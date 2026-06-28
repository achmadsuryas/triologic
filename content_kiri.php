<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'home':
        include 'page_home.php';
        break;
    case 'news':
        include 'page_news.php';
        break;
    case 'profil':
        include 'page_profil.php';
        break;
    case 'articles':
        include 'page_articles.php';
        break;
    case 'contact':
        include 'page_contact.php';
        break;
    default:
        include 'page_home.php';
        break;
}
?>
