-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 14 jan 2023 om 17:10
-- Serverversie: 10.1.37-MariaDB
-- PHP-versie: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gcdb`
--

--
-- Gegevens worden geëxporteerd voor tabel `games`
--

INSERT INTO `games` (`gameid`, `title`, `url`, `genres`) VALUES
(1, 'Suikoden', 'suikoden', 128),
(2, 'Grand Theft Auto III', 'grand-theft-auto-iii', 3),
(3, 'God of War Ragnarök', 'god-of-war-ragnarok', 516),
(4, 'God of War III', 'god-of-war-iii', 516),
(5, 'E.T. the Extra-Terrestrial', 'et-the-extra-terrestrial', 4),
(6, 'Super Mario RPG: Legend of the Seven Stars', 'super-mario-rpg-legend-of-the-seven-stars', 128),
(7, 'Stubbs the Zombie in Rebel Without a Pulse', 'stubbs-the-zombie-in-rebel-without-a-pulse', 131074),
(8, 'Jet Set Radio', 'jet-set radio', 262154),
(9, 'Red Dead Redemption 2', 'red-dead-redemption-2', 3),
(10, 'The Legend of Zelda: Breath of the Wild', 'the-legend-of-zelda-breath-of-the-wild', 1);

--
-- Gegevens worden geëxporteerd voor tabel `pages`
--

INSERT INTO `pages` (`pageid`, `title`, `url`, `content`) VALUES
(1, 'Home', 'home', 'Welcome');

--
-- Gegevens worden geëxporteerd voor tabel `releases`
--

INSERT INTO `releases` (`releaseid`, `gameid`, `console`, `region`, `localtitle`, `latintitle`, `serial`, `releasedate`, `developer`, `publisher`, `added`, `image`) VALUES
(1, 1, 'psx', 'jp', '幻想水滸伝', 'Gensō Suikoden', 'SCPS-45184', '1995-12-15', 'Konami Computer Entertainment Tokyo', 'Konami', '2023-01-07', 'suikoden_jp.jpg'),
(2, 1, 'psx', 'na', NULL, NULL, 'SLUS-00292', '1996-12-14', 'Konami Computer Entertainment Tokyo', 'Konami', '2023-01-07', 'suikoden_us.jpg'),
(3, 1, 'psx', 'eu', NULL, NULL, 'SLES-00527', '1997-04-14', 'Konami Computer Entertainment Tokyo', 'Konami', '2023-01-07', 'suikoden_pal.jpg'),
(4, 1, 'saturn', 'jp', '幻想水滸伝', 'Gensō Suikoden', NULL, '1998-09-17', 'Konami Computer Entertainment Tokyo', 'Konami', '2023-01-07', 'suikoden_jp.jpg'),
(5, 2, 'ps2', 'eu', NULL, NULL, 'SLES-50330', '2001-10-26', 'DMA Design Ltd', 'Rockstar Games', '2023-01-07', 'gta-iii-pal.jpg'),
(6, 3, 'ps4', 'eu', NULL, NULL, NULL, '2022-11-09', 'Santa Monica Studio', 'Sony Interactive Entertainment', '2023-01-07', 'god-of-war-ragnarok-pal.jpg'),
(7, 3, 'ps5', 'eu', NULL, NULL, NULL, '2022-11-09', 'Santa Monica Studio', 'Sony Interactive Entertainment', '2023-01-07', 'god-of-war-ragnarok-pal.jpg'),
(8, 4, 'ps3', 'eu', NULL, NULL, NULL, '2010-03-19', 'Santa Monica Studio', 'Sony Computer Entertainment', '2023-01-07', 'god-of-war-iii-eu.jpg'),
(9, 5, '2600', 'na', NULL, NULL, NULL, '1982-12-01', 'Atari Inc', 'Atari Inc', '2023-01-07', 'et-us.jpg'),
(10, 6, 'snes', 'na', NULL, NULL, NULL, '1996-05-13', 'Square', 'Nintendo', '2023-01-08', 'super-mario-rpg-us.jpg'),
(11, 7, 'xbox', 'na', NULL, NULL, NULL, '2005-10-18', 'Wideload Games', 'Aspyr Media', '2023-01-10', 'stubbs-the-zombie-in-rebel-without-a-pulse-na.jpg'),
(12, 8, 'dreamcast', 'eu', NULL, NULL, NULL, '2000-11-24', 'Smilebit', 'Sega', '2023-01-11', 'jet-set-radio-eu.jpg'),
(13, 9, 'xone', 'eu', NULL, NULL, NULL, '2018-10-26', 'Rockstar Studios', 'Rockstar Games', '2023-01-12', 'red-dead-redemption-2-eu.jpg'),
(14, 10, 'switch', 'eu', NULL, NULL, NULL, '2017-03-03', 'Nintendo EPD', 'Nintendo', '2023-01-12', 'the-legend-of-zelda-breath-of-the-wild-eu.jpg');

--
-- Gegevens worden geëxporteerd voor tabel `reviews`
--

INSERT INTO `reviews` (`reviewid`, `gameid`, `releaseid`, `outlet`, `link`, `score`) VALUES
(1, 1, NULL, 'gamerevolution', 'https://www.gamerevolution.com/review/33946-suikoden-review', 90);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
