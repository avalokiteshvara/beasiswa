<style>
   .modal-dialog { width: 60%;  height: 60%; padding: 0; margin: 0; }
   .modal-content { height: 100%; min-height: 100%;  height: auto; border-radius: 0; }
   .modal .modal-body { /*max-height: 520px;*/ /*max-width: 900px;*/ overflow-y: auto; }
   .vertical-alignment-helper { display:table; height: 100%; width: 100%; pointer-events:none;   }
   .vertical-align-center { /* To center vertically */ display: table-cell; vertical-align: middle; pointer-events:none;  }
   .modal-content { width:inherit; height:inherit; margin: 0 auto; pointer-events:all; }
   img.displayed { display: block; margin-left: auto; margin-right: auto }
</style>

<link href="https://cdn.datatables.net/fixedcolumns/3.2.2/css/fixedColumns.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>
<div class="panel panel-default">
   <div class="panel-heading">
      <?php echo $page_title?>
      <!-- Single button -->
      <div class="btn-group pull-right">
         <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Export Data<span class="caret"></span>
         </button>
         <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('guest/export_data/' . base64url_encode('pdf/' . $this->uri->segment(3) . '/semua'))?>">Semua pendaftar (*.pdf)</a></li>
            <li><a href="<?php echo site_url('guest/export_data/' . base64url_encode('pdf/' . $this->uri->segment(3) . '/terpilih'))?>">Pendaftar diterima (*.pdf)</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo site_url('guest/export_data/' . base64url_encode('excel/' . $this->uri->segment(3) . '/semua'))?>">Semua pendaftar (*.xls)</a></li>
            <li><a href="<?php echo site_url('guest/export_data/' . base64url_encode('excel/' . $this->uri->segment(3) . '/terpilih'))?>">Pendaftar diterima (*.xls)</a></li>
            <!-- <li><a href="#">Something else here</a></li> -->
            <!-- <li role="separator" class="divider"></li>
               <li><a href="#">Separated link</a></li> -->
         </ul>
      </div>
   </div>
   <div class="panel-body">
      <table id="example" class="display nowrap" cellspacing="0" width="100%">
         <thead>
            <tr>
               <!-- <th>NIK</th> -->
               <th>Nama Lengkap</th>
               <th>Kab / Kota</th>
               <!-- <th>Alamat</th> -->
               <th>Jenis Kelamin</th>
               <th>Perguruan Tinggi</th>
               <th>Program Studi</th>
               <th>Semester</th>
               <th>IPK</th>
               <th>Dokumen</th>


            </tr>
         </thead>
         <tbody>
            <?php
            $set_jenis_dokumen = explode(',',$set_jenis_dokumen);
            foreach ($pendaftar->result_array() as $p) { ?>
            <tr id="tr_<?php echo $p['id']?>">
               <!-- <td><?php echo $p['nik']?></td> -->
               <td><a href="#" class="detail" id="<?php echo $p['nik']?>" onclick="show_detail('<?php echo $p['nik']?>')"><?php echo strtoupper($p['nama_lengkap'])?></a></td>
               <td><?php echo $p['kab_kota']?></td>
               <!-- <td><?php echo $p['alamat_rumah']?></td> -->
               <td><?php echo $p['jk']?></td>
               <td><?php echo $p['nama_lembaga']?></td>
               <td><?php echo $p['program_studi']?></td>
               <td><?php echo 'Semester ' . $p['semester']?></td>
               <td><?php echo $p['ip_semester']?></td>
               <td>
                  <?php
                     if(!empty($p['dokumen'])){

                       echo '<table>';


                       $dokumen_list = explode(';',$p['dokumen']);

                       $count_doc = count(array_filter($dokumen_list, 'strlen'));
                       if($count_doc > 0){

                         $dokumen_uploaded = array();

                         foreach ($dokumen_list as $dok) {
                           $dokumen = explode('|',$dok);
                          //  print_r($dokumen);
                           echo '<tr>';
                           $dokumen_uploaded[] = $dokumen[3];

                           echo '<td>';
                           echo $dokumen[0]. '&nbsp:&nbsp';
                           echo '</td>';

                           echo '<td>';
                           echo '<a href="' . site_url('uploads/dokumen/' . $dokumen[1]) . '">Download</a>&nbsp;';
                           echo '</td>';

                           echo '<td>';
                           if($dokumen[2] === 'pending'){
                             echo '<span class="badge bg-secondary">Belum verifikasi</span>';
                           }elseif($dokumen[2] === 'diterima'){
                             echo '<span class="badge bg-success">Diterima</span>';
                           }else{
                             echo '<span class="badge bg-danger">Ditolak</span>';
                           }
                           echo '</td>';
                           //echo ' [ ' . $dokumen[2] . ' diverifikasi] ';
                           echo '</tr>';
                         }
                         //cari yang belum diupload

                         $dokumen_diff = array_diff($set_jenis_dokumen,$dokumen_uploaded);

                         $count_diff = count(array_filter($dokumen_diff, 'strlen'));
                         if($count_diff > 0){
                           //print_r($dokumen_diff);
                           $this->db->where_in('id',$dokumen_diff);
                           $not_yet_uploaded = $this->db->get('jenis_dokumen');
                           foreach ($not_yet_uploaded->result_array() as $nyu) {
                             echo '<tr>';

                             echo ' <td>';
                             echo $nyu['nama']. '&nbsp:&nbsp';
                             echo ' </td>';

                             echo '<td colspan="2">';
                             echo '<span class="badge bg-warning text-dark">Belum diunggah</span>';
                             echo '</td>';

                             echo '</tr>';
                           }
                         }

                       }
                       echo '</table>';
                     }else{
                       echo 'Belum ada dokumen yang diunggah';
                     }
                     ?>
               </td>
               

            </tr>
            <?php } ?>
         </tbody>
      </table>
   </div>
</div>
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
   <div class="vertical-alignment-helper">
      <div class="modal-dialog vertical-align-center">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Detail Data Diri</h4>
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
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
</div>
<script>

     var datatable = $('#example').DataTable({
         "scrollX": true,
         fixedColumns : {
           leftColumns: 1
         }
     });

    function hapus_pendaftaran(id_dokumen_pendaftar){
      var return_confirm = confirm('Apakah anda yakin ingin menghapus pendaftaran peserta?');
      if(return_confirm){
        $.ajax({
          url: "<?php echo site_url('guest/hapus_pendaftaran/')?>" + id_dokumen_pendaftar
        }).done(function( msg ) {

          $('#tr_' + id_dokumen_pendaftar).fadeTo("slow",0.7, function(){
              //$('#tr_' + id_dokumen_pendaftar).remove();
              datatable.row($(this)).remove().draw(false);
          });

          //datatable.draw();

        });
      }
    }

    function set_status_pendaftaran(id_dokumen_pendaftar,status) {
      //diterima,ditolak

      if(status == 'diterima'){
         var return_confirm = confirm('Apakah anda yakin ingin menerima peserta ini?');
         if(return_confirm){
           $.ajax({
             beforeSend:function() {
               $('#loading_' + id_dokumen_pendaftar).show();
             },
             url: "<?php echo site_url('guest/set_status_pendaftaran/diterima/')?>" + id_dokumen_pendaftar
           }).done(function( msg ) {
             $('#td_' + id_dokumen_pendaftar).html(msg);
             datatable.draw();
           });
         }

      }else{
         var return_confirm = confirm('Apakah anda yakin ingin menolak berkas ini?');
         if(return_confirm){
           $.ajax({
             url: "<?php echo site_url('guest/set_status_pendaftaran/ditolak/')?>" + id_dokumen_pendaftar
           }).done(function( msg ) {
             $('#td_' + id_dokumen_pendaftar).html(msg);
           });
         }
      }
    }

    // $(".detail").on('click', function() {
    //   var nik = this.id;
    //   $.get( "<?php echo site_url('guest/pendaftar_details')?>", { nik: nik } )
    //    .done(function( data ) {
    //      $("#file_foto").attr("src","<?php echo base_url() . 'uploads/foto/'?>" + data.file_foto);
    //      $('#nik').val(data.nik);
    //      $('#nama_lengkap').val(data.nama_lengkap);
    //      $('#alamat_rumah').val(data.alamat_rumah);
    //      $('#jk').val(data.jk);
    //      $('#kota_lahir').val(data.kota_lahir);
    //      $('#tgl_lahir').val(data.tgl_lahir);
    //      $('#no_hp').val(data.no_hp);
    //      $('#email').val(data.email);
    //      $('#nama_lembaga').val(data.nama_lembaga);
    //      $('#program_studi').val(data.program_studi);
    //      $('#akreditasi').val(data.akreditasi);
    //      $('#semester').val(data.semester);
    //      $('#ip_semester').val(data.ip_semester);
    //
    //      $('#myModal').modal('show');
    //    });
    // });

    function show_detail(nik) {
      //var nik = this.id;
      event.preventDefault();
      $.get( "<?php echo site_url('guest/pendaftar_details')?>", { nik: nik } )
       .done(function( data ) {
         $("#file_foto").attr("src","<?php echo base_url() . 'uploads/foto/'?>" + data.file_foto);
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
