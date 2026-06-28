<?php

include_once __DIR__ . "/config/Crud.php";
$crud = new Crud();


$query = "SELECT * FROM tb_berita ORDER BY id_berita DESC LIMIT 3";
$result = $crud->getData($query);
?>


<div class="card-modern p-4 mb-4">
    <h5 class="sidebar-title">LATEST UPDATES</h5>
    <div class="d-flex flex-column gap-3">
        <?php if (!empty($result)): ?>
            <?php foreach ($result as $res): ?>
                <div class="update-item">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="badge-date">
                            <i class="bi bi-clock"></i> 
                            <?php echo date('d M Y', strtotime($res['tanggal'])); ?>
                        </span>
                    </div>
                    <h6 class="mb-0">
                        <a href="index.php?page=news&id=<?php echo $res['id_berita']; ?>">
                            <?php echo htmlspecialchars($res['judul']); ?>
                        </a>
                    </h6>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted small mb-0">Belum ada berita terbaru.</p>
        <?php endif; ?>
    </div>
</div>