<?php
$current_page = basename($_SERVER['PHP_SELF']);
$page_param = isset($_GET['page']) ? $_GET['page'] : 'dashboard';


$is_dashboard_active = ($current_page == 'index.php' && $page_param == 'dashboard');
$is_berita_active = ($current_page == 'index.php' && $page_param == 'berita') || strpos($current_page, 'berita_') === 0;
?>
<div class="col-md-3 col-lg-2 bg-dark text-white p-0 min-vh-100 d-flex flex-column" style="border-right: 1px solid #334155;">
    
    <div class="p-3 text-center border-bottom border-secondary" style="background-color: #0f172a;">
        <h4 class="fw-bold mb-0 text-white">triologic</h4>
        <span class="text-secondary small fw-semibold">Admin Panel</span>
    </div>
    
    
    <div class="nav flex-column nav-pills p-3 gap-2 flex-grow-1">
        <a class="nav-link text-white <?php echo $is_dashboard_active ? 'active' : ''; ?>" 
           href="index.php?page=dashboard" 
           style="<?php echo $is_dashboard_active ? 'background-color: var(--primary-color) !important; border-radius: 4px;' : ''; ?>">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
        <a class="nav-link text-white <?php echo $is_berita_active ? 'active' : ''; ?>" 
           href="index.php?page=berita" 
           style="<?php echo $is_berita_active ? 'background-color: var(--primary-color) !important; border-radius: 4px;' : ''; ?>">
            <i class="bi bi-newspaper me-2"></i> Berita
        </a>
        <a class="nav-link text-white" href="../index.php" target="_blank">
            <i class="bi bi-globe me-2"></i> Lihat Web <i class="bi bi-box-arrow-up-right small ms-1" style="font-size: 0.75rem;"></i>
        </a>
    </div>

    
    <div class="p-3 border-top border-secondary mt-auto" style="background-color: #0f172a;">
        <div class="d-flex align-items-center justify-content-between">
            <span class="small text-white-50 text-truncate me-2" title="<?php echo isset($_SESSION['admin_nama']) ? htmlspecialchars($_SESSION['admin_nama']) : 'Administrator'; ?>">
                <i class="bi bi-person-fill"></i> <?php echo isset($_SESSION['admin_username']) ? htmlspecialchars($_SESSION['admin_username']) : 'admin'; ?> (<?php echo isset($_SESSION['admin_role']) ? htmlspecialchars($_SESSION['admin_role']) : 'admin'; ?>)
            </span>
            <a href="logout.php" class="btn btn-danger btn-sm text-white fw-bold py-1 px-2" style="font-size: 0.8rem;">
                <i class="bi bi-box-arrow-left"></i> Logout
            </a>
        </div>
    </div>
</div>
