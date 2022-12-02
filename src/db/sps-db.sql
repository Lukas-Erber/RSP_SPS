-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 21. lis 2022, 23:36
-- Verze serveru: 10.4.25-MariaDB
-- Verze PHP: 8.1.10

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

CREATE TABLE `clanek` (
  `id` int(11) NOT NULL,
  `id_stav` int(11) NOT NULL,
  `id_autor` int(11) NOT NULL,
  `tema` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `datum` date NOT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `soubor` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `spoluautori` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `clanek`
--

INSERT INTO `clanek` (`id`, `id_stav`, `id_autor`, `tema`, `datum`, `nazev`, `soubor`, `spoluautori`) VALUES
(1, 0, 1, 'tema', '2022-11-19', 'nazev', 'test.txt', 'autor');

-- --------------------------------------------------------

--
-- Struktura tabulky `posudek`
--

CREATE TABLE `posudek` (
  `id` int(11) NOT NULL,
  `id_uzivatel` int(11) NOT NULL,
  `id_clanek` int(11) NOT NULL,
  `datum` date NOT NULL,
  `text` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `kod` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

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

CREATE TABLE `stav` (
  `id` int(11) NOT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `kod` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

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

CREATE TABLE `uzivatel` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `login` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `heslo` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `jmeno` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `prijmeni` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `uzivatel`
--

INSERT INTO `uzivatel` (`id`, `id_role`, `login`, `heslo`, `jmeno`, `prijmeni`, `email`) VALUES
(1, 2, 'test', '$2y$10$kulxTzH8sVFmt1YAD/Gawuf4CqNuPJU6537c79QSx0DpvICeMb8qm', 'test', 'test', 'test@test.cz'),
(2, 1, 'admin', '$2y$10$kulxTzH8sVFmt1YAD/Gawuf4CqNuPJU6537c79QSx0DpvICeMb8qm', 'admin', 'admin', 'admin@email.cz'),
(3, 2, 'autor', '$2y$10$kulxTzH8sVFmt1YAD/Gawuf4CqNuPJU6537c79QSx0DpvICeMb8qm', 'Prokop', 'Buben', 'prokop@buben.cz'),
(4, 3, 'redaktor', '$2y$10$kulxTzH8sVFmt1YAD/Gawuf4CqNuPJU6537c79QSx0DpvICeMb8qm', 'Nějaký', 'Jméno', 'redaktor@email.cz'),
(5, 4, 'sefredaktor', '$2y$10$kulxTzH8sVFmt1YAD/Gawuf4CqNuPJU6537c79QSx0DpvICeMb8qm', 'Šéfredaktorovo', 'Jméno', 'sefredaktor@email.cz'),
(6, 5, 'recenzent', '$2y$10$kulxTzH8sVFmt1YAD/Gawuf4CqNuPJU6537c79QSx0DpvICeMb8qm', 'Recenzent', 'Aaaa', 'recenzent@email.cz');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `clanek`
--
ALTER TABLE `clanek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_stavClanku` (`id_stav`),
  ADD KEY `fk_autorClanku` (`id_autor`);

--
-- Indexy pro tabulku `posudek`
--
ALTER TABLE `posudek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_autorPosudku` (`id_uzivatel`),
  ADD KEY `fk_posuzovanyClanek` (`id_clanek`);

--
-- Indexy pro tabulku `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `stav`
--
ALTER TABLE `stav`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `fk_roleUzivatele` (`id_role`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `clanek`
--
ALTER TABLE `clanek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pro tabulku `posudek`
--
ALTER TABLE `posudek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `stav`
--
ALTER TABLE `stav`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
