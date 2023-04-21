
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
      <!-- <div class="btn-group pull-right">
         <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Export Data<span class="caret"></span>
         </button>
         <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('admin/export_data/' . base64url_encode('pdf/' . $this->uri->segment(3) . '/semua')) ?>">Semua pendaftar (*.pdf)</a></li>
            <li><a href="<?php echo site_url('admin/export_data/' . base64url_encode('pdf/' . $this->uri->segment(3) . '/terpilih')) ?>">Pendaftar diterima (*.pdf)</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo site_url('admin/export_data/' . base64url_encode('excel/' . $this->uri->segment(3) . '/semua')) ?>">Semua pendaftar (*.xls)</a></li>
            <li><a href="<?php echo site_url('admin/export_data/' . base64url_encode('excel/' . $this->uri->segment(3) . '/terpilih')) ?>">Pendaftar diterima (*.xls)</a></li>
         </ul>
      </div> -->
   </div>
   <div class="panel-body">
      <table id="example" class="display nowrap" cellspacing="0" width="100%">
         <thead>
            <tr>
               <!-- <th></th> -->
               <!-- <th>NIK</th> -->
               <th>Nama Lengkap</th>
               <th>Kab / Kota</th>
               <th>Jenis Kelamin</th>
               <th>Perguruan Tinggi</th>
               <th>Program Studi</th>
               <th>Akreditasi</th>
               <th>Semester</th>
               <th>IP</th>
               <th>Dokumen</th>
               <th>Status</th>
               <!--<th>Status Tahap Akhir</th>-->
               <th>Ubah Email</th>
               <th>Tgl Daftar</th>
               <th>Hapus</th>

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
               <h5 class="modal-title">Detail Data Diri</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form>
                  <img class="displayed" id="file_foto" src="" alt="" src="" width="170px" height="170px">
                  <div id="form-part">
                     <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" id="nik" class="form-control" readonly>
                     </div>
                     <div class="form-group">
                        <label for="nama_lengkap">Nama lengkap (Beserta gelar jika ada)</label>
                        <input type="text" class="form-control" id="nama_lengkap">
                     </div>
                     <div class="form-group">
                        <label for="alamat_rumah">Alamat rumah</label>
                        <input type="text" class="form-control" id="alamat_rumah">
                     </div>
                     <div class="form-group">
                        <label for="jk">Jenis kelamin</label>
                        <input type="text" class="form-control" id="jk">
                     </div>
                     <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                           <div class="form-group">
                              <label for="kota_lahir">Kota lahir</label>
                              <input type="text" id="kota_lahir" class="form-control">
                           </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                           <div class="form-group">
                              <label for="tgl_lahir">Tanggal lahir</label>
                              <input id="tgl_lahir" class="form-control">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                           <div class="form-group">
                              <label for="no_hp">Nomor handphone</label>
                              <input type="text" id="no_hp" class="form-control">
                           </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                           <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" id="email" class="form-control">
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="nama_lembaga">Perguruan tinggi</label>
                        <input type="text" id="nama_lembaga" class="form-control">
                     </div>
                     <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                           <div class="form-group">
                              <label for="program_studi">Program studi</label>
                              <input type="text" id="program_studi" class="form-control">
                           </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                           <div class="form-group">
                              <label for="akreditasi">Akreditasi</label>
                              <input type="text" class="form-control" id="akreditasi">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                           <div class="form-group">
                              <label for="semester">Semester</label>
                              <input type="text" class="form-control" id="semester">
                           </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                           <div class="form-group">
                              <div class="form-group">
                                 <label for="ip_semester">Indeks Prestasi Kumulatif (IPK)</label>
                                 <input type="text" class="form-control" id="ip_semester">
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

<div class="modal fade" id="modalUbahEmail" role="dialog">
   <div class="vertical-alignment-helper">
      <div class="modal-dialog vertical-align-center" style="width: 40%;  height: 30%; padding: 0; margin: 0;">

         <div class="modal-content" style="height: 40%; min-height: 40%;  border-radius: 0; ">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Ubah Email</h4>
            </div>
            <div class="modal-body">
               <div class="alert alert-danger" id="alert_email_udah_digunakan" style="display:none">
                  <strong>Peringatan!</strong> <br />Email ini telah digunakan oleh pendaftar dengan ID yang berbeda.
               </div>
               <form method="post" id="form_ubah_email">
                  <input type="hidden" name="pendaftar_id" id="pendaftar_id" />
                  <input type="hidden" name="ubah_email_nik" id="ubah_email_nik" />
                  <div id="form-part">
                     <div class="form-group">
                        <label for="email_lama">Email lama</label>
                        <input type="email" id="email_lama" class="form-control" readonly>
                     </div>
                     <div class="form-group">
                        <label for="email_baru">Email baru</label>
                        <input type="email" class="form-control" id="email_baru" required>
                     </div>
                  </div>

                  <button type="submit" class="btn btn-danger pull-right">Submit <span class="fa fa-arrow-right"></span>
                     &nbsp;&nbsp;<img src="<?php echo site_url('assets/manage/img/loading.gif') ?>" id="loading_ubah_email" style="display:none">
                  </button>
               </form>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="modalDokumen" role="dialog">
   <div class="vertical-alignment-helper">
      <div class="modal-dialog vertical-align-center" style="width: 60%;  height: 80%; padding: 0; margin: 0;">
         <!-- Modal content-->
         <div class="modal-content" style="height: 60%; min-height: 80%;  height: auto; border-radius: 0; ">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Dokumen</h4>
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

<style>
   /*td.details-control {
      background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
      cursor: pointer;
  }
  tr.details td.details-control {
      background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
  }*/
</style>

<script>
   //  var datatable = $('#example').DataTable({
   //      "scrollX": true,
   //      fixedColumns : {
   //        leftColumns: 1
   //      }
   //  });
   // function format ( d ) {
   //   return 'The child row can contain any data you wish, including links, images, inner tables etc.';
   // }

   // function base64url_encode( data){
   //   var str = base64.encode(data);
   //   str = str.replace('+','-');
   //   str = str.replace('==','');

   //   return str.replace('/','_');
   // }

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
         "url": "<?php echo base_url(); ?>admin/penerima_sebelumnya_ajax",
         "type": "POST",
         "data": {
            slug: "<?php echo $this->uri->segment(3) ?>"
         }
      },

      "oLanguage": {
         "sProcessing": "Memproses Data....."
      },

      "columns": [
         // { "data": "nik"},
         {
            "data": "nama_lengkap"
         },
         {
            "data": "kab_kota"
         },
         {
            "data": "jk"
         },
         {
            "data": "nama_lembaga"
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
            "data": "ip_semester"
         },
         {
            "data": "dokumen"
         },
         {
            "data": "status"
         },
         {
            "data": "email"
         },
         {
            "data": "tgl_daftar"
         },
         {
            "data": "id"
         },
         // { "data": "ubah_email"},
         // { "data": "hapus"},
         //hidden
         // { "data": "nama_pendaftar" },
         // { "data": "email" },
      ],
      "columnDefs": [{
            //<a href="#" class="detail" id="1671070911900008" onclick="show_detail('1671070911900008')">BELA RONALDOE</a>
            "render": function(data, type, row) {
               return '<a href="#" class="detail" id="' + row['nik'] + '" onclick="show_detail(\'' + row['nik'] + '\')">' + data + '</a>';
            },
            "targets": 0
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
            "targets": 8,
            "searchable": false
         },
         {
            "render": function(data, type, row) {
               if (data === 'pending') {
                  var image_div = '<img src="<?php echo site_url('assets/manage/img/loading.gif') ?>" id="loading_' + row['id'] + '" style="display:none">';
                  var diterima = '<a class="diterima" onclick="set_status_pendaftaran(' + row['id'] + ',\'diterima\')">TERIMA</a> | ';
                  var ditolak = '<a class="ditolak" onclick="set_status_pendaftaran(' + row['id'] + ',\'ditolak\')">TOLAK</a>';

                  var berkas = '<div id="td_' + row['id'] + '">' + image_div + 'BERKAS : ' + diterima + ditolak + '</div>';

                  return berkas;
               } else if (data === 'diterima') {
                  var pendaftar_id_base64 = (base64url_encode(row['id']));
                  var berkas = 'BERKAS : <span class="badge bg-success">Diterima</span>&nbsp;-&nbsp;';
                  berkas += '<a href="<?php echo site_url('admin/cetak_bukti_pendaftaran/') ?>' + pendaftar_id_base64 + '">[ Download Bukti]</a><br />';


                  if (row['status_akhir'] === 'pending') {
                     var image_div = '<img src="<?php echo site_url('assets/manage/img/loading.gif') ?>" id="loading_' + row['id'] + '" style="display:none">';
                     var diterima = '<a class="diterima" onclick="set_status_akhir(' + row['id'] + ',\'diterima\')">TERIMA</a> | ';
                     var ditolak = '<a class="ditolak" onclick="set_status_akhir(' + row['id'] + ',\'ditolak\')">TOLAK</a>';

                     var akhir = '<div id="td_' + row['id'] + '">' + image_div + 'AKHIR : ' + diterima + ditolak + '</div>';

                     return berkas + akhir;
                  } else if (row['status_akhir'] === 'diterima') {

                     var pendaftar_id_base64 = (base64url_encode(row['id']));
                     var akhir = 'AKHIR : <span class="badge bg-success">Diterima</span>&nbsp;-&nbsp;';
                     akhir += '<a href="<?php echo site_url('admin/cetak_bukti_penerima_beasiswa/') ?>' + pendaftar_id_base64 + '">[ Download Bukti]</a><br />';

                     return berkas + akhir;

                  } else {
                     akhir = '<span class="badge bg-danger">Ditolak</span>';
                     return berkas + akhir;
                  }


               } else {
                  return '<span class="badge bg-danger">Ditolak</span>';
               }

            },
            "targets": 9
         },
         {
            "render": function(data, type, row) {
               return '<a href="#" class="ubah_email alert-info" id="ubah_email_' + row['nik'] + '" onclick="show_ubah_email(\'' + row['nik'] + '\')">' + data + '</a>';
            },
            "targets": 10

         }, {

            "targets": 11,
            "searchable": false
         },
         {
            "render": function(data, type, row) {
               return '<a class="alert alert-danger" onclick="hapus_pendaftaran(' + data + ')">HAPUS</a>';
            },
            "targets": 12
         }

         //  {
         //    "visible" : false,
         //    "targets":0
         //  }
         //   { "orderable": false, "targets": 8 },
         //   { "orderable": false, "targets": 9 },
         //   { "targets": [ 10 ] , "visible": false , "searchable": true },
         //   { "targets": [ 11 ] , "visible": false , "searchable": true },
      ],
      "fnDrawCallback": function() {

      },
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
      $.get("<?php echo site_url('admin/load_dokumen') ?>", {
            pendaftar_id: pendaftar_id,
            slug: base64url_encode('<?php echo $this->uri->segment(3) ?>')
         })
         .done(function(data) {

            $('#modalDokumenBody').html(data);
            $('#modalDokumen').modal('show');
         })

   }

   function hapus_pendaftaran(pendaftar_id) {
      var return_confirm = confirm('Apakah anda yakin ingin menghapus pendaftaran peserta?');
      if (return_confirm) {
         $.ajax({
            url: "<?php echo site_url('admin/hapus_pendaftaran/') ?>" + pendaftar_id
         }).done(function(msg) {
            $('#tr_' + pendaftar_id).fadeTo("slow", 0.7, function() {
               //$('#tr_' + pendaftar_id).remove();
               datatable.api().row($(this)).remove().draw(false);
            });
         });
      }
   }

   function set_status_pendaftaran(pendaftar_id, status) {

      if (status == 'diterima') {
         var return_confirm = confirm('Apakah anda yakin ingin menerima peserta ini?');
         if (return_confirm) {
            $.ajax({
               beforeSend: function() {
                  $('#loading_' + pendaftar_id).show();
               },
               url: "<?php echo site_url('admin/set_status_pendaftaran/diterima/') ?>" + pendaftar_id
            }).done(function(msg) {
               $('#td_' + pendaftar_id).html('BERKAS : ' + msg);
               //datatable.draw();
            });
         }

      } else {
         var return_confirm = confirm('Apakah anda yakin ingin menolak peserta ini?');
         if (return_confirm) {
            $.ajax({
               beforeSend: function() {
                  $('#loading_' + pendaftar_id).show();
               },
               url: "<?php echo site_url('admin/set_status_pendaftaran/ditolak/') ?>" + pendaftar_id
            }).done(function(msg) {
               $('#td_' + pendaftar_id).html(msg);
            });
         }
      }
   }

   function set_status_akhir(pendaftar_id, status) {

      if (status == 'diterima') {
         var return_confirm = confirm('Apakah anda yakin ingin menerima peserta ini?');
         if (return_confirm) {
            $.ajax({
               beforeSend: function() {
                  $('#loading_' + pendaftar_id).show();
               },
               url: "<?php echo site_url('admin/set_status_akhir/diterima/') ?>" + pendaftar_id
            }).done(function(msg) {
               $('#td_' + pendaftar_id).html('BERKAS : ' + msg);
               //datatable.draw();
            });
         }

      } else {
         var return_confirm = confirm('Apakah anda yakin ingin menolak peserta ini?');
         if (return_confirm) {
            $.ajax({
               beforeSend: function() {
                  $('#loading_' + pendaftar_id).show();
               },
               url: "<?php echo site_url('admin/set_status_akhir/ditolak/') ?>" + pendaftar_id
            }).done(function(msg) {
               $('#td_' + pendaftar_id).html(msg);
            });
         }
      }
   }

   $("#form_ubah_email").submit(function(e) {

      $.ajax({
         beforeSend: function() {
            $('#loading_ubah_email').show();
         },
         type: "POST",
         url: "<?php echo site_url('admin/ubah_email') ?>",
         data: {
            pendaftar_id: $('#pendaftar_id').val(),
            email_baru: $('#email_baru').val()
         },
         dataType: 'json',
         success: function(data) {
            $('#loading_ubah_email').hide();
            $('#alert_email_udah_digunakan').hide();

            if (data.msg == 'error') {
               $('#alert_email_udah_digunakan').show();
            } else {
               var nik = $('#ubah_email_nik').val();
               $('#modalUbahEmail').modal('hide');
               $('#email_baru').val('');
               $('#ubah_email_' + nik).text(data.email_baru);
               datatable.draw();
            }
            //alert(data); // show response from the php script.
         }
      });

      e.preventDefault(); // avoid to execute the actual submit of the form.
   });

   function show_ubah_email(nik) {
      event.preventDefault();
      $.get("<?php echo site_url('admin/ubah_email') ?>", {
            nik: nik
         })
         .done(function(data) {
            $('#ubah_email_nik').val(data.nik);
            $('#email_lama').val(data.email);
            $('#pendaftar_id').val(data.id);
            $('#modalUbahEmail').modal('show');
         })
   }

   function show_detail(nik) {
      //var nik = this.id;
      event.preventDefault();
      $.get("<?php echo site_url('admin/pendaftar_details') ?>", {
            nik: nik
         })
         .done(function(data) {
            $("#file_foto").attr("src", "<?php echo base_url() . 'uploads/foto/' ?>" + data.file_foto);
            $('#nik').val(data.nik);
            $('#nama_lengkap').val(data.nama_lengkap);
            $('#alamat_rumah').val(data.alamat_rumah);
            $('#jk').val(data.jk);
            $('#kota_lahir').val(data.kota_lahir);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#no_hp').val(data.no_hp);
            $('#email').val(data.email);
            $('#nama_lembaga').val(data.nama_lembaga);
            $('#program_studi').val(data.program_studi);
            $('#akreditasi').val(data.akreditasi);
            $('#semester').val(data.semester);
            $('#ip_semester').val(data.ip_semester);

            $('#myModal').modal('show');
         });
   };
</script>