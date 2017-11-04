-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2017 at 04:03 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `larawiki`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `align` int(11) NOT NULL DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `featured_image_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `start_date`, `end_date`, `description`, `align`, `visible`, `created_at`, `updated_at`, `featured_image_url`, `user_id`) VALUES
(12, 'Napoleon', '1970-01-01', '1970-01-01', 'Napoléon Bonaparte (; 15 August 1769 – 5 May 1821) was a French military and political leader who rose to prominence during the French Revolution and led several successful campaigns during the French Revolutionary Wars', 0, 1, '2017-10-19 13:54:50', '2017-10-28 03:14:08', 'https://upload.wikimedia.org/wikipedia/commons/5/50/Jacques-Louis_David_-_The_Emperor_Napoleon_in_His_Study_at_the_Tuileries_-_Google_Art_Project.jpg', 2),
(13, 'Napoleon', '1970-01-01', '1970-01-01', 'Napoléon Bonaparte (; 15 August 1769 – 5 May 1821) was a French military and political leader who rose to prominence during the French Revolution and led several successful campaigns during the French Revolutionary Wars', 0, 1, '2017-10-19 13:57:30', '2017-10-19 13:57:30', 'https://upload.wikimedia.org/wikipedia/commons/5/50/Jacques-Louis_David_-_The_Emperor_Napoleon_in_His_Study_at_the_Tuileries_-_Google_Art_Project.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `event_id`, `name`, `url`, `created_at`, `updated_at`) VALUES
(19, 13, 'Carlo Buonaparte.jpg', 'https://upload.wikimedia.org/wikipedia/commons/a/a4/Carlo_Buonaparte.jpg', '2017-10-19 13:57:30', '2017-10-19 13:57:30'),
(20, 13, 'Paoli.png', 'https://upload.wikimedia.org/wikipedia/commons/0/0c/Paoli.png', '2017-10-19 13:57:30', '2017-10-19 13:57:30'),
(21, 13, 'Napoleon - 2.jpg', 'https://upload.wikimedia.org/wikipedia/commons/5/5d/Napoleon_-_2.jpg', '2017-10-19 13:57:31', '2017-10-19 13:57:31'),
(22, 13, '1801 Antoine-Jean Gros - Bonaparte on the Bridge at Arcole.jpg', 'https://upload.wikimedia.org/wikipedia/commons/f/f0/1801_Antoine-Jean_Gros_-_Bonaparte_on_the_Bridge_at_Arcole.jpg', '2017-10-19 13:57:31', '2017-10-19 13:57:31'),
(27, 12, 'Carlo Buonaparte.jpg', 'https://upload.wikimedia.org/wikipedia/commons/a/a4/Carlo_Buonaparte.jpg', '2017-10-28 03:14:08', '2017-10-28 03:14:08'),
(28, 12, 'Paoli.png', 'https://upload.wikimedia.org/wikipedia/commons/0/0c/Paoli.png', '2017-10-28 03:14:08', '2017-10-28 03:14:08');

-- --------------------------------------------------------

--
-- Table structure for table `line_event`
--

CREATE TABLE `line_event` (
  `id` int(10) UNSIGNED NOT NULL,
  `timeline_id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `line_event`
--

INSERT INTO `line_event` (`id`, `timeline_id`, `event_id`, `created_at`, `updated_at`) VALUES
(5, 3, 12, '2017-10-28 03:23:17', '2017-10-28 03:23:17'),
(6, 3, 13, '2017-10-28 03:23:17', '2017-10-28 03:23:17');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_10_16_223514_create_users_table', 1),
(2, '2017_10_16_224711_create_timelines_table', 1),
(3, '2017_10_16_224732_create_events_table', 1),
(4, '2017_10_16_224756_create_images_table', 1),
(5, '2017_10_16_225245_create_line_event_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `timelines`
--

CREATE TABLE `timelines` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `timelines`
--

INSERT INTO `timelines` (`id`, `user_id`, `title`, `start_date`, `end_date`, `color`, `description`, `created_at`, `updated_at`) VALUES
(3, 2, 'oriari', '0000-00-00', '2034-12-23', 'red', 'An airplane or aeroplane (informally plane) is a powered, fixed-wing aircraft that is propelled forward by thrust from a jet engine or propeller', '2017-10-19 13:57:45', '2017-10-28 03:23:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `setting_push_notification` tinyint(1) NOT NULL DEFAULT '1',
  `timeline_count` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `event_count` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `photo_url`, `phone_number`, `setting_push_notification`, `timeline_count`, `event_count`, `created_at`, `updated_at`, `email`, `token`) VALUES
(2, NULL, NULL, 'admin', '$2y$10$sXwuTw.Nib7/NnxeS/oRR.uS1axlnRSVTYmjAYBLr3QjYpUQW2XY2', NULL, NULL, 1, 3, 5, '2017-10-17 03:42:07', '2017-10-27 01:30:34', 'admin@la.fr', '2c9b26140aaaf955b42b4576b202c5d0'),
(3, NULL, NULL, 'user', '$2y$10$omuxu46uf.9w11ZysyDnQOG/jN5dfo3FvjuAEJPjFltZxdYwd/8k6', NULL, NULL, 1, 0, 0, '2017-10-17 21:06:39', '2017-10-17 21:06:39', 'user@la.fr', '2d9db629690d2f1eab697ace7c71f2a1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `line_event`
--
ALTER TABLE `line_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timelines`
--
ALTER TABLE `timelines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `line_event`
--
ALTER TABLE `line_event`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `timelines`
--
ALTER TABLE `timelines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
