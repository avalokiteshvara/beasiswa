<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="robots" content="noindex, nofollow">
      <title>PESERTA | Beasiswa</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
      <link href="<?php echo site_url('assets/peserta/css/custom.css')?>" rel="stylesheet" id="bootstrap-css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
      <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
      <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

   </head>
   <body>
      <nav class="navbar navbar-default navbar-static-top">
         <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
               <button type="button" class="navbar-toggle navbar-toggle-sidebar collapsed">
               MENU
               </button>
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="#">
               <?php echo strtoupper('Peserta ' . $kat_beasiswa);?>
               </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <!-- <form class="navbar-form navbar-left" method="GET" role="search">
                  <div class="form-group">
                     <input type="text" name="q" class="form-control" placeholder="Search">
                  </div>
                  <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
               </form> -->
               <ul class="nav navbar-nav navbar-right">
                  <!-- <li><a href="http://www.pingpong-labs.com" target="_blank">Visit Site</a></li> -->
                  <li class="dropdown ">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color: #555">
                     <?php echo $this->session->userdata('user_nama_lengkap');?>
                     <span class="caret"></span></a>
                     <ul class="dropdown-menu" role="menu">
                        <!-- <li class="dropdown-header">SETTINGS</li> -->
                        <!-- <li class=""><a href="<?php echo site_url('peserta/ubah-password')?>">Ubah Password</a></li> -->
                        <!-- <li class=""><a href="#">Other Link</a></li>
                        <li class=""><a href="#">Other Link</a></li> -->
                        <!-- <li class="divider"></li> -->
                        <li><a href="<?php echo site_url('peserta/ganti-password')?>">Ganti Password</a></li>
                        <li><a href="<?php echo site_url('signout')?>">Logout</a></li>
                     </ul>
                  </li>
               </ul>
            </div>
            <!-- /.navbar-collapse -->
         </div>
         <!-- /.container-fluid -->
      </nav>
      <div class="container-fluid main-container">
         <div class="col-md-2 sidebar">
            <div class="row">
               <!-- uncomment code for absolute positioning tweek see top comment in css -->
               <div class="absolute-wrapper"> </div>
               <!-- Menu -->
               <div class="side-menu">
                  <nav class="navbar navbar-default" role="navigation">
                     <!-- Main Menu -->
                     <div class="side-menu-container">
                        <ul class="nav navbar-nav" style="float:none">
                           <li class="active"><a href="<?php echo site_url('peserta')?>"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
                           <li style="padding: 5px">
                              <form id="form-foto" action="<?php echo site_url('peserta/update_foto')?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                 <?php if(empty($biodata['file_foto'])){ ?>
                                 <img src="<?php echo site_url('uploads/foto/nofoto.jpg')?>" alt="No-Foto" height="200" width="200">
                                 <br />
                                 <?php }else{ ?>
                                 <a href="<?php echo site_url('uploads/foto/' . $biodata['file_foto'])?>" target="_blank">
                                   <img src="<?php echo site_url('uploads/foto/' . $biodata['file_foto'])?>" alt="File foto" height="200" width="200">
                                 </a>
                                 <br />
                                 <?php } ?>

                                 <!-- <label for="exampleInputFile">File foto</label> -->
                                 <input type="file" name="file_foto_sidebar" id="file_foto_sidebar">
                                 <p class="help-block">Max :512KB ; Format :jpg</p>
                               </div>
                              </form> 
                           </li>
                           <script type="text/javascript">                             
                              $('#file_foto_sidebar').change(function() {
                                $('#form-foto').submit();
                              });
                           </script>
                           
                           <style type="text/css">
                             .navbar-default .navbar-nav>li>a {
                                  color: #fff; 
                              }
                           </style>
                           
                           <?php if($status_lv1 === 'diterima'){ ?>
                           <li style="margin-top: 10px">
                            <a role="button" class="btn btn-info btn-lg btn-block"  href="<?php echo site_url('peserta/download-bukti-lulus-verifikasi')?>">Cetak Bukti Lolos Tahap I</a>
                            <!-- <a href="#link" class="btn btn-info" role="button">Link Button</a> -->
                           </li>
                           <?php } ?>

                           <?php if($status_lv2 === 'diterima'){ ?>
                           <li style="margin-top: 10px">
                            <a role="button" class="btn btn-success btn-lg btn-block" href="<?php echo site_url('peserta/download-bukti-lulus-tahap-akhir')?>">Cetak Bukti Lolos Tahap II</a>
                           </li>
                           <?php } ?>                           
                           
                           <!-- <li><a href="#"><span class="glyphicon glyphicon-plane"></span> Active Link</a></li> -->
                           <!-- <li><a href="#"><span class="glyphicon glyphicon-cloud"></span> Link</a></li> -->
                           <!-- Dropdown-->
                           <!-- <li class="panel panel-default" id="dropdown">
                              <a data-toggle="collapse" href="#dropdown-lvl1">
                              <span class="glyphicon glyphicon-user"></span> Sub Level <span class="caret"></span>
                              </a>

                              <div id="dropdown-lvl1" class="panel-collapse collapse">
                                 <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                       <li><a href="#">Link</a></li>
                                       <li><a href="#">Link</a></li>
                                       <li><a href="#">Link</a></li>

                                       <li class="panel panel-default" id="dropdown">
                                          <a data-toggle="collapse" href="#dropdown-lvl2">
                                          <span class="glyphicon glyphicon-off"></span> Sub Level <span class="caret"></span>
                                          </a>
                                          <div id="dropdown-lvl2" class="panel-collapse collapse">
                                             <div class="panel-body">
                                                <ul class="nav navbar-nav">
                                                   <li><a href="#">Link</a></li>
                                                   <li><a href="#">Link</a></li>
                                                   <li><a href="#">Link</a></li>
                                                </ul>
                                             </div>
                                          </div>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                              </li> -->
                           <!-- <li><a href="#"><span class="glyphicon glyphicon-signal"></span> Link</a></li> -->
                        </ul>
                     </div>
                     <!-- /.navbar-collapse -->
                  </nav>
               </div>
            </div>
         </div>
         <div class="col-md-10 content">            
            <?php if(isset($output)){ echo $output; }else{ include $page_name . ".php";} ?>
         </div>
         <footer class="pull-left footer">
            <p class="col-md-12">
            <hr class="divider">
            <!-- Copyright &COPY; 2015 <a href="http://www.pingpong-labs.com">Gravitano</a> -->
            </p>
         </footer>
      </div>
      <script type="text/javascript">

          var myLanguage = {
                requiredField : 'Input ini dibutuhkan',
                errorTitle: 'Form submission failed!',
                requiredFields: 'You have not answered all required fields',
                badTime: 'You have not given a correct time',
                badEmail: 'Alamat email tidak valid',
                badTelephone: 'You have not given a correct phone number',
                badSecurityAnswer: 'You have not given a correct answer to the security question',
                badDate: 'You have not given a correct date',
                lengthBadStart: 'The input value must be between ',
                lengthBadEnd: ' characters',
                lengthTooLongStart: 'The input value is longer than ',
                lengthTooShortStart: 'The input value is shorter than ',
                notConfirmed: 'Input values could not be confirmed',
                badDomain: 'Incorrect domain value',
                badUrl: 'The input value is not a correct URL',
                badCustomVal: 'The input value is incorrect',
                andSpaces: ' and spaces ',
                badInt: 'The input value was not a correct number',
                badSecurityNumber: 'Your social security number was incorrect',
                badUKVatAnswer: 'Incorrect UK VAT Number',
                badStrength: 'The password isn\'t strong enough',
                badNumberOfSelectedOptionsStart: 'You have to choose at least ',
                badNumberOfSelectedOptionsEnd: ' answers',
                badAlphaNumeric: 'The input value can only contain alphanumeric characters ',
                badAlphaNumericExtra: ' and ',
                wrongFileSize: 'The file you are trying to upload is too large (max %s)',
                wrongFileType: 'Only files of type %s is allowed',
                groupCheckedRangeStart: 'Please choose between ',
                groupCheckedTooFewStart: 'Please choose at least ',
                groupCheckedTooManyStart: 'Please choose a maximum of ',
                groupCheckedEnd: ' item(s)',
                badCreditCard: 'The credit card number is not correct',
                badCVV: 'The CVV number was not correct',
                wrongFileDim : 'Incorrect image dimensions,',
                imageTooTall : 'the image can not be taller than',
                imageTooWide : 'the image can not be wider than',
                imageTooSmall : 'the image was too small',
                min : 'min',
                max : 'max',
                imageRatioNotAccepted : 'Image ratio is not accepted'
          };

          $.validate({
              language : myLanguage,
              modules : 'date'
          });

         $(function () {
          	$('.navbar-toggle-sidebar').click(function () {
          		$('.navbar-nav').toggleClass('slide-in');
          		$('.side-body').toggleClass('body-slide-in');
          		$('#search').removeClass('in').addClass('collapse').slideUp(200);
          	});

          	$('#search-trigger').click(function () {
          		$('.navbar-nav').removeClass('slide-in');
          		$('.side-body').removeClass('body-slide-in');
          		$('.search-input').focus();
          	});
          });

          <?php if(has_alert()):
            foreach(has_alert() as $type => $message): ?>
            <?php if($type === 'alert-danger'){ ?>
              swal({
                  title: 'Ada kesalahan!',
                  text: '<?php echo $message; ?>',
                  type: 'error',
                  confirmButtonText: 'Ok'
              });
            <?php }else{ ?>
              swal({
                  title: 'Berhasil',
                  text: '<?php echo $message; ?>',
                  type: 'success',
                  confirmButtonText: 'Ok'
              });
           <?php } ?>
            <?php endforeach;
          endif; ?>
      </script>
   </body>
</html>
