-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 15, 2025 at 05:33 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nextedu-laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sinopsis` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `kategori_id`, `judul`, `img`, `sinopsis`, `link`, `created_at`, `updated_at`) VALUES
(1, 1, '4 Hal Yang Kamu Pelajari di SMK Jurusan Teknik Komputer Dan Jaringan', 'artikel_images/VhcokxmmxsCLm8QEbYPvBMFMd1qvAHjnZQZHi6RY.jpg', 'Jurusan TKJ di SMK mengajarkan perakitan komputer, jaringan, pemrograman website, dan sistem operasi jaringan. Siswa juga mendapatkan pengalaman magang di industri, menjadikannya pilihan tepat bagi yang tertarik dengan teknologi.', 'https://www.vokasi.kemdikbud.go.id/read/b/4-hal-yang-kamu-pelajari-di-smk-jurusan-teknik-komputer-dan-jaringan', '2025-03-19 05:09:12', '2025-04-10 02:55:09'),
(2, 1, 'Jurusan TKJ: Pengertian, Materi yang Dipelajari, dan Prospeknya', 'artikel_images/ytg7PiKhCy9G7brdwuf5oFEMVT0bcxTwQ0xlHGQl.jpg', 'Jurusan TKJ atau teknik komputer jaringan adalah jurusan bidang teknologi yang bisa kamu temukan di sekolah menengah kejuruan.\r\nSetelah belajar di jurusan ini, kamu bisa mendalami keahlianmu di perguruan tinggi pada program studi yang relevan, seperti teknik informatika atau ilmu komputer. Yuk, simak rangkuman Glints di bawah ini!', 'https://glints.com/id/lowongan/jurusan-tkj/', '2025-03-19 05:15:46', '2025-04-02 16:12:31'),
(3, 1, 'Lulusan SMK TKJ Bisa Kerja Apa? Simak 10 Pilihan Karirnya!', 'artikel_images/BMYvsKKoGZVy9JGmSnQQw9GEaQJhxNWTavim3q7C.png', 'Jurusan Teknik Komputer dan Jaringan (TKJ) memiliki prospek karir yang luas seiring perkembangan teknologi. Lulusan TKJ tidak hanya bekerja di bidang IT, tetapi juga sebagai konsultan IT atau pengelola data perusahaan. Artikel ini membahas lebih dalam tentang jurusan TKJ dan peluang kerjanya.', 'https://www.cake.me/resources/jurusan-tkj?locale=id', '2025-03-19 05:18:37', '2025-04-10 02:58:10'),
(4, 1, '8 Profesi Jurusan Teknik Komputer dan Jaringan (TKJ) Bergaji Besar!', 'artikel_images/tgEjSdJdS7vIPxH8tf4zzXnAOI2DuW2GJRo1jhAp.jpg', 'Memilih jurusan TKJ (Teknik Komputer dan Jaringan) atau TJKT (Teknik Jaringan Komputer dan Telekomunikasi) di SMK adalah keputusan yang tepat. Kamu bisa memilih menjadi satu dari 9 profesi berikut ini di masa depan nanti. Apalagi, gaji yang ditawarkan.', 'https://www.gamelab.id/news/2346-8-profesi-jurusan-teknik-komputer-dan-jaringan-tkj-bergaji-besar', '2025-03-19 05:20:43', '2025-04-10 02:54:37'),
(5, 1, 'Rekomendasi Jurusan Kuliah untuk Kamu Lulusan TKJ', 'artikel_images/lOUIvMECzCWCGQG7rtKJwNsVOWGYtagYVNpG63Pw.jpg', 'Jurusan TKJ memiliki prospek karir luas, tidak hanya di IT tetapi juga sebagai konsultan dan pengelola data perusahaan. Artikel ini membahas peluang kerja dan jurusan kuliah yang sesuai untuk lulusan TKJ.', 'https://www.prestasikita.com/2024/06/29/rekomendasi-jurusan-kuliah-untuk-kamu-lulusan-tkj/', '2025-03-19 05:24:57', '2025-04-02 15:54:20'),
(6, 2, 'Jurusan Perkantoran SMK Belajar Apa Saja? Dilengkapi Prospek Kerjanya', 'artikel_images/Xbfv9R0D07gMqianOMziNwEA07UusKyyOTNscx9E.jpg', 'Jurusan Perkantoran di SMK membekali siswa dengan keterampilan kerja nyata melalui program seperti PPL. Tidak semua SMK memilikinya, karena disesuaikan dengan kebutuhan industri daerah. Artikel ini membahas materi yang dipelajari dan prospek kerja jurusan ini.', 'https://mamikos.com/info/jurusan-perkantoran-smk-pljr/#goog_rewarded', '2025-03-19 05:28:59', '2025-04-10 02:59:35'),
(7, 2, 'Mau Tahu Jurusan Perkantoran SMK? Ini Pelajaran yang Didapat dan Prospek Kerjanya', 'artikel_images/jYljkILPNUEOJiKhISoCzMewhUD46xGQ3xEoXpBL.jpg', 'Jurusan Administrasi Perkantoran adalah salah satu kompetensi keahlian yang sedang naik daun di sekolah menengah kejuruan. Prospek kariernya pun cukup menjanjikan karena ada banyak pilihannya, mulai dari sekretaris hingga staf administrasi.', 'https://www.gamelab.id/news/3831-mau-tahu-jurusan-perkantoran-smk-ini-pelajaran-yang-didapat-dan-prospek-kerjanya', '2025-03-19 05:30:46', '2025-04-02 15:59:49'),
(8, 3, 'Jurusan TKR (Teknik Kendaraan Ringan): Materi dan Prospeknya', 'artikel_images/U0hoJlrf1LOeGFjB6kMVEkpBQzuLL0NoGSbm8oru.png', 'Jurusan TKR adalah singkatan dari Teknik Kendaraan Ringan. Kamu bisa menemukan jurusan ini di tingkat pendidikan SMK.\r\nSetelahnya, kamu bisa langsung mencari kerja atau mendalami ilmu ke jenjang perguruan tinggi di jurusan relevan, seperti teknik otomotif, teknik elektro, atau teknik mesin.', 'https://glints.com/id/lowongan/jurusan-tkr-adalah/', '2025-03-19 05:37:42', '2025-04-02 16:05:31'),
(9, 3, 'SMK Jurusan Teknik dan Bisnis Sepeda Motor : Pengertian, Apa yang Dipelajari, dan Prospek Kerja', 'artikel_images/Us1jSHdUmTGxJP3mbB6elwONxbLmnRGPUfHWJicH.jpg', 'SMK Jurusan Teknik dan Bisnis Sepeda Motor membekali siswa dengan keterampilan perawatan, perbaikan, serta aspek bisnis sepeda motor. Mereka belajar mekanika, kelistrikan, sistem bahan bakar, suspensi, hingga manajemen bengkel dan pemasaran. Jurusan ini berfokus khusus pada sepeda motor, berbeda dari jurusan otomotif lain yang lebih umum.', 'https://www.loker.id/artikel/smk-jurusan-teknik-dan-bisnis-sepeda-motor-pengertian-apa-yang-dipelajari-dan-prospek-kerja', '2025-03-19 05:48:35', '2025-04-02 16:07:50');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_tes`
--

CREATE TABLE `hasil_tes` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `hasil` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hasil_tes`
--

INSERT INTO `hasil_tes` (`id`, `created_at`, `updated_at`, `user_id`, `hasil`) VALUES
(1, '2025-04-10 03:18:32', '2025-04-10 03:18:32', 13, 'Teknik Komputer Jaringan'),
(2, '2025-04-10 03:23:03', '2025-04-10 03:23:03', 13, 'Teknik Sepeda Motor'),
(3, '2025-04-10 04:02:20', '2025-04-10 04:02:20', 1, 'Teknik Komputer Jaringan'),
(4, '2025-04-11 05:05:22', '2025-04-11 05:05:22', 1, 'Teknik Komputer Jaringan'),
(14, '2025-04-15 03:55:26', '2025-04-15 03:55:26', 29, 'Teknik Komputer Jaringan'),
(15, '2025-04-15 03:55:26', '2025-04-15 03:55:26', 29, 'Teknik Komputer Jaringan'),
(16, '2025-04-15 03:56:49', '2025-04-15 03:56:49', 29, 'Teknik Komputer Jaringan');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `img` text COLLATE utf8mb4_unicode_ci,
  `jurusan_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `created_at`, `updated_at`, `img`, `jurusan_code`, `jurusan`, `jenis`, `deskripsi`) VALUES
(1, '2025-03-16 21:01:42', '2025-04-15 05:26:46', 'jurusan_images/ju0WVoxrxNejsTg6NaaOifrBQelpH9xoimmn7OWT.jpg', 'J1', 'Teknik Komputer Jaringan', 'IT', 'Jurusan yang berfokus pada jaringan komputer, pemrograman dasar, dan perbaikan perangkat keras.'),
(2, '2025-03-16 21:31:18', '2025-04-10 03:01:00', 'jurusan_images/EgELkGXqF1qyWXXpeIrTaf186HdxeFJr6JmeJ8RX.jpg', 'J2', 'Teknik Sepeda Motor', 'Engineering', 'Jurusan yang mempelajari perawatan, perbaikan, dan teknologi sistem kelistrikan serta mesin sepeda motor.'),
(3, '2025-03-16 21:31:51', '2025-04-10 03:01:13', 'jurusan_images/8SNZDJuQ9oFiH7mDfIz2W83ZiFnJj2nEYoZMjmzb.jpg', 'J3', 'Teknik Kendaraan Ringan', 'Engineering', 'Jurusan yang berfokus pada sistem mesin mobil, transmisi, suspensi, dan teknologi kendaraan ringan.'),
(4, '2025-03-18 21:48:27', '2025-04-10 03:01:30', 'jurusan_images/tdqHIrCL3pjKr4HSUz92I8EUJSn478QIRcSejXQG.jpg', 'J4', 'Admin Perkantoran', 'business', 'Jurusan yang berfokus pada administrasi perkantoran, manajemen dokumen, pelayanan publik, dan keterampilan komunikasi dalam lingkungan bisnis.');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_artikel`
--

CREATE TABLE `kategori_artikel` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama_kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_artikel`
--

INSERT INTO `kategori_artikel` (`id`, `created_at`, `updated_at`, `nama_kategori`) VALUES
(1, NULL, NULL, 'Teknik Komputer Jaringan'),
(2, NULL, NULL, 'Admin Perkantoran'),
(3, NULL, NULL, 'Teknik Sepeda Motor'),
(4, NULL, NULL, 'Teknik kendaraan Ringan');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_03_03_184926_create_users_table', 1),
(2, '2025_03_03_190406_create_pertanyaan_table', 1),
(3, '2025_03_03_191428_create_jurusan_table', 1),
(4, '2025_03_03_192736_create_rule_table', 1),
(5, '2025_03_03_193455_create_saran_pekerjaan_table', 1),
(6, '2025_03_03_193807_create_hasil_tes_table', 1),
(7, '2025_03_03_195151_create_kategori_artikel_table', 1),
(8, '2025_03_03_195152_create_artikel_table', 1),
(9, '2025_03_04_134253_create_sessions_table', 1),
(10, '2025_03_05_062326_create_personal_access_tokens_table', 1),
(11, '2025_03_20_120103_create_testimonis_table', 1),
(12, '2025_05_09_211443_create_sekolahs_table', 1),
(13, '2025_03_18_100357_add_foto_to_users_table', 2),
(14, '2025_03_29_124457_add_google_id_to_users_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 5, 'auth_token', '712aaaf6444ee83df02411b1f5f90284b82fa665266ddb7d2f52be62ffcc8611', '[\"*\"]', NULL, NULL, '2025-03-17 03:03:25', '2025-03-17 03:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pertanyaan_code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pertanyaan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`id`, `created_at`, `updated_at`, `pertanyaan_code`, `pertanyaan`) VALUES
(1, '2025-03-17 02:59:31', '2025-03-17 02:59:31', 'F1', 'Apakah kamu tertarik dengan pemrograman dan jaringan komputer?'),
(2, '2025-03-17 03:00:02', '2025-03-17 03:00:02', 'F2', 'Apakah kamu suka memecahkan masalah teknis pada perangkat keras dan lunak?'),
(3, '2025-03-17 03:00:21', '2025-03-17 03:00:21', 'F3', 'Apakah kamu tertarik memahami cara kerja sistem operasi dan server?'),
(4, '2025-03-17 03:01:28', '2025-03-17 03:01:28', 'F4', 'Apakah kamu senang melakukan troubleshooting pada jaringan?'),
(5, '2025-03-17 03:01:54', '2025-03-17 03:01:54', 'F5', 'Apakah kamu tertarik dengan keamanan siber dan proteksi data?'),
(6, '2025-03-17 03:02:28', '2025-03-17 03:02:28', 'F6', 'Apakah kamu suka bekerja dengan perangkat keras komputer?'),
(7, '2025-03-17 03:02:59', '2025-03-17 03:02:59', 'F7', 'Apakah kamu tertarik dengan teknologi cloud computing?'),
(8, '2025-03-17 03:03:25', '2025-03-17 03:03:25', 'F8', 'Apakah kamu suka membongkar dan merakit mesin sepeda motor?'),
(9, '2025-03-17 03:03:43', '2025-03-17 03:03:43', 'F9', 'Apakah kamu tertarik memahami sistem kelistrikan pada sepeda motor?'),
(11, '2025-03-17 03:04:24', '2025-03-17 03:04:24', 'F11', 'Apakah kamu tertarik mempelajari teknologi injeksi bahan bakar?'),
(12, '2025-03-17 03:04:41', '2025-03-17 03:04:41', 'F12', 'Apakah kamu ingin mengembangkan keterampilan diagnosa kerusakan mesin?'),
(13, '2025-03-17 03:06:12', '2025-03-17 03:06:12', 'F10', 'Apakah kamu senang melakukan perawatan dan perbaikan kendaraan roda dua?'),
(14, '2025-03-17 03:07:04', '2025-03-17 03:07:04', 'F13', 'Apakah kamu tertarik memahami sistem suspensi dan pengereman sepeda motor?'),
(15, '2025-03-17 03:07:27', '2025-03-17 03:07:27', 'F14', 'Apakah kamu suka mengikuti perkembangan teknologi motor listrik?'),
(16, '2025-03-17 03:08:11', '2025-03-17 03:08:11', 'F15', 'Apakah kamu tertarik memahami sistem mesin mobil dan kendaraan ringan lainnya?'),
(17, '2025-03-17 03:08:29', '2025-03-17 03:08:29', 'F16', 'Apakah kamu suka memperbaiki sistem transmisi dan suspensi kendaraan?'),
(18, '2025-03-17 03:08:51', '2025-03-17 03:08:51', 'F17', 'Apakah kamu senang bekerja dengan teknologi sistem rem dan kemudi?'),
(19, '2025-03-17 03:09:19', '2025-03-17 03:09:19', 'F18', 'Apakah kamu tertarik dengan teknologi kendaraan listrik dan hybrid?'),
(20, '2025-03-17 03:09:40', '2025-03-17 03:09:40', 'F19', 'Apakah kamu ingin memahami sistem pendinginan dan pelumasan mesin?'),
(21, '2025-03-17 03:10:06', '2025-03-17 03:10:06', 'F20', 'Apakah kamu suka melakukan diagnosis kerusakan elektronik pada kendaraan?'),
(22, '2025-03-17 03:10:32', '2025-03-17 03:10:32', 'F21', 'Apakah kamu tertarik mempelajari sistem manajemen mesin modern?'),
(23, '2025-03-17 04:44:46', '2025-03-17 04:44:46', 'F22', 'Apakah kamu tertarik dengan sistem kelistrikan yang juga diterapkan pada kendaraan?\"'),
(24, '2025-03-17 04:45:29', '2025-03-17 04:45:29', 'F23', 'Apakah kamu tertarik dengan teknologi kendaraan listrik yang juga diterapkan pada kendaraan ringan?'),
(25, '2025-03-17 04:46:05', '2025-03-17 04:46:05', 'F24', 'Apakah kamu tertarik dengan sensor yang digunakan pada kendaraan dan sistem IoT?'),
(27, '2025-03-19 04:53:34', '2025-03-19 04:53:34', 'F25', 'Apakah kamu tertarik dengan pekerjaan administratif seperti pengarsipan dan surat-menyurat?'),
(28, '2025-03-19 04:53:55', '2025-03-19 04:53:55', 'F26', 'Apakah kamu suka mengatur jadwal dan mengelola dokumen?'),
(29, '2025-03-19 04:54:23', '2025-03-19 04:54:23', 'F27', 'Apakah kamu tertarik dengan dunia kesekretariatan dan layanan pelanggan?'),
(30, '2025-03-19 04:55:02', '2025-03-19 04:55:02', 'F28', 'Apakah kamu tertarik dengan dunia kesekretariatan dan layanan pelanggan?'),
(31, '2025-03-19 04:56:29', '2025-03-19 04:56:29', 'F29', 'Apakah kamu tertarik memahami cara komunikasi bisnis yang efektif?'),
(32, '2025-03-19 04:56:52', '2025-03-19 04:56:52', 'F30', 'Apakah kamu suka bekerja dengan data dan membuat laporan keuangan sederhana?'),
(33, '2025-03-19 04:57:14', '2025-03-19 04:57:14', 'F31', 'Apakah kamu ingin memahami manajemen sumber daya manusia dalam sebuah perusahaan?'),
(34, '2025-03-19 04:57:31', '2025-03-19 04:57:31', 'F32', 'Apakah kamu tertarik dengan etika dan tata cara dalam dunia bisnis?'),
(35, '2025-03-19 04:57:53', '2025-03-19 04:57:53', 'F33', 'Apakah kamu suka menyusun agenda rapat dan membuat notulen?'),
(36, '2025-03-19 04:58:25', '2025-03-19 04:58:25', 'F34', 'Apakah kamu ingin memahami proses pengelolaan dokumen digital dan arsip?'),
(37, '2025-03-19 04:59:01', '2025-03-19 04:59:01', 'F35', 'Apakah kamu tertarik dengan teknologi yang digunakan dalam manajemen kantor modern?');

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaans`
--

CREATE TABLE `pertanyaans` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pertanyaan_code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pertanyaan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pertanyaans`
--

INSERT INTO `pertanyaans` (`id`, `created_at`, `updated_at`, `pertanyaan_code`, `pertanyaan`) VALUES
(1, '2025-03-16 19:59:31', '2025-03-16 19:59:31', 'F1', 'Apakah kamu tertarik dengan pemrograman dan jaringan komputer?'),
(2, '2025-03-16 20:00:02', '2025-03-16 20:00:02', 'F2', 'Apakah kamu suka memecahkan masalah teknis pada perangkat keras dan lunak?'),
(3, '2025-03-16 20:00:21', '2025-03-16 20:00:21', 'F3', 'Apakah kamu tertarik memahami cara kerja sistem operasi dan server?'),
(4, '2025-03-16 20:01:28', '2025-03-16 20:01:28', 'F4', 'Apakah kamu senang melakukan troubleshooting pada jaringan?'),
(5, '2025-03-16 20:01:54', '2025-03-16 20:01:54', 'F5', 'Apakah kamu tertarik dengan keamanan siber dan proteksi data?'),
(58, '2025-04-14 22:42:34', '2025-04-14 22:42:34', 'p01', 'ser'),
(59, '2025-04-14 22:42:44', '2025-04-14 22:42:44', 'mm,', 'serlinl');

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jurusan_id` bigint UNSIGNED NOT NULL,
  `pertanyaan_id` bigint UNSIGNED NOT NULL,
  `rule_value` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`id`, `created_at`, `updated_at`, `jurusan_id`, `pertanyaan_id`, `rule_value`) VALUES
(24, '2025-04-07 06:19:34', '2025-04-07 06:19:34', 1, 1, 1),
(25, '2025-04-07 06:19:34', '2025-04-07 06:19:34', 1, 2, 1),
(26, '2025-04-07 06:19:34', '2025-04-07 06:19:34', 1, 3, 1),
(27, '2025-04-07 06:19:34', '2025-04-07 06:19:34', 1, 4, 1),
(28, '2025-04-07 06:19:34', '2025-04-07 06:19:34', 1, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `saran_pekerjaan`
--

CREATE TABLE `saran_pekerjaan` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jurusan_id` bigint UNSIGNED NOT NULL,
  `saran_pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saran_pekerjaan`
--

INSERT INTO `saran_pekerjaan` (`id`, `created_at`, `updated_at`, `jurusan_id`, `saran_pekerjaan`, `gambar`) VALUES
(1, '2025-04-10 03:17:02', '2025-04-15 05:25:03', 1, 'Software Engineer', 'saran-pekerjaan/jKQ8fY2XvMPhati5zzmyj8RA8puMaxTIfOUzWXLP.jpg'),
(2, '2025-04-10 03:21:54', '2025-04-10 03:22:07', 3, 'Automotive Component Engineer', 'saran-pekerjaan/UUxRmdVAyqw5xk7dhGpxvUgWrRRJ8CB8i7iHQLoO.jpg'),
(3, '2025-04-10 03:22:49', '2025-04-10 03:23:00', 3, 'Automotive Technopreneur', 'saran-pekerjaan/ZKKMoOJr6l06WXJJP6oOPcTApwJmJA6yGjCFdJoT.jpg'),
(4, '2025-04-10 03:23:23', '2025-04-10 03:24:21', 4, 'Customer Service', 'saran-pekerjaan/CiUlC0ICaHKez5T9HWoZlE7EDBWgqnd4fPclalp3.jpg'),
(5, '2025-04-10 03:24:50', '2025-04-15 05:25:19', 1, 'Cyber Security Specialist', 'saran-pekerjaan/uS0JQrCFZ8LHgvJMi0BLRRdt1BAv10XK6EBATAZt.jpg'),
(6, '2025-04-10 03:26:04', '2025-04-15 05:25:31', 1, 'Data Entry', 'saran-pekerjaan/MRMDG5sKgtqe0zAiQJ4jw4i4hTatoc2XhOMytjn5.jpg'),
(7, '2025-04-10 03:28:00', '2025-04-15 05:25:43', 1, 'Data Scientist', 'saran-pekerjaan/F9Qix9jNY3yNyfBJx3XbRwvd7kmXdzufUPh4fVv3.jpg'),
(8, '2025-04-10 03:29:08', '2025-04-10 03:29:31', 2, 'Desainer Otomotif', 'saran-pekerjaan/CG9XFAYNnL918ePNPImJiLorQSHTe2SpfUThxMyX.jpg'),
(9, '2025-04-10 03:30:15', '2025-04-15 05:26:01', 1, 'IT Support', 'saran-pekerjaan/lGOZbdRu51y93SAxPz2AqFcSyhrRHDkEls8RCyXn.jpg'),
(10, '2025-04-10 03:32:08', '2025-04-10 03:32:22', 3, 'Marketing Otomotif', 'saran-pekerjaan/PSqZWIw07u5KPNDNVaavS4x7UwNWiPJeCk3yHXFl.jpg'),
(11, '2025-04-10 03:32:44', '2025-04-10 03:32:57', 3, 'Mekanik', 'saran-pekerjaan/56UgGVKuRICRmHV97eQ0PARsCc4tS07WsA9YC0bx.jpg'),
(12, '2025-04-10 03:33:22', '2025-04-10 03:33:22', 3, 'Modifikator', 'saran-pekerjaan/63vsUMOgBkQ2WJ7SVqhKWsaBMp7Hv8toSYgBKlBj.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sekolahs`
--

CREATE TABLE `sekolahs` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sekolahs`
--

INSERT INTO `sekolahs` (`id`, `nama`, `jurusan_id`, `created_at`, `updated_at`) VALUES
(1, 'SMK TELKOM PURWOKERTO', 1, '2025-04-01 10:44:34', '2025-04-07 09:02:06');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('48QAOLUk5bEXK1v5nNDMXny9rjHLnaLrykSqNhOk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMXY5OFRyUDBYSjA4cE5ndENEaXhJOTVMN3RIaWU5V3hKU091RjZOQyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90YW55YUp1cnBhbi9wYWdlIjt9fQ==', 1744695140);

-- --------------------------------------------------------

--
-- Table structure for table `testimonis`
--

CREATE TABLE `testimonis` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `hasil` bigint UNSIGNED NOT NULL,
  `testimoni` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `testimonis`
--

INSERT INTO `testimonis` (`id`, `user_id`, `hasil`, `testimoni`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Website nya bagus', '2025-04-15 04:19:09', '2025-04-15 04:19:09'),
(2, 1, 4, 'mudah digunakan', '2025-04-15 04:36:27', '2025-04-15 04:36:27'),
(3, 1, 3, 'kerenn', '2025-04-15 04:36:48', '2025-04-15 04:36:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sekolah` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomer_hp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_code_expires_at` timestamp NULL DEFAULT NULL,
  `reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_code_expires_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `sekolah`, `email`, `nomer_hp`, `foto`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`, `google_id`, `reset_code`, `reset_code_expires_at`, `reset_token`, `verification_code`, `verification_code_expires_at`, `email_verified_at`) VALUES
(1, 'Admin NextEdu', NULL, 'admin@gmail.com', '081234567890', 'profile_pictures/OeJxbKyJhgW4XOnwsGJmqbHJbbLMIN1jnla6waAC.png', '$2y$12$LVZ/CL7Yd54lEbIODnKOieR13/s0MKn0b.KNLfyw63fH4mFLMhiri', 1, NULL, '2025-03-16 10:35:26', '2025-04-14 14:20:20', NULL, NULL, NULL, NULL, '5536', '2025-04-11 02:59:59', '2025-04-11 03:28:54'),
(3, 'Zizi', 'smk telkom', 'zizirecink@gmail.com', '08818516729', NULL, '$2y$12$ofTxH4f4VBTMuZpK0Bvone1xkmxmXp35Bl6Ll5aBhcVBHj9qhsb5C', 0, NULL, '2025-03-17 06:40:09', '2025-03-17 06:40:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'serlin', 'smk telkom', 'serlinimhudt@gmail.com', '088185163922', NULL, '$2y$12$/d0zib9um.QYizcCkaisneH7LmS4Al9WhcFqPEcp66DU0Njct8Loe', 0, NULL, '2025-03-29 04:32:35', '2025-03-29 04:32:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Shanaz Laksmi', 'SMK Telkom Purwokerto', 'shanazlaksmi21@gmail.com', 'Belum diisi', NULL, '$2y$12$v2ynLsnrL5QnuayhXGXJBuIBaqx.p.oiQd/SH.L18opuj4e8m9/Om', 0, NULL, '2025-04-04 08:01:56', '2025-04-09 03:31:25', '111772965074475180807', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Arya Fathdillah', 'Belum diisi', 'coderea9@gmail.com', 'Belum diisi', NULL, '$2y$12$ID66VRW1NwU59/.rYyQqpOUQJpGyLLlAJB/5XbnnX1BOvI6K2O0q6', 0, NULL, '2025-04-04 10:32:48', '2025-04-04 10:32:48', '117174258518793744231', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Arya Fathdillah Adi Saputra', 'SMK TELKOM PURWOKERTO', 'aryafathdillah923@gmail.com', '081469735184', NULL, '$2y$12$wBRlrZiaQbbpKByQoMPd5eo9IwZRFU.AR5YZfSZGzMaLQmdXF/vUe', 0, NULL, '2025-04-04 10:35:16', '2025-04-04 10:35:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'zafira nayla putri', 'Belum diisi', 'zafiranaylap@gmail.com', 'Belum diisi', 'profile_pictures/gDMaxxOCLPLIW3ZXTmtbxKk37kTXvcA4Lwpv4TDm.jpg', '$2y$12$XSLO3l2qriYOuERNofbPfeyhbh7JCDzmMUufOu8nT38K6dgdYqOTm', 0, NULL, '2025-04-06 06:11:35', '2025-04-08 13:55:41', '113574834649339425681', '3633', '2025-04-08 13:58:41', NULL, NULL, NULL, NULL),
(9, 'Shanaz Laksmi', 'SMK Telkom Purwokerto', 'zannashyy@gmail.com', '082135204052', NULL, '$2y$12$ocVkex1YtQ6o2bBEMhfwp.GuOa29osvLmaPu.VZi3QPm0sPcHU63y', 0, NULL, '2025-04-07 13:50:36', '2025-04-07 13:50:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'zafie nayy', 'Belum diisi', 'zafienayy@gmail.com', 'Belum diisi', NULL, '$2y$12$nlLg/UGPc8HRcWj8GOC2zO9PV2Ou6jB/yM2qWwfZ/YS3oMrf30aRW', 0, NULL, '2025-04-08 13:57:12', '2025-04-08 13:58:56', '103284228808349827526', '1185', '2025-04-08 14:01:09', 'lL3mGfIDETaV6LW8eitdHa5xi1wD7hkFMl8fe06P9ElGT7gMEHra7S41Y9GQ', NULL, NULL, NULL),
(11, 'Firda Ayu Nirmala', 'SMP Telkom', 'firaynir@gmail.com', '082220383877', NULL, '$2y$12$pb.LScRxtshJbuFOSMGXZ.YxoqFRl829nCqfD7VtaTMMsddIxQ8Za', 0, NULL, '2025-04-09 01:54:43', '2025-04-09 01:55:28', '111602173480100650006', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Shanaz Laksmi Pinasthika', 'SMK Telkom Purwokerto', 'shanazchan95@gmail.com', '082135204052', 'profile_pictures/WFLHjstyRzmpyhu4WjBD4YJSSiorq74f2woZL1lj.jpg', '$2y$12$ivzEYY7LovM19CzECeZXf.d7/zqCB1A43yEGe9fq5DS.XZUoXT3Ty', 0, NULL, '2025-04-09 02:43:41', '2025-04-09 10:51:40', '101887230494612082255', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'zizi', 'smp teluk', 'zizi@gmail.com', '089632243234', NULL, '$2y$12$rc0WLwsIQF3bxT3OWi5OYu6F5PqbV1CbpPjgDx/nbgxCoX/FfeZnq', 0, NULL, '2025-04-10 01:53:34', '2025-04-10 01:53:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'Admin NextEdu', 'smk telkom', 'admin@gmail.comd', '0881851639206', NULL, '$2y$12$w1jG7k91OlmO8HPJePx8J.m.8H4/ZHipCpIspcz7oWZyd0rD.4VNi', 0, NULL, '2025-04-11 13:41:43', '2025-04-11 13:41:43', NULL, NULL, NULL, NULL, '3865', '2025-04-11 13:44:43', NULL),
(27, 'mochi', 'w', 'rucci@gmail.coms', '08811817374', NULL, '$2y$12$8Qy27oYWBXjkv7os9jH3K.gdk0ZGqne7.YFgfbYsWCxEn1Ux4dPyK', 0, NULL, '2025-04-11 13:56:17', '2025-04-11 14:12:43', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-11 14:12:43'),
(29, 'Serlin Aprilia', 'smk telkom', 'mochimaachi16@gmail.com', '088185126392', NULL, '$2y$12$QdeHtBOzzqTfHUyfTMwbo.3ZbexUc6laDlQTm3WF0FYYZuqCk6OJi', 0, NULL, '2025-04-12 11:43:14', '2025-04-12 11:43:14', NULL, NULL, NULL, NULL, '0748', '2025-04-12 11:46:14', '2025-04-11 03:28:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artikel_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `hasil_tes`
--
ALTER TABLE `hasil_tes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_tes_user_id_foreign` (`user_id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jurusan_code` (`jurusan_code`);

--
-- Indexes for table `kategori_artikel`
--
ALTER TABLE `kategori_artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pertanyaans`
--
ALTER TABLE `pertanyaans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rule_jurusan_id_foreign` (`jurusan_id`),
  ADD KEY `rule_pertanyaan_id_foreign` (`pertanyaan_id`);

--
-- Indexes for table `saran_pekerjaan`
--
ALTER TABLE `saran_pekerjaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saran_pekerjaan_jurusan_id_foreign` (`jurusan_id`);

--
-- Indexes for table `sekolahs`
--
ALTER TABLE `sekolahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `testimonis`
--
ALTER TABLE `testimonis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testimonis_user_id_foreign` (`user_id`),
  ADD KEY `testimonis_hasil_foreign` (`hasil`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hasil_tes`
--
ALTER TABLE `hasil_tes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori_artikel`
--
ALTER TABLE `kategori_artikel`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `pertanyaans`
--
ALTER TABLE `pertanyaans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `saran_pekerjaan`
--
ALTER TABLE `saran_pekerjaan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sekolahs`
--
ALTER TABLE `sekolahs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonis`
--
ALTER TABLE `testimonis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_tes`
--
ALTER TABLE `hasil_tes`
  ADD CONSTRAINT `hasil_tes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rules`
--
ALTER TABLE `rules`
  ADD CONSTRAINT `rule_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rule_pertanyaan_id_foreign` FOREIGN KEY (`pertanyaan_id`) REFERENCES `pertanyaans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `saran_pekerjaan`
--
ALTER TABLE `saran_pekerjaan`
  ADD CONSTRAINT `saran_pekerjaan_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `testimonis`
--
ALTER TABLE `testimonis`
  ADD CONSTRAINT `testimonis_hasil_foreign` FOREIGN KEY (`hasil`) REFERENCES `hasil_tes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `testimonis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
