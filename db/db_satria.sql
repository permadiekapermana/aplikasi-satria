-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2019 at 05:21 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_satria`
--

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `id_sales` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `alamat` varchar(75) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `tglmasuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `id_sales`, `nama`, `alamat`, `telepon`, `tglmasuk`) VALUES
(10, 13, 'ABADI MAKMUR', 'JL. RAYA GUNUNG JATI DS KLAYAN GNJATI', '081432678900', '2019-07-01'),
(12, 14, 'CAHAYA KILAU', 'JL. GN TANGKUBAN PERAHU NO. 78 PERUMNAS CIREBON', '085724590122', '2019-02-20'),
(13, 14, 'JAYA TERANG', 'PILANG SARI KEDAWUNG, KAB CIREBON', '089980123900', '2019-08-05'),
(14, 15, 'DUA SAUDARA', 'JL. RAYA MAJALENGKA NO.40', '085234680300', '2019-06-02'),
(15, 15, 'MUSTOFAH', 'JL. PATUANAN LEUWIMUNDING MJLK', '0811345800', '2019-05-08'),
(16, 13, 'MAKMUR ABADI', 'JL. ARUM SARI JEMBATAN MERAH, TALUN', '087729321890', '2019-07-01');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `nopembayaran` int(12) NOT NULL,
  `no_invoice` varchar(20) NOT NULL,
  `id_pelanggan` varchar(11) DEFAULT NULL,
  `tglpembayaran` date NOT NULL,
  `jumlah_bayar` int(20) DEFAULT NULL,
  `sisa_kredit` int(20) DEFAULT NULL,
  `status_pembayaran` smallint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`nopembayaran`, `no_invoice`, `id_pelanggan`, `tglpembayaran`, `jumlah_bayar`, `sisa_kredit`, `status_pembayaran`) VALUES
(19, 'INV2019090012', '10', '2019-09-14', 100000, 464000, 0),
(20, 'INV2019090015', '13', '2019-09-14', 50000, 47000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `nopenjualan` varchar(20) NOT NULL,
  `no_invoice` varchar(20) DEFAULT NULL,
  `tglpenjualan` date NOT NULL,
  `grand_total_penjualan` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `metode_penjualan` tinyint(1) NOT NULL,
  `tgl_jatuh_tempo` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`nopenjualan`, `no_invoice`, `tglpenjualan`, `grand_total_penjualan`, `id_pelanggan`, `metode_penjualan`, `tgl_jatuh_tempo`) VALUES
('PJLN2019090001', '', '2019-09-11', 550000, 4, 1, '2019-10-13'),
('PJLN2019090002', '', '2019-09-11', 550000, 4, 1, '2019-10-13'),
('PJLN2019090003', '', '2019-09-11', 209000, 4, 1, '2019-10-13'),
('PJLN2019090004', 'INV2019090004', '2019-09-11', 383600, 6, 2, '2019-10-13'),
('PJLN2019090005', '', '2019-09-10', 268000, 5, 1, '2019-10-13'),
('PJLN2019090006', '', '2019-09-11', 115500, 5, 1, '2019-10-13'),
('PJLN2019090007', 'INV2019090007', '2019-09-02', 672000, 7, 2, '2019-10-10'),
('PJLN2019090008', 'INV2019090008', '2019-09-03', 542400, 7, 2, '2019-09-09'),
('PJLN2019090009', 'INV2019090009', '2019-09-11', 196000, 6, 2, '2019-10-13'),
('PJLN2019090010', '', '2019-09-11', 728000, 8, 1, '2019-10-13'),
('PJLN2019090011', 'INV2019090011', '2019-09-11', 114000, 8, 2, '2019-10-13'),
('PJLN2019090012', 'INV2019090012', '2019-09-14', 564000, 10, 1, '2019-10-16'),
('PJLN2019090013', 'INV2019090013', '2019-09-14', 221000, 16, 2, '2019-10-16'),
('PJLN2019090014', '', '2019-09-14', 56000, 12, 1, '2019-10-16'),
('PJLN2019090015', 'INV2019090015', '2019-09-14', 97000, 13, 2, '2019-10-16'),
('PJLN2019090016', '', '2019-09-14', 120000, 14, 1, '2019-10-16'),
('PJLN2019090017', 'INV2019090017', '2019-09-14', 268000, 15, 2, '2019-10-16'),
('PJLN2019090018', '', '2019-09-15', 132000, 14, 1, '2019-10-17'),
('PJLN2019090019', '', '2019-09-15', 456000, 12, 1, '2019-10-17'),
('PJLN2019090020', '', '2019-09-15', 0, 14, 1, '2019-10-17');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `nopenjualan` varchar(20) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `itemterjual` int(11) NOT NULL,
  `total_penjualan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`nopenjualan`, `id_produk`, `itemterjual`, `total_penjualan`) VALUES
('PJLN2019090012', 31, 10, 228000),
('PJLN2019090012', 32, 10, 336000),
('PJLN2019090013', 29, 15, 165000),
('PJLN2019090013', 30, 20, 56000),
('PJLN2019090014', 33, 5, 56000),
('PJLN2019090015', 34, 10, 97000),
('PJLN2019090016', 36, 20, 120000),
('PJLN2019090017', 35, 20, 268000),
('PJLN2019090018', 29, 12, 132000),
('PJLN2019090019', 31, 20, 456000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(25) NOT NULL,
  `harga` int(11) NOT NULL,
  `stokawal` int(11) NOT NULL,
  `stokproduk` int(11) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `tglmasuk` date NOT NULL,
  `harga_beli` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `stokawal`, `stokproduk`, `satuan`, `tglmasuk`, `harga_beli`) VALUES
(29, 'Kabel Serabut', 11000, 875, 870, 'roll', '2019-07-03', 8000),
(30, 'Steker Biasa', 2800, 990, 905, 'pcs', '2019-07-01', 2000),
(31, 'philips led 4w', 22800, 260, 230, 'pcs', '2019-08-07', 21500),
(32, 'philips led 10w', 33600, 272, 242, 'pcs', '2019-08-07', 31000),
(33, 'Broco stop kontak IB', 11200, 390, 385, 'pcs', '2019-08-05', 10000),
(34, 'Broco saklar enggel IB', 9700, 385, 375, 'pcs', '2019-08-05', 8500),
(35, 'Broco saklar seri IB', 13400, 375, 355, 'pcs', '2019-08-05', 12600),
(36, 'Fiting plapon', 6000, 300, 290, 'pcs', '2019-08-02', 7000);

-- --------------------------------------------------------

--
-- Table structure for table `retur`
--

CREATE TABLE `retur` (
  `id_retur` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `jml_retur` int(11) NOT NULL,
  `tgl_retur` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retur`
--

INSERT INTO `retur` (`id_retur`, `id_produk`, `id_pelanggan`, `jml_retur`, `tgl_retur`) VALUES
(1, 29, 10, 19, '2019-09-16'),
(2, 30, 10, 12, '2019-09-16'),
(3, 29, 10, 20, '2019-09-16'),
(4, 36, 10, 281, '2019-09-16'),
(5, 36, 10, 10, '2019-09-16'),
(6, 30, 10, 10, '2019-09-16'),
(7, 29, 10, 10, '2019-09-16'),
(8, 29, 10, 12, '2019-09-17'),
(9, 0, 0, 10, '2019-09-17'),
(10, 30, 12, 15, '2019-09-17');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `alamat` varchar(75) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `tglmasuk` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama`, `alamat`, `telepon`, `tglmasuk`) VALUES
(2, 'PT. MULTI ERAGUNA USAHA', 'JL. PATIUNUS NO. 8 RT 05 RW 02, JEPARA. SEMARANG,JAWA TENGAH', '89900012111', '2019-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_penjualan`
--

CREATE TABLE `tmp_penjualan` (
  `idtmp` int(10) NOT NULL,
  `nopenjualan` varchar(20) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `itemterjual` int(11) DEFAULT NULL,
  `total_penjualan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level_user` enum('admin','sales','gudang','pimpinan') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `level_user`) VALUES
(1, 'Dewi', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(8, 'Agus Surya', 'pimpinan', '90973652b88fe07d05a4304f0a945de8', 'pimpinan'),
(9, 'Heri', 'gudang', '202446dd1d6028084426867365b0c7a1', 'gudang'),
(13, 'AKBAR', 'AKBAR', 'da7c1b2519415d312411f058c3c72e86', 'sales'),
(14, 'Nandar', 'Nandar', '9ed083b1436e5f40ef984b28255eef18', 'sales'),
(15, 'Teddy', 'teddy', '962b2d2b8e72dc6771bca613d49b46fb', 'sales');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`nopembayaran`,`no_invoice`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`nopenjualan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `retur`
--
ALTER TABLE `retur`
  ADD PRIMARY KEY (`id_retur`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `tmp_penjualan`
--
ALTER TABLE `tmp_penjualan`
  ADD PRIMARY KEY (`idtmp`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `nopembayaran` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `retur`
--
ALTER TABLE `retur`
  MODIFY `id_retur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tmp_penjualan`
--
ALTER TABLE `tmp_penjualan`
  MODIFY `idtmp` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
