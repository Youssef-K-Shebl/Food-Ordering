-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2022 at 03:47 PM
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
-- Database: `foodorderingproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'youssef', 'Fox', 'b59c67bf196a4758191e42f76670ceba'),
(8, 'Kimo', 'Bibo', 'b59c67bf196a4758191e42f76670ceba'),
(57, 'joo', 'joo', '21232f297a57a5a743894a0e4a801fc3'),
(59, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(55, 'momo', 'Food_Category_470.jpg', 'Yes', 'Yes'),
(57, 'Pizza', 'Food_Category_135.jpg', 'Yes', 'Yes'),
(61, 'Gaht y oina', 'Food_Category_673.jpg', 'No', 'Yes'),
(63, 'pasta', 'Food_Category_573.jpg', 'No', 'Yes'),
(64, 'burger', 'Food_Category_522.jpg', 'Yes', 'Yes'),
(65, 'dgd', 'Food_Category_813.jpg', 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `descripion` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `title`, `descripion`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(42, 'pizze', 'sas', '1231.00', 'Food_185.jpg', 57, 'Yes', 'Yes'),
(43, 'cheese burger', 'burger with cheese with machroums', '150.00', 'Food_160.jpg', 64, 'Yes', 'Yes'),
(44, 'cheese Burger', 'Burger with cheese', '100.00', 'Food_819.jpg', 64, 'Yes', 'Yes'),
(45, 'margrita', 'pizza with cheese and sauce', '120.00', 'Food_955.jpg', 57, 'Yes', 'Yes'),
(46, 'super subrime', 'Pizza with chicken', '150.00', 'Food_229.jpg', 57, 'Yes', 'Yes'),
(47, 'mushroom burger', 'burger with mushrooms and cheese', '120.00', 'Food_932.jpg', 64, 'Yes', 'Yes'),
(48, 'cheese lover', 'pizza with 6 types of cheese ', '170.00', 'Food_739.jpg', 57, 'Yes', 'Yes'),
(49, 'momo', 'omomomomom', '120.00', 'Food_913.jpg', 55, 'Yes', 'Yes'),
(51, 'new', '', '100.00', '', 57, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'super subrime', '150.00', 4, '600.00', '2022-02-01 04:19:51', 'Cancelled', 'AaD', '4378121674', 'youssef@gmail.com', 'bahari'),
(2, 'cheese Burger', '100.00', 1, '100.00', '2022-02-01 04:21:00', 'Delivered', 'C  nirghem', '6757012308', 'gici@sudno.ee', 'roshdy'),
(3, 'cheese Burger', '100.00', 6, '600.00', '2022-02-01 04:21:20', 'Cancelled', 'Linayauawtkg', '7854686934', 'ila@tujube.nu', 'zezinia'),
(4, 'cheese burger', '150.00', 3, '450.00', '2022-02-01 04:22:03', 'Delivered', 'Apilta hlha yhg', '7084003571', 'osesunat@ci.su', 'gleem'),
(5, 'margrita', '120.00', 3, '360.00', '2022-02-01 04:22:56', 'Delivered', 'Hlirhamthubre', '6468863743', 'izfejiz@sorogla.pk', 'sumoha al \'nasr\' st\';\r\n'),
(6, 'cheese burger', '150.00', 1, '150.00', '2022-02-04 03:23:16', 'Delivered', 'joo', '01026403173', 'you@gmail.com', 'zezinia tomas tower'),
(7, 'margrita', '120.00', 1, '120.00', '2022-02-04 06:04:51', 'Ordered', 'test', '124131', 'test@test.com', 'alex');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food-category` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food-category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
