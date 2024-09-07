-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2024 at 05:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'level 0',
  `email` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `role`, `email`, `password`, `date`) VALUES
(5, 'Ines', 'level-0', 'inestoni25@gmail.com', '$2y$12$EcXNA8UHc53gWrW0suAB2.b028O7ItuHyLqXrQN6j00ax7OHVBF3i', '2021-05-22 10:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(20) NOT NULL,
  `names` varchar(20) NOT NULL,
  `phone` int(20) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `names`, `phone`, `email`) VALUES
(1, 'umutoni', 786697645, 'inestoni25@gmail.com'),
(2, 'umutoni', 786697645, 'inestoni25@gmail.com'),
(3, 'umutoni', 786697645, 'inestoni25@gmail.com'),
(4, 'umutoni', 786697645, 'inestoni25@gmail.com'),
(5, 'Irene', 787238127, 'irene@gmail.com'),
(6, 'yvan', 786697640, 'yvanhirwa2020@gmail.'),
(7, 'yvan', 786697640, 'yvanhirwa2020@gmail.'),
(8, 'yvan', 786697640, 'yvanhirwa2020@gmail.'),
(9, 'mugisha', 786697640, 'yvanhirwa2020@gmail.'),
(10, 'mugisha', 786697640, 'yvanhirwa2020@gmail.');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `blogid` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `names` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `names`, `email`, `message`, `date`) VALUES
(1, 'Ethredah', 'ethredah@gmail.com', 'Hello there Ushauri team.', '2018-07-27 16:57:59'),
(2, 'Chao', 'chao@gmail.com', 'Hi there!!', '2018-07-27 16:57:59'),
(4, 'James Mlamba', 'jaymo@gmail.com', 'I am interested in a meeting.', '2018-07-28 01:38:22');

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `houseID` int(11) NOT NULL,
  `house_name` text NOT NULL,
  `image` blob NOT NULL,
  `imga` blob NOT NULL,
  `imgb` blob NOT NULL,
  `imgc` blob NOT NULL,
  `imgd` blob NOT NULL,
  `number_of_rooms` int(10) NOT NULL DEFAULT 1,
  `rent_amount` double NOT NULL,
  `location` text NOT NULL,
  `num_of_bedrooms` int(10) NOT NULL,
  `house_status` varchar(50) NOT NULL DEFAULT 'Vacant'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`houseID`, `house_name`, `image`, `imga`, `imgb`, `imgc`, `imgd`, `number_of_rooms`, `rent_amount`, `location`, `num_of_bedrooms`, `house_status`) VALUES
(30, 'House', 0x686f7573652e6a7067, '', '', '', '', 7, 350, 'Kinyinya', 4, 'Vacant'),
(31, 'Appartment', 0x6b6162312e6a7067, '', '', '', '', 4, 300, 'Kimihurura', 2, 'Vacant'),
(32, 'Apartment', 0x6b6979312e6a7067, '', '', '', '', 5, 300, 'kabuga', 3, 'Vacant'),
(33, 'Apartment', 0x6b616e312e6a7067, '', '', '', '', 5, 300, 'kabuga', 3, 'Vacant');

-- --------------------------------------------------------

--
-- Table structure for table `house_pics`
--

CREATE TABLE `house_pics` (
  `pic_id` int(11) NOT NULL,
  `pic_name` text NOT NULL,
  `house_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoiceNumber` varchar(50) NOT NULL,
  `tenantID` int(11) NOT NULL,
  `dateOfInvoice` text NOT NULL,
  `dateDue` text NOT NULL,
  `amountDue` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'unpaid',
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoiceNumber`, `tenantID`, `dateOfInvoice`, `dateDue`, `amountDue`, `status`, `comment`) VALUES
('INV20231019132349', 18, '2023-10-19', '2023-10-26', -4500, 'paid', 'Please pay rent for this month'),
('INV20231019133401', 19, '2023-10-19', '2023-10-25', 6120, 'unpaid', 'This is the rent invoice for this month'),
('INV20231019134119', 20, '2023-10-19', '2023-10-31', 0, 'paid', 'This is the rent invoice for this month'),
('INV20240903143324', 20, '2024-09-03', '2024-08-08', 139700, 'unpaid', 'This is the rent invoice for this month');

-- --------------------------------------------------------

--
-- Stand-in structure for view `invoicesview`
-- (See below for the actual view)
--
CREATE TABLE `invoicesview` (
`invoiceNumber` varchar(50)
,`tenant_name` text
,`tenantID` int(11)
,`phone_number` varchar(13)
,`amountDue` int(11)
,`dateOfInvoice` text
,`dateDue` text
,`status` varchar(50)
,`comment` text
);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `location_name` text NOT NULL,
  `geo_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location_name`, `geo_id`) VALUES
(1, 'Kacyiru', ''),
(2, 'Kanombe', ''),
(3, 'Kimihurura', ''),
(4, 'kabuga', ''),
(5, 'Kiyovu', 'undefined'),
(6, 'Kinyinya', 'undefined'),
(7, 'Gishushu', 'undefined');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `paymentID` int(11) NOT NULL,
  `tenantID` int(11) NOT NULL,
  `invoiceNumber` varchar(50) NOT NULL,
  `expectedAmount` int(11) NOT NULL,
  `amountPaid` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `mpesaCode` varchar(30) NOT NULL DEFAULT 'None',
  `dateofPayment` text NOT NULL,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`paymentID`, `tenantID`, `invoiceNumber`, `expectedAmount`, `amountPaid`, `balance`, `mpesaCode`, `dateofPayment`, `comment`) VALUES
(13, 18, 'INV20231019132349', 10000, 7000, 3000, 'gh3423h', '2023-10-19', 'partial payment for the invoice'),
(14, 18, 'INV20231019132349', 3000, 7500, -4500, 'ty28393io', '2023-10-19', 'another payment'),
(15, 19, 'INV20231019133401', 10000, 3000, 7000, 'sdsd434', '2023-10-19', 'partial payment'),
(16, 20, 'INV20231019134119', 70000, 70000, 0, 'er23456', '2023-10-19', 'rent settlement'),
(17, 19, 'INV20231019133401', 7000, 880, 6120, '999', '2024-09-04', 'sept 2024'),
(18, 19, 'INV20231019133401', 7000, 880, 6120, '999', '2024-09-04', 'sept 2024'),
(19, 20, 'INV20240903143324', 140000, 300, 139700, '300', '2024-09-07', 'booked');

-- --------------------------------------------------------

--
-- Stand-in structure for view `paymentsview`
-- (See below for the actual view)
--
CREATE TABLE `paymentsview` (
`paymentID` int(11)
,`tenantID` int(11)
,`tenant_name` text
,`house_name` text
,`invoiceNumber` varchar(50)
,`expectedAmount` int(11)
,`amountPaid` int(11)
,`balance` int(11)
,`mpesaCode` varchar(30)
,`dateofPayment` text
,`comment` text
);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `author` varchar(200) NOT NULL,
  `title` varchar(400) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `author`, `title`, `content`, `date`) VALUES
(5, 'Ethredah', 'MENTAL HEALTH IS REAL', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,csem.Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar,\r\n\r\n', '2018-07-27 15:28:31'),
(6, 'Derick', 'Ushauri Lending a hand', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar,\r\n\r\n', '2018-07-27 15:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `date`) VALUES
(3, 'ethredah@gmail.com', '2018-07-27 18:21:30'),
(4, 'james@hack3.io', '2018-07-27 18:21:30'),
(6, 'admin@pikash.sales', '2018-07-28 01:49:21');

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `tenantID` int(11) NOT NULL,
  `houseNumber` int(10) NOT NULL,
  `tenant_name` text NOT NULL,
  `email` text NOT NULL,
  `ID_number` int(10) NOT NULL,
  `profession` text NOT NULL,
  `phone_number` varchar(13) NOT NULL,
  `agreement_file` text DEFAULT NULL,
  `dateAdmitted` text DEFAULT NULL,
  `account` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`tenantID`, `houseNumber`, `tenant_name`, `email`, `ID_number`, `profession`, `phone_number`, `agreement_file`, `dateAdmitted`, `account`) VALUES
(21, 11, 'Ines', 'inestoni25@gmail.com', 2147483647, 'Student', '+254786697640', NULL, '2024-09-03', 0),
(22, 16, 'Ines', 'inestoni5@gmail.com', 2147483647, 'Student', '+254786697640', NULL, '2024-09-04', 0),
(23, 16, 'Ines', 'inestoni5@gmail.com', 2147483647, 'Student', '+254786697640', NULL, '2024-09-04', 0),
(24, 19, 'Ines', 'inestoni5@gmail.com', 2147483647, 'Student', '+254786697640', NULL, '2024-09-04', 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tenantsview`
-- (See below for the actual view)
--
CREATE TABLE `tenantsview` (
`tenantID` int(11)
,`houseNumber` int(10)
,`tenant_name` text
,`email` text
,`ID_number` int(10)
,`profession` text
,`phone_number` varchar(13)
,`dateAdmitted` text
,`agreement_file` text
,`house_name` text
,`number_of_rooms` int(10)
,`house_status` varchar(50)
,`rent_amount` double
,`houseID` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `actor` text DEFAULT NULL,
  `time` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `seen` varchar(10) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `actor`, `time`, `description`, `seen`) VALUES
(21, 'Admin (obed)', '2023-10-19 : 13:18:23', 'obed added a new house (A Blue House) with 4 rentable units, and 2 bedrooms per unit located in Nairobi Cbd', 'YES'),
(22, 'Admin (obed)', '2023-10-19 : 13:20:16', 'obed admitted a new tenant (Obed Paul) at 2023-10-19 : 13:20:16', 'YES'),
(23, 'Admin (obed)', '2023-10-19 : 13:23:49', 'obed added a new rental invoice (INV20231019132349) for tenant (Obed Paul) at 2023-10-19 : 13:23:49.', 'YES'),
(24, 'Admin (obed)', '2023-10-19 : 13:25:50', 'obed added payment of 7000 for Obed Paul, under invoice ID: INV20231019132349', 'YES'),
(25, 'Admin (obed)', '2023-10-19 : 13:27:25', 'obed added payment of 7500 for Obed Paul, under invoice ID: INV20231019132349', 'YES'),
(26, 'Admin (obed)', '2023-10-19 : 13:31:52', 'obed admitted a new tenant (Ann Tenant) at 2023-10-19 : 13:31:52', 'YES'),
(27, 'Admin (obed)', '2023-10-19 : 13:34:01', 'obed added a new rental invoice (INV20231019133401) for tenant (Ann Tenant) at 2023-10-19 : 13:34:01.', 'YES'),
(28, 'Admin (obed)', '2023-10-19 : 13:35:21', 'obed added payment of 3000 for Ann Tenant, under invoice ID: INV20231019133401', 'YES'),
(29, 'Admin (obed)', '2023-10-19 : 13:37:33', 'obed added a new house (The Palatial House) with 1 rentable units, and 5 bedrooms per unit located in Nairobi Cbd', 'YES'),
(30, 'Admin (obed)', '2023-10-19 : 13:39:10', 'obed admitted a new tenant (Someone Watching) at 2023-10-19 : 13:39:10', 'YES'),
(31, 'Admin (obed)', '2023-10-19 : 13:41:19', 'obed added a new rental invoice (INV20231019134119) for tenant (Someone Watching) at 2023-10-19 : 13:41:19.', 'YES'),
(32, 'Admin (obed)', '2023-10-19 : 13:42:34', 'obed added payment of 70000 for Someone Watching, under invoice ID: INV20231019134119', 'YES'),
(33, 'Admin (obed)', '2024-01-25 : 10:17:45', 'obed added a new house (Telposta House) with 12 rentable units, and 2 bedrooms per unit located in Mvita', 'YES'),
(34, 'Admin (obed)', '2024-09-03 : 14:31:39', 'obed added a new house (Apartment) with 4 rentable units, and 4 bedrooms per unit located in Mtongwe', 'YES'),
(35, 'Admin (obed)', '2024-09-03 : 14:33:24', 'obed added a new rental invoice (INV20240903143324) for tenant (Someone Watching) at 2024-09-03 : 14:33:24.', 'YES'),
(36, 'Admin (obed)', '2024-09-03 : 14:39:25', 'obed admitted a new tenant (Ines) at 2024-09-03 : 14:39:25', 'YES'),
(37, 'Admin (obed)', '2024-09-03 : 15:55:27', 'obed added a new house (Apartment) with 3 rentable units, and 4 bedrooms per unit located in Nairobi Cbd', 'YES'),
(38, 'Admin (obed)', '2024-09-03 : 16:26:17', 'obed added a new house (Apartment) with 5 rentable units, and 4 bedrooms per unit located in Kacyiru', 'YES'),
(39, 'Admin (obed)', '2024-09-03 : 16:27:42', 'obed added a new house (Apartment) with 5 rentable units, and 4 bedrooms per unit located in Kacyiru', 'YES'),
(45, 'Admin (obed)', '2024-09-03 : 17:26:34', 'obed added a new house (Apartment) with 5 rentable units, and 4 bedrooms per unit located in kabuga', 'YES'),
(46, 'Admin (obed)', '2024-09-04 : 09:21:03', 'obed added payment of 880 for Ann Tenant, under invoice ID: INV20231019133401', 'YES'),
(47, 'Admin (obed)', '2024-09-04 : 09:21:54', 'obed added payment of 880 for Ann Tenant, under invoice ID: INV20231019133401', 'YES'),
(48, 'Admin (obed)', '2024-09-04 : 09:23:29', 'obed admitted a new tenant (Ines) at 2024-09-04 : 09:23:29', 'YES'),
(49, 'Admin (obed)', '2024-09-04 : 09:24:19', 'obed admitted a new tenant (Ines) at 2024-09-04 : 09:24:19', 'YES'),
(50, 'Admin (obed)', '2024-09-04 : 14:37:24', 'obed added a new house (Apartment) with 5 rentable units, and 4 bedrooms per unit located in kabuga', 'YES'),
(51, 'Admin (obed)', '2024-09-04 : 14:58:16', 'obed added a new house (Apartment) with 5 rentable units, and 4 bedrooms per unit located in kabuga', 'YES'),
(52, 'Admin (obed)', '2024-09-04 : 15:27:33', 'obed added a new house (Apartment) with 5 rentable units, and 4 bedrooms per unit located in kabuga', 'YES'),
(53, 'Admin (obed)', '2024-09-04 : 15:57:17', 'obed admitted a new tenant (Ines) at 2024-09-04 : 15:57:17', 'YES'),
(54, 'Admin (inestoni25)', '2024-09-05 : 14:53:13', 'inestoni25 added a new house (Home) with 7 rentable units, and 5 bedrooms per unit located in Kinyinya', 'YES'),
(55, 'Admin (inestoni25)', '2024-09-05 : 14:55:07', 'inestoni25 added a new house (Home) with 7 rentable units, and 5 bedrooms per unit located in Kanombe', 'YES'),
(56, 'Admin (inestoni25)', '2024-09-05 : 15:21:10', 'inestoni25 added a new house (House) with 7 rentable units, and 5 bedrooms per unit located in Kiyovu', 'YES'),
(57, 'Admin (inestoni25)', '2024-09-06 : 09:43:03', 'inestoni25 added a new house (Apartment) with 5 rentable units, and 3 bedrooms per unit located in Kanombe', 'YES'),
(58, 'Admin (inestoni25)', '2024-09-06 : 11:22:55', 'inestoni25 added a new house (House) with 7 rentable units, and 4 bedrooms per unit located in Kinyinya', 'YES'),
(59, 'Admin (inestoni25)', '2024-09-06 : 11:54:44', 'inestoni25 added a new house (House) with 7 rentable units, and 4 bedrooms per unit located in Kinyinya', 'YES'),
(60, 'Admin (inestoni25)', '2024-09-06 : 11:57:29', 'inestoni25 added a new house (House) with 7 rentable units, and 4 bedrooms per unit located in Kinyinya', 'YES'),
(61, 'Admin (inestoni25)', '2024-09-06 : 12:00:27', 'inestoni25 added a new house (House) with 7 rentable units, and 4 bedrooms per unit located in Kinyinya', 'YES'),
(62, 'Admin (inestoni25)', '2024-09-06 : 12:05:24', 'inestoni25 added a new house (House) with 7 rentable units, and 4 bedrooms per unit located in Kinyinya', 'YES'),
(63, 'Admin (inestoni25)', '2024-09-06 : 17:35:11', 'inestoni25 added a new house (Appartment) with 4 rentable units, and 2 bedrooms per unit located in Kimihurura', 'YES'),
(64, 'Admin (inestoni25)', '2024-09-07 : 04:48:39', 'inestoni25 added a new house (Apartment) with 5 rentable units, and 3 bedrooms per unit located in kabuga', 'YES'),
(65, 'Admin (inestoni25)', '2024-09-07 : 04:50:20', 'inestoni25 added payment of 300 for , under invoice ID: INV20240903143324', 'YES'),
(66, 'Admin (inestoni25)', '2024-09-07 : 05:25:17', 'inestoni25 added a new house (Apartment) with 5 rentable units, and 3 bedrooms per unit located in kabuga', 'YES');

-- --------------------------------------------------------

--
-- Structure for view `invoicesview`
--
DROP TABLE IF EXISTS `invoicesview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `invoicesview`  AS SELECT `invoices`.`invoiceNumber` AS `invoiceNumber`, `tenants`.`tenant_name` AS `tenant_name`, `invoices`.`tenantID` AS `tenantID`, `tenants`.`phone_number` AS `phone_number`, `invoices`.`amountDue` AS `amountDue`, `invoices`.`dateOfInvoice` AS `dateOfInvoice`, `invoices`.`dateDue` AS `dateDue`, `invoices`.`status` AS `status`, `invoices`.`comment` AS `comment` FROM (`invoices` left join `tenants` on(`invoices`.`tenantID` = `tenants`.`tenantID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `paymentsview`
--
DROP TABLE IF EXISTS `paymentsview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `paymentsview`  AS SELECT `payments`.`paymentID` AS `paymentID`, `payments`.`tenantID` AS `tenantID`, `tenantsview`.`tenant_name` AS `tenant_name`, `tenantsview`.`house_name` AS `house_name`, `payments`.`invoiceNumber` AS `invoiceNumber`, `payments`.`expectedAmount` AS `expectedAmount`, `payments`.`amountPaid` AS `amountPaid`, `payments`.`balance` AS `balance`, `payments`.`mpesaCode` AS `mpesaCode`, `payments`.`dateofPayment` AS `dateofPayment`, `payments`.`comment` AS `comment` FROM (`payments` left join `tenantsview` on(`payments`.`tenantID` = `tenantsview`.`tenantID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `tenantsview`
--
DROP TABLE IF EXISTS `tenantsview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tenantsview`  AS SELECT `tenants`.`tenantID` AS `tenantID`, `tenants`.`houseNumber` AS `houseNumber`, `tenants`.`tenant_name` AS `tenant_name`, `tenants`.`email` AS `email`, `tenants`.`ID_number` AS `ID_number`, `tenants`.`profession` AS `profession`, `tenants`.`phone_number` AS `phone_number`, `tenants`.`dateAdmitted` AS `dateAdmitted`, `tenants`.`agreement_file` AS `agreement_file`, `houses`.`house_name` AS `house_name`, `houses`.`number_of_rooms` AS `number_of_rooms`, `houses`.`house_status` AS `house_status`, `houses`.`rent_amount` AS `rent_amount`, `houses`.`houseID` AS `houseID` FROM (`tenants` left join `houses` on(`tenants`.`houseNumber` = `houses`.`houseID`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogid` (`blogid`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`houseID`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoiceNumber`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`paymentID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`tenantID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `houseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `tenantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
