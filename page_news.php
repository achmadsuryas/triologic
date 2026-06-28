<?php

include_once __DIR__ . "/config/Crud.php";
$crud = new Crud();


$id_berita = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT * FROM tb_berita WHERE id_berita = '$id_berita'";
$result = $crud->getData($query);
?>

<div class="row">


    <?php if (!empty($result)): ?>
        <?php foreach ($result as $res): ?>
            <?php
            
            $foto_url = "https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=1200&q=80"; 
            if (!empty($res['foto'])) {
                if (file_exists("foto_berita/" . $res['foto'])) {
                    $foto_url = "foto_berita/" . htmlspecialchars($res['foto']);
                } else {
                    
                    if ($res['id_berita'] == 1) {
                        $foto_url = "https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&w=1200&q=80";
                    } elseif ($res['id_berita'] == 2) {
                        $foto_url = "https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=1200&q=80";
                    } elseif ($res['id_berita'] == 3) {
                        $foto_url = "https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=1200&q=80";
                    } elseif ($res['id_berita'] == 4) {
                        $foto_url = "https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=1200&q=80";
                    }
                }
            }
            ?>
            <div class="col-12">
                <article class="card-modern p-4 p-md-5">
                    
                    <header class="mb-4">
                        <h1 class="display-5 fw-bold mb-3" style="color: #0f172a; font-family: var(--font-heading);">
                            <?php echo htmlspecialchars($res['judul']); ?>
                        </h1>
                        <div class="d-flex flex-wrap gap-3 align-items-center text-muted">
                            <span class="badge-date">
                                <i class="bi bi-calendar-event-fill"></i> 
                                <?php echo date('d F Y', strtotime($res['tanggal'])); ?>
                            </span>
                            <span class="badge-date">
                                <i class="bi bi-person-fill"></i> 
                                Author: <?php echo htmlspecialchars($res['author']); ?>
                            </span>
                        </div>
                    </header>

                    
                    <div class="mb-4 rounded-3 overflow-hidden shadow-sm" style="max-height: 480px;">
                        <img src="<?php echo $foto_url; ?>" class="w-100 h-100 object-fit-cover" alt="<?php echo htmlspecialchars($res['judul']); ?>" style="object-fit: cover;">
                    </div>

                    
                    <div class="entry-content text-muted lh-lg fs-6 mb-5" style="text-align: justify;">
                        <?php echo nl2br($res['isi']); ?>
                    </div>

                    
                    <footer class="border-top pt-4">
                        <a href="index.php?page=home" class="btn btn-modern">
                            <i class="bi bi-arrow-left me-1"></i> Kembali ke Home
                        </a>
                    </footer>
                </article>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12 text-center py-5">
            <i class="bi bi-exclamation-triangle text-warning fs-1 mb-3"></i>
            <h4>Artikel Tidak Ditemukan</h4>
            <p class="text-muted">Artikel yang Anda cari tidak tersedia atau telah dihapus.</p>
            <a href="index.php?page=home" class="btn btn-modern mt-3"><i class="bi bi-arrow-left me-1"></i> Kembali ke Home</a>
        </div>
    <?php endif; ?>
</div>