-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 03 nov 2020 kl 00:46
-- Serverversion: 10.4.14-MariaDB
-- PHP-version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `padelbooking`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `admin`
--

INSERT INTO `admin` (`admin_id`, `user_id`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Tabellstruktur `arenas`
--

CREATE TABLE `arenas` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `dbname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `arenas`
--

INSERT INTO `arenas` (`id`, `name`, `street`, `city`, `zip`, `dbname`) VALUES
(1, 'Bålsta Padelclub', ' Ullevivägen 2', 'Bålsta', '746 51', 'balstapadelclub'),
(2, 'Järfälla Padel Club', 'Mjölnarvägen 1', 'Järfälla', '177 41', 'jarfallapadelclub'),
(3, 'Västerås Padel Arena - Hälla', 'Stockholmsvägen 136', 'Västerås', '721 34', 'vasteraspadelarenahalla'),
(4, 'Enköping Padel Arena', 'Sandgatan 24', 'Enköping', '749 35', 'enkopingpadelarena'),
(5, 'Globen Padel', ' Arenaslingan 9', 'Johanneshov', '121 77', 'GlobenPadel');

-- --------------------------------------------------------

--
-- Tabellstruktur `balstapadelclub`
--

CREATE TABLE `balstapadelclub` (
  `id` int(11) NOT NULL,
  `arena_id` int(11) NOT NULL,
  `court` varchar(50) NOT NULL,
  `timeInterval` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `balstapadelclub`
--

INSERT INTO `balstapadelclub` (`id`, `arena_id`, `court`, `timeInterval`) VALUES
(1, 1, 'MTB AB', '[{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]}]'),
(2, 1, 'Bäckarnas', '[{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]}]'),
(3, 1, 'Padelpärras', '[{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]}]'),
(4, 1, '746 AB', '[{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]}]');

-- --------------------------------------------------------

--
-- Tabellstruktur `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `arena_id` int(11) NOT NULL,
  `court_id` int(11) NOT NULL,
  `courtname` varchar(50) NOT NULL,
  `dateTimeStart` datetime NOT NULL,
  `dateTimeEnd` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `booking`
--

INSERT INTO `booking` (`id`, `arena_id`, `court_id`, `courtname`, `dateTimeStart`, `dateTimeEnd`) VALUES
(207, 1, 1, 'MTB AB', '2020-11-03 10:00:00', '2020-11-03 11:00:00'),
(208, 1, 2, 'Bäckarnas', '2020-11-03 13:00:00', '2020-11-03 14:00:00'),
(209, 1, 4, '746 AB', '2020-11-03 21:00:00', '2020-11-03 22:30:00'),
(210, 1, 1, 'MTB AB', '2020-11-04 19:00:00', '2020-11-04 19:55:00'),
(211, 1, 4, '746 AB', '2020-11-05 12:00:00', '2020-11-05 13:25:00'),
(212, 5, 1, 'Tele 2', '2020-11-03 11:00:00', '2020-11-03 12:00:00'),
(213, 1, 1, 'MTB AB', '2020-11-03 16:00:00', '2020-11-03 17:00:00'),
(214, 1, 1, 'MTB AB', '2020-11-04 16:00:00', '2020-11-04 16:55:00');

-- --------------------------------------------------------

--
-- Tabellstruktur `coachbooking`
--

CREATE TABLE `coachbooking` (
  `book_id` int(11) DEFAULT NULL,
  `coach_id` int(11) NOT NULL,
  `dateTimeStart` datetime NOT NULL,
  `dateTimeEnd` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `coachbooking`
--

INSERT INTO `coachbooking` (`book_id`, `coach_id`, `dateTimeStart`, `dateTimeEnd`) VALUES
(207, 2, '2020-11-03 10:00:00', '2020-11-03 11:00:00'),
(208, 2, '2020-11-03 13:00:00', '2020-11-03 14:00:00'),
(209, 2, '2020-11-03 21:00:00', '2020-11-03 22:30:00'),
(214, 3, '2020-11-04 16:00:00', '2020-11-04 16:55:00'),
(210, 3, '2020-11-04 19:00:00', '2020-11-04 19:55:00'),
(211, 3, '2020-11-05 12:00:00', '2020-11-05 13:25:00');

-- --------------------------------------------------------

--
-- Tabellstruktur `coaches`
--

CREATE TABLE `coaches` (
  `coach_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `coaches`
--

INSERT INTO `coaches` (`coach_id`, `user_id`) VALUES
(1, 1),
(2, 3),
(4, 2),
(13, 8),
(14, 4),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 10),
(25, 10);

-- --------------------------------------------------------

--
-- Tabellstruktur `coachinarena`
--

CREATE TABLE `coachinarena` (
  `coach_id` int(11) NOT NULL,
  `arena_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `coachinarena`
--

INSERT INTO `coachinarena` (`coach_id`, `arena_id`) VALUES
(1, 1),
(1, 2),
(1, 4),
(2, 1),
(4, 1),
(13, 2),
(14, 1),
(24, 3),
(24, 5);

-- --------------------------------------------------------

--
-- Tabellstruktur `enkopingpadelarena`
--

CREATE TABLE `enkopingpadelarena` (
  `id` int(11) NOT NULL,
  `arena_id` int(11) NOT NULL,
  `court` varchar(50) NOT NULL,
  `timeInterval` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `enkopingpadelarena`
--

INSERT INTO `enkopingpadelarena` (`id`, `arena_id`, `court`, `timeInterval`) VALUES
(1, 4, 'Sparbanken i Enköping', '[{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]}]'),
(2, 4, 'Clean Drink', '[{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]}]\r\n\r\n\r\n\r\n\r\n\r\n\r\n'),
(3, 4, 'Infra Projektledning', '[{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]}]\r\n\r\n\r\n\r\n\r\n\r\n\r\n'),
(4, 4, 'Combimix', '[{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]}]\r\n\r\n\r\n\r\n\r\n\r\n\r\n');

-- --------------------------------------------------------

--
-- Tabellstruktur `globenpadel`
--

CREATE TABLE `globenpadel` (
  `id` int(11) NOT NULL,
  `arena_id` int(11) DEFAULT NULL,
  `court` varchar(50) DEFAULT NULL,
  `timeInterval` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `globenpadel`
--

INSERT INTO `globenpadel` (`id`, `arena_id`, `court`, `timeInterval`) VALUES
(1, 5, 'Tele 2', '[{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]}]'),
(2, 5, 'Swedbank', '[{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]}]');

-- --------------------------------------------------------

--
-- Tabellstruktur `jarfallapadelclub`
--

CREATE TABLE `jarfallapadelclub` (
  `id` int(11) NOT NULL,
  `arena_id` int(11) NOT NULL,
  `court` varchar(50) NOT NULL,
  `timeInterval` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `jarfallapadelclub`
--

INSERT INTO `jarfallapadelclub` (`id`, `arena_id`, `court`, `timeInterval`) VALUES
(1, 2, 'Centercourt', '[{\"day\":[90]},{\"day\":[60,90,90,90,90,90,90,90,90,90,90]},{\"day\":[60,90,90,90,90,90,90,90,90,90,90]},{\"day\":[60,90,90,90,90,90,90,90,90,90,90]},{\"day\":[60,90,90,90,90,90,90,90,90,90,90]},{\"day\":[60,90,90,90,90,90,90,90,90,90]},{\"day\":[90]}]'),
(2, 2, 'Centercourt', '[{\"day\":[90]},{\"day\":[60,90,90,90,90,90,90,90,90,90,90]},{\"day\":[60,90,90,90,90,90,90,90,90,90,90]},{\"day\":[60,90,90,90,90,90,90,90,90,90,90]},{\"day\":[60,90,90,90,90,90,90,90,90,90,90]},{\"day\":[60,90,90,90,90,90,90,90,90,90]},{\"day\":[90]}]'),
(3, 2, 'Court', '[{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]}]'),
(4, 2, 'Court', '[{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]}]'),
(5, 2, 'Court', '[{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]}]'),
(6, 2, 'Court', '[{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]}]'),
(7, 2, 'Court', '[{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]},{\"day\":[60]}]');

-- --------------------------------------------------------

--
-- Tabellstruktur `openinghours`
--

CREATE TABLE `openinghours` (
  `arena_id` int(11) NOT NULL,
  `weekday` int(11) NOT NULL,
  `open` time NOT NULL,
  `close` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `openinghours`
--

INSERT INTO `openinghours` (`arena_id`, `weekday`, `open`, `close`) VALUES
(1, 0, '06:00:00', '24:00:00'),
(1, 1, '06:00:00', '24:00:00'),
(1, 2, '06:00:00', '24:00:00'),
(1, 3, '06:00:00', '24:00:00'),
(1, 4, '06:00:00', '24:00:00'),
(1, 5, '06:00:00', '24:00:00'),
(1, 6, '06:00:00', '24:00:00'),
(2, 0, '08:00:00', '23:00:00'),
(2, 1, '07:00:00', '23:00:00'),
(2, 2, '07:00:00', '23:00:00'),
(2, 3, '07:00:00', '23:00:00'),
(2, 4, '07:00:00', '23:00:00'),
(2, 5, '07:00:00', '21:30:00'),
(2, 6, '08:00:00', '19:00:00'),
(3, 0, '06:00:00', '24:00:00'),
(3, 1, '06:00:00', '24:00:00'),
(3, 2, '06:00:00', '24:00:00'),
(3, 3, '06:00:00', '24:00:00'),
(3, 4, '06:00:00', '24:00:00'),
(3, 5, '06:00:00', '24:00:00'),
(3, 6, '06:00:00', '24:00:00'),
(4, 0, '06:00:00', '23:00:00'),
(4, 1, '06:00:00', '23:00:00'),
(4, 2, '06:00:00', '23:00:00'),
(4, 3, '06:00:00', '23:00:00'),
(4, 4, '06:00:00', '23:00:00'),
(4, 5, '06:00:00', '23:00:00'),
(4, 6, '06:00:00', '23:00:00'),
(5, 0, '08:00:00', '22:00:00'),
(5, 1, '08:00:00', '20:00:00'),
(5, 2, '07:00:00', '23:00:00'),
(5, 3, '07:00:00', '23:00:00'),
(5, 4, '07:00:00', '23:00:00'),
(5, 5, '07:00:00', '23:00:00'),
(5, 6, '07:00:00', '23:00:00');

-- --------------------------------------------------------

--
-- Tabellstruktur `userbooking`
--

CREATE TABLE `userbooking` (
  `user_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `userbooking`
--

INSERT INTO `userbooking` (`user_id`, `booking_id`) VALUES
(2, 207),
(2, 208),
(2, 209),
(2, 210),
(2, 211),
(5, 212),
(5, 213),
(5, 214);

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `imgurl` varchar(100) NOT NULL DEFAULT 'images/dummy.png',
  `info` varchar(500) NOT NULL,
  `playrank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `street`, `city`, `zip`, `phone`, `imgurl`, `info`, `playrank`) VALUES
(1, 'rselvander@gmail.com', '*94BDCEBE19083CE2A1F959FD02F964C7AF4CFC29', 'Rasmus', 'Selvander', 'Vänersborgsvägen 1B', 'Bålsta', '746 34', '0723979496', 'images/rs.jpg', 'Fun trainer', 10),
(2, 'tim.dafteke@mail.com', '*94BDCEBE19083CE2A1F959FD02F964C7AF4CFC29', 'Tim', 'Dafteke', '', '', '', '', 'images/tränare3.jpg', '      ', 69),
(3, 'oskar.renefalk@gmail.com', '*94BDCEBE19083CE2A1F959FD02F964C7AF4CFC29', 'Oskar', 'Renefalk', 'Vetevägen 1', '', '746', '', 'images/or.jpg', '  ', 2),
(4, 'gabriel@mail.com', '*94BDCEBE19083CE2A1F959FD02F964C7AF4CFC29', 'Gabriel', 'Kazai', '', '', '', '', 'images/tränare4.jpg', '', 0),
(5, 'test12@mail.com', '*94BDCEBE19083CE2A1F959FD02F964C7AF4CFC29', 'Pär', 'Jansson', 'Gäddan', '', '74691', '0700053100', 'images/tränare1.jpg', 'Likes to play padel on my spare time. Likes to google        ', 9),
(6, 'test@mail.com', '*94BDCEBE19083CE2A1F959FD02F964C7AF4CFC29', 'tester', 'tester', '', '', '', '0700053126', 'images/dummy.png', 'Likes to play padel on my spare time. Likes to google', 5),
(8, 'root@mail.com', '*81F5E21E35407D884A6CD4A731AEBFB6AF209E1B', 'root', 'root', '', '', '000', '', 'images/dummy.png', 'test', 7),
(10, 'alyckasen@gmail.com', '*94BDCEBE19083CE2A1F959FD02F964C7AF4CFC29', 'Albin', 'Lyckåsen', '', '', '', '', 'images/test.jpg', 'Best trainer i svedala ;)', 10),
(12, 'www@mail.com', '*3D07E0D0A6AB1EB78DA1D222570ED89455FB7045', 'www', 'www', 'www', '', 'www', 'www', 'images/tränare4.jpg', '   testetteashryhewhshhrhhsh ', 9);

-- --------------------------------------------------------

--
-- Tabellstruktur `vasteraspadelarenahalla`
--

CREATE TABLE `vasteraspadelarenahalla` (
  `id` int(11) NOT NULL,
  `arena_id` int(11) NOT NULL,
  `court` varchar(50) NOT NULL,
  `timeInterval` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `vasteraspadelarenahalla`
--

INSERT INTO `vasteraspadelarenahalla` (`id`, `arena_id`, `court`, `timeInterval`) VALUES
(1, 3, 'Alfaglas Centercourt', '[{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]}]'),
(2, 3, 'Fastighetsbyrån', '[{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]}]'),
(3, 3, 'Brunnby', '[{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]}]'),
(4, 3, 'Digiwise Centercourt', '[{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]}]'),
(5, 3, 'Putsarkungen', '[{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]},{\"day\":[90]}]'),
(6, 3, 'VLT', '[{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]},{\"day\":[60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,120]}]');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index för tabell `arenas`
--
ALTER TABLE `arenas`
  ADD PRIMARY KEY (`id`,`name`,`city`);

--
-- Index för tabell `balstapadelclub`
--
ALTER TABLE `balstapadelclub`
  ADD PRIMARY KEY (`id`,`arena_id`) USING BTREE,
  ADD KEY `arena_id` (`arena_id`);

--
-- Index för tabell `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `arena_id` (`arena_id`,`court_id`,`dateTimeStart`);

--
-- Index för tabell `coachbooking`
--
ALTER TABLE `coachbooking`
  ADD PRIMARY KEY (`coach_id`,`dateTimeStart`);

--
-- Index för tabell `coaches`
--
ALTER TABLE `coaches`
  ADD PRIMARY KEY (`coach_id`,`user_id`) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Index för tabell `coachinarena`
--
ALTER TABLE `coachinarena`
  ADD PRIMARY KEY (`coach_id`,`arena_id`),
  ADD KEY `arena_id` (`arena_id`);

--
-- Index för tabell `enkopingpadelarena`
--
ALTER TABLE `enkopingpadelarena`
  ADD PRIMARY KEY (`id`,`arena_id`),
  ADD KEY `arena_id` (`arena_id`);

--
-- Index för tabell `globenpadel`
--
ALTER TABLE `globenpadel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `arena_id` (`arena_id`);

--
-- Index för tabell `jarfallapadelclub`
--
ALTER TABLE `jarfallapadelclub`
  ADD PRIMARY KEY (`id`,`arena_id`),
  ADD KEY `arena_id` (`arena_id`);

--
-- Index för tabell `openinghours`
--
ALTER TABLE `openinghours`
  ADD PRIMARY KEY (`arena_id`,`weekday`) USING BTREE;

--
-- Index för tabell `userbooking`
--
ALTER TABLE `userbooking`
  ADD PRIMARY KEY (`user_id`,`booking_id`),
  ADD KEY `booking_id` (`booking_id`) USING BTREE,
  ADD KEY `user_id` (`user_id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`email`);

--
-- Index för tabell `vasteraspadelarenahalla`
--
ALTER TABLE `vasteraspadelarenahalla`
  ADD PRIMARY KEY (`id`,`arena_id`),
  ADD KEY `arena_id` (`arena_id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT för tabell `arenas`
--
ALTER TABLE `arenas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT för tabell `balstapadelclub`
--
ALTER TABLE `balstapadelclub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT för tabell `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT för tabell `coaches`
--
ALTER TABLE `coaches`
  MODIFY `coach_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT för tabell `enkopingpadelarena`
--
ALTER TABLE `enkopingpadelarena`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT för tabell `globenpadel`
--
ALTER TABLE `globenpadel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT för tabell `jarfallapadelclub`
--
ALTER TABLE `jarfallapadelclub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT för tabell `vasteraspadelarenahalla`
--
ALTER TABLE `vasteraspadelarenahalla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Restriktioner för tabell `balstapadelclub`
--
ALTER TABLE `balstapadelclub`
  ADD CONSTRAINT `balstapadelclub_ibfk_1` FOREIGN KEY (`arena_id`) REFERENCES `arenas` (`id`);

--
-- Restriktioner för tabell `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`arena_id`) REFERENCES `arenas` (`id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`arena_id`) REFERENCES `arenas` (`id`);

--
-- Restriktioner för tabell `coaches`
--
ALTER TABLE `coaches`
  ADD CONSTRAINT `coaches_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `coaches_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coaches_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coaches_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Restriktioner för tabell `coachinarena`
--
ALTER TABLE `coachinarena`
  ADD CONSTRAINT `coachinarena_ibfk_1` FOREIGN KEY (`coach_id`) REFERENCES `coaches` (`coach_id`),
  ADD CONSTRAINT `coachinarena_ibfk_2` FOREIGN KEY (`arena_id`) REFERENCES `arenas` (`id`),
  ADD CONSTRAINT `coachinarena_ibfk_3` FOREIGN KEY (`coach_id`) REFERENCES `coaches` (`coach_id`) ON DELETE CASCADE;

--
-- Restriktioner för tabell `enkopingpadelarena`
--
ALTER TABLE `enkopingpadelarena`
  ADD CONSTRAINT `enkopingpadelarena_ibfk_1` FOREIGN KEY (`arena_id`) REFERENCES `arenas` (`id`);

--
-- Restriktioner för tabell `globenpadel`
--
ALTER TABLE `globenpadel`
  ADD CONSTRAINT `globenpadel_ibfk_1` FOREIGN KEY (`arena_id`) REFERENCES `arenas` (`id`);

--
-- Restriktioner för tabell `jarfallapadelclub`
--
ALTER TABLE `jarfallapadelclub`
  ADD CONSTRAINT `jarfallapadelclub_ibfk_1` FOREIGN KEY (`arena_id`) REFERENCES `arenas` (`id`);

--
-- Restriktioner för tabell `openinghours`
--
ALTER TABLE `openinghours`
  ADD CONSTRAINT `openinghours_ibfk_1` FOREIGN KEY (`arena_id`) REFERENCES `arenas` (`id`);

--
-- Restriktioner för tabell `userbooking`
--
ALTER TABLE `userbooking`
  ADD CONSTRAINT `userbooking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `userbooking_ibfk_2` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`),
  ADD CONSTRAINT `userbooking_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `userbooking_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `userbooking_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Restriktioner för tabell `vasteraspadelarenahalla`
--
ALTER TABLE `vasteraspadelarenahalla`
  ADD CONSTRAINT `vasteraspadelarenahalla_ibfk_1` FOREIGN KEY (`arena_id`) REFERENCES `arenas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
