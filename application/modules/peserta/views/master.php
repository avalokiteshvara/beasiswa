<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>PESERTA | Beasiswa</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.ico" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" integrity="sha512-YFENbnqHbCRmJt5d+9lHimyEMt8LKSNTMLSaHjvsclnZGICeY/0KYEeiHwD1Ux4Tcao0h60tdcMv+0GljvWyHg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/red/pace-theme-flash.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

    <?php
    if (isset($css_files)) {
        foreach ($css_files as $file) : ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach;
    } else { ?>
        <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
    <?php }; ?>

    <?php
    if (isset($js_files)) {
        foreach ($js_files as $file) : ?>
            <script src="<?php echo $file; ?>"></script>
        <?php endforeach;
    } else { ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

    <?php }; ?>


    <!-- Template Main CSS File -->
    <link href="<?php echo site_url('assets/manage/css/style.css'); ?>" rel="stylesheet">


    <style type="text/css">
        .has-error .checkbox,
        .has-error .checkbox-inline,
        .has-error .control-label,
        .has-error .help-block,
        .has-error .radio,
        .has-error .radio-inline,
        .has-error.checkbox label,
        .has-error.checkbox-inline label,
        .has-error.radio label,
        .has-error.radio-inline label {
            color: #a94442;
        }
    </style>

    <script src="<?php echo site_url('assets/manage/js/base64.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block"><i class="bi bi-person-bounding-box"></i> Hi, <?php echo strtoupper(fullNameToFirstName($this->session->userdata('user_nama_lengkap'))) ?></span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
            <b><?php echo strtoupper('Peserta ' . $kat_beasiswa); ?></b>
        </div><!-- End Logo -->



        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">

                        <?php if (empty($file_foto)) { ?>
                            <img src="<?php echo site_url('uploads/foto/nofoto.jpg') ?>" alt="Profile" class="rounded-circle">

                        <?php } else { ?>
                            <img src="<?php echo site_url('uploads/foto/' . $file_foto) ?>" alt="Profile" class="rounded-circle">
                        <?php } ?>

                        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo fullNameToFirstName($this->session->userdata('user_nama_lengkap')); ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo $this->session->userdata('user_nama_lengkap'); ?></h6>
                            <span>Peserta</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo site_url('peserta/ganti-password') ?>">
                                <i class="bi bi-person"></i>
                                <span>Ganti Password</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo site_url('signout') ?>">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Keluar</span>
                            </a>
                        </li>
                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo site_url('peserta') ?>">
                    <i class="bi bi-person-vcard-fill"></i>
                    <span>Biodata</span>
                </a>
                <a class="nav-link collapsed" href="<?php echo site_url('peserta/dokumen') ?>">
                    <i class="bi bi-briefcase-fill"></i>
                    <span>Dokumen</span>
                </a>

                <a class="nav-link collapsed" href="<?php echo site_url('peserta/pertanyaan') ?>">
                    <i class="bi bi-chat-left-text-fill"></i>
                    <span>Pertanyaan</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li style="padding: 5px">
                <form id="form-foto" action="<?php echo site_url('peserta/update_foto') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <?php if (empty($file_foto)) { ?>
                            <img src="<?php echo site_url('uploads/foto/nofoto.jpg') ?>" alt="No-Foto" height="200" width="200">
                            <br />
                        <?php } else { ?>
                            <a href="<?php echo site_url('uploads/foto/' . $file_foto) ?>" target="_blank">
                                <img src="<?php echo site_url('uploads/foto/' . $file_foto) ?>" alt="File foto" height="200" width="200">
                            </a>
                            <br />
                        <?php } ?>

                        <!-- <label for="exampleInputFile">File foto</label> -->
                        <input type="file" name="file_foto_sidebar" id="file_foto_sidebar">
                        <p class="help-block">Foto (Max:512KB; Format:jpg)</p>
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

            <?php if ($status_lv1 === 'diterima') { ?>
                <li style="margin-top: 10px">
                    <a role="button" class="btn btn-info btn-block" href="<?php echo site_url('peserta/download-bukti-lulus-verifikasi') ?>">Cetak Bukti Lolos Tahap I</a>

                </li>
            <?php } ?>

            <?php if ($status_lv2 === 'diterima') { ?>
                <li style="margin-top: 10px">
                    <a role="button" class="btn btn-success btn-block" href="<?php echo site_url('peserta/download-bukti-lulus-tahap-akhir') ?>">Cetak Bukti Lolos Tahap II</a>
                </li>
            <?php } ?>




        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        <section class="section">
            <div class="row mt-2">
                <div class="col-lg-12">
                    <?php if (isset($output)) {
                        echo $output;
                    } else {
                        include $page_name . ".php";
                    } ?>
                </div>
        </section>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
       <footer id="footer" class="footer">
        <div class="copyright">
                <font size="2"><p align="center">Hak Cipta &copy; 2023.<span>
                        <a href="https://kesra.jambiprov.go.id/">Biro Kesejahteraan Masyarakat Provinsi Jambi.</a> All right reserved.
                    </span></font></br>
                    <font size="2">Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>. Developed and Supported by <a href="https://disdik.jambiprov.go.id/">BTIKP Dinas Pendidikan Provinsi Jambi</a></font>
            </p>
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
           
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js" integrity="sha512-i9cEfJwUwViEPFKdC1enz4ZRGBj8YQo6QByFTF92YXHi7waCqyexvRD75S5NVTsSiTv7rKWqG9Y5eFxmRsOn0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- Template Main JS File -->
    <script src="<?php echo site_url('assets/manage/js/main.js'); ?>"></script>

    <script type="text/javascript">
        <?php if (has_alert()) :
            foreach (has_alert() as $type => $message) : ?>
                <?php if ($type === 'alert-danger') { ?>
                    swal({
                        title: 'Ada kesalahan!',
                        text: '<?php echo $message; ?>',
                        type: 'error',
                        confirmButtonText: 'Ok'
                    });
                <?php } else { ?>
                    swal({
                        title: 'Berhasil',
                        text: '<?php echo $message; ?>',
                        type: 'success',
                        confirmButtonText: 'Ok'
                    });
                <?php } ?>
        <?php endforeach;
        endif; ?>

        // Menambahkan event listener pada dokumen
        document.addEventListener('keydown', function(event) {
            // Mengecek apakah tombol "Esc" ditekan
            if (event.key === 'Escape') {
                // Mendapatkan modal yang sedang aktif
                const modal = document.querySelector('.modal.show');
                // Menutup modal jika ditemukan
                if (modal) {
                    const modalId = modal.getAttribute('id');
                    $('#' + modalId).modal('hide');
                }
            }
        });
    </script>

</body>

</html>