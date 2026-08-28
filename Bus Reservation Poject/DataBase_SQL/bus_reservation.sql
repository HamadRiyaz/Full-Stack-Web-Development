-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Database: `bus_reservation`
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

SET NAMES utf8mb4;

--
-- Database: `bus_reservation`
--

-- --------------------------------------------------------
--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`) VALUES
(1, 'Admin One', 'admin1@example.com', 'demo123'),
(2, 'Admin Two', 'admin2@example.com', 'demo456'),
(3, 'Admin Three', 'admin3@example.com', 'demo789'),
(4, 'Admin Four', 'admin4@example.com', 'demo101');

-- --------------------------------------------------------
--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `status` enum('Confirmed','Cancelled','Pending') DEFAULT 'Pending',
  `passenger_id` int(11) DEFAULT NULL,
  `bus_id` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `seat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `booking_date`, `status`, `passenger_id`, `bus_id`, `route_id`, `seat_id`) VALUES
(14, '2026-02-26', 'Confirmed', 21, 4, 9, 38),
(16, '2026-02-26', 'Confirmed', 2, 6, 11, 89),
(17, '2026-02-26', 'Confirmed', 5, 7, 12, 110),
(18, '2026-02-26', 'Confirmed', 6, 8, 13, 120),
(19, '2026-02-27', 'Confirmed', 22, 10, 15, 148),
(20, '2026-03-22', 'Confirmed', 23, 4, 9, 36),
(21, '2026-04-07', 'Confirmed', 24, 4, 9, 37),
(24, '2026-05-24', 'Confirmed', 27, 4, 9, 44),
(25, '2026-05-26', 'Confirmed', 28, 4, 9, 41),
(26, '2026-07-03', 'Confirmed', 29, 10, 15, 149);

-- --------------------------------------------------------
--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `bus_id` int(11) NOT NULL,
  `bus_number` varchar(20) NOT NULL,
  `total_seats` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`bus_id`, `bus_number`, `total_seats`, `admin_id`, `route_id`) VALUES
(4, 'BUS-201', 40, 1, 9),
(5, 'BUS-202', 45, 1, 10),
(6, 'BUS-203', 50, 1, 11),
(7, 'BUS-204', 40, 2, 12),
(8, 'BUS-205', 55, 2, 13),
(9, 'BUS-206', 60, 1, 14),
(10, 'BUS-207', 45, 2, 15),
(11, 'BUS-208', 50, 1, 16),
(14, 'BUS-209', 45, 1, NULL),
(20, 'BUS-302', 25, 1, 24),
(23, 'BUS-6579', 30, 1, 27);

-- --------------------------------------------------------
--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `passenger_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`passenger_id`, `name`, `email`, `phone`, `password`) VALUES
(1, 'Passenger One', 'passenger1@example.com', '03000000001', 'demo111'),
(2, 'Passenger Two', 'passenger2@example.com', '03000000002', 'demo111'),
(3, 'Passenger Three', 'passenger3@example.com', '03000000003', 'demo111'),
(4, 'Passenger Four', 'passenger4@example.com', '03000000004', 'demo111'),
(5, 'Passenger Five', 'passenger5@example.com', '03000000005', 'demo111'),
(6, 'Passenger Six', 'passenger6@example.com', '03000000006', 'demo111'),
(7, 'Passenger Seven', 'passenger7@example.com', '03000000007', 'demo111'),
(8, 'Passenger Eight', 'passenger8@example.com', '03000000008', 'demo111'),
(18, 'Passenger Nine', 'passenger9@example.com', '03000000018', 'demo555'),
(20, 'Passenger Ten', 'passenger10@example.com', '03000000020', 'demo123'),
(21, 'Passenger Eleven', 'passenger11@example.com', '03000000021', 'demo555'),
(22, 'Passenger Twelve', 'passenger12@example.com', '03000000022', 'demo222'),
(23, 'Passenger Thirteen', 'passenger13@example.com', '03000000023', 'demo333'),
(24, 'Passenger Fourteen', 'passenger14@example.com', '03000000024', 'demo123'),
(25, 'Passenger Fifteen', 'passenger15@example.com', '03000000025', 'demo444'),
(26, 'Passenger Sixteen', 'passenger16@example.com', '03000000026', 'demo111'),
(27, 'Passenger Seventeen', 'passenger17@example.com', '03000000027', 'demo123'),
(28, 'Passenger Eighteen', 'passenger18@example.com', '03000000028', 'demo123'),
(29, 'Passenger Nineteen', 'passenger19@example.com', '03000000029', 'demo123'),
(30, 'Passenger Twenty', 'passenger20@example.com', '03000000030', 'demo123');

-- --------------------------------------------------------
--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `payment_method` varchar(30) DEFAULT NULL,
  `payment_status` enum('Paid','Unpaid') DEFAULT 'Paid'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `booking_id`, `payment_date`, `amount`, `payment_method`, `payment_status`) VALUES
(12, 14, '2026-02-26', 5000.00, 'Card', 'Paid'),
(14, 16, '2026-02-26', 800.00, 'Card', 'Paid'),
(15, 17, '2026-02-26', 1200.00, 'Card', 'Paid'),
(16, 18, '2026-02-26', 4400.00, 'Card', 'Paid'),
(17, 19, '2026-02-27', 1500.00, 'Card', 'Paid'),
(18, 20, '2026-03-22', 5000.00, 'Card', 'Paid'),
(19, 21, '2026-04-07', 5000.00, 'Card', 'Paid'),
(22, 24, '2026-05-24', 2500.00, 'Card', 'Paid'),
(23, 25, '2026-05-26', 5000.00, 'Card', 'Paid'),
(24, 26, '2026-07-03', 4500.00, 'Card', 'Paid');

-- --------------------------------------------------------
--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `route_id` int(11) NOT NULL,
  `source` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `travel_time` varchar(20) DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`route_id`, `source`, `destination`, `travel_time`, `price`, `admin_id`) VALUES
(9, 'Lahore', 'Islamabad', '5 Hours', 2500.00, 1),
(10, 'Lahore', 'Karachi', '18 Hours', 6000.00, 1),
(11, 'Gujranwala', 'Lahore', '2 Hours', 800.00, 1),
(12, 'Islamabad', 'Peshawar', '3 Hours', 1200.00, 2),
(13, 'Multan', 'Lahore', '6 Hours', 2200.00, 2),
(14, 'Faisalabad', 'Rawalpindi', '4 Hours', 1800.00, 1),
(15, 'Sialkot', 'Lahore', '3 Hours', 1500.00, 2),
(16, 'Bahawalpur', 'Multan', '2.5 Hours', 1000.00, 1),
(24, 'Lahore', 'Narang Mandi', '2 Hours', 500.00, 1),
(25, 'Kala Khatai', 'Iran', '12 Hours', 0.00, 1),
(26, 'Lahore', 'Peshawar', '', 2000.00, 1),
(27, 'Lahore', 'Peshawar', '2 Hours', 1000.00, 1),
(28, 'Lahore', 'Peshawar', '2 Hours', 1000.00, 1);

-- --------------------------------------------------------
--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `seat_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `seat_no` int(11) NOT NULL,
  `seat_type` enum('Normal','VIP') DEFAULT 'Normal',
  `is_booked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`seat_id`, `bus_id`, `seat_no`, `seat_type`, `is_booked`) VALUES
(29, 4, 20, 'Normal', 1),
(31, 4, 22, 'Normal', 1),
(34, 4, 25, 'Normal', 1),
(36, 4, 27, 'Normal', 1),
(37, 4, 28, 'Normal', 1),
(38, 4, 29, 'Normal', 1),
(39, 4, 30, 'Normal', 1),
(40, 4, 31, 'Normal', 0),
(41, 4, 32, 'Normal', 1),
(42, 4, 33, 'Normal', 0),
(43, 4, 34, 'Normal', 0),
(44, 4, 35, 'Normal', 1),
(45, 4, 36, 'Normal', 0),
(46, 4, 37, 'Normal', 0),
(47, 4, 38, 'Normal', 0),
(48, 4, 39, 'Normal', 0),
(49, 4, 40, 'Normal', 0),

(73, 5, 1, 'Normal', 0),
(74, 5, 2, 'Normal', 0),
(75, 5, 3, 'Normal', 0),
(76, 5, 4, 'VIP', 0),
(77, 5, 5, 'Normal', 1),
(78, 5, 6, 'Normal', 0),
(79, 5, 7, 'Normal', 0),
(80, 5, 8, 'VIP', 0),
(81, 5, 9, 'Normal', 0),
(82, 5, 10, 'Normal', 1),
(83, 5, 11, 'Normal', 0),
(84, 5, 12, 'VIP', 0),
(85, 5, 13, 'Normal', 0),
(86, 5, 14, 'Normal', 0),
(87, 5, 15, 'Normal', 1),

(88, 6, 1, 'Normal', 0),
(89, 6, 2, 'Normal', 1),
(90, 6, 3, 'Normal', 0),
(91, 6, 4, 'VIP', 0),
(92, 6, 5, 'Normal', 1),
(93, 6, 6, 'Normal', 0),
(94, 6, 7, 'Normal', 0),
(95, 6, 8, 'VIP', 0),
(96, 6, 9, 'Normal', 0),
(97, 6, 10, 'Normal', 1),
(98, 6, 11, 'Normal', 0),
(99, 6, 12, 'VIP', 0),
(100, 6, 13, 'Normal', 0),
(101, 6, 14, 'Normal', 0),
(102, 6, 15, 'Normal', 1),

(103, 7, 1, 'Normal', 0),
(104, 7, 2, 'Normal', 0),
(105, 7, 3, 'Normal', 0),
(106, 7, 4, 'VIP', 0),
(107, 7, 5, 'Normal', 1),
(108, 7, 6, 'Normal', 0),
(109, 7, 7, 'Normal', 0),
(110, 7, 8, 'VIP', 1),
(111, 7, 9, 'Normal', 0),
(112, 7, 10, 'Normal', 1),
(113, 7, 11, 'Normal', 0),
(114, 7, 12, 'VIP', 0),
(115, 7, 13, 'Normal', 0),
(116, 7, 14, 'Normal', 0),
(117, 7, 15, 'Normal', 1),

(118, 8, 1, 'Normal', 0),
(119, 8, 2, 'Normal', 0),
(120, 8, 3, 'Normal', 1),
(121, 8, 4, 'VIP', 0),
(122, 8, 5, 'Normal', 1),
(123, 8, 6, 'Normal', 0),
(124, 8, 7, 'Normal', 0),
(125, 8, 8, 'VIP', 0),
(126, 8, 9, 'Normal', 0),
(127, 8, 10, 'Normal', 1),
(128, 8, 11, 'Normal', 0),
(129, 8, 12, 'VIP', 1),
(130, 8, 13, 'Normal', 0),
(131, 8, 14, 'Normal', 0),
(132, 8, 15, 'Normal', 1),

(133, 9, 1, 'Normal', 0),
(134, 9, 2, 'Normal', 0),
(135, 9, 3, 'Normal', 0),
(136, 9, 4, 'VIP', 0),
(137, 9, 5, 'Normal', 1),
(138, 9, 6, 'Normal', 0),
(139, 9, 7, 'Normal', 0),
(140, 9, 8, 'VIP', 0),
(141, 9, 9, 'Normal', 0),
(142, 9, 10, 'Normal', 1),
(143, 9, 11, 'Normal', 0),
(144, 9, 12, 'VIP', 0),
(145, 9, 13, 'Normal', 0),
(146, 9, 14, 'Normal', 0),
(147, 9, 15, 'Normal', 1),

(148, 10, 1, 'Normal', 1),
(149, 10, 2, 'Normal', 1),
(150, 10, 3, 'Normal', 0),
(151, 10, 4, 'VIP', 0),
(152, 10, 5, 'Normal', 1),
(153, 10, 6, 'Normal', 0),
(154, 10, 7, 'Normal', 0),
(155, 10, 8, 'VIP', 0),
(156, 10, 9, 'Normal', 0),
(157, 10, 10, 'Normal', 1),
(158, 10, 11, 'Normal', 0),
(159, 10, 12, 'VIP', 0),
(160, 10, 13, 'Normal', 0),
(161, 10, 14, 'Normal', 0),
(162, 10, 15, 'Normal', 1),

(163, 11, 1, 'Normal', 0),
(164, 11, 2, 'Normal', 0),
(165, 11, 3, 'Normal', 0),
(166, 11, 4, 'VIP', 0),
(167, 11, 5, 'Normal', 1),
(168, 11, 6, 'Normal', 0),
(169, 11, 7, 'Normal', 0),
(170, 11, 8, 'VIP', 0),
(171, 11, 9, 'Normal', 0),
(172, 11, 10, 'Normal', 1),
(173, 11, 11, 'Normal', 1),
(174, 11, 12, 'VIP', 0),
(175, 11, 13, 'Normal', 0),
(176, 11, 14, 'Normal', 0),
(177, 11, 15, 'Normal', 1),

(178, 8, 0, 'Normal', 0),
(179, 8, 0, 'Normal', 0),
(180, 8, 0, 'Normal', 0),
(181, 8, 0, 'Normal', 0),
(182, 8, 0, 'Normal', 0),
(183, 8, 0, 'Normal', 0),
(184, 8, 0, 'Normal', 0),
(185, 8, 0, 'Normal', 0),
(186, 8, 0, 'Normal', 0),
(187, 8, 0, 'Normal', 0),

(243, 20, 0, 'Normal', 0),
(244, 20, 0, 'Normal', 0),
(245, 20, 0, 'Normal', 0),
(246, 20, 0, 'Normal', 0),
(247, 20, 0, 'Normal', 0),
(248, 20, 0, 'Normal', 0),
(249, 20, 0, 'Normal', 0),
(250, 20, 0, 'Normal', 0),
(251, 20, 0, 'Normal', 0),
(252, 20, 0, 'Normal', 0),
(253, 20, 0, 'Normal', 0),
(254, 20, 0, 'Normal', 0),
(255, 20, 0, 'Normal', 0),
(256, 20, 0, 'Normal', 0),
(257, 20, 0, 'Normal', 0),
(258, 20, 0, 'Normal', 0),
(259, 20, 0, 'Normal', 0),
(260, 20, 0, 'Normal', 0),
(261, 20, 0, 'Normal', 0),
(262, 20, 0, 'Normal', 0),
(263, 20, 0, 'Normal', 0),
(264, 20, 0, 'Normal', 0),
(265, 20, 0, 'Normal', 0),
(266, 20, 0, 'Normal', 0),
(267, 20, 0, 'Normal', 0),

(348, 23, 0, 'Normal', 0),
(349, 23, 0, 'Normal', 0),
(350, 23, 0, 'Normal', 0),
(351, 23, 0, 'Normal', 0),
(352, 23, 0, 'Normal', 0),
(353, 23, 0, 'Normal', 0),
(354, 23, 0, 'Normal', 0),
(355, 23, 0, 'Normal', 0),
(356, 23, 0, 'Normal', 0),
(357, 23, 0, 'Normal', 0),
(358, 23, 0, 'Normal', 0),
(359, 23, 0, 'Normal', 0),
(360, 23, 0, 'Normal', 0),
(361, 23, 0, 'Normal', 0),
(362, 23, 0, 'Normal', 0),
(363, 23, 0, 'Normal', 0),
(364, 23, 0, 'Normal', 0),
(365, 23, 0, 'Normal', 0),
(366, 23, 0, 'Normal', 0),
(367, 23, 0, 'Normal', 0),
(368, 23, 0, 'Normal', 0),
(369, 23, 0, 'Normal', 0),
(370, 23, 0, 'Normal', 0),
(371, 23, 0, 'Normal', 0),
(372, 23, 0, 'Normal', 0),
(373, 23, 0, 'Normal', 0),
(374, 23, 0, 'Normal', 0),
(375, 23, 0, 'Normal', 0),
(376, 23, 0, 'Normal', 0),
(377, 23, 0, 'Normal', 0);

-- --------------------------------------------------------
--
-- Indexes for dumped tables
--

ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `passenger_id` (`passenger_id`),
  ADD KEY `bus_id` (`bus_id`),
  ADD KEY `route_id` (`route_id`),
  ADD KEY `seat_id` (`seat_id`);

ALTER TABLE `bus`
  ADD PRIMARY KEY (`bus_id`),
  ADD UNIQUE KEY `bus_number` (`bus_number`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `fk_route` (`route_id`);

ALTER TABLE `passenger`
  ADD PRIMARY KEY (`passenger_id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD UNIQUE KEY `booking_id` (`booking_id`);

ALTER TABLE `route`
  ADD PRIMARY KEY (`route_id`),
  ADD KEY `admin_id` (`admin_id`);

ALTER TABLE `seat`
  ADD PRIMARY KEY (`seat_id`),
  ADD KEY `bus_id` (`bus_id`);

-- --------------------------------------------------------
--
-- AUTO_INCREMENT
--

ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

ALTER TABLE `bus`
  MODIFY `bus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

ALTER TABLE `passenger`
  MODIFY `passenger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

ALTER TABLE `route`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

ALTER TABLE `seat`
  MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=423;

-- --------------------------------------------------------
--
-- Constraints
--

ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`passenger_id`) REFERENCES `passenger` (`passenger_id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`bus_id`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`route_id`) REFERENCES `route` (`route_id`),
  ADD CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`seat_id`) REFERENCES `seat` (`seat_id`);

ALTER TABLE `bus`
  ADD CONSTRAINT `bus_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `fk_route` FOREIGN KEY (`route_id`) REFERENCES `route` (`route_id`);

ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`);

ALTER TABLE `route`
  ADD CONSTRAINT `route_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

ALTER TABLE `seat`
  ADD CONSTRAINT `seat_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`bus_id`);

COMMIT;

SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT;
SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS;
SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION;