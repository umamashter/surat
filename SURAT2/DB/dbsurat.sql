-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Nov 2023 pada 07.02
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsurat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_surat`
--

CREATE TABLE `file_surat` (
  `id_file` int(11) NOT NULL,
  `surat_id` int(11) NOT NULL,
  `nama_file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `file_surat`
--

INSERT INTO `file_surat` (`id_file`, `surat_id`, `nama_file`) VALUES
(27, 11, '1524-Article Text-5999-1-10-20230524.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_surat_k`
--

CREATE TABLE `file_surat_k` (
  `id_file_sk` int(11) NOT NULL,
  `sk_id` int(11) NOT NULL,
  `nama_file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `file_surat_k`
--

INSERT INTO `file_surat_k` (`id_file_sk`, `sk_id`, `nama_file`) VALUES
(34, 10, '11.+Endang+Amalia.pdf'),
(36, 12, '21964-61740-1-PB.pdf'),
(37, 11, '1524-Article Text-5999-1-10-20230524.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ajukan`
--

CREATE TABLE `tb_ajukan` (
  `id_ajukan` int(11) NOT NULL,
  `pg_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_ajukan`
--

INSERT INTO `tb_ajukan` (`id_ajukan`, `pg_id`) VALUES
(7, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_arsip_surat`
--

CREATE TABLE `tb_arsip_surat` (
  `id_arsip` int(11) NOT NULL,
  `sm_id` int(11) NOT NULL,
  `sk_id` int(11) NOT NULL,
  `tgl_arsip` date NOT NULL,
  `lokasi_arsip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_arsip_surat`
--

INSERT INTO `tb_arsip_surat` (`id_arsip`, `sm_id`, `sk_id`, `tgl_arsip`, `lokasi_arsip`) VALUES
(12, 0, 10, '2023-11-30', 'Rak 2'),
(13, 11, 0, '2023-11-30', 'Rak 2'),
(14, 0, 12, '2023-11-30', 'Rak 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_disposisi`
--

CREATE TABLE `tb_disposisi` (
  `id_disposisi` int(11) NOT NULL,
  `sm_id` int(11) NOT NULL,
  `tujuan_disposisi` varchar(50) NOT NULL,
  `catatan` text NOT NULL,
  `status_dispo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_disposisi`
--

INSERT INTO `tb_disposisi` (`id_disposisi`, `sm_id`, `tujuan_disposisi`, `catatan`, `status_dispo`) VALUES
(8, 11, 'Bagian Umum', 'Dipahami<br>Arsip<br>Segera', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori_s` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori_s`) VALUES
(1, 'Surat Resmi'),
(2, 'Surat Pribadi'),
(3, 'Surat Bisnis'),
(4, 'Surat Lamaran Pekerjaan'),
(5, 'Surat Izin atau Permohonan'),
(6, 'Surat Resmi Pemerintah'),
(7, 'Surat Berita'),
(8, 'Surat Perjanjian'),
(9, 'Surat Resmi Sekolah atau Universitas'),
(10, 'Surat Pengaduan atau Keluhan'),
(11, 'Surat Tugas atau Perintah'),
(12, 'Surat Pemberitahuan Perubahan Informasi'),
(13, 'Surat Undangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id_pg` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(80) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `izin_akses` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pg`, `username`, `password`, `nama_lengkap`, `jabatan`, `izin_akses`, `foto`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Aan Danu', 'ADMIN', 'Admin', 'man.png'),
(2, 'pimpinan', '90973652b88fe07d05a4304f0a945de8', 'Pak Karmi, SH', 'Kepala', 'Pimpinan', 'boy.png'),
(4, 'netti', '7333131b824d2871bfb0bdbde485aeaf', 'Buk Netti, S.M', 'Sekretaris', 'Sekretaris', 'girl.png'),
(5, 'dina', 'e274648aed611371cf5c30a30bbe1d65', 'Dina', 'Bagian Umum', 'Petugas', 'girl.png'),
(6, 'bagian1', '91f9ebb4b3931170b9ae9f88f75bb427', 'Bagian1', 'Bagian1', 'Petugas', 'boy.png'),
(7, 'bagian2', '8bdf85399738ee3f92caebfa279100f5', 'Bagian2', 'Bagian2', 'Petugas', 'man.png'),
(8, 'zainal', '5486718b3496396344b004e2fb6eabda', 'Pak Zainal', 'BENDAHARA', 'Petugas', 'boy.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sk`
--

CREATE TABLE `tb_sk` (
  `id_sk` int(11) NOT NULL,
  `nomor_agenda` varchar(50) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nomor_sk` varchar(50) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `tgl_sk` date NOT NULL,
  `penerima_sk` varchar(50) NOT NULL,
  `perihal_sk` varchar(50) NOT NULL,
  `lampiran_sk` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `tindakan` text NOT NULL,
  `berkas_kesalahan` text NOT NULL,
  `dari_disposisi` varchar(80) NOT NULL,
  `status_arsip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_sk`
--

INSERT INTO `tb_sk` (`id_sk`, `nomor_agenda`, `kode`, `nomor_sk`, `tgl_keluar`, `tgl_sk`, `penerima_sk`, `perihal_sk`, `lampiran_sk`, `status`, `tindakan`, `berkas_kesalahan`, `dari_disposisi`, `status_arsip`) VALUES
(10, '001', '289', 'JKCB-175/DNXE/649-BRW', '2023-11-30', '2023-11-30', 'DESA TITI PUTIH', 'Pemberitahuan Resmi', '1 Lampiran', 3, 'KIRIM BERKAS', '', '6', 1),
(11, '002', '494', 'YWJP-399/WXTX/607-CNJ', '2023-11-30', '2023-11-30', 'DESA GAJAH', 'Undangan Rapat', '1 Lampiran', 1, 'CEK KEMBALI', '', '6', 0),
(12, '003', '345', 'FXVQ-229/ULUH/228-EKU', '2023-11-30', '2023-11-30', 'DESA ITU', 'Undangan Rapat', '1 Lampiran', 3, 'KIRIM BERKAS', '', '5', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sm`
--

CREATE TABLE `tb_sm` (
  `id_sm` int(11) NOT NULL,
  `nomor_agenda` varchar(50) NOT NULL,
  `kode_sm` varchar(50) NOT NULL,
  `nomor_sm` varchar(80) NOT NULL,
  `tgl_surat` date DEFAULT NULL,
  `tgl_sm` date NOT NULL,
  `kategori` int(11) NOT NULL,
  `pengirim` varchar(80) NOT NULL,
  `perihal_surat` varchar(50) NOT NULL,
  `lampiran` varchar(50) NOT NULL,
  `disposisi` varchar(80) NOT NULL,
  `status` int(11) NOT NULL,
  `status_baca` int(11) NOT NULL,
  `tindakan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_sm`
--

INSERT INTO `tb_sm` (`id_sm`, `nomor_agenda`, `kode_sm`, `nomor_sm`, `tgl_surat`, `tgl_sm`, `kategori`, `pengirim`, `perihal_surat`, `lampiran`, `disposisi`, `status`, `status_baca`, `tindakan`) VALUES
(11, '001', '243', 'DDBVJ-JS89/XJCB90', '2023-11-30', '2023-11-29', 1, 'DESA INI', 'Pemberitahuan Resmi', '1 Lampiran', 'Dina', 3, 1, 'SEGERA');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `file_surat`
--
ALTER TABLE `file_surat`
  ADD PRIMARY KEY (`id_file`);

--
-- Indeks untuk tabel `file_surat_k`
--
ALTER TABLE `file_surat_k`
  ADD PRIMARY KEY (`id_file_sk`);

--
-- Indeks untuk tabel `tb_ajukan`
--
ALTER TABLE `tb_ajukan`
  ADD PRIMARY KEY (`id_ajukan`);

--
-- Indeks untuk tabel `tb_arsip_surat`
--
ALTER TABLE `tb_arsip_surat`
  ADD PRIMARY KEY (`id_arsip`);

--
-- Indeks untuk tabel `tb_disposisi`
--
ALTER TABLE `tb_disposisi`
  ADD PRIMARY KEY (`id_disposisi`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id_pg`);

--
-- Indeks untuk tabel `tb_sk`
--
ALTER TABLE `tb_sk`
  ADD PRIMARY KEY (`id_sk`);

--
-- Indeks untuk tabel `tb_sm`
--
ALTER TABLE `tb_sm`
  ADD PRIMARY KEY (`id_sm`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `file_surat`
--
ALTER TABLE `file_surat`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `file_surat_k`
--
ALTER TABLE `file_surat_k`
  MODIFY `id_file_sk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `tb_ajukan`
--
ALTER TABLE `tb_ajukan`
  MODIFY `id_ajukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_arsip_surat`
--
ALTER TABLE `tb_arsip_surat`
  MODIFY `id_arsip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_disposisi`
--
ALTER TABLE `tb_disposisi`
  MODIFY `id_disposisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id_pg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_sk`
--
ALTER TABLE `tb_sk`
  MODIFY `id_sk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_sm`
--
ALTER TABLE `tb_sm`
  MODIFY `id_sm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
