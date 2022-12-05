-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 10, 2022 at 07:39 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barber_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `title`, `image`, `description`) VALUES
(1, 'About Us', 'about.jpeg', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). And then.');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'haben', 'abcdef');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appoid` int(4) NOT NULL,
  `appodate` date NOT NULL,
  `appotime` time NOT NULL,
  `cid` int(4) NOT NULL,
  `service_code` int(4) NOT NULL,
  `status` enum('Pending','Rejected','Approved') NOT NULL DEFAULT 'Pending',
  `new_read` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appoid`, `appodate`, `appotime`, `cid`, `service_code`, `status`, `new_read`) VALUES
(27, '2022-05-12', '11:11:00', 12, 1, 'Approved', 'yes'),
(28, '2022-05-27', '14:12:00', 12, 8, 'Approved', 'yes'),
(30, '2022-05-13', '15:52:00', 20, 7, 'Approved', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(3) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `address`, `phone`, `email`) VALUES
(1, '141 Adi Yacob Street, Foch Foch, VYC 12045', '+971-50 1232345', 'xyz.abc@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(4) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `phone` char(10) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `date_creation` date DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `verified` enum('yes','no') DEFAULT NULL,
  `ver_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `fname`, `lname`, `phone`, `email`, `date_creation`, `username`, `password`, `verified`, `ver_key`) VALUES
(12, 'haben', 'tekeste', NULL, 'dezufolrnmxvc@candassociates.com', '2022-05-09', 'haben', '$2y$10$4bb929c2f01469b5597bfufLPoqFgBP5D.DGkfBI41d0bkKF8dIqW', 'yes', 'f457c545a9ded88f18ecee47145a72c0'),
(16, 'mewael', 'alema', NULL, 'rfmgdygv@candassociates.com', '2022-05-10', 'mewael', '$2y$10$4bb929c2f01469b5597bfufLPoqFgBP5D.DGkfBI41d0bkKF8dIqW', 'yes', '1ff1de774005f8da13f42943881c655f'),
(20, 'usercan', 'canuser', NULL, 'kaspdkrv@candassociates.com', '2022-05-10', 'fochfo', '$2y$10$4bb929c2f01469b5597bfufLPoqFgBP5D.DGkfBI41d0bkKF8dIqW', 'yes', '6364d3f0f495b6ab9dcf8d3b5c6e0b01');

-- --------------------------------------------------------

--
-- Table structure for table `Employee`
--

CREATE TABLE `Employee` (
  `id` int(4) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `city` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `salary` decimal(6,2) NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Employee`
--

INSERT INTO `Employee` (`id`, `firstname`, `lastname`, `gender`, `city`, `phone`, `salary`, `img`) VALUES
(1, 'Adingo', 'Kini', 'Male', 'Zayed City', '+971-50 1232345', '1800.00', '1.jpeg'),
(2, 'Rbqa', 'Measho', 'Female', 'Zayed City', '+971-50 1232345', '1800.00', '3.jpeg'),
(3, 'Behabelom', 'Haile', 'Male', 'Zayed City', '+971-50 1232345', '1800.00', '2.jpeg'),
(4, 'Alex', 'Andom', 'Male', 'Zayed City', '+971-50 1232345', '1800.00', '6.jpg'),
(5, 'Meaza', 'Alem', 'Female', 'Zayed City', '+971-50 1232345', '1800.00', '8.jpeg'),
(6, 'Kidane', 'Genene', 'Male', 'Zayed City', '+971-50 1232345', '1800.00', '4.png'),
(8, 'Kidane', 'Genene', 'Male', 'Zayed City', '+971-50 1232345', '1800.00', '5.jpeg'),
(13, 'Salman', 'Salim', 'Male', 'Al ain', '+971-50 1232345', '1700.00', '9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(4) NOT NULL,
  `user` int(4) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `user`, `feedback`, `status`, `date`) VALUES
(13, 12, 'Really good haircuts, I enjoyed my stay there. Lookin forward to visiting again', 'Approved', '2022-05-09');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_code` int(4) NOT NULL,
  `servname` varchar(25) NOT NULL,
  `servduration` int(3) NOT NULL,
  `servprice` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_code`, `servname`, `servduration`, `servprice`) VALUES
(1, 'trim', 25, '30.00'),
(2, 'Hair Dye', 30, '65.00'),
(3, 'Beard Trim', 45, '50.00'),
(4, 'Beard Dye', 20, '70.00'),
(6, 'Haircut', 40, '70.00'),
(7, 'Braiding', 70, '80.00'),
(8, 'Razor Cut', 20, '30.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appoid`),
  ADD KEY `fk_service` (`service_code`),
  ADD KEY `fk_customer` (`cid`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appoid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `Employee`
--
ALTER TABLE `Employee`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_code` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`cid`) REFERENCES `customer` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_service` FOREIGN KEY (`service_code`) REFERENCES `service` (`service_code`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `user` FOREIGN KEY (`user`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
