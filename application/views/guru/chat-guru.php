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
        
    </div>
   
</div>



<hr style="height: 5px; background: black;">
<div class="app-content">
    <div class="row ms-auto me-auto justify-content-center w-auto mt-4">
        <div class="col-md-11 p-2">
            <div class="card shadow-lg border-0 rounded-lg">
                
                <div class="card-body" style="height: 500px; overflow-y: scroll;">
                    
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
                        $last_date = ''; 
                        foreach ($tanggapan as $t) {
                        // Separator waktu
                        if ($last_date != $t['tgl_tanggapan']) {
                            $last_date = $t['tgl_tanggapan'];
                            echo '<div class="text-center text-muted mb-3"><small>' . date('d/m/Y', strtotime($last_date)) . '</small></div>';
                        }

                        if ($t['sender_type'] == 'guru') {
                            
                            echo '<div class="d-flex justify-content-end mb-3">';
                            echo '<div class="card text-bg-primary p-2 w-auto">';
                            echo '<p>' . htmlspecialchars($t['tanggapan']) . '</p>';

                            if (!empty($t['attachment'])) {
                                $attachment_path = base_url('uploads/lampiran/' . $t['attachment']);
                                $file_extension = strtolower(pathinfo($t['attachment'], PATHINFO_EXTENSION));

                                // Periksa apakah file adalah gambar
                                $image_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                                if (in_array($file_extension, $image_extensions)) {
                                    echo '<img src="' . $attachment_path . '" alt="Lampiran" class="img-fluid rounded my-2" style="max-width: 200px; max-height: 200px;">';
                                } else {
                                    echo '<a href="' . $attachment_path . '" target="_blank" class="text-white">Lihat Lampiran</a>';
                                }
                            }
                            date_default_timezone_set('Asia/Jakarta'); // Menetapkan zona waktu Indonesia
                            echo '<small class="text-end">' . date('h:i A', strtotime($t['jam_menit'])) . '</small>';
                            echo '</div></div>';
                        }else {
                                echo '<div class="d-flex justify-content-start mb-3">';
                                echo '<div class="card text-bg-secondary p-2 w-auto">';
                                echo '<p>' . htmlspecialchars($t['tanggapan']) . '</p>';
                                if (!empty($t['attachment'])) {
                                $attachment_path = base_url('uploads/lampiran/' . $t['attachment']);
                                $file_extension = strtolower(pathinfo($t['attachment'], PATHINFO_EXTENSION));

                                // Periksa apakah file adalah gambar
                                $image_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                                if (in_array($file_extension, $image_extensions)) {
                                    echo '<img src="' . $attachment_path . '" alt="Lampiran" class="img-fluid rounded my-2" style="max-width: 200px; max-height: 200px;">';
                                } else {
                                    echo '<a href="' . $attachment_path . '" target="_blank" class="text-white">Lihat Lampiran</a>';
                                }
                            }
                                date_default_timezone_set('Asia/Jakarta'); // Menetapkan zona waktu Indonesia
                                echo '<small class="text-end">' . date('h:i A', strtotime($t['jam_menit'])) . '</small>';
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
        
        <div class="col-md-10">
            <textarea class="form-control" name="isi_pesan" rows="2" placeholder="Type Message ..."></textarea>
        </div>
        
        <div class="col-md-2 d-flex justify-content-between align-items-center">
            <label for="lampiran" class="btn btn-outline-secondary" id="lampiranLabel">Lampiran</label>
            <input type="file" id="lampiran" name="lampiran" class="d-none" onchange="updateLampiranLabel()">
            <button type="submit" class="btn btn-primary">KIRIM</button>
            </div>
    </div>
    
    <input type="hidden" name="id_pengaduan" value="<?= $pengaduan_hash; ?>">
    
    <input type="hidden" name="sender_type" value="guru"> 
</form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateLampiranLabel() {
        const fileInput = document.getElementById('lampiran');
        const label = document.getElementById('lampiranLabel');

        if (fileInput.files && fileInput.files.length > 0) {
            label.textContent = fileInput.files[0].name;
        } else {
            label.textContent = 'Lampiran';
        }
    }
</script>