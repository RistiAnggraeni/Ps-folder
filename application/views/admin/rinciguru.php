<?php

$id = $this->input->get('id'); 


$petugas = $this->db->get_where('data_petugas', ['id_petugas' => $id])->row_array();


if (!$petugas) {
    echo "Data tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Akun Anda</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <div class="d-flex align-items-center">
            <a href="<?= site_url('pages/dataguru')?>" class="btn btn-primary ms-2 mt-2 me-3"><i class="bi bi-arrow-left"></i></a>
            
    </div>
    <body>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container ">
                        <div class="row justify-content-center">
                            <div class="col-lg-5 p-2">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-body rounded" style="background-color: #09B2F5;">
                                    <div class="card-body" style="background-color: #09B2F5;">
                                        

                                        <form action="<?= site_url('siswaguru/update2'); ?>" method="post">
                                            <h3 class="text-left font-weight-light my-4 text-light">Rincian Akun</h3>
                                            <input class="form-control" id="id_petugas" type="text" name="id_petugas" value="<?= $petugas['id_petugas']; ?>" hidden style="color: #C7AAAA;"/>
                                           <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="username" type="text" value="<?= $petugas['username']; ?>" style="color: #C7AAAA;"/>
                                                <label for="inputEmail" style="color: #C7AAAA;">Username</label>
                                            </div>
                                           
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="nama" type="text" value="<?= $petugas['nama_guru']; ?>" style="color: #C7AAAA;"/>
                                                <label for="inputEmail" style="color: #C7AAAA;">Nama Lengkap</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="jabatan" type="text" value="<?= $petugas['jabatan']; ?>" style="color: #C7AAAA;"/>
                                                <label for="inputEmail" style="color: #C7AAAA;">Mapel/Jabatan</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="no_hp" type="text" value="<?= $petugas['no_hp']; ?>" style="color: #C7AAAA;"/>
                                                <label for="inputEmail" style="color: #C7AAAA;">No Hp</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" readonly name="level" type="text" value="<?= $petugas['level']; ?>" style="color: #C7AAAA;"/>
                                                <label for="inputEmail" style="color: #C7AAAA;">Sebagai</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn w-100" style="background-color: #2F45F1; color: white;" type="submit">Ubah</button>
                                            </div>
                                            <div>
                                                
                                            </div>
                                            
                                        </form> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
