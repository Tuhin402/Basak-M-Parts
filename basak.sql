-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 04, 2025 at 01:55 PM
-- Server version: 10.6.21-MariaDB-cll-lve
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `basak`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_bnr`
--

CREATE TABLE `about_bnr` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_bnr`
--

INSERT INTO `about_bnr` (`id`, `title`, `image`) VALUES
(2, 'Basak M Store – Offering necessary car parts in India', '1741103568_about.webp');

-- --------------------------------------------------------

--
-- Table structure for table `about_headshot`
--

CREATE TABLE `about_headshot` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `des` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_headshot`
--

INSERT INTO `about_headshot` (`id`, `title`, `des`) VALUES
(1, 'Introduction', 'Welcome to Basak M Store, your premier destination for fashion-forward clothing and accessories. We pride ourselves on offering a curated selection of rare and beautiful items sourced both locally and globally. Our mission is to bring you the latest trends and timeless styles, ensuring every piece reflects quality and elegance. Discover the perfect addition to your car parts at Basak M Store.'),
(3, 'Our Vision', 'Welcome to Basak M Store, your premier destination for fashion-forward clothing and accessories. We pride ourselves on offering a curated selection of rare and beautiful items sourced both locally and globally. Our mission is to bring you the latest trends and timeless styles, ensuring every piece reflects quality and elegance. Discover the perfect addition to your car parts at Basak M Store.'),
(4, 'What Sets Us Apart', 'Welcome to Basak M Store, your premier destination for fashion-forward clothing and accessories. We pride ourselves on offering a curated selection of rare and beautiful items sourced both locally and globally. Our mission is to bring you the latest trends and timeless styles, ensuring every piece reflects quality and elegance. Discover the perfect addition to your car parts at Basak M Store.'),
(5, 'Our Commitment', 'Welcome to Basak M Parts, your premier destination for fashion-forward clothing and accessories. We pride ourselves on offering a curated selection of rare and beautiful items sourced both locally and globally. Our mission is to bring you the latest trends and timeless styles, ensuring every piece reflects quality and elegance. Discover the perfect addition to your car parts at Basak M Parts.');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, '', 'admin@gmail.com', '590f8626e4709b66aa57fa3d0f13950c'),
(2, 'Tuhin Sarkar', 'tuhinsarkar581@gmail.com', '4a7d1ed414474e4033ac29ccb8653d9b');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `b2c_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `b2c_image`) VALUES
(4, '1741156877_b2c banner.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `banner_two`
--

CREATE TABLE `banner_two` (
  `id` int(11) NOT NULL,
  `b2b_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banner_two`
--

INSERT INTO `banner_two` (`id`, `b2b_image`) VALUES
(2, '1741156888_b2b banner.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `call_req`
--

CREATE TABLE `call_req` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `b2c_id` int(11) DEFAULT NULL,
  `b2b_id` int(11) DEFAULT NULL,
  `pro_id` int(11) NOT NULL,
  `qty` decimal(10,0) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `shipping_price` decimal(10,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `b2c_id`, `b2b_id`, `pro_id`, `qty`, `total_price`, `shipping_price`, `date`) VALUES
(54, NULL, 1, 64, 5, 5711.25, 70.00, '2025-04-02 11:26:40'),
(63, 1, NULL, 56, 1, 0.90, 20.00, '2025-04-04 11:57:20'),
(66, 2, NULL, 56, 1, 0.90, 20.00, '2025-04-04 14:45:56'),
(67, NULL, 1, 81, 1, 413.40, 50.00, '2025-04-04 16:57:12');

-- --------------------------------------------------------

--
-- Table structure for table `category_company`
--

CREATE TABLE `category_company` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_company`
--

INSERT INTO `category_company` (`id`, `cat_id`, `company_id`) VALUES
(7, 1, 3),
(8, 1, 3),
(13, 1, 6),
(14, 1, 6),
(15, 1, 6),
(16, 1, 6),
(17, 1, 6),
(18, 1, 6),
(19, 1, 6),
(20, 1, 6),
(21, 1, 6),
(22, 1, 6),
(23, 1, 6),
(24, 1, 6),
(25, 1, 6),
(26, 1, 6),
(27, 1, 6),
(28, 1, 6),
(29, 1, 6),
(30, 1, 6),
(31, 1, 6),
(32, 1, 6),
(33, 1, 6),
(34, 1, 6),
(35, 1, 6),
(36, 1, 6),
(37, 1, 6),
(38, 1, 6),
(39, 1, 6),
(40, 1, 6),
(41, 1, 6),
(42, 1, 6),
(43, 3, 7),
(44, 3, 3),
(45, 2, 26),
(46, 1, 26),
(47, 1, 26),
(48, 1, 26),
(49, 1, 26),
(50, 1, 26),
(51, 1, 26),
(52, 1, 26),
(53, 1, 26),
(54, 1, 26),
(55, 1, 26),
(56, 1, 26),
(57, 1, 26),
(58, 1, 26),
(59, 1, 26),
(60, 1, 26),
(61, 1, 26),
(62, 1, 26),
(63, 1, 26),
(64, 1, 26),
(65, 1, 26),
(66, 1, 26),
(67, 1, 26),
(68, 4, 13),
(69, 4, 13),
(70, 1, 6),
(71, 1, 6),
(72, 1, 6),
(73, 1, 6),
(74, 1, 6),
(75, 1, 6),
(76, 1, 6),
(77, 2, 29),
(78, 2, 29),
(79, 2, 29),
(80, 2, 29),
(81, 2, 29),
(82, 2, 29);

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `image`) VALUES
(7, '1743757294_WhatsApp Image 2025-03-25 at 13.16.11_130ca47d.jpg'),
(8, '1743757219_GST CERTIFICATE_page-0001.jpg'),
(9, '1743757135_MSMS_CERTIFICATE_BASAK_page-0001.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `sort_order`, `name`, `image`) VALUES
(3, 3, 'HERO', '1742371584_hero.png'),
(6, 7, 'INEL/ NIPPON', '1743518670_logo.png'),
(7, 9, 'NAPINO', '1743518683_1597232172147.jpg'),
(8, 11, 'LUMAX', '1743518695_LUMAXIND.NS_BIG-80633668.png'),
(9, 13, 'UNO MINDA', '1743518710_UNOMINDA.NS_BIG-ae49e1e3.png'),
(10, 10, 'VARROC', '1743518723_VARROC.NS_BIG-3882ad26.png'),
(11, 12, 'OSRAM', '1743518734_png-clipart-osram-text-osram-logo-icons-logos-emojis-iconic-brands.png'),
(12, 2, 'TVS', '1743518758_0b77a61ba7f8810d715dedde29875272.png'),
(13, 4, 'YAMAHA', '1743518769_4ff509a7f661b99574cb6b0d86e14232.jpg'),
(14, 6, 'HONDA', '1743518783_honda engine oil.jpg'),
(15, 5, 'BAJAJ', '1743518799_a28abb0824fdd58d2367676a6bbb3921.webp'),
(16, 1, 'ROYAL ENFIELD', '1743518825_Royal-Enfield-Logo.png'),
(17, 14, 'LISPART', '1743518991_IMG-20190719-WA0000_edited_edited.webp'),
(18, 15, 'ARB', '1743519014_product-jpeg-250x250.webp'),
(19, 16, 'SPARK MINDA', '1743519035_sparkminda.png'),
(20, 17, 'STEELBIRD', '1743519056_steelbird.png'),
(24, 18, 'NAPINO CABLE', '1743576233_1597232172223147.jpg'),
(26, 8, 'LUCAS TVS', '1743576292_unnamed.webp'),
(27, 19, 'PAVNA', '1743576385_pavna-industries-limited--600.png'),
(28, 20, 'ADVIK', '1743576405_41.-ADVIK-HI-TECH-PVT-.LTD_.jpg'),
(29, 21, 'MK LIDE', '1743576426_1630608522687.jpg'),
(30, 22, 'MK', '1743576439_images.png'),
(31, 23, 'CHAMPION', '1743576466_Champion-logo-sm-1732130048282.png'),
(32, 24, 'FIEM', '1743576656_fiem-industries--600.png'),
(33, 25, 'IFB', '1743576675_images.jpg'),
(34, 26, 'MAKINO', '1743576694_images (1).png'),
(35, 27, 'GAE', '1743576720_gulati_auto_electricals_cover.jpg'),
(36, 28, 'RMP', '1743576733_images (2).png'),
(37, 29, 'TEXPIN', '1743576747_logo.png'),
(38, 30, 'AR', '1743576768_unnamed (1).png'),
(39, 31, 'ZODIX', '1743576795_unnamed.png'),
(40, 32, 'JK TYRE', '1743576816_AR-131029931.jpgmaxW618cci_ts20131026142356-001.jpg'),
(41, 33, 'CEAT', '1743576844_a9c6b7103611879.Y3JvcCwxMjc4LDEwMDAsMzYwLDA.jpg'),
(42, 34, 'MRF', '1743576854_MRF-Tyres-logo-1500x1100.png');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `helpline` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `open_date` varchar(30) NOT NULL,
  `open_time` varchar(30) NOT NULL,
  `map` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `phone`, `helpline`, `email`, `address`, `open_date`, `open_time`, `map`) VALUES
(2, '011 69 313 567', '011 69 313 567', 'office@basakmparts.com', 'Murshidabad, West Bengal', 'Saturday - Thursday', '10:00 AM - 8:00 PM   IST', 'https://www.google.com/maps/place/Basak+M+Parts/@24.1806768,88.2734874,17z/data=!3m1!4b1!4m6!3m5!1s0x39fbd657ec77d3d1:0x2ef469369fddf658!8m2!3d24.1806719!4d88.2760623!16s%2Fg%2F11bzt9s74d?authuser=0&entry=ttu&g_ep=EgoyMDI1MDMyNS4xIKXMDSoASAFQAw%3D%3D');

-- --------------------------------------------------------

--
-- Table structure for table `offline_sell`
--

CREATE TABLE `offline_sell` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `part` varchar(50) NOT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `price` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `totalprice` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `shiprocket_order_id` bigint(20) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_mobile` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `landmark` varchar(255) DEFAULT NULL,
  `pin` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `hsn` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `razorpay_order_id` varchar(255) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `ship_status` varchar(20) NOT NULL,
  `order_status` varchar(40) NOT NULL,
  `refund_status` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_cancel`
--

CREATE TABLE `order_cancel` (
  `id` int(11) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `shiprocket_order_id` bigint(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `acc_no` varchar(50) NOT NULL,
  `ifsc` varchar(30) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `branch_add` varchar(100) NOT NULL,
  `banking_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `des` text NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `order_status` varchar(40) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_notice` text NOT NULL,
  `admin_proof` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_refund`
--

CREATE TABLE `order_refund` (
  `id` int(11) NOT NULL,
  `order_id` varchar(150) NOT NULL,
  `shiprocket_order_id` bigint(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `acc_no` varchar(50) NOT NULL,
  `ifsc` varchar(30) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `branch_add` varchar(255) NOT NULL,
  `banking_name` varchar(100) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `des` text NOT NULL,
  `payment_status` varchar(30) NOT NULL,
  `refund_status` varchar(50) NOT NULL,
  `image_1` varchar(255) NOT NULL,
  `image_2` varchar(255) NOT NULL,
  `image_3` varchar(255) NOT NULL,
  `image_4` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_notice` text NOT NULL,
  `admin_proof` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `other_dispatch`
--

CREATE TABLE `other_dispatch` (
  `id` int(11) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `shiprocket_order_id` bigint(20) NOT NULL,
  `confinement_id` varchar(150) NOT NULL,
  `tracking_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `other_dispatch`
--

INSERT INTO `other_dispatch` (`id`, `order_id`, `shiprocket_order_id`, `confinement_id`, `tracking_link`) VALUES
(3, 'ORD-FDF7893B3D', 797852403, 'BVKVI3191YBLLEBBU835Y', 'https://codezsolsinfotech.com');

-- --------------------------------------------------------

--
-- Table structure for table `popular_picks_b2b`
--

CREATE TABLE `popular_picks_b2b` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `popular_picks_b2b`
--

INSERT INTO `popular_picks_b2b` (`id`, `title`, `link`, `image`) VALUES
(1, 'Spare Parts', 'http://localhost/Basak/products-list.php?cat_id=2', '1741162359_body_parts.webp'),
(3, 'fdjfj', 'https://www.youtube.com/watch?v=sdpxddDzXfE', '1743606220_banner.png');

-- --------------------------------------------------------

--
-- Table structure for table `popular_picks_b2c`
--

CREATE TABLE `popular_picks_b2c` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `popular_picks_b2c`
--

INSERT INTO `popular_picks_b2c` (`id`, `title`, `link`, `image`) VALUES
(1, 'Get Extra Discount', 'http://localhost/Basak/products-list.php?cat_id=1', '1743595618_003.jpg'),
(5, 'OFFER', 'http://localhost/Basak/products-list.php?cat_id=1', '1743748690_002.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `privacy`
--

CREATE TABLE `privacy` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `des` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `privacy`
--

INSERT INTO `privacy` (`id`, `title`, `des`) VALUES
(4, 'What is Basak M Parts?', 'Basak M Parts.com is a ecom platform where we sell various motorcycles parts. This company incorporated under the laws of India, having its registered office at SIRAJDULLAH ROAD, LALBAGH, Murshidabad, WestBengal,742149 (\"Company\") and its mobile and tablet applications (\"Platforms\"), which inter alia facilitates the purchase of car part products sold by the Company under the various brands (\"Products\") to the users of the Platforms (\"Users\").'),
(5, 'What is this Privacy Policy?', 'This privacy policy (the Privacy Policy), together with the terms of use, describes the Companys policies and procedures on the collection, use, retention and disclosure of the information provided by Users and Visitors (as defined herein below) of the Platforms. The Company shall not use the Users information in any manner except as provided under this Privacy Policy. Every User who accesses or uses the Platforms shall be bound by this Privacy Policy.'),
(6, 'Why is this Privacy Policy?', 'This Privacy Policy is published pursuant to:\r\nSection 43A of the Information Technology Act, 2000;\r\nRegulation 4 of the Information Technology (Reasonable Security Practices and Procedures and Sensitive Personal Information) Rules, 2011 (SPI Rules);\r\nRegulation 3(1) of the Information Technology (Intermediaries Guidelines) Rules, 2011.\r\nThis Privacy Policy sets out the type of information collected from the Users, including the nature of the sensitive personal data or information, the purpose, means and modes of usage of such information and how and to whom the Company shall disclose such information.'),
(7, 'What Type Of Information Is Covered By This Privacy Policy?', 'The Privacy Policy applies to information collected and processed by the Company consisting of following -\r\nPersonal information is information related to a User, (adult and child) or a combination of pieces of information that could reasonably allow him to be identified. Personal information may consist of full name, personal contact numbers, email address, gender or date of birth\r\nSensitive personal data or information is such personal information that is collected, received, stored, transmitted or processed by the Company, consisting of:\r\nPassword;\r\nFinancial information such as bank account or credit card or debit card or other payment instrument details;\r\nPhysical, physiological and mental health condition;\r\nSexual orientation;\r\nMedical records and history;\r\nBiometric information\r\nAny detail relating to the above personal information categories as provided to the Company for providing service; and Any of the information received under above personal information categories by the Company for processing, stored or processed under lawful contract or otherwise.\r\nPlease note that any information that is freely available or accessible in public domain or furnished under the Right to Information Act, 2005 or any other law for the time being in force shall not be regarded as sensitive personal information.'),
(8, 'Users Note', '5.1. A condition of each Users use of and access to the Platforms and to other services provided by the Company to Users (collectively referred to as the Services), is his/her/its acceptance of the terms of use which also involves acceptance of the terms of this Privacy Policy. Any User who does not agree with any provisions of the Terms of Use or this Privacy Policy is advised not to accept the Terms of Use and may leave the Platforms.\r\n5.2. While browsing the Platforms, a User is not required to provide personal information as set out under paragraph 4.1 and paragraph 4.2 until and unless such User chooses to avail or sign up for any of the Services. All the information provided to the Company by a User, including personal information and personally identifiable information, is voluntary. The User has the right to request the withdrawal of his/her/its consent at any time, in accordance with the terms of this Privacy Policy and the Terms of Use. It is the Users duty to ensure strict caution while giving out any personally identifiable information about himself/herself/itself or his/her family members in use of any of the Services. The Company does not endorse the content, messages or information found in any Services and therefore, the Company specifically disclaims any liability with regard to the Services and any actions resulting from the Users participation in any Services. As a condition to use the Services, you as a User agree to waive any claims against the Company relating to the same, and to the extent such waiver may be ineffective, you agree to release any claims against the Company relating to the same.\r\n5.3. Users can access, modify, correct and remove the data about him/her/their or his/her/their child which has been collected pursuant to his/her/its decision to become a User. Any grievances in relation to the information shared by the User with the Company may be brought to the attention of grievance officer in accordance with clause 7 of this Privacy Policy.\r\n5.4. For the use of the Services and purchase of Products, you may be required to pay the Company with a credit card, wire-transfer, or debit card through the Companys third party payment gateway provider and such third party payment gateway provider may be required to collect certain financial information from you including, but not restricted to, your credit/debit card number or your bank account details (collectively referred to as Financial Information). All Financial Information collected from the Users by the Company\'s third-party payment gateway providers will be used only for billing and payment processes. The verification of the Financial Information shall be accomplished only by the User through a process of authentication in which the Company shall have no role to play.\r\n5.5. Personal information, personally identifiable information and / or Financial Information shall be collected by the Company as regular course of Service, without need for further, separate consent from the User (aside from the acceptance of this Privacy Policy, as provided in paragraph 5.1) for one or more of the following reasons:\r\n5.5.1 to identify the User, to understand his/her/its needs and resolve disputes, if any;\r\n5.5.2 to set up, manage and offer products and to enhance the Services to meet the Users requirements;\r\n5.5.3 to provide ongoing service;\r\n5.5.4 to meet legal and regulatory requirements;\r\n5.5.5 to resolve technical issues and troubleshoot problems;\r\n5.5.6 to aid the Company in collecting monies from Users for transactions carried out on the Platforms;\r\n5.5.7 to keep Users apprised of the Companys (or third parties) promotions and offers;\r\n5.5.8 to customize User experience with respect to service;\r\n5.5.9 to detect and protect the Company from error, fraud and other criminal activities;\r\n5.5.10 to enforce the Terms of Use;\r\n5.5.11 other reasons which, prior to being put into effect, shall be communicated to the Users through an update carried out to this Privacy Policy.\r\n5.6. The Financial Information collected from the Users is transacted through secure digital platforms of approved payment gateways which are under encryption, thereby complying with reasonably expected technology standards. While the Company shall make reasonable endeavours to ensure that the Users personal information and the Financial Information is duly protected by undertaking security measures prescribed under applicable laws, the User is strongly advised to exercise discretion while providing personal information or Financial Information while using the Services given that the Internet is susceptible to security breaches.\r\n5.7. The Company does not exercise control over the websites displayed as search results or links from within the Services. These other sites may place their own cookies or other files on the Users computer, collect data or solicit personal information or Financial Information from the Users, for which the Company shall not be held responsible or liable. The Company does not make any representations concerning the privacy practices or policies of such third parties or terms of use of such websites, nor does the Company guarantee the accuracy, integrity, or quality of the information, data, text, software, sound, photographs, graphics, videos, messages or other materials available on such websites. The inclusion or exclusion does not imply any endorsement by the Company of such websites, the websites provider, or the information on the website.\r\n5.8. The Company has implemented security policies, rules and technical measures, as required under applicable law including firewalls, transport layer security and other physical and electronic security measures to protect the Financial Information and personal information that it has under its control from unauthorized access, improper use or disclosure, unauthorized modification and unlawful destruction or accidental loss. It is expressly stated that the Company shall not be responsible for any breach of security or for any action of any third parties that receive Users personal data or events that are beyond the reasonable control of the Company including, acts of government, computer hacking, unauthorized access to computer data and storage device, computer crashes, breach of security and encryption, etc.\r\n5.9. The Company may be required to disclose personal information or Financial Information to governmental institutions or authorities when such disclosure is requisitioned under any law or judicial decree or when the Company, in its sole discretion, deems it necessary in order to protect its rights or the rights of others, to prevent harm to persons or property, to fight fraud and credit risk, or to enforce or apply the Terms of Use.\r\n5.10. All information collected from the Users by the Company is maintained in digital form on servers and/or cloud systems and shall be accessible by certain employees of the Company. The User information may also be converted to physical form from time to time. Regardless of the manner of storage, the Company shall make commercially reasonable endeavours to ensure that the User information is rendered confidential and will disclose User information only in accordance with the terms of this Privacy Policy.'),
(9, 'Visitors Note', '6.1. No personal information or Financial Information is automatically collected from any visitors of the Platforms who are merely perusing or browsing the Platforms (Visitor). Nevertheless, the provisions of this Privacy Policy are applicable to Visitors, and Visitors are required to read, understand and accept the privacy statements set out herein, failing which they are required to leave the Platforms immediately.\r\n6.2. A User will not merely be a Visitor if the User has willingly submitted any personal information or Financial Information (including phone numbers, email addresses, responses to surveys, etc.) to the Company through any means, including email, telephone calls, telephonic messaging or while availing or signing-up for the Services. All such Visitors will be deemed to be, and will be treated as Users for the purposes of this Privacy Policy, and in which case, all the statements in this Privacy Policy shall apply to the User.\r\n6.3. If you, as a Visitor, have inadvertently browsed any other pages of the Platforms prior to reading the privacy statements set out herein, and you do not agree with the manner in which such information is obtained, stored or used, merely quitting the Platforms should ordinarily clear all temporary cookies installed by the Company. All Visitors, however, are encouraged to use the clear cookies functionality on their browsers to ensure such clearing or deletion, as the Company cannot guarantee, predict or provide for the behaviour of the equipment of all the Visitors of the Platforms.\r\n6.4. If you are accessing the Platforms from outside India, it is solely your responsibility to ensure that your access does not breach or violate any local or national law applicable in the place from where you are making the access, for the time being in force.'),
(10, 'Data Retention Policy', 'We the Company may retain your Personal Information only as long as we have your consent and/or as long as you are registered on our Platform, and also as required to retain under applicable legal and/or regulatory requirements. The retention of data is reasonably required for the purposes mentioned hereinabove and/or otherwise permitted or required by applicable law and/or regulatory requirements.'),
(11, 'Feedback Or Concern', 'For feedback or concern, if any, kindly contact at:\r\nEmail Address: office@basakmparts.com and basakmparts@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `part` varchar(50) DEFAULT NULL,
  `mrp` varchar(255) NOT NULL,
  `gst` varchar(20) NOT NULL,
  `b2b_price` decimal(10,2) DEFAULT NULL,
  `b2c_price` decimal(10,2) DEFAULT NULL,
  `shipping_price` decimal(10,2) NOT NULL,
  `b2b_discount` decimal(10,2) NOT NULL,
  `b2c_discount` decimal(10,2) NOT NULL,
  `b2c_special_discount` decimal(10,0) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `stock` varchar(255) NOT NULL DEFAULT '0',
  `best_seller` varchar(10) NOT NULL,
  `image_1` varchar(255) DEFAULT NULL,
  `image_2` varchar(255) DEFAULT NULL,
  `image_3` varchar(255) DEFAULT NULL,
  `image_4` varchar(255) DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sort_order`, `name`, `description`, `sku`, `part`, `mrp`, `gst`, `b2b_price`, `b2c_price`, `shipping_price`, `b2b_discount`, `b2c_discount`, `b2c_special_discount`, `cat_id`, `company_id`, `stock`, `best_seller`, `image_1`, `image_2`, `image_3`, `image_4`, `last_updated`) VALUES
(26, 1, 'COIL BASE/ STATOR STAR-CITY 110 (K.s) BS-3 5 POLE WITH 1EX COIL ', 'COIL BASE/ STATOR FOR STAR-CITY 110 (K.s) BS-3 5 POLE WITH 1EX COIL (NIPPON)', '85112010', '51003', '790', '28', 592.50, 750.50, 0.00, 25.00, 5.00, 5, 1, 6, '0', '0', '1743519550_51003 01.jpg', '1743519550_51003 02.jpg', '1743519550_51003 03.jpg', '', '2025-04-04 19:52:45'),
(27, 2, 'COIL BASE/ STATOR STAR-CITY-110 ES BS-3 ', 'COIL BASE/ STATOR FOR STAR-CITY-110 ES BS-3 (NIPPON)', '85112010', '51009', '1168', '28', 876.00, 1109.60, 50.00, 25.00, 5.00, 5, 1, 6, '-1', '0', '1743520063_51009 01.jpg', '1743520063_51009 02.jpg', '1743520063_51009 03.jpg', '', '2025-04-02 09:47:45'),
(28, 3, 'STARTING COIL XL-SUPER', 'STARTING COIL FOR XL-SUPER (NIPPON)', '85112010', '51018', '208', '28', 156.00, 197.60, 20.00, 25.00, 5.00, 5, 1, 6, '20', '0', '1743521173_51018 01.jpg', '1743521173_51018 02.jpg', '1743521173_51018 03.jpg', '', '2025-04-01 15:26:13'),
(29, 4, 'PICKUP COIL APACHE BS3', 'PICKUP COIL FOR APACHE BS3 (NIPPON)', '85112010', '51019', '140', '28', 105.00, 133.00, 20.00, 25.00, 5.00, 5, 1, 6, '25', '0', '1743521311_51019 01.jpg', '1743521311_51019 02.jpg', '1743521311_51019 03.jpg', '', '2025-04-01 15:28:31'),
(30, 5, 'COIL BASE/ STATOR RTR EFI-BS-3 8 POLE ', 'COIL BASE/ STATOR FOR RTR EFI-BS-3 8 POLE (NIPPON)', '85112010', '51021', '1418', '28', 1063.50, 1347.10, 50.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743521433_51021 01.jpg', '1743521433_51021 02.jpg', '1743521433_51021 03.jpg', '', '2025-04-01 15:30:33'),
(31, 6, 'FWM COIL PLATE ASSY RTR-160/180 ', 'FWM COIL PLATE ASSY FOR RTR-160/180 (NIPPON)', '85112010', '51024', '1141', '28', 855.75, 1083.95, 50.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743521611_51024 01.jpg', '1743521611_51024 02.jpg', '1743521611_51024 03.jpg', '', '2025-04-01 15:33:31'),
(32, 7, 'ROTOR XL-SUPER BS-3 ', 'ROTOR FOR XL-SUPER BS-3 (NIPPON)', '85112010', '51027', '1050', '28', 787.50, 997.50, 70.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743521969_51027 01.jpg', '1743521969_51027 02.jpg', '1743521969_51027 03.jpg', '', '2025-04-01 15:39:29'),
(33, 8, 'ROTOR SPLENDOR BS-3', 'ROTOR FOR SPLENDOR BS-3 (NIPPON)', '85112010', '51035', '1028', '28', 771.00, 976.60, 70.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743522066_51035 01.jpg', '1743522066_51035 02.jpg', '1743522066_51035 03.jpg', '', '2025-04-01 15:41:06'),
(34, 9, 'LAMP COIL CD-100/ DAWN ', 'LAMP COIL FOR CD-100/ DAWN (NIPPON)', '85112010', '51043', '325', '28', 243.75, 308.75, 50.00, 25.00, 5.00, 5, 1, 6, '10', '0', '1743522168_51043 01.jpg', '1743522168_51043 02.jpg', '1743522168_51043 03.jpg', '', '2025-04-01 15:42:48'),
(35, 10, 'STARTING COIL SPL NEW BS-3 ', 'STARTING COIL FOR SPL NEW BS-3 (NIPPON)', '85112010', '51044', '246', '28', 184.50, 233.70, 20.00, 25.00, 5.00, 5, 1, 6, '13', '0', '1743522262_51044 01.jpg', '1743522262_51044 02.jpg', '1743522262_51044 03.jpg', '', '2025-04-04 08:24:08'),
(36, 11, 'PICKUP COIL SPL/ CD-100 BS3', 'PICKUP COIL FOR SPL/ CD-100 BS3 (NIPPON)', '85112010', '51045', '147', '28', 110.25, 139.65, 20.00, 25.00, 5.00, 5, 1, 6, '15', '0', '1743522452_51045 01.jpg', '1743522452_51045 02.jpg', '1743522452_51045 03.jpg', '', '2025-04-01 15:47:32'),
(37, 12, 'ROTOR STAR SPORT/CITY-HLX100 (E.S) BS-3 ', 'ROTOR FOR STAR SPORT/CITY-HLX100 (E.S) BS-3 (NIPPON)', '85112010', '51065', '1224', '28', 918.00, 1162.80, 70.00, 25.00, 5.00, 5, 1, 6, '4', '0', '1743522573_51065 01.jpg', '1743522573_51065 03.jpg', '1743522573_51065 02.jpg', '', '2025-04-01 15:52:59'),
(38, 13, 'STARTING COIL RX-100/135 BS-2 ', 'STARTING COIL FOR RX-100/135 BS-2 (NIPPON)\r\n', '85112010', '51084', '265', '28', 198.75, 251.75, 20.00, 25.00, 5.00, 5, 1, 6, '9', '0', '1743522988_51084 01.jpg', '1743522988_51084 02.jpg', '1743522988_51084 03.jpg', '', '2025-04-04 14:04:47'),
(39, 14, 'COIL BASE/ STATOR STAR-CITY-110/SPORTS ES BS-3 7POLE', 'COIL BASE/ STATOR FOR STAR-CITY-110/SPORTS ES BS-3 7POLE (NIPPON)', '85112010', '51105', '1067', '28', 800.25, 1013.65, 70.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743523119_51105 01.jpg', '1743523119_51105 02.jpg', '1743523119_51105 03.jpg', '', '2025-04-01 15:58:39'),
(40, 15, 'COIL BASE/ STATOR STAR-SPORT/ CITY (K.S) BS-3 5 POLE ', 'COIL BASE/ STATOR FOR STAR-SPORT/ CITY (K.S) BS-3 5 POLE (NIPPON)', '85112010', '51106', '930', '28', 697.50, 883.50, 70.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743523227_51106 01.jpg', '1743523227_51106 03.jpg', '1743523227_51106 02.jpg', '', '2025-04-01 16:01:03'),
(41, 16, 'COIL BASE/ STATOR VICTOR NM/ PHONIX/ S-CITY+ BS-3 12 POLE', 'COIL BASE/ STATOR FOR VICTOR NM/ PHONIX/ S-CITY+ BS-3 12 POLE (NIPPON)', '85112010', '51116', '1142', '28', 856.50, 1084.90, 70.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743523384_51116 01.jpg', '1743523384_51116 03.jpg', '1743523384_51116 02.jpg', '', '2025-04-01 16:03:04'),
(42, 17, 'ROTOR PASSION-PRO/SPL-PRO ES BS-3', 'ROTOR FOR PASSION-PRO/SPL-PRO ES BS-3 (NIPPON)', '85112010', '51122', '1009', '28', 756.75, 958.55, 70.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743523500_51122 02.jpg', '1743523500_51122 03.jpg', '1743523500_51122 01.jpg', '', '2025-04-01 16:05:00'),
(43, 18, 'PICKUP COIL PASSION-PRO', 'PICKUP COIL FOR PASSION-PRO (NIPPON)', '85112010', '51123', '136', '28', 102.00, 129.20, 20.00, 25.00, 5.00, 5, 1, 6, '20', '0', '1743523621_51123 01.jpg', '1743523621_51123 02.jpg', '1743523621_51123 03.jpg', '', '2025-04-01 16:07:01'),
(44, 19, 'COIL BASE/ STATOR DREAM-YUGA BS-3 12 POLE', 'COIL BASE/ STATOR FOR DREAM-YUGA BS-3 12 POLE (NIPPON)', '85112010', '51131', '970', '28', 727.50, 921.50, 70.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743523730_51131 03.jpg', '1743523730_51131 01.jpg', '1743523730_51131 02.jpg', '', '2025-04-01 16:08:50'),
(45, 20, 'PICKUP COIL S-CITY-110 BS-3', 'PICKUP COIL FOR S-CITY-110 BS-3 (NIPPON)', '85112010', '51133', '155', '28', 116.25, 147.25, 20.00, 25.00, 5.00, 5, 1, 6, '10', '0', '1743524081_51133 01.jpg', '1743524081_51133 02.jpg', '1743524081_51133 03.jpg', '', '2025-04-01 16:14:41'),
(46, 21, 'COIL BASE/ STATOR ACTIVA-110 BS-3 6 POLE', 'COIL BASE/ STATOR FOR ACTIVA-110 BS-3 6 POLE (NIPPON)', '85112010', '51140', '1159', '28', 869.25, 1101.05, 70.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743524221_51140 02.jpg', '1743524221_51140 01.jpg', '1743524221_51140 03.jpg', '', '2025-04-01 16:17:01'),
(47, 22, 'ROTOR RTR 160/180 BS-3', 'ROTOR FOR RTR 160/180 BS-3 (NIPPON)', '85112010', '51143', '1339', '28', 1004.25, 1272.05, 70.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743524334_51143 03.jpg', '1743524334_51143 01.jpg', '1743524334_51143 02.jpg', '', '2025-04-01 16:18:54'),
(48, 23, 'ROTOR STAR SPORT KS BS-3', 'ROTOR FOR STAR SPORT KS BS-3 (NIPPON)', '85112010', '51144', '820', '28', 615.00, 779.00, 70.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743524426_51144 01.jpg', '1743524426_51144 03.jpg', '1743524426_51144 02.jpg', '', '2025-04-01 16:20:26'),
(49, 24, 'PICK UP COIL STAR-CITY +', 'PICK UP COIL FOR STAR-CITY + (NIPPON)', '85112010', '51156', '156', '28', 117.00, 148.20, 20.00, 25.00, 5.00, 5, 1, 6, '10', '0', '1743524515_51156 01.jpg', '1743524515_51156 02.jpg', '1743524515_51156 03.jpg', '', '2025-04-01 16:21:55'),
(50, 25, 'COIL BASE/ STATOR XL-100 KS BS-4 ', 'COIL BASE/ STATOR FOR XL-100 KS BS-4 (NIPPON)', '85112010', '51159', '899', '28', 674.25, 854.05, 70.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743524637_51159 02.jpg', '1743524637_51159 01.jpg', '1743524637_51159 03.jpg', '', '2025-04-01 16:23:57'),
(51, 26, 'COIL BASE/ STATOR VICTOR+ 12 POLE', 'COIL BASE/ STATOR FOR VICTOR+ 12 POLE (NIPPON)', '85112010', '51161', '1210', '28', 907.50, 1149.50, 70.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743524738_51161 03.jpg', '1743524738_51161 01.jpg', '1743524738_51161 02.jpg', '', '2025-04-01 16:25:38'),
(52, 27, 'ROTOR VICTOR+ BS-4', 'ROTOR FOR VICTOR+ BS-4 (NIPPON)', '85112010', '51162', '1301', '28', 975.75, 1235.95, 70.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743524833_51162 03.jpg', '1743524833_51162 01.jpg', '1743524833_51162 02.jpg', '', '2025-04-01 16:27:13'),
(53, 28, 'PICK UP COIL TVS XL 100 ', 'PICK UP COIL  FOR TVS XL 100 (NIPPON)', '85112010', '51166', '134', '28', 100.50, 127.30, 20.00, 25.00, 5.00, 5, 1, 6, '15', '0', '1743524953_51166 01.jpg', '1743524953_51166 02.jpg', '1743524953_51166 03.jpg', '', '2025-04-01 16:29:13'),
(54, 29, 'COIL BASE/ STATOR ACTIVA-125 HET BS-3', 'COIL BASE/ STATOR FOR ACTIVA-125 HET BS-3 (NIPPON)', '85112010', '51170', '1063', '28', 797.25, 1009.85, 70.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743525063_51170 02.jpg', '1743525063_51170 01.jpg', '1743525063_51170 03.jpg', '', '2025-04-01 16:31:03'),
(55, 30, 'COIL BASE/ STATOR SHINE OLD BS-3 8 POLE', 'COIL BASE/ STATOR FOR SHINE OLD BS-3 8 POLE (NIPPON)', '85112010', '51171', '1064', '28', 798.00, 1010.80, 70.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743525177_51171 01.jpg', '1743525177_51171 03.jpg', '1743525177_51171 02.jpg', '', '2025-04-01 16:32:57'),
(56, 31, 'ACC CABLE SPL+/ PASSION+ ', 'ACC CABLE SPL+/ PASSION+ (VDO)', '87149990', '8002', '90', '28', 54.00, 85.50, 20.00, 40.00, 5.00, 5, 3, 7, '39', 'yes', '1743525377_8002 01 copy.jpg', '1743525377_8002 02.jpg', '1743525377_8002 03.jpg', '1743525377_8002 04.jpg', '2025-04-04 19:51:55'),
(57, 32, 'BRAKE CABLE GLAMOUR NM', 'BRAKE CABLE GLAMOUR NM (HERO)', '87141090', '45450KTRA20S', '150', '28', 123.00, 150.00, 20.00, 18.00, 0.00, 5, 3, 3, '7', 'no', '1743525904_45450KTRA20S 01.jpg', '1743525904_45450KTRA20S 02.jpg', '1743525904_45450KTRA20S 03.jpg', '', '2025-04-04 16:31:55'),
(58, 33, 'BENDIX/PINION  STARTER ASSEMBLY ACTIVA-100CC (LUCAS)', 'BENDIX/PINION  STARTER ASSEMBLY FOR ACTIVA-100CC', '85114000', '26025166', '705', '28', 528.75, 669.75, 20.00, 25.00, 5.00, 5, 2, 26, '10', 'yes', '1743577055_26025166 01.jpg', '1743577055_26025166 02.jpg', '1743577055_26025166 03.jpg', '', '2025-04-04 07:47:38'),
(59, 34, 'SELF MOTOR ACTIVA 5G NM/ MEASTRO/ PLEASURE/ DIO-110 (31200KWPH010M1) (LUCAS) WITH WIRING', 'SELF MOTOR FOR ACTIVA 5G NM/ MEASTRO/ PLEASURE/ DIO-110 (31200KWPH010M1) (LUCAS) \r\nWITH WIRING', '85114000', '26024782', '1659', '28', 1244.25, 1576.05, 50.00, 25.00, 5.00, 5, 1, 26, '5', '0', '1743577293_26024782 01.jpg', '1743577293_26024782 02.jpg', '1743577293_26024782 03.jpg', '', '2025-04-02 07:01:33'),
(60, 35, 'SELF MOTOR ACTIVA-3G/ ACCESS NM (LUCAS)', 'SELF MOTOR FOR ACTIVA-3G/ ACCESS NM (LUCAS)', '85114000', '26261568', '1330', '28', 997.50, 1263.50, 70.00, 25.00, 5.00, 5, 1, 26, '5', '0', '1743578556_COMMING SOON.jpg', '', '', '', '2025-04-02 07:22:36'),
(61, 36, 'SELF MOTOR ACTIVA/AVIATOR/DIO/CLIQ/DUET/NAVI (LUCAS)', 'SELF MOTOR FOR ACTIVA/AVIATOR/DIO/CLIQ/DUET/NAVI (LUCAS)', '85114000', '26025131', '1756', '28', 1317.00, 1668.20, 70.00, 25.00, 5.00, 5, 1, 26, '5', '0', '1743578799_26025131 01.jpg', '1743578799_26025131 02.jpg', '1743578799_26025131 03.jpg', '', '2025-04-02 07:26:39'),
(62, 37, 'SELF MOTOR BS-6 Destini 125/Duet, Maestro Edge/125/Pleasure/110 plus, Pleasure 110', 'SELF MOTOR FOR BS-6 Destini 125/Duet, Maestro Edge/125/Pleasure/110 plus, Pleasure 110', '85114000', '26024655', '1489', '28', 1116.75, 1414.55, 70.00, 25.00, 5.00, 5, 1, 26, '5', '0', '1743578951_26024655 01.jpg', '1743578951_26024655 02.jpg', '1743578951_26024655 03.jpg', '', '2025-04-02 07:29:11'),
(63, 38, 'SELF MOTOR BS-6 SSPL/I-SMART/PASS-XTEC/P-PRO/SPL-I3S/GLMR-FI-XTEC-I3S-XTEC/SSPL-FI (LUCAS)', 'SELF MOTOR FOR BS-6 SUPER SPLELNOR/I-SMART/PASSION-XTEC/PASSION-PRO/SPLENDOR-I3S/GLAMOUR-FI-XTEC-I3S-XTEC/SUPER SPLENDOR-FI (LUCAS)', '85114000', '26024794', '1454', '28', 1090.50, 1381.30, 70.00, 25.00, 5.00, 5, 1, 26, '5', '0', '1743579101_26024794 01.jpg', '1743579101_26024794 02.jpg', '1743579101_26024794 03.jpg', '', '2025-04-02 07:34:32'),
(64, 39, 'SELF MOTOR BS-6 TVS JUPITER-110/ STAR-CITY (LUCAS)', 'SELF MOTOR FOR BS-6 TVS JUPITER-110/ STAR-CITY (LUCAS) \r\nTVS GENUINE PART NO K6060570', '85114000', '26024992', '1523', '28', 1142.25, 1446.85, 70.00, 25.00, 5.00, 5, 1, 26, '-27', 'yes', '1743579467_26024992 01.jpg', '1743579467_26024992 02.jpg', '1743579467_26024992 03.jpg', '', '2025-04-04 16:58:24'),
(65, 40, 'SELF MOTOR DISCOVER-100/125 (LUCAS)', 'SELF FOR MOTOR DISCOVER-100/125 (LUCAS)', '85114000', '26024671', '1299', '28', 974.25, 1234.05, 70.00, 25.00, 5.00, 5, 1, 26, '5', '0', '1743580311_26024671 01.jpg', '1743580311_26024671 02.jpg', '1743580311_26024671 03.jpg', '', '2025-04-02 07:51:51'),
(66, 41, 'SELF MOTOR FZ/ FAZER-V1 CLAMP MODEL (LUCAS)', 'SELF MOTOR FOR FZ/ FAZER-V1 WITH CLAMP MODEL (LUCAS)', '85114000', '26024563', '1775', '28', 1331.25, 1686.25, 70.00, 25.00, 5.00, 5, 1, 26, '5', '0', '1743580455_26024563 01.jpg', '1743580455_26024563 02.jpg', '1743580455_26024563 03.jpg', '', '2025-04-02 07:54:15'),
(67, 42, 'SELF MOTOR I-SMART-100/110 (LUCAS)', 'SELF MOTOR FOR I-SMART-100/110 (LUCAS)', '85114000', '26046112', '1693', '28', 1269.75, 1608.35, 70.00, 25.00, 5.00, 5, 1, 26, '5', '0', '1743580667_26046112 01.jpg', '1743580667_26046112 02.jpg', '1743580667_26046112 03.jpg', '', '2025-04-02 07:57:47'),
(68, 43, 'SELF MOTOR N-TORQ/ JUPITOR-125 WITH 2 WIRE AND CUPLAR (LUCAS) OE KL060020', 'SELF MOTOR FOR N-TORQ/ JUPITOR-125 WITH 2 WIRE AND CUPLAR (LUCAS) \r\nTVS GENUINE PART NO: KL060020', '85114000', '26024744', '1872', '28', 1404.00, 1778.40, 70.00, 25.00, 5.00, 5, 1, 26, '5', '0', '1743581602_26024744 01.jpg', '1743581602_26024744 02.jpg', '1743581602_26024744 03.jpg', '', '2025-04-02 08:13:22'),
(69, 44, 'SELF MOTOR PASS-PRO-I3S/SPL-PRO-PLUS-I3S/SPL I-SMARTOLD/NXG/HF-CD-HD-DLX', 'SELF MOTOR FOR PASSION-PRO-I3S/SPLENDOR-PRO-SPLENDOR PLUS-I3S/SPLENDOR I-SMART OLD/NXG/HF-CD-HD-DLX', '85114000', '26046091', '1515', '28', 1136.25, 1439.25, 70.00, 25.00, 5.00, 5, 1, 26, '5', '0', '1743581804_26046091 01.jpg', '1743581804_26046091 02.jpg', '1743581804_26046091 03.jpg', '', '2025-04-02 08:16:44'),
(70, 45, 'SELF MOTOR PEP/PEP+ (LUCAS)', 'SELF MOTOR FOR PEP/PEP+ (LUCAS)\r\nTVS GENUINE PART NO: K3060060', '85114000', '26025172A', '1366', '28', 1024.50, 1297.70, 70.00, 25.00, 5.00, 5, 1, 26, '5', '0', '1743582365_COMMING SOON.jpg', '', '', '', '2025-04-02 08:26:05'),
(71, 46, 'SELF MOTOR PHOENIX/ JIVE/ VICTOR NM/ FLAME (LUCAS)', 'SELF MOTOR FOR PHOENIX/ JIVE/ VICTOR NM/ FLAME (LUCAS)\r\nTVS GENUINE PART NO: N4060080', '85114000', '26024632', '2113', '28', 1584.75, 2007.35, 70.00, 25.00, 5.00, 5, 1, 26, '5', '0', '1743582816_26024632 01.jpg', '1743582816_26024632 02.jpg', '1743582816_26024632 03.jpg', '', '2025-04-02 08:33:36'),
(72, 47, 'SELF MOTOR PLEASURE 102cc (LUCAS)', 'SELF MOTOR FOR PLEASURE 102cc LUCAS', '85114000', '26024548', '1575', '28', 1181.25, 1496.25, 70.00, 25.00, 5.00, 5, 1, 26, '5', '0', '1743583411_26024548 01.jpg', '1743583411_26024548 02.jpg', '1743583411_26024548 03.jpg', '', '2025-04-02 08:43:31'),
(73, 48, 'SELF MOTOR PULSAR 150/180 (LUCAS)', 'SELF MOTOR FOR PULSAR 150/180 (LUCAS)', '85114000', '26024440', '1428', '28', 1071.00, 1356.60, 70.00, 25.00, 5.00, 5, 1, 26, '5', '0', '1743583546_26024440 01.jpg', '1743583546_26024440 02.jpg', '1743583546_26024440 03.jpg', '', '2025-04-02 08:45:46'),
(74, 49, 'SELF MOTOR RAY-125/ ALPHA/ FASCINO (LUCAS)', 'SELF MOTOR FOR RAY-125/ ALPHA/ FASCINO (LUCAS)', '85114000', '26046095', '1711', '28', 1283.25, 1625.45, 70.00, 25.00, 5.00, 5, 1, 26, '5', '0', '1743583705_26046095 01.jpg', '1743583705_26046095 02.jpg', '1743583705_26046095 03.jpg', '1743583705_26046095 04.jpg', '2025-04-02 08:48:25'),
(75, 50, 'SELF MOTOR RTR-160/180 2V (LUCAS)', 'SELF MOTOR FOR RTR-160/180 2V (LUCAS)\r\nTVS GENUINE PART NO: M1060060', '85114000', '26024757', '2094', '28', 1570.50, 1989.30, 70.00, 25.00, 5.00, 5, 1, 26, '5', '0', '1743584070_COMMING SOON.jpg', '', '', '', '2025-04-02 08:54:30'),
(76, 51, 'SELF MOTOR SHINE/STUNNER/HUNK/ACHIVER/AMBITION/IMPULSE/XPLUSE-200/XTREME/IGNITOR (LUCAS)', 'SELF MOTOR FOR SHINE/STUNNER/HUNK/ACHIVER/AMBITION/IMPULSE/XPLUSE-200/XTREME/IGNITOR (LUCAS)', '85114000', '26046090', '1961', '28', 1470.75, 1862.95, 70.00, 25.00, 5.00, 5, 1, 26, '5', '0', '1743584324_26046090 01.jpg', '1743584324_26046090 02.jpg', '1743584324_26046090 03.jpg', '', '2025-04-02 08:58:44'),
(77, 52, 'SELF MOTOR STAR CITY/SPORTS (LUCAS)', 'SELF MOTOR FOR STAR CITY/SPORTS (LUCAS)\r\nTVS GENUINE PART NO: N8060250', '85114000', '26024564', '1729', '28', 1296.75, 1642.55, 70.00, 25.00, 5.00, 5, 1, 26, '5', '0', '1743584451_26024564 01.jpg', '1743584451_26024564 02.jpg', '1743584451_26024564 03.jpg', '', '2025-04-02 09:00:51'),
(78, 53, 'SELF MOTOR SUPER SPLENDOR 2POLE (LUCAS)', 'SELF MOTOR FOR SUPER SPLENDOR 2POLE (LUCAS)', '85114000', '26046103', '1689', '28', 1266.75, 1604.55, 70.00, 25.00, 5.00, 5, 1, 26, '5', '0', '1743584574_26046103 01.jpg', '1743584574_26046103 02.jpg', '1743584574_26046103 03.jpg', '', '2025-04-02 09:02:54'),
(79, 54, 'SELF MOTOR WEGO/ ZEST/ JUPITOR 100CC (LUCAS)', 'SELF MOTOR FOR WEGO/ ZEST/ JUPITOR 100CC (LUCAS)\r\nTVS GENUINE PART NO: K6060200', '85114000', '26024450', '2075', '28', 1556.25, 1971.25, 70.00, 25.00, 5.00, 5, 1, 26, '5', '0', '1743584806_26024450 01.jpg', '1743584806_26024450 02.jpg', '1743584806_26024450 03.jpg', '', '2025-04-02 09:06:46'),
(80, 55, 'SELF MOTOR DREAM YUGA/CD-100/NEO/TWISTER (LUCAS)', 'SELF MOTOR FOR DREAM YUGA/CD-100/NEO/TWISTER (LUCAS) WITH WIRING\r\nHONDA GENUINE PART NO: 31200-K1494930-M1', '85114000', '26024590', '1772', '28', 1329.00, 1683.40, 70.00, 25.00, 5.00, 5, 1, 26, '5', '0', '1743584964_26024590 01.jpg', '1743584964_26024590 02.jpg', '1743584964_26024590 03.jpg', '', '2025-04-02 09:11:53'),
(81, 56, 'YAMALUBE SPORTY PREMIUM 10W40 1L', 'YAMALUBE SPORTY PREMIUM 10W40 1L', '27101972', '90793AD426', '530', '18', 413.40, 508.80, 50.00, 22.00, 4.00, 5, 4, 13, '7', 'yes', '1743604428_Untitled-1 copy.jpg', '', '', '', '2025-04-04 16:58:17'),
(82, 57, 'YAMALUBE OPTIMA 10W40 1L', 'YAMALUBE OPTIMA 10W40 1L', '27101972', '90793AD410', '430', '18', 335.40, 412.80, 50.00, 22.00, 4.00, 5, 4, 13, '20', '0', '1743604610_Untitled-1 cop000y.jpg', '', '', '', '2025-04-02 14:36:50'),
(83, 58, 'COIL BASE/ STATOR XL-100 KS BS-4 (NIPPON)', 'COIL BASE/ STATOR for XL-100 KS BS-4 (NIPPON)', '85112010', '51195', '899', '28', 674.25, 854.05, 50.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743610545_51195 01.jpg', '1743610545_51195 02.jpg', '1743610545_51195 03.jpg', '', '2025-04-02 16:15:45'),
(84, 59, 'COIL BASE/ STATOR DLX/ SPL+ ES BS-4 12 POLE (NIPPON)', 'COIL BASE/ STATOR FOR DLX/ SPL+ ES BS-4 12 POLE (NIPPON)', '85112010', '51237', '1071', '28', 803.25, 1017.45, 50.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743610651_51237 01.jpg', '1743610651_51237 02.jpg', '1743610651_51237 03.jpg', '', '2025-04-02 16:17:31'),
(85, 60, 'COIL BASE/ STATOR GLAMOUR/ PASSION-PRO 12 POLE  (NIPPON)', 'COIL BASE/ STATOR FOR GLAMOUR/ PASSION-PRO 12 POLE  (NIPPON)', '85112010', '51238', '1043', '28', 782.25, 990.85, 50.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743610781_51238 03.jpg', '1743610781_51238 01.jpg', '1743610781_51238 02.jpg', '', '2025-04-02 16:19:41'),
(86, 61, 'COIL BASE/ STATOR SPLENDOR-PRO/ PASSIN-PRO BS-3 8 POLE (NIPPON)', 'COIL BASE/ STATOR FOR SPL-PRO/ PASSIN-PRO BS-3 8 POLE (NIPPON)', '85112010', '51240', '819', '28', 614.25, 778.05, 50.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743610909_51240 01.jpg', '1743610909_51240 02.jpg', '1743610909_51240 03.jpg', '', '2025-04-02 16:21:49'),
(87, 62, 'COIL BASE/ STATOR HAYETHE BS-3 (NIPPON)', 'COIL BASE/ STATOR FOR HAYETHE BS-3 (NIPPON)', '85112010', '51241', '804', '28', 603.00, 763.80, 50.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743611017_51241 01.jpg', '1743611017_51241 02.jpg', '1743611017_51241 03.jpg', '', '2025-04-02 16:23:37'),
(88, 63, 'COIL BASE/ STATOR REDION/ STAR-ITY/ S-SPORTS KS/ SPORT  BS-6  (NIPPON)', 'COIL BASE/ STATOR FOR REDION/ STAR-CITY/ STAR-SPORTS KS/ SPORT  BS-6  (NIPPON)', '85112010', '51245', '1237', '28', 927.75, 1175.15, 50.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743611143_51245 01.jpg', '1743611143_51245 02.jpg', '1743611143_51245 03.jpg', '', '2025-04-02 16:25:43'),
(89, 64, 'ROTOR REDION/ STAR-CITY+/ STAR SPORTS KS/ STAR SPORT ES/ BS-6 (NIPPON)', 'ROTOR FOR REDION/ S-CITY+/ SPORTS KS/ SPORT ES/ BS-6 (NIPPON)', '85112010', '51246', '1264', '28', 948.00, 1200.80, 70.00, 25.00, 5.00, 5, 1, 6, '5', '0', '1743611432_51246 01.jpg', '1743611432_51246 04.jpg', '1743611432_51246 03.jpg', '1743611432_51246 02.jpg', '2025-04-02 16:30:32'),
(90, 65, 'CLUTCH ASSY BS-6 S-SPL/GLAMOUR (MK)', 'CLUTCH ASSY BS-6 S-SPL/GLAMOUR (MK)', '87141090', '110211', '850', '28', 637.50, 807.50, 50.00, 25.00, 5.00, 5, 2, 29, '6', '0', '1743687711_110211 04.jpg', '1743687711_110211 01.jpg', '1743687711_110211 02.jpg', '1743687711_110211 03.jpg', '2025-04-03 13:41:51'),
(91, 66, 'CLUTCH ASSY 4S/BOXER-AT-AR/CALIBER (MK)', 'CLUTCH ASSY FOR 4S/BOXER-AT-AR/CALIBER (MK)', '87149990', '170205', '816', '28', 489.60, 734.40, 50.00, 40.00, 10.00, 5, 2, 29, '6', '0', '1743746829_COMMING SOON.jpg', '', '', '', '2025-04-04 06:07:09'),
(94, 67, 'CLUTCH ASSY BS 6 LIVO/ SHINE-SP/ 125  (MK)', 'CLUTCH ASSY FOR BS 6 LIVO/ SHINE-SP/ 125  (MK)\r\nINCLUDING RUBBER CLUTCH PALTE FOR A SMOOTH RIDING EXPERIENCE ', '87141090', '120214', '905', '28', 543.00, 769.25, 50.00, 40.00, 15.00, 5, 2, 29, '-6', 'yes', '1743747198_120214 01.jpg', '1743747198_120214 02.jpg', '1743747198_120214 03.jpg', '1743747198_120214 04.jpg', '2025-04-04 17:15:23'),
(95, 68, 'CLUTCH ASSY BS-4 SUPER SPLENDOR 3-LEGS (MK)', 'CLUTCH ASSY FOR BS-4 SUPER SPL 3-LEGS (MK)', '87141090', '110218', '878', '28', 526.80, 790.20, 50.00, 40.00, 10.00, 5, 2, 29, '6', '0', '1743748177_COMMING SOON.jpg', '', '', '', '2025-04-04 06:29:37');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `sort_order`, `category`, `image`) VALUES
(1, 2, 'Auto Electrical', '1743613314_Untitled-2 (1).jpeg'),
(2, 5, 'Spare Parts', '1743615444_Untitled-2 (4).jpeg'),
(3, 4, 'Cables', '1743610162_Untitled-2 (3).jpeg'),
(4, 7, 'Lubricant', '1743604735_Untitled (8).jpeg'),
(5, 6, 'Nut Bolt & Spring', '1743596133_nuts-bolts.jpeg'),
(6, 3, 'Body Parts', '1738344930_body_parts.webp'),
(7, 8, 'Tyre Tube', '1743596178_kisspng-car-continental-ag-motorcycle-tires-motorcycle-tir-continental-exquisite-metal-frame-pattern-5adca4f95e1ea8.2206777215244095933855.png'),
(8, 1, 'Accessories', '1738344986_Accessories.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `review` text NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `product_id`, `name`, `review`, `rating`, `created_at`) VALUES
(7, 36, 'Ayan Bag', 'Good Product..', 5, '2025-04-04 13:53:38'),
(8, 57, 'Ayan Bag', 'good product', 5, '2025-04-04 13:56:06'),
(9, 58, 'Tuhin Sarkar', 'good product', 5, '2025-04-04 13:56:06'),
(10, 58, 'Mamon', 'Nice product', 5, '2025-04-04 13:58:13'),
(11, 58, 'Mamon', 'Nice product', 5, '2025-04-04 13:59:14'),
(12, 82, 'Biswajit Bag', 'GOOD Engine Oil . Value For money', 5, '2025-04-04 14:03:52');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `name`, `email`, `phone`, `address`, `type`, `password`, `date`) VALUES
(1, 'Tuhin Sarkar', 'tuhinsarkar581@gmail.com', '6291996890', 'Dankuni', 'user', 'MDAwMA==', '2025-03-09 09:54:58'),
(2, 'Sagar Kewat', 'sagarsins@gmail.com', '7789876543', 'Salt Lake City, GD 382, FD Block, Sector 3, Bidhannagar, Kolkata, West Bengal 700106', 'admin', 'MTIzNA==', '2025-03-09 10:23:53');

-- --------------------------------------------------------

--
-- Table structure for table `reg_btob`
--

CREATE TABLE `reg_btob` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address_one` varchar(255) NOT NULL,
  `address_two` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `landmark` varchar(255) NOT NULL,
  `pin` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `c_password` varchar(255) NOT NULL,
  `otp` varchar(20) NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `gst` varchar(255) NOT NULL,
  `shop_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reg_btob`
--

INSERT INTO `reg_btob` (`id`, `name`, `email`, `phone`, `address_one`, `address_two`, `state`, `district`, `landmark`, `pin`, `password`, `c_password`, `otp`, `business_name`, `gst`, `shop_image`, `created_at`) VALUES
(1, 'Sagar Kewat', 'sagarsins@gmail.com', '7789876543', 'Garalgacha', '', 'West Bengal', 'Hooghly', 'Mandir', '712708', '$2y$10$YcRJGK/Sr2UWBYJrKYMxDuGnsMrMuG/9/wVVq779TL9qE4/iNf44e', '$2y$10$YcRJGK/Sr2UWBYJrKYMxDuGnsMrMuG/9/wVVq779TL9qE4/iNf44e', '', 'Freelancing', 'GH97240NB0U2IN', '', '2025-02-28 17:25:26');

-- --------------------------------------------------------

--
-- Table structure for table `reg_btoc`
--

CREATE TABLE `reg_btoc` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address_one` varchar(255) NOT NULL,
  `address_two` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `landmark` varchar(255) NOT NULL,
  `pin` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `c_password` varchar(255) NOT NULL,
  `otp` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reg_btoc`
--

INSERT INTO `reg_btoc` (`id`, `name`, `email`, `phone`, `address_one`, `address_two`, `state`, `district`, `landmark`, `pin`, `password`, `c_password`, `otp`, `created_at`) VALUES
(1, 'Tuhin Sarkar', 'tuhinsarkar581@gmail.com', '6291996890', '43, Rabindranagar, Dankuni Hooghly', '', 'West Bengal', 'Hooghly', 'Shree Ramkrishna Sishutirtha High School', '712311', '$2y$10$YcRJGK/Sr2UWBYJrKYMxDuGnsMrMuG/9/wVVq779TL9qE4/iNf44e', '$2y$10$YcRJGK/Sr2UWBYJrKYMxDuGnsMrMuG/9/wVVq779TL9qE4/iNf44e', '', '2025-01-30 08:49:55'),
(2, 'Surjava Basak', 'surjavabasak@gmail.com', '9614992122', 'Siraj Ud Doullah Road', 'Registry Office Junction', 'West Bengal', 'Murshidabad ', 'Neer Nashipur Rajbati', '742149', '$2y$10$D2MhG3uikZZzVAgdEoPS5e7PPW6lOKvnSV8dbQC4JK1GHU0yUoZTO', '$2y$10$D2MhG3uikZZzVAgdEoPS5e7PPW6lOKvnSV8dbQC4JK1GHU0yUoZTO', '', '2025-04-04 14:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `return_policy`
--

CREATE TABLE `return_policy` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `des` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `return_policy`
--

INSERT INTO `return_policy` (`id`, `title`, `des`) VALUES
(6, 'What is Basak M Parts?', 'A ecom platform in Murshidabad. A company incorporated under the laws of India, having its registered store and warehouse at SIRAJDULLAH ROAD, LALBAGH, Murshidabad, West Bengal, 742149.'),
(7, 'What Is This Return And Refund Policy?', '2.1 In keeping with Basak M Part\'s goal of ensuring User satisfaction, this return and refund Policy (Return and Refund Policy), together with the Terms of Use, sets out Basak M Parts procedures and policies in accepting Product returns, once a Product has been delivered to a User after purchase from the Platforms. Any return of Products by Users shall be governed by and subject to the terms and conditions set out under this Return and Refund Policy.\r\n\r\n2.2 Users are required to peruse and understand the terms of this Return and Refund Policy. If you do not agree to the terms contained in this Return and Refund Policy, you are advised not to accept the Terms of Use and may forthwith leave and stop using the Platforms. The terms contained in this Return and Refund Policy shall be accepted without modification and you agree to be bound by the terms contained herein by initiating a request for purchase of Product(s) on the Platforms.'),
(8, 'Terms Of Return And Refund', '3.0.1 For B2C\r\nYes, we accept returns. \r\nA. Products that have been invoiced or dispatched from Basak M Parts can only be returned or exchanged as per Basak M Parts returns policy.\r\nB. Returns will be accepted only in cases when the product does not fit your bike/scooty or wrong/damaged product was delivered to you.\r\nC.  In cases where an incorrect product was ordered by the customer, shipping and handling charges will be deducted. \r\nD. Change of mind after dispatch of the product from Basak M Parts or after receiving of the product by customer will not be considered a valid reason for returning a product.\r\nF. Any return request has to be raised within 3 days of receiving the order. Requests raised after the 3 days, window would not be processed.\r\nG. All products need to be returned in their original packaging and should reach back to us within 10 days of a return request getting accepted Return Orders received back to our warehouse after a window of 10 days from the date of return request acceptance would not be eligible for refund.\r\n\r\n3.0.2 For B2B\r\nBASAK M PARTS offers cancellation & refund before products are invoiced. All you have to do is to notify us via email within 12 hours of your order, or press the Cancel Order button on your My Order page For cancellation, you need to contact office@basakmparts.com with your order number or call us.\r\nRefunds will be given between 2 to 5 working days.\r\n\r\n\r\n3.0.3 In all events of cancellation, prior to the dispatch of the purchased Products, Basak M Part shall initiate refunds within 5 (five) business days from the date on which it received the request from the User. The refund will reflect in the Users bank account within such reasonable time (subject to the policies of the Users bank in case of bank account/credit card refunds) from the date on which Basak M Parts initiates the refund. All refunds shall be subject to applicable charges as may be deducted by the Users bank.'),
(9, 'Grievance Redressal', 'Any grievances relating to the Return and Refund Policy may be directed by you to the grievance officer of Codezsols Infotech who can be contacted at office@basakmparts.com'),
(10, 'How do I pay for a Basak M Part  purchase?', 'Basak M Parts offers you multiple payment methods. Whatever your online mode of payment, you can rest assured that Basak M Part\'s trusted payment gateway partners use secure encryption technology to keep your transaction details confidential at all times.\r\n\r\nYou may use Internet Banking, Cash on Delivery and Wallet to make your purchase.\r\n\r\nBasak M Part also accepts payments made using Visa, MasterCard, Maestro and American Express credit/debit cards in India.'),
(11, 'What is Cash on Delivery?', 'If you are not comfortable making an online payment on basakmparts.com, you can opt for the Cash on Delivery (C-o-D) payment method instead. With C-o-D you can pay in cash at the time of actual delivery of the product at your doorstep, without requiring you to make any advance payment online. The maximum order value for a Cash on Delivery (C-o-D) payment is ?50,000. It is strictly a cash-only payment method. Gift Cards or store credit cannot be used for C-o-D orders. Foreign currency cannot be used to make a C-o-D payment. Only Indian Rupees accepted.'),
(12, 'How do I pay using a credit/debit card?', 'We accept payments made by credit/debit cards issued in India.\r\n\r\nWe accept payments made using Visa, MasterCard and American Express credit cards.\r\n\r\nWe accept payments made using Visa, MasterCard and Maestro debit cards.\r\n\r\nTo pay using your debit card at checkout, you will need your card number, expiry date (optional for Maestro cards), three-digit CVV number (optional for Maestro cards). You will then be redirected to your bank\'s secure page for entering your online password (issued by your bank) to complete the payment.\r\n\r\nInternationally issued credit/debit cards cannot be used for Flyte, Wallet and eGV payments/top-ups.'),
(13, 'What steps does Basak M Part take to prevent card fraud?', 'Basak M Part realizes the importance of a strong fraud detection and resolution capability. We and our online payments partners monitor transactions continuously for suspicious activity and flag potentially fraudulent transactions for manual verification by our team.\r\n\r\nIn the rarest of rare cases, when our team is unable to rule out the possibility of fraud categorically, the transaction is kept on hold, and the customer is requested to provide identity documents. The ID documents help us ensure that the purchases were indeed made by a genuine card holder. We apologise for any inconvenience that may be caused to customers and request them to bear with us in the larger interest of ensuring a safe and secure environment for online transactions.');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `des` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `rating` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `title`, `des`, `name`, `rating`) VALUES
(2, 'Customer Service!', 'Purchased a cable for my scooty.. its very good. They deliver within 5 days', 'Soma Maity', '4'),
(3, 'Variety of Styles!', 'Fantastic shop! Great selection, fair prices, and friendly staff. Highly recommended. The quality of the products is exceptional, and the prices are very reasonable!', 'Samsul Yemin', '5'),
(4, 'Good Products', 'Fantastic shop! Great selection, fair prices, and friendly staff. Highly recommended. The quality of the products is exceptional, and the prices are very reasonable!', 'Monimohan Mondal', '3');

-- --------------------------------------------------------

--
-- Table structure for table `ship`
--

CREATE TABLE `ship` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `des` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ship`
--

INSERT INTO `ship` (`id`, `title`, `des`) VALUES
(5, 'What are the delivery charges?', 'Delivery charge varies with each Seller.\r\n\r\nSellers incur relatively higher shipping costs on low value items. In such cases, charging a nominal delivery charge helps them offset logistics costs. Please check your order summary to understand the delivery charges for individual products.\r\n\r\nUsually, the shipping charge is calculated as a fixed fee for the first piece in order and thereafter it increases as per the total pieces of products. In the case of large products like rear mudguard, tail panel, visor, etc, additional shipping is charged as per the actual size of the material. For example, the typical shipping charge for a rear mudguard is approx. 200-500. Depending upon the availability of courier service at your location, and distance this amount can vary.\r\n\r\nRs 20 to 500 charge for delivery per item may be applied if the order value is less than Rs 2500. While, orders of Rs 2500 or above for B2C Customer are delivered free.'),
(6, 'Why does the delivery date not correspond to the delivery timeline of X-Y business days?', 'It is possible that the courier partners have a holiday between the day your placed your order and the date of delivery, which is based on the timelines shown on the product page. In this case, we add a day to the estimated date. Some courier partners do not work on Sundays and this is factored in to the delivery dates.\r\n\r\nBasak M Parts only use highly reliable e-commerce friendly couriers like Delhivery, Ecart, DTDC etc to deliver your order at your door step. After receiving your order, we complete the despatch process in just 24 hours. we deliver all India, order delivery will take 2-7 days to arrive.(Note: In exceptional case, delivery can take more time than expected.)'),
(7, 'What is the estimated delivery time?', 'Basak M Parts generally procure and ship the items within the time specified on the product page. Business days exclude public holidays and Sundays.\r\n\r\nEstimated delivery time depends on the following factors:\r\nThe destination to which you want the order shipped to and location of the Seller.\r\nOrder delivery will take 2-7 days to arrive.(Note: In exceptional case, delivery can take more time than expected.)\r\n\r\nOnce we dispatch your order, you will receive order tracking button on My Order Page or link via WhatsApp/ SMS/ email. You can also track your order at this link. You can also track your order from your Track Order option on your Basak M Parts account. We request you to please wait for 24 hours after ordering to receive your order tracking details\r\nAll orders are despatch from the warehouse of Basak M Parts, Murshidabad, West Bengal'),
(8, 'Are there any hidden costs (sales tax, octroi etc) on items?', 'There are NO hidden charges when you make a purchase on Basak M Part. List prices are final and all-inclusive. The price you see on the product page is exactly what you would pay. Delivery charges are not hidden charges and are charged (if at all) extra depending on the Seller\'s shipping policy.'),
(10, 'Basak M Parts does not/cannot ship to my area. Why?', 'Please enter your pincode on the product page (you don\'t have to enter it every single time) to know whether the product can be delivered to your location. If you haven\'t provided your pincode until the checkout stage, the pincode in your shipping address will be used to check for serviceability.\r\n\r\nWhether your location can be serviced or not depends on\r\nWhether Basak M Parts ships to your location\r\nLegal restrictions, if any, in shipping particular products to your location\r\nThe availability of reliable courier partners in your location\r\n\r\nAt times Basak M Parts prefer not to ship to certain locations. This is entirely at their discretion.'),
(11, 'Why is the CoD option not offered in my location?', 'Availability of CoD depends on the ability of our courier partner servicing your location to accept cash as payment at the time of delivery. Our courier partners have limits on the cash amount payable on delivery depending on the destination and your order value might have exceeded this limit. Please enter your pin code on the product page to check if CoD is available in your location.'),
(12, 'What do the different tags like \"In Stock\", \"Available\" mean?', '\'In Stock\'\r\nFor items listed as \"In Stock\", Sellers will mention the delivery time based on your location pincode (usually 2-3 business days, 4-5 business days or 4-6 business days in areas where standard courier service is available). For other areas, orders will be sent by Registered Post through the Indian Postal Service which may take 1-2 weeks depending on the location.\r\n\r\n\'Available\'\r\nThe Seller might not have the item in stock but can procure it when an order is placed for the item. The delivery time will depend on the estimated procurement time and the estimated shipping time to your location.\r\n\r\n\'Preorder\' or \'Forthcoming\'\r\nSuch items are expected to be released soon and can be pre-booked for you. The item will be shipped to you on the day of it\'s official release launch and will reach you in 2 to 6 business days. The Preorder duration varies from item to item. Once known, release time and date is mentioned. (Eg. 5th May, August 3rd week)\r\n\r\n\'Out of Stock\'\r\nCurrently, the item is not available for sale. Use the \'Notify Me\' feature to know once it is available for purchase.\r\n\r\n\'Imported\'\r\nSometimes, items have to be sourced by Sellers from outside India. These items are mentioned as \'Imported\' on the product page and can take at least 10 days or more to be delivered to you.\r\n\r\n\'Back In Stock Soon\'\r\nThe item is popular and is sold out. You can however \'book\' an order for the product and it will be shipped according to the timelines mentioned by the Seller.\r\n\r\n\'Temporarily Unavailable\'\r\nThe product is currently out of stock and is not available for purchase. The product could to be in stock soon. Use the \'Notify Me\' feature to know when it is available for purchase.\r\n\r\n\'Permanently Discontinued\'\r\nThis product is no longer available because it is obsolete and/or its production has been discontinued.\r\n\r\n\'Out of Print\'\r\nThis product is not available because it is no longer being published and has been permanently discontinued.'),
(13, 'What is the shipping policy for B2B customer?', 'Most orders are billed, packed, and dispatched on the same day of ordering.  The cut-off time is 3PM - 5PM for Same-Day dispatch.  Please note that Same-Day Dispatch is done on the best effortâ€™s basis. Typical wait time before dispatch is 0-2  days for 96% of orders. Sometimes, higher delays can happen due to high demand or products being on backorder.   We will keep you informed regularly via status emails to your registered email ID.');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `phone`, `email`, `address`, `date`, `time`, `image`) VALUES
(3, 'Murshidabad', '011 693 13 567', 'office@basakmparts.com', 'Murshidabad, West Bengal', 'Thursday - Saturday ', '10:00 AM - 8:00 PM', '1741161127_prts.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL,
  `social` varchar(150) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `role`, `social`, `image`) VALUES
(2, 'Lorem Ipsum', 'Courier', 'https://www.youtube.com/watch?v=sdpxddDzXfE', '1741157676_men-9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `des` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `title`, `des`) VALUES
(2, 'What is this Document', '1.1 These terms of use, read together with the (i) Privacy Policy, (ii) Shipping Policy (iii) Return & Refund Policy, a company incorporated under the laws of India, having its registered office SIRAJDULLAH ROAD, LALBAGH, Murshidabad, West Bengal,742149 (\"Basak M Parts\").\r\n\r\n1.2 The Terms of Use, provides the terms that govern your access to use (i) Basak M Parts website, and its mobile, tablet and desktop applications (Platforms), (ii) Basak M Parts online electronics solutions, which facilitates the purchase of electronics, and automation devices sold by Basak M Parts (Products) through the Platforms, and (iii) and any other service that may be provided by Basak M Parts from time to time collectively referred to as the (Services).\r\n\r\n1.3 You hereby understand and agree that the Terms of Use form a binding contract between Basak M Parts and anyone who accesses, browses, or purchases the Products and uses the Services in any manner (User) and accordingly, you hereby agree to be bound by the terms contained in the Terms of Use. If you do not agree to the terms contained in the Terms of Use, you are advised not to proceed with purchasing the Products or using the Services. The terms contained in the Terms of Use shall be accepted without modification. The use of the Services would constitute acceptance of the terms of the Terms of Use.'),
(3, 'Terms & Conditions', '2.1 Users must be 18 years of age or older to register, or visit or use the Services in any manner. By registering, visiting or using the Services, you hereby represent and warrant to Basak M Parts that you are 18 years of age or older, and that you have the right, authority and capacity to use the Services, and agree to abide by the Terms of Use. If a User is below 18 years of age, it is assumed that he/she is using/browsing the Platforms under the supervision of his/her parent or legal guardian and that such Users parent or legal guardian has read and agrees to the terms of this Terms of Use, including terms of purchase of Products, on behalf of the minor User. Should Basak M Parts be made aware that a User is under the age of 18 and is using/browsing the Platforms without the supervision of his/her parent or legal guardian, Basak M Parts reserves the right to deactivate such Users account without further notice.\r\n\r\n2.2 The Terms of Use are governed by the provisions of Indian law, including, but not limited to:\r\n\r\n2.2.1 The Indian Contract Act, 1872;\r\n2.2.2 The Information Technology Act, 2000;\r\n2.2.3 The rules, regulations, guidelines and clarifications framed thereunder, including the Information Technology (Reasonable Security Practices and Procedures and Sensitive Personal Information) Rules, 2011 (SPI Rules) and;\r\n2.2.4 The Information Technology (Intermediaries Guidelines) Rules, 2011 (IG Rules).\r\n\r\n2.3 The contents of Services, information, text, graphics, images, logos, button icons, software code, interface, design and the collection, arrangement and assembly of the content on the Platforms or any of the other Services are the property of Basak M Parts, its parent company, group companies, subsidiaries, associates, affiliates, suppliers, vendors and sister companies, as the case may be (Basak M Parts Content), and are protected under copyright, trademark and other applicable laws. You shall not modify the Basak M Parts Content or reproduce, display, publicly perform, distribute, reverse engineer or otherwise use the Basak M Parts Content in any way for any public or commercial purpose or for personal gain.\r\n\r\n2.4 Basak M Parts authorises you to view and access the Basak M Parts Content solely for identifying Products, carrying out purchases of Products and processing returns and refunds, in accordance with Return and Refund Policy, if any. Basak M Parts, therefore, grants you a limited, revocable permission to access and use the Services. This permission does not include a permission for carrying out any resale of the Products or commercial use of the Basak M Parts Content, any collection and use of product listings, description, or prices, and, any derivative use of the Platforms or of Basak M Parts Content.\r\n\r\n2.5 As means to assist the Users in identifying the Products of their choice, Basak M Parts provides visual representations on the Platforms including graphics, illustrations, photographs, images, videos, charts, screenshots, infographics and other visual aids. While reasonable efforts are made to provide accurate visual representations, Basak M Parts disclaims any guarantee or warranty of exactness of such visual representation or description of the Product, with the actual Product ultimately delivered to Users. The appearance of the Product when delivered may vary for various reasons.'),
(4, 'User Covenants And Obligations', '3.1 As mandated under the provisions of Regulation 3(2) of the IG Rules, Basak M Parts hereby informs you that you are prohibited from hosting, displaying, uploading, modifying, publishing, transmitting, updating or sharing any information that:\r\n\r\n3.1.1 belongs to another person and to which you do not have any right;\r\n3.1.2 is grossly harmful, harassing, blasphemous, defamatory, obscene, pornographic, pedophilic, libelous, invasive of anothers privacy, hateful, or racially, ethnically objectionable, disparaging, relating to or encouraging money laundering or gambling, or otherwise harmful in any manner whatsoever;\r\n3.1.3 harms minors in any way;\r\n3.1.4 infringes any patent, trademark, copyright or other proprietary rights;\r\n3.1.5 violates any law for the time being in force;\r\n3.1.6 deceives or misleads the addressee about the origin of such messages or communicates any information which is grossly offensive or menacing in nature;\r\n3.1.7 impersonates or defames another person; or\r\n3.1.8 contains software viruses or any other computer code, files or programs designed to interrupt, destroy or limit the functionality of any computer resource.\r\n\r\n3.2 You are also prohibited from:\r\n\r\n3.2.1 violating or attempting to violate the integrity or security of the Platforms or the Basak M Parts Content;\r\n3.2.2 transmitting any information on or through the Platforms that is disruptive or competitive to the provision of Services by Basak M Parts;\r\n3.2.3 intentionally submitting on the Platforms, false or inaccurate information;\r\n3.2.4 using any engine, software, tool, agent or other mechanism (such as spiders, robots, avatars, worms, time bombs, Easter eggs, cancel bots, intelligent agents, etc.) to navigate or search the Platforms;\r\n3.2.5 attempting to decipher, decompile, disassemble or reverse engineer any part of the Platforms; or\r\n3.2.6 copying or duplicating in any manner any of the Basak M Parts Content.\r\n\r\n3.4 You hereby authorise Basak M Parts to declare and provide declarations to any Governmental authority on request on your behalf, including that the Products ordered by you are for personal, non-commercial use.'),
(5, 'Waiver', 'Basak M Parts failure to enforce any provision of the Terms of Use or respond to a breach by a User or User shall in no way imply a waiver of Basak M Parts right to subsequently enforce any provision of the terms of the Terms of Use or to act with respect to similar breaches by a User or User.\r\n\r\nPostal Address: SIRAJDULLAH ROAD, LALBAGH, Murshidabad, West Bengal,742149\r\nEmail Address: office@basakmparts.com\r\nbasakmparts@gmail.com'),
(6, 'Interpretation', 'Headings, subheadings, titles, subtitles to clauses, sub-clauses and paragraphs are for information only and shall not form part of the operative provisions of the Terms of Use and shall be ignored in construing the same.\r\n\r\nWords denoting the singular shall include the plural and words denoting any gender shall include all genders.\r\n\r\nThe words include and including are to be construed without limitation.'),
(7, 'Price Change Events', 'Prices are quoted as per MRP decided by brands. However, many times, price changes are known only at the time of shipment. If the MRP label is lower than what you have paid, BASAK M PARTS automatically refunds the amount. Whenever BASAK M PARTS receives a product at higher prices than what has been originally quoted price then, the customer will be notified of the price change and required to pay the difference amount.  A full refund of the already paid amount will always be available if you donâ€™t want to purchase on increased price.'),
(8, 'Product usage B2C', 'Products at basakmparts.com are sold for end users only. By making any purchase at basakmparts.com, you certify that the product purchased at basakmparts.com is for end use only and not meant for any resale or commercial purpose.'),
(9, 'Product usage B2B', 'By making any purchase at basakmparts.com, you certify that the product purchased at basakmparts.com is for retail only and not for any other purpose.'),
(10, 'Order Value for B2B', 'The price of your invoice must be 5000 rupees or above.');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `link`, `image`) VALUES
(1, 'https://youtu.be/OCAYs4jWRDM', '1743774765_Untitled.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `b2c_id` int(11) DEFAULT NULL,
  `b2b_id` int(11) DEFAULT NULL,
  `pro_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `b2c_id`, `b2b_id`, `pro_id`, `date`) VALUES
(12, 1, NULL, 56, '2025-04-04 08:38:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_bnr`
--
ALTER TABLE `about_bnr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `about_headshot`
--
ALTER TABLE `about_headshot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_two`
--
ALTER TABLE `banner_two`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `call_req`
--
ALTER TABLE `call_req`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `b2c_id` (`b2c_id`),
  ADD KEY `b2b_id` (`b2b_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `category_company`
--
ALTER TABLE `category_company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offline_sell`
--
ALTER TABLE `offline_sell`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_offline_sell_product` (`pro_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_cancel`
--
ALTER TABLE `order_cancel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_refund`
--
ALTER TABLE `order_refund`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_dispatch`
--
ALTER TABLE `other_dispatch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popular_picks_b2b`
--
ALTER TABLE `popular_picks_b2b`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popular_picks_b2c`
--
ALTER TABLE `popular_picks_b2c`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacy`
--
ALTER TABLE `privacy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reg_btob`
--
ALTER TABLE `reg_btob`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reg_btoc`
--
ALTER TABLE `reg_btoc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_policy`
--
ALTER TABLE `return_policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ship`
--
ALTER TABLE `ship`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `b2c_id` (`b2c_id`),
  ADD KEY `b2b_id` (`b2b_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_bnr`
--
ALTER TABLE `about_bnr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `about_headshot`
--
ALTER TABLE `about_headshot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `banner_two`
--
ALTER TABLE `banner_two`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `call_req`
--
ALTER TABLE `call_req`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `category_company`
--
ALTER TABLE `category_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offline_sell`
--
ALTER TABLE `offline_sell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `order_cancel`
--
ALTER TABLE `order_cancel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order_refund`
--
ALTER TABLE `order_refund`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `other_dispatch`
--
ALTER TABLE `other_dispatch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `popular_picks_b2b`
--
ALTER TABLE `popular_picks_b2b`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `popular_picks_b2c`
--
ALTER TABLE `popular_picks_b2c`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `privacy`
--
ALTER TABLE `privacy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reg_btob`
--
ALTER TABLE `reg_btob`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reg_btoc`
--
ALTER TABLE `reg_btoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `return_policy`
--
ALTER TABLE `return_policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ship`
--
ALTER TABLE `ship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`b2c_id`) REFERENCES `reg_btoc` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`b2b_id`) REFERENCES `reg_btob` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`pro_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `category_company`
--
ALTER TABLE `category_company`
  ADD CONSTRAINT `category_company_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `product_category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_company_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offline_sell`
--
ALTER TABLE `offline_sell`
  ADD CONSTRAINT `fk_offline_sell_product` FOREIGN KEY (`pro_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `product_category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`b2c_id`) REFERENCES `reg_btoc` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`b2b_id`) REFERENCES `reg_btob` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_3` FOREIGN KEY (`pro_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
