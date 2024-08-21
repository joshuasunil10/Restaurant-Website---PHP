-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2024 at 03:01 AM
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
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `price`) VALUES
(1, 'NotChicken Bucket', 'A bucket of NotChicken, the most delicious bucket you will ever find', 13.99),
(2, 'NotChicken Sandwich', 'Crispy chicken sandwich served with mayo and lettuce', 6.49),
(3, 'The Mighty Fries', 'The best part of any meal, mighty yet seasoned French fries', 3.50),
(4, 'NotPopcorn Chicken', 'Popcorn Chicken, coated in breadcrumbs with salt and pepper seasoning', 3.99),
(5, 'Mega Meal Banquet', 'Consists, of a box of Boneless Chicken, Mighty Fries, and a Soda', 13.95),
(6, 'Soda', 'Choice of Coke, Pepsi, or Sprite', 1.99),
(7, 'NotKFC Milkshake', 'A tasty side to your NotKFC Meal, Choice of Vanilla, Oreo, Caramel', 5.95),
(8, 'NotKFC IceCream Sundae', 'A refreshing desert to any meal, choice of chocolate, vanilla and oreo', 4.80);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
