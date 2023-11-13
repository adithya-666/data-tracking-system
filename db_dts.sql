-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 13 Nov 2023 pada 01.43
-- Versi server: 8.0.30
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dts`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `doc_patients`
--

CREATE TABLE `doc_patients` (
  `id` bigint UNSIGNED NOT NULL,
  `patient_id` bigint UNSIGNED NOT NULL,
  `doc_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_sub` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_user_sub` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_time_sub` datetime DEFAULT NULL,
  `doc_ver` bigint UNSIGNED DEFAULT '0',
  `doc_user_ver` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_time_ver` datetime DEFAULT NULL,
  `doc_val` bigint UNSIGNED DEFAULT '0',
  `doc_user_val` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_time_val` datetime DEFAULT NULL,
  `doc_note_sub` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `doc_note_ver` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `doc_note_val` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `doc_user_revisi` bigint UNSIGNED DEFAULT NULL,
  `doc_time_revisi` datetime DEFAULT NULL,
  `doc_revisi` bigint UNSIGNED DEFAULT NULL,
  `doc_note_revisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `doc_patients`
--

INSERT INTO `doc_patients` (`id`, `patient_id`, `doc_name`, `doc_status`, `doc_sub`, `doc_user_sub`, `doc_time_sub`, `doc_ver`, `doc_user_ver`, `doc_time_ver`, `doc_val`, `doc_user_val`, `doc_time_val`, `doc_note_sub`, `doc_note_ver`, `doc_note_val`, `doc_user_revisi`, `doc_time_revisi`, `doc_revisi`, `doc_note_revisi`, `file`, `file_name`, `created_at`, `updated_at`) VALUES
(70, 218, 'BPJS', 'Selesai', '0', '7', '2023-11-06 22:00:38', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 'post-files/WXsSIykpvY8lrbG9SlVnZpq7reZjmia6Vv6WlSZD.pdf', 'Voucher.pdf', '2023-11-06 15:00:38', '2023-11-08 07:04:57'),
(73, 208, 'Radiologi', 'Upload', NULL, '7', '2023-11-06 22:16:42', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'post-files/qkHtvM96KjH7RQElWo89wK63pTefPoqCf5zfq8eh.pdf', 'Voucher.pdf', '2023-11-06 15:16:42', '2023-11-06 15:16:42'),
(82, 207, 'BPJS', 'Upload', NULL, '7', '2023-11-07 11:07:27', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'post-files/nH7XFPQrrWc31Tm894bbuyMbFKrumgKqdS4PEHmC.pdf', 'Voucher.pdf', '2023-11-07 04:07:27', '2023-11-07 04:07:27'),
(84, 214, 'Radiologi', 'Arsip', NULL, '7', '2023-11-07 11:28:13', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'post-files/wWfdP6SGp1NzDQbvENUFNZdxerX9O64IP2G2XRYv.pdf', 'Voucher.pdf', '2023-11-07 04:28:13', '2023-11-07 04:45:48'),
(85, 215, 'BPJS', 'Selesai', NULL, '7', '2023-11-07 11:58:08', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'post-files/Lghapy7a4j4HZB5WKslzyfSI10MDgI8wAbiFgTm2.pdf', 'Voucher.pdf', '2023-11-07 04:58:08', '2023-11-07 04:59:26'),
(86, 213, 'Radiologi', 'Upload', NULL, '7', '2023-11-09 08:55:56', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'post-files/NmqnjDdop3ZP35QO7qbQwA1Sjb0DqvI9fyzsBWRz.pdf', 'Voucher.pdf', '2023-11-09 01:55:57', '2023-11-09 01:55:57'),
(87, 213, 'LAB', 'Upload', NULL, '7', '2023-11-09 08:59:36', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'post-files/1zvAM5kwx2U0lVK3NjroRSev9CZQlb2WYaxGMoXn.pdf', 'Voucher.pdf', '2023-11-09 01:59:36', '2023-11-09 01:59:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(38, '2014_10_12_000000_create_users_table', 1),
(39, '2023_9_27_164448_create_rooms_table', 2),
(40, '2023_10_10_060108_create_patients_table', 3),
(42, '2023_10_10_071535_create_doc_patients_table', 4),
(43, '2023_10_27_162845_add_no_pen__to_patients_table', 5),
(44, '2023_10_18_110503_add_coloumn_to_patients', 6),
(45, '2023_8_25_092807_add_doc_status__to_doc_patients', 7),
(46, '2023_10_30_140919_add_doc_status_patient_to_users_table', 8),
(49, '2023_11_02_093101_add_coloumn_doc_revisi_table', 9),
(50, '2023_11_02_093555_add_coloumn_status_revisi_table', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `patients`
--

CREATE TABLE `patients` (
  `id` bigint UNSIGNED NOT NULL,
  `no_sep` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_pen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `medrec` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patient_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_id` bigint UNSIGNED DEFAULT NULL,
  `room` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_order` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_ruangan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_in` datetime DEFAULT NULL,
  `date_out` datetime DEFAULT NULL,
  `doctor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_submission` int DEFAULT NULL,
  `doc_status_patient` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_ver` bigint UNSIGNED DEFAULT '0',
  `status_val` bigint UNSIGNED DEFAULT '0',
  `status_revisi` bigint UNSIGNED DEFAULT '0',
  `status_grouping` bigint UNSIGNED DEFAULT '0',
  `time_submission` datetime DEFAULT NULL,
  `time_ver` datetime DEFAULT NULL,
  `time_val` datetime DEFAULT NULL,
  `time_revisi` datetime DEFAULT NULL,
  `time_grouping` datetime DEFAULT NULL,
  `insurance` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_sub` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `note_ver` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `note_val` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `note_grouping` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `note_revisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_admin` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_jkn` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `patients`
--

INSERT INTO `patients` (`id`, `no_sep`, `no_pen`, `birthdate`, `gender`, `medrec`, `patient_name`, `room_id`, `room`, `no_order`, `kode_ruangan`, `date_in`, `date_out`, `doctor`, `status_submission`, `doc_status_patient`, `status_ver`, `status_val`, `status_revisi`, `status_grouping`, `time_submission`, `time_ver`, `time_val`, `time_revisi`, `time_grouping`, `insurance`, `note_sub`, `note_ver`, `note_val`, `note_grouping`, `note_revisi`, `note_admin`, `note_jkn`, `file`, `file_name`, `created_at`, `updated_at`) VALUES
(201, '1021R0010623V009311', '2306240206', '1987-04-24', 'Perempuan', '22377', 'WARKHAYATI', NULL, 'Klinik Dalam', '1011101012306240020', '101110101', '2023-06-24 19:34:41', '2023-10-12 08:59:01', 'dr. Siswono, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:43:44'),
(202, '1021R0010623V009347', '2306240260', '1995-03-22', 'Perempuan', '200590', 'HARTIKA', NULL, 'Klinik Dalam', '1011101012306240019', '101110101', '2023-06-24 18:19:32', NULL, 'dr. Siswono, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:43:44'),
(203, '1021R0010623V009308', '2306240201', '2005-07-18', 'Laki-laki', '15930', 'JAKA SAMUDRA  AN', NULL, 'Klinik Dalam', '1011101012306240018', '101110101', '2023-06-24 12:27:21', NULL, 'dr. Rachmat Prayitno, SpB, MARS, FICS, FINACS', 0, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(204, '1021R0010623V009306', '2306240196', '2008-08-23', 'Laki-laki', '2207226', 'AGUS RAMADHAN', NULL, 'Klinik Dalam', '1011101012306240017', '101110101', '2023-06-24 12:18:03', NULL, 'dr. Rachmat Prayitno, SpB, MARS, FICS, FINACS', 0, '', 0, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(205, '1021R0010623V009291', '2306240177', '1983-12-07', 'Laki-laki', '40493', 'DENI NURLIANTO TN', NULL, 'Klinik Dalam', '1011101012306240016', '101110101', '2023-06-24 11:26:44', NULL, 'dr. Rachmat Prayitno, SpB, MARS, FICS, FINACS', 0, '', 0, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(206, '1021R0010623V009304', '2306240194', '2008-12-01', 'Laki-laki', '2207343', 'MUHAMMAD FATHAN ASRAAR RACHMAN', NULL, 'Kamar Operasi', '1011101012306240015', '101110101', '2023-06-24 11:23:19', NULL, 'dr. Rachmat Prayitno, SpB, MARS, FICS, FINACS', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(207, '-', '2306240154', '1976-11-22', 'Laki-laki', '205750', 'ASEP ABDUL MUKTI', NULL, 'Kidang Kencana 1', '1011101012306240012', '101030601', '2023-06-24 09:32:04', '2023-06-24 11:52:31', 'dr. Rizky Admagusta, Sp. OT', 0, 'Verifikasi', 1, 0, 1, 0, '2023-11-07 11:07:27', '2023-11-10 17:01:10', NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, 'Salahhh  Dokumenn LAB', NULL, NULL, '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(208, '1021R0010623V008151', '2306210517', '1960-11-09', 'Perempuan', '175299', 'CAMI', NULL, 'Kidang Kencana 1', '1011101012306240011', '101030601', '2023-06-24 07:59:48', NULL, 'dr. Mochamad Reza Mahdi, Sp. PD', 0, '', 0, 0, 1, 0, '2023-11-06 22:16:42', NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, 'Data Kurang lengkap', 'Data Lengkap', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(209, '1021R0010623V009084', '2306230494', '1964-07-10', 'Laki-laki', '64682', 'SARWIDI', NULL, 'Kidang Kencana 1', '1011101012306240010', '101030601', '2023-06-24 07:57:06', NULL, 'dr. Rizky Admagusta, Sp. OT', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(210, '1021R0010623V008661', '2306220593', '1969-04-15', 'Perempuan', '2207146', 'KHODIJAH', NULL, 'Kidang Kencana 1', '1011101012306240009', '101030601', '2023-06-24 07:55:32', NULL, 'dr. Siswono, Sp.OG', 0, '', 0, 0, 1, 0, '2023-11-07 11:17:57', NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, 'Salah Dokumen', NULL, '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(211, '1021R0010623V009092', '2306230519', '1980-01-03', 'Perempuan', '2207306', 'SULASTRI', NULL, 'Kidang Kencana 1', '1011101012306240008', '101030601', '2023-06-24 07:53:38', NULL, 'dr. Siswono, Sp.OG', 0, '', 0, 0, 0, 0, '2023-11-06 07:48:35', NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, 'Mantappp', 'okeeee', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(212, '1021R0010623V009101', '2306230530', '2003-09-10', 'Perempuan', '47800', 'DIAN FAUDILAH', NULL, 'Kidang Kencana 1', '1011101012306240007', '101030601', '2023-06-24 07:51:18', NULL, 'dr. La Royba Hawa, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(213, '1021R0010623V009059', '2306230450', '2003-06-04', 'Perempuan', '2207020', 'VIRLY NURANGGRAENI', NULL, 'Kidang Kencana 1', '1011101012306240006', '101030601', '2023-06-24 07:50:15', NULL, 'dr. Tarjono, Sp. B', 1, 'Upload', 0, 0, 1, 1, '2023-11-09 08:59:36', '2023-11-09 08:53:51', NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, 'Data salah', NULL, '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(214, '1021R0010623V009061', '2306230452', '1965-08-04', 'Laki-laki', '4441', 'SUPIRNO BIN NARIMAH', NULL, 'Kidang Kencana 1', '1011101012306240005', '101030601', '2023-06-24 07:46:54', NULL, 'dr. Tarjono, Sp. B', 1, '', 0, 0, 0, 1, '2023-11-07 11:28:13', '2023-11-07 11:30:47', NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(215, '1021R0010623V009079', '2306230481', '1986-05-26', 'Perempuan', '2207001', 'ROKANAH', NULL, 'Kidang Kencana 1', '1011101012306240004', '101030601', '2023-06-24 07:44:29', NULL, 'dr. Tarjono, Sp. B', 1, '', 0, 0, 0, 1, '2023-11-07 11:58:08', '2023-11-07 11:56:56', NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(216, '1021R0010623V009081', '2306230485', '1967-06-01', 'Perempuan', '34504', 'TIIN', NULL, 'Kidang Kencana 1', '1011101012306240003', '101030601', '2023-06-24 07:41:45', NULL, 'dr. Tarjono, Sp. B', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(217, '1021R0010623V009082', '2306230489', '1984-10-14', 'Laki-laki', '2206937', 'KHUMAEDI', NULL, 'Kidang Kencana 1', '1011101012306240002', '101030601', '2023-06-24 07:39:44', NULL, 'dr. Tarjono, Sp. B', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(218, '1021R0010623V009040', '2306230424', '1970-02-10', 'Perempuan', '104175', 'SUKATI NY', NULL, 'Kidang Kencana 1', '1011101012306240001', '101030601', '2023-06-24 07:03:28', NULL, 'dr. Rachmat Prayitno, SpB, MARS, FICS, FINACS', 0, '', 0, 0, 0, 1, '2023-11-06 22:00:38', '2023-11-08 14:03:50', NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, 'mantappp 222', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(219, '1021R0010623V008552', '2306220402', '1998-01-10', 'Perempuan', '2207145', 'ALFIAH KHAIRUNNISA', NULL, 'Kamar Operasi', '1011101012306230014', '101110101', '2023-06-23 20:19:05', NULL, 'dr. Siswono, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(220, '1021R0010623V008134', '2306200610', '1998-09-09', 'Perempuan', '201080', 'RISMANTI', NULL, 'Kamar Operasi', '1011101012306230013', '101110101', '2023-06-23 14:43:01', NULL, 'dr. Wahyudi Hartono, MKK,SP.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(221, '1021R0010623V008625', '2306220536', '2001-07-17', 'Perempuan', '2206232', 'SUNENTI', NULL, 'Kamar Operasi', '1011101012306230011', '101110101', '2023-06-23 07:16:18', NULL, 'dr. Eka Budhi Satyawardhana, Sp. BS', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(222, '1021R0010623V009121', '2306220616', '1984-07-01', 'Perempuan', '2207223', 'DEDE INUNG SOBICHA', NULL, 'Kamar Operasi', '1011101012306230009', '101110101', '2023-06-23 07:15:39', '2023-06-23 12:23:29', 'dr. Siswono, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(223, '1021R0010623V008218', '2306210631', '2022-10-30', 'Laki-laki', '184969', 'HABIBIE DHEFIN ELFATIH BAYI NY KASTINAH', NULL, 'Kamar Operasi', '1011101012306230008', '101110101', '2023-06-23 07:14:38', '2023-06-23 12:29:12', 'dr. Anandya Anton A H, Sp.A', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(224, '1021R0010623V008605', '2306220474', '1996-05-15', 'Perempuan', '2206909', 'CANETI', NULL, 'Kamar Operasi', '1011101012306230006', '101110101', '2023-06-23 07:13:33', '2023-06-23 12:28:07', 'dr. Tarjono, Sp. B', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(225, '1021R0010623V008673', '2306220619', '1966-05-15', 'Laki-laki', '102532', 'SANGID', NULL, 'Kamar Operasi', '1011101012306230005', '101110101', '2023-06-23 07:13:19', '2023-06-23 12:27:00', 'dr. Tarjono, Sp. B', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(226, '1021R0010623V008601', '2306220463', '1994-03-05', 'Perempuan', '2207133', 'YAYAH USRIYAH', NULL, 'Kamar Operasi', '1011101012306230002', '101110101', '2023-06-23 07:04:41', '2023-06-23 08:53:46', 'dr. Siswono, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(227, '1021R0010623V008601', '2306220463', '1994-03-05', 'Perempuan', '2207133', 'YAYAH USRIYAH', NULL, 'Kamar Operasi', '1011101012306230001', '101110101', '2023-06-23 06:04:21', '2023-06-23 06:17:35', 'dr. Siswono, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(228, '1021R0010623V008666', '2306220600', '1990-01-10', 'Perempuan', '2207217', 'IIS SUGIARTI', NULL, 'Kamar Operasi', '1011101012306220015', '101110101', '2023-06-22 22:02:00', '2023-06-23 05:33:16', 'dr. Siswono, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(229, '1021R0010623V005875', '2306150535', '1971-07-12', 'Perempuan', '196210', 'TAHINAH', NULL, 'Kamar Operasi', '1011101012306220014', '101110101', '2023-06-22 20:20:15', '2023-06-23 05:25:29', 'dr. Azlan Sain, Sp. JP', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(230, '-', '2306220278', '1989-01-11', 'Perempuan', '2207136', 'TRESIA MORIS', NULL, 'Klinik Dalam', '1011101012306220011', '101110101', '2023-06-22 09:40:31', '2023-06-23 08:52:32', 'dr. Siswono, Sp.OG', 0, '', 0, 1, 0, 1, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(231, '-', '2306220090', '1983-05-18', 'Perempuan', '2207119', 'DASINAH BT RASIDI', NULL, 'Kamar Operasi', '1011101012306220010', '101110101', '2023-06-22 09:20:20', '2023-06-22 20:25:05', 'dr. Siswono, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'RENCANA BPJS', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(232, '1021R0010623V008148', '2306210512', '2015-08-06', 'Perempuan', '2206573', 'SALWA ZAHRA MAWADAH', NULL, 'Kamar Operasi', '1011101012306220009', '101110101', '2023-06-22 09:08:25', '2023-06-23 11:39:27', 'drg. Lira Masri, Sp. BM', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(233, '1021R0010623V008147', '2306210511', '1981-03-02', 'Laki-laki', '2206564', 'RUSTONO', NULL, 'Kamar Operasi', '1011101012306220008', '101110101', '2023-06-22 08:39:07', '2023-06-23 11:35:56', 'drg. Lira Masri, Sp. BM', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(234, '1021R0010623V008129', '2306210470', '1955-08-06', 'Laki-laki', '31779', 'AGUS MULYADI BIN M JAMIDI', NULL, 'Kamar Operasi', '1011101012306220007', '101110101', '2023-06-22 08:37:58', '2023-06-22 11:56:54', 'dr. Tarjono, Sp. B', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(235, '1021R0010623V008115', '2306210450', '2009-01-02', 'Perempuan', '205536', 'PUTRI', NULL, 'Kamar Operasi', '1011101012306220006', '101110101', '2023-06-22 07:24:18', '2023-06-23 05:29:30', 'dr. Rizky Admagusta, Sp. OT', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(236, '1021R0010623V008121', '2306210459', '2000-01-10', 'Laki-laki', '206107', 'SRI MULYA', NULL, 'Kamar Operasi', '1011101012306220005', '101110101', '2023-06-22 07:23:57', '2023-06-23 08:46:21', 'dr. Rizky Admagusta, Sp. OT', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(237, '1021R0010623V008144', '2306210505', '2002-02-02', 'Perempuan', '2206470', 'WULAN FEBRIYANTI', NULL, 'Kamar Operasi', '1011101012306220004', '101110101', '2023-06-22 07:23:26', '2023-06-23 11:33:38', 'drg. Lira Masri, Sp. BM', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(238, '1021R0010623V008145', '2306210507', '2001-10-30', 'Laki-laki', '201695', 'DODI WAHYUDIN', NULL, 'Kamar Operasi', '1011101012306220003', '101110101', '2023-06-22 07:23:10', '2023-06-23 12:22:17', 'drg. Lira Masri, Sp. BM', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(239, '1021R0010623V008198', '2306210582', '1956-01-01', 'Laki-laki', '2207087', 'SURYAMA', NULL, 'Kamar Operasi', '1011101012306220002', '101110101', '2023-06-22 06:10:42', '2023-06-22 11:56:34', 'dr. Tarjono, Sp. B', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(240, '1021R0010623V008199', '2306210583', '1998-04-06', 'Perempuan', '2207090', 'VINA AFRILIANA', NULL, 'Kamar Operasi', '1011101012306220001', '101110101', '2023-06-22 06:06:42', '2023-06-22 11:03:40', 'dr. Hanifah Mirzanie, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(241, '1021R0010623V007667', '2306200526', '1985-01-01', 'Perempuan', '2206926', 'WASKINIH', NULL, 'Kamar Operasi', '1011101012306210025', '101110101', '2023-06-21 17:00:45', '2023-06-21 20:11:56', 'dr. La Royba Hawa, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(242, '1021R0010623V008193', '2306210566', '1997-01-12', 'Perempuan', '104363', 'SRI RAHAYU', NULL, 'Kamar Operasi', '1011101012306210024', '101110101', '2023-06-21 16:05:43', '2023-06-22 07:43:32', 'dr. Siswono, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(243, '1021R0010623V008155', '2306210524', '1983-08-15', 'Perempuan', '18703', 'ALINAH ', NULL, 'Kamar Operasi', '1011101012306210023', '101110101', '2023-06-21 16:04:38', '2023-06-22 07:44:14', 'dr. Siswono, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(244, '-', '2306210353', '1976-12-11', 'Perempuan', '4574', 'DARMINI', NULL, 'Kamar Operasi', '1011101012306210022', '101110101', '2023-06-21 13:03:19', '2023-06-22 09:51:42', 'dr. Eka Budhi Satyawardhana, Sp. BS', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(245, '1021R0010623V008123', '2306210461', '1957-11-04', 'Perempuan', '55018', 'MURYATI  BT MASTAL', NULL, 'Kamar Operasi', '1011101012306210020', '101110101', '2023-06-21 11:47:00', '2023-06-22 09:50:44', 'dr. Eka Budhi Satyawardhana, Sp. BS', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(246, '-', '2306210192', '1995-04-08', 'Perempuan', '2207006', 'NY FITRIYANI', NULL, 'Kamar Operasi', '1011101012306210019', '101110101', '2023-06-21 08:38:59', '2023-06-22 07:39:58', 'dr. Wahyudi Hartono, MKK,SP.OG', 0, '', 0, 0, 1, 0, '2023-11-06 00:32:52', NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, 'DONE', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(247, '1021R0010623V007701', '2306200590', '1955-10-19', 'Laki-laki', '2206948', 'U D I', NULL, 'Kamar Operasi', '1011101012306210017', '101110101', '2023-06-21 06:28:12', '2023-06-22 11:47:56', 'dr. Tarjono, Sp. B', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(248, '1021R0010623V007692', '2306200578', '1965-11-03', 'Perempuan', '203855', 'SEREN', NULL, 'Kamar Operasi', '1011101012306210016', '101110101', '2023-06-21 06:27:48', '2023-06-21 13:22:22', 'dr. Rizky Admagusta, Sp. OT', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(249, '1021R0010623V007678', '2306200547', '1995-08-28', 'Perempuan', '86002', 'QODIROH', NULL, 'Kamar Operasi', '1011101012306210015', '101110101', '2023-06-21 06:27:27', '2023-06-21 13:20:05', 'dr. Rizky Admagusta, Sp. OT', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(250, '1021R0010623V007691', '2306200575', '1979-07-08', 'Laki-laki', '200422', 'UDIN SAMSUDIN TN', NULL, 'Kamar Operasi', '1011101012306210014', '101110101', '2023-06-21 06:26:49', '2023-06-22 12:02:53', 'dr. Rizky Admagusta, Sp. OT', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(251, '1021R0010623V007699', '2306200587', '1979-06-01', 'Perempuan', '2206932', 'SUSNIAWATI', NULL, 'Kamar Operasi', '1011101012306210013', '101110101', '2023-06-21 06:26:31', '2023-06-22 11:46:21', 'dr. Tarjono, Sp. B', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(252, '1021R0010623V006555', '2306170294', '2002-01-02', 'Perempuan', '2206700', 'MARYATI BT KADAMA', NULL, 'Kamar Operasi', '1011101012306210012', '101110101', '2023-06-21 06:26:14', '2023-06-21 12:31:15', 'dr. Hanifah Mirzanie, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(253, '1021R0010623V007744', '2306200667', '1979-11-05', 'Perempuan', '2206933', 'SUMAENI', NULL, 'Kamar Operasi', '1011101012306210010', '101110101', '2023-06-21 06:25:39', '2023-06-22 07:38:19', 'dr. Wahyudi Hartono, MKK,SP.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(254, '1021R0010623V007682', '2306200551', '1993-05-18', 'Perempuan', '2206939', 'SUSI SULASTRI', NULL, 'Kamar Operasi', '1011101012306210009', '101110101', '2023-06-21 06:25:24', '2023-06-22 07:38:55', 'dr. Wahyudi Hartono, MKK,SP.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(255, '1021R0010623V007686', '2306200559', '2000-06-19', 'Laki-laki', '169688', 'CASMITA', NULL, 'Kamar Operasi', '1011101012306210008', '101110101', '2023-06-21 06:24:59', '2023-06-21 13:16:07', 'dr. Rizky Admagusta, Sp. OT', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(256, '1021R0010623V007679', '2306200550', '1968-03-15', 'Perempuan', '202835', 'KARYATI', NULL, 'Kamar Operasi', '1011101012306210007', '101110101', '2023-06-21 06:24:44', '2023-06-21 13:14:59', 'dr. Rizky Admagusta, Sp. OT', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(257, '1021R0010623V007690', '2306200574', '1974-12-28', 'Perempuan', '147023', 'SRI HIDAYATI', NULL, 'Kamar Operasi', '1011101012306210006', '101110101', '2023-06-21 06:24:20', '2023-06-22 07:42:06', 'dr. Rizmayadi Anwar, Sp.OT', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(258, '1021R0010623V007687', '2306200561', '1986-06-05', 'Laki-laki', '2206597', 'KASUDIN', NULL, 'Kamar Operasi', '1011101012306210005', '101110101', '2023-06-21 06:24:02', '2023-06-22 07:35:06', 'drg. Lira Masri, Sp. BM', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(259, '1021R0010623V007736', '2306200645', '1976-04-10', 'Perempuan', '197289', 'RATMINIH NY', NULL, 'Kamar Operasi', '1011101012306210004', '101110101', '2023-06-21 06:23:46', '2023-06-22 07:36:03', 'dr. Eka Budhi Satyawardhana, Sp. BS', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(260, '1021R0010623V007675', '2306200541', '2012-08-06', 'Laki-laki', '33010', 'UMAR ABDURRAHMAN AN', NULL, 'Kamar Operasi', '1011101012306210003', '101110101', '2023-06-21 06:23:31', '2023-06-21 13:24:50', 'dr. Rizky Admagusta, Sp. OT', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(261, '1021R0010623V007062', '2306190512', '1986-10-03', 'Perempuan', '206358', 'SANIAH', NULL, 'Kamar Operasi', '1011101012306210002', '101110101', '2023-06-21 06:22:58', '2023-06-22 11:45:02', 'dr. Tarjono, Sp. B', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(262, '1021R0010623V007698', '2306200582', '1978-01-26', 'Perempuan', '2206946', 'INAH', NULL, 'Kamar Operasi', '1011101012306210001', '101110101', '2023-06-21 05:35:25', '2023-06-21 08:46:42', 'dr. Siswono, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(263, '1021R0010623V007737', '2306200648', '1997-08-30', 'Perempuan', '101226', 'LUVI HAERUNISAH', NULL, 'Kamar Operasi', '1011101012306200026', '101110101', '2023-06-20 19:32:39', '2023-06-21 08:03:38', 'dr. Wahyudi Hartono, MKK,SP.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(264, '-', '2306200562', '1992-01-07', 'Perempuan', '23875', 'NITI ADIANTI', NULL, 'Kamar Operasi', '1011101012306200024', '101110101', '2023-06-20 12:54:35', '2023-06-21 08:02:51', 'dr. Wahyudi Hartono, MKK,SP.OG', 0, '', 0, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(265, '1021R0010623V007605', '2306200437', '1956-06-30', 'Laki-laki', '58583', 'H  U ABDUL MUFTI', NULL, 'Kamar Operasi', '1011101012306200023', '101110101', '2023-06-20 10:37:57', '2023-06-21 12:15:36', 'dr. Rizky Admagusta, Sp. OT', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(266, '1021R0010623V007145', '2306190642', '2016-06-28', 'Perempuan', '2206596', 'MOZHA ARFANESA ZAVIRA', NULL, 'Kamar Operasi', '1011101012306200021', '101110101', '2023-06-20 08:43:34', '2023-06-21 12:15:00', 'drg. Lira Masri, Sp. BM', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(267, '1021R0010623V007209', '2306190752', '1992-05-23', 'Perempuan', '2206874', 'ADE IIS SUMIRAT', NULL, 'Kamar Operasi', '1011101012306200020', '101110101', '2023-06-20 08:38:20', '2023-06-23 09:09:59', 'dr. Tarjono, Sp. B', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(268, '1021R0010623V007218', '2306200014', '1989-08-14', 'Laki-laki', '78426', 'ZUBAEDAH', NULL, 'Kamar Operasi', '1011101012306200019', '101110101', '2023-06-20 08:17:39', '2023-06-20 11:13:05', 'dr. Wahyudi Hartono, MKK,SP.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(269, '1021R0010623V006922', '2306180079', '1999-04-21', 'Laki-laki', '2206737', 'DARMANI', NULL, 'Kamar Operasi', '1011101012306200017', '101110101', '2023-06-20 08:13:55', '2023-06-20 20:00:22', 'dr. Eka Budhi Satyawardhana, Sp. BS', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(270, '1021R0010623V006284', '2306160449', '1948-03-27', 'Perempuan', '10535', 'HJ MASLICHA', NULL, 'Kamar Operasi', '1011101012306200016', '101110101', '2023-06-20 08:12:38', '2023-06-21 08:00:37', 'dr. Rizmayadi Anwar, Sp.OT', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(271, '1021R0010623V007149', '2306190651', '2005-08-03', 'Laki-laki', '2206580', 'TAROHIM', NULL, 'Kamar Operasi', '1011101012306200014', '101110101', '2023-06-20 08:08:53', '2023-06-21 12:04:13', 'drg. Lira Masri, Sp. BM', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(272, '1021R0010623V007147', '2306190648', '2004-11-20', 'Laki-laki', '206409', 'RIDHO ILZINAN', NULL, 'Kamar Operasi', '1011101012306200013', '101110101', '2023-06-20 08:07:50', '2023-06-21 07:58:20', 'dr. Rizky Admagusta, Sp. OT', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(273, '1021R0010623V007130', '2306190610', '1978-04-19', 'Laki-laki', '179027', 'WANDI BN AMAD', NULL, 'Kamar Operasi', '1011101012306200012', '101110101', '2023-06-20 08:06:39', '2023-06-21 07:57:54', 'dr. Rizky Admagusta, Sp. OT', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(274, '1021R0010623V007129', '2306190607', '1967-07-12', 'Laki-laki', '203276', 'H USEP', NULL, 'Kamar Operasi', '1011101012306200008', '101110101', '2023-06-20 07:36:12', '2023-06-21 07:57:24', 'dr. Rizky Admagusta, Sp. OT', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(275, '1021R0010623V006615', '2306190010', '1989-03-09', 'Perempuan', '206855', 'YUSNIAH', NULL, 'Kamar Operasi', '1011101012306200007', '101110101', '2023-06-20 07:34:13', '2023-06-20 11:00:33', 'dr. Hanifah Mirzanie, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(276, '1021R0010623V006596', '2306180085', '1960-11-12', 'Laki-laki', '149967', 'SAIN', NULL, 'Kamar Operasi', '1011101012306200005', '101110101', '2023-06-20 07:26:16', '2023-06-22 11:22:44', 'dr. Mochamad Reza Mahdi, Sp. PD', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(277, '1021R0010623V007213', '2306190760', '1953-10-07', 'Perempuan', '2206877', 'MARNI', NULL, 'Kamar Operasi', '1011101012306200004', '101110101', '2023-06-20 07:21:54', '2023-06-22 11:20:55', 'dr. Tarjono, Sp. B', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(278, '1021R0010623V007066', '2306190518', '1952-03-07', 'Laki-laki', '182621', 'DARTA', NULL, 'Kamar Operasi', '1011101012306200003', '101110101', '2023-06-20 07:19:42', '2023-06-22 11:17:18', 'dr. Tarjono, Sp. B', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(279, '1021R0010623V007140', '2306190628', '1968-11-17', 'Perempuan', '2206227', 'KHODIJAH', NULL, 'Kamar Operasi', '1011101012306200002', '101110101', '2023-06-20 07:18:26', '2023-06-22 11:06:00', 'dr. Tarjono, Sp. B', 0, '', 0, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, 'ada yang salah', '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(280, '1021R0010623V006352', '2306160577', '1956-09-14', 'Laki-laki', '2206650', 'KOMARUDIN', NULL, 'Kamar Operasi', '1011101012306190012', '101110101', '2023-06-19 13:57:48', '2023-06-20 07:11:29', 'dr. Eka Budhi Satyawardhana, Sp. BS', 0, '', 0, 0, 0, 0, '2023-11-06 13:14:46', NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', 'kurang ronsen', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(281, '1021R0010623V007152', '2306190656', '2015-08-07', 'Perempuan', '2206834', 'ROSIDATUN MAZIDAH', NULL, 'Kamar Operasi', '1011101012306190011', '101110101', '2023-06-19 13:53:16', '2023-06-20 07:14:01', 'dr. Wahyudi Hartono, MKK,SP.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(282, '1021R0010623V006603', '2306180115', '1992-09-21', 'Perempuan', '111546', 'SRI MULYANI', NULL, 'Kamar Operasi', '1011101012306190007', '101110101', '2023-06-19 08:02:47', '2023-06-19 10:41:07', 'dr. Wahyudi Hartono, MKK,SP.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(283, '1021R0010623V006602', '2306180113', '2006-11-20', 'Laki-laki', '84601', 'HILAL NAFIS ADILAH', NULL, 'Kamar Operasi', '1011101012306190006', '101110101', '2023-06-19 08:01:58', '2023-06-20 07:13:25', 'dr. Rizky Admagusta, Sp. OT', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(284, '1021R0010623V006593', '2306180075', '2022-08-23', 'Laki-laki', '2206348', 'ARROYYAN ALFARIZQI', NULL, 'Kamar Operasi', '1011101012306190005', '101110101', '2023-06-19 08:00:31', '2023-06-20 09:03:11', 'dr. Tarjono, Sp. B', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(285, '1021R0010623V006594', '2306180077', '2008-01-05', 'Perempuan', '2206478', 'SITI NUR AZIZAH', NULL, 'Kamar Operasi', '1011101012306190004', '101110101', '2023-06-19 08:00:15', '2023-06-20 09:00:52', 'dr. Tarjono, Sp. B', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(286, '1021R0010623V006579', '2306180032', '1972-07-11', 'Perempuan', '2205687', 'TOIPAHTUN MAULA', NULL, 'Kamar Operasi', '1011101012306190002', '101110101', '2023-06-19 07:59:35', '2023-06-20 08:59:03', 'dr. Tarjono, Sp. B', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(287, '1021R0010623V006578', '2306180030', '2002-05-07', 'Laki-laki', '2206402', 'NIKO MAYLANDI', NULL, 'Kamar Operasi', '1011101012306190001', '101110101', '2023-06-19 07:59:15', '2023-06-20 08:56:25', 'dr. Tarjono, Sp. B', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(288, '1021R0010623V006564', '2306170304', '1962-09-05', 'Perempuan', '2206702', 'CATU', NULL, 'Kamar Operasi', '1011101012306180008', '101110101', '2023-06-18 19:21:49', '2023-06-19 08:38:50', 'dr. Rachmat Prayitno, SpB, MARS, FICS, FINACS', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(289, '1021R0010623V006590', '2306180065', '1976-05-11', 'Perempuan', '2206729', 'ATUNG', NULL, 'Kamar Operasi', '1011101012306180007', '101110101', '2023-06-18 18:40:03', '2023-06-19 08:40:18', 'dr. Rachmat Prayitno, SpB, MARS, FICS, FINACS', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(290, '1021R0010623V006588', '2306180062', '1991-11-11', 'Perempuan', '2206731', 'TULUS RAHAYU', NULL, 'Kamar Operasi', '1011101012306180004', '101110101', '2023-06-18 16:46:25', '2023-06-19 08:56:46', 'dr. Hanifah Mirzanie, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(291, '1021R0010623V006576', '2306180029', '1987-07-12', 'Perempuan', '24477', 'RATNAWATI', NULL, 'Kamar Operasi', '1011101012306180003', '101110101', '2023-06-18 14:29:48', '2023-06-19 08:34:21', 'dr. Siswono, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(292, '1021R0010623V006576', '2306180029', '1987-07-12', 'Perempuan', '24477', 'RATNAWATI', NULL, 'Kamar Operasi', '1011101012306180001', '101110101', '2023-06-18 10:31:44', '2023-06-18 13:16:02', 'dr. Siswono, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(293, '1021R0010623V004745', '2306130546', '1963-06-03', 'Perempuan', '2206233', 'NURYATI', NULL, 'Kamar Operasi', '1011101012306170013', '101110101', '2023-06-17 15:00:32', '2023-06-19 08:27:38', 'dr. La Royba Hawa, Sp.OG', 0, 'Diajukan', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36'),
(294, '1021R0010623V006349', '2306160572', '1996-12-09', 'Perempuan', '2205427', 'FITRI SUNINGSIH', NULL, 'Kamar Operasi', '1011101012306170012', '101110101', '2023-06-17 10:43:26', '2023-06-19 08:29:00', 'dr. Wahyudi Hartono, MKK,SP.OG', 0, '', 0, 0, 0, 0, '2023-11-06 13:15:34', NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', 'Tambah catatan saja', '', '', '2023-10-31 14:09:19', '2023-11-08 11:53:49'),
(295, '1021R0010623V006345', '2306160556', '1974-04-05', 'Perempuan', '2206644', 'SODAH', NULL, 'Kamar Operasi', '1011101012306170011', '101110101', '2023-06-17 10:31:09', '2023-06-19 08:24:25', 'dr. Mochamad Reza Mahdi, Sp. PD', NULL, 'Selesai', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 17:55:47'),
(296, '1021R0010623V006491', '2306170170', '1978-09-13', 'Perempuan', '179577', 'TARINIH BT RASWADI', NULL, 'Kamar Operasi', '1011101012306170010', '101110101', '2023-06-17 10:12:50', '2023-06-19 08:25:52', 'dr. Rachmat Prayitno, SpB, MARS, FICS, FINACS', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:53:49'),
(297, '1021R0010623V005912', '2306150616', '1996-02-22', 'Perempuan', '22626', 'SITI KHOMSIAH', NULL, 'Kamar Operasi', '1011101012306170009', '101110101', '2023-06-17 09:26:56', '2023-06-17 10:53:05', 'dr. Siswono, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 17:55:39'),
(298, '1021R0010623V006470', '2306170146', '2008-04-08', 'Perempuan', '2206658', 'LARASATI', NULL, 'Kamar Operasi', '1011101012306170008', '101110101', '2023-06-17 09:19:00', '2023-06-19 08:25:01', 'dr. Rachmat Prayitno, SpB, MARS, FICS, FINACS', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:48:18'),
(299, '1021R0010623V006541', '2306170148', '2005-12-25', 'Perempuan', '2206660', 'SUSANTI', NULL, 'Kamar Operasi', '1011101012306170007', '101110101', '2023-06-17 09:00:13', '2023-06-19 08:21:55', 'dr. La Royba Hawa, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:50:04'),
(300, '1021R0010623V006440', '2306170108', '2003-09-10', 'Perempuan', '47800', 'DIAN FAUDILAH', NULL, 'Kamar Operasi', '1011101012306170006', '101110101', '2023-06-17 08:58:37', '2023-06-19 08:21:27', 'dr. La Royba Hawa, Sp.OG', NULL, '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'BPJS / JKN', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2023-10-31 14:09:19', '2023-11-08 11:41:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint UNSIGNED NOT NULL,
  `general_code` bigint UNSIGNED DEFAULT NULL,
  `room` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rooms`
--

INSERT INTO `rooms` (`id`, `general_code`, `room`, `jenis`, `created_at`, `updated_at`) VALUES
(1, 101010101, 'Klinik Dalam', 'rwj', NULL, NULL),
(2, 101010102, 'Klinik Mata', 'rwj', NULL, NULL),
(3, 101010103, 'Klinik Gigi', 'rwj', NULL, NULL),
(4, 101010104, 'Klinik Anak', 'rwj', NULL, NULL),
(5, 101010105, 'Klinik Kebidanan', 'rwj', NULL, NULL),
(6, 101010106, 'Klinik THT', 'rwj', NULL, NULL),
(7, 101010107, 'Klinik Bedah', 'rwj', NULL, NULL),
(8, 101010108, 'Klinik Kulit & Kelamin', 'rwj', NULL, NULL),
(9, 101010109, 'Klinik Orthopedi', 'rwj', NULL, NULL),
(10, 101010110, 'Klinik Bedah Saraf', '', NULL, NULL),
(11, 101010111, 'Klinik Melati', '', NULL, NULL),
(12, 101010112, 'Klinik Jantung', '', NULL, NULL),
(13, 101010113, 'Klinik DOTS', '', NULL, NULL),
(14, 101010114, 'Klinik Geriatri', '', NULL, NULL),
(15, 101010115, 'Klinik Rehab Medik', '', NULL, NULL),
(16, 101010116, 'Klinik Mawar', '', NULL, NULL),
(17, 101010117, 'Klinik Fisioterapi', '', NULL, NULL),
(18, 101010118, 'Klinik Hemodialisa', '', NULL, NULL),
(19, 101010119, 'Klinik Dalam 2', '', NULL, NULL),
(20, 101010120, 'Klinik Saraf', '', NULL, NULL),
(21, 101010121, 'MCU', '', NULL, NULL),
(22, 101010122, 'Klinik Kemoterapi (HOT)', '', NULL, NULL),
(23, 101010123, 'Klinik Nyeri', '', NULL, NULL),
(24, 101010124, 'Klinik Luka Modern', '', NULL, NULL),
(25, 101010125, 'Thalesemia', '', NULL, NULL),
(26, 101010126, 'Klinik VIP', '', NULL, NULL),
(27, 101010127, 'Klinik Gigi Bedah Mulut', '', NULL, NULL),
(28, 101010128, 'CSSD', '', NULL, NULL),
(29, 101020102, 'IGD', '', NULL, NULL),
(30, 101020103, 'IGD VK', '', NULL, NULL),
(31, 101030101, 'Golek', 'rwi', NULL, NULL),
(32, 101030118, 'Kidang Kencana 3', '', NULL, NULL),
(33, 101030121, 'Kidang Emas ', '', NULL, NULL),
(34, 101030201, 'Manalagi 1', '', NULL, NULL),
(35, 101030202, 'Manalagi 2', '', NULL, NULL),
(36, 101030301, 'Gincu 1', '', NULL, NULL),
(37, 101030302, 'Gincu 3', '', NULL, NULL),
(38, 101030303, 'Gincu 4', '', NULL, NULL),
(39, 101030401, 'Cengkir 1', 'rwi', NULL, NULL),
(40, 101030402, 'Cengkir 2', 'rwi', NULL, NULL),
(41, 101030403, 'Cengkir 3', 'rwi', NULL, NULL),
(42, 101030501, 'Kweni', '', NULL, NULL),
(43, 101030502, 'Arumanis', '', NULL, NULL),
(44, 101030601, 'Kidang Kencana 1', 'rwi', NULL, NULL),
(45, 101030602, 'Kidang Kencana 2', '', NULL, NULL),
(46, 101030701, 'Gincu 2', '', NULL, NULL),
(47, 101030801, 'Malgova', '', NULL, NULL),
(48, 101030901, 'ICU', '', NULL, NULL),
(49, 101030902, 'HCU', '', NULL, NULL),
(50, 101030903, 'NICU', '', NULL, NULL),
(51, 101030904, 'NCCU', '', NULL, NULL),
(52, 101031001, 'Isolasi Kebidanan', '', NULL, NULL),
(53, 101031002, 'Isolasi Khusus', '', NULL, NULL),
(54, 101110101, 'Kamar Operasi', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `room` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_active` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `name`, `role`, `room`, `last_active`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$l.JTzK/pnX0PwpTc9U5TwuKMYXn5NFPNkjf9p1xZ0X2h0jsAeMgie', 'Admin DTS', 'admin', '', '2023-10-27 10:44:30', '2023-10-27 10:44:30', '2023-10-27 10:44:30'),
(2, 'Hali', '$2y$10$QlqowoDPsNkkcwzeQU8jc.s5piXSWX1XShRZSOWqew6pRpX/WSA9m', 'Hali Munandar', 'JKN', '', '2023-10-27 10:44:30', '2023-10-27 10:44:31', '2023-10-27 10:44:31'),
(3, 'Dani', '$2y$10$h4.hGBPKYHohQt5FpbLZEee5xbf2Q7Ut/DZkDGPzf4t6jKh/4C0U2', 'Dani Munandar', 'kepala ruangan', '', '2023-10-27 10:44:31', '2023-10-27 10:44:31', '2023-10-27 10:44:31'),
(4, 'adit', '$2y$10$EIZkrVu68QOtCcsPlhHcaOThtaldSbjvkNh9t7FIu1VOOI5X50Rru', 'Adithya Rahman', 'admin', '', '2023-10-30 22:59:36', '2023-10-30 22:59:36', '2023-10-30 22:59:36'),
(5, 'rendy', '$2y$10$Cces7H4z2n94LiAZHxuQ..Ed.JU2kw/pDm0mbF2JoO7OlIbvSuM9K', 'rendy', 'admin', '', '2023-10-31 01:41:53', '2023-10-31 01:41:53', '2023-10-31 01:41:53'),
(6, 'adit77', '$2y$10$xcuSqP6fwUlMdd/JcP5ja.0I7vLRfrmKdkBXCU8jAr0uyQMtFJpRy', 'Adithya Rahman', 'admin', 'Klinik Dalam', '2023-11-01 04:04:31', '2023-11-01 04:04:31', '2023-11-01 04:04:31'),
(7, 'adminKK1', '$2y$10$Y8B.RMBZ8kzapKOuxp0.IefYqanL8T4KBVLgJ1pdjsX31kdUfdKvi', 'admin kidang kencana 1', 'admin', 'Kidang Kencana 1', '2023-11-02 10:30:00', '2023-11-02 10:30:00', '2023-11-02 10:30:00'),
(8, 'KARUKK1', '$2y$10$uQT1tIhJXAGHpdzIxG0JOO3y0DdZj/4dXLANqiSh6xAKfqe5YlbSq', 'Kepala Ruangan Kidang Kencana 1', 'kepala ruangan', 'Kidang Kencana 1', '2023-11-02 10:31:30', '2023-11-02 10:31:30', '2023-11-02 10:31:30');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `doc_patients`
--
ALTER TABLE `doc_patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doc_patients_patient_id_foreign` (`patient_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patients_room_id_foreign` (`room_id`);

--
-- Indeks untuk tabel `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `doc_patients`
--
ALTER TABLE `doc_patients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT untuk tabel `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `doc_patients`
--
ALTER TABLE `doc_patients`
  ADD CONSTRAINT `doc_patients_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);

--
-- Ketidakleluasaan untuk tabel `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
