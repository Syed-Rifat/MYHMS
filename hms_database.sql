-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 08:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `full_name`, `email`, `phone`, `password`, `created_at`) VALUES
(1, 'Admin One', 'admin1@example.com', '1234567890', 'password123', '2024-11-22 20:49:54'),
(2, 'Admin', 'admin@gmail.com', '0987654321', '$2y$10$eOJABFMmQsixMS7boA5GceieltOusSkjYOiNJfJV8tHHuQ5Rv.JLi', '2024-11-22 20:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `admin_registration_request`
--

CREATE TABLE `admin_registration_request` (
  `request_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration_requests`
--

CREATE TABLE `registration_requests` (
  `id` int(11) NOT NULL,
  `role` enum('student','teacher','staff') NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `student_id_number` varchar(20) NOT NULL,
  `department` enum('CSE','ICT','EEE','ME','CIVIL','IPE','ENG','BBA','ASI') NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `father_phone` varchar(15) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `mother_phone` varchar(15) DEFAULT NULL,
  `guardian_name` varchar(100) DEFAULT NULL,
  `guardian_phone` varchar(15) DEFAULT NULL,
  `guardian_relation` varchar(50) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `full_name`, `student_id_number`, `department`, `email`, `phone`, `blood_group`, `father_name`, `father_phone`, `mother_name`, `mother_phone`, `guardian_name`, `guardian_phone`, `guardian_relation`, `profile_picture`, `password`, `created_at`) VALUES
(1, 'John Doe', 'STU12345', 'CSE', 'john.doe@example.com', '1234567890', 'A+', 'Robert Doe', '0987654321', 'Jane Doe', '0987654321', 'Michael Smith', '1122334455', 'Guardian', NULL, 'password123', '2024-11-22 20:51:15'),
(2, 'Alice Smith', 'STU67890', 'BBA', 'alice.smith@example.com', '0987654321', 'B+', 'James Smith', '1122334455', 'Sarah Smith', '1122334455', 'David Johnson', '6677889900', 'Guardian', NULL, 'password456', '2024-11-22 20:51:15'),
(4, 'syed', '220201050', 'CSE', 'syed@gmail.com', '123456789', 'A+', 'asd', '123', 'qwe', '456', '', '', '', 'uploads/Screenshot 2024-02-05 005558.png', '$2y$10$XD9KRDBS0iccBZu.GhHp4u5Yu3JYKC7ASccnUg5QRmJY1udbs.s8i', '2024-11-24 15:12:49');

-- --------------------------------------------------------

--
-- Table structure for table `student_registration_request`
--

CREATE TABLE `student_registration_request` (
  `request_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `student_id_number` varchar(20) NOT NULL,
  `department` enum('CSE','ICT','EEE','ME','CIVIL','IPE','ENG','BBA','ASI') NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `father_phone` varchar(15) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `mother_phone` varchar(15) DEFAULT NULL,
  `guardian_name` varchar(100) DEFAULT NULL,
  `guardian_phone` varchar(15) DEFAULT NULL,
  `guardian_relation` varchar(50) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_registration_request`
--

INSERT INTO `student_registration_request` (`request_id`, `full_name`, `student_id_number`, `department`, `email`, `phone`, `blood_group`, `father_name`, `father_phone`, `mother_name`, `mother_phone`, `guardian_name`, `guardian_phone`, `guardian_relation`, `profile_picture`, `PASSWORD`, `status`, `created_at`) VALUES
(1, 'jghfgh', '1234321', 'CSE', 's@g.com', '3213432345', 'A+', 'wew', '1234321', 'qwerfdsa', '9898', '', '', '', NULL, '$2y$10$m54uZyNo/X987/Vj9.nj6eV/mwtCDSNR2NmEPlkl/dvPUg48nTdf.', 'approved', '2024-11-23 06:23:46'),
(3, 'aakndad', '432', 'CSE', 'a@g.com', '432', 'A+', 'asdf', '3212', 'sdf', '123', '', '', '', NULL, '$2y$10$464d0BfpCqYkw6mRiwlOJOUztEo9wY4HCpF0JV2.TNzc1VkPxsjR6', 'rejected', '2024-11-23 06:28:58'),
(4, 'syed', '220201050', 'CSE', 'syed@gmail.com', '123456789', 'A+', 'asd', '123', 'qwe', '456', '', '', '', 'uploads/Screenshot 2024-02-05 005558.png', '$2y$10$XD9KRDBS0iccBZu.GhHp4u5Yu3JYKC7ASccnUg5QRmJY1udbs.s8i', 'approved', '2024-11-23 06:31:44'),
(6, 'rifat', '12345432', 'CSE', 'f@g.com', '4321', 'A+', 'aws', '123', 'qse', '654', '', '', '', 'uploads/Screenshot_2023-08-01_200937_png', '$2y$10$xxxf6nQJUN2vE1BTPyAkKuvzBKUkq4yZatgiWEzWx/ZyZdt9ufh7S', 'pending', '2024-11-23 06:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `teacher_id_number` varchar(20) NOT NULL,
  `department` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `full_name`, `teacher_id_number`, `department`, `email`, `phone`, `blood_group`, `profile_picture`, `password`, `created_at`) VALUES
(1, 'Don', 'TEA123', 'Mathematics', 'teacher@example.com', '0987654321', 'A+', NULL, 'teacherpass', '2024-11-22 20:51:21');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_registration_request`
--

CREATE TABLE `teacher_registration_request` (
  `request_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `teacher_id_number` varchar(20) NOT NULL,
  `department` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_registration_request`
--

INSERT INTO `teacher_registration_request` (`request_id`, `full_name`, `teacher_id_number`, `department`, `email`, `phone`, `blood_group`, `profile_picture`, `PASSWORD`, `status`, `created_at`) VALUES
(1, 'jhgfdfgh', '7654', 'CSE', 'sd@f.com', 'ffgty', 'A+', 'uploads/Screenshot_2023-08-01_201014_png', '$2y$10$JwxsoO6zyWGRtAZy11eKmeM0gYZXEKwcKQeEcEVsyhjYaZ0FF/GKG', 'pending', '2024-11-23 06:41:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `admin_registration_request`
--
ALTER TABLE `admin_registration_request`
  ADD PRIMARY KEY (`request_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `registration_requests`
--
ALTER TABLE `registration_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_id_number` (`student_id_number`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `student_registration_request`
--
ALTER TABLE `student_registration_request`
  ADD PRIMARY KEY (`request_id`),
  ADD UNIQUE KEY `student_id_number` (`student_id_number`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `teacher_id_number` (`teacher_id_number`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `teacher_registration_request`
--
ALTER TABLE `teacher_registration_request`
  ADD PRIMARY KEY (`request_id`),
  ADD UNIQUE KEY `teacher_id_number` (`teacher_id_number`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_registration_request`
--
ALTER TABLE `admin_registration_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration_requests`
--
ALTER TABLE `registration_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_registration_request`
--
ALTER TABLE `student_registration_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher_registration_request`
--
ALTER TABLE `teacher_registration_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
