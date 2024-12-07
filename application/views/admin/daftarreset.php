                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="m-2 alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                    <?php elseif ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>
                    <div class="container">
                      <h1 class="mt-4">Permintaan Reset Siswa</h1>
                      <ol class="breadcrumb mb-4">
                          <li class="breadcrumb-item active">Reset Password</li>
                      </ol>
                  </div>

                  <?php if (empty($dafres)): ?>
                      <!-- Jika tabel daftar_reset kosong -->
                      <div class=" m-2 alert alert-info text-center" role="alert">
                          Tidak Ada Pengajuan Untuk Reset
                      </div>
                  <?php else: ?>
                      <!-- Jika tabel daftar_reset tidak kosong -->
                      <?php foreach ($dafres as $s): ?>   
                          <div class="container d-flex flex-column">
                              <div class="card mt-3 mb-3 me-3 ms-3">
                                  <h6 class="card-header">NIS: <?= $s['nis']; ?></h6>
                                  <div class="card-body">
                                      <h5 class="card-title">Nama: <?= $s['nama_lengkap']; ?></h5>
                                  </div>
                                  <div class="card-body">
                                      <a class="btn btn-warning" 
                                         href="<?= site_url('pages/reset_password_siswa/' . $s['nis']); ?>" 
                                         onclick="return confirm('Apakah Anda yakin ingin me-reset password akun ini?');">
                                          Reset
                                      </a>
                                  </div>
                              </div>
                          </div>
                      <?php endforeach; ?>
                  <?php endif; ?>
