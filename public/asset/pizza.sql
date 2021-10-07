-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2021 at 08:45 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizza`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Special Offers'),
(2, 'Pizza'),
(3, 'Pasta'),
(4, 'Group Meals'),
(5, 'Solo Meals'),
(6, 'Chicken'),
(7, 'Drinks');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `img`, `price`, `category_id`) VALUES
(1, 'Carbonara Supreme', 'Olive oil-coated pasta lightly sauteed with fresh garlic, succulent shrimps and red chili flakes.', 'SEAFOOD_MARINARA_9.png', '134.00', 1),
(2, 'chicken and pizza', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt, laborum ea nisi atque hic, nam deserunt excepturi illum a, debitis praesentium accusamus provident in.', 'salad_chicken_n_pizza_0.png', '128.00', 1),
(3, 'chicken and rice', 'Sit amet consectetur adipisicing elit. Nesciunt, laborum ea nisi atque hic, nam deserunt excepturi illum a, debitis praesentium accusamus provident in! Ducimus.', 'chicken_n_rice_0.png', '112.00', 1),
(4, 'Prima Lasagna', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt, laborum ea nisi atque. nam deserunt excepturi illum a, debitis praesentium accusamus provident in! Ducimus', 'PRIMA LASAGNA_7.png', '98.10', 1),
(5, 'Shrimp Aglio Olio', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt, laborum ea nisi atque hic, nam deserunt excepturi illum a, debitis.', 'SHRIMP AGLIO OLIO_6.png', '104.89', 1),
(6, 'Angus steakhouse', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, eveniet facere? Eligendi voluptate ab id dolor harum fuga commodi illum eveniet qui vitae consequuntur recusandae, dignissimos repellat molestias? Quam', 'ANGUS_STEAKHOUSE_71.png', '77.00', 2),
(7, 'Angus burger pizza', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, eveniet facere? Eligendi voluptate ab id dolor harum fuga commodi illum eveniet qui vitae consequuntur recusandae, dignissimos repellat molestias', 'angus-burger-pizza_0_0.png', '347.00', 2),
(8, 'Belly Buster', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, eveniet facere? Eligendi voluptate ab id dolor harum fuga commodi illum eveniet qui vitae consequuntur recusandae, dignissimos repellat.', 'BELLY_BUSTER_67.png', '235.00', 2),
(9, 'Classic cheese', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, eveniet facere? Eligendi voluptate ab id dolor harum fuga commodi illum eveniet qui vitae consequuntur recusandae.', 'classic_cheese_1.png', '174.00', 2),
(10, 'Hawaiian Delight', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, eveniet facere? Eligendi voluptate ab id dolor harum fuga commodi illum eveniet qui vitae consequuntur recusandae.', 'hawaiian_delight_5.png', '111.00', 2),
(11, 'High protein supreme', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, eveniet facere? Eligendi voluptate ab id dolor harum fuga commodi illum eveniet qui vitae consequuntur recusandae.', 'hi-protein_supreme_1.png', '111.00', 2),
(12, 'Manger choice', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, eveniet facere? Eligendi voluptate ab id dolor harum fuga commodi illum eveniet qui vitae consequuntur recusandae.', 'MANAGER\'S_CHOICE_48.png', '254.00', 2),
(13, 'Pepperoni Crunch', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, eveniet facere? Eligendi voluptate ab id dolor harum fuga commodi illum eveniet qui vitae consequuntur recusandae.', 'PEPPERONI_CRRRUNCH_45.png', '543.00', 2),
(14, 'Pepperoni Overload', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, eveniet facere? Eligendi voluptate ab id dolor harum fuga commodi illum eveniet qui vitae consequuntur recusandae.', 'PEPPERONI_48.png', '389.00', 2),
(15, 'Lasagna Supreme', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsam optio nulla deleniti quisquam maiores enim ullam doloribus eum perspiciatis esse vitae atque, iusto ducimus fugit at id.', 'pasta-1.png', '100.00', 3),
(16, 'Creamy Bacon Carbinara', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsam optio nulla deleniti quisquam maiores enim ullam doloribus eum perspiciatis esse vitae atque, iusto ducimus fugit at id.', 'pasta-2.png', '118.00', 3),
(17, 'Large spaghetti and meatball', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsam optio nulla deleniti quisquam maiores enim ullam doloribus eum perspiciatis esse vitae atque, iusto ducimus fugit at id.', 'pasta-3.png', '56.00', 3),
(18, 'MYMIX - DEL', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsam optio nulla deleniti quisquam maiores enim ullam doloribus eum perspiciatis esse vitae atque, iusto ducimus fugit at id.', 'pasta-5.png', '174.00', 3),
(19, 'Large - Coca Cola', 'Refresh drink adipisicing elit. Ipsam optio nulla deleniti quisquam maiores enim ullam doloribus eum perspiciatis esse vitae atque, iusto ducimus fugit at id.', 'coke-large.png', '87.00', 7),
(20, 'Glass of Coke', 'Refresh drink adipisicing elit. Ipsam optio nulla deleniti quisquam maiores enim ullam doloribus eum perspiciatis esse vitae atque, iusto ducimus fugit at id.', 'drink-1.png', '24.00', 7),
(21, 'Glass of Royal', 'Refresh drink adipisicing elit. Ipsam optio nulla deleniti quisquam maiores enim ullam doloribus eum perspiciatis esse vitae atque, iusto ducimus fugit at id.', 'drink-3.png', '24.00', 7),
(22, 'CALAMARI CRRRUNCH', 'repellendus dolores beatae molestiae perspiciatis minus, explicabo quidem maxime illo quisquam vero voluptatum', 'CALAMARI_CRRRUNCH_4.png', '58.00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_category` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
