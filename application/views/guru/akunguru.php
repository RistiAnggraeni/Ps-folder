
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

                    <div class="container ">
                        <div class="row justify-content-center">
                            <div class="col-lg-5 p-2">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-body rounded" style="background-color: #09B2F5;">
                                    <div class="card-body" style="background-color: #09B2F5;">
                                        <?php if ($this->session->flashdata('success')): ?>
                                                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                                            <?php elseif ($this->session->flashdata('error')): ?>
                                                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                                            <?php endif; ?>


                                        <form>
                                            <h3 class="text-left font-weight-light my-4 text-light">Akun Anda</h3>
                                            <div class="text-center mb-3 mt-5">
                                                <i class="fas fa-user fa-fw text-white" style="width: 50px; height: 50px;"></i>
                                                <p class="text-white"><?= $user['username']; ?></p>
                                            </div>
                                           
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" readonly id="inputEmail" type="text" value="<?= $user['nama_guru']; ?>" style="color: #C7AAAA;"/>
                                                <label for="inputEmail" style="color: #C7AAAA;">Nama Lengkap</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" readonly id="inputEmail" type="text" value="<?= $user['jabatan']; ?>" style="color: #C7AAAA;"/>
                                                <label for="inputEmail" style="color: #C7AAAA;">Mapel</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" readonly id="inputEmail" type="text" value="<?= $user['no_hp']; ?>" style="color: #C7AAAA;"/>
                                                <label for="inputEmail" style="color: #C7AAAA;">No Hp</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" readonly id="inputEmail" type="text" value="<?= $user['level']; ?>" style="color: #C7AAAA;"/>
                                                <label for="inputEmail" style="color: #C7AAAA;">Sebagai</label>
                                            </div>
                                            <div>
                                                
                                            </div></form>

                                      
                                            <div class="mt-4">
                                            <h6 class="text-white">Ubah Password</h6>
                                            
                                        <form action="<?= site_url('tambah_data/change_passwordguru');?>" method= "post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="password_new" id="inputPassword" type="password" placeholder="Password" />
                                                <label for="inputPassword" style="color: #C7AAAA;">Masukkan Password</label>
                                                <!-- Icon toggle visibility -->
                                                <span class="position-absolute end-0 top-50 translate-middle-y pe-3" style="cursor: pointer;" onclick="togglePasswordVisibility('inputPassword', 'togglePasswordIcon')">
                                                    <i id="togglePasswordIcon" class="bi bi-eye-slash"></i>
                                                </span>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="confirmPassword_new" id="inputConfirmPassword" type="password" placeholder="Masukkan Ulang Password" />
                                                <label for="inputConfirmPassword" style="color: #C7AAAA;">Masukkan Ulang Password</label>
                                                <!-- Icon toggle visibility -->
                                                <span class="position-absolute end-0 top-50 translate-middle-y pe-3" style="cursor: pointer;" onclick="togglePasswordVisibility('inputConfirmPassword', 'toggleConfirmPasswordIcon')">
                                                    <i id="toggleConfirmPasswordIcon" class="bi bi-eye-slash"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn w-100" style="background-color: #2F45F1; color: white;" type="submit">Ubah Password</button>
                                            </div>
                                            
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