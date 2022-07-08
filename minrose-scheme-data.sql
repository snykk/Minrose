-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2022 at 03:32 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minrose`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `nama_bank` varchar(25) NOT NULL,
  `no_rekening` varchar(25) NOT NULL,
  `logo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `nama_bank`, `no_rekening`, `logo`) VALUES
(1, 'Mandiri', '092 7840 1923 7422', 'bank-mandiri.svg'),
(2, 'BRI', '058 9092 8274 9125', 'bank-bri.svg'),
(3, 'BCA', '088 7182 4291 9123', 'bank-bca.svg'),
(4, 'BNI', '0982 2937 9823 2341', 'bank-bni.svg');

-- --------------------------------------------------------

--
-- Table structure for table `catatan`
--

CREATE TABLE `catatan` (
  `id` int(10) UNSIGNED NOT NULL,
  `catatan_pemesanan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catatan`
--

INSERT INTO `catatan` (`id`, `catatan_pemesanan`) VALUES
(1, 'sedang menunggu pertemuan COD'),
(2, '[belum ada bukti transfer] sedang menunggu pengiriman bukti transaksi'),
(3, 'transaksi berhasil'),
(4, 'bukti transfer disetujui, sedang menunggu pengiriman produk'),
(5, 'pemesanan dibatalkan langsung oleh user'),
(6, 'bukti transfer berhasil dikirim, sedang menunggu persetujuan dari admin');

-- --------------------------------------------------------

--
-- Table structure for table `metode`
--

CREATE TABLE `metode` (
  `id` int(11) NOT NULL,
  `metode_pembayaran` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `metode`
--

INSERT INTO `metode` (`id`, `metode_pembayaran`) VALUES
(1, 'Transfer Bank'),
(2, 'COD');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah_produk` int(11) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `id_metode` int(11) NOT NULL,
  `id_bank` int(11) DEFAULT NULL,
  `id_catatan` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `data_dibuat` int(11) NOT NULL,
  `data_diubah` int(11) NOT NULL,
  `is_done` int(11) NOT NULL,
  `alasan_penolakan` varchar(256) DEFAULT NULL,
  `kuponUsed` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `diskon` decimal(6,2) NOT NULL,
  `image` varchar(128) NOT NULL,
  `orientasi` text NOT NULL,
  `data_dibuat` int(11) NOT NULL,
  `data_diedit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `stok`, `diskon`, `image`, `orientasi`, `data_dibuat`, `data_diedit`) VALUES
(1, 'Minrose Cup', 'Minuman cup Bunga Rosella ini terbuat dari bahan alami pilihan yaitu bunga Rosella terbaik. Pengolahan Teh Rosela sebagai minuman kesehatan herbal ini sudah menggunakan standar CPOTB, SNI dan ISO. Sehingga dapat memberikan jaminan mutu dan rasa aman bagi konsumen.', 5000, 80, '0.00', 'minrose-cup.jpeg', 'Satu minrose cup yang kami jual tidak pernah gagal untuk menghilangkan rasa haus saat dahaga', 1650206453, 1657149444),
(2, 'Minrose Botol', 'Berbagai penelitian menunjukkan bahwa ekstrak tanaman rosella mampu menurunkan tekanan darah pada penderita sindrom metabolik. Penyakit ini ditandai dengan peningkatan tekanan darah, gula darah, kolesterol, serta berat badan. Tak hanya itu, teh rosella botol ini juga diketahui dapat menurunkan tekanan darah dan mencegah hipertensi atau tekanan darah tinggi. Namun, penggunaan teh rosella botol sebagai obat untuk mengatasi hipertensi tentunya harus dikonsultasikan lebih dulu dengan dokter.', 8000, 0, '0.00', 'minrose-botol.jpg', 'Kami juga menyediakan produk jenis botol agar mudah anda bawa beraktivitas ke mana saja', 1650206453, 1651625611),
(3, 'Minrose Dus', 'Minuman Rosela dibuat dari seduhan Bunga Rosela (Hibiscus Sabdariffa) dan 100% gula asli. Bunga rosella merupakan spesies bunga asal Afrika. Minuman tersebut diyakini bisa meningkatkan imunitas tubuh dan membantu menurunkan tekanan darah tinggi. Kandungan dalam 57 gram bunga rosella di antaranya terdapat 0,84 mg zat besi, 6,8 mg vitamin C, 123 mg kalsium, vitamin A dan 0,016 mg vitamin B2.', 25000, 45, '0.20', 'minrose-dus.jpg', 'Penuhi stok minuman di rumah anda dengan membeli 1 atau beberapa dus berisi penuh minrose', 1650206453, 1655789843),
(4, 'ini produk baru', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, fugit dolore ipsum recusandae nostrum a temporibus eaque possimus ab necessitatibus perferendis, iusto libero blanditiis, eveniet quod atque neque suscipit id ipsa. Doloremque quibusdam repudiandae soluta aspernatur commodi quasi unde ad dolores distinctio expedita velit, porro at fugit. Ad, necessitatibus nam.', 35000, 113, '0.20', 'cat.PNG', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Non suscipit ullam deleniti quod ea!aaa', 1651135243, 1651622633);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status_pemesanan` varchar(25) NOT NULL,
  `style` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status_pemesanan`, `style`) VALUES
(1, 'disetujui', 'success'),
(2, 'pending', 'warning'),
(3, 'ditolak', 'danger'),
(4, 'selesai', 'info'),
(5, 'dibatalkan', 'secondary');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `kategori` varchar(64) NOT NULL,
  `keterangan` varchar(256) NOT NULL,
  `pemasukan` int(11) DEFAULT NULL,
  `pengeluaran` int(11) DEFAULT NULL,
  `data_dibuat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `ulasan` text NOT NULL,
  `data_dibuat` int(11) NOT NULL,
  `data_diubah` int(11) NOT NULL,
  `isEdited` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `role_id` int(11) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `image` varchar(128) NOT NULL,
  `data_dibuat` int(11) NOT NULL,
  `point` int(11) DEFAULT NULL,
  `kupon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama_lengkap`, `username`, `email`, `password`, `jenis_kelamin`, `no_hp`, `role_id`, `alamat`, `image`, `data_dibuat`, `point`, `kupon`) VALUES
(1, 'Moh. Najib Fikri', 'pStar7', 'najibfikri13@gmail.com', '$2y$10$4Prh5XY25sgT43oSjkiteu2yMNjtclp41RjwclQdPTZEFcw6M3M6e', 'L', '089283912345', 1, 'Jln. Pattimura no 65, Banyuwangi, Jawa Timur', 'default.jpg', 1650206453, 0, 0),
(2, 'Patrick Star 7', 'Itsme patrick', 'member@gmail.com', '$2y$10$m8e4IDvFx63hhUF5cg4JNOcbOOIwibPNbx/U5Oz7SLQCCJrSj7dOa', 'L', '08123112312', 2, 'inialamatku', 'person1.jpg', 1650207116, 314, 0),
(3, 'Larry is real', 'just larry', 'gatau@gmail.com', '$2y$10$Uekb57i2C9kwI/YOuR3Sjuzzf4iyDJEV9Q9g3hIAZHVSSmV3aZ0jC', 'L', '081982936413', 2, 'inialamatsaya', 'person3.jpg', 1650622148, 0, 0),
(4, 'someone who is talented', 'squidy', 'emailbaru@gmail.com', '$2y$10$01i1hWk4oj/sBEzl74NWd.pPbfc50wxv9mbjoUwzfU/9./5Yoi/6a', 'L', '081982789231', 2, 'alamatbaru', 'person4.jpg', 1651900508, 185, 2),
(5, 'jane doe', 'halo im jane', 'janedoe@gmail.com', '$2y$10$KYTiNuar5Zo1xry2m4YdEeNR5POvuf3ohYzHbv4Ti8nSnouhJ3TSy', 'L', '0812341231127', 2, 'jawa timur, indonesia', 'person2.jpg', 1652276424, 28, 2),
(6, 'just a man', 'goodman', 'goodman@gmail.com', '$2y$10$AeJ3ukkStnx//2OWmD9UHO7aR8sdAT2ap7TkFWiAbh2BGNvsrkb7C', 'L', '08198293812', 2, 'place of peace lmao', 'default.jpg', 1653376561, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metode`
--
ALTER TABLE `metode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `catatan`
--
ALTER TABLE `catatan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `metode`
--
ALTER TABLE `metode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
