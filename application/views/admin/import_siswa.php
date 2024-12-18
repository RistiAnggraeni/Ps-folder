<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Data Siswa</title>
    <!-- Link ke Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-4 shadow-lg" style="width: 400px;">
        <h3 class="text-center mb-4" >Import Siswa ke Database</h3>
        <div class="mt-2 mb-4">
            <a href="<?= base_url('assets/template_siswa.xlsx') ?>" class="btn btn-info" style="color: white;" download>Unduh Format Excel</a>
        </div>
        
        <!-- Form untuk mengimpor file Excel -->
        <form action="<?= site_url('excel/import_for_siswa') ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="excelFile" class="form-label">Pilih File Excel</label>
                <input type="file" class="form-control" id="excelFile" name="file" accept=".xlsx, .xls" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Impor Excel</button>
        </form>

        <!-- Link untuk mendownload format Excel -->
        
    </div>
</div>


</body>
</html>
