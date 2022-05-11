-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2022 at 08:15 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `garagedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `idcar` varchar(255) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `typecar` text DEFAULT NULL,
  `engineoil` text DEFAULT NULL,
  `typefuel` text DEFAULT NULL,
  `coolant` text DEFAULT NULL,
  `airpressure` text DEFAULT NULL,
  `tiresize` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `username`, `idcar`, `year`, `typecar`, `engineoil`, `typefuel`, `coolant`, `airpressure`, `tiresize`) VALUES
(113, 'ahmad', '88-339-51', 2003, 'פולו', '15w30', 'סולר', 'אדום', '35', '285/15/14'),
(117, 'benshabbat', '55-444-55', 2020, 'טסלה', '15W30', '95', 'ירוק', '35', '18'),
(118, 'jbareen', '99-885-55', 2000, 'מאזדה', '5w-30', '95', 'ירוק', '33', '17'),
(119, 'miri', '22-333-22', 2020, 'יונדאי', '15W30', '95', 'ירוק', '36', '16'),
(121, 'golan', '88-339-52', 2003, 'Polo', '5W30', 'בנזין 95', 'אדום', '33PSI', '175/70R/14'),
(122, 'gogo', '132-33-488', 2021, 'מאזדה', '5W30', 'סולר', 'ירוק', '30', '185/17R/15'),
(124, 'yotam', '22-332-23', 2000, 'טסלה', '2321', '111', '11', '11', '111');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `fromU` text NOT NULL,
  `toU` text NOT NULL,
  `phone` text NOT NULL,
  `typeservice` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `date` text NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `fromU`, `toU`, `phone`, `typeservice`, `email`, `date`, `text`) VALUES
(105, 'benshabbat', 'admin', '050-2284238', 'טיפול', 'benshabbat27@gmail.com', 'Thursday 30th of December 2021 02:48:38 PM', 'אני צריך טיפול חודשי בבקשה'),
(106, 'admin', 'benshabbat', ' 050-5555555', 'הודעה', ' admin@gmail.com', 'Thursday 30th of December 2021 02:49:15 PM', 'קיבלתי אתה מוזמן להגיע'),
(107, 'admin', 'jbareen', ' 050-5555555', 'הודעה', ' admin@gmail.com', 'Sunday 2nd of January 2022 01:55:43 PM', 'ברוך הבא'),
(109, 'golan', 'admin', '050-1122334', 'תקלה', 'golan@gmail.com', 'Sunday 2nd of January 2022 05:19:22 PM', 'תודה'),
(110, 'admin', 'yotam', ' 050-5555555', 'הודעה', ' admin@gmail.com', 'Tuesday 4th of January 2022 12:56:46 PM', 'ברוך הבא למוסך הנגיש'),
(111, 'yotam', 'admin', '050-1111111', 'הודעה', 'yotaml@gmail.com', 'Tuesday 4th of January 2022 12:57:40 PM', 'תודה רבה על השירות'),
(112, 'jbareen', 'admin', '050-7825557', 'הודעה', 'jbareen005@gmail.com', 'Thursday 6th of January 2022 02:13:03 PM', 'תודה על השירות'),
(113, 'דוד', 'admin', '052-4447744', 'אורח', 'dd@gmail.com', 'Thursday 6th of January 2022 02:18:05 PM', 'היי ברצוני להגיע לטיפול'),
(114, 'admin', 'miri', ' 050-5555555', 'הודעה', ' admin@gmail.com', 'Tuesday 22nd of March 2022 06:53:12 PM', 'שלום\r\n\r\n'),
(115, 'admin', 'benshabbat', ' 050-5555555', 'הודעה', ' admin@gmail.com', 'Tuesday 22nd of March 2022 06:56:32 PM', 'תגיע לטיפול'),
(116, 'benshabbat', 'admin', '050-2284238', 'תקלה', 'benshabbat27@gmail.com', 'Tuesday 22nd of March 2022 08:38:16 PM', 'ג'),
(117, 'admin', 'golan', ' 050-5555555', 'הודעה', ' admin@gmail.com', 'Thursday 24th of March 2022 10:59:06 PM', 'גש לבדיקה בבקשה');

-- --------------------------------------------------------

--
-- Table structure for table `namecars`
--

CREATE TABLE `namecars` (
  `nameCars` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `namecars`
--

INSERT INTO `namecars` (`nameCars`, `id`) VALUES
('סובארו', 1),
('במוו', 2),
('אאודי', 3),
('יונדאי', 4),
('טויוטה', 5);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `idcar` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date` text NOT NULL,
  `typeservice` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `km` varchar(255) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `idcar`, `username`, `date`, `typeservice`, `phone`, `km`, `text`) VALUES
(30, '99-885-55', 'jbareen', 'Thursday 6th of January 2022 02:12:03 PM', 'תקלה', '050-7825557', '25000', 'בדיקה שגרתית'),
(31, '55-444-55', 'benshabbat', 'Thursday 6th of January 2022 02:19:30 PM', 'תקלה', '050-2284238', '10000', 'בדיקה שגרתית'),
(32, '88-339-51', 'ahmad', 'Thursday 6th of January 2022 02:21:13 PM', 'בדיקה', '050-7825556', '35000', 'בדיקה שגרתית'),
(40, '55-444-55', 'benshabbat', 'Wednesday 23rd of March 2022 08:23:19 AM', 'טיפול', '050-2284238', '555333', 'בוא לטיפול'),
(42, '55-444-55', 'benshabbat', 'Wednesday 23rd of March 2022 08:30:53 AM', 'בדיקה', '050-2284238', '555333', 'בדיקה'),
(43, '55-444-55', 'benshabbat', 'Wednesday 23rd of March 2022 08:38:06 AM', 'הודעה', '050-2284238', '555333', 'היי טופל'),
(44, '88-339-51', 'ahmad', 'Wednesday 23rd of March 2022 08:41:02 AM', 'תקלה', '050-7825556', '22555', 'פנצר'),
(47, '88-339-51', 'ahmad', 'Wednesday 23rd of March 2022 08:51:52 AM', 'הודעה', '050-7825556', '22555', 'טופל בפנצר'),
(48, '22-333-22', 'miri', 'Wednesday 23rd of March 2022 09:11:22 AM', 'טיפול', '058-4085081', '20000', 'שגרתי'),
(51, '99-885-55', 'jbareen', 'Wednesday 23rd of March 2022 11:10:31 AM', 'טיפול', '050-7825557', '30000', 'שגרתי'),
(56, '55-444-55', 'benshabbat', 'Thursday 24th of March 2022 11:18:50 PM', 'בדיקה', '050-2284238', '555333', 'בדיקה טלפון');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `phone`, `email`, `password`) VALUES
(1, 'admin', ' 050-5555555', ' admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3'),
(14, 'ahmad', '050-7825556', 'jbareen007@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(16, 'benshabbat', '050-2284238', 'benshabbat27@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(17, 'yama', '050-2233223', '554kl51@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(18, 'jbareen', '050-7825557', 'jbareen005@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(19, 'golan', '050-1122334', 'golan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(20, 'miri', '058-4085081', 'miri@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(24, 'yotam', '050-1111111', 'yotaml@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(26, 'gogo', '050-2223344', 'gogo@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_4` (`username`),
  ADD UNIQUE KEY `username_6` (`username`),
  ADD KEY `username` (`username`),
  ADD KEY `username_2` (`username`),
  ADD KEY `username_3` (`username`),
  ADD KEY `username_5` (`username`),
  ADD KEY `username_7` (`username`),
  ADD KEY `username_8` (`username`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `namecars`
--
ALTER TABLE `namecars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcar` (`idcar`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `namecars`
--
ALTER TABLE `namecars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
