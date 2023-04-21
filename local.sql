-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               8.0.32 - MySQL Community Server - GPL
-- Server OS:                    Linux
-- HeidiSQL Version:             12.4.0.6665
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for unic5432_beasiswa
DROP DATABASE IF EXISTS `unic5432_beasiswa`;
CREATE DATABASE IF NOT EXISTS `unic5432_beasiswa` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `unic5432_beasiswa`;

-- Dumping structure for table unic5432_beasiswa.ci_session
DROP TABLE IF EXISTS `ci_session`;
CREATE TABLE IF NOT EXISTS `ci_session` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table unic5432_beasiswa.ci_session: ~2 rows (approximately)
DELETE FROM `ci_session`;
INSERT INTO `ci_session` (`id`, `ip_address`, `timestamp`, `data`) VALUES
	('0eb928e7ab37b8f9a8386f7ac20b9e6577b88b16', '172.21.0.1', 1680243678, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313638303234333637383b757365725f69647c733a353a223133313730223b757365725f6b617465676f72695f69647c733a313a2233223b757365725f6e696b7c733a31363a2231353731303534353037383230303032223b757365725f656d61696c7c733a32333a227472696173666168727564696e40676d61696c2e636f6d223b757365725f6e616d615f6c656e676b61707c733a32323a226b6972616e612e6176616c6f6b697465736876617261223b757365725f6c6576656c7c733a373a2270657365727461223b),
	('0f49676bbae252b8183f0ec3c6f28569fb79dbfa', '172.21.0.1', 1680241628, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313638303234313632383b757365725f69647c733a353a223133313730223b757365725f6b617465676f72695f69647c733a313a2233223b757365725f6e696b7c733a31363a2231353731303534353037383230303032223b757365725f656d61696c7c733a32333a227472696173666168727564696e40676d61696c2e636f6d223b757365725f6e616d615f6c656e676b61707c733a32323a226b6972616e612e6176616c6f6b697465736876617261223b757365725f6c6576656c7c733a373a2270657365727461223b),
	('16d5b2e9264ac1d62e75a625f182139897003522', '172.21.0.1', 1680242586, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313638303234323538363b757365725f69647c733a353a223133313730223b757365725f6b617465676f72695f69647c733a313a2233223b757365725f6e696b7c733a31363a2231353731303534353037383230303032223b757365725f656d61696c7c733a32333a227472696173666168727564696e40676d61696c2e636f6d223b757365725f6e616d615f6c656e676b61707c733a32323a226b6972616e612e6176616c6f6b697465736876617261223b757365725f6c6576656c7c733a373a2270657365727461223b),
	('18dab8a64621cbefcb3bf5c1ed3ded44084c2d5c', '172.21.0.1', 1680248444, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313638303234383233393b757365725f69647c733a353a223133313730223b757365725f6b617465676f72695f69647c733a313a2237223b757365725f6e696b7c733a31363a2231353731303534353037383230303032223b757365725f656d61696c7c733a32333a227472696173666168727564696e40676d61696c2e636f6d223b757365725f6e616d615f6c656e676b61707c733a32323a226b6972616e612e6176616c6f6b697465736876617261223b757365725f6c6576656c7c733a373a2270657365727461223b),
	('1a8f7f0ac558e7733c6ab93f0c8de60f0e0cbfd0', '172.21.0.1', 1680242261, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313638303234323236313b757365725f69647c733a353a223133313730223b757365725f6b617465676f72695f69647c733a313a2233223b757365725f6e696b7c733a31363a2231353731303534353037383230303032223b757365725f656d61696c7c733a32333a227472696173666168727564696e40676d61696c2e636f6d223b757365725f6e616d615f6c656e676b61707c733a32323a226b6972616e612e6176616c6f6b697465736876617261223b757365725f6c6576656c7c733a373a2270657365727461223b),
	('4096f957c886f6c2750dcc3862adbba24484b2c4', '172.21.0.1', 1680245538, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313638303234353533383b757365725f69647c733a353a223133313730223b757365725f6b617465676f72695f69647c733a313a2233223b757365725f6e696b7c733a31363a2231353731303534353037383230303032223b757365725f656d61696c7c733a32333a227472696173666168727564696e40676d61696c2e636f6d223b757365725f6e616d615f6c656e676b61707c733a32323a226b6972616e612e6176616c6f6b697465736876617261223b757365725f6c6576656c7c733a373a2270657365727461223b),
	('444ef9f885041e9cb4f9e1a54bf5ec5f84384501', '172.21.0.1', 1680240902, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313638303234303930323b757365725f69647c733a353a223133313730223b757365725f6b617465676f72695f69647c733a313a2233223b757365725f6e696b7c733a31363a2231353731303534353037383230303032223b757365725f656d61696c7c733a32333a227472696173666168727564696e40676d61696c2e636f6d223b757365725f6e616d615f6c656e676b61707c733a32323a226b6972616e612e6176616c6f6b697465736876617261223b757365725f6c6576656c7c733a373a2270657365727461223b),
	('4e30b9c55b82709f670caa1c70a73a1b3c073181', '172.21.0.1', 1680244635, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313638303234343633353b757365725f69647c733a353a223133313730223b757365725f6b617465676f72695f69647c733a313a2233223b757365725f6e696b7c733a31363a2231353731303534353037383230303032223b757365725f656d61696c7c733a32333a227472696173666168727564696e40676d61696c2e636f6d223b757365725f6e616d615f6c656e676b61707c733a32323a226b6972616e612e6176616c6f6b697465736876617261223b757365725f6c6576656c7c733a373a2270657365727461223b),
	('749f88a479014da2cf6b8eecf4c702b45048cfe7', '172.21.0.1', 1680246052, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313638303234363035323b757365725f69647c733a353a223133313730223b757365725f6b617465676f72695f69647c733a313a2233223b757365725f6e696b7c733a31363a2231353731303534353037383230303032223b757365725f656d61696c7c733a32333a227472696173666168727564696e40676d61696c2e636f6d223b757365725f6e616d615f6c656e676b61707c733a32323a226b6972616e612e6176616c6f6b697465736876617261223b757365725f6c6576656c7c733a373a2270657365727461223b),
	('8bbcfec8a4915628ddcf636ba149a81ccaed367d', '172.21.0.1', 1680241264, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313638303234313236343b757365725f69647c733a353a223133313730223b757365725f6b617465676f72695f69647c733a313a2233223b757365725f6e696b7c733a31363a2231353731303534353037383230303032223b757365725f656d61696c7c733a32333a227472696173666168727564696e40676d61696c2e636f6d223b757365725f6e616d615f6c656e676b61707c733a32323a226b6972616e612e6176616c6f6b697465736876617261223b757365725f6c6576656c7c733a373a2270657365727461223b),
	('968951f8a972cc2c6b4510c322b3eebadb6f920f', '172.21.0.1', 1680247836, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313638303234373833363b757365725f69647c733a353a223133313730223b757365725f6b617465676f72695f69647c733a313a2237223b757365725f6e696b7c733a31363a2231353731303534353037383230303032223b757365725f656d61696c7c733a32333a227472696173666168727564696e40676d61696c2e636f6d223b757365725f6e616d615f6c656e676b61707c733a32323a226b6972616e612e6176616c6f6b697465736876617261223b757365725f6c6576656c7c733a373a2270657365727461223b),
	('98f6d4fe233e0021cc6f31edf01faa3b8050b3a7', '172.21.0.1', 1680241931, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313638303234313933313b757365725f69647c733a353a223133313730223b757365725f6b617465676f72695f69647c733a313a2233223b757365725f6e696b7c733a31363a2231353731303534353037383230303032223b757365725f656d61696c7c733a32333a227472696173666168727564696e40676d61696c2e636f6d223b757365725f6e616d615f6c656e676b61707c733a32323a226b6972616e612e6176616c6f6b697465736876617261223b757365725f6c6576656c7c733a373a2270657365727461223b),
	('9ed2f728f3873137a63c099d00dbaf9f8b681ee8', '172.21.0.1', 1680242930, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313638303234323933303b757365725f69647c733a353a223133313730223b757365725f6b617465676f72695f69647c733a313a2233223b757365725f6e696b7c733a31363a2231353731303534353037383230303032223b757365725f656d61696c7c733a32333a227472696173666168727564696e40676d61696c2e636f6d223b757365725f6e616d615f6c656e676b61707c733a32323a226b6972616e612e6176616c6f6b697465736876617261223b757365725f6c6576656c7c733a373a2270657365727461223b),
	('b39467a80e1f9d842421f911117c02eade4c81cc', '172.21.0.1', 1680246497, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313638303234363439373b757365725f69647c733a353a223133313730223b757365725f6b617465676f72695f69647c733a313a2233223b757365725f6e696b7c733a31363a2231353731303534353037383230303032223b757365725f656d61696c7c733a32333a227472696173666168727564696e40676d61696c2e636f6d223b757365725f6e616d615f6c656e676b61707c733a32323a226b6972616e612e6176616c6f6b697465736876617261223b757365725f6c6576656c7c733a373a2270657365727461223b),
	('b9081b63b0c32d36afcc365f418c964bde627148', '172.21.0.1', 1680244077, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313638303234343037373b757365725f69647c733a353a223133313730223b757365725f6b617465676f72695f69647c733a313a2233223b757365725f6e696b7c733a31363a2231353731303534353037383230303032223b757365725f656d61696c7c733a32333a227472696173666168727564696e40676d61696c2e636f6d223b757365725f6e616d615f6c656e676b61707c733a32323a226b6972616e612e6176616c6f6b697465736876617261223b757365725f6c6576656c7c733a373a2270657365727461223b),
	('c0dff22027689a10cb64d296ee372217d88dec23', '172.21.0.1', 1680248239, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313638303234383233393b757365725f69647c733a353a223133313730223b757365725f6b617465676f72695f69647c733a313a2237223b757365725f6e696b7c733a31363a2231353731303534353037383230303032223b757365725f656d61696c7c733a32333a227472696173666168727564696e40676d61696c2e636f6d223b757365725f6e616d615f6c656e676b61707c733a32323a226b6972616e612e6176616c6f6b697465736876617261223b757365725f6c6576656c7c733a373a2270657365727461223b),
	('e8d9eae78c880bcc89da47f29fcd9a21f8742ccd', '172.21.0.1', 1680243232, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313638303234333233323b757365725f69647c733a353a223133313730223b757365725f6b617465676f72695f69647c733a313a2233223b757365725f6e696b7c733a31363a2231353731303534353037383230303032223b757365725f656d61696c7c733a32333a227472696173666168727564696e40676d61696c2e636f6d223b757365725f6e616d615f6c656e676b61707c733a32323a226b6972616e612e6176616c6f6b697465736876617261223b757365725f6c6576656c7c733a373a2270657365727461223b);

-- Dumping structure for table unic5432_beasiswa.dokumen_pendaftar
DROP TABLE IF EXISTS `dokumen_pendaftar`;
CREATE TABLE IF NOT EXISTS `dokumen_pendaftar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pendaftar_id` int NOT NULL,
  `jenis_dokumen_id` int NOT NULL,
  `file_dokumen` varchar(500) NOT NULL,
  `verifikasi` enum('pending','ditolak','diterima') DEFAULT 'pending',
  `verifikator_id` int DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pendaftar_id_jenis_dokumen_id` (`pendaftar_id`,`jenis_dokumen_id`),
  KEY `verifikasi` (`verifikasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table unic5432_beasiswa.dokumen_pendaftar: ~29,278 rows (approximately)
DELETE FROM `dokumen_pendaftar`;

-- Dumping structure for table unic5432_beasiswa.faq
DROP TABLE IF EXISTS `faq`;
CREATE TABLE IF NOT EXISTS `faq` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pertanyaan` varchar(200) NOT NULL,
  `jawaban` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Dumping data for table unic5432_beasiswa.faq: ~26 rows (approximately)
DELETE FROM `faq`;
INSERT INTO `faq` (`id`, `pertanyaan`, `jawaban`) VALUES
	(1, 'Bagaimana cara melakukan pendaftaran online ?', '<p>Klik link pendaftaran pada halaman pendaftaran beasiswa, masukkan Nomor Induk Kependudukan (NIK) dan isi form yang telah disediakan dialamat website <a href="https://beasiswa.disdik.jambiprov.go.id">http://beasiswa.disdik.jambiprov.go.id</a></p>\n\n<p>NIK harus kode wilayah Provinsi Jambi dan Pastikan alamat <strong>Email</strong> yang digunakan Valid dan masih digunakan.</p>\n'),
	(2, 'Kapan jadwal pendaftaran Beasiswa ?', '<p><img alt="" src="https://image.ibb.co/koBVBz/Untitled_2.jpg" /></p>\n'),
	(3, 'Apakah yang dimaksud dengan NIK ?', '<p>NIK adalah Nomor Induk Kependudukan yang ada di Kartu Tanda Penduduk (KTP) yang berjumlah 16 (enam belas) digit angka.</p>\r\n'),
	(4, 'Bisakah saya membuka website beasiswa menggunakan perangkat android/Smartphone ?', '<p>Untuk membaca informasi bisa, tetapi disarankan&nbsp;untuk login dan upload data diharuskan menggunakan Personal Computer (PC) atau Laptop.</p>\n'),
	(5, 'Mengapa username dan password login saya belum diterima ?', '<p>Hal ini biasanya dikarenakan kesalahan dalam memasukkan alamat email. Alamat email harus benar dan masih aktif.</p>\n'),
	(6, 'Siapa saja yang bisa ikut seleksi penerima beasiswa D3, S1, S2, Dokter Spesialis ?', '<p>Yang berhak ikut seleksi penerima beasiswa adalah Mahasiswa aktif dengan syarat : - Penduduk ber-KTP Provinsi Jambi - Mahasiswa aktif (bukan calon mahasiswa) duduk di minimal semester II - Meraih Indeks Prestasi paling rendah ; D3 = 3,25, S1 = 3,25, S2 = 3,30, dan Dokter Spesialis = 3,00 - Akreditasi Program Studi minimal akreditasi B - Tidak sedang menerima bantuan pihak lain - <strong>Calon penerima diluar ketentuan diatas tidak bisa ikut seleksi penerima beasiswa</strong></p>\n'),
	(7, 'Jika saya belum kuliah, bisakah saya ikut seleksi penerima beasiswa ?', '<p>Tidak bisa, beasiswa ini hanya untuk mahasiswa aktif.</p>\r\n'),
	(8, 'Jika saya bukan penduduk Provinsi Jambi, bisakah saya ikut seleksi penerima beasiswa ?', '<p>Tidak bisa, hanya untuk penduduk ber-KTP Provinsi Jambi.</p>\r\n'),
	(9, 'Apakah yang dimaksud dengan IP dalam form pendaftaran ?', '<p>IP adalah nilai Indeks Prestasi, nilai yang diinput adalah nilai IP di semester terakhir. Nilai IP dibawah persyaratan tidak bisa ikut seleksi penerima beasiswa.</p>\r\n'),
	(10, 'Apakah yang dimaksud dengan akreditasi program studi ?', '<p>Akreditasi Program Studi adalah nilai akreditasi yang diraih Program Studi tempat mahasiswa berkuliah minimal akreditasi B, akreditasi dibawah itu atau belum terakreditasi tidak bisa mengikuti seleksi penerima beasiswa.</p>\r\n'),
	(11, 'Apakah yang dimaksud dengan sertifikat prestasi non akademik ?', '<p>Sertifikat non akademik adalah sertifikat atau piagam prestasi minimal di tingkat Provinsi di bidang Seni, Olah Raga, Sains Dll yang digunakan sebagai bahan pendukung penilaian seleksi beasiswa.</p>\r\n'),
	(12, 'Apakah yang dimaksud dengan Fakta Integritas ?', '<p>Fakta Integritas adalah dokumen pernyataan kebenaran data dan dokumen peserta seleksi beasiswea yang wajib diunduh di halaman website beasiswa dan diisi serta ditandatangani diatas materai.</p>\r\n'),
	(13, 'Wajibkah saya mengupload semua data ?', '<p>Semua data wajib diupload oleh peserta seleksi beasiswa, kecuali sertifikat/piagam prestasi hanya bagi yang memiliki prestasi non akademik.</p>\r\n'),
	(15, 'Kapan peserta seleksi beasiswa Tahap I (Administrasi) diumumkan ?', '<p>Peserta seleksi beasiswa Tahap I (berkas) diumumkan pada tanggal 14 November 2018. Jumlah peserta yang diumumkan berdasarkan jumlah quota beasiswa dan berdasarkan peringkat Indeks Prestasi Tertinggi dan kelengkapan administrasi.</p>\n'),
	(16, 'Bagaimana cara verifikasi Tahap II ?', '<p>Calon penerima beasiswa akan dipanggil oleh Tim Seleksi dan diwajibkan membawa semua dokumen asli yang telah diupload pada tanggal 19 - 23 November 2018.&nbsp;Tim Seleksi juga akan melakukan konfirmasi data ke Perguruan Tinggi Calon penerima beasiswa. Jika terdapat data palsu/tidak benar, Calon penerima beasiswa didiskualifikasi</p>\n'),
	(17, 'Informasi Tambahan ?', '<p>Tim Seleksi tidak bertanggung jawab apabila peserta seleksi salah memasukkan data diantaranya Nomor Handphone dan alamat email untuk keperluan komunikasi data/suara antara Tim Seleksi dan Peserta seleksi.</p>\r\n'),
	(18, 'Saya sudah mendaftar akan tetapi NIK, IP Semester, Akreditasi Program Studi yang saya inputkan salah, dan juga kesalahan upload dokumen apakah ada solusinya ?', '<p>Peserta dapat melakukan update data sendiri di sistem.</p>\r\n'),
	(19, 'Saya salah memasukkan alamat E-mail apakah bisa login?', '<p>Ya, system bisa menerima akses melalui email (baik email yang valid ataupun tidak valid), dengan catatan, jika alamat email yang tidak valid dapat melapor pada support beasiswa di laman chat dan email : admin@beasiswaprovjambi.com</p>\r\n'),
	(20, 'Saya mempunyai lebih dari satu sertifikat prestasi, bagaimana cara menguploadnya?', '<p>Silahkan data-data tersebut di .zip atau .rar dalam satu dokumen.</p>\r\n'),
	(22, 'Saya sudah mendaftar akan tetapi belum mendapat email untuk login, bagaimana solusinya?', ''),
	(23, 'Saya sudah upload dokumen, akan tetapi salah. adakah solusinya?', '<p>Silahkan upload kembali dokumen yang dimaksud, nantinya dokumen lama akan tergantikan dengan dokumen yang baru.</p>\n'),
	(24, 'Jenis File apa saja dan ukuran file yang bisa diupload dalam sistem pendaftaran?', '<p>Inofrmasi yang wajib diketahui oleh pendaftar beasiswa :</p>\r\n\r\n<p>1. Ekstensi file unggah yang diijinkan : zip;rar;jpg;pdf;doc;docx;xls;xlsx<br />\r\n2. Besar file dokumen max 1 MBytes (1024 KB)</p>\r\n'),
	(25, 'Akreditasi Program Studi itu di dapat dari mana?', '<p>Silahkan bertanya kepada pihak kampus baik itu ketua prodi atau ketua jurusan tempat saudara/i kuliah atau bisa juga mengecek secara online di laman website <a href="https://banpt.or.id/direktori/prodi/pencarian_prodi">https://banpt.or.id/direktori/prodi/pencarian_prodi</a></p>\n'),
	(26, 'Saya sudah mendapat bantuan beasiswa dari Pemprov Jambi, apakah masih bisa mendaftar?', '<p>Sistem akan menolak NIK peserta yang telah menerima bantuan beasiswa tahun sebelumnya.</p>\n'),
	(27, 'Saya PNS dan sedang kuliah di salah satu Perguruan tinggi negeri/swasta yang sudah berakreditasi, apakah bisa mengikuti program bantuan beasiswa ini?', '<p>YA, bisa&nbsp;</p>\n'),
	(28, 'NIK Daftar Kode Wilayah Provinsi Jambi', '<p>Daftar kode wilayah 11 kabupaten/kota di Provinsi Jambi yang terdiri dari 9 kabupaten dan 2 kota berdasarkan data yang dikeluarkan oleh Kementerian Dalam Negeri Republik Indonesia.</p>\n\n<table border="1" cellpadding="5" cellspacing="0">\n	<thead>\n		<tr>\n			<th>\n			<p><strong>No</strong></p>\n			</th>\n			<th>\n			<p><strong>Kode Wilayah</strong></p>\n			</th>\n			<th>\n			<p><strong>Kabupaten/Kota</strong></p>\n			</th>\n		</tr>\n	</thead>\n	<tbody>\n		<tr>\n			<td>\n			<p>1</p>\n			</td>\n			<td>\n			<p>15.01</p>\n			</td>\n			<td>\n			<p>Kabupaten Kerinci</p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p>2</p>\n			</td>\n			<td>\n			<p>15.02</p>\n			</td>\n			<td>\n			<p>Kabupaten Merangin</p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p>3</p>\n			</td>\n			<td>\n			<p>15.03</p>\n			</td>\n			<td>\n			<p>Kabupaten Sarolangun</p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p>4</p>\n			</td>\n			<td>\n			<p>15.04</p>\n			</td>\n			<td>\n			<p>Kabupaten Batanghari</p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p>5</p>\n			</td>\n			<td>\n			<p>15.05</p>\n			</td>\n			<td>\n			<p>Kabupaten Muaro Jambi</p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p>6</p>\n			</td>\n			<td>\n			<p>15.06</p>\n			</td>\n			<td>\n			<p>Kabupaten Tanjung Jabung Barat</p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p>7</p>\n			</td>\n			<td>\n			<p>15.07</p>\n			</td>\n			<td>\n			<p>Kabupaten Tanjung Jabung Timur</p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p>8</p>\n			</td>\n			<td>\n			<p>15.08</p>\n			</td>\n			<td>\n			<p>Kabupaten Bungo</p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p>9</p>\n			</td>\n			<td>\n			<p>15.09</p>\n			</td>\n			<td>\n			<p>Kabupaten Tebo</p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p>10</p>\n			</td>\n			<td>\n			<p>15.71</p>\n			</td>\n			<td>\n			<p>Kota Jambi</p>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<p>11</p>\n			</td>\n			<td>\n			<p>15.72</p>\n			</td>\n			<td>\n			<p>Kota Sungai Penuh</p>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p><a href="http://infopersada.com/jambi/pemerintahan-dan-wilayah/41-daftar-kode-wilayah-kabupaten-kota-di-jambi.html">http://infopersada.com/jambi/pemerintahan-dan-wilayah/41-daftar-kode-wilayah-kabupaten-kota-di-jambi.html</a></p>\n');

-- Dumping structure for table unic5432_beasiswa.jenis_dokumen
DROP TABLE IF EXISTS `jenis_dokumen`;
CREATE TABLE IF NOT EXISTS `jenis_dokumen` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) DEFAULT NULL,
  `file_template` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Dumping data for table unic5432_beasiswa.jenis_dokumen: ~18 rows (approximately)
DELETE FROM `jenis_dokumen`;
INSERT INTO `jenis_dokumen` (`id`, `nama`, `file_template`) VALUES
	(1, 'Kartu Tanda Penduduk (KTP)', NULL),
	(2, 'Fakta Integritas', '0426f-06334-fakta-integritas.doc'),
	(3, 'Kartu Tanda Mahasiswa (KTM)', NULL),
	(4, 'Kartu Keluarga (KK)', NULL),
	(5, 'Transkrip Nilai / Kartu Hasil Studi (legalisir)', NULL),
	(6, 'Surat Aktif Kuliah', NULL),
	(7, 'Akreditasi Program Studi dari BAN-PT ', NULL),
	(8, 'Sertifikat Prestasi (Jika memiliki, Jika tidak ada tidak perlu)', NULL),
	(9, 'Surat Rekomendasi dari Dinas Kesehatan', NULL),
	(10, 'Surat Rekomendasi dari Rumah Sakit', NULL),
	(11, 'Surat Pernyataan Tidak Sedang Menerima Beasiswa', '8ada5-740c9-surat-pernyataan-tidak-menerima-bantuan-beasiswa.docx'),
	(12, 'Draft Proposal Tesis', NULL),
	(15, 'Rencana Penggunaan Dana Beasiswa', '5ba37-contoh-rencana-penggunaan-dana.xlsx'),
	(16, 'Surat Pernyataan Perjanjian Penerima Bantuan Beasiswa ', 'e5607-3c8e0-surat-pernyataan-penerima-bantuan-beasiswa.docx'),
	(17, 'Surat Keterangan Bebas Narkoba (SKBN)', NULL),
	(19, 'Pengumuman Hasil Seleksi', '55e8d-pengumuman-beasiswa-2018.pdf'),
	(20, 'Kepgub Jambi tentang Penerima Beasiswa', '4efe7-kepgub-beasiswa-2018.pdf'),
	(21, 'Pengumuman JPEG', '71ad2-pengumuman-beasiswa-2018_001.jpg');

-- Dumping structure for table unic5432_beasiswa.kategori
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `logo` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `sort_num` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `level_penerima` enum('mahasiswa','pelajar') NOT NULL DEFAULT 'mahasiswa',
  `status_pendaftaran` enum('buka','tutup') NOT NULL DEFAULT 'buka',
  `prefix_registrasi` char(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `persyaratan` text,
  `set_jenis_dokumen` varchar(100) DEFAULT NULL,
  `tgl_buka` date DEFAULT NULL,
  `tgl_tutup` date DEFAULT NULL,
  `jml_penerima` smallint DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `akreditasi` varchar(50) DEFAULT NULL,
  `semester` varchar(50) DEFAULT NULL,
  `ip_minimal` varchar(9) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `strict_ip_minimal` enum('Y','N') DEFAULT NULL,
  `template_lulus` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COMMENT='\r\n\r\n';

-- Dumping data for table unic5432_beasiswa.kategori: ~3 rows (approximately)
DELETE FROM `kategori`;
INSERT INTO `kategori` (`id`, `nama`, `logo`, `sort_num`, `level_penerima`, `status_pendaftaran`, `prefix_registrasi`, `slug`, `persyaratan`, `set_jenis_dokumen`, `tgl_buka`, `tgl_tutup`, `jml_penerima`, `kelas`, `akreditasi`, `semester`, `ip_minimal`, `strict_ip_minimal`, `template_lulus`) VALUES
	(3, 'Beasiswa Mahasiswa Strata Satu (S1) - Kurang Mampu', '1ac06-beasiswa.jpg', '1', 'mahasiswa', 'buka', 'S1-01', 'beasiswa-mahasiswa-strata-satu-s1-kurang-mampu', '<p>a. Terdaftar sebagai penduduk di Provinsi Jambi dibuktikan dengan menunjukkan Kartu Mahasiswa, Kartu Tanda Penduduk dan Kartu Keluarga;</p>\r\n\r\n<p>b. Terdaftar dalam daftar DKTS atau melampirkan surat keterangan kurang mampu dari RT dan Lurah&nbsp; setempat;</p>\r\n\r\n<p>c. akreditasi program studi minimal B; dan</p>\r\n\r\n<p>d. tidak sedang menerima bantuan beasiswa dari pihak lain.</p>\r\n\r\n<p>e. belum pernah mendapatkan bantuan beasiswa dari pemerintah&nbsp;provinsi jambi</p>\r\n', '7,2,4,3,1,8,6,17,11,5', '2018-10-05', '2018-11-05', 350, NULL, 'A,B', '1,2,3,4,5,6', '2:2', 'N', 'f1df5-tanda_bukti_merah.docx'),
	(5, 'Beasiswa Mahasiswa Strata Tiga (S3) - Tenaga pengajar / Dosen', '52940-326fqyhd.png', '3', 'mahasiswa', 'buka', 'S3', 'beasiswa-mahasiswa-strata-tiga-s3-tenaga-pengajar-dosen', '<p>a. terdaftar sebagai penduduk di Provinsi Jambi dibuktikan dengan menunjukkan Kartu Tanda Penduduk atau Kartu Keluarga;</p>\r\n\r\n<p>b. Sudah memiliki Nomor Induk atau tenaga pengajar tetap pada perguruan tinggi dalam Provinsi jambi</p>\r\n\r\n<p>c. Indeks Prestasi Kumulatif (IPK) minimal 3,50 (tiga koma lima nol)</p>\r\n\r\n<p>d. akreditasi program studi minimal B; dan</p>\r\n\r\n<p>f. tidak sedang menerima bantuan beasiswa dari pihak lain.</p>\r\n', '7,12,2,4,3,1,15,8,6,16,11,5', '2017-08-16', '2017-09-16', 50, NULL, 'A,B', '1,2,3,4,5,6', '2:2', 'N', 'e0f18-tanda_bukti_hijau.docx'),
	(7, 'Beasiswa Mahasiswa Strata Satu (S1) - Berprestasi', '4b319-beasiswa.png', '2', 'mahasiswa', 'buka', 'S1-02', 'beasiswa-mahasiswa-strata-satu-s1-berprestasi', '<p>a. Terdaftar sebagai penduduk di Provinsi Jambi dibuktikan dengan menunjukkan Kartu Mahasiswa, Kartu Tanda Penduduk dan Kartu Keluarga;</p>\r\n\r\n<p>b. Index Prestasi Kumulatif (IPK) minimal 2,75 (dua koma tujuh lima) untuk mahasiswa eksakta dan minimal 3.00 (tiga koma nol nol) untuk mahasiswa sosial</p>\r\n\r\n<p>c. akreditasi program studi minimal B; dan</p>\r\n\r\n<p>d. tidak sedang menerima bantuan beasiswa dari pihak lain.</p>\r\n\r\n<p>e. belum pernah mendapatkan bantuan beasiswa dari pemerintah&nbsp;provinsi jambi</p>\r\n', NULL, '2023-03-01', '2023-03-31', 50, NULL, 'A,B', '1,2,3,4,5,6', '2.75:3.00', 'Y', 'f');

-- Dumping structure for table unic5432_beasiswa.kategori_qry_validation
DROP TABLE IF EXISTS `kategori_qry_validation`;
CREATE TABLE IF NOT EXISTS `kategori_qry_validation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kategori_id` int NOT NULL,
  `qry` varchar(300) NOT NULL,
  `success_msg` varchar(50) NOT NULL,
  `error_msg` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table unic5432_beasiswa.kategori_qry_validation: ~0 rows (approximately)
DELETE FROM `kategori_qry_validation`;
INSERT INTO `kategori_qry_validation` (`id`, `kategori_id`, `qry`, `success_msg`, `error_msg`) VALUES
	(1, 1, 'SELECT IF(:kelas > 10, \'Y\',IF( :semester > 1 ,\'Y\',\'N\')) AS result', '', 'Persyaratan tidak terpenuhi !');

-- Dumping structure for table unic5432_beasiswa.pendaftar
DROP TABLE IF EXISTS `pendaftar`;
CREATE TABLE IF NOT EXISTS `pendaftar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kategori_id` int NOT NULL,
  `no_urut_group` int NOT NULL,
  `nik` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat_rumah` text NOT NULL,
  `kota_lahir` varchar(50) NOT NULL,
  `tgl_lahir` varchar(50) NOT NULL,
  `jk` enum('Laki-laki','Perempuan') NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama_lembaga` varchar(100) NOT NULL,
  `program_studi` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jenis_jurusan` enum('eksakta','non_eksakta') NOT NULL DEFAULT 'eksakta',
  `akreditasi` char(2) NOT NULL,
  `kelas` tinyint NOT NULL,
  `semester` tinyint NOT NULL,
  `ip_semester` float NOT NULL,
  `file_foto` varchar(50) NOT NULL DEFAULT 'nofoto.jpg',
  `kab_kota` varchar(50) NOT NULL,
  `status` enum('pending','ditolak','diterima') NOT NULL DEFAULT 'pending',
  `status_akhir` enum('pending','ditolak','diterima') NOT NULL DEFAULT 'pending',
  `token_reset_password` varchar(100) NOT NULL,
  `token_expired` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `nik` (`nik`),
  UNIQUE KEY `no_hp` (`no_hp`),
  KEY `status_status_akhir` (`status`,`status_akhir`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='kelas digunakan untuk pelajar';

-- Dumping data for table unic5432_beasiswa.pendaftar: ~0 rows (approximately)
DELETE FROM `pendaftar`;

-- Dumping structure for table unic5432_beasiswa.pertanyaan
DROP TABLE IF EXISTS `pertanyaan`;
CREATE TABLE IF NOT EXISTS `pertanyaan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `topik` text NOT NULL,
  `tampil` enum('Y','N') NOT NULL DEFAULT 'N',
  `inserted_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `topik` (`topik`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=latin1;

-- Dumping data for table unic5432_beasiswa.pertanyaan: ~14 rows (approximately)
DELETE FROM `pertanyaan`;
INSERT INTO `pertanyaan` (`id`, `nama`, `email`, `topik`, `tampil`, `inserted_at`, `updated_at`) VALUES
	(134, 'test', 'test@gmail.com', 'asslkum : admin yth, kmren saya udah daftar diklat maya desiminasi Tik, apakah secara otomatis yg daftar di terima atau masih diseleksi, trims', 'Y', '2023-03-20 12:49:46', '2023-03-25 07:17:26'),
	(135, 'test', 'test@gmail.com', 'xxxx', 'Y', '2023-03-19 11:21:42', '2023-03-21 07:47:23'),
	(136, 'test', 'test@gmail.com', 'dddddddd', 'Y', '2023-03-19 11:24:17', '2023-03-21 07:47:23'),
	(137, 'test', 'test@gmail.com', 'x', 'Y', '2023-03-19 11:27:16', '2023-03-21 07:47:23'),
	(138, 'test', 'test@gmail.com', 'ccccccc', 'Y', '2023-03-19 11:31:54', '2023-03-21 07:47:24'),
	(139, 'test', 'test@gmail.com', 'xx', 'Y', '2023-03-19 11:33:40', '2023-03-21 07:47:24'),
	(140, 'test', 'test@gmail.com', 'ccccccccccccd', 'Y', '2023-03-19 12:06:36', '2023-03-21 07:47:25'),
	(141, 'test', 'test@gmail.com', 'xx', 'Y', '2023-03-19 11:33:40', '2023-03-21 07:47:25'),
	(142, 'test', 'test@gmail.com', 'xxxxx', 'Y', '2023-03-21 03:44:58', '2023-03-21 07:47:25'),
	(143, 'aa', 'test@gmail.com', 'zzzz', 'Y', '2023-03-21 03:45:18', '2023-03-21 07:47:26'),
	(144, 'test', 'test@gmail.com', 'xxx', 'Y', '2023-03-21 03:46:15', '2023-03-21 07:47:26'),
	(145, 'test', 'test@gmail.com', 'aaa', 'Y', '2023-03-21 03:49:59', '2023-03-21 07:47:27'),
	(146, 'test', 'test@gmail.com', 'ddddddd', 'N', '2023-03-21 03:55:43', '2023-03-22 04:48:00'),
	(147, 'test', 'test@gmail.com', 'ssddd', 'N', '2023-03-21 03:58:37', '2023-03-22 04:47:58'),
	(149, 'kirana.avalokiteshvara', 'triasfahrudin@gmail.com', '<p>xxxxxxxxxxxxxxxxxxxxx</p>\r\n', 'N', '2023-03-31 12:57:43', '0000-00-00 00:00:00');

-- Dumping structure for table unic5432_beasiswa.pertanyaan_tanggapan
DROP TABLE IF EXISTS `pertanyaan_tanggapan`;
CREATE TABLE IF NOT EXISTS `pertanyaan_tanggapan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pertanyaan` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `komentar` text NOT NULL,
  `tampil` enum('Y','N') NOT NULL DEFAULT 'N',
  `inserted_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=latin1;

-- Dumping data for table unic5432_beasiswa.pertanyaan_tanggapan: ~4 rows (approximately)
DELETE FROM `pertanyaan_tanggapan`;
INSERT INTO `pertanyaan_tanggapan` (`id`, `id_pertanyaan`, `nama`, `email`, `komentar`, `tampil`, `inserted_at`, `updated_at`) VALUES
	(182, 134, 'admin', '', '<p>ini adalah tanggapan dari admin</p>\r\n', 'Y', '2023-03-22 12:36:42', '2023-03-22 05:44:32'),
	(183, 134, 'Guest', 'admin@gmail.com', 'xxxxxxxx', 'Y', '2023-03-25 14:18:11', '2023-03-25 07:18:22'),
	(184, 135, 'lala', 'lala@gmail.com', 'xxxxxxxxxxx', 'N', '2023-03-31 10:14:15', '2023-03-31 03:14:15'),
	(185, 135, 'lala', 'lala@gmail.com', 'ddddd', 'N', '2023-03-31 10:15:53', '2023-03-31 03:15:53'),
	(186, 149, 'kirana.avalokiteshvara', 'triasfahrudin@gmail.com', '<p>test test</p>\r\n', 'Y', '2023-03-31 13:04:45', '2023-03-31 13:04:45'),
	(187, 149, 'triasfahrudin@gmail.com', 'kirana.avalokiteshvara', 'gggg', 'N', '2023-03-31 14:34:27', '2023-03-31 07:34:27'),
	(188, 149, 'kirana.avalokiteshvara', 'triasfahrudin@gmail.com', 'ssss', 'N', '2023-03-31 14:37:19', '2023-03-31 07:37:19'),
	(189, 149, 'kirana.avalokiteshvara', 'triasfahrudin@gmail.com', 'gagaga', 'N', '2023-03-31 14:37:29', '2023-03-31 07:37:29');

-- Dumping structure for table unic5432_beasiswa.settings
DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `tipe` enum('small-text','big-text') DEFAULT 'small-text',
  `value` text,
  `show` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table unic5432_beasiswa.settings: ~4 rows (approximately)
DELETE FROM `settings`;
INSERT INTO `settings` (`id`, `title`, `tipe`, `value`, `show`) VALUES
	(1, 'frontpage_popup', 'big-text', '<p><a href="http://beasiswa.disdik.jambiprov.go.id/uploads/55e8d-pengumuman-beasiswa-2018.pdf">PENGUMUMAN PENERIMA BEASISWA</a></p>\n\n<p><img alt="" src="http://beasiswa.disdik.jambiprov.go.id/uploads/71ad2-pengumuman-beasiswa-2018_001.jpg" style="height:936px; width:612px" /></p>\n\n<p>&nbsp;</p>\n\n<p>Klik Link dibawah untuk mengunduh Kepgub Jambi</p>\n\n<p><a href="http://beasiswa.disdik.jambiprov.go.id/uploads/4efe7-kepgub-beasiswa-2018.pdf">KEPUTUSAN GUBERNUR JAMBI TENTANG PENERIMA BEASISWA</a></p>\n', 'YA,TIDAK;TIDAK'),
	(2, 'frontpage_marquee', 'small-text', 'test test test', 'YA,TIDAK;YA'),
	(3, 'penambahan_tahap_berkas', 'small-text', '0', 'YA,TIDAK;YA'),
	(4, 'tahun_aktif', 'small-text', '2018', 'YA;YA');

-- Dumping structure for function unic5432_beasiswa.slugify
DROP FUNCTION IF EXISTS `slugify`;
DELIMITER //
CREATE FUNCTION `slugify`(`dirty_string` varchar(200)

) RETURNS varchar(200) CHARSET latin1
    DETERMINISTIC
BEGIN
    DECLARE x, y , z Int;
    DECLARE temp_string, new_string VarChar(200);
    DECLARE is_allowed Bool;
    DECLARE c, check_char VarChar(1);

    set temp_string = LOWER(dirty_string);

    Set temp_string = replace(temp_string, '&', ' and ');
    Set temp_string = replace(temp_string, '#', ' sharp ');

    Select temp_string Regexp('[^a-z0-9\-]+') into x;
    If x = 1 then
        set z = 1;
        While z <= Char_length(temp_string) Do
            Set c = Substring(temp_string, z, 1);
            Set is_allowed = False;
            If !((ascii(c) = 45) or (ascii(c) >= 48 and ascii(c) <= 57) or (ascii(c) >= 97 and ascii(c) <= 122)) Then
                Set temp_string = Replace(temp_string, c, '-');
            End If;
            set z = z + 1;
        End While;
    End If;

    Select temp_string Regexp("^-|-$|'") into x;
    If x = 1 Then
        Set temp_string = Replace(temp_string, "'", '');
        Set z = Char_length(temp_string);
        Set y = Char_length(temp_string);
        Dash_check: While z > 1 Do
            If Strcmp(SubString(temp_string, -1, 1), '-') = 0 Then
                Set temp_string = Substring(temp_string,1, y-1);
                Set y = y - 1;
            Else
                Leave Dash_check;
            End If;
            Set z = z - 1;
        End While;
    End If;

    Repeat
        Select temp_string Regexp("--") into x;
        If x = 1 Then
            Set temp_string = Replace(temp_string, "--", "-");
        End If;
    Until x <> 1 End Repeat;

    If LOCATE('-', temp_string) = 1 Then
        Set temp_string = SUBSTRING(temp_string, 2);
    End If;

    Return temp_string;
END//
DELIMITER ;

-- Dumping structure for table unic5432_beasiswa.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `level` enum('admin','verifikator','guest') NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `hak_akses` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Dumping data for table unic5432_beasiswa.user: ~0 rows (approximately)
DELETE FROM `user`;
INSERT INTO `user` (`id`, `level`, `username`, `password`, `hak_akses`) VALUES
	(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2,3,4,6'),
	(26, 'verifikator', 'verifikator', '2ea2aa47b5cbf1f95b9dd18c1bf8dd4c', '3,5,7'),
	(27, 'guest', 'guest', '084e0343a0486ff05530df6c705c8bb4', '3,5,7');

-- Dumping structure for view unic5432_beasiswa.v_pendaftar
DROP VIEW IF EXISTS `v_pendaftar`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_pendaftar` (
	`id` INT(10) NOT NULL,
	`DT_RowId` VARCHAR(14) NOT NULL COLLATE 'utf8mb4_general_ci',
	`nik` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`kategori_id` INT(10) NOT NULL,
	`nama_lengkap` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`kab_kota` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`jk` VARCHAR(9) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_lembaga` VARCHAR(100) NOT NULL COLLATE 'latin1_swedish_ci',
	`program_studi` VARCHAR(100) NOT NULL COLLATE 'latin1_swedish_ci',
	`akreditasi` CHAR(2) NOT NULL COLLATE 'latin1_swedish_ci',
	`semester` TINYINT(3) NOT NULL,
	`ip_semester` FLOAT NOT NULL,
	`dokumen` VARCHAR(8) NOT NULL COLLATE 'utf8mb4_general_ci',
	`status` ENUM('pending','ditolak','diterima') NOT NULL COLLATE 'latin1_swedish_ci',
	`status_akhir` ENUM('pending','ditolak','diterima') NOT NULL COLLATE 'latin1_swedish_ci',
	`email` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`tgl_daftar` VARCHAR(24) NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for table unic5432_beasiswa.web_content
DROP TABLE IF EXISTS `web_content`;
CREATE TABLE IF NOT EXISTS `web_content` (
  `id` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(50) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table unic5432_beasiswa.web_content: ~2 rows (approximately)
DELETE FROM `web_content`;
INSERT INTO `web_content` (`id`, `judul`, `content`) VALUES
	(1, 'juknis', '<iframe src="https://docs.google.com/document/d/1N6fJpDYeaoHnxoiqn5oeZjegkr6f31FuXrIq6eAtDlI/edit" style="width:100%;height:500px"></iframe> '),
	(2, 'rundown', '<p><img alt="" src="https://image.ibb.co/koBVBz/Untitled_2.jpg" style="height:595px; width:1050px" /></p>\n');

-- Dumping structure for trigger unic5432_beasiswa.kategori_before_insert
DROP TRIGGER IF EXISTS `kategori_before_insert`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `kategori_before_insert` BEFORE INSERT ON `kategori` FOR EACH ROW BEGIN
	SET NEW.slug = slugify(NEW.nama);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger unic5432_beasiswa.kategori_before_update
DROP TRIGGER IF EXISTS `kategori_before_update`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `kategori_before_update` BEFORE UPDATE ON `kategori` FOR EACH ROW BEGIN
	SET NEW.slug = slugify(NEW.nama);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger unic5432_beasiswa.pendaftar_before_insert
DROP TRIGGER IF EXISTS `pendaftar_before_insert`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `pendaftar_before_insert` BEFORE INSERT ON `pendaftar` FOR EACH ROW BEGIN
	SET NEW.no_urut_group = (SELECT IFNULL((SELECT COUNT(id) + 1 FROM pendaftar WHERE kategori_id = NEW.kategori_id GROUP BY kategori_id),1));
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for view unic5432_beasiswa.v_pendaftar
DROP VIEW IF EXISTS `v_pendaftar`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_pendaftar`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_pendaftar` AS select `a`.`id` AS `id`,concat('tr_',`a`.`id`) AS `DT_RowId`,`a`.`nik` AS `nik`,`a`.`kategori_id` AS `kategori_id`,upper(`a`.`nama_lengkap`) AS `nama_lengkap`,upper(`a`.`kab_kota`) AS `kab_kota`,upper(`a`.`jk`) AS `jk`,upper(`a`.`nama_lembaga`) AS `nama_lembaga`,upper(`a`.`program_studi`) AS `program_studi`,`a`.`akreditasi` AS `akreditasi`,`a`.`semester` AS `semester`,`a`.`ip_semester` AS `ip_semester`,concat(lpad(cast(count(distinct `b`.`id`) as unsigned),2,'0'),'-',lpad(cast(count(distinct `c`.`id`) as unsigned),2,'0'),'-',lpad(cast(count(distinct `d`.`id`) as unsigned),2,'0')) AS `dokumen`,`a`.`status` AS `status`,`a`.`status_akhir` AS `status_akhir`,`a`.`email` AS `email`,date_format(`a`.`created_at`,'%d-%m-%Y %H:%i:%s') AS `tgl_daftar` from (((`pendaftar` `a` left join `dokumen_pendaftar` `b` on((`a`.`id` = `b`.`pendaftar_id`))) left join `dokumen_pendaftar` `c` on(((`a`.`id` = `c`.`pendaftar_id`) and (`c`.`verifikasi` = 'diterima')))) left join `dokumen_pendaftar` `d` on(((`a`.`id` = `d`.`pendaftar_id`) and (`d`.`verifikasi` = 'ditolak')))) group by `a`.`id`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
