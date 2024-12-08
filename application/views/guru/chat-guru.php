<?php
$pengaduan_hash = $this->input->get('id_pengaduan');

?>
<div class="app-content-header"> 
    
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <div class="d-flex align-items-center">
                    <a href="<?= site_url('pages3/home')?>" class="btn btn-primary"><i class="bi bi-arrow-left"></i></a>
                    <i class="bi bi-person-circle primary ms-4" style="color: #589BFF; font-size: 40px;"></i>
                    <span class="text-primary ms-3 align-text-center"><b><?= $pengaduan['username'] ?></b></span>
                </div>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<!--end::App Content Header-->

<!--begin::App Content-->
<hr style="height: 5px; background: black;">
<div class="app-content">
    <div class="row ms-auto me-auto justify-content-center w-auto mt-4">
        <div class="col-md-11 p-2">
            <div class="card shadow-lg border-0 rounded-lg">
                <!-- Container dengan scroll -->
                <div class="card-body" style="height: 500px; overflow-y: scroll;">
                    <!-- Pengaduan Awal -->
                    <div class="mb-4">
                        <div class="card shadow-lg border-0 rounded-lg">
                            <div class="card-body rounded" style="background-color: #09B2F5;">
                                <div class="card-body" style="background-color: #09B2F5;">
                                    <div class="float-sm-end text-white"><?= $pengaduan['tgl_pengaduan'] ?></div>
                                    <form>
                                        <div class="form-floating mb-3 col-md-5">
                                            <input class="form-control" id="inputEmail" readonly type="text" placeholder="name@example.com" value="<?= $pengaduan['judul_pengaduan'] ?>" />
                                            <label for="floatingTextarea2">Judul : </label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <img src="<?= base_url('uploads/' . $pengaduan['gambar']); ?>" class="img-thumbnail w-25" alt="Bukti Foto" id="foto">
                                        </div>
                                        <div class="form-floating">
                                            <textarea class="form-control h-auto" readonly placeholder="Leave a comment here" id="floatingTextarea2"></textarea>
                                            <label for="floatingTextarea2"><?= $pengaduan['isi_laporan'] ?></label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php
                        $last_date = ''; // Untuk memisahkan tanggapan berdasarkan tanggal
                        foreach ($tanggapan as $t) {
                        // Separator waktu
                        if ($last_date != $t['tgl_tanggapan']) {
                            $last_date = $t['tgl_tanggapan'];
                            echo '<div class="text-center text-muted mb-3"><small>' . date('d/m/Y', strtotime($last_date)) . '</small></div>';
                        }

                        if ($t['sender_type'] == 'guru') {
                            // Pesan dari guru (kanan)
                            echo '<div class="d-flex justify-content-end mb-3">';
                            echo '<div class="card text-bg-primary p-2 w-auto">';
                            echo '<p>' . htmlspecialchars($t['tanggapan']) . '</p>';
                            if (!empty($t['attachment'])) {
                                echo '<a href="' . base_url('uploads/lampiran/' . $t['attachment']) . '" target="_blank" class="text-white">Lihat Lampiran</a>';
                            }
                            echo '<small class="text-end">' . date('H:i', strtotime($t['jam_menit'])) . '</small>';
                            echo '</div></div>';
                        } else {
                            // Pesan dari siswa (kiri)
                            echo '<div class="d-flex justify-content-start mb-3">';
                            echo '<div class="card text-bg-secondary p-2 w-auto">';
                            echo '<p>' . htmlspecialchars($t['tanggapan']) . '</p>';
                            if (!empty($t['attachment'])) {
                                echo '<a href="' . base_url('uploads/lampiran/' . $t['attachment']) . '" target="_blank" class="text-white">Lihat Lampiran</a>';
                            }
                            echo '<small class="text-end">' . date('H:i', strtotime($t['jam_menit'])) . '</small>';
                            echo '</div></div>';
                        }
                    }

                        ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Form Kirim Pesan Baru -->
    <div class="row ms-auto me-auto justify-content-center w-auto mt-2">
        <div class="col-md-11 p-2">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body">
                    <form action="<?= base_url('chat/kirim_pesan'); ?>" method="POST" enctype="multipart/form-data">
    <div class="row g-2">
        <!-- Textarea untuk Pesan -->
        <div class="col-md-10">
            <textarea class="form-control" name="isi_pesan" rows="2" placeholder="Type Message ..."></textarea>
        </div>
        <!-- Tombol Lampiran dan Kirim -->
        <div class="col-md-2 d-flex justify-content-between align-items-center">
            <label for="lampiran" class="btn btn-outline-secondary">Lampiran</label>
            <input type="file" id="lampiran" name="lampiran" class="d-none">
            <button type="submit" class="btn btn-primary">KIRIM</button>
        </div>
    </div>
    <!-- Hidden ID Pengaduan -->
    <input type="hidden" name="id_pengaduan" value="<?= $pengaduan_hash; ?>">
    <!-- Hidden Sender Type -->
    <input type="hidden" name="sender_type" value="guru"> 
</form>

                </div>
            </div>
        </div>
    </div>
</div>
<!--end::App Content-->
