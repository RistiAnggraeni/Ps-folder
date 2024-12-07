<?php
        //Cek apakah pengguna sudah login
        if (!$this->session->userdata('logged_in')) {
            // Redirect ke halaman login jika belum login
            redirect(site_url('auth_petugas'));
        }elseif ($this->session->userdata('logged_in')&& $this->session->userdata('level') === 'guru') {
            redirect(site_url('pages3/home'));
        }elseif ($this->session->userdata('level') !== 'admin' && $this->session->userdata('nis')) {
            redirect(site_url('pages2/home'));
        }
// print_r($this->session->userdata('id_petugas')); exit();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>apps</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="<?= base_url('assets/dist/css-sb/styles.css'); ?>" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed" >

        <nav class="sb-topnav navbar navbar-expand " style="background-color: #589BFF;">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3 text-white" href="index.html">Start APS</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars text-white"></i></button>
    <!-- Navbar Search-->
    
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw text-white"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?= site_url('pages/akunpet'); ?>">Akun</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="<?= site_url('auth_petugas/logout'); ?>">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-white" id="sidenavAccordion" style="background-color: #AE9D9D;">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
            
                            <a class="nav-link text-white" href="<?= site_url('pages/home'); ?>">
                                <div class="sb-nav-link-icon text-white"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            
                            <a class="nav-link collapsed text-white" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon text-white"><i class="fas fa-columns"></i></div>
                                Daftar Pengguna
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link text-white" href="<?= site_url('pages/datasiswa'); ?>">Data Siswa</a>
                                    <a class="nav-link text-white" href="<?= site_url('pages/dataguru'); ?>">Data Guru dan Petugas</a>
                                </nav>
                            </div>
                            
                            <a class="nav-link text-white" href="<?= site_url('pages/tambah-guru'); ?>">
                                <div class="sb-nav-link-icon text-white"><i class="fas fa-chart-area"></i></div>
                                Tambah Guru/Petugas
                            </a>
                            <a class="nav-link text-white" href="<?= site_url('pages/tambah-siswa'); ?>">
                                <div class="sb-nav-link-icon text-white"><i class="fas fa-chart-area"></i></div>
                                Tambah Siswa
                            </a>
                            <a class="nav-link text-white" href="<?= site_url('pages/daftarreset'); ?>">
                                <div class="sb-nav-link-icon text-white"><i class="fas fa-table"></i></div>
                                Permintaan reset password
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer text-white">
                        <div class="small">Login Sebagai:</div>
                        Admin
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    
                    <?= isset($content) ? $content : ''; ?>

                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url('assets/dist/js-sb/scripts.js'); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url('assets/dist/assets-sb/demo/chart-area-demo.js'); ?>"></script>
        <script src="<?= base_url('assets/dist/assets-sb/demo/chart-bar-demo.js'); ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url('assets/dist/js-sb/datatables-simple-demo.js'); ?>"></script>
    </body>
</html>
