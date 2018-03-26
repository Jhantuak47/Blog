-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2018 at 09:48 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lsapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_01_18_073900_create_posts_table', 1),
(4, '2018_01_19_091324_add_user_id_to_posts', 2),
(5, '2018_01_19_150839_add_cover_image_to_post', 3),
(7, '2018_01_23_095251_create_delete_column_to_post', 4),
(8, '2018_01_23_122256_create_image_column_to_post', 5),
(9, '2018_01_24_053627_user_get_profile_image', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `cover_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `created_at`, `updated_at`, `user_id`, `deleted`, `cover_image`, `deleted_at`) VALUES
(8, 'First Post', 'This is my first post with image test.......', '2018-01-23 07:17:26', '2018-01-23 07:17:26', 2, 0, 'content_top_1516711646.jpg', NULL),
(9, 'Second Post', 'This post  is test for uploading without image....', '2018-01-23 07:55:54', '2018-01-24 05:12:51', 2, 0, 'images_1516788357.jpg', NULL),
(10, 'My New posts', 'fhslsjflkdsfsdfdsfsfsfsfsdfffffffffffffffffffffffffff', '2018-02-15 06:37:33', '2018-02-15 06:37:33', 4, 0, 'no_image.jpg', NULL),
(11, 'last post', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2018-02-15 06:38:29', '2018-03-14 05:54:19', 4, 0, 'Screenshot (14)_1521026659.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile_img` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `profile_img`) VALUES
(2, 'Krishna', 'krishnanandi4@gamil.com', '$2y$10$Jyz7vYgUTk1osoJv17iGaeNTTLjYGWD7.EUeWf3cT/fi4IXjotp0m', 'wUsRiU5EZvx6gwhqmVOxy1cSPswcAgozApQYr4lxZsmn1RFh3Hke00PW0k6h', '2018-01-19 03:25:35', '2018-01-24 01:22:10', 'IMG_20170513_212715_1516776730.jpg'),
(3, 'Admin', 'admin@gmail.com', '$2y$10$TobG6x6cSsru/ZVmrZylQ./n0rkePzlA2UsXcj62xRaxyLemiogtG', 'dkdEJyNekUmr1OLAbETzD6sIITNjKAIXCM4QtMoYui5lmd89YJBTOv8akxN7', '2018-01-19 05:40:45', '2018-01-19 05:40:45', 'no_image.jpg'),
(4, 'Jhantu Nandi', 'jhantunandi4@gmail.com', '$2y$10$jtfbrtjF7zhxukwmnzcxWuQ5gtyQRnz/IVJf0SqWrYxQvY4cPtXSS', 'kP4KFBBmYGU8ymbllL5kn8rHRdz4jrw56bAFrt6iluHzrJgOPSR97KINQHrx', '2018-02-15 06:36:59', '2018-02-15 06:36:59', 'no_image.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
