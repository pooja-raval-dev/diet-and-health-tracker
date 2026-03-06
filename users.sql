-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2025 at 02:46 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diet_tracker_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `height` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `goal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `created_at`, `age`, `gender`, `height`, `weight`, `goal`) VALUES
(1, 'Pooja', 'Pooja@gmail.com', '9876543210', 'pooja123', '2025-08-12 13:05:21', 25, 'male', 58, 75, 'Lose Weight'),
(2, 'ABC Shah', 'abc@gmail.com', '9879879870', 'abc123', '2025-08-12 14:48:57', 75, 'Male', 52, 49, 'Gain Weight'),
(4, 'Sachin', 'sachin1@gmail.com', '7894561230', 'sachin123', '2025-08-13 13:36:27', 30, 'male', 55, 60, 'Lose Weight'),
(5, 'Krishna Katariya', 'kk25@gmail.com', '6239518470', 'krishna25', '2025-08-13 13:37:55', 22, 'male', 55, 45, 'Gain Weight'),
(7, 'John Doe', 'john45@gmail.com', '7539873210', 'john456', '2025-08-13 14:20:00', 58, 'Male', 57, 70, 'Lose Weight'),
(9, 'Nisha Patel', 'nisha@gmail.com', '6842035719', 'nisha@25', '2025-09-06 11:49:43', 25, 'female', 48, 60, 'Lose Weight');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `2` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
