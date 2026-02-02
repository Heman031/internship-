-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2026 at 08:28 AM
-- Server version: 8.0.41
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admission_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission_form`
--

CREATE TABLE `admission_form` (
  `id` int NOT NULL,
  `level` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `eligibility` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admission_form`
--

INSERT INTO `admission_form` (`id`, `level`, `name`, `mobile`, `email`, `course`, `eligibility`, `created_at`) VALUES
(13, 'UG', 'heman raj', '5663', 'hemanraj2713@gmail.com', 'BSc', '10+2 with Science', '2026-02-01 17:44:58'),
(18, 'UG', 'heman raj', '8877665544', 'heman27@gmail.com', 'BSc', '10+2 with Science', '2026-02-01 17:58:44'),
(20, 'UG', 'heman raj', '0123456799', 'heman7@gmail.com', 'BCA', '10+2 with Mathematics', '2026-02-02 05:03:00'),
(21, 'UG', 'heman raj', '0123456789', 'heman@gmail.com', 'BCA', '10+2 with Mathematics', '2026-02-02 06:47:31'),
(27, 'UG', 'hemNrg', '5454355656', 'hemanath@gmail.com', 'BCA', '10+2 with Mathematics', '2026-02-02 06:51:48'),
(28, 'UG', 'hemNrg', '5454355650', 'hemanah@gmail.com', 'BSc', '10+2 with Science', '2026-02-02 06:52:39');

-- --------------------------------------------------------

--
-- Table structure for table `diploma_courses`
--

CREATE TABLE `diploma_courses` (
  `id` int NOT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `eligibility` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `diploma_courses`
--

INSERT INTO `diploma_courses` (`id`, `course_name`, `eligibility`) VALUES
(1, 'Diploma IT', '10th Pass'),
(2, 'Diploma Mechanical', '10th Pass');

-- --------------------------------------------------------

--
-- Table structure for table `pg_courses`
--

CREATE TABLE `pg_courses` (
  `id` int NOT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `eligibility` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pg_courses`
--

INSERT INTO `pg_courses` (`id`, `course_name`, `eligibility`) VALUES
(1, 'MCA', 'UG Degree with Mathematics'),
(2, 'MBA', 'Any UG Degree + Entrance Exam'),
(3, 'MSc', 'Relevant UG Degree');

-- --------------------------------------------------------

--
-- Table structure for table `professional_courses`
--

CREATE TABLE `professional_courses` (
  `id` int NOT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `eligibility` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `professional_courses`
--

INSERT INTO `professional_courses` (`id`, `course_name`, `eligibility`) VALUES
(1, 'CA', '12th + Foundation Course'),
(2, 'CS', '12th + Foundation');

-- --------------------------------------------------------

--
-- Table structure for table `ug_courses`
--

CREATE TABLE `ug_courses` (
  `id` int NOT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `eligibility` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ug_courses`
--

INSERT INTO `ug_courses` (`id`, `course_name`, `eligibility`) VALUES
(1, 'BCA', '10+2 with Mathematics'),
(2, 'BSc', '10+2 with Science'),
(3, 'BCom', '10+2 in Commerce');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission_form`
--
ALTER TABLE `admission_form`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `diploma_courses`
--
ALTER TABLE `diploma_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pg_courses`
--
ALTER TABLE `pg_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professional_courses`
--
ALTER TABLE `professional_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ug_courses`
--
ALTER TABLE `ug_courses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admission_form`
--
ALTER TABLE `admission_form`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `diploma_courses`
--
ALTER TABLE `diploma_courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pg_courses`
--
ALTER TABLE `pg_courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `professional_courses`
--
ALTER TABLE `professional_courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ug_courses`
--
ALTER TABLE `ug_courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
