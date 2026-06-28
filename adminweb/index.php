<?php
session_start();


if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true || $_SESSION['admin_role'] !== 'admin') {
    header("Location: login.php?error=unauthorized");
    exit();
}

include_once "../config/Crud.php";
$crud = new Crud();

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';


if ($page == 'dashboard') {

    $res_count = $crud->getData("SELECT COUNT(*) AS total FROM tb_berita");
    $total_berita = !empty($res_count) ? $res_count[0]['total'] : 0;

    
    $res_last = $crud->getData("SELECT MAX(tanggal) AS terakhir FROM tb_berita");
    $terakhir_upload = (!empty($res_last) && $res_last[0]['terakhir'] !== null) ? date('d M Y', strtotime($res_last[0]['terakhir'])) : '-';

    
    $res_auth = $crud->getData("SELECT COUNT(DISTINCT author) AS total_author FROM tb_berita");
    $total_author = !empty($res_auth) ? $res_auth[0]['total_author'] : 0;
} else {
    
    $result = $crud->getData("SELECT * FROM tb_berita ORDER BY id_berita DESC");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Triologic</title>
    
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../assets/css/style.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">

    
    <div class="container-fluid">
        <div class="row">
            
            
            <?php include_once "sidebar.php"; ?>

            
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                
                
                <?php if ($page == 'dashboard'): ?>
                    <div class="mb-1 pt-2">
                        <span class="text-muted fw-semibold small">Selamat Datang, <?php echo isset($_SESSION['admin_username']) ? htmlspecialchars($_SESSION['admin_username']) : 'Admin'; ?>!</span>
                    </div>
                <?php endif; ?>

                
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-4 border-bottom">
                    <div>
                        <h1 class="h2 fw-bold text-dark mb-0">
                            <?php echo ($page == 'berita') ? 'Kelola Berita' : 'Dashboard Admin'; ?>
                        </h1>
                        <span class="text-muted small">Panel Kontrol Triologic Portal</span>
                    </div>
                </div>

                <?php if ($page == 'dashboard'): ?>
                    
                    <div class="row g-4 mb-4">
                        
                        <div class="col-md-4">
                            <div class="card-modern p-4 d-flex align-items-center justify-content-between bg-white">
                                <div>
                                    <h6 class="text-muted fw-bold small text-uppercase mb-1">Total Artikel</h6>
                                    <h2 class="fw-bold mb-0 text-dark"><?php echo $total_berita; ?></h2>
                                </div>
                                <div class="bg-primary text-white p-3 rounded" style="background-color: var(--primary-color) !important;">
                                    <i class="bi bi-newspaper fs-3"></i>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-4">
                            <div class="card-modern p-4 d-flex align-items-center justify-content-between bg-white">
                                <div>
                                    <h6 class="text-muted fw-bold small text-uppercase mb-1">Update Terakhir</h6>
                                    <h2 class="fw-bold mb-0 text-dark" style="font-size: 1.5rem;"><?php echo $terakhir_upload; ?></h2>
                                </div>
                                <div class="bg-success text-white p-3 rounded">
                                    <i class="bi bi-calendar-check fs-3"></i>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-md-4">
                            <div class="card-modern p-4 d-flex align-items-center justify-content-between bg-white">
                                <div>
                                    <h6 class="text-muted fw-bold small text-uppercase mb-1">Jumlah Penulis</h6>
                                    <h2 class="fw-bold mb-0 text-dark"><?php echo $total_author; ?></h2>
                                </div>
                                <div class="bg-info text-white p-3 rounded" style="background-color: var(--secondary-color) !important;">
                                    <i class="bi bi-people fs-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php else: ?>
                    
                    <div class="row g-4">
                        <?php if ($_SESSION['admin_role'] === 'admin'): ?>
                        <div class="col-12 text-end">
                            <a href="berita_tambah.php" class="btn btn-modern">
                                <i class="bi bi-plus-circle me-1"></i> Tambah Berita Baru
                            </a>
                        </div>
                        <?php endif; ?>
                        <div class="col-12">
                            <div class="card-modern p-4 bg-white">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover align-middle mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th style="width: 60px;" class="text-center">No</th>
                                                <th>Judul Berita</th>
                                                <th style="width: 150px;">Tanggal</th>
                                                <th style="width: 150px;">Author</th>
                                                <th style="width: 100px;" class="text-center">Foto</th>
                                                <?php if ($_SESSION['admin_role'] === 'admin'): ?>
                                                <th style="width: 160px;" class="text-center">Aksi</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($result)): ?>
                                                <?php $no = 1; foreach ($result as $res): ?>
                                                    <tr>
                                                        <td class="text-center fw-bold"><?php echo $no++; ?></td>
                                                        <td>
                                                            <span class="fw-semibold"><?php echo htmlspecialchars($res['judul']); ?></span>
                                                        </td>
                                                        <td><?php echo date('d M Y', strtotime($res['tanggal'])); ?></td>
                                                        <td><span class="badge bg-secondary"><?php echo htmlspecialchars($res['author']); ?></span></td>
                                                        <td class="text-center">
                                                            <?php if (!empty($res['foto'])): ?>
                                                                <?php
                                                                $foto_path = "../foto_berita/" . htmlspecialchars($res['foto']);
                                                                
                                                                if (!file_exists($foto_path)) {
                                                                    if ($res['id_berita'] == 1) {
                                                                        $foto_path = "https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&w=150&q=80";
                                                                    } elseif ($res['id_berita'] == 2) {
                                                                        $foto_path = "https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=150&q=80";
                                                                    } elseif ($res['id_berita'] == 3) {
                                                                        $foto_path = "https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?auto=format&fit=crop&w=150&q=80";
                                                                    } elseif ($res['id_berita'] == 4) {
                                                                        $foto_path = "https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=150&q=80";
                                                                    }
                                                                }
                                                                ?>
                                                                <img src="<?php echo $foto_path; ?>" alt="Preview" class="rounded" style="width: 50px; height: 38px; object-fit: cover; border: 1px solid #cbd5e1;">
                                                            <?php else: ?>
                                                                <span class="text-muted small">-</span>
                                                            <?php endif; ?>
                                                        </td>
                                                         <?php if ($_SESSION['admin_role'] === 'admin'): ?>
                                                         <td class="text-center">
                                                             <div class="d-flex justify-content-center gap-2">
                                                                 <a href="berita_edit.php?id=<?php echo $res['id_berita']; ?>" class="btn btn-warning btn-sm text-dark fw-bold">
                                                                     <i class="bi bi-pencil-square"></i> Edit
                                                                 </a>
                                                                 <a href="berita_proses.php?action=delete&id=<?php echo $res['id_berita']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                                                     <i class="bi bi-trash"></i> Hapus
                                                                 </a>
                                                             </div>
                                                         </td>
                                                         <?php endif; ?>
                                                    </tr>
                                                <?php endforeach; ?>
                                             <?php else: ?>
                                                 <tr>
                                                     <td colspan="<?php echo ($_SESSION['admin_role'] === 'admin') ? '6' : '5'; ?>" class="text-center py-4 text-muted">Belum ada berita.</td>
                                                 </tr>
                                             <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </main>
        </div>
    </div>

    
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
