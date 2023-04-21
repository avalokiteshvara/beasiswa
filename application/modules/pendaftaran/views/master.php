<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="sistem beasiswa">
  <meta name="keyword" content="sistem beasiswa, scholarship system">
  <meta name="author" content="">
  <title>Sistem Beasiswa Provinsi Jambi</title>
  <!-- Bootstrap Core CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/css/bootstrap.min.css" />
  <link href="<?php echo site_url('assets/pendaftaran/css/bootstrap-nav-wizard.min.css'); ?>" rel="stylesheet" type="text/css">

  <!-- Custom CSS -->
  <link href="<?php echo site_url('assets/pendaftaran/css/grayscale.css') ?>" rel="stylesheet">
  <link rel="shortcut icon" href="<?php echo site_url('assets/pendaftaran/img/favicon.ico') ?>" type="image/x-icon">
  <link rel="icon" href="<?php echo site_url('assets/pendaftaran/img/favicon.ico'); ?>" type="image/x-icon">
  <!-- Custom Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" />
  <link href="<?php echo site_url('assets/pendaftaran/css/lora.css'); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo site_url('assets/pendaftaran/css/montserrat.css'); ?>" rel="stylesheet" type="text/css">
  <!-- sweet alert -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/theme-default.min.css" integrity="sha512-8wU/gsExpTv8PS32juUjuZx10OBHgxj5ZWoVDoJKvBrFy524wEKAUgS/64da3Qg4zD5kVwQh3+xFmzzOzFDAtg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
     <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
     <![endif]-->

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit&hl=id" async defer></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
  <script src="<?php echo site_url('assets/pendaftaran/js/grayscale.js'); ?>"></script>
  <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/jquery.form-validator.min.js" integrity="sha512-7+hQkXGIswtBWoGbyajZqqrC8sa3OYW+gJw5FzW/XzU/lq6kScphPSlj4AyJb91MjPkQc+mPQ3bZ90c/dcUO5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
    var myLanguage = {
      requiredField: 'Input ini dibutuhkan',
      errorTitle: 'Gagal mengirimkan formulir!',
      requiredFields: 'Anda belum menjawab semua input yang dibutuhkan',
      badTime: 'Anda belum memberikan waktu yang benar',
      badEmail: 'Alamat email tidak valid',
      badTelephone: 'Anda belum memberikan nomor telepon yang benar',
      badSecurityAnswer: 'Anda belum memberikan jawaban yang benar untuk pertanyaan keamanan',
      badDate: 'Anda belum memberikan tanggal yang benar',
      lengthBadStart: 'Nilai input harus antara ',
      lengthBadEnd: ' karakter',
      lengthTooLongStart: 'Nilai input lebih panjang dari ',
      lengthTooShortStart: 'Nilai input lebih pendek dari ',
      notConfirmed: 'Nilai input tidak dapat dikonfirmasi',
      badDomain: 'Nilai domain salah',
      badUrl: 'Nilai input bukan URL yang benar',
      badCustomVal: 'Nilai input salah',
      andSpaces: ' dan spasi ',
      badInt: 'Nilai input bukan angka yang benar',
      badSecurityNumber: 'Nomor keamanan sosial Anda salah',
      badUKVatAnswer: 'Nomor VAT UK salah',
      badStrength: 'Kata sandi tidak cukup kuat',
      badNumberOfSelectedOptionsStart: 'Anda harus memilih setidaknya ',
      badNumberOfSelectedOptionsEnd: ' jawaban',
      badAlphaNumeric: 'Nilai input hanya dapat mengandung karakter alfanumerik ',
      badAlphaNumericExtra: ' dan ',
      wrongFileSize: 'File yang ingin Anda unggah terlalu besar (maksimum %s)',
      wrongFileType: 'Hanya file dengan tipe %s yang diizinkan',
      groupCheckedRangeStart: 'Silakan memilih antara ',
      groupCheckedTooFewStart: 'Silakan memilih setidaknya ',
      groupCheckedTooManyStart: 'Silakan memilih maksimum ',
      groupCheckedEnd: ' item',
      badCreditCard: 'Nomor kartu kredit tidak benar',
      badCVV: 'Nomor CVV tidak benar',
      wrongFileDim: 'Dimensi gambar tidak benar,',
      imageTooTall: 'gambar tidak boleh lebih tinggi dari',
      imageTooWide: 'gambar tidak boleh lebih lebar dari',
      imageTooSmall: 'gambar terlalu kecil',
      min: 'minimum',
      max: 'maksimum',
      imageRatioNotAccepted: 'Rasio gambar tidak diterima'
    };
  </script>

  <style type="text/css">
    .ui-autocomplete-loading {
      background: white url("<?php echo site_url('assets/pendaftaran/img/ui-anim_basic_16x16.gif'); ?>") right center no-repeat;
    }
  </style>
  <style type="text/css">
    div.text-container {
      margin: 0 auto;
      width: 75%;
    }

    .hideContent {
      overflow: hidden;
      line-height: 1em;
      height: 2em;
    }

    .showContent {
      line-height: 1em;
      height: auto;
    }

    .showContent {
      height: auto;
    }

    h1 {
      font-size: 24px;
    }

    p {
      padding: 0px 0;
    }

    .show-more {
      padding: 10px 0;
      text-align: center;
    }

    .collapsed {
      height: 50px;
      overflow: hidden
    }

    /* .g-recaptcha {
      transform: scale(0.79);
      transform-origin: 0 0;

    } */
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
        <a class="navbar-brand page-scroll" href="<?php echo site_url('web') ?>">
          <i class="fa fa-play-circle"></i> <span class="light">Sistem Beasiswa</span> Provinsi Jambi 2018
        </a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
        <ul class="nav navbar-nav">
          <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
          <li class="hidden active">
            <a href="#page-top"></a>
          </li>

          <li>
            <a class="page-scroll" href="<?php echo site_url('web') ?>">Kembali ke halaman depan</a>
          </li>

        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
  </nav>

  <style>
    @media screen and (min-width: 992px) {
      .sticky-top {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
      }
    }
  </style>

  <section id="daftar-beasiswa" class="content-section">
    <div class="container">
      <br />
      <div class="col-lg-12">
        <div class="panel panel-success">
          <div class="panel-body hitam">
            <div id="exTab1">
              <ul class="nav nav-pills" style="padding-bottom:5px">
              </ul>

              <div class="alert alert-danger text-center" role="alert" id="alert-tutup">
                <h3 style="margin-bottom: 0%;">Pendaftaran telah ditutup.</h3>
              </div>

              <div class="tab-content clearfix">
                <div class="tab-pane active" id="1a">
                  <div class="row">
                    <ul class="nav nav-wizard" style="padding-bottom:5px;padding-left:10px">
                      <li id="nav-wizard-nik"><a href="<?php echo site_url('pendaftaran/ubah-nik/' . base64url_encode($this->uri->segment(3))) ?>">Input NIK</a></li>
                      <li id="nav-wizard-form"><a href="#">Form Pendaftaran</a></li>
                      <li id="nav-wizard-selesai"><a href="#">Selesai</a></li>
                    </ul>
                    <hr />
                    <div class="col-md-5 sticky-top">
                      <div class="alert alert-block alert-success">

                        <h4 class="element-invisible text-center">Persyaratan & Ketentuan<br /><?php echo $detail['nama'] ?></h4>
                        <?php echo $detail['persyaratan'] ?>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="alert alert-block alert-warning">

                        <h4 class="element-invisible text-center">Perhatian</h4>
                        <ol>
                          <li>NIK harus kode wilayah di Provinsi Jambi </li>
                          <li>
                            Alamat E-mail dan Nomor handphone (WhatsApp) WAJIB ada dan masih aktif,
                            karena sistem akan mengirimkan informasi pendaftaran melalui akun email peserta atau WhatsApp .
                          </li>
                        </ol>
                      </div>

                      <?php if (has_alert()) :
                        foreach (has_alert() as $type => $message) : ?>
                          <div class="alert alert-dismissible <?php echo $type; ?>">
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                            <?php echo $message; ?>
                          </div>
                      <?php endforeach;
                      endif; ?>



                      <form aria-label="" role="form" name="form-nik" id="form-nik" action="" method="post">
                        <div id="nik-part">
                          <div class="form-group">
                            <label for="nik">Nomor Induk Kependudukan</label>
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan Nomor Induk Kependudukan" data-validation="required number" data-validation-error-msg="NIK tidak valid">
                          </div>
                        </div>
                        <?php if ($detail['level_penerima'] === 'dosen') { ?>
                          <div id="nidn-part">
                            <div class="form-group">
                              <label for="nidn">Nomor Induk Dosen Nasional</label>
                              <input type="text" class="form-control" id="nidn" name="nidn" placeholder="Masukkan Nomor Induk Dosen Nasional" data-validation="required number length" data-validation-length="10-10" data-validation-error-msg="NIDN tidak valid">
                            </div>
                          </div>
                        <?php } ?>
                        <button type="submit" class="btn btn-primary pull-right" name="submit" value="submit-nik">Lanjut</button>
                      </form>



                      <style>
                        #loader {
                          display: none;
                          position: fixed;
                          top: 0;
                          left: 0;
                          right: 0;
                          bottom: 0;
                          background-color: rgba(0, 0, 0, 0.5);
                          z-index: 9999;
                        }

                        .spinner {
                          position: absolute;
                          top: 42%;
                          left: 50%;
                          margin: -25px 0 0 -25px;
                          border: 5px solid #f3f3f3;
                          border-top: 5px solid #3498db;
                          border-radius: 50%;
                          width: 50px;
                          height: 50px;
                          animation: spin 1s linear infinite;
                        }

                        .text {
                          position: absolute;
                          top: 50%;
                          left: 50%;
                          transform: translate(-50%, -50%);
                          color: #fff;
                          font-size: 24px;
                        }

                        @keyframes spin {
                          0% {
                            transform: rotate(0deg);
                          }

                          100% {
                            transform: rotate(360deg);
                          }
                        }
                      </style>



                      <form aria-label="" role="form" name="form-signup" id="form-signup" action="" method="post">
                        <?php if ($detail['level_penerima'] === 'pelajar') { ?>
                          <!-- pelajar part -->
                          <div id="form-part">
                            <div class="form-group">
                              <label for="nik">NIK</label>
                              <input type="text" name="nik" class="form-control" placeholder="" tabindex="1" value="<?php echo $this->session->userdata('nik') ?>" readonly>
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

                            </div>
                            <div class="row">
                              <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                  <label for="kelas">Kelas</label>
                                  <select name="kelas" class="form-control" data-validation="required">
                                    <option value="">Pilih kelas</option>
                                    <?php $kelas = explode(',', $detail['kelas']);
                                    foreach ($kelas as $kls) { ?>
                                      <option value="<?php echo $kls; ?>"><?php echo ucfirst(terbilang($kls)); ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                  <label for="semester">Semester</label>
                                  <select name="semester" class="form-control" data-validation="required">
                                    <option value="">Pilih semester</option>
                                    <?php $semester = explode(',', $detail['semester']);
                                    foreach ($semester as $smt) { ?>
                                      <option value="<?php echo $smt; ?>"><?php echo ucfirst(terbilang($smt)); ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- /pelajar part -->
                        <?php } else { ?>
                          <!--  ================= mahasiswa ======================-->

                          <div id="form-part">

                            <div class="panel panel-primary">
                              <div class="panel-heading">
                                <h3 class="panel-title">Data Pribadi</h3>
                              </div>
                              <div class="panel-body">

                                <div class="form-group">
                                  <label for="nik">NIK</label>
                                  <input type="text" name="nik" class="form-control" placeholder="" tabindex="1" value="<?php echo $this->session->userdata('nik') ?>" readonly>
                                </div>

                                <div class="form-group">
                                  <label for="nama_lengkap">Nama lengkap (Beserta gelar jika ada)</label>
                                  <input tabindex="2" type="text" class="form-control" id="nama_lengkap" value="<?php echo $this->session->userdata('nama'); ?>" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" data-validation="required">
                                </div>

                                <div class="form-group">
                                  <label for="jk">Jenis kelamin</label>
                                  <select tabindex="3" name="jk" class="form-control" data-validation="required">
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                  </select>
                                </div>

                                <?php if ($detail['level_penerima'] === 'dosen') { ?>
                                  <div class="form-group">
                                    <label for="nidn">NIDN</label>
                                    <input tabindex="4" type="text" name="nidn" class="form-control" placeholder="" value="<?php echo $this->session->userdata('nidn') ?>" readonly>
                                  </div>

                                  <div class="form-group">
                                    <label for="nidn">Perguruan Tinggi</label>
                                    <input tabindex="5" type="text" name="lembaga_kerja" class="form-control" placeholder="" value="<?php echo $this->session->userdata('pt_dinas') ?>">
                                  </div>

                                  <div class="form-group">
                                    <label for="nidn">Program Studi</label>
                                    <input tabindex="6" type="text" name="prodi_kerja" class="form-control" placeholder="" value="<?php echo $this->session->userdata('prodi_dinas') ?>">
                                  </div>

                                <?php } ?>

                                <div class="panel panel-info">
                                  <div class="panel-heading">
                                    <h3 class="panel-title">Alamat</h3>
                                  </div>
                                  <div class="panel-body">
                                    <div class="form-group">
                                      <label for="select_wilayah">Desa/Kelurahan</label>
                                      <select tabindex="7" id="select_wilayah" name="select_wilayah" class="form-control" data-validation="required"></select>
                                    </div>

                                    <input type="hidden" name="wilayah" id="wilayah">

                                    <div class="form-group">
                                      <label for="alamat_rumah">Alamat lengkap</label>
                                      <input tabindex="8" type="text" class="form-control" id="alamat_rumah" name="alamat_rumah" placeholder="Masukkan Alamat rumah" data-validation="required">
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                      <label for="kota_lahir">Kota lahir</label>
                                      <input tabindex="9" type="text" name="kota_lahir" class="form-control " placeholder="Kota lahir" value="" data-validation="required">
                                    </div>
                                  </div>
                                  <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                      <label for="tgl_lahir">Tanggal lahir</label>
                                      <input tabindex="10" name="tgl_lahir" class="form-control " placeholder="Tanggal lahir (Misal : 26/12/1980)" value="" data-validation="birthdate" data-validation-format="dd/mm/yyyy" data-validation-help="format : tgl/bln/thn (misal : 26/11/1985)">
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                      <label for="no_hp">Nomor handphone</label>
                                      <input tabindex="11" type="text" name="no_hp" class="form-control " placeholder="Nomor handphone" value="" data-validation="required number length" data-validation-length="10-13">
                                    </div>
                                  </div>
                                  <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                      <label for="email">Email</label>
                                      <input tabindex="12" type="email" name="email" class="form-control " placeholder="Alamat email" value="" data-validation="email required">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="panel panel-primary">
                              <div class="panel-heading">
                                <h3 class="panel-title">Data Studi</h3>
                              </div>
                              <div class="panel-body">
                                <div class="form-group">
                                  <label for="nama_lembaga">Perguruan tinggi</label>
                                  <input tabindex="13" type="text" name="nama_lembaga" class="form-control nama_lembaga" placeholder="Nama Perguruan Tinggi" value="" data-validation="required">

                                </div>


                                <div class="row">
                                  <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                      <label for="jenis_jurusan">Jenis Jurusan</label>
                                      <select tabindex="14" name="jenis_jurusan" class="form-control" data-validation="required">
                                        <option value="">Pilih jenis jurusan</option>
                                        <option value="eksakta">Eksakta</option>
                                        <option value="non_eksakta">Non Eksakta</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                      <label for="program_studi">Program studi</label>
                                      <input tabindex="15" type="text" name="program_studi" class="form-control " placeholder="Program studi" value="" data-validation="required">
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="akreditasi">Akreditasi</label>
                                  <select tabindex="16" name="akreditasi" class="form-control" data-validation="required">
                                    <option value="">Pilih akreditasi</option>
                                    <?php $akreditasi = explode(',', $detail['akreditasi']);
                                    foreach ($akreditasi as $akr) { ?>
                                      <option value="<?php echo $akr; ?>"><?php echo $akr; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>


                                <div class="row">
                                  <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                      <label for="semester">Semester</label>
                                      <select tabindex="17" name="semester" class="form-control" data-validation="required">
                                        <option value="">Pilih semester</option>
                                        <?php $semester = explode(',', $detail['semester']);
                                        foreach ($semester as $smt) { ?>
                                          <option value="<?php echo $smt; ?>"><?php echo ucfirst(terbilang($smt)); ?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-xs-12 col-sm-6 col-md-6">

                                    <div class="form-group">
                                      <label for="ip_semester">Indeks Prestasi Kumulatif (IPK) *</label>
                                      <?php $ip_minimal = explode(':', $detail['ip_minimal']); ?>

                                      <?php if ($detail['strict_ip_minimal'] === 'N') { ?>
                                        <input tabindex="18" type="text" name="ip_semester" class="form-control" placeholder="IIndeks Prestasi Kumulatif (IPK)" tabindex="6" value="" data-validation="number required" data-validation-allowing="range[1.0;4.0],float" data-validation-decimal-separator="," data-validation-error-msg="Nilai IPK tidak valid" data-validation-help="pisahkan desimal dengan koma (',')">
                                        <?php if ($ip_minimal[0] == $ip_minimal[1]) { ?>
                                          <p class="help-block"><?php echo "* IPK minimal untuk beasiswa ini adalah " . $ip_minimal[0] . " untuk non eksakta, namun jika anda memiliki prestasi non akademik, anda dapat memasukkan nilai dibawah itu (lihat persyaratan & ketentuan diatas)" ?></p>
                                        <?php } else { ?>
                                          <p class="help-block"><?php echo "* IPK minimal untuk beasiswa ini adalah " . $ip_minimal[0] . " untuk eksakta dan " . $ip_minimal[1] . " untuk non eksakta, namun jika anda memiliki prestasi non akademik, anda dapat memasukkan nilai dibawah itu (lihat persyaratan & ketentuan diatas)" ?></p>
                                        <?php } ?>
                                      <?php } else { ?>
                                        <input tabindex="18" type="text" name="ip_semester" class="form-control" placeholder="Indeks Prestasi Kumulatif (IPK)" tabindex="6" value="" data-validation="number required" data-validation-depends-on="jenis_jurusan" data-validation-depends-on-value="eksakta, non_eksakta" data-validation-allowing="range[<?php echo $ip_minimal[0] ?> ;4.0],float" data-validation-decimal-separator="," data-validation-error-msg="Nilai IPK tidak valid atau dibawah ketentuan" data-validation-help="pisahkan desimal dengan koma (',')">
                                        <?php if ($ip_minimal[0] == $ip_minimal[1]) { ?>
                                          <p class="help-block"><?php echo "* IPK minimal untuk beasiswa ini adalah " . $ip_minimal[0]; ?></p>
                                        <?php } else { ?>
                                          <p class="help-block"><?php echo "* IPK minimal untuk beasiswa ini adalah " . $ip_minimal[0] . " untuk eksakta dan " . $ip_minimal[1] . " untuk non eksakta" ?></p>
                                        <?php } ?>


                                        <script>
                                          // Ambil elemen input yang akan dimodifikasi berdasarkan nama
                                          var targetField = document.querySelector('[name="ip_semester"]');

                                          // Tambahkan event listener pada elemen input `numberField`
                                          var numberField = document.querySelector('[name="jenis_jurusan"]');
                                          numberField.addEventListener('change', function() {
                                            var min = 0.0;
                                            if (numberField.value == 1) {
                                              var min = <?php echo $ip_minimal[0] ?>;
                                            } else {
                                              var min = <?php echo $ip_minimal[1] ?>;
                                            }

                                            // Modifikasi nilai atribut `data-validation-allowing` pada elemen `targetField`
                                            targetField.setAttribute('data-validation-allowing', 'range[' + min + ';4.0],float');
                                          });
                                        </script>
                                      <?php } ?>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php } ?>

                        <div class="row">
                          <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">


                            </div>
                          </div>
                          <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                              <?php echo $this->recaptcha->render() ?>
                              <br>
                              <button type="submit" class="btn btn-primary pull-right" name="submit" value="daftar">Daftar</button>
                              <a href="<?php echo site_url('pendaftaran/ubah-nik/' . base64url_encode($this->uri->segment(3))) ?>" style="margin-right: 10px;" class="btn btn-warning pull-right">
                                << Kembali</a>
                            </div>
                          </div>
                        </div>
                        <br />

                        <script>
                          // Ambil semua elemen yang memiliki tagname 'input' dan 'select'
                          var inputs = document.querySelectorAll('input, select');
                          // Inisialisasi variabel untuk menyimpan nilai tabindex
                          var tabindex = 1;
                          // Loop melalui semua elemen input dan select
                          inputs.forEach(function(elem) {
                            // Berikan nilai tabindex pada elemen input atau select saat ini
                            elem.tabIndex = tabindex;
                            // Tambahkan nilai tabindex dengan 1 untuk elemen input atau select berikutnya
                            tabindex++;
                          });
                        </script>

                      </form>

                      <div id="loader">
                        <div class="spinner"></div>
                        <div class="text">Mohon tunggu...</div>
                      </div>

                      <br />
                      <br />
                      <form aria-label="" role="form" name="form-finish" id="form-finish" action="" method="post">
                        <div class="alert alert-success" role="alert">
                          <h4>Pendaftaran berhasil !</h4>
                          * Mohon Periksa Email atau pesan pada WhatsApp anda Untuk informasi akun login anda<br />
                          <a href="<?php echo site_url() ?>" type="button" class="btn btn-success">Kembali ke halaman depan</a>

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
      Copyright <a href="http://disdik.jambiprov.go.id/">Dinas Pendidikan Provinsi Jambi</a>
    </div>
  </footer>


  <script type="text/javascript">
    $.validate({
      language: myLanguage,
      modules: 'date,logic',

      onError: function($form) {
        // tampilkan pesan error pada elemen dengan kelas "error-message"
        // $('.error-message').text('Form tidak valid. Periksa kembali isian Anda.');

        swal({
          title: 'Ada kesalahan!',
          text: 'Form tidak valid. Periksa kembali isian Anda.',
          type: 'error',
          confirmButtonText: 'Ok'
        });
      },
      onSuccess: function() {
        // validasi berhasil, lakukan tindakan yang diinginkan
        var loader = document.getElementById("loader");
        loader.style.display = "block";
      }
    });

    <?php $this->load->config('recaptcha', true); ?>

    var CaptchaCallback = function() {
      $('.g-recaptcha').each(function(index, el) {
        grecaptcha.render(el, {
          'sitekey': '<?php echo $this->config->item('recaptcha_sitekey', 'recaptcha') ?>'
        });
      });
    };

    <?php if (has_alert()) :
      foreach (has_alert() as $type => $message) : ?>
        <?php if ($type === 'alert-danger') { ?>
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

    <?php if (!$this->session->userdata('nik')) { ?>
      // $('#infoModal').modal('show');
    <?php } ?>

    <?php
    if (!$this->session->userdata('nik')) {
      echo "$('#nav-wizard-nik').addClass('active');";
      echo "$('#form-signup').remove();";
      echo "$('#form-finish').remove();";
    } else {
      if (!$this->session->userdata('email')) {
        echo "$('#nav-wizard-form').addClass('active');";
        echo "$('#form-nik').remove();";
        echo "$('#form-finish').remove();";
      } else {
        echo "$('#nav-wizard-selesai').addClass('active');";
        echo "$('#form-nik').remove();";
        echo "$('#form-signup').remove();";
        // echo "$('#nav-wizard-nik').html('<a href=\"#\">Input NIK</a> ');";
      }
    }
    ?>

    <?php if ($detail['status_pendaftaran'] === 'tutup') { ?>
      $(document).ready(function() {
        $('#tab_pendaftaran').remove();
        $('#1a').remove();
        // $('#tab_login').addClass('active');
        // $('#2a').addClass('active');
      })
    <?php } else { ?>
      $('#alert-tutup').remove();
    <?php } ?>


    $(".nama_lembaga").autocomplete({
      source: "<?php echo site_url('pendaftaran/cari_lembaga') ?>",
      minLength: 3,
      select: function(event, ui) {
        // log( "Selected: " + ui.item.value + " aka " + ui.item.id );
      }
    });



    $('#select_wilayah').select2({
      ajax: {
        url: '<?php echo base_url("api/get-wilayah"); ?>',
        dataType: 'json',
        delay: 250,
        data: function(params) {
          return {
            q: params.term, // Inputan Select2
          };
        },
        processResults: function(data) {
          return {
            results: data
          };
        },
        cache: true
      },
      placeholder: 'Pilih desa/kelurahan',
      minimumInputLength: 3,
    });


    $('#select_wilayah').on('change', function() {
      var data = $(this).select2('data')[0];
      $('#wilayah').val(data.id + ':' + data.desa + ':' + data.kec + ':' + data.kab);

    });
  </script>
</body>

</html>