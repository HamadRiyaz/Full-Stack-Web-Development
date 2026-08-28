-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2026 at 05:43 AM
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
-- Database: `attendance_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `status` enum('Present','Absent') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `subject`, `date`, `status`) VALUES
(1, '23140001', 'Software Engineering', '2026-02-10', 'Present'),
(2, '23140002', 'Software Engineering', '2026-02-10', 'Present'),
(3, '23140003', 'Software Engineering', '2026-02-10', 'Present'),
(4, '252980053', 'Software Engineering', '2026-02-10', 'Present'),
(5, '23140001', 'Software Engineering', '2026-02-11', 'Present'),
(6, '23140002', 'Software Engineering', '2026-02-11', 'Absent'),
(7, '23140003', 'Software Engineering', '2026-02-11', 'Present'),
(8, '252980053', 'Software Engineering', '2026-02-11', 'Present'),
(9, '252980009', 'Software Engineering', '2026-02-11', 'Absent'),
(10, '23140001', 'Software Engineering', '2026-02-12', 'Present'),
(11, '23140002', 'Software Engineering', '2026-02-12', 'Present'),
(12, '23140003', 'Software Engineering', '2026-02-12', 'Present'),
(13, '252980053', 'Software Engineering', '2026-02-12', 'Present'),
(14, '252980001', 'Software Engineering', '2026-02-12', 'Present'),
(15, '23140001', 'Software Engineering', '2026-02-14', 'Present'),
(16, '23140002', 'Software Engineering', '2026-02-14', 'Present'),
(17, '23140003', 'Software Engineering', '2026-02-14', 'Present'),
(18, '252980053', 'Software Engineering', '2026-02-14', 'Present'),
(19, '252980001', 'Software Engineering', '2026-02-14', 'Present'),
(20, '251400188', 'Software Engineering', '2026-02-14', 'Absent'),
(21, '23140001', 'Software Engineering', '2026-02-22', 'Absent'),
(22, '23140002', 'Software Engineering', '2026-02-22', 'Present'),
(23, '23140003', 'Software Engineering', '2026-02-22', 'Present'),
(24, '252980053', 'Software Engineering', '2026-02-22', 'Absent'),
(25, '252980001', 'Software Engineering', '2026-02-22', 'Absent'),
(26, '251400188', 'Software Engineering', '2026-02-22', 'Present'),
(27, '64462', 'Software Engineering', '2026-02-22', 'Present'),
(28, '23140001', 'Software Engineering', '2026-04-21', 'Present'),
(29, '23140002', 'Software Engineering', '2026-04-21', 'Present'),
(30, '23140003', 'Software Engineering', '2026-04-21', 'Absent'),
(31, '252980053', 'Software Engineering', '2026-04-21', 'Present'),
(32, '252980001', 'Software Engineering', '2026-04-21', 'Absent'),
(33, '251400188', 'Software Engineering', '2026-04-21', 'Present'),
(34, '64462', 'Software Engineering', '2026-04-21', 'Absent'),
(35, '251370162', 'Software Engineering', '2026-04-21', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('student','teacher') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `password`, `role`) VALUES
(1, 'teacher01', 'teacher123', 'teacher'),
(2, '23140001', 'student123', 'student'),
(3, '23140002', 'student123', 'student'),
(4, '23140003', 'student123', 'student'),
(6, '252980053', 'student', 'student'),
(8, '252980001', '1234', 'student'),
(9, '251400188', '123456', 'student'),
(10, '64462', '12345', 'student'),
(11, '251370162', '111', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
