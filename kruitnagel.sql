-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 15 apr 2024 om 12:56
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kruitnagel`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categorieën`
--

CREATE TABLE `categorieën` (
  `categorie_id` int(11) NOT NULL,
  `categorie_naam` varchar(250) DEFAULT NULL,
  `btw_percentage` decimal(5,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `categorieën`
--

INSERT INTO `categorieën` (`categorie_id`, `categorie_naam`, `btw_percentage`) VALUES
(1, 'Elektronica', 21),
(2, 'Kleding', 21),
(3, 'Snoep', 9),
(4, 'Koek', 9),
(5, 'Sieraden', 21),
(6, 'Drank', 21);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `medewerkers`
--

CREATE TABLE `medewerkers` (
  `medewerker_id` int(11) NOT NULL,
  `medewerker_naam` varchar(250) DEFAULT NULL,
  `medewerker_mail` varchar(250) DEFAULT NULL,
  `medewerker_ww` varchar(250) DEFAULT NULL,
  `medewerker_pin` text DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `medewerkers`
--

INSERT INTO `medewerkers` (`medewerker_id`, `medewerker_naam`, `medewerker_mail`, `medewerker_ww`, `medewerker_pin`, `rol_id`) VALUES
(1, 'Jorian', 'info@jorianbeukens.nl', 'jorian', '1234', 1),
(2, 'Lars', 'info@larsvandenberg.nl', 'lars', '0000', 5),
(5, 'Test', 'test@test.nl', 'test', '5238', 2),
(6, 'nej', 'nej@hoornbeeck.nl', 'nej', '1234', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orderregels`
--

CREATE TABLE `orderregels` (
  `bonregel_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(20) DEFAULT NULL,
  `aantal` int(11) DEFAULT NULL,
  `totaalprijs` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `orderregels`
--

INSERT INTO `orderregels` (`bonregel_id`, `order_id`, `product_id`, `aantal`, `totaalprijs`) VALUES
(54, 43, 102, 1, NULL),
(55, 43, 203, 1, NULL),
(56, 43, 102, 1, NULL),
(57, 44, 203, 1, NULL),
(58, 44, 203, 1, NULL),
(59, 44, 203, 1, NULL),
(60, 44, 203, 1, NULL),
(61, 45, 203, 1, NULL),
(62, 45, 203, 1, NULL),
(63, 45, 203, 1, NULL),
(64, 45, 203, 1, NULL),
(65, 45, 203, 1, NULL),
(67, 46, 203, 1, NULL),
(68, 46, 203, 1, NULL),
(69, 47, 203, 1, NULL),
(71, 47, 102, 1, NULL),
(73, 49, 203, 1, NULL),
(74, 49, 203, 1, NULL),
(75, 49, 203, 1, NULL),
(76, 50, 203, 1, 0.00),
(77, 50, 203, 1, 150.00),
(78, 50, 203, 1, 150.00),
(79, 50, 102, 1, 40.00),
(81, 50, 102, 1, 40.00),
(84, 51, 203, 1, 150.00),
(85, 52, 203, 1, 150.00),
(87, 53, 203, 1, 150.00),
(88, 53, 102, 1, 40.00),
(90, 54, 203, 1, 150.00),
(91, 56, 203, 1, 150.00),
(92, 56, 102, 1, 40.00),
(93, 57, 203, 1, 150.00),
(94, 57, 203, 1, 150.00),
(95, 57, 102, 1, 40.00),
(97, 59, 203, 1, 150.00),
(98, 59, 102, 1, 40.00),
(99, 59, 203, 1, 150.00),
(101, 59, 203, 1, 150.00),
(102, 59, 102, 1, 40.00),
(103, 59, 102, 1, 40.00),
(104, 61, 102, 1, 40.00),
(105, 61, 203, 1, 150.00),
(109, 63, 203, 1, 150.00),
(110, 63, 102, 1, 40.00),
(114, 68, 203, 1, 150.00),
(115, 68, 102, 1, 40.00),
(116, 68, 102, 1, 40.00),
(117, 68, 203, 1, 150.00),
(118, 74, 203, 1, 150.00),
(119, 76, 203, 1, 150.00),
(120, 76, 102, 1, 40.00),
(121, 80, 102, 1, 40.00),
(122, 80, 203, 1, 150.00),
(123, 81, 203, 1, 150.00),
(124, 83, 203, 1, 150.00),
(125, 83, 102, 1, 40.00),
(126, 84, 203, 1, 150.00),
(127, 85, 203, 1, 150.00),
(128, 86, 102, 1, 40.00),
(129, 86, 203, 1, 150.00),
(130, 86, 203, 1, 150.00),
(131, 87, 203, 1, 150.00),
(132, 87, 102, 1, 40.00),
(133, 89, 203, 1, 150.00),
(134, 89, 102, 1, 40.00),
(135, 89, 203, 1, 150.00),
(137, 91, 102, 1, 40.00),
(138, 91, 203, 1, 150.00),
(139, 93, 203, 1, 150.00),
(140, 95, 102, 1, 40.00),
(141, 96, 203, 1, 150.00),
(142, 97, 203, 1, 150.00),
(143, 98, 203, 1, 150.00),
(144, 99, 102, 1, 40.00),
(145, 100, 203, 1, 150.00),
(146, 101, 203, 1, 150.00),
(148, 103, 102, 1, 40.00),
(150, 103, 203, 1, 150.00),
(151, 103, 203, 1, 150.00),
(152, 103, 203, 1, 150.00),
(153, 104, 203, 1, 150.00),
(154, 105, 203, 1, 150.00),
(156, 107, 203, 1, 150.00),
(157, 108, 203, 1, 150.00),
(158, 108, 102, 1, 40.00),
(161, 109, 102, 1, 40.00),
(162, 109, 203, 1, 150.00),
(164, 110, 203, 1, 150.00),
(166, 111, 102, 1, 40.00),
(167, 111, 203, 1, 150.00),
(168, 112, 203, 1, 150.00),
(171, 112, 203, 1, 150.00),
(174, 113, 203, 1, 150.00),
(180, 114, 401, 1, 250.00),
(181, 115, 203, 1, 150.00),
(182, 115, 102, 1, 40.00),
(184, 116, 102, 1, 40.00),
(197, 117, 203, 1, 150.00),
(199, 118, 203, 1, 150.00),
(200, 118, 102, 1, 40.00),
(201, 119, 203, 1, 150.00),
(202, 120, 203, 1, 150.00),
(203, 120, 203, 1, 150.00),
(204, 121, 203, 1, 150.00),
(205, 122, 203, 1, 150.00),
(206, 122, 203, 1, 150.00),
(215, 123, 203, 1, 150.00),
(217, 124, 203, 1, 150.00),
(248, 125, 202, 1, 49.00),
(249, 125, 303, 1, 1.00),
(251, 125, 202, 1, 49.00),
(254, 126, 103, 1, 1000.00),
(255, 126, 501, 1, 17850.00),
(256, 126, 103, 1, 1000.00),
(257, 126, 501, 1, 17850.00),
(258, 126, 501, 1, 17850.00),
(259, 126, 307, 1, 0.75),
(260, 126, 103, 1, 1000.00),
(261, 126, 501, 1, 17850.00),
(262, 126, 309, 1, 1.50),
(263, 126, 307, 1, 0.75),
(264, 126, 103, 1, 1000.00),
(265, 127, 501, 1, 17850.00),
(272, 128, 103, 1, 1000.00),
(304, 129, 303, 1, 1.00),
(305, 129, 303, 1, 1.00),
(306, 129, 303, 1, 1.00),
(307, 129, 304, 1, 5.00),
(308, 129, 308, 1, 1.00),
(309, 129, 307, 1, 0.75),
(310, 129, 104, 1, 300.00),
(311, 129, 105, 1, 200.00),
(312, 129, 203, 1, 150.00),
(313, 129, 306, 1, 1.20),
(314, 129, 402, 1, 3.00),
(315, 129, 405, 1, 2.00),
(316, 129, 404, 1, 1.20),
(317, 129, 404, 1, 1.20),
(318, 130, 203, 1, 150.00),
(319, 130, 501, 1, 17850.00),
(320, 130, 203, 1, 150.00),
(321, 130, 102, 1, 40.00);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `datum` date DEFAULT current_timestamp(),
  `medewerker_id` int(11) DEFAULT NULL,
  `totaal_bedrag_excl_btw` int(11) DEFAULT NULL,
  `btw_bedrag` int(11) DEFAULT NULL,
  `totaal_bedrag_incl_btw` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `orders`
--

INSERT INTO `orders` (`order_id`, `datum`, `medewerker_id`, `totaal_bedrag_excl_btw`, `btw_bedrag`, `totaal_bedrag_incl_btw`) VALUES
(34, '2024-04-08', 1, 0, 0, 0.00),
(35, '2024-04-08', 1, 0, 0, 0.00),
(36, '2024-04-08', 1, NULL, NULL, NULL),
(37, '2024-04-08', NULL, NULL, NULL, NULL),
(38, '2024-04-08', NULL, NULL, NULL, NULL),
(39, '2024-04-08', NULL, NULL, NULL, NULL),
(40, '2024-04-08', NULL, NULL, NULL, NULL),
(41, '2024-04-08', NULL, NULL, NULL, NULL),
(42, '2024-04-08', NULL, NULL, NULL, NULL),
(43, '2024-04-08', NULL, NULL, NULL, NULL),
(44, '2024-04-08', NULL, NULL, NULL, NULL),
(45, '2024-04-08', NULL, NULL, NULL, NULL),
(46, '2024-04-08', NULL, NULL, NULL, NULL),
(47, '2024-04-08', NULL, NULL, NULL, NULL),
(48, '2024-04-08', NULL, NULL, NULL, NULL),
(49, '2024-04-08', NULL, NULL, NULL, NULL),
(50, '2024-04-08', NULL, NULL, NULL, NULL),
(51, '2024-04-08', NULL, NULL, NULL, NULL),
(52, '2024-04-09', NULL, NULL, NULL, NULL),
(53, '2024-04-09', 0, NULL, NULL, NULL),
(54, '2024-04-09', 1, NULL, NULL, NULL),
(55, '2024-04-09', 1, NULL, NULL, NULL),
(56, '2024-04-09', 2, NULL, NULL, 0.00),
(57, '2024-04-09', 2, NULL, NULL, 3.00),
(58, '2024-04-09', 2, NULL, NULL, 0.00),
(59, '2024-04-09', 2, 541, NULL, 655.00),
(60, '2024-04-09', 2, 0, NULL, 0.00),
(61, '2024-04-09', 0, 190, 40, 230.00),
(62, '2024-04-09', 0, 0, 0, 0.00),
(63, '2024-04-09', 1, 157, 33, 190.00),
(64, '2024-04-09', 1, 0, 0, 0.00),
(65, '2024-04-09', 1, 0, 0, 0.00),
(66, '2024-04-09', 1, 0, 0, 0.00),
(67, '2024-04-09', 1, 0, 0, 0.00),
(68, '2024-04-09', 1, 314, 66, 380.00),
(69, '2024-04-09', 1, 0, 0, 0.00),
(70, '2024-04-09', 1, 0, 0, 0.00),
(71, '2024-04-09', 1, 0, 0, 0.00),
(72, '2024-04-09', 1, 0, 0, 0.00),
(73, '2024-04-09', 1, 0, 0, 0.00),
(74, '2024-04-09', 1, 124, 26, 150.00),
(75, '2024-04-09', 1, 0, 0, 0.00),
(76, '2024-04-09', 1, 157, 33, 190.00),
(77, '2024-04-09', 1, 0, 0, 0.00),
(78, '2024-04-09', 1, 0, 0, 0.00),
(79, '2024-04-09', 1, 0, 0, 0.00),
(80, '2024-04-09', 1, 157, 33, 190.00),
(81, '2024-04-09', 1, 124, 26, 150.00),
(82, '2024-04-09', 1, 0, 0, 0.00),
(83, '2024-04-09', 1, 157, 33, 190.00),
(84, '2024-04-09', 1, 124, 26, 150.00),
(85, '2024-04-09', 1, 124, 26, 150.00),
(86, '2024-04-09', 1, 281, 59, 340.00),
(87, '2024-04-09', 1, 157, 33, 190.00),
(88, '2024-04-09', 1, 0, 0, 0.00),
(89, '2024-04-09', 1, 298, 62, 360.00),
(90, '2024-04-09', 1, 0, 0, 0.00),
(91, '2024-04-09', 1, 157, 33, 190.00),
(92, '2024-04-09', 1, 0, 0, 0.00),
(93, '2024-04-09', 1, 124, 26, 150.00),
(94, '2024-04-09', 1, 0, 0, 0.00),
(95, '2024-04-09', 1, 33, 7, 40.00),
(96, '2024-04-09', 1, 124, 26, 150.00),
(97, '2024-04-09', 1, 124, 26, 150.00),
(98, '2024-04-09', 1, 124, 26, 150.00),
(99, '2024-04-09', 1, 33, 7, 40.00),
(100, '2024-04-09', 1, 124, 26, 150.00),
(101, '2024-04-09', 1, 124, 26, 150.00),
(102, '2024-04-09', 1, 17, 3, 20.00),
(103, '2024-04-09', 2, 421, 89, 510.00),
(104, '2024-04-09', 1, 124, 26, 150.00),
(105, '2024-04-09', 1, 124, 26, 150.00),
(106, '2024-04-09', 1, 17, 3, 20.00),
(107, '2024-04-09', 1, 124, 26, 150.00),
(108, '2024-04-09', 1, 174, 36, 210.00),
(109, '2024-04-09', 1, 174, 36, 210.00),
(110, '2024-04-09', 1, 140, 30, 170.00),
(111, '2024-04-09', 1, 174, 36, 210.00),
(112, '2024-04-09', 1, 298, 62, 360.00),
(113, '2024-04-09', 1, 190, 40, 230.00),
(114, '2024-04-09', 1, 283, 52, 335.00),
(115, '2024-04-09', 1, 157, 33, 190.00),
(116, '2024-04-09', 1, 50, 10, 60.00),
(117, '2024-04-09', 1, 140, 30, 170.00),
(118, '2024-04-11', 1, 157, 33, 190.00),
(119, '2024-04-11', 1, 124, 26, 150.00),
(120, '2024-04-11', 1, 248, 52, 300.00),
(121, '2024-04-11', 1, 124, 26, 150.00),
(122, '2024-04-11', 1, 248, 52, 300.00),
(123, '2024-04-11', 1, 124, 26, 150.00),
(124, '2024-04-11', 1, 124, 26, 150.00),
(125, '2024-04-11', 2, 86, 17, 103.00),
(126, '2024-04-15', 1, 62317, 13086, 75403.00),
(127, '2024-04-15', 1, 14752, 3098, 17850.00),
(128, '2024-04-15', 6, 826, 174, 1000.00),
(129, '2024-04-15', 6, 554, 114, 668.35),
(130, '2024-04-15', 1, 15033, 3157, 18190.00);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `producten`
--

CREATE TABLE `producten` (
  `product_id` int(20) NOT NULL,
  `product_naam` varchar(250) DEFAULT NULL,
  `prijs` decimal(10,2) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `producten`
--

INSERT INTO `producten` (`product_id`, `product_naam`, `prijs`, `categorie_id`) VALUES
(101, 'Smartphone', 500.00, 1),
(102, 'Smart Light', 40.00, 1),
(103, 'Laptop', 1000.00, 1),
(104, 'Tablet', 300.00, 1),
(105, 'Smartwatch', 200.00, 1),
(201, 'Spijkerbroek', 63.00, 2),
(202, 'Hoodie', 49.00, 2),
(203, 'T-shirt', 150.00, 2),
(302, 'Winegums', 2.95, 3),
(303, 'Stroopwafels', 1.00, 3),
(304, 'Glorix eucalyptus bleek', 5.00, 3),
(306, 'Toffees', 1.20, 3),
(307, 'Kauwgom', 0.75, 3),
(308, 'Zure Snoepjes', 1.00, 3),
(309, 'Drop', 1.50, 3),
(310, 'Chocoladerepen', 2.00, 3),
(401, 'Donald Duck', 10.00, 4),
(402, 'Oreo', 3.00, 4),
(404, 'Maria', 1.20, 4),
(405, 'Jodenkoeken', 2.00, 4),
(406, 'Stroopwafels', 2.50, 4),
(407, 'Bastogne', 2.20, 4),
(408, 'Speculaas', 1.50, 4),
(409, 'Vanillewafels', 2.00, 4),
(410, 'Chocoladekoekjes', 2.75, 4),
(501, 'Rolex Pepsi', 17850.00, 5);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rollen`
--

CREATE TABLE `rollen` (
  `rol_id` int(11) NOT NULL,
  `rol_naam` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `rollen`
--

INSERT INTO `rollen` (`rol_id`, `rol_naam`) VALUES
(1, 'Manager'),
(2, 'Verkoper'),
(3, 'Magazijnmedewerker'),
(4, 'Administratief medewerker'),
(5, 'Kassamedewerker');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `voorraad`
--

CREATE TABLE `voorraad` (
  `product_id` int(20) NOT NULL,
  `aantal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `voorraad`
--

INSERT INTO `voorraad` (`product_id`, `aantal`) VALUES
(101, 30),
(102, 294),
(103, 10),
(104, 45),
(105, 60),
(201, 150),
(202, 25),
(203, 0),
(302, 166),
(303, 135),
(304, 94),
(306, 100),
(307, 200),
(308, 120),
(309, 80),
(310, 70),
(401, 658),
(402, 40),
(404, 70),
(405, 55),
(406, 45),
(407, 50),
(408, 65),
(409, 40),
(410, 55),
(501, 9);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `categorieën`
--
ALTER TABLE `categorieën`
  ADD PRIMARY KEY (`categorie_id`);

--
-- Indexen voor tabel `medewerkers`
--
ALTER TABLE `medewerkers`
  ADD UNIQUE KEY `medewerker_id` (`medewerker_id`);

--
-- Indexen voor tabel `orderregels`
--
ALTER TABLE `orderregels`
  ADD PRIMARY KEY (`bonregel_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexen voor tabel `producten`
--
ALTER TABLE `producten`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `categorie_id` (`categorie_id`);

--
-- Indexen voor tabel `rollen`
--
ALTER TABLE `rollen`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indexen voor tabel `voorraad`
--
ALTER TABLE `voorraad`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `categorieën`
--
ALTER TABLE `categorieën`
  MODIFY `categorie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `medewerkers`
--
ALTER TABLE `medewerkers`
  MODIFY `medewerker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `orderregels`
--
ALTER TABLE `orderregels`
  MODIFY `bonregel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;

--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `orderregels`
--
ALTER TABLE `orderregels`
  ADD CONSTRAINT `orderregels_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `orderregels_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `producten` (`product_id`);

--
-- Beperkingen voor tabel `producten`
--
ALTER TABLE `producten`
  ADD CONSTRAINT `producten_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categorieën` (`categorie_id`);

--
-- Beperkingen voor tabel `voorraad`
--
ALTER TABLE `voorraad`
  ADD CONSTRAINT `voorraad_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `producten` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
