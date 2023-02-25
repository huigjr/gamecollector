-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 11 apr 2018 om 15:36
-- Serverversie: 10.1.26-MariaDB
-- PHP-versie: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "system";
SET CHARACTER SET utf8mb4;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamecollector`
--
CREATE DATABASE IF NOT EXISTS `gamecollector`;
USE `gamecollector`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `raw_ps5`
--

CREATE TABLE IF NOT EXISTS `raw_ps5` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `genre` varchar(128) DEFAULT NULL,
  `developer` varchar(256) DEFAULT NULL,
  `publisher` varchar(128) DEFAULT NULL,
  `jp` date DEFAULT NULL,
  `na` date DEFAULT NULL,
  `eu` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `raw_sxs`
--

CREATE TABLE IF NOT EXISTS `raw_sxs` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `genre` varchar(128) DEFAULT NULL,
  `developer` varchar(256) DEFAULT NULL,
  `publisher` varchar(128) DEFAULT NULL,
  `jp` date DEFAULT NULL,
  `na` date DEFAULT NULL,
  `eu` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `raw_switch`
--

CREATE TABLE IF NOT EXISTS `raw_switch` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(256) DEFAULT NULL,
  `url` varchar(256) DEFAULT NULL,
  `genre` varchar(128) DEFAULT NULL,
  `developer` varchar(256) DEFAULT NULL,
  `publisher` varchar(128) DEFAULT NULL,
  `ww` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `raw_ps4`
--

CREATE TABLE IF NOT EXISTS `raw_ps4` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `genre` varchar(128) DEFAULT NULL,
  `developer` varchar(256) DEFAULT NULL,
  `publisher` varchar(128) DEFAULT NULL,
  `jp` date DEFAULT NULL,
  `na` date DEFAULT NULL,
  `eu` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `raw_xbo`
--

CREATE TABLE IF NOT EXISTS `raw_xbo` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `genre` varchar(128) DEFAULT NULL,
  `developer` varchar(256) DEFAULT NULL,
  `publisher` varchar(128) DEFAULT NULL,
  `jp` date DEFAULT NULL,
  `na` date DEFAULT NULL,
  `eu` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `raw_vita`
--

CREATE TABLE IF NOT EXISTS `raw_vita` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `genre` varchar(128) DEFAULT NULL,
  `developer` varchar(256) DEFAULT NULL,
  `publisher` varchar(128) DEFAULT NULL,
  `na` date DEFAULT NULL,
  `eu` date DEFAULT NULL,
  `jp` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `raw_wiiu`
--

CREATE TABLE IF NOT EXISTS `raw_wiiu` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `genre` varchar(128) DEFAULT NULL,
  `developer` varchar(256) DEFAULT NULL,
  `publisher` varchar(128) DEFAULT NULL,
  `jp` date DEFAULT NULL,
  `na` date DEFAULT NULL,
  `au` date DEFAULT NULL,
  `eu` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `raw_wii`
--

CREATE TABLE IF NOT EXISTS `raw_wii` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `developer` varchar(256) DEFAULT NULL,
  `publisher` varchar(128) DEFAULT NULL,
  `jp` date DEFAULT NULL,
  `na` date DEFAULT NULL,
  `au` date DEFAULT NULL,
  `eu` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `raw_ps3`
--

CREATE TABLE IF NOT EXISTS `raw_ps3` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `developer` varchar(256) DEFAULT NULL,
  `jp` date DEFAULT NULL,
  `eu` date DEFAULT NULL,
  `na` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `raw_x360`
--

CREATE TABLE IF NOT EXISTS `raw_x360` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `genre` varchar(128) DEFAULT NULL,
  `developer` varchar(256) DEFAULT NULL,
  `publisher` varchar(128) DEFAULT NULL,
  `na` date DEFAULT NULL,
  `eu` date DEFAULT NULL,
  `jp` date DEFAULT NULL,
  `au` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `raw_psp`
--

CREATE TABLE IF NOT EXISTS `raw_psp` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `developer` varchar(256) DEFAULT NULL,
  `publisher` varchar(128) DEFAULT NULL,
  `na` date DEFAULT NULL,
  `eu` date DEFAULT NULL,
  `jp` date DEFAULT NULL,
  `au` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `raw_xbox`
--

CREATE TABLE IF NOT EXISTS `raw_xbox` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `genre` varchar(128) DEFAULT NULL,
  `developer` varchar(256) DEFAULT NULL,
  `publisher` varchar(128) DEFAULT NULL,
  `eu` date DEFAULT NULL,
  `jp` date DEFAULT NULL,
  `na` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `raw_gamecube`
--

CREATE TABLE IF NOT EXISTS `raw_gamecube` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `developer` varchar(256) DEFAULT NULL,
  `publisher` varchar(128) DEFAULT NULL,
  `eu` date DEFAULT NULL,
  `jp` date DEFAULT NULL,
  `na` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `raw_dreamcast`
--

CREATE TABLE IF NOT EXISTS `raw_dreamcast` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `genre` varchar(128) DEFAULT NULL,
  `developer` varchar(256) DEFAULT NULL,
  `publisher` varchar(128) DEFAULT NULL,
  `jp` date DEFAULT NULL,
  `na` date DEFAULT NULL,
  `eu` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
