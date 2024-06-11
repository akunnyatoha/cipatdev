-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 04, 2024 at 08:13 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjamanruang`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_07_025042_create_roles_table', 1),
(6, '2023_12_07_031855_add_role_id_to_users_table', 1),
(7, '2023_12_07_031906_add_phone_to_users_table', 1),
(8, '2023_12_07_031916_add_avatar_to_users_table', 1),
(9, '2023_12_07_063056_create_rooms_table', 1),
(10, '2023_12_07_063232_create_peminjamans_table', 1),
(12, '2024_02_02_024159_create_sliders_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjamans`
--

CREATE TABLE `peminjamans` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_id` bigint UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_datetime` timestamp NOT NULL,
  `end_datetime` timestamp NOT NULL,
  `capacity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('accepted','pending','reject') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `validated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjamans`
--

INSERT INTO `peminjamans` (`id`, `email`, `name`, `phone`, `room_id`, `description`, `start_datetime`, `end_datetime`, `capacity`, `status`, `created_by`, `validated_by`, `created_at`, `updated_at`) VALUES
(187, 'chad.frami@gmail.com', 'Husein Syahfikri', '8888888888', 122, 'Filter', '2024-02-01 00:15:00', '2024-02-02 00:15:00', '40', 'pending', 650843, 650843, '2024-01-31 18:36:54', '2024-01-31 18:36:54'),
(188, 'chad.frami@gmail.com', 'Husein Syahfikri', '85155345149', 120, 'Filter2', '2024-01-23 17:51:00', '2024-01-25 16:50:00', '40', 'accepted', 650843, 650843, '2024-01-31 18:36:54', '2024-01-31 18:36:54'),
(189, 'chad.frami@gmail.com', 'Husein Syahfikri', '85155345149', 118, 'Filter', '2024-01-24 16:44:00', '2024-01-25 16:44:00', '50', 'accepted', 650843, 650843, '2024-01-31 18:36:54', '2024-01-31 18:36:54'),
(190, 'chad.frami@gmail.com', 'Husein Syahfikri', '85155345149', 102, 'Tes ga sih', '2024-01-19 06:15:00', '2024-01-20 06:15:00', '50', 'accepted', 650843, 650843, '2024-01-31 18:36:54', '2024-01-31 18:36:54'),
(191, 'chad.frami@gmail.com', 'Bessie Predovic', '-2896', 109, 'Validator', '2024-01-09 00:49:00', '2024-01-10 00:49:00', '50', 'accepted', 650843, 650843, '2024-01-31 18:36:54', '2024-01-31 18:36:54'),
(192, 'chad.frami@gmail.com', 'Bessie Predovic', '-2896', 102, 'Tes malam', '2023-12-29 13:24:00', '2023-12-30 13:24:00', '70', 'pending', 650843, 650843, '2024-01-31 18:36:54', '2024-01-31 18:36:54'),
(193, 'user1@gmail.com', 'Ricky Yahya', '85155345149', 109, 'tes', '2023-12-29 13:21:00', '2023-12-30 13:21:00', '50', 'accepted', 650843, 650843, '2024-01-31 18:36:54', '2024-01-31 18:36:54'),
(194, 'admin@email.test', 'Iphone 12', '8854665456', 102, 'Tes ga sih', '2023-12-22 12:32:00', '2023-12-23 12:32:00', '23', 'accepted', 650843, 650843, '2024-01-31 18:36:54', '2024-01-31 18:36:54'),
(195, 'chad.frami@gmail.com', 'Bessie Predovic', '-2896', 109, 'Tes ga sih', '2024-01-12 07:47:00', '2024-01-14 07:47:00', '9999', 'reject', 650843, 650843, '2024-01-31 18:36:54', '2024-01-31 18:36:54'),
(196, 'chad.frami@gmail.com', 'Bessie Predovic', '-2896', 109, 'reject', '2024-01-06 06:50:00', '2024-01-07 06:50:00', '9999', 'reject', 650843, 650843, '2024-01-31 18:36:54', '2024-01-31 18:36:54'),
(197, 'dawn.predovic@abshire.biz', 'Dr. Major Huels II', '14634036886', 102, 'Pending', '2023-12-29 06:49:00', '2023-12-30 06:49:00', '50', 'reject', 650843, 650843, '2024-01-31 18:36:54', '2024-01-31 18:36:54'),
(198, 'user1@gmail.com', 'Iphone 12', '85155345149', 102, 'dSendal Baru', '2023-12-29 06:36:00', '2024-01-05 06:36:00', '95', 'accepted', 650843, 650843, '2024-01-31 18:36:54', '2024-01-31 18:36:54'),
(199, 'syahfikri03@gmail.com', 'Husein Syahfikri', '85155345149', 109, 'dSendal Baru', '2024-01-01 04:25:00', '2024-01-05 04:25:00', '30', 'accepted', 650843, 650843, '2024-01-31 18:36:54', '2024-01-31 18:36:54'),
(200, 'chad.frami@gmail.com', 'Bessie Predovic', '-2896', 102, 'Tes ga sih', '2023-12-29 04:23:00', '2023-12-31 04:23:00', '9999', 'accepted', 650843, 650843, '2024-01-31 18:36:54', '2024-01-31 18:36:54'),
(201, 'ricky@example.com', 'Ricky Yahya', '85155345149', 109, 'Validator', '2023-12-29 03:00:00', '2024-01-05 03:00:00', '56', 'accepted', 650843, 650843, '2024-01-31 18:36:54', '2024-01-31 18:36:54'),
(202, 'ricky@example.com', 'Ricky Yahya', '85155345149', 102, 'Validator', '2023-12-29 04:49:00', '2024-01-02 03:45:00', '96', 'accepted', 650843, 650843, '2024-01-31 18:36:54', '2024-01-31 18:36:54'),
(203, 'chad.frami@gmail.com', 'Bessie Predovic', '-2896', 109, 'workshop', '2023-12-08 02:50:00', '2023-12-08 02:50:00', '40', 'accepted', 650843, 650843, '2024-01-31 18:36:54', '2024-01-31 18:36:54'),
(204, 'chad.frami@gmail.com', 'Husein Syahfikri', '85155345149', 102, 'dSendal Baru', '2024-01-24 13:00:00', '2024-01-25 13:00:00', '50', 'pending', 650843, 650843, '2024-01-31 18:36:54', '2024-01-31 18:36:54');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2023-12-07 19:48:59', '2023-12-07 19:48:59'),
(2, 'staff', '2023-12-07 19:48:59', '2023-12-07 19:48:59'),
(3, 'user', '2023-12-07 19:48:59', '2023-12-07 19:48:59');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `floor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `building` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `floor`, `capacity`, `building`, `created_at`, `updated_at`) VALUES
(102, 'DJOEANDA 1', '2', '30', 'A', '2023-12-07 19:49:00', '2024-01-18 21:40:43'),
(104, 'DJOEANDA 2', '2', '30', 'A', '2023-12-07 19:49:00', '2024-01-18 21:41:02'),
(105, 'AL BIRUNI 1', '2', '30', 'A', '2023-12-07 19:49:00', '2024-01-18 21:44:48'),
(107, 'AL BIRUNI 2', '2', '20', 'A', '2023-12-07 19:49:00', '2024-01-18 21:45:06'),
(109, 'AL FIHRIYAH 1', '2', '30', 'A', '2023-12-07 19:49:00', '2024-01-18 21:45:35'),
(110, 'AL FIHRIYAH 2', '2', '30', 'A', '2023-12-07 19:49:00', '2024-01-18 21:45:52'),
(116, 'AL KHAZINI 1', '2', '30', 'A', '2023-12-07 19:49:00', '2024-01-18 21:46:08'),
(118, 'HABIBIE 1', '3', '50', 'A', '2023-12-07 19:49:00', '2024-01-18 21:46:33'),
(119, 'HABIBIE 2', '3', '50', 'A', '2023-12-07 19:49:00', '2024-01-18 21:46:46'),
(120, 'SINAN 1', '3', '40', 'A', '2023-12-07 19:49:00', '2024-01-18 21:47:03'),
(121, 'SINAN 2', '3', '40', 'A', '2023-12-07 19:49:00', '2024-01-18 21:47:23'),
(122, 'SINAN 3', '3', '40', 'A', '2023-12-07 19:49:00', '2024-01-18 21:47:42'),
(123, 'AL BATTANI', '1', '50', 'B', '2023-12-07 19:49:00', '2024-01-18 21:48:04'),
(124, 'AL KHAZINI 2', '2', '30', 'B', '2023-12-07 19:49:00', '2024-01-18 21:48:30'),
(125, 'AR RAZI 1', '3', '60', 'B', '2023-12-07 19:49:00', '2024-01-18 21:48:53'),
(127, 'AR RAZI 2', '3', '60', 'B', '2023-12-07 19:49:00', '2024-01-18 21:49:22'),
(131, 'AL DINAWARI 1', '3', '50', 'B', '2023-12-07 19:49:00', '2024-01-18 21:49:46'),
(132, 'AL DINAWARI 2', '3', '50', 'B', '2023-12-07 19:49:00', '2024-01-18 21:50:00'),
(133, 'AR RAMMAH 1', '3', '30', 'B', '2023-12-07 19:49:00', '2024-01-18 21:50:33'),
(134, 'AR RAMMAH 1', '3', '30', 'B', '2023-12-07 19:49:00', '2024-01-18 21:50:48'),
(141, 'AL JAZARI 2', '1', '40', 'C', '2023-12-07 19:49:00', '2024-01-18 21:51:16'),
(145, 'AL JAZARI 3', '1', '30', 'C', '2023-12-07 19:49:00', '2024-01-18 21:51:33'),
(146, 'IBNU FIRNAS', '2', '30', 'C', '2023-12-07 19:49:00', '2024-01-18 21:51:56'),
(147, 'BANU MUSA 1', '2', '30', 'C', '2023-12-07 19:49:00', '2024-01-18 21:52:12'),
(152, 'BANU MUSA 2', '2', '30', 'C', '2023-12-07 19:49:00', '2024-01-18 21:52:26'),
(153, 'BANU MUSA 3', '2', '30', 'C', '2023-12-07 19:49:00', '2024-01-18 21:52:43'),
(154, 'AL KARAJI 1', '2', '40', 'D', '2023-12-07 19:49:00', '2024-01-18 21:53:16'),
(155, 'AL KARAJI 2', '2', '40', 'D', '2023-12-07 19:49:00', '2024-01-18 21:53:30'),
(161, 'IBNU RUSYD 1', '2', '40', 'D', '2023-12-07 19:49:00', '2024-01-18 21:53:55'),
(162, 'IBNU BAJJAH 1', '3', '30', 'D', '2023-12-07 19:49:00', '2024-01-18 21:54:10'),
(166, 'IBNU BAJJAH 2', '3', '40', 'D', '2023-12-07 19:49:00', '2024-01-18 21:54:29'),
(167, 'AL KHAWARIZMI 1', '3', '30', 'D', '2023-12-07 19:49:00', '2024-01-18 21:54:52'),
(168, 'AL KHAWARIZMI 2', '3', '30', 'D', '2023-12-07 19:49:00', '2024-01-18 21:55:28'),
(171, 'AL KHAYYAM 1', '3', '30', 'D', '2023-12-07 19:49:00', '2024-01-18 21:55:45'),
(173, 'AL KHAYYAM 2', '3', '30', 'D', '2023-12-07 19:49:00', '2024-01-18 21:55:58'),
(175, 'AL HAYTSAM 1', '3', '40', 'D', '2023-12-07 19:49:00', '2024-01-18 21:56:20'),
(176, 'AL HAYTSAM 2', '3', '40', 'D', '2023-12-07 19:49:00', '2024-01-18 21:56:34'),
(180, 'IBNU RUSYD 2', '3', '40', 'D', '2023-12-07 19:49:00', '2024-01-18 21:56:55');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `caption`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Denah', 'Lantai 1', '1706855996.jpg', '2024-02-01 20:25:02', '2024-02-01 23:39:56'),
(2, 'Denah', 'Lantai 2', '1706844466.jpg', '2024-02-01 20:27:46', '2024-02-01 20:27:46'),
(3, 'Denah', 'Lantai 3', '1706844476.jpg', '2024-02-01 20:27:56', '2024-02-01 20:27:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `phone`, `image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(123456, 3, 'Himpunan', 'himpunan@ftumj.ac.id', '123455678', '1705645584.jpg', NULL, '$2y$12$x46t1umVIRZ4rcVOVTvK7en9SxDnwGz6W06Cuh4CgkIcz7xUUSFb6', NULL, '2024-01-18 23:26:25', '2024-01-18 23:26:25'),
(154039, 2, 'Staff baru', 'staff@email.test', '12345678901', '1704772793.jpg', NULL, '$2y$12$Hpt0VsQ6riaOhzgsKOcVOOnyvgSMvOujlAzM2J5gFoe1YmmjbuUPy', NULL, '2023-12-07 19:48:59', '2024-01-08 21:00:16'),
(286878, 3, 'Dr. Major Huels II', 'dawn.predovic@abshire.biz', '+14634036886', NULL, NULL, '$2y$12$yQ.MNHTNbjkkoIazgMWAf.OBpum6eJiUALsnI9JYJSlFcRN9NkFTS', NULL, '2023-12-07 19:49:00', '2023-12-07 19:49:00'),
(434863, 3, 'Husein Syahfikri', 'chad.frami@gmail.com', '8888888888', '1706525333.jpg', NULL, '$2y$12$AFL35QuKX8Bxzi.4XaYbEetYrWrtURR6fO0JLautk/V3hkaQA5U7m', NULL, '2023-12-07 19:49:00', '2024-01-31 18:33:17'),
(650843, 1, 'Admin', 'admin@email.test', '(240) 386-0500', NULL, NULL, '$2y$12$tfstrKLanB8RtvwNvom9Eeaj2eUeHmbgguNuDiUZ0ZcSjCqQ0fco.', NULL, '2023-12-07 19:48:59', '2023-12-07 19:48:59'),
(123456789, 1, 'Husein Syahfikri', 'syahfikri01@gmail.com', '0888155664', '1703856511.jpg', NULL, '$2y$12$GR4uiUgcL4kEx41698iNt.A9.qKJiVvFa0SULEsX3YWG2RyASujOe', NULL, '2023-12-29 06:28:32', '2023-12-29 06:28:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjamans_room_id_foreign` (`room_id`),
  ADD KEY `peminjamans_created_by_foreign` (`created_by`),
  ADD KEY `peminjamans_validated_by_foreign` (`validated_by`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `peminjamans`
--
ALTER TABLE `peminjamans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123456790;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD CONSTRAINT `peminjamans_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `peminjamans_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjamans_validated_by_foreign` FOREIGN KEY (`validated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
