<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cok ||</title>
    <link rel="stylesheet" href="dist/css/adminlte.css">
</head>

<body>
    <nav class="p-3" style="background-color: #589BFF;">
        <div class="d-flex justify-content-between md:justify-content-start p-10">

            <img src="btk.png" alt="Logo" width="250" height="70" class="">

            <p class="fs-4 fw-bold align-self-center m-8">Pengaduan Siswa</p>
        </div>
    </nav>

    <div class="d-flex justify-content-center justify-items-center flex-column">
        <div class="w-75 align-self-center">
            <h3 class="mt-2">Dashboard</h3>
        </div>
        <div class="card md-4 mt-2 mb-2 w-75 align-self-center" style="background-color: #589BFF;">
            <form>
                <div class="card-body">
                    <div class="form-floating w-50">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Kepada ; Agus SU.</label>
                    </div>
                    <div class="form-floating md-4 mt-3 w-50">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Yang bener aja rugi dong</label>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary btn-lg mb-2 mt-3 ">Edit</button>
                        <button type="submit" class="btn btn-danger  btn-lg mb-2 mt-3">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="d-flex justify-content-center justify-items-center">
        <div class="card md-3 mt-2 mb-3 w-75" style="background-color: #589BFF;">
            <form>
                <div class="card-body">
                    <div class="form-floating w-50">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Kepada ; Agus SU.</label>
                    </div>
                    <div class="form-floating md-4 mt-3 w-50">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Lu gausah sok asyik !!</label>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div></div>
                        <button type="submit" class="btn btn-success text-white btn-lg mb-2 mt-3">Lihat Tanggapan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>