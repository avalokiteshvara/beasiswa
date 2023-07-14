<style>
  .help-block.form-error {
    color: red;
  }
</style>
<form id="form_update_biodata" enctype="multipart/form-data">
  <input type="hidden" name="id" id="bio_id" value="<?php echo $biodata['id'] ?>">
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">NIK (Nomor Induk kependudukan)</label>
    <input type="text" class="form-control" id="bio_nik" name="nik" placeholder="NIK (Nomor Induk Kependudukan)" value="<?php echo $biodata['nik'] ?>" readonly>
  </div>
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">No. Kartu Keluarga</label>
    <input type="text" class="form-control" id="bio_nokk" name="nokk" placeholder="No Kartu Keluarga" value="<?php echo $biodata['nokk'] ?>" readonly>
  </div>
  
  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control" id="bio_email" name="email" placeholder="Alamat Email" value="<?php echo $biodata['email'] ?>" readonly>
  </div>


  <div class="form-group mb-3">
    <label for="select_wilayah">Desa / Kelurahan</label>
    <input type="text" id="select_wilayah" placeholder="Search for something...">
    <input type="hidden" name="wilayah" id="wilayah" value="<?php echo $biodata['kelurahan_id'] . ':' . $biodata['kelurahan'] . ':' . $biodata['kecamatan'] . ':' . $biodata['kab_kota'] ?>">
  </div>

  <div class="form-group mb-3">
    <label for="exampleInputEmail1">Alamat lengkap</label>
    <input type="text" class="form-control" id="bio_alamat_rumah" name="alamat_rumah" placeholder="" value="<?php echo $biodata['alamat_rumah'] ?>">
  </div>


  <script>
    // Initialize Selectize.js on input field
    var selectize = $('#select_wilayah').selectize({
      // Set options for Selectize.js
      valueField: 'id',
      labelField: 'text',
      searchField: ['desa'],
      options: [],
      create: false,
      maxItems: 1,
      closeAfterSelect: true,
      loadThrottle: 500, // Set throttle time to 500 ms
      placeholder: 'Cari desa/kelurahan (Masukkan minimal 3 karakter)',
      items: [],
      preload: true,

      // Use fetch API to retrieve data from API
      load: function(query, callback) {
        if (!query.length || query.length < 3) return callback(); // Don't fetch API if query length is less than 3
        $.ajax({
          url: '<?php echo base_url("api/get-wilayah"); ?>',
          type: 'GET',
          dataType: 'json',
          data: {
            q: query
          },
          error: function() {
            callback();
          },
          success: function(res) {
            callback(res);
          }
        });
      },
      onChange: function(value) {
        var data = this.options[value];
        $('#wilayah').val(data.id + ':' + data.desa + ':' + data.kec + ':' + data.kab);
        // $('#bio_kelurahan').val(data.desa);
        // $('#bio_kecamatan').val(data.kec);
        // $('#bio_kab_kota').val(data.kab);
      }
    });

    $('#select_wilayah-selectized').val('<?php echo $biodata['kelurahan'] . ' - ' . $biodata['kecamatan'] . ' - ' . $biodata['kab_kota'] ?>');
    $('#select_wilayah-selectized').css('width', '420px');
  </script>

  <div class="form-group mb-3">
    <label for="akreditasi">Akreditasi program studi</label>
    <select id="bio_akreditasi" name="akreditasi" class="form-control" data-validation="required">
      <option value="">Pilih akreditasi</option>
      <?php $akreditasi = explode(',', $biodata['akreditasi_prog_studi']);
      foreach ($akreditasi as $akr) { ?>
        <option <?php echo $biodata['akreditasi'] === $akr ? 'selected' : '' ?> value="<?php echo $akr; ?>"><?php echo $akr; ?></option>
      <?php   } ?>
    </select>
  </div>

  <div class="form-group mb-3">
    <label for="akreditasi">Akreditasi program studi</label>
    <label for="jenis_jurusan">Jenis Jurusan</label>
    <select id="bio_jenis_jurusan" name="jenis_jurusan" class="form-control" data-validation="required">
      <option value="eksakta" <?php echo $biodata['jenis_jurusan'] === 'eksakta' ? 'selected' : '' ?>>Eksakta</option>
      <option value="non_eksakta" <?php echo $biodata['jenis_jurusan'] === 'non_eksakta' ? 'selected' : '' ?>>Non Eksakta</option>
    </select>
  </div>

  <div class="form-group mb-3">
    <label for="semester">Semester</label>
    <select id="bio_semester" name="semester" class="form-control" data-validation="required">
      <option value="">Pilih semester</option>
      <?php $semester = explode(',', $biodata['semester_kategori']);
      foreach ($semester as $smt) { ?>
        <option <?php echo $biodata['semester'] === $smt ? 'selected' : '' ?> value="<?php echo $smt; ?>"><?php echo ucfirst(terbilang($smt)); ?></option>

      <?php   } ?>
    </select>
  </div>


  <div class="form-group mb-3">
    <label for="ip_semester">Index Prestasi Kumulatif (IPK) *</label>
    <?php $ip_minimal = explode(':', $biodata['ip_minimal']); ?>

    <?php if ($biodata['strict_ip_minimal'] === 'N') { ?>
      <input type="text" id="bio_ip_semester" name="ip_semester" class="form-control" placeholder="Indeks Prestasi Kumulatif (IPK)" tabindex="6" value="<?php echo str_replace('.', ',', $biodata['ip_semester']) ?>" data-validation="number" data-validation-allowing="range[1.0;4.0],float" data-validation-decimal-separator="," data-validation-error-msg="Nilai IPK tidak valid" data-validation-help="pisahkan desimal dengan koma (',')">
      <p class="help-block"><?php echo "* IPK minimal untuk beasiswa ini adalah " . $ip_minimal[0] . " untuk eksakta dan " . $ip_minimal[1] . " untuk non eksakta" ?></p>
    <?php } else { ?>
      <input type="text" id="bio_ip_semester" name="ip_semester" class="form-control" placeholder="Indeks Prestasi Kumulatif (IPK)" tabindex="6" value="<?php echo str_replace('.', ',', $biodata['ip_semester']) ?>" data-validation="number" data-validation-depends-on="jenis_jurusan" data-validation-depends-on-value="1, 2" data-validation-allowing="range[<?php echo $ip_minimal[0] ?> ;4.0],float" data-validation-decimal-separator="," data-validation-error-msg="Nilai IPK tidak valid atau dibawah ketentuan" data-validation-help="pisahkan desimal dengan koma (',')">
      <p class="help-block"><?php echo "* IPK minimal untuk beasiswa ini adalah " . $ip_minimal[0] . " untuk eksakta dan " . $ip_minimal[1] . " untuk non eksakta" ?></p>
      <script>
        // Ambil elemen input yang akan dimodifikasi berdasarkan nama
        var targetField = document.querySelector('[name="ip_semester"]');

        // Tambahkan event listener pada elemen input `numberField`
        var numberField = document.querySelector('[name="jenis_jurusan"]');
        numberField.addEventListener('change', function() {
          var min = 0.0;
          if (numberField.value == 1) {
            var min = <?php echo $ip_minimal[0] ?>;
          } else {
            var min = <?php echo $ip_minimal[1] ?>;
          }

          // Modifikasi nilai atribut `data-validation-allowing` pada elemen `targetField`
          targetField.setAttribute('data-validation-allowing', 'range[' + min + ';4.0],float');
        });
      </script>
    <?php } ?>

  </div>

  <div class="form-group mb-3">
    <?php if (empty($biodata['file_foto'])) { ?>
      <img src="<?php echo site_url('uploads/foto/nofoto.jpg') ?>" alt="No-Foto" height="42" width="42" id="view_foto">
      <br />
    <?php } else { ?>
      <a href="<?php echo site_url('uploads/foto/' . $biodata['file_foto']) ?>" target="_blank" id="link_view_foto">
        <img src="<?php echo site_url('uploads/foto/' . $biodata['file_foto']) ?>" alt="File foto" height="42" width="42" id="view_foto">
      </a>
      <br />
    <?php } ?>

    <label for="exampleInputFile">File foto</label>
    <input type="file" id="bio_file_foto" name="file_foto">
    <p class="help-block">Ukuran maks. file :512KB ; Jenis file :jpg</p>
  </div>

  <div class="alert alert-danger" id="alert_bio_danger" style="display:none">
    <strong>Peringatan!</strong> <br />
    <div id="bio_msg_danger"></div>
  </div>
  <div class="alert alert-success" id="alert_bio_success" style="display:none">
    <strong>Info!</strong> <br />
    <div id="bio_msg_success"></div>
  </div>

  <button type="submit" class="btn btn-success">Simpan</button>
  &nbsp;&nbsp;<img src="<?php echo site_url('assets/manage/img/loading.gif') ?>" id="loading_ubah_biodata" style="display:none">
</form>

<script type="text/javascript">
  $(document).ready(function() {
    var myLanguage = {
      requiredField: 'Input ini dibutuhkan',
      errorTitle: 'Form submission failed!',
      requiredFields: 'You have not answered all required fields',
      badTime: 'You have not given a correct time',
      badEmail: 'Alamat email tidak valid',
      badTelephone: 'You have not given a correct phone number',
      badSecurityAnswer: 'You have not given a correct answer to the security question',
      badDate: 'You have not given a correct date',
      lengthBadStart: 'The input value must be between ',
      lengthBadEnd: ' characters',
      lengthTooLongStart: 'The input value is longer than ',
      lengthTooShortStart: 'The input value is shorter than ',
      notConfirmed: 'Input values could not be confirmed',
      badDomain: 'Incorrect domain value',
      badUrl: 'The input value is not a correct URL',
      badCustomVal: 'The input value is incorrect',
      andSpaces: ' and spaces ',
      badInt: 'The input value was not a correct number',
      badSecurityNumber: 'Your social security number was incorrect',
      badUKVatAnswer: 'Incorrect UK VAT Number',
      badStrength: 'The password isn\'t strong enough',
      badNumberOfSelectedOptionsStart: 'You have to choose at least ',
      badNumberOfSelectedOptionsEnd: ' answers',
      badAlphaNumeric: 'The input value can only contain alphanumeric characters ',
      badAlphaNumericExtra: ' and ',
      wrongFileSize: 'The file you are trying to upload is too large (max %s)',
      wrongFileType: 'Only files of type %s is allowed',
      groupCheckedRangeStart: 'Please choose between ',
      groupCheckedTooFewStart: 'Please choose at least ',
      groupCheckedTooManyStart: 'Please choose a maximum of ',
      groupCheckedEnd: ' item(s)',
      badCreditCard: 'The credit card number is not correct',
      badCVV: 'The CVV number was not correct',
      wrongFileDim: 'Incorrect image dimensions,',
      imageTooTall: 'the image can not be taller than',
      imageTooWide: 'the image can not be wider than',
      imageTooSmall: 'the image was too small',
      min: 'min',
      max: 'max',
      imageRatioNotAccepted: 'Image ratio is not accepted'
    };

    $.validate({
      language: myLanguage,
      modules: 'date'
    });
  });



  $("#form_update_biodata").submit(function(e) {

    var fd = new FormData();
    fd.append('id', $('#bio_id').val());
    // fd.append('kab_kota', $('#bio_kab_kota').val());
    // fd.append('kecamatan', $('#bio_kecamatan').val());
    // fd.append('kelurahan', $('#bio_kelurahan').val());

    fd.append('wilayah', $('#wilayah').val());
    fd.append('akreditasi', $('#bio_akreditasi').val());
    fd.append('semester', $('#bio_semester').val());
    fd.append('alamat_rumah', $('#bio_alamat_rumah').val());

    fd.append('jenis_jurusan', $('#bio_jenis_jurusan').val());

    fd.append('ip_semester', $('#bio_ip_semester').val());
    fd.append('file_foto', $("#bio_file_foto").prop("files")[0]);

    $.ajax({
      beforeSend: function() {
        $('#loading_ubah_biodata').show();
      },
      type: "POST",
      url: "<?php echo site_url('admin/update_biodata') ?>",
      data: fd,
      dataType: 'json',
      processData: false,
      contentType: false,
      success: function(data) {
        $('#loading_ubah_biodata').hide();

        $('#alert_bio_danger').hide();
        $('#alert_bio_success').hide();

        if (data.status !== 'OK') {
          $('#alert_bio_danger').show();
          $('#bio_msg_danger').html(data.msg);
        } else {
          $('#alert_bio_success').show();
          $('#bio_msg_success').html(data.msg);

          // datatable.api().draw();

          if (data.foto !== 'use_old_foto') {
            $('#view_foto').attr('src', data.foto);
            $('#link_view_foto').attr('href', data.foto);
          }
        }
      }
    });

    e.preventDefault(); // avoid to execute the actual submit of the form.
  });
</script>