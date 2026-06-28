<?php
session_start();


if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true || $_SESSION['admin_role'] !== 'admin') {
    header("Location: login.php?error=unauthorized");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita - Triologic Admin</title>
    
    <link class="bootstrap-css" rel="stylesheet" href="../assets/css/bootstrap.min.css">
    
    <link class="custom-css" rel="stylesheet" href="../assets/css/style.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">

    
    <div class="container-fluid">
        <div class="row">
            
            
            <?php include_once "sidebar.php"; ?>

            
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                
                
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                    <div>
                        <h1 class="h2 fw-bold text-dark mb-0">Tambah Berita</h1>
                        <span class="text-muted small">Buat artikel baru untuk portal Triologic</span>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card-modern p-4 p-md-5 bg-white">
                            <form action="berita_proses.php?action=add" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-3" onsubmit="return confirm('Apakah Anda yakin ingin menyimpan berita baru ini?');">
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label for="judul" class="form-label small text-muted fw-bold">Judul Berita</label>
                                        <input type="text" class="form-control form-control-modern" id="judul" name="judul" required placeholder="Masukkan judul berita">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="tanggal" class="form-label small text-muted fw-bold">Tanggal Terbit</label>
                                        <input type="date" class="form-control form-control-modern" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d'); ?>" required>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="author" class="form-label small text-muted fw-bold">Penulis (Author)</label>
                                        <input type="text" class="form-control form-control-modern" id="author" name="author" value="<?php echo isset($_SESSION['admin_username']) ? htmlspecialchars($_SESSION['admin_username']) : ''; ?>" required placeholder="Nama penulis">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="foto" class="form-label small text-muted fw-bold">Upload Foto Berita</label>
                                        <input type="file" class="form-control form-control-modern" id="foto" name="foto" accept="image/*">
                                        <span class="text-muted small fs-7">*Format: JPG, JPEG, PNG (Opsional)</span>
                                    </div>
                                </div>

                                <div>
                                    <label for="isi" class="form-label small text-muted fw-bold">Isi Berita</label>
                                    <textarea class="form-control form-control-modern" id="isi" name="isi" rows="10" required placeholder="Tuliskan isi artikel berita secara lengkap..."></textarea>
                                </div>

                                <div class="border-top pt-4 mt-3 d-flex justify-content-end gap-2">
                                    <a href="index.php?page=berita" class="btn btn-secondary py-2 px-4"><i class="bi bi-x-circle me-1"></i> Batal</a>
                                    <button type="submit" class="btn btn-modern py-2 px-4"><i class="bi bi-save me-1"></i> Simpan Berita</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
