<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed" >
        <nav class="sb-topnav navbar navbar-expand " style="background-color: #589BFF;">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3 text-white" href="index.html">Start APS</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars text-white"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw text-white"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="akun.php">Akun</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="login.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-white" id="sidenavAccordion" style="background-color: #AE9D9D;">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
            
                            <a class="nav-link text-white" href="?page=home">
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
                                    <a class="nav-link text-white" href="?page=datasiswa">Data Siswa</a>
                                    <a class="nav-link text-white" href="?page=dataguru">Data Guru dan Petugas</a>
                                </nav>
                            </div>
                            
                            <a class="nav-link text-white" href="?page=tambah-guru">
                                <div class="sb-nav-link-icon text-white"><i class="fas fa-chart-area"></i></div>
                                Tambah Guru/Petugas
                            </a>
                            <a class="nav-link text-white" href="?page=tambah-siswa">
                                <div class="sb-nav-link-icon text-white"><i class="fas fa-chart-area"></i></div>
                                Tambah Siswa
                            </a>
                            <a class="nav-link text-white" href="?page=daftarreset">
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
                <h1 class="mt-2">Dashboard</h1>
                    <div class="container ">
                        <div class="row justify-content-center">
                            <div class="col-md-11 p-2">
                                <div class="card shadow-lg border-0 rounded-lg mt-2">
                                    <div class="card-body rounded" style="background-color: #09B2F5;">
                                    <div class="card-body" style="background-color: #09B2F5;">
                                    <div class="float-sm-end">10/09/2024</div>
                                        <form>
                                            <div class="form-floating mb-3 col-md-5">
                                                <input class="form-control" id="inputEmail" type="text" placeholder="name@example.com" />
                                                <label for="inputEmail" style="color: #C7AAAA;">oleh : </label>
                                            </div>
                                            <div class="form-floating mb-3 col-md-5">
                                                <input class="form-control" id="inputEmail" type="number" placeholder="name@example.com" />
                                                <label for="inputEmail" style="color: #C7AAAA;">Kepada : </label>
                                            </div>
                                            <div class="form-floating mb-3 col-md-5">
                                                <input class="form-control" id="inputEmail" type="text" placeholder="name@example.com" />
                                                <label for="inputEmail" style="color: #C7AAAA;">Untuk Anda</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0 col-md-2 ms-auto p-2">
                                                <button class="btn w-100" style="background-color: #31D100; color: white;" type="submit">Tanggapi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container ">
                        <div class="row justify-content-center">
                            <div class="col-md-11 p-2">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-body rounded" style="background-color: #09B2F5;">
                                    <div class="card-body" style="background-color: #09B2F5;">
                                    <div class="float-sm-end">10/09/2024</div>
                                        <form>
                                            <div class="form-floating mb-3 col-md-5">
                                                <input class="form-control" id="inputEmail" type="text" placeholder="name@example.com" />
                                                <label for="inputEmail" style="color: #C7AAAA;">oleh : </label>
                                            </div>
                                            <div class="form-floating mb-3 col-md-5">
                                                <input class="form-control" id="inputEmail" type="number" placeholder="name@example.com" />
                                                <label for="inputEmail" style="color: #C7AAAA;">Kepada : </label>
                                            </div>
                                            <div class="form-floating mb-3 col-md-5">
                                                <input class="form-control" id="inputEmail" type="text" placeholder="name@example.com" />
                                                <label for="inputEmail" style="color: #C7AAAA;">Untuk Anda</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0 col-md-2 ms-auto p-2">
                                                <button class="btn w-100 " style="background-color: #31D100; color: white;" type="submit">Tanggapi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>