<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<div class="container">
        <form method="post" action="<?= site_url('tambah_data/upload_excel') ?>" enctype="multipart/form-data">
        <div class="d-flex justify-content-start align-items-center mt-2">
            <label class="btn btn-primary d-flex justify-content-center align-items-center" style="max-width: 8rem; max-height: 2rem;">
                <i class="fas fa-plus me-2"></i>Data Excel
                <input type="file" name="file_excel" accept=".xlsx, .xls" style="display: none;">
            </label>
        </div>
    </form>
        <div class="row justify-content-center">

        <div class="col-lg-6 p-2 d-flex align-items-start">
            <!-- Tombol di sebelah kiri form dengan ikon, warna primary, dan jarak 100px -->
            

            <div class="card shadow-lg border-0 rounded-lg w-100 ">
                <div class="card-body rounded" style="background-color: #09B2F5;">
                    <!-- Form dimulai di sini -->
                    <form method="post" action="<?php echo site_url('tambah_data/store2'); ?>">
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                        <?php elseif ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                        <?php endif; ?>
                        
                        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        <h3 class="text-left font-weight-light my-4 text-light">TAMBAH DATA SISWA</h3>
                        <div class="form-floating mb-3">
                            <input class="form-control"value="<?= set_value('username'); ?>" name="username" id="inputEmail" type="text" placeholder="name@example.com" />
                            <span class="text-danger"><?= $this->session->flashdata('error_username'); ?></span>
                            <label for="inputEmail" style="color: #C7AAAA;">Masukkan Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" value="<?= set_value('nis'); ?>" name="nis" id="inputNIS" type="number" placeholder="Masukkan NIS" />
                            <span class="text-danger"><?= $this->session->flashdata('error_nis'); ?></span>
                            <label for="inputNIS" style="color: #C7AAAA;">Masukkan NIS</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" value="<?= set_value('nama'); ?>" name="nama" id="inputNama" type="text" placeholder="Masukkan Nama Lengkap" />
                            <span class="text-danger"><?= $this->session->flashdata('error_nama'); ?></span>
                            <label for="inputNama" style="color: #C7AAAA;">Masukkan Nama Lengkap</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" value="<?= set_value('kelas'); ?>" name="kelas" id="inputKelas" type="text" placeholder="Masukkan Kelas" />
                            <span class="text-danger"><?= $this->session->flashdata('error_kelas'); ?></span>
                            <label for="inputKelas" style="color: #C7AAAA;">Masukkan Kelas(ex. XII RPL 1)</label>
                        </div>
                        
                        <div class="form-floating mb-3 position-relative">
                            <input 
                                class="form-control" 
                                value="<?= set_value('password'); ?>" 
                                name="password" 
                                id="inputPassword" 
                                type="password" 
                                placeholder="Password" />
                            <label for="inputPassword" style="color: #C7AAAA;">Masukkan Password (*minimal 6 karakter)</label>
                            <span class="text-danger"><?= $this->session->flashdata('error_password'); ?></span>
                            <!-- Icon toggle visibility -->
                            <span class="position-absolute end-0 top-50 translate-middle-y pe-3" style="cursor: pointer;" onclick="togglePasswordVisibility('inputPassword', 'togglePasswordIcon')">
                                <i id="togglePasswordIcon" class="bi bi-eye-slash"></i>
                            </span>
                        </div>

                        <div class="form-floating mb-3 position-relative">
                            <input 
                                class="form-control" 
                                value="<?= set_value('confirmPassword'); ?>" 
                                name="confirmPassword" 
                                id="inputConfirmPassword" 
                                type="password" 
                                placeholder="Masukkan Ulang Password" />
                            <label for="inputConfirmPassword" style="color: #C7AAAA;">Masukkan Ulang Password</label>
                            <span class="text-danger"><?= $this->session->flashdata('error_confirmPassword'); ?></span>
                            <!-- Icon toggle visibility -->
                            <span class="position-absolute end-0 top-50 translate-middle-y pe-3" style="cursor: pointer;" onclick="togglePasswordVisibility('inputConfirmPassword', 'toggleConfirmPasswordIcon')">
                                <i id="toggleConfirmPasswordIcon" class="bi bi-eye-slash"></i>
                            </span>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <button class="btn w-100" style="background-color: #31D100; color: white;" type="submit">Tambah</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
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
