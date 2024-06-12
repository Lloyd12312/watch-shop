-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2024 at 05:56 PM
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
-- Database: `watchshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `quantity` tinyint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Таблица корзины продуктов';

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `product_price`, `quantity`) VALUES
(54, 7, 5, 1060, 3),
(55, 0, 3, 499, 1),
(56, 0, 3, 499, 1),
(57, 0, 3, 499, 1),
(58, 0, 3, 499, 1),
(59, 0, 3, 499, 1),
(60, 0, 2, 550, 1),
(61, 0, 2, 550, 1),
(62, 7, 6, 15999, 1),
(81, 10, 2, 550, 1),
(82, 10, 1, 835, 1),
(83, 10, 5, 1060, 1),
(84, 10, 3, 499, 1),
(85, 10, 4, 399, 1),
(86, 10, 8, 799, 1),
(87, 10, 10, 7799, 1),
(88, 10, 12, 669, 1),
(89, 10, 14, 4999, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(75) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `card_holder_name` varchar(75) NOT NULL,
  `card_number` varchar(20) NOT NULL,
  `expiration_month` varchar(20) NOT NULL,
  `expiration_year` varchar(20) NOT NULL,
  `cvv` varchar(20) NOT NULL,
  `product_id` text NOT NULL,
  `product_price` float NOT NULL,
  `quantity` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='orders';

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `full_name`, `email`, `address`, `city`, `state`, `zip_code`, `card_holder_name`, `card_number`, `expiration_month`, `expiration_year`, `cvv`, `product_id`, `product_price`, `quantity`) VALUES
(6, 10, 'AdminAdminAdmin', 'admin@gmail.com', 'AdminAdminAdmin', 'AdminCity', 'AdminCountry', '123456', 'AdminAdminAdmin', '7b8802b5aa06e55f70c9', 'August', '2025', '202cb962ac59075b964b', '1,2', 3320, '2,3');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `product_price` float NOT NULL,
  `product_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Таблица товаров';

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_price`, `product_image`) VALUES
(1, 'Rolex GMT-Master II', 835, 'https://cdn2.chrono24.com/cdn-cgi/image/f=auto,metadata=none,q=65,h=305/images/topmodels/4-s3n4vjwfzcimyvyeizqpl6cv-Original.png'),
(2, 'Rolex Daytona', 550, 'https://cdn2.chrono24.com/cdn-cgi/image/f=auto,metadata=none,q=65,h=305/images/topmodels/2-y181jdh67kx2lripaucfting-Original.png'),
(3, 'Rolex Submariner', 499, 'https://cdn2.chrono24.com/cdn-cgi/image/f=auto,metadata=none,q=65,h=305/images/topmodels/1-w70x429knb132x17edf24c63-Original.png'),
(4, 'Rolex Datejust', 399, 'https://cdn2.chrono24.com/cdn-cgi/image/f=auto,metadata=none,q=65,h=305/images/topmodels/45-w36w6el32cnbsnxr0smetc2y-Original.png'),
(5, 'Rolex Day-Date', 1060, 'https://cdn2.chrono24.com/cdn-cgi/image/f=auto,metadata=none,q=65,h=305/images/topmodels/47-v5b06z1h6pcvqe8xu0e9h2pg-Original.png'),
(6, 'Rolex Yacht-Master II', 15999, 'https://cdn2.chrono24.com/cdn-cgi/image/f=auto,metadata=none,q=65,h=305/images/topmodels/59-64dbjwtbd3y6580vuf2h85z0-Original.png'),
(7, 'Rolex Oyster Perpetual', 445, 'https://cdn2.chrono24.com/cdn-cgi/image/f=auto,metadata=none,q=65,h=305/images/topmodels/55-vb2javyk3a8rlddxgy6lkr33-Original.png'),
(8, 'Rolex Sea-Dweller', 799, 'https://cdn2.chrono24.com/cdn-cgi/image/f=auto,metadata=none,q=65,h=305/images/topmodels/49-5os8cromlu1m5otpcim3xb2w-Original.png'),
(9, 'Rolex Explorer II', 5999, 'https://cdn2.chrono24.com/cdn-cgi/image/f=auto,metadata=none,q=65,h=305/images/topmodels/51-92wkn1hz3jvvyfqzhu1yjwxy-Original.png'),
(10, 'Rolex Milgauss', 7799, 'https://cdn2.chrono24.com/cdn-cgi/image/f=auto,metadata=none,q=65,h=305/images/topmodels/54-83a5t6w7ocqe7bm8y9kigmt3-Original.png'),
(11, 'Rolex Yacht-Master', 4799, 'https://cdn2.chrono24.com/cdn-cgi/image/f=auto,metadata=none,q=65,h=305/images/topmodels/58-23ylh0e75ur1pxmih48bd3x0-Original.png'),
(12, 'Rolex GMT-Master', 669, 'https://cdn2.chrono24.com/cdn-cgi/image/f=auto,metadata=none,q=65,h=305/images/topmodels/3-oxbyqsr0pt5y84g8sexacrfl-Original.png'),
(13, 'Rolex Lady-Datejust', 2499, 'https://cdn2.chrono24.com/cdn-cgi/image/f=auto,metadata=none,q=65,h=305/images/topmodels/53-qr7rjp3uwl4jco6w9zezewr6-Original.png'),
(14, 'Rolex Explorer', 4999, 'https://cdn2.chrono24.com/cdn-cgi/image/f=auto,metadata=none,q=65,h=305/images/topmodels/50-0wd8mlcl2km8mg9oqejxdc67-Original.png'),
(15, 'Rolex Air King', 499, 'https://cdn2.chrono24.com/cdn-cgi/image/f=auto,metadata=none,q=65,h=305/images/topmodels/5-1gfc76l6jakp6ckprhhuypse-Original.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `pu` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `pu`) VALUES
(7, 'Andrii', 'Korzhynskyi', 'andriikorzhynskyi@gmail.com', '45da9d72e523598a6c850ea634948dee', 0),
(8, 'NieAndrii', 'NieKorzhynskyi', 'nieandriikorzhynskyi@gmail.com', '45da9d72e523598a6c850ea634948dee', 0),
(9, 'adasd', 'asdasd', 'asdandriikorzhynskyi@gmail.com', '45da9d72e523598a6c850ea634948dee', 0),
(10, 'admin', 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1),
(11, 'test', 'test', 'test@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
