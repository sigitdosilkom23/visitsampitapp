-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Agu 2023 pada 17.11
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tourism_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `book_list`
--

CREATE TABLE `book_list` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `package_id` int(30) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=pending,1=confirm, 2=cancelled\r\n',
  `schedule` date DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `book_list`
--

INSERT INTO `book_list` (`id`, `user_id`, `package_id`, `status`, `schedule`, `date_created`) VALUES
(2, 4, 8, 3, '2021-06-21', '2021-06-19 08:37:59'),
(3, 5, 8, 3, '2021-06-18', '2021-06-19 11:51:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `cat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `cat`) VALUES
(5, 'Penginapan/Hotel'),
(7, 'Mode and Fashion'),
(8, 'Healthy'),
(9, 'Personal Care'),
(10, 'Clinic and Pharmacy'),
(11, 'ATM Bank'),
(12, 'Cafe & Resto'),
(13, 'Foods and Drinks'),
(14, 'Transportation'),
(15, 'Market'),
(16, 'Places of Worship');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hostelry`
--

CREATE TABLE `hostelry` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_package` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `type` int(11) NOT NULL,
  `lat` varchar(20) DEFAULT NULL,
  `lng` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hostelry`
--

INSERT INTO `hostelry` (`id`, `id_package`, `name`, `photo`, `desc`, `type`, `lat`, `lng`, `created_at`, `updated_at`) VALUES
(11, 32, 'ATM BRI', 'uploads/hostelry_979119', '&lt;p&gt;JLN : USMAN HARUN No. 11\r\nBUKA DARI JAM 08:00-16:00\r\nHARI SABTU TUTUP&lt;br&gt;&lt;/p&gt;', 11, '', '', '2023-07-09 18:19:52', '2023-08-24 15:09:51'),
(12, 18, 'ATM BRI TERAS', 'uploads/hostelry_977510', '&lt;p&gt;&amp;nbsp;PPM\r\nJLN. ISKANDAR\r\nBUKA SENIN SAMPAI KAMIS DARI JAM 08:00-16:00\r\nSABTU TUTUP&lt;br&gt;&lt;/p&gt;', 11, '', '', '2023-07-09 18:21:35', '2023-08-24 15:09:35'),
(13, 18, 'UNIT BRI PELITA SAMPIT', 'uploads/hostelry_975718', '&lt;p&gt;JL. PELITA TIMUR N0 60\r\nJAM OPERASIONAL BUKA 24 JAM&lt;br&gt;&lt;/p&gt;', 11, '', '', '2023-07-09 18:25:17', '2023-08-24 15:09:17'),
(14, 32, 'ATM BNI', 'uploads/hostelry_973010', '&lt;p&gt;JALAN : SUTOYO S No. 11 MENTAYA BARU HULU\r\nJAM OPERASINAL\r\nSENI SAMPAI JUMAT JAM 08:15:30\r\nSABTU MINGGU LIBUR&lt;br&gt;&lt;/p&gt;', 11, '', '', '2023-07-09 18:27:46', '2023-08-24 15:08:50'),
(15, 7, 'ATM BNI SAWAHAN', 'uploads/hostelry_971321', '&lt;p&gt;JLN : CILIK RIWUT No. KM 1\r\nBUKA DARI JAM 08:00-16:00\r\nHARI SABTU DAN MINGGU TUTUP&lt;br&gt;&lt;/p&gt;', 11, '', '', '2023-07-09 18:34:44', '2023-08-24 15:08:33'),
(16, 18, 'ATM Bank Kalteng', 'uploads/hostelry_968013', '&lt;p&gt;Mentawa Baru Hulu, Kec. Mentawa Baru Ketapang, Kabupaten\r\nKotawaringin Timur, Kalimantan Tengah 74312&lt;br&gt;&lt;/p&gt;', 11, '', '', '2023-07-09 18:39:37', '2023-08-24 15:08:00'),
(17, 7, 'BRI link', 'uploads/hostelry_96581', '&lt;p&gt;Jl. H.M. Arsyad, Mentawa Baru Hilir, Kec. Mentawa Baru\r\nKetapang, Kabupaten Kotawaringin Timur, Kalimantan Tengah 74321&lt;br&gt;&lt;/p&gt;', 11, '', '', '2023-07-09 18:43:44', '2023-08-24 15:07:38'),
(18, 7, 'BRI link  Arza Jaya Group', 'uploads/hostelry_96387', '&lt;p&gt;Jl. HM Arsyad Sampit, Ketapang, Kotim, Mentawa Baru Hilir, Kec. Mentawa\r\nBaru Ketapang, Kabupaten Kotawaringin Timur, Kalimantan Tengah 74323 Di\r\ndepan Swalayan Mentari&lt;br&gt;&lt;/p&gt;', 11, '', '', '2023-07-09 18:46:50', '2023-08-24 15:07:18'),
(19, 33, 'Alfamart', 'uploads/hostelry_960917', '&lt;p&gt;Jl. Jendral Sudirman Km 4.5 Kel.Mentawa Baru Hulu, Mentawa Baru, Ketapang, Kab,\r\nKabupaten Kotawaringin Timur, Kalimantan Tengah&lt;/p&gt;&lt;p&gt;Alfamart adalah jaringan ritel terbesar di Indonesia yang menyediakan kebutuhan seharihari dengan harga terjangkau&lt;/p&gt;&lt;p&gt;Buka 07.00-22.00&amp;nbsp;&lt;br&gt;&lt;/p&gt;', 15, '', '', '2023-07-09 19:11:10', '2023-08-24 15:06:49'),
(20, 22, 'Alfamart', 'uploads/hostelry_959225', '&lt;p&gt;Jl. Jenderal Sudirman Km. 6 Pasir Putih Mentawa Baru/Ketapang, Kabupaten Kotawaringin\r\nTimur, Pasir Putih, Mentawa Baru Ketapang, Kalimantan tengah&amp;nbsp;&lt;/p&gt;&lt;p&gt; Alfamart adalah minimarket yang memiliki toko yang tersebar luas di Indonesia,\r\nmenawarkan produk lengkap dan layanan cepat. &lt;/p&gt;&lt;p&gt;Buka 07.00-22.00&lt;br&gt;&lt;/p&gt;', 15, '', '', '2023-07-09 19:18:32', '2023-08-24 15:06:32'),
(21, 18, 'Bintang swalayan ', 'uploads/hostelry_957110', '&lt;p&gt;&amp;nbsp;Jl. Letjen. Sutoyo No.88, Mentawa Baru Hulu, Kec. Mentawa Baru Ketapang, Kabupaten\r\nKotawaringin Timur, Kalimantan Tengah &lt;/p&gt;&lt;p&gt;Bintang Swalayan adalah toko ritel yang lebih besar dari minimarket, menawarkan\r\nberbagai macam produk dan fasilitas yang luas. &lt;/p&gt;&lt;p&gt;Buka 07.30-21.00&amp;nbsp;&lt;br&gt;&lt;/p&gt;', 15, '', '', '2023-07-09 19:27:19', '2023-08-24 15:06:11'),
(22, 18, 'Kusuka Swalayan', 'uploads/hostelry_950620', '&lt;p&gt;Jl. Letjen. Sutoyo Mentawa Baru Hulu, Kec. Mentawa Baru Ketapang, Kabupaten\r\nKotawaringin Timur, Kalimantan Tengah &lt;/p&gt;&lt;p&gt;Kusuka Swalayan menyediakan pengalaman berbelanja yang lengkap dengan variasi\r\nproduk yang lebih banyak, termasuk makanan, kebutuhan rumah tangga, pakaian, dan\r\nelektronik.&amp;nbsp;&lt;/p&gt;&lt;p&gt; Buka 07.15-21.30&lt;br&gt;&lt;/p&gt;', 15, '', '', '2023-07-09 19:58:54', '2023-08-24 15:05:06'),
(23, 7, 'Martabak Ter-Bul Mur-Mer', 'uploads/hostelry_944716', '&lt;p class=&quot;MsoNormal&quot; style=&quot;text-align: justify; &quot;&gt;&lt;span style=&quot;line-height: 107%;&quot;&gt;&lt;span style=&quot;font-size: 18px;&quot;&gt;Martabak\r\nmanis atau seringkali orang mengebutnya dengan &amp;nbsp;Terang bulan adalah makan yang sering kali &amp;nbsp;di orang ketika &amp;nbsp;waktu malam . Makanan ini menja santapan\r\nterfavorit semua orang termasuk masyarakat Kota Sampit karena martabak bisa\r\ndijadikan cemilan saat berkumpul. rekomendasi&amp;nbsp;\r\nsalah satu tempat penjual martabak yang enak dan murah yaitu TER-BUL\r\nMUR-MER .&lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;font-size: 0.875rem; line-height: 107%;&quot;&gt;&lt;span style=&quot;font-size: 18px;&quot;&gt;Buka dari jam 16&amp;nbsp; sampai 20,\r\nharga terjangkau dan enak.&amp;nbsp;&lt;/span&gt;&lt;/span&gt;&lt;span style=&quot;font-size: 18px;&quot;&gt;Lokasi nya di jalan bumi raya&amp;nbsp;&lt;/span&gt;&lt;/p&gt;', 13, '', '', '2023-07-09 20:26:30', '2023-08-24 15:04:07'),
(24, 22, 'Nasi Goreng Mulyo Joyo', 'uploads/hostelry_94258', '&lt;p class=&quot;MsoNormal&quot; style=&quot;&quot;&gt;&lt;span style=&quot;line-height: 107%;&quot;&gt;Nasi\r\ngoreng adalah salah satu makanan populer di Indonesia yang terkenal karena rasa\r\nlezat dan variasi bahan yang bisa digunakan. Makanan ini merupakan hidangan\r\nyang sangat fleksibel dan dapat disesuaikan dengan preferensi individu.&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;font-size: 0.875rem;&quot;&gt;Buka\r\ndari jam 14:00-22:00 lokasi nya tepat di sebelah kiri bundaran Pahlawan&amp;nbsp;&lt;/span&gt;&lt;/p&gt;', 13, '', '', '2023-07-09 20:35:36', '2023-08-24 15:03:46'),
(25, 7, 'Apotek Hadinata', 'uploads/hostelry_94041', '&lt;p class=&quot;MsoNormal&quot; style=&quot;line-height: 1;&quot;&gt;&lt;span lang=&quot;EN-ID&quot; style=&quot;line-height: 107%;&quot;&gt;Apotek Hadinata merupakan sebuah apotek yang terletak di jalan Kopi Selatan&lt;br&gt;&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot;&gt;&lt;span lang=&quot;EN-ID&quot; style=&quot;line-height: 107%;&quot;&gt;Gg.\r\nKopi 1B, Mentawa Baru Hilir, Kec. Mentawa Baru Ketapang, Kabupaten Kotawaringin\r\nTimur, Kalimantan Tengah 74321&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot;&gt;&lt;span lang=&quot;EN-ID&quot; style=&quot;line-height: 107%;&quot;&gt;Buka\r\n&lt;/span&gt;&lt;span lang=&quot;EN-ID&quot; style=&quot;line-height: 107%;&quot;&gt;&sdot;&lt;/span&gt;&lt;span lang=&quot;EN-ID&quot; style=&quot;line-height: 107%;&quot;&gt; Tutup pukul 21.00&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot;&gt;&lt;span lang=&quot;EN-ID&quot; style=&quot;line-height: 107%;&quot;&gt;0857-9917-1816&lt;/span&gt;&lt;/p&gt;&lt;p&gt;\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot;&gt;&lt;br&gt;&lt;/p&gt;', 10, '', '', '2023-07-09 20:39:36', '2023-08-24 15:03:24'),
(26, 7, 'Apotek Surabaya', 'uploads/hostelry_938020', '&lt;p class=&quot;MsoNormal&quot;&gt;Apotek Surabaya merupakan sebuah apotek yang terletak di jalan Pandjaitan&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot;&gt;&lt;span lang=&quot;EN-ID&quot; style=&quot;line-height: 107%;&quot;&gt;&amp;nbsp; Jl. D.I. Panjaitan No.79, Mentawa Baru Hilir,\r\nKec. Mentawa Baru Ketapang, Kabupaten Kotawaringin Timur, Kalimantan Tengah\r\n74321&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot;&gt;&lt;span lang=&quot;EN-ID&quot; style=&quot;line-height: 107%;&quot;&gt;Buka\r\n&lt;/span&gt;&lt;span lang=&quot;EN-ID&quot; style=&quot;line-height: 107%;&quot;&gt;&sdot;&lt;/span&gt;&lt;span lang=&quot;EN-ID&quot; style=&quot;line-height: 107%;&quot;&gt; Tutup pukul 22.00&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot;&gt;&lt;span lang=&quot;EN-ID&quot; style=&quot;line-height: 107%;&quot;&gt;(0531)\r\n34333&lt;/span&gt;&lt;/p&gt;', 10, '', '', '2023-07-09 21:11:57', '2023-08-24 15:03:00'),
(27, 7, 'Travel Wisana Sampit', 'uploads/hostelry_936110', '&lt;p class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-size: 0.875rem;&quot;&gt;Travel wisana sampit , Merupakan travel yang\r\nsangat ramai apalagi letak nya di pinggir jalan dan sering orang &ndash; orang\r\nmenggunakan travel wisana saat keluar kota termasuk saya ,&lt;/span&gt;&lt;span style=&quot;font-size: 0.875rem;&quot;&gt;tujuan nya mulai\r\ndari ke pangkalanbun , banjarmasin , palangkarya dll.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot;&gt;Jln Ahmad yani no 27 ketapang mentawa baru hulu&lt;span style=&quot;font-size: 0.875rem;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 14, '', '', '2023-07-09 21:53:37', '2023-08-24 15:02:41'),
(28, 32, 'Suzie Salon', 'uploads/hostelry_934417', '&lt;p class=&quot;MsoNormal&quot; style=&quot;line-height: 150%;&quot;&gt;&lt;span lang=&quot;EN-ID&quot; style=&quot;&quot;&gt;Salon kecantikan\r\nadalah tempat khusus untuk merawat kecantikan wanita dari rambut, wajah, kulit,\r\nkuku dan sebagainya. Salon Kecantikan merupakan fasilitas untuk mempercantik\r\ndiri dalam waktu yang relatif cepat.Kegiatan salon terbagi menjadi 3 bagian\r\nyaitu rambut, wajah dan tubuh.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot; style=&quot;line-height: 150%;&quot;&gt;&lt;span lang=&quot;EN-ID&quot; style=&quot;line-height: 107%;&quot;&gt;Alamat: Jl.Hasan Mansyur&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 9, '', '', '2023-07-09 22:29:06', '2023-08-24 15:02:24'),
(29, 32, 'Gereja Katolik St. Joan don Bosco', 'uploads/hostelry_928425', '&lt;p style=&quot;margin: 6pt 0in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;&quot;&gt;Santo Yohanes Bosco Sampit merupakan suatu paroki Gereja Katolik Roma di Keuskupan Palangka Raya;&amp;nbsp;&lt;span style=&quot;font-size: 0.875rem;&quot;&gt;berpusat di Kelurahan Mentawa Baru Hulu - Kecamatan Mentawa Baru Ketapang, di Kota Sampit - Kalimantan Tengah. Misa dimulai pukul 18:00-19:00 (gereja selalu buka)&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin: 6pt 0in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;&quot;&gt;Alamat&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; : Jl. Kom. Laut Yos Sudarso, Mentawa Baru Hulu Mentawa Baru Ketapang, Sampit, Kalimantan Tengah 74322&lt;br&gt;&lt;/p&gt;', 16, '', '', '2023-07-09 22:37:07', '2023-08-24 15:01:24'),
(30, 32, 'Gereja GKE Maranatha Sampit ', 'uploads/hostelry_92693', '&lt;p style=&quot;margin: 6pt 0in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;&quot;&gt;&lt;span lang=&quot;EN-ID&quot; style=&quot;background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;&quot;&gt;Salah\r\nsatu&amp;nbsp;gereja&amp;nbsp;yang dipadati, yakni&amp;nbsp;Gereja&amp;nbsp;Maranatha&amp;nbsp;di\r\nJalan S Parman.&amp;nbsp;Gereja&amp;nbsp;legendaris di&amp;nbsp;Sampit&amp;nbsp;dengan\r\narsitektur luar negeri. Sembahyang dimulai pukul 17:00-18:00&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot;&gt;&lt;span lang=&quot;EN-ID&quot; style=&quot;color:black;mso-themecolor:text1&quot;&gt;Alamat&amp;nbsp; : Jl. Kom. Laut Yos Sudarso, &lt;a href=&quot;https://id.wikipedia.org/wiki/Mentawa_Baru_Hulu,_Mentawa_Baru_Ketapang,_Kotawaringin_Timur&quot; title=&quot;Mentawa Baru Hulu, Mentawa Baru Ketapang, Kotawaringin Timur&quot;&gt;&lt;span style=&quot;color: black;&quot;&gt;Mentawa Baru Hulu&lt;/span&gt;&lt;/a&gt;&amp;nbsp;&lt;a href=&quot;https://id.wikipedia.org/wiki/Mentawa_Baru_Ketapang,_Kotawaringin_Timur&quot; title=&quot;Mentawa Baru Ketapang, Kotawaringin Timur&quot;&gt;&lt;span style=&quot;color: black;&quot;&gt;Mentawa Baru\r\nKetapang&lt;/span&gt;&lt;/a&gt;,&amp;nbsp;&lt;a href=&quot;https://id.wikipedia.org/wiki/Sampit_(kota)&quot; title=&quot;Sampit (kota)&quot;&gt;&lt;span style=&quot;color: black;&quot;&gt;Sampit&lt;/span&gt;&lt;/a&gt;, &lt;a href=&quot;https://id.wikipedia.org/wiki/Kalimantan_Tengah&quot; title=&quot;Kalimantan Tengah&quot;&gt;&lt;span style=&quot;color: black;&quot;&gt;Kalimantan Tengah&lt;/span&gt;&lt;/a&gt;&amp;nbsp;74322&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;', 16, '', '', '2023-07-09 22:44:10', '2023-08-24 15:01:09'),
(31, 7, 'Klenteng Kong Miao Lintang', 'uploads/hostelry_735923', '&lt;p style=&quot;margin: 6pt 0in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;&quot;&gt;&lt;span lang=&quot;EN-ID&quot; style=&quot;background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;&quot;&gt;Klenteng Harmoni Kehidupan Sampit di Jalan MT\r\nHaryono, Kecamatan Mentawa Baru Ketapang, Kabupaten Kotawaringin Timur (Kotim) melakukan\r\nibadah syukur awal tahun sebagai puncak perayaan Imlek 2574 kongzili pada\r\nMinggu malam, 22 Januari 2023. Sembahyang dimulai 00:00 sampai selesai&lt;/span&gt;&lt;span lang=&quot;EN-ID&quot; style=&quot;background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin: 6pt 0in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;&quot;&gt;&lt;span lang=&quot;EN-ID&quot; style=&quot;background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;&quot;&gt;\r\n\r\n&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin: 6pt 0in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;margin: 6pt 0in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;&quot;&gt;&lt;span lang=&quot;EN-ID&quot; style=&quot;background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;&quot;&gt;Alamat : Jl.MT.Haryono, Mentawa Baru Ketanpang, Kabupaten Kotawaringin\r\nTimur, Kalimantan Tengah 74311&lt;span style=&quot;font-size: 14pt;&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;', 16, '', '', '2023-07-09 22:47:20', '2023-08-24 14:29:19'),
(32, 32, 'Fajar GYM', 'uploads/hostelry_69086', '&lt;p&gt;&lt;span style=&quot;font-size:11.0pt;line-height:107%;\r\nfont-family:&amp;quot;Calibri&amp;quot;,sans-serif;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:\r\nCalibri;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;\r\nmso-bidi-font-family:&amp;quot;Times New Roman&amp;quot;;mso-bidi-theme-font:minor-bidi;\r\nmso-ansi-language:EN-US;mso-fareast-language:EN-US;mso-bidi-language:AR-SA&quot;&gt;Fajar\r\nGym dan futsal dikenai harga 25 ribuan per hari buka dari jam 08.00 sampe jam\r\n21.00&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 8, '', '', '2023-07-10 04:43:27', '2023-08-24 14:21:48'),
(33, 32, 'SHMG SAMPIT (Serba Harga Murah Girls Sampit)', 'uploads/hostelry_67506', '&lt;p&gt;Toko SHMG yang menjual pakaian dan aksesoris khusus wanita yang berlokasi di Jalan AIS\r\nNasution, Sampit Kabupaten Kotawaringin Timur, Kalimantan Tengah. SHMG merupakan\r\nkependekan dari Serba Harga Murah Girls. Sesuai nama tokonya, pengelola toko\r\nmenunjukkan komitmen dengan menjual produk-produk dengan harga murah namun\r\nberkualitas. Produk murah yang bukan murahan.Toko yang buka pukul 08.00 WIB hingga\r\n21.00 WIB,Lantai satu diisi dengan produk pakaian, sedangkan lantai dua diisi produk lain\r\nseperti sepatu, sandal, tas, dompet, masker dan aksesoris lainnya.&amp;nbsp;&lt;br&gt;&lt;/p&gt;', 7, '', '', '2023-07-10 04:47:48', '2023-08-24 14:19:10'),
(34, 32, 'NOSH CAFÃ‰  & EATERY', 'uploads/hostelry_67237', '&lt;p&gt;&lt;span style=&quot;line-height: 115%;&quot;&gt;Restoran\r\ndan caf&eacute; menjadi tempat yang sering dikunjungi karena menyediakan berbagai\r\nragam menu makanan dan minuman yang di sajikan, resto dan caf&eacute; ini juga sering\r\ndi jadikan tempat parties acara keluarga ataupun ulang tahun.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 12, '', '', '2023-07-10 04:52:38', '2023-08-24 14:18:43'),
(35, 7, 'Masjid As Shidiq', 'uploads/hostelry_668511', '&lt;p&gt;masjid adem dan luas untuk parker,dan nyaman&lt;br&gt;&lt;/p&gt;', 16, '', '', '2023-07-10 04:55:22', '2023-08-24 14:18:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int(30) NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `packages`
--

CREATE TABLE `packages` (
  `id` int(30) NOT NULL,
  `title` text DEFAULT NULL,
  `tour_location` text DEFAULT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `cost` double NOT NULL,
  `type` tinyint(2) NOT NULL DEFAULT 1,
  `description` text DEFAULT NULL,
  `upload_path` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 =active ,2 = Inactive',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `packages`
--

INSERT INTO `packages` (`id`, `title`, `tour_location`, `lat`, `lng`, `cost`, `type`, `description`, `upload_path`, `status`, `date_created`) VALUES
(1, 'WISATA TUMBANG GAGU', 'ANTANG KALANG', '121', '1212', 0, 1, '&lt;p class=&quot;fs-5 mb-4&quot; style=&quot;text-align: justify; line-height: 1.75;&quot;&gt;&lt;font color=&quot;#212529&quot; face=&quot;system-ui, -apple-system, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, Liberation Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 18px;&quot;&gt;Terletak di Kecamatan Antang Kalang, kira kira 190 Km dari Kota Sampit, dapat di capai dengan meggunakan transportasi darat menuju Antang Kalang dan dilanjutkan kemudian menggunakan transportasi sungai menuju Desa Tumbang Gagu memakan waktu sekitar 5-6 jam perjalanan. Sepanjang perjalanan terdapat panorama yang menarik, juga melewati riamriam yang cukup menantang. Pembangunan Betang Tumbang Gagu dimulai pada tahun 1870 dan selesai pada tahun 1878, pembangunan betang ini di rintis oleh Singa jaya Antang bin Lambang. Pangkong lding, Tuyang Busou, Boruk Dowut dan Lambang Dadu (Ayah Anting). Betang Tumbang Gagu adalah rumah tradisional Suku Dayak yang berukuran besar sehingga dapat dihuni oleh beberapa kepala keluarga. Betang ini masih terjaga keberadaannya meskipun dibeberapa bagian sudah mulai lapuk di makan usia. Arsitektur betang ini sederhana tetapi unik karena dalam pembangunannya tidak menggunakan paku melainkan menggunakan pasak dan kayu.&lt;/span&gt;&lt;/font&gt;&lt;br&gt;&lt;/p&gt;', 'uploads/package_284223', 1, '2021-06-18 10:31:03'),
(7, 'MUSEUM KAYU SAMPIT', 'SAMPIT', '', '', 0, 1, '&lt;p style=&quot;text-align: justify; &quot;&gt;&lt;font color=&quot;#000000&quot; face=&quot;Open Sans, Arial, sans-serif&quot;&gt;Bangunan yang terletak di jalan S. Parman Sampit, diberi nama Museum Kayu karena pada awalnya terbuat dari kayu, bangunan tersebut telah berdiri sejak jaman pemerintahan Belanda, kemudian mengalami renovasi. Bangunan ini sempat digunakan sebagai kantor Dinas Kehutanan, kemudian diserahkan kepada Dinas Pendidikan yang selanjutnya hingga sekarang menjadi UPTD Museum Kayu di bawah Dinas Kebudayaan dan Pariwisata Kabupaten Kotawaringin Timur. Museum ini tidak hanya memamerkan koleksi tentang perkayuan saja, tetapi juga terdapat beberapa koleksi tentang sejarah, alam, kebudayaan dan lain-lain. Fasilitas 1. Dekat dengan Pasar 2. Lokasi mudah di akses 3. Ada kafe buat hangout Jam Operasional Senin - Minggu | 10:00-16:30 WIB&lt;/font&gt;&lt;br&gt;&lt;/p&gt;', 'uploads/package_291818', 1, '2021-06-18 11:17:11'),
(8, 'PANTAI UJUNG PANDARAN', 'TELUK SAMPIT', '', '', 0, 1, '&lt;p style=&quot;line-height: 1.75; font-size: 16px; color: rgb(77, 77, 77); font-family: Poppins, Arial, sans-serif;&quot;&gt;&lt;span style=&quot;font-family: &amp;quot;Segoe UI Emoji&amp;quot;;&quot;&gt;Pantai Ujung Pandarat berada di Desa Ujung Pandaran, Kecamatan &amp;nbsp;Teuk Sempit, Kabupaten Kotawaringin timur, Kalimatan Tegah yang terletak 80 km dari pusat Kota Sampit. Pantai ini terekenal akan pantai yang landai dan biota lautnya yang membentang puluhan kilometer dari Kabupaten Kotawaringin Timur ingga perbatasan Kabupaten seruyan.&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;line-height: 1.75; font-size: 16px; color: rgb(77, 77, 77); font-family: Poppins, Arial, sans-serif;&quot;&gt;&lt;span style=&quot;font-family: &amp;quot;Segoe UI Emoji&amp;quot;;&quot;&gt;Keberadaan Pandaran Pantai Ujung jauh dari keramaian kota adalah tempat yang bagus untuk liburan. Pantai Ujung Pandaran termasuk jenis miring pantai dan berdekatan dengan Laut &amp;nbsp;Utara.Pantai ini juga menawarkan pemandangan matahari terbenam atau matahari terbenam yang indah .Setiap tanggal 10 bulan Syawal (10 hari setelah Idul Fitri) mengadakan ritual kaleng laut. nelayant akan bekerja sama untuk membersihkan pantai sebelum ritual dimulai, maka berbagai diperpanjang persembahan akan dilarung ke laut. Keberadaan ritual ini memang percaya akan membawa keamanan dan melimpah keberuntungan untuk anjing.&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;line-height: 1.75; font-family: &amp;quot;Roboto Slab&amp;quot;, -apple-system, BlinkMacSystemFont, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 16px; color: rgb(77, 77, 77);&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;line-height: 1.75; font-size: 16px; color: rgb(77, 77, 77); font-family: Poppins, Arial, sans-serif;&quot;&gt;&lt;span style=&quot;font-family: &amp;quot;Segoe UI Emoji&amp;quot;;&quot;&gt;Akses dari kota Sampit dapat menggunakan kendaraan / waktu pribadi sewa - 3 jam, Anda akan melewati perkebunan kelapa dan semak semak di sisi kiri ke kanan. Dan dari Palangkaraya juga dapat menggunakan kendaraan pribadi / angkutan umum, dari terminal bus bisa Palangkaraya Palangkaraya-Sampit jurusan. Setelah tiba di Sampit terus menggunakan bus menuju ke Teluk Sampit.&lt;/span&gt;&lt;/p&gt;&lt;h5 style=&quot;font-family: Poppins, Arial, sans-serif; font-weight: 700; line-height: 1.5; color: rgb(0, 0, 0);&quot;&gt;&lt;span style=&quot;font-family: &amp;quot;Segoe UI Emoji&amp;quot;;&quot;&gt;Fasilitas&lt;/span&gt;&lt;/h5&gt;&lt;p style=&quot;line-height: 1.75; font-size: 16px; color: rgb(77, 77, 77); font-family: Poppins, Arial, sans-serif;&quot;&gt;&lt;span style=&quot;font-family: &amp;quot;Segoe UI Emoji&amp;quot;;&quot;&gt;- Tempat parkir motor dan mobil - Mushola - Tempat Foto - Warung Makan&lt;/span&gt;&lt;/p&gt;&lt;h5 style=&quot;font-family: Poppins, Arial, sans-serif; font-weight: 700; line-height: 1.5; color: rgb(0, 0, 0);&quot;&gt;&lt;span style=&quot;font-family: &amp;quot;Segoe UI Emoji&amp;quot;;&quot;&gt;Kontak&lt;/span&gt;&lt;/h5&gt;&lt;p style=&quot;line-height: 1.75; font-size: 16px; color: rgb(77, 77, 77); font-family: Poppins, Arial, sans-serif;&quot;&gt;&lt;span style=&quot;font-family: &amp;quot;Segoe UI Emoji&amp;quot;;&quot;&gt;0851234565432&lt;/span&gt;&lt;/p&gt;&lt;h4 style=&quot;font-family: Poppins, Arial, sans-serif; font-weight: 700; line-height: 1.5; color: rgb(0, 0, 0);&quot;&gt;&lt;span style=&quot;font-family: &amp;quot;Segoe UI Emoji&amp;quot;;&quot;&gt;Lokasi&lt;/span&gt;&lt;/h4&gt;&lt;p style=&quot;line-height: 1.75; font-size: 16px; color: rgb(77, 77, 77); font-family: Poppins, Arial, sans-serif;&quot;&gt;&lt;span style=&quot;font-family: &amp;quot;Segoe UI Emoji&amp;quot;;&quot;&gt;Pantai Ujung Pandaran Teluk Sampit Kabupaten Kotawaringin Timur, Parebok , Teluk Sampit , KAB. KOTAWARINGIN TIMUR&lt;/span&gt;&lt;/p&gt;', 'uploads/package_297125', 1, '2021-06-18 13:34:08'),
(18, 'WISATA IKON JELAWAT', 'SAMPIT', '', '', 0, 1, '&lt;article style=&quot;&quot;&gt;&lt;section class=&quot;mb-5&quot; style=&quot;&quot;&gt;&lt;p class=&quot;fs-5 mb-4&quot; style=&quot;text-align: justify; &quot;&gt;&lt;font color=&quot;#212529&quot; face=&quot;system-ui, -apple-system, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, Liberation Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji&quot;&gt;&lt;span style=&quot;font-size: 14px;&quot;&gt;Wisata Ikon Jelawat di Kotawaringin Timur merupakan salah satu ikon kebanggaan warga Sampit. Obyek wisata yang dibangun di bantaran sungai Mentaya ini sangat digemari masyarakat. Di tengahnya berdiri patung ikan jelawat besar yang menghadap ke sungai Mentaya. Angin sejuk yang berhembus dari perairan sungai semakin menambah kenyamanan yang menggiurkan. Sore hari menjadi waktu yang sering dipadati pengunjung dari berbagai kalangan usia. Sore hari menjadi waktu yang sering dipadati pengunjung dari berbagai kalangan usia. Warga yang melakukan perjalanan trans Kalimantan pun juga seringkali sengaja singgah di sini. Wisata Ikon Jelawat seakan menjadi bukti khas bahwa wisatawan pernah berkunjung ke Sampit. Letaknya cukup strategis di antara pusat perbelanjaan Mentaya, sungai Mentaya, dan Pelabuhan Sampit. Sore hari menjadi waktu yang sering dipadati pengunjung dari berbagai kalangan usia. Warga yang melakukan perjalanan trans Kalimantan pun juga seringkali sengaja singgah di sini. Wisata Ikon Jelawat seakan menjadi bukti khas bahwa wisatawan pernah berkunjung ke Sampit. Letaknya cukup strategis di antara pusat perbelanjaan Mentaya, sungai Mentaya, dan Pelabuhan Sampit Fasilitas Di jalan menuju Wisata Ikon Jelawat disediakan jalur bagi pengguna kursi roda. Tersedia toilet umum dan juga masjid untuk pengunjung yang hendak beribadah. Di dekat kawasan wisata ini terdapat Pusat Perbelanjaan Mentaya. Di sana menjual berbagai kebutuhan pokok warga Sampit dari makanan, pakaian, hingga pernak-pernik.&lt;/span&gt;&lt;/font&gt;&lt;br&gt;&lt;/p&gt;&lt;/section&gt;&lt;/article&gt;', 'uploads/package_24613', 1, '2022-12-23 17:49:08'),
(19, 'WISATA KALAP AIR TERJUN MERAH KALAP GADUR', 'KALAP', '', '', 0, 1, '&lt;div style=&quot;&quot;&gt;&lt;p class=&quot;fs-5 mb-4&quot; style=&quot;text-align: justify; line-height: 1.75;&quot;&gt;&lt;span style=&quot;font-size: 14px;&quot;&gt;&iuml;&raquo;&iquest;Kawasan Ujung Pandaran kecamatan Teluk Sampit Kalimantan tengah, ternyata tidak hanya memiliki destinasi wisata berupa pantai nan indah, ternyata ada potensi wisata lain yang sangat unik dan masih belum banyak diketahui orang. Yakni, air terjun merah. Masyarakat setempat menyebutnya air terjun merah, karena warna airnya yang kemerahan. Spot wisata ini terletak di kampung Kalap Gadur. Air nya yang berwarna kemerah-merahan dan sangat jernih ini mengalir dengan deras dari atas tebing yang hanya setinggi sekitar tiga meter. Warnanya yang merah karena mengalir dari tanah gambut.. Saat panas terik, suara gemuruh dan gemericik dari air yang berasal dari wilayah hulu hutan pedalaman ini, memberikan nuansa alami yang berbeda. Lokasi ini belum banyak diketahui oleh masyarakat luar daerah tersebut. Sehingga suasananya masih terasa sangat alami, asri &amp;amp; eksotis. Untuk mencapai lokasi air terjun merah di kampung Kalap Gadur, dapat ditempuh dari desa Ujung Pandaran menuju arah kabupaten Seruyan. Hanya dibutuhkan waktu perjalanan sekitar 30 menit atau sejauh 20 kilometer, baik dengan mengendarai mobil maupun sepeda motor. Sebelum sampai di spot air terjun tersebut, kita akan melewati padang rumput yang sangat luas, disini kita akan disajikan sensasi seakan-akan sedang mengarungi padang savana hijau dengan pemandangan yang masih sangat alami.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;/div&gt;', 'uploads/package_25702', 1, '2022-12-23 17:49:20'),
(20, 'WISATA PANTAI SATIRUK', 'SATIRUK', '', '', 0, 1, '&lt;p class=&quot;fs-5 mb-4&quot; style=&quot;line-height: 1.75; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, &amp;quot;Noto Sans&amp;quot;, &amp;quot;Liberation Sans&amp;quot;, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 1.25rem !important;&quot;&gt;Pantai yang berada di ujung selatan Kabupaten Kotawaringin Timur ini berjarak 78 kilometer dari Kota Sampit masuk di wilayah Kecamatan Pulau Hanaut, Desa Cemeti&lt;/p&gt;&lt;p class=&quot;fs-5 mb-4&quot; style=&quot;line-height: 1.75; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, &amp;quot;Noto Sans&amp;quot;, &amp;quot;Liberation Sans&amp;quot;, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 1.25rem !important;&quot;&gt;Pantai ini masih alami dikarenakan akses menuju ke tempat ini hanya dapat dilalui dengan menggunakan kendaraan roda dua dan menggunakan transportasi ai. Dengan pantai yang masih bersih dan alami sehingga sangat cocok untuk menjadi obyek wisata alternatif di Kabupaten Kotawaringin Timur.&lt;/p&gt;&lt;p class=&quot;fs-5 mb-4&quot; style=&quot;line-height: 1.75; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, &amp;quot;Noto Sans&amp;quot;, &amp;quot;Liberation Sans&amp;quot;, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 1.25rem !important;&quot;&gt;Pantai Satiruk diambil dari nama desanya yakni Desa Satiruk. Desa ini merupakan desa terujung di Kecamatan Pulau Hanaut yang langsung menghadap Laut Jawa. Hamparan pasir putih sepanjang sekitar 25 kilometer, langsung memanjakan mata para pengunjung yang menginjakkan kaki di pantai ini.&lt;/p&gt;&lt;h2 class=&quot;fw-bolder mb-4 mt-5&quot; style=&quot;font-family: system-ui, -apple-system, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, &amp;quot;Noto Sans&amp;quot;, &amp;quot;Liberation Sans&amp;quot;, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; color: rgb(33, 37, 41); font-weight: bolder !important;&quot;&gt;Fasilitas&lt;/h2&gt;&lt;p class=&quot;fs-5 mb-4&quot; style=&quot;line-height: 1.75; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, &amp;quot;Noto Sans&amp;quot;, &amp;quot;Liberation Sans&amp;quot;, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 1.25rem !important;&quot;&gt;1. parkir gratis&lt;br&gt;2. Lokasi mudah di akses&lt;br&gt;3. pemandangan yang indah&lt;br&gt;&lt;/p&gt;&lt;h2 class=&quot;fw-bolder mb-4 mt-5&quot; style=&quot;font-family: system-ui, -apple-system, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, &amp;quot;Noto Sans&amp;quot;, &amp;quot;Liberation Sans&amp;quot;, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; color: rgb(33, 37, 41); font-weight: bolder !important;&quot;&gt;Jam Operasional&lt;/h2&gt;&lt;p class=&quot;fs-5 mb-4&quot; style=&quot;line-height: 1.75; color: rgb(33, 37, 41); font-family: system-ui, -apple-system, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, &amp;quot;Noto Sans&amp;quot;, &amp;quot;Liberation Sans&amp;quot;, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 1.25rem !important;&quot;&gt;Setiap Hari | 08:00 - 16:00 WIB&lt;/p&gt;', 'uploads/package_264023', 1, '2022-12-23 17:49:39'),
(21, 'WISATA TAMAN MINIATUR BUDAYA KOTIM', 'SAMPIT', '', '', 0, 1, '&lt;p style=&quot;text-align: justify; &quot;&gt;&lt;span style=&quot;font-size: 18px;&quot;&gt;Taman Miniatur Budaya ini berada di jalan Pramuka, berada persis di belakang Mesjid Wahyu Al Hadi dan Komplek lslamic Center, di bangun oleh Dinas Kebudayaan dan Pariwisata kabupaten Kotawaringin Timur memiliki beberapa miniatur rumah adat, seperti : Rumah Betang, Rumah Adat Banjar, Rumah Adat Bali dan Rumah Joglo Jogja serta terdapat panggung terbuka yang digunakan untuk pertunjukan kesenian. Tempat ini juga selalu digunakan untuk melaksanakan kegiatan Mampakanan Sahur dan Mamapas Lewu. Fasilitas 1. Berdekatan dengan Masjid IC Sampit 2. Lokasi mudah di akses dengan kendaraan apapun 3. di Lokasi wisata tersebut berdekatan dengan PKL (Pedagang Kaki Lima) Jam Operasional Senin - Minggu | 10:00-16:30 WIB&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 'uploads/package_27005', 1, '2022-12-23 17:49:58'),
(22, 'WISATA BUNDARAN BALANGA', 'SAMPIT', '', '', 0, 1, '&lt;p&gt;Bundaran yang berada di jalan Jenderal Sudirman Km. 3 ini pada awalnya hanya terdapat tiang dari Kayu Ulin yang didirikan untuk memperingati Tragedi Kemanusiaan yang pernah terjadi di Kabupaten Kotawaringin Timur pada tahun 2001, pada tiang tersebut terdapat berbagai macam ukiran yang mewakili aliran sungai besar yang ada di Kabupaten Kotawaringin Timur. Pada Pemerintahan Bupati H. Supian hadi, S. lkom bundaran ini dipercantik agar menarik minat masyarakat untuk mengunjunginya dan untuk memperindah kota Sampit Tepat disebelah barat bundaran balanga, merupakan komplek Islamic Center dan juga Mesjid Raya Wahyu Al Hadi&quot;. Fasilitas 1. Dekat dengan Masjid 2. Lokasi mudah di akses Jam Operasional Buka Setiap Hari | 10:00-16:30 WIB&lt;br&gt;&lt;/p&gt;', 'uploads/package_27823', 1, '2022-12-23 17:50:10'),
(23, 'RUMAH BETANG PANTAI UJUNG PANDARAN', 'TELUK SAMPIT', '', '', 0, 1, '&lt;p&gt;RUMAH BETANG YANG MEMILIKI TERAS,&amp;nbsp; RUANG TENGAH, 4 KAMAR TIDUR DAN 2 KAMAR MANDI DI LUAR&amp;nbsp;&lt;span style=&quot;font-size: 0.875rem;&quot;&gt;UTAMA (L= 6,10 M P= 12,70M)&amp;nbsp; TERAS (L= 2,80M P= 2,80M) PENGHUBUNG (L= 2,60M P= 3,30M)&lt;/span&gt;&lt;/p&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;', 'uploads/package_196919', 1, '2022-12-29 19:13:07'),
(24, 'SUMUR BAJAU PANTAI UJUNG PANDARAN', 'TELUK SAMPIT ', '', '', 0, 1, '&lt;p&gt;SUMUR SEDALAM 2 METER YANG AIR TAWARNYA TIDAK PERNAH HABIS MAUPUN KERING, BERADA DI TENGAH DESA UJUNG&amp;nbsp;&lt;span style=&quot;font-size: 0.875rem;&quot;&gt;PANDARAN&lt;/span&gt;&lt;/p&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;', 'uploads/package_203218', 1, '2022-12-29 19:16:42'),
(25, 'DERMAGA TELUK SAMPIT PANTAI UJUNG PANDARAN', 'TELUK SAMPIT', '', '', 0, 1, '&lt;p&gt;DERMAGA DI SISI DALAM TELUK SAMPIT, AIR TAWAR, TERDAPAT HUTAN MANGROVE, TERHAMPAR LUMPUR YANG LUAS SAAT&amp;nbsp;&lt;span style=&quot;font-size: 0.875rem;&quot;&gt;AIR SURUT&lt;/span&gt;&lt;/p&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;', 'uploads/package_217110', 1, '2022-12-29 19:20:03'),
(26, 'HABITAT MONYET TRANS  PANTAI UJUNG PANDARAN KUALA PEMBUANG\r\n', 'TELUK SAMPIT', '', '', 0, 1, '&lt;p&gt;TITIK BERKUMPULNYA SEKUMPULAN MONYET MENCARI MAKANAN, BEBERAPA MASYARAKAT YANG LEWAT SERING&amp;nbsp;&lt;span style=&quot;font-size: 0.875rem;&quot;&gt;MEMBERI SEDIKIT CEMILAN DI TITIK AREAN PERKUMPULAN INI&lt;/span&gt;&lt;/p&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;', 'uploads/package_222215', 1, '2022-12-29 19:22:34'),
(27, 'KUBAH MAKAM KERAMAT PANTAI UJUNG PANDARAN', 'TELUK SAMPIT', '', '', 0, 1, '&lt;p&gt;MERUPAKAN MAKAM YANG DIKERAMAT YAITU MAKAM AL-ALIMUL ALLAAMAH SYEKH HAJI ABU HAMID BIN ALIMUL&lt;br&gt;&lt;/p&gt;', 'uploads/package_227521', 1, '2022-12-29 19:24:40'),
(28, 'SANDUNG SAPUNDU TANAH PASIHAN LEWU TATAU DESA PONDOK DAMAR\r\n', 'MENTAYA HILIR UTARA', '', '', 0, 1, '&lt;p&gt;DIDIRIKAN PADA TANGGAL 16/02/2008&amp;nbsp; DAN TAHUN PENDIRIAN BERPARIASI MENURUT TINGKAT PELAKSANAA&lt;br&gt;&lt;/p&gt;', 'uploads/package_240117', 1, '2022-12-29 19:27:40'),
(29, 'SITUS BUDAYA KERAMAT BATU NYAPAU BUKIT SANTUAI', 'BUKIT SANTUAI', '', '', 0, 1, '&lt;p&gt;KONSERVASI SITUS BUDAYA KERAMAT DAN TANAH ADAT&lt;br&gt;&lt;/p&gt;', 'uploads/package_136818', 1, '2022-12-30 18:19:20'),
(30, 'DANAU ', 'ANTANG KALANG', '', '', 0, 1, '&lt;p&gt;DANAU BERBENTUK BINTANG DENGAN AIR BERWARNA HIJAU&lt;br&gt;&lt;/p&gt;', 'uploads/package_14258', 1, '2022-12-30 18:21:23'),
(31, 'DANAU BIRU', 'ANTANG KALANG', '', '', 0, 1, '&lt;p&gt;DANAU BIRU MASUK DALAM WILAYAH PERKEBUNAN SAWIT PT. KARYA MAKMUR BAHAGIA DIWILAYAH PERBATASAN DESA&amp;nbsp;&lt;span style=&quot;font-size: 0.875rem;&quot;&gt;GUNUNG MAKMUR DAN DESA TUMBANG SEPAYANG KEC. ANTANG KALANG&lt;/span&gt;&lt;/p&gt;', 'uploads/package_148810', 1, '2022-12-30 18:23:29'),
(32, 'TAMAN KOTA SAMPIT', 'SAMPIT', '', '', 0, 1, '&lt;p&gt;DIRESMIKAN SETELAH PERBAIKAN PADA 21 FEBRUARI 2015&lt;br&gt;&lt;/p&gt;', 'uploads/package_164711', 1, '2022-12-30 18:26:57'),
(33, 'ISLAMIC CENTER  DAN MESJID  RAYA WAHYU AL HADI', 'MENTAWA BARU KETAPANG - SAMPIT', '-2.5352957048098905', '112.91140693869075', 0, 1, '&lt;p&gt;-&lt;/p&gt;', 'uploads/package_18239', 1, '2022-12-30 18:29:38'),
(34, 'PEMBATAAN', 'MENTAWA BARU KETAPANG', '', '', 0, 1, '&lt;p&gt;MERUPAKAN TEMPAT USAHA PEMBATAAN YANG HASIL GALIAN TANAH LIATNYA MENGHASILKAN DANAU. MENJADI SALAH&amp;nbsp;&lt;span style=&quot;font-size: 0.875rem;&quot;&gt;SATU TEMPAT YANG SERING DIKUNJUNGIN UNTUK PEMOTRETAN&lt;/span&gt;&lt;/p&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;', 'uploads/package_186821', 1, '2022-12-30 18:31:35'),
(37, 'Terowongan Nur Mentaya', 'Jalan Tjilik Riwut, Sampit', '', '', 0, 4, '<div style=\"color: rgb(33, 37, 41); font-family: &quot;Roboto Slab&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify;\">Terowongan Nur Mentaya adalah sebuah terowongan yang menjadi ikon wisata baru di Kotawaringin Timur. Terowongan ini memiliki keunikan dan keindahan yang menarik perhatian wisatawan.</div><div style=\"color: rgb(33, 37, 41); font-family: &quot;Roboto Slab&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify;\">Terowongan Nur Mentaya terletak di Kotawaringin Timur, tepatnya di Jalan Cilik Riwut, Sampit, Kecamatan Baamang. Lokasinya strategis dan mudah diakses oleh wisatawan.</div><div style=\"color: rgb(33, 37, 41); font-family: &quot;Roboto Slab&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify;\"><br></div><div style=\"color: rgb(33, 37, 41); font-family: &quot;Roboto Slab&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify;\">Terowongan Nur Mentaya telah diresmikan oleh Bupati Kotawaringin Timur, Halikinnor, dan telah menjadi objek wisata yang populer sejak itu. Wisatawan dapat mengunjungi terowongan ini kapan saja sepanjang tahun.&nbsp;Terowongan Nur Mentaya menjadi daya tarik bagi wisatawan lokal dan juga wisatawan dari luar daerah. Wisatawan dari segala usia dapat menikmati keindahan terowongan ini.Terowongan Nur Mentaya menawarkan pengalaman yang unik dan menarik. Keindahan lampu penerangan jalan umum (PJU) yang dipasang di dalam terowongan menciptakan suasana yang memukau saat malam hari. Terowongan ini juga menjadi simbol keindahan Kota Sampit dan mendukung sektor pariwisata serta pertumbuhan ekonomi kerakyatan di kawasan tersebut.&nbsp;Terowongan Nur Mentaya dapat diakses dengan mudah melalui Jalan Cilik Riwut. Wisatawan dapat mengunjungi terowongan ini dengan menggunakan kendaraan pribadi atau menggunakan transportasi umum. Di sepanjang sisi jalan kawasan Terowongan Nur Mentaya, terdapat peluang usaha bagi masyarakat setempat untuk membuka berbagai jenis usaha yang dapat meningkatkan pendapatan dan pertumbuhan ekonomi.</div><div style=\"color: rgb(33, 37, 41); font-family: &quot;Roboto Slab&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify;\"><br></div><div style=\"color: rgb(33, 37, 41); font-family: &quot;Roboto Slab&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px; text-align: justify;\">Dengan keindahan lampu PJU yang memukau, Terowongan Nur Mentaya menawarkan pengalaman wisata yang tak terlupakan. Mari kunjungi destinasi wisata ini dan rasakan pesonanya yang memikat hati. Jangan lupa untuk mengabadikan momen indah Anda di Terowongan Nur Mentaya dan berpartisipasi dalam lomba foto selfie dan video pendek yang diadakan oleh Bupati Kotawaringin Timur, Halikinnor. Yuk, jadikan Terowongan Nur Mentaya sebagai destinasi liburan Anda berikutnya!</div>', 'uploads/package_107224', 1, '2023-08-15 07:57:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rate_review`
--

CREATE TABLE `rate_review` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `anonim_name` varchar(100) DEFAULT NULL,
  `package_id` int(30) NOT NULL,
  `rate` int(11) NOT NULL,
  `review` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rate_review`
--

INSERT INTO `rate_review` (`id`, `user_id`, `anonim_name`, `package_id`, `rate`, `review`, `photo`, `date_created`, `status`) VALUES
(3, 5, '', 8, 5, '<p>bgus disini, rekomended</p>', '', '2022-12-20 11:53:16', 1),
(4, 5, '', 8, 5, '&lt;p&gt;mantab gan disiniii&lt;/p&gt;', '', '2022-12-18 13:49:26', 1),
(10, 6, 'Rizki Maulana', 1, 4, '&lt;p&gt;Yap&lt;/p&gt;', '', '2022-09-26 19:48:11', 1),
(11, 5, '', 8, 5, '&lt;p&gt;bagussss disini&lt;/p&gt;', '', '2022-12-19 13:49:26', 1),
(13, 5, '', 1, 2, '&lt;p&gt;pemandangannya top&lt;/p&gt;', '', '2022-12-19 13:49:26', 1),
(15, 5, 'Rizki Maulana', 18, 5, 'mantabbbb', '', '2022-12-23 11:00:00', 1),
(16, 5, 'Rizki Maulana', 19, 4, 'Review', '', '2022-12-23 11:00:00', 1),
(17, 5, 'Rizki Maulana', 20, 3, 'Review', '', '2022-12-23 11:00:00', 1),
(18, 5, 'Rizki Maulana', 21, 3, 'Review', '', '2022-12-23 11:00:00', 1),
(19, 5, 'Rizki Maulana', 22, 4, 'Review', '', '2022-12-23 11:00:00', 1),
(20, 6, 'tes', 21, 4, '&lt;p&gt;asa&lt;/p&gt;', '', '2022-12-28 11:40:42', 1),
(23, 6, 'Julak Atuy', 8, 5, 'baguss cuy', '', '2022-12-28 12:07:31', 1),
(24, 6, 'Muhammad Andre', 22, 4, '&lt;p&gt;sampit nih boss senggol donkk&lt;/p&gt;', '', '2022-12-28 21:32:25', 1),
(25, 6, 'Rafly', 8, 5, 'wisatanyaa top bgt', '', '2022-12-29 19:31:34', 1),
(26, 6, 'Rasyid', 33, 4, 'SANGAT INDAH', '', '2022-12-30 18:35:01', 1),
(27, 6, 'NISA HAYATUN', 32, 5, '&lt;p&gt;rekomended&lt;/p&gt;', '', '2022-12-30 18:37:35', 1),
(28, 6, 'yoga', 34, 3, '&lt;p&gt;keren&lt;/p&gt;', '', '2022-12-30 19:16:47', 1),
(29, 6, 'Aisha', 31, 4, 'View nya keren', '', '2022-12-31 14:01:51', 1),
(30, 6, 'Della', 24, 3, '&lt;p&gt;Mau tau cerita sejarahnya&lt;/p&gt;', '', '2022-12-31 14:03:11', 1),
(32, 6, 'Ulah', 19, 3, 'Untuk jalan menuju wisata kurang bagus', '', '2023-01-04 16:21:05', 1),
(33, 6, 'Yoga bay', 32, 3, '<p>siip</p>', 'uploads/comments/301778.jpg', '2023-02-24 22:54:21', 1),
(34, 6, 'Yog', 32, 3, '<p>siip</p>', 'uploads/comments/301778.jpg', '2023-02-24 22:54:21', 1),
(35, 6, 'bay', 32, 3, '<p>siip</p>', 'uploads/comments/301778.jpg', '2023-02-24 22:54:21', 1),
(40, 6, 'andika', 36, 5, '<p>tes</p>', NULL, '2023-08-14 23:03:09', 1),
(41, 6, 'Restu ', 37, 5, '<p>mantab bro disni</p>', NULL, '2023-08-15 08:11:32', 1),
(42, 6, 'Setiawan', 37, 5, '<p>bagus banar sip dah</p>', NULL, '2023-08-24 21:19:55', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `shout_box`
--

CREATE TABLE `shout_box` (
  `id` int(11) NOT NULL,
  `user` varchar(60) NOT NULL,
  `message` varchar(100) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `shout_box`
--

INSERT INTO `shout_box` (`id`, `user`, `message`, `date_time`, `ip_address`) VALUES
(21, 'dsdsd', 'aaaa', '2023-06-26 09:28:55', '::1'),
(22, 'wewe', 'dsd', '2023-06-26 09:31:31', '::1'),
(23, 'wewe', 'eeee', '2023-06-26 09:31:35', '::1'),
(24, 'wewe', 'eeeee', '2023-06-26 09:31:37', '::1'),
(25, 'wewe', 'eee', '2023-06-26 09:31:38', '::1'),
(26, 'sss', 'sss', '2023-06-26 09:33:32', '::1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Visit Sampit | Kotawaringin Timur'),
(6, 'short_name', 'JWK-PHP'),
(11, 'logo', 'uploads/1673611080_KOTIM.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/1692028020_1680006900_bg1 (1) (1).png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `isAktive` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`, `isAktive`) VALUES
(1, 'Adminstrator', 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'uploads/1620201300_avatar.png', NULL, 1, '2021-01-20 14:02:37', '2023-08-14 22:46:16', 1),
(4, 'John', 'Smith', 'jsmith', '1254737c076cf867dc53d60a0364f38e', NULL, NULL, 0, '2021-06-19 08:36:09', '2021-06-19 10:53:12', 0),
(5, 'Anonim', '', 'cblake', '4744ddea876b11dcb1d169fadf494418', NULL, NULL, 0, '2021-06-19 10:01:51', '2022-12-26 22:43:36', 0),
(6, 'anonim', '', '', '', NULL, NULL, 0, '2022-09-26 12:36:53', NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `loc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `video`
--

INSERT INTO `video` (`id`, `name`, `description`, `loc`) VALUES
(1, 'Kota Sampit', '<p>Kabupaten Kotawaringin Timur</p>', 'uploads/video/Wisata KOTIM.mp4');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `book_list`
--
ALTER TABLE `book_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hostelry`
--
ALTER TABLE `hostelry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_package` (`id_package`),
  ADD KEY `categories` (`type`);

--
-- Indeks untuk tabel `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rate_review`
--
ALTER TABLE `rate_review`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `shout_box`
--
ALTER TABLE `shout_box`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `book_list`
--
ALTER TABLE `book_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `hostelry`
--
ALTER TABLE `hostelry`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `rate_review`
--
ALTER TABLE `rate_review`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `shout_box`
--
ALTER TABLE `shout_box`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hostelry`
--
ALTER TABLE `hostelry`
  ADD CONSTRAINT `categories` FOREIGN KEY (`type`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `hostelry_ibfk_1` FOREIGN KEY (`id_package`) REFERENCES `packages` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
