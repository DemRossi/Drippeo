-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 05 mei 2019 om 21:35
-- Serverversie: 10.1.38-MariaDB
-- PHP-versie: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weslezp319_drippeo`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postalCode` int(11) NOT NULL,
  `phone` int(11) NOT NULL,
  `verbruikId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstName`, `lastName`, `street`, `number`, `city`, `postalCode`, `phone`, `verbruikId`) VALUES
(1, 'test@test.com', 'qwerty', 'test', 'tester', 'ergens', '45', 'Antwerpen', 2000, 475689951, 0),
(2, 'test@test.com', 'qwerty', 'test', 'tester', 'ergens', '45', 'Antwerpen', 2000, 475689951, 0),
(3, 'test@test.com', 'qwerty', 'test', 'tester', 'ergens', '45', 'Antwerpen', 2000, 475689951, 0),
(4, 'test@test.com', 'qwerty', 'test', 'tester', 'ergens', '45', 'Antwerpen', 2000, 475689951, 0),
(5, 'test@test.com', 'qwerty', 'test', 'tester', 'ergens', '45', 'Antwerpen', 2000, 475689951, 0),
(6, 'test@test.com', 'qwerty', 'test', 'tester', 'ergens', '45', 'Antwerpen', 2000, 475689951, 0),
(7, 'test@test.com', 'qwerty', 'test', 'tester', 'ergens', '45', 'Antwerpen', 2000, 475689951, 0),
(8, 'wwke@test.com', '$2y$10$o7PCG8FnOXDTXBPlugRpdOKUmfcOdtJsllhBhAyR6L839QVJB8Y5K', 'wes', 'ke', 'ergens', '54', 'Berchem', 2600, 412365478, 0),
(9, 'nieuw@test.com', '$2y$13$oSyPqHTSigGTpCUfeIfx5eUCrM8/DkF9GRoX08sbhk4mZkJr2.MRS', 'nie', 'uw', 'Anders', '32', 'Deurne', 2100, 477951753, 0),
(10, 'test@tester.be', '$2y$13$8y2rz0wDAScHsUstMBDPF.dGobcOCymw/DBsZ3QqrVThX64IrVolW', 'test', 'tester', 'teststraat', '404', 'Debug', 4040, 479123654, 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
