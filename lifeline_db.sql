-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2022 at 05:17 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lifelinedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminacc`
--

CREATE TABLE `adminacc` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminacc`
--

INSERT INTO `adminacc` (`id`, `name`, `username`, `password`) VALUES
(1, 'Zyrah Avila', 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `drive_id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `is_active` varchar(255) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `drive_id` int(11) NOT NULL,
  `blood_code` varchar(255) NOT NULL,
  `blood_type` varchar(255) NOT NULL,
  `blood_rh` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `tracking` varchar(255) NOT NULL DEFAULT 'In Storage',
  `confirm` varchar(255) NOT NULL DEFAULT 'Pending',
  `is_active` varchar(255) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `bday` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `employment` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phonenum` varchar(50) NOT NULL,
  `phonetype` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `blood_type` varchar(255) NOT NULL,
  `blood_rh` varchar(255) NOT NULL,
  `available` varchar(255) NOT NULL DEFAULT 'Available',
  `is_active` varchar(255) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`id`, `name`, `city`, `bday`, `gender`, `employment`, `email`, `phonenum`, `phonetype`, `username`, `password`, `blood_type`, `blood_rh`, `available`, `is_active`) VALUES
(1, 'Nicole Avila', 'Taguig', '1999-06-08', 'Female', 'Student', 'avila.zyrah@gmail.com', '09751070345', 'Mobile', 'zyrah', 'zyrah123', 'AB', '+', 'Available', 'Yes'),
(2, 'Jacob Lopez', 'San Juan', '2000-03-09', 'Male', 'Self Employed', 'jlopez@yahoo.com', '09365946244', 'Mobile', 'jlopez', 'jlopez123', 'O', '+', 'Available', 'Yes'),
(3, 'Sabrina Flores', 'Caloocan', '1994-02-15', 'Female', 'Full-time Employed', 'florsab215@outlook.com', '09465846245', 'Mobile', 'sabrina', 'sabrina123', 'B', '+ ', 'Available', 'Yes'),
(4, 'Wade Torres', 'Manila\r\n', '2004-01-10', 'Male\r\n', 'Unemployed\r\n', 'torres_wade@gmail.com\r\n', '09254735475', 'Mobile\r\n', 'twade', 'twade123', 'A', '-', 'Available', 'Yes'),
(5, 'Yasmin Garcia', 'Valenzuela', '1993-10-20', 'Female', 'Full-Employed', 'yasming1993@yahoo.com', '09985638566', 'Mobile', 'yasming', 'yasmin123', 'O', '-', 'Available', 'Yes'),
(6, 'Pablo Perez', 'Marikina', '1996-05-31', 'Male', 'Retired', 'pabloperez@gmail.com', '09364836475', 'Mobile', 'pablop', 'pablop123', 'O', '+ ', 'Available', 'Yes'),
(7, 'Madison Hernandez', 'Manila', '1999-04-17', 'Female', 'Student', 'maddez@gmail.com', '09648364857', 'Mobile', 'maddez', 'maddez123', 'AB', '+ ', 'Available', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `drive`
--

CREATE TABLE `drive` (
  `id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `details` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `time_start` varchar(255) NOT NULL,
  `time_end` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `is_active` varchar(255) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drive`
--

INSERT INTO `drive` (`id`, `host_id`, `title`, `details`, `city`, `location`, `date_start`, `date_end`, `time_start`, `time_end`, `status`, `is_active`) VALUES
(1, 1, 'Life-Giving Blood Donation Drive', 'The Philippine Biking Group Rizal Chapter together with Red Cross is holding a blood donation drive for it\'s annual foundation ceremony.', 'Rizal', 'Tanay, Rizal', '2022-03-18', '2022-03-20', '09:00:00', '20:00:00', 'Pending', 'Yes'),
(2, 3, 'Bayanihan Na for the UP-PGH Blood Bank\r\n', 'The UP Philippine General Hospital blood stocks are in very critical levels. The blood donor center is open 7 days a week, including holidays, online scheduling is encouraged.\r\n', 'Manila\r\n', 'Ermita, Manila\r\n', '2022-01-01', '2022-12-31', '08:00:00', '16:00:00\r\n', 'On Going', 'Yes'),
(3, 6, '\"Mass Blood Drive for Philippine Red Cross\r\n\"\r\n', 'The Red Cross is experiencing the worst blood shortage in over a decade. The dangerously low blood supply levels have forced some hospitals to defer patients from major surgery, including organ transplants. Your donation is desperately needed.\r\n', 'Batangas\r\n', 'Sto. Tomas, Batangas\r\n', '2022-07-01', '2022-07-08', '09:00:00\r\n', '17:00:00\r\n', 'Pending', 'Yes'),
(4, 4, '\"DFA Conducts Life-Giving Blood Donation Drive\r\n\"\r\n', 'The Department of Foreign Affairs (DFA), led by Foreign Affairs Secretary Teodoro L. Locsin, Jr.,will kick off the Valentine month of February with a blood donation drive with the theme \"Love in the Time of CoVid\" at the DFA’s Bulwagang Apolinario Mabini, Thursday, February 4.\r\n', 'Pasay\r\n', 'Bulwagang Apolinario Mabini, Pasay\r\n', '2022-02-04', '2022-02-04', '13:00:00\r\n', '16:00:00\r\n', 'Done', 'Yes'),
(5, 1, 'PH Red Cross partners with Angkas for blood donation drive\r\n', '\"To help replenish the blood reserves in the country which is currently affected by the coronavirus (COVID-19) pandemic, the Philippine Red Cross (PRC) has partnered with a delivery service provider for a donation drive.\r\n\"\r\n', 'Mandaluyong\r\n', '37 EDSA corner Boni Avenue, Mandaluyong\r\n', '2022-10-26', '2022-12-31', '08:00:00\r\n', '17:00:00\r\n', 'Pending', 'Yes'),
(6, 6, 'Blood drive of PH Red Cross in La Union\r\n', 'Despite the pandemic, the Philippine Red Cross (PRC) moves to ensure that there will be a steady supply of blood in the country through its continuous blood donation drive.\r\n', 'La Union\r\n', 'Bauang, La Union\r\n', '2020-05-02', '2020-05-02', '10:00\r\n', '15:00\r\n', 'Done', 'Yes'),
(7, 5, '\"In response to blood donation call, NPC Ladies Foundation Inc. resumes blood drive\r\n\"\r\n', 'To heed the DOH call for blood donors, the National Power Corporation’s Ladies Foundation Inc. will organize a blood donation drive in its office in Diliman on March 22, in partnership with the Philippine Blood Center of the Department of Health. \r\n', 'Quezon\r\n', 'Diliman, Quezon\r\n', '2022-03-22', '2022-03-22', '07:00\r\n', '14:00\r\n', 'Pending', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `host`
--

CREATE TABLE `host` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `orgname` varchar(255) NOT NULL,
  `orgtype` varchar(255) NOT NULL,
  `orgrole` varchar(255) NOT NULL,
  `bday` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phonenum` varchar(50) NOT NULL,
  `phonetype` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hostedQ` varchar(255) NOT NULL,
  `relQ` varchar(255) NOT NULL,
  `hearQ` varchar(255) NOT NULL,
  `storyQ` varchar(255) NOT NULL,
  `is_active` varchar(255) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `host`
--

INSERT INTO `host` (`id`, `name`, `orgname`, `orgtype`, `orgrole`, `bday`, `gender`, `email`, `phonenum`, `phonetype`, `username`, `password`, `hostedQ`, `relQ`, `hearQ`, `storyQ`, `is_active`) VALUES
(1, 'Jo Ann Jose', 'Philippines Red Cross Rizal Chapter', 'Healthcare', 'Management', '1997-04-02', 'Female', 'jjose@gmail.com', '(02) 8470 9', 'Business', 'rcrizal', '12345678', 'Yes', 'Volunteer', 'Other', 'No', 'Yes'),
(2, 'John  Benedict', 'Philippine Blood Coordinating Council', 'Government', 'Management', '1993-09-13', 'Male', 'benedict@gmail.com', '(02) 8423 5', 'Business', 'pbcc', '12345678', 'Yes', 'Volunteer', 'Other', 'Yes', 'Yes'),
(3, 'Edwin Rodriguez\r\n', 'Philippine Blood Center\r\n', 'Government\r\n', 'Management\r\n', '1992-03-19', 'Male\r\n', 'edwinrodriguez@philippine.blood.center.org\r\n', '(02) 8651 7800', 'Business\r\n', 'pbcedwin', 'pbcedwin123', 'Yes', 'Disaster', 'Referral', 'No', 'Yes'),
(4, 'Abegail Martinez', 'University of Santo Tomas Hospital Blood Bank', 'Healthcare', 'HR', '1995-09-04', 'Female', 'martinezabegail@ust.hospital.org', ' (632) 731-3001', 'Business', 'ust1995', 'ust1995123', 'Yes', 'Disaster', 'Social', 'No', 'Yes'),
(5, 'Halsey Gonzales', 'Sripathi blood donations', 'Healthcare', 'Management', '1993-12-18', 'Female', 'halseygonzales@sripathi.blood.org', '0920 554 7778', 'Mobile', 'sripathibloodorg', 'sripathi123', 'No', 'Volunteer', 'Referral', 'No', 'Yes'),
(6, 'Terrence Rivera', 'Philippine Red Cross - NHQ', 'Healthcare', 'Chairman', '1982-11-24', 'Male', 'terrencerivera@redcross.ph', '(02) 527 6353', 'Business', 'prc_terrence', 'terrence123', 'Yes', 'FinancialDonor', 'Referral', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `hospitalname` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `hours_from` varchar(255) DEFAULT NULL,
  `hours_to` varchar(255) DEFAULT NULL,
  `contactnum` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `is_active` varchar(255) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `city`, `category`, `hospitalname`, `address`, `hours_from`, `hours_to`, `contactnum`, `email`, `is_active`) VALUES
(1, 'Makati', 'Blood Collecting Unit/Blood Station', NULL, 'Johnny Air Building 55 B Dian St. Cor Gil Puyat Ave. Brgy. Palanan Makati', NULL, NULL, '403-6267', 'rizalmakati@redcross.org.ph', 'Yes'),
(2, 'Cavite', 'Hospital', 'De La Salle University Medical Center', 'Congressional Rd, Dasmariñas, 4114 Cavite', '00:30', '01:30', '0234818000', 'dlsumc@gmai.com', 'Yes'),
(3, 'Pasay', 'Blood Center', '', '2354 CAA Compound, Aurora Blvd. (old Tramo), Pasay City', '00:40', '06:30', '09189171181', 'pasay@redcross.org.ph', 'Yes'),
(4, 'Quezon', 'Hospital', 'UERM Memorial Medical Center', 'UERM Memorial Medical Center, Aurora Boulevard, Quezon City, 1100 Metro Manila', '', '', '02871 0861', '', 'Yes'),
(5, 'Manila\r\n', 'Blood Center\r\n', 'UP-PGH Blood Bank\r\n', 'Ermita, Maynila\r\n', '08:00\r\n', '16:00\r\n', '85548400\r\n', NULL, 'Yes'),
(6, 'Las Pinas\r\n', 'Hospital\r\n', 'Perpetual Help Medical Center\r\n', 'Alabang-Zapote Road 1740 Pamplona 3 Las Pinas City \r\n', '00:00\r\n', '00:00\r\n', '(02) 874 8515\r\n', NULL, 'Yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminacc`
--
ALTER TABLE `adminacc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donor appt` (`donor_id`),
  ADD KEY `drive appt` (`drive_id`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donor donation` (`donor_id`),
  ADD KEY `drive donation` (`drive_id`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drive`
--
ALTER TABLE `drive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `host drive` (`host_id`);

--
-- Indexes for table `host`
--
ALTER TABLE `host`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminacc`
--
ALTER TABLE `adminacc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `drive`
--
ALTER TABLE `drive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `host`
--
ALTER TABLE `host`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `donor appt` FOREIGN KEY (`donor_id`) REFERENCES `donor` (`id`),
  ADD CONSTRAINT `drive appt` FOREIGN KEY (`drive_id`) REFERENCES `drive` (`id`);

--
-- Constraints for table `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `donor donation` FOREIGN KEY (`donor_id`) REFERENCES `donor` (`id`),
  ADD CONSTRAINT `drive donation` FOREIGN KEY (`drive_id`) REFERENCES `drive` (`id`);

--
-- Constraints for table `drive`
--
ALTER TABLE `drive`
  ADD CONSTRAINT `host drive` FOREIGN KEY (`host_id`) REFERENCES `host` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
