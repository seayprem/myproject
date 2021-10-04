-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2021 at 12:39 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `systemexam`
--

-- --------------------------------------------------------

--
-- Table structure for table `associate`
--

CREATE TABLE `associate` (
  `ass_id` int(11) NOT NULL,
  `ass_num_regis` varchar(64) NOT NULL,
  `ass_date_regis` varchar(64) NOT NULL,
  `sub_id` varchar(15) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

CREATE TABLE `officers` (
  `officer_id` varchar(15) NOT NULL,
  `officer_user` varchar(64) NOT NULL,
  `officer_pass` varchar(64) NOT NULL,
  `officer_fname` varchar(30) NOT NULL,
  `officer_lname` varchar(30) NOT NULL,
  `officer_tel` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `officers`
--

INSERT INTO `officers` (`officer_id`, `officer_user`, `officer_pass`, `officer_fname`, `officer_lname`, `officer_tel`) VALUES
('administrator', 'admin', 'eb453f1d8d7be0f1d3eb1213ce3904f63467171f', 'administrator', 'system', 123456789);

-- --------------------------------------------------------

--
-- Table structure for table `sent_exam`
--

CREATE TABLE `sent_exam` (
  `sent_no` int(11) NOT NULL,
  `sent_term` int(2) NOT NULL,
  `sent_year` int(5) NOT NULL,
  `sent_time_exam` text NOT NULL,
  `sent_date_exam` text NOT NULL,
  `sent_answersheet` varchar(20) NOT NULL,
  `sent_twopage_book` varchar(20) NOT NULL,
  `sent_fourpage_book` varchar(20) NOT NULL,
  `sent_single_copy` varchar(20) NOT NULL,
  `sent_single_copy_start` int(11) NOT NULL,
  `sent_single_copy_end` int(11) NOT NULL,
  `sent_duplex_copy` varchar(20) NOT NULL,
  `sent_duplex_copy_start` int(11) NOT NULL,
  `sent_duplex_copy_end` int(11) NOT NULL,
  `sent_num_page` int(11) NOT NULL,
  `sent_checked` int(11) NOT NULL,
  `sent_other` text NOT NULL,
  `sent_files` text NOT NULL,
  `teacher_id` varchar(15) NOT NULL,
  `sub_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `students_class`
--

CREATE TABLE `students_class` (
  `class_id` int(11) NOT NULL,
  `class_code` varchar(15) NOT NULL,
  `class_amount` int(11) NOT NULL,
  `class_year` int(11) NOT NULL,
  `sub_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `sub_id` varchar(15) NOT NULL,
  `sub_name` varchar(64) NOT NULL,
  `sub_credit` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`sub_id`, `sub_name`, `sub_credit`) VALUES
('01-406-011-131', 'โครงสร้างข้อมูลและอัลกอริทึม', 2),
('01-406-011-132', 'ปฏิบัติการโครงสร้างข้อมูลและอัลกอริทึม', 1),
('01-406-011-133', 'ระบบจัดการฐานข้อมูล', 2),
('01-406-011-134', 'ปฏิบัติการระบบจัดการฐานข้อมูล', 1),
('01-406-011-135', 'การวิเคราะห์และออกแบบระบบ', 2),
('01-406-011-136', 'ปฏิบัติการการวิเคราะห์และออกแบบระบบ', 1),
('01-406-013-137', 'การเขียนโปรแกรมเว็บแบบพลวัติ', 2),
('01-406-013-138', 'ปฏิบัติการการเขียนโปรแกรมเว็บแบบพลวัติ', 1),
('01-406-013-139', 'การเขียนโปรแกรมเชิงวัตถุ', 2),
('01-406-013-140', 'ปฏิบัติการการเขียนโปรแกรมเชิงวัตถุ', 1),
('01-406-013-241', 'ข้อมูลขนาดใหญ่และการวิเคราะห์', 2),
('01-406-013-242', 'ปฏิบัติการข้อมูลขนาดใหญ่และการวิเคราะห์', 1),
('01-406-014-163', 'การเขียนโปรแกรมคอมพิวเตอร์ในงานธุรกิจ', 3),
('01-406-014-244', 'สัมมนาทางคอมพิวเตอร์ธุรกิจ', 3),
('01-406-014-268', 'การจัดการนวัตกรรมและเทคโนโลยี', 3),
('01-406-014-270', 'การประยุกต์ใช้ปัญญาประดิษฐ์ในงานธุรกิจ', 3),
('01-406-015-161', 'ระบบอินเทอร์เน็ตและอินทราเน็ต', 3);

-- --------------------------------------------------------

--
-- Table structure for table `take_exam`
--

CREATE TABLE `take_exam` (
  `take_no` int(11) NOT NULL,
  `take_date` text NOT NULL,
  `officer_id` varchar(15) NOT NULL,
  `sent_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` varchar(15) NOT NULL,
  `teacher_user` varchar(64) NOT NULL,
  `teacher_pass` varchar(64) NOT NULL,
  `teacher_fname` varchar(30) NOT NULL,
  `teacher_lname` varchar(30) NOT NULL,
  `teacher_tel` int(10) NOT NULL,
  `teacher_position` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `teacher_user`, `teacher_pass`, `teacher_fname`, `teacher_lname`, `teacher_tel`, `teacher_position`) VALUES
('header', 'header', '67045742c7e539cbddd650bae94110568718bd31', 'header', 'header', 123456789, 'หัวหน้าโปรแกรมวิชา'),
('user', 'user', '0caba15064170407c388b773f894fcc7651e9e65', 'user', 'user', 123456789, 'อาจารย์');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `associate`
--
ALTER TABLE `associate`
  ADD PRIMARY KEY (`ass_id`),
  ADD KEY `associate_class_id_fk1` (`class_id`),
  ADD KEY `associate_subject_id_fk1` (`sub_id`);

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
  ADD KEY `teacherid_fk1` (`teacher_id`),
  ADD KEY `subids_fk1` (`sub_id`);

--
-- Indexes for table `students_class`
--
ALTER TABLE `students_class`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `student_class_fk1_to_subject` (`sub_id`);

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
  ADD KEY `take_exam_fk1_officer` (`officer_id`),
  ADD KEY `take_exam_fk1_sentexam` (`sent_no`);

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
-- AUTO_INCREMENT for table `sent_exam`
--
ALTER TABLE `sent_exam`
  MODIFY `sent_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students_class`
--
ALTER TABLE `students_class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `take_exam`
--
ALTER TABLE `take_exam`
  MODIFY `take_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `associate`
--
ALTER TABLE `associate`
  ADD CONSTRAINT `associate_class_id_fk1` FOREIGN KEY (`class_id`) REFERENCES `students_class` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `associate_subject_id_fk1` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sent_exam`
--
ALTER TABLE `sent_exam`
  ADD CONSTRAINT `subids_fk1` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacherid_fk1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students_class`
--
ALTER TABLE `students_class`
  ADD CONSTRAINT `student_class_fk1_to_subject` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `take_exam`
--
ALTER TABLE `take_exam`
  ADD CONSTRAINT `take_exam_fk1_officer` FOREIGN KEY (`officer_id`) REFERENCES `officers` (`officer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `take_exam_fk1_sentexam` FOREIGN KEY (`sent_no`) REFERENCES `sent_exam` (`sent_no`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
