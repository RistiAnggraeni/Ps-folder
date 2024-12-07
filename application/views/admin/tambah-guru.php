                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
                    <div class="container ">
                        <button class="btn btn-primary mt-2 d-flex justify-content-start align-items-center" style="max-width: 8rem; max-height: 2rem;">
                                <i class="fas fa-plus me-2"></i>Data Excel
                            </button>
                    <div class="row justify-content-center">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 p-2">
                                <div class="card shadow-lg border-0 rounded-lg mt-2">
                                    <div class="card-body rounded" style="background-color: #09B2F5;">
                                    <div class="card-body" style="background-color: #09B2F5;">
                                        <?php if ($this->session->flashdata('success')): ?>
                                            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                                        <?php elseif ($this->session->flashdata('error')): ?>
                                            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                                        <?php endif; ?>

                                        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                                        <form method="post" action="<?php echo site_url('tambah_data/store'); ?>">
                                            <h3 class="text-left font-weight-light my-4 text-light">TAMBAH GURU/PETUGAS</h3></div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="username" id="inputUsername" type="text" placeholder="name@example.com"/>
                                                <label for="inputUsername" style="color: #C7AAAA;">Masukkan Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="nama" id="inputNama" type="text" placeholder="name@example.com" />
                                                <label for="inputNama" style="color: #C7AAAA;">Masukkan Nama Lengkap</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="mapel" id="inputMapel" type="text" placeholder="name@example.com" />
                                                <label for="inputMapel" style="color: #C7AAAA;">Masukkan Mapel/Jabatan Guru</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="no_hp" id="inputNo" type="number" placeholder="name@example.com" />
                                                <label for="inputNo" style="color: #C7AAAA;">Masukkan No HP</label>
                                            </div>
                                            <div class="form-floating mb-3 text-white">
                                                <select class="form-select" name="level" id="floatingSelect" aria-label="Floating label select example" style="color: #C7AAAA;">
                                                    <option selected>Admin/Guru</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Guru">Guru</option>
                                                    
                                                </select>
                                                <label for="floatingSelect" style="color: #C7AAAA;">Admin/Guru</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" />
                                                <label for="inputPassword" style="color: #C7AAAA;">Masukkan Password(*minimal 6 karakter)</label>
                                                <!-- Icon toggle visibility -->
                                                <span class="position-absolute end-0 top-50 translate-middle-y pe-3" style="cursor: pointer;" onclick="togglePasswordVisibility('inputPassword', 'togglePasswordIcon')">
                                                    <i id="togglePasswordIcon" class="bi bi-eye-slash"></i>
                                                </span>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="confirmPassword" id="inputConfirmPassword" type="password" placeholder="Masukkan Ulang Password" />
                                                <label for="inputConfirmPassword" style="color: #C7AAAA;">Masukkan Ulang Password</label>
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
                