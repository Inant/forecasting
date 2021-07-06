-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jul 2021 pada 14.50
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forecasting_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id` int(10) UNSIGNED NOT NULL,
  `bulan` tinyint(2) UNSIGNED ZEROFILL NOT NULL,
  `tahun` mediumint(9) NOT NULL,
  `qty_bahan_baku` decimal(11,2) NOT NULL,
  `nominal_bahan_baku` decimal(13,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bahan_baku`
--

INSERT INTO `bahan_baku` (`id`, `bulan`, `tahun`, `qty_bahan_baku`, `nominal_bahan_baku`, `created_at`, `updated_at`) VALUES
(1, 01, 2018, '2341.30', '2681471880.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(2, 02, 2018, '2526.14', '2753038024.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(3, 03, 2018, '3004.08', '3368948901.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(4, 04, 2018, '2788.13', '3085639912.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(5, 05, 2018, '2240.00', '2532883093.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(6, 06, 2018, '1559.79', '1885416783.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(7, 07, 2018, '1745.94', '2144400398.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(8, 08, 2018, '1422.96', '1816822987.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(9, 09, 2018, '1459.54', '1848371883.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(10, 10, 2018, '1565.66', '2005332527.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(11, 11, 2018, '929.93', '1185801662.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(12, 12, 2018, '1347.54', '1787259179.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(13, 01, 2019, '1127.11', '1531056570.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(14, 02, 2019, '1315.18', '1775155289.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(15, 03, 2019, '1158.42', '1494436483.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(16, 04, 2019, '1162.35', '1470214896.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(17, 05, 2019, '556.75', '690609532.10', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(18, 06, 2019, '705.88', '966083009.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(19, 07, 2019, '2485.01', '2981130455.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(20, 08, 2019, '2546.46', '2141929798.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(21, 09, 2019, '2047.11', '2412238560.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(22, 10, 2019, '2506.52', '3028975440.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(23, 11, 2019, '1786.72', '2133815000.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(24, 12, 2019, '342.23', '410026000.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(25, 01, 2020, '0.00', '0.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(26, 02, 2020, '1585.89', '1648203000.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00'),
(27, 03, 2020, '2619.47', '2430919000.00', '2021-03-15 22:50:00', '2021-03-15 22:50:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya_tenaga_kerja`
--

CREATE TABLE `biaya_tenaga_kerja` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_karyawan` int(11) NOT NULL,
  `gaji_per_karyawan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `biaya_tenaga_kerja`
--

INSERT INTO `biaya_tenaga_kerja` (`id`, `jumlah_karyawan`, `gaji_per_karyawan`, `created_at`, `updated_at`) VALUES
(1, 432, 1954706, '2021-04-14 14:36:21', '2021-07-01 15:02:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_produksi`
--

CREATE TABLE `hasil_produksi` (
  `id` int(10) UNSIGNED NOT NULL,
  `bulan` tinyint(4) NOT NULL,
  `tahun` mediumint(9) NOT NULL,
  `qty_hasil_produksi` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rendemen` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `hasil_produksi`
--

INSERT INTO `hasil_produksi` (`id`, `bulan`, `tahun`, `qty_hasil_produksi`, `created_at`, `updated_at`, `rendemen`) VALUES
(1, 1, 2018, '1115.18', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '47.63'),
(2, 2, 2018, '1307.46', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '51.76'),
(3, 3, 2018, '1435.15', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '47.77'),
(4, 4, 2018, '1347.35', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '48.32'),
(5, 5, 2018, '1036.98', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '46.29'),
(6, 6, 2018, '729.24', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '46.75'),
(7, 7, 2018, '827.63', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '47.40'),
(8, 8, 2018, '666.76', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '46.86'),
(9, 9, 2018, '691.76', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '47.40'),
(10, 10, 2018, '731.40', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '46.72'),
(11, 11, 2018, '520.05', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '55.92'),
(12, 12, 2018, '657.35', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '48.78'),
(13, 1, 2019, '623.06', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '55.28'),
(14, 2, 2019, '769.21', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '58.49'),
(15, 3, 2019, '531.67', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '45.90'),
(16, 4, 2019, '652.30', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '56.12'),
(17, 5, 2019, '316.29', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '56.81'),
(18, 6, 2019, '392.37', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '55.59'),
(19, 7, 2019, '1734.52', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '69.80'),
(20, 8, 2019, '1587.39', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '62.34'),
(21, 9, 2019, '1201.23', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '58.68'),
(22, 10, 2019, '1480.69', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '59.07'),
(23, 11, 2019, '1043.94', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '58.43'),
(24, 12, 2019, '144.23', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '42.14'),
(25, 1, 2020, '0.00', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '0.00'),
(26, 2, 2020, '950.15', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '59.91'),
(27, 3, 2020, '1327.91', '2021-03-16 13:54:00', '2021-03-16 13:54:00', '50.69');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_02_09_223335_create_sessions_table', 1),
(7, '2021_02_13_185325_create_purchase_order_table', 2),
(8, '2021_02_14_003940_modify_bulan_field', 3),
(9, '2021_02_15_213022_create_bahan_baku_table', 4),
(10, '2021_02_15_214220_modify_bulan_bahan_baku', 5),
(11, '2021_02_22_101631_create_hasil_produksi_table', 6),
(12, '2021_03_02_003633_add_rendemen_in_hasil_produksi_table', 7),
(13, '2021_03_02_004526_add_stock_opname_in_purchase_order_table', 8),
(14, '2021_03_15_071831_create_pembelian_bahan_baku_table', 9),
(15, '2021_03_15_072412_create_pembelian_sparepart_table', 9),
(16, '2021_03_15_072629_create_pemakaian_sparepart_table', 10),
(17, '2021_03_15_073009_create_pemakaian_barang_jadi_table', 10),
(18, '2021_03_15_074040_create_stock_opname_table', 11),
(19, '2021_03_15_132836_delete_stock_opname', 12),
(20, '2021_03_15_192740_add_timestamps', 13),
(21, '2021_03_15_213538_alter_stock_opname', 14),
(23, '2021_04_14_210528_create_biaya_tenaga_kerja_table', 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemakaian_barang_jadi`
--

CREATE TABLE `pemakaian_barang_jadi` (
  `id` int(10) UNSIGNED NOT NULL,
  `bulan` tinyint(4) NOT NULL,
  `tahun` mediumint(9) NOT NULL,
  `qty_pemakaian` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pemakaian_barang_jadi`
--

INSERT INTO `pemakaian_barang_jadi` (`id`, `bulan`, `tahun`, `qty_pemakaian`, `created_at`, `updated_at`) VALUES
(1, 1, 2018, '0.00', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(2, 2, 2018, '0.00', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(3, 3, 2018, '0.00', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(4, 4, 2018, '0.00', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(5, 5, 2018, '0.00', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(6, 6, 2018, '0.00', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(7, 7, 2018, '0.00', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(8, 8, 2018, '0.00', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(9, 9, 2018, '0.00', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(10, 10, 2018, '0.00', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(11, 11, 2018, '0.00', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(12, 12, 2018, '0.00', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(13, 1, 2019, '0.00', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(14, 2, 2019, '0.00', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(15, 3, 2019, '50.62', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(16, 4, 2019, '330.78', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(17, 5, 2019, '118.91', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(18, 6, 2019, '0.00', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(19, 7, 2019, '949.12', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(20, 8, 2019, '1175.97', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(21, 9, 2019, '1222.99', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(22, 10, 2019, '1103.49', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(23, 11, 2019, '334.02', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(24, 12, 2019, '-10.12', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(25, 1, 2020, '22.77', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(26, 2, 2020, '350.17', '2021-03-16 18:39:03', '2021-03-16 18:39:03'),
(27, 3, 2020, '1242.40', '2021-03-16 18:39:03', '2021-03-16 18:39:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemakaian_sparepart`
--

CREATE TABLE `pemakaian_sparepart` (
  `id` int(10) UNSIGNED NOT NULL,
  `bulan` tinyint(4) NOT NULL,
  `tahun` mediumint(9) NOT NULL,
  `qty_pemakaian` decimal(11,2) NOT NULL,
  `nominal_pemakaian` decimal(13,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pemakaian_sparepart`
--

INSERT INTO `pemakaian_sparepart` (`id`, `bulan`, `tahun`, `qty_pemakaian`, `nominal_pemakaian`, `created_at`, `updated_at`) VALUES
(1, 1, 2018, '11167.25', '435217374.11', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(2, 2, 2018, '9084.00', '314253814.63', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(3, 3, 2018, '12703.80', '743758687.82', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(4, 4, 2018, '11203.48', '411712049.05', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(5, 5, 2018, '10188.00', '381312868.05', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(6, 6, 2018, '6124.00', '169066076.91', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(7, 7, 2018, '10768.50', '353971477.29', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(8, 8, 2018, '9368.50', '274349907.02', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(9, 9, 2018, '9784.00', '279429539.96', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(10, 10, 2018, '9377.75', '295962752.29', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(11, 11, 2018, '8926.50', '252698242.18', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(12, 12, 2018, '7884.50', '224877106.64', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(13, 1, 2019, '9885.00', '480645836.36', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(14, 2, 2019, '9713.00', '293348597.59', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(15, 3, 2019, '18360.57', '2424952993.21', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(16, 4, 2019, '45817.94', '522014280.07', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(17, 5, 2019, '38850.04', '391422475.32', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(18, 6, 2019, '41921.05', '1878476124.57', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(19, 7, 2019, '124816.56', '906507528.71', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(20, 8, 2019, '111528.66', '785426210.81', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(21, 9, 2019, '121011.95', '951985496.04', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(22, 10, 2019, '165914.15', '1401064726.18', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(23, 11, 2019, '34002.46', '398609372.53', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(24, 12, 2019, '11244.80', '134450980.89', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(25, 1, 2020, '7088.30', '142857826.48', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(26, 2, 2020, '99320.10', '814955833.57', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(27, 3, 2020, '141920.80', '870998468.27', '2021-03-16 07:41:00', '2021-03-16 07:41:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_bahan_baku`
--

CREATE TABLE `pembelian_bahan_baku` (
  `id` int(10) UNSIGNED NOT NULL,
  `bulan` tinyint(4) NOT NULL,
  `tahun` mediumint(9) NOT NULL,
  `qty_pembelian` decimal(11,2) NOT NULL,
  `nominal_pembelian` decimal(13,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembelian_bahan_baku`
--

INSERT INTO `pembelian_bahan_baku` (`id`, `bulan`, `tahun`, `qty_pembelian`, `nominal_pembelian`, `created_at`, `updated_at`) VALUES
(1, 1, 2018, '619.01', '648228000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(2, 2, 2018, '2538.76', '2748720000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(3, 3, 2018, '3496.27', '3931265000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(4, 4, 2018, '3550.85', '3926977000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(5, 5, 2018, '1719.42', '2124407000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(6, 6, 2018, '1249.73', '1475472000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(7, 7, 2018, '2092.47', '2620012000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(8, 8, 2018, '1862.76', '2360579000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(9, 9, 2018, '1066.79', '1358431000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(10, 10, 2018, '846.40', '1080657000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(11, 11, 2018, '1349.12', '1772475000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(12, 12, 2018, '952.23', '1285964000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(13, 1, 2019, '1285.72', '1732956000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(14, 2, 2019, '1416.55', '1932800000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(15, 3, 2019, '1086.18', '1282929000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(16, 4, 2019, '1104.27', '1475239000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(17, 5, 2019, '308.70', '381197000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(18, 6, 2019, '369.12', '505451400.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(19, 7, 2019, '3292.10', '4041658000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(20, 8, 2019, '2303.66', '2729578000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(21, 9, 2019, '1791.98', '2081072000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(22, 10, 2019, '2835.85', '3327321000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(23, 11, 2019, '1202.26', '1536867000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(24, 12, 2019, '201.96', '229708000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(25, 1, 2020, '0.00', '0.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(26, 2, 2020, '1712.24', '1770276000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00'),
(27, 3, 2020, '2575.33', '2375338000.00', '2021-03-15 17:18:00', '2021-03-15 17:18:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_sparepart`
--

CREATE TABLE `pembelian_sparepart` (
  `id` int(10) UNSIGNED NOT NULL,
  `bulan` tinyint(4) NOT NULL,
  `tahun` mediumint(9) NOT NULL,
  `qty_pembelian` decimal(11,2) NOT NULL,
  `nominal_pembelian` decimal(13,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembelian_sparepart`
--

INSERT INTO `pembelian_sparepart` (`id`, `bulan`, `tahun`, `qty_pembelian`, `nominal_pembelian`, `created_at`, `updated_at`) VALUES
(1, 1, 2018, '10164.00', '277223460.00', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(2, 2, 2018, '9178.00', '338262487.00', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(3, 3, 2018, '11314.00', '657677803.34', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(4, 4, 2018, '12511.38', '537192160.80', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(5, 5, 2018, '13883.30', '540381690.90', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(6, 6, 2018, '2887.00', '51975000.00', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(7, 7, 2018, '10111.10', '290037897.67', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(8, 8, 2018, '10554.30', '377622650.00', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(9, 9, 2018, '8444.88', '214037500.10', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(10, 10, 2018, '8838.91', '299205870.00', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(11, 11, 2018, '8446.96', '283605796.65', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(12, 12, 2018, '9918.40', '267668637.00', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(13, 1, 2019, '9495.03', '3332685899.00', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(14, 2, 2019, '10052.71', '367197432.00', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(15, 3, 2019, '29202.00', '630859773.00', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(16, 4, 2019, '62478.15', '633037385.46', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(17, 5, 2019, '50128.26', '873330245.00', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(18, 6, 2019, '26160.66', '443347237.00', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(19, 7, 2019, '122484.89', '1146049053.00', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(20, 8, 2019, '130680.30', '918191138.72', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(21, 9, 2019, '133201.08', '1064121561.00', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(22, 10, 2019, '132999.52', '1177131229.00', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(23, 11, 2019, '20005.98', '348171018.20', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(24, 12, 2019, '12023.00', '277893305.40', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(25, 1, 2020, '1935.70', '64907996.00', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(26, 2, 2020, '125726.30', '1059827292.00', '2021-03-16 07:41:00', '2021-03-16 07:41:00'),
(27, 3, 2020, '137207.90', '1058073454.00', '2021-03-16 07:41:00', '2021-03-16 07:41:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `bulan` tinyint(2) UNSIGNED ZEROFILL NOT NULL,
  `tahun` mediumint(9) NOT NULL,
  `qty_po` decimal(11,2) NOT NULL,
  `nominal_po` decimal(13,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `purchase_order`
--

INSERT INTO `purchase_order` (`id`, `bulan`, `tahun`, `qty_po`, `nominal_po`, `created_at`, `updated_at`) VALUES
(1, 01, 2018, '1675.55', '7390857356.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(2, 02, 2018, '1382.72', '5332308118.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(3, 03, 2018, '1476.27', '5529031446.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(4, 04, 2018, '1034.11', '4248785584.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(5, 05, 2018, '1028.99', '4535309712.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(6, 06, 2018, '590.44', '3094726898.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(7, 07, 2018, '667.19', '3604801755.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(8, 08, 2018, '769.45', '4087305203.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(9, 09, 2018, '624.97', '3736466100.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(10, 10, 2018, '619.05', '3497624979.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(11, 11, 2018, '635.10', '3777457660.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(12, 12, 2018, '622.77', '3596426660.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(13, 01, 2019, '594.02', '3448438472.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(14, 02, 2019, '715.50', '3282822051.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(15, 03, 2019, '511.11', '2938289530.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(16, 04, 2019, '419.87', '2571121900.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(17, 05, 2019, '227.72', '1220608160.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(18, 06, 2019, '237.84', '1393552320.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(19, 07, 2019, '346.64', '2080902740.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(20, 08, 2019, '402.31', '2321406505.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(21, 09, 2019, '422.55', '2328111350.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(22, 10, 2019, '273.27', '1426192725.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(23, 11, 2019, '397.25', '2208681475.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(24, 12, 2019, '172.05', '878891960.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(25, 01, 2020, '227.72', '1147608510.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(26, 02, 2020, '179.64', '822973107.50', '2021-03-11 16:03:00', '2021-03-11 16:03:00'),
(27, 03, 2020, '240.22', '1193750430.00', '2021-03-11 16:03:00', '2021-03-11 16:03:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('tqQglsQjdDfCq3aB9hCoxkfIBzvlaxi4KVcsHXUc', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiZ0NGa1JxVHdyV0xnbHhUSWo0cDhVbHcxR0REUDlYS1dXSWdrTU96NyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJHdyRjlNMmgzMi5sc2paM0JtMVdkNGVGY1BkdlVCcUZMNE90OUk1NkEyVUduWTF0UTd5ay5xIjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCR3ckY5TTJoMzIubHNqWjNCbTFXZDRlRmNQZHZVQnFGTDRPdDlJNTZBMlVHblkxdFE3eWsucSI7fQ==', 1625485164);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_opname`
--

CREATE TABLE `stock_opname` (
  `id` int(10) UNSIGNED NOT NULL,
  `bulan` tinyint(4) NOT NULL,
  `tahun` mediumint(9) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bahan_baku` decimal(11,2) NOT NULL,
  `sparepart` decimal(11,2) NOT NULL,
  `barang_jadi` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stock_opname`
--

INSERT INTO `stock_opname` (`id`, `bulan`, `tahun`, `created_at`, `updated_at`, `bahan_baku`, `sparepart`, `barang_jadi`) VALUES
(1, 1, 2018, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '412.95', '6426.69', '220.56'),
(2, 2, 2018, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '425.56', '6520.69', '145.29'),
(3, 3, 2018, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '917.75', '5130.89', '104.17'),
(4, 4, 2018, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '1680.48', '6438.80', '417.40'),
(5, 5, 2018, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '1159.90', '10134.10', '425.39'),
(6, 6, 2018, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '849.84', '6897.10', '564.19'),
(7, 7, 2018, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '1196.38', '6239.70', '724.62'),
(8, 8, 2018, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '1636.18', '7966.50', '621.92'),
(9, 9, 2018, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '1243.42', '6086.38', '688.71'),
(10, 10, 2018, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '524.17', '5547.54', '801.05'),
(11, 11, 2018, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '943.36', '5068.01', '686.00'),
(12, 12, 2018, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '548.05', '7101.91', '720.58'),
(13, 1, 2019, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '706.67', '6711.94', '749.62'),
(14, 2, 2019, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '808.03', '7051.65', '803.32'),
(15, 3, 2019, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '735.80', '17893.08', '773.24'),
(16, 4, 2019, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '677.72', '34553.29', '674.71'),
(17, 5, 2019, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '429.67', '45831.51', '644.35'),
(18, 6, 2019, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '92.91', '30071.12', '798.88'),
(19, 7, 2019, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '900.00', '27739.45', '1237.44'),
(20, 8, 2019, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '657.20', '46891.09', '1246.24'),
(21, 9, 2019, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '402.07', '59080.22', '801.65'),
(22, 10, 2019, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '731.40', '26155.47', '915.37'),
(23, 11, 2019, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '146.94', '12158.99', '1227.97'),
(24, 12, 2019, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '6.67', '12937.19', '1210.26'),
(25, 1, 2020, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '6.67', '7784.59', '959.77'),
(26, 2, 2020, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '133.02', '34190.79', '1380.05'),
(27, 3, 2020, '2021-03-15 17:18:00', '2021-03-15 17:18:00', '88.88', '29477.89', '1224.85');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nama` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator@mail.com', '$2y$10$Ml4LuIVE6BooaN0ZtvNH1.wunPqAzfWPAuj27VFv.5MN0y.C.MJa2', NULL, NULL, '2021-02-10 15:18:47', '2021-02-10 15:27:11'),
(2, 'Inant Kharisma', 'inant.kharisma@gmail.com', '$2y$10$wrF9M2h32.lsjZ3Bm1Wd4eFcPdvUBqFL4Ot9I56A2UGnY1tQ7yk.q', NULL, NULL, '2021-02-13 07:25:48', '2021-06-20 08:49:06');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `biaya_tenaga_kerja`
--
ALTER TABLE `biaya_tenaga_kerja`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `hasil_produksi`
--
ALTER TABLE `hasil_produksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pemakaian_barang_jadi`
--
ALTER TABLE `pemakaian_barang_jadi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemakaian_sparepart`
--
ALTER TABLE `pemakaian_sparepart`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembelian_bahan_baku`
--
ALTER TABLE `pembelian_bahan_baku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembelian_sparepart`
--
ALTER TABLE `pembelian_sparepart`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `stock_opname`
--
ALTER TABLE `stock_opname`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `biaya_tenaga_kerja`
--
ALTER TABLE `biaya_tenaga_kerja`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `hasil_produksi`
--
ALTER TABLE `hasil_produksi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `pemakaian_barang_jadi`
--
ALTER TABLE `pemakaian_barang_jadi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `pemakaian_sparepart`
--
ALTER TABLE `pemakaian_sparepart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `pembelian_bahan_baku`
--
ALTER TABLE `pembelian_bahan_baku`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `pembelian_sparepart`
--
ALTER TABLE `pembelian_sparepart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `stock_opname`
--
ALTER TABLE `stock_opname`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
