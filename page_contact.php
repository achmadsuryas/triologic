<?php
$success_msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';
    
    if (!empty($name) && !empty($email) && !empty($message)) {
        $success_msg = "Terima kasih, <b>$name</b>. Pesan Anda telah berhasil dikirim! Redaksi Trilogi Blog akan segera membaca dan merespons.";
    }
}
?>

<div class="row g-4">
    <div class="col-12">
        <h3 class="mb-4 pb-2 border-bottom d-flex align-items-center gap-2">
            <i class="bi bi-envelope" style="color: var(--primary-color);"></i>
            <span>Hubungi Kami</span>
        </h3>
    </div>

    <div class="col-12">
        <div class="card-modern p-4 p-md-5">
            <?php if (!empty($success_msg)): ?>
                <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> <?php echo $success_msg; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="row g-4">
                
                <div class="col-md-5">
                    <h4 class="fw-bold mb-3" style="color: var(--primary-color);">Sekretariat Redaksi</h4>
                    <p class="text-muted small mb-4">Punya saran berita, pengaduan hal receh, atau ingin membagikan review makanan enak di PJP/Kantin? Hubungi redaksi kami secara langsung.</p>
                    
                    <div class="d-flex align-items-start gap-3 mb-3">
                        <div class="bg-light p-2 rounded text-primary">
                            <i class="bi bi-geo-alt-fill fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Alamat Redaksi</h6>
                            <p class="text-muted small mb-0">Kampus Universitas Trilogi, Jl. TPU Kalibata No. 1, Duren Tiga, Pancoran, Jakarta Selatan, 12760</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 mb-3">
                        <div class="bg-light p-2 rounded text-primary">
                            <i class="bi bi-telephone-fill fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Telepon</h6>
                            <p class="text-muted small mb-0">+62 21 798 0011</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="bg-light p-2 rounded text-primary">
                            <i class="bi bi-envelope-fill fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Email</h6>
                            <p class="text-muted small mb-0">redaksi@trilogi.ac.id</p>
                        </div>
                    </div>

                    
                    <div class="rounded-3 overflow-hidden border shadow-sm" style="height: 180px;">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1558231268393!2d106.84883497457805!3d-6.243187161135246!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3beb0662d5f%3A0x6b306b47c0b05b87!2sUniversitas%20Trilogi!5e0!3m2!1sid!2sid!4v1719573000000!5m2!1sid!2sid" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                
                <div class="col-md-7">
                    <h4 class="fw-bold mb-3" style="color: var(--primary-color);">Kirim Masukan / Tips Berita</h4>
                    <form action="index.php?page=contact" method="POST" class="d-flex flex-column gap-3">
                        <div>
                            <label for="name" class="form-label fw-600 small text-muted">Nama Lengkap</label>
                            <input type="text" class="form-control form-control-modern" id="name" name="name" placeholder="Masukkan nama Anda" required>
                        </div>
                        <div>
                            <label for="email" class="form-label fw-600 small text-muted">Alamat Email</label>
                            <input type="email" class="form-control form-control-modern" id="email" name="email" placeholder="nama@email.com" required>
                        </div>
                        <div>
                            <label for="message" class="form-label fw-600 small text-muted">Pesan / Tips Berita</label>
                            <textarea class="form-control form-control-modern" id="message" name="message" rows="5" placeholder="Tuliskan pesan, kontribusi artikel, atau tips kuliner PJP Anda disini..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-modern w-100 py-2">
                            Kirim Masukan <i class="bi bi-send-fill ms-1"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
