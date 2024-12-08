    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Guru & Admin</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Data Guru & Admin</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                  <?php if ($this->session->flashdata('success')): ?>
                                        <div class="alert alert-success" role="alert">
                                            <?= $this->session->flashdata('success'); ?>
                                        </div>
                                    <?php elseif ($this->session->flashdata('error')): ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?= $this->session->flashdata('error'); ?>
                                        </div>
                                    <?php endif; ?>
                
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Mapel</th>
                                            <th>Posisi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Mapel</th>
                                            <th>Posisi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                       <?php $no = 1; ?>
                                        <?php foreach ($petugas as $s): ?>

                                            <tr>

                                                <td><?= $no++; ?></td>
                                                <td><?= $s['nama_guru']; ?></td>
                                                <td><?= $s['jabatan']; ?></td>
                                                <td><?= $s['level']; ?></td>
                                                
                                                <td>
                                                    <a class="btn btn-primary" href="<?= site_url('pages/rinciguru?id=' . md5($s['id_petugas'])); ?>">Rinci</a>

                                                    <a class="btn btn-warning" href="<?= site_url('pages/reset_password/' . $s['id_petugas']); ?>" onclick="return confirm('Apakah Anda yakin ingin me-reset password akun ini?');">Reset</a>
                                                    <a class="btn btn-danger" href="<?= site_url('pages/hapus_petugas/' . $s['id_petugas']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                