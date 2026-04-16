-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2026 at 09:13 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drinkitgrigorii`
--

-- --------------------------------------------------------

--
-- Table structure for table `aines`
--

CREATE TABLE `aines` (
  `Aineksen_ID` int(10) NOT NULL,
  `Nimi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aines`
--

INSERT INTO `aines` (`Aineksen_ID`, `Nimi`) VALUES
(1, 'Coca-Cola'),
(2, 'Paulainer'),
(3, 'Vesi'),
(4, 'Vodka');

-- --------------------------------------------------------

--
-- Table structure for table `aines_määrä`
--

CREATE TABLE `aines_määrä` (
  `Määrä` varchar(30) NOT NULL,
  `Reseptin_ID` int(10) NOT NULL,
  `Aineksen_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aines_määrä`
--

INSERT INTO `aines_määrä` (`Määrä`, `Reseptin_ID`, `Aineksen_ID`) VALUES
('1kpl', 5, 2),
('1kpl', 6, 2),
('50ml', 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `käyttäjät`
--

CREATE TABLE `käyttäjät` (
  `Käyttäjätunnus` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Salasana` varchar(100) NOT NULL,
  `Rooli` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `käyttäjät`
--

INSERT INTO `käyttäjät` (`Käyttäjätunnus`, `Email`, `Salasana`, `Rooli`) VALUES
('mainManraz', 'asdfghjklqwertybb@gmail.com', '1812', 'admin'),
('manraz', 'gregory.razuvaev@yandex.ru', '1234', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `resepti`
--

CREATE TABLE `resepti` (
  `Reseptin_ID` int(10) NOT NULL,
  `Reseptin_nimi` varchar(50) NOT NULL,
  `Juomalaji` varchar(50) NOT NULL,
  `Ohjet` varchar(200) NOT NULL,
  `Hyväksytty` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resepti`
--

INSERT INTO `resepti` (`Reseptin_ID`, `Reseptin_nimi`, `Juomalaji`, `Ohjet`, `Hyväksytty`) VALUES
(5, 'Beer', 'Beer', 'enjoy', 1),
(6, 'Yorsh', 'cocktail', 'drink\r\nsurvive(optionally)', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aines`
--
ALTER TABLE `aines`
  ADD PRIMARY KEY (`Aineksen_ID`);

--
-- Indexes for table `aines_määrä`
--
ALTER TABLE `aines_määrä`
  ADD PRIMARY KEY (`Reseptin_ID`,`Aineksen_ID`),
  ADD KEY `aines_määrä_ibfk_2` (`Aineksen_ID`);

--
-- Indexes for table `käyttäjät`
--
ALTER TABLE `käyttäjät`
  ADD PRIMARY KEY (`Käyttäjätunnus`);

--
-- Indexes for table `resepti`
--
ALTER TABLE `resepti`
  ADD PRIMARY KEY (`Reseptin_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aines`
--
ALTER TABLE `aines`
  MODIFY `Aineksen_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `resepti`
--
ALTER TABLE `resepti`
  MODIFY `Reseptin_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aines_määrä`
--
ALTER TABLE `aines_määrä`
  ADD CONSTRAINT `aines_määrä_ibfk_1` FOREIGN KEY (`Reseptin_ID`) REFERENCES `resepti` (`Reseptin_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `aines_määrä_ibfk_2` FOREIGN KEY (`Aineksen_ID`) REFERENCES `aines` (`Aineksen_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
