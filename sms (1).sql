-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2024 at 01:11 PM
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
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` varchar(50) DEFAULT NULL,
  `attendance_date` date NOT NULL,
  `status` enum('Present','Absent','Late','Excused') NOT NULL,
  `course` varchar(100) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `semester_year` varchar(20) DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `student_id`, `attendance_date`, `status`, `course`, `section`, `semester_year`, `remarks`) VALUES
(1, 'S12345', '2024-09-11', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Fall 2023', NULL),
(2, 'S12346', '2024-09-11', 'Present', 'Bachelor of Arts in English', 'Evening', 'Fall 2023', NULL),
(3, 'S12347', '2024-09-11', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024', NULL),
(4, 'S12348', '2024-09-11', 'Present', 'Master of Business Administration', 'Evening', 'Fall 2023', NULL),
(5, 'S12349', '2024-09-11', 'Present', 'Bachelor of Science in Mathematics', 'Morning', 'Spring 2024', NULL),
(6, 'S12350', '2024-09-11', 'Present', 'Master of Science in Data Science', 'Evening', 'Fall 2023', NULL),
(7, 'S12351', '2024-09-11', 'Present', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024', NULL),
(8, 'S12352', '2024-09-11', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(9, 'S12353', '2024-09-11', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(10, 'S12354', '2024-09-11', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(11, 'S12355', '2024-09-11', 'Present', 'Bachelor of Arts in History', 'Morning', 'Spring 2024', NULL),
(12, 'S12356', '2024-09-11', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(13, 'S12357', '2024-09-11', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(14, 'S12358', '2024-09-11', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(15, 'S12359', '2024-09-11', 'Present', 'Bachelor of Science in Mathematics', 'Morning', 'Spring 2024', NULL),
(16, 'S12360', '2024-09-11', 'Present', 'Master of Business Administration', 'Evening', 'Fall 2023', NULL),
(17, 'S12361', '2024-09-11', 'Present', 'Bachelor of Arts in English', 'Morning', 'Spring 2024', NULL),
(18, 'S12362', '2024-09-11', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(19, 'S12363', '2024-09-11', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(20, 'S12364', '2024-09-11', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(21, 'S12365', '2024-09-11', 'Present', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024', NULL),
(22, 'S12366', '2024-09-11', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(23, 'S12367', '2024-09-11', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(24, 'S12368', '2024-09-11', 'Present', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023', NULL),
(25, 'S12369', '2024-09-11', 'Present', 'Master of Business Administration', 'Morning', 'Spring 2024', NULL),
(26, 'S12370', '2024-09-11', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(27, 'S12371', '2024-09-11', 'Present', 'Bachelor of Arts in History', 'Morning', 'Spring 2024', NULL),
(28, 'S12372', '2024-09-11', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(29, 'S12373', '2024-09-11', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(30, 'S12374', '2024-09-11', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(31, 'S12375', '2024-09-11', 'Present', 'Bachelor of Arts in English', 'Morning', 'Spring 2024', NULL),
(32, 'S12376', '2024-09-11', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(33, 'S12377', '2024-09-11', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(34, 'S12378', '2024-09-11', 'Present', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023', NULL),
(35, 'S12379', '2024-09-11', 'Present', 'Bachelor of Science in Biology', 'Morning', 'Spring 2024', NULL),
(36, 'S12380', '2024-09-11', 'Present', 'Master of Business Administration', 'Evening', 'Fall 2023', NULL),
(37, 'S12381', '2024-09-11', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024', NULL),
(38, 'S12382', '2024-09-11', 'Present', 'Bachelor of Arts in Psychology', 'Evening', 'Fall 2023', NULL),
(39, 'S12383', '2024-09-11', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(40, 'S12384', '2024-09-11', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(41, 'S12385', '2024-09-11', 'Present', 'Bachelor of Arts in History', 'Morning', 'Spring 2024', NULL),
(42, 'S12386', '2024-09-11', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(43, 'S12387', '2024-09-11', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(44, 'S12388', '2024-09-11', 'Present', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023', NULL),
(45, 'S12389', '2024-09-11', 'Present', 'Master of Business Administration', 'Morning', 'Spring 2024', NULL),
(46, 'S12390', '2024-09-11', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(47, 'S12391', '2024-09-11', 'Present', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024', NULL),
(48, 'S12392', '2024-09-11', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(49, 'S12393', '2024-09-11', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(50, 'S12394', '2024-09-11', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(51, 'S12401', '2024-09-11', 'Present', 'Bachelor of Arts in Philosophy', 'Morning', 'Fall 2023', NULL),
(52, 'S12402', '2024-09-11', 'Present', 'Master of Science in Chemistry', 'Evening', 'Fall 2023', NULL),
(53, 'S12403', '2024-09-11', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024', NULL),
(54, 'S12404', '2024-09-11', 'Present', 'Bachelor of Arts in History', 'Evening', 'Fall 2023', NULL),
(55, 'S12405', '2024-09-11', 'Present', 'Master of Business Administration', 'Morning', 'Spring 2024', NULL),
(56, 'S12406', '2024-09-11', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(57, 'S12407', '2024-09-11', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(58, 'S12408', '2024-09-11', 'Present', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023', NULL),
(59, 'S12409', '2024-09-11', 'Present', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024', NULL),
(60, 'S12410', '2024-09-11', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(61, 'S12411', '2024-09-11', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(62, 'S12412', '2024-09-11', 'Present', 'Bachelor of Science in Chemistry', 'Evening', 'Fall 2023', NULL),
(63, 'S12413', '2024-09-11', 'Present', 'Bachelor of Arts in Sociology', 'Morning', 'Spring 2024', NULL),
(64, 'S12414', '2024-09-11', 'Present', 'Bachelor of Science in Physics', 'Evening', 'Fall 2023', NULL),
(65, 'S12415', '2024-09-11', 'Present', 'Master of Business Administration', 'Morning', 'Spring 2024', NULL),
(66, 'S12416', '2024-09-11', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(67, 'S12417', '2024-09-11', 'Present', 'Bachelor of Arts in Political Science', 'Morning', 'Spring 2024', NULL),
(68, 'S12418', '2024-09-11', 'Present', 'Master of Science in Data Science', 'Evening', 'Fall 2023', NULL),
(69, 'S12419', '2024-09-11', 'Present', 'Bachelor of Science in Biology', 'Morning', 'Spring 2024', NULL),
(70, 'S12420', '2024-09-11', 'Present', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023', NULL),
(71, 'S12421', '2024-09-11', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(72, 'S12422', '2024-09-11', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(73, 'S12423', '2024-09-11', 'Present', 'Bachelor of Science in Chemistry', 'Morning', 'Spring 2024', NULL),
(74, 'S12424', '2024-09-11', 'Present', 'Bachelor of Arts in Sociology', 'Evening', 'Fall 2023', NULL),
(75, 'S12425', '2024-09-11', 'Present', 'Bachelor of Science in Physics', 'Morning', 'Spring 2024', NULL),
(76, 'S12426', '2024-09-11', 'Present', 'Master of Business Administration', 'Evening', 'Fall 2023', NULL),
(77, 'S12427', '2024-09-11', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024', NULL),
(78, 'S12428', '2024-09-11', 'Present', 'Bachelor of Arts in Political Science', 'Evening', 'Fall 2023', NULL),
(79, 'S12429', '2024-09-11', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(80, 'S12430', '2024-09-11', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(81, 'S12431', '2024-09-11', 'Present', 'Bachelor of Science in Mathematics', 'Morning', 'Spring 2024', NULL),
(82, 'S12432', '2024-09-11', 'Present', 'Master of Arts in Literature', 'Evening', 'Fall 2023', NULL),
(83, 'S12433', '2024-09-11', 'Present', 'Bachelor of Science in Computer Engineering', 'Morning', 'Spring 2024', NULL),
(84, 'S12434', '2024-09-11', 'Present', 'Bachelor of Science in Chemistry', 'Evening', 'Fall 2023', NULL),
(85, 'S12435', '2024-09-11', 'Present', 'Bachelor of Arts in Sociology', 'Morning', 'Spring 2024', NULL),
(86, 'S12436', '2024-09-11', 'Present', 'Bachelor of Science in Physics', 'Evening', 'Fall 2023', NULL),
(87, 'S12437', '2024-09-11', 'Present', 'Master of Business Administration', 'Morning', 'Spring 2024', NULL),
(88, 'S12438', '2024-09-11', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(89, 'S12439', '2024-09-11', 'Present', 'Bachelor of Arts in Political Science', 'Morning', 'Spring 2024', NULL),
(90, 'S12440', '2024-09-11', 'Present', 'Master of Science in Data Science', 'Evening', 'Fall 2023', NULL),
(91, 'S12441', '2024-09-11', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Fall 2023', NULL),
(92, 'S12442', '2024-09-11', 'Present', 'Bachelor of Arts in History', 'Evening', 'Spring 2024', NULL),
(93, 'S12443', '2024-09-11', 'Present', 'Bachelor of Science in Physics', 'Morning', 'Fall 2023', NULL),
(94, 'S12444', '2024-09-11', 'Present', 'Master of Science in Data Science', 'Evening', 'Spring 2024', NULL),
(95, 'S12445', '2024-09-11', 'Present', 'Bachelor of Arts in Political Science', 'Morning', 'Fall 2023', NULL),
(96, 'S12446', '2024-09-11', 'Present', 'Master of Business Administration', 'Evening', 'Spring 2024', NULL),
(97, 'S12447', '2024-09-11', 'Present', 'Bachelor of Science in Mathematics', 'Morning', 'Fall 2023', NULL),
(98, 'S12448', '2024-09-11', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Spring 2024', NULL),
(99, 'S12449', '2024-09-11', 'Present', 'Bachelor of Science in Biology', 'Morning', 'Fall 2023', NULL),
(100, 'S12450', '2024-09-11', 'Present', 'Bachelor of Arts in Philosophy', 'Evening', 'Spring 2024', NULL),
(101, 'S12451', '2024-09-11', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Fall 2023', NULL),
(102, 'S12452', '2024-09-11', 'Present', 'Bachelor of Arts in Literature', 'Evening', 'Spring 2024', NULL),
(103, 'S12345', '2024-09-26', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Fall 2023', NULL),
(104, 'S12346', '2024-09-26', 'Present', 'Bachelor of Arts in English', 'Evening', 'Fall 2023', NULL),
(105, 'S12347', '2024-09-26', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024', NULL),
(106, 'S12348', '2024-09-26', 'Present', 'Master of Business Administration', 'Evening', 'Fall 2023', NULL),
(107, 'S12349', '2024-09-26', 'Present', 'Bachelor of Science in Mathematics', 'Morning', 'Spring 2024', NULL),
(108, 'S12350', '2024-09-26', 'Present', 'Master of Science in Data Science', 'Evening', 'Fall 2023', NULL),
(109, 'S12351', '2024-09-26', 'Present', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024', NULL),
(110, 'S12352', '2024-09-26', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(111, 'S12353', '2024-09-26', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(112, 'S12354', '2024-09-26', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(113, 'S12355', '2024-09-26', 'Present', 'Bachelor of Arts in History', 'Morning', 'Spring 2024', NULL),
(114, 'S12356', '2024-09-26', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(115, 'S12357', '2024-09-26', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(116, 'S12358', '2024-09-26', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(117, 'S12359', '2024-09-26', 'Present', 'Bachelor of Science in Mathematics', 'Morning', 'Spring 2024', NULL),
(118, 'S12360', '2024-09-26', 'Present', 'Master of Business Administration', 'Evening', 'Fall 2023', NULL),
(119, 'S12361', '2024-09-26', 'Present', 'Bachelor of Arts in English', 'Morning', 'Spring 2024', NULL),
(120, 'S12362', '2024-09-26', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(121, 'S12363', '2024-09-26', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(122, 'S12364', '2024-09-26', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(123, 'S12365', '2024-09-26', 'Present', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024', NULL),
(124, 'S12366', '2024-09-26', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(125, 'S12367', '2024-09-26', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(126, 'S12368', '2024-09-26', 'Present', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023', NULL),
(127, 'S12369', '2024-09-26', 'Present', 'Master of Business Administration', 'Morning', 'Spring 2024', NULL),
(128, 'S12370', '2024-09-26', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(129, 'S12371', '2024-09-26', 'Present', 'Bachelor of Arts in History', 'Morning', 'Spring 2024', NULL),
(130, 'S12372', '2024-09-26', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(131, 'S12373', '2024-09-26', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(132, 'S12374', '2024-09-26', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(133, 'S12375', '2024-09-26', 'Present', 'Bachelor of Arts in English', 'Morning', 'Spring 2024', NULL),
(134, 'S12376', '2024-09-26', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(135, 'S12377', '2024-09-26', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(136, 'S12378', '2024-09-26', 'Present', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023', NULL),
(137, 'S12379', '2024-09-26', 'Present', 'Bachelor of Science in Biology', 'Morning', 'Spring 2024', NULL),
(138, 'S12380', '2024-09-26', 'Present', 'Master of Business Administration', 'Evening', 'Fall 2023', NULL),
(139, 'S12381', '2024-09-26', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024', NULL),
(140, 'S12382', '2024-09-26', 'Present', 'Bachelor of Arts in Psychology', 'Evening', 'Fall 2023', NULL),
(141, 'S12383', '2024-09-26', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(142, 'S12384', '2024-09-26', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(143, 'S12385', '2024-09-26', 'Present', 'Bachelor of Arts in History', 'Morning', 'Spring 2024', NULL),
(144, 'S12386', '2024-09-26', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(145, 'S12387', '2024-09-26', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(146, 'S12388', '2024-09-26', 'Present', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023', NULL),
(147, 'S12389', '2024-09-26', 'Present', 'Master of Business Administration', 'Morning', 'Spring 2024', NULL),
(148, 'S12390', '2024-09-26', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(149, 'S12391', '2024-09-26', 'Present', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024', NULL),
(150, 'S12392', '2024-09-26', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(151, 'S12393', '2024-09-26', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(152, 'S12394', '2024-09-26', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(153, 'S12401', '2024-09-26', 'Present', 'Bachelor of Arts in Philosophy', 'Morning', 'Fall 2023', NULL),
(154, 'S12402', '2024-09-26', 'Present', 'Master of Science in Chemistry', 'Evening', 'Fall 2023', NULL),
(155, 'S12403', '2024-09-26', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024', NULL),
(156, 'S12404', '2024-09-26', 'Present', 'Bachelor of Arts in History', 'Evening', 'Fall 2023', NULL),
(157, 'S12405', '2024-09-26', 'Present', 'Master of Business Administration', 'Morning', 'Spring 2024', NULL),
(158, 'S12406', '2024-09-26', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(159, 'S12407', '2024-09-26', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(160, 'S12408', '2024-09-26', 'Present', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023', NULL),
(161, 'S12409', '2024-09-26', 'Present', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024', NULL),
(162, 'S12410', '2024-09-26', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(163, 'S12411', '2024-09-26', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(164, 'S12412', '2024-09-26', 'Present', 'Bachelor of Science in Chemistry', 'Evening', 'Fall 2023', NULL),
(165, 'S12413', '2024-09-26', 'Present', 'Bachelor of Arts in Sociology', 'Morning', 'Spring 2024', NULL),
(166, 'S12414', '2024-09-26', 'Present', 'Bachelor of Science in Physics', 'Evening', 'Fall 2023', NULL),
(167, 'S12415', '2024-09-26', 'Present', 'Master of Business Administration', 'Morning', 'Spring 2024', NULL),
(168, 'S12416', '2024-09-26', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(169, 'S12417', '2024-09-26', 'Present', 'Bachelor of Arts in Political Science', 'Morning', 'Spring 2024', NULL),
(170, 'S12418', '2024-09-26', 'Present', 'Master of Science in Data Science', 'Evening', 'Fall 2023', NULL),
(171, 'S12419', '2024-09-26', 'Present', 'Bachelor of Science in Biology', 'Morning', 'Spring 2024', NULL),
(172, 'S12420', '2024-09-26', 'Present', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023', NULL),
(173, 'S12421', '2024-09-26', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(174, 'S12422', '2024-09-26', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(175, 'S12423', '2024-09-26', 'Present', 'Bachelor of Science in Chemistry', 'Morning', 'Spring 2024', NULL),
(176, 'S12424', '2024-09-26', 'Present', 'Bachelor of Arts in Sociology', 'Evening', 'Fall 2023', NULL),
(177, 'S12425', '2024-09-26', 'Present', 'Bachelor of Science in Physics', 'Morning', 'Spring 2024', NULL),
(178, 'S12426', '2024-09-26', 'Present', 'Master of Business Administration', 'Evening', 'Fall 2023', NULL),
(179, 'S12427', '2024-09-26', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024', NULL),
(180, 'S12428', '2024-09-26', 'Present', 'Bachelor of Arts in Political Science', 'Evening', 'Fall 2023', NULL),
(181, 'S12429', '2024-09-26', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(182, 'S12430', '2024-09-26', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(183, 'S12431', '2024-09-26', 'Present', 'Bachelor of Science in Mathematics', 'Morning', 'Spring 2024', NULL),
(184, 'S12432', '2024-09-26', 'Present', 'Master of Arts in Literature', 'Evening', 'Fall 2023', NULL),
(185, 'S12433', '2024-09-26', 'Present', 'Bachelor of Science in Computer Engineering', 'Morning', 'Spring 2024', NULL),
(186, 'S12434', '2024-09-26', 'Present', 'Bachelor of Science in Chemistry', 'Evening', 'Fall 2023', NULL),
(187, 'S12435', '2024-09-26', 'Present', 'Bachelor of Arts in Sociology', 'Morning', 'Spring 2024', NULL),
(188, 'S12436', '2024-09-26', 'Present', 'Bachelor of Science in Physics', 'Evening', 'Fall 2023', NULL),
(189, 'S12437', '2024-09-26', 'Present', 'Master of Business Administration', 'Morning', 'Spring 2024', NULL),
(190, 'S12438', '2024-09-26', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(191, 'S12439', '2024-09-26', 'Present', 'Bachelor of Arts in Political Science', 'Morning', 'Spring 2024', NULL),
(192, 'S12440', '2024-09-26', 'Present', 'Master of Science in Data Science', 'Evening', 'Fall 2023', NULL),
(193, 'S12441', '2024-09-26', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Fall 2023', NULL),
(194, 'S12442', '2024-09-26', 'Present', 'Bachelor of Arts in History', 'Evening', 'Spring 2024', NULL),
(195, 'S12443', '2024-09-26', 'Present', 'Bachelor of Science in Physics', 'Morning', 'Fall 2023', NULL),
(196, 'S12444', '2024-09-26', 'Present', 'Master of Science in Data Science', 'Evening', 'Spring 2024', NULL),
(197, 'S12445', '2024-09-26', 'Present', 'Bachelor of Arts in Political Science', 'Morning', 'Fall 2023', NULL),
(198, 'S12446', '2024-09-26', 'Present', 'Master of Business Administration', 'Evening', 'Spring 2024', NULL),
(199, 'S12447', '2024-09-26', 'Present', 'Bachelor of Science in Mathematics', 'Morning', 'Fall 2023', NULL),
(200, 'S12448', '2024-09-26', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Spring 2024', NULL),
(201, 'S12449', '2024-09-26', 'Present', 'Bachelor of Science in Biology', 'Morning', 'Fall 2023', NULL),
(202, 'S12450', '2024-09-26', 'Present', 'Bachelor of Arts in Philosophy', 'Evening', 'Spring 2024', NULL),
(203, 'S12451', '2024-09-26', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Fall 2023', NULL),
(204, 'S12452', '2024-09-26', 'Present', 'Bachelor of Arts in Literature', 'Evening', 'Spring 2024', NULL),
(208, 'S12345', '2024-09-20', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Fall 2023', NULL),
(209, 'S12346', '2024-09-20', 'Present', 'Bachelor of Arts in English', 'Evening', 'Fall 2023', NULL),
(210, 'S12347', '2024-09-20', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024', NULL),
(211, 'S12348', '2024-09-20', 'Present', 'Master of Business Administration', 'Evening', 'Fall 2023', NULL),
(212, 'S12349', '2024-09-20', 'Present', 'Bachelor of Science in Mathematics', 'Morning', 'Spring 2024', NULL),
(213, 'S12350', '2024-09-20', 'Present', 'Master of Science in Data Science', 'Evening', 'Fall 2023', NULL),
(214, 'S12351', '2024-09-20', 'Present', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024', NULL),
(215, 'S12352', '2024-09-20', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(216, 'S12353', '2024-09-20', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(217, 'S12354', '2024-09-20', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(218, 'S12355', '2024-09-20', 'Present', 'Bachelor of Arts in History', 'Morning', 'Spring 2024', NULL),
(219, 'S12356', '2024-09-20', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(220, 'S12357', '2024-09-20', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(221, 'S12358', '2024-09-20', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(222, 'S12359', '2024-09-20', 'Present', 'Bachelor of Science in Mathematics', 'Morning', 'Spring 2024', NULL),
(223, 'S12360', '2024-09-20', 'Present', 'Master of Business Administration', 'Evening', 'Fall 2023', NULL),
(224, 'S12361', '2024-09-20', 'Present', 'Bachelor of Arts in English', 'Morning', 'Spring 2024', NULL),
(225, 'S12362', '2024-09-20', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(226, 'S12363', '2024-09-20', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(227, 'S12364', '2024-09-20', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(228, 'S12365', '2024-09-20', 'Present', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024', NULL),
(229, 'S12366', '2024-09-20', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(230, 'S12367', '2024-09-20', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(231, 'S12368', '2024-09-20', 'Present', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023', NULL),
(232, 'S12369', '2024-09-20', 'Present', 'Master of Business Administration', 'Morning', 'Spring 2024', NULL),
(233, 'S12370', '2024-09-20', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(234, 'S12371', '2024-09-20', 'Present', 'Bachelor of Arts in History', 'Morning', 'Spring 2024', NULL),
(235, 'S12372', '2024-09-20', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(236, 'S12373', '2024-09-20', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(237, 'S12374', '2024-09-20', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(238, 'S12375', '2024-09-20', 'Present', 'Bachelor of Arts in English', 'Morning', 'Spring 2024', NULL),
(239, 'S12376', '2024-09-20', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(240, 'S12377', '2024-09-20', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(241, 'S12378', '2024-09-20', 'Present', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023', NULL),
(242, 'S12379', '2024-09-20', 'Present', 'Bachelor of Science in Biology', 'Morning', 'Spring 2024', NULL),
(243, 'S12380', '2024-09-20', 'Present', 'Master of Business Administration', 'Evening', 'Fall 2023', NULL),
(244, 'S12381', '2024-09-20', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024', NULL),
(245, 'S12382', '2024-09-20', 'Present', 'Bachelor of Arts in Psychology', 'Evening', 'Fall 2023', NULL),
(246, 'S12383', '2024-09-20', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(247, 'S12384', '2024-09-20', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(248, 'S12385', '2024-09-20', 'Present', 'Bachelor of Arts in History', 'Morning', 'Spring 2024', NULL),
(249, 'S12386', '2024-09-20', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(250, 'S12387', '2024-09-20', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(251, 'S12388', '2024-09-20', 'Present', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023', NULL),
(252, 'S12389', '2024-09-20', 'Present', 'Master of Business Administration', 'Morning', 'Spring 2024', NULL),
(253, 'S12390', '2024-09-20', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(254, 'S12391', '2024-09-20', 'Present', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024', NULL),
(255, 'S12392', '2024-09-20', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(256, 'S12393', '2024-09-20', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(257, 'S12394', '2024-09-20', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(258, 'S12401', '2024-09-20', 'Present', 'Bachelor of Arts in Philosophy', 'Morning', 'Fall 2023', NULL),
(259, 'S12402', '2024-09-20', 'Present', 'Master of Science in Chemistry', 'Evening', 'Fall 2023', NULL),
(260, 'S12403', '2024-09-20', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024', NULL),
(261, 'S12404', '2024-09-20', 'Present', 'Bachelor of Arts in History', 'Evening', 'Fall 2023', NULL),
(262, 'S12405', '2024-09-20', 'Present', 'Master of Business Administration', 'Morning', 'Spring 2024', NULL),
(263, 'S12406', '2024-09-20', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(264, 'S12407', '2024-09-20', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(265, 'S12408', '2024-09-20', 'Present', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023', NULL),
(266, 'S12409', '2024-09-20', 'Present', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024', NULL),
(267, 'S12410', '2024-09-20', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(268, 'S12411', '2024-09-20', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(269, 'S12412', '2024-09-20', 'Present', 'Bachelor of Science in Chemistry', 'Evening', 'Fall 2023', NULL),
(270, 'S12413', '2024-09-20', 'Present', 'Bachelor of Arts in Sociology', 'Morning', 'Spring 2024', NULL),
(271, 'S12414', '2024-09-20', 'Present', 'Bachelor of Science in Physics', 'Evening', 'Fall 2023', NULL),
(272, 'S12415', '2024-09-20', 'Present', 'Master of Business Administration', 'Morning', 'Spring 2024', NULL),
(273, 'S12416', '2024-09-20', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(274, 'S12417', '2024-09-20', 'Present', 'Bachelor of Arts in Political Science', 'Morning', 'Spring 2024', NULL),
(275, 'S12418', '2024-09-20', 'Present', 'Master of Science in Data Science', 'Evening', 'Fall 2023', NULL),
(276, 'S12419', '2024-09-20', 'Present', 'Bachelor of Science in Biology', 'Morning', 'Spring 2024', NULL),
(277, 'S12420', '2024-09-20', 'Present', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023', NULL),
(278, 'S12421', '2024-09-20', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(279, 'S12422', '2024-09-20', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(280, 'S12423', '2024-09-20', 'Present', 'Bachelor of Science in Chemistry', 'Morning', 'Spring 2024', NULL),
(281, 'S12424', '2024-09-20', 'Present', 'Bachelor of Arts in Sociology', 'Evening', 'Fall 2023', NULL),
(282, 'S12425', '2024-09-20', 'Present', 'Bachelor of Science in Physics', 'Morning', 'Spring 2024', NULL),
(283, 'S12426', '2024-09-20', 'Present', 'Master of Business Administration', 'Evening', 'Fall 2023', NULL),
(284, 'S12427', '2024-09-20', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024', NULL),
(285, 'S12428', '2024-09-20', 'Present', 'Bachelor of Arts in Political Science', 'Evening', 'Fall 2023', NULL),
(286, 'S12429', '2024-09-20', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(287, 'S12430', '2024-09-20', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(288, 'S12431', '2024-09-20', 'Present', 'Bachelor of Science in Mathematics', 'Morning', 'Spring 2024', NULL),
(289, 'S12432', '2024-09-20', 'Present', 'Master of Arts in Literature', 'Evening', 'Fall 2023', NULL),
(290, 'S12433', '2024-09-20', 'Present', 'Bachelor of Science in Computer Engineering', 'Morning', 'Spring 2024', NULL),
(291, 'S12434', '2024-09-20', 'Present', 'Bachelor of Science in Chemistry', 'Evening', 'Fall 2023', NULL),
(292, 'S12435', '2024-09-20', 'Present', 'Bachelor of Arts in Sociology', 'Morning', 'Spring 2024', NULL),
(293, 'S12436', '2024-09-20', 'Present', 'Bachelor of Science in Physics', 'Evening', 'Fall 2023', NULL),
(294, 'S12437', '2024-09-20', 'Present', 'Master of Business Administration', 'Morning', 'Spring 2024', NULL),
(295, 'S12438', '2024-09-20', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(296, 'S12439', '2024-09-20', 'Present', 'Bachelor of Arts in Political Science', 'Morning', 'Spring 2024', NULL),
(297, 'S12440', '2024-09-20', 'Present', 'Master of Science in Data Science', 'Evening', 'Fall 2023', NULL),
(298, 'S12441', '2024-09-20', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Fall 2023', NULL),
(299, 'S12442', '2024-09-20', 'Present', 'Bachelor of Arts in History', 'Evening', 'Spring 2024', NULL),
(300, 'S12443', '2024-09-20', 'Present', 'Bachelor of Science in Physics', 'Morning', 'Fall 2023', NULL),
(301, 'S12444', '2024-09-20', 'Present', 'Master of Science in Data Science', 'Evening', 'Spring 2024', NULL),
(302, 'S12445', '2024-09-20', 'Present', 'Bachelor of Arts in Political Science', 'Morning', 'Fall 2023', NULL),
(303, 'S12446', '2024-09-20', 'Present', 'Master of Business Administration', 'Evening', 'Spring 2024', NULL),
(304, 'S12447', '2024-09-20', 'Present', 'Bachelor of Science in Mathematics', 'Morning', 'Fall 2023', NULL),
(305, 'S12448', '2024-09-20', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Spring 2024', NULL),
(306, 'S12449', '2024-09-20', 'Present', 'Bachelor of Science in Biology', 'Morning', 'Fall 2023', NULL),
(307, 'S12450', '2024-09-20', 'Present', 'Bachelor of Arts in Philosophy', 'Evening', 'Spring 2024', NULL),
(308, 'S12451', '2024-09-20', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Fall 2023', NULL),
(309, 'S12452', '2024-09-20', 'Present', 'Bachelor of Arts in Literature', 'Evening', 'Spring 2024', NULL),
(310, 'S12345', '2024-09-25', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Fall 2023', NULL),
(311, 'S12346', '2024-09-25', 'Present', 'Bachelor of Arts in English', 'Evening', 'Fall 2023', NULL),
(312, 'S12347', '2024-09-25', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024', NULL),
(313, 'S12348', '2024-09-25', 'Present', 'Master of Business Administration', 'Evening', 'Fall 2023', NULL),
(314, 'S12349', '2024-09-25', 'Present', 'Bachelor of Science in Mathematics', 'Morning', 'Spring 2024', NULL),
(315, 'S12350', '2024-09-25', 'Present', 'Master of Science in Data Science', 'Evening', 'Fall 2023', NULL),
(316, 'S12351', '2024-09-25', 'Present', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024', NULL),
(317, 'S12352', '2024-09-25', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(318, 'S12353', '2024-09-25', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(319, 'S12354', '2024-09-25', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(320, 'S12355', '2024-09-25', 'Present', 'Bachelor of Arts in History', 'Morning', 'Spring 2024', NULL),
(321, 'S12356', '2024-09-25', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(322, 'S12357', '2024-09-25', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(323, 'S12358', '2024-09-25', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(324, 'S12359', '2024-09-25', 'Present', 'Bachelor of Science in Mathematics', 'Morning', 'Spring 2024', NULL),
(325, 'S12360', '2024-09-25', 'Present', 'Master of Business Administration', 'Evening', 'Fall 2023', NULL),
(326, 'S12361', '2024-09-25', 'Present', 'Bachelor of Arts in English', 'Morning', 'Spring 2024', NULL),
(327, 'S12362', '2024-09-25', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(328, 'S12363', '2024-09-25', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(329, 'S12364', '2024-09-25', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(330, 'S12365', '2024-09-25', 'Present', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024', NULL),
(331, 'S12366', '2024-09-25', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(332, 'S12367', '2024-09-25', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(333, 'S12368', '2024-09-25', 'Present', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023', NULL),
(334, 'S12369', '2024-09-25', 'Present', 'Master of Business Administration', 'Morning', 'Spring 2024', NULL),
(335, 'S12370', '2024-09-25', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(336, 'S12371', '2024-09-25', 'Present', 'Bachelor of Arts in History', 'Morning', 'Spring 2024', NULL),
(337, 'S12372', '2024-09-25', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(338, 'S12373', '2024-09-25', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(339, 'S12374', '2024-09-25', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(340, 'S12375', '2024-09-25', 'Present', 'Bachelor of Arts in English', 'Morning', 'Spring 2024', NULL),
(341, 'S12376', '2024-09-25', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(342, 'S12377', '2024-09-25', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(343, 'S12378', '2024-09-25', 'Present', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023', NULL),
(344, 'S12379', '2024-09-25', 'Present', 'Bachelor of Science in Biology', 'Morning', 'Spring 2024', NULL),
(345, 'S12380', '2024-09-25', 'Present', 'Master of Business Administration', 'Evening', 'Fall 2023', NULL),
(346, 'S12381', '2024-09-25', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024', NULL),
(347, 'S12382', '2024-09-25', 'Present', 'Bachelor of Arts in Psychology', 'Evening', 'Fall 2023', NULL),
(348, 'S12383', '2024-09-25', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(349, 'S12384', '2024-09-25', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(350, 'S12385', '2024-09-25', 'Present', 'Bachelor of Arts in History', 'Morning', 'Spring 2024', NULL),
(351, 'S12386', '2024-09-25', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(352, 'S12387', '2024-09-25', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(353, 'S12388', '2024-09-25', 'Present', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023', NULL),
(354, 'S12389', '2024-09-25', 'Present', 'Master of Business Administration', 'Morning', 'Spring 2024', NULL),
(355, 'S12390', '2024-09-25', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(356, 'S12391', '2024-09-25', 'Present', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024', NULL),
(357, 'S12392', '2024-09-25', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(358, 'S12393', '2024-09-25', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(359, 'S12394', '2024-09-25', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(360, 'S12401', '2024-09-25', 'Present', 'Bachelor of Arts in Philosophy', 'Morning', 'Fall 2023', NULL),
(361, 'S12402', '2024-09-25', 'Present', 'Master of Science in Chemistry', 'Evening', 'Fall 2023', NULL),
(362, 'S12403', '2024-09-25', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024', NULL),
(363, 'S12404', '2024-09-25', 'Present', 'Bachelor of Arts in History', 'Evening', 'Fall 2023', NULL),
(364, 'S12405', '2024-09-25', 'Present', 'Master of Business Administration', 'Morning', 'Spring 2024', NULL),
(365, 'S12406', '2024-09-25', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(366, 'S12407', '2024-09-25', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(367, 'S12408', '2024-09-25', 'Present', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023', NULL),
(368, 'S12409', '2024-09-25', 'Present', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024', NULL),
(369, 'S12410', '2024-09-25', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(370, 'S12411', '2024-09-25', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(371, 'S12412', '2024-09-25', 'Present', 'Bachelor of Science in Chemistry', 'Evening', 'Fall 2023', NULL),
(372, 'S12413', '2024-09-25', 'Present', 'Bachelor of Arts in Sociology', 'Morning', 'Spring 2024', NULL),
(373, 'S12414', '2024-09-25', 'Present', 'Bachelor of Science in Physics', 'Evening', 'Fall 2023', NULL),
(374, 'S12415', '2024-09-25', 'Present', 'Master of Business Administration', 'Morning', 'Spring 2024', NULL),
(375, 'S12416', '2024-09-25', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(376, 'S12417', '2024-09-25', 'Present', 'Bachelor of Arts in Political Science', 'Morning', 'Spring 2024', NULL),
(377, 'S12418', '2024-09-25', 'Present', 'Master of Science in Data Science', 'Evening', 'Fall 2023', NULL),
(378, 'S12419', '2024-09-25', 'Present', 'Bachelor of Science in Biology', 'Morning', 'Spring 2024', NULL),
(379, 'S12420', '2024-09-25', 'Present', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023', NULL),
(380, 'S12421', '2024-09-25', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(381, 'S12422', '2024-09-25', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(382, 'S12423', '2024-09-25', 'Present', 'Bachelor of Science in Chemistry', 'Morning', 'Spring 2024', NULL),
(383, 'S12424', '2024-09-25', 'Present', 'Bachelor of Arts in Sociology', 'Evening', 'Fall 2023', NULL),
(384, 'S12425', '2024-09-25', 'Present', 'Bachelor of Science in Physics', 'Morning', 'Spring 2024', NULL),
(385, 'S12426', '2024-09-25', 'Present', 'Master of Business Administration', 'Evening', 'Fall 2023', NULL),
(386, 'S12427', '2024-09-25', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024', NULL),
(387, 'S12428', '2024-09-25', 'Present', 'Bachelor of Arts in Political Science', 'Evening', 'Fall 2023', NULL),
(388, 'S12429', '2024-09-25', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(389, 'S12430', '2024-09-25', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(390, 'S12431', '2024-09-25', 'Present', 'Bachelor of Science in Mathematics', 'Morning', 'Spring 2024', NULL),
(391, 'S12432', '2024-09-25', 'Present', 'Master of Arts in Literature', 'Evening', 'Fall 2023', NULL),
(392, 'S12433', '2024-09-25', 'Present', 'Bachelor of Science in Computer Engineering', 'Morning', 'Spring 2024', NULL),
(393, 'S12434', '2024-09-25', 'Present', 'Bachelor of Science in Chemistry', 'Evening', 'Fall 2023', NULL),
(394, 'S12435', '2024-09-25', 'Present', 'Bachelor of Arts in Sociology', 'Morning', 'Spring 2024', NULL),
(395, 'S12436', '2024-09-25', 'Present', 'Bachelor of Science in Physics', 'Evening', 'Fall 2023', NULL),
(396, 'S12437', '2024-09-25', 'Present', 'Master of Business Administration', 'Morning', 'Spring 2024', NULL),
(397, 'S12438', '2024-09-25', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(398, 'S12439', '2024-09-25', 'Present', 'Bachelor of Arts in Political Science', 'Morning', 'Spring 2024', NULL),
(399, 'S12440', '2024-09-25', 'Present', 'Master of Science in Data Science', 'Evening', 'Fall 2023', NULL),
(400, 'S12441', '2024-09-25', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Fall 2023', NULL),
(401, 'S12442', '2024-09-25', 'Present', 'Bachelor of Arts in History', 'Evening', 'Spring 2024', NULL),
(402, 'S12443', '2024-09-25', 'Present', 'Bachelor of Science in Physics', 'Morning', 'Fall 2023', NULL),
(403, 'S12444', '2024-09-25', 'Present', 'Master of Science in Data Science', 'Evening', 'Spring 2024', NULL),
(404, 'S12445', '2024-09-25', 'Present', 'Bachelor of Arts in Political Science', 'Morning', 'Fall 2023', NULL),
(405, 'S12446', '2024-09-25', 'Present', 'Master of Business Administration', 'Evening', 'Spring 2024', NULL),
(406, 'S12447', '2024-09-25', 'Present', 'Bachelor of Science in Mathematics', 'Morning', 'Fall 2023', NULL),
(407, 'S12448', '2024-09-25', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Spring 2024', NULL),
(408, 'S12449', '2024-09-25', 'Present', 'Bachelor of Science in Biology', 'Morning', 'Fall 2023', NULL),
(409, 'S12450', '2024-09-25', 'Present', 'Bachelor of Arts in Philosophy', 'Evening', 'Spring 2024', NULL),
(410, 'S12451', '2024-09-25', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Fall 2023', NULL),
(411, 'S12452', '2024-09-25', 'Present', 'Bachelor of Arts in Literature', 'Evening', 'Spring 2024', NULL),
(412, 'S12345', '2024-09-29', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Fall 2023', NULL),
(413, 'S12346', '2024-09-29', 'Present', 'Bachelor of Arts in English', 'Evening', 'Fall 2023', NULL),
(414, 'S12347', '2024-09-29', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024', NULL),
(415, 'S12348', '2024-09-29', 'Present', 'Master of Business Administration', 'Evening', 'Fall 2023', NULL),
(416, 'S12349', '2024-09-29', 'Present', 'Bachelor of Science in Mathematics', 'Morning', 'Spring 2024', NULL),
(417, 'S12350', '2024-09-29', 'Present', 'Master of Science in Data Science', 'Evening', 'Fall 2023', NULL),
(418, 'S12351', '2024-09-29', 'Present', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024', NULL),
(419, 'S12352', '2024-09-29', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(420, 'S12353', '2024-09-29', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(421, 'S12354', '2024-09-29', 'Present', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(422, 'S12355', '2024-09-29', 'Present', 'Bachelor of Arts in History', 'Morning', 'Spring 2024', NULL),
(423, 'S12356', '2024-09-29', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(424, 'S12357', '2024-09-29', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(425, 'S12358', '2024-09-29', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(426, 'S12359', '2024-09-29', 'Absent', 'Bachelor of Science in Mathematics', 'Morning', 'Spring 2024', NULL),
(427, 'S12345', '2024-09-29', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Fall 2023', NULL),
(428, 'S12346', '2024-09-29', 'Present', 'Bachelor of Arts in English', 'Evening', 'Fall 2023', NULL),
(429, 'S12347', '2024-09-29', 'Present', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024', NULL),
(430, 'S12348', '2024-09-29', 'Present', 'Master of Business Administration', 'Evening', 'Fall 2023', NULL),
(431, 'S12349', '2024-09-29', 'Late', 'Bachelor of Science in Mathematics', 'Morning', 'Spring 2024', NULL),
(432, 'S12350', '2024-09-29', 'Present', 'Master of Science in Data Science', 'Evening', 'Fall 2023', NULL),
(433, 'S12351', '2024-09-29', 'Present', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024', NULL),
(434, 'S12352', '2024-09-29', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(435, 'S12353', '2024-09-29', 'Present', 'Master of Science in Data Science', 'Morning', 'Spring 2024', NULL),
(436, 'S12354', '2024-09-29', 'Absent', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023', NULL),
(437, 'S12355', '2024-09-29', 'Present', 'Bachelor of Arts in History', 'Morning', 'Spring 2024', NULL),
(438, 'S12356', '2024-09-29', 'Present', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023', NULL),
(439, 'S12357', '2024-09-29', 'Present', 'Master of Arts in Literature', 'Morning', 'Spring 2024', NULL),
(440, 'S12358', '2024-09-29', 'Present', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023', NULL),
(441, 'S12359', '2024-09-29', 'Present', 'Bachelor of Science in Mathematics', 'Morning', 'Spring 2024', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_description` text DEFAULT NULL,
  `course_image` varchar(255) DEFAULT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `course_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_description`, `course_image`, `duration`, `price`, `course_type`) VALUES
(1, 'Bachelor of Computer Applications (BCA)', 'The Bachelor of Computer Applications (BCA) is a 3-year undergraduate program designed to provide a solid foundation in computer science, programming, and software development. The course covers areas like databases, networking, web development, and mobile applications, preparing students for careers in IT and tech industries.', 'assets/images/course/bca.png', '3 years', 50000.00, 'Semester-based'),
(2, 'Bachelor of Business Administration (BBA)', 'The Bachelor of Business Administration (BBA) is a 3-year undergraduate degree designed to equip students with essential business skills. This program covers key areas such as management, marketing, finance, and human resources, preparing students for leadership roles in the business world. The curriculum emphasizes practical knowledge and strategic thinking, making graduates highly competitive in the job market.', 'assets/images/course/bba.png', '3 years', 50000.00, 'Semester-based'),
(3, 'Bachelor of Commerce (BCom)', 'The Bachelor of Commerce (BCom) is a 3-year program focusing on the principles of commerce and finance. It provides a solid foundation in accounting, economics, and business law. The course aims to develop a thorough understanding of financial management, business operations, and analytical skills, preparing students for various careers in finance, accounting, and business administration.', 'assets/images/course/bcom.png', '3 years', 45000.00, 'Semester-based'),
(4, 'Master of Business Administration (MBA)', 'The Master of Business Administration (MBA) is a 2-year postgraduate program aimed at developing advanced business management skills. It covers strategic management, leadership, finance, and marketing. The program emphasizes practical experience through case studies, internships, and group projects, equipping graduates with the expertise needed for executive roles in various industries.', 'assets/images/course/mba.jpg', '2 years', 100000.00, 'Yearly-based'),
(5, 'Bachelor of Science (BSc)', 'The Bachelor of Science (BSc) is a 3-year undergraduate program that offers a deep dive into various scientific disciplines such as physics, chemistry, and biology. The course emphasizes experimental skills, data analysis, and scientific research methodologies. Students are prepared for careers in research, technology, and applied sciences, with opportunities for further study in specialized fields.', 'assets/images/course/bsc.png', '3 years', 50000.00, 'Semester-based'),
(6, 'Master of Computer Applications (MCA)', 'The Master of Computer Applications (MCA) is a 3-year postgraduate program focusing on computer science and applications. It covers areas such as software development, database management, and network security. The course is designed to enhance technical skills and problem-solving abilities, preparing students for careers in IT and software development or for advanced research in computer science.', 'assets/images/course/mca.jpg', '3 years', 90000.00, 'Semester-based'),
(7, 'Bachelor of Tourism Management (BTM)', 'The Bachelor of Tourism Management (BTM) is a 3-year program focusing on the tourism and hospitality industry. It covers aspects such as travel management, tour operations, and event planning. The course aims to develop skills in customer service, marketing, and business management, preparing students for careers in tourism agencies, hotels, and event management.', 'assets/images/course/btm.jpg', '3 years', 48000.00, 'Semester-based'),
(8, 'Bachelor of Technology (BTech)', 'The Bachelor of Technology (BTech) is a 4-year undergraduate program in engineering and technology. It provides specialized knowledge in fields such as civil, mechanical, and electrical engineering. The program includes hands-on training, project work, and internships, equipping students with practical skills and theoretical understanding to excel in technology-driven industries.', 'assets/images/course/btech.jpg', '4 years', 70000.00, 'Yearly-based');

-- --------------------------------------------------------

--
-- Table structure for table `course_info`
--

CREATE TABLE `course_info` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_type` varchar(100) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `fee_structure` decimal(10,2) NOT NULL,
  `eligibility` varchar(255) DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `course_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_info`
--

INSERT INTO `course_info` (`id`, `course_name`, `course_type`, `duration`, `description`, `fee_structure`, `eligibility`, `specialization`, `course_id`) VALUES
(1, 'Post Graduate Diploma in Development Studies', 'DIPLOMA', '1 Year', 'This programme is designed to equip students with knowledge and skills to understand development processes, address developmental issues, and contribute to sustainable development.', 12000.00, 'Bachelor’s Degree or a higher degree from a recognized University.', 'Development Studies', 'PGDDVS'),
(2, 'Post Graduate Diploma in Corporate Social Responsibility', 'DIPLOMA', '1 Year', 'This programme aims to develop professionals capable of managing and implementing CSR activities in organizations, focusing on ethical business practices and community engagement.', 12000.00, 'Bachelor’s Degree or a higher degree from a recognized University.', 'Corporate Social Responsibility', 'PGDCSR'),
(3, 'Post Graduate Diploma in Folklore and Culture Studies', 'DIPLOMA', '1 Year', 'This programme focuses on the study of folklore and cultural traditions, aiming to equip students with skills to analyze and document cultural practices.', 12000.00, 'Bachelor’s Degree or a higher degree from a recognized University.', 'Folklore and Culture Studies', 'PGDFCS'),
(4, 'Diploma in Retailing', 'DIPLOMA', '1 Year', 'This programme provides knowledge and skills for a career in the retail sector, focusing on various aspects of retailing.', 10000.00, '10+2/equivalent', 'Retailing', 'DIRIL'),
(5, 'Certificate in Energy Technology and Management', 'CERTIFICATE', '0 Years 6 Months', 'CETM aims at equipping students with knowledge about energy resources, conservation, and management.', 3000.00, '10th Pass', 'Energy Technology and Management', 'CETM'),
(6, 'Certificate in Russian Language', 'CERTIFICATE', '0 Years 6 Months', 'The programme introduces learners to the basics of Russian grammar and phonetics, enabling them to read, write, and speak Russian.', 2500.00, 'Minimum age 18 years. No formal qualification is required, Class 10 level of English proficiency is desirable.', 'Russian Language', 'CRUL'),
(7, 'Bachelor of Arts (English)', 'DEGREE', '3 Years', 'This programme offers comprehensive training in English language and literature, preparing students for various career paths.', 15000.00, '10+2 or equivalent', 'English', 'BAFEG'),
(8, 'Bachelor of Science (Food Safety and Quality Management)', 'DEGREE', '3 Years', 'This programme addresses the growing demand for food safety professionals and provides knowledge in food processing and safety.', 18000.00, '10+2 with Science/Agriculture subjects', 'Food Safety and Quality Management', 'BSCFFSQM'),
(9, 'Bachelor of Science (Mathematics)', 'DEGREE', '3 Years', 'This programme provides in-depth knowledge in mathematics, encouraging students to explore interdisciplinary subjects.', 18000.00, '10+2 with Mathematics', 'Mathematics', 'BSCFMT'),
(10, 'Bachelor of Science (Biochemistry)', 'DEGREE', '3 Years', 'This programme focuses on the biochemical processes and their applications in various fields, preparing students for advanced studies.', 43500.00, '10+2 with Physics, Chemistry and Biology', 'Biochemistry', 'BSCFBC'),
(11, 'Bachelor of Science (Anthropology)', 'DEGREE', '3 Years', 'This programme explores the diversity of human cultures and societies, preparing students for careers in social sciences.', 18900.00, '10+2 or equivalent', 'Anthropology', 'BSCFAN'),
(12, 'Bachelor of Science', 'DEGREE', '3 Years', 'The programme aims to provide high quality higher education in multidisciplinary subjects through open and distance learning.', 18000.00, '10+2 with science subjects or its equivalent qualification', 'Science', 'BSCM'),
(13, 'Bachelor of Arts (Tourism Studies)', 'DEGREE', '3 Years', 'BATS is a 3-year Degree Programme designed for students interested in pursuing a career in the travel and tourism sector.', 15000.00, '10+2 or equivalent', 'Tourism Studies', 'BATS'),
(14, 'Bachelor of Arts (Hons) Sociology', 'DEGREE', '3 Years', 'The Bachelors Honours programmes are designed to give in-depth knowledge in a discipline while allowing for exposure to subjects beyond the discipline.', 15000.00, '10+2 or its equivalent', 'Sociology', 'BASOH'),
(15, 'Bachelor of Arts (Psychology)', 'DEGREE', '3 Years', 'This programme provides a comprehensive understanding of psychological theories and practices, preparing students for various fields.', 16500.00, '10+2 or equivalent', 'Psychology', 'BAFPC'),
(16, 'Master of Arts in Gender and Development Studies', 'DEGREE', '2 Years', 'This programme aims to explore the intersection of gender and development, focusing on policies and practices that promote gender equality.', 12400.00, 'Bachelor’s Degree or a higher degree from a recognized University.', 'Gender & Development Studies', 'MAGD'),
(17, 'Master of Arts in Philosophy', 'DEGREE', '2 Years', 'The programme aims to provide a deep understanding of philosophical concepts and theories, encouraging critical thinking and analysis.', 14000.00, 'Bachelor’s Degree or a higher degree from a recognized University.', 'Philosophy', 'MAPY'),
(18, 'Master of Arts in Public Administration', 'DEGREE', '2 Years', 'This programme equips students with the skills and knowledge to manage public administration and governance effectively.', 14000.00, 'Bachelor’s Degree or a higher degree from a recognized University.', 'Public Administration', 'MPA'),
(19, 'Master of Arts in Hindi', 'DEGREE', '2 Years', 'This programme offers advanced study in Hindi literature, language, and culture, promoting proficiency and critical understanding.', 15400.00, 'Bachelor’s Degree or a higher degree from a recognized University.', 'Hindi', 'MHD');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` varchar(15) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_name`, `student_id`, `email`, `phone_no`, `course`) VALUES
(1, 'Vinod Kumar', '002365', 'vk16072003@gmail.com', '1234567890', 'BCA'),
(2, 'Piyush Sharma', '64543', 'piyush072003@gmail.com', '0987654321', 'MCA');

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `id` int(11) NOT NULL,
  `student_img` varchar(255) DEFAULT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_no` varchar(15) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `section` varchar(10) DEFAULT NULL,
  `semester_year` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`id`, `student_img`, `student_name`, `student_id`, `email`, `phone_no`, `course`, `section`, `semester_year`) VALUES
(1, 'assets/images/placeholder.jpg', 'Alice Smith', 'S12345', 'alice@example.com', '123-456-7890', 'Bachelor of Science in Computer Science', 'Morning', 'Fall 2023'),
(2, 'assets/images/placeholder.jpg', 'Bob Johnson', 'S12346', 'bob@example.com', '123-456-7891', 'Bachelor of Arts in English', 'Evening', 'Fall 2023'),
(3, 'assets/images/placeholder.jpg', 'Charlie Brown', 'S12347', 'charlie@example.com', '123-456-7892', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024'),
(4, 'assets/images/placeholder.jpg', 'David Wilson', 'S12348', 'david@example.com', '123-456-7893', 'Master of Business Administration', 'Evening', 'Fall 2023'),
(5, 'assets/images/placeholder.jpg', 'Eva Adams', 'S12349', 'eva@example.com', '123-456-7894', 'Bachelor of Science in Mathematics', 'Morning', 'Spring 2024'),
(6, 'assets/images/placeholder.jpg', 'Franklin Clark', 'S12350', 'frank@example.com', '123-456-7895', 'Master of Science in Data Science', 'Evening', 'Fall 2023'),
(7, 'assets/images/placeholder.jpg', 'Grace Lee', 'S12351', 'grace@example.com', '123-456-7896', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024'),
(8, 'assets/images/placeholder.jpg', 'Hannah Martinez', 'S12352', 'hannah@example.com', '123-456-7897', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023'),
(9, 'assets/images/placeholder.jpg', 'Ian Taylor', 'S12353', 'ian@example.com', '123-456-7898', 'Master of Science in Data Science', 'Morning', 'Spring 2024'),
(10, 'assets/images/placeholder.jpg', 'Jack Anderson', 'S12354', 'jack@example.com', '123-456-7899', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023'),
(11, 'assets/images/placeholder.jpg', 'Karen Thompson', 'S12355', 'karen@example.com', '123-456-7800', 'Bachelor of Arts in History', 'Morning', 'Spring 2024'),
(12, 'assets/images/placeholder.jpg', 'Leo White', 'S12356', 'leo@example.com', '123-456-7801', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023'),
(13, 'assets/images/placeholder.jpg', 'Mia Harris', 'S12357', 'mia@example.com', '123-456-7802', 'Master of Arts in Literature', 'Morning', 'Spring 2024'),
(14, 'assets/images/placeholder.jpg', 'Noah King', 'S12358', 'noah@example.com', '123-456-7803', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023'),
(15, 'assets/images/placeholder.jpg', 'Olivia Wright', 'S12359', 'olivia@example.com', '123-456-7804', 'Bachelor of Science in Mathematics', 'Morning', 'Spring 2024'),
(16, 'assets/images/placeholder.jpg', 'Paul Young', 'S12360', 'paul@example.com', '123-456-7805', 'Master of Business Administration', 'Evening', 'Fall 2023'),
(17, 'assets/images/placeholder.jpg', 'Quinn Scott', 'S12361', 'quinn@example.com', '123-456-7806', 'Bachelor of Arts in English', 'Morning', 'Spring 2024'),
(18, 'assets/images/placeholder.jpg', 'Rachel Green', 'S12362', 'rachel@example.com', '123-456-7807', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023'),
(19, 'assets/images/placeholder.jpg', 'Sam Baker', 'S12363', 'sam@example.com', '123-456-7808', 'Master of Science in Data Science', 'Morning', 'Spring 2024'),
(20, 'assets/images/placeholder.jpg', 'Tina Turner', 'S12364', 'tina@example.com', '123-456-7809', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023'),
(21, 'assets/images/placeholder.jpg', 'Uma Clark', 'S12365', 'uma@example.com', '123-456-7810', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024'),
(22, 'assets/images/placeholder.jpg', 'Vera Lewis', 'S12366', 'vera@example.com', '123-456-7811', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023'),
(23, 'assets/images/placeholder.jpg', 'Will Robinson', 'S12367', 'will@example.com', '123-456-7812', 'Master of Arts in Literature', 'Morning', 'Spring 2024'),
(24, 'assets/images/placeholder.jpg', 'Xena Chen', 'S12368', 'xena@example.com', '123-456-7813', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023'),
(25, 'assets/images/placeholder.jpg', 'Yara Adams', 'S12369', 'yara@example.com', '123-456-7814', 'Master of Business Administration', 'Morning', 'Spring 2024'),
(26, 'assets/images/placeholder.jpg', 'Zack Hill', 'S12370', 'zack@example.com', '123-456-7815', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023'),
(27, 'assets/images/placeholder.jpg', 'Anna Patel', 'S12371', 'anna@example.com', '123-456-7816', 'Bachelor of Arts in History', 'Morning', 'Spring 2024'),
(28, 'assets/images/placeholder.jpg', 'Ben Smith', 'S12372', 'ben@example.com', '123-456-7817', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023'),
(29, 'assets/images/placeholder.jpg', 'Chloe Lopez', 'S12373', 'chloe@example.com', '123-456-7818', 'Master of Science in Data Science', 'Morning', 'Spring 2024'),
(30, 'assets/images/placeholder.jpg', 'Derek Fox', 'S12374', 'derek@example.com', '123-456-7819', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023'),
(31, './assets/upload/bsw.png', 'Eve Ward', 'S12375', 'eve@example.com', '123-456-7820', 'Bachelor of Arts in English', 'Morning', 'Spring 2024'),
(32, 'assets/images/placeholder.jpg', 'Frank Lee', 'S12376', 'frankl@example.com', '123-456-7821', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023'),
(33, 'assets/images/placeholder.jpg', 'Grace Wong', 'S12377', 'gracew@example.com', '123-456-7822', 'Master of Arts in Literature', 'Morning', 'Spring 2024'),
(34, 'assets/images/placeholder.jpg', 'Hank Moore', 'S12378', 'hankm@example.com', '123-456-7823', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023'),
(35, 'assets/images/placeholder.jpg', 'Ivy Turner', 'S12379', 'ivy@example.com', '123-456-7824', 'Bachelor of Science in Biology', 'Morning', 'Spring 2024'),
(36, 'assets/images/placeholder.jpg', 'Jackie Chan', 'S12380', 'jackie@example.com', '123-456-7825', 'Master of Business Administration', 'Evening', 'Fall 2023'),
(37, 'assets/images/placeholder.jpg', 'Katy Perry', 'S12381', 'katy@example.com', '123-456-7826', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024'),
(38, 'assets/images/placeholder.jpg', 'Liam Neeson', 'S12382', 'liam@example.com', '123-456-7827', 'Bachelor of Arts in Psychology', 'Evening', 'Fall 2023'),
(39, 'assets/images/placeholder.jpg', 'Mona Lisa', 'S12383', 'mona@example.com', '123-456-7828', 'Master of Science in Data Science', 'Morning', 'Spring 2024'),
(40, 'assets/images/placeholder.jpg', 'Nina Simone', 'S12384', 'nina@example.com', '123-456-7829', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023'),
(41, 'assets/images/placeholder.jpg', 'Oscar Wilde', 'S12385', 'oscar@example.com', '123-456-7830', 'Bachelor of Arts in History', 'Morning', 'Spring 2024'),
(42, 'assets/images/placeholder.jpg', 'Paula Abdul', 'S12386', 'paula@example.com', '123-456-7831', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023'),
(43, 'assets/images/placeholder.jpg', 'Quincy Jones', 'S12387', 'quincy@example.com', '123-456-7832', 'Master of Arts in Literature', 'Morning', 'Spring 2024'),
(44, 'assets/images/placeholder.jpg', 'Rita Hayworth', 'S12388', 'rita@example.com', '123-456-7833', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023'),
(45, 'assets/images/placeholder.jpg', 'Steve Jobs', 'S12389', 'steve@example.com', '123-456-7834', 'Master of Business Administration', 'Morning', 'Spring 2024'),
(46, 'assets/images/placeholder.jpg', 'Tina Fey', 'S12390', 'tina.f@example.com', '123-456-7835', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023'),
(47, 'assets/images/placeholder.jpg', 'Uma Thurman', 'S12391', 'uma.t@example.com', '123-456-7836', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024'),
(48, 'assets/images/placeholder.jpg', 'Vin Diesel', 'S12392', 'vin@example.com', '123-456-7837', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023'),
(49, 'assets/images/placeholder.jpg', 'Wendy Williams', 'S12393', 'wendy@example.com', '123-456-7838', 'Master of Science in Data Science', 'Morning', 'Spring 2024'),
(50, 'assets/images/placeholder.jpg', 'Xander Cage', 'S12394', 'xander@example.com', '123-456-7839', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023'),
(51, 'assets/images/placeholder.jpg', 'Nina Black', 'S12401', 'nina.black@example.com', '123-456-7900', 'Bachelor of Arts in Philosophy', 'Morning', 'Fall 2023'),
(52, 'assets/images/placeholder.jpg', 'Oliver Evans', 'S12402', 'oliver.evans@example.com', '123-456-7901', 'Master of Science in Chemistry', 'Evening', 'Fall 2023'),
(53, 'assets/images/placeholder.jpg', 'Peter Quinn', 'S12403', 'peter.quinn@example.com', '123-456-7902', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024'),
(54, 'assets/images/placeholder.jpg', 'Quinn Roberts', 'S12404', 'quinn.roberts@example.com', '123-456-7903', 'Bachelor of Arts in History', 'Evening', 'Fall 2023'),
(55, 'assets/images/placeholder.jpg', 'Rebecca King', 'S12405', 'rebecca.king@example.com', '123-456-7904', 'Master of Business Administration', 'Morning', 'Spring 2024'),
(56, 'assets/images/placeholder.jpg', 'Samuel Harris', 'S12406', 'samuel.harris@example.com', '123-456-7905', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023'),
(57, 'assets/images/placeholder.jpg', 'Tracy Green', 'S12407', 'tracy.green@example.com', '123-456-7906', 'Master of Science in Data Science', 'Morning', 'Spring 2024'),
(58, 'assets/images/placeholder.jpg', 'Uma Patel', 'S12408', 'uma.patel@example.com', '123-456-7907', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023'),
(59, 'assets/images/placeholder.jpg', 'Victor Lee', 'S12409', 'victor.lee@example.com', '123-456-7908', 'Bachelor of Arts in Psychology', 'Morning', 'Spring 2024'),
(60, 'assets/images/placeholder.jpg', 'Wendy Chang', 'S12410', 'wendy.chang@example.com', '123-456-7909', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023'),
(61, 'assets/images/placeholder.jpg', 'Xander Torres', 'S12411', 'xander.torres@example.com', '123-456-7910', 'Master of Arts in Literature', 'Morning', 'Spring 2024'),
(62, 'assets/images/placeholder.jpg', 'Yasmin Parker', 'S12412', 'yasmin.parker@example.com', '123-456-7911', 'Bachelor of Science in Chemistry', 'Evening', 'Fall 2023'),
(63, 'assets/images/placeholder.jpg', 'Zane Brooks', 'S12413', 'zane.brooks@example.com', '123-456-7912', 'Bachelor of Arts in Sociology', 'Morning', 'Spring 2024'),
(64, 'assets/images/placeholder.jpg', 'Aaron Williams', 'S12414', 'aaron.williams@example.com', '123-456-7913', 'Bachelor of Science in Physics', 'Evening', 'Fall 2023'),
(65, 'assets/images/placeholder.jpg', 'Brittany Coleman', 'S12415', 'brittany.coleman@example.com', '123-456-7914', 'Master of Business Administration', 'Morning', 'Spring 2024'),
(66, 'assets/images/placeholder.jpg', 'Carlos Gonzalez', 'S12416', 'carlos.gonzalez@example.com', '123-456-7915', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023'),
(67, 'assets/images/placeholder.jpg', 'Diana Baker', 'S12417', 'diana.baker@example.com', '123-456-7916', 'Bachelor of Arts in Political Science', 'Morning', 'Spring 2024'),
(68, 'assets/images/placeholder.jpg', 'Edward Turner', 'S12418', 'edward.turner@example.com', '123-456-7917', 'Master of Science in Data Science', 'Evening', 'Fall 2023'),
(69, 'assets/images/placeholder.jpg', 'Fiona Adams', 'S12419', 'fiona.adams@example.com', '123-456-7918', 'Bachelor of Science in Biology', 'Morning', 'Spring 2024'),
(70, 'assets/images/placeholder.jpg', 'George Clark', 'S12420', 'george.clark@example.com', '123-456-7919', 'Bachelor of Science in Mathematics', 'Evening', 'Fall 2023'),
(71, 'assets/images/placeholder.jpg', 'Hannah Murphy', 'S12421', 'hannah.murphy@example.com', '123-456-7920', 'Master of Arts in Literature', 'Morning', 'Spring 2024'),
(72, 'assets/images/placeholder.jpg', 'Ian Foster', 'S12422', 'ian.foster@example.com', '123-456-7921', 'Bachelor of Science in Computer Engineering', 'Evening', 'Fall 2023'),
(73, 'assets/images/placeholder.jpg', 'Jessica Stewart', 'S12423', 'jessica.stewart@example.com', '123-456-7922', 'Bachelor of Science in Chemistry', 'Morning', 'Spring 2024'),
(74, 'assets/images/placeholder.jpg', 'Kevin Hughes', 'S12424', 'kevin.hughes@example.com', '123-456-7923', 'Bachelor of Arts in Sociology', 'Evening', 'Fall 2023'),
(75, 'assets/images/placeholder.jpg', 'Laura Phillips', 'S12425', 'laura.phillips@example.com', '123-456-7924', 'Bachelor of Science in Physics', 'Morning', 'Spring 2024'),
(76, 'assets/images/placeholder.jpg', 'Michael Young', 'S12426', 'michael.young@example.com', '123-456-7925', 'Master of Business Administration', 'Evening', 'Fall 2023'),
(77, 'assets/images/placeholder.jpg', 'Nora Martin', 'S12427', 'nora.martin@example.com', '123-456-7926', 'Bachelor of Science in Computer Science', 'Morning', 'Spring 2024'),
(78, 'assets/images/placeholder.jpg', 'Oscar Perez', 'S12428', 'oscar.perez@example.com', '123-456-7927', 'Bachelor of Arts in Political Science', 'Evening', 'Fall 2023'),
(79, 'assets/images/placeholder.jpg', 'Paula Thompson', 'S12429', 'paula.thompson@example.com', '123-456-7928', 'Master of Science in Data Science', 'Morning', 'Spring 2024'),
(80, 'assets/images/placeholder.jpg', 'Quincy Lewis', 'S12430', 'quincy.lewis@example.com', '123-456-7929', 'Bachelor of Science in Biology', 'Evening', 'Fall 2023'),
(81, 'assets/images/placeholder.jpg', 'Rachel Walker', 'S12431', 'rachel.walker@example.com', '123-456-7930', 'Bachelor of Science in Mathematics', 'Morning', 'Spring 2024'),
(82, 'assets/images/placeholder.jpg', 'Steven Edwards', 'S12432', 'steven.edwards@example.com', '123-456-7931', 'Master of Arts in Literature', 'Evening', 'Fall 2023'),
(83, 'assets/images/placeholder.jpg', 'Thomas Roberts', 'S12433', 'thomas.roberts@example.com', '123-456-7932', 'Bachelor of Science in Computer Engineering', 'Morning', 'Spring 2024'),
(84, 'assets/images/placeholder.jpg', 'Ursula Bennett', 'S12434', 'ursula.bennett@example.com', '123-456-7933', 'Bachelor of Science in Chemistry', 'Evening', 'Fall 2023'),
(85, 'assets/images/placeholder.jpg', 'Victoria White', 'S12435', 'victoria.white@example.com', '123-456-7934', 'Bachelor of Arts in Sociology', 'Morning', 'Spring 2024'),
(86, 'assets/images/placeholder.jpg', 'William Cox', 'S12436', 'william.cox@example.com', '123-456-7935', 'Bachelor of Science in Physics', 'Evening', 'Fall 2023'),
(87, 'assets/images/placeholder.jpg', 'Xavier Scott', 'S12437', 'xavier.scott@example.com', '123-456-7936', 'Master of Business Administration', 'Morning', 'Spring 2024'),
(88, 'assets/images/placeholder.jpg', 'Yvette Bell', 'S12438', 'yvette.bell@example.com', '123-456-7937', 'Bachelor of Science in Computer Science', 'Evening', 'Fall 2023'),
(89, 'assets/images/placeholder.jpg', 'Zoe Ward', 'S12439', 'zoe.ward@example.com', '123-456-7938', 'Bachelor of Arts in Political Science', 'Morning', 'Spring 2024'),
(90, 'assets/images/placeholder.jpg', 'Aaron King', 'S12440', 'aaron.king@example.com', '123-456-7939', 'Master of Science in Data Science', 'Evening', 'Fall 2023'),
(91, 'assets/images/placeholder.jpg', 'Brian Lee', 'S12441', 'brian.lee@example.com', '123-456-7940', 'Bachelor of Science in Computer Science', 'Morning', 'Fall 2023'),
(92, 'assets/images/placeholder.jpg', 'Chloe Jenkins', 'S12442', 'chloe.jenkins@example.com', '123-456-7941', 'Bachelor of Arts in History', 'Evening', 'Spring 2024'),
(93, 'assets/images/placeholder.jpg', 'David Sanders', 'S12443', 'david.sanders@example.com', '123-456-7942', 'Bachelor of Science in Physics', 'Morning', 'Fall 2023'),
(94, 'assets/images/placeholder.jpg', 'Emily Brooks', 'S12444', 'emily.brooks@example.com', '123-456-7943', 'Master of Science in Data Science', 'Evening', 'Spring 2024'),
(95, 'assets/images/placeholder.jpg', 'Frank Hall', 'S12445', 'frank.hall@example.com', '123-456-7944', 'Bachelor of Arts in Political Science', 'Morning', 'Fall 2023'),
(96, 'assets/images/placeholder.jpg', 'Gina Brown', 'S12446', 'gina.brown@example.com', '123-456-7945', 'Master of Business Administration', 'Evening', 'Spring 2024'),
(97, 'assets/images/placeholder.jpg', 'Henry Wilson', 'S12447', 'henry.wilson@example.com', '123-456-7946', 'Bachelor of Science in Mathematics', 'Morning', 'Fall 2023'),
(98, 'assets/images/placeholder.jpg', 'Isla Adams', 'S12448', 'isla.adams@example.com', '123-456-7947', 'Bachelor of Science in Computer Engineering', 'Evening', 'Spring 2024'),
(99, 'assets/images/placeholder.jpg', 'Jackie Turner', 'S12449', 'jackie.turner@example.com', '123-456-7948', 'Bachelor of Science in Biology', 'Morning', 'Fall 2023'),
(100, 'assets/images/placeholder.jpg', 'Kelly Peterson', 'S12450', 'kelly.peterson@example.com', '123-456-7949', 'Bachelor of Arts in Philosophy', 'Evening', 'Spring 2024'),
(101, './assets/upload/placeholder.jpg', 'Liam Taylor', 'S12451', 'liam.taylor@example.com', '123-456-7950', 'Bachelor of Science in Computer Science', 'Morning', 'Fall 2023'),
(102, './assets/upload/teacher.jpg', 'Maya Johnson', 'S12452', 'maya.johnson@example.com', '123-456-7951', 'Bachelor of Arts in Literature', 'Evening', 'Spring 2024'),
(104, './assets/upload/ache.png', 'fgfasd', 'j4574545', 'adsas@email.com', '456464545', 'MCA', 'Morning', 'Fall 2023'),
(105, './assets/upload/still-life-851328_1280.jpg', 'afdsfasfsf', 'g4545', 'example@email.com', '7456756475', 'msg', 'Evening', 'Spring 2024');

-- --------------------------------------------------------

--
-- Table structure for table `subject_info`
--

CREATE TABLE `subject_info` (
  `id` int(11) NOT NULL,
  `subject_id` varchar(20) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `semester_year` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject_info`
--

INSERT INTO `subject_info` (`id`, `subject_id`, `subject_name`, `course_id`, `semester_year`) VALUES
(1, 'PGDDVS101', 'Development Theory', 'PGDDVS', 'Year 1'),
(2, 'PGDDVS102', 'Development Research Methods', 'PGDDVS', 'Year 1'),
(3, 'PGDDVS103', 'Development Strategies', 'PGDDVS', 'Year 1'),
(4, 'PGDCSR101', 'Corporate Social Responsibility: Concepts and Principles', 'PGDCSR', 'Year 1'),
(5, 'PGDCSR102', 'CSR and Sustainable Development', 'PGDCSR', 'Year 1'),
(6, 'PGDCSR103', 'CSR Practices in India', 'PGDCSR', 'Year 1'),
(7, 'PGDFCS101', 'Introduction to Folklore', 'PGDFCS', 'Year 1'),
(8, 'PGDFCS102', 'Cultural Studies', 'PGDFCS', 'Year 1'),
(9, 'DIRIL101', 'Retail Management', 'DIRIL', 'Year 1'),
(10, 'DIRIL102', 'Retail Operations', 'DIRIL', 'Year 1'),
(11, 'DIRIL103', 'Customer Relations in Retailing', 'DIRIL', 'Year 1'),
(12, 'CETM101', 'Introduction to Energy Technology', 'CETM', 'Year 1'),
(13, 'CETM102', 'Energy Management Practices', 'CETM', 'Year 1'),
(14, 'BAFEG101', 'English Literature: Fiction', 'BAFEG', 'Semester 1'),
(15, 'BAFEG102', 'English Literature: Poetry and Drama', 'BAFEG', 'Semester 1'),
(16, 'BAFEG103', 'English Language Skills', 'BAFEG', 'Semester 2'),
(17, 'BSCFFSQM101', 'Food Microbiology', 'BSCFFSQM', 'Semester 1'),
(18, 'BSCFFSQM102', 'Food Chemistry', 'BSCFFSQM', 'Semester 1'),
(19, 'BSCFFSQM103', 'Food Safety Standards', 'BSCFFSQM', 'Semester 2'),
(20, 'BSCFMT101', 'Calculus', 'BSCFMT', 'Semester 1'),
(21, 'BSCFMT102', 'Algebra', 'BSCFMT', 'Semester 1'),
(22, 'BSCFMT103', 'Geometry and Trigonometry', 'BSCFMT', 'Semester 2'),
(23, 'MPA101', 'Public Administration Theories', 'MPA', 'Year 1'),
(24, 'MPA102', 'Public Policy and Analysis', 'MPA', 'Year 1'),
(25, 'MPA103', 'Governance and Development', 'MPA', 'Year 1'),
(26, 'BSCFAN101', 'Introduction to Anthropology', 'BSCFAN', 'Semester 1'),
(27, 'BSCFAN102', 'Social and Cultural Anthropology', 'BSCFAN', 'Semester 1'),
(28, 'BSCFAN103', 'Physical Anthropology', 'BSCFAN', 'Semester 2'),
(29, 'BAFPC101', 'General Psychology', 'BAFPC', 'Semester 1'),
(30, 'BAFPC102', 'Developmental Psychology', 'BAFPC', 'Semester 1'),
(31, 'BAFPC103', 'Psychology of Learning', 'BAFPC', 'Semester 2');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `teacher_id` varchar(50) NOT NULL,
  `phone_no` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `teacher_name`, `email`, `teacher_id`, `phone_no`) VALUES
(1, 'Piyush Kumar', 'piyush1672003@gmail.com', '160723', NULL),
(2, 'Sunita', 'piyush1672003+gpt@gmail.com', '31467', NULL),
(3, 'aman singh', 'example@email.com', '4654566', '3164862354');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_info`
--

CREATE TABLE `teacher_info` (
  `teacher_id` int(11) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `teacher_image` varchar(255) DEFAULT NULL,
  `ratings` decimal(3,2) NOT NULL,
  `teacher_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_info`
--

INSERT INTO `teacher_info` (`teacher_id`, `teacher_name`, `teacher_image`, `ratings`, `teacher_description`) VALUES
(1, 'John Doe', 'assets/images/placeholder.jpg', 4.70, 'John is an expert in Computer Science with over 10 years of experience in the field.'),
(2, 'Jane Smith', 'assets/images/placeholder.jpg', 4.90, 'Jane specializes in Business Administration and has guided numerous students to success.'),
(3, 'Robert Brown', 'assets/images/placeholder.jpg', 4.50, 'Robert is a seasoned educator specializing in Economics and Business Studies, with extensive experience in both fields.'),
(4, 'Emily Davis', 'assets/images/placeholder.jpg', 4.60, 'Emily has a background in Finance and is passionate about teaching and research.'),
(5, 'Michael Wilson', 'assets/images/placeholder.jpg', 4.80, 'Michael is known for his practical approach to teaching in Computer Applications.'),
(6, 'Sarah Johnson', 'assets/images/placeholder.jpg', 4.40, 'Sarah is a dedicated educator in the field of Environmental Science and Management.');

-- --------------------------------------------------------

--
-- Table structure for table `timetable_info`
--

CREATE TABLE `timetable_info` (
  `id` int(11) NOT NULL,
  `day_of_week` varchar(50) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject_id` varchar(255) NOT NULL,
  `section` varchar(50) DEFAULT NULL,
  `course_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetable_info`
--

INSERT INTO `timetable_info` (`id`, `day_of_week`, `start_time`, `end_time`, `subject_id`, `section`, `course_id`) VALUES
(1, '5', '16:44:00', '17:45:00', 'PGDDVS101', 'Morning', 'PGDDVS'),
(2, '3', '16:52:00', '17:52:00', 'PGDDVS101', 'Morning', 'PGDDVS'),
(3, '2', '16:53:00', '17:53:00', 'PGDCSR101', 'Morning', 'PGDCSR'),
(4, '1', '17:02:00', '18:02:00', 'PGDDVS102', 'Morning', 'PGDDVS'),
(5, '4', '21:30:00', '23:30:00', 'PGDFCS101', 'Morning', 'PGDFCS'),
(6, '7', '21:39:00', '22:40:00', 'PGDCSR103', 'Evening', 'PGDCSR');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('teacher','student','parent') NOT NULL,
  `user_specific_id` varchar(50) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone_no` varchar(15) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `user_type`, `user_specific_id`, `name`, `phone_no`, `course`) VALUES
(1, 'piyush1672003@gmail.com', '$2y$10$H4hpfw.9kWP00Oc248atZ.AZ9jgdq4G4dE144juSUaAIJNB1791ay', 'teacher', '160723', 'Piyush Kumar', '1234567890', 'BCA'),
(2, 'vk16072003@gmail.com', '$2y$10$iB/uR5Ia15P15VpfXsydbu/mkx1/5NjsxW.c0TDH.xk8u26/GCyPy', 'student', '002365', 'Vinod Kumar', NULL, NULL),
(3, 'sd16072003@gmail.com', '$2y$10$t6mad5TUQhGzhp5584zhT.Xpf4nTl3Fr68pWZqjhw1oiPuxKxQqtS', 'teacher', '002365', 'Sunita', NULL, NULL),
(4, 'piyush072003@gmail.com', '$2y$10$59uw7pyQAruAyZ2uhPsMaugtaxtA0yYEubx626wz2/uLSavul.85y', 'student', '64543', 'Piyush Sharma', NULL, NULL),
(5, 'piyush1672003+gpt@gmail.com', '$2y$10$oeJaGLL4/g9x2VZap7BtP.8I.mo/XFglKBvv338YZvNgR1DLMa0PC', 'teacher', '31467', 'Sunita', NULL, NULL),
(6, 'example@email.com', '$2y$10$JUT446vfmThPSKgjiuJjre2q7oLolaryHnaGg64taafGG7sIZLfry', 'teacher', '4654566', 'aman singh', '3164862354', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_info`
--
ALTER TABLE `course_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_id` (`course_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `subject_info`
--
ALTER TABLE `subject_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subject_id` (`subject_id`),
  ADD UNIQUE KEY `subject_id_2` (`subject_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `teacher_info`
--
ALTER TABLE `teacher_info`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `timetable_info`
--
ALTER TABLE `timetable_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`);

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
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=442;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `course_info`
--
ALTER TABLE `course_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `subject_info`
--
ALTER TABLE `subject_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher_info`
--
ALTER TABLE `teacher_info`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `timetable_info`
--
ALTER TABLE `timetable_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_info` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `subject_info`
--
ALTER TABLE `subject_info`
  ADD CONSTRAINT `subject_info_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course_info` (`course_id`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `timetable_info`
--
ALTER TABLE `timetable_info`
  ADD CONSTRAINT `timetable_info_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject_info` (`subject_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
