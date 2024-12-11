<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex align-items-center">
                <a href="<?= site_url('pages2/daftaraduan'); ?>" class="btn btn-primary me-3"><i class="bi bi-arrow-left"></i></a>
                <h3 class="mb-0" style="color: #09B2F5;"><b>Edit Aduan Anda</b></h3>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11 p-2">
            <div class="card shadow-lg border-0 rounded-lg mt-2">
                <div class="card-body rounded" style="background-color: #09B2F5;">
                    <div class="card-body" style="background-color: #09B2F5;">
                        <form action="<?= site_url('pengaduan/updatepengaduan/'.$aduan['id_pengaduan']); ?>" method="POST" enctype="multipart/form-data">
                            <!-- Perubahan Pada Bagian Kepada -->
                            <div class="form-floating mb-3 col-md-5">
                                <select class="form-select" name="kepada" id="id_petugas" aria-label="Pilih Guru">
                                    <option selected disabled>Ditujukan Kepada...</option>
                                    <?php foreach ($data_petugas as $p): ?>
                                        <?php if ($p['level'] == 'guru'): ?>
                                            <option value="<?= $p['id_petugas'] ?>" <?= ($p['id_petugas'] == $aduan['id_petugas']) ? 'selected' : '' ?>>
                                                <?= $p['nama_guru'] . ' - ' . $p['jabatan'] ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <label for="id_petugas">Kepada :</label>
                            </div>
                            <!-- Bagian Judul -->
                            <div class="form-floating mb-3 col-md-5">
                                <input class="form-control" id="judul" type="text" name="judul" placeholder="Judul Pengaduan" value="<?= $aduan['judul_pengaduan'] ?>" />
                                <label for="judul">Judul :</label> 
                            </div>
                            <!-- Bagian Gambar -->
                            <div class="form-floating mb-2">
                                <img src="<?= base_url('uploads/'.$aduan['gambar']) ?>" class="img-thumbnail w-25" alt="Bukti Foto" id="foto">
                                <input type="file" class="form-control mt-2" name="gambar" placeholder="Ganti Foto"/>
                            </div>
                            <!-- Bagian Isi Laporan -->
                            <div class="form-floating">
                                <textarea class="form-control" name="isi_laporan" placeholder="Isi Pengaduan" style="height: 100px"><?= $aduan['isi_laporan'] ?></textarea>
                                <label for="floatingTextarea2">Isi Pengaduan</label>
                            </div>
                            <!-- Tombol Update -->
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0 col-md-2 ms-auto p-2">
                                <button type="submit" class="btn w-100 text-white btn-primary" onclick="return confirm('Apakah Anda yakin ingin mengubah pengaduan ini?'); ">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
