<div class="panel panel-default">
   <div class="panel-heading">
      <h3 class="panel-title">
         Form Ganti Password
      </h3>
   </div>
   <div class="panel-body">
     <!-- <?php if(isset($msg['content'])){ ?>
     <div id="alert-msg" class="<?php echo $msg['css_class']?>">
       <?php echo $msg['content']?>
     </div>
     <?php } ?> -->
     <!-- <form action="" method="post"> -->
     <?php echo form_open('peserta/ganti-password','');?>
       <div class="form-group">
         <label>Password Lama</label>
         <input type="password" class="form-control" placeholder="Password Lama" id="pass_lama" name="pass_lama" required>
         <!-- <span class="help-block">* Kosongkan jika tidak ingin merubah password</span> -->
       </div>

       <div class="form-group" id="div_pass_baru">
         <label>Password Baru</label>
         <input type="password" class="form-control" placeholder="Password Baru" id="pass_baru" name="pass_baru" required>
       </div>

       <div class="form-group" id="div_pass_ulangi">
         <label>Ulangi</label>
         <input type="password" class="form-control" placeholder="Ulangi Password" id="pass_ulangi" name="pass_ulangi" required>
       </div>

       <button type="submit" class="btn btn-default">Submit</button>
     <!-- </form> -->
     <?php echo form_close();?>
   </div>
</div>

<script>
    $('#div_pass_baru , #div_pass_ulangi').hide();

    $( "#pass_lama").keyup(function() {
      if($(this).val() != ''){
        $('#div_pass_baru , #div_pass_ulangi').show();
      }else{
        $('#div_pass_baru , #div_pass_ulangi').hide();
      }
    });
</script>
