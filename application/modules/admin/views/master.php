<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>ADMIN | Beasiswa</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" integrity="sha512-YFENbnqHbCRmJt5d+9lHimyEMt8LKSNTMLSaHjvsclnZGICeY/0KYEeiHwD1Ux4Tcao0h60tdcMv+0GljvWyHg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.2.4/themes/red/pace-theme-flash.css" />

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
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
        <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

    <?php }; ?>

    <!-- Template Main CSS File -->
    <link href="<?php echo site_url('assets/manage/css/style.css'); ?>" rel="stylesheet">

    <script src="<?php echo site_url('assets/manage/js/base64.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"></script>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js" integrity="sha512-i9cEfJwUwViEPFKdC1enz4ZRGBj8YQo6QByFTF92YXHi7waCqyexvRD75S5NVTsSiTv7rKWqG9Y5eFxmRsOn0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.2.4/pace.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Cookies.js/0.3.1/cookies.js"></script>


    <!-- Include Selectize.js library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/3.0.1/js.cookie.min.js" integrity="sha512-wT7uPE7tOP6w4o28u1DN775jYjHQApdBnib5Pho4RB0Pgd9y7eSkAV1BTqQydupYDB9GBhTcQQzyNMPMV3cAew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

    <style>
        a.ditolak {
            color: #ff111f;
        }

        a.diterima {
            color: #266927;
        }

        a {
            cursor: pointer;
            cursor: hand;
        }
    </style>


</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="<?php echo site_url('admin')?>" class="logo d-flex align-items-center">

                <span class="d-none d-lg-block"><?php echo strtoupper($this->session->userdata('user_username')) ?></span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->



        <nav class="header-nav ms-auto" aria-label="">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->



                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?rounded=true&name=<?php echo $this->session->userdata('user_username') ?>" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo strtoupper($this->session->userdata('user_username')) ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo strtoupper($this->session->userdata('user_username')) ?></h6>
                            <span>Administrator</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo site_url('admin/ganti-password') ?>">
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
                                <span>Sign Out</span>
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
                <a class="nav-link collapsed" href="<?php echo site_url('admin/index') ?>">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo site_url('admin/kategori-beasiswa') ?>">
                    <i class="bi bi-grid"></i>
                    <span>Beasiswa</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo site_url('admin/jenis-dokumen') ?>">
                    <i class="bi bi-grid"></i>
                    <span>Jenis Dokumen</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo site_url('admin/web-content') ?>">
                    <i class="bi bi-grid"></i>
                    <span>Web Konten</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo site_url('admin/faq-list') ?>">
                    <i class=" bi bi-grid"></i>
                    <span>FAQ List</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo site_url('admin/data-user') ?>">
                    <i class="bi bi-grid"></i>
                    <span>Data Pengguna</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo site_url('admin/pertanyaan') ?>">
                    <i class="bi bi-grid"></i>
                    <span>Pertanyaan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo site_url('admin/settings') ?>">
                    <i class="bi bi-grid"></i>
                    <span>Settings</span>
                </a>
            </li>



        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1><?php echo $page_title ?></h1>
            <nav aria-label="">
                <?php echo $this->breadcrumbs->show(); ?>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <?php

                    $uri2 = $this->uri->segment(2);
                    if ($uri2 === 'pendaftar_ajax') { ?>

                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">Header</div>
                            <div class="card-body" id="rekap">
                                <ul>
                                    <li>Total Pendaftar&nbsp;:&nbsp;000</li>
                                    <li>Tahap Berkas&nbsp;:&nbsp;</li>
                                    <ul>
                                        <li>Diterima&nbsp;:&nbsp;000</li>
                                        <li>Ditolak&nbsp;:&nbsp;000</li>
                                    </ul>
                                    <li>Tahap Akhir&nbsp;:&nbsp;</li>
                                    <ul>
                                        <li>Diterima&nbsp;:&nbsp;000</li>
                                        <li>Ditolak&nbsp;:&nbsp;000</li>
                                    </ul>
                            </div>
                        </div>

                    <?php }

                    ?>



                    <div class="card">
                        <div class="card-body p-2">

                            <?php if (isset($output)) {
                                echo $output;
                            } else {
                                include_once($page_name . ".php");
                            } ?>
                        </div>
                    </div>

                </div>



        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            <p align="center">&copy;<strong><span>
                        <font size="2"> Biro Kesra Provinsi Jambi. 2023
                    </span></strong></font>
            </p>
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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

        function base64url_encode(data) {
            var str = base64.encode(data);
            str = str.replace('+', '-');
            str = str.replace('==', '');
            str = str.replace('=', '');

            return str.replace('/', '_');
        }

        <?php
        $uri2 = $this->uri->segment(2);
        if ($uri2 === 'pendaftar_ajax') { ?>
                (function worker() {
                    $.ajax({
                        url: '<?php echo site_url('api/rekap/' . base64url_encode($this->uri->segment(3))) ?>',
                        success: function(data) {
                            $('#rekap').html(data);
                        },
                        complete: function() {
                            setTimeout(worker, 5000);
                        }
                    });
                })();
        <?php } ?>

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