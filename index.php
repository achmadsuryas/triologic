<?php

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Triologic - Seputar Kampus Universitas Trilogi</title>
    
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="assets/css/style.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

    
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">triologic</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page == 'home' || $page == 'news') ? 'active' : ''; ?>" href="index.php?page=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page == 'articles') ? 'active' : ''; ?>" href="index.php?page=articles">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page == 'profil') ? 'active' : ''; ?>" href="index.php?page=profil">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page == 'contact') ? 'active' : ''; ?>" href="index.php?page=contact">Contacts</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-light btn-sm mt-1 mt-lg-0 text-dark fw-bold" href="adminweb/login.php"><i class="bi bi-person-fill"></i> Admin Panel</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    
    <div class="container my-4">
        
        
        <div class="hero-section mb-4">
            <div class="row">
                <div class="col-12">
                    <span class="badge badge-custom mb-2">Kabar & Cerita Kampus</span>
                    <h1 class="hero-title mb-2">Seputar Cerita dan Event di Universitas Trilogi</h1>
                    <p class="hero-subtitle mb-3">Wadah informasi mahasiswa mulai dari info event kampus terupdate, curhatan & hal-hal receh sehari-hari, hingga rekomendasi kuliner enak di kantin dan PJP!</p>
                    <div class="d-flex gap-2">
                        <a href="index.php?page=profil" class="btn btn-modern">Pelajari Selengkapnya</a>
                        <a href="index.php?page=contact" class="btn btn-modern-outline">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row g-4">
            
            
            <div class="col-lg-8">
                <div class="pe-lg-2">
                    <?php
                        require_once "content_kiri.php";
                    ?>
                </div>
            </div>

            
            <div class="col-lg-4">
                <aside class="sidebar-wrapper">
                    <?php
                        require_once "content_kanan.php";
                    ?>
                </aside>
            </div>

        </div>
    </div>

    
    <footer class="footer-modern py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0 text-white-50 small">&copy; 2026 Triologic. All rights reserved.</p>
        </div>
    </footer>

    
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
