-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2025 at 10:39 PM
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
-- Database: `attendance_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'akash', 'akash2@gmail.com', '1212');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `teacher_id`, `title`, `description`, `created_at`) VALUES
(1, 0, 'Holiday Notice', 'College will remain closed on 25th December.', '2025-12-23 21:05:30'),
(2, 0, 'Exam Schedule', 'Mid-term exams start from 5th January.', '2025-12-23 21:05:30'),
(3, 3, 'Quiz update', 'today quiz cancel', '2025-12-24 00:10:17'),
(4, 0, 'summer holidays', 'summer holidays will start from 1 July 2026', '2025-12-25 15:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) NOT NULL,
  `student_roll` varchar(50) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` enum('Present','Absent','Leave','Late') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `course_id`, `student_roll`, `teacher_id`, `class_id`, `subject_id`, `date`, `status`) VALUES
(1, 3, 1, '', NULL, NULL, NULL, '2025-12-25', 'Absent'),
(2, 5, 1, '', NULL, NULL, NULL, '2025-12-25', 'Absent'),
(3, 6, 1, '41592', NULL, NULL, NULL, '2025-12-25', 'Present'),
(4, 3, 2, '', NULL, NULL, NULL, '2025-12-25', 'Present'),
(5, 5, 2, '', NULL, NULL, NULL, '2025-12-25', 'Present'),
(6, 6, 2, '', NULL, NULL, NULL, '2025-12-25', 'Absent'),
(7, 3, 5, '', NULL, NULL, NULL, '2025-12-26', 'Present'),
(8, 5, 5, '', NULL, NULL, NULL, '2025-12-26', 'Present'),
(9, 6, 5, '', NULL, NULL, NULL, '2025-12-26', 'Present'),
(10, 3, 1, '', NULL, NULL, NULL, '2025-12-26', 'Present'),
(11, 5, 1, '', NULL, NULL, NULL, '2025-12-26', 'Present'),
(12, 6, 1, '', NULL, NULL, NULL, '2025-12-26', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_name`) VALUES
(1, 'BSCS 1st Semester'),
(2, 'BSCS 2nd Semester'),
(3, 'BSIT 1st Semester'),
(4, 'BSIT 2nd Semester'),
(5, 'BSSE');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `teacher_name` varchar(100) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `teacher_name`, `class_id`, `teacher_id`) VALUES
(1, 'Mathematics', 'Mr. Hafiz', 1, 7),
(2, 'Physics', 'Mrs. Khan', 1, 6),
(3, 'Computer Science', 'Ms. Fatima', 2, 4),
(4, 'programming fundamental', '', 1, 6),
(5, 'Pakistan study ', 'umer', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` enum('student','teacher') DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `role`, `token`, `expiry`) VALUES
(1, 'akashakhlaq082@gmail.com', 'student', '7a2b39a3efa4467aac79f46a0315d98c6585ce715a6d17b5550e39e308ee0267', '2025-12-26 21:58:53'),
(2, 'akashakhlaq082@gmail.com', 'student', 'f256b266cd4065fcbf30645190613ed0c45824fea5221cab6eae73a035d9eaa4', '2025-12-26 22:07:50'),
(3, 'akashakhlaq082@gmail.com', 'student', '554b1346bc2af2739309aac319f0c133c4ebccb44cf7a9ab0cef692d7bf9c3ff', '2025-12-26 22:12:59'),
(4, 'akashakhlaq082@gmail.com', 'student', '8f7eabb57f366ec1a1c5a058adc0a67106569fabb41264794d60f2dc3197a60a', '2025-12-26 22:13:32'),
(5, 'akashakhlaq38@gmail.com', NULL, 'ac199a661b5b341f8dfe91d2976aab6c', NULL),
(6, 'akashakhlaq082@gmail.com', NULL, '5402006d11532bda6118aced798832fc', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `roll_no`, `password`, `name`, `class_id`, `status`, `reset_token`, `token_expiry`) VALUES
(1, 'ST001', 'ali123', 'Ali khan', 2, 1, NULL, NULL),
(3, 'ST001', '1234', 'Ali', 1, 1, NULL, NULL),
(4, '41593', '', 'Akash akhlaq ', 2, 1, NULL, NULL),
(5, 'ST001', '', 'Akash akhlaq ', 1, 1, NULL, NULL),
(6, '41592', 'jibran123', 'Muhammad Jibran Tahir', 1, 1, NULL, NULL),
(7, '1234', '$2y$10$EER71b8gYVu/TsHN.igo6eD70lGpylcl54T2NaY.pWvn6L3GhsUGC', 'shamu', 4, 1, NULL, NULL),
(8, '1', '$2y$10$7eY6B.7XLXUzelmwYHmIWOO4uGz7AmKWPRRT7e.u.fBSXsffh1jBy', 'usman', 4, 1, NULL, NULL),
(9, '1212', '$2y$10$NbFk4Cz81k3FnKnYsQi5VusCHtQbtR2eGlCiNWgj4yhVoNROGcDMy', 'nafees', 3, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_work`
--

CREATE TABLE `student_work` (
  `id` int(11) NOT NULL,
  `student_roll` varchar(50) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_work`
--

INSERT INTO `student_work` (`id`, `student_roll`, `file_name`, `file_path`, `uploaded_at`) VALUES
(1, 'ST001', 'lab task 5 akash akhlaq.pdf', '../uploads/lab task 5 akash akhlaq.pdf', '2025-12-23 21:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`) VALUES
(1, 'Pakistan study');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `email`, `password`, `class_id`, `subject_id`, `status`, `reset_token`, `token_expiry`) VALUES
(4, 'Akash akhlaq ', 'akashakhlaq38@gmail.com', '1212', NULL, NULL, 1, '3ae75b574fba31b551f7d200d99935b9', '2025-12-26 22:42:47'),
(5, 'usman', 'usman@gmail.com', 'usman123', NULL, NULL, 1, NULL, NULL),
(6, 'umer', 'umer@gmail.com', 'umer123', NULL, NULL, 1, NULL, NULL),
(7, 'akram', 'akashakhlaq082@gmail.com', 'akram123', NULL, NULL, 1, '87d2c1e4fc45effe581bd25280cb1327', '2025-12-26 22:31:44');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_assignments`
--

CREATE TABLE `teacher_assignments` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `day` varchar(20) DEFAULT NULL,
  `period` int(11) NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `teacher_id`, `class_id`, `subject_id`, `day`, `period`, `start_time`, `end_time`) VALUES
(7, 4, 1, 1, 'Monday', 1, '13:38:00', '12:10:00'),
(8, 5, 2, 1, 'Tuesday', 1, '21:30:00', '20:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_work`
--
ALTER TABLE `student_work`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `teacher_assignments`
--
ALTER TABLE `teacher_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `student_work`
--
ALTER TABLE `student_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teacher_assignments`
--
ALTER TABLE `teacher_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `teacher_assignments`
--
ALTER TABLE `teacher_assignments`
  ADD CONSTRAINT `teacher_assignments_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`),
  ADD CONSTRAINT `teacher_assignments_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `teacher_assignments_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
