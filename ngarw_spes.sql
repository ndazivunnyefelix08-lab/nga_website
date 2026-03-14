-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 10.123.0.150:3306
-- Generation Time: Mar 11, 2026 at 03:13 PM
-- Server version: 8.4.7
-- PHP Version: 8.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ngarw_spes`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_sections`
--
CREATE DATABASE IF NOT EXISTS mysql;
USE mysql;
CREATE TABLE `about_sections` (
  `id` int NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` text,
  `color` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `about_sections`
--

INSERT INTO `about_sections` (`id`, `title`, `content`, `color`) VALUES
(10, 'Mission', 'New Generation Academy\'s mission is to serve and impact the community through educating, nurturing, and caring for children entrusted to us.', 'success'),
(12, 'Core Values', 'These are the values that shape our school:\n\nGodliness\nSteadfastness\nInnovation\nAcademic Excellence\nPatriotism\nServanthood\nUnity in diversity', '');

-- --------------------------------------------------------

--
-- Table structure for table `academic_curriculum`
--

CREATE TABLE `academic_curriculum` (
  `id` int NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `tags` varchar(255) NOT NULL COMMENT 'Comma-separated tags',
  `duration` varchar(50) NOT NULL,
  `course_level` varchar(50) NOT NULL,
  `academic_year` int NOT NULL COMMENT '1, 2, or 3',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Hidden',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `academic_curriculum`
--

INSERT INTO `academic_curriculum` (`id`, `course_code`, `title`, `description`, `tags`, `duration`, `course_level`, `academic_year`, `status`, `created_at`) VALUES
(1, 'CS-101', 'C Programming Fundamentals', 'Deep dive into memory management, pointers, and low-level system architecture.', 'COMPUTER SCIENCE, THEORY', 'Trimester 1', 'Foundation', 1, 1, '0000-00-00 00:00:00'),
(2, 'SE-101', 'Web Application Development (JS)', 'Build dynamic, interactive web apps using modern JavaScript frameworks like React and Next.js.', 'DEVELOPMENT, FUNDAMENTALS', 'Trimester 2', 'Foundation', 1, 1, '0000-00-00 00:00:00'),
(3, 'ENG-101', 'Technical English', 'Master professional communication for international technical environments.', 'COMMUNICATION, WRITING', 'Full Year', 'Foundation', 1, 1, '0000-00-00 00:00:00'),
(4, 'LAN-101', 'Kinyarwanda Communication', 'Deepen cultural understanding and local professional communication skills.', 'LANGUAGES, CULTURE', 'Full Year', 'Foundation', 1, 1, '0000-00-00 00:00:00'),
(5, 'ETH-101', 'Digital Citizenship', 'Navigate the ethical, legal, and social responsibilities of technology.', 'ETHICS, PHILOSOPHY', 'Full Year', 'Intermediate', 1, 1, '0000-00-00 00:00:00'),
(6, 'SE-102', 'Web Application Development (PHP)', 'Create robust server-side applications and secure APIs powering the modern web.', 'ALGORITHMS, DATA STRUCTURES', 'Trimester 1', 'Intermediate', 1, 1, '0000-00-00 00:00:00'),
(7, 'DB-101', 'Basic Database Development', 'Design scalable schemas and write efficient SQL queries for data-driven apps.', 'SQL, DATABASE DESIGN', 'Trimester 1', 'Intermediate', 1, 1, '0000-00-00 00:00:00'),
(8, 'UI-101', 'Web User Interface Design', 'Master the art of creating beautiful, responsive, and accessible web interfaces.', 'DESIGN, FIGMA', 'Trimester 2', 'Intermediate', 1, 1, '0000-00-00 00:00:00'),
(9, 'NW-201', 'Networking Fundamentals', 'Architect secure and reliable computer networks and communication protocols.', 'NETWORKING, PROTOCOLS', 'Trimester 3', 'Advanced', 1, 1, '0000-00-00 00:00:00'),
(10, 'EE-201', 'Electrical & Electronic Circuits', 'Analyze and design complex analog/digital circuits and optical instruments.', 'CIRCUITS, ELECTRONICS', 'Trimester 2', 'Advanced', 1, 1, '0000-00-00 00:00:00'),
(11, 'CS-101', 'C Programming Fundamentals', 'Deep dive into memory management, pointers, and low-level system architecture.', 'COMPUTER SCIENCE, THEORY', 'Trimester 1', 'Foundation', 2, 1, '0000-00-00 00:00:00'),
(12, 'SE-101', 'Web Application Development (JS)', 'Build dynamic, interactive web apps using modern JavaScript frameworks like React and Next.js.', 'DEVELOPMENT, FUNDAMENTALS', 'Trimester 2', 'Foundation', 2, 1, '0000-00-00 00:00:00'),
(13, 'ENG-101', 'Technical English', 'Master professional communication for international technical environments.', 'COMMUNICATION, WRITING', 'Full Year', 'Foundation', 2, 1, '0000-00-00 00:00:00'),
(14, 'LAN-101', 'Kinyarwanda Communication', 'Deepen cultural understanding and local professional communication skills.', 'LANGUAGES, CULTURE', 'Full Year', 'Foundation', 2, 1, '0000-00-00 00:00:00'),
(15, 'ETH-101', 'Digital Citizenship', 'Navigate the ethical, legal, and social responsibilities of technology.', 'ETHICS, PHILOSOPHY', 'Full Year', 'Intermediate', 2, 1, '0000-00-00 00:00:00'),
(16, 'SE-102', 'Web Application Development (PHP)', 'Create robust server-side applications and secure APIs powering the modern web.', 'ALGORITHMS, DATA STRUCTURES', 'Trimester 1', 'Intermediate', 2, 1, '0000-00-00 00:00:00'),
(17, 'DB-101', 'Basic Database Development', 'Design scalable schemas and write efficient SQL queries for data-driven apps.', 'SQL, DATABASE DESIGN', 'Trimester 1', 'Intermediate', 2, 1, '0000-00-00 00:00:00'),
(18, 'UI-101', 'Web User Interface Design', 'Master the art of creating beautiful, responsive, and accessible web interfaces.', 'DESIGN, FIGMA', 'Trimester 2', 'Intermediate', 2, 1, '0000-00-00 00:00:00'),
(19, 'NW-201', 'Networking Fundamentals', 'Architect secure and reliable computer networks and communication protocols.', 'NETWORKING, PROTOCOLS', 'Trimester 3', 'Advanced', 2, 1, '0000-00-00 00:00:00'),
(20, 'EE-201', 'Electrical & Electronic Circuits', 'Analyze and design complex analog/digital circuits and optical instruments.', 'CIRCUITS, ELECTRONICS', 'Trimester 2', 'Advanced', 2, 1, '0000-00-00 00:00:00'),
(21, 'CS-101', 'C Programming Fundamentals', 'Deep dive into memory management, pointers, and low-level system architecture.', 'COMPUTER SCIENCE, THEORY', 'Trimester 1', 'Foundation', 3, 1, '0000-00-00 00:00:00'),
(22, 'SE-101', 'Web Application Development (JS)', 'Build dynamic, interactive web apps using modern JavaScript frameworks like React and Next.js.', 'DEVELOPMENT, FUNDAMENTALS', 'Trimester 2', 'Foundation', 3, 1, '0000-00-00 00:00:00'),
(23, 'ENG-101', 'Technical English', 'Master professional communication for international technical environments.', 'COMMUNICATION, WRITING', 'Full Year', 'Foundation', 3, 1, '0000-00-00 00:00:00'),
(24, 'LAN-101', 'Kinyarwanda Communication', 'Deepen cultural understanding and local professional communication skills.', 'LANGUAGES, CULTURE', 'Full Year', 'Foundation', 3, 1, '0000-00-00 00:00:00'),
(25, 'ETH-101', 'Digital Citizenship', 'Navigate the ethical, legal, and social responsibilities of technology.', 'ETHICS, PHILOSOPHY', 'Full Year', 'Intermediate', 3, 1, '0000-00-00 00:00:00'),
(26, 'SE-102', 'Web Application Development (PHP)', 'Create robust server-side applications and secure APIs powering the modern web.', 'ALGORITHMS, DATA STRUCTURES', 'Trimester 1', 'Intermediate', 3, 1, '0000-00-00 00:00:00'),
(27, 'DB-101', 'Basic Database Development', 'Design scalable schemas and write efficient SQL queries for data-driven apps.', 'SQL, DATABASE DESIGN', 'Trimester 1', 'Intermediate', 3, 1, '0000-00-00 00:00:00'),
(28, 'UI-101', 'Web User Interface Design', 'Master the art of creating beautiful, responsive, and accessible web interfaces.', 'DESIGN, FIGMA', 'Trimester 2', 'Intermediate', 3, 1, '0000-00-00 00:00:00'),
(29, 'NW-201', 'Networking Fundamentals', 'Architect secure and reliable computer networks and communication protocols.', 'NETWORKING, PROTOCOLS', 'Trimester 3', 'Advanced', 3, 1, '0000-00-00 00:00:00'),
(30, 'EE-201', 'Electrical & Electronic Circuits', 'Analyze and design complex analog/digital circuits and optical instruments.', 'CIRCUITS, ELECTRONICS', 'Trimester 2', 'Advanced', 3, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `academy_blogs`
--

CREATE TABLE `academy_blogs` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `image_path` varchar(255) DEFAULT NULL,
  `author` varchar(100) DEFAULT 'Admin',
  `post_date` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `academy_blogs`
--

INSERT INTO `academy_blogs` (`id`, `title`, `content`, `image_path`, `author`, `post_date`, `status`) VALUES
(3, 'IOAI, UNESCO and MINICT delegates visit NGA', 'On November 19th, New Generation Academy proudly welcomed esteemed delegates from the International Olympiad in Artificial Intelligence (IOAI), UNESCO, and Rwanda\'s Ministry of ICT and Innova...', 'https://nga-web-demo.vercel.app/_next/static/media/r-image3.6b049a07.png', 'NGA', '2026-02-26', 1),
(4, 'Rwanda has inaugurated a state-of-the-art robotics laboratory worth 100 million Frw', 'Rwanda has inaugurated a state-of-the-art robotics laboratory at New Generation Academy, valued at 100 million Rwandan francs. This facility aims to advance students\' knowledge in coding and...', 'https://nga-web-demo.vercel.app/_next/static/media/r-image1.cd7e6ad2.png', 'NGA', '2026-02-26', 1),
(5, 'Imbaraga u Rwanda rwashyize mu ikoranabuhanga zatangiye kubyara imbuto', 'IKoranabuhanga ry\'ubwenge buhangano. Robo (Robots) +Artificial Intelligence', 'https://nga-web-demo.vercel.app/_next/static/media/r-image2.11f16028.png', 'NGA', '2026-02-26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `academy_features`
--

CREATE TABLE `academy_features` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `display_order` int DEFAULT '0',
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `academy_programs`
--

CREATE TABLE `academy_programs` (
  `id` int NOT NULL,
  `program_number` varchar(10) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `image_url` varchar(255) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT '#',
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `academy_programs`
--

INSERT INTO `academy_programs` (`id`, `program_number`, `title`, `description`, `image_url`, `link_url`, `status`, `created_at`) VALUES
(1, '01', 'Software Development Foundations', 'Students build strong programming and problem-solving skills...', 'https://media.giphy.com/media/SWoSkN6DxTszqIKEqv/giphy.gif', '#', 1, '2026-02-25 20:01:27'),
(2, '02', 'Embedded Systems & IoT', 'Learners gain hands-on experience working with microcontrollers...', 'https://media2.giphy.com/media/v1.Y2lkPTc5MGI3NjExZXE0dTh3Y2w0cjZuY2R6NmZmd213N2dpbGVwN201aHUzaGhmb3oyNCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/U1Bd0YJSjuxLzmBNQX/giphy.gif', '#', 1, '2026-02-25 20:01:27'),
(3, '03', 'Robotics & Intelligent Automation', 'The program blends mechanical, electronic, and programming skills...', 'https://media4.giphy.com/media/v1.Y2lkPTc5MGI3NjExZ3Y1dmo5Z3pvMHFvcTNqeWl5bWU5ajVhNXR6NXBpdzZ1aDZuc3Z5ZCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/ajOEvSqe0KfXE8UGTA/giphy.gif', '#', 1, '2026-02-25 20:01:27');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `created_at`) VALUES
(2, 'faustin.niyitegeka@gmail.com', 'admin@123', '2025-12-10 12:52:29'),
(3, 'ingachrina@gmail.com', 'Madoudou@2025', '2026-03-08 08:22:08'),
(4, 'emmanuelniyongabo44@gmail.com', NULL, '2026-03-08 08:23:54'),
(5, 'tuyishimireericc@gmail.com', NULL, '2026-03-08 08:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `assignement_Instructor`
--

CREATE TABLE `assignement_Instructor` (
  `id` int NOT NULL,
  `student_name` varchar(100) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `project_title` varchar(100) DEFAULT NULL,
  `description` text,
  `file_path` varchar(100) DEFAULT NULL,
  `website_url` varchar(100) DEFAULT NULL,
  `uploaded_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignement_Instructor`
--

INSERT INTO `assignement_Instructor` (`id`, `student_name`, `category`, `project_title`, `description`, `file_path`, `website_url`, `uploaded_on`) VALUES
(4, '', 'Software Programming', 'End of PHP fundamentals Assignement', 'End of PHP fundamentals Assignement: \r\no	You must clearly explain your logic, how each operator or condition works, and why your output is correct.\r\no	If you fail to explain your code, your work will not be accepted even if it runs correctly.\r\n', 'uploads/4 Nov 2025 PHP Assignement 3.pdf', '', '2025-11-05 06:11:36'),
(5, '', 'Software Programming', 'Interpret database design documents Assignement', 'Case Studies:\r\nYou are developing a simple Education Management System for a school. The system allows teachers to register students, assign courses, and record marks. The system should store all data in a database and display student progress clearly. Answer The Following questions\r\n', 'uploads/Database Assignement On 4 Nov 2025.pdf', '', '2025-11-05 06:38:28'),
(6, '', 'Software Programming & Embedded System', 'Answer of database assignement', 'I have thoroughly reviewed the case study, and the following responses present the solutions to all specified requirements.', 'uploads/Answers of Database Assignement On 4 Nov 2025.pdf', '', '2025-11-24 06:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int NOT NULL,
  `student_id` int DEFAULT NULL,
  `teacher_id` int DEFAULT NULL,
  `subject_id` int DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `uploaded_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `student_id`, `teacher_id`, `subject_id`, `file_path`, `uploaded_at`) VALUES
(2, 2, 19, 2, 'uploads/assignments/assign_2_1761026498.pdf', '2025-10-21 08:01:38'),
(3, 5, 19, 2, 'uploads/assignments/assign_5_1761026620.pdf', '2025-10-21 08:03:40'),
(4, 4, 19, 2, 'uploads/assignments/assign_4_1761027167.pdf', '2025-10-21 08:12:47'),
(6, 36, 19, 2, 'uploads/assignments/assign_36_1761028475.pdf', '2025-10-21 08:34:35'),
(7, 37, 19, 2, 'uploads/assignments/assign_37_1761028581.pdf', '2025-10-21 08:36:21'),
(8, 7, 2, 2, 'uploads/assignments/assign_7_1761028584.pdf', '2025-10-21 08:36:24'),
(9, 38, 19, 2, 'uploads/assignments/assign_38_1761029180.pdf', '2025-10-21 08:46:20'),
(10, 3, 19, 2, 'uploads/assignments/assign_3_1761029328.pdf', '2025-10-21 08:48:48'),
(11, 8, 19, 2, 'uploads/assignments/assign_8_1761029523.pdf', '2025-10-21 08:52:03'),
(13, 7, 19, 2, 'uploads/assignments/assign_7_1761030551.pdf', '2025-10-21 09:09:11'),
(14, 5, 19, 2, 'uploads/assignments/assign_5_1761041180.pdf', '2025-10-21 12:06:20'),
(15, 5, 19, 2, 'uploads/assignments/assign_5_1761635711.pdf', '2025-10-28 09:15:11'),
(16, 43, 19, 2, 'uploads/assignments/assign_43_1761635758.pdf', '2025-10-28 09:15:58'),
(17, 42, 19, 2, 'uploads/assignments/assign_42_1761635807.pdf', '2025-10-28 09:16:47'),
(18, 42, 19, 2, 'uploads/assignments/assign_42_1761635990.pdf', '2025-10-28 09:19:50'),
(19, 42, 19, 2, 'uploads/assignments/assign_42_1761636907.pdf', '2025-10-28 09:35:07'),
(20, 4, 19, 3, 'uploads/assignments/assign_4_1763446831.zip', '2025-11-18 08:20:31'),
(21, 5, 19, 3, 'uploads/assignments/assign_5_1763447163.zip', '2025-11-18 08:26:03'),
(22, 43, 19, 2, 'uploads/assignments/assign_43_1763458992.pdf', '2025-11-18 11:43:12'),
(23, 43, 19, 2, 'uploads/assignments/assign_43_1763458994.pdf', '2025-11-18 11:43:14'),
(24, 42, 19, 2, 'uploads/assignments/assign_42_1763459009.pdf', '2025-11-18 11:43:29'),
(25, 37, 19, 2, 'uploads/assignments/assign_37_1763459235.pdf', '2025-11-18 11:47:15'),
(26, 5, 19, 2, 'uploads/assignments/assign_5_1763460891.pdf', '2025-11-18 12:14:51');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chatid` int NOT NULL,
  `chat_room_id` int DEFAULT NULL,
  `chat_msg` text,
  `userid` int DEFAULT NULL,
  `chat_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chatid`, `chat_room_id`, `chat_msg`, `userid`, `chat_date`) VALUES
(12, 1, 'Hello class\n', 8, '2025-10-14 15:58:26'),
(13, 1, 'This platform allows us to ask questions, share ideas or suggestions, and communicate with one another. Thank you ', 8, '2025-10-14 16:01:08'),
(14, 1, 'Hello\n', 3, '2025-10-17 09:51:39'),
(16, 1, '\nDear Classmates, You can log in to our platform to submit your assignments. On tuesday, we will allow presentations only for students who have submitted their assignments. use this  Link: https://nga.hts.rw/index.php,  Then click \"Login to your account\". Use your email and the following passwords to log in: Alpha123,  Levi123,  Camilla123, Kelvin123, Deborah123, Tiana123. ', 8, '2025-10-18 14:04:24'),
(17, 1, 'Every one can Change his Password \n', 8, '2025-10-18 14:04:48'),
(18, 1, 'Hello Class\n', 8, '2025-10-23 10:26:27'),
(19, 1, 'i am sorry but i didn\'t see the quiz that we are supposed to have today?\n', 1, '2025-10-26 16:42:08');

-- --------------------------------------------------------

--
-- Table structure for table `chat_room`
--

CREATE TABLE `chat_room` (
  `chat_room_id` int NOT NULL,
  `chat_room_name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_room`
--

INSERT INTO `chat_room` (`chat_room_id`, `chat_room_name`) VALUES
(1, 'New Generation Academy');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int NOT NULL,
  `class_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_name`) VALUES
(1, 'Grade 1'),
(3, 'Grade 2'),
(5, 'Grade 3'),
(6, 'Grade 4'),
(7, 'Grade 5'),
(8, 'Grade 6'),
(9, 'Grade 7'),
(10, 'Grade 8'),
(11, 'Grade 9'),
(12, 'SPES');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `recurring` enum('Yes','No') DEFAULT 'No',
  `donation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `body` text,
  `image` varchar(255) NOT NULL,
  `is_display` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `body`, `image`, `is_display`, `created_at`) VALUES
(2, 'Inauguration of the National Robotics Maker Lab at New Generation Academy', 'New Generation Academy (NGA) is proud to announce the launch of our Robotics Maker Lab, established through the generous support of GIZ, in partnership with the Government of Rwanda and MINICT (Ministry of ICT and Innovation). Officially inaugurated on November 5, this facility serves as a hub of innovation for students and teachers across Kigali, bridging the technology gap and bringing hands-on learning in robotics and design to learners of all ages. Equipped with advanced tools—including virtual reality headsets, 3D printers, and laser cutters—the lab enables practical, interactive education in STEM (Science, Technology, Engineering, and Math) fields. Students can immerse themselves in virtual environments, create detailed designs with precision, and bring projects to life with 3D printing and laser cutting. Accessible to learners across Kigali, the Robotics Maker Lab is available for use during both regular school hours and holiday programs, providing unique opportunities for hands-on learning to students within and beyond our campus. This initiative, supported by the Ministry of ICT and Innovation, aligns with Rwanda’s competence-based curriculum and contributes to building a future-ready generation.\r\n\r\nVenue: New Generation Academy Rugando Campus\r\nMain Speaker: Iradukunda Yves (PS - MINICT) and Malik Schwarz (Country Director - GIZ)', 'uploads/events/1765519752_Innau.png', 'no', '2025-12-10 14:10:40'),
(3, 'NGA has become the ambassador of the Rwandan Government Robotics 4 Youth program', 'On this Friday 13th October New Generation Academy (NGA), Ministry of ICT and Innovation (MINICT) and Digital Solutions for Sustainable Development (DSSD) project of GIZ signed a memorandum of understanding (MoU) as an agreement to build a robotic maker laboratory at New Generation Academy. The laboratory to be built will serve the whole country by not only being a laboratory of reference in Robotics but also supporting the National Robotics Programe. By signing this MoU, NGA committed to become an ambassador of the Rwandan Government Robotics for Youth program. The objective of this joint statement is to establish a robotics lab at NGA, for its students and teachers’ use. This lab will also be accessible to stakeholders such as innovators, teachers and other people involved in the national robotics program. The MoU was signed by:\r\n\r\nTuyisenge Jean Claude (Managing Director of NGA)\r\nNorman Schraepel (GIZ)\r\nIradukunda Yves (PS - MINICT)\r\nThe MoU is for a period of two (2) years starting from 13th October 2023 to 30th December 2025 but may be extended for a subsequent period of 2 years (period) by agreement of the signed parties.\r\nVenue: #\r\nMain Speaker: #', 'uploads/events/1765519615_Innoguration.png', 'yes', '2025-12-10 14:11:10'),
(4, 'Kigali’s New Generation Academy leads AI education, gears up for global competition', 'The New Generation Academy in Kigali on November 19 hosted a delegation from the International Olympiad in Artificial Intelligence (IOAI), UNESCO, and a representative from Rwanda’s Ministry of ICT and Innovation as part of the announcement of Rwanda’s certification as the first IOAI hub in Africa.\r\n\r\nThe school, which follows the Cambridge curriculum, is pioneering the integration of AI into its educational programmes, aiming to teach students from nursery through to secondary school.\r\n\r\nDuring the visit, students showcased their AI projects, including robotics, drones, and traffic light systems, demonstrating the school’s commitment to emerging technologies.\r\n\r\nAlthough AI education in Rwanda is still in its early stages, the New Generation Academy’s initiatives are seen as vital for preparing the next generation to compete in global AI competitions.\r\nAccording to Jean-Claude Tuyisenge, the founder and managing director of New Generation Academy, the school is committed to integrating artificial intelligence (AI) into its curriculum, starting from the earliest levels, emphasising the importance of embracing AI despite differing options on the technology.\r\n\r\n“We have already started to develop the curriculum for AI and want to incorporate it so that students from kindergarten up to grade 9 can learn artificial intelligence,” he said.\r\n\r\nTuyisenge expressed confidence in the school’s ability to compete at high levels, noting that New Generation Academy has already participated in and won competitions for high school students, even though the school serves primary and lower secondary students.\r\n\r\n“We are confident that we can compete with high school students. We have been doing that, and we’ve won many competitions even though they were organised for secondary students,” he stated.\r\n\r\nNew Generation Academy is focused on integrating AI into its curriculum from an early age to help prepare students for the rapidly advancing field of technology.\r\n\r\nDuring her visit to New Generation Academy in Kigali, Elena Marinova, co-founder and chair of the International Olympiad in Artificial Intelligence (IOAI), recognised the school’s dedication to developing young talents, underscoring the potential impact of AI on the future.\r\n\r\nShe was impressed by the students’ projects, which included robotics, drones, traffic lights, and 3D printing, noting the depth of their work and the enthusiasm of both students and teachers.\r\n\r\n“I am very positively surprised by the enthusiasm of the teachers and the kids and the depth of the projects they are working on. Although these students are still in grade 7 or 8, I’m confident that in a few years, they will be ready to compete at the highest levels,” Marinova said.\r\nAlpha Mpore Mugisha, a Grade 8 student who demonstrated drone operations during the visit, , shared his admiration for how companies like zipline operates explaining that his aspiration are to integrate artificial intelligence into drone systems to enhance their efficiency.\r\n\r\n\"Drones often lose signal while in operation, and I would like to explore ways to integrate AI into the systems controlling drones. My goal is to ensure that if an issue arises during operation, the AI can automatically find a solution and allow the drone to continue delivering services effectively,\" he said.\r\n\r\nFor Gaella Ninziza Ndizihiwe, also in Grade 8, demonstrated her understanding of traffic light systems and how she programs them using coding during her presentation, she was asked a question on what she could do if a traffic light turns green for a road with no cars while the road with more cars remains red?\r\n\r\nShe responded, suggesting that the integration of AI into traffic light programming could help optimize traffic flow.\r\n\r\n\"Since traffic lights are usually pre-programmed, I believe AI could be integrated to allow the system to adapt and respond dynamically based on real-time traffic conditions, ensuring that traffic lights prioritize roads with heavier traffic,\" she explained.\r\n\r\nALSO READ: How coding training nurtures software developers from Mahama refugee camp\r\n\r\nDominique Mvunabandi, the Director of Science, Technology, and Innovations at UNESCO Rwanda National Commission, emphasised that the purpose of the visit to the New Generation Academy was to assess Rwanda’s readiness to host the International AI Olympiad.\r\n\r\nMvunabandi noted that the visit aimed to explore Rwanda’s AI facilities, infrastructure, and expertise, gathering insights to help organise the competition in collaboration with UNESCO and the Bulgarian National Commission.\r\n\r\n“We are evaluating the pool of knowledge and expertise here in Rwanda to see how we can support the AI Olympiad. The competition will culminate in the International AI Olympiad next year, which will be held in China, with Rwanda poised to send its best candidates to represent the country,” he explained.\r\n\r\nMvunabandi also highlighted that the competition, which will feature different categories for both students and teachers, will include advanced technologies like robotics, AI, virtual reality, and drone technology.\r\n\r\nDirector of the Department of Innovation and Emerging Technologies at the Ministry of ICT and Innovation, Victor Muvunyi, explained that Rwanda’s goal is to involve at least 10 African nations, and with the support of Smart Africa, they expect that number to rise.\r\n\r\nHe emphasised the importance of incorporating AI into the national curriculum, which remains a work in progress, and expressed hope that other schools in Rwanda would follow New Generation Academy’s example in integrating emerging technologies.\r\n\r\n“We are working with partners to level up countries in AI, and Rwanda is proud to be at the forefront of this effort,” he said.\r\n\r\nHe also commended New Generation Academy for its role in promoting AI education, noting the impressive innovations showcased at the school, such as robots built from recyclable materials.', 'uploads/events/1765520261_kigali.png', 'yes', '2025-12-12 06:17:41'),
(5, 'Imbaraga u Rwanda rwashyize mu ikoranabuhanga zatangiye kubyara imbuto', '<iframe width=\"100%\" height=\"400\"\r\nsrc=\"https://www.youtube.com/embed/m4ezDWNdda0\"\r\ntitle=\"YouTube video player\" \r\nframeborder=\"0\" \r\nallow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" \r\nallowfullscreen>\r\n</iframe>\r\n\r\n', 'uploads/events/1765520472_IMG_2739-min.jpg', 'yes', '2025-12-12 06:21:12'),
(6, 'Rwanda\'s IT revolution: A driving force for sustainable economic development', '<iframe width=\"100%\" height=\"400\"\r\nsrc=\"https://www.youtube.com/embed/X3ED1qWzXeM\"\r\ntitle=\"YouTube video player\" \r\nframeborder=\"0\" \r\nallow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" \r\nallowfullscreen>\r\n</iframe>\r\n', 'uploads/events/1765521006_Innau.png', 'no', '2025-12-12 06:30:06');

-- --------------------------------------------------------

--
-- Table structure for table `innovation_pillars`
--

CREATE TABLE `innovation_pillars` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon_svg` text,
  `display_order` int DEFAULT '0',
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `innovation_pillars`
--

INSERT INTO `innovation_pillars` (`id`, `title`, `description`, `icon_svg`, `display_order`, `status`) VALUES
(1, 'Research & Development', 'Turning abstract ideas into concrete prototypes and conducting market-aligned research.', '', 1, 1),
(2, 'STEM & Robotics Labs', 'Hands-on engineering challenges exploring automated systems and intelligent algorithms.', '', 2, 1),
(3, 'Digital Entrepreneurship', 'Nurturing the startup spirit, teaching business acumen, and pitch strategies.', '', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `innovation_sliders`
--

CREATE TABLE `innovation_sliders` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `list_item_1` text,
  `list_item_2` text,
  `image_url` varchar(255) NOT NULL,
  `display_order` int DEFAULT '0',
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `innovation_sliders`
--

INSERT INTO `innovation_sliders` (`id`, `title`, `description`, `list_item_1`, `list_item_2`, `image_url`, `display_order`, `status`) VALUES
(1, 'Clean & Creative Digital Solutions.', 'There are lots of reasons, but most importantly because we deliver seamless digital experiences. Lorem ipsum dolor sit amet.', 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum.', 'Duis sed odio sit amet nibh vulputate cursus a sit amet mauris.', 'uploads/innovation_slide1.jpg', 1, 1),
(2, 'Modern & Scalable Architecture.', 'Building robust platforms designed to grow. We focus on maintainable codebases and future-proof technologies.', 'Advanced system design that supports high traffic volumes.', 'Secure by default. Implementing the latest industry standards in data protection.', 'uploads/innovation_slide2.jpg', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','unsubscribed') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `subscribed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletter_subscribers`
--

INSERT INTO `newsletter_subscribers` (`id`, `name`, `email`, `status`, `subscribed_at`) VALUES
(1, 'Niyongabo Emmanuel', 'emmanuelniyongabo44@gmail.com', 'active', '2026-02-25 19:01:29'),
(2, 'Fautsin NIYTEGEKA', 'faustin.niyitegeka@gmail.com', 'active', '2026-02-25 19:05:34'),
(3, 'Felix', 'ndazivunnyefelix08@gmail.com', 'active', '2026-02-26 14:21:29'),
(4, 'Eric Tuyishimire', 'tuyishimireericc@gmail.com', 'active', '2026-02-26 14:38:29'),
(5, 'Fortressija', 'veloshini@cbsafrica.net', 'active', '2026-02-27 06:29:05'),
(6, 'Blenderpdr', 'nltorsky185@gmail.com', 'active', '2026-02-28 02:07:53'),
(7, 'NSHIMIYIMANA Elissa', 'nshimiyimanaelissa462@gmail.com', 'active', '2026-03-10 09:01:35'),
(8, 'jdfeketkfl', 'upkumzkw@checkyourform.xyz', 'active', '2026-03-11 00:50:07'),
(9, 'qyzpxpjpir', 'ngfgwhsz@checkyourform.xyz', 'active', '2026-03-11 00:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `page_settings`
--

CREATE TABLE `page_settings` (
  `id` int NOT NULL,
  `meta_key` varchar(100) DEFAULT NULL,
  `meta_value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `page_settings`
--

INSERT INTO `page_settings` (`id`, `meta_key`, `meta_value`) VALUES
(1, 'mission', 'To provide high-quality, competency-based training in Software Programming...'),
(2, 'vision', 'To shape future-ready careers by delivering excellence...');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `partner_id` int UNSIGNED NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `logo_path` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT '#',
  `display_order` int DEFAULT '0',
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`partner_id`, `category_name`, `name`, `logo_path`, `url`, `display_order`, `status`) VALUES
(12, 'No_Profit', 'Digital Media Academy', 'partners/1765692182_digital media.png', 'https://digitalmediaacademy.org/', 1, 1),
(13, 'Private Sector', 'Bank of KIgali', 'partners/1765692229_bk.jpg', 'https://bk.rw/personal', 1, 1),
(14, 'Private Sector', 'Radiant', 'partners/1765692271_radiant.png', 'https://radiant.co.rw/', 1, 1),
(15, 'No_Profit', 'British Council', 'partners/1765692326_british.jpg', 'https://www.britishcouncil.org/', 1, 1),
(16, 'No_Profit', 'Edify', 'partners/1765692459_edify.jpg', 'https://edify.org/', 1, 1),
(17, 'No_Profit', 'Institut Français ', 'partners/1765692672_institut francais.png', 'https://if-rwanda.org/', 1, 1),
(18, 'Government', 'Rwanda Education Board', 'partners/1765693300_reb.png', 'https://www.reb.gov.rw/home', 1, 1),
(19, 'No_Profit', 'GIZ', 'partners/1765693336_giz.png', 'https://www.giz.de/en', 1, 1),
(20, 'Private Sector', 'Rwanda Coding Academy', 'partners/1765693370_rca.png', 'https://rca.ac.rw/', 1, 1),
(21, 'No_Profit', 'Cambridge International', 'partners/1765693415_cambrig.png', 'https://www.cambridgeinternational.org/', 1, 1),
(22, 'Government', 'Ministry of ICT & Innovation', 'partners/1766049897_miniict.png', 'https://www.minict.gov.rw/', 1, 1),
(23, 'Government', 'MINISPORTS', 'partners/1766049753_minisport.png', 'https://www.minisports.gov.rw/', 1, 1),
(24, 'No_Profit', 'The Stirling Foundation', 'partners/1766046346_String Foundation.png', 'https://thestirlingfoundation.org/', 1, 1),
(25, 'Government', 'Rwanda Civil Aviation Authority', 'partners/1766046459_LOGO_RCAA.png', 'https://www.caa.gov.rw/', 1, 1),
(26, 'Government', 'Rwanda TVET Board', 'partners/1766049298_logortb.jpg', 'https://www.rtb.gov.rw/', 1, 1),
(27, 'Government', 'Ministry of Education', 'partners/1766049528_mineduc.png', 'https://www.mineduc.gov.rw/', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_info`
--

CREATE TABLE `personal_info` (
  `id` int UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `date_of_birth` date NOT NULL,
  `marital_status` varchar(20) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email_address` varchar(150) NOT NULL,
  `reference_person_phone` varchar(20) DEFAULT NULL,
  `national_id_number` varchar(50) DEFAULT NULL,
  `nationality` varchar(100) NOT NULL,
  `program_id` varchar(100) NOT NULL,
  `country_of_residence` varchar(100) NOT NULL,
  `sponsor` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `sector` varchar(100) DEFAULT NULL,
  `cell` varchar(100) NOT NULL,
  `village` varchar(100) NOT NULL,
  `residence_district` varchar(100) DEFAULT NULL,
  `disability` varchar(50) DEFAULT 'None',
  `passport_photo_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `personal_info`
--

INSERT INTO `personal_info` (`id`, `first_name`, `last_name`, `father_name`, `mother_name`, `gender`, `date_of_birth`, `marital_status`, `phone_number`, `email_address`, `reference_person_phone`, `national_id_number`, `nationality`, `program_id`, `country_of_residence`, `sponsor`, `province`, `district`, `sector`, `cell`, `village`, `residence_district`, `disability`, `passport_photo_path`, `created_at`) VALUES
(6, 'SteveJepAL', 'SteveJepAL', 'SteveJep', 'SteveJep', 'Male', '0000-00-00', '', '88987543392', 'pavlov-9ao9i@rambler.ua', '83345433741', 'Singaporean', 'russian', '', 'China', 'Mike Anderson', '21', '', '', '', '', '', 'Visual', 'uploads/passports/1766041314_bg.jpg', '2025-12-13 12:01:58'),
(9, 'Rurangwa Ngenzi', 'Davis ', 'Africa Aimable', 'Muragijimana Alice ', 'Male', '2010-06-06', 'Single', '0783264667', 'ngenzidavis@gmail.com', '0783264667', '   .', 'Rwanda ', '', 'Rwanda ', '', 'Southern ', 'Muhanga', 'Cyeza ', '', '', '', 'None', '', '2025-12-14 18:20:19'),
(10, 'SamuelGemUE', 'SamuelGemUE', 'SamuelGem', 'SamuelGem', '1', '0000-00-00', 'Divorced', '89947379545', 'elenakifixo@mail.ru', '88275282366', 'British', 'russian', '', 'Hungary', 'Swoozie', '227', 'CentOS 5.1', 'Denzel washington', '', '', '', 'Physical', '', '2025-12-15 08:55:58'),
(14, 'RoyapseBoypebotAE', 'RoyapseBoypebotAE', 'RoyapseBoypebot', 'RoyapseBoypebot', '1', '0000-00-00', 'Married', '83358233482', 'kip@prohabits.es', 'Nursery Program', 'RoyapseBoypebot', 'russian', '12', 'China', 'Will Smith', '496', 'Debian', 'Clint Eastwood', 'Former TBC', 'Montpellier', '', 'Visual', '', '2025-12-18 10:59:43'),
(15, 'swusafmeknmdcvrGP', 'xzusalmevteuckbGP', 'Incipiojuy', 'Incipiojuy', '1', '0000-00-00', 'Divorced', '84776989957', 'janicefortes@hotmail.com', 'Nursery Program', 'Incipiowvq', 'russian', '12', 'USA', 'Jason Lake', '14', 'Debian', 'Clint Eastwood', '......', 'FAR', '', 'Visual', '', '2025-12-20 07:02:02'),
(17, 'ThomasnugGP', 'ThomasnugGP', 'Thomasnug', 'Thomasnug', '1', '0000-00-00', 'Divorced', '82324397786', 'imanelill2595@hotmail.com', 'Nursery Program', 'Thomasnug', 'russian', '12', 'Armenia', 'Mike Anderson', '458', 'Vista x64 Ultimate', 'Denzel washington', 'BUSINESS SKILLS', 'Toulouse', '', 'Visual', '', '2025-12-23 19:52:55'),
(18, '* * * $3,222 deposit available! Confirm your operation here: https://google.com * * * hs=f2edd5abe46', '8rsuul', '18jzgo', 'c84lod', '', '0000-00-00', '', 'qt3ao9', 'ydx~nwa9pwyxz@mailbox.in.ua', 'General Registration', 'rwcw6y', 'eityov', '', 'g8ve09', 'z01rrw', 'welrd7', 'jmg888', 'fte0sw', 'q0fsdv', '67n7d7', '', 'Visual', 'uploads/passports/1766687995_photo1.jpg', '2025-12-25 18:39:55'),
(21, 'zvusafmegtohdzyGP', 'zzusafme3mtjdbzGP', 'Glassmqk', 'Glassmqk', '1', '0000-00-00', 'Divorced', '86719551344', 'rocioduque@nevhc.org', 'Nursery Program', 'Glasslla', 'russian', '12', 'USA', 'Mike Anderson', '448', 'Windows XP', 'Denzel washington', 'BUSINESS SKILLS', 'Kansas, USA', '', 'Physical', '', '2025-12-26 13:31:29'),
(22, 'MatthewrofDN', 'MatthewrofDN', 'Matthewrof', 'Matthewrof', 'Female', '0000-00-00', 'Married', '88377897845', 'rya.n.w.h.it.e5.4.7.6.34.@gmail.com', 'Nursery Program', 'Matthewrof', 'russian', '12', 'Cambodia', 'Jason Lake', '388', 'Vista', 'Sean Connery', 'Bsc', 'Dans la Sarthe', '', 'Physical', '', '2025-12-28 15:52:48'),
(23, 'KeithCrushBL', 'KeithCrushBL', 'KeithCrush', 'KeithCrush', '1', '0000-00-00', 'Divorced', '81489559425', 'hannema4200@hotmail.com', 'Nursery Program', 'KeithCrush', 'russian', '12', 'Sweden', 'Mike Anderson', '507', 'Windows XP', 'Sean Connery', 'BUSINESS SKILLS', 'Montpellier', '', 'Visual', '', '2026-01-02 01:40:11'),
(26, 'lp1qj1gvx', 'bfu29z', 'l130co', 'yeubnx', '', '0000-00-00', '', 's5rnb6', '71bq2on5p@73z4b.com', 'General Registration', 'j9o3na', 'w5vz1c', '', 'g76224', '0j52q9', 'v0tayq', 'bi48u9', '921d00', 'oqb388', 'bjqrib', '', 'Visual', 'uploads/passports/1767419178_doc.php', '2026-01-03 05:46:18'),
(27, 'szusaymeamoucjbGP', 'xzusalmeonsizhfGP', 'Flashpaqgtj', 'Flashpaqgtj', '1', '0000-00-00', 'Married', '85234341585', 'wrightfamchiro@gmail.com', 'Nursery Program', 'Flashpaqelt', 'russian', '12', 'USA', 'Jason Lake', '227', 'Windows XP', 'Denzel washington', 'MTU', 'PARIS AREA', '', 'Physical', '', '2026-01-04 08:41:11'),
(28, 'svusafmestmyddiGP', 'xvusalmeomcfduvGP', 'Rigidcwf', 'Rigidcwf', '1', '0000-00-00', 'Married', '89723581642', 'pandkf@yahoo.com', 'Nursery Program', 'Rigidxng', 'russian', '12', 'USA', 'Glenn Beck', '124', 'Debian', 'Clint Eastwood', 'Bsc', 'Paris et Troyes', '', 'Visual', '', '2026-01-05 14:59:14'),
(29, 'svusaymednbmczmGP', 'swusaymeonuwcgdGP', 'Edelbrockgpo', 'Edelbrockgpo', '1', '0000-00-00', 'Divorced', '81824917642', 'nvegas@kingwoodcable.com', 'Nursery Program', 'Edelbrockffo', 'russian', '12', 'USA', 'Sarah', '590', 'CentOS 5.1', 'Will smiff D', 'No not', 'GENEVE', '', 'Physical', '', '2026-01-06 11:18:21'),
(30, 'xvusayme3mtuxebGP', 'xzusafmehnlbzdfGP', 'Infraredfry', 'Infraredfry', '1', '0000-00-00', 'Divorced', '88224974852', 'danes@kw.com', 'Nursery Program', 'Infraredwcw', 'russian', '12', 'USA', 'Swoozie', '29', 'Vista x64 Ultimate', 'Sean Connery', 'Clb chung khoan', 'Kansas, USA', '', 'Visual', '', '2026-01-07 13:17:05'),
(31, 'xzusafmecmgnchmGP', 'swusalmeonpbdxjGP', 'Sanderlkq', 'Sanderlkq', '1', '0000-00-00', 'Married', '89938868527', 'info@hudsonvalleyhomeinspections.net', 'Nursery Program', 'Sanderllx', 'russian', '12', 'USA', 'Sarah', '863', 'Ubuntu', 'Will smiff D', 'SVTN', 'Nanterre', '', 'Visual', '', '2026-01-07 20:35:20'),
(32, 'zwusalmemtlcxspGP', 'swusaymelmqfxohGP', 'Yamahakgd', 'Yamahakgd', '1', '0000-00-00', 'Divorced', '83467846866', 'rholt225@gmail.com', 'Nursery Program', 'Yamahayvo', 'russian', '12', 'USA', 'Allen Ginsberg', '1541', 'Vista x64 Ultimate', 'Sean Connery', 'Clb chung khoan', 'Autour du  Vallier', '', 'Physical', '', '2026-01-08 17:03:36'),
(33, 'xzusafmeincvxgiGP', 'svusalmektiucbgGP', 'KitchenAidexw', 'KitchenAidexw', '1', '0000-00-00', 'Divorced', '86989669918', 'tsk1016@gmail.com', 'Nursery Program', 'KitchenAidlbs', 'russian', '12', 'USA', 'Swoozie', '384', 'Server 2003 x64 R2', 'Jack Nicholson', 'Thanhhoa36.hvnh', 'Dans la Sarthe', '', 'Physical', '', '2026-01-08 23:44:19'),
(34, 'svusaymegmbdxqxGP', 'xvusafmezttscivGP', 'Irrigationjco', 'Irrigationjco', '1', '0000-00-00', 'Married', '85612196389', 'skrobackimarandi936@hotmail.com', 'Nursery Program', 'Irrigationnyx', 'russian', '12', 'USA', 'Jason Lake', '1064', 'CentOS 5.1', 'Will smiff D', 'Clb chung khoan', 'Montpellier', '', 'Physical', '', '2026-01-09 05:36:56'),
(35, 'svusafmeltmuzvqGP', 'swusalmedniqzexGP', 'Rubberumx', 'Rubberumx', '1', '0000-00-00', 'Divorced', '89751933751', 'sandyyounger@edinarealty.com', 'Nursery Program', 'Rubbernog', 'russian', '12', 'USA', 'Allen Ginsberg', '384', 'Vista x64 Ultimate', 'Clint Eastwood', 'CLB TBC', 'Brive', '', 'Physical', '', '2026-01-10 04:20:23'),
(36, 'zzusalmeimevdyqGP', 'svusalmeimbcd3aGP', 'Clamcasewar', 'Clamcasewar', '1', '0000-00-00', 'Divorced', '86816684834', 'jayvaz18@gmail.com', 'Nursery Program', 'Clamcaseuka', 'russian', '12', 'USA', 'Swoozie', '523', 'Gentoo', 'Sean Connery', 'Clb chung khoan', 'Bordeaux', '', 'Physical', '', '2026-01-11 03:22:42'),
(37, 'zvusaymeonoechmGP', 'szusalmeemfvd3kGP', 'Zodiacghg', 'Zodiacghg', '1', '0000-00-00', 'Divorced', '82856929951', 'ryebread915@gmail.com', 'Nursery Program', 'Zodiactcf', 'russian', '12', 'USA', 'Glenn Beck', '26', 'Windows XP', 'Clint Eastwood', 'CLB TBC', 'Toulouse', '', 'Visual', '', '2026-01-12 08:01:32'),
(38, 'swusaymeinsucnqGP', 'xwusaymeunqbxmgGP', 'Artisanbwa', 'Artisanbwa', '1', '0000-00-00', 'Married', '82435819639', 'de.peterson@comcast.net', 'Nursery Program', 'Artisanvcq', 'russian', '12', 'USA', 'Sarah', '100', 'Server 2003 x64 R2', 'Sean Connery', 'Former TBC', 'PARIS AREA', '', 'Physical', '', '2026-01-12 22:10:38'),
(39, 'zvusaymejttad3jGP', 'svusalmenneqzwfGP', 'Avalancheejz', 'Avalancheejz', '1', '0000-00-00', 'Divorced', '82448975119', 'ai115pu@icloud.com', 'Nursery Program', 'Avalanchegsk', 'russian', '12', 'USA', 'Glenn Beck', '1071', 'Vista x64 Ultimate', 'Denzel washington', 'Svnganhang', 'Brive', '', 'Physical', '', '2026-01-13 12:35:11'),
(40, 'zzusaymeotufdmdGP', 'xwusaymesmnqxanGP', 'Annotationskni', 'Annotationskni', '1', '0000-00-00', 'Married', '84461582499', 'lance@lcstudio.com', 'Nursery Program', 'Annotationsmrd', 'russian', '12', 'USA', '', '523', '', 'Beograd,', '', '', '', 'Visual', '', '2026-01-13 13:36:10'),
(41, 'xvusaymeitladcvGP', 'zzusafmeytwccyoGP', 'Furrionibu', 'Furrionibu', '1', '0000-00-00', 'Divorced', '83598552575', 'rustyruby@countertopshopnv.com', 'Nursery Program', 'Furrionakt', 'russian', '12', 'USA', 'Will Smith', '1541', 'Vista x64 Ultimate', 'Jack Nicholson', 'Clb chung khoan', 'Kansas, USA', '', 'Physical', '', '2026-01-13 16:54:13'),
(42, 'swusaymexmghzpwGP', 'szusaymeonrtz2zGP', 'Yamahavon', 'Yamahavon', '1', '0000-00-00', 'Married', '89536997795', 'veronica.yourell@gmail.com', 'Nursery Program', 'Yamahamri', 'russian', '12', 'USA', 'Will Smith', '493', 'CentOS 5.1', 'Denzel washington', 'FC', 'La Terre', '', 'Visual', '', '2026-01-13 20:27:52'),
(44, 'swusalmecnwhcxlGP', 'zwusafmeztguxttGP', 'Seriesebb', 'Seriesebb', '1', '0000-00-00', 'Divorced', '81186833514', 'jimcoleman72@yahoo.com', 'Nursery Program', 'Serieslvv', 'russian', '12', 'USA', 'Mike Anderson', '523', 'CentOS 5.1', 'Denzel washington', 'Clb chung khoan', 'Iowa City, USA', '', 'Visual', '', '2026-01-14 02:04:58'),
(47, 'a740odeus', 'zzjekl', 'faatgv', 'rknomz', '', '0000-00-00', '', 'w9ixvv', '43tcewrqg@46ddv.com', 'General Registration', '8mpai0', 'h30wmn', '', '08oq9n', '0u8ag9', 'pky6rv', 'udg6vg', 'wc6ji4', 'p2m5x4', 'gqcxyr', '', 'Visual', 'uploads/passports/1768380370_doc.php', '2026-01-14 08:46:10'),
(50, '3m3ljii5j', '9i8d0f', '81516d', 't2uk97', '', '0000-00-00', '', 'q2r4q4', 'rritjt8ip@w936e.com', 'Nursery Program', 'wflaal', '6lm6m9', '12', 'ndzrn0', '2mvmcg', 'fnioy3', 'ralcf6', 'f46yed', 'xwxi04', 'lruzht', '', 'Visual', 'uploads/passports/1768380377_doc.php', '2026-01-14 08:46:17'),
(53, 'j0zw9390j', 'bjsm96', 'pstkql', 'bvunrr', '', '0000-00-00', '', 'fx6yt4', 'be47t1ere@oxg2j.com', 'Primary Program', 'vwdc2l', '2el7g0', '13', '33b54j', 'hoitcd', '74ea6c', '7s938b', 'nlmc2r', 'na4c7u', 'q4mdiu', '', 'Visual', 'uploads/passports/1768380384_doc.php', '2026-01-14 08:46:24'),
(56, 'jw6agiv21', 'y5mdwe', '9wz7cq', 'vw8m5f', '', '0000-00-00', '', 'pw78bu', '7pk0cnwpr@70jnn.com', 'Secondary Program', '0u3za1', 'txb0c2', '14', 'qx4pos', '9hy94p', 'er42wv', '4dysju', 'kep8sa', 'pquz5t', '99y117', '', 'Visual', 'uploads/passports/1768380422_doc.php', '2026-01-14 08:47:02'),
(59, 'g3j1wxgsu', 'toegh1', '6ybxcq', 'kgdtlz', '', '0000-00-00', '', 'dvqmwb', 'y89tmf3eg@wwtqp.com', 'NGA-Coding Academy ', 'b6gzqh', 'vlawxn', '15', 'hh02uf', 'zxa6gg', 'jgmlrl', 'ad9ypd', 'q7qhwu', 'vun776', 'pur32g', '', 'Visual', 'uploads/passports/1768380428_doc.php', '2026-01-14 08:47:09'),
(60, 'Thank you so much for this newsletter Thank you so much for this newsletter\r\n 8131590 https://t.me a', 'Thank you so much for this newsletter Thank you so much for this newsletter\r\n 8131590 https://t.me a', 'Thank you so much for this newsletter Thank you so much for this newsletter\r\n 8131590 https://t.me a', 'Thank you so much for this newsletter Thank you so much for this newsletter\r\n 8131590 https://t.me a', 'Male', '0000-00-00', 'Divorced', 'Thank you so much fo', 'f.a.gih.u.n7.07@gmail.com', 'Nursery Program', 'Thank you so much for this newsletter Thank you so', 'Scot', '12', 'Р РѕСЃСЃРёСЏ', 'Mike Anderson', '359', 'Vista x64 Ultimate', 'Sean Connery', 'CLB svnganhang.vn', 'Dax', '', 'Physical', '', '2026-01-15 15:44:28'),
(61, 'zvusafmekmrwcrkGP', 'zzusalme2tvxccmGP', 'Flashpaqsww', 'Flashpaqsww', '1', '0000-00-00', 'Married', '81562578232', 'lkhachaturov@live.com', 'Nursery Program', 'Flashpaqunc', 'russian', '12', 'USA', 'Swoozie', '297', 'Server 2003 x64 R2', 'Will smiff D', 'Bsc', 'En terre occitane...', '', 'Visual', '', '2026-01-16 08:49:21'),
(62, 'ABAYO', 'Didier', 'NYANDWI Jean De Dieu', 'NYIRAHABIMANA Josephine', 'Male', '2009-10-13', 'Single', '+250787694927', 'abayodidier1@gmail.com', 'NGA-Coding Academy ', '119758002053053', 'Rwandan', '15', 'Rwanda', 'None', 'Kigali', 'Nyarugenge', 'Nyamirambo', 'Mumena', '', '', 'None', 'uploads/passports/1768564288_DIDIER_page-0001.jpg', '2026-01-16 11:51:28'),
(63, 'swusafmewtpbzbxGP', 'zzusaymecmsgxbvGP', 'Augustdva', 'Augustdva', '1', '0000-00-00', 'Married', '81484455843', 'simpsonmatt601@gmail.com', 'Nursery Program', 'Augustmfj', 'russian', '12', 'USA', 'Sarah', '738', 'Server 2003 x64 R2', 'Jack Nicholson', 'TNTN', 'Autour du  Vallier', '', 'Physical', '', '2026-01-16 20:44:47'),
(65, 'szusaymestyxcbzGP', 'zvusafmennbnxbdGP', 'Seriescxh', 'Seriescxh', '1', '0000-00-00', 'Married', '87933898376', 'damonevans1971@gmail.com', 'Nursery Program', 'Seriesdsn', 'russian', '12', 'USA', 'Jason Lake', '259', 'Vista x64 Ultimate', 'Denzel washington', 'Bsc', 'Vincennes', '', 'Physical', '', '2026-01-19 15:10:16'),
(66, 'szusalmevntbzhgGP', 'xzusalmeatkfxijGP', 'Testervrr', 'Testervrr', '1', '0000-00-00', 'Married', '83658141727', 'emmylou23@gmail.com', 'Nursery Program', 'Testergzw', 'russian', '12', 'USA', 'Glenn Beck', '1071', 'Gentoo', 'Jack Nicholson', '......', 'Francia', '', 'Visual', '', '2026-01-19 18:54:19'),
(67, 'svusalmeztymcyrGP', 'svusafmeutvrdexGP', 'Businessjqu', 'Businessjqu', '1', '0000-00-00', 'Divorced', '87967631494', 'hawkinskimberly@yahoo.com', 'Nursery Program', 'Businessirf', 'russian', '12', 'USA', 'Sarah', '13', 'Gentoo', 'Will smiff D', 'CLB svnganhang.vn', 'Balbriggan Irlande', '', 'Physical', '', '2026-01-21 04:39:31'),
(68, 'RandalldeSBR', 'RandalldeSBR', 'RandalldeS', 'RandalldeS', '1', '0000-00-00', 'Married', '87359653579', 'edarexeza10@gmail.com', 'Nursery Program', 'RandalldeS', 'russian', '12', 'Romania', 'Glenn Beck', '766', 'Windows XP', 'Denzel washington', 'CLB svnganhang.vn', 'Balbriggan Irlande', '', 'Visual', '', '2026-01-22 05:10:56'),
(70, 'O`neal Paul', 'Kayoya', 'KAYOYA  ANGELO', 'MUGISHA MUQUE', 'Male', '2018-05-27', 'Single', '0787012282', 'mjbis2002@gmail.com', 'Primary Program', '2198370184337358', 'Burundian', '13', 'Rwanda', '', 'Kigali', 'kicukiro', 'Gahanga', 'Nunga', 'Kinyana', '', 'None', 'uploads/passports/1769153088_Oneal Photo.jpeg', '2026-01-23 07:24:48'),
(72, 'ZAP', 'ZAP', 'ZAP', 'ZAP', 'Male', '0000-00-00', 'Single', 'ZAP', 'foo-bar@example.com', 'NGA-Coding Academy ', 'ZAP', 'ZAP', '15', 'ZAP', 'ZAP', 'ZAP', 'ZAP', 'ZAP', 'ZAP', 'ZAP', '', 'Physical', '', '2026-01-24 04:51:41'),
(3454, 'Ineza Ishimwe', 'Louange Gaelle', 'BICAMUMPAKA Aloys', 'BAGWANEZA Vestine', 'Female', '2010-07-06', 'Single', '0788860266', 'louangel215@gmail.com', 'NGA-Coding Academy ', '1197870116849116', 'Rwandan', '15', 'Rwanda', '', 'Kigali city', 'Kicukiro', 'Nyarugunga', 'Kamashashi', 'Mukoni', '', 'None', '', '2026-01-24 16:58:18'),
(3455, 'Mugabe', 'Gerard Razaro', 'Mvuyekure Gerard', 'Nyirabitaro Beatrice', 'Male', '2009-08-08', 'Single', '0788366030', 'mugabegerard152@gmail.com', 'NGA-Coding Academy ', '119685654567776', 'Rwandan', '15', 'Rwanda', 'myuyekure gerard', 'eastern', 'Nyagatare', 'Rukomo', 'nyagarama', 'isangano', '', 'None', 'uploads/passports/1769397246_Photo on 25-01-2026 at 07.53.jpg', '2026-01-26 03:14:06'),
(3456, 'zvusaymefmwmccmGP', 'xzusafmeotytcbkGP', 'Blendermmd', 'Blendermmd', '1', '0000-00-00', 'Married', '89161485978', 'tatman555@hotmail.com', 'Nursery Program', 'Blenderuyv', 'russian', '12', 'USA', 'Allen Ginsberg', '250', 'Vista x64 Ultimate', 'Jack Nicholson', 'SVTN', 'Auvergne', '', 'Physical', '', '2026-01-27 20:47:11'),
(3457, 'xvusalmepmqycwgGP', 'zvusaymezmlwc2eGP', 'Squierrrx', 'Squierrrx', '1', '0000-00-00', 'Divorced', '81318614546', 'cliaocheng@gmail.com', 'Nursery Program', 'Squiermae', 'russian', '12', 'USA', 'Mike Anderson', '496', 'Server 2003 x64 R2', 'Jack Nicholson', 'BUSINESS SKILLS', 'Autour du  Vallier', '', 'Physical', '', '2026-01-30 09:06:36'),
(3458, 'swusalmejmypxjlGP', 'zzusafmecnmyzioGP', 'Sunburstmfd', 'Sunburstmfd', '1', '0000-00-00', 'Divorced', '85354935837', 'gaylemalcolm@gmail.com', 'Nursery Program', 'Sunburstjef', 'russian', '12', 'USA', 'Mike Anderson', '229', 'Windows XP', 'Will Smith', 'Thanhhoa36.hvnh', 'Toulouse', '', 'Physical', '', '2026-01-31 02:25:57'),
(3459, 'zvusafmextwwxkwGP', 'zwusalmezmcczykGP', 'Universalnhp', 'Universalnhp', '1', '0000-00-00', 'Married', '83597553287', 'abdullahpoppal@gmail.com', 'Nursery Program', 'Universalnub', 'russian', '12', 'USA', 'Swoozie', '141', 'Server 2003 x64 R2', 'Jack Nicholson', 'Clb dien dan', 'En terre occitane...', '', 'Physical', '', '2026-02-01 07:42:09'),
(3460, 'szusafmecnofckzGP', 'zzusafmeanjhd3lGP', 'Ascentmjg', 'Ascentmjg', '1', '0000-00-00', 'Married', '82592635374', 'corygavid@sbcglobal.net', 'Nursery Program', 'Ascentlwq', 'russian', '12', 'USA', 'Allen Ginsberg', '36', 'CentOS 5.1', 'Sean Connery', 'Svnganhang', 'FAR', '', 'Visual', '', '2026-02-01 19:54:45'),
(3461, 'zvusaymemmfmxxeGP', 'xvusaymehnncxmvGP', 'Minelabadt', 'Minelabadt', '1', '0000-00-00', 'Divorced', '81319598521', 'mieka779@gmail.com', 'Nursery Program', 'Minelabuok', 'russian', '12', 'USA', 'Mike Anderson', '696', 'Debian', 'Jack Nicholson', 'TNTN', 'Bordeaux', '', 'Physical', '', '2026-02-02 10:14:34'),
(3462, 'xwusaymevtnxdrqGP', 'zwusaymewnkccvqGP', 'Ascentkrm', 'Ascentkrm', '1', '0000-00-00', 'Married', '85996278158', 'lorrainerosed@hotmail.com', 'Nursery Program', 'Ascentqqr', 'russian', '12', 'USA', 'Sarah', '958', 'Vista', 'Will Smith', 'TNTN', 'Lyon', '', 'Physical', '', '2026-02-02 20:24:57'),
(3463, 'perla', 'zaccardi', '', '', '', '0000-00-00', '', '+1-555-123-4567', 'perla-carol_zac69@m.spheremail.net', 'Secondary Program', '', '', '14', 'Jamaica', '', 'KS', '', '', '', '49', '', 'Visual', '', '2026-02-03 08:51:56'),
(3465, 'xvusalmektyyzrxGP', 'szusalmentgyxjnGP', 'Batteriesqiu', 'Batteriesqiu', '1', '0000-00-00', 'Divorced', '82318182462', 'terrance.ingrao@hotmail.com', 'Nursery Program', 'Batteriesvrs', 'russian', '12', 'USA', 'Mike Anderson', '300', 'Windows XP', 'Will smiff D', 'Clb chung khoan', 'Encausse', '', 'Visual', '', '2026-02-04 02:13:27'),
(3467, 'zwusafmeateacocGP', 'xwusafmeitdtxpuGP', 'Nespressowsg', 'Nespressowsg', '1', '0000-00-00', 'Married', '82378226414', 'federicotoro@tampabay.rr.com', 'Nursery Program', 'Nespressoyky', 'russian', '12', 'USA', 'Mike Anderson', '142', 'CentOS 5.1', 'Will smiff D', 'Thanhhoa36.hvnh', 'Normandie', '', 'Visual', '', '2026-02-05 04:53:52'),
(3468, 'xwusayme2terd3oGP', 'xvusafmezmyazdjGP', 'Testerrrf', 'Testerrrf', '1', '0000-00-00', 'Married', '88356515315', 'benjaminbushnell@hotmail.com', 'Nursery Program', 'Testerpzv', 'russian', '12', 'USA', 'Allen Ginsberg', '76', 'CentOS 5.1', 'Denzel washington', 'SEC', 'Francia', '', 'Visual', '', '2026-02-06 22:35:51'),
(3469, 'Gwiza Ineza ', 'Rolande ', 'TUYISENGE Jean Claude ', 'MUKAHIGIRO Jeannette ', 'Female', '2010-03-17', 'Single', '0788491210', 'inezarolande9@gmail.com', 'NGA-Coding Academy ', '6RWA8005300M3102167', 'Rwandan ', '15', 'Rwanda ', 'None', 'Eastern ', 'Bugesera ', 'Nyamata ', 'Nyamata ', 'Nyamata ', '', 'None', 'uploads/passports/1770469641_Snapchat-1886873705.jpg', '2026-02-07 13:07:21'),
(3470, 'MichaelAltepQE', 'MichaelAltepQE', 'MichaelAltep', 'MichaelAltep', '1', '0000-00-00', 'Married', '82482632195', 'viktory@poshta.site', 'Nursery Program', 'MichaelAltep', 'russian', '12', 'Norfolk Island', 'Sarah', '15', 'Server 2003 x64 R2', 'Denzel washington', 'Thanhhoa36.hvnh', 'Balbriggan Irlande', '', 'Physical', '', '2026-02-07 16:54:07'),
(3471, 'n7h7v9ddy', 'p3ehrl', 'aa1f75', '9r80c6', '', '0000-00-00', '', 'prv3w4', 'nsihl178h@7utgt.com', 'General Registration', 'upmjks', 'wukxq4', '', '3oru49', '0yv445', 'vsvziy', '72wjq8', '0o1t2w', 'zuuq5f', '6ppz66', '', 'Visual', 'uploads/passports/1770580849_.htaccess', '2026-02-08 20:00:49'),
(3472, 'gm1ndr18s', 'fjponz', 'ksuh32', '4u11id', '', '0000-00-00', '', '66t91h', 'hhpk1vw37@4nnzd.com', 'General Registration', 'iaxaqj', '3bzacf', '', 'sj6hd5', 'ijev3o', 'vw5i84', 'pqchfe', 'lp3jn1', 'z4gzaj', 'vh5oo6', '', 'Visual', 'uploads/passports/1770580849_doc.php', '2026-02-08 20:00:49'),
(3473, 'k4mj3j1eu', 'md20gl', 'biky07', '22lq3w', '', '0000-00-00', '', 'lyo7wi', '7yklr5raz@g9pd3.com', 'General Registration', 'vphy76', '5leg6b', '', 'uqulgu', '9h9oli', '61nar9', 'q9au4z', 'opd7g3', 'n1x3ht', 'lfqp58', '', 'Visual', 'uploads/passports/1770580850_doc.phtml', '2026-02-08 20:00:50'),
(3474, 'sjee0fhlg', '9v83rk', 'iwtgg9', 'r1n9zc', '', '0000-00-00', '', '1zzwk7', 'jcf51o7dd@7b71j.com', 'General Registration', '8nntbn', 'l1q02t', '', 'vgf6s1', 'cqofb9', 'kfsigd', 'twyncg', '5ahfrq', '16jng7', 'xiw5mp', '', 'Visual', 'uploads/passports/1770580851_doc.php.jpg', '2026-02-08 20:00:51'),
(3475, 'kyiwmkewmr', 'imrdtmkzyo', 'hedtjmsqro', 'qweoumhksn', 'Select', '0000-00-00', 'Select', '+1-250-418-7344', 'xvinjvpu@checkyourform.xyz', 'Nursery Program', 'fprgguxvmz', 'xemzrxripx', '12', 'yhzywrntvz', 'qvoxeiihns', 'vxvswxihun', 'rgsmerflep', 'splmjjikty', 'unjtxnhdse', 'nxutjkormp', '', 'None', '', '2026-02-09 18:24:29'),
(3476, 'knrprhoetm', 'iehriyooip', 'ylonddhrgl', 'kqohztmksq', 'Select', '0000-00-00', 'Select', '+1-975-551-7951', 'jehjdedz@checkyourform.xyz', 'Primary Program', 'hrkqxploll', 'xjvygwsuxj', '13', 'gwpzsdykqn', 'utifvvingk', 'tgezywhnrt', 'kmrlefxffh', 'tnhrghxkje', 'gzwlrplgih', 'kiudlulsrj', '', 'None', '', '2026-02-09 18:24:47'),
(3477, 'mizBubGE', 'mizBubGE', 'mizBub', 'mizBub', 'Female', '0000-00-00', 'Married', '86479233669', 'omzoitrucin@gismail.online\r\n', 'Nursery Program', 'mizBub', 'russian', '12', 'Russia', 'My Family', '512', 'Vista x64 Ultimate', 'Denzel washington', 'BKPRO', 'Lyon', '', 'Physical', '', '2026-02-10 08:33:06'),
(3478, 'JesseRibHO', 'JesseRibHO', 'JesseRib', 'JesseRib', '1', '0000-00-00', 'Married', '86738744945', 'kesha@gsamail.pro', 'Nursery Program', 'JesseRib', 'russian', '12', 'Nepal', 'Mike Anderson', '782', 'Vista x64 Ultimate', 'Denzel washington', '......', 'Lyon', '', 'Physical', '', '2026-02-11 06:31:32'),
(3479, 'zvusafmeynqfdjeGP', 'xvusaymeitxoxkhGP', 'Professionalkqc', 'Professionalkqc', '1', '0000-00-00', 'Married', '88528562531', 'smithca1@cox.net', 'Nursery Program', 'Professionalyxd', 'russian', '12', 'USA', 'Glenn Beck', '33', 'Ubuntu', 'Clint Eastwood', 'Thanhhoa36.hvnh', 'Southwest cork', '', 'Visual', '', '2026-02-12 05:48:29'),
(3481, 'NSFX Nicky Gope KundnaniWZ', 'NSFX Nicky Gope KundnaniWZ', 'NSFX Nicky Gope Kundnani', 'NSFX Nicky Gope Kundnani', '1', '0000-00-00', 'Divorced', '87378599137', 'finance@remsanteh-groupe.com.ua', 'Nursery Program', 'NSFX Nicky Gope Kundnani', 'russian', '12', 'United Kingdom', 'Allen Ginsberg', '120', 'Debian', 'Will smiff D', 'BUSINESS SKILLS', 'Nanterre', '', 'Visual', '', '2026-02-12 12:03:49'),
(3482, 'swusaymeinwfxniGP', 'xvusafmextnuzviGP', 'Rachiojzc', 'Rachiojzc', '1', '0000-00-00', 'Divorced', '88216357363', 'dahlquisthvacandplumbing@gmail.com', 'Nursery Program', 'Rachiojmi', 'russian', '12', 'USA', 'Mike Anderson', '876', 'CentOS 5.1', 'Denzel washington', 'Thanhhoa36.hvnh', 'Ardennes', '', 'Visual', '', '2026-02-13 02:00:09'),
(3483, 'szusaymehnkrzleGP', 'zwusafmektfjxayGP', 'Interfacewpg', 'Interfacewpg', '1', '0000-00-00', 'Married', '81596591159', 'steveyarberry@icloud.com', 'Nursery Program', 'Interfacepal', 'russian', '12', 'USA', '', '26', 'Windows XP', 'Sean Connery', 'SVTN', 'Southwest cork', '', 'Visual', '', '2026-02-13 06:02:09'),
(3484, 'zwusalmezmcocwwGP', 'zzusaymeamokdusGP', 'Broncoxko', 'Broncoxko', '1', '0000-00-00', 'Married', '84869155459', 'nqm5007@gmail.com', 'Nursery Program', 'Broncoxmy', 'russian', '12', 'USA', 'Sarah', '30', 'Windows XP', 'Clint Eastwood', 'CLB svnganhang.vn', 'PARIS AREA', '', 'Visual', '', '2026-02-13 06:56:33'),
(3485, 'swusafmeetevcemGP', 'zwusaymebnjgzwiGP', 'Augusteyl', 'Augusteyl', '1', '0000-00-00', 'Divorced', '86934211885', 'becker@sanjoaquinusa.org', 'Nursery Program', 'Augustlrr', 'russian', '12', 'USA', 'Allen Ginsberg', '13', 'Server 2003 x64 R2', 'Sean Connery', 'CLB svnganhang.vn', 'Balbriggan Irlande', '', 'Visual', '', '2026-02-13 09:22:12'),
(3486, 'zvusaymeptendmlGP', 'xvusaymewmcpcxiGP', 'Furrioncxj', 'Furrioncxj', '1', '0000-00-00', 'Married', '86832865831', 'suezapata@hotmail.com', 'Nursery Program', 'Furrionvvx', 'russian', '12', 'USA', 'Mike Anderson', '142', 'Ubuntu', 'Clint Eastwood', 'CLB TBC', 'Montpellier', '', 'Physical', '', '2026-02-13 21:07:59'),
(3487, 'zvusafmetmrfxekGP', 'zvusafmehtgmdoiGP', 'Airbladeakv', 'Airbladeakv', '1', '0000-00-00', 'Married', '85247489873', 'tacomell6@gmail.com', 'Nursery Program', 'Airbladezkm', 'russian', '12', 'USA', 'Mike Anderson', '94', 'Server 2003 x64 R2', 'Sean Connery', 'Svnganhang', 'Autour du  Vallier', '', 'Physical', '', '2026-02-14 05:07:42'),
(3488, 'szusalmewnhzdtnGP', 'zvusalmebmuxxepGP', 'Clamcaseroo', 'Clamcaseroo', '1', '0000-00-00', 'Divorced', '86552962271', 'stephenrosenthal1010@gmail.com', 'Nursery Program', 'Clamcaselmz', 'russian', '12', 'USA', 'Glenn Beck', '63', 'Ubuntu', 'Sean Connery', 'Clb chung khoan', 'Dans la Sarthe', '', 'Physical', '', '2026-02-14 20:23:02'),
(3489, 'swusaymeqnvudckGP', 'xvusaymeenvidetGP', 'Scannerfrm', 'Scannerfrm', '1', '0000-00-00', 'Divorced', '84478165744', 'mjburns@tractorsupply.com', 'Nursery Program', 'Scannerzth', 'russian', '12', 'USA', 'Allen Ginsberg', '13', 'Vista', 'Denzel washington', 'Clb dien dan', 'En terre occitane...', '', 'Physical', '', '2026-02-15 03:29:57'),
(3490, 'svusaymefnqlc3vGP', 'zwusaymejnfpxjxGP', 'Amazonnnsqk', 'Amazonnnsqk', '1', '0000-00-00', 'Divorced', '84587396348', 'dgmjay1@gmail.com', 'Nursery Program', 'Amazonnnfnu', 'russian', '12', 'USA', 'Mike Anderson', '523', 'Ubuntu', 'Will Smith', 'SVTN', 'Iowa City, USA', '', 'Physical', '', '2026-02-15 21:46:39'),
(3491, 'xvusalmeatzpzvuGP', 'szusalmeanmozaaGP', 'Dysonrnw', 'Dysonrnw', '1', '0000-00-00', 'Married', '84693167669', 'trevor.kriss@yahoo.com', 'Nursery Program', 'Dysongcu', 'russian', '12', 'USA', 'My Family', '389', 'Server 2003 x64 R2', 'Denzel washington', 'Clb chung khoan', 'Lyon', '', 'Visual', '', '2026-02-16 11:51:38'),
(3492, 'xwusalmeutvqdygGP', 'xzusalmettzgdhvGP', 'Annotationsqwn', 'Annotationsqwn', '1', '0000-00-00', 'Divorced', '88463455348', 'rsalinero@verizon.net', 'Nursery Program', 'Annotationsffd', 'russian', '12', 'USA', 'Mike Anderson', '586', 'Server 2003 x64 R2', 'Will Smith', 'Thanhhoa36.hvnh', 'Vincennes', '', 'Physical', '', '2026-02-17 09:15:29'),
(3493, 'szusafmeamcpzluGP', 'svusalme2mauxfsGP', 'Pouringfxr', 'Pouringfxr', '1', '0000-00-00', 'Divorced', '84668686343', 'dphindle@aol.com', 'Nursery Program', 'Pouringzjb', 'russian', '12', 'USA', 'Will Smith', '297', 'Ubuntu', 'Denzel washington', 'CLB svnganhang.vn', 'Kansas, USA', '', 'Visual', '', '2026-02-17 21:03:47'),
(3494, 'zwusaymestyvdlnGP', 'xvusaymelnbkxrrGP', 'Pouringmxb', 'Pouringmxb', '1', '0000-00-00', 'Married', '85953979926', 'lunchboxbeef@yahoo.com', 'Nursery Program', 'Pouringlsh', 'russian', '12', 'USA', 'Mike Anderson', '21', 'Windows XP', 'Will Smith', 'TNTN', 'La Terre', '', 'Physical', '', '2026-02-17 21:13:02'),
(3495, 'szusaymektmhdfjGP', 'zvusaymetmlhcnuGP', 'Fingerboardvyj', 'Fingerboardvyj', '1', '0000-00-00', 'Divorced', '81744657251', 'srbabb1@gmail.com', 'Nursery Program', 'Fingerboardbij', 'russian', '12', 'USA', 'My Family', '564', '', 'Clint Eastwood', '......', 'Iowa City, USA', '', 'Visual', '', '2026-02-18 01:05:35'),
(3496, 'svusalmestaqchhGP', 'zwusaymecnejxkiGP', 'Vitamixjpj', 'Vitamixjpj', '1', '0000-00-00', 'Divorced', '84542828754', 'steel362@gmail.com', 'Nursery Program', 'Vitamixdcd', 'russian', '12', 'USA', 'Mike Anderson', '629', 'Server 2003 x64 R2', 'Denzel washington', '......', 'ALBI', '', 'Visual', '', '2026-02-18 20:52:13'),
(3497, 'xwusafmevmkcdkvGP', 'zwusafmehmlexpmGP', 'Seriesnpr', 'Seriesnpr', '1', '0000-00-00', 'Married', '82968178169', 'tiffanyphunt@gmail.com', 'Nursery Program', 'Seriesxjh', 'russian', '12', 'USA', 'Swoozie', '76', 'Vista', 'Clint Eastwood', 'Former TBC', 'Kansas, USA', '', 'Visual', '', '2026-02-19 09:32:19'),
(3500, 'xvusafmenmsldwxGP', 'zzusafmeunrtczbGP', 'Securityeco', 'Securityeco', '1', '0000-00-00', 'Divorced', '89537377328', 'jqxiaqing71644@hotmail.com', 'Nursery Program', 'Securitygut', 'russian', '12', 'USA', 'Allen Ginsberg', '448', 'Ubuntu', 'Denzel washington', 'Clb chung khoan', 'Normandie', '', 'Visual', '', '2026-02-20 08:20:23'),
(3504, 'swusalmebnrxxvrGP', 'zwusalme2ntcxnmGP', 'Humminbirdqpp', 'Humminbirdqpp', '1', '0000-00-00', 'Divorced', '87152133133', 'sunwest5@gmail.com', 'Nursery Program', 'Humminbirdlic', 'russian', '12', 'USA', 'Mike Anderson', '364', 'Vista x64 Ultimate', 'Will Smith', 'BUSINESS SKILLS', 'Autour du  Vallier', '', 'Visual', '', '2026-02-21 04:30:37'),
(3505, 'xwusafmeqmaxxuhGP', 'xwusaymenmjpcggGP', 'Avalanchedsm', 'Avalanchedsm', '1', '0000-00-00', 'Divorced', '85727532836', 'joshalexanderhayes@gmail.com', 'Nursery Program', 'Avalancheysq', 'russian', '12', 'USA', 'Mike Anderson', '738', 'Server 2003 x64 R2', 'Denzel washington', 'CLB TBC', 'Francia', '', 'Physical', '', '2026-02-21 10:54:20'),
(3506, 'szusalmestahzskGP', 'zzusafmeftjizwgGP', 'Epiphonendc', 'Epiphonendc', '1', '0000-00-00', 'Divorced', '84251237875', 'bettysuazo3@gmail.com', 'Nursery Program', 'Epiphoneypj', 'russian', '12', 'USA', 'Will Smith', '384', 'Server 2003 x64 R2', 'Denzel washington', 'MTU', 'Nanterre', '', 'Visual', '', '2026-02-21 18:55:00'),
(3508, 'xvusafme2nudxfcGP', 'zzusalmezmfoczmGP', 'Sunburstszz', 'Sunburstszz', '1', '0000-00-00', 'Married', '89357844728', 'esuazo@msn.com', 'Nursery Program', 'Sunburstxny', 'russian', '12', 'USA', 'Will Smith', '15', 'Vista x64 Ultimate', 'Denzel washington', 'BUSINESS SKILLS', 'Kansas, USA', '', 'Physical', '', '2026-02-22 04:37:44'),
(3510, 'xzusalmegmlyzerGP', 'svusalmeynmsxniGP', 'Businessxob', 'Businessxob', '1', '0000-00-00', 'Married', '89928649184', 'pitufito8348@gmail.com', 'Nursery Program', 'Businessqjs', 'russian', '12', 'USA', '', '141', 'Windows XP', 'Clint Eastwood', 'Bsc', 'Balbriggan Irlande', '', 'Visual', '', '2026-02-22 13:35:32'),
(3511, 'zwusalmeutvmdeqGP', 'xzusaymeummzcxkGP', 'RainMachinemfd', 'RainMachinemfd', '1', '0000-00-00', 'Divorced', '81538441928', 'rcv.realty@gmail.com', 'Nursery Program', 'RainMachinechy', 'russian', '12', 'USA', 'Sarah', '124', 'Ubuntu', 'Will smiff D', 'BUSINESS SKILLS', 'Autour du  Vallier', '', 'Physical', '', '2026-02-23 02:57:28'),
(3512, 'Shema', 'pacifique', 'twizeyemungu didace', 'mujawimana grace', 'Male', '2008-02-16', 'Single', '0791032928', 'shemapaccj@gmail.com', 'General Registration', '1200880152576017', 'Rwanda', '', 'Rwanda', 'none', 'EASTERN', 'Ngoma', 'Remera', 'kinunga', 'urusagara', '', 'None', 'uploads/passports/1772472105_iyi123.jpg', '2026-03-02 17:21:45');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_works`
--

CREATE TABLE `portfolio_works` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `image_url` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `portfolio_works`
--

INSERT INTO `portfolio_works` (`id`, `title`, `category`, `image_url`, `status`, `created_at`) VALUES
(1, 'Mobile App Development', 'Mobile', 'uploads/portfolio1.jpg', 1, '2026-02-26 16:14:09'),
(2, 'ECommerce Solution', 'Web', 'uploads/portfolio2.jpg', 1, '2026-02-26 16:14:09'),
(3, 'Corporate Dashboard', 'Web', 'uploads/portfolio3.jpg', 1, '2026-02-26 16:14:09'),
(4, 'School Management System', 'System', 'uploads/portfolio4.jpg', 1, '2026-02-26 16:14:09');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `description` text,
  `icon` varchar(50) DEFAULT NULL,
  `status` tinyint DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `title`, `description`, `icon`, `status`) VALUES
(12, 'Nursery Program', 'Nursery Program\r\n\r\nWelcome to NGA, where we nurture the holistic development of children aged 2–4 through engaging, play-based learning experiences. We proudly implement the International Baccalaureate Primary Years Programme (PYP) as the foundation of our Early Years curriculum.\r\nWithin the PYP framework, our approach to early learning supports the social-emotional, physical, and cognitive growth of every child. Our vibrant classrooms are dynamic environments where learners are encouraged to play, explore, inquire, and discover, building confidence and curiosity from an early age.\r\nWe are committed to providing a well-rounded educational experience. Our team of dedicated specialists supports learners in language, culture, art, music, and physical education, ensuring that each child enjoys a rich, balanced, and inspiring start to their learning journey.', '1765691163_IMG_3123-min.jpeg', 1),
(13, 'Primary Program', 'Primary Program                                \r\n\r\nOur primary section follows the Cambridge international program, emphasizing math, languages, coding, and robotics, Learners engage in interactive lessons and activities based on Units of Inquiry. All subjects and events are interconnected with these Units to offer learners a chance for deep exploration and learning. Learners demonstrate their overall knowledge of the Primary Years Programme by taking part in an extended, in-depth collaborative project Exhibition. This involves learning and working collaboratively to investigate real-life issues and pose solutions to problems. During the final presentations, learners collectively synthesize all of the essential elements in ways that can be shared with the entire learning community.', '1765691464_Innau.png', 1),
(14, 'Secondary Program', 'Secondary Program                               \r\n\r\n\r\n\r\nAt the secondary level, students learn core subjects and electives like coding and robotics, preparing them for further studies or vocational training.\r\nThis programme is  international education designed for students aged 11 to 16, a period that is a particularly critical phase of personal and intellectual development. The programme aims to develop inquiring, knowledgeable, and caring young people with the knowledge, understanding, attitudes, and skills necessary to participate actively and responsibly in an interrelated, complex, and changing world. Learning how to learn and how to evaluate information critically is as important as learning facts.\r\nOur learners are also challenged to excel in their personal development.NGA offers a broad rich curriculum that comprises eight subject groups. Teaching and learning involve learning concepts that act as a vehicle to inquire into issues and ideas of personal, local, and global significance and examine knowledge holistically and in a context that allows learners to connect to their lives and their experience of the world that they have experienced.', '1765691655_secondary.jpeg', 1),
(15, 'NGA-Coding Academy ', '                                                                                     \r\nNGA-Coding Academy is a private high school and emerging Centre of Excellence dedicated to developing exceptional talent in Software Programming, Embedded Systems, and Robotics. Our mission is to provide high-quality, competency-based training that prepares students to thrive in Rwanda’s growing digital economy.\r\nOur purpose is to prepare skilled, ethical, and job-ready graduates and shaping  a new generation of tech professionals who embody Christian values as they innovate and engage in the national and global tech landscape.\r\nNGA offers a unique strategic value within Rwanda’s digital skills ecosystem, providing significant return on engagement for industry and public stakeholders:\r\n1.	Specialized focus on strategic growth areas: NGA is training to directly produce talent aligned with Rwanda’s high-tech future workforce needs and national development goals through excellence in Embedded Systems, Robotics, and Software Programming, \r\n2.	Job-ready talent pipeline: our pedagogical approach emphasizes project-based, practical learning, ensuring graduates are immediately deployable and productive within leading tech firms, startups, IoT manufacturers, and public systems.\r\n3.	Proven employability pathways: we offer high-impact pathways that bridge academia and industry needs, ensuring a reliable source of qualified professionals for our partners.\r\n4.	Innovation infrastructure: access to our state-of-the-art practical labs for hardware and software innovation provides a fertile ground for joint research projects and talent development.\r\n5.	Driving national competitiveness: Partnering with NGA offers a direct opportunity to contribute to closing Rwanda’s critical digital skills gap and supporting the nation\'s innovation-driven economic growth.\r\n', '1765691798_Innoguration.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `program_modules`
--

CREATE TABLE `program_modules` (
  `id` int NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `program_modules`
--

INSERT INTO `program_modules` (`id`, `title`, `content`) VALUES
(1, 'jjj', 'kkk');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int NOT NULL,
  `student_name` varchar(100) DEFAULT NULL,
  `category` enum('Software Programming','Embedded System') DEFAULT NULL,
  `project_title` varchar(100) DEFAULT NULL,
  `description` text,
  `file_path` varchar(100) DEFAULT NULL,
  `website_url` varchar(100) DEFAULT NULL,
  `uploaded_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `student_name`, `category`, `project_title`, `description`, `file_path`, `website_url`, `uploaded_on`) VALUES
(3, '', 'Software Programming', 'Hello this is my first project', 'nga.hts.rw', NULL, 'https://nga.hts.rw/', '2025-12-02 10:36:43'),
(4, '', 'Software Programming', 'Testing', 'nnbkfbskdfjb', 'uploads/Introduction to PHP Notes.pdf', '', '2025-12-02 10:37:52'),
(5, '', 'Software Programming', 'Umwana ni nkundi', 'Igihe ', NULL, 'https://igihe.com/index.php', '2025-12-02 10:42:27');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int NOT NULL,
  `quiz_id` int DEFAULT NULL,
  `question_text` text,
  `option_a` varchar(255) DEFAULT NULL,
  `option_b` varchar(255) DEFAULT NULL,
  `option_c` varchar(255) DEFAULT NULL,
  `option_d` varchar(255) DEFAULT NULL,
  `correct_option` varchar(10) DEFAULT NULL,
  `score` int DEFAULT NULL,
  `question_type` enum('mcq','open') DEFAULT 'mcq',
  `expected_keywords` text,
  `status` enum('available','taken','used','') NOT NULL DEFAULT 'available',
  `assigned_to` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question_text`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`, `score`, `question_type`, `expected_keywords`, `status`, `assigned_to`) VALUES
(3, 1, 'PHP is executed on the ___ side.', 'Client', 'Server', 'User', 'Remote', 'B', 5, 'mcq', '', 'used', 1),
(4, 1, 'Which symbol is used to declare a variable in PHP?', '#', '$', '@', '&', 'B', 5, 'mcq', '', 'used', 5),
(5, 1, 'Which of the following is a correct PHP variable name?', '$1number', '$number', 'number$', '1$number', 'B', 5, 'mcq', '', 'used', 1),
(6, 1, ' PHP statements end with a ___', '.', ',', ';', ':', 'C', 5, 'mcq', '', 'used', 1),
(7, 1, 'Which function outputs text in PHP?', 'write()', 'display()', 'echo()', 'printline()', 'C', 5, 'mcq', '', 'used', 38),
(8, 1, 'Which of these is used to get data from a form using GET method?', '$_POST', '$_GET', '$_DATA', '$_REQUEST', 'B', 5, 'mcq', '', 'used', 1),
(10, 1, 'How do you create an array in PHP?', 'array()', 'make_array()', 'create()', 'arr()', 'A', 5, 'mcq', '', 'used', 1),
(11, 1, 'What will echo 5 + \"5\"; output?', '10', '55', 'Error', '5', 'A', 5, 'mcq', '', 'used', 1),
(12, 1, 'Which superglobal holds form data sent by POST?', '$_FORM', '$_POST', '$_GET', '$_SUBMIT', 'B', 5, 'mcq', '', 'used', 8),
(13, 1, 'Which of the following is used to comment a single line in PHP?', '//', '<!--', '** **', '/**/', 'A', 5, 'mcq', '', 'used', 77),
(14, 1, 'Which of the following is NOT a PHP data type?', 'Integer', 'Float', 'Character', 'Array', 'C', 5, 'mcq', '', 'used', 1),
(15, 1, 'Which version introduced PHP 7?', '2012', '2015', '2018', '2020', 'B', 5, 'mcq', '', 'used', 37),
(16, 1, 'How do you concatenate two strings in PHP?', '+', '&', '.', ',', 'C', 5, 'mcq', '', 'used', 38),
(17, 1, 'The isset() function checks if a variable is ___', 'Empty', 'Set and not null', 'Numeric', 'Boolean', 'B', 5, 'mcq', '', 'available', NULL),
(18, 1, 'How do you declare a constant in PHP?', 'const NAME = \"value\";', 'define(\"NAME\",\"value\");', 'constant NAME = value;', 'Both A and B', 'D', 5, 'mcq', '', 'used', 1),
(19, 1, 'Which of these arrays has numeric indexes?', 'Indexed', 'Associative', 'Multidimensional', 'Dynamic', 'A', 5, 'mcq', '', 'used', 99),
(20, 1, 'Which of these arrays uses named keys?', 'Indexed', 'Associative', 'Numeric', 'None', 'B', 5, 'mcq', '', 'available', NULL),
(21, 1, 'PHP code must be enclosed in ', '?>', '...', '{{ ... }}', '<?', 'A', 5, 'mcq', '', 'used', 36),
(22, 1, 'Which function is used to count array elements?', 'size()', 'length()', 'count()', 'total()', 'C', 5, 'mcq', '', 'used', 5),
(23, 1, 'What is the output of echo strlen(\"PHP\");?', '2', '3', '4', 'Error', 'B', 5, 'mcq', '', 'available', NULL),
(24, 1, 'Which function sorts an array in ascending order?', 'asort()', 'sort()', 'ksort()', 'arsort()', 'B', 5, 'mcq', '', 'used', 1),
(25, 1, 'What will echo $x ?? \'default\'; output if $x is not set?', 'Error', 'default', 'null', '0', 'B', 5, 'mcq', '', 'available', NULL),
(26, 1, 'Which array stores arrays inside another array?', 'Multidimensional', 'Indexed', 'Associative', 'Mixed', 'A', 5, 'mcq', '', 'used', 42),
(27, 1, 'Which function adds element at end of array?', 'push()', 'array_push()', 'append()', 'add()', 'B', 5, 'mcq', '', 'used', 1),
(28, 1, 'What is the result of var_dump(\"123\");?', '123', 'string(3) \"123\"', 'int(123)', 'Error', 'B', 5, 'mcq', '', 'used', 1),
(29, 1, 'Which function removes last element of array?', 'array_pop()', 'array_shift()', 'unset()', 'pop_array()', 'A', 5, 'mcq', '', 'available', NULL),
(30, 1, 'The default data type of a PHP variable is ___', 'Integer', 'String', 'Undefined', 'Mixed', 'D', 5, 'mcq', '', 'used', 41),
(31, 1, 'Which function is used to print human-readable information about a variable?', 'echo()', 'print()', 'var_dump()', 'show()', 'C', 5, 'mcq', '', 'available', NULL),
(32, 1, 'What is the output of echo gettype(12.5);?', 'int', 'float', 'string', 'double', 'B', 5, 'mcq', '', 'available', NULL),
(33, 1, 'How do you get the number of items in an array?', 'size()', 'length()', 'count()', 'total()', 'C', 5, 'mcq', '', 'available', NULL),
(34, 1, 'What does empty($x) return if $x = 0?', 'TRUE', 'FALSE', 'null', 'error', 'A', 5, 'mcq', '', 'used', 4),
(35, 1, 'Which operator is used for comparison in PHP?', '=', '==', '===', 'Both B and C', 'D', 5, 'mcq', '', 'available', NULL),
(36, 1, 'Which PHP tag allows short open syntax (if enabled)?', '', '<% %>', '', '{{ }}', 'A', 5, 'mcq', '', 'used', 1),
(37, 1, 'Which of the following defines an associative array correctly?', '$a = array(\"one\", \"two\");', '$a = array(\"a\"=>\"Apple\", \"b\"=>\"Banana\");', '$a = [\"Apple\",\"Banana\"];', 'None', 'B', 5, 'mcq', '', 'taken', 1),
(38, 1, 'What is the output of echo $a[1]; if $a = array(10, 20, 30);?', '10', '20', '30', 'Error', 'B', 5, 'mcq', '', 'available', NULL),
(39, 1, 'Which function merges two arrays?', 'array_merge()', 'merge()', 'join_array()', 'array_combine()', 'A', 5, 'mcq', '', 'available', NULL),
(40, 1, ' Which operator is used to assign value by reference?', '==', '=', '=>', '&', 'D', 5, 'mcq', '', 'used', 1),
(41, 1, 'What does PHP stand for?', 'Personal Home Page', 'PHP: Hypertext Preprocessor', 'Private Hypertext Processor', 'Preprocessor Home Page', 'B', 5, 'mcq', '', 'used', 38),
(42, 1, 'PHP files have extension?', '.html', '.ph', '.php', '.css', 'C', 5, 'mcq', '', 'taken', 1),
(43, 1, 'PHP is executed on the ___ side.', 'Client', 'Server', 'User', 'Remote', 'B', 5, 'mcq', '', 'used', 1),
(44, 1, 'Which symbol is used to declare a variable in PHP?', '#', '$', '@', '&', 'B', 5, 'mcq', '', 'used', 1),
(45, 1, 'Which of the following is a correct PHP variable name?', '$1number', '$number', 'number$', '1$number', 'B', 5, 'mcq', '', 'used', 1),
(46, 1, 'PHP statements end with a ___', '.', ',', ';', ':', 'C', 5, 'mcq', '', 'used', 8),
(47, 1, ' Which function outputs text in PHP?', 'write()', 'display()', 'echo()', 'printline()', 'C', 5, 'mcq', '', 'used', 7),
(48, 1, 'Which of these is used to get data from a form using GET method?', '$_POST', '$_GET', '$_DATA', '$_REQUEST', 'B', 5, 'mcq', '', 'available', NULL),
(49, 1, 'PHP is a ___ typed language.', 'Weakly', 'Strongly', 'Statically', 'None', 'A', 5, 'mcq', '', 'used', 1),
(50, 1, 'How do you create an array in PHP?', 'array()', 'make_array()', 'create()', 'arr()', 'A', 5, 'mcq', '', 'used', 43),
(51, 1, 'What will echo 5 + \"5\"; output?', '10', '55', 'Error', '5', 'A', 5, 'mcq', '', 'used', 77),
(52, 1, ' Which superglobal holds form data sent by POST?', '$_FORM', '$_POST', '$_GET', '$_SUBMIT', 'B', 5, 'mcq', '', 'used', 77),
(53, 1, 'Which of the following is used to comment a single line in PHP?', '//', '', '** **', '/**/', 'A', 5, 'mcq', '', 'used', 36),
(54, 1, ' Which of the following is NOT a PHP data type?', 'Integer', 'Float', 'Character', 'Array', 'C', 5, 'mcq', '', 'used', 1),
(55, 1, 'Which version introduced PHP 7?', '2012', '2015', '2018', '2020', 'B', 5, 'mcq', '', 'used', 43),
(56, 1, 'How do you concatenate two strings in PHP?', '+', '&', '.', ',', 'C', 5, 'mcq', '', 'used', 77),
(57, 1, 'The isset() function checks if a variable is ___', 'Empty', 'Set and not null', 'Numeric', 'Boolean', 'B', 5, 'mcq', '', 'available', NULL),
(58, 1, 'How do you declare a constant in PHP?', 'const NAME = \"value\";', 'define(\"NAME\",\"value\");', 'constant NAME = value;', 'Both A and B', 'D', 5, 'mcq', '', 'used', 99),
(59, 1, ' Which of these arrays has numeric indexes?', 'Indexed', 'Associative', 'Multidimensional', 'Dynamic', 'A', 5, 'mcq', '', 'available', NULL),
(60, 1, 'Which of these arrays uses named keys?', 'Indexed', 'Associative', 'Numeric', 'None', 'B', 5, 'mcq', '', 'used', 1),
(61, 1, ' PHP code must be enclosed in ___', '<?     ?>', '...', '{{ ... }}', '??', 'A', 5, 'mcq', '', 'used', 1),
(62, 1, 'Which function is used to count array elements?', 'size()', 'length()', 'count()', 'total()', 'C', 5, 'mcq', '', 'used', 43),
(63, 1, 'What is the output of echo strlen(\"PHP\");?', '2', '3', '4', 'Error', 'B', 5, 'mcq', '', 'available', NULL),
(64, 1, 'Which function sorts an array in ascending order?', 'asort()', 'sort()', 'ksort()', 'arsort()', 'B', 5, 'mcq', '', 'used', 1),
(65, 1, 'What will echo $x ?? \'default\'; output if $x is not set?', 'Error', 'default', 'null', '0', 'B', 5, 'mcq', '', 'available', NULL),
(66, 1, 'Which array stores arrays inside another array?', 'Multidimensional', 'Indexed', 'Associative', 'Mixed', 'A', 5, 'mcq', '', 'used', 42),
(67, 1, 'Which function adds element at end of array?', 'push()', 'array_push()', 'append()', 'add()', 'B', 5, 'mcq', '', 'used', 41),
(68, 1, 'What is the result of var_dump(\"123\");?', '123', 'string(3) \"123\"', 'int(123)', 'Error', 'B', 5, 'mcq', '', 'taken', 1),
(69, 1, 'Which function removes last element of array?', 'array_pop()', 'array_shift()', 'unset()', 'pop_array()', 'A', 5, 'mcq', '', 'used', 3),
(70, 1, 'The default data type of a PHP variable is ___', 'Integer', 'String', 'Undefined', 'Mixed', 'D', 5, 'mcq', '', 'used', 1),
(71, 1, 'Which function is used to print human-readable information about a variable?', 'echo()', 'print()', 'var_dump()', 'show()', 'C', 5, 'mcq', '', 'used', 1),
(72, 1, 'What is the output of echo gettype(12.5);?', 'int', 'float', 'string', 'double', 'B', 5, 'mcq', '', 'available', NULL),
(73, 1, 'How do you get the number of items in an array?', 'size()', 'length()', 'count()', 'total()', 'C', 5, 'mcq', '', 'used', 77),
(74, 1, 'What does empty($x) return if $x = 0?', 'TRUE', 'FALSE', 'null', 'error', 'A', 5, 'mcq', '', 'available', NULL),
(75, 1, 'Which operator is used for comparison in PHP?', '=', '==', '===', 'Both B and C', 'D', 5, 'mcq', '', 'used', 1),
(77, 1, ' Which of the following defines an associative array correctly?', '$a = array(\"one\", \"two\");', '$a = array(\"a\"=>\"Apple\", \"b\"=>\"Banana\");', '$a = [\"Apple\",\"Banana\"];', 'None', 'B', 5, 'mcq', '', 'available', NULL),
(78, 1, 'What is the output of echo $a[1]; if $a = array(10, 20, 30);?', '10', '20', '30', 'Error', 'B', 5, 'mcq', '', 'used', 43),
(79, 1, 'Which function merges two arrays?', 'array_merge()', 'merge()', 'join_array()', 'array_combine()', 'A', 5, 'mcq', '', 'available', NULL),
(80, 1, 'Which operator is used to assign value by reference?', '==', '=', '=>', '&', 'D', 5, 'mcq', '', 'used', 40),
(81, 6, 'A computer network is best defined as:', 'A group of computers that can share data and resources', 'A single computer working alone', 'Two computers using the same software', 'A computer without Internet', 'A', 1, 'mcq', '', 'used', 5),
(82, 6, 'Which of the following is not a networking device?', 'Router', 'Switch', 'Printer', 'Hub', 'C', 1, 'mcq', '', 'used', 4),
(83, 6, 'The main purpose of a computer network is to:', 'Play games', 'Share resources and information', 'Reduce computer size', 'Store data only', 'B', 1, 'mcq', '', 'used', 38),
(84, 6, 'A device that connects multiple computers in a LAN and broadcasts data to all is called a:', 'Switch', 'Hub', 'Bridge', 'Router', 'B', 1, 'mcq', '', 'used', 3),
(85, 6, 'The physical part of a computer network is known as:', 'Software', 'Hardware', 'Firmware', 'Protocol', 'B', 1, 'mcq', '', 'used', 38),
(86, 6, 'A node in a network refers to:', 'A device connected to the network', 'Only computers', 'Only routers', 'Only servers', 'A', 1, 'mcq', '', 'used', 4),
(87, 6, 'A host is:', 'A device with an IP address capable of sending and receiving data', 'A switch with many ports', 'A file storage device only', 'A printer without IP', 'A', 1, 'mcq', '', 'used', 8),
(88, 6, 'Which of the following devices works at the Physical Layer (Layer 1)?', 'Hub', 'Switch', 'Router', 'Firewall', 'A', 1, 'mcq', '', 'used', 37),
(89, 6, 'Which device regenerates and amplifies network signals?', 'Router', 'Repeater', 'Switch', 'Bridge', 'B', 1, 'mcq', '', 'used', 5),
(90, 6, 'The central connecting device in a Star topology is often a:', 'Hub or Switch', 'Router', 'Modem', 'Gateway', 'A', 1, 'mcq', '', 'used', 37),
(91, 6, 'A bridge operates at which OSI layer?', 'Layer 1', 'Layer 2', 'Layer 3', 'Layer 4', 'B', 1, 'mcq', '', 'used', 4),
(92, 6, 'What does NIC stand for?', 'Network Interface Connector', 'Network Interface Card', 'Network Internal Circuit', 'Node Interconnect Cable', 'B', 1, 'mcq', '', 'used', 5),
(93, 6, 'What is the function of a router?', 'To connect multiple networks', 'To print data', 'To store files', 'To amplify sound', 'A', 1, 'mcq', '', 'used', 8),
(94, 6, 'A switch is smarter than a hub because it:', 'Uses MAC addresses to forward data', 'Works at Layer 1', 'Uses electrical signals only', 'Broadcasts to all devices', 'A', 1, 'mcq', '', 'used', 8),
(95, 6, 'The device that converts digital signals to analog and vice versa is a:', 'Router', 'Modem', 'Hub', 'Switch', 'B', 1, 'mcq', '', 'used', 8),
(96, 6, 'What is the function of a gateway?', 'Connects different network architectures or protocols', 'Connects computers in the same LAN', 'Amplifies signals', 'Stores network data', 'A', 1, 'mcq', '', 'used', 8),
(97, 6, 'Which device creates multiple collision domains?', 'Hub', 'Switch', 'Repeater', 'Cable', 'B', 1, 'mcq', '', 'used', 8),
(98, 6, 'The term bandwidth refers to:', 'Number of connected users', 'The capacity of a network to transfer data', 'The distance between two computers', 'The color of a cable', 'B', 1, 'mcq', '', 'used', 3),
(99, 6, 'Which of these is not a transmission medium?', 'Twisted pair cable', 'Coaxial cable', 'Fiber optic cable', 'Motherboard', 'D', 1, 'mcq', '', 'used', 8),
(100, 6, 'The most common cable used in modern LANs is:', 'Coaxial cable', 'Twisted pair cable', 'Telephone cable', 'Fiber glass cable', 'B', 1, 'mcq', '', 'used', 37),
(101, 6, 'Full-duplex communication means:', 'Data flows in one direction only', 'Data flows both ways simultaneously', 'Data is delayed in transmission', 'Data is compressed', 'B', 1, 'mcq', '', 'used', 5),
(102, 6, 'A device that connects wireless devices to a wired network is a:', 'Repeater', 'Access Point', 'Router', 'Hub', 'B', 1, 'mcq', '', 'used', 37),
(103, 6, 'The main advantage of computer networking is:', 'Increased redundancy', 'Sharing of resources and faster communication', 'Reduced storage', 'Increased cable usage', 'B', 1, 'mcq', '', 'used', 4),
(104, 6, 'Which of the following represents a wired medium?', 'Radio frequency', 'Twisted pair cable', 'Infrared', 'Wi-Fi', 'B', 1, 'mcq', '', 'used', 8),
(105, 6, 'Which device operates at both Layer 2 and Layer 3?', 'Multilayer Switch', 'Hub', 'Repeater', 'Bridge', 'A', 1, 'mcq', '', 'used', 4),
(106, 6, 'MAC address is associated with which layer?', 'Network layer', 'Data link layer', 'Transport layer', 'Application layer', 'B', 1, 'mcq', '', 'used', 3),
(107, 6, 'A network interface card (NIC) provides a:', 'Physical connection between a computer and a network', 'Software link between computers', 'Connection to a database', 'Link to storage', 'A', 1, 'mcq', '', 'used', 4),
(108, 6, 'The function of a switch is to:', 'Amplify signals', 'Forward data based on MAC addresses', 'Connect to the Internet', 'Translate protocols', 'B', 1, 'mcq', '', 'used', 5),
(109, 6, 'RJ-45 connectors are used for:', 'Telephone lines', 'Ethernet cables', 'Fiber cables', 'Coaxial cables', 'B', 1, 'mcq', '', 'used', 37),
(110, 6, 'RJ-11 connectors are used for:', 'Ethernet cables', 'Telephone lines', 'USB devices', 'Fiber cables', 'B', 1, 'mcq', '', 'used', 8),
(111, 6, 'A repeater is used to:', 'Extend the distance of a network signal', 'Filter data', 'Provide IP addresses', 'Block interference', 'A', 1, 'mcq', '', 'used', 37),
(112, 6, 'Network protocols are rules that:', 'Define how data is transmitted and received', 'Store passwords', 'Display websites', 'Convert data to sound', 'A', 1, 'mcq', '', 'used', 4),
(113, 6, 'The physical path through which data travels is the:', 'Protocol', 'Medium', 'Node', 'Address', 'B', 1, 'mcq', '', 'used', 3),
(114, 6, 'The function of a crimping tool is to:', 'Cut fiber optic cables', 'Attach connectors to network cables', 'Test signal strength', 'Monitor data', 'B', 1, 'mcq', '', 'used', 3),
(115, 6, 'Which device reduces collisions by separating network segments?', 'Bridge', 'Hub', 'Repeater', 'Router', 'A', 1, 'mcq', '', 'used', 3),
(116, 6, 'A network can be classified based on:', 'Size and topology', 'Color and design', 'Speed and cost', 'Brand of devices', 'A', 1, 'mcq', '', 'used', 4),
(117, 6, 'Which of these is not an advantage of computer networking?', 'Data sharing', 'File access', 'Hardware sharing', 'Privacy increase', 'D', 1, 'mcq', '', 'used', 37),
(118, 6, 'A LAN generally covers:', 'One city', 'One building or campus', 'One country', 'Global networks', 'B', 1, 'mcq', '', 'used', 8),
(119, 6, 'The smallest type of network is a:', 'LAN', 'PAN', 'MAN', 'WAN', 'B', 1, 'mcq', '', 'used', 5),
(120, 6, 'Which type of network spans countries or continents?', 'LAN', 'MAN', 'WAN', 'PAN', 'C', 1, 'mcq', '', 'used', 5),
(121, 6, 'A MAN covers:', 'A single room', 'A city or large campus', 'A global area', 'A building', 'B', 1, 'mcq', '', 'used', 37),
(122, 6, 'Which network type is commonly used for home devices via Bluetooth?', 'WAN', 'PAN', 'MAN', 'LAN', 'B', 1, 'mcq', '', 'used', 4),
(123, 6, 'A hybrid network combines:', 'Two or more topologies', 'Two or more routers', 'Cables and wireless signals only', 'IPv4 and IPv6', 'A', 1, 'mcq', '', 'used', 37),
(124, 6, 'The physical layout of a network is called its:', 'Protocol', 'Topology', 'Bandwidth', 'Configuration', 'B', 1, 'mcq', '', 'used', 4),
(125, 6, 'In a bus topology, data travels:', 'Through a central hub', 'Along a single backbone cable', 'Through ring connections', 'Randomly', 'B', 1, 'mcq', '', 'used', 5),
(126, 6, 'In a star topology, if the central hub fails:', 'Only one computer is affected', 'The whole network stops functioning', 'Data continues using another route', 'Nothing happens', 'B', 1, 'mcq', '', 'used', 5),
(127, 6, 'In a bus topology, what happens when the main cable breaks?', 'Only one device is affected', 'The entire network goes down', 'The network speed increases', 'Data is redirected automatically', 'B', 1, 'mcq', '', 'used', 3),
(128, 6, 'Which of the following topologies is most fault-tolerant?', 'Ring', 'Bus', 'Mesh', 'Star', 'C', 1, 'mcq', '', 'used', 38),
(129, 6, 'Which topology connects each node to every other node?', 'Star', 'Mesh', 'Bus', 'Tree', 'B', 1, 'mcq', '', 'used', 38),
(130, 6, 'Which topology uses a central cable known as a backbone?', 'Ring', 'Bus', 'Star', 'Mesh', 'B', 1, 'mcq', '', 'used', 5),
(131, 6, 'In a ring topology, data travels:', 'In a circular path from one device to another', 'Through a central hub', 'Randomly to all devices', 'In both directions simultaneously', 'A', 1, 'mcq', '', 'used', 4),
(132, 6, 'Which topology is a combination of star and bus topologies?', 'Ring', 'Hybrid', 'Tree', 'Mesh', 'C', 1, 'mcq', '', 'used', 8),
(133, 6, 'The topology most commonly used in Ethernet networks is:', 'Ring', 'Bus', 'Star', 'Mesh', 'C', 1, 'mcq', '', 'used', 4),
(134, 6, 'The tree topology is suitable for:', 'Small, single-room networks', 'Large hierarchical organizations or schools', 'Mobile devices only', 'Wireless networks', 'B', 1, 'mcq', '', 'used', 3),
(135, 6, 'Which topology is the most cost-effective for small networks?', 'Mesh', 'Star', 'Bus', 'Hybrid', 'C', 1, 'mcq', '', 'used', 8),
(147, 6, 'A network administrator connects two campuses in different towns. Which type of network connection is most suitable?', 'LAN', 'MAN', 'WAN', 'PAN', 'C', 1, 'mcq', NULL, 'used', 3),
(148, 6, 'In a bus topology, all devices share:', 'The same network switch', 'A single backbone cable', 'Individual direct connections', 'A wireless access point', 'B', 1, 'mcq', NULL, 'used', 5),
(149, 6, 'In a star topology, all computers are connected to:', 'Each other directly', 'A central hub or switch', 'A router', 'A common ring', 'B', 1, 'mcq', NULL, 'used', 37),
(150, 6, 'A ring topology allows data to travel:', 'Only one way around the ring', 'In both directions always', 'Randomly across nodes', 'To all devices at once', 'A', 1, 'mcq', NULL, 'used', 3),
(151, 6, 'The main advantage of a mesh topology is:', 'Low cost', 'High reliability and redundancy', 'Simplicity of design', 'Easy cabling', 'B', 1, 'mcq', NULL, 'used', 4),
(152, 6, 'Which topology is most cost-effective to install in small networks?\r\n', 'Mesh', 'Star', 'Bus', 'Hybrid', 'C', 1, 'mcq', NULL, 'used', 8),
(153, 6, 'A tree topology is best described as:', 'A combination of star and bus', 'A combination of ring and mesh', 'A wireless structure', 'A direct connection between all devices', 'A', 1, 'mcq', NULL, 'used', 3),
(154, 6, 'In a bus topology, data collisions are likely because:', 'There are multiple backbone cables', 'All devices share a common medium', 'Devices communicate via routers', 'Switches isolate each signal', 'B', 1, 'mcq', NULL, 'used', 5),
(155, 6, 'Star topology is preferred in modern LANs because:', 'It uses less cable', 'It allows easy fault isolation and scalability', 'It uses wireless signals', 'It eliminates the need for network devices', 'B', 1, 'mcq', NULL, 'used', 8),
(156, 6, 'Which topology requires the most cabling?', 'Ring', 'Bus', 'Star', 'Mesh', 'D', 1, 'mcq', NULL, 'used', 5),
(157, 6, 'The performance of a star topology mainly depends on:', 'The type of central device used', 'The number of computers', 'The operating system', 'Cable color', 'A', 1, 'mcq', NULL, 'used', 37),
(158, 6, 'In a bus topology, what device is used at both ends of the main cable?', 'Hub', 'Repeater', 'Terminator', 'Bridge', 'C', 1, 'mcq', NULL, 'used', 37),
(159, 6, 'In a mesh topology, if one link fails:', 'The entire network stops', 'Only that link is affected', 'All nodes must restart', 'Data cannot be rerouted', 'B', 1, 'mcq', NULL, 'used', 5),
(160, 6, 'The failure of one node affects the whole network in which topology?', 'Mesh', 'Bus', 'Ring', 'Star', 'C', 1, 'mcq', NULL, 'used', 37),
(161, 6, 'Which topology uses token passing for data transmission?', 'Bus', 'Ring', 'Mesh', 'Star', 'B', 1, 'mcq', NULL, 'used', 3),
(162, 6, 'The hybrid topology provides:', 'Flexibility and reliability', 'Simplified design', 'No redundancy', 'Less cabling cost', 'A', 1, 'mcq', NULL, 'used', 4),
(163, 6, 'The most secure topology due to point-to-point links is:', 'Star', 'Mesh', 'Ring', 'Tree', 'B', 1, 'mcq', NULL, 'used', 37),
(164, 6, 'The topology best suited for video conferencing systems requiring reliability and speed is:', 'Mesh', 'Bus', 'Tree', 'Ring', 'A', 1, 'mcq', NULL, 'used', 3),
(165, 6, 'In a tree topology, each branch is connected to:\r\n', 'Central cable', 'Central hub', 'Root node or parent network', 'Router', 'C', 1, 'mcq', NULL, 'used', 37),
(166, 6, 'Which topology is most efficient for a small office that requires low cost and simplicity?', 'Mesh', 'Bus', 'Star', 'Hybrid', 'B', 1, 'mcq', NULL, 'used', 4),
(167, 6, 'If the central cable of a bus topology is damaged, what will happen?', 'Only one computer loses connection', 'Entire network stops working', 'The hub will bypass the error', ' Data finds another route', 'B', 1, 'mcq', NULL, 'used', 3),
(168, 6, 'A classroomâ€™s computers are connected using a hub, and each student accesses shared files. Which topology is being used?\r\n', 'Mesh', 'Bus', 'Star', 'Ring', 'C', 1, 'mcq', NULL, 'used', 8),
(169, 6, 'A research center connects various types of topologies â€” bus, star, and mesh â€” across departments. The overall setup is:', 'Tree topology', 'Hybrid topology', 'Mesh topology', 'Bus topology', 'B', 1, 'mcq', NULL, 'used', 3),
(170, 6, 'A company needs a network that can easily expand without redesigning everything. Which topology is ideal?', 'Star', 'Bus', 'Mesh', 'Ring', 'A', 1, 'mcq', NULL, 'used', 5),
(171, 1, 'What are the output of the following php script: \r\n<html>\r\n<body>\r\n<?php\r\necho strlen(\"Hello world!\"); ?>\r\n</body>\r\n</html>', NULL, NULL, NULL, NULL, NULL, 5, 'open', '', 'used', 1),
(1095, 15, 'Which component manages database storage?', 'DBMS', 'Operating System', 'Compiler', 'Assembler', 'A', 2, 'mcq', NULL, 'used', 1),
(1096, 15, 'Which query language is most widely used in Database?', 'SQL', 'HTML', 'CSS', 'Python', 'A', 2, 'mcq', NULL, 'used', 8),
(1097, 15, 'Which is NOT a database type?', 'Relational', 'NoSQL', 'Object-oriented', 'Spreadsheet', 'D', 2, 'mcq', NULL, 'available', NULL),
(1098, 15, 'Which database organizes data in rows and columns?', 'Relational', 'NoSQL', 'Object-oriented', 'Graph', 'A', 2, 'mcq', NULL, 'used', 2),
(1099, 15, 'Which database is schema-less?', 'Relational', 'NoSQL', 'Object-oriented', 'Hierarchical', 'B', 2, 'mcq', NULL, 'available', NULL),
(1100, 15, 'Which database stores objects directly?', 'Relational', 'NoSQL', 'Object-oriented', 'Hierarchical', 'C', 2, 'mcq', NULL, 'used', 43),
(1101, 15, 'Which database spreads across multiple servers?', 'Relational', 'NoSQL', 'Object-oriented', 'Distributed', 'D', 2, 'mcq', NULL, 'used', 40),
(1102, 15, 'Data redundancy means...', 'Duplicate data', 'Accurate data', 'Secured data', 'Encrypted data', 'A', 2, 'mcq', NULL, 'used', 37),
(1103, 15, 'Data integrity ensures...', 'Accuracy and consistency', 'Duplicate data', 'Unauthorized access', 'Loss of data', 'A', 2, 'mcq', NULL, 'available', NULL),
(1104, 15, 'Which feature protects sensitive data?', 'Passwords', 'DBMS Security', 'Manual locks', 'Flat files', 'B', 2, 'mcq', NULL, 'available', NULL),
(1105, 15, 'Which feature allows multiple users?', 'Concurrent Access', 'Single Access', 'No Access', 'Limited Access', 'A', 2, 'mcq', NULL, 'available', NULL),
(1106, 15, 'Which feature helps decision making?', 'Reports', 'Manual files', 'Flat files', 'Spreadsheets', 'A', 2, 'mcq', NULL, 'used', 8),
(1107, 15, 'Which feature allows automation?', 'Automation', 'Manual entry', 'Flat files', 'Spreadsheets', 'A', 2, 'mcq', NULL, 'used', 43),
(1108, 15, 'Which challenge exists in DBMS?', 'Scalability', 'Security', 'Integrity', 'All of the above', 'D', 2, 'mcq', NULL, 'available', NULL),
(1109, 15, 'Flat files are...', 'Independent files', 'Relational tables', 'Objects', 'Indexes', 'A', 2, 'mcq', NULL, 'available', NULL),
(1110, 15, 'Which DBMS advantage allows backup?', 'Backup', 'Data Reliability', 'Data Protection', 'DDL', 'A', 2, 'mcq', NULL, 'available', NULL),
(1111, 15, 'Which DBMS advantage allows interfaces?', 'Variation of Interfaces', 'Data Reliability', 'Backup', 'DDL', 'A', 2, 'mcq', NULL, 'available', NULL),
(1112, 15, 'Which DBMS advantage ensures recovery?', 'System Failure', 'Data Protection', 'Backup', 'DDL', 'A', 2, 'mcq', NULL, 'used', 38),
(1113, 15, 'Which DBMS advantage ensures protection?', 'Data Protection', 'Data Reliability', 'Backup', 'DDL', 'A', 2, 'mcq', NULL, 'available', NULL),
(1114, 15, 'Which DBMS advantage allows easy maintenance?', 'Centralized Structure', 'Flat Files', 'Manual Storage', 'Spreadsheets', 'A', 2, 'mcq', NULL, 'used', 38),
(1117, 15, 'Which DBMS language defines schema?', 'DDL', 'DML', 'DCL', 'TCL', 'A', 2, 'mcq', NULL, 'available', NULL),
(1118, 15, 'Which DBMS language manipulates data?', 'DDL', 'DML', 'DCL', 'TCL', 'B', 2, 'mcq', NULL, 'available', NULL),
(1119, 15, 'Which database type uses documents?', 'Relational', 'NoSQL', 'Object-oriented', 'Hierarchical', 'B', 2, 'mcq', NULL, 'used', 1),
(1120, 15, 'Which database type uses key-value pairs?', 'Relational', 'NoSQL', 'Object-oriented', 'Hierarchical', 'B', 2, 'mcq', NULL, 'used', 43),
(1121, 15, 'Which database type uses wide-column stores?', 'Relational', 'NoSQL', 'Object-oriented', 'Hierarchical', 'B', 2, 'mcq', NULL, 'available', NULL),
(1122, 15, 'Which database type uses graphs?', 'Relational', 'NoSQL', 'Object-oriented', 'Graph', 'D', 2, 'mcq', NULL, 'used', 77),
(1123, 15, 'Which database type stores objects?', 'Relational', 'NoSQL', 'Object-oriented', 'Hierarchical', 'C', 2, 'mcq', NULL, 'available', NULL),
(1124, 15, 'Which database type spreads across servers?', 'Relational', 'NoSQL', 'Object-oriented', 'Distributed', 'D', 2, 'mcq', NULL, 'available', NULL),
(1125, 15, 'Which is most common database type?', 'Relational', 'NoSQL', 'Object-oriented', 'Distributed', 'A', 2, 'mcq', NULL, 'used', 77),
(1126, 15, 'Which database is best for social networks?', 'Relational', 'NoSQL', 'Object-oriented', 'Graph', 'D', 2, 'mcq', NULL, 'used', 2),
(1127, 15, 'Which database is best for banks?', 'Relational', 'NoSQL', 'Object-oriented', 'Distributed', 'A', 2, 'mcq', NULL, 'available', NULL),
(1128, 15, 'Which database is best for big data?', 'Relational', 'NoSQL', 'Object-oriented', 'Hierarchical', 'B', 2, 'mcq', NULL, 'available', NULL),
(1129, 15, 'Which database is best for CAD systems?', 'Relational', 'NoSQL', 'Object-oriented', 'Specialized', 'C', 2, 'mcq', NULL, 'used', 4),
(1130, 15, 'Which database is best for decentralized ops?', 'Relational', 'NoSQL', 'Object-oriented', 'Distributed', 'D', 2, 'mcq', NULL, 'used', 37),
(1131, 15, 'Which database uses SQL?', 'Relational', 'NoSQL', 'Object-oriented', 'Graph', 'A', 2, 'mcq', NULL, 'available', NULL),
(1132, 15, 'Which database uses MongoDB?', 'Relational', 'NoSQL', 'Object-oriented', 'Graph', 'B', 2, 'mcq', NULL, 'available', NULL),
(1133, 15, 'Which database uses Neo4j?', 'Relational', 'NoSQL', 'Object-oriented', 'Graph', 'D', 2, 'mcq', NULL, 'available', NULL),
(1134, 15, 'Which database uses Redis?', 'Relational', 'NoSQL', 'Object-oriented', 'Graph', 'B', 2, 'mcq', NULL, 'used', 8),
(1135, 15, 'Which database uses Cassandra?', 'Relational', 'NoSQL', 'Object-oriented', 'Graph', 'B', 2, 'mcq', NULL, 'available', NULL),
(1136, 15, 'Which database uses Oracle?', 'Relational', 'NoSQL', 'Object-oriented', 'Graph', 'A', 2, 'mcq', NULL, 'used', 8),
(1137, 15, 'Which database uses PostgreSQL?', 'Relational', 'NoSQL', 'Object-oriented', 'Graph', 'A', 2, 'mcq', NULL, 'used', 5),
(1138, 15, 'Which database uses MySQL?', 'Relational', 'NoSQL', 'Object-oriented', 'Graph', 'A', 2, 'mcq', NULL, 'used', 2),
(1139, 15, 'Which database uses CouchDB?', 'Relational', 'NoSQL', 'Object-oriented', 'Graph', 'B', 2, 'mcq', NULL, 'available', NULL),
(1140, 15, 'Which database uses DB2?', 'Relational', 'NoSQL', 'Object-oriented', 'Graph', 'A', 2, 'mcq', NULL, 'available', NULL),
(1141, 15, 'Which database is best for airline reservations?', 'Relational', 'NoSQL', 'Object-oriented', 'Graph', 'A', 2, 'mcq', NULL, 'used', 4),
(1142, 15, 'Which database is best for e-commerce catalogs?', 'Relational', 'NoSQL', 'Object-oriented', 'Graph', 'B', 2, 'mcq', NULL, 'available', NULL),
(1143, 15, 'Which database is best for social media feeds?', 'Relational', 'NoSQL', 'Object-oriented', 'Graph', 'D', 2, 'mcq', NULL, 'available', NULL),
(1144, 15, 'Traditional file systems store...', 'Flat files', 'Relational tables', 'Objects', 'Graphs', 'A', 2, 'mcq', NULL, 'available', NULL),
(1145, 15, 'File systems cause...', 'Data redundancy', 'Data integrity', 'Data security', 'All of the above', 'D', 2, 'mcq', NULL, 'available', NULL),
(1146, 15, 'File systems lack...', 'ACID properties', 'Data redundancy', 'Data duplication', 'Indexes', 'A', 2, 'mcq', NULL, 'available', NULL),
(1147, 15, 'File systems maintenance cost is...', 'High', 'Low', 'Zero', 'Medium', 'A', 2, 'mcq', NULL, 'used', 4),
(1148, 15, 'File systems store...', 'Independent files', 'Centralized data', 'Objects', 'Indexes', 'A', 2, 'mcq', NULL, 'available', NULL),
(1149, 15, 'File systems cause wrong address due to...', 'Loss of integrity', 'Data redundancy', 'Data duplication', 'Data protection', 'A', 2, 'mcq', NULL, 'available', NULL),
(1150, 15, 'File systems allow unauthorized access due to...', 'Weak security', 'Strong security', 'Encryption', 'Centralization', 'A', 2, 'mcq', NULL, 'available', NULL),
(1151, 15, 'File systems fail transactions due to...', 'No ACID', 'Strong ACID', 'Encryption', 'Indexes', 'A', 2, 'mcq', NULL, 'used', 2),
(1152, 15, 'File systems concurrent issues occur when...', 'Multiple updates', 'Single access', 'Data duplication', 'Data protection', 'A', 2, 'mcq', NULL, 'available', NULL),
(1153, 15, 'DBMS solves redundancy by...', 'Centralization', 'Duplication', 'Manual storage', 'Flat files', 'A', 2, 'mcq', NULL, 'used', 38),
(1154, 15, 'DBMS solves integrity by...', 'Consistency', 'Redundancy', 'Duplication', 'Flat files', 'A', 2, 'mcq', NULL, 'available', NULL),
(1155, 15, 'DBMS solves security by...', 'Access control', 'Redundancy', 'Duplication', 'Flat files', 'A', 2, 'mcq', NULL, 'available', NULL),
(1156, 15, 'DBMS solves transactions by...', 'ACID', 'Redundancy', 'Duplication', 'Flat files', 'A', 2, 'mcq', NULL, 'used', 77),
(1157, 15, 'DBMS solves concurrency by...', 'Locking', 'Redundancy', 'Duplication', 'Flat files', 'A', 2, 'mcq', NULL, 'used', 38),
(1158, 15, 'DBMS allows...', 'Backup', 'No backup', 'Manual storage', 'Flat files', 'A', 2, 'mcq', NULL, 'used', 1),
(1159, 15, 'DBMS allows...', 'Interfaces', 'No interfaces', 'Manual storage', 'Flat files', 'A', 2, 'mcq', NULL, 'used', 38),
(1160, 15, 'DBMS allows...', 'Recovery', 'No recovery', 'Manual storage', 'Flat files', 'A', 2, 'mcq', NULL, 'available', NULL),
(1161, 15, 'DBMS allows...', 'Protection', 'No protection', 'Manual storage', 'Flat files', 'A', 2, 'mcq', NULL, 'used', 5),
(1162, 15, 'DBMS allows...', 'Maintenance', 'No maintenance', 'Manual storage', 'Flat files', 'A', 2, 'mcq', NULL, 'used', 5),
(1163, 15, 'Flat files are...', 'Independent', 'Centralized', 'Objects', 'Indexes', 'A', 2, 'mcq', NULL, 'used', 77),
(1164, 15, 'DBMS is...', 'Centralized', 'Decentralized', 'Manual', 'Flat files', 'A', 2, 'mcq', NULL, 'available', NULL),
(1165, 15, 'File systems are...', 'Manual', 'Automated', 'Centralized', 'Secure', 'A', 2, 'mcq', NULL, 'used', 38),
(1166, 15, 'DBMS is...', 'Automated', 'Manual', 'Flat files', 'Decentralized', 'A', 2, 'mcq', NULL, 'available', NULL),
(1167, 15, 'File systems are...', 'Costly', 'Cheap', 'Efficient', 'Secure', 'A', 2, 'mcq', NULL, 'used', 43),
(1168, 15, 'Who manages database backups and recovery?', 'System Analyst', 'Database Administrator', 'Application Programmer', 'Casual User', 'B', 2, 'mcq', NULL, 'available', NULL),
(1169, 15, 'Which user defines the database schema?', 'Application Programmer', 'Database Designer', 'Casual User', 'DBA', 'B', 2, 'mcq', NULL, 'used', 43),
(1170, 15, 'Which user writes backend code for DBMS?', 'DBA', 'Application Programmer', 'Naive User', 'Sophisticated User', 'B', 2, 'mcq', NULL, 'available', NULL),
(1171, 15, 'Which user interacts daily without DBMS knowledge?', 'DBA', 'Naive User', 'System Analyst', 'Sophisticated User', 'B', 2, 'mcq', NULL, 'available', NULL),
(1172, 15, 'Which user occasionally uses the database?', 'Casual User', 'DBA', 'Designer', 'Naive User', 'A', 2, 'mcq', NULL, 'used', 37),
(1173, 15, 'Which user writes specialized applications?', 'Sophisticated User', 'Specialized User', 'Naive User', 'DBA', 'B', 2, 'mcq', NULL, 'used', 2),
(1174, 15, 'Which user analyzes requirements before design?', 'System Analyst', 'DBA', 'Designer', 'Naive User', 'A', 2, 'mcq', NULL, 'available', NULL),
(1175, 15, 'Which user creates tables and constraints?', 'Designer', 'DBA', 'Naive User', 'Casual User', 'A', 2, 'mcq', NULL, 'used', 37),
(1176, 15, 'Which user writes canned transactions?', 'Application Programmer', 'DBA', 'Designer', 'Naive User', 'A', 2, 'mcq', NULL, 'available', NULL),
(1177, 15, 'Which user repairs damage after crashes?', 'DBA', 'Designer', 'Naive User', 'Casual User', 'A', 2, 'mcq', NULL, 'available', NULL),
(1178, 15, 'Which user maintains accounts and permissions?', 'DBA', 'Designer', 'Naive User', 'Casual User', 'A', 2, 'mcq', NULL, 'available', NULL),
(1179, 15, 'Which user interacts directly with SQL?', 'Sophisticated User', 'Naive User', 'Casual User', 'DBA', 'A', 2, 'mcq', NULL, 'available', NULL),
(1180, 15, 'Which user is least technical?', 'Naive User', 'DBA', 'Designer', 'Casual User', 'A', 2, 'mcq', NULL, 'used', 43),
(1181, 15, 'Which user designs ER diagrams?', 'Database Designer', 'System Analyst', 'DBA', 'Casual User', 'A', 2, 'mcq', NULL, 'available', NULL),
(1182, 15, 'Which user ensures performance tuning?', 'DBA', 'Designer', 'Naive User', 'Casual User', 'A', 2, 'mcq', NULL, 'used', 5),
(1183, 15, 'Which user develops front-end applications?', 'Application Programmer', 'DBA', 'Designer', 'Naive User', 'A', 2, 'mcq', NULL, 'used', 77),
(1184, 15, 'Which user is responsible for security?', 'DBA', 'Designer', 'Naive User', 'Casual User', 'A', 2, 'mcq', NULL, 'used', 8),
(1185, 15, 'Which user is responsible for testing?', 'Application Programmer', 'DBA', 'Designer', 'Naive User', 'A', 2, 'mcq', NULL, 'available', NULL),
(1186, 15, 'Which user is responsible for requirements gathering?', 'System Analyst', 'DBA', 'Designer', 'Naive User', 'A', 2, 'mcq', NULL, 'used', 77),
(1187, 15, 'Which user is responsible for schema evolution?', 'Database Designer', 'DBA', 'Naive User', 'Casual User', 'A', 2, 'mcq', NULL, 'available', NULL),
(1188, 15, 'Which user is responsible for transaction design?', 'Application Programmer', 'DBA', 'Designer', 'Naive User', 'A', 2, 'mcq', NULL, 'used', 43),
(1189, 15, 'Which user is responsible for indexing?', 'DBA', 'Designer', 'Naive User', 'Casual User', 'A', 2, 'mcq', NULL, 'available', NULL),
(1190, 15, 'Which user is responsible for query optimization?', 'DBA', 'Designer', 'Naive User', 'Casual User', 'A', 2, 'mcq', NULL, 'available', NULL),
(1191, 15, 'Which user is responsible for hardware setup?', 'System Analyst', 'DBA', 'Designer', 'Naive User', 'A', 2, 'mcq', NULL, 'used', 37),
(1192, 15, 'Which user is responsible for training end-users?', 'DBA', 'Designer', 'Naive User', 'Casual User', 'A', 2, 'mcq', NULL, 'used', 4),
(1194, 15, 'Which independence protects applications from schema changes?', 'Logical', 'Physical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'used', 43),
(1195, 15, 'Which independence protects schema from storage changes?', 'Physical', 'Logical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'used', 4),
(1196, 15, 'Which independence is harder to achieve?', 'Logical', 'Physical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'used', 77),
(1197, 15, 'Which independence is easier to achieve?', 'Physical', 'Logical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'available', NULL),
(1198, 15, 'Which independence relates to external schema?', 'Logical', 'Physical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'used', 8),
(1199, 15, 'Which independence relates to internal schema?', 'Physical', 'Logical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'available', NULL),
(1200, 15, 'Which independence is linked to conceptual schema?', 'Logical', 'Physical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'available', NULL),
(1201, 15, 'Which independence is linked to physical storage?', 'Physical', 'Logical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'available', NULL),
(1202, 15, 'Which independence ensures portability?', 'Logical', 'Physical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'used', 43),
(1203, 15, 'Which independence ensures flexibility?', 'Logical', 'Physical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'used', 37),
(1204, 15, 'Which independence ensures scalability?', 'Logical', 'Physical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'available', NULL),
(1205, 15, 'Which independence ensures maintainability?', 'Logical', 'Physical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'used', 4),
(1206, 15, 'Which independence ensures adaptability?', 'Logical', 'Physical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'available', NULL),
(1207, 15, 'Which independence ensures abstraction?', 'Logical', 'Physical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'used', 8),
(1208, 15, 'Which independence ensures insulation?', 'Logical', 'Physical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'available', NULL),
(1209, 15, 'Which independence ensures separation of concerns?', 'Logical', 'Physical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'used', 37),
(1210, 15, 'Which independence ensures minimal disruption?', 'Logical', 'Physical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'available', NULL),
(1211, 15, 'Which independence ensures user transparency?', 'Logical', 'Physical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'used', 5),
(1212, 15, 'Which independence ensures developer productivity?', 'Logical', 'Physical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'used', 43),
(1213, 15, 'Which independence ensures system longevity?', 'Logical', 'Physical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'available', NULL),
(1214, 15, 'Which independence ensures schema evolution?', 'Logical', 'Physical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'available', NULL),
(1215, 15, 'Which independence ensures storage evolution?', 'Physical', 'Logical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'used', 38),
(1216, 15, 'Which independence ensures application evolution?', 'Logical', 'Physical', 'Functional', 'Structural', 'A', 2, 'mcq', NULL, 'used', 77),
(1217, 15, 'Which DBMS language defines schema?', 'DDL', 'DML', 'DCL', 'TCL', 'A', 2, 'mcq', NULL, 'used', 37),
(1218, 15, 'Which DBMS language manipulates data?', 'DDL', 'DML', 'DCL', 'TCL', 'B', 2, 'mcq', NULL, 'used', 8),
(1219, 15, 'Which DBMS language controls access?', 'DDL', 'DML', 'DCL', 'TCL', 'C', 2, 'mcq', NULL, 'used', 43),
(1220, 15, 'Which DBMS language manages transactions?', 'DDL', 'DML', 'DCL', 'TCL', 'D', 2, 'mcq', NULL, 'used', 77),
(1221, 15, 'Which command creates a table?', 'CREATE', 'ALTER', 'DROP', 'TRUNCATE', 'A', 2, 'mcq', NULL, 'used', 40),
(1222, 15, 'Which command modifies a table?', 'CREATE', 'ALTER', 'DROP', 'TRUNCATE', 'B', 2, 'mcq', NULL, 'used', 1),
(1223, 15, 'Which command removes a table?', 'CREATE', 'ALTER', 'DROP', 'TRUNCATE', 'C', 2, 'mcq', NULL, 'available', NULL),
(1224, 15, 'Which command clears rows?', 'DELETE', 'DROP', 'TRUNCATE', 'UPDATE', 'C', 2, 'mcq', NULL, 'available', NULL),
(1225, 15, 'Which command retrieves rows?', 'INSERT', 'UPDATE', 'DELETE', 'SELECT', 'D', 2, 'mcq', NULL, 'available', NULL),
(1226, 15, 'Which command adds new records?', 'INSERT', 'UPDATE', 'DELETE', 'SELECT', 'A', 2, 'mcq', NULL, 'used', 38),
(1227, 15, 'Which command changes existing records?', 'INSERT', 'UPDATE', 'DELETE', 'SELECT', 'B', 2, 'mcq', NULL, 'used', 5),
(1228, 15, 'Which command deletes records?', 'INSERT', 'UPDATE', 'DELETE', 'SELECT', 'C', 2, 'mcq', NULL, 'available', NULL),
(1229, 15, 'Which command permanently saves changes?', 'COMMIT', 'ROLLBACK', 'SAVEPOINT', 'GRANT', 'A', 2, 'mcq', NULL, 'available', NULL),
(1230, 15, 'Which command undoes changes?', 'COMMIT', 'ROLLBACK', 'SAVEPOINT', 'GRANT', 'B', 2, 'mcq', NULL, 'used', 8),
(1231, 15, 'Which command sets rollback point?', 'COMMIT', 'ROLLBACK', 'SAVEPOINT', 'GRANT', 'C', 2, 'mcq', NULL, 'available', NULL),
(1232, 15, 'Which command grants permissions?', 'COMMIT', 'ROLLBACK', 'SAVEPOINT', 'GRANT', 'D', 2, 'mcq', NULL, 'available', NULL),
(1233, 15, 'Which command revokes permissions?', 'REVOKE', 'GRANT', 'ALTER', 'DROP', 'A', 2, 'mcq', NULL, 'available', NULL),
(1234, 15, 'Which command changes table structure?', 'ALTER', 'CREATE', 'DROP', 'TRUNCATE', 'A', 2, 'mcq', NULL, 'available', NULL),
(1235, 15, 'Which command deletes all rows but keeps structure?', 'TRUNCATE', 'DELETE', 'DROP', 'UPDATE', 'A', 2, 'mcq', NULL, 'used', 2),
(1236, 15, 'Which command removes database?', 'DROP', 'CREATE', 'ALTER', 'TRUNCATE', 'A', 2, 'mcq', NULL, 'available', NULL),
(1237, 15, 'Which command creates index?', 'CREATE INDEX', 'DROP INDEX', 'ALTER INDEX', 'TRUNCATE INDEX', 'A', 2, 'mcq', NULL, 'used', 43),
(1238, 15, 'Which command removes index?', 'DROP INDEX', 'CREATE INDEX', 'ALTER INDEX', 'TRUNCATE INDEX', 'A', 2, 'mcq', NULL, 'used', 77),
(1239, 15, 'Which command changes index?', 'ALTER INDEX', 'CREATE INDEX', 'DROP INDEX', 'TRUNCATE INDEX', 'A', 2, 'mcq', NULL, 'available', NULL),
(1240, 15, 'Which command creates view?', 'CREATE VIEW', 'DROP VIEW', 'ALTER VIEW', 'TRUNCATE VIEW', 'A', 2, 'mcq', NULL, 'available', NULL),
(1241, 15, 'Which command removes view?', 'DROP VIEW', 'CREATE VIEW', 'ALTER VIEW', 'TRUNCATE VIEW', 'A', 2, 'mcq', NULL, 'available', NULL),
(1242, 15, 'Which ACID property ensures all-or-nothing execution?', 'Atomicity', 'Consistency', 'Isolation', 'Durability', 'A', 2, 'mcq', NULL, 'available', NULL),
(1243, 15, 'Which ACID property ensures database remains valid?', 'Atomicity', 'Consistency', 'Isolation', 'Durability', 'B', 2, 'mcq', NULL, 'used', 8),
(1244, 15, 'Which ACID property ensures transactions don’t interfere?', 'Atomicity', 'Consistency', 'Isolation', 'Durability', 'C', 2, 'mcq', NULL, 'available', NULL),
(1245, 15, 'Which ACID property ensures data survives crashes?', 'Atomicity', 'Consistency', 'Isolation', 'Durability', 'D', 2, 'mcq', NULL, 'used', 43),
(1246, 15, 'Which command permanently saves a transaction?', 'COMMIT', 'ROLLBACK', 'SAVEPOINT', 'GRANT', 'A', 2, 'mcq', NULL, 'available', NULL),
(1247, 15, 'Which command undoes a transaction?', 'COMMIT', 'ROLLBACK', 'SAVEPOINT', 'GRANT', 'B', 2, 'mcq', NULL, 'available', NULL),
(1248, 15, 'Which command sets a rollback point?', 'COMMIT', 'ROLLBACK', 'SAVEPOINT', 'GRANT', 'C', 2, 'mcq', NULL, 'available', NULL),
(1249, 15, 'Which command grants privileges?', 'COMMIT', 'ROLLBACK', 'SAVEPOINT', 'GRANT', 'D', 2, 'mcq', NULL, 'used', 4),
(1250, 15, 'Which command revokes privileges?', 'REVOKE', 'GRANT', 'ALTER', 'DROP', 'A', 2, 'mcq', NULL, 'used', 37),
(1251, 15, 'Which command starts a transaction?', 'BEGIN', 'START', 'OPEN', 'INIT', 'A', 2, 'mcq', NULL, 'available', NULL),
(1252, 15, 'Which command ends a transaction?', 'END', 'STOP', 'CLOSE', 'COMMIT', 'D', 2, 'mcq', NULL, 'used', 77),
(1253, 15, 'Which command cancels a transaction?', 'ROLLBACK', 'COMMIT', 'SAVEPOINT', 'GRANT', 'A', 2, 'mcq', NULL, 'available', NULL),
(1254, 15, 'Which command creates a savepoint?', 'SAVEPOINT', 'ROLLBACK', 'COMMIT', 'GRANT', 'A', 2, 'mcq', NULL, 'used', 43),
(1255, 15, 'Which command restores to savepoint?', 'ROLLBACK TO', 'SAVEPOINT', 'COMMIT', 'GRANT', 'A', 2, 'mcq', NULL, 'available', NULL),
(1256, 15, 'Which command changes isolation level?', 'SET ISOLATION', 'ALTER', 'UPDATE', 'DELETE', 'A', 2, 'mcq', NULL, 'available', NULL),
(1257, 15, 'Which isolation level allows dirty reads?', 'READ UNCOMMITTED', 'READ COMMITTED', 'REPEATABLE READ', 'SERIALIZABLE', 'A', 2, 'mcq', NULL, 'used', 38),
(1258, 15, 'Which isolation level prevents dirty reads?', 'READ COMMITTED', 'READ UNCOMMITTED', 'REPEATABLE READ', 'SERIALIZABLE', 'A', 2, 'mcq', NULL, 'used', 4),
(1259, 15, 'Which isolation level prevents non-repeatable reads?', 'REPEATABLE READ', 'READ COMMITTED', 'READ UNCOMMITTED', 'SERIALIZABLE', 'A', 2, 'mcq', NULL, 'used', 8),
(1260, 15, 'Which isolation level prevents phantom reads?', 'SERIALIZABLE', 'READ COMMITTED', 'READ UNCOMMITTED', 'REPEATABLE READ', 'A', 2, 'mcq', NULL, 'used', 43),
(1261, 15, 'Which transaction property ensures durability?', 'Durability', 'Atomicity', 'Consistency', 'Isolation', 'A', 2, 'mcq', NULL, 'used', 77),
(1262, 15, 'Which transaction property ensures isolation?', 'Isolation', 'Atomicity', 'Consistency', 'Durability', 'A', 2, 'mcq', NULL, 'used', 8),
(1263, 15, 'Which transaction property ensures atomicity?', 'Atomicity', 'Consistency', 'Isolation', 'Durability', 'A', 2, 'mcq', NULL, 'used', 43),
(1264, 15, 'Which transaction property ensures consistency?', 'Consistency', 'Atomicity', 'Isolation', 'Durability', 'A', 2, 'mcq', NULL, 'used', 4),
(1265, 15, 'Which transaction property ensures reliability?', 'Durability', 'Atomicity', 'Consistency', 'Isolation', 'A', 2, 'mcq', NULL, 'available', NULL),
(1266, 15, 'Which transaction property ensures correctness?', 'Consistency', 'Atomicity', 'Isolation', 'Durability', 'A', 2, 'mcq', NULL, 'used', 5),
(1267, 15, 'Which model organizes data as a tree?', 'Hierarchical', 'Network', 'Relational', 'ER', 'A', 2, 'mcq', NULL, 'used', 37),
(1268, 15, 'Which model organizes data as a graph?', 'Network', 'Hierarchical', 'Relational', 'ER', 'A', 2, 'mcq', NULL, 'available', NULL),
(1269, 15, 'Which model organizes data as tables?', 'Relational', 'Network', 'Hierarchical', 'ER', 'A', 2, 'mcq', NULL, 'used', 77),
(1270, 15, 'Which model organizes data as entities?', 'ER', 'Relational', 'Network', 'Hierarchical', 'A', 2, 'mcq', NULL, 'used', 43),
(1271, 15, 'Which model uses parent-child relationships?', 'Hierarchical', 'Network', 'Relational', 'ER', 'A', 2, 'mcq', NULL, 'used', 4),
(1272, 15, 'Which model uses many-to-many links?', 'Network', 'Hierarchical', 'Relational', 'ER', 'A', 2, 'mcq', NULL, 'used', 2),
(1273, 15, 'Which model uses rows and columns?', 'Relational', 'Network', 'Hierarchical', 'ER', 'A', 2, 'mcq', NULL, 'used', 4),
(1274, 15, 'Which model uses attributes and relationships?', 'ER', 'Relational', 'Network', 'Hierarchical', 'A', 2, 'mcq', NULL, 'used', 4),
(1275, 15, 'Which model is simplest?', 'Hierarchical', 'Network', 'Relational', 'ER', 'A', 2, 'mcq', NULL, 'used', 4),
(1276, 15, 'Which model is most flexible?', 'Network', 'Hierarchical', 'Relational', 'ER', 'A', 2, 'mcq', NULL, 'used', 77),
(1277, 15, 'Which model is most common?', 'Relational', 'Network', 'Hierarchical', 'ER', 'A', 2, 'mcq', NULL, 'available', NULL),
(1278, 15, 'Which model is most conceptual?', 'ER', 'Relational', 'Network', 'Hierarchical', 'A', 2, 'mcq', NULL, 'used', 4),
(1279, 15, 'Which model is best for organizational charts?', 'Hierarchical', 'Network', 'Relational', 'ER', 'A', 2, 'mcq', NULL, 'used', 8),
(1280, 15, 'Which model is best for airline routes?', 'Network', 'Hierarchical', 'Relational', 'ER', 'A', 2, 'mcq', NULL, 'used', 2),
(1281, 15, 'Which model is best for banking?', 'Relational', 'Network', 'Hierarchical', 'ER', 'A', 2, 'mcq', NULL, 'available', NULL),
(1282, 15, 'Which model is best for university database?', 'ER', 'Relational', 'Network', 'Hierarchical', 'A', 2, 'mcq', NULL, 'used', 1),
(1283, 15, 'Which model is best for XML data?', 'Hierarchical', 'Network', 'Relational', 'ER', 'A', 2, 'mcq', NULL, 'available', NULL),
(1284, 15, 'Which model is best for social networks?', 'Network', 'Hierarchical', 'Relational', 'ER', 'A', 2, 'mcq', NULL, 'available', NULL),
(1285, 15, 'Which model is best for e-commerce?', 'Relational', 'Network', 'Hierarchical', 'ER', 'A', 2, 'mcq', NULL, 'available', NULL);
INSERT INTO `questions` (`id`, `quiz_id`, `question_text`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`, `score`, `question_type`, `expected_keywords`, `status`, `assigned_to`) VALUES
(1286, 15, 'Which model is best for hospital records?', 'ER', 'Relational', 'Network', 'Hierarchical', 'A', 2, 'mcq', NULL, 'available', NULL),
(1287, 15, 'Which model is oldest?', 'Hierarchical', 'Network', 'Relational', 'ER', 'A', 2, 'mcq', NULL, 'used', 4),
(1288, 15, 'Which model is newest?', 'ER', 'Relational', 'Network', 'Hierarchical', 'A', 2, 'mcq', NULL, 'used', 8),
(1289, 15, 'Which model is most widely taught?', 'Relational', 'Network', 'Hierarchical', 'ER', 'A', 2, 'mcq', NULL, 'available', NULL),
(1290, 15, 'Which model is most abstract?', 'ER', 'Relational', 'Network', 'Hierarchical', 'A', 2, 'mcq', NULL, 'used', 38),
(1291, 15, 'Which model is most physical?', 'Hierarchical', 'Network', 'Relational', 'ER', 'A', 2, 'mcq', NULL, 'available', NULL),
(1292, 15, 'Which database is used in hospitals?', 'Hospital DB', 'Library DB', 'Airline DB', 'School DB', 'A', 2, 'mcq', NULL, 'available', NULL),
(1293, 15, 'Which database is used in banks?', 'Bank DB', 'Hospital DB', 'Library DB', 'School DB', 'A', 2, 'mcq', NULL, 'used', 43),
(1294, 15, 'Which database is used in schools?', 'School DB', 'Hospital DB', 'Bank DB', 'Library DB', 'A', 2, 'mcq', NULL, 'available', NULL),
(1295, 15, 'Which database is used in airlines?', 'Airline DB', 'Hospital DB', 'Bank DB', 'School DB', 'A', 2, 'mcq', NULL, 'used', 4),
(1296, 15, 'Which database is used in libraries?', 'Library DB', 'Hospital DB', 'Bank DB', 'School DB', 'A', 2, 'mcq', NULL, 'available', NULL),
(1297, 15, 'Which database stores patient records?', 'Hospital DB', 'Library DB', 'Bank DB', 'School DB', 'A', 2, 'mcq', NULL, 'available', NULL),
(1298, 15, 'Which database stores account records?', 'Bank DB', 'Hospital DB', 'Library DB', 'School DB', 'A', 2, 'mcq', NULL, 'used', 77),
(1299, 15, 'Which database stores student records?', 'School DB', 'Hospital DB', 'Bank DB', 'Library DB', 'A', 2, 'mcq', NULL, 'available', NULL),
(1300, 15, 'Which database stores flight schedules?', 'Airline DB', 'Hospital DB', 'Bank DB', 'Library DB', 'A', 2, 'mcq', NULL, 'used', 8),
(1301, 15, 'Which database stores book catalogs?', 'Library DB', 'Hospital DB', 'Bank DB', 'School DB', 'A', 2, 'mcq', NULL, 'used', 38),
(1302, 15, 'Which database is best for e-commerce?', 'E-commerce DB', 'Hospital DB', 'Bank DB', 'School DB', 'A', 2, 'mcq', NULL, 'used', 8),
(1303, 15, 'Which database is best for social media?', 'Social Media DB', 'Hospital DB', 'Bank DB', 'School DB', 'A', 2, 'mcq', NULL, 'used', 37),
(1304, 15, 'Which database is best for logistics?', 'Logistics DB', 'Hospital DB', 'Bank DB', 'School DB', 'A', 2, 'mcq', NULL, 'available', NULL),
(1305, 15, 'Which database is best for government records?', 'Government DB', 'Hospital DB', 'Bank DB', 'School DB', 'A', 2, 'mcq', NULL, 'used', 1),
(1306, 15, 'Which database is best for weather data?', 'Weather DB', 'Hospital DB', 'Bank DB', 'School DB', 'A', 2, 'mcq', NULL, 'available', NULL),
(1307, 15, 'Which database is best for transport?', 'Transport DB', 'Hospital DB', 'Bank DB', 'School DB', 'A', 2, 'mcq', NULL, 'used', 42),
(1308, 15, 'Which database is best for retail?', 'Retail DB', 'Hospital DB', 'Bank DB', 'School DB', 'A', 2, 'mcq', NULL, 'available', NULL),
(1309, 15, 'Which database is best for manufacturing?', 'Manufacturing DB', 'Hospital DB', 'Bank DB', 'School DB', 'A', 2, 'mcq', NULL, 'available', NULL),
(1310, 15, 'Which database is best for tourism?', 'Tourism DB', 'Hospital DB', 'Bank DB', 'School DB', 'A', 2, 'mcq', NULL, 'used', 77),
(1311, 15, 'Which database is best for agriculture?', 'Agriculture DB', 'Hospital DB', 'Bank DB', 'School DB', 'A', 2, 'mcq', NULL, 'available', NULL),
(1312, 15, 'Which database is best for energy?', 'Energy DB', 'Hospital DB', 'Bank DB', 'School DB', 'A', 2, 'mcq', NULL, 'used', 77),
(1313, 15, 'Which database is best for sports?', 'Sports DB', 'Hospital DB', 'Bank DB', 'School DB', 'A', 2, 'mcq', NULL, 'available', NULL),
(1314, 15, 'Which database is best for music?', 'Music DB', 'Hospital DB', 'Bank DB', 'School DB', 'A', 2, 'mcq', NULL, 'used', 77),
(1315, 15, 'Which database is best for movies?', 'Movies DB', 'Hospital DB', 'Bank DB', 'School DB', 'A', 2, 'mcq', NULL, 'available', NULL),
(1316, 15, 'Which database is best for science?', 'Science DB', 'Hospital DB', 'Bank DB', 'School DB', 'A', 2, 'mcq', NULL, 'used', 77),
(1317, 15, 'Which DBMS advantage reduces duplication?', 'Centralized Control', 'Manual Storage', 'Flat Files', 'Spreadsheets', 'A', 2, 'mcq', NULL, 'available', NULL),
(1318, 15, 'Which DBMS advantage improves accuracy?', 'Data Integrity', 'Data Redundancy', 'Data Duplication', 'Data Loss', 'A', 2, 'mcq', NULL, 'available', NULL),
(1319, 15, 'Which DBMS advantage improves security?', 'Access Control', 'Passwords only', 'Manual Locks', 'Flat Files', 'A', 2, 'mcq', NULL, 'used', 4),
(1320, 15, 'Which DBMS advantage supports multiple users?', 'Concurrent Access', 'Single Access', 'No Access', 'Limited Access', 'A', 2, 'mcq', NULL, 'used', 38),
(1321, 15, 'Which DBMS advantage helps decision making?', 'Reports', 'Manual Files', 'Flat Files', 'Spreadsheets', 'A', 2, 'mcq', NULL, 'available', NULL),
(1322, 15, 'Which DBMS advantage allows automation?', 'Automation', 'Manual Entry', 'Flat Files', 'Spreadsheets', 'A', 2, 'mcq', NULL, 'used', 5),
(1323, 15, 'Which DBMS advantage ensures scalability?', 'Scalability', 'Redundancy', 'Duplication', 'Flat Files', 'A', 2, 'mcq', NULL, 'available', NULL),
(1324, 15, 'Which DBMS advantage ensures reliability?', 'Reliability', 'Redundancy', 'Duplication', 'Flat Files', 'A', 2, 'mcq', NULL, 'used', 43),
(1325, 15, 'Which DBMS advantage ensures recovery?', 'Recovery', 'No Recovery', 'Manual Storage', 'Flat Files', 'A', 2, 'mcq', NULL, 'available', NULL),
(1326, 15, 'Which DBMS advantage ensures protection?', 'Protection', 'No Protection', 'Manual Storage', 'Flat Files', 'A', 2, 'mcq', NULL, 'available', NULL),
(1327, 15, 'Which DBMS advantage allows backup?', 'Backup', 'No Backup', 'Manual Storage', 'Flat Files', 'A', 2, 'mcq', NULL, 'used', 77),
(1328, 15, 'Which DBMS advantage allows easy maintenance?', 'Centralized Structure', 'Flat Files', 'Manual Storage', 'Spreadsheets', 'A', 2, 'mcq', NULL, 'available', NULL),
(1329, 15, 'Which DBMS advantage allows portability?', 'Portability', 'No Portability', 'Manual Storage', 'Flat Files', 'A', 2, 'mcq', NULL, 'available', NULL),
(1330, 15, 'Which DBMS advantage allows flexibility?', 'Flexibility', 'No Flexibility', 'Manual Storage', 'Flat Files', 'A', 2, 'mcq', NULL, 'used', 5),
(1331, 15, 'Which DBMS advantage allows abstraction?', 'Abstraction', 'No Abstraction', 'Manual Storage', 'Flat Files', 'A', 2, 'mcq', NULL, 'available', NULL),
(1332, 15, 'Which DBMS advantage allows insulation?', 'Insulation', 'No Insulation', 'Manual Storage', 'Flat Files', 'A', 2, 'mcq', NULL, 'used', 37),
(1333, 15, 'Which DBMS advantage allows transparency?', 'Transparency', 'No Transparency', 'Manual Storage', 'Flat Files', 'A', 2, 'mcq', NULL, 'available', NULL),
(1334, 15, 'Which DBMS advantage allows productivity?', 'Productivity', 'No Productivity', 'Manual Storage', 'Flat Files', 'A', 2, 'mcq', NULL, 'available', NULL),
(1335, 15, 'Which DBMS advantage allows longevity?', 'Longevity', 'No Longevity', 'Manual Storage', 'Flat Files', 'A', 2, 'mcq', NULL, 'used', 2),
(1336, 15, 'Which DBMS advantage allows evolution?', 'Evolution', 'No Evolution', 'Manual Storage', 'Flat Files', 'A', 2, 'mcq', NULL, 'used', 1),
(1337, 15, 'Which DBMS advantage allows indexing?', 'Indexing', 'No Indexing', 'Manual Storage', 'Flat Files', 'A', 2, 'mcq', NULL, 'available', NULL),
(1338, 15, 'Which DBMS advantage allows optimization?', 'Optimization', 'No Optimization', 'Manual Storage', 'Flat Files', 'A', 2, 'mcq', NULL, 'available', NULL),
(1339, 15, 'Which DBMS advantage allows tuning?', 'Tuning', 'No Tuning', 'Manual Storage', 'Flat Files', 'A', 2, 'mcq', NULL, 'used', 38),
(1340, 15, 'Which DBMS advantage allows monitoring?', 'Monitoring', 'No Monitoring', 'Manual Storage', 'Flat Files', 'A', 2, 'mcq', NULL, 'available', NULL),
(1341, 15, 'Which DBMS advantage allows auditing?', 'Auditing', 'No Auditing', 'Manual Storage', 'Flat Files', 'A', 2, 'mcq', NULL, 'used', 4),
(1342, 15, 'Which DBMS challenge is hardest?', 'Scalability', 'Security', 'Integrity', 'All of the above', 'D', 2, 'mcq', NULL, 'available', NULL),
(1343, 15, 'Which DBMS challenge relates to growth?', 'Scalability', 'Security', 'Integrity', 'Redundancy', 'A', 2, 'mcq', NULL, 'available', NULL),
(1344, 15, 'Which DBMS challenge relates to protection?', 'Security', 'Scalability', 'Integrity', 'Redundancy', 'A', 2, 'mcq', NULL, 'available', NULL),
(1345, 15, 'Which DBMS challenge relates to accuracy?', 'Integrity', 'Scalability', 'Security', 'Redundancy', 'A', 2, 'mcq', NULL, 'available', NULL),
(1346, 15, 'Which DBMS challenge relates to duplication?', 'Redundancy', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'available', NULL),
(1347, 15, 'Which DBMS challenge relates to cost?', 'Cost', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'available', NULL),
(1348, 15, 'Which DBMS challenge relates to complexity?', 'Complexity', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'used', 37),
(1349, 15, 'Which DBMS challenge relates to performance?', 'Performance', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'available', NULL),
(1350, 15, 'Which DBMS challenge relates to training?', 'Training', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'available', NULL),
(1351, 15, 'Which DBMS challenge relates to migration?', 'Migration', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'available', NULL),
(1352, 15, 'Which DBMS challenge relates to compatibility?', 'Compatibility', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'used', 37),
(1353, 15, 'Which DBMS challenge relates to updates?', 'Updates', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'used', 4),
(1354, 15, 'Which DBMS challenge relates to evolution?', 'Evolution', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'used', 77),
(1355, 15, 'Which DBMS challenge relates to maintenance?', 'Maintenance', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'used', 40),
(1356, 15, 'Which DBMS challenge relates to hardware?', 'Hardware', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'used', 5),
(1357, 15, 'Which DBMS challenge relates to software?', 'Software', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'available', NULL),
(1358, 15, 'Which DBMS challenge relates to licensing?', 'Licensing', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'available', NULL),
(1359, 15, 'Which DBMS challenge relates to vendor lock-in?', 'Vendor Lock-in', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'used', 77),
(1360, 15, 'Which DBMS challenge relates to upgrades?', 'Upgrades', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'used', 38),
(1361, 15, 'Which DBMS challenge relates to downtime?', 'Downtime', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'used', 1),
(1362, 15, 'Which DBMS challenge relates to disaster recovery?', 'Disaster Recovery', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'available', NULL),
(1363, 15, 'Which DBMS challenge relates to auditing?', 'Auditing', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'used', 5),
(1364, 15, 'Which DBMS challenge relates to monitoring?', 'Monitoring', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'available', NULL),
(1365, 15, 'Which DBMS challenge relates to optimization?', 'Optimization', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'used', 37),
(1366, 15, 'Which DBMS challenge relates to tuning?', 'Tuning', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'available', NULL),
(1367, 15, 'Which DBMS challenge relates to transparency?', 'Transparency', 'Integrity', 'Security', 'Scalability', 'A', 2, 'mcq', NULL, 'available', NULL),
(1368, 15, 'Which DBMS concept integrates multiple models?', 'Multimodel DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'used', 37),
(1369, 15, 'Which DBMS concept supports cloud?', 'Cloud DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'used', 4),
(1370, 15, 'Which DBMS concept supports big data?', 'Big Data DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'used', 43),
(1371, 15, 'Which DBMS concept supports AI?', 'AI DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'available', NULL),
(1372, 15, 'Which DBMS concept supports IoT?', 'IoT DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'used', 4),
(1373, 15, 'Which DBMS concept supports blockchain?', 'Blockchain DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'available', NULL),
(1374, 15, 'Which DBMS concept supports graph?', 'Graph DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'used', 43),
(1375, 15, 'Which DBMS concept supports document?', 'Document DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'used', 43),
(1376, 15, 'Which DBMS concept supports key-value?', 'Key-Value DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'available', NULL),
(1377, 15, 'Which DBMS concept supports wide-column?', 'Wide-Column DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'used', 37),
(1378, 15, 'Which DBMS concept supports time-series?', 'Time-Series DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'used', 4),
(1379, 15, 'Which DBMS concept supports spatial?', 'Spatial DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'available', NULL),
(1380, 15, 'Which DBMS concept supports multimedia?', 'Multimedia DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'used', 77),
(1381, 15, 'Which DBMS concept supports mobile?', 'Mobile DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'used', 1),
(1382, 15, 'Which DBMS concept supports distributed?', 'Distributed DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'available', NULL),
(1383, 15, 'Which DBMS concept supports federated?', 'Federated DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'used', 8),
(1384, 15, 'Which DBMS concept supports parallel?', 'Parallel DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'used', 2),
(1385, 15, 'Which DBMS concept supports in-memory?', 'In-Memory DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'available', NULL),
(1386, 15, 'Which DBMS concept supports columnar?', 'Columnar DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'used', 77),
(1387, 15, 'Which DBMS concept supports hybrid?', 'Hybrid DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'available', NULL),
(1388, 15, 'Which DBMS concept supports OLAP?', 'OLAP DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'available', NULL),
(1389, 15, 'Which DBMS concept supports OLTP?', 'OLTP DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'used', 4),
(1390, 15, 'Which DBMS concept supports analytics?', 'Analytics DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'available', NULL),
(1391, 15, 'Which DBMS concept supports warehousing?', 'Warehouse DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'used', 1),
(1392, 15, 'Which DBMS concept supports archiving?', 'Archive DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'used', 77),
(1393, 15, 'Which DBMS concept supports caching?', 'Cache DB', 'Relational DB', 'NoSQL DB', 'Object DB', 'A', 2, 'mcq', NULL, 'used', 38);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int NOT NULL,
  `teacher_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `quiz_title` varchar(100) NOT NULL,
  `duration_minutes` int NOT NULL DEFAULT '2',
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `question_limit` int DEFAULT '5'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `teacher_id`, `subject_id`, `class_name`, `quiz_title`, `duration_minutes`, `start_time`, `end_time`, `created_at`, `question_limit`) VALUES
(1, 19, 2, 'SPES', 'Introduction to PHP', 2, '2025-12-09 10:17:00', '2025-12-09 13:00:00', '2025-10-20 14:59:46', 25),
(2, 18, 4, 'SPES', 'Quiz on Network classification ', 2, '2025-10-27 09:00:00', '2025-10-27 10:30:00', '2025-10-21 15:55:39', 10),
(4, 18, 4, 'SPES', 'Quiz on the first two topics ', 2, '2025-10-27 09:00:00', '2025-10-27 10:00:00', '2025-10-22 12:35:06', 15),
(6, 18, 4, 'SPES', 'Quiz on Introduction to Computer Networking and Network Classifications', 2, '2025-10-27 09:00:00', '2025-10-27 10:00:00', '2025-10-22 13:32:05', 15),
(10, 7, 8, 'SPES', 'This is testing quiz', 2, '2025-10-23 12:10:00', '2025-10-24 12:10:00', '2025-10-23 12:10:43', 5),
(15, 19, 3, 'SPES', 'Database Retake Test', 2, '2025-12-09 10:10:00', '2025-12-09 11:00:00', '2025-11-20 12:23:07', 10);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_attempts`
--

CREATE TABLE `quiz_attempts` (
  `id` int NOT NULL,
  `quiz_id` int NOT NULL,
  `student_id` int NOT NULL,
  `attempt_start` datetime NOT NULL,
  `attempt_end` datetime NOT NULL,
  `finished` tinyint NOT NULL DEFAULT '0',
  `completed` int NOT NULL,
  `score` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_exam`
--

CREATE TABLE `quiz_exam` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `quiz_file` varchar(100) NOT NULL,
  `answer_file` varchar(100) NOT NULL,
  `text_answer` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` int NOT NULL,
  `quiz_id` int NOT NULL,
  `student_id` int NOT NULL,
  `marks` int NOT NULL,
  `submitted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`id`, `quiz_id`, `student_id`, `marks`, `submitted_at`) VALUES
(1, 8, 2, 75, '2025-10-22 22:04:42'),
(2, 1, 36, 75, '2025-10-26 15:44:08'),
(3, 1, 5, 75, '2025-10-26 15:59:00'),
(5, 1, 8, 75, '2025-10-26 18:43:38'),
(7, 1, 38, 100, '2025-10-26 20:52:00'),
(8, 1, 4, 100, '2025-10-26 21:11:21'),
(9, 6, 4, 87, '2025-10-27 09:03:49'),
(10, 6, 37, 73, '2025-10-27 09:08:08'),
(11, 6, 38, 100, '2025-10-27 09:08:21'),
(12, 6, 3, 87, '2025-10-27 09:08:43'),
(13, 6, 5, 100, '2025-10-27 09:11:45'),
(14, 6, 8, 73, '2025-10-27 09:19:14'),
(15, 1, 2, 100, '2025-10-28 08:33:20'),
(17, 1, 3, 0, '2025-10-28 08:36:47'),
(20, 1, 41, 60, '2025-10-28 08:41:57'),
(21, 1, 7, 25, '2025-10-28 08:43:27'),
(22, 1, 37, 85, '2025-10-28 08:46:43'),
(24, 1, 9, 40, '2025-10-28 08:49:06'),
(25, 1, 99, 60, '2025-10-28 08:54:14'),
(26, 1, 77, 100, '2025-10-28 08:54:36'),
(27, 1, 43, 60, '2025-10-28 09:02:46'),
(28, 1, 42, 100, '2025-10-28 09:04:04'),
(33, 1, 40, 100, '2025-10-28 09:19:52'),
(34, 14, 42, 88, '2025-11-20 12:20:15'),
(35, 15, 42, 60, '2025-11-23 13:20:49'),
(36, 15, 40, 100, '2025-11-23 13:52:29'),
(37, 15, 5, 68, '2025-11-23 17:08:47'),
(38, 15, 37, 88, '2025-11-23 17:14:58'),
(39, 15, 38, 88, '2025-11-23 17:19:14'),
(40, 15, 43, 76, '2025-11-23 17:43:54'),
(41, 15, 8, 72, '2025-11-23 17:54:24'),
(42, 15, 4, 72, '2025-11-23 18:32:10'),
(43, 15, 77, 92, '2025-11-23 20:16:24'),
(44, 15, 1, 20, '2025-12-09 10:20:30'),
(46, 1, 1, 60, '2025-12-09 10:36:10'),
(47, 15, 2, 90, '2025-12-09 10:44:47');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int NOT NULL,
  `setting_key` varchar(100) DEFAULT NULL,
  `setting_value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `setting_key`, `setting_value`) VALUES
(1, 'hero_title', 'Building Rwanda’s Next Generation of Developers'),
(2, 'hero_subtitle', 'A private Centre of Excellence delivering industry-aligned training.'),
(3, 'hero_image', 'images/IMG_3035-min.jpg'),
(4, 'school_email', 'info@nga.ac.rw'),
(5, 'school_phone', '+250789552671'),
(6, 'school_address', 'KG642st , Rugando, Kigali - Rwanda'),
(7, 'logo', 'images/nga-logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `spes_features`
--

CREATE TABLE `spes_features` (
  `id` int NOT NULL,
  `feature` text,
  `status` tinyint DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `class_name` varchar(100) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `allow` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `class_name`, `created_by`, `email`, `password`, `allow`, `created_at`) VALUES
(2, 'NDIZIHIWE Ninziza Gaella', 'SPES', NULL, 'Gaella', 'Gaella123', 1, '2025-12-09 08:35:10'),
(4, 'Utuje Oceanne Camilla', 'SPES', 0, 'utujeocean@gmail.com', 'Camilla123', 0, '2025-11-28 06:01:34'),
(5, 'ISHIMWE Kenny Kelvin', 'SPES', 0, 'ikennykelvin75@gmail.com', 'Kelvin123', 0, '2025-10-18 04:05:03'),
(8, 'TUNGA Tiana', 'SPES', 0, 'tiana.tunga@gmail.com', 'Tiana123', 0, '2025-10-18 04:05:10'),
(37, 'Brian HIRWA', 'SPES', NULL, 'bhirwa344@gmail.com', 'BrianH', 0, '2025-11-28 06:07:08'),
(38, 'Malvyn', 'SPES', NULL, 'malvyn304@gmail.com', 'malvyn123', 0, '2025-10-21 06:45:17'),
(40, 'Irakoze Gwiza Kheilla Vera', 'SPES', NULL, 'kheillavera@gmail.com', 'kheilla2010', 0, '2025-10-28 06:37:39'),
(42, 'Mugisha Alpha', 'SPES', 0, 'tigerkev07@gmail.com', 'Alpha123', 0, '2025-11-28 08:34:19'),
(43, 'Levi', 'SPES', 0, 'getmorelev@gmail.com', 'Levi123', 0, '2025-10-28 07:01:30'),
(77, 'Isaro Debstar', 'SPES', 0, 'isarodeborah85@gmail.com', 'Deborah123', 0, '2025-10-28 06:48:17');

-- --------------------------------------------------------

--
-- Table structure for table `students_history`
--

CREATE TABLE `students_history` (
  `id` int NOT NULL,
  `full_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `photo` varchar(255) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `full_history` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_answers`
--

CREATE TABLE `student_answers` (
  `id` int NOT NULL,
  `student_id` int DEFAULT NULL,
  `quiz_id` int DEFAULT NULL,
  `question_id` text,
  `selected_option` varchar(100) DEFAULT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `answer_text` varchar(255) DEFAULT NULL,
  `is_correct` tinyint DEFAULT '1',
  `assigned_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_answers`
--

INSERT INTO `student_answers` (`id`, `student_id`, `quiz_id`, `question_id`, `selected_option`, `student_name`, `answer_text`, `is_correct`, `assigned_at`) VALUES
(1, 2, 8, '144', 'A', NULL, NULL, 1, NULL),
(2, 2, 8, '140', 'B', NULL, NULL, 1, NULL),
(3, 2, 8, '146', 'Kwisanga, mafene, rugirangonga , inka, martha', NULL, NULL, 1, NULL),
(4, 2, 8, '141', 'C', NULL, NULL, 1, NULL),
(5, 36, 1, '21', 'A', NULL, NULL, 1, NULL),
(6, 36, 1, '55', 'D', NULL, NULL, 0, NULL),
(7, 36, 1, '53', 'A', NULL, NULL, 1, NULL),
(8, 36, 1, '64', 'B', NULL, NULL, 1, NULL),
(9, 5, 1, '4', 'B', NULL, NULL, 1, NULL),
(10, 5, 1, '52', 'B', NULL, NULL, 1, NULL),
(11, 5, 1, '22', 'C', NULL, NULL, 1, NULL),
(12, 5, 1, '40', 'B', NULL, NULL, 0, NULL),
(13, 2, 111, '26', 'A', NULL, NULL, 1, NULL),
(14, 2, 111, '75', 'B', NULL, NULL, 0, NULL),
(15, 2, 111, '14', 'C', NULL, NULL, 1, NULL),
(16, 8, 1, '46', 'C', NULL, NULL, 1, NULL),
(17, 8, 1, '71', 'C', NULL, NULL, 1, NULL),
(18, 8, 1, '54', 'D', NULL, NULL, 0, NULL),
(19, 8, 1, '12', 'B', NULL, NULL, 1, NULL),
(24, 38, 1, '41', 'B', NULL, NULL, 1, NULL),
(25, 38, 1, '7', 'C', NULL, NULL, 1, NULL),
(26, 38, 1, '80', 'D', NULL, NULL, 1, NULL),
(27, 38, 1, '16', 'C', NULL, NULL, 1, NULL),
(28, 4, 1, '44', 'B', NULL, NULL, 1, NULL),
(29, 4, 1, '34', 'A', NULL, NULL, 1, NULL),
(30, 4, 1, '24', 'B', NULL, NULL, 1, NULL),
(31, 4, 1, '53', 'A', NULL, NULL, 1, NULL),
(32, 4, 6, '86', 'A', NULL, NULL, 1, NULL),
(33, 4, 6, '103', 'B', NULL, NULL, 1, NULL),
(34, 4, 6, '116', 'A', NULL, NULL, 1, NULL),
(35, 4, 6, '151', 'B', NULL, NULL, 1, NULL),
(36, 4, 6, '166', 'B', NULL, NULL, 1, NULL),
(37, 4, 6, '124', 'B', NULL, NULL, 1, NULL),
(38, 4, 6, '82', 'C', NULL, NULL, 1, NULL),
(39, 4, 6, '131', 'A', NULL, NULL, 1, NULL),
(40, 4, 6, '91', 'A', NULL, NULL, 0, NULL),
(41, 4, 6, '162', 'A', NULL, NULL, 1, NULL),
(42, 4, 6, '112', 'A', NULL, NULL, 1, NULL),
(43, 4, 6, '133', 'D', NULL, NULL, 0, NULL),
(44, 4, 6, '105', 'A', NULL, NULL, 1, NULL),
(45, 4, 6, '107', 'A', NULL, NULL, 1, NULL),
(46, 4, 6, '122', 'B', NULL, NULL, 1, NULL),
(47, 37, 6, '123', 'A', NULL, NULL, 1, NULL),
(48, 37, 6, '165', 'C', NULL, NULL, 1, NULL),
(49, 37, 6, '149', 'B', NULL, NULL, 1, NULL),
(50, 37, 6, '100', 'D', NULL, NULL, 0, NULL),
(51, 37, 6, '90', 'A', NULL, NULL, 1, NULL),
(52, 37, 6, '88', 'A', NULL, NULL, 1, NULL),
(53, 37, 6, '157', 'A', NULL, NULL, 1, NULL),
(54, 37, 6, '102', 'C', NULL, NULL, 0, NULL),
(55, 37, 6, '117', 'D', NULL, NULL, 1, NULL),
(56, 37, 6, '163', 'B', NULL, NULL, 1, NULL),
(57, 37, 6, '158', 'A', NULL, NULL, 0, NULL),
(58, 37, 6, '109', 'B', NULL, NULL, 1, NULL),
(59, 37, 6, '111', 'A', NULL, NULL, 1, NULL),
(60, 37, 6, '160', 'D', NULL, NULL, 0, NULL),
(61, 37, 6, '121', 'B', NULL, NULL, 1, NULL),
(62, 38, 6, '129', 'B', NULL, NULL, 1, NULL),
(63, 38, 6, '128', 'C', NULL, NULL, 1, NULL),
(64, 38, 6, '83', 'B', NULL, NULL, 1, NULL),
(65, 38, 6, '85', 'B', NULL, NULL, 1, NULL),
(66, 3, 6, '113', 'B', NULL, NULL, 1, NULL),
(67, 3, 6, '115', 'A', NULL, NULL, 1, NULL),
(68, 3, 6, '153', 'A', NULL, NULL, 1, NULL),
(69, 3, 6, '164', 'A', NULL, NULL, 1, NULL),
(70, 3, 6, '169', 'B', NULL, NULL, 1, NULL),
(71, 3, 6, '161', 'B', NULL, NULL, 1, NULL),
(72, 3, 6, '127', 'B', NULL, NULL, 1, NULL),
(73, 3, 6, '84', 'D', NULL, NULL, 0, NULL),
(74, 3, 6, '98', 'B', NULL, NULL, 1, NULL),
(75, 3, 6, '147', 'C', NULL, NULL, 1, NULL),
(76, 3, 6, '114', 'B', NULL, NULL, 1, NULL),
(77, 3, 6, '134', 'B', NULL, NULL, 1, NULL),
(78, 3, 6, '150', 'B', NULL, NULL, 0, NULL),
(79, 3, 6, '167', 'B', NULL, NULL, 1, NULL),
(80, 3, 6, '106', 'B', NULL, NULL, 1, NULL),
(81, 5, 6, '154', 'B', NULL, NULL, 1, NULL),
(82, 5, 6, '148', 'B', NULL, NULL, 1, NULL),
(83, 5, 6, '119', 'B', NULL, NULL, 1, NULL),
(84, 5, 6, '130', 'B', NULL, NULL, 1, NULL),
(85, 5, 6, '108', 'B', NULL, NULL, 1, NULL),
(86, 5, 6, '81', 'A', NULL, NULL, 1, NULL),
(87, 5, 6, '159', 'B', NULL, NULL, 1, NULL),
(88, 5, 6, '125', 'B', NULL, NULL, 1, NULL),
(89, 5, 6, '126', 'B', NULL, NULL, 1, NULL),
(90, 5, 6, '156', 'D', NULL, NULL, 1, NULL),
(91, 5, 6, '101', 'B', NULL, NULL, 1, NULL),
(92, 5, 6, '89', 'B', NULL, NULL, 1, NULL),
(93, 5, 6, '170', 'A', NULL, NULL, 1, NULL),
(94, 5, 6, '120', 'C', NULL, NULL, 1, NULL),
(95, 5, 6, '92', 'B', NULL, NULL, 1, NULL),
(96, 8, 6, '104', 'B', NULL, NULL, 1, NULL),
(97, 8, 6, '87', 'A', NULL, NULL, 1, NULL),
(98, 8, 6, '168', 'C', NULL, NULL, 1, NULL),
(99, 8, 6, '99', 'D', NULL, NULL, 1, NULL),
(100, 8, 6, '155', 'B', NULL, NULL, 1, NULL),
(101, 8, 6, '152', 'C', NULL, NULL, 1, NULL),
(102, 8, 6, '94', 'D', NULL, NULL, 0, NULL),
(103, 8, 6, '118', 'B', NULL, NULL, 1, NULL),
(104, 8, 6, '93', 'A', NULL, NULL, 1, NULL),
(105, 8, 6, '95', 'C', NULL, NULL, 0, NULL),
(106, 8, 6, '97', 'C', NULL, NULL, 0, NULL),
(107, 8, 6, '132', 'B', NULL, NULL, 0, NULL),
(108, 8, 6, '135', 'C', NULL, NULL, 1, NULL),
(109, 8, 6, '110', 'B', NULL, NULL, 1, NULL),
(110, 8, 6, '96', 'A', NULL, NULL, 1, NULL),
(111, 2, 1, '26', 'A', NULL, NULL, 1, NULL),
(112, 2, 1, '75', 'D', NULL, NULL, 1, NULL),
(113, 2, 1, '14', 'C', NULL, NULL, 1, NULL),
(118, 3, 1, '40', 'A', NULL, NULL, 0, NULL),
(119, 3, 1, '69', 'C', NULL, NULL, 0, NULL),
(120, 3, 1, '70', 'A', NULL, NULL, 0, NULL),
(121, 3, 1, '68', 'C', NULL, NULL, 0, NULL),
(132, 41, 1, '30', 'A', NULL, NULL, 0, NULL),
(133, 41, 1, '11', 'A', NULL, NULL, 1, NULL),
(134, 41, 1, '67', 'B', NULL, NULL, 1, NULL),
(135, 41, 1, '8', 'D', NULL, NULL, 0, NULL),
(136, 41, 1, '13', 'A', NULL, NULL, 1, NULL),
(137, 7, 1, '47', 'C', NULL, NULL, 1, NULL),
(138, 7, 1, '76', 'B', NULL, NULL, 0, NULL),
(139, 7, 1, '30', 'C', NULL, NULL, 0, NULL),
(140, 7, 1, '58', 'A', NULL, NULL, 0, NULL),
(141, 37, 1, '171', '11', NULL, NULL, 0, NULL),
(142, 37, 1, '15', 'B', NULL, NULL, 1, NULL),
(143, 37, 1, '24', 'B', NULL, NULL, 1, NULL),
(144, 37, 1, '68', 'B', NULL, NULL, 1, NULL),
(145, 37, 1, '75', 'D', NULL, NULL, 1, NULL),
(151, 9, 1, '71', 'A', NULL, NULL, 0, NULL),
(152, 9, 1, '43', 'C', NULL, NULL, 0, NULL),
(153, 9, 1, '24', 'A', NULL, NULL, 0, NULL),
(154, 9, 1, '49', 'A', NULL, NULL, 1, NULL),
(155, 9, 1, '10', 'A', NULL, NULL, 1, NULL),
(156, 99, 1, '54', 'C', NULL, NULL, 1, NULL),
(157, 99, 1, '36', 'B', NULL, NULL, 0, NULL),
(158, 99, 1, '66', 'A', NULL, NULL, 1, NULL),
(159, 99, 1, '58', 'A', NULL, NULL, 0, NULL),
(160, 99, 1, '19', 'A', NULL, NULL, 1, NULL),
(161, 77, 1, '51', 'A', NULL, NULL, 1, NULL),
(162, 77, 1, '56', 'C', NULL, NULL, 1, NULL),
(163, 77, 1, '13', 'A', NULL, NULL, 1, NULL),
(164, 77, 1, '52', 'B', NULL, NULL, 1, NULL),
(165, 77, 1, '73', 'C', NULL, NULL, 1, NULL),
(166, 43, 1, '78', 'B', NULL, NULL, 1, NULL),
(167, 43, 1, '50', 'A', NULL, NULL, 1, NULL),
(168, 43, 1, '62', 'C', NULL, NULL, 1, NULL),
(169, 43, 1, '55', 'C', NULL, NULL, 0, NULL),
(170, 43, 1, '24', 'A', NULL, NULL, 0, NULL),
(171, 42, 1, '66', 'A', NULL, NULL, 1, NULL),
(172, 42, 1, '14', 'C', NULL, NULL, 1, NULL),
(173, 42, 1, '10', 'A', NULL, NULL, 1, NULL),
(174, 42, 1, '75', 'D', NULL, NULL, 1, NULL),
(175, 42, 1, '26', 'A', NULL, NULL, 1, NULL),
(196, 40, 1, '56', 'C', NULL, NULL, 1, NULL),
(197, 40, 1, '19', 'A', NULL, NULL, 1, NULL),
(198, 40, 1, '80', 'D', NULL, NULL, 1, NULL),
(199, 40, 1, '13', 'A', NULL, NULL, 1, NULL),
(200, 40, 1, '10', 'A', NULL, NULL, 1, NULL),
(201, 42, 14, '875', 'A', NULL, NULL, 1, NULL),
(202, 42, 14, '929', 'C', NULL, NULL, 1, NULL),
(203, 42, 14, '1083', 'A', NULL, NULL, 1, NULL),
(204, 42, 14, '1063', 'A', NULL, NULL, 1, NULL),
(205, 42, 14, '1023', 'A', NULL, NULL, 1, NULL),
(206, 42, 14, '1054', 'A', NULL, NULL, 1, NULL),
(207, 42, 14, '934', 'A', NULL, NULL, 1, NULL),
(208, 42, 14, '1068', 'A', NULL, NULL, 1, NULL),
(209, 42, 14, '1085', 'A', NULL, NULL, 1, NULL),
(210, 42, 14, '924', 'C', NULL, NULL, 1, NULL),
(211, 42, 14, '1057', 'A', NULL, NULL, 1, NULL),
(212, 42, 14, '994', 'A', NULL, NULL, 1, NULL),
(213, 42, 14, '871', 'B', NULL, NULL, 1, NULL),
(214, 42, 14, '1091', 'A', NULL, NULL, 1, NULL),
(215, 42, 14, '904', 'A', NULL, NULL, 1, NULL),
(216, 42, 14, '892', 'C', NULL, NULL, 0, NULL),
(217, 42, 14, '872', 'A', NULL, NULL, 0, NULL),
(218, 42, 14, '859', 'A', NULL, NULL, 1, NULL),
(219, 42, 14, '845', 'A', NULL, NULL, 1, NULL),
(220, 42, 14, '1051', 'A', NULL, NULL, 1, NULL),
(221, 42, 14, '866', 'B', NULL, NULL, 0, NULL),
(222, 42, 14, '922', 'A', NULL, NULL, 1, NULL),
(223, 42, 14, '941', 'A', NULL, NULL, 1, NULL),
(224, 42, 14, '895', 'A', NULL, NULL, 1, NULL),
(225, 42, 14, '919', 'B', NULL, NULL, 1, NULL),
(226, 42, 15, '1307', 'A', NULL, NULL, 1, NULL),
(227, 42, 15, '1330', 'A', NULL, NULL, 1, NULL),
(228, 42, 15, '1282', 'B', NULL, NULL, 0, NULL),
(229, 42, 15, '1273', 'A', NULL, NULL, 1, NULL),
(230, 42, 15, '1370', 'C', NULL, NULL, 0, NULL),
(231, 40, 15, '1101', 'D', NULL, NULL, 1, NULL),
(232, 40, 15, '1216', 'A', NULL, NULL, 1, NULL),
(233, 40, 15, '1221', 'A', NULL, NULL, 1, NULL),
(234, 40, 15, '1355', 'A', NULL, NULL, 1, NULL),
(235, 40, 15, '1165', 'A', NULL, NULL, 1, NULL),
(236, 5, 15, '1216', 'A', NULL, NULL, 1, NULL),
(237, 5, 15, '1370', 'C', NULL, NULL, 0, NULL),
(238, 5, 15, '1363', 'C', NULL, NULL, 0, NULL),
(239, 5, 15, '1322', 'A', NULL, NULL, 1, NULL),
(240, 5, 15, '1182', 'A', NULL, NULL, 1, NULL),
(241, 5, 15, '1353', 'B', NULL, NULL, 0, NULL),
(242, 5, 15, '1137', 'A', NULL, NULL, 1, NULL),
(243, 5, 15, '1314', 'A', NULL, NULL, 1, NULL),
(244, 5, 15, '1161', 'A', NULL, NULL, 1, NULL),
(245, 5, 15, '1356', 'A', NULL, NULL, 1, NULL),
(246, 5, 15, '1130', 'B', NULL, NULL, 0, NULL),
(247, 5, 15, '1211', 'B', NULL, NULL, 0, NULL),
(248, 5, 15, '1209', 'C', NULL, NULL, 0, NULL),
(249, 5, 15, '1266', 'A', NULL, NULL, 1, NULL),
(250, 5, 15, '1227', 'B', NULL, NULL, 1, NULL),
(251, 5, 15, '1167', 'B', NULL, NULL, 0, NULL),
(252, 5, 15, '1288', 'A', NULL, NULL, 1, NULL),
(253, 5, 15, '1095', 'A', NULL, NULL, 1, NULL),
(254, 5, 15, '1198', 'A', NULL, NULL, 1, NULL),
(255, 5, 15, '1267', 'A', NULL, NULL, 1, NULL),
(256, 5, 15, '1188', 'C', NULL, NULL, 0, NULL),
(257, 5, 15, '1316', 'A', NULL, NULL, 1, NULL),
(258, 5, 15, '1096', 'A', NULL, NULL, 1, NULL),
(259, 5, 15, '1330', 'A', NULL, NULL, 1, NULL),
(260, 5, 15, '1162', 'A', NULL, NULL, 1, NULL),
(261, 37, 15, '1332', 'A', NULL, NULL, 1, NULL),
(262, 37, 15, '1352', 'A', NULL, NULL, 1, NULL),
(263, 37, 15, '1262', 'A', NULL, NULL, 1, NULL),
(264, 37, 15, '1172', 'A', NULL, NULL, 1, NULL),
(265, 37, 15, '1250', 'A', NULL, NULL, 1, NULL),
(266, 37, 15, '1102', 'A', NULL, NULL, 1, NULL),
(267, 37, 15, '1303', 'A', NULL, NULL, 1, NULL),
(268, 37, 15, '1368', 'A', NULL, NULL, 1, NULL),
(269, 37, 15, '1365', 'A', NULL, NULL, 1, NULL),
(270, 37, 15, '1370', 'A', NULL, NULL, 1, NULL),
(271, 37, 15, '1314', 'A', NULL, NULL, 1, NULL),
(272, 37, 15, '1191', 'A', NULL, NULL, 1, NULL),
(273, 37, 15, '1175', 'B', NULL, NULL, 0, NULL),
(274, 37, 15, '1180', 'A', NULL, NULL, 1, NULL),
(275, 37, 15, '1209', 'A', NULL, NULL, 1, NULL),
(276, 37, 15, '1267', 'A', NULL, NULL, 1, NULL),
(277, 37, 15, '1203', 'B', NULL, NULL, 0, NULL),
(278, 37, 15, '1348', 'A', NULL, NULL, 1, NULL),
(279, 37, 15, '1107', 'A', NULL, NULL, 1, NULL),
(280, 37, 15, '1212', 'A', NULL, NULL, 1, NULL),
(281, 37, 15, '1377', 'A', NULL, NULL, 1, NULL),
(282, 37, 15, '1167', 'B', NULL, NULL, 0, NULL),
(283, 37, 15, '1130', 'D', NULL, NULL, 1, NULL),
(284, 37, 15, '1217', 'A', NULL, NULL, 1, NULL),
(285, 37, 15, '1147', 'A', NULL, NULL, 1, NULL),
(286, 38, 15, '1369', 'A', NULL, NULL, 1, NULL),
(287, 38, 15, '1301', 'A', NULL, NULL, 1, NULL),
(288, 38, 15, '1377', 'A', NULL, NULL, 1, NULL),
(289, 38, 15, '1215', 'A', NULL, NULL, 1, NULL),
(290, 38, 15, '1157', 'A', NULL, NULL, 1, NULL),
(291, 38, 15, '1237', 'A', NULL, NULL, 1, NULL),
(292, 38, 15, '1290', 'A', NULL, NULL, 1, NULL),
(293, 38, 15, '1278', 'A', NULL, NULL, 1, NULL),
(294, 38, 15, '1159', 'A', NULL, NULL, 1, NULL),
(295, 38, 15, '1114', 'A', NULL, NULL, 1, NULL),
(296, 38, 15, '1112', 'C', NULL, NULL, 0, NULL),
(297, 38, 15, '1106', 'A', NULL, NULL, 1, NULL),
(298, 38, 15, '1151', 'A', NULL, NULL, 1, NULL),
(299, 38, 15, '1341', 'A', NULL, NULL, 1, NULL),
(300, 38, 15, '1393', 'A', NULL, NULL, 1, NULL),
(301, 38, 15, '1320', 'B', NULL, NULL, 0, NULL),
(302, 38, 15, '1226', 'A', NULL, NULL, 1, NULL),
(303, 38, 15, '1339', 'A', NULL, NULL, 1, NULL),
(304, 38, 15, '1257', 'A', NULL, NULL, 1, NULL),
(305, 38, 15, '1165', 'B', NULL, NULL, 0, NULL),
(306, 38, 15, '1262', 'A', NULL, NULL, 1, NULL),
(307, 38, 15, '1360', 'A', NULL, NULL, 1, NULL),
(308, 38, 15, '1261', 'A', NULL, NULL, 1, NULL),
(309, 38, 15, '1141', 'A', NULL, NULL, 1, NULL),
(310, 38, 15, '1153', 'A', NULL, NULL, 1, NULL),
(311, 43, 15, '1107', 'A', NULL, NULL, 1, NULL),
(312, 43, 15, '1194', 'A', NULL, NULL, 1, NULL),
(313, 43, 15, '1270', 'D', NULL, NULL, 0, NULL),
(314, 43, 15, '1370', 'A', NULL, NULL, 1, NULL),
(315, 43, 15, '1169', 'B', NULL, NULL, 1, NULL),
(316, 43, 15, '1374', 'A', NULL, NULL, 1, NULL),
(317, 43, 15, '1219', 'A', NULL, NULL, 0, NULL),
(318, 43, 15, '1188', 'A', NULL, NULL, 1, NULL),
(319, 43, 15, '1167', 'D', NULL, NULL, 0, NULL),
(320, 43, 15, '1293', 'A', NULL, NULL, 1, NULL),
(321, 43, 15, '1375', 'A', NULL, NULL, 1, NULL),
(322, 43, 15, '1212', 'A', NULL, NULL, 1, NULL),
(323, 43, 15, '1120', 'B', NULL, NULL, 1, NULL),
(324, 43, 15, '1254', 'A', NULL, NULL, 1, NULL),
(325, 43, 15, '1324', 'B', NULL, NULL, 0, NULL),
(326, 43, 15, '1202', 'A', NULL, NULL, 1, NULL),
(327, 43, 15, '1222', 'B', NULL, NULL, 1, NULL),
(328, 43, 15, '1260', 'D', NULL, NULL, 0, NULL),
(329, 43, 15, '1100', 'C', NULL, NULL, 1, NULL),
(330, 43, 15, '1263', 'A', NULL, NULL, 1, NULL),
(331, 43, 15, '1237', 'A', NULL, NULL, 1, NULL),
(332, 43, 15, '1245', 'A', NULL, NULL, 0, NULL),
(333, 43, 15, '1180', 'A', NULL, NULL, 1, NULL),
(334, 43, 15, '1312', 'A', NULL, NULL, 1, NULL),
(335, 43, 15, '1386', 'A', NULL, NULL, 1, NULL),
(336, 8, 15, '1147', 'B', NULL, NULL, 0, NULL),
(337, 8, 15, '1136', 'A', NULL, NULL, 1, NULL),
(338, 8, 15, '1312', 'A', NULL, NULL, 1, NULL),
(339, 8, 15, '1107', 'A', NULL, NULL, 1, NULL),
(340, 8, 15, '1134', 'B', NULL, NULL, 1, NULL),
(341, 8, 15, '1259', 'A', NULL, NULL, 1, NULL),
(342, 8, 15, '1288', 'B', NULL, NULL, 0, NULL),
(343, 8, 15, '1184', 'A', NULL, NULL, 1, NULL),
(344, 8, 15, '1359', 'C', NULL, NULL, 0, NULL),
(345, 8, 15, '1106', 'A', NULL, NULL, 1, NULL),
(346, 8, 15, '1279', 'C', NULL, NULL, 0, NULL),
(347, 8, 15, '1243', 'B', NULL, NULL, 1, NULL),
(348, 8, 15, '1198', 'A', NULL, NULL, 1, NULL),
(349, 8, 15, '1167', 'C', NULL, NULL, 0, NULL),
(350, 8, 15, '1282', 'B', NULL, NULL, 0, NULL),
(351, 8, 15, '1302', 'A', NULL, NULL, 1, NULL),
(352, 8, 15, '1383', 'A', NULL, NULL, 1, NULL),
(353, 8, 15, '1262', 'A', NULL, NULL, 1, NULL),
(354, 8, 15, '1096', 'A', NULL, NULL, 1, NULL),
(355, 8, 15, '1272', 'A', NULL, NULL, 1, NULL),
(356, 8, 15, '1218', 'B', NULL, NULL, 1, NULL),
(357, 8, 15, '1300', 'A', NULL, NULL, 1, NULL),
(358, 8, 15, '1207', 'D', NULL, NULL, 0, NULL),
(359, 8, 15, '1219', 'C', NULL, NULL, 1, NULL),
(360, 8, 15, '1230', 'B', NULL, NULL, 1, NULL),
(361, 4, 15, '1098', 'A', NULL, NULL, 1, NULL),
(362, 4, 15, '1195', 'B', NULL, NULL, 0, NULL),
(363, 4, 15, '1147', 'B', NULL, NULL, 0, NULL),
(364, 4, 15, '1335', 'A', NULL, NULL, 1, NULL),
(365, 4, 15, '1275', 'A', NULL, NULL, 1, NULL),
(366, 4, 15, '1278', 'A', NULL, NULL, 1, NULL),
(367, 4, 15, '1369', 'A', NULL, NULL, 1, NULL),
(368, 4, 15, '1287', 'A', NULL, NULL, 1, NULL),
(369, 4, 15, '1295', 'A', NULL, NULL, 1, NULL),
(370, 4, 15, '1258', 'B', NULL, NULL, 0, NULL),
(371, 4, 15, '1341', 'A', NULL, NULL, 1, NULL),
(372, 4, 15, '1372', 'A', NULL, NULL, 1, NULL),
(373, 4, 15, '1271', 'A', NULL, NULL, 1, NULL),
(374, 4, 15, '1274', 'B', NULL, NULL, 0, NULL),
(375, 4, 15, '1249', 'D', NULL, NULL, 1, NULL),
(376, 4, 15, '1141', 'A', NULL, NULL, 1, NULL),
(377, 4, 15, '1264', 'A', NULL, NULL, 1, NULL),
(378, 4, 15, '1389', 'A', NULL, NULL, 1, NULL),
(379, 4, 15, '1378', 'A', NULL, NULL, 1, NULL),
(380, 4, 15, '1205', 'A', NULL, NULL, 1, NULL),
(381, 4, 15, '1353', 'D', NULL, NULL, 0, NULL),
(382, 4, 15, '1273', 'A', NULL, NULL, 1, NULL),
(383, 4, 15, '1319', 'A', NULL, NULL, 1, NULL),
(384, 4, 15, '1129', 'B', NULL, NULL, 0, NULL),
(385, 4, 15, '1192', 'D', NULL, NULL, 0, NULL),
(386, 77, 15, '1312', 'A', NULL, NULL, 1, NULL),
(387, 77, 15, '1314', 'A', NULL, NULL, 1, NULL),
(388, 77, 15, '1310', 'A', NULL, NULL, 1, NULL),
(389, 77, 15, '1238', 'A', NULL, NULL, 1, NULL),
(390, 77, 15, '1183', 'A', NULL, NULL, 1, NULL),
(391, 77, 15, '1220', 'D', NULL, NULL, 1, NULL),
(392, 77, 15, '1386', 'A', NULL, NULL, 1, NULL),
(393, 77, 15, '1261', 'A', NULL, NULL, 1, NULL),
(394, 77, 15, '1216', 'C', NULL, NULL, 0, NULL),
(395, 77, 15, '1186', 'A', NULL, NULL, 1, NULL),
(396, 77, 15, '1316', 'A', NULL, NULL, 1, NULL),
(397, 77, 15, '1276', 'C', NULL, NULL, 0, NULL),
(398, 77, 15, '1269', 'A', NULL, NULL, 1, NULL),
(399, 77, 15, '1156', 'A', NULL, NULL, 1, NULL),
(400, 77, 15, '1122', 'D', NULL, NULL, 1, NULL),
(401, 77, 15, '1125', 'A', NULL, NULL, 1, NULL),
(402, 77, 15, '1354', 'A', NULL, NULL, 1, NULL),
(403, 77, 15, '1163', 'A', NULL, NULL, 1, NULL),
(404, 77, 15, '1327', 'A', NULL, NULL, 1, NULL),
(405, 77, 15, '1298', 'A', NULL, NULL, 1, NULL),
(406, 77, 15, '1392', 'A', NULL, NULL, 1, NULL),
(407, 77, 15, '1380', 'A', NULL, NULL, 1, NULL),
(408, 77, 15, '1359', 'A', NULL, NULL, 1, NULL),
(409, 77, 15, '1252', 'D', NULL, NULL, 1, NULL),
(410, 77, 15, '1196', 'A', NULL, NULL, 1, NULL),
(411, 1, 15, '1095', 'B', NULL, NULL, 0, NULL),
(412, 1, 15, '1282', 'B', NULL, NULL, 0, NULL),
(413, 1, 15, '1361', 'D', NULL, NULL, 0, NULL),
(414, 1, 15, '1336', 'C', NULL, NULL, 0, NULL),
(415, 1, 15, '1158', 'C', NULL, NULL, 0, NULL),
(416, 1, 15, '1222', 'D', NULL, NULL, 0, NULL),
(417, 1, 15, '1119', 'C', NULL, NULL, 0, NULL),
(418, 1, 15, '1305', 'A', NULL, NULL, 1, NULL),
(419, 1, 15, '1391', 'D', NULL, NULL, 0, NULL),
(420, 1, 15, '1381', 'A', NULL, NULL, 1, NULL),
(446, 1, 1, '18', 'A', NULL, NULL, 0, NULL),
(447, 1, 1, '27', 'B', NULL, NULL, 1, NULL),
(448, 1, 1, '36', 'D', NULL, NULL, 0, NULL),
(449, 1, 1, '49', 'A', NULL, NULL, 1, NULL),
(450, 1, 1, '64', 'D', NULL, NULL, 0, NULL),
(451, 1, 1, '171', '12', NULL, NULL, 0, NULL),
(452, 1, 1, '24', 'D', NULL, NULL, 0, NULL),
(453, 1, 1, '43', 'B', NULL, NULL, 1, NULL),
(454, 1, 1, '45', 'B', NULL, NULL, 1, NULL),
(455, 1, 1, '40', 'A', NULL, NULL, 0, NULL),
(456, 1, 1, '14', 'B', NULL, NULL, 0, NULL),
(457, 1, 1, '75', 'D', NULL, NULL, 1, NULL),
(458, 1, 1, '10', 'A', NULL, NULL, 1, NULL),
(459, 1, 1, '70', 'B', NULL, NULL, 0, NULL),
(460, 1, 1, '6', 'C', NULL, NULL, 1, NULL),
(461, 1, 1, '3', 'B', NULL, NULL, 1, NULL),
(462, 1, 1, '11', 'A', NULL, NULL, 1, NULL),
(463, 1, 1, '60', 'B', NULL, NULL, 1, NULL),
(464, 1, 1, '8', 'B', NULL, NULL, 1, NULL),
(465, 1, 1, '54', 'B', NULL, NULL, 0, NULL),
(466, 1, 1, '71', 'A', NULL, NULL, 0, NULL),
(467, 1, 1, '44', 'B', NULL, NULL, 1, NULL),
(468, 1, 1, '61', 'A', NULL, NULL, 1, NULL),
(469, 1, 1, '5', 'B', NULL, NULL, 1, NULL),
(470, 1, 1, '28', 'B', NULL, NULL, 1, NULL),
(471, 2, 15, '1272', 'A', NULL, NULL, 1, NULL),
(472, 2, 15, '1173', 'B', NULL, NULL, 1, NULL),
(473, 2, 15, '1138', 'B', NULL, NULL, 0, NULL),
(474, 2, 15, '1235', 'A', NULL, NULL, 1, NULL),
(475, 2, 15, '1384', 'A', NULL, NULL, 1, NULL),
(476, 2, 15, '1280', 'A', NULL, NULL, 1, NULL),
(477, 2, 15, '1151', 'A', NULL, NULL, 1, NULL),
(478, 2, 15, '1126', 'D', NULL, NULL, 1, NULL),
(479, 2, 15, '1335', 'A', NULL, NULL, 1, NULL),
(480, 2, 15, '1098', 'A', NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_notes`
--

CREATE TABLE `student_notes` (
  `id` int NOT NULL,
  `note_date` date NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `pdf_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_notes`
--

INSERT INTO `student_notes` (`id`, `note_date`, `title`, `content`, `pdf_file`, `created_at`) VALUES
(4, '2025-10-11', 'Brief History of PHP and Programming Language', 'PHP, originally an acronym for \"Personal Home Page,\" later recursively defined as \"PHP: Hypertext Preprocessor,\" has a history rooted in personal web development tools.\n\n1994:  Rasmus Lerdorf, a Danish-Canadian programmer, created a set of Common Gateway Interface (CGI) binaries in C to manage his personal website, including tracking visitors to his online resume. These were the first iteration of what would become PHP.\n\n1995: Lerdorf publicly released the source code for his \"Personal Home Page Tools.\" He later rewrote the parser and added more features, including database interaction, releasing it as PHP/FI (Personal Home Page/Forms Interpreter). This version gained significant traction and  being used on thousands of websites by 1996.\n\n1998: Two Israeli developers, Zeev Suraski and Andi Gutmans, rewrote the parser, leading to PHP 3.0. At this point, PHP officially became known as â€œPHP: Hypertext Preprocessor.  This version introduced a more powerful and extensible architecture, and the name was formally changed to \"PHP: Hypertext Preprocessor.\" \n\n2000 â€“ Suraski and Gutmans developed the Zend Engine, the core scripting engine for PHP, and released PHP 4.0, which brought better performance and more features for complex applications.\n\n2004 â€“ PHP 5.0 was released, introducing the Zend Engine II, full support for object-oriented programming (OOP), and integration with XML and MySQL.\n\n2015: PHP 7.0 was release (PHP 6 was abandoned due to issues with Unicode support), introducing the Zend Engine 3.0 (interprets, compiles, and executes PHP code.) and often twice as fast as PHP 5, which delivered significant performance improvements and reduced memory usage. It also added new language features like return type declarations and the null  operator. \n\n2020 â€“ PHP 8.0 was released, introducing the Just-In-Time (JIT) compiler, union types, attributes, and other modern features, making PHP much faster and more robust . Robust means : strong, reliable, and able to handle different conditions without failing.\n\nToday â€“ PHP powers over 75% of websites with a known server-side language, including platforms like WordPress, Drupal, Joomla, and Magento. It remains one of the most widely used languages for web development.\nExample of Programming Language : \n\n1. Web Development\n\nPHP â€“ Used for server-side web development (e.g., WordPress, Facebookâ€™s early versions).\nJavaScript â€“ Runs in browsers to make web pages interactive (e.g., menus, animations, web apps).\nHTML & CSS (not programming, but markup & styling languages, often used with programming).\n\n2. General Purpose / Application Development\n\nPython â€“ Used for web apps, data science, AI, automation (e.g., Instagram, YouTube backend).\nJava â€“ Used in enterprise applications, Android apps, banking systems.\nC# â€“ Used with .NET for Windows apps, web apps, and games.\n\n3. System Programming\n\nC â€“ Used for operating systems, embedded systems (e.g., Linux kernel).\nC++ â€“ Used for games, performance-heavy applications, browsers.\nRust â€“ Modern language for system-level programming with safety and speed.\n\n4. Mobile Development\n\nSwift â€“ For iOS apps (iPhone, iPad).\nKotlin â€“ For Android apps.\n\nIn short : \n1.PHP is a programming language for making websites.\n2.Python is a programming language for AI, automation, and web apps.\n3.C is a programming language for building operating systems.\n', '1760164305_Brief History of PHP and Programming Language.pdf', '2025-10-13 06:02:37'),
(7, '2025-10-13', '1.	Introduction to PHP', 'Definition: PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages. PHP is a widely-used, free, and efficient alternative to competitors such as Microsoft\'s ASP.\nExample\n<html>\n<body>\n\n<? php\necho \"My first PHP script!\"; ?>\n</body>\n</html> \n\nRemember You should have a basic understanding of the following:\n\nâ€¢	HTML\nâ€¢	CSS\nâ€¢	JavaScript\nâ€¢	\nWhat is PHP?\nâ€¢	PHP is an acronym for \"PHP: Hypertext Preprocessor\"\nâ€¢	PHP is a widely-used, open source scripting language\nâ€¢	PHP scripts are executed on the server\nWhat is a PHP File?\nâ€¢	PHP files can contain text, HTML, CSS, JavaScript, and PHP code\nâ€¢	PHP code are executed on the server, and the result is returned to the browser as plain HTML\nâ€¢	PHP files have extension \".php\"\n\nWhat Can PHP Do?\nâ€¢	PHP can generate dynamic page content\nâ€¢	PHP can create, open, read, write, delete, and close files on the server\nâ€¢	PHP can collect form data\nâ€¢	PHP can send and receive cookies\nâ€¢	PHP can add, delete, modify data in your database\nâ€¢	PHP can be used to control user-access\nâ€¢	PHP can encrypt data\nâ€¢	\nWith PHP you are not limited to output HTML. You can output images, PDF files.\n\nWhy PHP?\n\nâ€¢	PHP runs on various platforms (Windows, Linux, Unix, Mac OS, etc.)\nâ€¢	PHP is compatible with almost all servers used today (Apache, IIS, etc.)\nâ€¢	PHP supports a wide range of databases\nâ€¢	PHP is easy to learn and runs efficiently on the server side\nTo start using PHP, you can:\n\nâ€¢	Find a web host with PHP and MySQL support\nâ€¢	Install a web server on your own PC, and then install PHP and MySQL\n\nUse a Web Host with PHP Support\nâ€¢	If your server has activated support for PHP you do not need to do anything.\nâ€¢	Just create some .php files, place them in your web directory, and the server will automatically parse them for you.\nâ€¢	You do not need to compile anything or install any extra tools.\n\n2.	PHP Scripts Basic PHP Syntax\n\ni.	A PHP script can be placed anywhere in the document.\nii.	A PHP script starts with <?php and ends with ?>:\n\nExample\n<html>\n<body>\n\n<h1>My first PHP page</h1>\n\n<?php\necho \"Hello World!\";\n?>\n\n</body>\n</html>\nNB: PHP statements end with a semicolon (;)\na.	Comments in PHP\n\nA comment in PHP code is a line that is not read/executed as part of the program. Its only purpose is to be read by someone who is looking at the code.\nComments can be used to:\ni.	Let others understand what you are doing\nii.	Remind yourself of what you did - Most programmers have experienced coming back to their own work a year or two later and having to re-figure out what they did. Comments can remind you of what you were thinking when you wrote the code\nExample 1.\n<html>\n<body>\n<?php\n// This is a single-line comment\n# This is also a single-line comment /*\nThis is a multiple-lines comment block that spans over multiple lines\n*/\n// You can also use comments to leave out parts of a code line\n$x = 5 /* + 15 */ + 5; echo  $x; \n?>\n</body>\n</html>\nIn the example below, only the first statement will display the value of the $color variable (this is because $color, $COLOR, and $coLOR are treated as three different variables):\nExample\n<html>\n<body>\n<?php\n$color = \"red\";\necho \"My car is \" . $color . \"<br>\";\necho \"My house is \" . $COLOR . \"<br>\"; echo \"My boat is \" . $coLOR . \"<br>\"; ?>\n</body>\n</html>\n\nb.	Data Types\n\ni.	Variables can store data of different types, and different data types can do different things.\n\nPHP supports the following data types:\nii.	String\niii.	Integer\niv.	Float (floating point numbers - also called double)\nv.	Boolean\nvi.	Array\nvii.	Object\nviii.	NULL\n\n3.	PHP String\n\ni.	A string is a sequence of characters, like \"Hello world!\".\nii.	A string can be any text inside quotes. You can use single or double quotes:\n\nExample\n<html>\n<body>\n<?php\n$x = \"Hello world!\";\n$y = \'Hello world!\'; echo $x;\necho \"<br>\"; echo $y;\n?>\n</body>\n</html>\nOUTPUT:\nHello world! Hello world!\n \n3.1  String Functions\niii.	Get The Length of a String\niv.	The PHP strlen() function returns the length of a string.\nv.	The example below returns the length of the string \"Hello world!\":\nExample\n<html>\n<body>\n<?php\necho strlen(\"Hello world!\"); ?>\n</body>\n</html>\nOUPUT:\n12\n3.2 Count The Number of Words in a String\n\nThe PHP str_word_count() function counts the number of words in a string:\n\nExample\n<html>\n<body>\n<?php\necho str_word_count(\"Hello world!\");\n?>\n</body>\n</html>\nOUPUT:\n2\n\n3.3 Reverse a String\nvi.	The PHP strrev() function reverses a string:\nExample\n<html>\n<body>\n<?php\necho strrev(\"Hello world!\");\n?>\n</body>\n</html>\nOUTPUT:\n!dlrow olleH\n3.4 Search For a Specific Text Within a String\n\nvii.	The PHP strpos() function searches for a specific text within a string.\nviii.	If a match is found, the function returns the character position of the first match. If no match is found, it will return FALSE.\nix.	The example below searches for the text \"world\" in the string \"Hello world!\":\n\nExample\n<html>\n<body>\n<?php\necho strpos(\"Hello world!\", \"world\");\n?>\n</body>\n</html>\nOUPUT:\n6\n\n3.5  Replace Text Within a String\n\nx.	The PHP str_replace() function replaces some characters with some other characters in a string.\nxi.	The example below replaces the text \"world\" with \"Dolly\":\n\nExample\n<html>\n<body>\n<?php\necho str_replace(\"world\", \"Dolly\", \"Hello world!\");\n?>\n</body>\n</html>\nOUPUT:\nHello Dolly!\n\n', '1760333682_Introduction to PHP Notes.pdf', '2025-10-13 06:02:50'),
(9, '2025-10-16', 'Apply Basic Database development', 'Intoduction \r\nThis module covers the skills, knowledge and attitude to maintain a website which facilitates the requirement as a front-end website developer. The module will allow the learner to resolve website issues, to respond to the customer requests, to add new features and to execute customer service support.\r\nDatabase development is a crucial aspect of modern software engineering and data-driven decision-making. It involves designing, implementing, and maintaining databases that store, organize, and retrieve large volumes of structured and unstructured data. Databases are at the heart of many business applications, e-commerce websites, social media platforms, and scientific research projects, among others. They enable developers to store and manage data efficiently, secure it from unauthorized access, and retrieve it quickly and accurately.\r\n\r\n\r\nTo develop a database, developers need to follow a systematic approach that involves several stages, such as requirement analysis, conceptual modelling, logical and physical design, implementation, testing, and maintenance. They need to select an appropriate database management system (DBMS) that matches the requirements and constraints of the project, such as scalability, performance, security, and compatibility. Moreover, they need to use standard query languages, such as SQL (Structured Query Language), to interact with the database and manipulate data. Overall, database development requires a blend of technical skills, analytical thinking, and creativity to design and implement effective data management solutions that meet the needs of various stakeholders.\r\n', '1760621629_DATABASE () COURSES NGA.pdf', '2025-10-16 13:33:49'),
(10, '2025-10-21', 'Intoduction to PHP Con\'t', 'On 21 Oct 2025: \r\nPhp  Functions', '1761045417_21 Oct 2025  Breif History and Intro to php.pdf', '2025-10-21 12:34:46'),
(11, '2025-10-22', 'Dtababase Management System', 'History of DBMS\r\nThe first database management systems (DBMS) were created to handle complex data for businesses in the 1960s. These systems includedÂ Charles Bachman\'s Integrated Data Store (IDS)Â and IBM\'s Information Management System (IMS). Databases were first organized into tree-like structures using hierarchical and network models.\r\nEdgar F. CoddÂ popularized the relational model in the 1970s, transforming database management systems (DBMS) with the concept of arranging data in tables, or relations and utilizing SQL for queries. As a result, contemporary DBMS systems like Oracle and MySQL were established. These systems are still developing today, incorporating newer technologies like NoSQL databases to handle unstructured data.\r\n\r\nWhat is DBMS?\r\n\r\nA Database Management System (DBMS) is a Software system designed to handle, store, retrieve, and work with data in databases. It ensures effective data management by serving as an interface between databases and end users. A DBMS gives users/developers the ability to create, edit, and remove databases as well as organize the environment in which data is kept in tables, records, and fields.\r\n.........................', '1761121225_22 Oct 2025 DATABASE COURSES NGA.pdf', '2025-10-22 08:20:25'),
(12, '2025-10-29', 'Database On  29 Oct 2025', 'Cont\'s', '1761729418_DATABASE COURSES NGA.pdf', '2025-10-29 09:17:17'),
(13, '2025-11-04', 'PHP fundamentals & Implement PHP Logic', 'Operators are used to perform operations on variables and values and  divides in the following groups:\r\nâ€¢	Arithmetic operators\r\nâ€¢	Assignment operators\r\nâ€¢	Comparison operators\r\nâ€¢	Increment/Decrement operators\r\nâ€¢	Logical operators\r\nâ€¢	String operators\r\nPHP Functions and  Application of conditionals and branching controls \r\nâ€¢	if statement - executes some code if one condition is true\r\nâ€¢	if...else statement - executes some code if a condition is true and another code if that condition is false\r\nâ€¢	if...elseif	else statement - executes different codes for more than two conditions\r\n. Nest If .... and \r\nâ€¢	switch statement - selects one of many blocks of code to be executed\r\n', '1762237612_04 Nov 2025 PHP Functions and Implematation of php Logic.pdf', '2025-11-04 06:26:52'),
(14, '2025-11-05', 'Practice', 'Database Practice from Assignment 2', '1762334351_Assgnment 2.pdf', '2025-11-05 09:19:11'),
(15, '2025-11-05', 'View User', 'OK', '1762337499_View usaer.pdf', '2025-11-05 10:11:39'),
(17, '2025-11-18', 'Mid Term Test Questions and Answer', 'Please find the Midterm Test and suggested answers. However, your answers are very important and will be the ones considered according to the notes', '1763452993_Mid term test Answers of web development using php.pdf', '2025-11-18 08:03:13'),
(18, '2025-11-19', 'MidTerm Test of Database', 'Please find the attachment containing the answers for the Midterm Test held on 19 Nov 2025.', '1763546288_Mid term test ANSWERS of  Database.pdf', '2025-11-19 09:58:08'),
(20, '2025-11-25', '25 Nov 2025 (Application of Iterative  Control Statements (Loops in php))', 'When we write programs, we often need to repeat certain actions. Instead of writing the same statement many times, we use iterative control structures (loops). Loops repeat a block of code as long as a given condition is true. It makes a program: Shorter, More efficient, Easier to maintain, Dynamic instead of repetitive\r\n\r\nPlease Click view to downlaod full Noe=tes\r\n', '1764050590_Continuing the PHP notes (November 25, 2025)..pdf', '2025-11-25 06:03:10'),
(21, '2025-12-02', 'Notes on 1 DEC 2025 on Describe PHP fundamentals', 'Application of Iterative  Control Statements, example of Loops , scenario and escercices \r\n', '1764656832_NOTES ON 1 DEC 2025 .pdf', '2025-12-02 06:27:12'),
(22, '2025-12-03', 'Define database objects', 'ïƒ¼	Database objects concepts\r\nïƒ¼	Create database syntax \r\nïƒ¼	Drop database Statement\r\nïƒ¼	Rename database\r\nïƒ¼	Import Database\r\nïƒ¼	Import concepts and formats\r\nïƒ¼	Using command line\r\nïƒ¼	Using import wizard\r\nïƒ¼	Export Database\r\nïƒ¼	Export formats\r\nïƒ¼	Using command line\r\nïƒ¼	Using import wizard\r\n', '1764763425_DATABASE COURSES NGA.pdf', '2025-12-03 12:03:45');

-- --------------------------------------------------------

--
-- Table structure for table `student_questions`
--

CREATE TABLE `student_questions` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `quiz_id` int NOT NULL,
  `question_id` int NOT NULL,
  `assigned_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_questions`
--

INSERT INTO `student_questions` (`id`, `student_id`, `quiz_id`, `question_id`, `assigned_at`) VALUES
(1, 3, 1, 40, '2025-10-21 07:47:33'),
(2, 3, 1, 69, '2025-10-21 07:47:33'),
(3, 3, 1, 70, '2025-10-21 07:47:33'),
(4, 3, 1, 68, '2025-10-21 07:47:33'),
(5, 4, 1, 44, '2025-10-21 07:52:13'),
(6, 4, 1, 34, '2025-10-21 07:52:13'),
(7, 4, 1, 24, '2025-10-21 07:52:13'),
(8, 4, 1, 53, '2025-10-21 07:52:13'),
(9, 8, 1, 46, '2025-10-21 07:54:06'),
(10, 8, 1, 71, '2025-10-21 07:54:06'),
(11, 8, 1, 54, '2025-10-21 07:54:06'),
(12, 8, 1, 12, '2025-10-21 07:54:06'),
(13, 7, 1, 47, '2025-10-21 07:54:11'),
(14, 7, 1, 76, '2025-10-21 07:54:11'),
(15, 7, 1, 30, '2025-10-21 07:54:11'),
(16, 7, 1, 58, '2025-10-21 07:54:11'),
(17, 2, 1, 26, '2025-10-22 13:02:31'),
(18, 2, 1, 1, '2025-10-22 13:02:31'),
(19, 2, 1, 75, '2025-10-22 13:02:31'),
(20, 2, 1, 14, '2025-10-22 13:02:31'),
(21, 2, 8, 144, '2025-10-22 21:47:36'),
(22, 2, 8, 140, '2025-10-22 21:47:36'),
(23, 2, 8, 146, '2025-10-22 21:47:36'),
(24, 2, 8, 141, '2025-10-22 21:47:36'),
(25, 36, 1, 21, '2025-10-26 15:36:55'),
(26, 36, 1, 55, '2025-10-26 15:36:55'),
(27, 36, 1, 53, '2025-10-26 15:36:55'),
(28, 36, 1, 64, '2025-10-26 15:36:55'),
(29, 5, 1, 4, '2025-10-26 15:56:48'),
(30, 5, 1, 52, '2025-10-26 15:56:48'),
(31, 5, 1, 22, '2025-10-26 15:56:48'),
(32, 5, 1, 40, '2025-10-26 15:56:48'),
(33, 38, 1, 41, '2025-10-26 20:37:23'),
(34, 38, 1, 7, '2025-10-26 20:37:23'),
(35, 38, 1, 80, '2025-10-26 20:37:23'),
(36, 38, 1, 16, '2025-10-26 20:37:24'),
(37, 4, 6, 86, '2025-10-27 09:01:10'),
(38, 4, 6, 103, '2025-10-27 09:01:10'),
(39, 4, 6, 116, '2025-10-27 09:01:10'),
(40, 4, 6, 151, '2025-10-27 09:01:10'),
(41, 4, 6, 166, '2025-10-27 09:01:10'),
(42, 4, 6, 124, '2025-10-27 09:01:10'),
(43, 4, 6, 82, '2025-10-27 09:01:10'),
(44, 4, 6, 131, '2025-10-27 09:01:10'),
(45, 4, 6, 91, '2025-10-27 09:01:10'),
(46, 4, 6, 162, '2025-10-27 09:01:10'),
(47, 4, 6, 112, '2025-10-27 09:01:10'),
(48, 4, 6, 133, '2025-10-27 09:01:10'),
(49, 4, 6, 105, '2025-10-27 09:01:10'),
(50, 4, 6, 107, '2025-10-27 09:01:10'),
(51, 4, 6, 122, '2025-10-27 09:01:10'),
(52, 8, 6, 104, '2025-10-27 09:01:14'),
(53, 8, 6, 87, '2025-10-27 09:01:14'),
(54, 8, 6, 168, '2025-10-27 09:01:14'),
(55, 8, 6, 99, '2025-10-27 09:01:14'),
(56, 8, 6, 155, '2025-10-27 09:01:14'),
(57, 8, 6, 152, '2025-10-27 09:01:14'),
(58, 8, 6, 94, '2025-10-27 09:01:14'),
(59, 8, 6, 118, '2025-10-27 09:01:14'),
(60, 8, 6, 93, '2025-10-27 09:01:14'),
(61, 8, 6, 95, '2025-10-27 09:01:14'),
(62, 8, 6, 97, '2025-10-27 09:01:14'),
(63, 8, 6, 132, '2025-10-27 09:01:14'),
(64, 8, 6, 135, '2025-10-27 09:01:14'),
(65, 8, 6, 110, '2025-10-27 09:01:14'),
(66, 8, 6, 96, '2025-10-27 09:01:14'),
(67, 5, 6, 154, '2025-10-27 09:02:17'),
(68, 5, 6, 148, '2025-10-27 09:02:17'),
(69, 5, 6, 119, '2025-10-27 09:02:17'),
(70, 5, 6, 130, '2025-10-27 09:02:17'),
(71, 5, 6, 108, '2025-10-27 09:02:17'),
(72, 5, 6, 81, '2025-10-27 09:02:17'),
(73, 5, 6, 159, '2025-10-27 09:02:17'),
(74, 5, 6, 125, '2025-10-27 09:02:17'),
(75, 5, 6, 126, '2025-10-27 09:02:17'),
(76, 5, 6, 156, '2025-10-27 09:02:17'),
(77, 5, 6, 101, '2025-10-27 09:02:17'),
(78, 5, 6, 89, '2025-10-27 09:02:17'),
(79, 5, 6, 170, '2025-10-27 09:02:17'),
(80, 5, 6, 120, '2025-10-27 09:02:17'),
(81, 5, 6, 92, '2025-10-27 09:02:17'),
(82, 3, 6, 113, '2025-10-27 09:02:21'),
(83, 3, 6, 115, '2025-10-27 09:02:21'),
(84, 3, 6, 153, '2025-10-27 09:02:21'),
(85, 3, 6, 164, '2025-10-27 09:02:21'),
(86, 3, 6, 169, '2025-10-27 09:02:21'),
(87, 3, 6, 161, '2025-10-27 09:02:21'),
(88, 3, 6, 127, '2025-10-27 09:02:21'),
(89, 3, 6, 84, '2025-10-27 09:02:21'),
(90, 3, 6, 98, '2025-10-27 09:02:21'),
(91, 3, 6, 147, '2025-10-27 09:02:21'),
(92, 3, 6, 114, '2025-10-27 09:02:21'),
(93, 3, 6, 134, '2025-10-27 09:02:21'),
(94, 3, 6, 150, '2025-10-27 09:02:21'),
(95, 3, 6, 167, '2025-10-27 09:02:21'),
(96, 3, 6, 106, '2025-10-27 09:02:21'),
(97, 37, 6, 123, '2025-10-27 09:02:30'),
(98, 37, 6, 165, '2025-10-27 09:02:30'),
(99, 37, 6, 149, '2025-10-27 09:02:30'),
(100, 37, 6, 100, '2025-10-27 09:02:30'),
(101, 37, 6, 90, '2025-10-27 09:02:30'),
(102, 37, 6, 88, '2025-10-27 09:02:30'),
(103, 37, 6, 157, '2025-10-27 09:02:30'),
(104, 37, 6, 102, '2025-10-27 09:02:30'),
(105, 37, 6, 117, '2025-10-27 09:02:30'),
(106, 37, 6, 163, '2025-10-27 09:02:30'),
(107, 37, 6, 158, '2025-10-27 09:02:30'),
(108, 37, 6, 109, '2025-10-27 09:02:30'),
(109, 37, 6, 111, '2025-10-27 09:02:30'),
(110, 37, 6, 160, '2025-10-27 09:02:30'),
(111, 37, 6, 121, '2025-10-27 09:02:30'),
(112, 38, 6, 129, '2025-10-27 09:02:33'),
(113, 38, 6, 128, '2025-10-27 09:02:33'),
(114, 38, 6, 83, '2025-10-27 09:02:33'),
(115, 38, 6, 85, '2025-10-27 09:02:33'),
(116, 37, 1, 171, '2025-10-28 08:32:25'),
(117, 37, 1, 15, '2025-10-28 08:32:25'),
(118, 37, 1, 24, '2025-10-28 08:32:25'),
(119, 37, 1, 68, '2025-10-28 08:32:25'),
(120, 37, 1, 75, '2025-10-28 08:32:25'),
(121, 9, 1, 71, '2025-10-28 08:37:00'),
(122, 9, 1, 43, '2025-10-28 08:37:00'),
(123, 9, 1, 24, '2025-10-28 08:37:00'),
(124, 9, 1, 49, '2025-10-28 08:37:00'),
(125, 9, 1, 10, '2025-10-28 08:37:00'),
(126, 40, 1, 56, '2025-10-28 08:38:23'),
(127, 40, 1, 19, '2025-10-28 08:38:23'),
(128, 40, 1, 80, '2025-10-28 08:38:23'),
(129, 40, 1, 13, '2025-10-28 08:38:23'),
(130, 40, 1, 10, '2025-10-28 08:38:23'),
(131, 41, 1, 30, '2025-10-28 08:40:23'),
(132, 41, 1, 11, '2025-10-28 08:40:23'),
(133, 41, 1, 67, '2025-10-28 08:40:23'),
(134, 41, 1, 8, '2025-10-28 08:40:23'),
(135, 41, 1, 13, '2025-10-28 08:40:23'),
(136, 99, 1, 54, '2025-10-28 08:49:28'),
(137, 99, 1, 36, '2025-10-28 08:49:28'),
(138, 99, 1, 66, '2025-10-28 08:49:28'),
(139, 99, 1, 58, '2025-10-28 08:49:28'),
(140, 99, 1, 19, '2025-10-28 08:49:28'),
(141, 77, 1, 51, '2025-10-28 08:49:41'),
(142, 77, 1, 56, '2025-10-28 08:49:41'),
(143, 77, 1, 13, '2025-10-28 08:49:41'),
(144, 77, 1, 52, '2025-10-28 08:49:41'),
(145, 77, 1, 73, '2025-10-28 08:49:41'),
(146, 43, 1, 78, '2025-10-28 09:01:35'),
(147, 43, 1, 50, '2025-10-28 09:01:35'),
(148, 43, 1, 62, '2025-10-28 09:01:35'),
(149, 43, 1, 55, '2025-10-28 09:01:35'),
(150, 43, 1, 24, '2025-10-28 09:01:35'),
(151, 42, 1, 66, '2025-10-28 09:01:49'),
(152, 42, 1, 14, '2025-10-28 09:01:49'),
(153, 42, 1, 10, '2025-10-28 09:01:49'),
(154, 42, 1, 75, '2025-10-28 09:01:49'),
(155, 42, 1, 26, '2025-10-28 09:01:49'),
(156, 4, 13, 773, '2025-11-19 20:07:16'),
(157, 4, 13, 260, '2025-11-19 20:07:16'),
(158, 4, 13, 223, '2025-11-19 20:07:16'),
(159, 4, 13, 767, '2025-11-19 20:07:16'),
(160, 4, 13, 608, '2025-11-19 20:07:16'),
(161, 4, 13, 207, '2025-11-19 20:07:16'),
(162, 4, 13, 330, '2025-11-19 20:07:16'),
(163, 4, 13, 382, '2025-11-19 20:07:16'),
(164, 4, 13, 602, '2025-11-19 20:07:16'),
(165, 4, 13, 571, '2025-11-19 20:07:16'),
(166, 4, 13, 356, '2025-11-19 20:07:16'),
(167, 4, 13, 553, '2025-11-19 20:07:16'),
(168, 4, 13, 606, '2025-11-19 20:07:16'),
(169, 4, 13, 639, '2025-11-19 20:07:16'),
(170, 4, 13, 339, '2025-11-19 20:07:16'),
(171, 4, 13, 203, '2025-11-19 20:07:16'),
(172, 4, 13, 270, '2025-11-19 20:07:16'),
(173, 4, 13, 268, '2025-11-19 20:07:16'),
(174, 4, 13, 406, '2025-11-19 20:07:16'),
(175, 4, 13, 369, '2025-11-19 20:07:16'),
(176, 4, 13, 274, '2025-11-19 20:07:16'),
(177, 4, 13, 455, '2025-11-19 20:07:16'),
(178, 4, 13, 423, '2025-11-19 20:07:16'),
(179, 4, 13, 616, '2025-11-19 20:07:16'),
(180, 4, 13, 789, '2025-11-19 20:07:16'),
(181, 42, 13, 565, '2025-11-20 09:13:04'),
(182, 42, 13, 204, '2025-11-20 09:13:04'),
(183, 42, 13, 338, '2025-11-20 09:13:04'),
(184, 42, 13, 388, '2025-11-20 09:13:04'),
(185, 42, 13, 245, '2025-11-20 09:13:04'),
(186, 42, 13, 248, '2025-11-20 09:13:04'),
(187, 42, 13, 326, '2025-11-20 09:13:04'),
(188, 42, 13, 399, '2025-11-20 09:13:04'),
(189, 42, 13, 653, '2025-11-20 09:13:04'),
(190, 42, 13, 759, '2025-11-20 09:13:04'),
(191, 42, 13, 552, '2025-11-20 09:13:04'),
(192, 42, 13, 333, '2025-11-20 09:13:04'),
(193, 42, 13, 173, '2025-11-20 09:13:04'),
(194, 42, 13, 305, '2025-11-20 09:13:04'),
(195, 42, 13, 244, '2025-11-20 09:13:04'),
(196, 42, 13, 585, '2025-11-20 09:13:04'),
(197, 42, 13, 740, '2025-11-20 09:13:04'),
(198, 42, 13, 768, '2025-11-20 09:13:04'),
(199, 42, 13, 780, '2025-11-20 09:13:04'),
(200, 42, 13, 765, '2025-11-20 09:13:04'),
(201, 42, 13, 651, '2025-11-20 09:13:04'),
(202, 42, 13, 492, '2025-11-20 09:13:04'),
(203, 42, 13, 316, '2025-11-20 09:13:04'),
(204, 42, 13, 320, '2025-11-20 09:13:04'),
(205, 42, 13, 692, '2025-11-20 09:13:04'),
(206, 42, 14, 875, '2025-11-20 12:15:55'),
(207, 42, 14, 929, '2025-11-20 12:15:55'),
(208, 42, 14, 1083, '2025-11-20 12:15:55'),
(209, 42, 14, 1063, '2025-11-20 12:15:55'),
(210, 42, 14, 1023, '2025-11-20 12:15:55'),
(211, 42, 14, 1054, '2025-11-20 12:15:55'),
(212, 42, 14, 934, '2025-11-20 12:15:55'),
(213, 42, 14, 1068, '2025-11-20 12:15:55'),
(214, 42, 14, 1085, '2025-11-20 12:15:55'),
(215, 42, 14, 924, '2025-11-20 12:15:55'),
(216, 42, 14, 1057, '2025-11-20 12:15:55'),
(217, 42, 14, 994, '2025-11-20 12:15:55'),
(218, 42, 14, 871, '2025-11-20 12:15:55'),
(219, 42, 14, 1091, '2025-11-20 12:15:55'),
(220, 42, 14, 904, '2025-11-20 12:15:55'),
(221, 42, 14, 892, '2025-11-20 12:15:55'),
(222, 42, 14, 872, '2025-11-20 12:15:55'),
(223, 42, 14, 859, '2025-11-20 12:15:55'),
(224, 42, 14, 845, '2025-11-20 12:15:55'),
(225, 42, 14, 1051, '2025-11-20 12:15:55'),
(226, 42, 14, 866, '2025-11-20 12:15:55'),
(227, 42, 14, 922, '2025-11-20 12:15:55'),
(228, 42, 14, 941, '2025-11-20 12:15:55'),
(229, 42, 14, 895, '2025-11-20 12:15:55'),
(230, 42, 14, 919, '2025-11-20 12:15:55'),
(231, 42, 15, 1307, '2025-11-23 13:16:01'),
(232, 42, 15, 1330, '2025-11-23 13:16:01'),
(233, 42, 15, 1282, '2025-11-23 13:16:01'),
(234, 42, 15, 1273, '2025-11-23 13:16:01'),
(235, 42, 15, 1370, '2025-11-23 13:16:01'),
(236, 40, 15, 1101, '2025-11-23 13:21:35'),
(237, 40, 15, 1216, '2025-11-23 13:21:35'),
(238, 40, 15, 1221, '2025-11-23 13:21:35'),
(239, 40, 15, 1355, '2025-11-23 13:21:35'),
(240, 40, 15, 1165, '2025-11-23 13:21:35'),
(241, 5, 15, 1216, '2025-11-23 13:34:19'),
(242, 5, 15, 1370, '2025-11-23 13:34:19'),
(243, 5, 15, 1363, '2025-11-23 13:34:19'),
(244, 5, 15, 1322, '2025-11-23 13:34:19'),
(245, 5, 15, 1182, '2025-11-23 13:34:19'),
(246, 5, 15, 1353, '2025-11-23 13:34:19'),
(247, 5, 15, 1137, '2025-11-23 13:34:19'),
(248, 5, 15, 1314, '2025-11-23 13:34:19'),
(249, 5, 15, 1161, '2025-11-23 13:34:19'),
(250, 5, 15, 1356, '2025-11-23 13:34:19'),
(251, 5, 15, 1130, '2025-11-23 13:34:19'),
(252, 5, 15, 1211, '2025-11-23 13:34:19'),
(253, 5, 15, 1209, '2025-11-23 13:34:19'),
(254, 5, 15, 1266, '2025-11-23 13:34:19'),
(255, 5, 15, 1227, '2025-11-23 13:34:19'),
(256, 5, 15, 1167, '2025-11-23 13:34:19'),
(257, 5, 15, 1288, '2025-11-23 13:34:19'),
(258, 5, 15, 1095, '2025-11-23 13:34:19'),
(259, 5, 15, 1198, '2025-11-23 13:34:19'),
(260, 5, 15, 1267, '2025-11-23 13:34:19'),
(261, 5, 15, 1188, '2025-11-23 13:34:19'),
(262, 5, 15, 1316, '2025-11-23 13:34:19'),
(263, 5, 15, 1096, '2025-11-23 13:34:19'),
(264, 5, 15, 1330, '2025-11-23 13:34:19'),
(265, 5, 15, 1162, '2025-11-23 13:34:19'),
(266, 38, 15, 1369, '2025-11-23 15:51:40'),
(267, 38, 15, 1301, '2025-11-23 15:51:40'),
(268, 38, 15, 1377, '2025-11-23 15:51:40'),
(269, 38, 15, 1215, '2025-11-23 15:51:40'),
(270, 38, 15, 1157, '2025-11-23 15:51:40'),
(271, 38, 15, 1237, '2025-11-23 15:51:40'),
(272, 38, 15, 1290, '2025-11-23 15:51:40'),
(273, 38, 15, 1278, '2025-11-23 15:51:40'),
(274, 38, 15, 1159, '2025-11-23 15:51:40'),
(275, 38, 15, 1114, '2025-11-23 15:51:40'),
(276, 38, 15, 1112, '2025-11-23 15:51:40'),
(277, 38, 15, 1106, '2025-11-23 15:51:40'),
(278, 38, 15, 1151, '2025-11-23 15:51:40'),
(279, 38, 15, 1341, '2025-11-23 15:51:40'),
(280, 38, 15, 1393, '2025-11-23 15:51:40'),
(281, 38, 15, 1320, '2025-11-23 15:51:40'),
(282, 38, 15, 1226, '2025-11-23 15:51:40'),
(283, 38, 15, 1339, '2025-11-23 15:51:40'),
(284, 38, 15, 1257, '2025-11-23 15:51:40'),
(285, 38, 15, 1165, '2025-11-23 15:51:40'),
(286, 38, 15, 1262, '2025-11-23 15:51:40'),
(287, 38, 15, 1360, '2025-11-23 15:51:40'),
(288, 38, 15, 1261, '2025-11-23 15:51:40'),
(289, 38, 15, 1141, '2025-11-23 15:51:40'),
(290, 38, 15, 1153, '2025-11-23 15:51:40'),
(291, 37, 15, 1332, '2025-11-23 16:40:45'),
(292, 37, 15, 1352, '2025-11-23 16:40:45'),
(293, 37, 15, 1262, '2025-11-23 16:40:45'),
(294, 37, 15, 1172, '2025-11-23 16:40:45'),
(295, 37, 15, 1250, '2025-11-23 16:40:45'),
(296, 37, 15, 1102, '2025-11-23 16:40:45'),
(297, 37, 15, 1303, '2025-11-23 16:40:45'),
(298, 37, 15, 1368, '2025-11-23 16:40:45'),
(299, 37, 15, 1365, '2025-11-23 16:40:45'),
(300, 37, 15, 1370, '2025-11-23 16:40:45'),
(301, 37, 15, 1314, '2025-11-23 16:40:45'),
(302, 37, 15, 1191, '2025-11-23 16:40:45'),
(303, 37, 15, 1175, '2025-11-23 16:40:45'),
(304, 37, 15, 1180, '2025-11-23 16:40:45'),
(305, 37, 15, 1209, '2025-11-23 16:40:45'),
(306, 37, 15, 1267, '2025-11-23 16:40:45'),
(307, 37, 15, 1203, '2025-11-23 16:40:45'),
(308, 37, 15, 1348, '2025-11-23 16:40:45'),
(309, 37, 15, 1107, '2025-11-23 16:40:45'),
(310, 37, 15, 1212, '2025-11-23 16:40:45'),
(311, 37, 15, 1377, '2025-11-23 16:40:45'),
(312, 37, 15, 1167, '2025-11-23 16:40:45'),
(313, 37, 15, 1130, '2025-11-23 16:40:45'),
(314, 37, 15, 1217, '2025-11-23 16:40:45'),
(315, 37, 15, 1147, '2025-11-23 16:40:45'),
(316, 8, 15, 1147, '2025-11-23 17:21:31'),
(317, 8, 15, 1136, '2025-11-23 17:21:31'),
(318, 8, 15, 1312, '2025-11-23 17:21:31'),
(319, 8, 15, 1107, '2025-11-23 17:21:31'),
(320, 8, 15, 1134, '2025-11-23 17:21:31'),
(321, 8, 15, 1259, '2025-11-23 17:21:31'),
(322, 8, 15, 1288, '2025-11-23 17:21:31'),
(323, 8, 15, 1184, '2025-11-23 17:21:31'),
(324, 8, 15, 1359, '2025-11-23 17:21:31'),
(325, 8, 15, 1106, '2025-11-23 17:21:31'),
(326, 8, 15, 1279, '2025-11-23 17:21:31'),
(327, 8, 15, 1243, '2025-11-23 17:21:31'),
(328, 8, 15, 1198, '2025-11-23 17:21:31'),
(329, 8, 15, 1167, '2025-11-23 17:21:31'),
(330, 8, 15, 1282, '2025-11-23 17:21:31'),
(331, 8, 15, 1302, '2025-11-23 17:21:31'),
(332, 8, 15, 1383, '2025-11-23 17:21:31'),
(333, 8, 15, 1262, '2025-11-23 17:21:31'),
(334, 8, 15, 1096, '2025-11-23 17:21:31'),
(335, 8, 15, 1272, '2025-11-23 17:21:31'),
(336, 8, 15, 1218, '2025-11-23 17:21:31'),
(337, 8, 15, 1300, '2025-11-23 17:21:31'),
(338, 8, 15, 1207, '2025-11-23 17:21:31'),
(339, 8, 15, 1219, '2025-11-23 17:21:31'),
(340, 8, 15, 1230, '2025-11-23 17:21:31'),
(341, 43, 15, 1107, '2025-11-23 17:32:49'),
(342, 43, 15, 1194, '2025-11-23 17:32:49'),
(343, 43, 15, 1270, '2025-11-23 17:32:49'),
(344, 43, 15, 1370, '2025-11-23 17:32:49'),
(345, 43, 15, 1169, '2025-11-23 17:32:49'),
(346, 43, 15, 1374, '2025-11-23 17:32:49'),
(347, 43, 15, 1219, '2025-11-23 17:32:49'),
(348, 43, 15, 1188, '2025-11-23 17:32:49'),
(349, 43, 15, 1167, '2025-11-23 17:32:49'),
(350, 43, 15, 1293, '2025-11-23 17:32:49'),
(351, 43, 15, 1375, '2025-11-23 17:32:49'),
(352, 43, 15, 1212, '2025-11-23 17:32:49'),
(353, 43, 15, 1120, '2025-11-23 17:32:49'),
(354, 43, 15, 1254, '2025-11-23 17:32:49'),
(355, 43, 15, 1324, '2025-11-23 17:32:49'),
(356, 43, 15, 1202, '2025-11-23 17:32:49'),
(357, 43, 15, 1222, '2025-11-23 17:32:49'),
(358, 43, 15, 1260, '2025-11-23 17:32:49'),
(359, 43, 15, 1100, '2025-11-23 17:32:49'),
(360, 43, 15, 1263, '2025-11-23 17:32:49'),
(361, 43, 15, 1237, '2025-11-23 17:32:49'),
(362, 43, 15, 1245, '2025-11-23 17:32:49'),
(363, 43, 15, 1180, '2025-11-23 17:32:49'),
(364, 43, 15, 1312, '2025-11-23 17:32:49'),
(365, 43, 15, 1386, '2025-11-23 17:32:49'),
(366, 4, 15, 1098, '2025-11-23 18:22:50'),
(367, 4, 15, 1195, '2025-11-23 18:22:50'),
(368, 4, 15, 1147, '2025-11-23 18:22:50'),
(369, 4, 15, 1335, '2025-11-23 18:22:50'),
(370, 4, 15, 1275, '2025-11-23 18:22:50'),
(371, 4, 15, 1278, '2025-11-23 18:22:50'),
(372, 4, 15, 1369, '2025-11-23 18:22:50'),
(373, 4, 15, 1287, '2025-11-23 18:22:50'),
(374, 4, 15, 1295, '2025-11-23 18:22:50'),
(375, 4, 15, 1258, '2025-11-23 18:22:50'),
(376, 4, 15, 1341, '2025-11-23 18:22:50'),
(377, 4, 15, 1372, '2025-11-23 18:22:50'),
(378, 4, 15, 1271, '2025-11-23 18:22:50'),
(379, 4, 15, 1274, '2025-11-23 18:22:50'),
(380, 4, 15, 1249, '2025-11-23 18:22:50'),
(381, 4, 15, 1141, '2025-11-23 18:22:50'),
(382, 4, 15, 1264, '2025-11-23 18:22:50'),
(383, 4, 15, 1389, '2025-11-23 18:22:50'),
(384, 4, 15, 1378, '2025-11-23 18:22:50'),
(385, 4, 15, 1205, '2025-11-23 18:22:50'),
(386, 4, 15, 1353, '2025-11-23 18:22:50'),
(387, 4, 15, 1273, '2025-11-23 18:22:50'),
(388, 4, 15, 1319, '2025-11-23 18:22:50'),
(389, 4, 15, 1129, '2025-11-23 18:22:50'),
(390, 4, 15, 1192, '2025-11-23 18:22:50'),
(391, 77, 15, 1312, '2025-11-23 19:56:38'),
(392, 77, 15, 1314, '2025-11-23 19:56:38'),
(393, 77, 15, 1310, '2025-11-23 19:56:38'),
(394, 77, 15, 1238, '2025-11-23 19:56:38'),
(395, 77, 15, 1183, '2025-11-23 19:56:38'),
(396, 77, 15, 1220, '2025-11-23 19:56:38'),
(397, 77, 15, 1386, '2025-11-23 19:56:38'),
(398, 77, 15, 1261, '2025-11-23 19:56:38'),
(399, 77, 15, 1216, '2025-11-23 19:56:38'),
(400, 77, 15, 1186, '2025-11-23 19:56:38'),
(401, 77, 15, 1316, '2025-11-23 19:56:38'),
(402, 77, 15, 1276, '2025-11-23 19:56:38'),
(403, 77, 15, 1269, '2025-11-23 19:56:38'),
(404, 77, 15, 1156, '2025-11-23 19:56:38'),
(405, 77, 15, 1122, '2025-11-23 19:56:38'),
(406, 77, 15, 1125, '2025-11-23 19:56:38'),
(407, 77, 15, 1354, '2025-11-23 19:56:38'),
(408, 77, 15, 1163, '2025-11-23 19:56:38'),
(409, 77, 15, 1327, '2025-11-23 19:56:38'),
(410, 77, 15, 1298, '2025-11-23 19:56:38'),
(411, 77, 15, 1392, '2025-11-23 19:56:38'),
(412, 77, 15, 1380, '2025-11-23 19:56:38'),
(413, 77, 15, 1359, '2025-11-23 19:56:38'),
(414, 77, 15, 1252, '2025-11-23 19:56:38'),
(415, 77, 15, 1196, '2025-11-23 19:56:38'),
(421, 1, 1, 18, '2025-11-28 08:32:36'),
(422, 1, 1, 27, '2025-11-28 08:32:36'),
(423, 1, 1, 36, '2025-11-28 08:32:36'),
(424, 1, 1, 49, '2025-11-28 08:32:36'),
(425, 1, 1, 64, '2025-11-28 08:32:36'),
(426, 1, 1, 171, '2025-11-28 08:32:36'),
(427, 1, 1, 24, '2025-11-28 08:32:36'),
(428, 1, 1, 43, '2025-11-28 08:32:36'),
(429, 1, 1, 45, '2025-11-28 08:32:36'),
(430, 1, 1, 40, '2025-11-28 08:32:36'),
(431, 1, 1, 14, '2025-11-28 08:32:36'),
(432, 1, 1, 75, '2025-11-28 08:32:36'),
(433, 1, 1, 10, '2025-11-28 08:32:36'),
(434, 1, 1, 70, '2025-11-28 08:32:36'),
(435, 1, 1, 6, '2025-11-28 08:32:36'),
(436, 1, 1, 3, '2025-11-28 08:32:36'),
(437, 1, 1, 11, '2025-11-28 08:32:36'),
(438, 1, 1, 60, '2025-11-28 08:32:36'),
(439, 1, 1, 8, '2025-11-28 08:32:36'),
(440, 1, 1, 54, '2025-11-28 08:32:36'),
(441, 1, 1, 71, '2025-11-28 08:32:36'),
(442, 1, 1, 44, '2025-11-28 08:32:36'),
(443, 1, 1, 61, '2025-11-28 08:32:36'),
(444, 1, 1, 5, '2025-11-28 08:32:36'),
(445, 1, 1, 28, '2025-11-28 08:32:36'),
(446, 1, 15, 1095, '2025-12-09 10:16:33'),
(447, 1, 15, 1282, '2025-12-09 10:16:33'),
(448, 1, 15, 1361, '2025-12-09 10:16:33'),
(449, 1, 15, 1336, '2025-12-09 10:16:33'),
(450, 1, 15, 1158, '2025-12-09 10:16:33'),
(451, 1, 15, 1222, '2025-12-09 10:16:33'),
(452, 1, 15, 1119, '2025-12-09 10:16:33'),
(453, 1, 15, 1305, '2025-12-09 10:16:33'),
(454, 1, 15, 1391, '2025-12-09 10:16:33'),
(455, 1, 15, 1381, '2025-12-09 10:16:33'),
(456, 2, 15, 1272, '2025-12-09 10:36:38'),
(457, 2, 15, 1173, '2025-12-09 10:36:38'),
(458, 2, 15, 1138, '2025-12-09 10:36:38'),
(459, 2, 15, 1235, '2025-12-09 10:36:38'),
(460, 2, 15, 1384, '2025-12-09 10:36:38'),
(461, 2, 15, 1280, '2025-12-09 10:36:38'),
(462, 2, 15, 1151, '2025-12-09 10:36:38'),
(463, 2, 15, 1126, '2025-12-09 10:36:38'),
(464, 2, 15, 1335, '2025-12-09 10:36:38'),
(465, 2, 15, 1098, '2025-12-09 10:36:38');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`) VALUES
(2, 'Web Developement using PHP'),
(3, 'Basics of Database Development'),
(4, 'Networking Fundamentals'),
(5, 'Develop Web User Interface'),
(6, 'Apply Computer Basics'),
(7, 'Apply Fundamentals of Programming using C '),
(8, 'Design Graphic User Interface'),
(9, 'Develop Web Application using JavaScript '),
(10, 'Design Embedded System Hardware'),
(11, 'Robotics');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subjects`
--

CREATE TABLE `teacher_subjects` (
  `id` int NOT NULL,
  `teacher_id` int DEFAULT NULL,
  `subject_id` int DEFAULT NULL,
  `class_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_subjects`
--

INSERT INTO `teacher_subjects` (`id`, `teacher_id`, `subject_id`, `class_name`) VALUES
(5, 2, 11, 'Grade 5'),
(6, 7, 8, 'SPES'),
(8, 19, 2, 'SPES'),
(9, 19, 3, 'SPES'),
(10, 21, 7, 'SPES'),
(11, 18, 4, 'SPES'),
(16, 6, 2, 'SPES'),
(17, 6, 3, 'SPES');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int NOT NULL,
  `quiz_id` int DEFAULT NULL,
  `question_text` text,
  `option_a` varchar(255) DEFAULT NULL,
  `option_b` varchar(255) DEFAULT NULL,
  `option_c` varchar(255) DEFAULT NULL,
  `option_d` varchar(255) DEFAULT NULL,
  `correct_option` varchar(10) DEFAULT NULL,
  `score` int DEFAULT NULL,
  `question_type` enum('mcq','open') DEFAULT 'mcq',
  `expected_keywords` text,
  `status` enum('available','taken','used','') NOT NULL DEFAULT 'available',
  `assigned_to` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `quiz_id`, `question_text`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`, `score`, `question_type`, `expected_keywords`, `status`, `assigned_to`) VALUES
(1, 1, 'PHP is executed on the ___ side.', 'Client', 'Server', 'User', 'Remote', 'B', 5, 'mcq', '', 'taken', 1),
(2, 1, 'Which symbol is used to declare a variable in PHP?', '#', '$', '@', '&', 'B', 5, 'mcq', '', 'used', 5),
(3, 1, 'Which of the following is a correct PHP variable name?', '$1number', '$number', 'number$', '1$number', 'B', 5, 'mcq', '', 'taken', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `your_name` varchar(60) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `your_name`, `email`, `phone`) VALUES
(1, 'tigerkev07@gmail.com', '12345', 'Mugisha Alpha', 'tigerkev07@gmail.com', '0'),
(2, 'getmorelev@gmail.com', '12345', 'Levi', 'getmorelev@gmail.com', '0'),
(3, 'utujeocean@gmail.com', '12345', 'Utuje Oceanne Camilla', 'utujeocean@gmail.com', '0'),
(4, 'ikennykelvin75@gmail.com', '12345', 'ISHIMWE Keny Kelvin', 'ikennykelvin75@gmail.com', '0795817707'),
(5, 'isarodeborah85@gmail.com', '12345', 'Isaro Debstar', 'isarodeborah85@gmail.com', '0'),
(6, 'tiana.tunga@gmail.com', '12345', 'TUNGA Tiana', 'tiana.tunga@gmail.com', '0'),
(7, 'bhirwa344@gmail.com', '12345', 'HIRWA Brian', 'bhirwa344@gmail.com', '0'),
(8, 'faustin.niyitegeka@gmail.com', '12345', 'Eng. Faustin NIYTEGEKA', 'faustin.niyitegeka@gmail.com', '0'),
(9, 'malvyn304@gmail.com', '12345', 'Nkusi Malvyn', 'malvyn304@gmail.com', '0781362233');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('teacher','student','admin') NOT NULL,
  `class_assigned` varchar(100) NOT NULL,
  `subject_assigned` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `class_assigned`, `subject_assigned`) VALUES
(1, 'Nicodem Ndayishimiye', 'ndayinicodem20@gmail.com', 'ABC123', 'teacher', 'SPES', NULL),
(2, 'Kagire Leah', 'karangileah25@gmail.com', 'ABC123', 'teacher', 'SPES', NULL),
(3, 'Niyonizera Jean de Dieu', 'niyonizera.dieu@gmail.com', 'ABC123', 'teacher', 'SPES', NULL),
(4, 'NDAZIVUNNYE Felix ', 'ndazivunnyefelix08@gmail.com', 'ABC123', 'teacher', 'SPES', NULL),
(5, 'Ingabire Christine', 'ingachrina@gmail.com', 'ABC123', 'teacher', 'SPES', NULL),
(7, 'TUYISHIMIRE ERIC', 'tuyishimireericc@gmail.com', 'ABC123', 'teacher', 'SPES', NULL),
(8, 'Jean Bosco Uwitonze ', 'uwjbosco@gmail.com', 'ABC123', 'teacher', 'SPES', NULL),
(9, 'NSHIMYIMANA Jean de Dieu', 'jeandedieunshimiyimana@gmail.com', 'ABC123', 'teacher', 'SPES', NULL),
(10, 'Leon NTABOMVURA', 'leon.ntabomvura@gmail.com', 'ABC123', 'teacher', 'SPES', NULL),
(11, 'NIYONGABO Emmanuel', 'emmanuelniyongabo44@gmail.com', 'ABC123', 'teacher', 'SPES', NULL),
(12, 'Assadou', 'assadunsba@gmail.com', 'ABC123', 'teacher', 'SPES', NULL),
(13, 'Jean Willy', 'jeanwillyh@gmail.com', 'ABC123', 'teacher', 'SPES', NULL),
(14, 'NIYITEGEKA FAUSTIN', 'faustinganzasheila@gmail.com', 'faustin@123', 'admin', 'SPES', NULL),
(19, 'NIYITEGEKA FAUSTIN', 'faustin.niyitegeka@gmail.com', 'faustin@123', 'teacher', 'SPES', '2,3');

-- --------------------------------------------------------

--
-- Table structure for table `why_partner_nga`
--

CREATE TABLE `why_partner_nga` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `display_order` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `why_partner_nga`
--

INSERT INTO `why_partner_nga` (`id`, `title`, `description`, `icon`, `status`, `display_order`) VALUES
(2, 'About Us', 'New Generation Academy is a nursery, primary and secondary level school in the heart of Kigali, Rwanda. We focus on delivering an English and French bilingual education focused on Christian values, ICT, Robotics and STEM to our students.', 'uploads/why_partner/why_partner_1765368541.jpg', 1, 1),
(4, 'Who We Are', 'NGA-Coding Academy is a private high school and emerging Centre of Excellence dedicated to developing exceptional talent in Software Programming, Embedded Systems, and Robotics. ', 'uploads/why_partner/why_partner_1765663698.png', 1, 2),
(5, 'Mission', '\nNew Generation Academy\'s mission is to serve and impact the community through educating, nurturing, and caring for children entrusted to us.\n', 'uploads/why_partner/why_partner_1765664482.png', 1, 3),
(7, 'Our Purpose', 'Our purpose is to prepare skilled, ethical, and job-ready graduates and shaping  a new generation of tech professionals who embody Christian values as they innovate and engage in the national and global tech landscape.', 'uploads/why_partner/why_partner_1765872065.jpeg', 1, 5),
(8, 'Vision', 'New generation academy aspires to consistently offer Christ centered education that focuses on individual uniqueness and talents to the glory of God.', 'uploads/why_partner/why_partner_1765872736.JPG', 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_sections`
--
ALTER TABLE `about_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `academic_curriculum`
--
ALTER TABLE `academic_curriculum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `academy_blogs`
--
ALTER TABLE `academy_blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `academy_features`
--
ALTER TABLE `academy_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `academy_programs`
--
ALTER TABLE `academy_programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `assignement_Instructor`
--
ALTER TABLE `assignement_Instructor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chatid`);

--
-- Indexes for table `chat_room`
--
ALTER TABLE `chat_room`
  ADD PRIMARY KEY (`chat_room_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `class_name` (`class_name`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `innovation_pillars`
--
ALTER TABLE `innovation_pillars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `innovation_sliders`
--
ALTER TABLE `innovation_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `page_settings`
--
ALTER TABLE `page_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `meta_key` (`meta_key`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`partner_id`);

--
-- Indexes for table `personal_info`
--
ALTER TABLE `personal_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_address` (`email_address`),
  ADD UNIQUE KEY `national_id_number` (`national_id_number`);

--
-- Indexes for table `portfolio_works`
--
ALTER TABLE `portfolio_works`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_modules`
--
ALTER TABLE `program_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_exam`
--
ALTER TABLE `quiz_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Indexes for table `spes_features`
--
ALTER TABLE `spes_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_history`
--
ALTER TABLE `students_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_answers`
--
ALTER TABLE `student_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_notes`
--
ALTER TABLE `student_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_questions`
--
ALTER TABLE `student_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `why_partner_nga`
--
ALTER TABLE `why_partner_nga`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_sections`
--
ALTER TABLE `about_sections`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `academic_curriculum`
--
ALTER TABLE `academic_curriculum`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `academy_blogs`
--
ALTER TABLE `academy_blogs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `academy_features`
--
ALTER TABLE `academy_features`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `academy_programs`
--
ALTER TABLE `academy_programs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `assignement_Instructor`
--
ALTER TABLE `assignement_Instructor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chatid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `chat_room`
--
ALTER TABLE `chat_room`
  MODIFY `chat_room_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `innovation_pillars`
--
ALTER TABLE `innovation_pillars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `innovation_sliders`
--
ALTER TABLE `innovation_sliders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `page_settings`
--
ALTER TABLE `page_settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `partner_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `personal_info`
--
ALTER TABLE `personal_info`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3514;

--
-- AUTO_INCREMENT for table `portfolio_works`
--
ALTER TABLE `portfolio_works`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `program_modules`
--
ALTER TABLE `program_modules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1400;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_exam`
--
ALTER TABLE `quiz_exam`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `spes_features`
--
ALTER TABLE `spes_features`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `students_history`
--
ALTER TABLE `students_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_answers`
--
ALTER TABLE `student_answers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=481;

--
-- AUTO_INCREMENT for table `student_notes`
--
ALTER TABLE `student_notes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `student_questions`
--
ALTER TABLE `student_questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=466;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1394;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `why_partner_nga`
--
ALTER TABLE `why_partner_nga`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
