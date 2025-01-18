-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 25, 2022 at 07:10 PM
-- Server version: 8.0.28
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eduparal_MAIN_DATABASE`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `Name` varchar(255) DEFAULT NULL,
  `USERNAME` varchar(8) DEFAULT NULL,
  `password` varchar(24) NOT NULL DEFAULT 'NOT NULL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`Name`, `USERNAME`, `password`) VALUES
('Pawan Vikasitha', 'Vikasith', '1234'),
('Janith Dewapriya', 'wVgXieSE', 'ENJLR5LnfZY3yUnhH7fdXW'),
('Aravinda Sampath', 'AN75SnEF', 'RGmsDZAvYpxbnJQxh8mUys');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us_messages`
--

CREATE TABLE `contact_us_messages` (
  `message_id` int NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone_number` varchar(255) DEFAULT NULL,
  `whatsapp_number` varchar(255) DEFAULT NULL,
  `message_content` longtext,
  `recived_date` date DEFAULT NULL,
  `recived_time` time DEFAULT NULL,
  `Readability` varchar(255) DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us_messages`
--

INSERT INTO `contact_us_messages` (`message_id`, `Name`, `Email`, `Phone_number`, `whatsapp_number`, `message_content`, `recived_date`, `recived_time`, `Readability`) VALUES
(27, '', '', '', '', '', '2022-03-12', '02:02:02', NULL),
(28, '', '', '', '', '', '2022-03-12', '02:02:03', NULL),
(29, 'Pawan Vikasitha', 'pawanvikasitha2001@gmail.com', '0711323889', '', '', '2022-03-12', '02:02:23', 'read'),
(30, 'Pawan Vikasitha', 'pawanvikasitha2001@gmail.com', '0711323889', '', '', '2022-03-12', '02:02:23', 'read'),
(31, 'Pawan Vikasitha', 'pawanvikasitha2001@gmail.com', '0711323889', '', '', '2022-03-12', '02:02:24', 'read'),
(32, '', '', '', '', '', '2022-03-12', '02:03:55', NULL),
(33, '', '', '', '', '', '2022-03-12', '02:03:59', NULL),
(34, '', '', '', '', '', '2022-03-12', '02:04:00', NULL),
(35, '', '', '', '', '', '2022-03-12', '02:04:00', NULL),
(36, '', '', '', '', '', '2022-03-12', '02:04:02', NULL),
(37, '', '', '', '', '', '2022-03-12', '02:05:10', NULL),
(38, '', '', '', '', '', '2022-03-12', '02:05:38', NULL),
(39, '', '', '', '', '', '2022-03-12', '02:05:39', NULL),
(40, '', '', '', '', '', '2022-03-12', '02:06:08', NULL),
(41, '', '', '', '', '', '2022-03-12', '02:06:11', NULL),
(42, '', '', '', '', '', '2022-03-12', '02:06:34', NULL),
(43, '', '', '', '', '', '2022-03-12', '02:06:40', NULL),
(44, '', '', '', '', '', '2022-03-12', '02:06:51', NULL),
(45, '', '', '', '', '', '2022-03-12', '02:06:52', NULL),
(46, '', '', '', '', '', '2022-03-12', '02:06:53', NULL),
(47, 'Madushan Gamage', 'madu@gmail.com', '0712132345', '0711323889', 'Mage me aulk thiyenawa, Mage profile eke pissuwak nattanawa wage seen ekak venawa. Please mata message ekak daanna aniwa.', '2022-03-12', '02:08:02', 'read'),
(48, '', '', '', '', '', '2022-03-12', '02:10:25', NULL),
(49, '', '', '', '', '', '2022-03-12', '02:10:28', NULL),
(50, '', '', '', '', '', '2022-03-12', '02:10:48', NULL),
(51, '', '', '', '', '', '2022-03-12', '02:10:51', NULL),
(52, '', '', '', '', '', '2022-03-12', '02:11:08', NULL),
(53, '', '', '', '', '', '2022-03-12', '02:11:08', NULL),
(54, '', '', '', '', '', '2022-03-12', '02:11:09', NULL),
(55, '', '', '', '', '', '2022-03-12', '02:11:26', NULL),
(56, '', '', '', '', '', '2022-03-12', '02:11:58', NULL),
(57, '', '', '', '', '', '2022-03-12', '02:12:06', NULL),
(58, '', '', '', '', '', '2022-03-12', '02:13:31', NULL),
(59, '', '', '', '', '', '2022-03-12', '02:13:35', NULL),
(60, '', '', '', '', '', '2022-03-12', '02:13:41', NULL),
(61, '', '', '', '', '', '2022-03-12', '02:13:58', NULL),
(62, '', '', '', '', '', '2022-03-12', '02:14:06', NULL),
(63, '', '', '', '', '', '2022-03-12', '02:14:11', NULL),
(64, '', '', '', '', '', '2022-03-12', '02:14:18', NULL),
(65, '', '', '', '', '', '2022-03-12', '02:14:24', NULL),
(66, '', '', '', '', '', '2022-03-12', '02:14:26', NULL),
(67, '', '', '', '', '', '2022-03-12', '02:14:38', NULL),
(68, '', '', '', '', '', '2022-03-12', '02:15:01', NULL),
(69, '', '', '', '', '', '2022-03-12', '02:15:04', NULL),
(70, '', '', '', '', '', '2022-03-12', '02:15:08', NULL),
(71, '', '', '', '', '', '2022-03-12', '02:15:23', NULL),
(72, '', '', '', '', '', '2022-03-12', '02:15:38', NULL),
(73, '', '', '', '', '', '2022-03-12', '02:16:23', NULL),
(74, '', '', '', '', '', '2022-03-12', '02:16:29', NULL),
(75, '', '', '', '', '', '2022-03-12', '02:16:31', NULL),
(76, '', '', '', '', '', '2022-03-12', '02:16:42', NULL),
(77, '', '', '', '', '', '2022-03-12', '02:17:36', NULL),
(78, '', '', '', '', '', '2022-03-12', '02:18:10', NULL),
(79, '', '', '', '', '', '2022-03-12', '02:18:51', NULL),
(80, '', '', '', '', '', '2022-03-12', '02:18:54', NULL),
(81, '', '', '', '', '', '2022-03-12', '02:19:20', NULL),
(82, '', '', '', '', '', '2022-03-12', '02:19:31', NULL),
(83, '', '', '', '', '', '2022-03-12', '02:19:39', NULL),
(84, '', '', '', '', '', '2022-03-12', '02:20:30', NULL),
(85, '', '', '', '', '', '2022-03-12', '02:21:50', NULL),
(86, '', '', '', '', '', '2022-03-12', '02:21:54', NULL),
(87, '', '', '', '', '', '2022-03-12', '02:23:52', NULL),
(88, '', '', '', '', '', '2022-03-12', '02:29:08', NULL),
(89, '', '', '', '', '', '2022-03-12', '02:29:56', NULL),
(90, '', '', '', '', '', '2022-03-12', '02:30:43', NULL),
(91, '', '', '', '', '', '2022-03-12', '02:31:23', NULL),
(92, '', '', '', '', '', '2022-03-12', '02:32:55', NULL),
(93, '', '', '', '', '', '2022-03-12', '08:15:49', NULL),
(94, '', '', '', '', '', '2022-03-12', '08:16:56', NULL),
(95, '', '', '', '', '', '2022-03-12', '08:16:56', NULL),
(96, '', '', '', '', '', '2022-03-12', '08:16:56', NULL),
(97, '', '', '', '', '', '2022-03-12', '08:16:57', NULL),
(98, '', '', '', '', '', '2022-03-12', '08:18:12', NULL),
(99, '', '', '', '', '', '2022-03-12', '08:18:17', NULL),
(100, '', '', '', '', '', '2022-03-12', '08:18:22', NULL),
(101, '', '', '', '', '', '2022-03-12', '08:23:58', NULL),
(102, 'Test Name', 'test@gmail.com', '0714568979898', '', 'This is just a test message', '2022-03-12', '08:24:48', 'read'),
(103, '', '', '', '', '', '2022-03-12', '08:26:19', NULL),
(104, '', '', '', '', '', '2022-03-12', '08:26:26', NULL),
(105, '', '', '', '', '', '2022-03-12', '08:27:03', NULL),
(106, '', '', '', '', '', '2022-03-12', '08:27:04', NULL),
(107, '', '', '', '', '', '2022-03-12', '08:27:05', NULL),
(108, '', '', '', '', '', '2022-03-12', '08:31:47', NULL),
(109, '', '', '', '', '', '2022-03-12', '08:32:05', NULL),
(110, '', '', '', '', '', '2022-03-12', '08:32:05', NULL),
(111, '', '', '', '', '', '2022-03-12', '08:32:06', NULL),
(112, '', '', '', '', '', '2022-03-12', '08:32:22', NULL),
(113, '', '', '', '', '', '2022-03-12', '08:32:22', NULL),
(114, '', '', '', '', '', '2022-03-12', '08:32:23', NULL),
(115, '', '', '', '', '', '2022-03-12', '08:32:46', NULL),
(116, '', '', '', '', '', '2022-03-12', '09:54:27', NULL),
(117, '', '', '', '', '', '2022-03-12', '10:34:50', NULL),
(118, '', '', '', '', '', '2022-03-12', '10:42:46', NULL),
(119, '', '', '', '', '', '2022-03-12', '15:51:07', NULL),
(120, '', '', '', '', '', '2022-03-12', '19:26:55', NULL),
(121, '', '', '', '', '', '2022-03-12', '19:38:25', NULL),
(122, '', '', '', '', '', '2022-03-12', '19:38:28', NULL),
(123, '', '', '', '', '', '2022-03-12', '19:38:42', NULL),
(124, '', '', '', '', '', '2022-03-12', '19:39:29', NULL),
(125, '', '', '', '', '', '2022-03-12', '19:40:33', NULL),
(126, '', '', '', '', '', '2022-03-12', '19:45:53', NULL),
(127, '', '', '', '', '', '2022-03-12', '19:47:49', NULL),
(128, '', '', '', '', '', '2022-03-12', '19:47:49', NULL),
(129, '', '', '', '', '', '2022-03-15', '00:04:24', NULL),
(130, '', '', '', '', '', '2022-03-17', '04:10:11', NULL),
(131, '', '', '', '', '', '2022-03-18', '12:50:22', 'unread'),
(132, 'Pawan Vikasitha', 'pawanvikasitha2001@gmail.com', '0711323889', '0711323889', 'Yo yo niga', '2022-03-18', '12:50:38', 'read'),
(133, 'SL Teach', 'sandchz@hotmail.com', '', '', 'Monawada bn me site eka set na kiyahanko', '2022-03-18', '13:05:16', 'read'),
(134, '', '', '', '', '', '2022-03-18', '14:54:06', 'unread'),
(135, '', '', '', '', '', '2022-03-18', '14:59:48', 'unread'),
(136, '', '', '', '', '', '2022-03-18', '14:59:51', 'unread'),
(137, '', '', '', '', '', '2022-03-18', '14:59:52', 'unread'),
(138, '', '', '', '', 'Future Icons represents a select collection of design and craft led businesses that', '2022-03-18', '15:00:24', 'read'),
(139, '', '', '', '', '11 ක්ලාස් එකෙ හිටිය උන්ට මතක ඇති', '2022-03-18', '15:15:44', 'read'),
(140, 'Rusiru', '', '', '', 'Me map eke thiyennne koheda bn?', '2022-03-18', '15:27:58', 'read'),
(141, 'SL Tec', 'infio.gokano@gmail.com', '0711323889', '', '', '2022-03-18', '16:59:42', 'read'),
(142, '', '', '', '', '', '2022-03-19', '03:37:57', 'unread'),
(143, 'Kavindu ', 'kavindu@gmail.com', '', '', 'Ada ape pattte dane geyak thibba bn. Ekayi enna bari une. Ada api cricket athak gahuwa dewminalage malli ekka', '2022-03-19', '03:39:22', 'read'),
(144, 'Vihanga', '', '', '', 'E ai bn ada ave natte? Set ekama ava kiyahanko. Hetawath enawada? Aniwa enawada', '2022-03-19', '03:41:32', 'read'),
(145, 'Dushan Jayasanka', '', '', '', 'Elements in HTML are mostly \"inline\" or \"block\" elements: An inline element has floating content on its left and right side. A block element fills the entire line, and nothing can be displayed on its left or right side.', '2022-03-19', '03:43:26', 'read'),
(146, 'Deshan Chirath', 'deshanchirath@gmail.com', '0711323889', '0711323889', 'W3Schools is optimized for learning and training. Examples might be simplified to improve reading and learning. Tutorials,.', '2022-03-19', '03:44:10', 'read'),
(147, 'Guneth Tashen', 'guneth@gmail.com', '0711323889', '0711323889', 'Kohomada bn meke aluth teacher kenekewa register karanne?', '2022-03-19', '03:44:54', 'read'),
(148, 'Theodor', '', '', '', 'Whatsup man?', '2022-03-19', '04:15:41', 'read'),
(149, 'the kota', '', '', '', 'whatsapp boys, isshu boy the kota her', '2022-03-19', '04:16:20', 'read'),
(150, '', '', '', '', '', '2022-03-19', '13:32:59', 'unread'),
(151, '', '', '', '', '', '2022-03-19', '13:33:20', 'unread'),
(152, '', '', '', '', '', '2022-03-20', '02:08:21', 'unread'),
(153, '', '', '', '', '', '2022-03-20', '02:17:10', 'unread'),
(154, '', '', '', '', '', '2022-03-20', '02:17:51', 'unread'),
(155, '', '', '', '', '', '2022-03-20', '02:18:19', 'unread'),
(156, '', '', '', '', '', '2022-03-20', '02:18:20', 'unread'),
(157, '', '', '', '', '', '2022-03-20', '02:18:22', 'unread'),
(158, '', '', '', '', '', '2022-03-20', '02:18:38', 'unread'),
(159, '', '', '', '', '', '2022-03-20', '02:18:39', 'unread'),
(160, '', '', '', '', '', '2022-03-20', '02:19:43', 'unread'),
(161, '', '', '', '', '', '2022-03-20', '02:20:05', 'unread'),
(162, '', '', '', '', '', '2022-03-20', '02:21:08', 'unread'),
(163, '', '', '', '', '', '2022-03-20', '02:21:11', 'unread'),
(164, '', '', '', '', '', '2022-03-20', '02:21:33', 'unread'),
(165, '', '', '', '', '', '2022-03-20', '02:26:50', 'unread'),
(166, '', '', '', '', '', '2022-03-20', '02:38:30', 'unread'),
(167, '', '', '', '', '', '2022-03-20', '02:50:08', 'unread'),
(168, '', '', '', '', '', '2022-03-20', '02:50:10', 'unread'),
(169, '', '', '', '', '', '2022-03-20', '04:35:46', 'unread'),
(170, '', '', '', '', '', '2022-03-20', '04:38:02', 'unread'),
(171, '', '', '', '', '', '2022-03-20', '04:39:08', 'unread'),
(172, '', '', '', '', '', '2022-03-20', '12:29:59', 'unread'),
(173, '', '', '', '', '', '2022-03-21', '21:28:00', 'unread'),
(174, '', '', '', '', '', '2022-03-22', '03:36:52', 'unread'),
(175, 'Janith Dilshan', 'janith@gmail.com', '07146546546546545', '', 'Ow ow bn\r\n', '2022-03-22', '03:37:40', 'read'),
(176, '', '', '', '', '', '2022-03-23', '17:13:33', 'unread'),
(177, '', '', '', '', '', '2022-03-24', '00:34:26', 'unread'),
(178, '', '', '', '', '', '2022-03-24', '00:39:55', 'unread'),
(179, '', '', '', '', '', '2022-03-24', '01:21:10', 'unread'),
(180, '', '', '', '', '', '2022-03-24', '01:56:14', 'unread'),
(181, '', '', '', '', '', '2022-03-25', '03:50:25', 'unread'),
(182, 'Pawan Vikasitha', 'pawanvikasitha2001@gmail.com', '0711323889', '', 'Kohomadaaa??????????????', '2022-03-25', '03:50:43', 'read'),
(183, '', '', '', '', '', '2022-03-25', '13:43:38', 'unread'),
(184, 'Janith', 'dewapriyajanith@gmail.com', '0716231345', '0716231345', 'Hi edupara', '2022-03-25', '13:44:34', 'read');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `Mail_ID` int NOT NULL,
  `sendTo` varchar(255) DEFAULT NULL,
  `sendCC` varchar(255) DEFAULT NULL,
  `sendBCC` varchar(255) DEFAULT NULL,
  `sendMessage` longtext,
  `time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`Mail_ID`, `sendTo`, `sendCC`, `sendBCC`, `sendMessage`, `time`) VALUES
(1, 'janithdewapriya@gmail.com', '', '', 'Lazy dog jumps over the lazy cat', '2022-03-18 22:31:04'),
(2, 'janithdewapriya@gmail.com', '', '', 'Lazy dog jumps over the lazy cat', '2022-03-19 00:05:22'),
(3, 'pawanvikasitha2001@gmail.com', '', '', '<b></b> Did you see the new feture', '2022-03-19 00:18:25'),
(4, 'pawanvikasitha2001@gmail.com', '', '', '<subject></subject> Did you see the new feture', '2022-03-19 00:20:12'),
(5, 'newjanithemail@gmail.com', '', '', '<subject></subject> The new subject has released a moment ago brav, You should see it.', '2022-03-19 00:21:06'),
(6, 'newjanithemail@gmail.com', '', '', '<subject>DID YOU SEE THE NEW SUBJECTS?</subject> The new subject has released a moment ago brav, You should see it.', '2022-03-19 00:21:54'),
(7, 'pawanvikasitha2001@gmail.com', '', '', '<subject>DID YOU SEE THE NEW SUBJECTS?</subject> Will you go alreadyL>', '2022-03-19 00:33:22'),
(8, 'pawanvikasitha2001@gmail.com', '', '', '<subject>DID YOU SEE THE NEW SUBJECTS?</subject> Will you go alreadyL>', '2022-03-19 00:34:00'),
(9, 'pawanvikasitha2001@gmail.com', '', '', '<subject>DID YOU SEE THE NEW SUBJECTS?</subject> Will you go alreadyL>', '2022-03-19 00:35:40'),
(10, 'pawanvikasitha2001@gmail.com', '', '', '<subject>DID YOU SEE THE NEW SUBJECTS?</subject> Will you go alreadyL>', '2022-03-19 00:35:48'),
(11, 'pawanvikasitha2001@gmail.com', '', '', '<subject>DID YOU SEE THE NEW SUBJECTS?</subject> Will you go alreadyL>', '2022-03-19 00:36:23'),
(12, 'pawanvikasitha2001@gmail.com', '', '', '<subject>DID YOU SEE THE NEW SUBJECTS?</subject> Will you go alreadyL>', '2022-03-19 00:36:44'),
(13, 'pawanvikasitha2001@gmail.com', 'aravindajarawardana@gmail.com', 'gayeshdewaraja@gmail.com', '<subject>The news paper</subject> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...\" “Lorem ipsum,” as you probably know, is placeholder text that allows clients to focus on design and UX, without getting distracted by the content — i.e., the words. Makes sense, right?', '2022-03-19 00:38:11'),
(14, 'pawanvikasitha2001@gmail.com', '', '', '<subject></subject> <h1>Hey</h1>', '2022-03-19 00:39:37'),
(15, 'pawanvikasitha2001@gmail.com', '', '', '<subject></subject> ', '2022-03-19 00:43:54'),
(16, 'pawanvikasitha2001@gmail.com', '', '', '<subject></subject> ', '2022-03-19 00:44:06'),
(17, 'pawanvikasitha2001@gmail.com', '', '', '<subject></subject> ', '2022-03-19 00:46:04'),
(18, 'pawanvikasitha2001@gmail.com', '', '', '<subject></subject> ', '2022-03-19 00:46:57'),
(19, 'pawanvikasitha2001@gmail.com', '', '', '<subject></subject> ', '2022-03-19 00:47:19'),
(20, 'pawanvikasitha2001@gmail.com', '', '', '<subject></subject> ', '2022-03-19 00:47:37'),
(21, 'pawanvikasitha2001@gmail.com', '', '', '<subject></subject> ', '2022-03-19 00:48:31'),
(22, 'pawanvikasitha2001@gmail.com', '', '', '<subject></subject> ', '2022-03-19 00:49:04'),
(23, 'pawanvikasitha2001@gmail.com', '', '', '<subject></subject> <b>Hey</b> Brav This was working', '2022-03-19 00:49:41');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `S_ID` int NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `FULL_NAME` varchar(255) DEFAULT NULL,
  `GRADE` varchar(255) DEFAULT NULL,
  `DISTRICT` varchar(255) DEFAULT NULL,
  `CITY` varchar(255) DEFAULT NULL,
  `CONTACT_NUMBER` varchar(255) DEFAULT NULL,
  `WHATSAPP_NUMBER` varchar(255) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL,
  `CONFIRM_PASSWORD` varchar(255) DEFAULT NULL,
  `RESGISTED_DATE_TIME` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`S_ID`, `EMAIL`, `FULL_NAME`, `GRADE`, `DISTRICT`, `CITY`, `CONTACT_NUMBER`, `WHATSAPP_NUMBER`, `PASSWORD`, `CONFIRM_PASSWORD`, `RESGISTED_DATE_TIME`) VALUES
(146, 'ANONYMOUS_1@anonymous.login', 'ANONYMOUS_1', 'AL', 'Jaffna', 'Urumpirai', '2473654638', '9808442249', 'ANONYMOUS_1 LOGIN_SESSION', 'ANONYMOUS_1 LOGIN_SESSION', '2022-03-24 02:17:12'),
(147, 'ANONYMOUS_147@anonymous.login', 'ANONYMOUS_147', 'AL', 'Kurunegala', 'Kurunegala', '8065408048', '4116014085', 'ANONYMOUS_147 LOGIN_SESSION', 'ANONYMOUS_147 LOGIN_SESSION', '2022-03-24 02:19:40'),
(148, 'ANONYMOUS_148@anonymous.login', 'ANONYMOUS_148', 'AL', 'Kalutara', 'Maggona', '5979937177', '9888091628', 'ANONYMOUS_148 LOGIN_SESSION', 'ANONYMOUS_148 LOGIN_SESSION', '2022-03-24 02:20:21'),
(149, 'ANONYMOUS_149@anonymous.login', 'ANONYMOUS_149', 'AL', 'Jaffna', 'Urumpirai', '8720856750', '1421294549', 'ANONYMOUS_149 LOGIN_SESSION', 'ANONYMOUS_149 LOGIN_SESSION', '2022-03-24 02:21:05'),
(150, 'pasindu@gmail.com', 'Pasindu Shanuka', 'grade_8', 'Mannar', 'Mannar', '0711323889', '0712354321', 'pasindu123', 'pasindu123', '2022-03-24 02:23:32'),
(151, 'ANONYMOUS_151@anonymous.login', 'ANONYMOUS_151', 'grade_6', 'Mathara', 'Akuressa', '8344168447', '8047878118', 'ANONYMOUS_151 LOGIN_SESSION', 'ANONYMOUS_151 LOGIN_SESSION', '2022-03-24 02:25:38'),
(152, 'ANONYMOUS_152@anonymous.login', 'ANONYMOUS_152', 'grade_6', 'Mathara', 'Bengamuwa', '9476687653', '8849920435', 'ANONYMOUS_152 LOGIN_SESSION', 'ANONYMOUS_152 LOGIN_SESSION', '2022-03-24 02:26:42'),
(153, 'ANONYMOUS_153@anonymous.login', 'ANONYMOUS_153', 'grade_6', 'Mathara', 'Deiyandara', '2532142734', '8820161477', 'ANONYMOUS_153 LOGIN_SESSION', 'ANONYMOUS_153 LOGIN_SESSION', '2022-03-24 02:27:48'),
(154, 'ANONYMOUS_154@anonymous.login', 'ANONYMOUS_154', 'grade_6', 'Mathara', 'Hakmana', '1277816465', '8233293748', 'ANONYMOUS_154 LOGIN_SESSION', 'ANONYMOUS_154 LOGIN_SESSION', '2022-03-24 02:28:34'),
(155, 'menuka@gmail.com', 'Menuka Sandeepa', 'AL', 'Colombo', 'Piliyandala', '0711323889', '0765588456', 'menuka123', 'menuka123', '2022-03-24 02:30:47'),
(156, 'ANONYMOUS_156@anonymous.login', 'ANONYMOUS_156', 'AL', 'Mathara', 'Mirissa', '8714742845', '9764416600', 'ANONYMOUS_156 LOGIN_SESSION', 'ANONYMOUS_156 LOGIN_SESSION', '2022-03-24 02:36:17'),
(157, 'ANONYMOUS_157@anonymous.login', 'ANONYMOUS_157', 'OL', 'Gampaha', 'Kadawatha', '1858759765', '3346876666', 'ANONYMOUS_157 LOGIN_SESSION', 'ANONYMOUS_157 LOGIN_SESSION', '2022-03-24 02:43:11'),
(158, 'ANONYMOUS_158@anonymous.login', 'ANONYMOUS_158', 'OL', 'Colombo', 'Athurugiriya', '1800488262', '3096534810', 'ANONYMOUS_158 LOGIN_SESSION', 'ANONYMOUS_158 LOGIN_SESSION', '2022-03-24 02:57:23'),
(159, 'pawanvikasitha2001@gmail.com', 'Baada test ', 'grade_7', 'Colombo', 'Ambuldeniya', '0711323889', '0756377858', 'whatever', 'whatever', '2022-03-24 03:04:40'),
(161, 'othraemail@gmail.com', 'Bari', 'OL', 'Badulla', 'Welimada', '0711323889', '0711323889', '12345678', '12345678', '2022-03-24 03:08:25'),
(162, 'othraemail2@gmail', 'Sadaruwan ', 'grade_7', 'Mathara', 'Karadippokku', '0711323889', '0711323889', 'abcd1234', 'abcd1234', '2022-03-24 03:11:02'),
(163, 'lakmal@gmail.com', 'Lakmal Pathirana', 'grade_8', 'Anuradhapura', 'Awukana', '0711323889', '0765588456', 'lakmal123', 'lakmal123', '2022-03-24 13:07:20'),
(164, 'ANONYMOUS_164@anonymous.login', 'ANONYMOUS_164', 'grade_9', 'Colombo', 'Arangala', '7492861739', '7698172791', 'ANONYMOUS_164 LOGIN_SESSION', 'ANONYMOUS_164 LOGIN_SESSION', '2022-03-24 13:08:27'),
(165, 'sandun@gmail.com', 'Sandun Mihiranga', 'grade_8', 'Mullaitivu', 'Mankulam', '0711323889', '0765588456', 'sandun123', 'sandun123', '2022-03-24 13:10:21'),
(166, 'ANONYMOUS_166@anonymous.login', 'ANONYMOUS_166', 'grade_7', 'Kegalle', 'Warakapola', '4004770444', '6138074432', 'ANONYMOUS_166 LOGIN_SESSION', 'ANONYMOUS_166 LOGIN_SESSION', '2022-03-24 18:11:42'),
(167, 'keshara@gmail.com', 'Keshara Abiman', 'AL', 'Trincomalee', 'Trincomalee', '0711323889', '0711323889', 'keshara123', 'keshara123', '2022-03-24 18:12:53'),
(168, 'ANONYMOUS_168@anonymous.login', 'ANONYMOUS_168', 'grade_8', 'Ratnapura', 'Eheliyagoda', '5495107081', '2313459263', 'ANONYMOUS_168 LOGIN_SESSION', 'ANONYMOUS_168 LOGIN_SESSION', '2022-03-24 18:13:39'),
(169, 'anosha@gmail.com', 'Anosha madushani', 'grade_9', 'Kandy', 'Gelioya', '0711323889', '0758844665', 'anosha123', 'anosha123', '2022-03-24 18:15:05'),
(170, 'ANONYMOUS_170@anonymous.login', 'ANONYMOUS_170', 'grade_7', 'Matale', 'Dambulla', '2377618123', '6953814057', 'ANONYMOUS_170 LOGIN_SESSION', 'ANONYMOUS_170 LOGIN_SESSION', '2022-03-24 18:29:45'),
(171, 'gimantha@gmail.com', 'Gimantha Rajapaksha', 'OL', 'Badulla', 'Welimada', '0711323889', '0784565778', 'gimantha123', 'gimantha123', '2022-03-24 18:31:04'),
(172, 'ANONYMOUS_172@anonymous.login', 'ANONYMOUS_172', 'AL', 'Hambantota', 'Weligatta', '8748227020', '5510058630', 'ANONYMOUS_172 LOGIN_SESSION', 'ANONYMOUS_172 LOGIN_SESSION', '2022-03-24 18:55:16'),
(173, 'ANONYMOUS_173@anonymous.login', 'ANONYMOUS_173', 'OL', 'Matale', 'Dambulla', '3349811694', '8499875883', 'ANONYMOUS_173 LOGIN_SESSION', 'ANONYMOUS_173 LOGIN_SESSION', '2022-03-24 18:56:32'),
(174, 'ANONYMOUS_174@anonymous.login', 'ANONYMOUS_174', 'grade_9', 'Kalutara', 'Kalutara', '6300314687', '2409548874', 'ANONYMOUS_174 LOGIN_SESSION', 'ANONYMOUS_174 LOGIN_SESSION', '2022-03-25 00:31:46'),
(175, 'ANONYMOUS_175@anonymous.login', 'ANONYMOUS_175', 'AL', 'Gampaha', 'Kadawatha', '1919664253', '3383687122', 'ANONYMOUS_175 LOGIN_SESSION', 'ANONYMOUS_175 LOGIN_SESSION', '2022-03-25 03:40:30'),
(176, 'ANONYMOUS_176@anonymous.login', 'ANONYMOUS_176', 'AL', 'Kegalle', 'Ruwanwella', '7188754940', '3449252514', 'ANONYMOUS_176 LOGIN_SESSION', 'ANONYMOUS_176 LOGIN_SESSION', '2022-03-25 04:05:38'),
(177, 'ANONYMOUS_177@anonymous.login', 'ANONYMOUS_177', 'AL', 'Matale', '', '4115958562', '3651315896', 'ANONYMOUS_177 LOGIN_SESSION', 'ANONYMOUS_177 LOGIN_SESSION', '2022-03-25 04:07:41'),
(178, 'ANONYMOUS_178@anonymous.login', 'ANONYMOUS_178', 'AL', 'Ratnapura', '', '1435687994', '5279743331', 'ANONYMOUS_178 LOGIN_SESSION', 'ANONYMOUS_178 LOGIN_SESSION', '2022-03-25 04:08:46');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `T_ID` int NOT NULL,
  `FNAME` varchar(255) NOT NULL,
  `SNAME` varchar(255) DEFAULT NULL,
  `Age` int DEFAULT NULL,
  `ID_NUM` varchar(12) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `PHONE_NUMBER` char(10) DEFAULT NULL,
  `WHATSAPP_NUMBER` char(10) DEFAULT NULL,
  `EDU_LEVEL` varchar(255) DEFAULT NULL,
  `UNIVERSITY` varchar(255) DEFAULT NULL,
  `GARDUATED_YEAR` varchar(255) DEFAULT NULL,
  `TEACHING_SINCE` varchar(255) DEFAULT NULL,
  `AMOUNT_SUBJECTS` int DEFAULT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `CONFIRM_PASSWORD` varchar(255) NOT NULL,
  `ADDITIONAL_DETAILS` varchar(255) DEFAULT NULL,
  `CLASS_TYPE_INPUT` varchar(255) NOT NULL,
  `REGISTERED_TIME` datetime DEFAULT NULL,
  `JOINED_YEAR` year DEFAULT NULL,
  `JOINED_TIME` datetime DEFAULT NULL,
  `IMAGE_NAME` varchar(255) DEFAULT 'no user.png',
  `IMAGE` longtext,
  `FACEBOOK_LINK` varchar(255) DEFAULT NULL,
  `YOUTUBE_LINK` varchar(255) DEFAULT NULL,
  `WEBSITE_LINK` varchar(255) DEFAULT NULL,
  `GENDER` varchar(255) DEFAULT NULL,
  `TEACH_IN_SCHOOL` varchar(255) DEFAULT NULL,
  `LANGUAGES` varchar(255) DEFAULT NULL,
  `MOTTO` varchar(255) DEFAULT NULL,
  `SUBJECTS_ON_DATABASE` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`T_ID`, `FNAME`, `SNAME`, `Age`, `ID_NUM`, `EMAIL`, `PHONE_NUMBER`, `WHATSAPP_NUMBER`, `EDU_LEVEL`, `UNIVERSITY`, `GARDUATED_YEAR`, `TEACHING_SINCE`, `AMOUNT_SUBJECTS`, `PASSWORD`, `CONFIRM_PASSWORD`, `ADDITIONAL_DETAILS`, `CLASS_TYPE_INPUT`, `REGISTERED_TIME`, `JOINED_YEAR`, `JOINED_TIME`, `IMAGE_NAME`, `IMAGE`, `FACEBOOK_LINK`, `YOUTUBE_LINK`, `WEBSITE_LINK`, `GENDER`, `TEACH_IN_SCHOOL`, `LANGUAGES`, `MOTTO`, `SUBJECTS_ON_DATABASE`) VALUES
(92, 'Pawan', 'Vikasitha', 21, '200127201698', 'pawanvikasitha2001@gmail.com', '0755487446', '0711323889', 'Advanced Level', 'Ananda College', '2020', '2017', 5, 'dragonmaster04@', 'dragonmaster04@', '', 'Physical', '2022-01-26 17:25:09', 2022, '2022-02-06 20:17:55', 'IMG-20201102-WA0040-modified.png', NULL, 'https://www.facebook.com/groups/studentsofbhanukaekanayakasir', 'https://www.youtube.com/watch?v=BBAyRBTfsOU&ab_channel=T-Series', 'www.zooma.ezyro.com', 'Male', 'Yes', 'Sinhala / English / ', '', 5),
(105, 'මහිම්', 'මන්තිල', 20, '200578456654', 'mahimmanthila@gmail.com', '0746574515', '0723213546', 'Doctarated', 'University of Harward England', '2005', '2001', 1, 'mahim123', 'mahim123', '', 'Online', '2022-01-29 22:12:29', 2022, '2022-01-29 22:13:39', 'photo_2022-01-29_22-32-23.jpg', NULL, 'https://www.facebook.com/groups/studentsofbhanukaekanayakasir', 'https://www.youtube.com/watch?v=BBAyRBTfsOU&ab_channel=T-Series', 'www.zooma.ezyro.com', 'Male', 'Yes', 'Sinhala / English / Tamil', '', 1),
(106, 'Luna', 'Daniel', 35, '854565436146', 'luna@gmail.com', '0756545112', '0756512445', 'BET(Upper Hons.)', 'Univeristy of Sri Jayawardanapura', '1999', '2001', 10, 'luna123', 'luna123', '', 'Both', '2022-01-29 23:15:07', 2022, '2022-01-29 23:16:04', 'photo_2021-12-25_17-08-47.jpg', NULL, 'https://www.facebook.com/dialog/close/', 'https://www.youtube.com/shorts/6l7sfhAFQ8M?&ab_channel=PiXimperfect', 'https://www.w3schools.com/sql/sql_count_avg_sum.asp', 'Female', 'Yes', 'Sinhala / English / ', '', 0),
(107, 'කවිඳු', 'මල්ෂාන්', 20, '212121456465', 'kavindumalshan@gmail.com', '0768754112', '0765454545', 'BICT (Software Technology)', 'ESOFT', '2020', '2020', 1, 'kavindu123', 'kavindu123', '', 'Online', '2022-01-30 02:22:14', 2022, '2022-01-30 02:23:22', 'photo_2022-01-30_02-26-03.jpg', NULL, 'www.facebook.com/KavinduMalshan', 'youtube/malshan', 'www.malshan.kavinidu.com', 'Male', 'No', 'Sinhala /  / ', '', 0),
(108, 'ගයේෂ්', 'දේවරාජ', 20, '200545713575', 'gayesh@gmail.com', '0756545523', '0784165413', 'Doctarated', 'National University of Germany', '2024', '2000', 5, 'gayesh123', 'gayesh123', '', 'Both', '2022-01-30 14:19:24', 2022, '2022-01-30 14:20:06', 'photo_2022-01-30_14-32-52.jpg', NULL, 'www.facebook.com/GayeshDewaraja', 'www.youtube.com/Gayesh_dewaraja', 'www.gayesh.slt.gov.net', 'Male', 'Yes', 'Sinhala / English / ', 'හෙළ බස උගනිමු', 2),
(109, 'තරුෂ', 'දම්සක්', 20, '213241648798', 'tharushadamsak@gmail.com', '0784557788', '0784565778', 'Masterd in Computer Science', 'University of NIBM', '2022', '2017', 2, 'tharusha123', 'tharusha123', '', 'Online', '2022-01-30 14:17:48', 2022, '2022-01-30 14:20:11', 'no user.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2),
(110, 'ග්‍රේස්', 'ලෝලා', 25, '954564562131', 'grace@gmail.com', '0754564545', '0751623468', 'BSc (Mechanical Engineer)', 'University of Harward', '2024', '2001', 4, 'grace123', 'grace123', '', 'Physical', '2022-01-30 14:37:25', 2022, '2022-01-30 14:41:04', 'photo_2022-01-30_14-34-27.jpg', NULL, '', '', '', 'Female', 'Yes', 'Sinhala / English / Tamil', '', 0),
(113, 'Aravinda', 'Sampath', 20, '254645454546', 'aravindasampath@gmail.com', '0711323889', '0711323889', 'Doctarated', 'University of Oxford', '2001', '2000', 10, 'ara123', 'ara123', '', 'Physical', '2022-02-06 20:20:17', 2022, '2022-02-06 20:20:53', 'photo_2021-10-09_14-19-23.jpg', NULL, 'https://www.facebook.com/groups/studentsofbhanukaekanayakasir', 'https://www.youtube.com/watch?v=BBAyRBTfsOU&ab_channel=T-Series', 'www.zooma.ezyro.com', 'Male', 'Yes', 'Sinhala / English / ', 'ලැල්ලක් වැනි කෑල්ලක් ඇත', 1),
(114, 'Chalana', 'Dulakshana', 20, '201216546546', 'chalana@gmail.com', '0711323889', '0784565778', 'Masters', 'University of Oxford', '2025', '2001', 2, 'chalana123', 'chalana123', '', 'Online', '2022-02-08 11:44:23', 2022, '2022-02-08 11:52:33', 'no user.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(115, 'Thamesh', 'Jayawardana', 20, '205651654654', 'thamesh@gmail.com', '0711323889', '0711323889', 'Doctarated', 'Kothalawala Defense University ', '2025', '2017', 2, 'thamesh123', 'thamesh123', '', 'Both', '2022-02-07 16:55:17', 2022, '2022-02-08 11:52:42', 'no user.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(116, 'Tu', 'Sueño', 16, '200545968654', 'tusueno@gmail.com', '0711323656', '0746546854', 'Masterd', 'University of Turkey', '2020', '2017', 10, 'tusueno123', 'tusueno123', '', 'Physical', '2022-02-09 12:01:55', 2022, '2022-02-09 12:19:30', 'photo_2022-02-10_22-28-42.jpg', NULL, '', '', '', 'Male', 'Yes', 'Sinhala / English / ', 'Not now? Then Never ever you not gonna do it. So if you are looking for an interesting class? Then this will be the best one ever. I can guarantee it for you.', 10),
(228, 'Jinethra', 'Dahami', 21, '200154654684', 'jinethra@gmail.com', '0711323889', '0784565778', 'BSc (Upper.) ', 'University of Harward - England', '2014', '2001', 10, 'jinethra123', 'jinethra123', '', 'Online', '2022-03-13 21:55:43', 2022, '2022-03-13 21:55:43', 'no user.png', NULL, 'https://www.facebook.com/groups/studentsofbhanukaekanayakasir', 'https://www.youtube.com/watch?v=BBAyRBTfsOU&ab_channel=T-Series', 'www.zooma.ezyro.com', 'Female', 'Yes', 'Sinhala / English / ', 'Sakaskada noki kata uge kata hubas kata', 8),
(229, 'Malindu', '(Chukki)', 9, '201354332132', 'malindu@gmail.com', '0784557788', '0784565778', 'A/L and O/L', 'Piliyandala Central College', '2017', '2004', 10, 'malindu123', 'malindu123', '', 'Both', '2022-03-16 17:02:59', 2022, '2022-03-16 17:05:34', '04.png', '', 'www.facebook.com/groups/studentsofbhanukaekanayakasir', 'www.youtube.com/watch?v=JfrUNqYNwUg', 'www.malshan.kavinidu.com', 'Male', 'Yes', 'Sinhala /  / ', 'you gotta go now', 2),
(231, 'Janith', 'Dewapriya', 22, '200011701809', 'dewapriyajanith@gmail.com', '0716231345', '0716231345', 'N/A', 'N/A', '', '2020', 3, 'JanithDewa', 'JanithDewa', 'කොහේ ගියත් එන්න වෙන්නේ මෙතනට', 'Both', '2022-03-24 05:21:52', 2022, '2022-03-25 01:39:45', 'no user.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(232, 'Thisara', 'Dilshan', 21, '200154525154', 'thisa@gmail.com', '0711323889', '0711323889', 'Doctarated', 'University of Oxford', '2014', '2017', 10, 'thisara123', 'thisara123', '', 'Online', '2022-03-21 16:26:32', 2022, '2022-03-25 01:40:11', 'no user.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(234, 'Umeesha ', 'Wanasigha', 18, '200465475462', 'umeesha@gmail.com', '0711323889', '0784565778', 'BET(Upper Hons.)', 'University of Harward England', '2005', '2017', 10, 'savinduhansaja', 'savinduhansaja', '', 'Online', '2022-03-25 03:02:58', 2022, '2022-03-25 03:02:58', 'no user.png', NULL, 'www.facebook.com/KavinduMalshan', 'https://www.youtube.com/c/HelloHelloSriLanka/videos?&ab_channel=HelloHello', 'www.gayesh.slt.gov.net', 'Female', 'Yes', 'Sinhala / English / ', '', 0),
(235, 'Jayani', 'Arunika', 21, '200178954654', 'arunika@gmail.com', '0711323889', '0758844665', 'Masters', 'University of Jaffna', '2018', '2001', 2, 'arunika123', 'arunika123', '', 'Both', '2022-03-25 03:05:59', 2022, '2022-03-25 03:05:59', 'no user.png', NULL, '', '', '', 'Female', 'Yes', 'Sinhala / English / ', '', 0),
(236, 'Shenil', 'Daniel', 21, '200154567874', 'daniel@gmail.com', '0745687899', '0784154654', 'Hons Degree in broadcasting ', 'University of Moratuwa', '2015', '2020', 5, 'daniyel12', 'daniyel12', '', 'Online', '2022-03-21 17:48:57', 2022, '2022-03-25 03:08:02', 'no user.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(237, 'Sandali', 'Geethma', 18, '200415261613', 'sandali@gmail.com', '0711323889', '0711323889', 'Doctarated', 'Univeristy of Peradeniya', '2004', '2001', 10, 'sandali123', 'sandali123', '', 'Online', '2022-03-21 16:12:55', 2022, '2022-03-25 03:09:10', 'no user.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(238, 'Navindu', 'Nishantha', 21, '200123215645', 'navindu@gmail.com', '0711323889', '0711323889', 'Masters', 'University of Harward England', '2025', '2000', 10, 'navindu123', 'navindu123', '', 'Online', '2022-03-25 03:16:16', 2022, '2022-03-25 03:17:37', 'photo_2022-03-18_00-45-53.jpg', NULL, '', '', '', 'Male', 'Yes', 'Sinhala / English / ', '', 0),
(239, 'Supun', 'Karunarathna', 26, '965355736V', 'srregi@gmail.com', '0773482562', '0773482562', 'Master', 'NIBM', '2009', '2011', 5, 'SupunKaru', 'SupunKaru', 'gahuwoth gahanwa', 'Physical', '2022-03-25 03:47:46', 2022, '2022-03-25 03:52:22', 'no user.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teachers_under_review`
--

CREATE TABLE `teachers_under_review` (
  `FNAME` varchar(255) DEFAULT NULL,
  `SNAME` varchar(255) DEFAULT NULL,
  `AGE` varchar(255) DEFAULT NULL,
  `ID_NUM` varchar(12) NOT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `PHONE_NUMBER` varchar(255) DEFAULT NULL,
  `WHATSAPP_NUMBER` varchar(255) DEFAULT NULL,
  `EDU_LEVEL` varchar(255) DEFAULT NULL,
  `UNIVERSITY` varchar(255) DEFAULT NULL,
  `GARDUATED_YEAR` varchar(255) DEFAULT NULL,
  `TEACHING_SINCE` varchar(255) DEFAULT NULL,
  `AMOUNT_SUBJECTS` varchar(255) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL,
  `CONFIRM_PASSWORD` varchar(255) DEFAULT NULL,
  `ADDITIONAL_DETAILS` varchar(255) DEFAULT NULL,
  `CLASS_TYPE_INPUT` varchar(255) DEFAULT NULL,
  `DATE_TIME` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers_under_review`
--

INSERT INTO `teachers_under_review` (`FNAME`, `SNAME`, `AGE`, `ID_NUM`, `EMAIL`, `PHONE_NUMBER`, `WHATSAPP_NUMBER`, `EDU_LEVEL`, `UNIVERSITY`, `GARDUATED_YEAR`, `TEACHING_SINCE`, `AMOUNT_SUBJECTS`, `PASSWORD`, `CONFIRM_PASSWORD`, `ADDITIONAL_DETAILS`, `CLASS_TYPE_INPUT`, `DATE_TIME`) VALUES
('Savinu', 'Hansaja', '20', '200127201698', 'sandchz@hotmail.com', '0721545778', '0784565778', '', '', '', '', '', 'savinduhansaja', 'savinduhansaja', '', 'Online', '2022-02-12 18:43:36'),
('Shan', 'Vimukthi', '18', '200412312132', 'vima@gmail.com', '0712412123', '0712354321', 'Doctarated', 'University of Sri Jayawardanapura', '2000', '2001', '10', 'vima123456', 'vima123456', '', 'Online', '2022-03-22 03:49:10'),
('Anjana', 'Kalhara', '18', '200453621321', 'anjana@gmail.com', '0711323889', '0758844665', 'Higer Education in University of London', 'University oif London - England', '2014', '2017', '5', 'anjana123', 'anjana123', 'Nothing/./!', 'Online', '2022-03-21 02:21:50'),
('Buddhika Oshadha ', 'Uduwaraarachchi ', '17', '200512313132', 'Uduwaraarachchi@gmail.com', '0711323889', '0784565778', 'Honors degree in Physics, A demonstrator in physics at the University of Kelaniya', 'University of Kelaniya', '2005', '2017', '', 'Uduwaraarachchi123', 'Uduwaraarachchi123', '', 'Physical', '2022-03-21 02:09:06'),
('Lakindu', 'Bimsara', '11', '201112312132', 'lakindu@gmail.com', '0711323889', '0711323889', '', '', '', '2001', '10', 'lakindu123', 'lakindu123', '', 'Online', '2022-03-21 01:57:06'),
('Bhanusha', 'Sampath', '21', '416161321321', 'bhanushabilinda@gmail.com', '0744564521', '0715645465', 'A/L', 'University of Oxford', '2020', '2001', '5', 'bhanusha123', 'bhanusha123', '', 'Online', '2022-03-12 19:58:51'),
('Sudew', 'Deshan', '77', '456655880V', 'sudew@gmail.com', '0711323889', '0711323889', '', '', '', '', '10', 'sudew123456789', 'sudew123456789', '', 'Physical', '2022-03-21 16:36:41'),
('Bhanusha', 'Milinda', '54', '54845622V', 'pawanvikasitha2001@gmail.com', '0711323889', '', 'Doctarated', 'University of Harward England', '2018', '', '', 'MARUWA123', 'MARUWA123', '', 'Online', '2022-03-21 02:14:31');

-- --------------------------------------------------------

--
-- Table structure for table `time_table_of_teachers`
--

CREATE TABLE `time_table_of_teachers` (
  `T_ID` int NOT NULL,
  `HOW_MANY_SUBJECTS_IN_DATABASE` int DEFAULT '0',
  `GRADE__1` text,
  `SUBJECT__1` text,
  `BATCH__1` text,
  `CLASS_DATE__1` text,
  `CLASS_BEGIN__1` text,
  `CLASS_END__1` text,
  `HOW_CLASS_DO__1` text,
  `DISTRICT__1` text,
  `CITY__1` text,
  `INSTITUTE__1` varchar(999) DEFAULT NULL,
  `LANGUAGES__1` text,
  `CLASS_TYPE__1` text,
  `GRADE__2` text,
  `SUBJECT__2` text,
  `BATCH__2` text,
  `CLASS_DATE__2` text,
  `CLASS_BEGIN__2` text,
  `CLASS_END__2` text,
  `HOW_CLASS_DO__2` text,
  `DISTRICT__2` text,
  `CITY__2` text,
  `INSTITUTE__2` varchar(255) DEFAULT NULL,
  `LANGUAGES__2` text,
  `CLASS_TYPE__2` text,
  `GRADE__3` text,
  `SUBJECT__3` text,
  `BATCH__3` text,
  `CLASS_DATE__3` text,
  `CLASS_BEGIN__3` text,
  `CLASS_END__3` text,
  `HOW_CLASS_DO__3` text,
  `DISTRICT__3` text,
  `CITY__3` text,
  `INSTITUTE__3` varchar(255) DEFAULT NULL,
  `LANGUAGES__3` text,
  `CLASS_TYPE__3` text,
  `GRADE__4` text,
  `SUBJECT__4` text,
  `BATCH__4` text,
  `CLASS_DATE__4` text,
  `CLASS_BEGIN__4` text,
  `CLASS_END__4` text,
  `HOW_CLASS_DO__4` text,
  `DISTRICT__4` text,
  `CITY__4` text,
  `INSTITUTE__4` varchar(255) DEFAULT NULL,
  `LANGUAGES__4` text,
  `CLASS_TYPE__4` text,
  `GRADE__5` text,
  `SUBJECT__5` text,
  `BATCH__5` text,
  `CLASS_DATE__5` text,
  `CLASS_BEGIN__5` text,
  `CLASS_END__5` text,
  `HOW_CLASS_DO__5` text,
  `DISTRICT__5` text,
  `CITY__5` text,
  `INSTITUTE__5` varchar(255) DEFAULT NULL,
  `LANGUAGES__5` text,
  `CLASS_TYPE__5` text,
  `GRADE__6` text,
  `SUBJECT__6` text,
  `BATCH__6` text,
  `CLASS_DATE__6` text,
  `CLASS_BEGIN__6` text,
  `CLASS_END__6` text,
  `HOW_CLASS_DO__6` text,
  `DISTRICT__6` text,
  `CITY__6` text,
  `INSTITUTE__6` varchar(255) DEFAULT NULL,
  `LANGUAGES__6` text,
  `CLASS_TYPE__6` text,
  `GRADE__7` text,
  `SUBJECT__7` text,
  `BATCH__7` text,
  `CLASS_DATE__7` text,
  `CLASS_BEGIN__7` text,
  `CLASS_END__7` text,
  `HOW_CLASS_DO__7` text,
  `DISTRICT__7` text,
  `CITY__7` text,
  `INSTITUTE__7` varchar(255) DEFAULT NULL,
  `LANGUAGES__7` text,
  `CLASS_TYPE__7` text,
  `GRADE__8` text,
  `SUBJECT__8` text,
  `BATCH__8` text,
  `CLASS_DATE__8` text,
  `CLASS_BEGIN__8` text,
  `CLASS_END__8` text,
  `HOW_CLASS_DO__8` text,
  `DISTRICT__8` text,
  `CITY__8` text,
  `INSTITUTE__8` varchar(255) DEFAULT NULL,
  `LANGUAGES__8` text,
  `CLASS_TYPE__8` text,
  `GRADE__9` text,
  `SUBJECT__9` text,
  `BATCH__9` text,
  `CLASS_DATE__9` text,
  `CLASS_BEGIN__9` text,
  `CLASS_END__9` text,
  `HOW_CLASS_DO__9` text,
  `DISTRICT__9` text,
  `CITY__9` text,
  `INSTITUTE__9` varchar(255) DEFAULT NULL,
  `LANGUAGES__9` text,
  `CLASS_TYPE__9` text,
  `GRADE__10` text,
  `SUBJECT__10` text,
  `BATCH__10` text,
  `CLASS_DATE__10` text,
  `CLASS_BEGIN__10` text,
  `CLASS_END__10` text,
  `HOW_CLASS_DO__10` text,
  `DISTRICT__10` text,
  `CITY__10` text,
  `INSTITUTE__10` varchar(255) DEFAULT NULL,
  `LANGUAGES__10` text,
  `CLASS_TYPE__10` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `time_table_of_teachers`
--

INSERT INTO `time_table_of_teachers` (`T_ID`, `HOW_MANY_SUBJECTS_IN_DATABASE`, `GRADE__1`, `SUBJECT__1`, `BATCH__1`, `CLASS_DATE__1`, `CLASS_BEGIN__1`, `CLASS_END__1`, `HOW_CLASS_DO__1`, `DISTRICT__1`, `CITY__1`, `INSTITUTE__1`, `LANGUAGES__1`, `CLASS_TYPE__1`, `GRADE__2`, `SUBJECT__2`, `BATCH__2`, `CLASS_DATE__2`, `CLASS_BEGIN__2`, `CLASS_END__2`, `HOW_CLASS_DO__2`, `DISTRICT__2`, `CITY__2`, `INSTITUTE__2`, `LANGUAGES__2`, `CLASS_TYPE__2`, `GRADE__3`, `SUBJECT__3`, `BATCH__3`, `CLASS_DATE__3`, `CLASS_BEGIN__3`, `CLASS_END__3`, `HOW_CLASS_DO__3`, `DISTRICT__3`, `CITY__3`, `INSTITUTE__3`, `LANGUAGES__3`, `CLASS_TYPE__3`, `GRADE__4`, `SUBJECT__4`, `BATCH__4`, `CLASS_DATE__4`, `CLASS_BEGIN__4`, `CLASS_END__4`, `HOW_CLASS_DO__4`, `DISTRICT__4`, `CITY__4`, `INSTITUTE__4`, `LANGUAGES__4`, `CLASS_TYPE__4`, `GRADE__5`, `SUBJECT__5`, `BATCH__5`, `CLASS_DATE__5`, `CLASS_BEGIN__5`, `CLASS_END__5`, `HOW_CLASS_DO__5`, `DISTRICT__5`, `CITY__5`, `INSTITUTE__5`, `LANGUAGES__5`, `CLASS_TYPE__5`, `GRADE__6`, `SUBJECT__6`, `BATCH__6`, `CLASS_DATE__6`, `CLASS_BEGIN__6`, `CLASS_END__6`, `HOW_CLASS_DO__6`, `DISTRICT__6`, `CITY__6`, `INSTITUTE__6`, `LANGUAGES__6`, `CLASS_TYPE__6`, `GRADE__7`, `SUBJECT__7`, `BATCH__7`, `CLASS_DATE__7`, `CLASS_BEGIN__7`, `CLASS_END__7`, `HOW_CLASS_DO__7`, `DISTRICT__7`, `CITY__7`, `INSTITUTE__7`, `LANGUAGES__7`, `CLASS_TYPE__7`, `GRADE__8`, `SUBJECT__8`, `BATCH__8`, `CLASS_DATE__8`, `CLASS_BEGIN__8`, `CLASS_END__8`, `HOW_CLASS_DO__8`, `DISTRICT__8`, `CITY__8`, `INSTITUTE__8`, `LANGUAGES__8`, `CLASS_TYPE__8`, `GRADE__9`, `SUBJECT__9`, `BATCH__9`, `CLASS_DATE__9`, `CLASS_BEGIN__9`, `CLASS_END__9`, `HOW_CLASS_DO__9`, `DISTRICT__9`, `CITY__9`, `INSTITUTE__9`, `LANGUAGES__9`, `CLASS_TYPE__9`, `GRADE__10`, `SUBJECT__10`, `BATCH__10`, `CLASS_DATE__10`, `CLASS_BEGIN__10`, `CLASS_END__10`, `HOW_CLASS_DO__10`, `DISTRICT__10`, `CITY__10`, `INSTITUTE__10`, `LANGUAGES__10`, `CLASS_TYPE__10`) VALUES
(92, 0, 'OL', 'Home Economics', 'All', 'Monday', '00:31', '12:13', 'physical', 'Nuwara Eliya', 'Bulathkohupitiya', 'Bogawanthalawa - Jazz', 'Sinhala / English / ', 'Medium Class (Group Class)', 'OL', 'Sinhala Language & Literature', '2023 Theory', 'Friday', '00:31', '16:05', 'both', 'Colombo', 'Athurugiriya', 'ZipZone - Athurugiriya', 'Sinhala /  / ', 'Medium Class (Group Class)', 'OL', 'Mathematics', 'All', 'Monday', '10:00', '22:10', 'physical', 'Colombo', 'Battaramulla', 'LAS - Battaramulla', 'Sinhala /  / ', 'Medium Class (Group Class)', 'OL', 'Geography', 'All', 'Thursday', '00:12', '12:12', 'physical', 'Colombo', 'Boralesgamuwa', 'Boralasgamuwa - Blazzer', 'Sinhala / English / Tamil', 'Medium Class (Group Class)', 'OL', 'Agriculture & Food Technology', 'All', 'Sunday', '02:30', '05:30', 'physical', 'Colombo', 'Battaramulla', 'LAS - Battaramulla', 'Sinhala /  / ', 'Medium Class (Group Class)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(113, 0, 'AL', 'Business Studies', 'All', 'Sunday', '00:22', '02:31', 'physical', 'Colombo', 'Athurugiriya', 'asdasdadasd', 'English /  / ', 'Medium Class (Group Class)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(116, 0, 'AL', 'SFT', '2022 Theory', 'Monday', '07:30', '13:30', 'physical', 'Colombo', 'Nugegoda', 'Rotary - Nugegoda', 'Sinhala /  / ', 'Medium Class (Group Class)', 'AL', 'SFT', '2022 Revision', 'Monday', '13:30', '17:30', 'physical', 'Colombo', 'Nugegoda', 'Rotary - Nugegoda', 'Sinhala /  / ', 'Medium Class (Group Class)', 'AL', 'SFT', '2023 Theory', 'Tuesday', '15:30', '17:30', 'physical', 'Colombo', 'Nugegoda', 'Sasip - Nugegoda', 'Sinhala /  / ', 'Medium Class (Group Class)', 'AL', 'SFT', '2023 Revision', 'Tuesday', '08:00', '10:00', 'physical', 'Colombo', 'Nugegoda', 'Sasip - Nugegoda', 'Sinhala /  / ', 'Medium Class (Group Class)', 'AL', 'SFT', '2024 Theory', 'Wednesday', '10:00', '12:00', 'physical', 'Kalutara', 'Horana', 'Sripali - Horana', 'Sinhala /  / ', 'Medium Class (Group Class)', 'AL', 'SFT', '2024 Revision', 'Wednesday', '13:00', '17:00', 'physical', 'Kalutara', 'Horana', 'Sripali - Horana', 'Sinhala /  / ', 'Medium Class (Group Class)', 'AL', 'BST', '2023 Papers', 'Saturday', '12:31', '02:13', 'online', 'Whole country', '', '', 'Sinhala /  / ', 'Medium Class (Group Class)', 'grade_6', 'Christianity', '2023 Theory', 'Thursday', '00:32', '12:31', 'physical', 'Polonnaruwa', 'Hingurakgoda', 'LAS - Battaramulla', 'Sinhala /  / ', 'Medium Class (Group Class)', 'AL', 'BST', '2023 Revision', 'Saturday', '12:31', '12:31', 'physical', 'Mullaitivu', 'Pudukudiyirippu', 'LAS - Battaramulla', 'Sinhala /  / ', 'Home Visit', 'AL', 'BST', '2023 Revision', 'Friday', '14:31', '13:13', 'physical', 'Mannar', 'Murunkan', 'LAS - Battaramulla', 'Sinhala /  / ', 'Home Visit'),
(228, 0, 'grade_9', 'Dancing', 'All', 'Wednesday', '12:31', '14:31', 'physical', 'Mathara', 'Dikwella', 'Dickwella Starts', 'Sinhala /  / ', 'Medium Class (Group Class)', 'OL', 'Eastern Music', 'All', 'Monday', '12:21', '02:12', 'physical', 'Colombo', 'Kalubowila', 'Kalubovila - Fanzx', 'Sinhala /  / ', 'Small Class (Mass Class)', 'grade_6', 'Buddhism', 'All', 'Monday', '00:12', '00:12', 'physical', 'Ratnapura', 'Parakaduwa', 'Rathnapura - Dizzers', 'Sinhala /  / ', 'Medium Class (Group Class)', 'grade_6', 'Christianity', 'All', 'Tuesday', '00:12', '00:12', 'physical', 'Gampaha', 'Dalugama', 'New Montana - Gampaha', 'Sinhala /  / ', 'Medium Class (Group Class)', 'AL', 'chemistry', '2024 Theory', 'Sunday', '00:12', '00:12', 'physical', 'Colombo', 'Rajagiriya', 'Rajagiriya Satscs2', 'Sinhala / English / ', 'Home Visit', 'AL', 'ICT', '2022 Theory', 'Wednesday', '08:00', '01:30', 'physical', 'Gampaha', 'Ekala', 'New Montana - Gampaha', 'Sinhala /  / ', 'Medium Class (Group Class)', 'AL', 'ICT', '2022 Revision', 'Wednesday', '13:30', '15:30', 'physical', 'Gampaha', 'Ekala', 'New Montana - Gampaha', 'Sinhala /  / ', 'Medium Class (Group Class)', 'AL', 'ICT', '2022 Papers', 'Wednesday', '15:30', '17:30', 'physical', 'Gampaha', 'Ekala', 'New Montana - Gampaha', 'Sinhala /  / ', 'Medium Class (Group Class)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(229, 0, 'OL', 'Art & Craft', 'All', 'Sunday', '14:31', '12:31', 'physical', 'Colombo', 'Piliyandala', 'Piliyandala - Chukz', 'Sinhala /  / ', 'Medium Class (Group Class)', 'OL', 'Home Economics', 'All', 'Tuesday', '12:31', '15:54', 'physical', 'Colombo', 'Piliyandala', 'Piliyandala - Chukz', 'Sinhala /  / ', 'Medium Class (Group Class)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(231, 0, 'AL', 'SFT', '2022 Theory', 'Monday', '08:30', '10:30', 'physical', 'Gampaha', 'Kandawala', 'Montana - Gampaha', 'Sinhala /  / ', 'Home Visit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`password`);

--
-- Indexes for table `contact_us_messages`
--
ALTER TABLE `contact_us_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`Mail_ID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`S_ID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`T_ID`),
  ADD UNIQUE KEY `ID_NUM` (`ID_NUM`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- Indexes for table `teachers_under_review`
--
ALTER TABLE `teachers_under_review`
  ADD PRIMARY KEY (`ID_NUM`);

--
-- Indexes for table `time_table_of_teachers`
--
ALTER TABLE `time_table_of_teachers`
  ADD PRIMARY KEY (`T_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_us_messages`
--
ALTER TABLE `contact_us_messages`
  MODIFY `message_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `Mail_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `S_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `T_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `time_table_of_teachers`
--
ALTER TABLE `time_table_of_teachers`
  ADD CONSTRAINT `time_table_of_teachers_ibfk_1` FOREIGN KEY (`T_ID`) REFERENCES `teachers` (`T_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
