-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2025 at 02:16 PM
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
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`admin_id`, `admin_email`, `admin_password`, `name`) VALUES
(1, 'pooja@gmail.com', 'pooja@#411', 'Pooja Raval'),
(2, 'kano@gmail.com', 'kano@#25', 'Krishna Katariya'),
(3, 'mayur@gmail.com', 'mayur@#123', 'Mayur Devganiya');

-- --------------------------------------------------------

--
-- Table structure for table `diet_plans`
--

CREATE TABLE `diet_plans` (
  `diet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `breakfast` varchar(255) DEFAULT NULL,
  `lunch` varchar(255) DEFAULT NULL,
  `snacks` varchar(255) DEFAULT NULL,
  `dinner` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diet_plans`
--

INSERT INTO `diet_plans` (`diet_id`, `user_id`, `breakfast`, `lunch`, `snacks`, `dinner`, `notes`, `created_at`) VALUES
(1, 1, '1-2 brown bread toast', '1-2 chapatis + salad + a little rice', 'Roasted makhana', 'Soup + salad + khichdi + 1 roti', 'Drink 8-10 glasses of water daily💧\r\nSleep 7-8 hours😴', '2025-11-07 10:19:37'),
(2, 5, 'Poha/ upma/ oats with milk\r\nNuts and roasted chana', '1 bowl dal/ rajma/ chole with buttermilk\r\n2-3 chapatis', 'Dark chocalate/ sprouts chaat', 'Paneer tikka with roti\r\nMilk\r\n', 'Paneer, Milk and Egg help to weight gain.', '2025-11-07 10:27:03'),
(3, 21, '1 glass warm water with lemon or soaked methi seeds', '1–2 chapatis + salad + a little rice', 'Green tea or lemon water', 'Light & early: soup + salad', 'Drink 8–10 glasses of water daily 💧\r\n\r\nWalk 15–20 min after dinner 🚶‍♀️\r\n\r\nSleep 7–8 hours 😴', '2025-11-07 17:16:37');

-- --------------------------------------------------------

--
-- Table structure for table `health_logs`
--

CREATE TABLE `health_logs` (
  `health_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `sleep_hours` float NOT NULL,
  `calories` int(11) DEFAULT NULL,
  `water_intake` float DEFAULT NULL,
  `mood_level` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `health_logs`
--

INSERT INTO `health_logs` (`health_id`, `id`, `date`, `sleep_hours`, `calories`, `water_intake`, `mood_level`, `notes`) VALUES
(20, 2, '2025-09-12 15:32:57', 9, 567, 56, 3, 'Please help me dostttt 😫😫😔😔😔'),
(21, 1, '2025-09-25 16:42:17', 9, 89800, 98, 3, 'Give me diet plan please.'),
(22, 5, '2025-09-25 16:44:32', 9, 90, 989, 5, 'Diet plan..............'),
(26, 21, '2025-11-06 17:56:06', 8, 100, 10, 3, 'Make perfect diet plan for me.');

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
(1, 'Pooja', 'Pooja@gmail.com', '9876543210', 'pooja123', '2025-08-12 13:05:21', 25, 'Female', 58, 75, 'Lose Weight'),
(2, 'ABC Shah', 'abc@gmail.com', '9879879870', 'abc@123', '2025-08-12 14:48:57', 75, 'Male', 52, 49, 'Gain Weight'),
(5, 'Krishna Katariya', 'kk25@gmail.com', '6239518470', 'krishna25', '2025-08-13 13:37:55', 22, 'male', 55, 45, 'Gain Weight'),
(21, 'John Doe', 'john45@gmail.com', '9879879870', 'john123', '2025-11-06 17:24:09', 25, 'Male', 50, 75, 'Lose Weight');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`admin_email`);

--
-- Indexes for table `diet_plans`
--
ALTER TABLE `diet_plans`
  ADD PRIMARY KEY (`diet_id`),
  ADD KEY `fk_user_diet` (`user_id`);

--
-- Indexes for table `health_logs`
--
ALTER TABLE `health_logs`
  ADD PRIMARY KEY (`health_id`),
  ADD KEY `health_user` (`id`);

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
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `diet_plans`
--
ALTER TABLE `diet_plans`
  MODIFY `diet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `health_logs`
--
ALTER TABLE `health_logs`
  MODIFY `health_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `diet_plans`
--
ALTER TABLE `diet_plans`
  ADD CONSTRAINT `fk_user_diet` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `health_logs`
--
ALTER TABLE `health_logs`
  ADD CONSTRAINT `health_user` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
