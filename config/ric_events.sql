-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2024 at 11:21 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currentuser`
--

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
(1, 'Lance Grayson Musngi', 'lance', 'lance.musngi@gmail.com', NULL, NULL, 'uploads/profile/lance.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `EventID` int(11) NOT NULL,
  `EventTitle` varchar(255) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Date` date NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Available` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`EventID`, `EventTitle`, `Description`, `Date`, `Location`, `Available`) VALUES
(1, 'Career Fair', 'Meet potential employers and explore job opportunities. Open to all graduating students.', '2024-06-05', 'Bulacan State University Gymnasium', 0),
(2, 'Science Symposium', 'Presentations and discussions on recent advancements in various fields of science.', '2024-06-06', 'Bulacan State University Auditorium', 1),
(3, 'Sleep Over ', 'Sleep Over sa bahay ni James Raille Sition, Foods dala ni Mae Reyes then si adrian Tokis Sleep Over sa bahay ni James Raille Sition, Foods dala ni Mae Reyes then si adrian Tokis Sleep Over sa bahay ni James Raille Sition, Foods dala ni Mae Reyes then si adrian Tokis Sleep Over sa bahay ni James Raille Sition, Foods dala ni Mae Reyes then si adrian Tokis Sleep Over sa bahay ni James Raille Sition, Foods dala ni Mae Reyes then si adrian Tokis ', '2024-05-31', 'James raile\'s House', 1),
(4, 'Coding Bootcamp', 'Intensive coding bootcamp covering Python, JavaScript, and SQL. Ideal for beginners and intermediate coders.\r\n', '2024-06-02', 'Bulacan State University', 0),
(5, 'Art Exhibit', 'Showcase of student artworks from the Fine Arts department. Open to the public.\r\n', '2024-06-06', 'Bulacan State University Gallery', 0),
(6, 'Music Festival', 'Annual music festival featuring bands and solo artists from the university.\r\n', '2024-06-04', 'Bulacan State University Main Grounds', 0),
(7, 'Tech Startup Workshop', 'Workshop for aspiring tech entrepreneurs covering startup essentials and pitching techniques.', '2024-06-17', 'Innovate Hub Co-working Space', 0),
(8, 'Fashion Show', 'Annual fashion show featuring designs by students and local designers. Runway and exhibition.', '2024-06-18', 'Glamour Events Hall', 0),
(9, 'Food Festival', 'Celebration of local cuisine with food stalls, cooking demonstrations, and live music.', '2024-06-19', 'Culinary Delights Plaza', 0),
(10, 'Fitness Bootcamp', 'Intensive fitness bootcamp with certified trainers. Outdoor workout sessions and nutrition seminars.', '2024-06-20', 'FitZone Park', 0),
(11, 'Artisan Market', 'Market showcasing handmade crafts, arts, and gourmet foods by local artisans. Shopping and live entertainment.', '2024-06-21', 'Artisan Alley', 0);

-- --------------------------------------------------------

--
-- Table structure for table `myevents`
--

CREATE TABLE `myevents` (
  `MyEventID` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `eventid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `myevents`
--

INSERT INTO `myevents` (`MyEventID`, `customer_id`, `eventid`) VALUES
(1, 4, 2),
(2, 4, 3),
(4, 6, 3),
(6, 6, 2),
(8, 5, 3),
(9, 0, 1),
(10, 4, 1),
(11, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

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
-- Table structure for table `slideshow`
--

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

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `FName` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `verification_code` int(11) NOT NULL,
  `verified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FName`, `Username`, `Password`, `Email`, `profile`, `verification_code`, `verified`) VALUES
(4, 'Lance Grayson Musngi', 'lance', '$2y$10$dbB2ID5r7mt.x8q5o95opeN0O0wd2lZWZLeV.Ab4rWPKfXjTSVprW', 'lance.musngi@gmail.com', 'uploads/profile/lance.png', 52203, 1),
(5, 'kyle musngi', 'kyle', '$2y$10$8gwxzNABhoPr.SE4rhbqkOmCgzeUa97zcD7Vt2zmXjGfxrajFZ3F.', 'lanceka456@gmail.com', 'css/img/new.png', 30762, 1),
(6, 'Ricmar Events', 'ricmar', '$2y$10$8gwxzNABhoPr.SE4rhbqkOmCgzeUa97zcD7Vt2zmXjGfxrajFZ3F.', 'lanceka4567@gmail.com', 'css/img/new.png', 30764, 1),
(7, 'kyle musngi77', 'kyle77', '$2y$10$8gwxzNABhoPr.SE4rhbqkOmCgzeUa97zcD7Vt2zmXjGfxrajFZ3F.', 'lanceka45677@gmail.com', 'css/img/new.png', 30761, 1);

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
  ADD PRIMARY KEY (`EventID`);

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
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `myevents`
--
ALTER TABLE `myevents`
  MODIFY `MyEventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
