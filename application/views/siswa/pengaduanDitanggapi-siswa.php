        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="d-flex align-items-center">
                                <a href="<?= site_url('pages2/home'); ?>" class="btn btn-primary me-3"><i class="bi bi-arrow-left"></i></a>
                                <h3 class="mb-0 " style="color: #09B2F5;"><b>Pengaduan Yang Ditanggapi</b></h3>
                        </div>
                        
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content Header--> <!--begin::App Content-->
             <!--begin::Container-->
                <div class="container ">
                        <div class="row justify-content-center">
                            <div class="col-md-11 p-2">
                                <div class="card shadow-lg border-0 rounded-lg mt-2">
                                    <div class="card-body rounded" style="background-color: #09B2F5;">
                                    <div class="card-body" style="background-color: #09B2F5;">
                                    <div class="float-sm-end text-white">10/09/2024</div>
                                        <form>
                                            <div class="form-floating mb-3 col-md-5">
                                                <input class="form-control" id="inputEmail" readonly type="text" placeholder="name@example.com" value="R*************" />
                                                <label for="floatingTextarea2">Oleh : </label> 
                                            </div>
                                            <div class="form-floating mb-3 col-md-5">
                                                <input class="form-control" readonly id="inputEmail" readonly type="text"  value="BapakneIma" />
                                                <label for="floatingTextarea2">Kepada : </label>  
                                            </div>
                                            <div class="form-floating mb-3 col-md-5">
                                                <input class="form-control" id="inputEmail" readonly type="text" placeholder="name@example.com" value="Oke Boss" />
                                                <label for="floatingTextarea2">Judul : </label> 
                                            </div>
                                            <div class="form-floating mb-2">
                                                <img src="<?= base_url('assets/dist/image/c2.jpg')?>" class="img-thumbnail w-25" alt="Bukti Foto" id="foto">
                                            </div>
                                            <div class="form-floating">
                                              <textarea class="form-control" readonly placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">Ngaso Sek Bolo</textarea>
                                              <label for="floatingTextarea2">Isi Pengaduan</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0 col-md-2 ms-auto p-2">
                                                <a href="?page=chat-siswa" class="btn w-100 text-white btn-warning">Notif Baru!!!</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </div>

                    
                    <!--end::App Content-->
       