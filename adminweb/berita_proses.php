<?php
session_start();


if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true || $_SESSION['admin_role'] !== 'admin') {
    header("Location: login.php?error=unauthorized");
    exit();
}

include_once "../config/Crud.php";
$crud = new Crud();

$action = isset($_GET['action']) ? trim($_GET['action']) : '';


$upload_dir = __DIR__ . '/../foto_berita/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

if ($action == 'add') {
    $judul = isset($_POST['judul']) ? trim($_POST['judul']) : '';
    $tanggal = isset($_POST['tanggal']) ? trim($_POST['tanggal']) : date('Y-m-d');
    $author = isset($_POST['author']) ? trim($_POST['author']) : 'Admin';
    $isi = isset($_POST['isi']) ? trim($_POST['isi']) : '';
    
    
    $foto_name = "";
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['foto']['tmp_name'];
        $file_orig_name = basename($_FILES['foto']['name']);
        $ext = strtolower(pathinfo($file_orig_name, PATHINFO_EXTENSION));
        
        
        $foto_name = time() . '_' . uniqid() . '.' . $ext;
        $target_file = $upload_dir . $foto_name;
        
        if (!move_uploaded_file($file_tmp, $target_file)) {
            $foto_name = ""; 
        }
    }
    
    $query = "INSERT INTO tb_berita (judul, tanggal, author, foto, isi) VALUES (?, ?, ?, ?, ?)";
    $params = [$judul, $tanggal, $author, $foto_name, $isi];
    $crud->execute($query, $params);
    
    header("Location: index.php");
    exit();

} elseif ($action == 'edit') {
    $id_berita = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id_berita <= 0) {
        header("Location: index.php");
        exit();
    }

    $judul = isset($_POST['judul']) ? trim($_POST['judul']) : '';
    $tanggal = isset($_POST['tanggal']) ? trim($_POST['tanggal']) : date('Y-m-d');
    $author = isset($_POST['author']) ? trim($_POST['author']) : 'Admin';
    $isi = isset($_POST['isi']) ? trim($_POST['isi']) : '';

    
    $select_query = "SELECT foto FROM tb_berita WHERE id_berita = ?";
    $existing = $crud->getData($select_query, [$id_berita]);
    $foto_name = !empty($existing) ? $existing[0]['foto'] : "";

    
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['foto']['tmp_name'];
        $file_orig_name = basename($_FILES['foto']['name']);
        $ext = strtolower(pathinfo($file_orig_name, PATHINFO_EXTENSION));
        
        
        $new_foto_name = time() . '_' . uniqid() . '.' . $ext;
        $target_file = $upload_dir . $new_foto_name;
        
        if (move_uploaded_file($file_tmp, $target_file)) {
            
            if (!empty($foto_name) && file_exists($upload_dir . $foto_name)) {
                @unlink($upload_dir . $foto_name);
            }
            $foto_name = $new_foto_name;
        }
    }

    $query = "UPDATE tb_berita SET judul = ?, tanggal = ?, author = ?, foto = ?, isi = ? WHERE id_berita = ?";
    $params = [$judul, $tanggal, $author, $foto_name, $isi, $id_berita];
    
    $crud->execute($query, $params);
    header("Location: index.php");
    exit();

} elseif ($action == 'delete') {
    $id_berita = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id_berita <= 0) {
        header("Location: index.php");
        exit();
    }

    
    $select_query = "SELECT foto FROM tb_berita WHERE id_berita = ?";
    $existing = $crud->getData($select_query, [$id_berita]);
    
    if (!empty($existing)) {
        $foto_name = $existing[0]['foto'];
        if (!empty($foto_name) && file_exists($upload_dir . $foto_name)) {
            @unlink($upload_dir . $foto_name);
        }
    }

    $query = "DELETE FROM tb_berita WHERE id_berita = ?";
    $params = [$id_berita];
    
    $crud->execute($query, $params);
    header("Location: index.php");
    exit();

} else {
    header("Location: index.php");
    exit();
}
?>
