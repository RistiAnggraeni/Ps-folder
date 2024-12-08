<div class="container">
    <?php if ($this->session->flashdata('success')) : ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-11">
            <?php if (!empty($pengaduan)) : ?>
                <?php foreach ($pengaduan as $row) : ?>
                    <div class="card shadow-lg border-0 rounded-lg mt-4" style="margin-bottom: 20px; background-color: #09B2F5;">
                        <div class="card-body rounded">
                            <div class="float-sm-end text-white">
                                <?= date('d/m/Y', strtotime($row['tgl_pengaduan'])) ?>
                            </div>
                            <form action="<?= base_url('pengaduan_status/updateStatus'); ?>" method="POST">
                                <div class="form-floating mb-3 col-md-5">
                                    <?php
                                    $username = ($row['status_nama'] == '1') ? substr($row['username'], 0, 1) . str_repeat('*', strlen($row['username']) - 1) : $row['username'];
                                    ?>
                                    <input class="form-control" readonly type="text" value="<?= $username ?>" />
                                    <label for="floatingTextarea2">Oleh :</label>
                                </div>

                                <div class="form-floating mb-3 col-md-5">
                                    <input class="form-control" readonly type="text" value="<?= $row['judul_pengaduan'] ?>" />
                                    <label for="floatingTextarea2">Judul :</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <img src="<?= base_url('uploads/' . $row['gambar']); ?>" class="img-thumbnail w-25" alt="Bukti Foto">
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" readonly style="height: 100px"><?= $row['isi_laporan'] ?></textarea>
                                    <label for="floatingTextarea2">Isi Pengaduan</label>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <!-- Tombol Selesai di kiri bawah -->
                                    <?php if ($row['status'] == 'ditanggapi') : ?>
                                        <div>
                                            <input type="hidden" name="id_pengaduan" value="<?= $row['id_pengaduan']; ?>">
                                            <input type="hidden" name="status" value="finish">
                                            <button type="submit" class="btn text-white btn-danger">Selesai</button>
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <?php if ($row['status'] == 'belum ditanggapi') : ?>
                                            <a href="<?= site_url('pages3/chat-guru?id_pengaduan=' . $row['pengaduan_hash']); ?>" class="btn text-white btn-success">Tanggapi</a>
                                        <?php elseif ($row['status'] == 'ditanggapi') : ?>
                                            <a href="<?= site_url('pages3/chat-guru?id_pengaduan=' . $row['pengaduan_hash']); ?>" class="btn text-white btn-primary">Buka</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-white text-center mt-4">Tidak ada data pengaduan untuk Anda.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

