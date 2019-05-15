-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 15 mei 2019 om 09:47
-- Serverversie: 5.7.23
-- PHP-versie: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `weslezp319_drippeo`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `productcode`
--

CREATE TABLE `productcode` (
  `id` int(11) NOT NULL,
  `productCode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `productcode`
--

INSERT INTO `productcode` (`id`, `productCode`) VALUES
(1, 'a1b2c3d4e5'),
(2, 'b2c3d4e5f6'),
(3, 'c3d4e5f6g7'),
(4, 'd4e5f6g7h8'),
(5, 'e5f6g7h8i9');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product_settings`
--

CREATE TABLE `product_settings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `residents` int(11) NOT NULL,
  `showers` int(11) NOT NULL,
  `baths` int(11) NOT NULL,
  `toilets` int(11) NOT NULL,
  `sinks` int(11) NOT NULL,
  `outside_tap` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `product_settings`
--

INSERT INTO `product_settings` (`id`, `user_id`, `residents`, `showers`, `baths`, `toilets`, `sinks`, `outside_tap`) VALUES
(1, 19, 3, 1, 1, 4, 5, 1);

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
  `productcode_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstName`, `lastName`, `street`, `number`, `city`, `postalCode`, `phone`, `productcode_id`) VALUES
(1, 'weske@test.com', '$2y$13$BF8Go8PBU6mGGzPXM2CW.Ojk5VJx5u6LGA1gNRPrLQHyOrC1mtAdu', 'wes', 'ke', 'ergens', '45', 'antwerpen', 2000, 475951357, 1),
(7, 'nieuw@test.com', '$2y$13$HsZbcl1Y9AJbqxUtW1iKC.ICaoaRug3ryfFKYWwFNkC.8MmP9evau', 'Mike', 'kerel', 'wasstraat', '123', 'Antwerpen', 2000, 495123456, 2),
(14, 'weske@iets.com', '$2y$13$E.mTfuTKussZ.hLQGUDgkutwbQH.UYLGjQ.XnMGZosWFX/scdZX5a', 'wasefdgh', 'asfdgfhmhj', 'asdfghm', '4562', 'sfdgfgh', 7856, 2147483647, 4),
(15, 'ietske@nietske.be', '$2y$13$tPbpYzHdQXFE1fuI9ByQXexN5mhBgQd19blV1iQ.kPpxRtko/u5ly', 'ikke', 'niet', 'eenStraat', '99', 'Ekeren', 2180, 495365784, 5),
(22, 'elke.borreij@gmail.com', '$2y$13$kLY/MzKtm.npxBKnjhX5Mu/Gd/6TUSmbrDXEIg2WDv7dkbvvWCP0W', 'Elke', 'Borreij', 'Koning Albertstraat', '110', 'Mechelen', 2800, 498825380, 3);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `productcode`
--
ALTER TABLE `productcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `product_settings`
--
ALTER TABLE `product_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `productcode`
--
ALTER TABLE `productcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `product_settings`
--
ALTER TABLE `product_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
