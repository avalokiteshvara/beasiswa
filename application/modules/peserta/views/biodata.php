 <!-- Include Selectize.js library -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


 <?php if ($biodata['status_akhir'] === 'diterima') { ?>
   <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
     <h4 style="text-align:center">SELAMAT ! Anda lulus tahap Akhir seleksi beasiswa</h4>
     <h4 style="text-align:center">Silahkan download dan cetak bukti lulus tahap akhir seleksi dengan menekan tombol "Cetak Bukti Lolos Tahap II"</a></h4>
   </div>
 <?php } ?>

 <?php if ($biodata['status'] === 'diterima') { ?>
   <div class="alert alert-primary bg-primary text-light border-0 alert-dismissible fade show" role="alert">
     <h4 style="text-align:center">SELAMAT ! Anda lulus tahap seleksi berkas</h4>
     <h4 style="text-align:center">Silahkan download dan cetak bukti lulus tahap seleksi berkas dengan menekan tombol "Cetak Bukti Lolos Tahap I"</a></h4>
   </div>
 <?php } ?>

 <?php if ($biodata['status'] === 'ditolak') { ?>
   <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
     <h4 style="text-align:center">Maaf , Anda belum lulus seleksi beasiswa kali ini</h4>
   </div>
 <?php } ?>


 <!-- <form action="<?php echo site_url('peserta/update_biodata') ?>" method="post" enctype="multipart/form-data" class="row g-3"> -->

 <form id="form-biodata" action="<?php echo site_url('peserta/update_biodata') ?>" method="post" enctype="multipart/form-data">

   <div class="card border-primary shadow">
     <div class="card-header bg-primary text-white mb-3">
       DATA PRIBADI
     </div>
     <div class="card-body">


       <div class="mb-3 mt-2">
         <label for="nik" class="form-label">NIK (Nomor Induk kependudukan)</label>
         <input type="text" class="form-control" name="nik" placeholder="NIK (Nomor Induk Kependudukan)" value="<?php echo $biodata['nik'] ?>" data-validation="required">
       </div>

       <div class="mb-3 mt-2">
         <label for="nokk" class="form-label">No. Kartu Keluarga</label>
         <input type="text" class="form-control" name="nokk" placeholder="No. Kartu Keluarga" value="<?php echo $biodata['nokk'] ?>" data-validation="required">
       </div>

       <div class="mb-3">
         <label for="exampleInputEmail1" class="form-label">Nama lengkap</label>
         <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama lengkap" value="<?php echo $biodata['nama_lengkap'] ?>" data-validation="required">
       </div>

       <?php if ($biodata['level_penerima'] === 'dosen') { ?>
         <div class="form-group mb-3">
           <label for="nidn" class="form-label">NIDN</label>
           <div class="input-group">
             <input type="text" name="nidn" id="nidn-input" class="form-control" placeholder="" tabindex="1" value="<?php echo $biodata['nidn'] ?>" data-validation="required">
             <div class="input-group-append">
               <button class="btn btn-success" id="submit-button" type="button">Cek NIDN</button>
             </div>
           </div>
         </div>

         <script>
           $(document).ready(function() {
             // Add click event listener to the submit button
             $('#submit-button').click(function() {
               // Get the NIDN value
               const nidn = $('#nidn-input').val();

               // Send the AJAX request
               $.ajax({
                 url: '<?php echo site_url('api/cek-nidn/') ?>' + nidn,
                 type: 'GET',

                 contentType: 'application/json',
                 success: function(response) {
                   // Handle the response as needed
                   console.log(response);
                   if (response.status === 'valid') {

                     $('#lembaga-kerja-input').val(response.pt_dinas);
                     $('#prodi_kerja-input').val(response.prodi_dinas);

                     swal({
                       title: 'Berhasil',
                       text: 'NIDN Berhasil diverifikasi',
                       type: 'success',
                       confirmButtonText: 'Ok'
                     });
                   }
                 },
                 error: function(xhr, status, error) {
                   console.error('Request failed. Status:', status);
                 }
               });
             });
           });
         </script>

         <div class="mb-3">
           <label for="lembaga_kerja" class="form-label">Perguruan Tinggi</label>
           <input type="text" name="lembaga_kerja" id="lembaga-kerja-input" class="form-control" placeholder="" tabindex="1" value="<?php echo $biodata['lembaga_kerja'] ?>" readonly>
         </div>

         <div class="mb-3">
           <label for="prodi_kerja" class="form-label">Program Studi</label>
           <input type="text" name="prodi_kerja" id="prodi_kerja-input" class="form-control" placeholder="" tabindex="1" value="<?php echo $biodata['prodi_kerja'] ?>" readonly>
         </div>

       <?php } ?>

       <div class="mb-3">
         <label for="email" class="form-label">Email</label>
         <input type="email" class="form-control" name="email" placeholder="Alamat Email" value="<?php echo $biodata['email'] ?>" data-validation="required">
       </div>

       <div class="mb-3">
         <label for="no_hp" class="form-label">No Handphone</label>
         <input type="text" class="form-control" name="no_hp" placeholder="No Handphone" value="<?php echo $biodata['no_hp'] ?>" data-validation="required">
       </div>

       <!-- <div class="mb-3">
        <label for="kab_kota" class="form-label">Alamat - Kabupaten / Kota</label>
        <input type="text" data-validation="required" class="form-control" name="kab_kota" placeholder="kabupaten / Kota" value="<?php echo $biodata['kab_kota'] ?>" required>
      </div> -->


       <div class="card border-primary shadow">
         <div class="card-header bg-primary text-white mb-3">
           ALAMAT RUMAH
         </div>
         <div class="card-body">
           <div class="form-group mb-3">
             <label for="select_wilayah">Desa / Kelurahan</label>
             <input type="text" id="select_wilayah" placeholder="Search for something...">
             <input type="hidden" name="wilayah" id="wilayah" value="<?php echo $biodata['kelurahan_id'] . ':' . $biodata['kelurahan'] . ':' . $biodata['kecamatan'] . ':' . $biodata['kab_kota'] ?>">
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

               }
             });

             $('#select_wilayah-selectized').val('<?php echo $biodata['kelurahan'] . ' - ' . $biodata['kecamatan'] . ' - ' . $biodata['kab_kota'] ?>');
             $('#select_wilayah-selectized').css('width', '420px');
           </script>

           <div class="form-group">
             <label for="alamat_rumah">Alamat lengkap</label>
             <input value="<?php echo $biodata['alamat_rumah'] ?>" type="text" class="form-control" id="alamat_rumah" name="alamat_rumah" placeholder="Masukkan Alamat rumah" data-validation="required">
           </div>
         </div>
       </div>

     </div>
   </div>

   <div class="card border-primary shadow">
     <div class="card-header bg-primary text-white mb-3">
       DATA STUDI
     </div>
     <div class="card-body">

       <div class="row mt-2">
         <div class="col-md-6">
           <label for="nama_lembaga" class="form-label">Perguruan Tinggi</label>
           <input type="text" class="form-control" name="nama_lembaga" placeholder="Perguruan Tinggi" value="<?php echo $biodata['nama_lembaga'] ?>" data-validation="required">
         </div>
         <div class="col-md-6">
           <label for="program_studi" class="form-label">Program Studi</label>
           <input type="text" class="form-control" name="program_studi" placeholder="Program Studi" value="<?php echo $biodata['program_studi'] ?>" data-validation="required">
         </div>
       </div>

       <div class="row mt-2">
         <div class="col-md-6">
           <label for="akreditasi" class="form-label">Jenis Jurusan</label>
           <select name="jenis_jurusan" class="form-control" data-validation="required">
             <option value="eksakta" <?php echo $biodata['jenis_jurusan'] === 'eksakta' ? 'selected' : '' ?>>Eksakta</option>
             <option value="non_eksakta" <?php echo $biodata['jenis_jurusan'] === 'non_eksakta' ? 'selected' : '' ?>>Non Eksakta</option>
           </select>
         </div>

         <div class="col-md-6">
           <label for="akreditasi" class="form-label">Akreditasi program studi</label>
           <select name="akreditasi" class="form-control" data-validation="required">
             <option value="">Pilih akreditasi</option>
             <?php $akreditasi = explode(',', $biodata['akreditasi_prog_studi']);
              foreach ($akreditasi as $akr) { ?>
               <option <?php echo $biodata['akreditasi'] === $akr ? 'selected' : '' ?> value="<?php echo $akr; ?>"><?php echo $akr; ?></option>
             <?php } ?>
           </select>
         </div>
       </div>

       <div class="row mt-2">

         <div class="col-md-6">
           <label for="semester" class="form-label">Semester</label>
           <select name="semester" class="form-control" data-validation="required">
             <option value="">Pilih semester</option>
             <?php $semester = explode(',', $biodata['semester_kategori']);
              foreach ($semester as $smt) { ?>
               <option <?php echo $biodata['semester'] === $smt ? 'selected' : '' ?> value="<?php echo $smt; ?>"><?php echo ucfirst(terbilang($smt)); ?></option>
             <?php } ?>
           </select>
         </div>


         <div class="col-md-6">
           <label for="ip_semester" class="form-label">Index Prestasi Kumulatif (IPK) *</label>
           <?php $ip_minimal = explode(':', $biodata['ip_minimal']); ?>

           <?php if ($biodata['strict_ip_minimal'] === 'N') { ?>
             <input type="text" name="ip_semester" value="<?php echo str_replace('.', ',', $biodata['ip_semester']) ?>" class="form-control" placeholder="Indeks Prestasi Kumulatif (IPK)" tabindex="6" value="" data-validation="number" data-validation-allowing="range[1.0;4.0],float" data-validation-decimal-separator="," data-validation-error-msg="Nilai IPK tidak valid" data-validation-help="pisahkan desimal dengan koma (',')">
             <p class="help-block"><?php echo "* IPK minimal untuk beasiswa ini adalah " . $ip_minimal[0] . " untuk eksakta dan " . $ip_minimal[1] . " untuk non eksakta , namun jika anda memiliki prestasi non akademik, anda dapat memasukkan nilai dibawah itu" ?></p>
           <?php } else { ?>
             <input type="text" name="ip_semester" value="<?php echo str_replace('.', ',', $biodata['ip_semester']) ?>" class="form-control" placeholder="Indeks Prestasi Kumulatif (IPK)" tabindex="6" value="" data-validation="number" data-validation-depends-on="jenis_jurusan" data-validation-depends-on-value="eksakta, non_eksakta" data-validation-allowing="range[<?php echo $ip_minimal[0] ?> ;4.0],float" data-validation-decimal-separator="," data-validation-error-msg="Format Nilai IPK tidak valid atau dibawah ketentuan" data-validation-help="pisahkan desimal dengan koma (',')">
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
       </div>


       <div class="row mt-2">
         <div class="col-md-6">

         </div>
         <div class="col-md-6 text-md-end">
           <button type="submit" class="btn btn-success">Simpan</button>
         </div>
       </div>

     </div>
   </div>



 </form>

 <script>
   var myLanguage = {
     requiredField: 'Input ini dibutuhkan',
     errorTitle: 'Gagal mengirimkan formulir!',
     requiredFields: 'Anda belum menjawab semua input yang dibutuhkan',
     badTime: 'Anda belum memberikan waktu yang benar',
     badEmail: 'Alamat email tidak valid',
     badTelephone: 'Anda belum memberikan nomor telepon yang benar',
     badSecurityAnswer: 'Anda belum memberikan jawaban yang benar untuk pertanyaan keamanan',
     badDate: 'Anda belum memberikan tanggal yang benar',
     lengthBadStart: 'Nilai input harus antara ',
     lengthBadEnd: ' karakter',
     lengthTooLongStart: 'Nilai input lebih panjang dari ',
     lengthTooShortStart: 'Nilai input lebih pendek dari ',
     notConfirmed: 'Nilai input tidak dapat dikonfirmasi',
     badDomain: 'Nilai domain salah',
     badUrl: 'Nilai input bukan URL yang benar',
     badCustomVal: 'Nilai input salah',
     andSpaces: ' dan spasi ',
     badInt: 'Nilai input bukan angka yang benar',
     badSecurityNumber: 'Nomor keamanan sosial Anda salah',
     badUKVatAnswer: 'Nomor VAT UK salah',
     badStrength: 'Kata sandi tidak cukup kuat',
     badNumberOfSelectedOptionsStart: 'Anda harus memilih setidaknya ',
     badNumberOfSelectedOptionsEnd: ' jawaban',
     badAlphaNumeric: 'Nilai input hanya dapat mengandung karakter alfanumerik ',
     badAlphaNumericExtra: ' dan ',
     wrongFileSize: 'File yang ingin Anda unggah terlalu besar (maksimum %s)',
     wrongFileType: 'Hanya file dengan tipe %s yang diizinkan',
     groupCheckedRangeStart: 'Silakan memilih antara ',
     groupCheckedTooFewStart: 'Silakan memilih setidaknya ',
     groupCheckedTooManyStart: 'Silakan memilih maksimum ',
     groupCheckedEnd: ' item',
     badCreditCard: 'Nomor kartu kredit tidak benar',
     badCVV: 'Nomor CVV tidak benar',
     wrongFileDim: 'Dimensi gambar tidak benar,',
     imageTooTall: 'gambar tidak boleh lebih tinggi dari',
     imageTooWide: 'gambar tidak boleh lebih lebar dari',
     imageTooSmall: 'gambar terlalu kecil',
     min: 'minimum',
     max: 'maksimum',
     imageRatioNotAccepted: 'Rasio gambar tidak diterima'
   };

   var inputs = document.querySelectorAll("#form-biodata input");
   for (var i = 0; i < inputs.length; i++) {
     inputs[i].addEventListener("keydown", function(event) {
       if (event.keyCode === 13) { // Check if Enter key is pressed
         event.preventDefault(); // Mencegah aksi default (submit form)
       }
     });
   }

   $.validate({
     language: myLanguage,
     modules: 'date',
     scrollToTopOnError: true,
     onValidate: function($f) {

       console.log('about to validate form ' + $f.attr('id'));

       var $callbackInput = $('#callback');
       if ($callbackInput.val() == 1) {
         return {
           element: $callbackInput,
           message: 'This validation was made in a callback'
         };
       }
     },
     onError: function($form) {
       // tampilkan pesan error pada elemen dengan kelas "error-message"
       // $('.error-message').text('Form tidak valid. Periksa kembali isian Anda.');
       //  var errorElements = document.getElementsByClassName("form-error");
       //  if (errorElements.length > 0) {
       //    var firstErrorElement = errorElements[0];
       //    firstErrorElement.scrollIntoView();
       //  }
       
       swal({
         title: 'Ada kesalahan!',
         text: 'Form tidak valid. Periksa kembali isian Anda.',
         icon: 'error',
         confirmButtonText: 'Ok',
         allowEscapeKey: true,
         allowOutsideClick: true,
       });
     }
   });



   //  var myForm = document.getElementById('form-biodata');

   //  var inputElements = myForm.getElementsByTagName('input');
   //  var errorCount = 0;
   //  for (var i = 0; i < inputElements.length; i++) {
   //    inputElements[i].addEventListener('blur', function() {

   //      var formElements = myForm.querySelectorAll('*');
   //      console.log("Class pada elemen dalam formulir:");
   //      formElements.forEach(function(element) {
   //        var classList = element.classList;
   //        if (classList.contains('form-error')) {
   //          errorCount++;
   //        }
   //      });


   //      console.log("Jumlah kesalahan:", errorCount);
   //      if (errorCount > 0) {
   //        alert("Ada kesalahan pada input dalam formulir");
   //      }

   //    });
   //  }
 </script>