-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2017 at 08:37 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `building_no` int(11) NOT NULL,
  `room_no` int(11) NOT NULL,
  `street_name` int(11) NOT NULL,
  `dzongkhag_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assigned_roles`
--

CREATE TABLE `assigned_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'home', NULL, '2017-02-25 22:00:33', '2017-02-25 22:00:33'),
(2, 'Home', '', '2017-02-28 16:51:26', '2017-02-28 16:51:26');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(15) NOT NULL,
  `image` varchar(55) DEFAULT NULL,
  `user_id` int(255) UNSIGNED NOT NULL,
  `course_name` char(15) NOT NULL,
  `course_code` varchar(6) NOT NULL,
  `credits` int(100) NOT NULL,
  `content_id` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `image`, `user_id`, `course_name`, `course_code`, `credits`, `content_id`, `description`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, 'ccn', 'ccn666', 66, NULL, '', '2017-02-25 16:47:54', '2017-02-25 16:47:54'),
(40, NULL, 2, 'uihiuhuih', '666661', 66, NULL, '', '2017-02-28 11:57:11', '2017-02-28 11:57:11'),
(43, NULL, 2, 'ihijoom', '11166i', 66, NULL, '', '2017-02-28 12:01:00', '2017-02-28 12:01:00'),
(51, NULL, 2, 'fuygbujkn', 't66666', 55, NULL, '', '2017-02-28 14:37:33', '2017-02-28 14:37:33'),
(52, NULL, 2, 'ftfukjl', 'kkjh66', 55, NULL, '', '2017-02-28 14:38:40', '2017-02-28 14:38:40'),
(53, NULL, 2, 'fyuguh', 'gg6666', 56, NULL, '', '2017-02-28 14:45:04', '2017-02-28 14:45:04'),
(62, NULL, 2, 'ddoahoid', 'd66666', 66, NULL, '', '2017-03-01 02:24:28', '2017-03-01 02:24:28'),
(64, NULL, 2, 'shdoij', 'dhid66', 66, NULL, '', '2017-03-01 02:25:25', '2017-03-01 02:25:25');

-- --------------------------------------------------------

--
-- Table structure for table `course_programme`
--

CREATE TABLE `course_programme` (
  `pivot_id` int(50) NOT NULL,
  `course_id` int(50) NOT NULL,
  `programme_id` int(50) DEFAULT NULL,
  `semester_id` int(12) DEFAULT NULL,
  `elective` blob,
  `selected` blob,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_programme`
--

INSERT INTO `course_programme` (`pivot_id`, `course_id`, `programme_id`, `semester_id`, `elective`, `selected`, `created_at`, `updated_at`) VALUES
(4, 1, 8, 2, 0x596573, 0x596573, '2017-02-28 06:02:58', '2017-02-28 06:02:58'),
(5, 64, 9, 5, NULL, NULL, '2017-03-01 02:25:25', '2017-03-01 02:25:25');

-- --------------------------------------------------------

--
-- Table structure for table `course_student`
--

CREATE TABLE `course_student` (
  `id` int(50) NOT NULL,
  `student_id` int(50) NOT NULL,
  `course_programme_id` int(50) NOT NULL,
  `type` enum('Regular','Back','Superback') NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_code` int(5) NOT NULL,
  `department_name` char(50) NOT NULL,
  `tutor_id` int(5) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_code`, `department_name`, `tutor_id`, `created_at`, `updated_at`) VALUES
(12, 555, 'Department of Information Technology', 2, '2017-02-19 10:19:12', '2017-02-19 11:18:20'),
(13, 666, 'Department of Civil Engineering', 1, '2017-02-19 13:25:27', '2017-02-19 13:25:27'),
(14, 111, 'Department of Electrical Engineering', 3, '2017-02-21 01:14:23', '2017-02-21 01:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `dzongkhags`
--

CREATE TABLE `dzongkhags` (
  `id` int(30) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dzongkhags`
--

INSERT INTO `dzongkhags` (`id`, `name`) VALUES
(1, 'Bumthang'),
(2, 'Chukha'),
(3, 'Dagana'),
(4, 'Gasa'),
(5, 'Haa'),
(6, 'Lhuentse'),
(7, 'Mongar'),
(8, 'Paro'),
(9, 'Pemagatshel'),
(10, 'Punakha'),
(11, 'Samdrup Jongkhar'),
(12, 'Samtse'),
(13, 'Sarpang'),
(14, 'Thimphu'),
(15, 'Trashigang'),
(16, 'Trashiyangtse'),
(17, 'Trongsa'),
(18, 'Tsirang'),
(19, 'Wangdue Phodrang'),
(20, 'Zhemgang');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('chimey@gmail.com', 'cbc31e8c7d1dc095905722ec510544dd55b279305b19b364aafdd61e86974b3c', '2017-02-12 03:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`) VALUES
(25, 'manage_blogs', 'manage blogs'),
(26, 'manage_posts', 'manage posts'),
(27, 'manage_comments', 'manage comments'),
(28, 'manage_users', 'manage users'),
(29, 'manage_roles', 'manage roles'),
(30, 'post_comment', 'post comment');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES
(29, 25, 9),
(30, 26, 9),
(31, 27, 9),
(32, 28, 9),
(33, 29, 9),
(34, 30, 9),
(35, 30, 10),
(36, 25, 11);

-- --------------------------------------------------------

--
-- Table structure for table `programmes`
--

CREATE TABLE `programmes` (
  `id` int(50) NOT NULL,
  `programme_code` varchar(50) NOT NULL,
  `programme_name` varchar(50) NOT NULL,
  `department_id` int(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programmes`
--

INSERT INTO `programmes` (`id`, `programme_code`, `programme_name`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'BE-IT', 'Bachelor of Engineering in Information Technology', 12, '2017-02-19 16:23:40', '2017-02-19 11:35:21'),
(8, 'BE Civil', 'Bachelor of Engineering in Civil Engineering', 13, '2017-02-19 13:25:50', '2017-02-19 13:25:50'),
(9, 'M111', 'Bachelor of Engineering in Electrical Engineering', 14, '2017-02-21 01:15:01', '2017-02-21 01:15:01');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2017-02-14 03:06:04', '2017-02-14 03:06:04'),
(2, 'Tutor', '2017-02-14 03:06:04', '2017-02-14 03:06:04'),
(3, 'Student', '2017-02-14 03:06:41', '2017-02-14 03:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(12) NOT NULL,
  `semester_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `semester_name`, `created_at`, `updated_at`) VALUES
(1, 'I', '2017-02-25 21:59:54', '2017-02-25 21:59:54'),
(2, 'II', '2017-02-25 21:59:54', '2017-02-25 21:59:54'),
(3, 'III', '2017-02-25 21:59:54', '2017-02-25 21:59:54'),
(4, 'IV', '2017-02-25 21:59:54', '2017-02-25 21:59:54'),
(5, 'V', '2017-02-25 21:59:54', '2017-02-25 21:59:54'),
(6, 'VI', '2017-02-25 21:59:54', '2017-02-25 21:59:54'),
(7, 'VII', '2017-02-25 21:59:54', '2017-02-25 21:59:54'),
(8, 'VIII', '2017-02-25 21:59:54', '2017-02-25 21:59:54'),
(9, 'IX', '2017-02-25 21:59:54', '2017-02-25 21:59:54'),
(10, 'X', '2017-02-25 21:59:54', '2017-02-25 21:59:54'),
(11, 'semester -15', '2017-02-25 16:01:16', '2017-02-25 16:01:16'),
(12, 'session 1', '2017-02-26 07:50:46', '2017-02-26 07:50:46'),
(13, 'session 11', '2017-02-26 07:53:00', '2017-02-26 07:53:00');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(50) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) NOT NULL,
  `cidno` varchar(255) NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `dob` date NOT NULL,
  `stdtype` enum('Regular','Self-Financed','In-Service','Repeater') NOT NULL,
  `programme_id` int(50) DEFAULT NULL,
  `current_semester` int(15) NOT NULL,
  `bloodgroup` varchar(10) NOT NULL,
  `street_name` varchar(100) NOT NULL,
  `building_no` varchar(50) NOT NULL,
  `room_no` varchar(50) NOT NULL,
  `dzongkhag_name` char(50) NOT NULL,
  `phone` int(50) NOT NULL,
  `enrolled` date NOT NULL,
  `registered` enum('Yes','No') NOT NULL DEFAULT 'No',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tutors`
--

CREATE TABLE `tutors` (
  `id` int(50) NOT NULL,
  `user_id` int(255) NOT NULL,
  `title` enum('Dr','Mr','Ms') NOT NULL,
  `fname` char(15) NOT NULL,
  `mname` char(15) DEFAULT NULL,
  `lname` char(15) NOT NULL,
  `position` varchar(50) NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `cidno` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `school_id` int(5) NOT NULL,
  `department_id` int(50) DEFAULT NULL,
  `phone` int(50) DEFAULT NULL,
  `fax` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tutors`
--

INSERT INTO `tutors` (`id`, `user_id`, `title`, `fname`, `mname`, `lname`, `position`, `sex`, `cidno`, `dob`, `school_id`, `department_id`, `phone`, `fax`) VALUES
(1, 1, 'Ms', 'Chimi', NULL, 'Wangmo', 'hod IT', 'Female', '1111111111111', '2017-02-01', 1, NULL, NULL, NULL),
(2, 3, 'Mr', 'Karma', NULL, 'Dorji', 'Hod Civil', 'Female', '66666666666', '2017-02-16', 1, NULL, NULL, NULL),
(3, 2, 'Ms', 'Dechen', NULL, 'Wangmo', 'HOD Electrical', 'Female', '55555555555555555', '2017-02-01', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` int(255) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `image`, `name`, `email`, `password`, `remember_token`, `confirmed`, `created_at`, `updated_at`) VALUES
(2, NULL, 'Sonam', 'chimey@gmail.com', '$2y$10$.Mcung61Ad9z/JMF1pLfUOEa0kTqw4gXLCVYlkKsldWfDvKdNGG4.', 'rdhH9gfzop7HfQoVaP7KgHtnFZihV8AgcXMl3zegsXUbz1SFcIeVGnp2tdY9', 0, '2017-02-14 11:07:33', '2017-02-16 15:02:36'),
(3, NULL, 'choki', 'sonam@gmail.com', '$2y$10$km75Wos24Ij85RPLvcKEC.JvxVdTD1.bhBFr4tZdL5417UGiV1JB2', NULL, 0, '2017-02-14 11:46:56', '2017-02-14 11:46:56'),
(4, NULL, 'jurme', 'sonamjurme@gmail.com', '$2y$10$Xa8/NZ7w0DnimMomtOHXROaejWiSM6s5Eap92EDzw2KGqsgfEdkr2', '8LymCek8RK9LMIPmWiWC0SIF1ObQyt6MdU82ZVnrpLAdISACvRz14FfVkGrL', 0, '2017-02-14 11:52:07', '2017-02-14 12:12:08'),
(5, NULL, 'karama', 'karma@gmail.com', '$2y$10$ALpTNCt.2uyDLnZononRE.1ASt8k/hM80FwrRFrOE2CEiqlVb2/oS', NULL, 0, '2017-02-14 12:12:42', '2017-02-14 12:12:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_no` (`room_no`),
  ADD KEY `dzongkhag_id` (`dzongkhag_id`);

--
-- Indexes for table `assigned_roles`
--
ALTER TABLE `assigned_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_roles_user_id_index` (`user_id`),
  ADD KEY `assigned_roles_role_id_index` (`role_id`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_name` (`course_name`),
  ADD UNIQUE KEY `course_code_2` (`course_code`),
  ADD UNIQUE KEY `content_id` (`content_id`),
  ADD KEY `course_name_2` (`course_name`),
  ADD KEY `course_code` (`course_code`),
  ADD KEY `course_name_3` (`course_name`),
  ADD KEY `course_name_4` (`course_name`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `course_programme`
--
ALTER TABLE `course_programme`
  ADD PRIMARY KEY (`pivot_id`),
  ADD UNIQUE KEY `pivot_id` (`pivot_id`),
  ADD UNIQUE KEY `course_id_2` (`course_id`,`programme_id`),
  ADD KEY `course_id` (`course_id`,`programme_id`),
  ADD KEY `programme_id` (`programme_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `programme_id_2` (`programme_id`);

--
-- Indexes for table `course_student`
--
ALTER TABLE `course_student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_id_2` (`course_programme_id`,`student_id`),
  ADD UNIQUE KEY `student_id_2` (`student_id`,`course_programme_id`),
  ADD KEY `course_id` (`course_programme_id`,`student_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id_3` (`course_programme_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `department_code` (`department_code`),
  ADD UNIQUE KEY `department_name` (`department_name`),
  ADD UNIQUE KEY `hod_id` (`tutor_id`);

--
-- Indexes for table `dzongkhags`
--
ALTER TABLE `dzongkhags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`),
  ADD UNIQUE KEY `permissions_display_name_uniq` (`display_name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pr_permission_id_index` (`permission_id`),
  ADD KEY `pr_role_id_index` (`role_id`);

--
-- Indexes for table `programmes`
--
ALTER TABLE `programmes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prog_code` (`programme_code`,`programme_name`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `semester_name_2` (`semester_name`),
  ADD KEY `semester_name` (`semester_name`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stdno` (`user_id`,`cidno`),
  ADD KEY `department_id` (`programme_id`);

--
-- Indexes for table `tutors`
--
ALTER TABLE `tutors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cidno` (`cidno`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`name`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assigned_roles`
--
ALTER TABLE `assigned_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `course_programme`
--
ALTER TABLE `course_programme`
  MODIFY `pivot_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `course_student`
--
ALTER TABLE `course_student`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `dzongkhags`
--
ALTER TABLE `dzongkhags`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tutors`
--
ALTER TABLE `tutors`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `assigned_roles`
--
ALTER TABLE `assigned_roles`
  ADD CONSTRAINT `assigned_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assigned_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_programme`
--
ALTER TABLE `course_programme`
  ADD CONSTRAINT `course_programme_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_programme_ibfk_2` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_programme_ibfk_3` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`);

--
-- Constraints for table `course_student`
--
ALTER TABLE `course_student`
  ADD CONSTRAINT `course_student_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `course_student_ibfk_2` FOREIGN KEY (`course_programme_id`) REFERENCES `course_programme` (`pivot_id`);

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`tutor_id`) REFERENCES `tutors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `programmes`
--
ALTER TABLE `programmes`
  ADD CONSTRAINT `programmes_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
