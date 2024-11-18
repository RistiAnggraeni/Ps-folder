<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container-sm">
                        <div class="row justify-content-center p-2 bd-highlight">
                            <!-- Foto dan teks berada di sebelah kiri pada desktop dan atas pada mobile -->
                            <div class="col-12 col-md-4 d-flex flex-column align-items-center mt-auto mb-auto me-auto">
                                <!-- Gambar dan Judul -->
                                <img src="assets/img/smk.jpg" class="img-fluid mb-3 " style="max-width: 100%; height: auto;">
                                <h5 class="text-center" style="color: #09B2F5;"><b>APLIKASI PENGADUAN SISWA</b></h5>
                            </div>

                            <!-- Form login berada di sebelah kanan pada desktop, dan bawah pada mobile -->
                            <div class="col-12 col-md-6 mb-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-body rounded" style="background-color: #09B2F5;">
                                        <form>
                                            <h3 class="text-left font-weight-light my-4 text-light">LOGIN</h3>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="number" placeholder="Masukkan NIS" />
                                                <label for="inputEmail" style="color: #C7AAAA;">Masukkan NIS</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputUsername" type="text" placeholder="Masukkan Username" />
                                                <label for="inputUsername" style="color: #C7AAAA;">Masukkan Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" placeholder="Password" />
                                                <label for="inputPassword" style="color: #C7AAAA;">Masukkan Password</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputConfirmPassword" type="password" placeholder="Masukkan Ulang Password" />
                                                <label for="inputConfirmPassword" style="color: #C7AAAA;">Masukkan Ulang Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn w-100" style="background-color: #2F45F1; color: white;" type="submit">Login</button>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a href="loginguru.php" class="btn w-100" style="background-color: #31D100; color: white;" type="submit">Login dengan akun guru/admin</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="js/scripts.js"></script>
    </body>
</html>
