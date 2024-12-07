<?php
//Cegah akses login jika sudah login
if ( $this->session->userdata('level')=== 'admin') {
    redirect(site_url('pages/home')); 
}elseif ($this->session->userdata('level')=== 'guru') {
    redirect(site_url('pages3/home')); 
}elseif ($this->session->userdata('logged_in')) {
    redirect(site_url('pages2/home')); 
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>
        <link href="<?= base_url('assets/dist/css-sb/styles.css')?>" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
                                <img src="<?= base_url('assets/dist/image/smk.jpg')?>" class="img-fluid mb-3 " style="max-width: 100%; height: auto;">
                                <h5 class="text-center" style="color: #09B2F5;"><b>APLIKASI PENGADUAN SISWA</b></h5>
                            </div>

                            <!-- Form login berada di sebelah kanan pada desktop, dan bawah pada mobile -->
                            <div class="col-12 col-md-6 mb-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-body rounded" style="background-color: #09B2F5;">
                                        <?php if ($this->session->flashdata('error')): ?>
                                            <div class="alert alert-danger">
                                                <?php echo $this->session->flashdata('error'); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($this->session->flashdata('success')): ?>
                                            <div class="alert alert-success">
                                                <?php echo $this->session->flashdata('success'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <form action="<?= site_url('tambah_data/reset_passwordform'); ?>" method="post">
                                            <h3 class="text-left font-weight-light my-4 text-light">Pengajuan Reset</h3>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="nis" id="inputEmail" type="number" placeholder="Masukkan NIS" />
                                                <label for="inputEmail" style="color: #C7AAAA;">Masukkan NIS</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="username" id="inputUsername" type="text" placeholder="Masukkan Username" />
                                                <label for="inputUsername" style="color: #C7AAAA;">Masukkan Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="nama_lengkap" id="inputUsername" type="text" placeholder="Masukkan Nama Lengkap" />
                                                <label for="inputUsername" style="color: #C7AAAA;">Masukkan Nama Lengkap</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="kelas" id="inputEmail" type="text" placeholder="Masukkan kelas(ex. XII RPL 1)" />
                                                <label for="inputEmail" style="color: #C7AAAA;">Masukkan kelas(ex. XII RPL 1)</label>
                                            </div>
                                            <a href="<?= site_url('pertama/index'); ?>" style="color: white;"> Login?</a>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn w-100" style="background-color: #2F45F1; color: white;" type="submit">Kirim Pengajuan</button>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <script>
                function togglePasswordVisibility(inputId, iconId) {
                    const inputField = document.getElementById(inputId);
                    const iconField = document.getElementById(iconId);

                    if (inputField.type === "password") {
                        inputField.type = "text";
                        iconField.classList.remove("bi-eye-slash");
                        iconField.classList.add("bi-eye");
                    } else {
                        inputField.type = "password";
                        iconField.classList.remove("bi-eye");
                        iconField.classList.add("bi-eye-slash");
                    }
                }
            </script>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="<?= base_url('assets/dist/js-sb/scripts.js')?>"></script>
    </body>
</html>
