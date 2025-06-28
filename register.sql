-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2024 at 01:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(30) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `prev_price` float(12,2) NOT NULL DEFAULT 0.00,
  `current_price` float(12,2) NOT NULL DEFAULT 0.00,
  `img_path` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `description`, `prev_price`, `current_price`, `img_path`, `date_created`, `date_updated`) VALUES
(1, '123456', 'Peanut', 'This is a sample Product 101 description only', 0.00, 145.23, 'images/honet_img.png', '2024-10-19 21:47:08', '2024-10-19 21:47:08'),
(2, '123457', 'Peanut butter', 'This is a sample Product 102 description only', 520.00, 399.00, 'images/honet_img.png', '2024-10-19 21:47:08', '2024-10-19 21:47:08'),
(3, '123458', 'Baby diapers', 'This is a sample Product 103 description only', 0.00, 1299.00, 'images/honet_img.png', '2024-10-19 21:47:08', '2024-10-19 21:47:08'),
(4, '123459', 'Bread', 'This is a sample Product 104 description only', 799.00, 599.00, 'images/honet_img.png', '2024-10-19 21:47:08', '2024-10-19 21:47:08'),
(5, '123450', 'Donut', 'This is a sample Product 105 description only', 1999.00, 1599.00, 'images/honet_img.png', '2024-10-19 21:47:08', '2024-10-19 21:47:08');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `username`, `phone`, `email`, `password`) VALUES
(0, 'Jack Hamilton', 543289102, 'oirew@gmail.com', '$2y$10$HM0pi'),
(0, 'yussif Kareem', 540595051, 'usivabdulkarim@gmail.com', '$2y$10$FtLSC'),
(0, 'Seidu Hassan', 241346456, 'seidu@gmail.com', '$2y$10$OXjhb'),
(0, 'Abrar', 432174932, 'abrar@gmail.com', '$2y$10$8h9IM'),
(0, 'Arewa ', 421827361, 'arewa@gmail.com', '$2y$10$PVcUJ'),
(0, 'AkamTech', 543421923, 'tech@gmail.com', '$2y$10$IA3yW'),
(0, 'Musha Kareem', 546386296, 'musharafakareem@gmail.com', '$2y$10$Sh802'),
(0, 'Nunu', 438261920, 'nunu@gmail.com', '$2y$10$9YiKLYgvGbdkaK.qntn2qeWdn5sj/.fiZ5ViPtd9C61xi0iC/JsjG'),
(0, 'Mom Karim', 596321873, 'mom@gmail.com', '$2y$10$rILc2YyFWsO/chjO5H1mM.65hLyyIkX3wtCXmA08pXr84BlQZdMnm'),
(0, 'Sydney', 239821763, 'sydney@gmail.com', '$2y$10$cunx3TQrs9FsQtW50iGrjOUv4pqJXW8Jf4kFv1/eHgeptA5FBsi16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
