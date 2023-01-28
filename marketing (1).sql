-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2023 at 07:31 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `super_id` int(11) DEFAULT NULL,
  `user_id1` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `super_id`, `user_id1`) VALUES
(1, 'Computers & Labtops', NULL, NULL),
(2, 'Men\'s Fasion', NULL, NULL),
(3, 'Men T-Shirts', 2, NULL),
(4, 'mouse', 1, NULL),
(5, 'computer', 1, NULL),
(6, 'Labtop', 1, NULL),
(7, 'Helth & Bueaty', NULL, NULL),
(8, 'Makeup', 7, NULL),
(9, 'Bags & Shoes', NULL, NULL),
(10, 'Fun & Sports', NULL, NULL),
(11, 'Women\'s Fashion', NULL, NULL),
(12, 'Keyboards', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `country` varchar(30) NOT NULL,
  `street` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `postalCode` varchar(10) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `ordernote` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id`, `firstname`, `lastname`, `email`, `country`, `street`, `city`, `postalCode`, `phone`, `ordernote`) VALUES
(23, 'admin', 'new', 'admin@gmail.com', 'Algeria', '361 St', 'Gaza', '956123', '+970591111111', 'by 8 days12'),
(25, 'admin', 'new', 'admin@gmail.com', 'Algeria', '361 St', 'Gaza', '956123', '+970591111111', 'by 7 days12'),
(30, 'admin', 'new', 'admin@gmail.com', 'India', '361 St.', 'Ax', '956123', '+970591111111', 'not important'),
(31, 'admin', 'mar', 'bader.halimi.tube@gmail.com', 'London', 'Moghrabi St', 'Ax', '956123', '+972595195292', 'By speedly please'),
(32, 'Bader', 'Halimi', 'bader.halimi.tube@gmail.com', 'Palestine', 'Mighrabi', 'Gaza', '00970', '+972595195292', 'nice!!');

-- --------------------------------------------------------

--
-- Table structure for table `google_accounts`
--

CREATE TABLE `google_accounts` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT '',
  `first_name` varchar(50) NOT NULL DEFAULT '',
  `last_name` varchar(50) NOT NULL DEFAULT '',
  `gender` varchar(50) NOT NULL DEFAULT '',
  `full_name` varchar(102) NOT NULL DEFAULT '',
  `picture` varchar(255) NOT NULL DEFAULT '',
  `verifiedEmail` int(100) NOT NULL DEFAULT 0,
  `token` varchar(100) NOT NULL,
  `activate` int(9) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `google_accounts`
--

INSERT INTO `google_accounts` (`id`, `email`, `first_name`, `last_name`, `gender`, `full_name`, `picture`, `verifiedEmail`, `token`, `activate`, `is_active`, `is_admin`) VALUES
(1, 'bader.halimi.tube@gmail.com', 'Bader', 'Al Halimi', '', 'Bader Al Halimi', 'https://lh3.googleusercontent.com/a/AEdFTp6E1Y-xWRjaXlWnmKY7O9oRneGiRxBS3XmM5tzSEQ=s96-c', 1, '111723560239192502650', 424712760, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(20) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `gaccount_id` int(11) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `date_adding` datetime NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `done` tinyint(4) NOT NULL DEFAULT 0,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `checkout_id` int(11) DEFAULT NULL,
  `is_delivered` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `user_id`, `gaccount_id`, `item_id`, `date_adding`, `quantity`, `done`, `is_delete`, `checkout_id`, `is_delivered`) VALUES
(37, 1, NULL, 2, '2022-12-12 09:38:16', 1, 1, 0, 23, 1),
(38, 1, NULL, 5, '2022-12-12 10:45:00', 1, 1, 0, 25, 0),
(39, 1, NULL, 5, '2022-12-12 10:48:12', 3, 1, 0, 23, 0),
(52, 1, NULL, 5, '2022-12-13 10:39:42', 1, 1, 0, 30, 0),
(53, 1, NULL, 2, '2022-12-13 10:47:38', 1, 1, 0, 30, 0),
(54, 1, NULL, 5, '2022-12-17 06:15:24', 3, 0, 1, NULL, 0),
(55, 1, NULL, 6, '2022-12-22 08:47:03', 3, 0, 1, NULL, 0),
(56, 2, NULL, 6, '2022-12-25 09:52:54', 1, 0, 1, NULL, 0),
(57, 2, NULL, 6, '2022-12-26 09:32:00', 2, 0, 0, NULL, 0),
(58, 1, NULL, 7, '2022-12-26 09:57:27', 1, 0, 1, NULL, 0),
(59, 1, NULL, 5, '2022-12-29 09:12:17', 4, 0, 1, NULL, 0),
(60, 1, NULL, 5, '2022-12-29 09:54:19', 1, 0, 0, NULL, 0),
(69, NULL, 1, 9, '2023-01-01 10:51:34', 1, 1, 1, 31, 0),
(70, NULL, 1, 7, '2023-01-01 11:36:35', 1, 0, 1, NULL, 0),
(71, NULL, 1, 8, '2023-01-05 04:33:08', 1, 1, 0, 32, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` varchar(1500) NOT NULL,
  `quantity` int(10) NOT NULL DEFAULT 1,
  `price` double NOT NULL DEFAULT 0,
  `discount` double DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `create_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `delete_at` datetime DEFAULT NULL,
  `image` varchar(30) NOT NULL,
  `rate` int(1) NOT NULL DEFAULT 3,
  `category_id` int(11) NOT NULL,
  `num_of_sales` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `details`, `quantity`, `price`, `discount`, `user_id`, `create_at`, `updated_at`, `is_delete`, `delete_at`, `image`, `rate`, `category_id`, `num_of_sales`) VALUES
(2, 'acer New Edittion sah dbajhsabdjadasd1', 'Hello World!', 50, 975, NULL, 1, '2022-12-12 04:32:00', '2022-12-29 09:32:19', 0, NULL, '167085912068589.jpg', 3, 6, 0),
(5, 'MSI GF63 15.6 a', 'MSI\' GF63 Laptop: Enjoy an immersive gaming experience with this MSI gaming laptop. The NVIDIA GeForce GTX1650 graphics card gives ultra-quality visuals on the 15.6-inch Full HD display, helping you maneuver around sharp corners with pinpoint precision, while the thin bezel design allows for easy portability. This MSI gaming laptop has an Intel Core i5-10300H processor and 8GB of RAM to deliver fast and responsive performance', 100, 2000, 150, 1, '2022-12-12 06:52:08', '2022-12-30 10:50:48', 0, NULL, '167086764281209.jpg', 3, 6, 0),
(6, 'Gaming Mouse', 'New Stule of Gaming Mouses', 100000, 15, NULL, 1, '2022-12-22 08:46:06', NULL, 0, NULL, '167173836692070.png', 3, 4, 0),
(7, 'Wireless Optical 2.4G USB Gaming Mouse 1600DPI 7 Color LED Backlit Rechargeable Silent Mice Gaming Mouse For PC Laptop Computer.', 'Product Description\r\n100% brand new and high quality. · Buttons: 7 buttons with scroll wheel. Tracking systems: Optical. Ergonomics design, suitable for all kinds of the hand type and computer. 7 keys, more convenient for game operations. DPI adjustable provides precise positioning. Custom macro settings, perfect suitable for more complex games. Pack well, Pretty good gift for your child, husband and friends. DPI Switch: 800/1200/1600 DPI Adjustable.  Key Life: 10 Million Times. ·Size: 133* 78 * 40 mm. Weight: about 150g. Color: Black and white. USB Cable Length: about 140cm. Breathing Light Color : Changeable(Press the mouses DPI key and Forward side key to turn on/off backlight). User for: The high-end players & gaming professional players for Dota, LOL, CSGO,etc. Warm Tips: The wheel on the side of mouse is just a decoration, couldnt rotate. Thanks for your understanding. Ultra-precise Scroll Wheel. Optical technology works on most surfaces. Ergonomically designed, long-term use without fatigue. Intelligent connectivity, no need to code, plug & play. Built-weight iron, feel comfortable, mobile and stability. Compatible with Windows XP, Vista, Windows 7, ME, 2000 and Mac OS...or latest.\r\nPacking List', 90, 30, 30, 1, '2022-12-26 09:53:15', NULL, 0, NULL, '167204479536989.webp', 3, 4, 0),
(8, 'Compatible with apple MacBook IMAC smart keyboard magic mouse touch ID with numeric keys silicone protective cover keyboard', '① This product is made of high quality silica gel, which not only has good hand feeling, but also has strong protection function \r\n② This product is only suitable for Apples wireless keyboard magic keyboard. Other brands cannot use it\r\n③ This product is designed to cover the whole keyboard, and the side is protected, which can well protect your keyboard\r\n④ This product is divided into two styles. It is suitable for Apples wireless keyboard, including the second and third generation keyboards. The touch ID hole is reserved. It also supports wireless keyboard with numeric keyboard\r\n[product information]\r\nProduct Name: Apple Wireless keyboard silicone protective cover\r\nBrand: partner good product\r\nMaterial: silica gel\r\nSpecification: single package\r\nColor: translucent\r\nSize: 280*120mm\r\nWeight: 72g (including packaging)\r\nPlace of origin: made in China', 399, 11, NULL, 1, '2022-12-29 09:58:30', '2022-12-29 10:00:36', 0, NULL, '167230431054771.webp', 3, 12, 1),
(9, 'Anime Men\'s T-Shirts Men\'s 3D Fashion Short Sleeve Anime Harajuku Tops Summer O-Neck Shirts Black Boys Clothing Street Clothing', 'Special reminder:This\' size may be different from your think, please carefully compare the size chart, thank you! ! !\r\nNote:\r\n1.There is 1-3CM difference according to manual measurement.\r\n2. Kindly to compare your detail size with our size table before you buying.\r\n3.Please note that slight color difference should be acceptable due to  the light and screen.', 110, 12.25, 4.65, 1, '2022-12-30 11:00:16', '2023-01-01 03:06:53', 0, NULL, '167243761693206.webp', 3, 3, -10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(191) CHARACTER SET utf8 NOT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `password` varchar(500) CHARACTER SET utf8 NOT NULL,
  `balance` double NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `image` varchar(30) DEFAULT NULL,
  `activate` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `password`, `balance`, `created_at`, `is_active`, `is_admin`, `image`, `activate`) VALUES
(1, 'admin1 new', 'admin@gmail.com', '+970590000000', '7af2d10b73ab7cd8f603937f7697cb5fe432c7ff', 0, '2022-12-12 14:15:44', 1, 1, '167154683940622.jpg', 0),
(2, 'Bader AlDin', 'user1@gmail.com', '+970591111111', 'cd027069371cdb4f80c68dcfb37e6f4a1bdb0222', 0, '0000-00-00 00:00:00', 1, 0, NULL, 0),
(4, 'Bader AlDin AlHalimi', 'bader.halimi.2003@gmail.com', '0591234567', '0c4a1218ad0d46e8eaca08042b34221f9024c4fd', 0, '0000-00-00 00:00:00', 1, 0, NULL, 606872),
(5, 'Graphic Design', 'marketbader1@gmail.com', '+970591111111', '0c4a1218ad0d46e8eaca08042b34221f9024c4fd', 0, '0000-00-00 00:00:00', 1, 0, NULL, 575670);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id1` (`user_id1`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ordernote` (`ordernote`);

--
-- Indexes for table `google_accounts`
--
ALTER TABLE `google_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `item-fk` (`item_id`),
  ADD KEY `user-fk` (`user_id`),
  ADD KEY `gaccount_id` (`gaccount_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `details` (`details`) USING HASH,
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `google_accounts`
--
ALTER TABLE `google_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`user_id1`) REFERENCES `users` (`id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`gaccount_id`) REFERENCES `google_accounts` (`id`),
  ADD CONSTRAINT `item-fk` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `user-fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
