<style>
   #modalUbahEmail .modal .modal-body {
      /*max-height: 520px;*/
      /*max-width: 900px;*/
      overflow-y: auto;
   }


   #modalUbahEmail .vertical-alignment-helper {
      display: table;
      height: 100%;
      width: 100%;
      pointer-events: none;
   }


   #modalUbahEmail .vertical-align-center {
      /* To center vertically */
      display: table-cell;
      vertical-align: middle;
      pointer-events: none;
   }


   #modalUbahEmail .modal-content {
      width: inherit;
      height: 100%;
      margin: 0 auto;
      pointer-events: all;
   }

   #modalDokumen .modal-dialog,
   #myModal .modal-dialog {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: calc(100% - 1rem);
      max-width: 80%;
   }

   #modalDokumen .modal-content,
   #myModal .modal-content {
      width: 80%;
      height: 100%;
      margin: auto;
      border-radius: 0;
   }

   #modalDokumen .modal .modal-body,
   #myModal .modal .modal-body {
      overflow-y: auto;
   }

   img.displayed {
      display: block;
      margin-left: auto;
      margin-right: auto;
   }

   div.dataTables_processing {
      z-index: 9999;
   }
</style>

<link href="https://cdn.datatables.net/fixedcolumns/3.2.2/css/fixedColumns.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

<div class="panel panel-default" id="panel_example">
   <div class="panel-heading">
      <?php echo $page_title ?>

      <div class="btn-group float-end mb-2">
         <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Export Data <span class="caret"></span>
         </button>
         <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo site_url('admin/export_data/' . base64url_encode('pdf/' . $this->uri->segment(3) . '/semua')) ?>">Semua pendaftar (*.pdf)</a></li>
            <li><a class="dropdown-item" href="<?php echo site_url('admin/export_data/' . base64url_encode('pdf/' . $this->uri->segment(3) . '/terpilih')) ?>">Pendaftar diterima (*.pdf)</a></li>
            <li>
               <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="<?php echo site_url('admin/export_data/' . base64url_encode('excel/' . $this->uri->segment(3) . '/semua')) ?>">Semua pendaftar (*.xls)</a></li>
            <li><a class="dropdown-item" href="<?php echo site_url('admin/export_data/' . base64url_encode('excel/' . $this->uri->segment(3) . '/terpilih')) ?>">Pendaftar diterima (*.xls)</a></li>
         </ul>
      </div>

      <!-- <select id="jenis_jurusan">
         <option value="">Semua jenis jurusan</option>
         <option value="eksakta">Eksakta</option>
         <option value="non_eksakta">Non eksakta</option>
      </select> -->

   </div>

   <div class="panel-body">



      <table id="example" class="display nowrap" cellspacing="0" width="100%">
         <thead>
            <tr>
               <!-- <th></th> -->
               <!-- <th>NIK</th> -->
               <th>Nama lengkap</th>
               <th>Kab / Kota</th>
               <th>Kecamatan</th>
               <th>Kelurahan</th>
               <th>Jenis kelamin</th>
               <th>Perguruan tinggi</th>
               <th>Jenis jurusan</th>
               <th>Program studi</th>
               <th>Akreditasi</th>
               <th>Semester</th>
               <th>IPK</th>
               <th>Sertifikat</th>
               <th>Dokumen</th>
               <th>Instrumen verifikasi</th>
               <th>Status</th>
               <th>Ubah email</th>
               <th>Ubah kategori</th>
               <th>Tgl daftar</th>
               <th>Aksi</th>
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

<div class="modal fade" id="modalUbahEmail" role="dialog">
   <div class="vertical-alignment-helper">
      <div class="modal-dialog vertical-align-center" style="width: 40%;  height: 30%; padding: 0; margin: 0;">
         <!-- Modal content-->
         <div class="modal-content" style="height: 40%; min-height: 40%;  border-radius: 0; ">

            <div class="modal-header">
               <h5 class="modal-title">Ubah Email</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
               <div class="alert alert-danger" id="alert_email_udah_digunakan" style="display:none">
                  <strong>Peringatan!</strong> <br />Email ini telah digunakan oleh pendaftar dengan ID yang berbeda.
               </div>
               <form method="post" id="form_ubah_email">
                  <input type="hidden" name="pendaftar_id" id="pendaftar_id" />
                  <input type="hidden" name="ubah_email_nik" id="ubah_email_nik" />
                  <div id="form-part" class="mb-2">
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

         </div>
      </div>
   </div>
</div>


<div class="modal fade" data-bs-keyboard="true" id="modalDokumen" aria-hidden="true">
   <div class="vertical-alignment-helper">
      <div class="modal-dialog vertical-align-center">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Dokumen</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalDokumenBody">
               {...}
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modalUbahDataDiri" tabindex="-1" aria-labelledby="modalUbahDataDiriLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
   <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="modalUbahDataDiriLabel">Biodata & Dokumen Peserta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col">
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                     <button class="nav-link active" id="nav-tab-biodata" data-bs-toggle="tab" data-bs-target="#tabBiodata" type="button" role="tab" aria-controls="tabBiodata" aria-selected="true">Biodata</button>
                     <button class="nav-link" id="nav-tab-dokumen" data-bs-toggle="tab" data-bs-target="#tabDokumen" type="button" role="tab" aria-controls="tabDokumen" aria-selected="false">Dokumen</button>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col">
                  <div class="tab-content" id="nav-tabContent">
                     <div class="tab-pane fade show active" id="tabBiodata" role="tabpanel" aria-labelledby="nav-tab-biodata">
                        {biodata}
                     </div>
                     <div class="tab-pane fade" id="tabDokumen" role="tabpanel" aria-labelledby="nav-tab-dokumen">
                        {dokumen}
                     </div>
                  </div>
               </div>
            </div>
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

   <?php $beasiswa = $this->db->get_where('kategori', array('slug' => $this->uri->segment(3)))->row_array(); ?>

   // function base64url_encode( data){
   //   var str = base64.encode(data);
   //   str = str.replace('+','-');
   //   str = str.replace('==','');
   //   str = str.replace('=','');

   //   return str.replace('/','_');
   // }



   // let select_val;

   let datatable = $('#example').dataTable({
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
         data: function(d){
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
            "data": "kab_kota" // 1
         },
         {
            "data": "kecamatan" // 2
         },
         {
            "data": "kelurahan" // 3
         },
         {
            "data": "jk" // 4
         },
         {
            "data": "nama_lembaga" //5
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
            "data": "bobot" //11
         },
         {
            "data": "dokumen"
         },
         {
            "data": "id"
         },
         {
            "data": "status"
         },
         {
            "data": "email"
         },
         {
            "data": "kategori_id"
         },
         {
            "data": "tgl_daftar"
         },
         {
            "data": "id"
         }
         // { "data": "ubah_email"},
         // { "data": "hapus"},
         //hidden
         // { "data": "nama_pendaftar" },
         // { "data": "email" },
      ],
      "columnDefs": [{
            //<a href="#" class="detail" id="1671070911900008" onclick="show_detail('1671070911900008')">BELA RONALDOE</a>
            "render": function(data, type, row) {
               // return '<a href="#" class="detail" id="' + row['nik'] + '" onclick="show_detail(\'' + row['nik'] + '\')">' + data + '</a>';
               if(row['status_penerima_sebelumnya'] > 0){
                  return '<a href="#" class="detail" id="' + row['nik'] + '" onclick="show_detail(\'' + row['nik'] + '\')">' + '<p class="strikethrough">' + data + '</p></a>';
               }else{
                  return '<a href="#" class="detail" id="' + row['nik'] + '" onclick="show_detail(\'' + row['nik'] + '\')">' +  data + '</a>';
               }
            },
            "targets": 0,
            "orderable": false
         },
         {
            "targets":1,
            "orderable": false
         },
         {
            "targets":2,
            "orderable": false
         },
         {
            "targets":3,
            "orderable": false
         },
         {
            "targets":4,
            "orderable": false
         },
         {
            "targets":5,
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
            "targets":7,
            "orderable": false
         },
         {
            "targets":8,
            "orderable": false
         },
         {
            "targets":9,
            "orderable": false
         },
         {
            "targets":10,
            "orderable": false
         },
         {
            "render": function(data, type, row) {
               if (data == 3) {
                  return '<span class="badge bg-warning text-dark">NASIONAL</span>';
               } else if (data == 4) {
                  return '<span class="badge bg-success text-white">INTERNASIONAL</span>';
               }else{
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
            "searchable": false,
            "orderable": false
         },
         {
            "render": function(data, type, row) {
               var pendaftar_id_base64 = (base64url_encode(row['id']));
               return '<a href="<?php echo site_url('admin/cetak_instrumen_verifikasi/') ?>' + pendaftar_id_base64 + '">[ Download ]</a><br />';;
            },
            "targets": 13,
            "orderable": false
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
            "targets": 14,
            "orderable": false
         },
         {
            "render": function(data, type, row) {
               return '<a href="#" class="ubah_email alert-info" id="ubah_email_' + row['nik'] + '" onclick="show_ubah_email(\'' + row['nik'] + '\')">' + data + '</a>';
            },
            "targets": 15,
            "orderable": false

         },
         {
            "render": function(data, type, row) {

               var select = '<select onchange="ubah_kategori(this,' + row['id'] + ',\'' + row['nik'] + '\')">';
               <?php
               $kat = $this->db->get('kategori');
               foreach ($kat->result_array() as $k) { ?>
                  select += "<option  <?php echo $beasiswa['id'] == $k['id'] ? 'selected' : '' ?> value='<?php echo $k['id'] ?>'><?php echo $k['nama'] ?></option>";
               <?php }
               ?>
               select += "</select>";

               return select;
            },
            "targets": 16,
            "orderable": false
         }, {
            "targets": 17,
            "searchable": false,
            "orderable": false
         },
         {
            "render": function(data, type, row) {
               return '<button type="button" class="btn btn-danger" onclick="hapus_pendaftaran(' + data + ')">HAPUS</button>&nbsp;<button type="button" class="btn btn-success" onclick="show_ubah_datadiri(' + data + ')">EDIT</button>';
            },
            "targets": 18,
            "orderable": false
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




   $('#example').on('processing.dt', function(e, settings, processing) {
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
   }).dataTable();

   function load_dokumen(pendaftar_id) {
      // alert(pendaftar_id);
      // event.preventDefault();
      $.get("<?php echo site_url('admin/load_dokumen') ?>", {
            pendaftar_id: pendaftar_id,
            slug: base64url_encode('<?php echo $this->uri->segment(3) ?>')
         })
         .done(function(data) {

            $('#modalDokumenBody').html(data);
            //var myModal = new bootstrap.Modal(document.getElementById("modalDokumen"), {});
            $('#modalDokumen').modal('show');
            //myModal.show();
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
               // datatable.api().draw();
               datatable.fnDraw(false);
            }
            //alert(data); // show response from the php script.
         }
      });

      e.preventDefault(); // avoid to execute the actual submit of the form.
   });

   function show_ubah_email(nik) {
      // event.preventDefault();
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


   /*show_ubah_datadiri*/
   function show_ubah_datadiri(pendaftar_id) {
      $.get("<?php echo site_url('admin/get_datadiri') ?>", {
            pendaftar_id: pendaftar_id
         })
         .done(function(data) {

            $('#tabBiodata').html(data.biodata);
            $('#tabDokumen').html(data.dokumen);
            $('#modalUbahDataDiri').modal('show');
         })
   }


   $('#modalUbahDataDiri').on('hidden.bs.modal', function() {
      //datatable.api().draw();      
      datatable.fnDraw(false);
   })

   function ubah_kategori(sel, pendaftar_id, nik) {


      var return_confirm = confirm('Apakah anda yakin ingin merubah kategori beasiswa peserta?');
      if (return_confirm) {
         $.ajax({
            url: "<?php echo site_url('admin/ubah_kategori') ?>",
            type: "post",
            data: {
               nik: nik,
               kategori_id: sel.value
            }
         }).done(function(msg) {
            $('#tr_' + pendaftar_id).fadeTo("slow", 0.7, function() {
               //$('#tr_' + pendaftar_id).remove();
               datatable.api().row($(this)).remove().draw(false);
            });
         });
      }
   }

   function show_detail(nik) {

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


   // });
</script>

<style>
   #jenis_jurusan {
      height: 30px;
   }
</style>