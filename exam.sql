-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2021 at 10:51 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `associate`
--

CREATE TABLE `associate` (
  `ass_id` int(11) NOT NULL,
  `ass_num_regis` varchar(64) DEFAULT NULL,
  `ass_date_regis` varchar(64) DEFAULT NULL,
  `sub_id` varchar(15) DEFAULT NULL,
  `teacher_id` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

CREATE TABLE `officers` (
  `officer_id` varchar(15) NOT NULL COMMENT 'รหัสประจำตัวเจ้าหน้าที่',
  `officer_user` varchar(64) NOT NULL COMMENT 'ชื่อผู้ใช้เจ้าหน้าที่',
  `officer_pass` varchar(64) NOT NULL COMMENT 'รหัสผ่าน',
  `officer_fname` varchar(30) NOT NULL COMMENT 'ชื่อเจ้าหน้าที่',
  `officer_lname` varchar(30) NOT NULL COMMENT 'นามสกุลเจ้าหน้าที่',
  `officer_tel` int(10) NOT NULL COMMENT 'เบอร์โทรศัพท์เจ้าหน้าที่'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `officers`
--

INSERT INTO `officers` (`officer_id`, `officer_user`, `officer_pass`, `officer_fname`, `officer_lname`, `officer_tel`) VALUES
('Administrator', 'admin', 'eb453f1d8d7be0f1d3eb1213ce3904f63467171f', 'administrator', 'system', 1234562789);

-- --------------------------------------------------------

--
-- Table structure for table `sent_exam`
--

CREATE TABLE `sent_exam` (
  `sent_no` int(15) NOT NULL,
  `sent_term` int(2) DEFAULT NULL,
  `sent_year` int(5) DEFAULT NULL,
  `sent_time_exam` int(5) DEFAULT NULL,
  `sent_date_exam` int(10) DEFAULT NULL,
  `sent_answersheet` varchar(20) DEFAULT NULL,
  `sent_twopage_book` varchar(20) DEFAULT NULL,
  `sent_fourpage_book` varchar(20) DEFAULT NULL,
  `sent_single_copy` varchar(20) DEFAULT NULL,
  `sent_duplex_copy` varchar(20) DEFAULT NULL,
  `sent_num_page` int(10) DEFAULT NULL,
  `sent_checked` int(11) DEFAULT NULL,
  `teacher_id` varchar(15) DEFAULT NULL,
  `sub_id` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `students_class`
--

CREATE TABLE `students_class` (
  `class_id` varchar(15) NOT NULL COMMENT 'รหัสห้องเรียน',
  `class_amount` int(5) DEFAULT NULL COMMENT 'จำนวนนักศึกษา',
  `class_year` int(2) DEFAULT NULL COMMENT 'ชั้นปี',
  `sub_id` varchar(30) DEFAULT NULL COMMENT 'รหัสวิชา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students_class`
--

INSERT INTO `students_class` (`class_id`, `class_amount`, `class_year`, `sub_id`) VALUES
('BC3/2A', 44, 3, '01-406-011-133'),
('BC3/2B', 42, 3, '01-406-011-131');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `sub_id` varchar(15) NOT NULL COMMENT 'รหัสวิชา',
  `sub_name` varchar(64) NOT NULL COMMENT 'ชื่อวิชา',
  `sub_credit` int(5) NOT NULL COMMENT 'หน่วยกิต'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`sub_id`, `sub_name`, `sub_credit`) VALUES
('01-404-041-204', 'การวิเคราะห์เชิงปริมาณทางธุรกิจ', 3),
('01-406-011-131', 'โครงสร้างข้อมูลและอัลกอริทึม', 2),
('01-406-011-132', 'ปฏิบัติการโครงสร้างข้อมูลและอัลกอริทึม', 1),
('01-406-011-133', 'ระบบจัดการฐานข้อมูล', 2),
('01-406-011-134', 'ปฏิบัติการระบบจัดการฐานข้อมูล', 1),
('01-406-013-137', 'การเขียนโปรแกรมเว็บแบบพลวัติ', 2),
('01-406-013-138', 'ปฏิบัติการการเขียนโปรแกรมเว็บแบบพลวัติ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `take_exam`
--

CREATE TABLE `take_exam` (
  `take_no` int(15) NOT NULL,
  `take_date` int(10) DEFAULT NULL,
  `officer_id` varchar(15) DEFAULT NULL,
  `sent_no` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` varchar(15) NOT NULL COMMENT 'รหัสประจำตัวอาจารย์',
  `teacher_user` varchar(64) NOT NULL COMMENT 'ชื่อผู้ใช้งานอาจารย์',
  `teacher_pass` varchar(64) NOT NULL COMMENT 'รหัสผ่าน',
  `teacher_fname` varchar(30) NOT NULL COMMENT 'ชื่อจริงอาจารย์',
  `teacher_lname` varchar(30) NOT NULL COMMENT 'นามสกุลอาจารย์',
  `teacher_tel` int(10) NOT NULL COMMENT 'เบอร์โทรศัพท์อาจารย์',
  `teacher_position` varchar(30) NOT NULL COMMENT 'ตำแหน่ง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `teacher_user`, `teacher_pass`, `teacher_fname`, `teacher_lname`, `teacher_tel`, `teacher_position`) VALUES
('1234', 'user', '0caba15064170407c388b773f894fcc7651e9e65', 'user', 'view', 123121, 'user'),
('test', 'test', 'f94c352ee87a98aa7734989ac5260571804f3bbd', 'หัวหน้า', 'โปรแกรมวิชา', 123123, 'หัวหน้าโปรแกรมวิชา');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `associate`
--
ALTER TABLE `associate`
  ADD PRIMARY KEY (`ass_id`),
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `officers`
--
ALTER TABLE `officers`
  ADD PRIMARY KEY (`officer_id`);

--
-- Indexes for table `sent_exam`
--
ALTER TABLE `sent_exam`
  ADD PRIMARY KEY (`sent_no`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `students_class`
--
ALTER TABLE `students_class`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `take_exam`
--
ALTER TABLE `take_exam`
  ADD PRIMARY KEY (`take_no`),
  ADD KEY `officer_id` (`officer_id`),
  ADD KEY `sent_no` (`sent_no`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `associate`
--
ALTER TABLE `associate`
  MODIFY `ass_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `associate`
--
ALTER TABLE `associate`
  ADD CONSTRAINT `associate_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`sub_id`),
  ADD CONSTRAINT `associate_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`);

--
-- Constraints for table `sent_exam`
--
ALTER TABLE `sent_exam`
  ADD CONSTRAINT `sent_exam_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `sent_exam_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`sub_id`);

--
-- Constraints for table `students_class`
--
ALTER TABLE `students_class`
  ADD CONSTRAINT `students_class_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`sub_id`);

--
-- Constraints for table `take_exam`
--
ALTER TABLE `take_exam`
  ADD CONSTRAINT `take_exam_ibfk_1` FOREIGN KEY (`officer_id`) REFERENCES `officers` (`officer_id`),
  ADD CONSTRAINT `take_exam_ibfk_2` FOREIGN KEY (`sent_no`) REFERENCES `sent_exam` (`sent_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
