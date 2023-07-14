<style>
   .modal-dialog {
      width: 60%;
      height: 60%;
      padding: 0;
      margin: 0;
   }

   .modal-content {
      height: 100%;
      min-height: 100%;
      height: auto;
      border-radius: 0;
   }

   .modal .modal-body {
      /*max-height: 520px;*/
      /*max-width: 900px;*/
      overflow-y: auto;
   }

   .vertical-alignment-helper {
      display: table;
      height: 100%;
      width: 100%;
      pointer-events: none;
   }

   .vertical-align-center {
      /* To center vertically */
      display: table-cell;
      vertical-align: middle;
      pointer-events: none;
   }

   .modal-content {
      width: inherit;
      height: inherit;
      margin: 0 auto;
      pointer-events: all;
   }

   img.displayed {
      display: block;
      margin-left: auto;
      margin-right: auto
   }

   div.dataTables_processing {
      z-index: 9999;
   }
</style>

<link href="https://cdn.datatables.net/fixedcolumns/3.2.2/css/fixedColumns.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>
<div class="panel panel-default" id="panel_example">
   <div class="panel-heading">
      <?php echo $page_title ?>
      <!-- Single button -->
      <div class="btn-group float-end mb-2">
         <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Export Data <span class="caret"></span>
         </button>
         <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo site_url('guest/export_data/' . base64url_encode('pdf/' . $this->uri->segment(3) . '/semua')) ?>">Semua pendaftar (*.pdf)</a></li>
            <li><a class="dropdown-item" href="<?php echo site_url('guest/export_data/' . base64url_encode('pdf/' . $this->uri->segment(3) . '/terpilih')) ?>">Pendaftar diterima (*.pdf)</a></li>
            <li>
               <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="<?php echo site_url('guest/export_data/' . base64url_encode('excel/' . $this->uri->segment(3) . '/semua')) ?>">Semua pendaftar (*.xls)</a></li>
            <li><a class="dropdown-item" href="<?php echo site_url('guest/export_data/' . base64url_encode('excel/' . $this->uri->segment(3) . '/terpilih')) ?>">Pendaftar diterima (*.xls)</a></li>
         </ul>
      </div>
   </div>
   <div class="panel-body">
      <table id="example" class="display nowrap" cellspacing="0" width="100%">
         <thead>
            <tr>
               <!-- <th></th> -->
               <!-- <th>NIK</th> -->
               <th>Nama Lengkap</th>
               <th>Kab / Kota</th>
               <th>Kecamatan</th>
               <th>Kelurahan</th>
               <th>Jenis Kelamin</th>
               <th>Perguruan Tinggi</th>
               <th>Jenis jurusan</th>
               <th>Program Studi</th>
               <th>Akreditasi</th>
               <th>Semester</th>
               <th>IPK</th>
               <th>Sertifikat</th>
               <th>Dokumen</th>
               <!-- <th>Status</th> -->
               <!--<th>Status Tahap Akhir</th>-->
               <!-- <th>Ubah Email</th> -->
               <!-- <th>Tgl Daftar</th> -->
               <!-- <th>Hapus</th> -->

            </tr>
         </thead>
         <tbody>

         </tbody>
      </table>
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
   <div class="vertical-alignment-helper">
      <div class="modal-dialog vertical-align-center">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Detail Data Diri.</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <img class="displayed mb-3" id="file_foto" src="" alt="" src="" width="170px" height="170px">
               <form class="row g-3">
                  <div id="form-part">
                     <div class="card border-primary shadow">
                        <div class="card-header bg-primary text-white mb-3">
                           DATA PRIBADI
                        </div>
                        <div class="card-body">
                           <div class="mb-3 form-floating">
                              <input type="text" id="nik" class="form-control" readonly>
                              <label for="nik" class="form-label">NIK</label>
                           </div>
                           <div class="mb-3 form-floating">
                              <input type="text" id="nokk" class="form-control" readonly>
                              <label for="nokk" class="form-label">No. Kartu Keluarga</label>
                           </div>

                           <div class="mb-3 form-floating">
                              <input type="text" class="form-control" id="nama_lengkap">
                              <label for="nama_lengkap" class="form-label">Nama lengkap (Beserta gelar jika ada)</label>
                           </div>

                           <div class="mb-3 form-floating">
                              <input type="text" class="form-control" id="jk">
                              <label for="jk" class="form-label">Jenis kelamin</label>
                           </div>

                           <div id="form-part-dosen" style="display:none">
                              <div class="mb-3 form-floating">
                                 <input type="text" id="nidn" name="nidn" class="form-control" placeholder="" tabindex="1" value="" readonly>
                                 <label for="nidn">NIDN</label>
                              </div>

                              <div class="row mb-3">
                                 <div class="col-12 col-sm-6 col-md-6 form-floating">
                                    <input type="text" id="lembaga_kerja" class="form-control" placeholder="" tabindex="1" value="">
                                    <label style="left:unset" for="lembaga_kerja">Perguruan Tinggi</label>
                                 </div>

                                 <div class="form-floating col-12 col-sm-6 col-md-6">
                                    <input type="text" id="prodi_kerja" class="form-control" placeholder="" tabindex="1" value="">
                                    <label style="left:unset" for="prodi_kerja">Program Studi</label>
                                 </div>
                              </div>

                           </div>

                           <div class="card border-primary shadow">
                              <div class="card-header bg-primary text-white mb-3">
                                 Alamat
                              </div>
                              <div class="card-body">
                                 <div class="row mb-3">
                                    <div class="form-floating col-12 col-sm-4 col-md-4">
                                       <input type="text" id="kab_kota" class="form-control" placeholder="" tabindex="1" value="">
                                       <label style="left:unset" for="kab_kota">Kabupaten</label>
                                    </div>

                                    <div class="form-floating col-12 col-sm-4 col-md-4">
                                       <input type="text" id="kecamatan" class="form-control" placeholder="" tabindex="1" value="">
                                       <label style="left:unset" for="kecamatan">Kecamatan</label>
                                    </div>

                                    <div class="form-floating col-12 col-sm-4 col-md-4">
                                       <input type="text" id="kelurahan" class="form-control" placeholder="" tabindex="1" value="">
                                       <label style="left:unset" for="kelurahan">Kelurahan/Desa</label>
                                    </div>
                                 </div>

                                 <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="alamat_rumah">
                                    <label style="left:unset" for="alamat_rumah" class="form-label">Alamat lengkap</label>
                                 </div>

                              </div>
                           </div>

                           <div class="row mb-3">
                              <div class="col-12 col-sm-6 col-md-6">
                                 <div class="form-floating form-group">
                                    <input type="text" id="kota_lahir" class="form-control">
                                    <label style="left:unset" for="kota_lahir" class="form-label">Kota lahir</label>
                                 </div>
                              </div>
                              <div class="col-12 col-sm-6 col-md-6">
                                 <div class="form-floating form-group">
                                    <input id="tgl_lahir" class="form-control">
                                    <label style="left:unset" for="tgl_lahir" class="form-label">Tanggal lahir</label>
                                 </div>
                              </div>
                           </div>
                           <div class="row mb-3">
                              <div class="col-12 col-sm-6 col-md-6">
                                 <div class="form-floating form-group">
                                    <input type="text" id="no_hp" class="form-control">
                                    <label style="left:unset" class="form-label" for="no_hp">Nomor handphone</label>
                                 </div>
                              </div>
                              <div class="col-12 col-sm-6 col-md-6">
                                 <div class="form-floating form-group">
                                    <input type="email" id="email" class="form-control">
                                    <label style="left:unset" class="form-label" for="email">Email</label>
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
                           <div class="mb-3 form-floating">
                              <input type="text" id="nama_lembaga" class="form-control">
                              <label class="form-label" for="nama_lembaga">Perguruan tinggi</label>
                           </div>

                           <div class="row mb-3">
                              <div class="col-12 col-sm-6 col-md-6">
                                 <div class="form-floating form-group">
                                    <input type="text" id="program_studi" class="form-control">
                                    <label style="left:unset" class="form-label" for="program_studi">Program studi</label>
                                 </div>
                              </div>
                              <div class="col-12 col-sm-6 col-md-6">
                                 <div class="form-floating form-group">
                                    <input type="text" class="form-control" id="akreditasi">
                                    <label style="left:unset" class="form-label" for="akreditasi">Akreditasi</label>
                                 </div>
                              </div>
                           </div>
                           <div class="row mb-3">
                              <div class="col-12 col-sm-6 col-md-6">
                                 <div class="form-floating form-group">
                                    <input type="text" class="form-control" id="semester">
                                    <label style="left:unset" class="form-label" for="semester">Semester</label>
                                 </div>
                              </div>
                              <div class="col-12 col-sm-6 col-md-6">
                                 <div class="form-floating form-group">
                                    <input type="text" class="form-control" id="ip_semester">
                                    <label style="left:unset" class="form-label" for="ip_semester">Index Prestasi Kumulatif (IPK)</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modalDokumen" role="dialog">
   <div class="vertical-alignment-helper">
      <div class="modal-dialog vertical-align-center" style="width: 70%;  height: 80%; padding: 0; margin: 0;">
         <!-- Modal content-->
         <div class="modal-content" style="height: 60%; min-height: 80%;  border-radius: 0; ">
            <div class="modal-header">
               <h5 class="modal-title">Dokumen</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalDokumenBody">

            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
         </div>
      </div>
   </div>
</div>

<script>
   function base64url_encode(data) {
      var str = base64.encode(data);
      str = str.replace('+', '-');
      str = str.replace('==', '');

      return str.replace('/', '_');
   }

   var datatable = $('#example').dataTable({
      "processing": true,
      "serverSide": true,
      "scrollX": true,
      "bSort": true,
      "pageLength": 10,
      "fixedColumns": {
         leftColumns: 1
      },
      ajax: {
         url: "<?php echo base_url(); ?>api/pendaftar_ajax",
         type: "POST",
         data: function(d) {
            d.slug = "<?php echo $this->uri->segment(3) ?>",
               d.filter = Cookies.get('filter');
         },
         complete: function() {

         },
         beforeSend: function() {


         }
      },

      "oLanguage": {
         "sProcessing": "Memproses Data....."
      },

      "columns": [
         // { "data": "nik"},
         {
            "data": "nama_lengkap" //0
         },
         {
            "data": "kab_kota" //1
         },
         {
            "data": "kecamatan"
         },
         {
            "data": "kelurahan"
         },
         {
            "data": "jk"
         },
         {
            "data": "nama_lembaga"
         },
         {
            "data": "jenis_jurusan" //6
         },
         {
            "data": "program_studi"
         },
         {
            "data": "akreditasi"
         },
         {
            "data": "semester"
         },
         {
            "data": "ip_semester" //10
         },
         {
            "data": "bobot" // 11
         },
         {
            "data": "dokumen"
         }
      ],
      "columnDefs": [{
            //<a href="#" class="detail" id="1671070911900008" onclick="show_detail('1671070911900008')">BELA RONALDOE</a>
            "render": function(data, type, row) {
               return '<a href="#" class="detail" id="' + row['nik'] + '" onclick="show_detail(\'' + row['nik'] + '\')">' + data + '</a>';
            },
            "targets": 0,
            "orderable": false
         },
         {
            "targets": 1,
            "orderable": false
         },
         {
            "targets": 2,
            "orderable": false
         },
         {
            "targets": 3,
            "orderable": false
         },
         {
            "targets": 4,
            "orderable": false
         },
         {
            "targets": 5,
            "orderable": false
         },
         {

            "render": function(data, type, row) {
               //return '<a href="#" class="ubah_email alert-info" id="ubah_email_' + row['nik'] + '" onclick="show_ubah_email(\'' + row['nik'] + '\')">' + data + '</a>';
               if (data === 'eksakta') {
                  return '<span class="badge bg-warning text-dark">EKSAKTA</span>';
               } else {
                  return '<span class="badge bg-success text-white">NON EKSAKTA</span>';
               }

            },
            "targets": 6,
            "searchable": false,
            "orderable": false
         },
         {
            "targets": 7,
            "orderable": false
         },
         {
            "targets": 8,
            "orderable": false
         },
         {
            "targets": 9,
            "orderable": false
         },
         {
            "targets": 10,
            "orderable": false
         },
         {
            "render": function(data, type, row) {
               if (data == 3) {
                  return '<span class="badge bg-warning text-dark">NASIONAL</span>';
               } else if (data == 4) {
                  return '<span class="badge bg-success text-white">INTERNASIONAL</span>';
               } else {
                  return '<span class="badge bg-secondary text-white">TIDAK ADA</span>';
               }

            },
            "targets": 11,
            "searchable": false,
            "orderable": false
         },
         {
            "render": function(data, type, row) {
               var dok_count = data.split('-');
               var jml_upload = '<span class="badge bg-secondary">' + dok_count[0] + '</span>&nbsp';
               var jml_diterima = '<span class="badge bg-success">' + dok_count[1] + '</span>&nbsp';
               var jml_ditolak = '<span class="badge bg-danger">' + dok_count[2] + '</span>';

               if (dok_count[0] === '00') {
                  return '<span class="badge bg-secondary">Belum ada dokumen yang diunggah</span>';
               } else {
                  return '<a onclick="load_dokumen(' + row['id'] + ')" class="btn btn-default">' + jml_upload + jml_diterima + jml_ditolak + '</a>';
               }

            },
            "targets": 12,
            "searchable": false
         }

      ],
      "fnDrawCallback": function() {

      },
   });

   $(document).ready(function() {

      var select = $('<select/>', {
         'class': '',
         'aria-label': 'Show entries',
         'style': 'text-align:right;float:right',
         'id': 'jenis_jurusan'
      }).appendTo($('#example_filter'));

      $('<option/>', {
         'value': '',
         'text': 'Semua jenis jurusan'
      }).appendTo(select);

      $('<option/>', {
         'value': 'eksakta',
         'text': 'Jurusan eksakta'
      }).appendTo(select);

      $('<option/>', {
         'value': 'non_eksakta',
         'text': 'Jurusan non eksakta'
      }).appendTo(select);

      let jenis_jurusan = document.getElementById('jenis_jurusan');


      $("#jenis_jurusan").val(Cookies.get('filter'));

      jenis_jurusan.addEventListener("change", function() {
         Cookies.set("filter", jenis_jurusan.value);
         datatable.fnDraw(true);
      });
   });

   $('#example')
      .on('processing.dt', function(e, settings, processing) {
         //  $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
         if (processing) {
            $('#panel_example').block({
               message: "",
               css: {
                  width: '100px',
                  left: '50%'
               },
               centerX: false,
            });
         } else {
            $('#panel_example').unblock({});
         }
      })
      .dataTable();

   function load_dokumen(pendaftar_id) {
      // alert(pendaftar_id);
      event.preventDefault();
      $.get("<?php echo site_url('guest/load_dokumen') ?>", {
            pendaftar_id: pendaftar_id,
            slug: base64url_encode('<?php echo $this->uri->segment(3) ?>')
         })
         .done(function(data) {

            $('#modalDokumenBody').html(data);
            $('#modalDokumen').modal('show');
         })

   }


   function show_detail(nik) {
      //var nik = this.id;
      event.preventDefault();
      $.get("<?php echo site_url('api/pendaftar_details') ?>", {
            nik: nik
         })
         .done(function(data) {
            $("#file_foto").attr("src", "<?php echo base_url() . 'uploads/foto/' ?>" + data.file_foto);
            // $('#nik').val(data.nik);
            // $('#nama_lengkap').val(data.nama_lengkap);
            // $('#alamat_rumah').val(data.alamat_rumah);
            // $('#jk').val(data.jk);
            // $('#kota_lahir').val(data.kota_lahir);
            // $('#tgl_lahir').val(data.tgl_lahir);
            // $('#no_hp').val(data.no_hp);
            // $('#email').val(data.email);
            // $('#nama_lembaga').val(data.nama_lembaga);
            // $('#program_studi').val(data.program_studi);
            // $('#akreditasi').val(data.akreditasi);
            // $('#semester').val(data.semester);
            // $('#ip_semester').val(data.ip_semester);

            for (const prop in data) {
               if ($('#' + prop).length) {
                  $('#' + prop).val(data[prop]);
               }
            }

            if (data.level_penerima == 'dosen') {
               $('#form-part-dosen').show();
            }

            $('#myModal').modal('show');
         });
   };

   // $('#modalDokumen').on('hidden.bs.modal', function () {
   //   $('#example').DataTable().ajax.reload(null,false)
   // })
</script>

<style>
   #jenis_jurusan {
      height: 30px;
   }
</style>