<div class="app-content-header"> 
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <div class="d-flex align-items-center">
                    <a href="index.php" class="btn btn-primary"><i class="bi bi-arrow-left"></i></a>
                    <i class="bi bi-person-circle primary ms-4" style="color: #589BFF; font-size: 40px;"></i>
                    <span class="text-primary ms-3 align-text-center"><b>Akun e dia</b></span>
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
                                    <div class="float-sm-end text-white">10/09/2024</div>
                                    <form>
                                        <div class="form-floating mb-3 col-md-5">
                                            <input class="form-control" id="inputEmail" readonly type="text" placeholder="name@example.com" value="Halo Boss" />
                                            <label for="floatingTextarea2">Judul : </label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <img src="<?= base_url('assets/dist/image/c2.jpg'); ?>" class="img-thumbnail w-25" alt="Bukti Foto" id="foto">
                                        </div>
                                        <div class="form-floating">
                                            <textarea class="form-control h-auto" readonly placeholder="Leave a comment here" id="floatingTextarea2">Ngaso Sek Bolovvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv</textarea>
                                            <label for="floatingTextarea2">Isi Pengaduan</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Separator Waktu -->
                    <div class="text-center text-muted mb-3">
                        <small>10/09/2024</small>
                    </div>

                    <!-- Percakapan -->
                    <div class="d-flex justify-content-end mb-3">
                        <div class="card text-bg-primary p-2 w-auto">
                            <p>Sherlock Tak Parani</p>
                            <small class="text-end">12:30</small>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mb-3">
                        <div class="card text-bg-secondary p-2 w-auto">
                            <p>Pie?</p>
                            <small class="text-end">11:45</small>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mb-3">
                        <div class="card text-bg-primary p-2 w-auto">
                            <p>Ngaso Sek Bolo</p>
                            <small class="text-end">13:15</small>
                        </div>
                    </div>
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
                        <input type="hidden" name="id_pengaduan" value="">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::App Content-->
