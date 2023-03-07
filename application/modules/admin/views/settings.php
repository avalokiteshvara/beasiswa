<script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.7.0/adapters/jquery.js"></script>
<script>
  $(function(){
  	$( 'textarea.texteditor' ).ckeditor({toolbar:'Full'});
  	$( 'textarea.mini-texteditor' ).ckeditor({toolbar:'Basic',width:700});
  });
</script>

<!-- <legend>Web Settings</legend> -->

<div class="panel panel-default">
   <div class="panel-heading">
      <h3 class="panel-title">
         Form Settings
      </h3>
   </div>
   <div class="panel-body">
     <?php if($setting->num_rows() == 0){ ?>
        <div class="row"></div>
        <div class="alert alert-info">
           <strong>Data tidak ditemukan.</strong>
        </div>
        <?php }else{ ?>
        <table width="100%" class="table table-condensed">
           <thead>
              <tr>
                 <th style="text-align: left">Nama Setting</th>
                 <th style="text-align: left">Nilai</th>
                 <th style="text-align: left">Tampil</th>
              </tr>
           </thead>
           <tbody>
              <?php $nomor = 0;?>
              <?php foreach($setting->result() as $r){ ?>
              <tr>
                 <td><?php echo $r->title;?></td>
                 <td>
                 <?php if($r->tipe === 'big-text'){?>
                   <textarea id="<?php echo $r->title;?>" class="update_me texteditor" style="width: 100%;height: 100%"><?php echo $r->value;?></textarea>
                   <script>
                     CKEDITOR.on('instanceCreated', function (e) {
                       e.editor.on('change', function (event) {
                         var this_val = CKEDITOR.instances['<?php echo $r->title;?>'].getData();//Value of Editor
                         var this_title = '<?php echo $r->title;?>';

                         $.post( "<?php echo base_url() . 'admin/settings/edt-value/';?>" + this_title,
                           { value: this_val,csrf_test_name: Cookies.get('csrf_cookie_name') }
                         );
                       });
                     });

                   </script>
                 <?php }elseif($r->tipe === 'small-text'){ ?>
                   <input id="<?php echo $r->title;?>" class="update_me form-control" style="width: 100%;height: 100%" type="text" value="<?php echo $r->value;?>">

                 <?php } ?>
                 </td>
                 <td>
                  <?php
                      $option_setting = explode(';', $r->show);
                      $option_list = explode(',' , $option_setting[0]);
                      $option_selected = $option_setting[1];

                      echo '<select id="show_' . $r->title.'" name="'. $r->title .'" class="form-control">';

                      foreach ($option_list as $op) {
                        if($op === $option_selected){
                          echo '<option selected value="' . $op . '">' . $op .'</option>';
                        }else{
                          echo '<option value="' . $op . '">' . $op .'</option>';
                        }

                      }

                      echo '</select>';

                      ?>


                      <script>
                        $('#show_<?php echo $r->title;?>').on('change', function()
                        {
                          var this_title = $(this).attr('name');
                          var options = $('#show_<?php echo $r->title;?> option');
                          var values = $.map(options ,function(option) { return option.value; });
                          var this_val = values + ';' +  $(this).val();

                          $.post( "<?php echo base_url() . 'admin/settings/edt-show/';?>" + this_title,
                            { value: this_val,csrf_test_name: Cookies.get('csrf_cookie_name') }
                          );

                        })
                      </script>


                 </td>
              </tr>
              <?php $nomor++;} ?>
           </tbody>
        </table>
        <?php } ?>
   </div>
</div>

<script>
$('.update_me').keyup( function() {
  var this_title = $(this).attr('id');
  var this_val = $(this).val();

  $.post( "<?php echo base_url() . 'admin/settings/edt-value/';?>" + this_title,
    { value: this_val,csrf_test_name: Cookies.get('csrf_cookie_name') }
  );
});
</script>
