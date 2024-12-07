 

                    <div class="container-fluid px-4">

                        <h1 class="mt-4">Data Siswa</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Data siswa</li>
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
                                            <th>Username</th>
                                            <th>Nama Lengkap</th>
                                            <th>NIS</th>
                                            <th>Kelas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Nama Lengkap</th>
                                            <th>NIS</th>
                                            <th>Kelas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($siswa as $s): ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $s['username']; ?></td>
                                                <td><?= $s['nama_lengkap']; ?></td>
                                                <td><?= $s['nis']; ?></td>
                                                <td><?= $s['kelas']; ?></td>
                                                <td>
                                                   <a class="btn btn-primary" href="<?= site_url('pages/rincisiswa?nis=' . $s['nis']); ?>">Rinci</a>

                                                    <a class="btn btn-warning" href="<?= site_url('pages/reset_password2/' . $s['nis']); ?>" onclick="return confirm('Apakah Anda yakin ingin me-reset password akun ini?');">Reset</a>
                                                    <a class="btn btn-danger" href="<?= site_url('pages/hapus_siswa/' . $s['nis']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">Hapus</a>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                