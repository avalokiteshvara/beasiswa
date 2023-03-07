<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- <link rel="stylesheet" href="css/demo.css" type="text/css"> -->
      <style type="text/css">
         /* style untuk link popup */
         a.popup-link {
         padding:17px 0;
         text-align: center;
         margin:10% auto;
         position: relative;
         width: 300px;
         color: #fff;
         text-decoration: none;
         background-color: #FFBA00;
         border-radius: 3px;
         box-shadow: 0 5px 0px 0px #eea900;
         display: block;
         }
         a.popup-link:hover {
         background-color: #ff9900;
         box-shadow: 0 3px 0px 0px #eea900;
         -webkit-transition:all 1s;
         transition:all 1s;
         }
         /* end link popup*/
         /* animasi popup */
         @-webkit-keyframes autopopup {
         from {opacity: 0;margin-top:-200px;}
         to {opacity: 1;}
         }
         @-moz-keyframes autopopup {
         from {opacity: 0;margin-top:-200px;}
         to {opacity: 1;}
         }
         @keyframes autopopup {
         from {opacity: 0;margin-top:-200px;}
         to {opacity: 1;}
         }
         /* end animasi popup */
         /*style untuk popup */
         #popup {
         background-color: rgba(0,0,0,0.8);
         position: fixed;
         top:0;
         left:0;
         right:0;
         bottom:0;
         margin:0;
         -webkit-animation:autopopup 2s;
         -moz-animation:autopopup 2s;
         animation:autopopup 2s;
         }
         #popup:target {
         -webkit-transition:all 1s;
         -moz-transition:all 1s;
         transition:all 1s;
         opacity: 0;
         visibility: hidden;
         }
         @media (min-width: 768px){
         .popup-container {
         width:600px;
         }
         }
         @media (max-width: 767px){
         .popup-container {
         width:100%;
         }
         }
         .popup-container {
         position: relative;
         margin:7% auto;
         padding:30px 50px;
         background-color: #fafafa;
         color:#333;
         border-radius: 3px;
         }
         a.popup-close {
         position: absolute;
         top:3px;
         right:3px;
         background-color: #333;
         padding:7px 10px;
         font-size: 20px;
         text-decoration: none;
         line-height: 1;
         color:#fff;
         }
         /* end style popup */
         /* style untuk isi popup */
         .popup-form {
         margin:10px auto;
         }
         .popup-form h2 {
         margin-bottom: 5px;
         font-size: 37px;
         text-transform: uppercase;
         }
         .popup-form .input-group {
         margin:10px auto;
         }
         .popup-form .input-group input {
         padding:17px;
         text-align: center;
         margin-bottom: 10px;
         border-radius:3px;
         font-size: 16px;
         display: block;
         width: 100%;
         }
         .popup-form .input-group input:focus {
         outline-color:#FB8833;
         }
         .popup-form .input-group input[type="email"] {
         border:0px;
         position: relative;
         }
         .popup-form .input-group input[type="submit"] {
         background-color: #FB8833;
         color: #fff;
         border: 0;
         cursor: pointer;
         }
         .popup-form .input-group input[type="submit"]:focus {
         box-shadow: inset 0 3px 7px 3px #ea7722;
         }
         /* end style isi popup */
      </style>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <meta name="description" content="Sistem Bantuan Beasiswa Pemerintah Provinsi Jambi">
      <meta name="keyword" content="Sistem Beasiswa Pemerintah Provinsi Jambi">
      <meta name="author" content="Dinas Pendidikan Provinsi Jambi">
      <title>Sistem Bantuan Beasiswa Provinsi Jambi</title>
      <!-- Bootstrap Core CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/css/bootstrap.min.css" />
      <!-- <link href="<?php echo site_url('assets/web/css/bootstrap-nav-wizard.min.css');?>" rel="stylesheet" type="text/css"> -->
      <!-- Custom CSS -->
      <link href="<?php echo site_url('assets/web/css/grayscale.css')?>" rel="stylesheet">
      <link rel="shortcut icon" href="<?php echo site_url('assets/web/img/favicon.ico')?>" type="image/x-icon">
      <link rel="icon" href="<?php echo site_url('assets/web/img/favicon.ico');?>" type="image/x-icon">
      <!-- Custom Fonts -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" />
      <link href="<?php echo site_url('assets/web/css/lora.css');?>" rel="stylesheet" type="text/css">
      <link href="<?php echo site_url('assets/web/css/montserrat.css');?>" rel="stylesheet" type="text/css">
      <!-- sweet alert -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script> -->
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
      <script type="text/javascript" src="https://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
      <script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit&hl=id" async defer></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
      <script src="<?php echo site_url('assets/web/js/grayscale.js');?>"></script>
      <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script> -->
      <style type="text/css">
         div.text-container { margin: 0 auto; width: 75%; }
         .hideContent { overflow: hidden; line-height: 1em; height: 2em; }
         .showContent { line-height: 1em; height: auto; }
         .showContent { height: auto; }
         h1 { font-size: 24px; }
         p { padding: 0px 0; }
         .show-more { padding: 10px 0; text-align: center; }
         .collapsed {height:50px; overflow:hidden}
         #daftar-berita{ background-color: #f4f4f4; padding-bottom: 10px; }
         #daftar-berita h4{ color:#111; }
         #daftar-berita .container{ padding: 10px 10px 10px 10px; }
         #rundown{ background-color: #f4f4f4; padding-bottom: 10px; }
         #rundown h4{ color:#111; }
         #rundown .container{ padding: 10px 10px 10px 10px; }
         #rundown .container .content{color:#111}
         #juknis{ background-color: #f4f4f4; padding-bottom: 10px; }
         #juknis h4{ color:#111; }
         #juknis .container{ padding: 10px 10px 10px 10px; }
         #juknis .container .content{color:#111}
         #faq-menu{ background-color: #f4f4f4; padding-bottom: 10px; }
         #faq-menu h4{ color:#111; }
         #faq-menu .container{ padding: 10px 10px 10px 10px; }
         #faq-menu .container .content{color:#111}
         /*#login-dp{ min-width: 250px; padding: 14px 14px 0;  overflow:hidden; background-color:#2a6496; }
         #login-dp .help-block{ font-size:12px }
         #login-dp .bottom{ background-color:rgba(255,255,255,.8); border-top:1px solid #ddd; clear:both; padding:14px; }
         #login-dp .social-buttons{  margin:12px 0 }
         #login-dp .social-buttons a{  width: 49%; }
         #login-dp .form-group { margin-bottom: 10px; }*/
         /*.modal .modal-dialog { width: 330px; }*/
         /*.modal { position: fixed;  top: 3%; right: 3%;  left: 3%;  width: auto;  margin: 0;  }
         .modal-body {  height: 60%; }
         .modal-body {  max-height: 350px;   padding: 15px;  overflow-y: auto;  -webkit-overflow-scrolling: touch;  }*/
         .modal {
         text-align: center;
         padding: 0!important;
         }
         .modal:before {
         content: '';
         display: inline-block;
         height: 100%;
         vertical-align: middle;
         margin-right: -4px;
         }
         .modal-dialog {
         display: inline-block;
         text-align: left;
         vertical-align: middle;
         }
         /*@media(max-width:768px){
         #login-dp{
         background-color: inherit;
         color: #fff;
         }
         #login-dp .bottom{
         background-color: inherit;
         border-top:0 none;
         }
         }*/
         // Extra small (<480px)
         @media(max-width: $screen-xs-max){
         .g-recaptcha iframe {
         max-width: 100%;
         transform:scale(0.77);
         -webkit-transform:scale(0.77);
         transform-origin: center center;
         -webkit-transform-origin: center center;
         }
         #rc-imageselect {
         transform:scale(0.77);
         -webkit-transform:scale(0.77);
         transform-origin:0 0;
         -webkit-transform-origin:0 0;
         }
         }
         // Medium small (>=480px)
         @media(min-width: $screen-ms-min){
         #rc-imageselect {
         transform: none;
         -webkit-transform: none;
         }
         .g-recaptcha iframe {
         max-width: none;
         transform: none;
         -webkit-transform: none;
         }
         }
         // Horizontally center the recaptcha - applied to all widths
         .g-recaptcha > div > div{
         margin: 4px auto !important;
         text-align: center;
         width: auto !important;
         height: auto !important;
         }
      </style>
      <!-- Smartsupp Live Chat script -->
      <script type="text/javascript">
         var _smartsupp = _smartsupp || {};
         _smartsupp.key = 'c4480d158f5400eaee184333600551ce695f6920';
         window.smartsupp||(function(d) {
         	var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
         	s=d.getElementsByTagName('script')[0];c=d.createElement('script');
         	c.type='text/javascript';c.charset='utf-8';c.async=true;
         	c.src='//www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
         })(document);
      </script>
   </head>
   <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
     <div class="container-fluid">

     </div>

      <!-- Navigation -->
      <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="padding-top:5px">

         <div class="container-fluid">
           <?php if(get_settings('show','frontpage_marquee') === 'YA'){ ?>
           <marquee bgcolor="black" style="font-family:calibri; font-size:20px; color:#ffffff;"><strong><?php echo get_settings('value','frontpage_marquee');?></strong></marquee>
           <?php } ?>
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
               <i class="fa fa-bars"></i>
               </button>
               <a class="navbar-brand page-scroll" href="#page-top">
               <i class="fa fa-play-circle"></i>  <span class="light">Sistem Beasiswa</span> Provinsi Jambi 2017
               </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
               <ul class="nav navbar-nav">
                  <li class="hidden">
                     <a href="#page-top"></a>
                  </li>
                 
                  <li>
                     <a class="page-scroll" href="#daftar-beasiswa">Daftar Beasiswa</a>
                  </li>
                   <li>
                     <a class="page-scroll animated infinite flash" href="#" data-toggle="modal" data-target="#lolos_tahap_1">Lolos Tahap 1</a>
                  </li>
                  <li>
                     <a class="page-scroll" href="#juknis">Juknis</a>
                  </li>
                  <li>
                     <a class="page-scroll" href="#rundown">Rundown</a>
                  </li>
                  <li>
                     <a class="page-scroll" href="#daftar-berita">Alur</a>
                  </li>
                  <li>
                     <a class="page-scroll" href="#faq-menu">FAQ</a>
                  </li>
                  <li>
                     <a class="page-scroll" href="#contact">Informasi</a>
                  </li>
               </ul>
               <!-- <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
                     <ul id="login-dp" class="dropdown-menu">
                        <li>
                           <div class="row">
                              <div class="col-md-12">
                                 <form class="form" role="form" method="post" action="" accept-charset="UTF-8" id="login-form">
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputEmail2">NIK</label>
                                       <input type="text" name="nik" class="form-control" id="exampleInputEmail2" placeholder="NIK" required>
                                    </div>
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputPassword2">Password</label>
                                       <input type="password" name="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                                       <br />
                                       <?php echo $this->recaptcha->render() ?>
                                       <div class="help-block text-right"><a href="#" onclick="$('#login-form').hide();$('#reset-form').show()">Lupa password ?</a></div>
                                    </div>

                                    <div class="form-group">
                                       <button type="submit" class="btn btn-primary btn-block"  name="submit" value="login">Login</button>
                                    </div>
                                 </form>

                                 <form class="form" role="form" method="post" action="" accept-charset="UTF-8" id="reset-form" style="display:none">
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputPassword2">Email</label>
                                       <input type="email" name="email" class="form-control" id="exampleInputPassword2" placeholder="Email" required>
                                       <div class="help-block text-right"><a href="#" onclick="$('#login-form').show();$('#reset-form').hide()">Login ?</a></div>
                                    </div>

                                    <div class="form-group">
                                       <button type="submit" class="btn btn-primary btn-block"  name="submit" value="reset-password">Reset Password</button>
                                    </div>
                                 </form>

                              </div>
                           </div>
                        </li>
                     </ul>
                  </li>
                  </ul> -->
            </div>
            <!-- /.navbar-collapse -->
         </div>
         <!-- /.container -->
      </nav>
      <!-- Intro Header -->
      <header class="intro">
         <div class="intro-body">
            <div class="container">
               <div class="row">
                  <div class="col-md-8 col-md-offset-2">
                     <!--
                        <h1 class="brand-heading">Grayscale</h1>
                        <p class="intro-text">A free, responsive, one page Bootstrap theme.<br>Created by Start Bootstrap.</p>
                        -->
                     <a href="#daftar-beasiswa" class="btn btn-circle page-scroll">
                        <!-- <i class="fa fa-angle-double-down animated"></i> -->
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- Daftar beasiswa Section -->
      <section id="daftar-beasiswa" class="content-section text-center">
         <div class="daftar-beasiswa-section">
            <div class="container">
               <h4>Daftar Beasiswa</h4>
               <?php foreach ($kategori->result_array() as $kat) { ?>
               <div class="col-lg-4 col-sm-6 col-xs-12">
                  <div class="panel panel-success">
                     <div class="panel-heading" style="height:63px;">
                        <h3 class="panel-title judul">
                           <?php if($kat['status_pendaftaran'] === 'buka'){ ?>
                           <a href="<?php echo site_url('pendaftaran/index/' . $kat['slug'])?>"><?php echo $kat['nama']?></a>
                           <?php }else{ ?>
                           <?php echo $kat['nama']?>
                           <?php } ?>
                        </h3>
                     </div>
                     <div class="panel-body hitam" style="height: 70px;">
                        <?php echo $kat['nama']?>
                     </div>
                     <div class="panel-footer hitam" style="text-align: left">
                        Periode Pendaftaran:  <?php echo convert_sql_date_to_date($kat['tgl_buka']) . ' s.d ' . convert_sql_date_to_date($kat['tgl_tutup'])?><br>
                        Status Pendaftaran : <?php echo $kat['status_pendaftaran'] === 'buka' ? "<font style='color:blue'><strong>Pendaftaran dibuka</strong></font>" : "<font style='color:red'>Pendaftaran telah ditutup</font>";?> <br>
                        Penerima Beasiswa : <?php echo $kat['jml_penerima']?><br />
                        Link :
                        <a href="<?php echo site_url('pendaftaran/index/' . $kat['slug']);?>" class="alert-info">Pendaftaran</a>&nbsp;|&nbsp;
                        <a href="#" class="alert-success" data-toggle="modal" data-target="#loginModal">Login</a>&nbsp;|&nbsp;
                        <a href="#" class="alert-danger" data-toggle="modal" data-target="#cekHasil">Cek Hasil</a>
                     </div>
                  </div>
               </div>
               <?php } ?>
               <!-- <div class="col-lg-12">
                  </div> -->
            </div>
         </div>
      </section>
      <!-- Modal -->
      <div id="loginModal" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" style="color:#333">Silahkan Login</h4>
               </div>
               <div class="modal-body">
                  <form class="form" role="form" method="post" action="" accept-charset="UTF-8" id="login-form">
                     <div class="form-group">
                        <label class="sr-only" for="exampleInputEmail2" style="color:#333">NIK / Email</label>
                        <input type="text" name="username" class="form-control" id="exampleInputEmail2" placeholder="Nomor Induk kependudukan atau Email" required>
                     </div>
                     <div class="form-group">
                        <label class="sr-only" for="exampleInputPassword2" style="color:#333">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                        <br />
                        <?php echo $this->recaptcha->render() ?>
                        <div class="help-block text-right"><a href="#" onclick="$('#login-form').hide();$('#reset-form').show()">Lupa password ?</a></div>
                     </div>
                     <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"  name="submit" value="login">Login</button>
                     </div>
                  </form>
                  <form class="form" role="form" method="post" action="" accept-charset="UTF-8" id="reset-form" style="display:none">
                     <div class="form-group">
                        <label class="sr-only" for="exampleInputPassword2" style="color:#333">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputPassword2" placeholder="Email" required>
                        <div class="help-block text-right"><a href="#" onclick="$('#login-form').show();$('#reset-form').hide()">Login ?</a></div>
                     </div>
                     <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"  name="submit" value="reset-password">Reset Password</button>
                     </div>
                  </form>
               </div>
               <!-- <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div> -->
            </div>
         </div>
      </div>
      <div id="cekHasil" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" style="color:#333">Cek Hasil</h4>
               </div>
               <div class="modal-body">
                  <form class="form" role="form" method="post" action="<?php echo site_url('web/cek_hasil')?>" accept-charset="UTF-8" id="formCekHasil">
                     <div class="form-group">
                        <label class="sr-only" for="exampleInputEmail2" style="color:#333">NIK</label>
                        <input type="text" id="cek_nik" name="nik" class="form-control" id="exampleInputEmail2" placeholder="NIK" required>
                     </div>
                     <div class="alert fade in alert-dismissable" style="margin-top:18px;display:none" id="alert_cek_hasil">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                     </div>
                     <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"  name="submit" value="cek_hasil">Cek Hasil</button>
                     </div>
                  </form>
               </div>
               <!-- <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div> -->
            </div>
         </div>
      </div>

      <div id="lolos_tahap_1" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
         <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" style="color:#333">Pengumuman Peserta Lolos Tahap 1 <a href="<?php echo site_url('web/download_rekap_tahap_pertama')?>">[Download]</h4>
               </div>
               <div class="modal-body">
                  <iframe src="https://docs.google.com/gview?url=<?php echo site_url('uploads/lolos_tahap_1.pdf')?>&embedded=true" style="width:870px; height:500px;" frameborder="0"></iframe>
               </div>
               <!-- <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div> -->
            </div>
         </div>
      </div>
      <section id="juknis" class="content-section text-center">
         <div class="juknis-section">
            <div class="container">
               <div class="content">
                  <div class="panel panel-success">
                     <div class="panel-heading">
                        <h3 class="panel-title judul">Juknis</h3>
                     </div>
                     <div class="panel-body hitam table-responsive">
                        <?php echo $juknis['content'];?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <br />
      <section id="rundown" class="content-section">
         <div class="rundown-section">
            <div class="container">
               <div class="content">
                  <div class="panel panel-success">
                     <div class="panel-heading">
                        <h3 class="panel-title judul">Rundown</h3>
                     </div>
                     <div class="panel-body hitam">
                        <?php echo $rundown['content'];?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <br />
      <section id="daftar-berita" class="content-section text-center">
         <div class="daftar-berita-section">
            <div class="container">
               <h4>Alur</h4>
               <img src="<?php echo site_url('uploads/alur-pendaftaran.jpg');?>"  class="img-responsive">
            </div>
         </div>
      </section>
      <br />
      <section id="faq-menu" class="content-section">
         <div class="faq-menu-section">
            <div class="container">
               <div class="content">
                  <div class="panel panel-success">
                     <div class="panel-heading">
                        <h3 class="panel-title judul">FAQ</h3>
                     </div>
                     <div class="panel-body hitam table-responsive">
                        <!-- faq -->
                        <div class="panel-group" id="accordion">
                           <h3 class="text-center" style="margin-bottom:10px">FAQ (Frequently Asked Questions)</h3>
                           <h4 class="text-center" style="margin-bottom:10px">PROGRAM BEASISWA PRESTASI PROVINSI JAMBI TAHUN 2017</h4>
                           <p class="text-center">Dijawab berdasarkan Pergub No. 21 Tahun 2017 tentang Beasiswa Prestasi dan Juknis Beasiswa Prestasi</p>
                           <?php foreach ($faqs->result_array() as $faq) { ?>
                           <!-- faq item -->
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $faq['id']?>" style="font-size: 15px">
                                    <?php echo $faq['pertanyaan']?>
                                    </a>
                                 </h4>
                              </div>
                              <div id="collapse-<?php echo $faq['id']?>" class="panel-collapse collapse">
                                 <div class="panel-body">
                                    <?php echo $faq['jawaban']?>
                                 </div>
                                 <!-- <div class="panel-footer">
                                    <div class="btn-group btn-group-xs"><span class="btn">Was this question useful?</span><a class="btn btn-success" href="#"><i class="fa fa-thumbs-up"></i> Yes</a> <a class="btn btn-danger" href="#"><i class="fa fa-thumbs-down"></i> No</a></div>
                                    <div class="btn-group btn-group-xs pull-right"><a class="btn btn-primary" href="#">Report this question</a></div>
                                    </div> -->
                              </div>
                           </div>
                           <!-- faq item-->
                           <?php } ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <br />
      <!-- Contact Section -->
      <section id="contact">
         <div class="container content-section" id="footer">
            <div class="row">
               <div class="col-sm-4 col-sm-offset-1">
                  <div class="footerWidget nekoAnim-invisible nekoAnim-animated nekoAnim-fadeIn nekoAnim-visible" data-nekoanim="fadeIn" data-nekodelay="100" style="-webkit-animation: 100ms;">
                     <h4>Informasi Umum</h4>
                     <div><a class="page-scroll" href="#informasi" id="btn-definisi">Informasi</a></div>
                     <div><a class="page-scroll" href="#informasi" id="btn-organisasi"></a></div>
                     <div><a class="page-scroll" href="#informasi" id="btn-skrektor"></a></div>
                     <div><a class="page-scroll" href="#informasi" id="btn-melamar">Cara melamar Beasiswa</a></div>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="footerWidget nekoAnim-invisible nekoAnim-animated nekoAnim-fadeIn nekoAnim-visible" data-nekoanim="fadeIn" data-nekodelay="100" style="-webkit-animation: 100ms;">
                     <h4>Akses Cepat</h4>
                     <!-- <div><a href="#">Daftar Akun</a></div> -->
                     <div><a href="http://disdik.jambiprov.go.id/">Portal Sistem Informasi</a></div>
                     <div><a href="https://simpeg.disdik.jambiprov.go.id/">Sistem Informasi Pegawai (SIMPEG)</a></div>
                     <div><a href="http://disdik.jambiprov.go.id/web/">Website Dinas Pendidikan Provinsi Jambi</a></div>
                     <div><a href="http://mail.jambiprov.go.id/">Webmail</a></div>
                  </div>
               </div>
               <div class="col-sm-3">
                  <div class="footerWidget nekoAnim-invisible nekoAnim-animated nekoAnim-fadeIn nekoAnim-visible" data-nekoanim="fadeIn" data-nekodelay="300" style="-webkit-animation: 300ms;">
                     <h4>Kontak Pengelola
                     </h4>
                     <address>
                        <p>
                           Layanan Informasi Beasiswa<br>
                           <i class="fa fa-institution"></i>&nbsp;Jl. Jendral Ahmad Yani No. 06<br>Telanaipura Jambi - 36124<br>
                           <i class="fa fa-envelope-o"></i>&nbsp;admin@beasiswaprovjambi.com<br>
                           <i class="fa fa-clock-o"></i>&nbsp;08.00 - 16.00 WIB
                        </p>
                        <br>
                     </address>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- Definisi Section -->
      <section id="informasi" class="container content-section text-left">
         <div class="row">
            <!-- <div class="col-lg-8 col-lg-offset-2" id="definisi">
               <h3>Informasi</h3>
               <p>
                  <b>Bagi Pendaftar Beasiswa</b> Jika belum menerima email balasan 1x24 jam dari system terkait password untuk login, silahkan melakukan aduan via chat online pada website beasiswa, Kami siap membantu<br><br>
                  <b>Bagi Pendaftar Beasiswa</b> Yang Belum Menerima Password Login Silahkan Melakukan Reset Password di Halaman LOGIN<br><br>
            </div> -->
            <div class="col-lg-8 col-lg-offset-2" id="definisi" style="display: block;">
               <h3>Informasi</h3>
               <p>
                  <b>SEDANG DILAKUKAN TAHAP VERIVIKASI</b> CALON PENERIMA BEASISWA PRESTASI YANG LOLOS SELEKSI TAHAP 1 (ONLINE) DITETAPKAN BERDASARKAN RANGKING INDEKS PRESTASI TERTINGGI DAN KELENGKAPAN / KESESUAIAN DOKUMEN YANG DIUNGGAH SESUAI DENGAN JUMLAH QUOTA PENERIMAAN BEASISWA DITAMBAH DENGAN 20% (DUA PULUH PERSEN) CADANGAN<br><br>
                  <b>JADWAL VERIFIKASI FAKTUAL (TAHAP 2) DOKUMEN</b> BEASISWA OLEH TIM SELEKSI AKADEMIS SEDANG DILAKUKAN PENJADWALAN ULANG, JADWAL AKAN DIUMUMKAN MELAUI EMAIL DAN HALAMAN WEBSITE, MOHON BERSABAR...!!!<br><br>
               </p>
            </div>
            <div class="col-lg-8 col-lg-offset-2" id="skrektor">
               <h3>SK Gubernur Pengelolaan Beasiswa</h3>
               <p>
                  Unduh dokumen <a href=#>SK Gubernur Nomor...</a> tentang Pengelolaan dukungan Biaya Pendidikan dan biaya Penunjang Pendidikan yang dikelola di lingkungan Provinsi Jambi.
               </p>
            </div>
            <div class="col-lg-8 col-lg-offset-2" id="melamar">
               <h3>Cara melamar Beasiswa</h3>
               <p>
               <div>Lakukan 6 Langkah berikut:</div>
               <ol>
                  <li>Registrasi</li>
                  <li>Memilih paket beasiswa yang sesuai dengan kebutuhan Anda</li>
                  <li>Klik tombol <b>"Daftar"</b> pada paket beasiswa yang Anda pilih</li>
                  <li>Mengisi seluruh data yang diperlukan, kemudian mengunggah seluruh dokumen Syarat dan Ketentuan yang diminta</li>
                  <li>Apabila dokumen Syarat dan Ketentuan sudah Anda lengkapi, klik tombol <b>"Kirim"</b> pada formulir elektronik.</li>
                  <li>Pendaftaran Selesai. Silakan memantau status lamaran beasiswa Anda secara berkala hingga akhir masa seleksi yang telah ditentukan.</li>
               </ol>
               </p>
            </div>
            <div class="col-lg-12" style="text-align: center">
               <a href="#contact" class="btn-kecil btn-circle-kecil page-scroll">
               <i class="fa fa-angle-up animated"></i>
               </a>
            </div>
         </div>
      </section>
      <!-- Map Section -->
      <!-- <div id="map"></div> -->
      <!-- Footer -->
      <footer>
         <div class="container text-center">
            COPYRIGHT © <a href="https://disdik.jambiprov.go.id/">DINAS PENDIDIKAN PROVINSI JAMBI</a> | SUPPORT BY <a href="http://btikp.disdik.jambiprov.go.id/">BALAI TEKNOLOGI INFORMASI KOMUNIKASI PENDIDIKAN (BTIKP)</a><br>
            DEVELOPER <a href="https://inone-tech.com/">INONE-TECH</a><br>2017
         </div>
      </footer>
      <script type='text/javascript'>//<![CDATA[
         $('#cekHasil').on('hidden.bs.modal', function () {
             // do something…
             $('#cek_nik').val('');
             $('#alert_cek_hasil').hide();
         })

         $('#formCekHasil').on('submit', function(e){
             e.preventDefault();
             $.ajax({
               type: 'POST',
               url: $("#formCekHasil").attr("action"),
               data: {nik : $('#cek_nik').val() },
               dataType: 'json',
               success: function(response) {
                 var alert_class = response.alert_class;
                 var msg = response.msg;

                 $('#alert_cek_hasil').removeClass('alert-warning')
                                      .removeClass('alert-success')
                                      .removeClass('alert-info')
                                      .removeClass('alert-danger').addClass(alert_class);
                 $('#alert_cek_hasil').html(msg);
                 $('#alert_cek_hasil').show();
               },
             });

         });

         <?php $this->load->config('recaptcha', true); ?>
          var CaptchaCallback = function() {
            $('.g-recaptcha').each(function(index, el) {
              grecaptcha.render(el, {'sitekey' : '<?php echo $this->config->item('recaptcha_sitekey', 'recaptcha')?>'});
            });
          };

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

          $('#btn-definisi').click(function() {
              $('#definisi').show();
              $('#organisasi').hide();
              $('#skrektor').hide();
              $('#melamar').hide();
              $('#donatur').hide();
              $('#faq').hide();
          });

          $('#btn-organisasi').click(function() {
              $('#definisi').hide();
              $('#organisasi').show();
              $('#skrektor').hide();
              $('#melamar').hide();
              $('#donatur').hide();
              $('#faq').hide();
          });

          $('#btn-skrektor').click(function() {
              $('#definisi').hide();
              $('#organisasi').hide();
              $('#skrektor').show();
              $('#melamar').hide();
              $('#donatur').hide();
              $('#faq').hide();
          });

          $('#btn-melamar').click(function() {
              $('#definisi').hide();
              $('#organisasi').hide();
              $('#skrektor').hide();
              $('#melamar').show();
              $('#donatur').hide();
              $('#faq').hide();
          });

          $('#btn-donatur').click(function() {
              $('#definisi').hide();
              $('#organisasi').hide();
              $('#skrektor').hide();
              $('#melamar').hide();
              $('#donatur').show();
              $('#faq').hide();
          });

          $('#btn-faq').click(function() {
              $('#definisi').hide();
              $('#organisasi').hide();
              $('#skrektor').hide();
              $('#melamar').hide();
              $('#donatur').hide();
              $('#faq').show();
          });


          $(document).ready(
            function() {
              $('#definisi').show();
              $('#organisasi').hide();
              $('#skrektor').hide();
              $('#melamar').hide();
              $('#donatur').hide();
              $('#faq').hide();
            }
          );

          // jQuery to collapse the navbar on scroll
          $(window).scroll(function() {
              if ($(".navbar").offset().top > 50) {
                  $(".navbar-fixed-top").addClass("top-nav-collapse");
              } else {
                  $(".navbar-fixed-top").removeClass("top-nav-collapse");
              }
          });


          // jQuery for page scrolling feature - requires jQuery Easing plugin
          $(function() {
              $('a.page-scroll').bind('click', function(event) {
                  var $anchor = $(this);
                  $('html, body').stop().animate({
                      scrollTop: $($anchor.attr('href')).offset().top
                  }, 1500, 'easeInOutExpo');
                  event.preventDefault();
              });
          });

          // Closes the Responsive Menu on Menu Item Click
          $('.navbar-collapse ul li a').click(function() {
              $('.navbar-toggle:visible').click();
          });

          /**
          * Vertically center Bootstrap 3 modals so they aren't always stuck at the top
          */
          function setModalMaxHeight(element) {
            this.$element     = $(element);
            this.$content     = this.$element.find('.modal-content');
            var borderWidth   = this.$content.outerHeight() - this.$content.innerHeight();
            var dialogMargin  = $(window).width() < 768 ? 20 : 60;
            var contentHeight = $(window).height() - (dialogMargin + borderWidth);
            var headerHeight  = this.$element.find('.modal-header').outerHeight() || 0;
            var footerHeight  = this.$element.find('.modal-footer').outerHeight() || 0;
            var maxHeight     = contentHeight - (headerHeight + footerHeight);

            this.$content.css({
                'overflow': 'hidden'
            });

            this.$element
              .find('.modal-body').css({
                'max-height': maxHeight,
                'overflow-y': 'auto'
            });
          }

          $('.modal').on('show.bs.modal', function() {
            $(this).show();
            setModalMaxHeight(this);
          });

          $(window).resize(function() {
            if ($('.modal.in').length != 0) {
              setModalMaxHeight($('.modal.in'));
            }
          });

          $('.modal-content').resizable({
           //alsoResize: ".modal-dialog",
           minHeight: 300,
           minWidth: 300
         });

         $('.modal-dialog').draggable();

         $('#loginModal').on('show.bs.modal', function() {
           $(this).find('.modal-body').css({
             'max-height': '100%'
           });
         });


         //  $(".show-more a").on("click", function () {
         //      var $this = $(this);
         //      var $content = $this.parent().prev("div.content");
         //      var linkText = $this.text().toUpperCase();
          //
         //      if (linkText === "SELENGKAPNYA") {
         //          linkText = "Tutup";
         //          $content.switchClass("hideContent", "showContent", 400);
         //      } else {
         //          linkText = "Selengkapnya";
         //          $content.switchClass("showContent", "hideContent", 400);
         //      }
         //      ;
          //
         //      $this.text(linkText);
         //  });
          //]]>

      </script>
      <?php if(get_settings('show','frontpage_popup') === 'YA'){ ?>
      <div class="popup-wrapper" id="popup"  style="overflow-y: scroll;">
         <div class="popup-container">
            <!-- Konten popup, silahkan ganti sesuai kebutughan -->
            <form action="<?php echo site_url('#daftar-beasiswa')?>" method="post" class="popup-form">
               <?php echo get_settings('value','frontpage_popup');?>
               <a href="#popup" class="btn btn-danger pull-right">Tutup</a>
            </form>
            <a class="popup-close" href="#popup">X</a>
         </div>

      </div>
    <?php } ?>

   </body>
</html>
