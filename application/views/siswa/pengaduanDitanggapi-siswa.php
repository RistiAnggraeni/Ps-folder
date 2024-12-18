
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="d-flex align-items-center">
                    <a href="<?= site_url('pages2/home'); ?>" class="btn btn-primary me-3"><i class="bi bi-arrow-left"></i></a>
                    <h3 class="mb-0" style="color: #09B2F5;"><b>Daftar Aduan Anda Yang Ditanggapi</b></h3>
                </div>
            </div>
        </div>
    </div>
    <?php if ($this->session->flashdata('success')): ?>
                <div class="m-1 alert alert-success"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="m-1 alert alert-danger"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>
    <div class="container">
        <?php foreach ($aduan_ditanggapi as $aduan): ?>
            <div class="row justify-content-center">
                <div class="col-md-11 p-2">
                    <div class="card shadow-lg border-0 rounded-lg mt-2">
                        <div class="card-body rounded" style="background-color: #09B2F5;">
                            <div class="float-sm-end text-white"><?= date('d/m/Y', strtotime($aduan['tgl_pengaduan'] )) ?></div>
                            <form>
                                <div class="form-floating mb-3 col-md-5">
                                    <input class="form-control" readonly type="text" value="<?= $aduan['nama_guru']; ?>" />
                                    <label for="floatingTextarea2">Kepada : </label>
                                </div>
                                <div class="form-floating mb-3 col-md-5">
                                    <input class="form-control" readonly type="text" value="<?= $aduan['judul_pengaduan']; ?>" />
                                    <label for="floatingTextarea2">Judul : </label>
                                </div>
                                <div class="form-floating mb-2">
                                    <img src="<?= base_url('uploads/'.$aduan['gambar']) ?>" class="img-thumbnail w-25" alt="Bukti Foto">
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" readonly style="height: 100px"><?= $aduan['isi_laporan']; ?></textarea>
                                    <label for="floatingTextarea2">Isi Pengaduan</label>
                                </div>
                                <div class="d-flex justify-content-between mt-4 position-relative">
                                    <a href="<?= site_url('pages2/chat-siswa?id_pengaduan=' . md5($aduan['id_pengaduan'])); ?>" 
                                       class="btn text-white btn-success position-relative">
                                       Buka
                                       <?php if ($aduan['unread_count'] > 0): ?>
                                           <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                                               <span class="visually-hidden">Unread</span>
                                           </span>
                                       <?php endif; ?>
                                    </a>
                                    
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</main>
<script>
    function confirmDelete() {
        var result = confirm("Apakah Anda yakin ingin menghapus pengaduan ini?");
        return result; // Jika user klik OK, return true, jika Cancel return false
    }
</script>