<style type="text/css">
  .password-strength-group .password-strength-meter {
    width: 100%;
    transition: height 0.3s;
    display: flex;
    justify-content: stretch;
  }

  .password-strength-group .password-strength-meter .meter-block {
    height: 4px;
    background: #ccc;
    margin-right: 6px;
    flex-grow: 1;
  }

  .password-strength-group .password-strength-meter .meter-block:last-child {
    margin: 0;
  }

  .password-strength-group .password-strength-message {
    font-weight: 20px;
    height: 1em;
    text-align: right;
    transition: all 0.5s;
    margin-top: 3px;
    position: relative;
  }

  .password-strength-group .password-strength-message .message-item {
    font-size: 12px;
    position: absolute;
    right: 0;
    opacity: 0;
    transition: opacity 0.2s;
  }

  .password-strength-group[data-strength="1"] .meter-block:nth-child(-n+1) {
    background: #cc3d04;
  }

  .password-strength-group[data-strength="1"] .message-item:nth-child(1) {
    opacity: 1;
  }

  .password-strength-group[data-strength="2"] .meter-block:nth-child(-n+2) {
    background: #ffc43b;
  }

  .password-strength-group[data-strength="2"] .message-item:nth-child(2) {
    opacity: 1;
  }

  .password-strength-group[data-strength="3"] .meter-block:nth-child(-n+3) {
    background: #9ea60a;
  }

  .password-strength-group[data-strength="3"] .message-item:nth-child(3) {
    opacity: 1;
  }

  .password-strength-group[data-strength="4"] .meter-block:nth-child(-n+4) {
    background: #289116;
  }

  .password-strength-group[data-strength="4"] .message-item:nth-child(4) {
    opacity: 1;
  }
</style>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title mt-2">
      Form Ganti Password
    </h3>
  </div>
  <div class="panel-body">

    <form class="row g-3" action="<?php echo site_url('admin/ganti-password') ?>" method="post" accept-charset="utf-8">

      <div class="col-12">
        <label for="pass_lama" class="form-label">Password Lama</label>
        <input type="password" class="form-control" placeholder="Password Lama" id="pass_lama" name="pass_lama" required>
      </div>

      <div class="col-12" id="div_pass_baru">
        <label for="pass_baru" class="form-label">Password Baru</label>
        <input type="password" class="form-control" placeholder="Password Baru" id="pass_baru" name="pass_baru" required>
        <div class="input-icon-right peek-password-button" data-peek-password="signupInputPassword">
          <span class="peek-password-icon icon-visibility"></span>
        </div>

        <div class="password-strength-group mt-2" data-strength="">

          <div id="password-strength-meter" class="password-strength-meter">
            <div class="meter-block"></div>
            <div class="meter-block"></div>
            <div class="meter-block"></div>
            <div class="meter-block"></div>
          </div>

          <div class="password-strength-message">
            <div class="message-item">
              Weak Password
            </div>

            <div class="message-item">
              Okay
            </div>

            <div class="message-item">
              Strong
            </div>

            <div class="message-item">
              Very Strong!
            </div>
          </div>

        </div>
      </div>

      <div class="col-12" id="div_pass_ulangi">
        <label for="pass_ulangi" class="form-label">Ulangi</label>
        <input type="password" class="form-control" placeholder="Ulangi Password" id="pass_ulangi" name="pass_ulangi" required>
      </div>

      <div class="text-left">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form><!-- Vertical Form -->
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

  function passwordCheck(password) {
    if (password.length >= 8)
      strength += 1;
    if (password.match(/(?=.*[0-9])/))
      strength += 1;
    if (password.match(/(?=.*[!,%,&,@,#,$,^,*,?,_,~,<,>,])/))
      strength += 1;
    if (password.match(/(?=.*[a-z])/))
      strength += 1;

    displayBar(strength);
  }

  function displayBar(strength) {
    $(".password-strength-group").attr('data-strength', strength);
  }

  $("#pass_baru").keyup(function() {
    strength = 0;
    var password = $(this).val();
    passwordCheck(password);
  });
</script>