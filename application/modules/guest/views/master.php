<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="robots" content="noindex, nofollow">
      <title>GUEST | Beasiswa</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link href="<?php echo site_url('assets/peserta/css/custom.css')?>" rel="stylesheet" id="bootstrap-css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

      <?php
        if(isset($css_files)){
          foreach($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
          <?php endforeach;
        }else{ ?>
          <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" >
      <?php }; ?>

      <?php
        if(isset($js_files)){
          foreach($js_files as $file): ?>
            <script src="<?php echo $file; ?>"></script>
          <?php endforeach;
        }else{ ?>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
          <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
          <!-- <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script> -->
      <?php }; ?>

      <!-- <script src="//code.jquery.com/jquery-1.10.2.min.js"></script> -->
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Cookies.js/0.3.1/cookies.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
      <script src="<?php echo site_url('assets/manage/js/base64.js')?>"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"></script>

      <style>
        a.ditolak{color:#ff111f;}
        a.diterima{color:#266927;}
        a { cursor: pointer; cursor: hand;}
      </style>
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
               Guest
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
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                     <?php echo strtoupper($this->session->userdata('user_username'))?>
                     <span class="caret"></span></a>
                     <ul class="dropdown-menu" role="menu">
                        <!-- <li class="dropdown-header">SETTINGS</li>
                        <li class=""><a href="#">Other Link</a></li>
                        <li class=""><a href="#">Other Link</a></li>
                        <li class=""><a href="#">Other Link</a></li>
                        <li class="divider"></li> -->
                        <li><a href="<?php echo site_url('guest/ganti-password')?>">Ganti Password</a></li>
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
                        <ul class="nav navbar-nav main-menu">
                           <li class="active"><a href="<?php echo site_url('guest/index')?>"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
                           <li><a href="<?php echo site_url('guest/kategori-beasiswa')?>"><span class="glyphicon glyphicon-list-alt"></span> Beasiswa</a></li>

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
                           </li>
                           <li><a href="#"><span class="glyphicon glyphicon-signal"></span> Link</a></li> -->
                        </ul>
                     </div>
                     <!-- /.navbar-collapse -->
                  </nav>
               </div>
            </div>
         </div>
         <div class="col-md-10 content">
           <?php echo $this->breadcrumbs->show();?>
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

          $(document).ready(function () {
            var index = Cookies.get('active');
            $('.main-menu').find('li').removeClass('active');
            $(".main-menu").find('li').eq(index).addClass('active');
            $('.main-menu').on('click', 'li', function (e) {
                // e.preventDefault();
                $('.main-menu').find('li').removeClass('active');
                $(this).addClass('active');
                Cookies.set('active', $('.main-menu li').index(this));
            });
          });

          //hack
          var level_penerima = $('#field-level_penerima').val();

          if(level_penerima === 'mahasiswa'){
            $('#kelas_field_box').hide();
            $('#akreditasi_field_box').show();
            $('#semester_field_box').show();
            $('#ip_minimal_field_box').show();
            $('#strict_ip_minimal_field_box').css('visibility','visible');
          }else if(level_penerima === 'pelajar'){
            $('#kelas_field_box').show();
            $('#akreditasi_field_box').hide();
            $('#semester_field_box').show();
            $('#ip_minimal_field_box').hide();
            $('#strict_ip_minimal_field_box').css('visibility','hidden');;
            // $('#field-strict_ip_minimal').css('visibility','hidden');
          }else{
            $('#kelas_field_box').hide();
            $('#akreditasi_field_box').hide();
            $('#semester_field_box').hide();
            $('#ip_minimal_field_box').hide();
            // $('#strict_ip_minimal_field_box').hide();
            $('#strict_ip_minimal_field_box').css('visibility','hidden');
            //alert(level_penerima);
          }


          $('#field-level_penerima').on('change', function() {
            // alert( this.value );
            var level = this.value;
            // $("#field-strict_ip_minimal").chosen();

            if(level === 'mahasiswa'){
              $('#kelas_field_box').hide();
              $('#akreditasi_field_box').show();
              $('#semester_field_box').show();
              $('#ip_minimal_field_box').show();
              // $('#field-strict_ip_minimal').css('visibility','visible');
              $('#strict_ip_minimal_field_box').css('visibility','visible');
            }else if(level === 'pelajar'){
              $('#kelas_field_box').show();
              $('#akreditasi_field_box').hide();
              $('#semester_field_box').show();
              $('#ip_minimal_field_box').hide();
              $('#strict_ip_minimal_field_box').css('visibility','hidden');
            }else{
              $('#kelas_field_box').hide();
              $('#akreditasi_field_box').hide();
              $('#semester_field_box').hide();
              $('#ip_minimal_field_box').hide();
              $('#strict_ip_minimal_field_box').css('visibility','hidden');
            }
          })

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
