-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 16, 2022 at 05:24 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manage_product`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name_category` varchar(256) NOT NULL,
  `image_category` text DEFAULT NULL,
  `belong_category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name_category`, `image_category`, `belong_category`) VALUES
(1, 'Fashion', '', 1),
(2, 'Pants', 'https://cdn.pixabay.com/photo/2014/08/26/21/49/jeans-428614_960_720.jpg', 1),
(3, 'Cloak', 'https://images.pexels.com/photos/7537868/pexels-photo-7537868.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 1),
(4, 'Trouser', 'https://images.pexels.com/photos/7205905/pexels-photo-7205905.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 4),
(5, 'Jeans', 'https://images.pexels.com/photos/1598507/pexels-photo-1598507.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 4),
(6, 'Hoodies\r\n', 'https://images.pexels.com/photos/1183266/pexels-photo-1183266.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 3),
(7, 'T-shirt', 'https://images.pexels.com/photos/6347892/pexels-photo-6347892.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 3);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `id_cate` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `image` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `id_cate`, `id_user`, `title`, `image`, `quantity`, `description`, `price`, `created_at`, `updated_at`) VALUES
(46, 3, 15, 'Office pants', 'https://images.pexels.com/photos/1390600/pexels-photo-1390600.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 12, 'This is a pant', '12', '2022-06-16 03:12:25', '0000-00-00 00:00:00'),
(47, 5, 16, 'T-Shirt Street style', 'https://images.pexels.com/photos/5120085/pexels-photo-5120085.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 21, 'Make from termainal...', '32', '2022-06-16 03:05:16', '0000-00-00 00:00:00'),
(48, 7, 13, 'Classic Robe', 'https://images.pexels.com/photos/157675/fashion-men-s-individuality-black-and-white-157675.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 123, 'This is a Robe', '12', '2022-06-16 03:12:31', '0000-00-00 00:00:00'),
(59, 1, 13, 'Italian Robe', 'https://images.pexels.com/photos/4355673/pexels-photo-4355673.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 2, 'This is a roble', '123', '2022-06-16 03:12:37', '0000-00-00 00:00:00'),
(60, 1, 14, 'Adidas Hoodies', 'https://images.pexels.com/photos/171945/pexels-photo-171945.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 12, 'This is a Hoodies', '123', '2022-06-16 03:12:43', '0000-00-00 00:00:00'),
(61, 1, 14, 'Personalized shirt', 'https://images.pexels.com/photos/2897531/pexels-photo-2897531.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 123, 'This is a T-shirt', '12', '2022-06-16 03:12:50', '0000-00-00 00:00:00'),
(63, 7, 15, 'product 1', 'product_35.jpg', 1, 'update product user', '12', '2022-06-16 03:22:50', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `userhasproduct`
--

CREATE TABLE `userhasproduct` (
  `id_user` int(10) NOT NULL,
  `id_product` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(13, 'admin_1', 'admin_1@gmail.com', '$2y$10$036gXMvOOCXOLQBj/sbNS.pB00d.64N76zsCwjpXZZcqTBZ1eanRW', 1, '2022-06-15 16:28:03'),
(14, 'admin', 'admin_root@gmail.com', '$2y$10$.n7L51H1zrUcSQ79NY81muLQAf0Iwr5YAo6B1orf23Xv19XbWI.qq', 1, '2022-06-15 05:02:58'),
(15, 'khanh', 'khanhhcm4@gmail.com', '$2y$10$NixLI9R2cMy3/2Q5uax5ueYsvQKL2MY4cOIq9SD98wHK3FqE7a20G', 0, '2022-06-15 16:29:09'),
(16, 'Kate', '4501104109@student.hcmue.edu.vn', '$2y$10$mcon10y2Fa9yysiS6IcLFO7csKyfxKeqXsjMZXLrSTxA/84AKnwAa', 0, '2022-06-15 16:29:39'),
(17, 'dante', 'dante@gmail.com', '$2y$10$.9W3oV42b1E48.LXIRW3JOt74Zc/zShCu8eqMk3Y.scYVKF/8BX3e', 0, '2022-06-15 16:53:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `belong_cate` (`belong_category`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_cate` (`id_cate`),
  ADD KEY `product_user` (`id_user`);

--
-- Indexes for table `userhasproduct`
--
ALTER TABLE `userhasproduct`
  ADD KEY `user_has_product` (`id_user`),
  ADD KEY `product_own_user` (`id_product`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `belong_cate` FOREIGN KEY (`belong_category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product_cate` FOREIGN KEY (`id_cate`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userhasproduct`
--
ALTER TABLE `userhasproduct`
  ADD CONSTRAINT `product_own_user` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_has_product` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
