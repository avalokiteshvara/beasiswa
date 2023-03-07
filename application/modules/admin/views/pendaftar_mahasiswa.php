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
            <li><a href="<?php echo site_url('admin/export_data/' . base64url_encode('pdf/' . $this->uri->segment(3) . '/semua'))?>">Semua pendaftar (*.pdf)</a></li>
            <li><a href="<?php echo site_url('admin/export_data/' . base64url_encode('pdf/' . $this->uri->segment(3) . '/terpilih'))?>">Pendaftar diterima (*.pdf)</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo site_url('admin/export_data/' . base64url_encode('excel/' . $this->uri->segment(3) . '/semua'))?>">Semua pendaftar (*.xls)</a></li>
            <li><a href="<?php echo site_url('admin/export_data/' . base64url_encode('excel/' . $this->uri->segment(3) . '/terpilih'))?>">Pendaftar diterima (*.xls)</a></li>
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
               <th>Nama Lengkap</th>
               <th>Kab / Kota</th>
               <!-- <th>Alamat</th> -->
               <th>Jenis Kelamin</th>
               <th>Perguruan Tinggi</th>
               <th>Program Studi</th>
               <th>Akreditasi</th>
               <th>Semester</th>
               <th>IP Semester</th>
               <th>Dokumen</th>
               <th>Status</th>
               <th>Ubah Email</th>
               <th>Hapus</th>
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
               <td><?php echo $p['akreditasi']?></td>
               <td><?php echo 'Semester ' . $p['semester']?></td>
               <td><?php echo $p['ip_semester']?></td>
               <td>

                  <?php
                     if(!empty($p['dokumen'])){

                      //  echo '<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapse' . $p['id'] .'" aria-expanded="false" aria-controls="collapse' . $p['id'] .'">Detail</a>';
                       echo '<table>';

                       $dokumen_list = explode(';',$p['dokumen']);

                       $count_doc = count(array_filter($dokumen_list, 'strlen'));
                       if($count_doc > 0){

                         $dokumen_uploaded = array();

                         foreach ($dokumen_list as $dok) {
                           $dokumen = explode('|',$dok);
                          //1|-kartu-tanda-penduduk.jpg|pending;
                           echo '<tr>';
                           $dokumen_uploaded[] = $dokumen[0];

                           echo '<td>';
                           echo jenis_dokumen($dokumen[0]). '&nbsp:&nbsp';
                           echo '</td>';

                           echo '<td>';
                           echo '<a href="' . site_url('uploads/dokumen/' . $p['nik'] . $dokumen[1]) . '">Download</a>&nbsp;';
                           echo '</td>';

                           echo '<td>';
                           if($dokumen[2] === 'pending'){
                             echo '<span class="label label-default">Belum verifikasi</span>';
                           }elseif($dokumen[2] === 'diterima'){
                             echo '<span class="label label-success">Diterima</span>';
                           }else{
                             echo '<span class="label label-danger">Ditolak</span>';
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
                             echo '<span class="label label-warning">Belum diunggah</span>';
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

               <td id="td_<?php echo $p['id']?>">
                  <?php if($p['status'] === 'pending'){ ?>

                  <img src="<?php echo site_url('assets/manage/img/loading.gif')?>" id="loading_<?php echo $p['id']?>" style="display:none">
                  <a class="diterima" onclick="set_status_pendaftaran(<?php echo $p['id']?>,'diterima')">TERIMA</a> |
                  <a class="ditolak" onclick="set_status_pendaftaran(<?php echo $p['id']?>,'ditolak')">TOLAK</a>

                  <?php }elseif ($p['status'] === 'diterima') { ?>
                  <span class="label label-success">Diterima</span> - <a href="<?php echo site_url('admin/cetak_bukti_pendaftaran/' . base64url_encode($p['id']))?>">[ Download Bukti ]</a>
                  <?php }else{ ?>
                  <span class="label label-danger">Ditolak</span>
                  <?php } ?>
               </td>
               <td>
                 <?php
                 if(!empty($p['dokumen'])){ ?>
                   -
                 <?php }else{ ?>
                   <a href="#" class="ubah_email alert-info" id="ubah_email_<?php echo $p['nik']?>" onclick="show_ubah_email('<?php echo $p['nik']?>')"><?php echo $p['email']?></a>
                 <?php } ?>
               </td>
               <td>
                 <a class="alert alert-danger" onclick="hapus_pendaftaran(<?php echo $p['id']?>)">HAPUS</a>
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
                                 <label for="ip_semester">Index Prestasi (IP) Semester</label>
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

<div class="modal fade" id="modalUbahEmail" role="dialog">
   <div class="vertical-alignment-helper">
      <div class="vertical-align-center" style="width: 40%;  height: 30%; padding: 0; margin: 0;">
         <!-- Modal content-->
         <div class="modal-content" style="height: 40%; min-height: 40%;  height: auto; border-radius: 0; ">
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
                    &nbsp;&nbsp;<img src="<?php echo site_url('assets/manage/img/loading.gif')?>" id="loading_ubah_email" style="display:none">
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

<script>

     var datatable = $('#example').DataTable({
         "scrollX": true,
         fixedColumns : {
           leftColumns: 1
         }
     });

     $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );

    function hapus_pendaftaran(id_dokumen_pendaftar){
      var return_confirm = confirm('Apakah anda yakin ingin menghapus pendaftaran peserta?');
      if(return_confirm){
        $.ajax({
          url: "<?php echo site_url('admin/hapus_pendaftaran/')?>" + id_dokumen_pendaftar
        }).done(function( msg ) {
          $('#tr_' + id_dokumen_pendaftar).fadeTo("slow",0.7, function(){
              //$('#tr_' + id_dokumen_pendaftar).remove();
              datatable.row($(this)).remove().draw(false);
          });
        });
      }
    }

    function set_status_pendaftaran(id_dokumen_pendaftar,status) {

      if(status == 'diterima'){
         var return_confirm = confirm('Apakah anda yakin ingin menerima peserta ini?');
         if(return_confirm){
           $.ajax({
             beforeSend:function() {
               $('#loading_' + id_dokumen_pendaftar).show();
             },
             url: "<?php echo site_url('admin/set_status_pendaftaran/diterima/')?>" + id_dokumen_pendaftar
           }).done(function( msg ) {
             $('#td_' + id_dokumen_pendaftar).html(msg);
             datatable.draw();
           });
         }

      }else{
         var return_confirm = confirm('Apakah anda yakin ingin menolak berkas ini?');
         if(return_confirm){
           $.ajax({
             url: "<?php echo site_url('admin/set_status_pendaftaran/ditolak/')?>" + id_dokumen_pendaftar
           }).done(function( msg ) {
             $('#td_' + id_dokumen_pendaftar).html(msg);
           });
         }
      }
    }

    // $(".detail").on('click', function() {
    //   var nik = this.id;
    //   $.get( "<?php echo site_url('admin/pendaftar_details')?>", { nik: nik } )
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

    $("#form_ubah_email").submit(function(e) {

        $.ajax({
           beforeSend:function() {
            $('#loading_ubah_email').show();
           },
           type: "POST",
           url: "<?php echo site_url('admin/ubah_email')?>",
           data: { pendaftar_id : $('#pendaftar_id').val(),
                   email_baru : $('#email_baru').val() },
           dataType: 'json',
           success: function(data)
           {
             $('#loading_ubah_email').hide();
             $('#alert_email_udah_digunakan').hide();

             if(data.msg == 'error'){
               $('#alert_email_udah_digunakan').show();
             }else{
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

    function show_ubah_email(nik){
      event.preventDefault();
      $.get("<?php echo site_url('admin/ubah_email')?>",{ nik:nik })
      .done( function( data ){
        $('#ubah_email_nik').val(data.nik);
        $('#email_lama').val(data.email);
        $('#pendaftar_id').val(data.id);
        $('#modalUbahEmail').modal('show');
      })
    }

    function show_detail(nik) {
      //var nik = this.id;
      event.preventDefault();
      $.get( "<?php echo site_url('admin/pendaftar_details')?>", { nik: nik } )
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
