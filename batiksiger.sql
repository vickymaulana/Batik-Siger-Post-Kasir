-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jan 2024 pada 09.15
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `batiksiger`;

USE `batiksiger`;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `batiksiger`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `databarang`
--

CREATE TABLE `databarang` (
  `id` int(11) NOT NULL,
  `jenis_teknik` varchar(255) NOT NULL,
  `jenis_pewarna` varchar(255) NOT NULL,
  `jenis_kain` varchar(255) NOT NULL,
  `ukuran_kain_panjang` int(11) NOT NULL,
  `ukuran_baju_satuan` varchar(255) NOT NULL,
  `ukuran_kain_lebar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `databarang`
--

INSERT INTO `databarang` (`id`, `jenis_teknik`, `jenis_pewarna`, `jenis_kain`, `ukuran_kain_panjang`, `ukuran_baju_satuan`, `ukuran_kain_lebar`) VALUES
(1, 'Batik Tulis/Cap', 'Sintetik', 'primisima kupu-kupu', 200, 'S', 110),
(2, 'Batik Tulis/Cap', 'Sintetik', 'primisima kupu-kupu', 200, 'S', 110),
(3, 'Batik Tulis/Cap', 'Sintetik', 'primisima kupu-kupu', 200, 'S', 110),
(4, 'Batik Tulis/Cap', 'Alami Indigovera', 'primisima kupu-kupu', 200, 'S', 110);

-- --------------------------------------------------------

--
-- Struktur dari tabel `formtransaksi`
--

CREATE TABLE `formtransaksi` (
  `kode_transaksi` varchar(255) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `namapelanggan` varchar(255) DEFAULT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `satuan` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `metodepembayaran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `formtransaksi`
--

INSERT INTO `formtransaksi` (`kode_transaksi`, `tanggal`, `namapelanggan`, `nama_produk`, `kategori`, `qty`, `satuan`, `stock`, `harga`, `total_harga`, `metodepembayaran`) VALUES
('BS-1', '2024-01-25', NULL, 'testing', 'jenispewarna', 50, 'pcs', 5000, 50000.00, 2500000.00, 'CASH'),
('BS-2', '2024-01-24', NULL, 'testing2', 'jenisteknik', 700, 'meter', 500, 130000.00, 91000000.00, 'BANK LAMPUNG'),
('BS-3', '2024-01-10', 'template', 'template1', 'jenisteknik', 50, 'pcs', 50, 50000.00, 2500000.00, 'CASH');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `databarang`
--
ALTER TABLE `databarang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `formtransaksi`
--
ALTER TABLE `formtransaksi`
  ADD PRIMARY KEY (`kode_transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `databarang`
--
ALTER TABLE `databarang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
