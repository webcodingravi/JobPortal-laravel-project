-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2024 at 01:58 PM
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
-- Database: `jobportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Accountant', 1, '2024-08-07 08:18:36', '2024-08-07 08:18:36'),
(2, 'Construction & Engineering', 1, '2024-08-07 08:18:36', '2024-08-07 08:18:36'),
(3, 'IT/Computers', 1, '2024-08-07 08:18:36', '2024-08-07 08:18:36'),
(4, 'Social Media', 1, '2024-08-07 08:18:36', '2024-08-07 08:18:36'),
(5, 'Telecom', 1, '2024-08-07 08:18:36', '2024-08-07 08:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `job_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `vacancy` int(11) NOT NULL,
  `salery` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `benefits` text DEFAULT NULL,
  `responsibility` text DEFAULT NULL,
  `qualification` text DEFAULT NULL,
  `keyword` text DEFAULT NULL,
  `experience` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_location` varchar(255) DEFAULT NULL,
  `company_website` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `isFeatured` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `category_id`, `job_type_id`, `user_id`, `vacancy`, `salery`, `location`, `description`, `benefits`, `responsibility`, `qualification`, `keyword`, `experience`, `company_name`, `company_location`, `company_website`, `status`, `isFeatured`, `created_at`, `updated_at`) VALUES
(4, 'Vito Nader', 2, 2, 2, 5, NULL, 'Port Josie', 'Quam excepturi unde tempora id a a nihil. Magnam sapiente est sequi quo molestiae. Sed porro iusto et quo. Numquam et omnis eum. Libero recusandae modi vero perspiciatis et ullam unde.', NULL, NULL, NULL, NULL, '4', 'Mrs. Leonora Schroeder', NULL, NULL, 1, 1, '2024-08-08 05:46:50', '2024-08-08 05:46:50'),
(6, 'Miss Dixie Fahey', 2, 4, 2, 1, NULL, 'East Jordane', 'Ad esse et et eum fugiat. Repellendus eligendi odio ut modi molestias dolorum ut. Asperiores quia eum quis similique qui quas qui voluptatem.', NULL, NULL, NULL, NULL, '5', 'Rylee Pagac IV', NULL, NULL, 1, 0, '2024-08-08 05:46:50', '2024-08-08 05:46:50'),
(7, 'Php Devloper', 3, 1, 2, 5, '5.5k', 'Delhi', 'Tempora accusantium et ratione consequuntur est maxime architecto nostrum. Suscipit amet ut sint in facere ipsum. Cum sapiente aperiam qui nobis nesciunt vel. Laborum doloribus nobis qui.', '<p><span style=\"font-family: Mont-Regular; font-size: 16px;\">Tempora accusantium et ratione consequuntur est maxime architecto nostrum. Suscipit amet ut sint in facere ipsum. Cum sapiente aperiam qui nobis nesciunt vel. Laborum doloribus nobis qui.</span><br></p>', '<p><span style=\"font-family: Mont-Regular; font-size: 16px;\">Tempora accusantium et ratione consequuntur est maxime architecto nostrum. Suscipit amet ut sint in facere ipsum. Cum sapiente aperiam qui nobis nesciunt vel. Laborum doloribus nobis qui.</span><br></p>', '<p><span style=\"font-family: Mont-Regular; font-size: 16px;\">Tempora accusantium et ratione consequuntur est maxime architecto nostrum. Suscipit amet ut sint in facere ipsum. Cum sapiente aperiam qui nobis nesciunt vel. Laborum doloribus nobis qui.</span><br></p>', NULL, '6', 'Isabell Hartmann', 'Delhi', NULL, 1, 1, '2024-08-08 05:46:51', '2024-08-13 07:06:50'),
(8, 'Henriette Stanton', 5, 2, 2, 4, NULL, 'East Joana', 'Sed aut tempora ab hic nihil. Laudantium sequi debitis dolorem expedita doloribus quas ab. Aspernatur est omnis non. Nihil omnis perspiciatis et.', NULL, NULL, NULL, NULL, '4', 'Samara Kertzmann DVM', NULL, NULL, 0, 0, '2024-08-08 05:46:51', '2024-08-13 07:13:57'),
(10, 'Cristobal Becker Jr.', 1, 1, 2, 3, NULL, 'Port Aubreyburgh', 'Reiciendis molestias rem aut beatae. Corrupti repudiandae minima officiis aut. Voluptatem suscipit accusamus expedita enim.', NULL, NULL, NULL, NULL, '4', 'Cleve Moore', NULL, NULL, 1, 0, '2024-08-08 05:46:51', '2024-08-08 05:46:51'),
(11, 'Ms. Anne Bernhard Jr.', 5, 4, 2, 2, NULL, 'Keelyland', 'Minima consequatur nostrum neque. Vel dolore corrupti tempore quia vel corrupti omnis aut. Dolor quas ex eius. Deleniti dolorum optio quam ad.', NULL, NULL, NULL, NULL, '6', 'Kareem Jacobson', NULL, NULL, 1, 0, '2024-08-08 05:46:51', '2024-08-08 05:46:51'),
(12, 'Oliver Zemlak', 4, 5, 2, 2, NULL, 'South Cayla', 'Animi eos ut accusamus. Ratione nihil sint et dolore totam. Dolor vitae aut quia laudantium ipsam accusantium nemo. Harum dolorem sunt assumenda et. Voluptatum a sed autem autem.', NULL, NULL, NULL, NULL, '9', 'Fannie Jerde', NULL, NULL, 1, 0, '2024-08-08 05:46:51', '2024-08-08 05:46:51'),
(13, 'Helen Langworth III', 2, 4, 2, 2, NULL, 'Helenashire', 'Possimus omnis qui vero et. Ut rerum non recusandae quo ipsa. Dolorem atque et nulla veritatis ea cum.', NULL, NULL, NULL, NULL, '8', 'Candace Harber', NULL, NULL, 1, 0, '2024-08-08 05:46:51', '2024-08-08 05:46:51'),
(16, 'Antonietta Hammes', 5, 5, 2, 1, NULL, 'East Alisa', 'Id quisquam ut quae. Dolor perferendis est qui at ex vitae. Aut nam quas est aliquid deleniti culpa suscipit.', NULL, NULL, NULL, NULL, '6', 'Bulah Cartwright', NULL, NULL, 1, 0, '2024-08-08 05:46:51', '2024-08-08 05:46:51'),
(19, 'Maureen Terry', 4, 2, 2, 3, NULL, 'West Alfonsomouth', 'Enim id nam aperiam cumque. Quam et iste corrupti optio. Consequatur et et veniam iusto. Dolores qui aut est sequi quod incidunt.', NULL, NULL, NULL, NULL, '10', 'Dr. Dee Quigley', NULL, NULL, 1, 0, '2024-08-08 05:46:51', '2024-08-08 05:46:51'),
(20, 'Hassie Von', 4, 2, 2, 1, NULL, 'Wehnerfort', 'Et voluptates quis iusto architecto fuga maxime. Assumenda sequi tempore dolorem neque. Quos a ut delectus. Atque id ut occaecati consequatur quibusdam.', NULL, NULL, NULL, NULL, '5', 'Ebony Strosin', NULL, NULL, 1, 0, '2024-08-08 05:46:51', '2024-08-08 05:46:51'),
(29, 'Website Devlopment', 3, 1, 14, 15, '15k', 'Delhi', '<p>Website Devlopment</p>', '<p>helth insurance benefits</p>', '<p>Website design and Devlop</p>', '<p>12th, any Graducation&nbsp;</p>', 'Website Devlopment', '1', 'Rk desinger', 'Delhi', 'www.rkdesigner.com', 1, 0, '2024-08-13 08:14:08', '2024-08-13 08:14:08');

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `employer_id` bigint(20) UNSIGNED NOT NULL,
  `applied_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_types`
--

CREATE TABLE `job_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_types`
--

INSERT INTO `job_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Full Time', 1, '2024-08-07 08:19:30', '2024-08-07 08:19:30'),
(2, 'Part Time', 1, '2024-08-07 08:19:30', '2024-08-07 08:19:30'),
(3, 'Freelance', 1, '2024-08-07 08:19:30', '2024-08-07 08:19:30'),
(4, 'Remote', 1, '2024-08-07 08:19:30', '2024-08-07 08:19:30'),
(5, 'Contract', 1, '2024-08-07 08:19:30', '2024-08-07 08:19:30');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(6, '2024_08_07_132406_create_categories_table', 2),
(7, '2024_08_07_132441_create_job_types_table', 2),
(8, '2024_08_07_132529_create_jobs_table', 2),
(9, '2024_08_07_151458_update_jobs_table', 3),
(10, '2024_08_08_103055_update_jobs_table', 4),
(11, '2024_08_09_122833_create_job_applications_table', 5),
(12, '2024_08_12_073255_create_saved_jobs_table', 6),
(13, '2024_08_12_130640_update_users_table', 7),
(14, '2024_08_15_090046_create_password_reset_tokens', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`id`, `email`, `token`, `created_at`, `updated_at`) VALUES
(3, 'rkconsultancy34@gmail.com', 'LjqFTjZr6gADS5ly9rvzde8rhOs33fTgtCGPLHOrvRJT5aCU20bF4fjijtQQ', '2024-08-15 06:14:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `saved_jobs`
--

CREATE TABLE `saved_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saved_jobs`
--

INSERT INTO `saved_jobs` (`id`, `job_id`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 7, 2, '2024-08-12 03:35:10', '2024-08-12 03:35:10'),
(5, 7, 14, '2024-08-13 08:12:01', '2024-08-13 08:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `designation`, `mobile`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'krish', 'krish@gmail.com', NULL, '$2y$12$Hd1iKjUkg2.XYQ5LZ4XJZeLbpeurdOV4wcysvd/ihOXAnuCqWEPDG', '2-1723466490.jpeg', 'Accountant', '9355247728', 'admin', NULL, '2024-08-05 09:06:58', '2024-08-12 07:28:33'),
(8, 'Kristoffer Howe', 'tmann@example.com', '2024-08-13 05:39:02', '$2y$12$iTRf6CK8aTK6gv4ibpdl5.h2x0Guo797.d1MXh3fuDWWLt4LduiOy', NULL, NULL, NULL, 'user', 'Hx8sJdBsec', '2024-08-13 05:39:02', '2024-08-13 05:39:02'),
(10, 'Dr. Michelle Moore', 'ggaylord@example.org', '2024-08-13 05:43:07', '$2y$12$4ix3v4amKxl1sOu9xV5xmOw0zZ.FSmV5TquB4AcGvsO3oAMBYnri2', NULL, 'Website Devlopment', NULL, 'user', 'IMX2PFtlZe', '2024-08-13 05:43:07', '2024-08-13 05:52:34'),
(14, 'Ravi kumar', 'rkconsultancy34@gmail.com', NULL, '$2y$12$cQK8dCKS359Z/l/oQ3jflOfIiMGEXS6cQ3HaMkaYL14C.O0zgRNqa', NULL, 'Website Devlopment', '25678945', 'user', NULL, '2024-08-13 05:47:54', '2024-08-15 06:25:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_category_id_foreign` (`category_id`),
  ADD KEY `jobs_job_type_id_foreign` (`job_type_id`),
  ADD KEY `jobs_user_id_foreign` (`user_id`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_applications_job_id_foreign` (`job_id`),
  ADD KEY `job_applications_user_id_foreign` (`user_id`),
  ADD KEY `job_applications_employer_id_foreign` (`employer_id`);

--
-- Indexes for table `job_types`
--
ALTER TABLE `job_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved_jobs`
--
ALTER TABLE `saved_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saved_jobs_job_id_foreign` (`job_id`),
  ADD KEY `saved_jobs_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `job_types`
--
ALTER TABLE `job_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `saved_jobs`
--
ALTER TABLE `saved_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jobs_job_type_id_foreign` FOREIGN KEY (`job_type_id`) REFERENCES `job_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_employer_id_foreign` FOREIGN KEY (`employer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job_applications_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `saved_jobs`
--
ALTER TABLE `saved_jobs`
  ADD CONSTRAINT `saved_jobs_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `saved_jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
