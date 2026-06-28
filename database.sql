CREATE DATABASE IF NOT EXISTS `db_triologic` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `db_triologic`;

DROP TABLE IF EXISTS `tb_berita`;
CREATE TABLE `tb_berita` (
  `id_berita` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_berita`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_berita` (`id_berita`, `judul`, `isi`, `tanggal`, `author`, `foto`) VALUES
(1, 'Mengenal Framework PHP Modern di Era Web Modern', 'Perkembangan dunia pengembangan web terus bergulir dengan sangat cepat di era web modern saat ini. Di tengah bermunculannya berbagai teknologi JavaScript, bahasa pemrograman PHP tetap berdiri tegak sebagai fondasi utama dari jutaan website di seluruh dunia. Artikel ini membahas evolusi framework PHP modern seperti Laravel 11 dan Symfony yang menawarkan arsitektur bersih, performa optimal, serta efisiensi pengembangan tinggi yang penting untuk dipelajari oleh mahasiswa Universitas Trilogi.', '2026-06-28', 'Admin IT', 'php_frameworks.jpg'),
(2, 'Kisah humor kucing oren kampus bernama \"Miko\" yang gemar ikut tidur di ruang kuliah.', 'Kehidupan di kampus Universitas Trilogi selalu diwarnai oleh kisah unik. Salah satunya datang dari Miko, seekor kucing oren berbadan gempal yang sangat ramah. Alih-alih mencari makan, hobi utama Miko adalah menyelinap masuk ke ruang kuliah saat dosen sedang mengajar, terutama pada kelas kuliah pagi jam 8. Dengan santainya Miko akan meringkuk di bawah meja dosen atau bahkan menduduki tas mahasiswa untuk tidur nyenyak. Tingkah lucu Miko ini kerap mengundang tawa dan menjadi pereda stres tersendiri bagi para mahasiswa.', '2026-06-27', 'Mahasiswa Kreatif', 'kucing_miko.jpg'),
(3, 'Menu makanan nasi goreng PJP.', 'Jika berkunjung ke area Pusat Jajanan Pemuda (PJP) Universitas Trilogi, menu makanan nasi goreng PJP adalah sajian kuliner yang paling direkomendasikan. Nasi goreng ini diracik dengan bumbu halus tradisional yang gurih serta disajikan panas dengan pelengkap telur dadar dan kerupuk renyah. Porsinya yang sangat mengenyangkan dengan harga bersahabat menjadikannya andalan utama mahasiswa untuk makan siang setelah lelah beraktivitas kuliah seharian.', '2026-06-26', 'Foodie Kampus', 'kuliner_pjp.jpg'),
(4, 'festival seni musik tahunan \"Trilogi Fest 2026\"', 'Kabar gembira bagi pecinta seni dan musik! Pagelaran festival seni musik tahunan \"Trilogi Fest 2026\" secara resmi akan diselenggarakan kembali di lapangan utama Universitas Trilogi. Acara ini akan menyuguhkan kolaborasi spektakuler antara musisi papan atas nasional dengan pertunjukan seni kreatif dari Unit Kegiatan Mahasiswa (UKM). Pihak panitia menjanjikan panggung megah, bazar kuliner mahasiswa yang meriah, dan atmosfer pertunjukan tak terlupakan.', '2026-06-25', 'BEM Kampus', 'event_festival.jpg');


DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `role`, `nama`) VALUES
(1, 'admin', MD5('admin'), 'admin', 'Administrator Kampus'),
(2, 'user', MD5('user'), 'user', 'Mahasiswa Universitas Trilogi');
