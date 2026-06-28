<?php
session_start();


if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true || $_SESSION['admin_role'] !== 'admin') {
    header("Location: login.php?error=unauthorized");
    exit();
}

include_once "../config/Crud.php";
$crud = new Crud();

$id_berita = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id_berita <= 0) {
    header("Location: index.php");
    exit();
}

$query = "SELECT * FROM tb_berita WHERE id_berita = '$id_berita'";
$result = $crud->getData($query);

if (empty($result)) {
    header("Location: index.php");
    exit();
}

$berita = $result[0];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita - Triologic Admin</title>
    
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../assets/css/style.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">

    
    <div class="container-fluid">
        <div class="row">
            
            
            <?php include_once "sidebar.php"; ?>

            
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                
                
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                    <div>
                        <h1 class="h2 fw-bold text-dark mb-0">Edit Berita</h1>
                        <span class="text-muted small">Perbarui data artikel portal Triologic</span>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card-modern p-4 p-md-5 bg-white">
                            <form action="berita_proses.php?action=edit&id=<?php echo $berita['id_berita']; ?>" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-3" onsubmit="return confirm('Apakah Anda yakin ingin menyimpan seluruh perubahan pada berita ini?');">
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label for="judul" class="form-label small text-muted fw-bold">Judul Berita</label>
                                        <input type="text" class="form-control form-control-modern" id="judul" name="judul" value="<?php echo htmlspecialchars($berita['judul']); ?>" required placeholder="Masukkan judul berita">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="tanggal" class="form-label small text-muted fw-bold">Tanggal Terbit</label>
                                        <input type="date" class="form-control form-control-modern" id="tanggal" name="tanggal" value="<?php echo htmlspecialchars($berita['tanggal']); ?>" required>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="author" class="form-label small text-muted fw-bold">Penulis (Author)</label>
                                        <input type="text" class="form-control form-control-modern" id="author" name="author" value="<?php echo htmlspecialchars($berita['author']); ?>" required placeholder="Nama penulis">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="foto" class="form-label small text-muted fw-bold">Ganti Foto Berita</label>
                                        <input type="file" class="form-control form-control-modern" id="foto" name="foto" accept="image/*">
                                        <span class="text-muted small fs-7">*Kosongkan jika tidak ingin mengganti foto</span>
                                    </div>
                                </div>

                                <div>
                                    <label for="isi" class="form-label small text-muted fw-bold">Isi Berita</label>
                                    <textarea class="form-control form-control-modern" id="isi" name="isi" rows="10" required placeholder="Tuliskan isi artikel berita secara lengkap..."><?php echo htmlspecialchars($berita['isi']); ?></textarea>
                                </div>

                                <div class="border-top pt-4 mt-3 d-flex justify-content-end gap-2">
                                    <a href="index.php?page=berita" class="btn btn-secondary py-2 px-4"><i class="bi bi-x-circle me-1"></i> Batal</a>
                                    <button type="submit" class="btn btn-modern py-2 px-4"><i class="bi bi-save me-1"></i> Simpan Perubahan</button>
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
