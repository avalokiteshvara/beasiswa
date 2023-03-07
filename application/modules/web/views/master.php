<!DOCTYPE html>
<html>
   <!-- <meta http-equiv="content-type" content="text/html;charset=UTF-8" /> -->
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Sistem Bantuan Beasiswa Provinsi Jambi</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta property="og:title" content="Sistem Bantuan Beasiswa Provinsi Jamb">
      <meta property="og:url" content="<?php echo site_url()?>">
      <meta property="og:description" content="Sistem Bantuan Beasiswa Provinsi Jamb">
      <meta property="og:type" content="article">
      <meta property="og:site_name" content="Sistem Bantuan Beasiswa Provinsi Jambi">
      <meta name="description" content="Sistem Bantuan Beasiswa Provinsi Jambi">
      <meta name="keywords" content="Sistem Bantuan Beasiswa Provinsi Jambi">
      <meta name="author" content="">
      <link rel="icon" href="#" type="">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
      <link rel="stylesheet" href="<?php echo site_url('assets/web/css/style.css?v=' . uniqid() );?>" />
      <link rel="stylesheet" href="<?php echo site_url('assets/web/css/settings.css');?>">
      <link rel="stylesheet" href="<?php echo site_url('assets/web/css/navigation.css');?>">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-90763815-4"></script> -->
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
		 table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
      </style>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.min.js"></script>
      <script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit&hl=id" async defer></script>
      <script type="text/javascript" src="<?php echo site_url('assets/web/js/jquery.themepunch.tools.min.js');?>"></script>
      <script type="text/javascript" src="<?php echo site_url('assets/web/js/jquery.themepunch.revolution.min.js');?>"></script>
      <script type="text/javascript" src="<?php echo site_url('assets/web/js/revolution.extension.actions.min.js');?>"></script>
      <script type="text/javascript" src="<?php echo site_url('assets/web/js/revolution.extension.carousel.min.js');?>"></script>
      <script type="text/javascript" src="<?php echo site_url('assets/web/js/revolution.extension.kenburn.min.js');?>"></script>
      <script type="text/javascript" src="<?php echo site_url('assets/web/js/revolution.extension.layeranimation.min.js');?>"></script>
      <script type="text/javascript" src="<?php echo site_url('assets/web/js/revolution.extension.migration.min.js');?>"></script>
      <script type="text/javascript" src="<?php echo site_url('assets/web/js/revolution.extension.navigation.min.js');?>"></script>
      <script type="text/javascript" src="<?php echo site_url('assets/web/js/revolution.extension.parallax.min.js');?>"></script>
      <script type="text/javascript" src="<?php echo site_url('assets/web/js/revolution.extension.slideanims.min.js');?>"></script>
      <script type="text/javascript" src="<?php echo site_url('assets/web/js/revolution.extension.video.min.js');?>"></script>
      <script type="text/javascript" src="<?php echo site_url('assets/web/js/revolution.initialize.js');?>"></script>   
      <!-- <script type="text/javascript" src="<?php echo site_url('assets/web/js/wow.min.js');?>"></script> -->
      <script type="text/javascript" src="https://cdn.rawgit.com/graingert/WOW/34712a3d/dist/wow.min.js"></script>
      <script>new WOW().init();</script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="<?php echo site_url('assets/web/js/script.js');?>" type="text/javascript"></script>
      <script src="<?php echo site_url('assets/web/js/smoothpagescroll.js');?>" type="text/javascript"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script type="text/javascript">
         var _smartsupp = _smartsupp || {};
         _smartsupp.key = 'c4480d158f5400eaee184333600551ce695f6920';
         window.smartsupp||(function(d) {
            var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
            s=d.getElementsByTagName('script')[0];c=d.createElement('script');
            c.type='text/javascript';c.charset='utf-8';c.async=true;
            c.src='//www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
         })(document);
         
         $( function() {
          $( ".accordion" ).accordion({heightStyle: "content"});
         } );
      </script>
   </head>
   <body>
      <?php if(get_settings('show','frontpage_marquee') === 'YA'){ ?>
      <marquee bgcolor="black" style="font-family:calibri; font-size:20px; color:#ffffff;"><strong><?php echo get_settings('value','frontpage_marquee');?></strong></marquee>
      <?php } ?>
      <div class="theme-layout">
         <header id="namheader">
            <div class="container">
               <div class="logo animated tada wow"><a href="<?php echo site_url();?>" style="display:block;width:120px;height:125px;margin:10px 50px 0px 0px;background:url(<?php echo site_url('uploads/logo.jpg')?>) no-repeat; background-size:contain;"></a></div>
               <div class="header-wrap">
                  <div class="topbar">
                     <div class="login" style="float: left;">
                        <form method="post" autocomplete="off">
                           <!-- <input placeholder="Email" type="text" name="namtextloginpenggunaid" required> -->
                           <!-- <input placeholder="Kata Sandi" type="password" name="namtextloginpenggunasandi" required> -->
                           <!-- <button type="submit" class="button active">MASUK</button> -->
                           <a type="button" class="button active buttlike" href="<?php echo site_url('index.php')?>#rekap-grafik">GRAFIK PENDAFTAR</a>
                        </form>
                     </div>
                     <div class="login" name="namdivlogin">
                        <form method="post" autocomplete="off">
                           <!-- <input placeholder="Email" type="text" name="namtextloginpenggunaid" required> -->
                           <!-- <input placeholder="Kata Sandi" type="password" name="namtextloginpenggunasandi" required> -->
                           <!-- <button type="submit" class="button active">MASUK</button> -->
                           <a class="button active buttlike animated flash" style="background-color:yellow;color:black" href="#" data-toggle="modal" data-target="#loginModal" onclick="$('.login-form').hide();$('.reset-form').show();$('.modal-title-login').html('Reset Password');">Reset Password</a>

                           <a type="button" class="button active buttlike" href="<?php echo site_url('index.php')?>#daftar-beasiswa">DAFTAR BEASISWA</a>
                        </form>
                     </div>
                     
                  </div>
                  <div class="menubar">
                     <nav>
                        <ul>
                           <li><a href="<?php echo site_url()?>"><i class="fa fa-home"></i> BERANDA</a></li>
                     
                           <li><a href="uploads/buku_petunjuk_pendaftaran_beasiswa_versi2.0.pdf" target="_blank"></i> PETUNJUK PENDAFTARAN</a></li>
                           
                           <?php if (file_exists(FCPATH . 'uploads/lolos_tahap_1.pdf')) { ?>
                           <!--<li><a class="animated infinite flash" href="#" data-toggle="modal" data-target="#lolos_tahap_1">LOLOS TAHAP 1</a></li>-->
                           <?php } ?>
                         <li><a class="animated infinite flash" a href="uploads/lolos_tahap_2.pdf" target="_blank"></i> LOLOS TAHAP 2</a></li>
                           <!--<li><a href="<?php echo site_url('index.php');?>#juknis">JUKNIS</a></li>-->
                           <li><a href="<?php echo site_url('index.php');?>#rundown">RUNDOWN</a></li>
                           <li><a href="<?php echo site_url('index.php');?>#daftar-berita">ALUR</a></li>
                           <li><a href="<?php echo site_url('index.php');?>#faq-menu">FAQ</a></li>
                           <li><a href="<?php echo site_url('index.php');?>#contact">KONTAK</a></li>
						   <li><a href="<?php echo site_url('index.php');?>#daftar-beasiswa">LOGIN</a></li>
                        </ul>
                     </nav>
                  </div>
               </div>
            </div>
         </header>
         <div class="responsive-header">
            <div class="topbar">
               <a class="menu-button" href="#" style="background:none;"><i class="fa fa-bars" style="font-size:24px;"></i></a>
               <div class="login" name="namdivlogin">
                  <form id="frmlogin2" method="post" autocomplete="off">
                    <a type="button" class="button active buttlike" href="<?php echo site_url('index.php')?>#rekap-grafik">GRAFIK PENDAFTAR</a>
                     <a type="button" class="button active buttlike" href="<?php echo site_url('index.php')?>#daftar-beasiswa">DAFTAR BEASISWA</a>
                       <a class="button active buttlike animated flash" style="background-color:yellow;color:black" href="#" data-toggle="modal" data-target="#loginModal" onclick="$('.login-form').hide();$('.reset-form').show();$('.modal-title-login').html('Reset Password');">Reset Password</a>
                  </form>
               </div>
            </div>
            <!-- responsive menu-->
            <div class="responsive-menu">
               <a class="close-menu" href="#" style="background:none;"><i class="fa fa-bars" style="font-size:24px;"></i></a>
               <div class="responsive-logobar">
                  <div class="responsive-logo animated tada wow">
                     <a href="<?php echo site_url()?>">
                     <img src="<?php echo site_url('uploads/logo.jpg')?>" width="180" height="187.5" alt="" />
                     </a>
                  </div>
               </div>
               <ul>
                  <li><a href="<?php echo site_url()?>"><i class="fa fa-home"></i> BERANDA</a></li>
   <li><a href="uploads/buku_petunjuk_pendaftaran_beasiswa_versi2.0.pdf" target="_blank"></i> PETUNJUK PENDAFTARAN</a></li>
                
                  <?php if (file_exists(FCPATH . 'uploads/lolos_tahap_1.pdf')) { ?>
                  <!--<li><a class="animated infinite flash" href="#" data-toggle="modal" data-target="#lolos_tahap_1">LOLOS TAHAP 1</a></li>-->
                  <?php } ?>
                  <li><a class="animated infinite flash" a href="uploads/lolos_tahap_2.pdf" target="_blank"></i> LOLOS TAHAP 2</a></li>
                  <!--<li><a href="<?php echo site_url('index.php');?>#juknis">JUKNIS</a></li>-->
                  <li><a href="<?php echo site_url('index.php');?>#rundown">RUNDOWN</a></li>
                  <li><a href="<?php echo site_url('index.php');?>#daftar-berita">ALUR</a></li>
                  <li><a href="<?php echo site_url('index.php');?>#faq-menu">FAQ</a></li>
                  <li><a href="<?php echo site_url('index.php');?>#contact">KONTAK</a></li>
				    <li><a href="<?php echo site_url('index.php');?>#daftar-beasiswa">LOGIN</a></li>
               </ul>
            </div>
         </div>
         <section id="namberanda">
            <div class="block no-padding">
               <div class="row">
                  <div class="col-md-12">
                     <div class="creative-slider">
                        <div id="rev_slider_4_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="classicslider1">
                           <div id="rev_slider_4_1" class="rev_slider fullwidthabanner" style="display:none;">
                              <ul>
                                 <?php
                                    // echo FCPATH;
                                    $files = array_slice(scandir(FCPATH . 'uploads/slider/'), 2);
                                    // var_dump($files);
                                    $i = 1;
                                    foreach ($files as $file) { ?>
                                 <li data-index="rs-<?php echo $i;?>" data-delay="15000" data-transition="random" data-slotamount="12"  data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="1000" data-title="Slide <?php echo $i;?>">
                                    <img src="<?php echo site_url('uploads/slider/' . $file)?>" alt="" data-bgposition="center center"  data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="4" class="rev-slidebg" data-no-retina>
                                 </li>
                                 <?php $i++;}
                                    ?>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <?php if(get_settings('show','frontpage_popup') === 'YA'){ ?>
         <div class="maklumat-info alert alert-danger alert-dismissible animated fadeInUpBig wow" role="alert" data-wow-delay="5s">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span><?php echo get_settings('value','frontpage_popup');?></span>
         </div>
         <?php } ?>
         <section id="daftar-beasiswa" style="background-color: #2F4355;padding-top: 100px">
            <!-- <div class="block"> -->
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <div class="panel panel-success">
                        <div class="panel-heading">
                           <h3 class="panel-title judul">Daftar Beasiswa</h3>
                        </div>
                        <div class="panel-body hitam table-responsive">
                           <!-- <h4 style="color: #fff">Daftar Beasiswa</h4> -->
                           <?php foreach ($kategori->result_array() as $kat) { ?>
                           <div class="col-lg-4 col-sm-6 col-xs-12" id="beasiswa-<?php echo $kat['id']?>">
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
                                    Quota Penerima Beasiswa : <?php echo $kat['jml_penerima']?><br />
                               
                                    Link :
                                    <a href="<?php echo site_url('pendaftaran/index/' . $kat['slug']);?>" class="alert-info">Pendaftaran</a>&nbsp;|&nbsp;
                                    <a href="#" class="alert-success" data-toggle="modal" data-target="#loginModal">Login</a>&nbsp;|&nbsp;
                                    <a href="#" class="alert-danger" data-toggle="modal" data-target="#cekHasil">Cek Hasil</a>
                                 </div>
                              </div>
                           </div>
                           <?php } ?>  
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <style type="text/css">
            .blackish:before, .whitish:before, .grayish:before, .coloured:before {
            background: #000 none repeat scroll 0 0;  content: "";
            height: 100%; opacity: 0.8; z-index: -666; position: absolute;
            left: 0; top: 0; width: 100%;
            }
         </style>
         <!--<section id="juknis">
            <div class="blackish">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="content">
                           <div class="panel panel-success">
                              <div class="panel-heading">
                                 <h3 class="panel-title judul">Juknis</h3>
                              </div>
                              <div class="panel-body hitam table-responsive">
                                 <iframe src="https://docs.google.com/gview?url=<?php echo site_url('uploads/juknis.docx');?>&embedded=true" style="width:100%; height:500px;" frameborder="0"></iframe>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>-->
         <section id="rundown" style="background-color: #2F4355;">
            <!-- <div class="block"> -->
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <div class="content">
                        <div class="panel panel-success">
                           <div class="panel-heading">
                              <h3 class="panel-title judul">Rundown</h3>
                           </div>
                           <div class="panel-body hitam">
                           <table>
  <tr>
    <th>JADWAL</th>
    <th>KEGIATAN</th>
    <th>KETERANGAN</th>
 
  </tr>
  <tr>
    <td>01 - 04 Okt 2018</td>
    <td>Sosialisasi Bantuan Beasiswa</td>
    <td>Media Cetak, Elektronik dan Media Sosial</td>
  </tr>
  <tr>
    <td>05 Okt - 05 Nov 2018</td>
    <td>Pendaftaran Online dan upload kelengkapan dokumen</td>
    <td>http://beasiswa.disdik.jambiprov.go.id</td>
  </tr>
  <tr>
    <td>06 - 11 Nov 2018</td>
    <td>Verifkasi Tahap 1 (Berkas)</td>
    <td>Tim Admin Beasiswa</td>
  </tr>
  <tr>
    <td>14 Des 2018</td>
    <td>Pengumuman Hasil Verifikasi Tahap 1 (Berkas) dan Penyampaian Undangan Untuk Verifikasi Tahap 2 (Faktual)</td>
    <td>Tim Seleksi Beasiswa</td>
  </tr>
  <tr>
    <td>18-20 Des 2018</td>
    <td>Verifikasi Tahap 2 (Faktual), Diikuti oleh mahasiswa yang berada di Jambi dan khusus Dokter Spesialis, Mahasiswa D3,S1,S2 yang diluar Jambi bisa/boleh diwakilkan menggunakan Surat Kuasa</td>
    <td>Tim Seleksi Beasiswa</td>
  </tr>
  <tr>
    <td>21-22 Des 2018</td>
    <td>Verifikasi ke Perguruan Tinggi</td>
    <td>Tim Seleksi Beasiswa</td>
  </tr>
   <tr>
    <td>28 Des 2018</td>
    <td>Pengumuman Penerima Bantuan Beasiswa Prestasi</td>
    <td>Jumlah Calon Penerima Sesuai Quota</td>
  </tr>
  <tr>
    <td>29-31 Des 2018</td>
    <td>Penyiapan Dokumen Pencairan Beasiswa Prestasi</td>
    <td>PPTK</td>
  </tr>
   
   <tr>
    <td>04 Jan 2019</td>
    <td>Pengambilan Buku Tabungan dan ATM disesuaikan dengan Jadwal Penerima Beasiswa oleh Pendaftar Beasiswa yang telah dinyatakan Lolos Tahap 2 (Faktual). Mekanisme Pengambilan Buku Tabungan Pagi Pukul 08.00-11.30 WIB JENJANG DOKTER SPESIALIS, D3 DAN S2. Siang Pukul 14.00-17.00 WIB JENJANG S1 </td>
    <td>Aula Lt. 3 Dinas Pendidikan</td>
  </tr>
</table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- </div> -->
         </section>
         <section id="daftar-berita">
            <div class="daftar-berita-section">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="content">
                           <div class="panel panel-success">
                              <div class="panel-heading">
                                 <h3 class="panel-title judul">Alur</h3>
                              </div>
                              <div class="panel-body hitam">
                                 <img src="<?php echo site_url('uploads/alur-pendaftaran.jpg');?>"  class="img-responsive">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <section id="faq-menu" style="background-color: #2F4355;">
            <div class="block blackish">
               <!-- <div class="fixed-bg bg3"></div> -->
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="panel panel-success">
                           <div class="panel-heading">
                              <h3 class="panel-title judul">FAQ</h3>
                           </div>
                           <div class="panel-body hitam table-responsive">
                              <!-- faq -->
                              <div class="panel-group">
                                 <h3 class="text-center" style="margin-bottom:10px">FAQ (Frequently Asked Questions)</h3>
                                 <h4 class="text-center" style="margin-bottom:10px">PROGRAM BEASISWA PRESTASI PROVINSI JAMBI TAHUN 2018</h4>
                                
                                 <div class="accordion">
                                    <?php foreach ($faqs->result_array() as $faq) { ?>
                                    <!-- faq item -->                                 
                                    <h3><?php echo $faq['pertanyaan']?></h3>
                                    <div><?php echo $faq['jawaban']?></div>
                                    <!-- faq item-->
                                    <?php } ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>

         <!-- highchart -->
         <script src="https://code.highcharts.com/highcharts.js"></script>
         <script src="https://code.highcharts.com/modules/exporting.js"></script>
         <script src="https://code.highcharts.com/modules/export-data.js"></script>
         <script src="https://code.highcharts.com/modules/no-data-to-display.js"></script>

         <section id="rekap-grafik">
            <div class="daftar-berita-section">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="content">
                           <div class="panel panel-success">
                              <div class="panel-heading">
                                 <h3 class="panel-title judul">Grafik Pendaftar</h3>
                              </div>
                              <div class="panel-body hitam">
                                  <div class="panel-group">
                                    <div class="accordion">
                                       <h3>Jumlah pendaftar perjenjang</h3>
                                       <div>
                                          <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                                          <script type="text/javascript">
                                             Highcharts.chart('container', {
                                                    chart: {
                                                        plotBackgroundColor: null,
                                                        plotBorderWidth: null,
                                                        plotShadow: false,
                                                        type: 'pie'
                                                    },
                                                    title: {
                                                        text: 'Berdasarkan jenjang pendidikan'
                                                    },
                                                    tooltip: {
                                                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                                    },
                                                    plotOptions: {
                                                        pie: {
                                                            allowPointSelect: true,
                                                            cursor: 'pointer',
                                                            dataLabels: {
                                                                enabled: true,
                                                                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                                                style: {
                                                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                                                }
                                                            }
                                                        }
                                                    },
                                                    series: [{
                                                        name: 'persentase',
                                                        colorByPoint: true,
                                                        data: [<?php echo $grafik_001['data'];?>]
                                                    }]
                                                });
                                          </script>
                                       </div>
                                       <h3>Perguruan Tinggi</h3>
                                       <div>
                                          <label for="sel1">Filter berdasarkan Jenjang: </label>
                                          <select name="select_grafik_002" class="form-control" id="select_grafik_002">
                                             <option value="2">Diploma III</option>
                                             <option value="3">Strata I</option>
                                             <option value="4">Strata II</option>
                                             <!-- <option value="2">Diploma III</option> -->
                                             <option value="6">Dokter Spesialis</option>
                                          </select>
                                          <!-- <input id="button" type="button" value="Update"/> -->
                                          <div id="grafik_002" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                                          <script type="text/javascript">
                                             var chart;
                                             $(document).ready(function() {
                                               chart = new Highcharts.Chart({
                                                 chart: {
                                                   renderTo: 'grafik_002',
                                                   plotBackgroundColor: null,
                                                   plotBorderWidth: null,
                                                   plotShadow: false,
                                                   animation: {
                                                     duration: 2000
                                                   }
                                                 },
                                                 title: {
                                                   text: 'Berdasarkan Perguruan Tinggi Asal'
                                                 },
                                                 tooltip: {
                                                   pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                                 },
                                                 plotOptions: {
                                                   pie: {
                                                     allowPointSelect: true,
                                                     cursor: 'pointer',
                                                     dataLabels: {
                                                       enabled: true,
                                                       color: '#000000',
                                                       connectorColor: '#000000',
                                                       // formatter: function() {
                                                       //     return '<b>'+ this.point.name +'</b>: '+ this.percentage +'.1f %';
                                                       // }
                                                       format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                                     }
                                                   }
                                                 },
                                                 series: [{
                                                   type: 'pie',
                                                   name: 'Persentase',
                                                   data: [ ]
                                                 }]
                                               });

                                               $.get("<?php echo site_url('web/update_grafik_002')?>", {
                                                   kategori: 2
                                                 })
                                                 .always(function(datareturn) {
                                                   chart.series[0].setData(eval("[" + datareturn + "]"), true);
                                                 });
                                             });

                                             jQuery("#select_grafik_002").on('change', function(i) {
                                               i.preventDefault();
                                               $.get("<?php echo site_url('web/update_grafik_002')?>", {
                                                   kategori: this.value
                                                 })
                                                 .always(function(datareturn) {
                                                   chart.series[0].setData(eval("[" + datareturn + "]"), true);
                                                 });
                                             });
                                              
                                          </script>

                                          
                                       </div>
                                       <h3>Akreditasi program studi</h3>
                                       <div>
                                          <label for="sel1">Filter berdasarkan Jenjang: </label>
                                          <select name="select_grafik_003" class="form-control" id="select_grafik_003">
                                             <option value="2">Diploma III</option>
                                             <option value="3">Strata I</option>
                                             <option value="4">Strata II</option>
                                             <!-- <option value="2">Diploma III</option> -->
                                             <option value="6">Dokter Spesialis</option>
                                          </select>
                                          <!-- <input id="button" type="button" value="Update"/> -->
                                          <div id="grafik_003" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                                          <script type="text/javascript">
                                             var chart;
                                             $(document).ready(function() {
                                               chart03 = new Highcharts.Chart({
                                                 chart: {
                                                   renderTo: 'grafik_003',
                                                   plotBackgroundColor: null,
                                                   plotBorderWidth: null,
                                                   plotShadow: false,
                                                   animation: {
                                                     duration: 2000
                                                   }
                                                 },
                                                 title: {
                                                   text: 'Berdasarkan Akreditasi Program Studi'
                                                 },
                                                 tooltip: {
                                                   pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                                 },
                                                 plotOptions: {
                                                   pie: {
                                                     allowPointSelect: true,
                                                     cursor: 'pointer',
                                                     dataLabels: {
                                                       enabled: true,
                                                       color: '#000000',
                                                       connectorColor: '#000000',
                                                       // formatter: function() {
                                                       //     return '<b>'+ this.point.name +'</b>: '+ this.percentage +'.1f %';
                                                       // }
                                                       format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                                     }
                                                   }
                                                 },
                                                 series: [{
                                                   type: 'pie',
                                                   name: 'Persentase',
                                                   data: [ ]
                                                 }]
                                               });

                                               $.get("<?php echo site_url('web/update_grafik_003')?>", {
                                                   kategori: 2
                                                 })
                                                 .always(function(datareturn) {
                                                   chart03.series[0].setData(eval("[" + datareturn + "]"), true);
                                                 });
                                             });

                                             jQuery("#select_grafik_003").on('change', function(i) {
                                               i.preventDefault();
                                               $.get("<?php echo site_url('web/update_grafik_003')?>", {
                                                   kategori: this.value
                                                 })
                                                 .always(function(datareturn) {
                                                   chart03.series[0].setData(eval("[" + datareturn + "]"), true);
                                                 });
                                             });
                                              
                                          </script>
                                       </div>
                                       
                                    </div>
                                  </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <section id="contact" style="color: #FFF;background:url(<?php echo site_url('assets/web/css/res/bg-pattern.jpg');?>) repeat scroll 0 0 transparent;">
            <div class="block">
               <div class="container content-section" id="footer">
                  <div class="row">
                     <div class="col-sm-4 col-sm-offset-1">
                        <div class="footerWidget nekoAnim-invisible nekoAnim-animated nekoAnim-fadeIn nekoAnim-visible" data-nekoanim="fadeIn" data-nekodelay="100" style="-webkit-animation: 100ms;">
                           <h4>Temukan Kami</h4>
                            <a href="https://www.facebook.com/Dinas-Pendidikan-Provinsi-Jambi-1605083263060096/"><i class="fa fa-facebook-square"></i>&nbsp;Facebook</a><br>
							<a href="https://www.instagram.com/disdikjambi/"><i class="fa fa-instagram"></i>&nbsp;Instagram</a><br>
							<a href="https://twitter.com/Disdik_Jambi"><i class="fa fa-twitter-square"></i>&nbsp;Twitter</a><br>
							<a href="http://disdik.jambiprov.go.id/web/"><i class="fa fa-link"></i>&nbsp;Website</a><br>
							<a href="https://www.youtube.com/channel/UC4w1DVb2isFVYbn0ml46rfw"><i class="fa fa-youtube"></i>&nbsp;Youtube Channel</a><br>
                       
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="footerWidget nekoAnim-invisible nekoAnim-animated nekoAnim-fadeIn nekoAnim-visible" data-nekoanim="fadeIn" data-nekodelay="100" style="-webkit-animation: 100ms;">
                           <h4>Akses Cepat</h4>
                           <!-- <div><a href="#">Daftar Akun</a></div> -->
                           <div><a href="https://forlap.ristekdikti.go.id/mahasiswa" target="_blank"><i class="fa fa-user-circle"></i>&nbsp;Pencarian Data Mahasiswa</a></div>
						   <div><a href="https://lamptkes.org/akreditasi/database/databasehasilakreditasi" target="_blank"><i class="fa fa-graduation-cap"></i>&nbsp;Akreditasi Program Studi LAM-PTKes</a></div>

 <div><a href="https://banpt.or.id/direktori/prodi/pencarian_prodi" target="_blank"><i class="fa fa-graduation-cap"></i>&nbsp;Akreditasi Program Studi</a></div>
						    <div><a href="http://dukcapil.kemendagri.go.id/ceknik" target="_blank"><i class="fa fa-id-card-o"></i>&nbsp;Cek NIK Nasional</a></div>
							<div><a href="http://infopersada.com/jambi/pemerintahan-dan-wilayah/41-daftar-kode-wilayah-kabupaten-kota-di-jambi.html" target="_blank"><i class="fa fa-address-card"></i>&nbsp;Daftar Kode Wilayah Kab/Kota di Jambi</a></div>
                        
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="footerWidget nekoAnim-invisible nekoAnim-animated nekoAnim-fadeIn nekoAnim-visible" data-nekoanim="fadeIn" data-nekodelay="300" style="-webkit-animation: 300ms;">
                           <h4>Layanan Informasi </h4>                   
                                                          
                                 <i class="fa fa-map-marker"></i>&nbsp;Jl.Jend.A.Yani No.06<br>Telanaipura Jambi Kode Pos 36124<br>
                                 <i class="fa fa-envelope-o"></i>&nbsp;admin@beasiswaprovjambi.com<br>
                                 <i class="fa fa-clock-o"></i>&nbsp;08.00 - 16.00 WIB
                              
                              <br>
                           </address>
                        </div>
                     </div>
                  </div>
                  <div class="row" id="informasi">
                    

                     <div class="col-lg-12" style="text-align: center">
                        <a href="#contact" class="btn-kecil btn-circle-kecil page-scroll">
                        <i class="fa fa-angle-up animated"></i>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </section>
        
      </div>
      <div id="loginModal" class="modal fade" role="dialog" data-backdrop="false">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title modal-title-login" style="color:#333">Silahkan Login</h4>
               </div>
               <div class="modal-body">
                  <form class="form login-form" role="form" method="post" action="" accept-charset="UTF-8">
                     <div class="form-group">
                        <label class="sr-only" for="exampleInputEmail2" style="color:#333">NIK / Email</label>
                        <input type="text" name="username" class="form-control" placeholder="Nomor Induk kependudukan atau Email" required>
                     </div>
                     <div class="form-group">
                        <label class="sr-only" for="exampleInputPassword2" style="color:#333">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <br />
                        <div class="help-block text-right"><a href="#" onclick="$('.login-form').hide();$('.reset-form').show();$('.modal-title-login').html('Reset Password');">Lupa password ?</a></div>
                     </div>
                     <div class="form-group">
                        <?php echo $this->recaptcha->render() ?>
                     </div>
                     <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"  name="submit" value="login">Login</button>
                     </div>
                  </form>
                  <form class="form reset-form" role="form" method="post" action="" accept-charset="UTF-8" style="display:none">
                     <div class="form-group">
                        <label class="sr-only" for="exampleInputPassword2" style="color:#333">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputPassword2" placeholder="Email" required>
                        <div class="help-block text-right"><a href="#" onclick="$('.login-form').show();$('.reset-form').hide();$('.modal-title-login').html('Silahkan Login');">Login ?</a></div>
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
                  <h4 class="modal-title" style="color:#333">Pengumuman Peserta Lolos Tahap 1 <a href="<?php echo site_url('web/download_rekap_tahap_pertama');?>">[Download]</a></h4>
               </div>
               <div class="modal-body">
                  <iframe src="https://docs.google.com/gview?url=<?php echo site_url('uploads/lolos_tahap_1.pdf');?>&embedded=true" style="width:870px; height:500px;" frameborder="0"></iframe>
               </div>
            </div>
         </div>
      </div>
      <div id="lolos_tahap_2" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
         <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" style="color:#333">Pengumuman Peserta Lolos Tahap 2 <a href="<?php echo site_url('web/download_rekap_tahap_kedua');?>">[Download]</a></h4>
               </div>
               <div class="modal-body">
                  <iframe src="https://docs.google.com/gview?url=<?php echo site_url('http://beasiswa.disdik.jambiprov.go.id/uploads/lolos_tahap_2.pdf');?>&embedded=true" style="width:870px; height:500px;" frameborder="0"></iframe>
               </div>
            </div>
         </div>
      </div>
      <div id="loader" style="display:none"></div>
      <script type='text/javascript'>//<![CDATA[
         $('#beasiswa-5').hide();
         
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
          // $(window).scroll(function() {
          //     if ($(".navbar").offset().top > 50) {
          //         $(".navbar-fixed-top").addClass("top-nav-collapse");
          //     } else {
          //         $(".navbar-fixed-top").removeClass("top-nav-collapse");
          //     }
          // });
         
         
          // jQuery for page scrolling feature - requires jQuery Easing plugin
          // $(function() {
          //     $('a.page-scroll').bind('click', function(event) {
          //         var $anchor = $(this);
          //         $('html, body').stop().animate({
          //             scrollTop: $($anchor.attr('href')).offset().top
          //         }, 1500, 'easeInOutExpo');
          //         event.preventDefault();
          //     });
          // });
         
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
         
         //  $('.modal-content').resizable({
         //   //alsoResize: ".modal-dialog",
         //   minHeight: 300,
         //   minWidth: 300
         // });
         
         // $('.modal-dialog').draggable();
         
         $('#loginModal').on('show.bs.modal', function() {
           $('#modal-title-login').html('Silahkan Login'); 
           $(this).find('.modal-body').css({
             'max-height': '100%'
           });
         });

        
         
      </script>
	
   </body>
     <div class="navbar navbar-default navbar-fixed-bottom" style="background:#0a2560;">
			<div class="container">
                <div class="row-md-6 row-lg-6">
                   	<p class="navbar-text pull-left" style="font-size:12px; color:#ffffff; style="text-align:center"> Hak Cipta <i class="fa fa-copyright"></i> Dinas Pendidikan Provinsi Jambi. BTIKP. All right reserved. 
					</p>
					 <div id="backtotop" class="backtotop"><a href="#"></a></div>
				</div>
				
			</div>
		</div>
</html>