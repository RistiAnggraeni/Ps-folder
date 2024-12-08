<?php
$nis_hash = $this->input->get('nis'); 

$siswa = $this->db->get_where('data_siswa', ['md5(nis)' => $nis_hash])->row_array();

if (!$siswa) {
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <div class="d-flex align-items-center">
            <a href="<?= site_url('pages/datasiswa')?>" class="btn btn-primary ms-2 mt-2 me-3"><i class="bi bi-arrow-left"></i></a>
            
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
                                 

                                        
                            <form action="<?= site_url('siswaguru/update'); ?>" method="post">
                                <h3 class="text-left font-weight-light my-4 text-light">Rincian Akun</h3>
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="username" id="username" type="text" value="<?= $siswa['username']; ?>" style="color: #C7AAAA;" />
                                    <label for="username" style="color: #C7AAAA;">Username</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" readonly name="nis" id="nis" type="number" value="<?= $siswa['nis']; ?>"  style="color: #C7AAAA;" />
                                    <label for="nis" style="color: #C7AAAA;">NIS</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="nama_lengkap" id="nama_lengkap" type="text" value="<?= $siswa['nama_lengkap']; ?>" style="color: #C7AAAA;" />
                                    <label for="nama_lengkap" style="color: #C7AAAA;">Nama Lengkap</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="kelas" id="kelas" type="text" value="<?= $siswa['kelas']; ?>" style="color: #C7AAAA;" />
                                    <label for="kelas" style="color: #C7AAAA;">Kelas</label>
                                </div>
                                <div>
                                    <button class="btn w-100" style="background-color: #2F45F1; color: white;" type="submit">Ubah</button>
                                </div>
                            </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            
        
    </body>
</html>
