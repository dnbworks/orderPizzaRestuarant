-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2021 at 07:03 AM
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
(2, 'Pizza'),
(3, 'Pasta'),
(4, 'Group Meals'),
(5, 'Solo Meals'),
(6, 'Chicken'),
(7, 'Drinks');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` char(1) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `postal_code` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `receive_updates` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--



-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` int(11) UNSIGNED NOT NULL,
  `delivery_method` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`delivery_id`, `delivery_method`) VALUES
(1, 'pickup'),
(2, 'home delivery');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `product_id` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `product_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 22);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) UNSIGNED NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delivery_id` int(11) UNSIGNED DEFAULT NULL,
  `customer_id` int(11) UNSIGNED DEFAULT NULL,
  `payment_id` int(11) UNSIGNED DEFAULT NULL,
  `pickup_branch_id` int(11) UNSIGNED DEFAULT NULL,
  `order_status` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_id` int(11) UNSIGNED NOT NULL,
  `product_id` tinyint(3) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `order_status_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`order_status_id`, `name`) VALUES
(1, 'Processed'),
(2, 'shipped'),
(3, 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) UNSIGNED NOT NULL,
  `payment_method` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_method`) VALUES
(1, 'cash on delivery'),
(2, 'debit card'),
(3, 'credit card'),
(4, 'paypal');

-- --------------------------------------------------------

--
-- Table structure for table `pickup_branches`
--

CREATE TABLE `pickup_branches` (
  `pickup_branch_id` int(11) UNSIGNED NOT NULL,
  `city` varchar(100) NOT NULL,
  `branch_location` varchar(100) NOT NULL,
  `operating_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pickup_branches`
--

INSERT INTO `pickup_branches` (`pickup_branch_id`, `city`, `branch_location`, `operating_time`) VALUES
(1, 'MUNTIBLUPA', 'Alabang Country Club', '10:00AM - 9:00PM'),
(2, 'ALBAY', 'Gregorian Mall, Legazpi', '9:00AM - 8:00PM');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` tinyint(3) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` tinyint(3) UNSIGNED NOT NULL,
  `quantity` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `title`, `description`, `img`, `price`, `category_id`, `quantity`) VALUES
(1, 'Carbonara Supreme', 'Olive oil-coated pasta lightly sauteed with fresh garlic, succulent shrimps and red chili flakes.', 'SEAFOOD_MARINARA_9.png', '134.00', 5, 10),
(2, 'chicken and pizza', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt, laborum ea nisi atque hic, nam deserunt excepturi illum a, debitis praesentium accusamus provident in.', 'salad_chicken_n_pizza_0.png', '128.00', 4, 10),
(3, 'chicken and rice', 'Sit amet consectetur adipisicing elit. Nesciunt, laborum ea nisi atque hic, nam deserunt excepturi illum a, debitis praesentium accusamus provident in! Ducimus.', 'chicken_n_rice_0.png', '112.00', 5, NULL),
(4, 'Prima Lasagna', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt, laborum ea nisi atque. nam deserunt excepturi illum a, debitis praesentium accusamus provident in! Ducimus', 'PRIMA LASAGNA_7.png', '98.10', 5, NULL),
(5, 'Shrimp Aglio Olio', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt, laborum ea nisi atque hic, nam deserunt excepturi illum a, debitis.', 'SHRIMP AGLIO OLIO_6.png', '104.89', 5, NULL),
(6, 'Angus steakhouse', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, eveniet facere? Eligendi voluptate ab id dolor harum fuga commodi illum eveniet qui vitae consequuntur recusandae, dignissimos repellat molestias? Quam', 'ANGUS_STEAKHOUSE_71.png', '77.00', 2, NULL),
(7, 'Angus burger pizza', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, eveniet facere? Eligendi voluptate ab id dolor harum fuga commodi illum eveniet qui vitae consequuntur recusandae, dignissimos repellat molestias', 'angus-burger-pizza_0_0.png', '347.00', 2, NULL),
(8, 'Belly Buster', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, eveniet facere? Eligendi voluptate ab id dolor harum fuga commodi illum eveniet qui vitae consequuntur recusandae, dignissimos repellat.', 'BELLY_BUSTER_67.png', '235.00', 2, NULL),
(9, 'Classic cheese', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, eveniet facere? Eligendi voluptate ab id dolor harum fuga commodi illum eveniet qui vitae consequuntur recusandae.', 'classic_cheese_1.png', '174.00', 2, NULL),
(10, 'Hawaiian Delight', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, eveniet facere? Eligendi voluptate ab id dolor harum fuga commodi illum eveniet qui vitae consequuntur recusandae.', 'hawaiian_delight_5.png', '111.00', 2, NULL),
(11, 'High protein supreme', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, eveniet facere? Eligendi voluptate ab id dolor harum fuga commodi illum eveniet qui vitae consequuntur recusandae.', 'hi-protein_supreme_1.png', '111.00', 2, NULL),
(12, 'Manger choice', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, eveniet facere? Eligendi voluptate ab id dolor harum fuga commodi illum eveniet qui vitae consequuntur recusandae.', 'MANAGER\'S_CHOICE_48.png', '254.00', 2, NULL),
(13, 'Pepperoni Crunch', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, eveniet facere? Eligendi voluptate ab id dolor harum fuga commodi illum eveniet qui vitae consequuntur recusandae.', 'PEPPERONI_CRRRUNCH_45.png', '543.00', 2, NULL),
(14, 'Pepperoni Overload', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, eveniet facere? Eligendi voluptate ab id dolor harum fuga commodi illum eveniet qui vitae consequuntur recusandae.', 'PEPPERONI_48.png', '389.00', 2, NULL),
(15, 'Lasagna Supreme', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsam optio nulla deleniti quisquam maiores enim ullam doloribus eum perspiciatis esse vitae atque, iusto ducimus fugit at id.', 'pasta-1.png', '100.00', 3, NULL),
(16, 'Creamy Bacon Carbinara', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsam optio nulla deleniti quisquam maiores enim ullam doloribus eum perspiciatis esse vitae atque, iusto ducimus fugit at id.', 'pasta-2.png', '118.00', 3, NULL),
(17, 'Large spaghetti and meatball', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsam optio nulla deleniti quisquam maiores enim ullam doloribus eum perspiciatis esse vitae atque, iusto ducimus fugit at id.', 'pasta-3.png', '56.00', 3, NULL),
(18, 'MYMIX - DEL', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsam optio nulla deleniti quisquam maiores enim ullam doloribus eum perspiciatis esse vitae atque, iusto ducimus fugit at id.', 'pasta-5.png', '174.00', 3, NULL),
(19, 'Large - Coca Cola', 'Refresh drink adipisicing elit. Ipsam optio nulla deleniti quisquam maiores enim ullam doloribus eum perspiciatis esse vitae atque, iusto ducimus fugit at id.', 'coke-large.png', '87.00', 7, NULL),
(20, 'Glass of Coke', 'Refresh drink adipisicing elit. Ipsam optio nulla deleniti quisquam maiores enim ullam doloribus eum perspiciatis esse vitae atque, iusto ducimus fugit at id.', 'drink-1.png', '24.00', 7, NULL),
(21, 'Glass of Royal', 'Refresh drink adipisicing elit. Ipsam optio nulla deleniti quisquam maiores enim ullam doloribus eum perspiciatis esse vitae atque, iusto ducimus fugit at id.', 'drink-3.png', '24.00', 7, NULL),
(22, 'CALAMARI CRRRUNCH', 'repellendus dolores beatae molestiae perspiciatis minus, explicabo quidem maxime illo quisquam vero voluptatum', 'CALAMARI_CRRRUNCH_4.png', '58.00', 4, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `pickup_branch_id` (`pickup_branch_id`),
  ADD KEY `delivery_id` (`delivery_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `fk_order_items_product_idx` (`product_id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`order_status_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `pickup_branches`
--
ALTER TABLE `pickup_branches`
  ADD PRIMARY KEY (`pickup_branch_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_products_category` (`category_id`),
  ADD KEY `id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `order_status_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pickup_branches`
--
ALTER TABLE `pickup_branches`
  MODIFY `pickup_branch_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`pickup_branch_id`) REFERENCES `pickup_branches` (`pickup_branch_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`delivery_id`) REFERENCES `delivery` (`delivery_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_order_items_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_items_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
