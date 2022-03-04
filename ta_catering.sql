-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Des 2019 pada 17.33
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta_catering`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `off` int(11) NOT NULL,
  `online` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `id_user`, `start`, `off`, `online`) VALUES
(68, 7, 1575450853, 1575451041, 0),
(118, 7, 1575539995, 1575540997, 0),
(125, 10, 1575451627, 1575452225, 0),
(587, 11, 1575553881, 1575555623, 0),
(601, 8, 1575450782, 1575450792, 0),
(698, 4, 1575561480, 1575561715, 0),
(1513, 11, 1575539399, 1575539988, 0),
(1905, 4, 1575479102, 1575479305, 0),
(2158, 7, 1575452804, 1575452874, 0),
(2383, 7, 1575471087, 1575471139, 0),
(2455, 10, 1575471555, 1575474337, 0),
(2629, 7, 1575452231, 1575452759, 0),
(2767, 7, 1575556152, 1575556727, 0),
(3248, 2, 1575879138, 1575881026, 0),
(3312, 4, 1575636965, 1575650231, 0),
(3332, 7, 1575881973, 1575882067, 0),
(3375, 7, 1575390391, 1575390484, 0),
(3513, 10, 1575882075, 0, 0),
(3601, 7, 1575628406, 1575636958, 0),
(3645, 7, 1575450800, 1575450814, 0),
(3658, 4, 1575451530, 1575451616, 0),
(3674, 7, 1575993101, 1575995062, 0),
(3764, 4, 1575561382, 1575561467, 0),
(3926, 2, 1575899937, 1575899964, 0),
(3996, 8, 1575451052, 1575451129, 0),
(4097, 4, 1575471144, 1575471153, 0),
(4116, 8, 1575450824, 1575450841, 0),
(4166, 10, 1575452881, 1575452987, 0),
(4267, 4, 1575406082, 1575406098, 0),
(4418, 4, 1575452769, 1575452796, 0),
(4425, 7, 1575724623, 0, 0),
(4564, 10, 1575881036, 1575881965, 0),
(4802, 10, 1575538257, 1575539231, 0),
(4896, 7, 1575471160, 1575471548, 0),
(4952, 10, 1575536918, 1575537241, 0),
(5219, 4, 1575992302, 1575993095, 0),
(5510, 11, 1575537296, 1575538035, 0),
(5653, 10, 1575538131, 1575538156, 0),
(5854, 7, 1575452995, 1575453421, 0),
(6170, 7, 1575541191, 1575541439, 0),
(6173, 5, 1575406110, 1575406189, 0),
(6652, 11, 1575538235, 1575538251, 0),
(6679, 11, 1575541573, 1575542439, 0),
(6873, 4, 1575989726, 1575992254, 0),
(6901, 5, 1575406024, 1575406074, 0),
(7013, 4, 1575451142, 1575451488, 0),
(7108, 10, 1575969684, 1575989718, 0),
(7137, 10, 1575539238, 1575539255, 0),
(7147, 7, 1575909571, 0, 1),
(7175, 7, 1575555629, 1575555658, 0),
(7498, 7, 1575650239, 0, 1),
(7502, 4, 1575541004, 1575541184, 0),
(7573, 11, 1575539263, 1575539273, 0),
(7624, 11, 1575555668, 1575556146, 0),
(7633, 10, 1575476011, 1575479095, 0),
(7796, 7, 1575992262, 1575992296, 0),
(8362, 11, 1575561474, 1575561476, 0),
(8528, 7, 1575538047, 1575538122, 0),
(8616, 4, 1575537277, 1575537286, 0),
(8654, 7, 1575383869, 1575389995, 0),
(8700, 10, 1575539280, 1575539391, 0),
(8787, 7, 1575715662, 0, 0),
(8924, 4, 1575405210, 1575406013, 0),
(8975, 11, 1575556734, 1575561377, 0),
(9038, 2, 1575995080, 1575995082, 0),
(9228, 2, 1575541451, 1575541454, 0),
(9523, 4, 1575474343, 1575475161, 0),
(9541, 4, 1575906845, 1575908258, 0),
(9729, 10, 1575995103, 0, 0),
(9776, 10, 1575899971, 1575906838, 0),
(22139, 8, 1575390926, 1575393786, 0),
(23929, 8, 1575390054, 1575390311, 0),
(25116, 8, 1575390491, 1575390691, 0),
(28291, 1, 1575405057, 1575405204, 0),
(32821, 7, 1575298081, 1575298103, 0),
(38831, 2, 1575298607, 1575298639, 0),
(43406, 7, 1575390868, 1575390917, 0),
(43856, 4, 1575298654, 1575300662, 0),
(47396, 7, 1575393792, 1575404345, 0),
(47575, 4, 1575404941, 1575405051, 0),
(51826, 7, 1575298017, 1575298047, 0),
(64172, 8, 1575404767, 1575404934, 0),
(74563, 8, 1575404355, 1575404722, 0),
(76147, 4, 1575300672, 1575304530, 0),
(91246, 7, 1575404728, 1575404760, 0),
(95716, 4, 1575298127, 1575298571, 0),
(99668, 7, 1575304538, 1575305218, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dompet`
--

CREATE TABLE `dompet` (
  `id` int(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `pin` varchar(256) NOT NULL,
  `saldo` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dompet`
--

INSERT INTO `dompet` (`id`, `user_id`, `email`, `pin`, `saldo`, `date_created`) VALUES
(1, '7', 'muliamc241@gmail.com', '$2y$10$a3MhXG5VvvjIdWA3kv9TweonMLgN5Cp9jo8MFHbJ1p6Qic9YsJZca', 4010000, 1574354264),
(4, '2', 'srahmat456@gmail.com', '$2y$10$wBLyBIISA8thBx3RSoJfPuvHimvKnAbW/7v3zFXDgLN7yBdvoSgwS', 934000, 1574610225),
(5, '5', 'muliaadhasiregar241@gmail.com', '$2y$10$XiKPTZKT7mPcfEwArCPlZONfB1e6finw2vu6mEYmVrwpLFU77GAxC', 2000000, 1574610284);

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(11) NOT NULL,
  `image` varchar(256) NOT NULL,
  `tipe` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `image`, `tipe`) VALUES
(1, 'file_1572474314.jpg', '1'),
(2, 'file_1572474326.jpg', '1'),
(3, 'file_1572474338.jpg', '1'),
(4, 'file_1572474349.jpg', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `iklan`
--

CREATE TABLE `iklan` (
  `id` int(11) NOT NULL,
  `image` varchar(128) NOT NULL,
  `tipe` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `iklan`
--

INSERT INTO `iklan` (`id`, `image`, `tipe`) VALUES
(1, 'file_1572529827.jpg', '2'),
(2, 'file_1573568571.png', '2'),
(3, 'file_1573568676.png', '2'),
(4, 'file_1573568752.png', '2'),
(5, 'file_1573568886.png', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE `invoice` (
  `id_invoice` int(11) NOT NULL,
  `no_invoice` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `last_nama` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `no_hp` varchar(128) NOT NULL,
  `kecamatan` varchar(128) NOT NULL,
  `kode_pos` varchar(128) NOT NULL,
  `tgl_acara` date NOT NULL,
  `total` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `invoice`
--

INSERT INTO `invoice` (`id_invoice`, `no_invoice`, `nama`, `last_nama`, `alamat`, `no_hp`, `kecamatan`, `kode_pos`, `tgl_acara`, `total`, `date_created`) VALUES
(1, 1623, 'mulia', 'siregar', 'jalan flamboyan', '081212345678', 'medan tuntungan', '20135', '2020-01-20', 8250000, 1575538111),
(2, 99219, 'Mulia Adha', 'Siregar', 'jalan flamboyan', '089612345678', 'medan tuntungan', '20135', '2020-01-10', 11000000, 1575882008);

-- --------------------------------------------------------

--
-- Struktur dari tabel `isi_saldo`
--

CREATE TABLE `isi_saldo` (
  `id_isisaldo` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `image` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `katagori`
--

CREATE TABLE `katagori` (
  `id` int(11) NOT NULL,
  `nama_katagori` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `katagori`
--

INSERT INTO `katagori` (`id`, `nama_katagori`) VALUES
(1, 'Pernikahan'),
(2, 'Ulang Tahun'),
(3, 'Kost');

-- --------------------------------------------------------

--
-- Struktur dari tabel `katagori_galeri`
--

CREATE TABLE `katagori_galeri` (
  `id` int(11) NOT NULL,
  `nama_katagori` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `katagori_galeri`
--

INSERT INTO `katagori_galeri` (`id`, `nama_katagori`) VALUES
(1, 'slide'),
(2, 'iklan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `user` varchar(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `price` int(11) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `qty` int(11) NOT NULL,
  `no_invoice` int(11) NOT NULL,
  `id_mitra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `user`, `product_id`, `name`, `price`, `gambar`, `qty`, `no_invoice`, `id_mitra`) VALUES
(1, '1630', 72, 'Paket Wedding Hemat', 7500000, 'Product_id_1575538021.jpg', 1, 1623, 11),
(2, '99226', 71, 'Paket Komplit', 10000000, 'Product_1575478711.jpg', 1, 99219, 10),
(3, '2', 21, 'Paket Komplit', 10000000, 'Product_1575478711.jpg', 1, 90076, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `makanan`
--

CREATE TABLE `makanan` (
  `product_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `nama_catering` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `makanan`
--

INSERT INTO `makanan` (`product_id`, `nama`, `harga`, `kategori`, `image`, `deskripsi`, `nama_catering`) VALUES
(1, 'Paket Komplit', 10000000, '1', 'Product_1575478711.jpg', '<p>Isi Paket:</p><ol><li>Nasi Putih</li><li>Chicken Terriyaki</li><li>Soup Ayam Telur Puyuh</li><li>Dendeng Dua Rasa ( Cabe Merah &amp; Cabe Ijo )</li><li>Sambal Goreng Kentang Ati</li><li>Capcay Goreng Seafood</li><li>Kerupuk Udang</li><li>Fruit Salad / Mixed Salad / Asinan</li><li>Aneka Buah Potong</li><li>Es Lemon Tea</li><li>Aneka Puding</li><li>Juice / Softdrink / Cocktail / Es Melon Nata De coco</li></ol><p>Ongkir free</p><p>&nbsp;</p>', '10'),
(2, 'Paket Wedding Hemat', 7500000, '1', 'Product_id_1575538021.jpg', '<p>Isi Paket : 1000 Porsi</p><ol><li>Soup Ayam Jamur</li><li>Ayam Goreng Mentega</li><li>Beef Black Pepper</li><li>Sambal Goreng Kentang Ati</li><li>Aneka Puding</li><li>Ayam Pang. Bumbu Pedas</li><li>Cah Brokoli Udang Tofu</li><li>Kerupuk Udang</li><li>Air Mineral</li></ol><p>Gratis Ongkir</p>', '11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `map`
--

CREATE TABLE `map` (
  `id` int(11) NOT NULL,
  `no_invoice` int(11) NOT NULL,
  `lat` varchar(128) NOT NULL,
  `lang` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `map`
--

INSERT INTO `map` (`id`, `no_invoice`, `lat`, `lang`) VALUES
(1, 99219, '3.543294321675416', '98.60878360802849');

-- --------------------------------------------------------

--
-- Struktur dari tabel `map_mitra`
--

CREATE TABLE `map_mitra` (
  `id` int(11) NOT NULL,
  `id_mitra` int(11) NOT NULL,
  `lat` varchar(128) NOT NULL,
  `lang` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `map_mitra`
--

INSERT INTO `map_mitra` (`id`, `id_mitra`, `lat`, `lang`) VALUES
(3, 10, '3.5772814431921716', '98.70001181357634');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mitra`
--

CREATE TABLE `mitra` (
  `id` int(11) NOT NULL,
  `nama_toko` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `dompet_saldo` int(11) NOT NULL,
  `role_id` int(1) NOT NULL,
  `is_active` varchar(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mitra`
--

INSERT INTO `mitra` (`id`, `nama_toko`, `email`, `image`, `password`, `no_hp`, `dompet_saldo`, `role_id`, `is_active`, `date_created`) VALUES
(10, 'Catering Kiki', 'srahmat456@gmail.com', 'default.jpg', '$2y$10$TAEzOx3Jddy10HBmuOKeGOPSzsEPik6yuZ8NTpuZs.pnawnIyFCDq', '084512341234', 0, 3, '1', 1575451519),
(11, 'Catering Bunda', 'ridho@gmail.com', 'default.jpg', '$2y$10$/NiTKBuM5Rk3HUc48BKwQeDO9Q4/XUaWlKfEqfSL5oZPOCf6hEJje', '082312341234', 8250000, 3, '1', 1575537271);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_mitra` int(11) NOT NULL,
  `invoice` int(32) NOT NULL,
  `email` varchar(128) NOT NULL,
  `total` int(11) NOT NULL,
  `status_pesanan` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `tgl_acara` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_user`, `id_mitra`, `invoice`, `email`, `total`, `status_pesanan`, `date_created`, `tgl_acara`) VALUES
(1, 7, 11, 1623, 'muliamc241@gmail.com', 8250000, 6, 1575538119, '2020-01-20'),
(2, 7, 10, 99219, 'muliamc241@gmail.com', 11000000, 1, 1575882021, '2020-01-10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating`
--

CREATE TABLE `rating` (
  `id_rating` int(11) NOT NULL,
  `id_mitra` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `koment` varchar(256) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rating`
--

INSERT INTO `rating` (`id_rating`, `id_mitra`, `product_id`, `koment`, `rate`) VALUES
(1, 11, 0, 'Komentari Makanan', 5),
(2, 0, 2, '<p>Komentari Makanan</p>', 5),
(3, 11, 0, 'Komentari Makanan', 5),
(4, 11, 0, 'Komentari Makanan', 5),
(5, 11, 2, '<p>Makanan nya enak</p>', 5),
(6, 11, 2, '<p>Komentari Makanan</p>', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpan_biaya`
--

CREATE TABLE `simpan_biaya` (
  `no_invoice` int(11) NOT NULL,
  `id_mitra` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tarik_saldo`
--

CREATE TABLE `tarik_saldo` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `bank` varchar(128) NOT NULL,
  `no_rekening` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `role_id` int(1) NOT NULL,
  `is_active` varchar(1) NOT NULL,
  `toko` varchar(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `image`, `password`, `tgl_lahir`, `no_hp`, `role_id`, `is_active`, `toko`, `date_created`) VALUES
(2, 'Rahmat Setiawan', 'srahmat456@gmail.com', 'default.jpg', '$2y$10$wFwU/G7KdccMT3hvyrHeiufbC2I1HHCP9a.O7hj.5v3JdbR7JhK8m', '1997-10-10', '081212345678', 2, '1', '0', 1572166738),
(3, 'chalid', 'chalidanwarr@gmail.com', 'default.jpg', '$2y$10$Xb6m9LUf5a1lWcsKWXSCh.PXDNTPP/H1bJt/YwmogjrhgCnOnmhmS', '1997-10-10', '085412345678', 2, '1', '0', 1572257717),
(4, 'Admin', 'admin@gmail.com', 'default.jpg', '$2y$10$LAMc37V7ASXRU7AcMhsC3.c.lNMyF74wo1eHHftrzJEEU8udqIJbG', '0000-00-00', '', 1, '1', '0', 1572299117),
(5, 'mulia adha', 'muliaadhasiregar241@gmail.com', 'default.jpg', '$2y$10$s3vUC/TduvnxhyISTu4oE.sVANvtAo5EwTJ2qFKXbqOUhB.miJeZW', '1997-10-10', '082312341234', 2, '1', '0', 1572340860),
(7, 'MuliaMc', 'muliamc241@gmail.com', 'Profil_MuliaMc.gif', '$2y$10$rrZeGL8lbxcA89TqfezMBux7wQtUG6xKEOIKRIq0vXy8oAnmyCqBC', '1997-04-10', '081264250712', 2, '1', '1', 1572367482);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'mitra');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dompet`
--
ALTER TABLE `dompet`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indeks untuk tabel `iklan`
--
ALTER TABLE `iklan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indeks untuk tabel `isi_saldo`
--
ALTER TABLE `isi_saldo`
  ADD PRIMARY KEY (`id_isisaldo`);

--
-- Indeks untuk tabel `katagori`
--
ALTER TABLE `katagori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `katagori_galeri`
--
ALTER TABLE `katagori_galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indeks untuk tabel `makanan`
--
ALTER TABLE `makanan`
  ADD PRIMARY KEY (`product_id`);

--
-- Indeks untuk tabel `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `map_mitra`
--
ALTER TABLE `map_mitra`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indeks untuk tabel `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`);

--
-- Indeks untuk tabel `simpan_biaya`
--
ALTER TABLE `simpan_biaya`
  ADD PRIMARY KEY (`no_invoice`);

--
-- Indeks untuk tabel `tarik_saldo`
--
ALTER TABLE `tarik_saldo`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dompet`
--
ALTER TABLE `dompet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `iklan`
--
ALTER TABLE `iklan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `isi_saldo`
--
ALTER TABLE `isi_saldo`
  MODIFY `id_isisaldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `katagori`
--
ALTER TABLE `katagori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `katagori_galeri`
--
ALTER TABLE `katagori_galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `makanan`
--
ALTER TABLE `makanan`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `map`
--
ALTER TABLE `map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `map_mitra`
--
ALTER TABLE `map_mitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `rating`
--
ALTER TABLE `rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tarik_saldo`
--
ALTER TABLE `tarik_saldo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
