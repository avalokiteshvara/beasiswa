<div class="alert alert-danger" id="alert_dok_danger" style="display:none">
   <strong>Peringatan!</strong> <br />
   <div id="dok_msg_danger"></div>
</div>
<div class="alert alert-success" id="alert_dok_success" style="display:none">
   <strong>Info!</strong> <br />
   <div id="dok_msg_success"></div>
</div>


<table class="table">
   <thead>
      <tr>
         <td>NO</td>
         <td>Dokumen Persyaratan</td>
         <td>Unggah</td>
         <td>Verifikasi</td>
      </tr>
   </thead>
   <tbody>
      <?php
      $i = 1;
      foreach ($dokumen->result_array() as $jd) { ?>
         <?php if ($jd['user_file_dokumen'] === 'belum' & $jd['verifikasi'] === '-') { ?>
            <tr class="default" id="tr_<?php echo $jd['id']; ?>">
            <?php } elseif ($jd['user_file_dokumen'] !== 'belum' & $jd['verifikasi'] === 'belum') { ?>
            <tr class="warning" id="tr_<?php echo $jd['id']; ?>">
            <?php } else { ?>
            <tr class="success" id="tr_<?php echo $jd['id']; ?>">
            <?php } ?>
            <th scope="row"><?php echo $i ?></th>
            <td>
               <?php echo $jd['nama'] ?>
               <?php if ($jd['file_template'] !== 'none') { ?>
                  <br /><a href="<?php echo site_url('uploads/' . $jd['file_template']) ?>">Download template</a>
               <?php } ?>
            </td>
            <td>
               <?php if ($jd['user_file_dokumen'] === 'belum') { ?>
                  <span class="badge bg-secondary" id="span_belum_<?php echo $jd['id'] ?>"><span id="span_glyphicon_<?php echo $jd['id'] ?>" class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><label id="div_belum_<?php echo $jd['id']; ?>">&nbsp;BELUM</label></span> - <a href="<?php echo site_url('uploads/dokumen/' . $jd['user_file_dokumen']) ?>?random=<?php echo date("YmdHis") ?>" target="_blank" id="dok_link_<?php echo $jd['id'] ?>" style="display: none;">Lihat</a>


                  <form style="margin-top:10px" method="post" enctype="multipart/form-data">
                     <img src="<?php echo site_url('assets/manage/img/loading.gif') ?>" id="loading_dok_<?php echo $jd['id'] ?>" style="display:none">
                     <input class="file_dokumen" name="file_dokumen" type="file" id="dok_<?php echo $jd['id'] ?>" />

                  </form>

               <?php } else { ?>
                  <span class="badge bg-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;SUDAH</span> - <a href="<?php echo site_url('uploads/dokumen/' . $jd['user_file_dokumen']) ?>?random=<?php echo date("YmdHis") ?>" target="_blank" id="dok_link_<?php echo $jd['id'] ?>">Lihat</a>

                  <form style="margin-top:10px" method="post" enctype="multipart/form-data">
                     <img src="<?php echo site_url('assets/manage/img/loading.gif') ?>" id="loading_dok_<?php echo $jd['id'] ?>" style="display:none">
                     <input class="file_dokumen" name="file_dokumen" type="file" id="dok_<?php echo $jd['id'] ?>" />
                  </form>

               <?php } ?>
            </td>
            <td id="td_verifikasi_<?php echo $jd['id'] ?>">
               <?php if ($jd['verifikasi'] === 'ditolak') { ?>
                  <span class="badge bg-danger"><i class="bi bi-x-circle" aria-hidden="true"></i>&nbsp;DITOLAK</span>
               <?php } elseif ($jd['verifikasi'] === 'diterima') { ?>
                  <span class="badge bg-success"><i class="bi bi-check-lg" aria-hidden="true"></i>&nbsp;DITERIMA</span>
               <?php } elseif ($jd['verifikasi'] === 'pending') { ?>
                  <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split" aria-hidden="true"></i>&nbsp;MENUNGGU</span>
               <?php } else { ?>
                  -
               <?php } ?>
            </td>
            </tr>
         <?php $i++;
      } ?>
   </tbody>
</table>

<script type="text/javascript">
   $('.file_dokumen').on("change", function() {
      //dok_??
      var file_dok_id = (this.id).split('_');
      var jenis_dokumen_id = file_dok_id[1];

      var fd = new FormData();
      fd.append('user_id', <?php echo $user_id; ?>);
      fd.append('user_nik', <?php echo $user_nik; ?>)
      fd.append('file_dokumen', $("#dok_" + jenis_dokumen_id).prop("files")[0]);
      fd.append('jenis_dokumen_id', jenis_dokumen_id);

      $.ajax({
         beforeSend: function() {
            $('#loading_dok_' + jenis_dokumen_id).show();
         },
         type: "POST",
         url: "<?php echo site_url('admin/upload_dokumen') ?>",
         data: fd,
         dataType: 'json',
         processData: false,
         contentType: false,
         success: function(data) {
            $('#loading_dok_' + jenis_dokumen_id).hide();

            $('#alert_dok_danger').hide();
            $('#alert_dok_success').hide();

            if (data.status !== 'OK') {
               $('#alert_dok_danger').show();
               $('#dok_msg_danger').html(data.msg);
            } else {
               $('#alert_dok_success').show();
               $('#dok_msg_success').html(data.msg);

               if (data.dok_link !== 'none') {
                  $('#dok_link_' + jenis_dokumen_id).attr('href', data.dok_link);
                  $('#dok_link_' + jenis_dokumen_id).show();
                  $('#span_belum_' + jenis_dokumen_id).removeClass('label-default').addClass('label-success');
                  $('#span_glyphicon_' + jenis_dokumen_id).removeClass('glyphicon-exclamation-sign').addClass('glyphicon-ok');
                  $('#div_belum_' + jenis_dokumen_id).html('&nbsp;SUDAH');
                  $('#td_verifikasi_' + jenis_dokumen_id).html('<span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split" aria-hidden="true"></i>&nbsp;MENUNGGU</span>');
                  $('#tr_' + jenis_dokumen_id).removeClass().addClass('success');


                  //   $('#link_view_foto').attr('href',data.foto);
               }
            }
         }
      });

      e.preventDefault(); // avoid to execute the actual submit of the form.


   });
</script>