<?php

include_once __DIR__ . "/config/Crud.php";
$crud = new Crud();

$query = "SELECT * FROM tb_berita ORDER BY id_berita DESC LIMIT 3";
$result = $crud->getData($query);
?>

<div class="row g-4">
    <div class="col-12">
        <h3 class="mb-4 pb-2 border-bottom d-flex align-items-center gap-2">
            <i class="bi bi-newspaper" style="color: var(--primary-color);"></i>
            <span>Kabar Terbaru Kampus</span>
        </h3>
    </div>

    <?php if (!empty($result)): ?>
        <?php foreach ($result as $res): ?>
            <?php
            
            $foto_url = "https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=800&q=80"; 
            if (!empty($res['foto'])) {
                if (file_exists("foto_berita/" . $res['foto'])) {
                    $foto_url = "foto_berita/" . htmlspecialchars($res['foto']);
                } else {
                    
                    if ($res['id_berita'] == 1) {
                        $foto_url = "https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80";
                    } elseif ($res['id_berita'] == 2) {
                        $foto_url = "https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?auto=format&fit=crop&w=800&q=80";
                    } elseif ($res['id_berita'] == 3) {
                        $foto_url = "https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=800&q=80";
                    } elseif ($res['id_berita'] == 4) {
                        $foto_url = "https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&w=800&q=80";
                    }
                }
            }
            
            
            $clean_content = strip_tags($res['isi']);
            $max_chars = 250;
            if (strlen($clean_content) > $max_chars) {
                $isi = substr($clean_content, 0, $max_chars);
                $isi = substr($isi, 0, strrpos($isi, " ")) . '...';
            } else {
                $isi = $clean_content;
            }
            ?>
            <div class="col-12">
                <article class="card-modern">
                    <div class="row g-0">
                        <div class="col-md-4 card-img-wrapper">
                            <img src="<?php echo $foto_url; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($res['judul']); ?>">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4 d-flex flex-column h-100">
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    <span class="badge-date">
                                        <i class="bi bi-clock-fill"></i> 
                                        <?php echo date('d M Y', strtotime($res['tanggal'])); ?>
                                    </span>
                                    <span class="badge-date">
                                        <i class="bi bi-person-fill"></i> 
                                        By: <?php echo htmlspecialchars($res['author']); ?>
                                    </span>
                                </div>
                                <h4 class="card-title mb-3">
                                    <a href="index.php?page=news&id=<?php echo $res['id_berita']; ?>" class="text-decoration-none text-dark hover-primary" style="transition: var(--transition-smooth);">
                                        <?php echo htmlspecialchars($res['judul']); ?>
                                    </a>
                                </h4>
                                <p class="card-text text-muted mb-4"><?php echo htmlspecialchars($isi); ?></p>
                                <div class="mt-auto">
                                    <a href="index.php?page=news&id=<?php echo $res['id_berita']; ?>" class="btn btn-modern-outline btn-sm">
                                        Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>

        
        <div class="col-12 text-center mt-4">
            <a href="index.php?page=articles" class="btn btn-modern px-5 py-2">
                Lihat Semua Artikel <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
        
    <?php else: ?>
        <div class="col-12 text-center py-5">
            <i class="bi bi-info-circle text-muted fs-1 mb-3"></i>
            <h4>Belum Ada Artikel</h4>
            <p class="text-muted">Database `tb_berita` kosong atau koneksi database bermasalah.</p>
        </div>
    <?php endif; ?>
</div>