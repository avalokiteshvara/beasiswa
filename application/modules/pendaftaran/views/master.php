<html lang="en">
  <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="description" content="sistem beasiswa universitas indonesia">
     <meta name="keyword" content="sistem beasiswa universitas indonesia, scholarship University of Indonesia">
     <meta name="author" content="universitas indonesia">
     <title>Sistem Beasiswa Provinsi Jambi</title>
     <!-- Bootstrap Core CSS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/css/bootstrap.min.css" />
     <link href="<?php echo site_url('assets/pendaftaran/css/bootstrap-nav-wizard.min.css');?>" rel="stylesheet" type="text/css">

     <!-- Custom CSS -->
     <link href="<?php echo site_url('assets/pendaftaran/css/grayscale.css')?>" rel="stylesheet">
     <link rel="shortcut icon" href="<?php echo site_url('assets/pendaftaran/img/favicon.ico')?>" type="image/x-icon">
     <link rel="icon" href="<?php echo site_url('assets/pendaftaran/img/favicon.ico');?>" type="image/x-icon">
     <!-- Custom Fonts -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" />
     <link href="<?php echo site_url('assets/pendaftaran/css/lora.css');?>" rel="stylesheet" type="text/css">
     <link href="<?php echo site_url('assets/pendaftaran/css/montserrat.css');?>" rel="stylesheet" type="text/css">
     <!-- sweet alert -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

     <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
     <!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
     <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
     <![endif]-->
     <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script> -->
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     <!-- <script type="text/javascript" src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script> -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
     <script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit&hl=id" async defer></script>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/js/bootstrap.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
     <script src="<?php echo site_url('assets/pendaftaran/js/grayscale.js');?>"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

     <!-- select2 -->
     <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> -->
     <!-- <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/select2/select2-bootstrap-theme/8f833863/dist/select2-bootstrap.min.css"> -->
     <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> -->

     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

     <style type="text/css">
       .ui-autocomplete-loading {
          background: white url("<?php echo site_url('assets/pendaftaran/img/ui-anim_basic_16x16.gif');?>") right center no-repeat;
        }
     </style>
     <style type="text/css">
        div.text-container { margin: 0 auto; width: 75%; }
        .hideContent { overflow: hidden; line-height: 1em; height: 2em; }
        .showContent { line-height: 1em; height: auto; }
        .showContent { height: auto; }
        h1 { font-size: 24px; }
        p { padding: 0px 0; }
        .show-more { padding: 10px 0; text-align: center; }
        .collapsed {height:50px; overflow:hidden}
        /*#daftar-berita{ background-color: #f4f4f4; padding-bottom: 10px; }
        #daftar-berita h4{ color:#111; }
        #daftar-berita .container{ padding: 10px 10px 10px 10px; }

        #login-dp{ min-width: 250px; padding: 14px 14px 0;  overflow:hidden; background-color:#2a6496; }
        #login-dp .help-block{ font-size:12px }
        #login-dp .bottom{ background-color:rgba(255,255,255,.8); border-top:1px solid #ddd; clear:both; padding:14px; }
        #login-dp .social-buttons{  margin:12px 0 }
        #login-dp .social-buttons a{  width: 49%; }
        #login-dp .form-group { margin-bottom: 10px; }

        @media(max-width:768px){
            #login-dp{
                background-color: inherit;
                color: #fff;
            }
            #login-dp .bottom{
                background-color: inherit;
                border-top:0 none;
            }
        }*/

       
     </style>
  </head>
   <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" style="color: #333;">


      <!-- Navigation -->
      <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
         <div class="container">
         </div>
         <div class="container-fluid">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
               <i class="fa fa-bars"></i>
               </button>
               <a class="navbar-brand page-scroll" href="<?php echo site_url('web')?>">
               <i class="fa fa-play-circle"></i>  <span class="light">Sistem Beasiswa</span> Provinsi Jambi 2018
               </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
               <ul class="nav navbar-nav">
                  <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                  <li class="hidden active">
                     <a href="#page-top"></a>
                  </li>
                  <!--
                     <li>
                         <a class="page-scroll" href="#about">Definisi</a>
                     </li>
                     -->
                  <li>
                     <a class="page-scroll" href="<?php echo site_url('web')?>">Kembali ke halaman depan</a>
                  </li>
                  <!-- <li class="active" id="tab_pendaftaran">
                     <a href="#1a" data-toggle="tab">Daftar</a>
                  </li>
                  <li id="tab_login">
                    <a href="#2a" data-toggle="tab">Login</a>
                  </li>
                  <li id="tab_reset">
                    <a href="#3a" data-toggle="tab">Reset Password</a>
                  </li> -->
               </ul>
            </div>
            <!-- /.navbar-collapse -->
         </div>
         <!-- /.container -->
      </nav>

      <section id="daftar-beasiswa" class="content-section">



         <!-- <div class="daftar-beasiswa-section"> -->
         <div class="container">
            <!-- <h4 class="text-center">Form Pendaftaran</h4> -->
            <br />
            <div class="col-lg-12">
               <div class="panel panel-success">
                  <div class="panel-body hitam">
                     <div id="exTab1">
                        <ul class="nav nav-pills" style="padding-bottom:5px">

                        </ul>
                        <!-- <br /> -->
                        <div class="tab-content clearfix">
                          <div class="tab-pane active" id="1a">
                            <div class="row">
                              <ul class="nav nav-wizard" style="padding-bottom:5px;padding-left:10px">
                                 <li id="nav-wizard-nik"><a href="<?php echo site_url('pendaftaran/ubah-nik/' . base64url_encode($this->uri->segment(3)))?>">Input NIK</a></li>
                                 <li id="nav-wizard-form"><a href="#">Form Pendaftaran</a></li>
                                 <li id="nav-wizard-selesai"><a href="#">Selesai</a></li>
                              </ul>
                              <hr />
                              <div class="col-md-5">
                                <div class="alert alert-block alert-success">
                                   <!-- <a class="close" data-dismiss="alert" href="#">×</a> -->
                                   <h4 class="element-invisible text-center">Persyaratan & Ketentuan<br /><?php echo $detail['nama']?></h4>
                                   <?php echo $detail['persyaratan']?>
                                </div>
                              </div>
                              <div class="col-md-7">
                                 <div class="alert alert-block alert-warning">
                                   <!-- <a class="close" data-dismiss="alert" href="#">×</a> -->
                                   <h4 class="element-invisible text-center">Perhatian</h4>
                                   <ol>
                                      <li>NIK harus kode wilayah di Provinsi Jambi </li>
                                      <li>Alamat E-mail WAJIB ada dan masih aktif, karena sistem akan mengirimkan informasi pendaftaran melalui akun email peserta.</li>
                                   </ol>
                                </div>

                                <?php if(has_alert()):
                                	// echo '<h4 class="element-invisible text-center alert-danger">Ada kesalahan</h4>';
                                  foreach(has_alert() as $type => $message): ?>
                                		<div class="alert alert-dismissible <?php echo $type; ?>">
                                			<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                			<?php echo $message; ?>
                                		</div>
                                	<?php endforeach;
                                endif; ?>

                               

                                <form role="form" name="form-nik" id="form-nik" action="" method="post">
                                  <div id="nik-part">
                                    <div class="form-group">
                                       <label for="nik">Nomor Induk Kependudukan</label>
                                       <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan Nomor Induk Kependudukan" data-validation="required number" data-validation-error-msg="NIK tidak valid">
                                    </div>
                                  </div>
                                  <button type="submit" class="btn btn-primary pull-right" name="submit" value="submit-nik">Lanjut</button>
                                </form>



                                <form role="form" name="form-signup" id="form-signup" action="" method="post">
                                  <?php if($detail['level_penerima'] === 'pelajar'){ ?>
                                    <!-- pelajar part -->
                                    <div id="form-part">
                                      <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" name="nik" class="form-control" placeholder="" tabindex="1" value="<?php echo $this->session->userdata('nik')?>" readonly>
                                      </div>
                                      <div class="form-group">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap" class="form-control" placeholder="" tabindex="2" value="" data-validation="required">
                                      </div>
                                      <div class="form-group">
                                        <label for="alamat_rumah">Alamat rumah</label>
                                        <input type="text" name="alamat_rumah" class="form-control" placeholder="" tabindex="3" value="" data-validation="required">
                                      </div>
                                      <div class="row">
                                         <div class="col-xs-12 col-sm-6 col-md-6">
                                           <div class="form-group">
                                             <label for="kota_lahir">Kota lahir</label>
                                             <input type="text" name="kota_lahir" class="form-control" placeholder="" tabindex="4" value="" data-validation="required">
                                           </div>
                                         </div>
                                         <div class="col-xs-12 col-sm-6 col-md-6">
                                           <div class="form-group">
                                             <label for="kota_lahir">Tanggal lahir</label>
                                             <input type="text" name="tgl_lahir" class="form-control" placeholder="tanggal/bulan/tahun" tabindex="5" value="" data-validation="birthdate" data-validation-format="dd/mm/yyyy" data-validation-help="format : tgl/bln/thn (misal : 26/11/1985)" data-validation-error-msg="Tanggal lahir tidak valid">
                                           </div>
                                         </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="jk">Jenis kelamin</label>
                                        <select name="jk" class="form-control">
                                          <option value="">Pilih jenis kelamin</option>
                                          <option value="laki-laki">Laki-laki</option>
                                          <option value="Perempuan">Perempuan</option>
                                        </select>
                                      </div>
                                      <div class="row">
                                         <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                              <label for="no_hp">Nomor handphone</label>
                                              <input type="text" name="no_hp" class="form-control " placeholder="Nomor handphone" tabindex="6" value="" data-validation="number" data-validation-error-msg="Hanya angka yang diperbolehkan">
                                            </div>
                                         </div>
                                         <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                              <label for="email">Email</label>
                                              <input type="email" name="email" class="form-control " placeholder="Alamat email" tabindex="6" value="" data-validation="email">
                                            </div>
                                         </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="nama_lembaga">Nama Sekolah</label>
                                        <input type="text" name="nama_lembaga" class="form-control nama_lembaga" placeholder="Nama Sekolah" tabindex="6" value="" data-validation="required">
                                        <!-- <select class="select2 form-control" name="nama_lembaga" data-validation="required"></select> -->
                                      </div>
                                      <div class="row">
                                         <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                              <label for="kelas">Kelas</label>
                                              <select name="kelas" class="form-control" data-validation="required">
                                                <option value="">Pilih kelas</option>
                                        <?php   $kelas = explode(',',$detail['kelas']);
                                                foreach ($kelas as $kls) { ?>
                                                <option value="<?php echo $kls;?>"><?php echo ucfirst(terbilang($kls));?></option>
                                        <?php   } ?>
                                              </select>
                                            </div>
                                         </div>
                                         <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                              <label for="semester">Semester</label>
                                              <select name="semester" class="form-control" data-validation="required">
                                                <option value="">Pilih semester</option>
                                        <?php   $semester = explode(',',$detail['semester']);
                                                foreach ($semester as $smt) { ?>
                                                <option value="<?php echo $smt;?>"><?php echo ucfirst(terbilang($smt));?></option>
                                        <?php   } ?>
                                              </select>
                                            </div>
                                         </div>
                                      </div>
                                    </div>
                                    <!-- /pelajar part -->
                                  <?php }else{ ?>
                                    <!-- mahasiswa -->
                                    <div id="form-part">
                                      <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" name="nik" class="form-control" placeholder="" tabindex="1" value="<?php echo $this->session->userdata('nik')?>" readonly>
                                      </div>
                                      <div class="form-group">
                                         <label for="nama_lengkap">Nama lengkap (Beserta gelar jika ada)</label>
                                         <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" data-validation="required">
                                      </div>
                                      <div class="form-group">
                                         <label for="alamat_rumah">Alamat rumah</label>
                                         <input type="text" class="form-control" id="alamat_rumah" name="alamat_rumah" placeholder="Masukkan Alamat rumah" data-validation="required">
                                      </div>
                                      <div class="form-group">
                                        <label for="jk">Jenis kelamin</label>
                                        <select name="jk" class="form-control" data-validation="required">
                                          <option value="">Pilih jenis kelamin</option>
                                          <option value="laki-laki">Laki-laki</option>
                                          <option value="Perempuan">Perempuan</option>
                                        </select>
                                      </div>
                                      <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                          <div class="form-group">
                                            <label for="kota_lahir">Kota lahir</label>
                                            <input type="text" name="kota_lahir" class="form-control " placeholder="Kota lahir" tabindex="6" value="" data-validation="required">
                                          </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                          <div class="form-group">
                                            <label for="tgl_lahir">Tanggal lahir</label>
                                            <input name="tgl_lahir" class="form-control " placeholder="Tanggal lahir (Misal : 26/12/1980)" tabindex="7" value="" data-validation="birthdate" data-validation-format="dd/mm/yyyy" data-validation-help="format : tgl/bln/thn (misal : 26/11/1985)" data-validation-error-msg="Tanggal lahir tidak valid">
                                          </div>
                                        </div>
                                      </div>

                                      <div class="row">
                                         <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                              <label for="no_hp">Nomor handphone</label>
                                              <input type="text" name="no_hp" class="form-control " placeholder="Nomor handphone" tabindex="6" value="" data-validation="number" data-validation-error-msg="Hanya angka yang diperbolehkan">
                                            </div>
                                         </div>
                                         <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                              <label for="email">Email</label>
                                              <input type="email" name="email" class="form-control " placeholder="Alamat email" tabindex="6" value="" data-validation="email">
                                            </div>
                                         </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="nama_lembaga">Perguruan tinggi</label>
                                        <input type="text" name="nama_lembaga" class="form-control nama_lembaga" placeholder="Nama Perguruan Tinggi" tabindex="6" value="" data-validation="required">
                                        <!-- <select class="select2 form-control" name="nama_lembaga" data-validation="required"></select> -->
                                      </div>

                                      <div class="row">
                                         <div class="col-xs-12 col-sm-6 col-md-6">
                                           <div class="form-group">
                                             <label for="program_studi">Program studi</label>
                                             <input type="text" name="program_studi" class="form-control " placeholder="Program studi" tabindex="6" value="" data-validation="required">
                                           </div>
                                         </div>
                                         <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                              <label for="akreditasi">Akreditasi</label>
                                              <select name="akreditasi" class="form-control" data-validation="required">
                                                <option value="">Pilih akreditasi</option>
                                        <?php   $akreditasi = explode(',',$detail['akreditasi']);
                                                foreach ($akreditasi as $akr) { ?>
                                                <option value="<?php echo $akr;?>"><?php echo $akr;?></option>
                                        <?php   } ?>
                                              </select>
                                            </div>
                                         </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                              <label for="semester">Semester</label>
                                              <select name="semester" class="form-control" data-validation="required">
                                                <option value="">Pilih semester</option>
                                        <?php   $semester = explode(',',$detail['semester']);
                                                foreach ($semester as $smt) { ?>
                                                <option value="<?php echo $smt;?>"><?php echo ucfirst(terbilang($smt));?></option>
                                        <?php   } ?>
                                              </select>
                                            </div>
                                         </div>
                                         <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                              <div class="form-group">
                                                <label for="ip_semester">Index Prestasi (IP) Semester *</label>
                                          <?php if($detail['strict_ip_minimal'] === 'N'){ ?>
                                                <input type="text" name="ip_semester" class="form-control" placeholder="Indeks Prestasi (IP) Semester" tabindex="6" value="" data-validation="number" data-validation-allowing="range[1.0;4.0],float" data-validation-decimal-separator="," data-validation-error-msg="Nilai IP tidak valid" data-validation-help="pisahkan desimal dengan koma (',')">
                                                <p class="help-block"><?php echo "* IP Semester minimal untuk beasiswa ini adalah " . $detail['ip_minimal'] . " , namun jika anda memiliki prestasi non akademik, anda dapat memasukkan nilai dibawah itu (lihat persyaratan & ketentuan diatas)"?></p>
                                          <?php }else{ ?>
                                                <input type="text" name="ip_semester" class="form-control" placeholder="Indeks Prestasi (IP) Semester" tabindex="6" value="" data-validation="number" data-validation-allowing="range[<?php echo $detail['ip_minimal']?>;4.0],float" data-validation-decimal-separator="," data-validation-error-msg="Nilai IP tidak valid atau dibawah ketentuan" data-validation-help="pisahkan desimal dengan koma (',')">
                                          <?php } ?>
                                              </div>
                                            </div>
                                         </div>

                                      </div>

                                    </div>
                                  <?php } ?>

                                   <?php echo $this->recaptcha->render() ?>
                                   <br />
                                   <button type="submit" class="btn btn-primary pull-right" name="submit" value="daftar">Daftar</button>
                                   <a href="<?php echo site_url('pendaftaran/ubah-nik/' . base64url_encode($this->uri->segment(3)))?>"  style="margin-right: 10px;" class="btn btn-warning pull-right">Ubah NIK</a>
                                </form>
                                <br />
                                <br />
                                <form role="form" name="form-finish" id="form-finish" action="" method="post">
                                  <div class="alert alert-success" role="alert">
                                    <h4>Pendaftaran berhasil !</h4>
                                    * Mohon Periksa Email Anda Untuk informasi akun login anda
                                  </div>
                                </form>

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
      <footer>
         <div class="container text-center">
            Copyright ©  2018 <a href="http://disdik.jambiprov.go.id/">Dinas Pendidikan Provinsi Jambi</a>
         </div>
      </footer>


      <!-- Modal -->
      <!-- <div id="infoModal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="color: black">          
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Informasi</h4>
            </div>
            <div class="modal-body">
              <ol>
                <li>NIK harus kode wilayah di Provinsi Jambi </li>
                <li>Alamat E-mail WAJIB ada dan masih aktif, karena sistem akan mengirimkan informasi pendaftaran melalui akun email peserta.</li>
              </ol>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>
 -->
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


        // Add custom validation rule
        // $.formUtils.addValidator({
        //   name : 'isProvjambi',
        //   validatorFunction : function(value, $el, config, language, $form) {
        //     return parseInt(value, 10) % 2 === 0;
        //   },
        //   errorMessage : 'You have to answer with an even number',
        //   errorMessageKey: 'badEvenNumber'
        // });


        $.validate({
            language : myLanguage,
            modules : 'date'
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
                text: 'Mohon perbaiki kesalahan sebelum melanjutkan',
                type: 'error',
                confirmButtonText: 'Ok'
            });

          <?php } ?>
          <?php endforeach;
        endif; ?>

        // jQuery to collapse the navbar on scroll
        $(window).scroll(function() {
            if ($(".navbar").offset().top > 50) {
                $(".navbar-fixed-top").addClass("top-nav-collapse");
            } else {
                $(".navbar-fixed-top").removeClass("top-nav-collapse");
            }
        });

        <?php if(!$this->session->userdata('nik')){ ?>
        // $('#infoModal').modal('show');
        <?php } ?>

        <?php
        if(!$this->session->userdata('nik')){
          echo "$('#nav-wizard-nik').addClass('active');";
          echo "$('#form-signup').remove();";
          echo "$('#form-finish').remove();";

        }else{
          if(!$this->session->userdata('email')){
            echo "$('#nav-wizard-form').addClass('active');";
            echo "$('#form-nik').remove();";
            echo "$('#form-finish').remove();";
          }else{
            echo "$('#nav-wizard-selesai').addClass('active');";
            echo "$('#form-nik').remove();";
            echo "$('#form-signup').remove();";
            // echo "$('#nav-wizard-nik').html('<a href=\"#\">Input NIK</a> ');";
          }
        }
        ?>

        <?php if($detail['status_pendaftaran'] === 'tutup'){ ?>
          $( document ).ready(function() {
            $('#tab_pendaftaran').remove();
            $('#1a').remove();
            $('#tab_login').addClass('active');
            $('#2a').addClass('active');
          })
        <?php } ?>


        $( ".nama_lembaga" ).autocomplete({
            source: "<?php echo site_url('pendaftaran/cari_lembaga')?>",
            minLength: 3,
            select: function( event, ui ) {
              // log( "Selected: " + ui.item.value + " aka " + ui.item.id );
            }
          });

        // $('.select2').select2({
        //   ajax: {
        //     url: '<?php echo site_url('pendaftaran/cari_lembaga')?>',
        //     dataType: 'json',
        //     delay:250
        //     // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
        //   },
        //   placeholder : 'Silahkan cari nama kampus anda',
        //   minimumInputLength : 1
        // });

      </script>
   </body>
</html>