-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jan 2024 pada 03.14
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud_siakad`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dosen`
--

CREATE TABLE `tb_dosen` (
  `nidn` char(10) NOT NULL,
  `nama_dosen` varchar(255) DEFAULT NULL,
  `email` char(255) NOT NULL,
  `pendidikan` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jenis_kelamin` varchar(1) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_dosen`
--

INSERT INTO `tb_dosen` (`nidn`, `nama_dosen`, `email`, `pendidikan`, `alamat`, `jenis_kelamin`, `foto`) VALUES
('1234567890', 'Michael', 'dosen@gmail.com', 'S3 Sistem Informasi', 'Mataram', 'L', 'foto4.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_khs`
--

CREATE TABLE `tb_khs` (
  `id` int(11) NOT NULL,
  `nim` char(7) NOT NULL,
  `kode_mk` char(5) NOT NULL,
  `semester` int(2) NOT NULL,
  `nilai` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_khs`
--

INSERT INTO `tb_khs` (`id`, `nim`, `kode_mk`, `semester`, `nilai`) VALUES
(1, '20TI001', '10008', 7, ''),
(2, '20TI001', '10009', 7, ''),
(3, '20TI001', '10010', 7, ''),
(4, '20TI001', '10011', 7, ''),
(5, '20TI001', '10012', 7, ''),
(6, '20TI001', '10013', 7, ''),
(7, '20TI001', '10014', 7, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `nim` char(7) NOT NULL,
  `nama_mahasiswa` varchar(255) DEFAULT NULL,
  `email` char(255) NOT NULL,
  `prodi` varchar(255) DEFAULT NULL,
  `semester` int(2) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jenis_kelamin` varchar(1) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`nim`, `nama_mahasiswa`, `email`, `prodi`, `semester`, `alamat`, `jenis_kelamin`, `foto`) VALUES
('20TI001', 'William', 'mahasiswa@gmail.com', 'Teknik Informatika', 7, 'Mataram', 'L', 'foto3.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mengajar`
--

CREATE TABLE `tb_mengajar` (
  `id` int(11) NOT NULL,
  `nidn` char(10) NOT NULL,
  `kode_mk` char(5) NOT NULL,
  `semester` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_mengajar`
--

INSERT INTO `tb_mengajar` (`id`, `nidn`, `kode_mk`, `semester`) VALUES
(1, '1234567890', '10010', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mk`
--

CREATE TABLE `tb_mk` (
  `kode_mk` char(5) NOT NULL,
  `nama_mk` varchar(255) DEFAULT NULL,
  `sks` int(1) DEFAULT NULL,
  `semester` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_mk`
--

INSERT INTO `tb_mk` (`kode_mk`, `nama_mk`, `sks`, `semester`) VALUES
('10001', 'Simulasi dan Pemodelan', 2, 'Genap'),
('10002', 'Memimpin Pemrograman Komputer', 2, 'Genap'),
('10003', 'Statistika dan Probabilitas', 3, 'Genap'),
('10004', 'Riset Teknologi Informasi', 3, 'Genap'),
('10005', 'Hukum dan Etika Profesi TI', 3, 'Genap'),
('10006', 'Kerangka Kerja Web', 3, 'Genap'),
('10007', 'Pengembangan Komputasi Awan', 3, 'Genap'),
('10008', 'Sistem Forensik Digital', 3, 'Ganjil'),
('10009', 'Komputasi Paralel dan Terdistribusi', 3, 'Ganjil'),
('10010', 'Aplikasi Web dan Perangkat Bergerak', 3, 'Ganjil'),
('10011', 'Desain Web Interaktif', 3, 'Ganjil'),
('10012', 'Kreatif Digital', 3, 'Ganjil'),
('10013', 'Keamanan Informasi', 3, 'Ganjil'),
('10014', 'E-Commerce', 2, 'Ganjil');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `email` char(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`email`, `password`, `level`, `nama_lengkap`) VALUES
('admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'Alfian Hidayat'),
('dosen@gmail.com', 'caf1a3dfb505ffed0d024130f58c5cfa', 'Dosen', 'Michael'),
('mahasiswa@gmail.com', '202cb962ac59075b964b07152d234b70', 'Mahasiswa', 'William');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_dosen`
--
ALTER TABLE `tb_dosen`
  ADD PRIMARY KEY (`nidn`);

--
-- Indeks untuk tabel `tb_khs`
--
ALTER TABLE `tb_khs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `tb_mengajar`
--
ALTER TABLE `tb_mengajar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_mk`
--
ALTER TABLE `tb_mk`
  ADD PRIMARY KEY (`kode_mk`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_khs`
--
ALTER TABLE `tb_khs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_mengajar`
--
ALTER TABLE `tb_mengajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
