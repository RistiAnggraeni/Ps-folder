<?php
$data['petugas'] = $this->Petugas_model->get_all_petugas();
 $id_petugas_terpilih = $this->input->post('id_petugas');
        $nama_guru_terpilih = null;
        if ($id_petugas_terpilih) {
            foreach ($data['petugas'] as $p) {
                if ($p['id_petugas'] == $id_petugas_terpilih) {
                    $nama_guru_terpilih = $p['nama_guru'] . ' - ' . $p['jabatan'];
                    break; 
                }
            }
        }

        // Mengirim data ke view
        $data['id_petugas_terpilih'] = $id_petugas_terpilih;
        $data['nama_guru_terpilih'] = $nama_guru_terpilih;

?>


    <div class="app-content">

    
        <div class="container-fluid d-flex justify-items-center justify-content-center flex-row gap-5 mt-3 mb-2">
            <div class="small-box text-white w-auto p-2 rounded" style="background-color: #589BFF;">
                
                <a href="<?= site_url('pages2/daftaraduan'); ?>" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    <div class="inner">
                    <h6>Jumlah Aduan Anda</h6>
                    <h3 class="text-center"><?= $jumlah_aduan ?></h3>
                </div></a>
            </div>
            <div class="small-box text-white w-auto p-2 rounded" style="background-color: #9BEC00;">
                
                <a href="<?= site_url('pages2/pengaduanDitanggapi-siswa'); ?>" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    <div class="inner">
                    <h6>Jumlah Aduan Ditanggapi</h6>
                    <h3 class="text-center"><?= $jumlah_ditanggapi ?></h3>
                </div>
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center justify-items-center">
        <div class="card mb-4 ms-2 me-2" style="background-color: #589BFF;">
            <?php if ($this->session->flashdata('success')): ?>
                <div class="m-1 alert alert-success"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="m-1 alert alert-danger"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>
            <form method="POST" action="<?= site_url('pengaduan/submit'); ?>" enctype="multipart/form-data">
                <div class="card-body">
                    <select class="form-select" name="id_petugas" aria-label="Default select example">
                        <?php if ($id_petugas_terpilih && $nama_guru_terpilih): ?>
                            <option value="<?= $id_petugas_terpilih ?>" selected>
                                <?= $nama_guru_terpilih ?>
                            </option>
                        <?php else: ?>
                            <option selected>Ditujukan Kepada......</option>
                        <?php endif; ?>
                        <?php foreach ($petugas as $p): ?>
                            <option value="<?= $p['id_petugas'] ?>">
                                <?= $p['nama_guru'] . ' - ' . $p['jabatan'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <div class="form-floating w-auto mt-2">
                        <input class="form-control" name="judul" placeholder="Leave a comment here" id="floatinginput"></input>
                        <label for="floatingTextarea">Judul</label>
                    </div>
                    <div class="form-floating md-4 mt-3">
                        <textarea class="form-control" name="isi_pengaduan" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px"></textarea>
                        <label for="floatingTextarea2">Comments</label>
                    </div>
                    <div class="input-group mb-3 md-4 mt-3"> 
                        <input type="file" class="form-control" id="inputGroupFile02" name="foto"> 
                        <label class="input-group-text" for="inputGroupFile02">Upload</label> 
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="mb-3 form-check">
                            <input type="hidden" name="status_nama" value="0">
                            <input type="checkbox" class="form-check-input text-white" id="exampleCheck1" name="status_nama" value="1">
                            <label class="form-check-label" for="exampleCheck1">Sensor nama anda</label>
                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
   
