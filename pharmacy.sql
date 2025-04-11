-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2025 at 04:59 PM
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
-- Database: `pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_credentials`
--

CREATE TABLE `admin_credentials` (
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `IS_LOGGED_IN` tinyint(1) NOT NULL DEFAULT 0,
  `pharmacy_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `admin_credentials`
--

INSERT INTO `admin_credentials` (`USERNAME`, `PASSWORD`, `IS_LOGGED_IN`, `pharmacy_id`) VALUES
('BHOLE', '123123123', 0, NULL),
('admin', '123123123', 0, 1),
('lele', '123123123', 0, NULL),
('preet8612', '123123123', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(20) NOT NULL,
  `CONTACT_NUMBER` varchar(10) NOT NULL,
  `ADDRESS` varchar(100) NOT NULL,
  `DOCTOR_NAME` varchar(20) NOT NULL,
  `DOCTOR_ADDRESS` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`ID`, `NAME`, `CONTACT_NUMBER`, `ADDRESS`, `DOCTOR_NAME`, `DOCTOR_ADDRESS`) VALUES
(4, 'Kiran Suthar', '1234567690', 'Andheri East', 'Anshari', 'Andheri East'),
(6, 'Aditya', '7365687269', 'Virar West', 'Xyz', 'Virar West'),
(11, 'Shivam Tiwari', '6862369896', 'Dadar West', 'Dr Kapoor', 'Dadar East'),
(13, 'Varsha Suthar', '7622369694', 'Rani Station', 'Dr Ramesh', 'Rani Station'),
(15, 'Preet Goyani', '9913232776', '8, Momai Row House, Pedar Road Mota Varachha', 'Krushil', 'Anan,vvnagat');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `INVOICE_ID` int(11) NOT NULL,
  `NET_TOTAL` double NOT NULL DEFAULT 0,
  `INVOICE_DATE` date NOT NULL DEFAULT current_timestamp(),
  `CUSTOMER_ID` int(11) NOT NULL,
  `TOTAL_AMOUNT` double NOT NULL,
  `TOTAL_DISCOUNT` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`INVOICE_ID`, `NET_TOTAL`, `INVOICE_DATE`, `CUSTOMER_ID`, `TOTAL_AMOUNT`, `TOTAL_DISCOUNT`) VALUES
(1, 30, '2021-10-19', 14, 30, 0),
(2, 2626, '2021-10-19', 6, 2626, 0),
(3, 5252, '2025-04-07', 15, 5252, 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `ID` int(11) NOT NULL,
  `INVOICE_ID` int(11) NOT NULL,
  `MEDICINE_NAME` varchar(100) NOT NULL,
  `EXPIRY_DATE` date NOT NULL,
  `QUANTITY` int(11) NOT NULL,
  `MRP` decimal(10,2) NOT NULL,
  `DISCOUNT` decimal(5,2) NOT NULL,
  `TOTAL` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `PACKING` varchar(20) NOT NULL,
  `GENERIC_NAME` varchar(100) NOT NULL,
  `SUPPLIER_NAME` varchar(100) NOT NULL,
  `CATEGORY` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`ID`, `NAME`, `PACKING`, `GENERIC_NAME`, `SUPPLIER_NAME`, `CATEGORY`) VALUES
(1, 'Nicip Plus', '10tab', 'Paracetamole', 'BDPL PHARMA', NULL),
(2, 'Crosin', '10tab', 'Hdsgvkvajkcbja', 'Kiran Pharma', NULL),
(4, 'Dolo 650', '15tab', 'paracetamole', 'BDPL PHARMA', NULL),
(5, 'Gelusil', '10tab', 'mint fla', 'Desai Pharma', NULL),
(6, 'Crosin', '123', 'CROSS', 'Desai Pharma', NULL),
(22, 'Poiu', '10', 'Pl', 'BDPL PHARMA', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medicines_stock`
--

CREATE TABLE `medicines_stock` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `BATCH_ID` varchar(20) NOT NULL,
  `EXPIRY_DATE` varchar(10) NOT NULL,
  `QUANTITY` int(11) NOT NULL,
  `MRP` double NOT NULL,
  `RATE` double NOT NULL,
  `MEDICINE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `medicines_stock`
--

INSERT INTO `medicines_stock` (`ID`, `NAME`, `BATCH_ID`, `EXPIRY_DATE`, `QUANTITY`, `MRP`, `RATE`, `MEDICINE_ID`) VALUES
(1, 'Crosin', 'CROS12', '12/34', 120, 2626, 26, 2),
(2, 'Gelusil', 'G327', '12/42', 0, 15, 12, 5),
(3, 'Dolo 650', 'DOLO327', '01/23', 3, 30, 24, 4),
(4, 'Nicip Plus', 'NI325', '05/22', 3, 32.65, 28, 1),
(11, 'Poiu', '110011', '03/26', 90, 10, 10, 22);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_details`
--

CREATE TABLE `pharmacy_details` (
  `id` int(11) NOT NULL,
  `pharmacy_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact_number` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacy_details`
--

INSERT INTO `pharmacy_details` (`id`, `pharmacy_name`, `address`, `email`, `contact_number`) VALUES
(1, 'preet', 'anan,vvnagar', 'preetgoyani8612@gmail.com', '9913232776'),
(2, 'preet', 'anan,vvnagar', 'preetgoyani8612@gmail.com', '9913232776'),
(3, 'preet', 'as a as, as as', 'preetgoyani8612@gmail.com', '9913232776'),
(4, 'BHOLE', 'VV NAGAR , ANAN', 'preetgoyani8612@gmail.com', '9913232775'),
(5, 'MediSync Pharmacy', '123 Main Street, City', 'info@medisync.com', '9876543210'),
(6, 'lele', 'anasn,vv nagar', 'preetgoyani8612@gmail.com', '9913232776');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `SUPPLIER_NAME` varchar(100) NOT NULL,
  `INVOICE_NUMBER` int(11) NOT NULL,
  `VOUCHER_NUMBER` int(11) NOT NULL,
  `PURCHASE_DATE` varchar(10) NOT NULL,
  `TOTAL_AMOUNT` double NOT NULL,
  `PAYMENT_STATUS` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `ID` int(11) NOT NULL,
  `INVOICE_NUMBER` int(11) NOT NULL,
  `MEDICINE_NAME` varchar(100) DEFAULT NULL,
  `EXPIRY_DATE` date DEFAULT NULL,
  `QUANTITY` int(11) DEFAULT NULL,
  `MRP` decimal(10,2) DEFAULT NULL,
  `DISCOUNT` int(11) DEFAULT NULL,
  `TOTAL` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `CONTACT_NUMBER` varchar(10) NOT NULL,
  `ADDRESS` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`ID`, `NAME`, `EMAIL`, `CONTACT_NUMBER`, `ADDRESS`) VALUES
(1, 'Desai Pharma', 'desai@gmail.com', '9948724242', 'Mahim East'),
(2, 'BDPL PHARMA', 'bdpl@gmail.com', '8645632963', 'Santacruz West'),
(9, 'Kiran Pharma', 'kiranpharma@gmail.com', '7638683637', 'Andheri East');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  ADD PRIMARY KEY (`USERNAME`),
  ADD KEY `fk_admin_pharmacy` (`pharmacy_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`INVOICE_ID`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `INVOICE_ID` (`INVOICE_ID`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `medicines_stock`
--
ALTER TABLE `medicines_stock`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `BATCH_ID` (`BATCH_ID`),
  ADD KEY `MEDICINE_ID` (`MEDICINE_ID`);

--
-- Indexes for table `pharmacy_details`
--
ALTER TABLE `pharmacy_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`VOUCHER_NUMBER`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `INVOICE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `medicines_stock`
--
ALTER TABLE `medicines_stock`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pharmacy_details`
--
ALTER TABLE `pharmacy_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `VOUCHER_NUMBER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  ADD CONSTRAINT `fk_admin_pharmacy` FOREIGN KEY (`pharmacy_id`) REFERENCES `pharmacy_details` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_ibfk_1` FOREIGN KEY (`INVOICE_ID`) REFERENCES `invoices` (`INVOICE_ID`) ON DELETE CASCADE;

--
-- Constraints for table `medicines_stock`
--
ALTER TABLE `medicines_stock`
  ADD CONSTRAINT `medicines_stock_ibfk_1` FOREIGN KEY (`MEDICINE_ID`) REFERENCES `medicines` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
