-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 24 feb 2023 om 21:00
-- Serverversie: 10.1.37-MariaDB
-- PHP-versie: 7.2.12

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

ALTER DATABASE `gamecollector` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `consoles`
--

CREATE TABLE IF NOT EXISTS `consoles` (
  `consoleid` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `url` varchar(32) DEFAULT NULL,
  `short` varchar(16) DEFAULT NULL,
  `releasedate` date DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT 0,
  PRIMARY KEY (`consoleid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `covers`
--

CREATE TABLE IF NOT EXISTS `covers` (
  `coverid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `gameid` smallint(5) UNSIGNED NOT NULL,
  `covertype` tinyint(3) UNSIGNED DEFAULT NULL,
  `console` varchar(16) DEFAULT NULL,
  `second` varchar(16) DEFAULT NULL,
  `region` varchar(2) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`coverid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `games`
--

CREATE TABLE IF NOT EXISTS `games` (
  `gameid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(64) DEFAULT NULL,
  `url` varchar(64) DEFAULT NULL,
  `genres` int(10) DEFAULT '0',
  `description_nl` varchar(2048) DEFAULT NULL,
  `description_en` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`gameid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `pageid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(64) DEFAULT NULL,
  `url` varchar(64) DEFAULT NULL,
  `content` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`pageid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `regions`
--

CREATE TABLE IF NOT EXISTS `regions` (
  `regionid` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent` tinyint(3) DEFAULT NULL,
  `short` varchar(2) DEFAULT NULL,
  `name` varchar(16) DEFAULT NULL,
  `flag` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`regionid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `releases`
--

CREATE TABLE IF NOT EXISTS `releases` (
  `releaseid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `gameid` smallint(5) UNSIGNED NOT NULL,
  `consoleid` tinyint(3) UNSIGNED NOT NULL,
  `regionid` tinyint(3) UNSIGNED NOT NULL,
  `console` varchar(16) DEFAULT NULL,
  `region` varchar(2) DEFAULT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `releasedate` date DEFAULT NULL,
  `developer` varchar(128) DEFAULT NULL,
  `publisher` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`releaseid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

CREATE VIEW releaseview AS
    SELECT `releases`.`releaseid`
    , `releases`.`gameid`
    , `games`.`title`
    , `games`.`url`
    , `games`.`genres`
    , `releases`.`type`
    , `releases`.`releasedate`
    , `consoles`.`short` as console
    , `regions`.`short` as region
    , `regions`.`flag`
    FROM `releases` 
    LEFT JOIN `consoles` ON `releases`.`consoleid` = `consoles`.`consoleid`
    LEFT JOIN `games` ON `releases`.`gameid` = `games`.`gameid` 
    LEFT JOIN `regions` ON `releases`.`regionid` = `regions`.`regionid`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `reviewid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `gameid` smallint(5) UNSIGNED NOT NULL,
  `releaseid` smallint(5) UNSIGNED DEFAULT NULL,
  `outlet` varchar(32) DEFAULT NULL,
  `link` varchar(265) DEFAULT NULL,
  `score` tinyint(3) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`reviewid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

-- --------------------------------------------------------

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
