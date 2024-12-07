<div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <?php if ($this->session->flashdata('success')): ?>
                                        <div class="alert alert-success" role="alert">
                                            <?= $this->session->flashdata('success'); ?>
                                        </div>
                                    <?php elseif ($this->session->flashdata('error')): ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?= $this->session->flashdata('error'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Tanggal</th>
                                            <th>Judul</th>
                                            <th>Isi Pengaduan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Tanggal</th>
                                            <th>Judul</th>
                                            <th>Isi Pengaduan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    <?php if (!empty($pengaduan)) : ?>
                                        <?php foreach ($pengaduan as $row) : ?> 

                                       <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nama_lengkap'] ?></td>
                                        <td><?= $row['kelas'] ?></td>
                                        <td><?= date('d/m/Y', strtotime($row['tgl_pengaduan'])) ?></td>
                                        <td><?= $row['judul_pengaduan'] ?></td>
                                        <td><?= $row['isi_laporan'] ?></td>

                                        <td><?php if ($row['status'] == 'belum ditanggapi' AND $row['filter'] === '1') : ?>
                                            <form action="<?= site_url('pengaduan_status/updateFilter'); ?>" method="POST" style="display: inline;">
                                            <input type="hidden" name="id_pengaduan" value="<?= $row['id_pengaduan']; ?>">
                                            <input type="hidden" name="filter" value="0">
                                            <button type="submit" class="btn text-white btn-danger">Nonaktifkan Aduan</button>
                                            </form>
                                        <?php elseif ($row['status'] == 'belum ditanggapi' AND $row['filter'] === '0') : ?>
                                            <form action="<?= site_url('pengaduan_status/updateFilter'); ?>" method="POST" style="display: inline;">
                                            <input type="hidden" name="id_pengaduan" value="<?= $row['id_pengaduan']; ?>">
                                            <input type="hidden" name="filter" value="1">
                                            <button type="submit" class="btn text-white btn-success">Aktifkan 
                                            Aduan</button>
                                        </form>
                                        <?php elseif ($row['status'] == 'ditanggapi' OR $row['status'] == 'finish' OR $row['status'] == 'endelete' ) : ?>
                                            <p><i>Sudah Ditanggapi</i></p>

                                        <?php endif; ?>
                                    </td>
                                       </tr>
                                        <?php endforeach; ?>
                                        <?php else : ?>
                                            <p class="text-white text-center mt-4">Tidak ada data pengaduan.</p>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>