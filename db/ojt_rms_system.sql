-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2023 at 01:22 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ojt_rms_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance_date` text NOT NULL,
  `attendance_time_in` text NOT NULL,
  `attendance_time_out` text NOT NULL,
  `attendance_log` text NOT NULL,
  `coordinator_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coordinator`
--

CREATE TABLE `tbl_coordinator` (
  `coordinator_id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `contact_number` text NOT NULL,
  `organization_id` int(11) NOT NULL,
  `isVerified` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coordinator_task`
--

CREATE TABLE `tbl_coordinator_task` (
  `coordinator_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `task_name` text NOT NULL,
  `task_description` text NOT NULL,
  `task_created` text NOT NULL DEFAULT current_timestamp(),
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE `tbl_course` (
  `course_id` int(11) NOT NULL,
  `course_code` text NOT NULL,
  `course_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`course_id`, `course_code`, `course_name`) VALUES
(1, 'it321', 'it era'),
(2, 'it123', 'ojt ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_organization`
--

CREATE TABLE `tbl_organization` (
  `organization_id` int(11) NOT NULL,
  `organization_name` text NOT NULL,
  `organization_description` text NOT NULL,
  `organization_contact_number` text NOT NULL,
  `organization_address` text NOT NULL,
  `organization_email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_organization`
--

INSERT INTO `tbl_organization` (`organization_id`, `organization_name`, `organization_description`, `organization_contact_number`, `organization_address`, `organization_email`) VALUES
(1, 'sti', 'Sed saepe numquam ni', 'Porter Greer Co', 'Craig and Knapp Trading', 'sijuzotacy@mailinator.com'),
(2, 'seait', 'Voluptatem et proid', 'Mccormick Beach Co', 'Sweet and Pope Traders', 'myqimylole@mailinator.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_otp`
--

CREATE TABLE `tbl_otp` (
  `user_id` int(11) NOT NULL,
  `otp_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_otp`
--

INSERT INTO `tbl_otp` (`user_id`, `otp_code`) VALUES
(70, '970751');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `student_id` int(11) NOT NULL,
  `student_id_number` text NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `course_id` int(11) NOT NULL,
  `contact_number` text NOT NULL,
  `address` text NOT NULL,
  `school_year` text NOT NULL,
  `organization_id` int(11) NOT NULL,
  `start_date` text NOT NULL,
  `required_hours` text NOT NULL,
  `isVerified` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`student_id`, `student_id_number`, `first_name`, `last_name`, `course_id`, `contact_number`, `address`, `school_year`, `organization_id`, `start_date`, `required_hours`, `isVerified`) VALUES
(62, '93938', 'hahsyz', 'zxjxjx', 2, 'jxuxux', 'hshs', '2023', 1, '2023-08-16', '200', '1'),
(70, '282882', 'hahshs', 'hzhzhz', 2, '1727272', 'polomolok ', '2023', 1, '2023-08-17', '200', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_task`
--

CREATE TABLE `tbl_student_task` (
  `task_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `task_name` text NOT NULL,
  `task_description` text NOT NULL,
  `task_status` text NOT NULL DEFAULT 'Pending',
  `task_created` text NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_email` text NOT NULL,
  `user_password` text NOT NULL,
  `user_status` text NOT NULL,
  `user_role` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isVerified` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_email`, `user_password`, `user_status`, `user_role`, `created_at`, `isVerified`) VALUES
(1, 'admin@gmail.com', 'admin', 'Verified', 'Admin', '2023-01-10 05:48:43', ''),
(5, 'ortegacanillo76@gmail.com', '$2y$10$lB0VE559AZnL9TzZ0h7ZIu5/7eADQwiUVkMX.qJ2nI50wIU7I65WK', 'Verified', 'Student', '2023-08-14 10:35:37', '1'),
(62, 'arzeljrz@gmail.com', '$2y$10$CtiMit8iyOwx2.m.6ovFlevH.B.2h.pWs3lhvr5n.VXWI3OeNBPwW', 'Verified', 'Student', '2023-08-16 06:03:34', '1'),
(70, 'ajmixrhyme@gmail.com', '$2y$10$Oh0FqR/QWKEOscHV40VxOuFkRxDFAFKpiksuj2mHYSA49BZHTwOby', 'Pending', 'Student', '2023-08-17 11:18:50', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `tbl_attendance_fk0` (`student_id`),
  ADD KEY `tbl_attendance_fk1` (`coordinator_id`);

--
-- Indexes for table `tbl_coordinator`
--
ALTER TABLE `tbl_coordinator`
  ADD PRIMARY KEY (`coordinator_id`),
  ADD KEY `tbl_coordinator_fk1` (`organization_id`);

--
-- Indexes for table `tbl_coordinator_task`
--
ALTER TABLE `tbl_coordinator_task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `tbl_coordinator_task_fk0` (`coordinator_id`);

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `tbl_organization`
--
ALTER TABLE `tbl_organization`
  ADD PRIMARY KEY (`organization_id`);

--
-- Indexes for table `tbl_otp`
--
ALTER TABLE `tbl_otp`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `tbl_student_fk1` (`course_id`),
  ADD KEY `tbl_student_fk2` (`organization_id`);

--
-- Indexes for table `tbl_student_task`
--
ALTER TABLE `tbl_student_task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `tbl_student_task_fk0` (`student_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_coordinator_task`
--
ALTER TABLE `tbl_coordinator_task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_organization`
--
ALTER TABLE `tbl_organization`
  MODIFY `organization_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_student_task`
--
ALTER TABLE `tbl_student_task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD CONSTRAINT `tbl_attendance_fk0` FOREIGN KEY (`student_id`) REFERENCES `tbl_student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_attendance_fk1` FOREIGN KEY (`coordinator_id`) REFERENCES `tbl_coordinator` (`coordinator_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_coordinator`
--
ALTER TABLE `tbl_coordinator`
  ADD CONSTRAINT `tbl_coordinator_fk0` FOREIGN KEY (`coordinator_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_coordinator_fk1` FOREIGN KEY (`organization_id`) REFERENCES `tbl_organization` (`organization_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_coordinator_task`
--
ALTER TABLE `tbl_coordinator_task`
  ADD CONSTRAINT `tbl_coordinator_task_fk0` FOREIGN KEY (`coordinator_id`) REFERENCES `tbl_coordinator` (`coordinator_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_otp`
--
ALTER TABLE `tbl_otp`
  ADD CONSTRAINT `tbl_otp_fk0` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD CONSTRAINT `tbl_student_fk0` FOREIGN KEY (`student_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_student_fk1` FOREIGN KEY (`course_id`) REFERENCES `tbl_course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_student_fk2` FOREIGN KEY (`organization_id`) REFERENCES `tbl_organization` (`organization_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_student_task`
--
ALTER TABLE `tbl_student_task`
  ADD CONSTRAINT `tbl_student_task_fk0` FOREIGN KEY (`student_id`) REFERENCES `tbl_student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
