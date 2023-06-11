-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jun 2023 pada 10.55
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventori`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_list_barang`
--

CREATE TABLE `detail_list_barang` (
  `dbid` int(10) UNSIGNED NOT NULL,
  `mbid` int(11) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `detail_list_barang`
--

INSERT INTO `detail_list_barang` (`dbid`, `mbid`, `nama_barang`, `jumlah`, `status`) VALUES
(5, 17, 'lemari', 12, 0),
(6, 17, 'kulkas', 1, 0),
(12, 19, 'dasd', 12, 0),
(13, 19, 'dasd', 12, 0),
(14, 20, 'Lemari', 12, 0),
(15, 20, 'tanggal', 22, 0),
(16, 21, 'asdasd', 12, 0),
(17, 21, 'asdasd', 12, 0),
(18, 21, 'asdasd', 12, 0),
(19, 23, 'ljgjgj', 14, 0),
(20, 23, 'ljgjgj', 12, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hmenu`
--

CREATE TABLE `hmenu` (
  `hid` int(10) UNSIGNED NOT NULL,
  `nama_head` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `hmenu`
--

INSERT INTO `hmenu` (`hid`, `nama_head`, `deskripsi`, `urutan`, `active`) VALUES
(1, 'Dashboard', 'Dashboard', 1, 1),
(5, 'Setting', 'Setting', 2, 1),
(6, 'Transaksi', 'Transaksi', 3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `list_barang`
--

CREATE TABLE `list_barang` (
  `lbid` int(10) UNSIGNED NOT NULL,
  `hari` varchar(100) DEFAULT NULL,
  `tanggal` varchar(100) DEFAULT NULL,
  `jam` varchar(50) DEFAULT NULL,
  `menit` varchar(50) DEFAULT NULL,
  `dari` text DEFAULT NULL,
  `untuk` text DEFAULT NULL,
  `pemberi` varchar(100) DEFAULT NULL,
  `penerima` varchar(100) DEFAULT NULL,
  `penyedia` varchar(100) DEFAULT NULL,
  `pemberi_waktu` varchar(225) DEFAULT NULL,
  `penerima_waktu` varchar(225) DEFAULT NULL,
  `penyedia_waktu` varchar(225) DEFAULT NULL,
  `no_pemberi` varchar(12) DEFAULT NULL,
  `no_penerima` varchar(12) DEFAULT NULL,
  `no_penyedia` varchar(12) DEFAULT NULL,
  `simpan` datetime DEFAULT NULL,
  `keluar` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `list_barang`
--

INSERT INTO `list_barang` (`lbid`, `hari`, `tanggal`, `jam`, `menit`, `dari`, `untuk`, `pemberi`, `penerima`, `penyedia`, `pemberi_waktu`, `penerima_waktu`, `penyedia_waktu`, `no_pemberi`, `no_penerima`, `no_penyedia`, `simpan`, `keluar`) VALUES
(17, 'selasa', '2023-05-28', '12', '24', 'jl.sukabumi', 'jl.sukasaya', 'pemberi testing', 'gggg', 'penyedia', '2023-05-28 10:21:45', '2023-05-28 12:34:31', '2023-06-04 06:55:09', NULL, NULL, NULL, NULL, NULL),
(19, 'jumat', '2023-06-06', '06', '07', 'saddd', 'asdddasd', 'pemberi', 'Joko Ardilah', 'penyedia', '2023-06-04 10:43:42', '2023-06-04 11:23:26', '2023-06-04 11:24:54', '081233121', '081297121121', '081234231123', NULL, NULL),
(20, 'kamis', '2023-06-14', '08', '07', 'dari ufuk timur', 'hingga ke ufuk barat ', 'joko', 'yanto', 'yanto', '2023-06-10 07:56:23', '2023-06-10 07:57:37', '2023-06-10 07:58:06', '081231231222', '08123212', '08321221221', NULL, NULL),
(21, 'selasa', '2023-06-10', '07', '08', 'BDABSD', 'SDASD', 'pppp', 'eeee', 'hhhhh', '2023-06-10 08:08:22', '2023-06-10 08:08:35', '2023-06-10 08:11:10', '081231', '0812331', '97666', NULL, NULL),
(22, 'selasa', '2023-06-10', '07', '08', 'BDABSD', 'SDASD', 'pppp', 'eeee', 'teasd', '2023-06-10 08:08:22', '2023-06-10 08:08:35', '2023-06-10 08:31:48', '081231', '0812331', '12300123', '2023-06-10 08:31:48', NULL),
(23, 'senin', '2023-06-20', '07', '05', 'dggdgg', 'jjjj', 'jjjjjh', 'trtfff', 'asddfd', '2023-06-11 08:04:17', '2023-06-11 08:04:30', '2023-06-11 08:05:22', '0886555788', '087554567', '088643', '2023-06-11 08:05:22', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `mid` int(10) UNSIGNED NOT NULL,
  `hid` int(11) DEFAULT NULL,
  `nama_menu` varchar(100) DEFAULT NULL,
  `href` text DEFAULT NULL,
  `icon` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`mid`, `hid`, `nama_menu`, `href`, `icon`, `deskripsi`, `urutan`, `active`) VALUES
(1, 1, 'Dashboard', '/', 'fas fa-fw fa-tachometer-alt', 'Dashboard > Dashboard', 1, 1),
(2, 5, 'Menus', '#', 'fas fa-bars', 'Setting >  Menus', 1, 1),
(3, 5, 'Akses', '#', 'fas fa-universal-access', 'Setting >Akses', 2, 1),
(4, 6, 'Barang Masuk', '#', 'fas fa-people-carry', 'Transaksi > Barang Masuk', 1, 1),
(5, 6, 'Barang Keluar', '#', 'fas fa-truck-loading', 'Transaksi > Barang Keluar', 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-04-19-070933', 'App\\Database\\Migrations\\Hmenu', 'default', 'App', 1681891624, 1),
(2, '2023-04-19-080847', 'App\\Database\\Migrations\\Menu', 'default', 'App', 1681892047, 2),
(3, '2023-04-19-081440', 'App\\Database\\Migrations\\Submenu', 'default', 'App', 1681892167, 3),
(4, '2023-05-20-010233', 'App\\Database\\Migrations\\ListBarang', 'default', 'App', 1684548192, 4),
(5, '2023-05-20-010310', 'App\\Database\\Migrations\\DlistBarang', 'default', 'App', 1684548192, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `submenu`
--

CREATE TABLE `submenu` (
  `smid` int(10) UNSIGNED NOT NULL,
  `mid` int(11) DEFAULT NULL,
  `hid` int(11) DEFAULT NULL,
  `nama_submenu` varchar(100) DEFAULT NULL,
  `href` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `submenu`
--

INSERT INTO `submenu` (`smid`, `mid`, `hid`, `nama_submenu`, `href`, `deskripsi`, `urutan`, `active`) VALUES
(1, 2, 5, 'Header Menu', '/hmenu', 'Setting > Menus > Header Menu', 1, 1),
(2, 2, 5, 'Menu', '/menu', 'Setting > Menus > Menu', 2, 1),
(3, 2, 5, 'Sub Menu', '/smenu', 'Setting > Menus > Sub Menu', 3, 1),
(4, 4, 6, 'List Barang Di Terima', '/list_barang', 'Transaksi > Barang Masuk > List Barang', 1, 1),
(5, 4, 6, 'approve penyedia', '/terima_barang', 'Transaksi > Barang Masuk > Accept Barang Masuk', 2, 1),
(6, 3, 5, 'User', '/user', 'Setting > Akses > User', 1, 1),
(7, 5, 6, 'Ceklist Barang Keluar', '/ceklist_barang_keluar', 'Transaksi > Barang Keluar > Ceklist Barang Keluar', 1, 1),
(8, 5, 6, 'Serah Barang Keluar', '/serah_barang_keluar', 'Transaksi > Barang Keluar > Serah Barang', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_list_barang`
--
ALTER TABLE `detail_list_barang`
  ADD PRIMARY KEY (`dbid`);

--
-- Indeks untuk tabel `hmenu`
--
ALTER TABLE `hmenu`
  ADD PRIMARY KEY (`hid`);

--
-- Indeks untuk tabel `list_barang`
--
ALTER TABLE `list_barang`
  ADD PRIMARY KEY (`lbid`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`mid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`smid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_list_barang`
--
ALTER TABLE `detail_list_barang`
  MODIFY `dbid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `hmenu`
--
ALTER TABLE `hmenu`
  MODIFY `hid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `list_barang`
--
ALTER TABLE `list_barang`
  MODIFY `lbid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `mid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `submenu`
--
ALTER TABLE `submenu`
  MODIFY `smid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
