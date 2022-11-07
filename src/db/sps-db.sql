-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1:3306
-- Vytvořeno: Pon 07. lis 2022, 15:51
-- Verze serveru: 5.7.36
-- Verze PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `sps-db`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `clanek`
--

DROP TABLE IF EXISTS `clanek`;
CREATE TABLE IF NOT EXISTS `clanek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_stav` int(11) NOT NULL,
  `id_autor` int(11) NOT NULL,
  `datum` date NOT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `soubor` blob NOT NULL,
  `spoluautori` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_stavClanku` (`id_stav`),
  KEY `fk_autorClanku` (`id_autor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `posudek`
--

DROP TABLE IF EXISTS `posudek`;
CREATE TABLE IF NOT EXISTS `posudek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_uzivatel` int(11) NOT NULL,
  `id_clanek` int(11) NOT NULL,
  `datum` date NOT NULL,
  `text` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_autorPosudku` (`id_uzivatel`),
  KEY `fk_posuzovanyClanek` (`id_clanek`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `kod` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `role`
--

INSERT INTO `role` (`id`, `nazev`, `kod`) VALUES
(1, 'Administrátor', 'admin'),
(2, 'Autor', 'autor'),
(3, 'Redaktor', 'redaktor'),
(4, 'Šéfredaktor', 'sefredaktor'),
(5, 'Recenzent', 'recenzent');

-- --------------------------------------------------------

--
-- Struktura tabulky `stav`
--

DROP TABLE IF EXISTS `stav`;
CREATE TABLE IF NOT EXISTS `stav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `kod` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `stav`
--

INSERT INTO `stav` (`id`, `nazev`, `kod`) VALUES
(1, 'Přidáno', 'pridano'),
(2, 'Přijato', 'prijato'),
(3, 'Zamítnuto', 'zamitnuto'),
(4, 'Vráceno', 'vraceno'),
(5, 'Odesláno k posudku', 'odeslano_k_posudku');

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatel`
--

DROP TABLE IF EXISTS `uzivatel`;
CREATE TABLE IF NOT EXISTS `uzivatel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_role` int(11) NOT NULL,
  `login` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `heslo` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `jmeno` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `prijmeni` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  KEY `fk_roleUzivatele` (`id_role`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
