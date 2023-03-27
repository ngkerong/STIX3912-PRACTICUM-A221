-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2023 at 05:58 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendancedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `id` int(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `icno` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `checkIn` time NOT NULL,
  `checkOut` time NOT NULL,
  `latt` varchar(50) NOT NULL,
  `longtt` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`id`, `name`, `icno`, `date`, `checkIn`, `checkOut`, `latt`, `longtt`, `status`) VALUES
(1, 'Ng Pei Shuang', '900124-07-5559', '2023-03-19', '21:50:52', '00:00:00', '', '', 'active'),
(2, 'Duck', '990124-07-6000', '2023-03-02', '08:51:06', '06:34:00', '', '', 'active'),
(9, 'Ng Ken', '990124-07-5449', '2023-03-21', '22:04:55', '22:47:12', '3.139003', '101.686855', 'active'),
(10, 'Ng Ken', '990124-07-5449', '2023-03-22', '00:19:20', '00:19:23', '5.352761769067154', '100.30235824749317', 'active'),
(12, 'Ng Ken', '990124-07-5449', '2023-03-23', '18:41:14', '18:41:20', '3.139003', '101.686855', 'active'),
(13, 'Ng Ken', '990124-07-5449', '2023-03-24', '13:02:06', '00:00:00', '5.3526159', '100.3022863', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `icno` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pemail` varchar(50) NOT NULL,
  `cemail` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `depart` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `password` varchar(40) NOT NULL,
  `address` varchar(200) NOT NULL,
  `regdate` datetime(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `lastlogin` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`icno`, `name`, `pemail`, `cemail`, `phone`, `depart`, `type`, `status`, `password`, `address`, `regdate`, `lastlogin`) VALUES
('900124-07-5000', 'Ng Ken', 'ng.ken.7503@gmail.com', 'ken@otc.com', '+60165103373', 'Intern', 'User', 'active', '2eaab2fbb032b258b58fdaed26b83ca391ddcd0a', 'No.152, Lorong 3\r\nTaman Desa Permai', '2023-03-27 23:08:42.135223', '2023-03-27 15:08:42.000000'),
('900124-07-5559', 'Ng Pei Shuang', 'ng.ken.7503@gmail.com', 'ng@otc.com', '0195921468', 'CS', 'User', 'active', '7a9c072beb1174918fbe7eae4609d4fa3e3aff4a', 'No.152, Lorong 3\r\nTaman Desa Permai', '2023-03-27 23:08:42.135223', '2023-03-27 15:08:42.000000'),
('990124-07-5449', 'Ng Ken', 'ng.ken.7503@gmail.com', 'ng.ken.7503@otc.com', '016-5103373', 'Intern', 'Admin', 'active', '7a9c072beb1174918fbe7eae4609d4fa3e3aff4a', 'No.152, Lorong 3\r\nTaman Desa Permai', '2023-03-27 23:08:42.135223', '2023-03-27 15:08:42.000000'),
('990124-07-6000', 'Duck', 'ng.ken.7503@gmail.com', 'ng.ken.7503@otc.com', '+60165103373', 'Sales', 'User', 'active', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'No.152, Lorong 3\r\nTaman Desa Permai', '2023-03-27 23:08:42.135223', '2023-03-27 15:08:42.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`icno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
