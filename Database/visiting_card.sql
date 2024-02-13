-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2024 at 08:05 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `visiting_card`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_type`
--

CREATE TABLE `category_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_type`
--

INSERT INTO `category_type` (`id`, `name`) VALUES
(1, 'OEM'),
(2, 'Distributor'),
(5, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `person_name` varchar(255) NOT NULL DEFAULT '',
  `company_name` varchar(255) NOT NULL DEFAULT '',
  `designation` varchar(255) NOT NULL DEFAULT '',
  `company_address_1` varchar(255) NOT NULL DEFAULT '',
  `company_address_2` varchar(255) NOT NULL DEFAULT '',
  `company_address_3` varchar(255) NOT NULL DEFAULT '',
  `business_email` varchar(255) NOT NULL DEFAULT '',
  `personal_email` varchar(255) NOT NULL DEFAULT '',
  `mobile_no` varchar(100) NOT NULL DEFAULT '',
  `landline_no` varchar(100) NOT NULL DEFAULT '',
  `website` varchar(255) NOT NULL DEFAULT '',
  `residence_address_1` varchar(1000) NOT NULL DEFAULT '',
  `residence_address_2` varchar(255) NOT NULL DEFAULT '',
  `residence_address_3` varchar(255) NOT NULL DEFAULT '',
  `related_to` varchar(255) NOT NULL DEFAULT '',
  `product_type` varchar(255) NOT NULL DEFAULT '',
  `importance` varchar(255) NOT NULL DEFAULT '',
  `group_type` varchar(255) NOT NULL DEFAULT '',
  `category` varchar(255) NOT NULL DEFAULT '',
  `cr_limit` varchar(255) NOT NULL DEFAULT '',
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `hash`, `person_name`, `company_name`, `designation`, `company_address_1`, `company_address_2`, `company_address_3`, `business_email`, `personal_email`, `mobile_no`, `landline_no`, `website`, `residence_address_1`, `residence_address_2`, `residence_address_3`, `related_to`, `product_type`, `importance`, `group_type`, `category`, `cr_limit`, `created_on`) VALUES
(10, 'xBhQwL1bU1EVuJ7lCrVDanuVXm7Phs', 'gg', 'gg', 'gggsdd', 'das', '', '', 'das', 'das', 'das', 'ad', 'da', 'ads', '', '', '0', '0', '12', '7', '2', '', '2024-01-12 16:02:34'),
(11, '10qeCD3CmGFux5KMHxDftWME563PqY', 'awq', 'abc', 'agda', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '', '', '2024-01-15 10:36:17'),
(12, 'ItHWyPfepvHPQJYn8VsHt8muhx0y3Z', 'a', 'a', 'a', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '', '', '', '2024-01-15 10:36:19'),
(19, 'dqc9HW3EZicHWaTmGUdnUgmDKlXPnL', 'das', 'sad', 'sd', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '0', '', '2024-01-16 16:42:44'),
(20, 'oPys7qYcTMh3mzHpVnJxyCDFvO1TNG', 'dsa', 'dsa', 'dsa', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '0', '', '2024-01-16 16:42:49'),
(21, 'RZMh6aOxX17EdCgrqxZjjo4yZLYJAx', 'hf', 'hg', 'hgfd', 'ghfd', '', '', 'fgh', '', '', '', '', '', '', '', '', '', '0', '0', '0', '', '2024-01-16 16:43:05'),
(22, 'UYjcXG1GjgZ8Qg9164aIp5OFI4Jphe', 'jry', 'ter', 'ter', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '0', '', '2024-01-16 16:43:10'),
(23, 'HLnAD0GdcDsXCpLUHvqXsb8glnqU3N', 'mnbv', 'vn', 'vm', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '0', '', '2024-01-16 16:43:15'),
(24, '7t5zysNrY0uyZgo4aNT8eMHWDwGJIu', 'ry', 'tey', 'ey', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '0', '', '2024-01-16 16:43:20'),
(25, 'A4ESD9Wz2Ch36kUxnZc0IBPrRNRRp2', 'wer', 'wre', 'we', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '0', '', '2024-01-16 16:43:25'),
(26, 'zUmZ85yjCTznvFY6TOQNTpsUN2RKPH', 'terw', 'sdgf', 'gsdf', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '0', '', '2024-01-16 16:43:29'),
(27, 'BqUtRnu8LeMHxPbqkMVGbGNkfFNmDL', 'erw', 'wre', 'rew', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '0', '', '2024-01-16 16:43:34'),
(28, 'ubsAgy2bRhnanIdEcK2oecJ8jXI79u', 'tyry', 'ytr', 'ytr', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '0', '', '2024-01-16 16:43:41'),
(30, 'YLvVdrBBtCietn2bwoaNpaeKKGtXx6', 'Vikas G', 'XYZ Company', 'HR', 'Jaipur', '', '', 'ads', 'sda', 'sda', 'dsa', 'ad', 'dsa', '', '', '0', '', '13', '6', '1', '12312', '2024-01-17 14:03:09'),
(32, 'eTViX34v9BgsxKnSK25QCz5hKn1ceo', 'Temp', 'Temp c', 'Temp D', 'CA1fsfgdadaddadadadadadadadadfdsfsdafsatgsdsgrdgdhdhdhdfghhdggh', '', 'CA3', 'xyz@abc.com', 'a@b.c', '2222222', '223322', 'xyz.com', 'RA1', 'RA2', 'RA3', '4', '0', '13', '6', '1', '1222', '2024-01-20 13:01:44'),
(34, 'IazFIy9wMdv3yV1EIh60lrN4oQ595x', 'gg', 'gg', 'gg', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '0', '0', '0', '', '2024-01-31 13:12:35');

-- --------------------------------------------------------

--
-- Table structure for table `group_type`
--

CREATE TABLE `group_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `group_type`
--

INSERT INTO `group_type` (`id`, `name`) VALUES
(6, 'Acer'),
(7, 'Dell'),
(9, 'HP');

-- --------------------------------------------------------

--
-- Table structure for table `importance_type`
--

CREATE TABLE `importance_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `importance_type`
--

INSERT INTO `importance_type` (`id`, `name`) VALUES
(12, 'A++'),
(13, 'A+'),
(14, 'A'),
(23, 'B'),
(24, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `list_contact_mapping`
--

CREATE TABLE `list_contact_mapping` (
  `id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL DEFAULT 0,
  `contact_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `name`) VALUES
(2, 'Laptop'),
(4, 'Desktop'),
(5, 'Printer');

-- --------------------------------------------------------

--
-- Table structure for table `related_to`
--

CREATE TABLE `related_to` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `related_to`
--

INSERT INTO `related_to` (`id`, `name`) VALUES
(3, 'Type3'),
(4, 'Type4');

-- --------------------------------------------------------

--
-- Table structure for table `saved_list`
--

CREATE TABLE `saved_list` (
  `id` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL DEFAULT '',
  `list_name` varchar(255) NOT NULL DEFAULT '',
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saved_list`
--

INSERT INTO `saved_list` (`id`, `hash`, `list_name`, `created_on`) VALUES
(16, '86Vhj76GoYOcYeZQMZaBbaQGPFP9L6', 'list1', '2024-02-01 13:43:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_type`
--
ALTER TABLE `category_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_type`
--
ALTER TABLE `group_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `importance_type`
--
ALTER TABLE `importance_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_contact_mapping`
--
ALTER TABLE `list_contact_mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `related_to`
--
ALTER TABLE `related_to`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved_list`
--
ALTER TABLE `saved_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_type`
--
ALTER TABLE `category_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `group_type`
--
ALTER TABLE `group_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `importance_type`
--
ALTER TABLE `importance_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `list_contact_mapping`
--
ALTER TABLE `list_contact_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `related_to`
--
ALTER TABLE `related_to`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `saved_list`
--
ALTER TABLE `saved_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
