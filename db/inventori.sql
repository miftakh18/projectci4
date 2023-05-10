-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Bulan Mei 2023 pada 15.19
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

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
(3, '2023-04-19-081440', 'App\\Database\\Migrations\\Submenu', 'default', 'App', 1681892167, 3);

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
(4, 4, 6, 'List Barang', '/terima_barang', 'Transaksi > Barang Masuk > List Barang', 1, 1),
(5, 4, 6, 'Terima Barang Masuk', '/accept_barang_masuk', 'Transaksi > Barang Masuk > Accept Barang Masuk', 2, 1),
(6, 3, 5, 'User', '/user', 'Setting > Akses > User', 1, 1),
(7, 5, 6, 'Ceklist Barang Keluar', '/ceklist_barang_keluar', 'Transaksi > Barang Keluar > Ceklist Barang Keluar', 1, 1),
(8, 5, 6, 'Serah Barang Keluar', '/serah_barang_keluar', 'Transaksi > Barang Keluar > Serah Barang', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hmenu`
--
ALTER TABLE `hmenu`
  ADD PRIMARY KEY (`hid`);

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
-- AUTO_INCREMENT untuk tabel `hmenu`
--
ALTER TABLE `hmenu`
  MODIFY `hid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `mid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `submenu`
--
ALTER TABLE `submenu`
  MODIFY `smid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
