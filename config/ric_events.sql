-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2024 at 12:01 PM
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
-- Database: `ric_events`
--
CREATE DATABASE IF NOT EXISTS `ric_events` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ric_events`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currentuser`
--

DROP TABLE IF EXISTS `currentuser`;
CREATE TABLE `currentuser` (
  `UserId` int(11) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `profile` varchar(200) NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `currentuser`
--

INSERT INTO `currentuser` (`UserId`, `FName`, `username`, `email`, `address`, `phone`, `profile`, `admin`) VALUES
(1, 'Lance Musngi', '0', 'lance.musngi@gmail.com', NULL, NULL, 'css/img/new.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `EventID` int(11) NOT NULL,
  `EventTitle` varchar(255) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Date` date NOT NULL,
  `Location` varchar(255) NOT NULL,
  `EventImg` varchar(255) NOT NULL,
  `Available` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 = need aproval\r\n1 = aproved',
  `Method` varchar(255) NOT NULL,
  `Price` float NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`EventID`, `EventTitle`, `Description`, `Date`, `Location`, `EventImg`, `Available`, `status`, `Method`, `Price`, `UserID`) VALUES
(1, 'Career Fair', 'Meet potential employers and explore job opportunities. Open to all graduating students.', '2024-07-23', 'Adrians House', 'uploads/events/Glamour Events Hall.jpg', 100, 1, '', 0, 1),
(2, 'Science Symposium', 'Presentations and discussions on recent advancements in various fields of science.', '2024-07-24', 'Bulacan State University Gymnasium', 'uploads\\events\\Bulacan State University Gymnasium.jpg', 100, 1, '', 0, 1),
(4, 'Coding Bootcamp', 'Intensive coding bootcamp covering Python, JavaScript, and SQL. Ideal for beginners and intermediate coders.\r\n', '2024-07-25', 'Bulacan State University', 'uploads\\events\\Bulacan State University.jpg', 50, 1, '', 0, 1),
(5, 'Art Exhibit', 'Showcase of student artworks from the Fine Arts department. Open to the public.\r\n', '2024-07-26', 'Bulacan State University Gymnasium', 'uploads\\events\\Bulacan State University Gymnasium.jpg', 50, 1, '', 0, 1),
(6, 'Music Festival', 'Annual music festival featuring bands and solo artists from the university.\r\n', '2024-07-28', 'Bulacan State University Main Grounds', 'uploads\\events\\Bulacan State University Main Grounds.jpg', 50, 1, '', 0, 1),
(7, 'Tech Startup Workshop', 'Workshop for aspiring tech entrepreneurs covering startup essentials and pitching techniques.', '2024-07-29', 'Innovate Hub Co-working Space', 'uploads\\events\\Innovate Hub Co-working Space.jpg', 10, 1, '', 0, 1),
(8, 'Fashion Show', 'Annual fashion show featuring designs by students and local designers. Runway and exhibition.', '2024-07-30', 'Glamour Events Hall', 'uploads\\events\\Glamour Events Hall.jpg', 50, 1, '', 0, 1),
(9, 'Food Festival', 'Celebration of local cuisine with food stalls, cooking demonstrations, and live music.', '2024-07-31', 'Culinary Delights Plaza', 'uploads\\events\\Culinary Delights Plaza.jpg', 1, 1, '', 0, 1),
(10, 'Fitness Bootcamp', 'Intensive fitness bootcamp with certified trainers. Outdoor workout sessions and nutrition seminars.', '2024-07-20', 'FitZone Park', 'uploads\\events\\fitzone.jpg', 100, 1, '', 0, 1),
(11, 'Artisan Market', 'Market showcasing handmade crafts, arts, and gourmet foods by local artisans. Shopping and live entertainment.', '2024-07-21', 'Artisan Alley', 'uploads\\events\\Artisan Alley.jpg', 50, 1, '', 0, 15),
(3, 'Sleep Over', 'Sleep Over sa bahay ni James Raille Sition, Foods dala ni Mae Reyes then si adrian Tokis Sleep Over sa bahay ni James Raille Sition, Foods dala ni Mae Reyes then si adrian Tokis Sleep Over sa bahay ni James Raille Sition, Foods dala ni Mae Reyes then si adrian Tokis Sleep Over sa bahay ni James Raille Sition, Foods dala ni Mae Reyes then si adrian Tokis Sleep Over sa bahay ni James Raille Sition, Foods dala ni Mae Reyes then si adrian Tokis ', '2024-07-22', 'Adrians House', 'uploads/events/sleepover.png', 20, 1, 'Maya', 3000, 15),
(61, 'Peyment na', 'sdsadasd', '2024-08-01', 'test', 'uploads/events/Bulacan State University.jpg', 100, 1, 'Debit Card', 15000, 15);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE `location` (
  `LocationID` int(11) NOT NULL,
  `LocationName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`LocationID`, `LocationName`) VALUES
(2, 'Adrians House'),
(3, 'Artisan Alley'),
(4, 'Bulacan State University'),
(1, 'Bulacan State University Gymnasium'),
(5, 'Bulacan State University Main Grounds'),
(6, 'Culinary Delights Plaza'),
(7, 'FitZone Park'),
(8, 'Glamour Events Hall'),
(9, 'Innovate Hub Co-working Space'),
(10, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `myevents`
--

DROP TABLE IF EXISTS `myevents`;
CREATE TABLE `myevents` (
  `MyEventID` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `myevents`
--

INSERT INTO `myevents` (`MyEventID`, `customer_id`, `eventid`, `status`) VALUES
(27, 1, 3, 0),
(41, 15, 3, 0),
(44, 1, 29, 0);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `ItemID` int(11) NOT NULL,
  `Itemname` varchar(50) NOT NULL,
  `value` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`ItemID`, `Itemname`, `value`) VALUES
(1, 'Logo', 'css/img/logo.png'),
(2, 'Company Name', 'Ric Events'),
(3, 'Background Image', 'uploads/page/pexels-pixabay-139398.jpg'),
(4, 'Background Color', '#ffffff'),
(5, 'Text Color', '#000000');

-- --------------------------------------------------------

--
-- Table structure for table `paymethod`
--

DROP TABLE IF EXISTS `paymethod`;
CREATE TABLE `paymethod` (
  `method_name` varchar(255) NOT NULL,
  `method_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymethod`
--

INSERT INTO `paymethod` (`method_name`, `method_img`) VALUES
('BPI', 'upload\\method\\link-91720ed84858d490ca62142de0494559.png'),
('Debit Card', 'upload\\method\\link-cf7aaa8b59e07c8548d2f03f0d930acb.png'),
('Maya', 'upload\\method\\link-4a1f1c2d9ee1820ccc9621b44f277387.png'),
('Visa', 'upload\\method\\link-8efc3b564e08e9e864ea83ab43d9f913.png');

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

DROP TABLE IF EXISTS `slideshow`;
CREATE TABLE `slideshow` (
  `SlideID` int(11) NOT NULL,
  `imagename` varchar(50) NOT NULL,
  `imagelocation` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`SlideID`, `imagename`, `imagelocation`) VALUES
(1, 'slide1', 'uploads/slideshow/1.png'),
(2, 'slide2', 'uploads/slideshow/1.png'),
(3, 'slide3', 'uploads/slideshow/1.png'),
(4, 'slide4', 'uploads/slideshow/1.png'),
(5, 'slide5', 'uploads/slideshow/1.png'),
(6, 'slide6', 'uploads/slideshow/1.png'),
(7, 'slide7', 'uploads/slideshow/1.png'),
(8, 'slide8', 'uploads/slideshow/1.png'),
(9, 'slide9', 'uploads/slideshow/1.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `FName` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `verification_code` int(11) NOT NULL,
  `verified` int(11) NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FName`, `Username`, `Password`, `Email`, `profile`, `verification_code`, `verified`, `admin`) VALUES
(1, 'Ric Eventss', 'admin', '$2y$10$oilozmptugxLRFN2w/DuCe3jwfVC5P9tGvPBFj5ShPX.bffpErUW.', 'ric.events@gmail.com', 'uploads/profile/logo.png', 1, 1, 1),
(11, 'Leoniel Mae Reyes', 'Leo', '$2y$10$.YYROuWgaxYv.Uo0Lxffx.lHu9yq7.Rp9bMGnUKpFwlt/UhJErNaC', 'reyesleoneilmae@gmail.com', 'css/img/new.png', 0, 0, 0),
(13, 'jan ric', 'ric', '$2y$10$c.hM2Nd3sd28zLXaqFDEdOTwDoK36q8blkkm9ZNfrkhlNsFMxcKZa', 'johnricmaralagos9@gmail.com', 'css/img/new.png', 16844, 1, 0),
(14, 'ric mar', 'ricmar', '$2y$10$7ARA6p7Qwof61.E91gZ/7.z9aAyMMeRC0/DayMabRdpMLI9s19.6m', 'johnricmar.alagos.c@gmail.com', 'uploads/profile/bf098655-3eb7-408e-b7d5-e4a3e1a1bd79.jpg', 55439, 1, 1),
(15, 'Lance Musngi', 'lance', '$2y$10$qZ9z3..HAEChN6Xd5sXjju.3VMznwztaokjF4IgpnDKz2O1sAbKCG', 'lance.musngi@gmail.com', 'css/img/new.png', 19800, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `currentuser`
--
ALTER TABLE `currentuser`
  ADD PRIMARY KEY (`UserId`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EventID`),
  ADD UNIQUE KEY `Date` (`Date`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`LocationID`),
  ADD UNIQUE KEY `LocationName` (`LocationName`);

--
-- Indexes for table `myevents`
--
ALTER TABLE `myevents`
  ADD PRIMARY KEY (`MyEventID`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `paymethod`
--
ALTER TABLE `paymethod`
  ADD PRIMARY KEY (`method_name`);

--
-- Indexes for table `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`SlideID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currentuser`
--
ALTER TABLE `currentuser`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `LocationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `myevents`
--
ALTER TABLE `myevents`
  MODIFY `MyEventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `SlideID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
