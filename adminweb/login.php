<?php
session_start();

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: index.php");
    exit();
}

include_once __DIR__ . "/../config/Crud.php";
$crud = new Crud();

$error = "";
if (isset($_GET['error']) && $_GET['error'] === 'unauthorized') {
    $error = "Akses ditolak! Anda tidak memiliki wewenang untuk masuk ke panel admin.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (!empty($username) && !empty($password)) {
        $query = "SELECT * FROM tb_user WHERE username = ? AND password = ?";
        $result = $crud->getData($query, [$username, md5($password)]);

        if (!empty($result)) {
            $user = $result[0];
            if ($user['role'] !== 'admin') {
                $error = "Akses ditolak! Hanya akun Administrator yang dapat mengakses panel ini.";
            } else {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $user['username'];
                $_SESSION['admin_role'] = $user['role'];
                $_SESSION['admin_nama'] = $user['nama'];
                header("Location: index.php");
                exit();
            }
        } else {
            $error = "Username atau password salah!";
        }
    } else {
        $error = "Username dan password wajib diisi!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Triologic</title>
    
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            background-color: #f1f5f9;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 2.5rem;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="text-center mb-4">
            <h3 class="fw-bold mb-1" style="color: var(--primary-color);">triologic</h3>
            <span class="text-muted small">Panel Administrasi</span>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger py-2 small" role="alert">
                <i class="bi bi-exclamation-circle me-1"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST" class="d-flex flex-column gap-3">
            <div>
                <label for="username" class="form-label small text-muted fw-bold">Username</label>
                <input type="text" class="form-control form-control-modern" id="username" name="username" required placeholder="Masukkan username">
            </div>
            <div>
                <label for="password" class="form-label small text-muted fw-bold">Password</label>
                <input type="password" class="form-control form-control-modern" id="password" name="password" required placeholder="Masukkan password">
            </div>
            <button type="submit" class="btn btn-modern w-100 mt-2 py-2">Login</button>
        </form>
        <div class="text-center mt-4">
            <a href="../index.php" class="text-decoration-none small text-muted"><i class="bi bi-arrow-left"></i> Kembali ke Website</a>
        </div>
    </div>

</body>
</html>
