-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2021 at 06:04 AM
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
('admin', 'admin', 'eb453f1d8d7be0f1d3eb1213ce3904f63467171f', 'Admin', 'Manage', 1111111111);

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
('BC3/2A', 41, 3, '01-406-011-133'),
('BC3/2B', 41, 3, '01-406-011-131');

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
('01-406-013-138', 'ปฏิบัติการการเขียนโปรแกรมเว็บแบบพลวัติ', 1),
('awd', 'awd', 2);

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
('userid', 'user', '0caba15064170407c388b773f894fcc7651e9e65', 'user', 'view', 111111, 'view');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `officers`
--
ALTER TABLE `officers`
  ADD PRIMARY KEY (`officer_id`);

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
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `students_class`
--
ALTER TABLE `students_class`
  ADD CONSTRAINT `students_class_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`sub_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
