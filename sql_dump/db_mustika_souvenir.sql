-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2020 at 08:25 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_mustika_souvenir`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `id_address` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `seo` varchar(125) DEFAULT NULL,
  `link` mediumtext,
  `maps` mediumtext,
  `description` text,
  `image` varchar(250) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id_address`, `title`, `seo`, `link`, `maps`, `description`, `image`, `status`, `dateTime`) VALUES
(8, 'Alamat ', 'alamat-', '', '', 'Jl. Kasongan, Beton rt05, Tirtonirwolo, Kasihan, Bantul', 'alamat-kantor--362-placeholder (1).png', '1', '2019-12-16 07:31:13');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id_articles` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `seo` varchar(125) DEFAULT NULL,
  `description` text,
  `image` varchar(250) DEFAULT NULL,
  `view` varchar(10) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id_articles`, `title`, `seo`, `description`, `image`, `view`, `status`, `dateTime`) VALUES
(11, 'Setelah Tol Balsam, Pemerintah Siap Kembangkan 3 Ruas Tol Baru Pendukung IKN', 'setelah-tol-balsam-pemerintah-siap-kembangkan-3-ruas-tol-baru-pendukung-ikn', '<p>Persiapkan Ibu Kota Negara (IKN) di Kalimantan Timur (Kaltim), pemerintah mulai siapkan konektivitas tiga jaringan jalan tol baru. Pasalnya tiga ruas tol baru ini akan dimulai setelah beroperasinya jalan tol pertama di Kalimantan, yakni Balikpapan-Samarinda.</p>\r\n<p>Kepala Badan Pengatur Jalan Tol (BPJT) Danang Parikesit mengatakan, pihaknya tengah merancang tiga akses yang menyambung ke IKN. Dia menjelaskan tiga akses ruas menuju IKN tersebut, yakni dari simpang Susun Samboja, kemudian Simpang Susun Karang Joang, dan akses Tol Trans Kalimantan Lintas Selatan.</p>\r\n<p>&ldquo;Supaya bisa meningkatkan konektivitas dari dan ke ibu kota negara, juga meningkatkan daya tarik Kaltim. Ada tiga akses ke IKN yang menjadi bagian jaringan untuk mengembangkan jaringan jalan tol di Kaltim setelah Balikpapan-Samarinda,&rdquo; jelasnya.</p>\r\n<p>Danang memaparkan bahwa rencananya dua dari ruas tol tersebut akan ditenderkan, sedangkan satu ruas dari Samboja ke Sepaku sedang dipertimbangkan untuk ditugaskan kepada PT Jasa Marga Tbk. Selaku Badan Usaha Jalan Tol (BUJT) yang bertanggung jawab atas ruas tol Balikpapan-Samarinda, penugasan itu berupa penambahan ruang lingkup pengerjaan.</p>\r\n<p>Dia memperkirakan bahwa masing-masing ruas tol tersebut akan memiliki panjang 30 km dengan nilai investasi sekitar Rp150-Rp200 miliar per kilometernya.</p>\r\n<p>Danang menyebutkan, saat ini sudah ada pra studi kelayakan untuk tiga ruas tol tersebut sehingga bisa ditindaklanjuti pada tahun depan untuk merealisasikan studi kelayakan. Setelah itu ruas-ruas tersebut bisa mulai ditenderkan sambil dilakukan pembebasan lahan. Tiga ruas tersebut belum masuk ke daftar Proyek Strategis Nasional (PSN) sehingga akan diajukan untuk masuk.</p>\r\n<p>&ldquo;Untuk keseluruhan penyelesaiannya, 40 bulan bicara dengan perkiraan 2 tahun untuk masa konstruksi. Kami pilah untuk percepat,&rdquo; tekannya.</p>\r\n<p>Percepatan dapat dilakukan mengingat akan adanya kebijakan baru. Hal ini terkait dengan percepatan masa pelelangan dengan menghilangkan tahapan pra-kualifikasi. Lazimnya, sebut Danang dimulai dari masa pra-kualifikasi hingga pengumuman pemenang. Periode itu membutuhkan waktu hingga satu tahun. Jika menghilangkan tahapan prakualifikasi maka bisa memendekkan waktu hingga 6 bulan saja.</p>\r\n<p>Selain tiga ruas baru pendukung IKN, pihaknya juga berkomitmen untuk melanjutkan rute pembangunan tol dari Samarinda menuju Bontang. Di sisi lain jembatan Tol Balikpapan-Penajam Paser Utara (PPU) juga sedang dikaji ulang.</p>\r\n<p>Saat ini tercatat Kalimantan Timur akan segera mengoperasionalkan jalan bebas hambatan pertama di pulau tersebut, yakni Balikpapan&mdash;Samarinda. Tarif tol akan ditetapkan pada pertengahan Januari 2020 sesuai dengan Perjanjian Pengusahaan Jalan Tol (PPJT) yang disepakati pada awal pembangunanya yakni Rp1.000 per km.</p>\r\n<p>Potensi penambahan nilai investasi dapat dimasukkan ke dalam komponen tarif, sesuai dengan ketentuan penyesuaian tarif setiap 2 tahun.</p>\r\n<p>Presiden Joko Widodo telah meresmikan seksi II,III, dan IV dengan total sepanjang 66 km. Operasional jalan tol tersebut memiliki fungsi strategis terkait dengan terealisasikannya IKN.</p>\r\n<p>Presiden RI Joko Widodo menekankan, ada dua titik pertumbuhan utama yang akan saling melengkapi dengan selesainya jalan tol ini karena menghubungkan kota pemerintahan, yakni Samarinda dan kota bisnis Balikpapan. Jarak tempuh diantara keduanya semula sekitar 3 jam menjadi sekitar 1 jam.</p>\r\n<p>&ldquo;Selain itu, provinsi Kaltim memiliki kawasan pantai dengan pelabuhan penting yakni Samarinda, Palarang, dan Kariangau yang akan menjadi satu jaringan jalan tol ini. Selain tentunya juga akan menghubungkan Bandar Udara yakni Aji Pangeran Tumenggung (APT) Pranoto dan Sultan Aji Muhammad Sulaiman (SAMS) Sepinggan,&rdquo; jelas Presiden saat peresmian.</p>\r\n<p>Adapun untuk bisa beroperasional penuh, ruas tol Balikpapan-Samarinda masih menghadapi kendala lahan di seksi I dan V sekitar 3,8 km. Namun, optimisme pemerintah menargetkan sebelum lebaran penyelesaiannya dapat direalisasikan.</p>', 'setelah-tol-balsam-pemerintah-siap-kembangkan-3-ruas-tol-baru-pendukung-ikn-405-new2.jpg', '13', '1', '2019-12-20 06:24:52'),
(12, 'Tips Untuk Mulai Menyewakan Apartemen di Perkotaan', 'tips-untuk-mulai-menyewakan-apartemen-di-perkotaan', '<p>Bagi masyarakat perkotaan, khususnya di Jakarta, tinggal di apartemen saat ini sudah menjadi gaya hidup. Lokasi yang strategis serta dilengkapi dengan fasilitas yang lengkap, membuat hunian vertikal kini mulai diburu oleh banyak pemburu properti.</p>\r\n<p>Kondisi ini pun akhirnya ditangkap sebagai potensi bisnis yang menggiurkan, khususnya bagi mereka para investor properti, mereka banyak membeli apartemen di pusat kota dan kemudian menyewakannya untuk mendapatkan keuntungan.</p>\r\n<p>Target penyewa sendiri menyasar kepada para eksekutif muda ataupun mahasiswa. Nah, bagi Anda yang saat ini berencana untuk menjalankan bisnis sewa apartemen, berikut ini adalah beberapa tips yang bisa Anda jalankan.</p>\r\n<ol>\r\n<li>Pertimbangkan urusan biaya</li>\r\n</ol>\r\n<p style="padding-left: 30px;">Pertama, berhati-hatilah saat menghitung biaya yang mungkin perlu Anda keluarkan, seperti: biaya hipotek, pemeliharaan, renovasi, hingga asuransi. Anda juga perlu mempertimbangkan kerusakan yang mungkin terjadi pada apartemen Anda selama waktu sewa. Total biaya tersebut tidak boleh lebih tinggi dari biaya sewa yang Anda terapkan.</p>\r\n<p style="padding-left: 30px;">2. Cari lokasi yang strategis</p>\r\n<p style="padding-left: 30px;">Urusan lokasi merupakan hal yang sangat penting karena semakin strategis lokasi apartemen Anda, semakin tinggi biaya sewa yang bisa ditetapkan. Contohnya seperti dekat dengan transportasi umum, perkantoran, pusat perbelanjaan ataupun pusat pendidikan.</p>\r\n<p style="padding-left: 30px;">3. Pertimbangkan untuk renovasi</p>\r\n<p style="padding-left: 30px;">Agar lebih menarik, Anda juga bisa merenovasi ulang unit apartemen yang disewakan. Hal ini cukup penting, karena persaingan bisnis sewa apartemen cukup ketat. Untuk itu disarankan Anda merenovasi ulang unit apartemen yang ingin disewakan, agar tampak lebih menarik dan memikat calon penyewa.</p>\r\n<p style="padding-left: 30px;">4. Beriklan secara cerdas</p>\r\n<p style="padding-left: 30px;">Temukan media yang tepat untuk mengiklankan apartemen Anda. Selalu gunakan kata-kata menarik dan informatif. Sertakan pula gambar apartemen yang hendak Anda sewakan. Gagasan ini bisa membuat orang lebih memperhatikan iklan yang dibuat, berikan pula informasi yang lengkap mengenai fitur apartemen, sehingga calon penyewa lebih tertarik.</p>\r\n<p style="padding-left: 30px;">5. Gunakan agen properti</p>\r\n<p style="padding-left: 30px;">Menjadi pemilik apartemen dan mengelolanya sendirian bisa jadi sangat melelahkan. Jika Anda tidak punya waktu, cobalah memakai jasa agen properti untuk membantu Anda menyewakan unit apartemen. Tentu, ada biaya tambahan yang harus dikeluarkan. Tapi, jika hal itu bisa meringankan beban Anda, kenapa tidak? Periksa kredibilitas agen properti sebelum menggunakan jasanya. Reputasinya harus bagus, tepercaya, dan dapat diandalkan.</p>\r\n<p>Untuk Anda pada investor yang ingin menggeluti bisnis sewa apartemen, mungkin membeli apartemen Permata Hijau Suites bisa menjadi pilihan yang menarik. Pasalnya memang apartemen ini dibangun di lokasi yang sangat strategis, sehingga potensi pasar sewa Anda semakin terbuka lebar.</p>\r\n<p>Apartemen Permata Hijau Suites dibangun di Jalan Kebayoran Lama No. 55, Grogol Utara, Jakarta Selatan, lokasinya sangat strategis karena dekat dengan kawasan perkantoran (Sudirman), pusat gaya hidup (Pondok Indah, Senayan) serta kawasan bisnis (Puri).</p>\r\n<p>Selain lokasinya yang strategis, apartemen ini juga dijual dengan harga yang bersahabat, yakni mulai dari Rp 1 miliar. Harga seperti itu, terhitung cukup murah karena lokasi apartemen ini berada di pusat kota dan strategis.</p>\r\n<p>Apartemen Permata Hijau Suites dikembangkan di atas lahan seluas 9000 meter persegi, di sana nantinya akan dibangun dua tower dengan kapasitas unit mencapai 649. Tipe unit yang ditawarkan terbagi menjadi tipe 1 bedroom dengan luas 40,86 m2 tipe 2 bedroom dengan luas 60,29 m2 &ndash; 69,39 m2 dan tipe 3 bedroom dengan luas 91,40 m2 &ndash; 91,69 m2.</p>\r\n<p>Guna memanjakan penghuninya, apartemen ini pun dilengkapi dengan fasilitas yang sangat lengkap seperti club lounge, library, aquatic gym pool, aquatic reflexology path, aquatic massage pool, yoga &amp; pilates area, jogging track, 3 on 3 basketball court, outdoor fitness center, infinity pool hingga BBQ Area.</p>', 'tips-untuk-mulai-menyewakan-apartemen-di-perkotaan-392-new1.jpg', '13', '1', '2019-12-20 06:19:51'),
(13, 'Cara Mudah Membuat IMB Online dan persyaratan dokumen yang dibutuhkan ', 'cara-mudah-membuat-imb-online-dan-persyaratan-dokumen-yang-dibutuhkan-', '<p>Apa Itu IMB Dan Manfaatnya ?<br />IMB atau Izin Mendirikan Bangunan adalah salah satu produk hukum untuk mewujudkan tatanan tertentu sehingga tercipta ketertiban, keamanan, keselamatan, kenyamanan, sekaligus kepastian hukum.</p>\r\n<p>Kewajiban setiap orang atau badan yang akan mendirikan bangunan untuk memiliki Izin Mendirikan Bangunan, diatur pada Pasal 5 ayat 1 Perda 7 Tahun 2009.</p>\r\n<p>IMB punya peranan untuk melegalkan suatu bangunan yang direncanakan sesuai dengan Tata Ruang yang telah ditentukan. Selain itu, adanya IMB menunjukkan bahwa rencana konstruksi bangunan tersebut juga dapat dipertanggungjawabkan untuk kepentingan bersama.</p>\r\n<p>Seperti membangun rumah, berkas yang dibutuhkan harus lengkap dan legal.</p>\r\n<p>Selain Sertifikat Hak Milik ada dokumen lain yang sama kuatnya secara hukum, bila anda tidak memilikinya, bangunan rumah atau kios bisa sewaktu-waktu dibongkar pasang dengan paksa.</p>\r\n<p>Berkas apa itu? IMB (Izin Mendirikan Bangunan), berdasarkan Undang-Undang No. 34 tahun 2001.</p>\r\n<p>Perlu masyarakat ketahui sebelumnya bahwa sekarang cara mengurus IMB online sudah bisa. Jadi tidak perlu bersusah payah harus mengantre. Namun kekurangannya masih belum meratanya informasi tersebut.</p>\r\n<p>Sebenarnya seberapa penting dokumen itu?</p>\r\n<p>IMB merupakan dokumen legal yang diberikan oleh Kepala Daerah kepada pemilik untuk membangun, mengubah, memperluas, mengurangi, dan/atau merawat sesuai dengan prosedur berlaku yang sifatnya kuat.</p>\r\n<p>Dalam berkas tercantum beberapa data mulai dari peruntukan, jumlah lantai, dan lampira teknis lainnya.</p>\r\n<p>Semakin rumitnya suatu gedung maka perhitungan pemberian IMB akan semakin banyak.</p>\r\n<p><strong>Berikut adalah cara mengurus IMB Online, antara lain :</strong></p>\r\n<ul>\r\n<li>Kunjungi website&nbsp;\r\n<ul>\r\n<li><a href="http://dppb.jakarta.go.id/" target="_blank" rel="noopener">http://dppb.jakarta.go.id</a>&nbsp;</li>\r\n<li><a href="https://dpmptsp.bandung.go.id/" target="_blank" rel="noopener">https://dpmptsp.bandung.go.id</a></li>\r\n</ul>\r\n</li>\r\n<li>Daftarkan diri Anda di website tersebut, kemudian login dengan akun yang sudah terdaftar</li>\r\n<li>Pilih antara menu IMB rumah tinggal atau rumah non-tinggal, lalu masukkan lampiran data berupa bangunan</li>\r\n<li>Scan dokumen yang dibutuhkan dengan jelas lalu unggah dan kirim, pengisian data harus lengkap agar permohonan tidak ditolak atau&nbsp;<em>reject</em></li>\r\n<li>Langkah terakhir, bayarlah retribusi ke Bank sesuai daerah masing-masing. Bukti bayar bisa di scan lalu unggah ke website</li>\r\n</ul>\r\n<p><strong>Kelengkapan persyaratan dokumen :</strong></p>\r\n<ul>\r\n<li>Formulir Permohonan Izin Mendirikan Bangunan (PIMB) secara lengkap dan dibubuhi tandatangan</li>\r\n<li>Fotokopi KTP pemilik tanah atau pengaju</li>\r\n<li>Fotokopi NPWP</li>\r\n<li>Fotokopi surat kepemilikan tanah dari BPN yang sudah dilegalisasi notaris atau kartu kavling dari PEMDA atau Pemerintah Pusat</li>\r\n<li>Fotokopi surat tagihan dan bukti pembayaran Pajak Bumi dan Bangunan</li>\r\n<li>Ketetapan Rencana Kota (KRK) sebanyak 7 lembar dari PTSP</li>\r\n<li>Rencana Tata Letak Bangunan (RTLB) sebanyak 5 lembar</li>\r\n<li>Fotokopi SIPPT dari Gubernur bila luas tanah 5.000 meter persegi atau lebih</li>\r\n<li>Gambar rencana arsitektur (khusus zonasi R.5 tumah besar / R.9 rumah KDB rendah)</li>\r\n<li>Bila lokasi terletak pada bangunan golongan pemugaran A, B, C. Maka TPAK untuk perencanaan arsitektur bisa direkomendasikan</li>\r\n<li>Perhitungan dan gambar rencana konstruksi yang ditandatangani pemilik IPTB</li>\r\n</ul>\r\n<p>Salah satu keunggulan cara mengurus IMB online adalah tidak perlu antre panjang dari pagi sampai sore hari mengenai biaya kepengurusan tiap wilayah berbeda-beda.</p>', 'cara-mudah-membuat-imb-tanpa-antri-724-news1.jpeg', '110', '1', '2019-12-14 07:04:56');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int(7) NOT NULL,
  `city_name` varchar(100) NOT NULL,
  `seo` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `seo`, `status`, `dateTime`) VALUES
(1, 'Bantul', 'bantul', '1', '2019-09-11 07:54:54'),
(2, 'Gunung Kidul', 'gunung-kidul', '1', '2019-09-11 07:54:51'),
(3, 'Kulon Progo', 'kulon-progo', '1', '2019-09-11 07:55:02'),
(4, 'Magelang', 'magelang', '1', '2019-09-21 08:16:19'),
(5, 'Sleman', 'sleman', '1', '2019-09-11 07:54:42'),
(6, 'Kota Yogyakarta', 'kota-yogyakarta', '1', '2019-09-11 07:54:46');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id_contact` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `seo` varchar(125) DEFAULT NULL,
  `description` text,
  `image` varchar(250) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id_contact`, `title`, `seo`, `description`, `image`, `status`, `dateTime`) VALUES
(1, 'Telephon', 'telephon', '+6281232524676', 'hotline-call-only-372-hotline.png', '1', '2019-12-16 06:21:59'),
(2, 'Chat via WhatsApp', 'chat-via-whatsapp', '+6281232524676', 'chat-via-whatsapp-723-whatsapp_icon.png', '1', '2019-12-16 06:22:00'),
(3, 'Email', 'email', 'info@mustikasouvenir.com', 'email-216-close-envelope.png', '', '2020-01-14 08:09:03');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id_gallery` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `category` enum('image','video') NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `seo` varchar(100) DEFAULT NULL,
  `image` varchar(150) DEFAULT NULL,
  `link` mediumtext,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id_gallery`, `id_users`, `category`, `title`, `seo`, `image`, `link`, `status`, `dateTime`) VALUES
(1, 0, 'image', 'Penjualan rumah daerah bantul', 'penjualan-rumah-daerah-bantul', 'penjualan-rumah-daerah-bantul-340-Gaya Modern dan Minimalis.jpeg', NULL, '1', '2019-12-14 07:48:08'),
(2, 0, 'image', 'Penjualan rumah daerah bantul', 'penjualan-rumah-daerah-bantul', 'penjualan-rumah-daerah-bantul-143-Kitchen Set.jpeg', NULL, '1', '2019-12-14 07:48:08'),
(3, 0, 'image', 'Penjualan rumah daerah bantul', 'penjualan-rumah-daerah-bantul', 'penjualan-rumah-daerah-bantul-435-Kitchen Set2.jpeg', NULL, '1', '2019-12-14 07:48:08'),
(4, 0, 'image', 'Penjualan rumah daerah bantul', 'penjualan-rumah-daerah-bantul', 'penjualan-rumah-daerah-bantul-753-Pagar.jpeg', NULL, '1', '2019-12-14 07:48:08'),
(5, 0, 'image', 'Penjualan rumah daerah bantul', 'penjualan-rumah-daerah-bantul', 'penjualan-rumah-daerah-bantul-820-Partisi.jpeg', NULL, '1', '2019-12-14 07:48:08'),
(6, 0, 'image', 'Penjualan rumah daerah bantul', 'penjualan-rumah-daerah-bantul', 'penjualan-rumah-daerah-bantul-574-Rumah Baru Bangunan 2017.jpeg', NULL, '1', '2019-12-14 07:48:08'),
(7, 0, 'image', 'Penjualan rumah daerah bantul', 'penjualan-rumah-daerah-bantul', 'penjualan-rumah-daerah-bantul-387-Shower dan Toilet Duduk.jpeg', NULL, '1', '2019-12-14 07:48:08'),
(8, 0, 'image', 'Penjualan rumah daerah bantul', 'penjualan-rumah-daerah-bantul', 'penjualan-rumah-daerah-bantul-983-Taman dan Carport.jpeg', NULL, '1', '2019-12-14 07:48:08'),
(9, 0, 'image', 'Penjualan rumah daerah bantul', 'penjualan-rumah-daerah-bantul', 'penjualan-rumah-daerah-bantul-761-tampak depan.jpeg', NULL, '1', '2019-12-14 07:48:09'),
(10, 0, 'image', 'Penjualan rumah daerah bantul', 'penjualan-rumah-daerah-bantul', 'penjualan-rumah-daerah-bantul-990-Ubin dan Teralis.jpeg', NULL, '1', '2019-12-14 07:48:09'),
(11, 0, 'video', 'Jual Rumah Pondok Labu ', 'jual-rumah-pondok-labu-', 'batuartspace_bali-832-prop7.jpg', 'https://www.youtube.com/watch?v=dKFW3l_99LE', '1', '2019-12-16 04:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `image_info`
--

CREATE TABLE IF NOT EXISTS `image_info` (
  `id_imageinfo` int(11) NOT NULL,
  `id_subinformation` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image_info`
--

INSERT INTO `image_info` (`id_imageinfo`, `id_subinformation`, `image`) VALUES
(97, 3389555, 'souvenir-towel-503.jpg'),
(98, 4799174, 'arabic-teapot-with-cups-beads-table-515.jpg'),
(99, 8917049, 'gantungan-kunci-rumah-417.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE IF NOT EXISTS `information` (
  `id_information` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `seo` varchar(120) NOT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id_information`, `title`, `seo`, `status`, `dateTime`) VALUES
(53, 'Towel', 'towel', '1', '2020-01-14 06:40:52'),
(57, 'Gantungan Kunci', 'gantungan-kunci', '1', '2020-01-14 06:35:36');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id_messages` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(125) DEFAULT NULL,
  `description` text,
  `phone` varchar(250) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id_messages`, `fullname`, `email`, `description`, `phone`, `status`, `dateTime`) VALUES
(37, 'Bejo Raharjo', 'tes@tes.test', 'ID iklan 1098767, Mohon Informasi lebih lanjut', '21323234', '0', '2019-12-11 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `messages_search`
--

CREATE TABLE IF NOT EXISTS `messages_search` (
  `id_messages` int(11) NOT NULL,
  `id_information` int(7) DEFAULT NULL,
  `city_id` int(7) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(125) DEFAULT NULL,
  `description` mediumtext,
  `facilities` mediumtext,
  `phone` varchar(250) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `dateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages_search`
--

INSERT INTO `messages_search` (`id_messages`, `id_information`, `city_id`, `fullname`, `email`, `description`, `facilities`, `phone`, `status`, `dateTime`) VALUES
(41, 55, 2, 'Bejo Raharjo', 'tes@tes.test', 'q', 'q', '081232524676', '0', '2019-12-18 14:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE IF NOT EXISTS `modul` (
  `id_modul` int(5) NOT NULL,
  `nama_modul` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `link` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `static_content` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `image` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `publish` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `status` enum('user','admin') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `urutan` int(5) NOT NULL,
  `link_seo` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=435 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id_modul`, `nama_modul`, `link`, `static_content`, `image`, `publish`, `status`, `aktif`, `urutan`, `link_seo`) VALUES
(2, 'Web Keyword', '#', 'souvenir pernikahan jogja murah,souvenir pernikahan murah jogja,souvenir pernikahan,souvenir pernikahan unik,grosir souvenir pernikahan,mustika souvenir,', '', 'Y', 'admin', 'Y', 0, ''),
(1, 'Web Tittle', '#', 'Mustika Souvenir', '', 'Y', 'admin', 'Y', 0, ''),
(3, 'Web Description', '#', 'Mustika Souvenir, Sedia aneka souvenir pernikahan murah unik di jogja dengan harga grosir. 085-729-014-711 Souvenir pernikahan murah,souvenir kelahiran murah', '', 'Y', 'admin', 'Y', 0, ''),
(5, 'Tentang Kami', '#', '<p>Selamat datang di Mustika Souvenir, Kami menyediakan aneka souvenir pernikahan jogja murah dan unik dengan harga grosir. Mustika Souvenir adalah Grosir Souvenir Pernikahan Murah di Yogyakarta dan Magelang, kami menjual berbagai macam produk souvenir pernikahan murah, souvenir pernikahan unik serta souvenir kelahiran / souvenir ulang tahun. Aneka souvenir pernikahan unik dan murah ada di sini, seperti souvenir towel cake, souvenir gelas, souvenir centong, souvenir kipas, dll. Cocok pula untuk kebutuhan souvenir berbagai event Anda lainnya seperti sebagai Souvenir Ulang Tahun, Souvenir Kelahiran Anak, Undangan Pernikahan Murah dan Unik, dll. Mustika Souvenir sebagai toko souvenir pernikahan di Yogyakarta siap menerima order souvenir dan undangan pernikahan ke seluruh Indonesia.<br />Harga yang tertera di website adalah harga terbaru (update).</p>', 'logo-289-head1.jpg', 'Y', 'admin', 'Y', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE IF NOT EXISTS `slide` (
  `id_slide` int(11) NOT NULL,
  `kategori` enum('video','photo') DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `seo` varchar(125) DEFAULT NULL,
  `link` text,
  `image` varchar(250) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id_slide`, `kategori`, `title`, `seo`, `link`, `image`, `status`, `dateTime`) VALUES
(1, NULL, 'Home', 'home', '', 'home-874-slide.jpg', '1', '2020-01-17 03:22:56'),
(2, NULL, 'slide-home', 'slidehome', '', 'slidehome-272-home-874-slide.jpg', '1', '2020-01-17 03:34:59');

-- --------------------------------------------------------

--
-- Table structure for table `sosmed`
--

CREATE TABLE IF NOT EXISTS `sosmed` (
  `id_sosmed` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `seo` varchar(125) DEFAULT NULL,
  `link` text,
  `image` varchar(250) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sosmed`
--

INSERT INTO `sosmed` (`id_sosmed`, `title`, `seo`, `link`, `image`, `status`, `dateTime`) VALUES
(1, 'Facebook', 'facebook', 'https://www.facebook.com/', 'facebook-370-facebook.png', '1', '2019-12-16 07:57:23'),
(2, 'Twitter', 'twitter', 'https://twitter.com/', 'twitter-919-twitter (1).png', '1', '2019-12-16 07:57:44'),
(3, 'Google Plus', 'google-plus', 'https://plus.google.com/', 'google-plus-415-google-plus (2).png', '1', '2019-12-16 07:57:48'),
(4, 'Instagram', 'instagram', 'https://www.instagram.com/', 'instagram-381-instagram (1).png', '1', '2019-12-16 07:57:52');

-- --------------------------------------------------------

--
-- Table structure for table `statistik`
--

CREATE TABLE IF NOT EXISTS `statistik` (
  `ip` varchar(20) NOT NULL DEFAULT '',
  `tanggal` date NOT NULL,
  `hits` int(10) NOT NULL DEFAULT '1',
  `online` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statistik`
--

INSERT INTO `statistik` (`ip`, `tanggal`, `hits`, `online`) VALUES
('::1', '2019-06-24', 64, '1571124250'),
('::1', '2019-06-19', 64, '1571124250'),
('::1', '2019-06-17', 64, '1571124250'),
('::1', '2019-06-15', 64, '1571124250'),
('::1', '2019-06-15', 64, '1571124250'),
('::1', '2019-06-14', 64, '1571124250'),
('::1', '2019-05-29', 64, '1571124250'),
('127.0.0.1', '2019-05-29', 1, '1559104366'),
('::1', '2019-05-28', 64, '1571124250'),
('::1', '2019-05-27', 64, '1571124250'),
('::1', '2019-05-24', 64, '1571124250'),
('::1', '2019-05-23', 64, '1571124250'),
('::1', '2019-05-22', 64, '1571124250'),
('::1', '2019-08-23', 64, '1571124250'),
('::1', '2019-08-24', 64, '1571124250'),
('::1', '2019-10-15', 64, '1571124250');

-- --------------------------------------------------------

--
-- Table structure for table `sub_information`
--

CREATE TABLE IF NOT EXISTS `sub_information` (
  `id_subinformation` char(7) NOT NULL,
  `id_information` int(11) NOT NULL,
  `kode` char(10) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `seo` varchar(125) NOT NULL,
  `price` bigint(20) NOT NULL,
  `description` text,
  `image` varchar(250) DEFAULT NULL,
  `premium` enum('0','1') DEFAULT NULL,
  `view` varchar(10) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_information`
--

INSERT INTO `sub_information` (`id_subinformation`, `id_information`, `kode`, `title`, `seo`, `price`, `description`, `image`, `premium`, `view`, `status`, `dateTime`) VALUES
('3389555', 53, 'TW234', 'Souvenir Towel', 'souvenir-towel', 10000, '<p>Souvenir Towel</p>\r\n<p>- min order 200 pcs<br />- kemas plastik + thanks card<br />- ukuran 16 x 16 cm<br />- warna campur</p>\r\n<p><br />Info/order :<br />Sms / wa : 0896 0683 0693</p>', 'souvenir-towel-564.jpg', '0', '101', '1', '2020-01-14 07:38:34'),
('4799174', 57, 'GK235', 'Arabic Teapot with Cups Beads Table', 'arabic-teapot-with-cups-beads-table', 10000, '<p>Arabic Teapot with Cups Beads Table</p>\r\n<p>- min order 200 pcs<br />- kemas platik + kut<br />- warna gold / silver / coklat kehitaman</p>\r\n<p>- kemas mika per pcs Rp. 2.700</p>\r\n<p>Info/order :<br />Sms / wa : 0896 0683 0693</p>', 'arabic-teapot-with-cups-beads-table-889.jpg', '1', '45', '1', '2020-01-14 07:26:44'),
('8917049', 57, 'GK234', 'Gantungan Kunci rumah', 'gantungan-kunci-rumah', 2000, '<p>Souvenir Gantungan Kunci Rumah</p>\r\n<p>- min order 200 pcs<br />- kemas platik + kut<br />- warna gold / silver / coklat kehitaman</p>\r\n<p>- kemas mika per pcs Rp. 2.700</p>\r\n<p>Info/order :<br />Sms / wa : 0896 0683 0693</p>', 'gantungan-kunci-rumah-93.jpg', '1', '81', '1', '2020-01-17 03:55:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(250) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `blokir` enum('N','Y') DEFAULT NULL,
  `level` enum('admin','petugas') DEFAULT NULL,
  `id_session` varchar(50) DEFAULT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `username`, `password`, `fullname`, `email`, `phone`, `image`, `blokir`, `level`, `id_session`, `dateTime`) VALUES
(1, 'toyar', 'S1BIczBqd0FDeUpMN3U0R0xNbE96QT09Ojow8eoKggSyO//LLhCOjGbP', 'Bejo Raharjo', 'bejomulyo716@gmail.com', '', 'bejo-raharjo-423-photo.jpg', 'N', 'admin', 'k6062ss7ekfql6rlhqgoni3766', '2019-05-17 04:19:59'),
(2, 'admin', 'RTQrMzNpMitkN3hkbXZJdE9wcDhBUT09Ojqs0YTK+HgFlEvi16rDwD7C', 'Admin', 'info@propertipedia.id', '(0272) xxxxx', '-754-user.png', 'N', 'admin', '50ecq7ts71qjkucd1vp0nmr593', '2020-01-17 03:20:04'),
(7, 'petugas', 'RFNxYWRma0hPNHpLM0JwVlVyTkNnZz09OjoZ9J66UE6WtXqzjXJSllwV', 'I''m Petugas', 'test@test.test', '', 'testing-29-19.jpg', 'N', 'petugas', 'lumd0hou4m6fi0ku639u9e0sti', '2019-11-22 04:09:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id_address`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id_articles`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id_gallery`);

--
-- Indexes for table `image_info`
--
ALTER TABLE `image_info`
  ADD PRIMARY KEY (`id_imageinfo`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id_information`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_messages`);

--
-- Indexes for table `messages_search`
--
ALTER TABLE `messages_search`
  ADD PRIMARY KEY (`id_messages`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id_modul`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id_slide`);

--
-- Indexes for table `sosmed`
--
ALTER TABLE `sosmed`
  ADD PRIMARY KEY (`id_sosmed`);

--
-- Indexes for table `sub_information`
--
ALTER TABLE `sub_information`
  ADD PRIMARY KEY (`id_subinformation`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id_address` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id_articles` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id_gallery` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `image_info`
--
ALTER TABLE `image_info`
  MODIFY `id_imageinfo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `id_information` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_messages` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `messages_search`
--
ALTER TABLE `messages_search`
  MODIFY `id_messages` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id_modul` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=435;
--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id_slide` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sosmed`
--
ALTER TABLE `sosmed`
  MODIFY `id_sosmed` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
