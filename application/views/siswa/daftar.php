
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="d-flex align-items-center">
                                <a href="<?= site_url('pages2/home')?>" class="btn btn-primary me-3"><i class="bi bi-arrow-left"></i></a>
                                <h3 class="mb-0 " style="color: #09B2F5;"><b>Daftar Nama Guru</b></h3>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div>
  <div class="container mt-5">
    <!-- Pencarian -->
    <div class="input-group mb-3">
      <span class="input-group-text" id="search-icon">
        <i class="bi bi-search"></i>
      </span>
      <input 
        type="text" 
        class="form-control" 
        id="searchInput" 
        placeholder="Cari berdasarkan nama guru atau mata pelajaran..." 
        aria-label="Cari berdasarkan nama guru atau mata pelajaran..." 
        aria-describedby="search-icon"
      >
    </div>

    <!-- Card Wrapper -->
    <div id="cardWrapper">
  <!-- Card 1 -->
  <?php foreach ($petugas as $s): ?>
    <!-- Pastikan hanya petugas dengan level 'guru' yang ditampilkan -->
    <?php if ($s['level'] == 'guru'): ?>
      <form method="POST" action="<?= site_url('pages2/home'); ?>" class="mb-3">
    <input type="hidden" name="id_petugas" value="<?= $s['id_petugas'] ?>">
    <div class="card shadow-sm">
        <div class="card-body row">
            <h5 class="card-title">Nama Guru: <?= $s['nama_guru'] ?></h5>
            <p class="card-text">Mata Pelajaran: <?= $s['jabatan'] ?></p>
            <button type="submit" class="btn btn-primary w-100 mt-3">Buat Pengaduan</button>
        </div>
    </div>
</form>
    <?php endif; ?>
  <?php endforeach; ?>
</div>

    </div>
  </div>

  <!-- Link Bootstrap JS -->
  