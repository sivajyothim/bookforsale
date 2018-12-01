-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2018 at 10:35 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `momscarriage`
--

-- --------------------------------------------------------

--
-- Table structure for table `const_master_admin_tbl`
--

CREATE TABLE `const_master_admin_tbl` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(60) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `admin_mobile` varchar(20) NOT NULL,
  `admin_securecode` varchar(80) NOT NULL,
  `admin_flag_status` tinyint(4) NOT NULL DEFAULT '1',
  `admin_last_login` datetime NOT NULL,
  `admin_role` int(11) NOT NULL,
  `admin_lastlogin_ip` varchar(50) NOT NULL,
  `admin_browser` varchar(100) NOT NULL,
  `admin_hashing_key` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='master_admin';

--
-- Dumping data for table `const_master_admin_tbl`
--

INSERT INTO `const_master_admin_tbl` (`admin_id`, `admin_name`, `admin_email`, `admin_mobile`, `admin_securecode`, `admin_flag_status`, `admin_last_login`, `admin_role`, `admin_lastlogin_ip`, `admin_browser`, `admin_hashing_key`) VALUES
(1, 'admin', 'admin@master.com', '8688941771', '4297f44b13955235245b2497399d7a93', 1, '0000-00-00 00:00:00', 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

CREATE TABLE `food_items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(80) NOT NULL,
  `description` varchar(200) NOT NULL,
  `veg_type` int(11) NOT NULL,
  `flag_status` tinyint(4) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `item_icon` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Food Items';

--
-- Dumping data for table `food_items`
--

INSERT INTO `food_items` (`item_id`, `item_name`, `description`, `veg_type`, `flag_status`, `created_on`, `item_icon`) VALUES
(1, 'Rice', '', 0, 1, '2018-09-23 18:44:00', ''),
(2, 'Pappu', '', 0, 1, '2018-09-23 18:44:00', ''),
(3, 'Alu Fry', '', 0, 1, '2018-09-23 18:44:44', ''),
(4, 'Sambar', '', 0, 1, '2018-09-23 18:44:44', ''),
(5, 'Curd', '', 0, 1, '2018-09-23 18:44:44', ''),
(6, 'Mango pickle', '', 0, 1, '2018-09-23 18:44:44', ''),
(7, 'Kesari', '', 1, 1, '2018-09-24 01:31:47', 'c1e9674d24ff844a3d74a3397ee9b90ad44d1747.jpg'),
(8, 'Kesari', '', 1, 1, '2018-09-24 01:32:27', '127ea15f598ccbdb90b3041a7157428a1eabcb16.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `food_menu`
--

CREATE TABLE `food_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_title` varchar(80) NOT NULL,
  `menu_price` double NOT NULL,
  `menu_offer_price` double NOT NULL,
  `menu_description` varchar(200) NOT NULL,
  `menu_day` int(11) NOT NULL,
  `menu_mrp` double NOT NULL,
  `flag_status` tinyint(4) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `menu_picture` varchar(100) NOT NULL,
  `menu_notes` varchar(300) NOT NULL,
  `menu_vegtype` int(11) NOT NULL,
  `protin_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Food Menu ';

--
-- Dumping data for table `food_menu`
--

INSERT INTO `food_menu` (`menu_id`, `menu_title`, `menu_price`, `menu_offer_price`, `menu_description`, `menu_day`, `menu_mrp`, `flag_status`, `created_on`, `menu_picture`, `menu_notes`, `menu_vegtype`, `protin_details`) VALUES
(1, 'Menu 1', 60, 2, 'This is description', 5, 60, 1, '2018-09-24 00:36:27', '8a1ea3a59b23926b368da04f7a987783a2e025c8.jpg', '', 2, 'Cal :  200g'),
(2, 'Menu 1', 60, 2, 'This is description', 5, 60, 1, '2018-09-24 00:38:03', '0126f04c6e52cd35f534ec1b443e24b1177f248e.jpg', '', 2, 'Cal :  200g');

-- --------------------------------------------------------

--
-- Table structure for table `food_menu_items`
--

CREATE TABLE `food_menu_items` (
  `menu_item_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `flag_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Menu Items ';

--
-- Dumping data for table `food_menu_items`
--

INSERT INTO `food_menu_items` (`menu_item_id`, `menu_id`, `item_id`, `created_on`, `flag_status`) VALUES
(1, 2, 6, '2018-09-24 00:38:03', 1),
(2, 2, 5, '2018-09-24 00:38:03', 1),
(3, 2, 4, '2018-09-24 00:38:03', 1),
(4, 2, 3, '2018-09-24 00:38:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_timings`
--

CREATE TABLE `food_timings` (
  `time_id` int(11) NOT NULL,
  `time_title` varchar(60) NOT NULL,
  `flag_status` tinyint(4) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `timings` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Food Times (Break fast, Lunch , Dinner)';

--
-- Dumping data for table `food_timings`
--

INSERT INTO `food_timings` (`time_id`, `time_title`, `flag_status`, `created_on`, `timings`) VALUES
(1, 'Breakfast', 1, '2018-09-22 05:22:07', '7 AM - 11 AM'),
(2, 'Lunch', 1, '2018-09-22 05:22:07', '12 PM - 2 PM'),
(3, 'Snacks', 1, '2018-09-22 05:22:07', '4 PM - 7 PM'),
(4, 'Dinner', 1, '2018-09-22 05:22:07', '7 PM - 11 PM');

-- --------------------------------------------------------

--
-- Table structure for table `veg_types`
--

CREATE TABLE `veg_types` (
  `id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `flag_status` tinyint(4) NOT NULL DEFAULT '1',
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Veg Types - Veg or Non-veg';

--
-- Dumping data for table `veg_types`
--

INSERT INTO `veg_types` (`id`, `title`, `flag_status`, `created_on`) VALUES
(1, 'Veg', 1, '2018-09-23 19:55:56'),
(2, 'Non-veg', 1, '2018-09-23 19:55:56');

-- --------------------------------------------------------

--
-- Table structure for table `weeks`
--

CREATE TABLE `weeks` (
  `week_id` int(11) NOT NULL,
  `week_title` varchar(60) NOT NULL,
  `flag_status` tinyint(4) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Weeks table';

--
-- Dumping data for table `weeks`
--

INSERT INTO `weeks` (`week_id`, `week_title`, `flag_status`, `created_on`) VALUES
(1, 'Monday', 1, '2018-09-23 22:28:57'),
(2, 'Tuesday', 1, '2018-09-23 22:28:57'),
(3, 'Wedns day', 1, '2018-09-23 22:30:51'),
(4, 'Thrus day', 1, '2018-09-23 22:30:51'),
(5, 'Friday', 1, '2018-09-23 22:31:01'),
(6, 'Saturday', 1, '2018-09-23 22:31:01'),
(7, 'Sunday', 1, '2018-09-23 22:31:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `const_master_admin_tbl`
--
ALTER TABLE `const_master_admin_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `food_items`
--
ALTER TABLE `food_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `food_menu`
--
ALTER TABLE `food_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `food_menu_items`
--
ALTER TABLE `food_menu_items`
  ADD PRIMARY KEY (`menu_item_id`);

--
-- Indexes for table `food_timings`
--
ALTER TABLE `food_timings`
  ADD PRIMARY KEY (`time_id`);

--
-- Indexes for table `veg_types`
--
ALTER TABLE `veg_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weeks`
--
ALTER TABLE `weeks`
  ADD PRIMARY KEY (`week_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `const_master_admin_tbl`
--
ALTER TABLE `const_master_admin_tbl`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `food_items`
--
ALTER TABLE `food_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `food_menu`
--
ALTER TABLE `food_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `food_menu_items`
--
ALTER TABLE `food_menu_items`
  MODIFY `menu_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `food_timings`
--
ALTER TABLE `food_timings`
  MODIFY `time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `veg_types`
--
ALTER TABLE `veg_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `weeks`
--
ALTER TABLE `weeks`
  MODIFY `week_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
