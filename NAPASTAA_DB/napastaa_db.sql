-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 07:21 AM
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
-- Database: `napastaa_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'napastaa@gmail.com', '0000');

-- --------------------------------------------------------

--
-- Table structure for table `adoption_applications`
--

CREATE TABLE `adoption_applications` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `child_name` varchar(255) NOT NULL,
  `child_age` int(11) NOT NULL,
  `child_gender` enum('male','female','other') NOT NULL,
  `child_picture` varchar(255) NOT NULL,
  `household_members` varchar(255) NOT NULL,
  `ages_relationships` varchar(255) NOT NULL,
  `employment_status` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `income` decimal(10,2) NOT NULL,
  `home_type` varchar(255) NOT NULL,
  `space_for_child` varchar(255) NOT NULL,
  `neighborhood_environment` varchar(255) NOT NULL,
  `references` varchar(255) NOT NULL,
  `motivation_statement` text NOT NULL,
  `background_check` varchar(255) NOT NULL,
  `child_abuse_clearance` varchar(255) NOT NULL,
  `creation_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adoption_applications`
--

INSERT INTO `adoption_applications` (`id`, `name`, `email`, `phone`, `address`, `child_name`, `child_age`, `child_gender`, `child_picture`, `household_members`, `ages_relationships`, `employment_status`, `occupation`, `income`, `home_type`, `space_for_child`, `neighborhood_environment`, `references`, `motivation_statement`, `background_check`, `child_abuse_clearance`, `creation_date`, `created_at`) VALUES
(1, 'John Mwangi', 'johnmwangi@gmail.com', '+254784701442', '123 nairobi', 'Amani Njeri', 5, 'female', '10.jpg', '4', ' 30 (Father), 28 (Mother), 10 (Sibling), 7 (Sibling)', 'Employed', 'Teacher', 50000.00, 'Apartment', 'One bedroom', 'Safe and friendly', 'Jane  +254798765432', 'yy', 'No criminal record', 'Cleared', '2024-10-26', '2024-10-26 14:47:55'),
(2, 'Alice Nanetia', 'alice@gmail.com', '+254743724022', '3495 Paul St', 'Aggrey Orina', 14, 'male', 'swing.jpg', '3', ' 35 (Father), 28 (Mother), 2 (Sibling)', 'Employed', 'Engineer', 500000.00, 'Apartment', 'One bedroom', 'Safe and friendly', 'Allan  +254798765432', 'i want to help children in need of a home', 'No criminal record', 'Cleared', '2024-10-26', '2024-10-26 15:02:31');

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE `children` (
  `id` int(11) NOT NULL,
  `child_name` varchar(100) NOT NULL,
  `child_age` int(11) NOT NULL,
  `child_gender` enum('Male','Female','Other') NOT NULL,
  `date_of_birth` date NOT NULL,
  `medical_history` text NOT NULL,
  `admission_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`id`, `child_name`, `child_age`, `child_gender`, `date_of_birth`, `medical_history`, `admission_date`) VALUES
(1, 'Amani Mwangi', 8, 'Male', '2015-02-10', 'None', '2021-09-01'),
(2, 'Wanjiru Njeri', 7, 'Female', '2016-05-15', 'Allergies', '2021-09-01'),
(3, 'Juma Otieno', 9, 'Male', '2014-08-22', 'Asthma', '2020-08-15'),
(4, 'Aisha Abdi', 6, 'Female', '2017-11-30', 'None', '2021-09-01'),
(5, 'Kamau Mwangi', 10, 'Male', '2013-01-05', 'Diabetes Type 1', '2019-05-20'),
(6, 'Zuri Wairimu', 5, 'Female', '2018-02-18', 'None', '2022-01-10'),
(7, 'Karanja Ndungu', 8, 'Male', '2015-06-25', 'None', '2021-09-01'),
(8, 'Nyambura Chege', 7, 'Female', '2016-05-10', 'Mild Eczema', '2021-09-01'),
(9, 'Otis Kiptoo', 9, 'Male', '2014-08-14', 'None', '2020-08-15'),
(10, 'Amani Wambui', 6, 'Female', '2017-12-05', 'None', '2021-09-01'),
(11, 'Baraka Muriuki', 8, 'Male', '2015-03-12', 'None', '2021-09-01'),
(12, 'Jecinta Wairimu', 7, 'Female', '2016-09-20', 'Allergies', '2021-09-01'),
(13, 'Abdi Hassan', 9, 'Male', '2014-07-30', 'Asthma', '2020-08-15'),
(14, 'Fatuma Akinyi', 6, 'Female', '2017-11-11', 'None', '2021-09-01'),
(15, 'Mwangi Kibet', 10, 'Male', '2013-01-25', 'Diabetes Type 1', '2019-05-20'),
(16, 'Nia Njeri', 5, 'Female', '2018-03-18', 'None', '2022-01-10'),
(17, 'Juma Nyaga', 8, 'Male', '2015-04-15', 'None', '2021-09-01'),
(18, 'Kezia Wambui', 7, 'Female', '2016-06-30', 'Mild Eczema', '2021-09-01'),
(19, 'Otieno Mbugua', 9, 'Male', '2014-09-10', 'None', '2020-08-15'),
(20, 'Asha Karanja', 6, 'Female', '2017-10-20', 'None', '2021-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `donation_type` enum('Food','Cloth','Cash','Other') DEFAULT NULL,
  `donation_amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `dedication` text DEFAULT NULL,
  `mpesa_phone_number` varchar(15) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_account_number` varchar(20) DEFAULT NULL,
  `bank_branch` varchar(100) DEFAULT NULL,
  `paypal_email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `name`, `phone_number`, `email`, `donation_type`, `donation_amount`, `payment_method`, `dedication`, `mpesa_phone_number`, `bank_name`, `bank_account_number`, `bank_branch`, `paypal_email`, `created_at`) VALUES
(1, 'Wanjiru Mwangi', '+254712345678', 'wanjiru.mwangi@gmail.com', 'Food', 5000.00, 'MPESA', 'For the children', '0712345678', 'Equity Bank', '123456789', 'Nairobi', 'wanjiru.mwangi@gmail.com', '2024-10-28 02:36:04'),
(2, 'Juma Otieno', '+254723456789', 'juma.otieno@gmail.com', 'Cloth', 2000.00, 'Bank Transfer', 'In memory of my father', NULL, 'KCB Bank', '987654321', 'Mombasa', 'juma.otieno@gmail.com', '2024-10-28 02:36:04'),
(3, 'Amina Abdi', '+254734567890', 'amina.abdi@gmail.com', 'Cash', 10000.00, 'PayPal', 'For the community', NULL, NULL, NULL, NULL, 'amina.abdi@gmail.com', '2024-10-28 02:36:04'),
(4, 'Kipkoech Tanui', '+254745678901', 'kipkoech.tanui@gmail.com', 'Other', 7500.00, 'MPESA', 'For the environment', '0745678901', 'Co-operative Bank', '456789123', 'Eldoret', 'kipkoech.tanui@gmail.com', '2024-10-28 02:36:04'),
(5, 'Miriam Njeri', '+254756789012', 'miriam.njeri@gmail.com', 'Food', 3000.00, 'Cash', 'For education', NULL, NULL, NULL, NULL, NULL, '2024-10-28 02:36:04'),
(6, 'David Karanja', '+254767890123', 'david.karanja@gmail.com', 'Other', 1500.00, 'MPESA', 'Support for health', '0767890123', 'Standard Chartered', '321654987', 'Nairobi', 'david.karanja@gmail.com', '2024-10-28 02:36:04'),
(7, 'Grace Wairimu', '+254778901234', 'grace.wairimu@gmail.com', 'Cloth', 8000.00, 'Bank Transfer', 'For animal welfare', NULL, 'Absa Bank', '654321789', 'Nairobi', 'grace.wairimu@gmail.com', '2024-10-28 02:36:04'),
(8, 'Peter Mwangi', '+254789012345', 'peter.mwangi@gmail.com', 'Cash', 6000.00, 'PayPal', 'For community development', NULL, NULL, NULL, NULL, 'peter.mwangi@gmail.com', '2024-10-28 02:36:04'),
(9, 'Fatuma Ali', '+254790123456', 'fatuma.ali@gmail.com', 'Other', 4000.00, 'Cash', 'In support of education', NULL, NULL, NULL, NULL, NULL, '2024-10-28 02:36:04'),
(10, 'Samuel Ndungu', '+254801234567', 'samuel.ndungu@gmail.com', 'Food', 2500.00, 'MPESA', 'For youth empowerment', '0781234567', 'Family Bank', '789456123', 'Nairobi', 'samuel.ndungu@gmail.com', '2024-10-28 02:36:04');

-- --------------------------------------------------------

--
-- Table structure for table `staff_info`
--

CREATE TABLE `staff_info` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `id_number` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `department` varchar(50) DEFAULT NULL,
  `supervisor` varchar(50) DEFAULT NULL,
  `employment_date` date NOT NULL,
  `employment_status` enum('Full-time','Part-time','Volunteer') NOT NULL,
  `work_shift` varchar(20) DEFAULT NULL,
  `education_level` varchar(50) NOT NULL,
  `certifications` text DEFAULT NULL,
  `skills` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_info`
--

INSERT INTO `staff_info` (`id`, `name`, `id_number`, `dob`, `gender`, `phone`, `email`, `job_title`, `department`, `supervisor`, `employment_date`, `employment_status`, `work_shift`, `education_level`, `certifications`, `skills`) VALUES
(1, 'John Ochieng', '123456789', '1978-03-15', 'Male', '0701234567', 'john@napastaa.org', 'Principal', 'Administration', 'Board of Directors', '2018-01-01', 'Full-time', 'Day Shift', 'Master\'s in Ed.', 'Leadership, Management', 'Strategic Planning'),
(2, 'Grace Njeri', '234567890', '1982-07-20', 'Female', '0722345678', 'grace@napastaa.org', 'Program Manager', 'Operations', 'John Ochieng', '2019-06-15', 'Full-time', 'Day Shift', 'Master\'s in Soc.', 'Project Management', 'Program Development'),
(3, 'David Kamau', '345678901', '1985-01-25', 'Male', '0733456789', 'david@napastaa.org', 'Finance Officer', 'Finance', 'John Ochieng', '2018-03-12', 'Full-time', 'Day Shift', 'Bachelor\'s in Fin.', 'CPA, Financial Analysis', 'Budget Management'),
(4, 'Rose Akinyi', '456789012', '1988-05-10', 'Female', '0744567890', 'rose@napastaa.org', 'Child Welfare Coordinator', 'Child Services', 'Grace Njeri', '2018-09-30', 'Full-time', 'Day Shift', 'Bachelor\'s in SW', 'Child Protection', 'Counseling, Case Mgmt'),
(5, 'Peter Mwangi', '567890123', '1990-11-05', 'Male', '0755678901', 'peter@napastaa.org', 'Education Coordinator', 'Child Services', 'Grace Njeri', '2018-11-15', 'Full-time', 'Day Shift', 'B.Ed.', 'Teaching, Curriculum Dev.', 'Educational Leadership'),
(6, 'Susan Wambui', '678901234', '1992-08-18', 'Female', '0766789012', 'susan@napastaa.org', 'Social Worker', 'Child Services', 'Rose Akinyi', '2018-05-21', 'Full-time', 'Day Shift', 'Bachelor\'s in SW', 'Counseling, Social Work', 'Case Management'),
(7, 'Mary Atieno', '789012345', '1987-09-10', 'Female', '0777890123', 'mary@napastaa.org', 'Health and Wellness Officer', 'Health Services', 'Grace Njeri', '2018-01-10', 'Full-time', 'Day Shift', 'Diploma in Nsg.', 'First Aid, Health Mgmt', 'Health Education'),
(8, 'Samuel Otieno', '890123456', '1983-12-15', 'Male', '0788901234', 'samuel@napastaa.org', 'Security Officer', 'Security', 'John Ochieng', '2018-02-25', 'Full-time', 'Night Shift', 'Diploma in Sec.', 'Conflict Resolution', 'Safety Management'),
(9, 'Anne Nduta', '901234567', '1995-04-22', 'Female', '0799012345', 'anne@napastaa.org', 'Administrative Assistant', 'Administration', 'John Ochieng', '2018-07-18', 'Full-time', 'Day Shift', 'Diploma in Bus.', 'Office Administration', 'Communication Skills'),
(10, 'James Kariuki', '012345678', '1980-02-07', 'Male', '0710123456', 'james@napastaa.org', 'Maintenance Supervisor', 'Maintenance', 'John Ochieng', '2018-04-05', 'Full-time', 'Day Shift', 'Diploma in Mech.', 'Facilities Management', 'Plumbing, Electrical'),
(11, 'Lucy Wanjiru', '112345679', '1986-03-25', 'Female', '0791234567', 'lucy@napastaa.org', 'Teacher', 'Education', 'Peter Mwangi', '2018-02-15', 'Full-time', 'Day Shift', 'B.Ed.', 'Teaching, Child Dev.', 'Classroom Management'),
(12, 'George Oduor', '122345679', '1990-06-10', 'Male', '0712345678', 'george@napastaa.org', 'Teacher', 'Education', 'Peter Mwangi', '2019-01-20', 'Full-time', 'Day Shift', 'B.Ed.', 'Teaching, Math Education', 'Curriculum Development'),
(13, 'Esther Njoki', '132345679', '1993-09-05', 'Female', '0723456789', 'esther@napastaa.org', 'Teacher', 'Education', 'Peter Mwangi', '2020-07-10', 'Full-time', 'Day Shift', 'B.Ed.', 'Teaching, Early Childhood', 'Classroom Management');

-- --------------------------------------------------------

--
-- Table structure for table `upcoming_events`
--

CREATE TABLE `upcoming_events` (
  `id` int(11) NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_description` text NOT NULL,
  `event_image` varchar(255) NOT NULL,
  `completed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `upcoming_events`
--

INSERT INTO `upcoming_events` (`id`, `event_title`, `event_date`, `event_description`, `event_image`, `completed`) VALUES
(1, 'Volunteer Orientation', '0000-00-00', 'Learn how you can make a difference by volunteering with us', '', 0),
(2, 'FOOD /HEALTH', '2025-02-02', 'sdrtyu', '', 0),
(3, 'FOOD /HEALTH', '2025-02-02', 'sdrtyu', '', 0),
(4, 'FOOD /HEALTH', '2025-02-02', 'sdrtyu', '', 0),
(5, 'FOOD /HEALTH', '2025-02-02', 'sdrtyu', '', 0),
(6, 'FOOD /HEALTH', '2025-02-02', 'sdrtyu', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `visit_date` date NOT NULL,
  `visit_time` time NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `name`, `email`, `phone_number`, `visit_date`, `visit_time`, `purpose`, `comments`) VALUES
(1, 'Juma Mwangi', 'juma.mwangi@gmail.com', '0712345678', '2024-12-01', '09:00:00', 'Inquiry about adoption', 'Looking for information on the adoption process.'),
(2, 'Wanjiru Njeri', 'wanjiru.njeri@gmail.com', '0723456789', '2025-10-02', '10:30:00', 'Follow-up visit', 'Interested in adopting a child.'),
(3, 'Kipkoech Chebet', 'kipkoech.chebet@gmail.com', '0734567890', '2025-10-03', '11:00:00', 'Donation', 'Bringing donations for the children.'),
(4, 'Aisha Abdi', 'aisha.abdi@gmail.com', '0745678901', '2024-11-04', '14:00:00', 'Volunteer inquiry', 'Wants to volunteer at the home.'),
(5, 'Kamau Ndungu', 'kamau.ndungu@gmail.com', '0756789012', '2025-10-05', '15:30:00', 'General inquiry', 'Asking about the services offered.'),
(6, 'Fatuma Wairimu', 'fatuma.wairimu@gmail.com', '0767890123', '2025-10-06', '08:45:00', 'Visit children', 'Wants to visit and spend time with the children.'),
(7, 'Otieno Ochieng', 'otieno.ochieng@gmail.com', '0778901234', '2025-10-07', '13:15:00', 'Adoption process', 'Inquiring about the adoption process.'),
(8, 'Zuri Muthoni', 'zuri.muthoni@gmail.com', '0789012345', '2025-10-08', '12:00:00', 'Donation', 'Bringing clothes and toys for the children.'),
(9, 'Jecinta Njeri', 'jecinta.njeri@gmail.com', '0790123456', '2024-11-09', '09:30:00', 'Volunteer inquiry', 'Wants to know how to help.'),
(10, 'Abdi Hassan', 'abdi.hassan@gmail.com', '0701234567', '2025-01-10', '10:00:00', 'General inquiry', 'Interested in learning more about the organization.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adoption_applications`
--
ALTER TABLE `adoption_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_info`
--
ALTER TABLE `staff_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upcoming_events`
--
ALTER TABLE `upcoming_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_upcoming_events_id` (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `adoption_applications`
--
ALTER TABLE `adoption_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `children`
--
ALTER TABLE `children`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `staff_info`
--
ALTER TABLE `staff_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `upcoming_events`
--
ALTER TABLE `upcoming_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
