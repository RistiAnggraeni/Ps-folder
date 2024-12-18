<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="d-flex align-items-center">
                    <a href="<?= site_url('pages2/home'); ?>" class="btn btn-primary me-3"><i class="bi bi-arrow-left"></i></a>
                    <h3 class="mb-0" style="color: #09B2F5;"><b>Daftar Aduan Anda Yang Selesai</b></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Pesan sukses/error -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="m-1 alert alert-success"><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="m-1 alert alert-danger"><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>

    <div class="container">
        <?php foreach ($aduan_selesai as $aduan): ?>
            <div class="row justify-content-center">
                <div class="col-md-11 p-2">
                    <div class="card shadow-lg border-0 rounded-lg mt-2">
                        <div class="card-body rounded" style="background-color: #09B2F5;">
                            <div class="float-sm-end text-white"><?= date('d/m/Y', strtotime($aduan['tgl_pengaduan'])) ?></div>

                            <!-- Form: Oleh -->
                            <div class="form-floating mb-3 col-md-5">
                                <?php
                                    $username = ($aduan['status_nama'] == '1') ? substr($aduan['username'], 0, 1) . str_repeat('*', strlen($aduan['username']) - 1) : $aduan['username'];
                                ?>
                                <input class="form-control" readonly type="text" value="<?= $username ?>" />
                                <label for="floatingTextarea2">Oleh :</label>
                            </div>

                            <!-- Form: Judul -->
                            <div class="form-floating mb-3 col-md-5">
                                <input class="form-control" readonly type="text" value="<?= $aduan['judul_pengaduan']; ?>" />
                                <label for="floatingTextarea2">Judul :</label>
                            </div>

                            <!-- Form: Gambar -->
                            <div class="form-floating mb-2">
                                <img src="<?= base_url('uploads/'.$aduan['gambar']) ?>" class="img-thumbnail w-25" alt="Bukti Foto">
                            </div>

                            <!-- Form: Isi Pengaduan -->
                            <div class="form-floating">
                                <textarea class="form-control" readonly style="height: 100px"><?= $aduan['isi_laporan']; ?></textarea>
                                <label for="floatingTextarea2">Isi Pengaduan</label>
                            </div>

                            <div class="d-flex justify-content-between mt-4 position-relative">
                                <!-- Form untuk Hapus -->
                                <form action="<?= base_url('pengaduan_status/selesai_pengaduan'); ?>" method="POST" style="display: inline;">
                                    <input type="hidden" name="id_pengaduan" value="<?= $aduan['id_pengaduan']; ?>">
                                    <input type="hidden" name="status" value="endelete">
                                    <button type="submit" class="btn text-white btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini?');">Hapus</button>
                                </form>

                                <!-- Form untuk Buka Kembali -->
                                <form action="<?= base_url('pengaduan_status/hapus_buka_pengaduan'); ?>" method="POST" style="display: inline;">
                                    <input type="hidden" name="id_pengaduan" value="<?= $aduan['id_pengaduan']; ?>">
                                    <input type="hidden" name="status" value="ditanggapi">
                                    <button type="submit" class="btn text-white btn-success" onclick="return confirm('Apakah Anda yakin ingin membuka kembali pengaduan ini?');">Buka Kembali</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
