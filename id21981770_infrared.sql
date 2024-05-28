-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 25, 2024 at 04:03 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21981770_infrared`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `time`, `qty`) VALUES
(1, '2024-03-07 01:00:00', 15),
(2, '2024-03-07 01:30:00', 20),
(3, '2024-03-07 02:00:00', 25),
(4, '2024-03-07 02:30:00', 18),
(5, '2024-03-07 03:00:00', 22),
(6, '2024-03-07 03:30:00', 17),
(7, '2024-03-07 04:00:00', 23),
(8, '2024-03-07 04:30:00', 19),
(9, '2024-03-07 05:00:00', 21),
(10, '2024-03-07 05:30:00', 24),
(11, '2024-03-12 07:59:53', 1),
(12, '2024-03-12 08:23:39', 1),
(13, '2024-03-12 08:30:35', 1),
(14, '2024-03-22 16:05:53', 1),
(15, '2024-03-22 16:13:56', 1),
(16, '2024-03-22 16:15:59', 1),
(17, '2024-03-22 16:16:31', 1),
(18, '2024-03-22 16:19:17', 1),
(19, '2024-03-22 16:19:45', 1),
(20, '2024-03-22 16:22:26', 1),
(21, '2024-03-22 16:25:40', 1),
(22, '2024-03-22 16:26:38', 1),
(23, '2024-03-22 16:28:36', 1),
(24, '2024-03-22 16:29:01', 1),
(25, '2024-03-22 16:29:17', 1),
(26, '2024-03-22 16:29:29', 1),
(27, '2024-03-22 16:31:13', 1),
(28, '2024-03-22 16:31:19', 1),
(29, '2024-03-22 16:31:25', 1),
(30, '2024-03-22 16:31:33', 1),
(31, '2024-03-22 16:31:39', 1),
(32, '2024-03-22 16:31:44', 1),
(33, '2024-03-22 16:31:50', 1),
(34, '2024-03-22 16:31:58', 1),
(35, '2024-03-22 16:32:06', 1),
(36, '2024-03-22 16:32:30', 1),
(37, '2024-03-22 16:32:38', 1),
(38, '2024-03-22 16:32:44', 1),
(39, '2024-03-22 16:32:50', 1),
(40, '2024-03-22 16:32:55', 1),
(41, '2024-03-22 16:33:01', 1),
(42, '2024-03-22 16:42:50', 1),
(43, '2024-03-22 16:52:29', 1),
(44, '2024-03-22 16:57:32', 1),
(45, '2024-03-22 17:18:49', 1),
(46, '2024-03-22 17:18:56', 1),
(47, '2024-03-22 17:19:45', 1),
(48, '2024-03-22 17:20:21', 1),
(49, '2024-03-22 17:49:08', 1),
(50, '2024-03-22 17:49:33', 1),
(51, '2024-03-22 17:49:59', 1),
(52, '2024-03-22 17:50:11', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
