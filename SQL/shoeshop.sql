-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2019 at 08:25 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoeshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand`) VALUES
(1, 'nicke'),
(2, 'adidas');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category`) VALUES
(1, 'วิ่ง'),
(2, 'เที่ยว'),
(3, 'แฟชัน'),
(4, 'เดินเล่น');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `mem_id` int(11) NOT NULL,
  `mem_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `mem_username` varchar(255) COLLATE utf8_bin NOT NULL,
  `mem_password` varchar(255) COLLATE utf8_bin NOT NULL,
  `mem_tel` int(11) NOT NULL,
  `mem_address` text COLLATE utf8_bin NOT NULL,
  `mem_img` text COLLATE utf8_bin NOT NULL,
  `mem_status` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`mem_id`, `mem_name`, `mem_username`, `mem_password`, `mem_tel`, `mem_address`, `mem_img`, `mem_status`) VALUES
(1, 'farook', 'farook@gmail.com', '123', 824223230, 'hello world', '', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `orderbuy`
--

CREATE TABLE `orderbuy` (
  `order_id` int(11) NOT NULL,
  `order_Date` date NOT NULL,
  `order_totalprice` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `Payment_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `orderbuy`
--

INSERT INTO `orderbuy` (`order_id`, `order_Date`, `order_totalprice`, `cus_id`, `Payment_ID`) VALUES
(1, '2019-10-11', 400, 1, 1),
(2, '2019-10-11', 100, 1, 1),
(3, '2019-10-11', 100, 1, 1),
(4, '2019-10-11', 200, 1, 1),
(5, '2019-10-11', 300, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderdtial`
--

CREATE TABLE `orderdtial` (
  `order_Detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `orderdtial`
--

INSERT INTO `orderdtial` (`order_Detail_id`, `order_id`, `amount`, `product_id`) VALUES
(1, 5, 1, 1),
(2, 5, 1, 2),
(3, 5, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `payment_status`
--

CREATE TABLE `payment_status` (
  `Payment_ID` int(11) NOT NULL,
  `Payment_Name` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `payment_status`
--

INSERT INTO `payment_status` (`Payment_ID`, `Payment_Name`) VALUES
(1, 'ยังไม่ชำระเงิน'),
(2, 'กำลังชำระเงิน'),
(3, 'ชำระเงินแล้ว');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `product_amount` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_img` text COLLATE utf8_bin NOT NULL,
  `product_brandID` int(11) NOT NULL,
  `product_categoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_amount`, `product_price`, `product_img`, `product_brandID`, `product_categoryID`) VALUES
(1, 'te', 0, 100, 'img_5da05ede4bb39.jpg', 1, 1),
(2, 'xxxxx', 10, 100, 'img_5da05eebe4d55.jfif', 1, 1),
(3, 'tttt', 0, 100, 'img_5da05ef5e09df.jpg', 1, 1),
(4, 'ีีีีtestx', 0, 100, 'img_5da05f0567e04.jpg', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`mem_id`);

--
-- Indexes for table `orderdtial`
--
ALTER TABLE `orderdtial`
  ADD PRIMARY KEY (`order_Detail_id`);

--
-- Indexes for table `payment_status`
--
ALTER TABLE `payment_status`
  ADD PRIMARY KEY (`Payment_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `mem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orderdtial`
--
ALTER TABLE `orderdtial`
  MODIFY `order_Detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_status`
--
ALTER TABLE `payment_status`
  MODIFY `Payment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
