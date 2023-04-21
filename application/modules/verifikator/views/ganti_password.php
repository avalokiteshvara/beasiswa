<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Form Ganti Password
    </h3>
  </div>
  <div class="card-body">
    
    <?php echo form_open('verifikator/ganti-password', ['class' => 'form-horizontal']); ?>
    <div class="form-group">
      <label for="pass_lama" class="col-form-label">Password Lama</label>
      <input type="password" class="form-control" placeholder="Password Lama" id="pass_lama" name="pass_lama" required>
      
    </div>

    <div class="form-group" id="div_pass_baru">
      <label for="pass_baru" class="col-form-label">Password Baru</label>
      <input type="password" class="form-control" placeholder="Password Baru" id="pass_baru" name="pass_baru" required>
    </div>

    <div class="form-group mb-2" id="div_pass_ulangi">
      <label for="pass_ulangi" class="col-form-label">Ulangi</label>
      <input type="password" class="form-control" placeholder="Ulangi Password" id="pass_ulangi" name="pass_ulangi" required>
    </div>

    <button type="submit" class="btn btn-primary mt-2">Submit</button>
    
    <?php echo form_close(); ?>
  </div>
</div>
<script>
  $('#div_pass_baru , #div_pass_ulangi').hide();

  $("#pass_lama").keyup(function() {
    if ($(this).val() != '') {
      $('#div_pass_baru , #div_pass_ulangi').show();
    } else {
      $('#div_pass_baru , #div_pass_ulangi').hide();
    }
  });
</script>