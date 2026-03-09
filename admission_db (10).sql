-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 09, 2026 at 07:59 AM
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
-- Database: `admission_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$64RSiBZjK292Fbc3LGWYUuE0QKT5wVGrRTNuNWuj8uTgIjdkDGQbi');

-- --------------------------------------------------------

--
-- Table structure for table `approval_logs`
--

CREATE TABLE `approval_logs` (
  `id` int(11) NOT NULL,
  `application_id` int(11) DEFAULT NULL,
  `application_no` varchar(30) DEFAULT NULL,
  `action_type` varchar(20) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `processed_by` varchar(100) DEFAULT NULL,
  `processed_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `approval_logs`
--

INSERT INTO `approval_logs` (`id`, `application_id`, `application_no`, `action_type`, `remark`, `processed_by`, `processed_at`) VALUES
(1, 11, 'PGA-2026-00005', 'Pending', 'submit mark', 'admin', '2026-02-22 23:17:19'),
(2, 5, 'PGA-2026-00001', 'Approved', 'hh', 'admin', '2026-02-22 23:18:37'),
(0, 20, 'UGA-2026-00004', 'Approved', 'asdfghjkl;\'', 'admin', '2026-02-24 14:26:04'),
(0, 19, 'CERTA-2026-00001', 'Approved', 'sdff', 'admin', '2026-02-24 15:26:54'),
(0, 19, 'CERTA-2026-00001', 'Pending', 'fgrg', 'admin', '2026-02-24 15:27:51'),
(0, 3, 'PG-2026-00001', 'Rejected', NULL, 'admin', '2026-02-25 12:07:31'),
(0, 11, 'PGA-2026-00005', 'Rejected', NULL, 'admin', '2026-02-25 12:07:49'),
(0, 11, 'PGA-2026-00005', 'Rejected', NULL, 'admin', '2026-02-25 12:07:53'),
(0, 12, 'PGA-2026-00006', 'Rejected', NULL, 'admin', '2026-02-25 12:08:03'),
(0, 43, 'UGA-2026-00023', 'Rejected', NULL, 'admin', '2026-03-03 09:46:00'),
(0, 44, 'UGA-2026-00024', 'Rejected', NULL, 'admin', '2026-03-03 09:46:20'),
(0, 25, 'UGA-2026-00006', 'Approved', NULL, 'admin', '2026-03-06 15:13:55'),
(0, 22, 'DIPA-2026-00004', 'Approved', NULL, 'admin', '2026-03-06 15:13:55'),
(0, 15, 'PGA-2026-00007', 'Approved', NULL, 'admin', '2026-03-06 15:13:55'),
(0, 13, 'UGA-2026-00001', 'Approved', NULL, 'admin', '2026-03-06 15:13:55'),
(0, 10, 'PGA-2026-00004', 'Approved', NULL, 'admin', '2026-03-06 15:13:55'),
(0, 9, 'PGA-2026-00003', 'Approved', NULL, 'admin', '2026-03-06 15:13:55');

-- --------------------------------------------------------

--
-- Table structure for table `caste_master`
--

CREATE TABLE `caste_master` (
  `id` int(11) NOT NULL,
  `community` varchar(20) DEFAULT NULL,
  `caste_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `caste_master`
--

INSERT INTO `caste_master` (`id`, `community`, `caste_name`) VALUES
(1, 'OC', 'Brahmin'),
(2, 'OC', 'Iyer'),
(3, 'OC', 'Iyengar'),
(4, 'OC', 'Mudaliar'),
(5, 'OC', 'Pillai'),
(6, 'OC', 'Chettiar'),
(7, 'OC', 'Naidu'),
(8, 'OC', 'Reddiar'),
(9, 'OC', 'Nair'),
(10, 'OC', 'Marwari'),
(11, 'OC', 'Others'),
(12, 'BC', 'Agamudayar'),
(13, 'BC', 'Balija'),
(14, 'BC', 'Chettiar'),
(15, 'BC', 'Gounder'),
(16, 'BC', 'Illathu Pillaimar'),
(17, 'BC', 'Jain'),
(18, 'BC', 'Kongu Vellalar'),
(19, 'BC', 'Naidu'),
(20, 'BC', 'Padmasali'),
(21, 'BC', 'Parkavakulam'),
(22, 'BC', 'Sengunthar'),
(23, 'BC', 'Vellalar'),
(24, 'BC', 'Vanniyar'),
(25, 'BC', 'Yadava'),
(26, 'BC', 'Others'),
(27, 'MBC', 'Agamudayar'),
(28, 'MBC', 'Ambalakaran'),
(29, 'MBC', 'Boyar'),
(30, 'MBC', 'Gavara'),
(31, 'MBC', 'Gounder'),
(32, 'MBC', 'Isai Vellalar'),
(33, 'MBC', 'Kaladi'),
(34, 'MBC', 'Kallar'),
(35, 'MBC', 'Maravar'),
(36, 'MBC', 'Mooppan'),
(37, 'MBC', 'Muthuraja'),
(38, 'MBC', 'Nadar'),
(39, 'MBC', 'Servai'),
(40, 'MBC', 'Thevar'),
(41, 'MBC', 'Vanniyar'),
(42, 'MBC', 'Vettuva Gounder'),
(43, 'MBC', 'Others'),
(44, 'SC', 'Adi Dravidar'),
(45, 'SC', 'Arunthathiyar'),
(46, 'SC', 'Chakkiliyan'),
(47, 'SC', 'Madiga'),
(48, 'SC', 'Pallar'),
(49, 'SC', 'Paraiyar'),
(50, 'SC', 'Sakkiliyar'),
(51, 'SC', 'Thoti'),
(52, 'SC', 'Others'),
(53, 'ST', 'Irular'),
(54, 'ST', 'Kattunayakan'),
(55, 'ST', 'Kanikaran'),
(56, 'ST', 'Kurumba'),
(57, 'ST', 'Malayali'),
(58, 'ST', 'Paniyan'),
(59, 'ST', 'Toda'),
(60, 'ST', 'Uraly'),
(61, 'ST', 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `certificate_courses`
--

CREATE TABLE `certificate_courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `medium` varchar(50) DEFAULT NULL,
  `eligibility` text DEFAULT NULL,
  `programme_degree` varchar(50) DEFAULT NULL,
  `main_subject` varchar(100) DEFAULT NULL,
  `course_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificate_courses`
--

INSERT INTO `certificate_courses` (`id`, `course_name`, `duration`, `medium`, `eligibility`, `programme_degree`, `main_subject`, `course_code`) VALUES
(1, 'Certificate in Accounting and Auditing', '6 Months', 'English & Tamil', 'Candidates who have passed the Higher Secondary Examination \r\n(Academic / Vocational) conducted by the Government of Tamil Nadu \r\nor any other examination accepted as equivalent thereto by the \r\nUniversity of Madras are eligible for admission to the Certificate Programme.', 'Certificate', 'Accounting and Auditing', 'CAA'),
(2, 'Certificate in Computer Applications', '1 Year', 'English', 'Candidates who have passed the Higher Secondary Examination \r\n(Academic / Vocational) conducted by the Government of Tamil Nadu \r\nor any other examination accepted as equivalent thereto by the \r\nUniversity of Madras are eligible for admission to the Certificate Programme.', 'Certificate', 'Computer Applications', 'CCA'),
(3, 'Certificate in Corporate Social Responsibility', '6 Months', 'English', 'Candidates who have passed the Higher Secondary Examination \r\n(Academic / Vocational) conducted by the Government of Tamil Nadu \r\nor any other examination accepted as equivalent thereto by the \r\nUniversity of Madras are eligible for admission to the Certificate Programme.', 'Certificate', 'Corporate Social Responsibility', 'CCS'),
(4, 'Certificate in E-Commerce', '1 Year', 'English', 'Candidates who have passed the Higher Secondary Examination \r\n(Academic / Vocational) conducted by the Government of Tamil Nadu \r\nor any other examination accepted as equivalent thereto by the \r\nUniversity of Madras are eligible for admission to the Certificate Programme.', 'Certificate', 'E-Commerce', 'CEC'),
(5, 'Certificate in Indian Christianity', '6 Months', 'English', 'Candidates who have passed the Higher Secondary Examination \r\n(Academic / Vocational) conducted by the Government of Tamil Nadu \r\nor any other examination accepted as equivalent thereto by the \r\nUniversity of Madras are eligible for admission to the Certificate Programme.', 'Certificate', 'Indian Christianity', 'CIC'),
(6, 'Certificate in Karnatic Music', '6 Months', 'English & Tamil', 'Candidates who have passed the Higher Secondary Examination \r\n(Academic / Vocational) conducted by the Government of Tamil Nadu \r\nor any other examination accepted as equivalent thereto by the \r\nUniversity of Madras are eligible for admission to the Certificate Programme.', 'Certificate', 'Karnatic Music', 'CKM'),
(7, 'Certificate in Library and Information Sciences', '6 Months', 'English & Tamil', 'Candidates who have passed the Higher Secondary Examination \r\n(Academic / Vocational) conducted by the Government of Tamil Nadu \r\nor any other examination accepted as equivalent thereto by the \r\nUniversity of Madras are eligible for admission to the Certificate Programme.', 'Certificate', 'Library and Information Sciences', 'CLS'),
(8, 'Certificate in Management', '6 Months', 'English', 'Candidates who have passed the Higher Secondary Examination \r\n(Academic / Vocational) conducted by the Government of Tamil Nadu \r\nor any other examination accepted as equivalent thereto by the \r\nUniversity of Madras are eligible for admission to the Certificate Programme.', 'Certificate', 'Management', 'CMT'),
(9, 'Certificate in Police Administration', '6 Months', 'English & Tamil', 'Candidates who have passed the Higher Secondary Examination \r\n(Academic / Vocational) conducted by the Government of Tamil Nadu \r\nor any other examination accepted as equivalent thereto by the \r\nUniversity of Madras are eligible for admission to the Certificate Programme.', 'Certificate', 'Police Administration', 'CPA'),
(10, 'Certificate in Research Methods of Social Sciences', '6 Months', 'English', 'Candidates who have passed the Higher Secondary Examination \r\n(Academic / Vocational) conducted by the Government of Tamil Nadu \r\nor any other examination accepted as equivalent thereto by the \r\nUniversity of Madras are eligible for admission to the Certificate Programme.', 'Certificate', 'Research Methods of Social Sciences', 'CRM'),
(11, 'Certificate in Christian Scriptures and Interpretation', '6 Months', 'English', 'Candidates who have passed the Higher Secondary Examination \r\n(Academic / Vocational) conducted by the Government of Tamil Nadu \r\nor any other examination accepted as equivalent thereto by the \r\nUniversity of Madras are eligible for admission to the Certificate Programme.', 'Certificate', 'Christian Scriptures and Interpretation', 'CSI'),
(12, 'Certificate in Voice Training', '6 Months', 'English', 'Candidates who have passed the Higher Secondary Examination \r\n(Academic / Vocational) conducted by the Government of Tamil Nadu \r\nor any other examination accepted as equivalent thereto by the \r\nUniversity of Madras are eligible for admission to the Certificate Programme.', 'Certificate', 'Voice Training', 'CVT'),
(13, 'Certificate in Spoken Tamil', '6 Months', 'Tamil', 'Candidates who have passed the Higher Secondary Examination \r\n(Academic / Vocational) conducted by the Government of Tamil Nadu \r\nor any other examination accepted as equivalent thereto by the \r\nUniversity of Madras are eligible for admission to the Certificate Programme.', 'Certificate', 'Spoken Tamil', 'CST'),
(14, 'Certificate in Taxation', '6 Months', 'English', 'Candidates who have passed the Higher Secondary Examination \r\n(Academic / Vocational) conducted by the Government of Tamil Nadu \r\nor any other examination accepted as equivalent thereto by the \r\nUniversity of Madras are eligible for admission to the Certificate Programme.', 'Certificate', 'Taxation', 'CTX'),
(15, 'Certificate in Written Tamil', '6 Months', 'Tamil', 'Candidates who have passed the Higher Secondary Examination \r\n(Academic / Vocational) conducted by the Government of Tamil Nadu \r\nor any other examination accepted as equivalent thereto by the \r\nUniversity of Madras are eligible for admission to the Certificate Programme.', 'Certificate', 'Written Tamil', 'CWT'),
(16, 'Certificate in Online Teaching', '6 Months', 'English', 'Candidates who have passed the Higher Secondary Examination \r\n(Academic / Vocational) conducted by the Government of Tamil Nadu \r\nor any other examination accepted as equivalent thereto by the \r\nUniversity of Madras are eligible for admission to the Certificate Programme.', 'Certificate', 'Online Teaching', 'COT');

-- --------------------------------------------------------

--
-- Table structure for table `diploma_courses`
--

CREATE TABLE `diploma_courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `medium` varchar(50) DEFAULT NULL,
  `eligibility` text DEFAULT NULL,
  `programme_degree` varchar(50) DEFAULT NULL,
  `main_subject` varchar(100) DEFAULT NULL,
  `course_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diploma_courses`
--

INSERT INTO `diploma_courses` (`id`, `course_name`, `duration`, `medium`, `eligibility`, `programme_degree`, `main_subject`, `course_code`) VALUES
(1, 'Diploma in Accounting and Finance', '1 Year', 'English', 'Candidates who have qualified for a Degree of this University \r\nor any other University recognized by UGC/AIU and accepted as \r\nequivalent thereto by the University of Madras under the \r\n10+2+3 pattern (or) 10+3+2 (or) 11+1+3 (or) 11+2+2 pattern \r\nare eligible for admission to the Diploma Programme.', 'Diploma', 'Accounting and Finance', 'DAF'),
(2, 'Diploma in Financial Management', '1 Year', 'English', 'Candidates who have qualified for a Degree of this University \r\nor any other University recognized by UGC/AIU and accepted as \r\nequivalent thereto by the University of Madras under the \r\n10+2+3 pattern (or) 10+3+2 (or) 11+1+3 (or) 11+2+2 pattern \r\nare eligible for admission to the Diploma Programme.', 'Diploma', 'Financial Management', 'DFM'),
(3, 'Diploma in Functional Arabic', '1 Year', 'English', 'Candidates who have qualified for a Degree of this University \r\nor any other University recognized by UGC/AIU and accepted as \r\nequivalent thereto by the University of Madras under the \r\n10+2+3 pattern (or) 10+3+2 (or) 11+1+3 (or) 11+2+2 pattern \r\nare eligible for admission to the Diploma Programme.', 'Diploma', 'Functional Arabic', 'DFA'),
(4, 'Diploma in Hospital Management', '1 Year', 'English', 'Candidates who have qualified for a Degree of this University \r\nor any other University recognized by UGC/AIU and accepted as \r\nequivalent thereto by the University of Madras under the \r\n10+2+3 pattern (or) 10+3+2 (or) 11+1+3 (or) 11+2+2 pattern \r\nare eligible for admission to the Diploma Programme.', 'Diploma', 'Hospital Management', 'DHM'),
(5, 'Diploma in Human Resource Management', '1 Year', 'English', 'Candidates who have qualified for a Degree of this University \r\nor any other University recognized by UGC/AIU and accepted as \r\nequivalent thereto by the University of Madras under the \r\n10+2+3 pattern (or) 10+3+2 (or) 11+1+3 (or) 11+2+2 pattern \r\nare eligible for admission to the Diploma Programme.', 'Diploma', 'Human Resource Management', 'DHR'),
(6, 'Diploma in Information Security and Cyber Law', '1 Year', 'English', 'Candidates who have qualified for a Degree of this University \r\nor any other University recognized by UGC/AIU and accepted as \r\nequivalent thereto by the University of Madras under the \r\n10+2+3 pattern (or) 10+3+2 (or) 11+1+3 (or) 11+2+2 pattern \r\nare eligible for admission to the Diploma Programme.', 'Diploma', 'Information Security and Cyber Law', 'DIS'),
(7, 'Diploma in Intellectual Property Rights', '1 Year', 'English', 'Candidates who have qualified for a Degree of this University \r\nor any other University recognized by UGC/AIU and accepted as \r\nequivalent thereto by the University of Madras under the \r\n10+2+3 pattern (or) 10+3+2 (or) 11+1+3 (or) 11+2+2 pattern \r\nare eligible for admission to the Diploma Programme.', 'Diploma', 'Intellectual Property Rights', 'DIP'),
(8, 'Diploma in Labour Law', '1 Year', 'English', 'Candidates who have qualified for a Degree of this University \r\nor any other University recognized by UGC/AIU and accepted as \r\nequivalent thereto by the University of Madras under the \r\n10+2+3 pattern (or) 10+3+2 (or) 11+1+3 (or) 11+2+2 pattern \r\nare eligible for admission to the Diploma Programme.', 'Diploma', 'Labour Law', 'DLL'),
(9, 'Diploma in Logistics and Supply Chain Management', '1 Year', 'English', 'Candidates who have qualified for a Degree of this University \r\nor any other University recognized by UGC/AIU and accepted as \r\nequivalent thereto by the University of Madras under the \r\n10+2+3 pattern (or) 10+3+2 (or) 11+1+3 (or) 11+2+2 pattern \r\nare eligible for admission to the Diploma Programme.', 'Diploma', 'Logistics and Supply Chain Management', 'DLS'),
(10, 'Diploma in Management', '1 Year', 'English', 'Candidates who have qualified for a Degree of this University \r\nor any other University recognized by UGC/AIU and accepted as \r\nequivalent thereto by the University of Madras under the \r\n10+2+3 pattern (or) 10+3+2 (or) 11+1+3 (or) 11+2+2 pattern \r\nare eligible for admission to the Diploma Programme.', 'Diploma', 'Management', 'DMG'),
(11, 'Diploma in Marketing Management', '1 Year', 'English', 'Candidates who have qualified for a Degree of this University \r\nor any other University recognized by UGC/AIU and accepted as \r\nequivalent thereto by the University of Madras under the \r\n10+2+3 pattern (or) 10+3+2 (or) 11+1+3 (or) 11+2+2 pattern \r\nare eligible for admission to the Diploma Programme.', 'Diploma', 'Marketing Management', 'DMM'),
(12, 'Diploma in Naturopathy and Yogic Sciences', '1 Year', 'English', 'Candidates who have qualified for a Degree of this University \r\nor any other University recognized by UGC/AIU and accepted as \r\nequivalent thereto by the University of Madras under the \r\n10+2+3 pattern (or) 10+3+2 (or) 11+1+3 (or) 11+2+2 pattern \r\nare eligible for admission to the Diploma Programme.', 'Diploma', 'Naturopathy and Yogic Sciences', 'DNY'),
(13, 'Diploma in Police Administration', '1 Year', 'English & Tamil', 'Candidates who have qualified for a Degree of this University \r\nor any other University recognized by UGC/AIU and accepted as \r\nequivalent thereto by the University of Madras under the \r\n10+2+3 pattern (or) 10+3+2 (or) 11+1+3 (or) 11+2+2 pattern \r\nare eligible for admission to the Diploma Programme.', 'Diploma', 'Police Administration', 'DPA'),
(14, 'Diploma in School Management', '1 Year', 'English', 'Candidates who have qualified for a Degree of this University \r\nor any other University recognized by UGC/AIU and accepted as \r\nequivalent thereto by the University of Madras under the \r\n10+2+3 pattern (or) 10+3+2 (or) 11+1+3 (or) 11+2+2 pattern \r\nare eligible for admission to the Diploma Programme.', 'Diploma', 'School Management', 'DSM'),
(15, 'Diploma in Systems Management', '1 Year', 'English', 'Candidates who have qualified for a Degree of this University \r\nor any other University recognized by UGC/AIU and accepted as \r\nequivalent thereto by the University of Madras under the \r\n10+2+3 pattern (or) 10+3+2 (or) 11+1+3 (or) 11+2+2 pattern \r\nare eligible for admission to the Diploma Programme.', 'Diploma', 'Systems Management', 'DYM'),
(16, 'Diploma in Taxation Finance and Investment', '1 Year', 'English', 'Candidates who have qualified for a Degree of this University \r\nor any other University recognized by UGC/AIU and accepted as \r\nequivalent thereto by the University of Madras under the \r\n10+2+3 pattern (or) 10+3+2 (or) 11+1+3 (or) 11+2+2 pattern \r\nare eligible for admission to the Diploma Programme.', 'Diploma', 'Taxation Finance and Investment', 'DTX'),
(17, 'Diploma in Teaching Methodology in Music', '1 Year', '', 'Any Degree from a recognized University', 'Diploma', 'Teaching Methodology in Music', 'DTM'),
(18, 'Diploma in Yoga', '1 Year', 'English', 'Any Degree from a recognized University', 'Diploma', 'Yoga', 'DYG'),
(19, 'Diploma in Tourism and Travel Management', '1 Year', 'English', 'Any Degree from a recognized University', 'Diploma', 'Tourism and Travel Management', 'DTT');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `district_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `state_id`, `district_name`) VALUES
(1, 23, 'Ariyalur'),
(2, 23, 'Chengalpattu'),
(3, 23, 'Chennai'),
(4, 23, 'Coimbatore'),
(5, 23, 'Cuddalore'),
(6, 23, 'Dharmapuri'),
(7, 23, 'Dindigul'),
(8, 23, 'Erode'),
(9, 23, 'Kallakurichi'),
(10, 23, 'Kanchipuram'),
(11, 23, 'Kanniyakumari'),
(12, 23, 'Karur'),
(13, 23, 'Krishnagiri'),
(14, 23, 'Madurai'),
(15, 23, 'Mayiladuthurai'),
(16, 23, 'Nagapattinam'),
(17, 23, 'Namakkal'),
(18, 23, 'Nilgiris'),
(19, 23, 'Perambalur'),
(20, 23, 'Pudukkottai'),
(21, 23, 'Ramanathapuram'),
(22, 23, 'Ranipet'),
(23, 23, 'Salem'),
(24, 23, 'Sivaganga'),
(25, 23, 'Tenkasi'),
(26, 23, 'Thanjavur'),
(27, 23, 'Theni'),
(28, 23, 'Thiruvallur'),
(29, 23, 'Thiruvarur'),
(30, 23, 'Thoothukudi'),
(31, 23, 'Tiruchirappalli'),
(32, 23, 'Tirunelveli'),
(33, 23, 'Tirupattur'),
(34, 23, 'Tiruppur'),
(35, 23, 'Tiruvannamalai'),
(36, 23, 'Vellore'),
(37, 23, 'Viluppuram'),
(38, 23, 'Virudhunagar'),
(39, 12, 'Alappuzha'),
(40, 12, 'Ernakulam'),
(41, 12, 'Idukki'),
(42, 12, 'Kannur'),
(43, 12, 'Kasaragod'),
(44, 12, 'Kollam'),
(45, 12, 'Kottayam'),
(46, 12, 'Kozhikode'),
(47, 12, 'Malappuram'),
(48, 12, 'Palakkad'),
(49, 12, 'Pathanamthitta'),
(50, 12, 'Thiruvananthapuram'),
(51, 12, 'Thrissur'),
(52, 12, 'Wayanad'),
(53, 11, 'Bagalkot'),
(54, 11, 'Ballari'),
(55, 11, 'Belagavi'),
(56, 11, 'Bengaluru Rural'),
(57, 11, 'Bengaluru Urban'),
(58, 11, 'Bidar'),
(59, 11, 'Chamarajanagar'),
(60, 11, 'Chikballapur'),
(61, 11, 'Chikkamagaluru'),
(62, 11, 'Chitradurga'),
(63, 11, 'Dakshina Kannada'),
(64, 11, 'Davanagere'),
(65, 11, 'Dharwad'),
(66, 11, 'Gadag'),
(67, 11, 'Hassan'),
(68, 11, 'Haveri'),
(69, 11, 'Kalaburagi'),
(70, 11, 'Kodagu'),
(71, 11, 'Kolar'),
(72, 11, 'Koppal'),
(73, 11, 'Mandya'),
(74, 11, 'Mysuru'),
(75, 11, 'Raichur'),
(76, 11, 'Ramanagara'),
(77, 11, 'Shivamogga'),
(78, 11, 'Tumakuru'),
(79, 11, 'Udupi'),
(80, 11, 'Uttara Kannada'),
(81, 11, 'Vijayapura'),
(82, 11, 'Yadgir'),
(83, 11, 'Vijayanagara'),
(84, 14, 'Ahmednagar'),
(85, 14, 'Akola'),
(86, 14, 'Amravati'),
(87, 14, 'Aurangabad'),
(88, 14, 'Beed'),
(89, 14, 'Bhandara'),
(90, 14, 'Buldhana'),
(91, 14, 'Chandrapur'),
(92, 14, 'Dhule'),
(93, 14, 'Gadchiroli'),
(94, 14, 'Gondia'),
(95, 14, 'Hingoli'),
(96, 14, 'Jalgaon'),
(97, 14, 'Jalna'),
(98, 14, 'Kolhapur'),
(99, 14, 'Latur'),
(100, 14, 'Mumbai City'),
(101, 14, 'Mumbai Suburban'),
(102, 14, 'Nagpur'),
(103, 14, 'Nanded'),
(104, 14, 'Nandurbar'),
(105, 14, 'Nashik'),
(106, 14, 'Osmanabad'),
(107, 14, 'Palghar'),
(108, 14, 'Parbhani'),
(109, 14, 'Pune'),
(110, 14, 'Raigad'),
(111, 14, 'Ratnagiri'),
(112, 14, 'Sangli'),
(113, 14, 'Satara'),
(114, 14, 'Sindhudurg'),
(115, 14, 'Solapur'),
(116, 14, 'Thane'),
(117, 14, 'Wardha'),
(118, 14, 'Washim'),
(119, 14, 'Yavatmal'),
(120, 15, 'Bishnupur'),
(121, 15, 'Chandel'),
(122, 15, 'Churachandpur'),
(123, 15, 'Imphal East'),
(124, 15, 'Imphal West'),
(125, 15, 'Jiribam'),
(126, 15, 'Kakching'),
(127, 15, 'Kamjong'),
(128, 15, 'Kangpokpi'),
(129, 15, 'Noney'),
(130, 15, 'Pherzawl'),
(131, 15, 'Senapati'),
(132, 15, 'Tamenglong'),
(133, 15, 'Tengnoupal'),
(134, 15, 'Thoubal'),
(135, 15, 'Ukhrul'),
(136, 17, 'Aizawl'),
(137, 17, 'Champhai'),
(138, 17, 'Hnahthial'),
(139, 17, 'Khawzawl'),
(140, 17, 'Kolasib'),
(141, 17, 'Lawngtlai'),
(142, 17, 'Lunglei'),
(143, 17, 'Mamit'),
(144, 17, 'Saiha'),
(145, 17, 'Saitual'),
(146, 17, 'Serchhip'),
(147, 16, 'East Garo Hills'),
(148, 16, 'East Jaintia Hills'),
(149, 16, 'East Khasi Hills'),
(150, 16, 'North Garo Hills'),
(151, 16, 'Ri-Bhoi'),
(152, 16, 'South Garo Hills'),
(153, 16, 'South West Garo Hills'),
(154, 16, 'South West Khasi Hills'),
(155, 16, 'West Garo Hills'),
(156, 16, 'West Jaintia Hills'),
(157, 16, 'West Khasi Hills'),
(158, 17, 'Aizawl'),
(159, 17, 'Champhai'),
(160, 17, 'Hnahthial'),
(161, 17, 'Khawzawl'),
(162, 17, 'Kolasib'),
(163, 17, 'Lawngtlai'),
(164, 17, 'Lunglei'),
(165, 17, 'Mamit'),
(166, 17, 'Saiha'),
(167, 17, 'Saitual'),
(168, 17, 'Serchhip'),
(169, 18, 'Chumoukedima'),
(170, 18, 'Dimapur'),
(171, 18, 'Kiphire'),
(172, 18, 'Kohima'),
(173, 18, 'Longleng'),
(174, 18, 'Mokokchung'),
(175, 18, 'Mon'),
(176, 18, 'Niuland'),
(177, 18, 'Noklak'),
(178, 18, 'Peren'),
(179, 18, 'Phek'),
(180, 18, 'Shamator'),
(181, 18, 'Tseminyu'),
(182, 18, 'Tuensang'),
(183, 18, 'Wokha'),
(184, 18, 'Zunheboto'),
(185, 19, 'Angul'),
(186, 19, 'Balangir'),
(187, 19, 'Balasore'),
(188, 19, 'Bargarh'),
(189, 19, 'Bhadrak'),
(190, 19, 'Boudh'),
(191, 19, 'Cuttack'),
(192, 19, 'Deogarh'),
(193, 19, 'Dhenkanal'),
(194, 19, 'Gajapati'),
(195, 19, 'Ganjam'),
(196, 19, 'Jagatsinghpur'),
(197, 19, 'Jajpur'),
(198, 19, 'Jharsuguda'),
(199, 19, 'Kalahandi'),
(200, 19, 'Kandhamal'),
(201, 19, 'Kendrapara'),
(202, 19, 'Kendujhar'),
(203, 19, 'Khordha'),
(204, 19, 'Koraput'),
(205, 19, 'Malkangiri'),
(206, 19, 'Mayurbhanj'),
(207, 19, 'Nabarangpur'),
(208, 19, 'Nayagarh'),
(209, 19, 'Nuapada'),
(210, 19, 'Puri'),
(211, 19, 'Rayagada'),
(212, 19, 'Sambalpur'),
(213, 19, 'Subarnapur'),
(214, 19, 'Sundargarh'),
(215, 20, 'Amritsar'),
(216, 20, 'Barnala'),
(217, 20, 'Bathinda'),
(218, 20, 'Faridkot'),
(219, 20, 'Fatehgarh Sahib'),
(220, 20, 'Fazilka'),
(221, 20, 'Ferozepur'),
(222, 20, 'Gurdaspur'),
(223, 20, 'Hoshiarpur'),
(224, 20, 'Jalandhar'),
(225, 20, 'Kapurthala'),
(226, 20, 'Ludhiana'),
(227, 20, 'Malerkotla'),
(228, 20, 'Mansa'),
(229, 20, 'Moga'),
(230, 20, 'Mohali'),
(231, 20, 'Muktsar'),
(232, 20, 'Pathankot'),
(233, 20, 'Patiala'),
(234, 20, 'Rupnagar'),
(235, 20, 'Sangrur'),
(236, 20, 'Shaheed Bhagat Singh Nagar'),
(237, 20, 'Tarn Taran'),
(238, 21, 'Ajmer'),
(239, 21, 'Alwar'),
(240, 21, 'Banswara'),
(241, 21, 'Baran'),
(242, 21, 'Barmer'),
(243, 21, 'Bharatpur'),
(244, 21, 'Bhilwara'),
(245, 21, 'Bikaner'),
(246, 21, 'Bundi'),
(247, 21, 'Chittorgarh'),
(248, 21, 'Churu'),
(249, 21, 'Dausa'),
(250, 21, 'Dholpur'),
(251, 21, 'Dungarpur'),
(252, 21, 'Hanumangarh'),
(253, 21, 'Jaipur'),
(254, 21, 'Jaisalmer'),
(255, 21, 'Jalore'),
(256, 21, 'Jhalawar'),
(257, 21, 'Jhunjhunu'),
(258, 21, 'Jodhpur'),
(259, 21, 'Karauli'),
(260, 21, 'Kota'),
(261, 21, 'Nagaur'),
(262, 21, 'Pali'),
(263, 21, 'Pratapgarh'),
(264, 21, 'Rajsamand'),
(265, 21, 'Sawai Madhopur'),
(266, 21, 'Sikar'),
(267, 21, 'Sirohi'),
(268, 21, 'Sri Ganganagar'),
(269, 21, 'Tonk'),
(270, 21, 'Udaipur'),
(271, 22, 'East Sikkim'),
(272, 22, 'North Sikkim'),
(273, 22, 'South Sikkim'),
(274, 22, 'West Sikkim'),
(275, 24, 'Adilabad'),
(276, 24, 'Bhadradri Kothagudem'),
(277, 24, 'Hyderabad'),
(278, 24, 'Jagtial'),
(279, 24, 'Jangaon'),
(280, 24, 'Jayashankar Bhupalpally'),
(281, 24, 'Jogulamba Gadwal'),
(282, 24, 'Kamareddy'),
(283, 24, 'Karimnagar'),
(284, 24, 'Khammam'),
(285, 24, 'Komaram Bheem'),
(286, 24, 'Mahabubabad'),
(287, 24, 'Mahabubnagar'),
(288, 24, 'Mancherial'),
(289, 24, 'Medak'),
(290, 24, 'Medchal-Malkajgiri'),
(291, 24, 'Mulugu'),
(292, 24, 'Nagarkurnool'),
(293, 24, 'Nalgonda'),
(294, 24, 'Narayanpet'),
(295, 24, 'Nirmal'),
(296, 24, 'Nizamabad'),
(297, 24, 'Peddapalli'),
(298, 24, 'Rajanna Sircilla'),
(299, 24, 'Rangareddy'),
(300, 24, 'Sangareddy'),
(301, 24, 'Siddipet'),
(302, 24, 'Suryapet'),
(303, 24, 'Vikarabad'),
(304, 24, 'Wanaparthy'),
(305, 24, 'Warangal'),
(306, 24, 'Hanumakonda'),
(307, 24, 'Yadadri Bhuvanagiri'),
(308, 25, 'Dhalai'),
(309, 25, 'Gomati'),
(310, 25, 'Khowai'),
(311, 25, 'North Tripura'),
(312, 25, 'Sepahijala'),
(313, 25, 'South Tripura'),
(314, 25, 'Unakoti'),
(315, 25, 'West Tripura'),
(316, 26, 'Agra'),
(317, 26, 'Aligarh'),
(318, 26, 'Ambedkar Nagar'),
(319, 26, 'Amethi'),
(320, 26, 'Amroha'),
(321, 26, 'Auraiya'),
(322, 26, 'Ayodhya'),
(323, 26, 'Azamgarh'),
(324, 26, 'Baghpat'),
(325, 26, 'Bahraich'),
(326, 26, 'Ballia'),
(327, 26, 'Balrampur'),
(328, 26, 'Banda'),
(329, 26, 'Barabanki'),
(330, 26, 'Bareilly'),
(331, 26, 'Basti'),
(332, 26, 'Bhadohi'),
(333, 26, 'Bijnor'),
(334, 26, 'Budaun'),
(335, 26, 'Bulandshahr'),
(336, 26, 'Chandauli'),
(337, 26, 'Chitrakoot'),
(338, 26, 'Deoria'),
(339, 26, 'Etah'),
(340, 26, 'Etawah'),
(341, 26, 'Farrukhabad'),
(342, 26, 'Fatehpur'),
(343, 26, 'Firozabad'),
(344, 26, 'Gautam Buddha Nagar'),
(345, 26, 'Ghaziabad'),
(346, 26, 'Ghazipur'),
(347, 26, 'Gonda'),
(348, 26, 'Gorakhpur'),
(349, 26, 'Hamirpur'),
(350, 26, 'Hapur'),
(351, 26, 'Hardoi'),
(352, 26, 'Hathras'),
(353, 26, 'Jalaun'),
(354, 26, 'Jaunpur'),
(355, 26, 'Jhansi'),
(356, 26, 'Kannauj'),
(357, 26, 'Kanpur Dehat'),
(358, 26, 'Kanpur Nagar'),
(359, 26, 'Kasganj'),
(360, 26, 'Kaushambi'),
(361, 26, 'Kheri'),
(362, 26, 'Kushinagar'),
(363, 26, 'Lalitpur'),
(364, 26, 'Lucknow'),
(365, 26, 'Maharajganj'),
(366, 26, 'Mahoba'),
(367, 26, 'Mainpuri'),
(368, 26, 'Mathura'),
(369, 26, 'Mau'),
(370, 26, 'Meerut'),
(371, 26, 'Mirzapur'),
(372, 26, 'Moradabad'),
(373, 26, 'Muzaffarnagar'),
(374, 26, 'Pilibhit'),
(375, 26, 'Pratapgarh'),
(376, 26, 'Prayagraj'),
(377, 26, 'Raebareli'),
(378, 26, 'Rampur'),
(379, 26, 'Saharanpur'),
(380, 26, 'Sambhal'),
(381, 26, 'Sant Kabir Nagar'),
(382, 26, 'Shahjahanpur'),
(383, 26, 'Shamli'),
(384, 26, 'Shravasti'),
(385, 26, 'Siddharthnagar'),
(386, 26, 'Sitapur'),
(387, 26, 'Sonbhadra'),
(388, 26, 'Sultanpur'),
(389, 26, 'Unnao'),
(390, 26, 'Varanasi'),
(391, 27, 'Almora'),
(392, 27, 'Bageshwar'),
(393, 27, 'Chamoli'),
(394, 27, 'Champawat'),
(395, 27, 'Dehradun'),
(396, 27, 'Haridwar'),
(397, 27, 'Nainital'),
(398, 27, 'Pauri Garhwal'),
(399, 27, 'Pithoragarh'),
(400, 27, 'Rudraprayag'),
(401, 27, 'Tehri Garhwal'),
(402, 27, 'Udham Singh Nagar'),
(403, 27, 'Uttarkashi'),
(404, 28, 'Alipurduar'),
(405, 28, 'Bankura'),
(406, 28, 'Birbhum'),
(407, 28, 'Cooch Behar'),
(408, 28, 'Dakshin Dinajpur'),
(409, 28, 'Darjeeling'),
(410, 28, 'Hooghly'),
(411, 28, 'Howrah'),
(412, 28, 'Jalpaiguri'),
(413, 28, 'Jhargram'),
(414, 28, 'Kalimpong'),
(415, 28, 'Kolkata'),
(416, 28, 'Malda'),
(417, 28, 'Murshidabad'),
(418, 28, 'Nadia'),
(419, 28, 'North 24 Parganas'),
(420, 28, 'Paschim Bardhaman'),
(421, 28, 'Paschim Medinipur'),
(422, 28, 'Purba Bardhaman'),
(423, 28, 'Purba Medinipur'),
(424, 28, 'Purulia'),
(425, 28, 'South 24 Parganas'),
(426, 28, 'Uttar Dinajpur'),
(427, 1, 'Alluri Sitharama Raju'),
(428, 1, 'Anakapalli'),
(429, 1, 'Anantapuramu'),
(430, 1, 'Annamayya'),
(431, 1, 'Bapatla'),
(432, 1, 'Chittoor'),
(433, 1, 'Dr. B.R. Ambedkar Konaseema'),
(434, 1, 'East Godavari'),
(435, 1, 'Eluru'),
(436, 1, 'Guntur'),
(437, 1, 'Kakinada'),
(438, 1, 'Krishna'),
(439, 1, 'Kurnool'),
(440, 1, 'Nandyal'),
(441, 1, 'NTR'),
(442, 1, 'Palnadu'),
(443, 1, 'Parvathipuram Manyam'),
(444, 1, 'Prakasam'),
(445, 1, 'Sri Potti Sriramulu Nellore'),
(446, 1, 'Sri Sathya Sai'),
(447, 1, 'Srikakulam'),
(448, 1, 'Tirupati'),
(449, 1, 'Visakhapatnam'),
(450, 1, 'Vizianagaram'),
(451, 1, 'West Godavari'),
(452, 1, 'YSR Kadapa'),
(453, 2, 'Tawang'),
(454, 2, 'West Kameng'),
(455, 2, 'East Kameng'),
(456, 2, 'Papum Pare'),
(457, 2, 'Kurung Kumey'),
(458, 2, 'Kra Daadi'),
(459, 2, 'Lower Subansiri'),
(460, 2, 'Upper Subansiri'),
(461, 2, 'West Siang'),
(462, 2, 'East Siang'),
(463, 2, 'Siang'),
(464, 2, 'Upper Siang'),
(465, 2, 'Lower Siang'),
(466, 2, 'Lower Dibang Valley'),
(467, 2, 'Dibang Valley'),
(468, 2, 'Anjaw'),
(469, 2, 'Lohit'),
(470, 2, 'Namsai'),
(471, 2, 'Changlang'),
(472, 2, 'Tirap'),
(473, 2, 'Longding'),
(474, 3, 'Baksa'),
(475, 3, 'Barpeta'),
(476, 3, 'Biswanath'),
(477, 3, 'Bongaigaon'),
(478, 3, 'Cachar'),
(479, 3, 'Charaideo'),
(480, 3, 'Chirang'),
(481, 3, 'Darrang'),
(482, 3, 'Dhemaji'),
(483, 3, 'Dhubri'),
(484, 3, 'Dibrugarh'),
(485, 3, 'Goalpara'),
(486, 3, 'Golaghat'),
(487, 3, 'Hailakandi'),
(488, 3, 'Hojai'),
(489, 3, 'Jorhat'),
(490, 3, 'Kamrup'),
(491, 3, 'Kamrup Metropolitan'),
(492, 3, 'Karbi Anglong'),
(493, 3, 'Karimganj'),
(494, 3, 'Kokrajhar'),
(495, 3, 'Lakhimpur'),
(496, 3, 'Majuli'),
(497, 3, 'Morigaon'),
(498, 3, 'Nagaon'),
(499, 3, 'Nalbari'),
(500, 3, 'Sivasagar'),
(501, 3, 'Sonitpur'),
(502, 3, 'South Salmara-Mankachar'),
(503, 3, 'Tinsukia'),
(504, 3, 'Udalguri'),
(505, 3, 'West Karbi Anglong'),
(506, 4, 'Araria'),
(507, 4, 'Arwal'),
(508, 4, 'Aurangabad'),
(509, 4, 'Banka'),
(510, 4, 'Begusarai'),
(511, 4, 'Bhagalpur'),
(512, 4, 'Bhojpur'),
(513, 4, 'Buxar'),
(514, 4, 'Darbhanga'),
(515, 4, 'East Champaran'),
(516, 4, 'Gaya'),
(517, 4, 'Gopalganj'),
(518, 4, 'Jamui'),
(519, 4, 'Jehanabad'),
(520, 4, 'Kaimur'),
(521, 4, 'Katihar'),
(522, 4, 'Khagaria'),
(523, 4, 'Kishanganj'),
(524, 4, 'Lakhisarai'),
(525, 4, 'Madhepura'),
(526, 4, 'Madhubani'),
(527, 4, 'Munger'),
(528, 4, 'Muzaffarpur'),
(529, 4, 'Nalanda'),
(530, 4, 'Nawada'),
(531, 4, 'Patna'),
(532, 4, 'Purnia'),
(533, 4, 'Rohtas'),
(534, 4, 'Saharsa'),
(535, 4, 'Samastipur'),
(536, 4, 'Saran'),
(537, 4, 'Sheikhpura'),
(538, 4, 'Sheohar'),
(539, 4, 'Sitamarhi'),
(540, 4, 'Siwan'),
(541, 4, 'Supaul'),
(542, 4, 'Vaishali'),
(543, 4, 'West Champaran'),
(544, 5, 'Balod'),
(545, 5, 'Baloda Bazar'),
(546, 5, 'Balrampur'),
(547, 5, 'Bastar'),
(548, 5, 'Bemetara'),
(549, 5, 'Bijapur'),
(550, 5, 'Bilaspur'),
(551, 5, 'Dantewada'),
(552, 5, 'Dhamtari'),
(553, 5, 'Durg'),
(554, 5, 'Gariaband'),
(555, 5, 'Gaurela-Pendra-Marwahi'),
(556, 5, 'Janjgir-Champa'),
(557, 5, 'Jashpur'),
(558, 5, 'Kabirdham'),
(559, 5, 'Kanker'),
(560, 5, 'Kondagaon'),
(561, 5, 'Korba'),
(562, 5, 'Korea'),
(563, 5, 'Mahasamund'),
(564, 5, 'Mungeli'),
(565, 5, 'Narayanpur'),
(566, 5, 'Raigarh'),
(567, 5, 'Raipur'),
(568, 5, 'Rajnandgaon'),
(569, 5, 'Sukma'),
(570, 5, 'Surajpur'),
(571, 5, 'Surguja'),
(572, 6, 'North Goa'),
(573, 6, 'South Goa'),
(574, 7, 'Ahmedabad'),
(575, 7, 'Amreli'),
(576, 7, 'Anand'),
(577, 7, 'Aravalli'),
(578, 7, 'Banaskantha'),
(579, 7, 'Bharuch'),
(580, 7, 'Bhavnagar'),
(581, 7, 'Botad'),
(582, 7, 'Chhota Udepur'),
(583, 7, 'Dahod'),
(584, 7, 'Dang'),
(585, 7, 'Devbhoomi Dwarka'),
(586, 7, 'Gandhinagar'),
(587, 7, 'Gir Somnath'),
(588, 7, 'Jamnagar'),
(589, 7, 'Junagadh'),
(590, 7, 'Kheda'),
(591, 7, 'Kutch'),
(592, 7, 'Mahisagar'),
(593, 7, 'Mehsana'),
(594, 7, 'Morbi'),
(595, 7, 'Narmada'),
(596, 7, 'Navsari'),
(597, 7, 'Panchmahal'),
(598, 7, 'Patan'),
(599, 7, 'Porbandar'),
(600, 7, 'Rajkot'),
(601, 7, 'Sabarkantha'),
(602, 7, 'Surat'),
(603, 7, 'Surendranagar'),
(604, 7, 'Tapi'),
(605, 7, 'Vadodara'),
(606, 7, 'Valsad'),
(607, 8, 'Ambala'),
(608, 8, 'Bhiwani'),
(609, 8, 'Charkhi Dadri'),
(610, 8, 'Faridabad'),
(611, 8, 'Fatehabad'),
(612, 8, 'Gurugram'),
(613, 8, 'Hisar'),
(614, 8, 'Jhajjar'),
(615, 8, 'Jind'),
(616, 8, 'Kaithal'),
(617, 8, 'Karnal'),
(618, 8, 'Kurukshetra'),
(619, 8, 'Mahendragarh'),
(620, 8, 'Nuh'),
(621, 8, 'Palwal'),
(622, 8, 'Panchkula'),
(623, 8, 'Panipat'),
(624, 8, 'Rewari'),
(625, 8, 'Rohtak'),
(626, 8, 'Sirsa'),
(627, 8, 'Sonipat'),
(628, 8, 'Yamunanagar'),
(629, 9, 'Bilaspur'),
(630, 9, 'Chamba'),
(631, 9, 'Hamirpur'),
(632, 9, 'Kangra'),
(633, 9, 'Kinnaur'),
(634, 9, 'Kullu'),
(635, 9, 'Lahaul and Spiti'),
(636, 9, 'Mandi'),
(637, 9, 'Shimla'),
(638, 9, 'Sirmaur'),
(639, 9, 'Solan'),
(640, 9, 'Una'),
(641, 10, 'Bokaro'),
(642, 10, 'Chatra'),
(643, 10, 'Deoghar'),
(644, 10, 'Dhanbad'),
(645, 10, 'Dumka'),
(646, 10, 'East Singhbhum'),
(647, 10, 'Garhwa'),
(648, 10, 'Giridih'),
(649, 10, 'Godda'),
(650, 10, 'Gumla'),
(651, 10, 'Hazaribagh'),
(652, 10, 'Jamtara'),
(653, 10, 'Khunti'),
(654, 10, 'Koderma'),
(655, 10, 'Latehar'),
(656, 10, 'Lohardaga'),
(657, 10, 'Pakur'),
(658, 10, 'Palamu'),
(659, 10, 'Ramgarh'),
(660, 10, 'Ranchi'),
(661, 10, 'Sahibganj'),
(662, 10, 'Saraikela Kharsawan'),
(663, 10, 'Simdega'),
(664, 10, 'West Singhbhum');

-- --------------------------------------------------------

--
-- Table structure for table `document_uploads`
--

CREATE TABLE `document_uploads` (
  `student_id` int(11) NOT NULL,
  `sslc` varchar(255) DEFAULT NULL,
  `hsc` varchar(255) DEFAULT NULL,
  `ug` varchar(255) DEFAULT NULL,
  `tc` varchar(255) DEFAULT NULL,
  `migration` varchar(255) DEFAULT NULL,
  `undertaking` varchar(255) DEFAULT NULL,
  `abc_status` varchar(5) DEFAULT NULL,
  `abc_id` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_uploads`
--

INSERT INTO `document_uploads` (`student_id`, `sslc`, `hsc`, `ug`, `tc`, `migration`, `undertaking`, `abc_status`, `abc_id`) VALUES
(11, NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL),
(13, 'sslc-PG-2026-00001.pdf', 'hsc-PG-2026-00001.jpeg', NULL, NULL, NULL, NULL, 'No', NULL),
(16, NULL, NULL, NULL, NULL, NULL, NULL, 'No', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pg_courses`
--

CREATE TABLE `pg_courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `medium` varchar(50) DEFAULT NULL,
  `eligibility` text DEFAULT NULL,
  `programme_degree` varchar(50) DEFAULT NULL,
  `main_subject` varchar(100) DEFAULT NULL,
  `course_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pg_courses`
--

INSERT INTO `pg_courses` (`id`, `course_name`, `duration`, `medium`, `eligibility`, `programme_degree`, `main_subject`, `course_code`) VALUES
(1, 'M.A Tamil', '2 Years', 'Tamil', '\"B.A/B.Lit. Tamil OR Any UG Degree with Foundation Course Part-I Tamil (Paper I, II, III & IV)\"', 'M.A', 'Tamil', 'PTL'),
(2, 'M.A English', '2 Years', 'English', '\"B.A English OR Any UG Degree with Foundation Course Part-II English (Paper I, II, III & IV)\"', 'M.A', 'English', 'PEN'),
(3, 'M.A Economics', '2 Years', 'English & Tamil', '\"B.A Economics / B.Com / BBA / Corporate Secretaryship / B.Sc Mathematics / Statistics / Any UG Social Science Degree\')\"', 'M.A', 'Economics', 'PEC'),
(4, 'M.A Christian Studies', '2 Years', 'English', '\"Any recognized Undergraduate Degree from a UGC approved University\"', 'M.A', 'Christian Studies', 'PCS'),
(5, 'M.A Historical Studies', '2 Years', 'English & Tamil', '\"Any recognized Undergraduate Degree from a UGC approved University\"', 'M.A', 'Historical Studies', 'PHS'),
(6, 'M.A Sociology', '2 Years', 'English', '\"Any recognized Undergraduate Degree from a UGC approved University\"', 'M.A', 'Sociology', 'PSL'),
(7, 'M.A Political Science', '2 Years', 'English & Tamil', '\"Any recognized Undergraduate Degree from a UGC approved University\"', 'M.A', 'Political Science', 'PPS'),
(8, 'M.A Sanskrit', '2 Years', 'English', '\"Any recognized Undergraduate Degree from a UGC approved University\"', 'M.A', 'Sanskrit', 'PST'),
(9, 'M.A Applied Saiva Siddhantha', '2 Years', 'Tamil', '\"Any recognized Undergraduate Degree from a UGC approved University\"', 'M.A', 'Applied Saiva Siddhantha', 'PSS'),
(10, 'M.A Public Administration', '2 Years', 'English & Tamil', '\"Any recognized Undergraduate Degree from a UGC approved University\"', 'M.A', 'Public Administration', 'PPA'),
(11, 'M.A Journalism', '2 Years', 'English', '\"Any recognized Undergraduate Degree from a UGC approved University\"', 'M.A', 'Journalism', 'PJM'),
(12, 'M.Com', '2 Years', 'English & Tamil', '\"B.Com / BBA / B.A Economics / B.Sc Mathematics / BCA with required core subjects\')\"', 'M.Com', 'Commerce', 'PCM'),
(13, 'M.Sc Mathematics', '2 Years', 'English', '\"B.Sc Mathematics / Applied Science / Physics / Chemistry OR B.E/B.Tech with Mathematics\')\"\r\n', 'M.Sc', 'Mathematics', 'PMA'),
(14, 'M.Sc Psychology', '2 Years', 'English', '\"Any recognized Undergraduate Degree\"', 'M.Sc', 'Psychology', 'PPY'),
(15, 'M.Sc Counselling Psychology', '2 Years', 'English', '\"B.A/B.Sc Psychology OR Any UG with three major papers in Psychology\')\"', 'M.Sc', 'Counselling Psychology', 'PPC'),
(16, 'M.Sc Cyber Forensics and Information Security', '2 Years', 'English', '\"Bachelor Degree in IT / CS / BCA / Networking / Data Science / AI / Criminology OR B.E/B.Tech in CSE/IT/EEE/ECE with 50% CS related subjects OR 3 Years Professional Experience in IT/Police/Defence\')\"\r\n', 'M.Sc', 'Cyber Forensics and Information Security', 'PCI'),
(17, 'M.Sc Geography', '2 Years', '', '\'B.A / B.Sc Geography OR Any Graduate under 10+2+3 Pattern\'),', 'M.Sc', 'Geography', 'PGE'),
(18, 'M.Sc Information Technology', '2 Years', 'English', '\'Any Bachelor Degree with Mathematics / Statistics / Business Mathematics / Mathematical Physics\');', 'M.Sc', 'Information Technology', 'PIT'),
(19, 'M.F.A Music', '2 Years', 'English & Tamil', 'A candidate who has passed:\r\n\r\n1) B.A (Indian Music) OR Bachelor of Music (B.Music) Degree\r\n   from this University or any other University recognized\r\n   as equivalent thereto\r\n\r\nOR\r\n\r\n2) Any Bachelor’s Degree of this University or any other \r\n   recognized University + ANY ONE of the following:\r\n\r\n• Minimum 50% marks in Certificate Course in Karnatic Music\r\n  offered by the Department of Indian Music\r\n\r\n• Diploma / Sangita Siromani Examination of Madras University\r\n\r\n• Ezisai-Mani Title Examination of Bharathidasan University\r\n\r\n• Sangitavisarada Examination of S.V University, Tirupati\r\n\r\n• Sangita-Siromani Examination in Karnataka Music of Delhi University\r\n\r\n• Sangita-Vidwan / Isaikkalaimani Title of Tamil Nadu Government\r\n\r\n• Higher Grade Examination of Government Examination, Chennai\r\n\r\n• Ganabhooshanam of Kerala Government\r\n\r\n• Diploma Examination of Andhra Pradesh Government\r\n\r\n• Senior Examination of Karnataka Government\r\n\r\n• Vocalist or Performer (Classical Music) placed under\r\n  “B” Grade or above in All India Radio\r\n\r\n• Passed all papers of the Main Subject in:\r\n    - Third Year B.A (Indian Music)\r\n      OR\r\n    - B.Music Degree (5th & 6th Semester Core)\r\n\r\n• Teacher’s Training Certificate in Music issued by\r\n  Government of Tamil Nadu\r\n\r\n• Advanced Diploma in Carnatic Music', 'M.F.A', 'Music', 'PMU');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(11) NOT NULL,
  `application_no` varchar(30) NOT NULL,
  `course_type` varchar(20) DEFAULT NULL,
  `foundation_lang` varchar(50) DEFAULT NULL,
  `programme_name` varchar(150) DEFAULT NULL,
  `main_subject` varchar(150) DEFAULT NULL,
  `medium` varchar(20) DEFAULT NULL,
  `differently_abled` varchar(5) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `street` varchar(200) NOT NULL,
  `town` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `mobile` varchar(15) NOT NULL,
  `name_english` varchar(150) NOT NULL,
  `name_tamil` varchar(150) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `guardian_name` varchar(150) NOT NULL,
  `aadhaar` varchar(14) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `mother_tongue` varchar(100) DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `community` varchar(20) DEFAULT NULL,
  `caste` varchar(100) DEFAULT NULL,
  `employment_status` varchar(10) DEFAULT NULL,
  `employment_type` varchar(150) DEFAULT NULL,
  `other_course` varchar(10) DEFAULT NULL,
  `other_course_details` varchar(255) DEFAULT NULL,
  `defence_personnel` tinyint(1) DEFAULT 0,
  `ex_servicemen` tinyint(1) DEFAULT 0,
  `sslc_school` varchar(150) DEFAULT NULL,
  `sslc_board` varchar(150) DEFAULT NULL,
  `sslc_pass_year` varchar(20) DEFAULT NULL,
  `sslc_reg_no` varchar(50) DEFAULT NULL,
  `sslc_grade` varchar(50) DEFAULT NULL,
  `sslc_max_marks` varchar(20) DEFAULT NULL,
  `hsc_school` varchar(150) DEFAULT NULL,
  `hsc_board` varchar(150) DEFAULT NULL,
  `hsc_pass_year` varchar(20) DEFAULT NULL,
  `hsc_reg_no` varchar(50) DEFAULT NULL,
  `hsc_grade` varchar(50) DEFAULT NULL,
  `hsc_max_marks` varchar(20) DEFAULT NULL,
  `abc_status` varchar(10) DEFAULT NULL,
  `abc_id` varchar(12) DEFAULT NULL,
  `sslc_file` varchar(255) DEFAULT NULL,
  `hsc_file` varchar(255) DEFAULT NULL,
  `ug_file` varchar(255) DEFAULT NULL,
  `tc_file` varchar(255) DEFAULT NULL,
  `migration_file` varchar(255) DEFAULT NULL,
  `undertaking_file` varchar(255) DEFAULT NULL,
  `enclosures` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `dip_school` varchar(200) DEFAULT NULL,
  `dip_board` varchar(200) DEFAULT NULL,
  `dip_pass_year` varchar(10) DEFAULT NULL,
  `dip_reg_no` varchar(50) DEFAULT NULL,
  `dip_grade` varchar(50) DEFAULT NULL,
  `dip_max_marks` varchar(50) DEFAULT NULL,
  `ug_school` varchar(200) DEFAULT NULL,
  `ug_board` varchar(200) DEFAULT NULL,
  `ug_pass_year` varchar(10) DEFAULT NULL,
  `ug_reg_no` varchar(50) DEFAULT NULL,
  `ug_grade` varchar(50) DEFAULT NULL,
  `ug_max_marks` varchar(50) DEFAULT NULL,
  `mother_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `defence_ward` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `staff_remark` text DEFAULT NULL,
  `processed_by` varchar(100) DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `enrollment_no` varchar(30) DEFAULT NULL,
  `course_code` varchar(10) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `application_no`, `course_type`, `foundation_lang`, `programme_name`, `main_subject`, `medium`, `differently_abled`, `photo`, `name`, `street`, `town`, `state`, `district`, `pincode`, `phone`, `mobile`, `name_english`, `name_tamil`, `dob`, `age`, `guardian_name`, `aadhaar`, `nationality`, `religion`, `mother_tongue`, `blood_group`, `community`, `caste`, `employment_status`, `employment_type`, `other_course`, `other_course_details`, `defence_personnel`, `ex_servicemen`, `sslc_school`, `sslc_board`, `sslc_pass_year`, `sslc_reg_no`, `sslc_grade`, `sslc_max_marks`, `hsc_school`, `hsc_board`, `hsc_pass_year`, `hsc_reg_no`, `hsc_grade`, `hsc_max_marks`, `abc_status`, `abc_id`, `sslc_file`, `hsc_file`, `ug_file`, `tc_file`, `migration_file`, `undertaking_file`, `enclosures`, `created_at`, `dip_school`, `dip_board`, `dip_pass_year`, `dip_reg_no`, `dip_grade`, `dip_max_marks`, `ug_school`, `ug_board`, `ug_pass_year`, `ug_reg_no`, `ug_grade`, `ug_max_marks`, `mother_name`, `email`, `defence_ward`, `status`, `staff_remark`, `processed_by`, `processed_at`, `enrollment_no`, `course_code`, `course_id`) VALUES
(8, 'DIPA-2026-00002', 'PG', 'English', 'M.Sc', 'Information technology', 'English', NULL, NULL, 'subi', 'kjdofiy', 'sjffp', 'Tamil Nadu', 'Chennai', '987654', '8976543213', '9876543210', 'sUBI', 'சுபி', '2009-02-04', 17, 'jksdfh9is', '7876 5342 38', 'INDIAN', 'kjbhjggftg', 'jkhfyt', NULL, 'BC', 'hgjgdh', 'yes', 'University of Madras', 'No', '', 0, 0, '', '', '1/2024', '', '', '', '', '', '2/2024', '', '', '', 'No', '', 'SSLC-DIPA-2026-00002.pdf', 'HSC-DIPA-2026-00002.pdf', 'UG-DIPA-2026-00002.pdf', 'TC-DIPA-2026-00002.pdf', 'MIGRATION-DIPA-2026-00002.pdf', 'UNDERTAKING-DIPA-2026-00002.pdf', NULL, '2026-02-17 16:59:51', '', '', '3/2024', '', '', '', '', '', '4/2024', '', '', '', '', '', NULL, 'Approved', 'vv', 'admin', '2026-03-06 07:54:17', 'A26101PIT6009', NULL, NULL),
(9, 'PGA-2026-00003', 'PG', 'Tamil', 'M.Sc', 'Computer Science', 'Tamil', NULL, NULL, 'subi', 'kjdofiy', 'sjffp', 'Tamil Nadu', 'Coimbatore', '987654', '8976543213', '9876543210', 'sUBI', 'சுபி', '2009-02-04', 17, 'jksdfh9is', '7876 5342 38', 'INDIAN', 'kjbhjggftg', 'jkhfyt', NULL, 'BC', 'hgjgdh', 'yes', 'University of Madras', 'No', '', 0, 0, '', '', '12/2023', '', '', '', '', '', '11/2023', '', '', '', 'No', '', 'SSLC-PGA-2026-00003.pdf', 'HSC-PGA-2026-00003.pdf', 'UG-PGA-2026-00003.pdf', 'TC-PGA-2026-00003.pdf', 'MIGRATION-PGA-2026-00003.pdf', 'UNDERTAKING-PGA-2026-00003.pdf', NULL, '2026-02-18 05:20:46', '', '', '1/2024', '', '', '', '', '', '2/2025', '', '', '', 'Mohan', 'subi@gmail.com', NULL, 'Approved', NULL, 'admin', '2026-03-06 15:13:55', NULL, NULL, NULL),
(10, 'PGA-2026-00004', 'PG', 'Tamil', 'M.Sc', 'Computer Science', 'Tamil', NULL, NULL, 'subi', 'kjdofiy', 'sjffp', 'Tamil Nadu', 'Coimbatore', '987654', '8976543213', '9876543210', 'sUBI', 'சுபி', '2009-02-04', 17, 'jksdfh9is', '7876 5342 3862', 'INDIAN', 'kjbhjggftg', 'jkhfyt', NULL, 'BC', 'hgjgdh', 'yes', 'University of Madras', 'No', '', 0, 0, '', '', '1/2022', '', '', '', '', '', '2/2023', '', '', '', 'Yes', '123345667899', 'SSLC-PGA-2026-00004.pdf', 'HSC-PGA-2026-00004.pdf', 'UG-PGA-2026-00004.pdf', 'TC-PGA-2026-00004.pdf', 'MIGRATION-PGA-2026-00004.pdf', 'UNDERTAKING-PGA-2026-00004.pdf', NULL, '2026-02-18 05:41:33', '', '', '3/2023', '', '', '', '', '', '4/2023', '', '', '', 'Mohan', 'subi@gmail.com', NULL, 'Approved', NULL, 'admin', '2026-03-06 15:13:55', NULL, NULL, NULL),
(11, 'PGA-2026-00005', 'PG', 'Tamil', 'M.Sc', 'Computer Science', 'English', NULL, '1771393967_PHOTO.jpg', 'subi', 'kjdofiy', 'sjffp', 'Tamil Nadu', 'Madurai', '987654', '8976543213', '9876543210', 'sUBI', 'சுபி', '2009-02-04', 17, 'jksdfh9is', '7876 5342 3862', 'INDIAN', 'kjbhjggftg', 'jkhfyt', NULL, 'BC', 'hgjgdh', 'no', NULL, 'No', '', 0, 0, '', '', '1/2022', '', '', '', '', '', '2/2022', '', '', '', 'No', '', 'SSLC-PGA-2026-00005.pdf', 'HSC-PGA-2026-00005.pdf', 'UG-PGA-2026-00005.pdf', 'TC-PGA-2026-00005.pdf', 'MIGRATION-PGA-2026-00005.pdf', 'UNDERTAKING-PGA-2026-00005.pdf', NULL, '2026-02-18 05:52:47', '', '', '3/2022', '', '', '', '', '', '12/2022', '', '', '', 'Mohan', 'subi@gmail.com', NULL, 'Rejected', NULL, 'admin', '2026-02-25 12:07:53', NULL, NULL, NULL),
(12, 'PGA-2026-00006', 'PG', NULL, 'gcsruk', 'M.A Public Administration', 'English', NULL, NULL, 'subi', 'kjdofiy', 'sjffp', 'Kerala', 'Coimbatore', '987654', '7412583695', '8976543213', 'subi', 'சுபி', '2009-02-02', 17, 'jksdfh9is', '7876 5342 3862', 'INDIAN', 'kjbhjggftg', 'jkhfyt', NULL, 'BC', 'hgjgdh', 'yes', 'University of Madras', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 05:08:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Mohan', 'subithramohan07@gmail.com', NULL, 'Approved', 'good', 'admin', '2026-02-25 12:12:29', NULL, NULL, NULL),
(13, 'UGA-2026-00001', 'UG', 'Malayalam', 'M.Sc', 'Computer Science', 'English', NULL, NULL, 'Hemanath', 'asdfghjkwertyuicvbnm', 'wertyuisdfghjkzxcvbnm', 'Tamil Nadu', 'Madurai', '60204', '8525555555', '2222222222', 'Hemanth', 'ஹேமந்த்', '2009-02-02', 17, 'Madhan', '9999 9999 9999', 'INDIAN', 'HINDU', 'TAMIL', NULL, 'ST', 'fsagfh', 'yes', 'University of Madras', 'No', '', 0, 0, 'Emmanuel Metric Hr School', '', '06/2019', '741852', '306', '500', 'Emmanuel Metric Hr School', '', '06/2021', '741852', '441', '600', 'Yes', '888888888888', 'SSLC-UGA-2026-00001.pdf', 'HSC-UGA-2026-00001.pdf', NULL, 'TC-UGA-2026-00001.pdf', 'MIGRATION-UGA-2026-00001.pdf', 'UNDERTAKING-UGA-2026-00001.pdf', NULL, '2026-02-19 05:33:45', '', '', '', '', '', '', '', '', '', '', '', '', 'Renuka', 'hema123@gmail.com', NULL, 'Approved', NULL, 'admin', '2026-03-06 15:13:55', NULL, NULL, NULL),
(14, 'UGA-2026-00002', 'UG', NULL, 'B.Com', 'Bank Management', 'English', NULL, NULL, 'Hemanath', 'Ponneri', 'Chennai', 'Tamil Nadu', 'Coimbatore', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2005-02-19', 21, 'Madhan', '5845 4585 8555', 'INDIAN', 'HINDU', 'TAMIL', NULL, 'SC', 'wsxsd', 'yes', 'University of Madras', 'No', '', 0, 0, 'ems', 'ems', '06/2019', '8520963', '306', '500', 'ems', 'ems', '06/2021', '852963', '441', '600', 'Yes', '777777777777', 'SSLC-UGA-2026-00002.pdf', 'HSC-UGA-2026-00002.pdf', 'UG-UGA-2026-00002.pdf', 'TC-UGA-2026-00002.pdf', 'MIGRATION-UGA-2026-00002.pdf', 'UNDERTAKING-UGA-2026-00002.pdf', NULL, '2026-02-19 08:46:04', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'mndc', 'admin', '2026-03-04 15:44:35', 'A26101UBT6001', NULL, 11),
(15, 'PGA-2026-00007', 'PG', NULL, 'M.Sc', 'Select Subject', NULL, NULL, NULL, 'Hemanath', 'Ponneri', 'Chennai', 'Tamil Nadu', 'Chennai', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-02-04', 17, 'Madhan', '4444 4444 44', 'INDIAN', 'HINDU', 'Tamil', NULL, 'BC', 'BBMNB', 'yes', 'University of Madras', 'No', '', 0, 0, 'JKKJHK', 'KJNDJ', '03/2001', '33333', '300', '500', '', '', '', '', '', '', 'Yes', '222222222222', 'SSLC-PGA-2026-00007.pdf', 'HSC-PGA-2026-00007.pdf', 'UG-PGA-2026-00007.pdf', 'TC-PGA-2026-00007.pdf', 'MIGRATION-PGA-2026-00007.pdf', 'UNDERTAKING-PGA-2026-00007.pdf', NULL, '2026-02-19 08:57:59', '', '', '', '', '', '', '', '', '', '', '', '', 'Lakshmi', 'hemanathmadhan@gmail.com', NULL, 'Approved', NULL, 'admin', '2026-03-06 15:13:55', NULL, NULL, NULL),
(16, 'PGA-2026-00008', 'PG', NULL, 'M.Sc', 'Geography', 'Tamil', NULL, '1771499344_PHOTO.jpg', 'Hemanath', 'Ponneri', 'Chennai', 'Tamil Nadu', 'Chennai', '601204', '9790817040', '2222222222', 'Hemanath M', 'ஹேமந்த் ம்', '2009-02-12', 17, 'ASDFGHJK', '1111 1111 1111', 'INDIAN', 'HINDU', 'TAMIL', NULL, 'BC', 'ADI DRAVIDAR', 'no', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 11:09:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'Okey', 'admin', '2026-02-28 21:40:23', NULL, NULL, 17),
(17, 'UGA-2026-00003', 'UG', NULL, 'B.Sc', 'Mathematics', 'English', NULL, NULL, 'Hemanath M', 'Ponneri', 'Chennai', 'Tamil Nadu', 'Madurai', '601204', '9790817040', '9790817040', 'monesh', 'மோனிஷ்', '2009-02-01', 17, 'ASDFGHJK', '2222 2222 2222', 'INDIAN', 'Hindu ', 'TAMIL', NULL, 'SC', 'dfghjk', 'no', NULL, 'Yes', 'sdfghj', 0, 0, 'mkldsfmkns', 'mkldsfmkns', '06/2019', '52631', '305', '775', 'mkldsfmkns', 'mkldsfmkns', '06/2021', '852963', '454', '88', 'No', '', 'SSLC-UGA-2026-00003.pdf', 'HSC-UGA-2026-00003.pdf', NULL, 'TC-UGA-2026-00003.pdf', 'MIGRATION-UGA-2026-00003.pdf', 'UNDERTAKING-UGA-2026-00003.pdf', NULL, '2026-02-23 06:20:38', '', '', '', '', '', '', '', '', '', '', '', '', 'sdfg', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'okey', 'admin', '2026-02-28 21:40:54', NULL, NULL, 13),
(18, 'DIPA-2026-00003', 'DIP', NULL, 'Diploma', 'Systems Management', 'English', NULL, NULL, 'Hemanath M', 'Ponneri', 'Chennai', 'Tamil Nadu', 'Madurai', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2008-12-03', 17, 'Madhan', '2222 2222 2222', 'INDIAN', ' bvcd', 'French', NULL, 'MBC', 'dfghjk', 'no', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-23 08:11:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'ERRRKL', 'admin', '2026-02-26 14:58:43', NULL, NULL, 15),
(19, 'CERTA-2026-00001', 'CERT', 'English', 'Certificate', 'Taxation', 'English', NULL, '1772000993_WhatsApp Image 2025-12-01 at 11.31.14_36a15b17.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '21', 'Jaisalmer', '601204', '9790817040', '9790817040', 'Hemanath M', 'Hemanath M', '2008-12-04', 17, 'ASDFGHJK', '7777 7777 7777', 'INDIAN', 'HINDU', 'TAMIL', NULL, 'MBC', 'wsxsd', 'no', NULL, 'No', '', 0, 0, 'EMMS', 'EMMS', '', '', '', '', 'EMMS', 'EMMS', '', '', '', '', 'No', '', 'SSLC-CERTA-2026-00001.pdf', 'HSC-CERTA-2026-00001.pdf', NULL, 'TC-CERTA-2026-00001.pdf', 'MIGRATION-CERTA-2026-00001.pdf', 'UNDERTAKING-CERTA-2026-00001.pdf', NULL, '2026-02-24 06:20:55', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'mm', 'admin', '2026-02-26 14:59:51', NULL, NULL, 14),
(20, 'UGA-2026-00004', 'UG', NULL, 'B.Com', 'Computer application', 'English', NULL, '1771918564_PHOTO.jpg', 'Janani', 'Ponneri', 'Chennai', '3', 'Biswanath', '601204', '9790817040', '9790817040', 'janani', 'ஜனனி', '2009-02-01', 17, 'ASDFGHJK', '7777 7777 7777', 'INDIAN', 'HINDU', 'hbvcx', NULL, 'BC', 'asdfb', 'no', NULL, 'No', '', 0, 0, 'EMS', 'EMS', '06/2019', '', '', '', 'EMS', 'EMS', '06/2021', '', '', '', 'No', '', 'SSLC-UGA-2026-00004.pdf', 'HSC-UGA-2026-00004.pdf', NULL, 'TC-UGA-2026-00004.pdf', 'MIGRATION-UGA-2026-00004.pdf', 'UNDERTAKING-UGA-2026-00004.pdf', NULL, '2026-02-24 07:36:04', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'asdfghjkl;\'', 'admin', '2026-02-24 14:26:04', NULL, NULL, NULL),
(21, 'UGA-2026-00005', 'UG', 'Communicative English', 'B.Com', 'General', 'English', NULL, NULL, 'Hemanath M', 'Ponneri', 'Chennai', '19', 'Bhadrak', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-02-01', 17, 'Madhan', '4444 4444 44', 'INDIAN', 'Hindu ', 'TAMIL', 'A+', 'ST', 'sdfgm', 'yes', 'University of Madras', 'No', '', 0, 0, 'EMMS', 'EMMS', '06/2019', '', '', '', 'EMMS', 'EMMS', '06/2021', '', '', '', 'Yes', '999999999999', 'SSLC-UGA-2026-00005.pdf', 'HSC-UGA-2026-00005.pdf', NULL, 'TC-UGA-2026-00005.pdf', 'MIGRATION-UGA-2026-00005.pdf', 'UNDERTAKING-UGA-2026-00005.pdf', NULL, '2026-02-25 07:35:15', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'sjshd', 'admin', '2026-03-04 15:44:07', 'A26101UCM6001', NULL, 10),
(22, 'DIPA-2026-00004', 'DIP', NULL, 'Diploma', 'Marketing Management', 'English', NULL, NULL, 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Coimbatore', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-02-02', 17, 'Madhan', '7777 7777 7777', 'INDIAN', 'HINDU', 'TAMIL', 'A-', 'ST', 'ADI DRAVIDAR', 'no', NULL, 'No', '', 0, 0, 'EMMS', 'EMMS', '06/2021', '', '', '', 'EMMS', 'EMMS', '', '', '', '', 'Yes', '852963415296', 'SSLC-DIPA-2026-00004.pdf', 'HSC-DIPA-2026-00004.pdf', NULL, 'TC-DIPA-2026-00004.pdf', 'MIGRATION-DIPA-2026-00004.pdf', 'UNDERTAKING-DIPA-2026-00004.pdf', NULL, '2026-02-26 05:31:31', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', NULL, 'admin', '2026-03-06 15:13:55', NULL, NULL, 11),
(23, 'PGA-2026-00009', 'PG', NULL, 'M.Com', 'Commerce', 'English', NULL, NULL, 'Sam', 'Ponneri', 'Chennai', '23', 'Select District', '601204', '9790817040', '9790817040', 'Sam', 'சாம்', '2009-02-02', 17, 'null', '4444 4444 44', 'INDIAN', 'HINDU', 'hbvcx', 'B-', 'ST', 'Adi Dravidar', 'yes', 'University of Madras', 'Yes', 'ADFGH', 0, 0, 'eeee', 'eeee', '06/2019', '', '', '', 'eeee', 'eeee', '06/2021', '', '', '', 'No', '', 'SSLC-PGA-2026-00009.pdf', 'HSC-PGA-2026-00009.pdf', 'UG-PGA-2026-00009.pdf', 'TC-PGA-2026-00009.pdf', 'MIGRATION-PGA-2026-00009.pdf', 'UNDERTAKING-PGA-2026-00009.pdf', NULL, '2026-02-26 06:24:24', '', '', '', '', '', '', '', '', '', '', '', '', 'Lakshmi', 'hemanathmadhan@gmail.com', NULL, 'Rejected', 'fgh', 'admin', '2026-02-26 14:26:25', NULL, NULL, 12),
(24, 'PGA-2026-00010', 'PG', NULL, 'M.Com', 'Commerce', 'English', NULL, '1772087163_PHOTO.jpg', 'Sam', 'Ponneri', 'Chennai', '23', 'Select District', '601204', '9790817040', '9790817040', 'Sam', 'சாம்', '2009-02-02', 17, 'null', '4444 4444 44', 'INDIAN', 'HINDU', 'hbvcx', 'B-', 'ST', 'Adi Dravidar', 'yes', 'University of Madras', 'No', '', 0, 0, 'eeee', 'eeee', '06/2019', '', '', '', 'eeee', 'eeee', '06/2021', '', '', '', 'Yes', '887745585655', 'SSLC-PGA-2026-00010.pdf', 'HSC-PGA-2026-00010.pdf', 'UG-PGA-2026-00010.pdf', 'TC-PGA-2026-00010.pdf', 'MIGRATION-PGA-2026-00010.pdf', 'UNDERTAKING-PGA-2026-00010.pdf', NULL, '2026-02-26 06:26:03', '', '', '', '', '', '', '', '', '', '', '', '', 'Lakshmi', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'gh', 'admin', '2026-02-26 14:25:26', NULL, NULL, 12),
(25, 'UGA-2026-00006', 'UG', 'French', 'B.Sc', 'Psychology', 'English', NULL, '1772290593_PHOTO.jpg', 'Renuka', 'Ponneri', 'Chennai', '23', 'Select District', '601204', '9790817040', '9790817040', 'renuka', 'ரேணுகா', '2009-02-01', 17, 'Madhan', '4444 4444 4444', 'INDIAN', ' bvcd', 'TAMIL', 'B+', 'BC', 'Adi Dravidar', 'no', NULL, 'No', '', 0, 0, 'EMMD', 'EMMD', '', '', '', '', 'EMMD', 'EMMD', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00006.pdf', 'HSC-UGA-2026-00006.pdf', NULL, 'TC-UGA-2026-00006.pdf', 'MIGRATION-UGA-2026-00006.pdf', 'UNDERTAKING-UGA-2026-00006.pdf', NULL, '2026-02-28 14:56:33', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', NULL, 'admin', '2026-03-06 15:13:55', NULL, NULL, 14),
(26, 'UGA-2026-00007', 'UG', 'French', 'B.Com', 'Bank Management', 'English', NULL, 'UGA-2026-00007.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Dharmapuri', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-02-01', 17, 'Madhan', '7777 7777 7777', 'INDIAN', 'HINDU', 'TAMIL', 'A-', 'ST', 'sdfgm', 'no', NULL, 'No', '', 0, 0, 'szfzszs', 'szfzszs', '', '', '', '', 'szfzszs', 'szfzszs', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00007.pdf', 'HSC-UGA-2026-00007.pdf', NULL, 'TC-UGA-2026-00007.pdf', 'MIGRATION-UGA-2026-00007.pdf', 'UNDERTAKING-UGA-2026-00007.pdf', NULL, '2026-02-28 15:04:13', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'hgv', 'admin', '2026-02-28 21:16:43', NULL, NULL, 11),
(27, 'PGA-2026-00011', 'PG', NULL, 'M.Com', 'Commerce', 'English', NULL, 'PGA-2026-00011.png', 'Hemanath M', 'Ponneri', 'Chennai', '19', 'Kandhamal', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-02-01', 17, 'Madhan', '4444 4444 44', 'INDIAN', ' bvcd', 'Tamil', 'O+', 'ST', 'devar', 'no', NULL, 'No', '', 0, 0, 'EEMS', 'EEMS', '', '', '', '', 'EEMS', 'EEMS', '', '', '', '', 'No', '', 'SSLC-PGA-2026-00011.pdf', 'HSC-PGA-2026-00011.pdf', 'UG-PGA-2026-00011.pdf', 'TC-PGA-2026-00011.pdf', 'MIGRATION-PGA-2026-00011.pdf', 'UNDERTAKING-PGA-2026-00011.pdf', NULL, '2026-02-28 15:49:27', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'gghfghf', 'admin', '2026-03-04 14:33:40', 'A26101PCM6001', NULL, 12),
(28, 'UGA-2026-00008', 'UG', 'Malayalam', 'B.Sc', 'Psychology', 'English', NULL, 'UGA-2026-00008.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Chengalpattu', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-02-01', 17, 'Madhan', '4444 4444 44', 'INDIAN', 'Hindu ', 'hbvcx', 'A-', 'ST', 'ADI DRAVIDAR', 'no', NULL, 'No', '', 0, 0, 'EMMS', 'EMMS', '', '', '', '', 'EMMS', 'EMMS', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00008.pdf', 'HSC-UGA-2026-00008.pdf', 'UG-UGA-2026-00008.pdf', 'TC-UGA-2026-00008.pdf', 'MIGRATION-UGA-2026-00008.pdf', 'UNDERTAKING-UGA-2026-00008.pdf', NULL, '2026-02-28 16:45:46', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'x x x', 'admin', '2026-02-28 22:17:11', 'A261016001', NULL, 14),
(29, 'UGA-2026-00009', 'UG', 'French', 'B.Com', 'General', 'Tamil', NULL, 'UGA-2026-00009.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Dindigul', '601204', '9790817040', '9790817040', 'Hemanath M', 'Hemanath M', '2009-02-01', 17, 'Madhan', '7777 7777 7777', 'INDIAN', ' bvcd', 'TAMIL', 'A-', 'ST', 'wsxsd', 'no', NULL, 'No', '', 0, 0, 'EMMS', 'EMMS', '', '', '', '', 'EMMS', 'EMMS', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00009.pdf', 'HSC-UGA-2026-00009.pdf', NULL, 'TC-UGA-2026-00009.pdf', 'MIGRATION-UGA-2026-00009.pdf', 'UNDERTAKING-UGA-2026-00009.pdf', NULL, '2026-02-28 17:02:53', '', '', '', '', '', '', '', '', '', '', '', '', 'Lakshmi', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'Okdy', 'admin', '2026-02-28 22:34:41', 'A261016002', NULL, 10),
(30, 'UGA-2026-00010', 'UG', 'Malayalam', 'B.A', 'French', 'Tamil', NULL, 'UGA-2026-00010.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Coimbatore', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-02-02', 17, 'Madhan', '4444 4444 44', 'INDIAN', 'HINDU', 'hbvcx', 'B+', 'ST', 'ADI DRAVIDAR', 'no', NULL, 'No', '', 0, 0, 'EEMS', 'EEMS', '', '', '', '', 'EEMS', 'EEMS', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00010.pdf', 'HSC-UGA-2026-00010.pdf', NULL, 'TC-UGA-2026-00010.pdf', 'MIGRATION-UGA-2026-00010.pdf', 'UNDERTAKING-UGA-2026-00010.pdf', NULL, '2026-03-01 02:14:06', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'Okey', 'admin', '2026-03-01 07:45:13', 'A20261015001', NULL, 3),
(31, 'UGA-2026-00011', 'UG', 'Tamil', 'B.A', 'French', 'Tamil', NULL, 'UGA-2026-00011.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Mayiladuthurai', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-01-06', 17, 'Madhan', '4444 4444 44', 'INDIAN', ' bvcd', 'Tamil', 'B+', 'ST', 'Adi Dravidar', 'no', NULL, 'No', '', 0, 0, 'EMMS', 'EMMS', '', '', '', '', 'EMMS', 'EMMS', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00011.pdf', 'HSC-UGA-2026-00011.pdf', NULL, 'TC-UGA-2026-00011.pdf', 'MIGRATION-UGA-2026-00011.pdf', 'UNDERTAKING-UGA-2026-00011.pdf', NULL, '2026-03-01 02:18:43', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'Okey', 'admin', '2026-03-01 07:49:42', 'A20261015001', NULL, 3),
(32, 'UGA-2026-00012', 'UG', 'Malayalam', 'B.A', 'French', 'English', NULL, 'UGA-2026-00012.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Coimbatore', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-02-01', 17, 'Madhan', '5845 4585 8555', 'INDIAN', 'Muslim', 'hbvcx', 'A+', 'SC', 'sdfgm', 'no', NULL, 'No', '', 0, 0, 'EMMS', 'EMMS', '', '', '', '', 'EMMS', 'EMMS', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00012.pdf', 'HSC-UGA-2026-00012.pdf', NULL, 'TC-UGA-2026-00012.pdf', 'MIGRATION-UGA-2026-00012.pdf', 'UNDERTAKING-UGA-2026-00012.pdf', NULL, '2026-03-01 02:31:08', '', '', '', '', '', '', '', '', '', '', '', '', 'nh', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'Okey', 'admin', '2026-03-01 08:02:07', 'A20261016001', NULL, 3),
(33, 'UGA-2026-00013', 'UG', 'French', 'B.A', 'Literature in Tamil', 'English', NULL, 'UGA-2026-00013.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Mayiladuthurai', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-01-05', 17, 'Madhan', '7777 7777 7777', 'INDIAN', 'HINDU', 'TAMIL', 'A-', 'ST', 'ADI DRAVIDAR', 'no', NULL, 'No', '', 0, 0, 'EMMS', 'EMMS', '', '', '', '', 'EMMS', 'EMMS', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00013.pdf', 'HSC-UGA-2026-00013.pdf', NULL, 'TC-UGA-2026-00013.pdf', 'MIGRATION-UGA-2026-00013.pdf', 'UNDERTAKING-UGA-2026-00013.pdf', NULL, '2026-03-01 02:38:57', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'okey', 'admin', '2026-03-01 08:16:29', 'A20261016001', NULL, 2),
(34, 'UGA-2026-00014', 'UG', 'Malayalam', 'B.B.A', 'Business Administration', 'English', NULL, 'UGA-2026-00014.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Cuddalore', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 4422', 'INDIAN', ' bvcd', 'French', 'O+', 'ST', 'ADI DRAVIDAR', 'no', NULL, 'No', '', 0, 0, 'EMMS', 'EMMS', '', '', '', '', 'EMMS', 'EMMS', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00014.pdf', 'HSC-UGA-2026-00014.pdf', NULL, 'TC-UGA-2026-00014.pdf', 'MIGRATION-UGA-2026-00014.pdf', 'UNDERTAKING-UGA-2026-00014.pdf', NULL, '2026-03-01 11:31:03', '', '', '', '', '', '', '', '', '', '', '', '', 'sdfg', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'Okey', 'admin', '2026-03-01 17:02:41', 'A20261016001', NULL, 12),
(35, 'UGA-2026-00015', 'UG', 'Arabic', 'B.C.A', 'Computer Applications', 'English', NULL, 'UGA-2026-00015.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Coimbatore', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '7777 7777 7777', 'INDIAN', ' bvcd', 'hbvcx', 'O+', 'ST', 'devar', 'no', NULL, 'No', '', 0, 0, 'EEMM', 'EEMM', '', '', '', '', 'EEMM', 'EEMM', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00015.pdf', 'HSC-UGA-2026-00015.pdf', NULL, 'TC-UGA-2026-00015.pdf', 'MIGRATION-UGA-2026-00015.pdf', 'UNDERTAKING-UGA-2026-00015.pdf', NULL, '2026-03-01 12:19:04', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'okey', 'admin', '2026-03-01 17:52:55', 'A20261016002', NULL, 16),
(36, 'UGA-2026-00016', 'UG', 'Malayalam', 'B.A', 'French', 'English', NULL, 'UGA-2026-00016.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Namakkal', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 4444', 'INDIAN', ' bvcd', 'Tamil', 'A-', 'ST', 'Adi Dravidar', 'no', NULL, 'No', '', 0, 0, 'SSSS', 'SSSS', '', '', '', '', 'SSSS', 'SSSS', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00016.pdf', 'HSC-UGA-2026-00016.pdf', NULL, 'TC-UGA-2026-00016.pdf', 'MIGRATION-UGA-2026-00016.pdf', 'UNDERTAKING-UGA-2026-00016.pdf', NULL, '2026-03-01 12:33:49', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'Okey', 'admin', '2026-03-01 18:17:33', 'A2026101UFR6001', NULL, 3),
(37, 'UGA-2026-00017', 'UG', 'French', 'B.A', 'Tamil', 'English', NULL, 'UGA-2026-00017.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Mayiladuthurai', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '7777 7777 7777', 'INDIAN', 'HINDU', 'hbvcx', 'A-', 'MBC', 'devar', 'no', NULL, 'No', '', 0, 0, 'EMMS', 'EMMS', '', '', '', '', 'EMMS', 'EMMS', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00017.pdf', 'HSC-UGA-2026-00017.pdf', NULL, 'TC-UGA-2026-00017.pdf', 'MIGRATION-UGA-2026-00017.pdf', 'UNDERTAKING-UGA-2026-00017.pdf', NULL, '2026-03-01 12:50:38', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'Okey', 'admin', '2026-03-01 18:28:47', 'A2026101UTL6001', NULL, NULL),
(38, 'UGA-2026-00018', 'UG', 'French', 'B.Com', 'Bank Management', NULL, NULL, 'UGA-2026-00018.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Nagapattinam', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '7777 7777 7777', 'INDIAN', 'Muslim', 'AAX', 'O+', 'ST', 'sdfgm', 'no', NULL, 'No', '', 0, 0, 'EMMS', 'EMMS', '', '', '', '', 'EMMS', 'EMMS', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00018.pdf', 'HSC-UGA-2026-00018.pdf', NULL, 'TC-UGA-2026-00018.pdf', 'MIGRATION-UGA-2026-00018.pdf', 'UNDERTAKING-UGA-2026-00018.pdf', NULL, '2026-03-01 13:00:25', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'Okey', 'admin', '2026-03-01 18:32:06', 'A2026101UBT5001', NULL, NULL),
(39, 'UGA-2026-00019', 'UG', 'Arabic', 'B.Com', 'General', 'Tamil', NULL, 'UGA-2026-00019.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '7', 'Jamnagar', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '7777 7777 7777', 'INDIAN', 'Muslim', 'AAX', 'O+', 'ST', 'sdfgm', 'no', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-01 13:04:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'hsss', 'admin', '2026-03-04 14:19:05', 'A26101UCM5002', NULL, NULL),
(40, 'UGA-2026-00020', 'UG', 'Tamil', 'B.Sc', 'Psychology', 'English', NULL, 'UGA-2026-00020.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Coimbatore', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '7777 7777 7777', 'INDIAN', 'HINDU', 'French', 'AB+', 'ST', 'devar', 'no', NULL, 'No', '', 0, 0, 'sdzs', 'asdD', '', '', '', '', 'dsc', 'aSDDSD', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00020.pdf', 'HSC-UGA-2026-00020.pdf', NULL, 'TC-UGA-2026-00020.pdf', 'MIGRATION-UGA-2026-00020.pdf', 'UNDERTAKING-UGA-2026-00020.pdf', NULL, '2026-03-01 13:07:22', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'okey', 'admin', '2026-03-01 18:38:20', 'A2026101UPY6001', NULL, NULL),
(41, 'UGA-2026-00021', 'UG', 'Arabic', 'B.Sc', 'Geography', 'English', NULL, 'UGA-2026-00021.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Madurai', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'r3fdc', '7777 7777 7777', 'INDIAN', ' bvcd', 'hbvcx', 'A-', 'ST', 'sdfgm', 'no', NULL, 'No', '', 0, 0, 'sd', 'asd', '', '', '', '', 'asd', 'asd', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00021.pdf', 'HSC-UGA-2026-00021.pdf', NULL, 'TC-UGA-2026-00021.pdf', 'MIGRATION-UGA-2026-00021.pdf', 'UNDERTAKING-UGA-2026-00021.pdf', NULL, '2026-03-01 13:09:31', '', '', '', '', '', '', '', '', '', '', '', '', 'sdfg', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'okey', 'admin', '2026-03-01 18:40:34', 'A2026101UGE6001', NULL, NULL),
(42, 'UGA-2026-00022', 'UG', 'Communicative English', 'B.F.A', 'Music', 'English', NULL, 'UGA-2026-00022.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Nagapattinam', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 4444', 'INDIAN', 'HINDU', 'TAMIL', 'A-', 'ST', 'Adi Dravidar', 'no', NULL, 'No', '', 0, 0, 'ef', 'ads', '', '', '', '', 'ad', 'sda', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00022.pdf', 'HSC-UGA-2026-00022.pdf', NULL, 'TC-UGA-2026-00022.pdf', 'MIGRATION-UGA-2026-00022.pdf', 'UNDERTAKING-UGA-2026-00022.pdf', NULL, '2026-03-01 13:14:33', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'okey', 'admin', '2026-03-01 18:45:41', 'A2026101UMU6001', NULL, NULL),
(43, 'UGA-2026-00023', 'UG', 'French', 'B.Sc', 'Mathematics', 'English', NULL, 'UGA-2026-00023.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Chennai', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'null', '7777 7777 7777', 'INDIAN', ' bvcd', 'TAMIL', 'A-', 'ST', 'Adi Dravidar', 'no', NULL, 'No', '', 0, 0, 'zdczd', 'xxc', '', '', '', '', 'zXz', 'xzx', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00023.pdf', 'HSC-UGA-2026-00023.pdf', NULL, 'TC-UGA-2026-00023.pdf', 'MIGRATION-UGA-2026-00023.pdf', 'UNDERTAKING-UGA-2026-00023.pdf', NULL, '2026-03-01 13:25:27', '', '', '', '', '', '', '', '', '', '', '', '', 'sdfg', 'hemanathmadhan@gmail.com', NULL, 'Rejected', 'cfc', 'admin', '2026-03-03 09:46:00', 'A2026101UMA6001', NULL, NULL),
(44, 'UGA-2026-00024', 'UG', 'Malayalam', 'B.Sc', 'Mathematics', 'English', NULL, 'UGA-2026-00024.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Nagapattinam', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '7777 7777 7777', 'INDIAN', 'HINDU', 'TAMIL', 'A-', 'ST', 'Adi Dravidar', 'no', NULL, 'No', '', 0, 0, 'zcz', 'zxc', '', '', '', '', 'xzx', 'xcx', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00024.pdf', 'HSC-UGA-2026-00024.pdf', NULL, 'TC-UGA-2026-00024.pdf', 'MIGRATION-UGA-2026-00024.pdf', 'UNDERTAKING-UGA-2026-00024.pdf', NULL, '2026-03-01 13:29:21', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'ddv', 'admin', '2026-03-03 09:46:32', 'A2026101UMA6002', NULL, NULL),
(45, 'CERTA-2026-00002', 'CERT', NULL, 'Certificate', 'Library and Information Sciences', 'English', NULL, 'CERTA-2026-00002.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Namakkal', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '7777 7777 7777', 'INDIAN', 'HINDU', 'French', 'O+', 'SC', 'ADI DRAVIDAR', 'no', NULL, 'No', '', 0, 0, 'ffadd', 'cSXs', '', '', '', '', 'ssSC', 'cASx', '', '', '', '', 'No', '', 'SSLC-CERTA-2026-00002.pdf', 'HSC-CERTA-2026-00002.pdf', NULL, 'TC-CERTA-2026-00002.pdf', 'MIGRATION-CERTA-2026-00002.pdf', 'UNDERTAKING-CERTA-2026-00002.pdf', NULL, '2026-03-01 14:58:44', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'Okey', 'admin', '2026-03-01 20:31:43', 'A2026101CLS6001', NULL, NULL),
(46, 'DIPA-2026-00005', 'DIP', NULL, 'Diploma', 'Naturopathy and Yogic Sciences', 'English', NULL, 'DIPA-2026-00005.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Chennai', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '7777 7777 7777', 'INDIAN', 'HINDU', 'TAMIL', 'O+', 'ST', 'ADI DRAVIDAR', 'no', NULL, 'No', '', 0, 0, 'sccS', 'ASxAS', '', '', '', '', 'SXS', 'SXS', '', '', '', '', 'No', '', 'SSLC-DIPA-2026-00005.pdf', 'HSC-DIPA-2026-00005.pdf', NULL, 'TC-DIPA-2026-00005.pdf', 'MIGRATION-DIPA-2026-00005.pdf', 'UNDERTAKING-DIPA-2026-00005.pdf', NULL, '2026-03-01 15:16:09', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'AS', 'admin', '2026-03-01 20:47:12', 'A2026101DNY6003', NULL, NULL),
(47, 'UGA-2026-00025', 'UG', 'Malayalam', 'B.Com', 'Bank Management', 'English', NULL, 'UGA-2026-00025.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Nagapattinam', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 44', 'INDIAN', ' bvcd', 'hbvcx', 'B-', 'SC', 'wsxsd', 'no', NULL, 'No', '', 0, 0, 'ggdsfg', 'sdfs', '', '', '', '', 'zsdfa', 'sdf', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00025.pdf', 'HSC-UGA-2026-00025.pdf', NULL, 'TC-UGA-2026-00025.pdf', 'MIGRATION-UGA-2026-00025.pdf', 'UNDERTAKING-UGA-2026-00025.pdf', NULL, '2026-03-01 15:34:08', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'bvc', 'admin', '2026-03-01 21:05:34', 'A2026101UBT6004', NULL, NULL),
(48, 'PGA-2026-00012', 'PG', NULL, 'M.Com', 'Commerce', 'English', NULL, NULL, 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Kallakurichi', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 4444', 'INDIAN', 'HINDU', 'hbvcx', 'B-', 'ST', 'Adi Dravidar', 'no', NULL, 'No', '', 0, 0, 'dfxvfdx', 'fxvfv', '', '', '', '', 'xcvxfv', 'xvxcv', '', '', '', '', 'No', '', 'SSLC-PGA-2026-00012.pdf', 'HSC-PGA-2026-00012.pdf', 'UG-PGA-2026-00012.pdf', 'TC-PGA-2026-00012.pdf', 'MIGRATION-PGA-2026-00012.pdf', 'UNDERTAKING-PGA-2026-00012.pdf', NULL, '2026-03-02 04:49:21', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'Okey', 'admin', '2026-03-02 10:21:55', 'A2026101PCM6005', NULL, NULL),
(49, 'CERTA-2026-00003', 'CERT', 'English', 'Certificate', 'Karnatic Music', 'Tamil', NULL, '1772510963_WIN_20251104_15_38_20_Pro.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Mayiladuthurai', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 44', 'INDIAN', 'HINDU', 'hbvcx', 'O+', 'ST', 'ADI DRAVIDAR', 'no', NULL, 'No', '', 0, 0, 'fvdv', 'dfc', '', '', '', '', 'dfc', 'dzc', '', '', '', '', 'No', '', 'SSLC-CERTA-2026-00003.pdf', 'HSC-CERTA-2026-00003.pdf', NULL, 'TC-CERTA-2026-00003.pdf', 'MIGRATION-CERTA-2026-00003.pdf', 'UNDERTAKING-CERTA-2026-00003.pdf', NULL, '2026-03-02 04:54:41', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'Okey', 'admin', '2026-03-02 10:25:44', 'A2026101CKM5002', NULL, NULL),
(50, 'DIPA-2026-00006', 'DIP', NULL, 'Diploma', 'Hospital Management', 'Tamil', NULL, 'DIPA-2026-00006.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Dindigul', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '7777 7777 7777', 'INDIAN', 'HINDU', 'TAMIL', 'O+', 'ST', 'Adi Dravidar', 'no', NULL, 'No', '', 0, 0, 'ssdfc', 'sdads', '', '', '', '', 'sdsa', 'sada', '', '', '', '', 'No', '', 'SSLC-DIPA-2026-00006.pdf', 'HSC-DIPA-2026-00006.pdf', NULL, 'TC-DIPA-2026-00006.pdf', 'MIGRATION-DIPA-2026-00006.pdf', 'UNDERTAKING-DIPA-2026-00006.pdf', NULL, '2026-03-02 05:04:30', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 's', 'admin', '2026-03-02 10:44:40', 'A26101DHM6003', NULL, NULL),
(51, 'PGA-2026-00013', 'PG', NULL, 'M.F.A', 'Music', 'English', NULL, NULL, 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Cuddalore', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 44', 'INDIAN', 'HINDU', 'TAMIL', 'A+', 'ST', 'Adi Dravidar', 'no', NULL, 'No', '', 0, 0, 'fdgdfg', 'xszdf', '', '', '', '', 'xdfdzsff', 'dfdf', '', '', '', '', 'No', '', 'SSLC-PGA-2026-00013.pdf', 'HSC-PGA-2026-00013.pdf', 'UG-PGA-2026-00013.pdf', 'TC-PGA-2026-00013.pdf', 'MIGRATION-PGA-2026-00013.pdf', 'UNDERTAKING-PGA-2026-00013.pdf', NULL, '2026-03-02 05:17:53', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'gfgf', 'admin', '2026-03-02 11:09:42', 'A26101PMU6002', NULL, NULL),
(52, 'UGA-2026-00026', 'UG', 'Tamil', 'B.A', 'Historical Studies', 'English', NULL, '1772446141_WIN_20251104_15_38_20_Pro.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Madurai', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 44', 'INDIAN', 'HINDU', 'TAMIL', 'O+', 'ST', 'Adi Dravidar', 'no', NULL, 'Yes', 'sadaSd', 0, 0, 'sdcdf', 'sdfsd', '', '', '', '', 'sdfds', 'dddda', '', '', '', '', 'Yes', '788787878787', 'SSLC-UGA-2026-00026.pdf', 'HSC-UGA-2026-00026.pdf', NULL, 'TC-UGA-2026-00026.pdf', 'MIGRATION-UGA-2026-00026.pdf', 'UNDERTAKING-UGA-2026-00026.pdf', NULL, '2026-03-02 07:01:48', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'Verified', 'admin', '2026-03-02 15:13:03', 'A26101UHS6003', NULL, NULL),
(53, 'DIPA-2026-00007', 'DIP', 'English', 'Diploma', 'Labour Law', 'Tamil', NULL, NULL, 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Madurai', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-02', 17, 'Madhan', '7777 7777 7777', 'INDIAN', 'HINDU', 'TAMIL', 'O-', 'ST', 'devar', 'no', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-03 05:44:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'nj', 'admin', '2026-03-04 12:42:02', 'A26101DLL6006', NULL, NULL),
(54, 'UGA-2026-00027', 'UG', 'Sanskrit', 'B.C.A', 'Computer Applications', 'Tamil', NULL, 'UGA-2026-00027.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Kanchipuram', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 4411', 'INDIAN', 'HINDU', 'TAMIL', 'B-', 'ST', 'Adi Dravidar', 'no', NULL, 'No', '', 0, 0, 'EMMS', 'EMMS', '06/2019', '74152', '306', '500', 'EMMS', 'EMMS', '06/2021', '96325', '341', '600', 'Yes', '789268585154', 'SSLC-UGA-2026-00027.pdf', 'HSC-UGA-2026-00027.pdf', NULL, 'TC-UGA-2026-00027.pdf', 'MIGRATION-UGA-2026-00027.pdf', 'UNDERTAKING-UGA-2026-00027.pdf', NULL, '2026-03-03 08:24:26', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'verified', 'admin', '2026-03-04 12:40:31', 'A26101UCA6004', NULL, NULL),
(55, 'UGA-2026-00028', 'UG', 'Kannada', 'B.Sc', 'Psychology', 'English', NULL, 'UGA-2026-00028.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Krishnagiri', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 44', 'INDIAN', 'HINDU', 'TAMIL', 'O+', 'ST', 'ADI DRAVIDAR', 'yes', 'University of Madras', 'Yes', 'wwwwwwwwwwwwwww', 0, 0, 'EMMS', 'EMMS', '06/2019', '25896', '306', '500', '', '', '', '', '', '', 'Yes', '256974268828', 'SSLC-UGA-2026-00028.pdf', 'HSC-UGA-2026-00028.pdf', NULL, 'TC-UGA-2026-00028.pdf', 'MIGRATION-UGA-2026-00028.pdf', 'UNDERTAKING-UGA-2026-00028.pdf', NULL, '2026-03-03 08:53:40', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'VERIFIED', 'admin', '2026-03-03 14:53:49', 'A26101UPY6004', NULL, NULL),
(56, 'UGA-2026-00029', 'UG', 'Sanskrit', 'B.A', 'Criminology and Police Administration', 'Tamil', NULL, 'UGA-2026-00029.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Madurai', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '7777 7777 7777', 'INDIAN', 'HINDU', 'Tamil', 'O+', 'ST', 'ADI DRAVIDAR', 'yes', 'University of Madras', 'No', '', 0, 0, 'gdfg', 'fdxdfg', '', '', '', '', 'fdfd', 'dfdsf', '', '', '', '', 'Yes', '546575463463', 'SSLC-UGA-2026-00029.pdf', 'HSC-UGA-2026-00029.pdf', NULL, 'TC-UGA-2026-00029.pdf', 'MIGRATION-UGA-2026-00029.pdf', 'UNDERTAKING-UGA-2026-00029.pdf', NULL, '2026-03-03 09:54:22', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'mbhb', 'admin', '2026-03-04 12:41:09', 'A26101UCP6005', NULL, NULL),
(57, 'PGA-2026-00014', 'PG', 'English', 'M.Com', 'Commerce', 'Tamil', NULL, 'PGA-2026-00014.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Erode', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 4444', 'INDIAN', ' bvcd', 'Tamil', 'B+', 'ST', 'Adi Dravidar', 'yes', 'University of Madras', 'Yes', 'private', 0, 0, 'mnm', '  b', '', '', '', '', 'nmbj', ' bnhb', '', '', '', '', 'No', '', 'SSLC-PGA-2026-00014.pdf', 'HSC-PGA-2026-00014.pdf', 'UG-PGA-2026-00014.pdf', 'TC-PGA-2026-00014.pdf', 'MIGRATION-PGA-2026-00014.pdf', 'UNDERTAKING-PGA-2026-00014.pdf', NULL, '2026-03-04 05:24:34', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'bnbj', 'admin', '2026-03-04 13:15:00', 'A26101PCM5001', NULL, NULL),
(58, 'UGA-2026-00030', 'UG', 'Communicative English', 'B.B.A', 'Business Administration', 'Tamil', NULL, 'UGA-2026-00030.png', 'Hemanath M', 'Ponneri', 'Chennai', '4', 'Arwal', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-02', 17, 'Madhan', '4444 4444 4422', 'INDIAN', 'Muslim', 'TAMIL', 'O+', 'ST', 'devar', 'no', NULL, 'No', '', 0, 0, 'ssdzsxszsc', 'xzczxcx', '', '', '', '', '', '', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00030.pdf', 'HSC-UGA-2026-00030.pdf', NULL, 'TC-UGA-2026-00030.pdf', 'MIGRATION-UGA-2026-00030.pdf', 'UNDERTAKING-UGA-2026-00030.pdf', NULL, '2026-03-04 07:42:58', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'XBhb', 'admin', '2026-03-04 13:14:28', 'A26101UBA5001', NULL, NULL),
(59, 'UGA-2026-00031', 'UG', 'Arabic', 'B.Com', 'General', 'tamil', NULL, 'UGA-2026-00031.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Nagapattinam', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 4444', 'INDIAN', ' bvcd', 'TAMIL', 'O+', 'ST', 'devar', 'no', NULL, 'No', '', 0, 0, 'ssxASA', '', '', '', '', '', 'SXSx', '', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00031.pdf', 'HSC-UGA-2026-00031.pdf', NULL, 'TC-UGA-2026-00031.pdf', 'MIGRATION-UGA-2026-00031.pdf', 'UNDERTAKING-UGA-2026-00031.pdf', NULL, '2026-03-04 08:27:26', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'xZXZ', 'admin', '2026-03-04 13:58:34', 'A26101UCM5001', NULL, NULL),
(60, 'UGA-2026-00032', 'UG', 'Communicative English', 'B.B.A', 'Business Administration', 'tamil', NULL, 'UGA-2026-00032.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Madurai', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 4444', 'INDIAN', 'HINDU', 'TAMIL', 'O+', 'ST', 'Adi Dravidar', 'no', NULL, 'No', '', 0, 0, 'sx', '', '', '', '', '', 'dssd', '', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00032.pdf', 'HSC-UGA-2026-00032.pdf', NULL, 'TC-UGA-2026-00032.pdf', 'MIGRATION-UGA-2026-00032.pdf', 'UNDERTAKING-UGA-2026-00032.pdf', NULL, '2026-03-04 08:30:12', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'ZXZ', 'admin', '2026-03-04 14:01:05', 'A26101UBA5002', NULL, NULL),
(61, 'UGA-2026-00033', 'UG', 'French', 'B.B.A', 'Business Administration', 'tamil', NULL, 'UGA-2026-00033.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Karur', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 4444', 'INDIAN', 'HINDU', 'TAMIL', 'O+', 'ST', 'sdfgm', 'no', NULL, 'No', '', 0, 0, 'xdvzfvzd', 'ffvds', '', '', '', '', '', '', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00033.pdf', 'HSC-UGA-2026-00033.pdf', NULL, 'TC-UGA-2026-00033.pdf', 'MIGRATION-UGA-2026-00033.pdf', 'UNDERTAKING-UGA-2026-00033.pdf', NULL, '2026-03-04 08:32:29', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'fs', 'admin', '2026-03-04 14:07:04', 'A26101UBA5003', NULL, NULL),
(62, 'UGA-2026-00034', 'UG', 'French', 'B.B.A', 'Business Administration', 'english', NULL, NULL, 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Krishnagiri', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 4444', 'INDIAN', 'HINDU', 'Tamil', 'O+', 'ST', 'ADI DRAVIDAR', 'no', NULL, 'No', '', 0, 0, 'xfdf', 'fddzdf', '', '', '', '', '', '', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00034.pdf', 'HSC-UGA-2026-00034.pdf', NULL, 'TC-UGA-2026-00034.pdf', 'MIGRATION-UGA-2026-00034.pdf', 'UNDERTAKING-UGA-2026-00034.pdf', NULL, '2026-03-04 08:34:15', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'done', 'admin', '2026-03-04 14:06:43', 'A26101UBA6001', NULL, NULL),
(63, 'CERTA-2026-00004', 'CERT', NULL, 'Certificate', 'Spoken Tamil', 'english', NULL, 'CERTA-2026-00004.jpg', 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Namakkal', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 4444', 'INDIAN', 'HINDU', 'TAMIL', 'O+', 'ST', 'Adi Dravidar', 'no', NULL, 'Yes', 'mmmm', 0, 0, 'hhhh', 'hhhh', '', '', '', '', '', '', '', '', '', '', 'Yes', '554548995656', 'SSLC-CERTA-2026-00004.pdf', 'HSC-CERTA-2026-00004.pdf', NULL, 'TC-CERTA-2026-00004.pdf', 'MIGRATION-CERTA-2026-00004.pdf', 'UNDERTAKING-CERTA-2026-00004.pdf', NULL, '2026-03-04 10:08:04', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'okey', 'admin', '2026-03-04 15:39:26', 'A26101CST6001', NULL, NULL),
(64, 'UGA-2026-00035', 'UG', 'Communicative English', 'B.A', 'French', 'english', NULL, NULL, 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Kallakurichi', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 4444', 'INDIAN', 'HINDU', 'Tamil', 'O+', 'ST', 'e', 'no', NULL, 'No', '', 0, 0, 'edasd', 'ddadde', '', '', '', '', '', '', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00035.pdf', 'HSC-UGA-2026-00035.pdf', NULL, 'TC-UGA-2026-00035.pdf', 'MIGRATION-UGA-2026-00035.pdf', 'UNDERTAKING-UGA-2026-00035.pdf', NULL, '2026-03-04 10:15:42', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'dsasd', 'admin', '2026-03-04 15:46:36', 'A26101UFR6001', NULL, NULL),
(65, 'PGA-2026-00015', 'PG', NULL, 'M.Com', 'Commerce', 'english', NULL, NULL, 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Kallakurichi', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 4444', 'INDIAN', ' bvcd', 'Tamil', 'B-', 'ST', 'Adi Dravidar', 'no', NULL, 'No', '', 0, 0, 'nvgv', '', '', '', '', '', 'jhghj', '', '', '', '', '', 'No', '', 'SSLC-PGA-2026-00015.pdf', 'HSC-PGA-2026-00015.pdf', 'UG-PGA-2026-00015.pdf', 'TC-PGA-2026-00015.pdf', 'MIGRATION-PGA-2026-00015.pdf', 'UNDERTAKING-PGA-2026-00015.pdf', NULL, '2026-03-04 10:26:59', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'sx', 'admin', '2026-03-04 16:03:10', 'A26101PCM6002', NULL, NULL),
(66, 'UGA-2026-00036', 'UG', 'Communicative English', 'B.B.A', 'Business Administration', 'english', NULL, NULL, 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Dindigul', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-02', 17, 'Madhan', '4444 4444 4444', 'INDIAN', 'HINDU', 'TAMIL', 'O+', 'ST', 'devar', 'no', NULL, 'No', '', 0, 0, 'sA', '', '', '', '', '', '', '', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00036.pdf', 'HSC-UGA-2026-00036.pdf', NULL, 'TC-UGA-2026-00036.pdf', 'MIGRATION-UGA-2026-00036.pdf', 'UNDERTAKING-UGA-2026-00036.pdf', NULL, '2026-03-04 10:35:02', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'hghf', 'admin', '2026-03-04 16:07:06', 'A26101UBA6002', NULL, NULL),
(67, 'PGA-2026-00016', 'PG', NULL, 'M.A', 'Applied Saiva Siddhantha', 'english', NULL, NULL, 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Dharmapuri', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 4444', 'INDIAN', 'HINDU', 'TAMIL', 'O+', 'ST', 'ADI DRAVIDAR', 'no', NULL, 'No', '', 0, 0, 'xzzcx', 'xxzx', '', '', '', '', '', '', '', '', '', '', 'No', '', 'SSLC-PGA-2026-00016.pdf', 'HSC-PGA-2026-00016.pdf', 'UG-PGA-2026-00016.pdf', 'TC-PGA-2026-00016.pdf', 'MIGRATION-PGA-2026-00016.pdf', 'UNDERTAKING-PGA-2026-00016.pdf', NULL, '2026-03-04 10:54:47', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'zmxm', 'admin', '2026-03-04 16:26:08', 'A26101PSS6001', NULL, NULL),
(68, 'DIPA-2026-00008', 'DIP', NULL, 'Diploma', 'Police Administration', 'english', NULL, NULL, 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Kallakurichi', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 4444', 'INDIAN', ' bvcd', 'Tamil', 'O+', 'ST', 'devar', 'no', NULL, 'No', '', 0, 0, 'xnjnx', '', '', '', '', '', 'mnm', '', '', '', '', '', 'No', '', 'SSLC-DIPA-2026-00008.pdf', 'HSC-DIPA-2026-00008.pdf', NULL, 'TC-DIPA-2026-00008.pdf', 'MIGRATION-DIPA-2026-00008.pdf', 'UNDERTAKING-DIPA-2026-00008.pdf', NULL, '2026-03-04 10:57:30', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'zx', 'admin', '2026-03-04 16:28:40', 'A26101DPA6001', NULL, NULL),
(69, 'UGA-2026-00037', 'UG', 'Telugu', 'B.B.A', 'Business Administration', 'English', NULL, NULL, 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Krishnagiri', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 4444', 'INDIAN', 'HINDU', 'Tamil', 'O+', 'ST', 'wsxsd', 'no', NULL, 'No', '', 0, 0, 'mn', ',k', '', '', '', '', '', '', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00037.pdf', 'HSC-UGA-2026-00037.pdf', NULL, 'TC-UGA-2026-00037.pdf', 'MIGRATION-UGA-2026-00037.pdf', 'UNDERTAKING-UGA-2026-00037.pdf', NULL, '2026-03-04 11:11:41', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'Njm', 'admin', '2026-03-04 16:48:38', 'A26101UBA6003', NULL, NULL);
INSERT INTO `records` (`id`, `application_no`, `course_type`, `foundation_lang`, `programme_name`, `main_subject`, `medium`, `differently_abled`, `photo`, `name`, `street`, `town`, `state`, `district`, `pincode`, `phone`, `mobile`, `name_english`, `name_tamil`, `dob`, `age`, `guardian_name`, `aadhaar`, `nationality`, `religion`, `mother_tongue`, `blood_group`, `community`, `caste`, `employment_status`, `employment_type`, `other_course`, `other_course_details`, `defence_personnel`, `ex_servicemen`, `sslc_school`, `sslc_board`, `sslc_pass_year`, `sslc_reg_no`, `sslc_grade`, `sslc_max_marks`, `hsc_school`, `hsc_board`, `hsc_pass_year`, `hsc_reg_no`, `hsc_grade`, `hsc_max_marks`, `abc_status`, `abc_id`, `sslc_file`, `hsc_file`, `ug_file`, `tc_file`, `migration_file`, `undertaking_file`, `enclosures`, `created_at`, `dip_school`, `dip_board`, `dip_pass_year`, `dip_reg_no`, `dip_grade`, `dip_max_marks`, `ug_school`, `ug_board`, `ug_pass_year`, `ug_reg_no`, `ug_grade`, `ug_max_marks`, `mother_name`, `email`, `defence_ward`, `status`, `staff_remark`, `processed_by`, `processed_at`, `enrollment_no`, `course_code`, `course_id`) VALUES
(70, 'PGA-2026-00017', 'PG', NULL, 'M.A', 'Historical Studies', 'english', NULL, NULL, 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Mayiladuthurai', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 4444', 'INDIAN', ' bvcd', 'French', 'O-', 'ST', 'dfghjk', 'no', NULL, 'No', '', 0, 0, 'cz', 'zc', '', '', '', '', '', '', '', '', '', '', 'No', '', 'SSLC-PGA-2026-00017.pdf', 'HSC-PGA-2026-00017.pdf', 'UG-PGA-2026-00017.pdf', 'TC-PGA-2026-00017.pdf', 'MIGRATION-PGA-2026-00017.pdf', 'UNDERTAKING-PGA-2026-00017.pdf', NULL, '2026-03-04 11:13:29', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'njmnxz', 'admin', '2026-03-04 16:49:01', 'A26101PHS6001', NULL, NULL),
(71, 'UGA-2026-00038', 'UG', 'French', 'B.B.A', 'Business Administration', 'english', NULL, NULL, 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Select District', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 4422', 'INDIAN', 'HINDU', 'AAX', 'O-', 'SC', 'sdfgm', 'no', NULL, 'No', '', 0, 0, 'szssd', 'sdasd', '', '', '', '', 'sds', 'ssa', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00038.pdf', 'HSC-UGA-2026-00038.pdf', NULL, 'TC-UGA-2026-00038.pdf', 'MIGRATION-UGA-2026-00038.pdf', 'UNDERTAKING-UGA-2026-00038.pdf', NULL, '2026-03-06 02:15:56', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'df', 'admin', '2026-03-06 07:49:07', 'A26101UBA6007', NULL, NULL),
(72, 'PGA-2026-00018', 'PG', NULL, 'M.Com', 'Commerce', 'english', NULL, NULL, 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Namakkal', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-02', 17, 'Madhan', '4444 4444 4444', 'INDIAN', 'HINDU', 'French', 'O+', 'ST', 'sdfgm', 'no', NULL, 'No', '', 0, 0, 'sx', '', '', '', '', '', 'sx', '', '', '', '', '', 'No', '', 'SSLC-PGA-2026-00018.pdf', 'HSC-PGA-2026-00018.pdf', 'UG-PGA-2026-00018.pdf', 'TC-PGA-2026-00018.pdf', 'MIGRATION-PGA-2026-00018.pdf', 'UNDERTAKING-PGA-2026-00018.pdf', NULL, '2026-03-06 02:17:55', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'scsc', 'admin', '2026-03-06 07:49:25', 'A26101PCM6008', NULL, NULL),
(73, 'UGA-2026-00039', 'UG', 'Communicative English', 'B.Sc', 'Mathematics', 'tamil', NULL, NULL, 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Kanchipuram', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-03', 17, 'Madhan', '4444 4444 4444', 'INDIAN', 'HINDU', 'TAMIL', 'O+', 'ST', 'ADI DRAVIDAR', 'no', NULL, 'No', '', 0, 0, 'scSX', 'sasd', '', '', '', '', 'ss', '', '', '', '', '', 'No', '', 'SSLC-UGA-2026-00039.pdf', 'HSC-UGA-2026-00039.pdf', NULL, 'TC-UGA-2026-00039.pdf', 'MIGRATION-UGA-2026-00039.pdf', 'UNDERTAKING-UGA-2026-00039.pdf', NULL, '2026-03-06 02:20:39', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'xzxZ', 'admin', '2026-03-06 07:52:00', 'A26101UMA5004', NULL, NULL),
(74, 'CERTA-2026-00005', 'CERT', NULL, 'Certificate', 'Indian Christianity', 'english', NULL, NULL, 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Nagapattinam', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 4444', 'INDIAN', 'HINDU', 'TAMIL', 'O+', 'ST', 'Adi Dravidar', 'no', NULL, 'No', '', 0, 0, 'tttt', 't4', '', '', '', '', '', '', '', '', '', '', 'No', '', 'SSLC-CERTA-2026-00005.pdf', 'HSC-CERTA-2026-00005.pdf', NULL, 'TC-CERTA-2026-00005.pdf', 'MIGRATION-CERTA-2026-00005.pdf', 'UNDERTAKING-CERTA-2026-00005.pdf', NULL, '2026-03-06 02:28:02', '', '', '', '', '', '', '', '', '', '', '', '', 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'trgg', 'admin', '2026-03-06 07:59:08', 'A26101CIC6010', NULL, NULL),
(75, 'DIPA-2026-00009', 'DIP', NULL, 'Diploma', 'Management', 'english', NULL, NULL, 'Hemanath M', 'Ponneri', 'Chennai', '23', 'Krishnagiri', '601204', '9790817040', '9790817040', 'Hemanath M', 'ஹேமந்த் ம்', '2009-03-01', 17, 'Madhan', '4444 4444 4444', 'INDIAN', 'HINDU', 'TAMIL', 'O+', 'ST', 'ADI DRAVIDAR', 'no', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-06 09:07:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M RENUKA', 'hemanathmadhan@gmail.com', NULL, 'Approved', 'xc', 'admin', '2026-03-06 15:13:12', 'A26101DMG6011', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `state_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state_name`) VALUES
(1, 'Andhra Pradesh'),
(2, 'Arunachal Pradesh'),
(3, 'Assam'),
(4, 'Bihar'),
(5, 'Chhattisgarh'),
(6, 'Goa'),
(7, 'Gujarat'),
(8, 'Haryana'),
(9, 'Himachal Pradesh'),
(10, 'Jharkhand'),
(11, 'Karnataka'),
(12, 'Kerala'),
(13, 'Madhya Pradesh'),
(14, 'Maharashtra'),
(15, 'Manipur'),
(16, 'Meghalaya'),
(17, 'Mizoram'),
(18, 'Nagaland'),
(19, 'Odisha'),
(20, 'Punjab'),
(21, 'Rajasthan'),
(22, 'Sikkim'),
(23, 'Tamil Nadu'),
(24, 'Telangana'),
(25, 'Tripura'),
(26, 'Uttar Pradesh'),
(27, 'Uttarakhand'),
(28, 'West Bengal');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `course` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `mobile`, `email`, `level`, `course`) VALUES
(1, 'subithra', '9876543212', 'bpooja09102004@gmail.com', 'UG', 'B.B.A'),
(2, 'heman', '9989999999', 'hemanraj2713@gmail.com', 'PG', 'M.Sc Cyber Forensics and Information Security'),
(3, 'Hemanath', '9790817040', 'hemanraj2713@gmail.com', 'UG', 'B.A Tamil'),
(4, 'hr', '2222222222', 'hemanraj2713@gmail.com', 'UG', 'B.Sc Geography'),
(5, 'hemanath', '5555555555', 'hemaoffice153@gmail.com', 'PG', 'M.Com'),
(6, 'Hemanath', '9790817040', 'hemaoffice153@gmail.com', 'PG', 'M.A Sociology'),
(7, 'heman raj', '1313132131', 'hemanraj2713@gmail.com', 'UG', 'B.Sc Mathematics'),
(8, 'hg', '8888888888', 'unom@gmail.com', 'PG', 'M.Sc Cyber Forensics and Information Security'),
(9, 'Heman', '8888888888', 'hema@gmail.com', 'PG', 'M.Sc Information Technology'),
(10, 'hemanath', '9876543210', 'subi@gmail.com', 'UG', 'B.C.A'),
(11, 'hemanath', '9876543210', 'subi21@gmail.com', 'Diploma', 'Diploma in Yoga'),
(12, 'hemanath', '9876543210', 'subi2@gmail.com', 'Diploma', 'Diploma in Yoga'),
(13, 'hemanath', '9876543210', 'subi22@gmail.com', 'UG', 'B.F.A Music'),
(14, 'Hemanath', '9790817040', 'hema13456@gmail.com', 'UG', 'B.Com Bank Management'),
(15, 'Naresh', '9790817040', 'hemanathmadhan@gmail.com', 'Certificate', 'Certificate in Karnatic Music');

-- --------------------------------------------------------

--
-- Table structure for table `ug_courses`
--

CREATE TABLE `ug_courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `medium` varchar(50) DEFAULT NULL,
  `eligibility` text DEFAULT NULL,
  `programme_degree` varchar(50) DEFAULT NULL,
  `main_subject` varchar(100) DEFAULT NULL,
  `course_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ug_courses`
--

INSERT INTO `ug_courses` (`id`, `course_name`, `duration`, `medium`, `eligibility`, `programme_degree`, `main_subject`, `course_code`) VALUES
(1, 'B.A Tamil', '3 Years', 'Tamil', '*Pass in 10+2 / Higher Secondary    \r\nExamination from a recognized Board.\r\n\r\n*CBSE / ICSE / NIOS candidates are eligible.\r\n\r\n*Diploma holders (after 10th) are eligible.\r\n\r\n*Equivalent examinations recognized by the University are also eligible.', 'B.A', 'Tamil', 'UTL'),
(2, 'B.A Literature in Tamil', '3 Years', 'Tamil', '*Pass in 10+2 / Higher Secondary    \r\nExamination from a recognized Board.\r\n\r\n*CBSE / ICSE / NIOS candidates are eligible.\r\n\r\n*Diploma holders (after 10th) are eligible.\r\n\r\n*Equivalent examinations recognized by the University are also eligible.', 'B.A', 'Literature in Tamil', 'ULT'),
(3, 'B.A French', '3 Years', 'English', '*Pass in 10+2 / Higher Secondary Examination from a recognized Board.\r\n\r\n*Candidates with French as a subject in school will be preferred.\r\n\r\n*Candidates without prior knowledge of French may also apply, subject to compulsory Foundation Course in French.', 'B.A', 'French', 'UFR'),
(4, 'B.A English', '3 Years', 'English', '*Pass in 10+2 / Higher Secondary    \r\nExamination from a recognized Board.\r\n\r\n*CBSE / ICSE / NIOS candidates are eligible.\r\n\r\n*Diploma holders (after 10th) are eligible.\r\n\r\n*Equivalent examinations recognized by the University are also eligible.', 'B.A', 'English', 'UEN'),
(5, 'B.A Economics', '3 Years', 'English & Tamil', '*Pass in 10+2 / Higher Secondary    \r\nExamination from a recognized Board.\r\n\r\n*CBSE / ICSE / NIOS candidates are eligible.\r\n\r\n*Diploma holders (after 10th) are eligible.\r\n\r\n*Equivalent examinations recognized by the University are also eligible.', 'B.A', 'Economics', 'UEC'),
(6, 'B.A Historical Studies', '3 Years', 'English & Tamil', '*Pass in 10+2 / Higher Secondary    \r\nExamination from a recognized Board.\r\n\r\n*CBSE / ICSE / NIOS candidates are eligible.\r\n\r\n*Diploma holders (after 10th) are eligible.\r\n\r\n*Equivalent examinations recognized by the University are also eligible.', 'B.A', 'Historical Studies', 'UHS'),
(7, 'B.A Sociology', '3 Years', 'English', '*Pass in 10+2 / Higher Secondary    \r\nExamination from a recognized Board.\r\n\r\n*CBSE / ICSE / NIOS candidates are eligible.\r\n\r\n*Diploma holders (after 10th) are eligible.\r\n\r\n*Equivalent examinations recognized by the University are also eligible.', 'B.A', 'Sociology', 'USL'),
(8, 'B.A Public Administration', '3 Years', 'English & Tamil', '*Pass in 10+2 / Higher Secondary    \r\nExamination from a recognized Board.\r\n\r\n*CBSE / ICSE / NIOS candidates are eligible.\r\n\r\n*Diploma holders (after 10th) are eligible.\r\n\r\n*Equivalent examinations recognized by the University are also eligible.', 'B.A', 'Public Administration', 'UPA'),
(9, 'B.A Criminology and Police Administration', '3 Years', 'English', '*Pass in 10+2 / Higher Secondary    \r\nExamination from a recognized Board.\r\n\r\n*CBSE / ICSE / NIOS candidates are eligible.\r\n\r\n*Diploma holders (after 10th) are eligible.\r\n\r\n*Equivalent examinations recognized by the University are also eligible.', 'B.A', 'Criminology and Police Administration', 'UCP'),
(10, 'B.Com (General)', '3 Years', 'English', '*Pass in 10+2 / Higher Secondary    \r\nExamination from a recognized Board.\r\n\r\n*CBSE / ICSE / NIOS candidates are eligible.\r\n\r\n*Diploma holders (after 10th) are eligible.\r\n\r\n*Equivalent examinations recognized by the University are also eligible.', 'B.Com', 'General', 'UCM'),
(11, 'B.Com Bank Management', '3 Years', 'English & Tamil', '*Pass in 10+2 / Higher Secondary    \r\nExamination from a recognized Board.\r\n\r\n*CBSE / ICSE / NIOS candidates are eligible.\r\n\r\n*Diploma holders (after 10th) are eligible.\r\n\r\n*Equivalent examinations recognized by the University are also eligible.', 'B.Com', 'Bank Management', 'UBT'),
(12, 'B.B.A', '3 Years', 'English & Tamil', '*Pass in 10+2 / Higher Secondary    \r\nExamination from a recognized Board.\r\n\r\n*CBSE / ICSE / NIOS candidates are eligible.\r\n\r\n*Diploma holders (after 10th) are eligible.\r\n\r\n*Equivalent examinations recognized by the University are also eligible.', 'B.B.A', 'Business Administration', 'UBA'),
(13, 'B.Sc Mathematics', '3 Years', 'English', '*Pass in 10+2 / Higher Secondary    \r\nExamination from a recognized Board.\r\n\r\n*CBSE / ICSE / NIOS candidates are eligible.\r\n\r\n*Diploma holders (after 10th) are eligible.\r\n\r\n*Equivalent examinations recognized by the University are also eligible.', 'B.Sc', 'Mathematics', 'UMA'),
(14, 'B.Sc Psychology', '3 Years', 'English', '*Pass in 10+2 / Higher Secondary    \r\nExamination from a recognized Board.\r\n\r\n*CBSE / ICSE / NIOS candidates are eligible.\r\n\r\n*Diploma holders (after 10th) are eligible.\r\n\r\n*Equivalent examinations recognized by the University are also eligible.', 'B.Sc', 'Psychology', 'UPY'),
(15, 'B.Sc Geography', '3 Years', 'English', '*Pass in 10+2 / Higher Secondary    \r\nExamination from a recognized Board.\r\n\r\n*CBSE / ICSE / NIOS candidates are eligible.\r\n\r\n*Diploma holders (after 10th) are eligible.\r\n\r\n*Equivalent examinations recognized by the University are also eligible.', 'B.Sc', 'Geography', 'UGE'),
(16, 'B.C.A', '3 Years', 'English', '*Pass in 10+2 / Higher Secondary    \r\nExamination from a recognized Board.\r\n\r\n*CBSE / ICSE / NIOS candidates are eligible.\r\n\r\n*Diploma holders (after 10th) are eligible.\r\n\r\n*Equivalent examinations recognized by the University are also eligible.', 'B.C.A', 'Computer Applications', 'UCA'),
(17, 'B.F.A Music', '3 Years', 'English & Tamil', '', 'B.F.A', 'Music', 'UMU');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `is_verified` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `otp_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `otp`, `is_verified`, `created_at`, `otp_expires_at`) VALUES
(5, 'bpooja09102004@gmail.com', '', NULL, 1, '2026-02-03 10:04:07', '2026-02-03 11:09:07'),
(12, 'hemanraj2713@gmail.com', '$2y$10$fNW/MlzEaeUraRgZ3ikIluVd6Y36UYFWQ2NaMP4/5BFD3XBVsRUrK', NULL, 1, '2026-02-10 11:11:18', '2026-02-10 12:16:18'),
(13, 'unom@gmail.com', '$2y$10$UkaCAsdijnK0h2FFUTBQ0OC2uRzRNx9GwG/UR1EXQcY7b8RKbzHtO', NULL, 1, '2026-02-11 06:26:07', '2026-02-11 07:31:07'),
(14, 'hema@gmail.com', '$2y$10$1DDmQeLFQZu5KP2w88WAgeW1BV8WM1GDVwGTB1eGbicrvebYN9Rw6', '751252', 1, '2026-02-11 09:51:42', '2026-02-11 11:09:11'),
(16, 'subi@gmail.com', '$2y$10$Qo25.Vv9x/oROHnCTbUQJuJfOyRFGIoRH29BXFT4tdpiFzPNwX2D2', NULL, 1, '2026-02-16 06:42:39', '2026-02-16 07:47:39'),
(17, 'subi21@gmail.com', '$2y$10$yjHUaKu3/qIA5.stTsc4zOR9tMRG8ra7f2rABRsxey4ckBrTWfXTu', NULL, 1, '2026-02-18 08:34:17', '2026-02-18 09:39:17'),
(18, 'subi2@gmail.com', '$2y$10$/vSxLL1a8ezVIlmU7qrmQuqMr5lOUQKbhpXweC/5dxKkKNswN4yzq', NULL, 1, '2026-02-18 08:38:54', '2026-02-18 09:43:54'),
(19, 'subi22@gmail.com', '$2y$10$oNPz.S5MvIpMzak6qQGce.KEVZ4gaT/NyDAdg4moApxYs7.6QJ1VO', NULL, 1, '2026-02-18 09:42:26', '2026-02-18 10:47:26'),
(20, 'hema13456@gmail.com', '$2y$10$QJqT07TVMj0hxcljrY11H.r5juMiFGcgbQ3BuBGyPDN1kmVxdhd2O', NULL, 1, '2026-02-19 08:51:08', '2026-02-19 09:56:08'),
(21, 'hemanathmadhan@gmail.com', '$2y$10$xF15TeTVIElkSSsEJ0ccOefOxvoA0HSeC6vi5bNqY3ospuQY.Zlp.', NULL, 1, '2026-03-04 05:20:59', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `caste_master`
--
ALTER TABLE `caste_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificate_courses`
--
ALTER TABLE `certificate_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diploma_courses`
--
ALTER TABLE `diploma_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `document_uploads`
--
ALTER TABLE `document_uploads`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `pg_courses`
--
ALTER TABLE `pg_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `application_no` (`application_no`),
  ADD KEY `fk_course` (`course_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ug_courses`
--
ALTER TABLE `ug_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `caste_master`
--
ALTER TABLE `caste_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `certificate_courses`
--
ALTER TABLE `certificate_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `diploma_courses`
--
ALTER TABLE `diploma_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=665;

--
-- AUTO_INCREMENT for table `pg_courses`
--
ALTER TABLE `pg_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ug_courses`
--
ALTER TABLE `ug_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `fk_course` FOREIGN KEY (`course_id`) REFERENCES `ug_courses` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
