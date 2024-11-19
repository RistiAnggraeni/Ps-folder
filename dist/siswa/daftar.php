<main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="d-flex align-items-center">
                                <a href="index.php" class="btn btn-primary me-3"><i class="bi bi-arrow-left"></i></a>
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
      <div class="card shadow-sm mb-3" data-search="bapak ahmad matematika">
        <div class="card-body row">
          <h5 class="card-title">Nama Guru: Bapak Ahmad</h5>
          <p class="card-text">Mata Pelajaran: Matematika</p>
          <a href="?page=index" class="btn btn-primary w-100 mt-3">Buat Pengaduan</a>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="card shadow-sm mb-3" data-search="ibu siti bahasa indonesia">
        <div class="card-body row">
          <h5 class="card-title">Nama Guru: Ibu Siti</h5>
          <p class="card-text">Mata Pelajaran: Bahasa Indonesia</p>
          <a href="?page=index" class="btn btn-primary w-100 mt-3">Buat Pengaduan</a>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="card shadow-sm mb-3" data-search="bapak ali fisika">
        <div class="card-body row">
          <h5 class="card-title">Nama Guru: Bapak Ali</h5>
          <p class="card-text">Mata Pelajaran: Fisika</p>
          <a href="?page=index" class="btn btn-primary w-100 mt-3">Buat Pengaduan</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Link Bootstrap JS -->
  