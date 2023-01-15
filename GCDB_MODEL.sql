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
-- Database: `gcdb`
--
CREATE DATABASE IF NOT EXISTS `gcdb`;
USE `gcdb`;

ALTER DATABASE `gcdb` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `games`
--

CREATE TABLE IF NOT EXISTS `games` (
  `gameid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(64) DEFAULT NULL,
  `url` varchar(64) DEFAULT NULL,
  `genres` int(10) DEFAULT 0,
  `genre` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`gameid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `releases`
--

CREATE TABLE IF NOT EXISTS `releases` (
  `releaseid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `gameid` smallint(5) UNSIGNED NOT NULL,
  `console` varchar(32) DEFAULT NULL,
  `region` varchar(4) DEFAULT NULL,
  `localtitle` varchar(64) DEFAULT NULL,
  `latintitle` varchar(64) DEFAULT NULL,
  `serial` varchar(32) DEFAULT NULL,
  `releasedate` date DEFAULT NULL,
  `developer` varchar(64) DEFAULT NULL,
  `publisher` varchar(64) DEFAULT NULL,
  `added` date DEFAULT NULL,
  `image` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`releaseid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1 ;


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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1 ;


-- --------------------------------------------------------


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
