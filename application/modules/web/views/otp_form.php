<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <meta http-equiv="X-UA-Compatible" content="ie=edge" />

   <title>CodePen - Bootstrap 5 verify OTP with validation form inputs</title>
   <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css'>

   <style>
      .height-100 {
         height: 100vh
      }

      .card {
         width: 400px;
         border: none;
         height: 300px;
         box-shadow: 0px 5px 20px 0px #d2dae3;
         z-index: 1;
         display: flex;
         justify-content: center;
         align-items: center
      }

      .card h6 {
         color: red;
         font-size: 20px
      }

      .inputs input {
         width: 40px;
         height: 40px
      }

      input[type=number]::-webkit-inner-spin-button,
      input[type=number]::-webkit-outer-spin-button {
         -webkit-appearance: none;
         -moz-appearance: none;
         appearance: none;
         margin: 0
      }

      .card-2 {
         background-color: #fff;
         padding: 10px;
         width: 350px;
         height: 100px;
         bottom: -50px;
         left: 20px;
         position: absolute;
         border-radius: 5px
      }

      .card-2 .content {
         margin-top: 50px
      }

      .card-2 .content a {
         color: red
      }

      .form-control:focus {
         box-shadow: none;
         border: 2px solid red
      }

      .validate {
         border-radius: 20px;
         height: 40px;
         background-color: red;
         border: 1px solid red;
         width: 140px
      }
   </style>
</head>

<body translate="no">
   <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
      <div class="position-relative">
         <div class="card p-2 text-center">
            <h6>Silahkan masukkan kode verifikasi</h6>
            <div><span>Kode telah dikirim ke email atau Whatsapp</span></div>
            <form action="<?php echo site_url('web/otp/' . $token) ?>" method="post" class="digit-group" data-group-name="digits" data-autosubmit="true" autocomplete="off">
               <input type="hidden" name="token" value="<?php echo $token; ?>" />
               <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                  <input class="m-2 text-center form-control rounded" type="text" id="first" maxlength="1" name="txt_1" data-next="second" />
                  <input class="m-2 text-center form-control rounded" type="text" id="second" maxlength="1" name="txt_2" data-next="third" data-previous="first" />
                  <input class="m-2 text-center form-control rounded" type="text" id="third" maxlength="1" name="txt_3" data-next="fourth" data-previous="second" />
                  <input class="m-2 text-center form-control rounded" type="text" id="fourth" maxlength="1" name="txt_4" data-next="fifth" data-previous="third" />
                  <input class="m-2 text-center form-control rounded" type="text" id="fifth" maxlength="1" name="txt_5" data-next="sixth" data-previous="fourth" />
                  <input class="m-2 text-center form-control rounded" type="text" id="sixth" maxlength="1" name="txt_6" data-previous="fifth" />
               </div>
            </form>
         </div>
      </div>
   </div>

   <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.min.js'></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script>
      $('.digit-group').find('input').each(function() {
         $(this).attr('maxlength', 1);
         $(this).on('keyup', function(e) {
            var parent = $($(this).parent().parent());

            if (e.keyCode === 8 || e.keyCode === 37) {
               var prev = parent.find('input#' + $(this).data('previous'));

               if (prev.length) {
                  $(prev).select();
               }
            } else if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
               var next = parent.find('input#' + $(this).data('next'));

               if (next.length) {
                  $(next).select();
               } else {
                  if (parent.data('autosubmit')) {
                     //parent.submit();
                     var isFilled = true;
                     parent.find('input').each(function() {
                        if ($(this).val() == '') {
                           isFilled = false;
                        }
                     });

                     if (isFilled) {
                        // semua input teks terisi, submit formulir
                        parent.submit();
                     } 
                  }
               }
            }
         });
      });
   </script>
</body>

</html>