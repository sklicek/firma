-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 18. Mai 2020 um 09:46
-- Server-Version: 8.0.20
-- PHP-Version: 7.2.24-0ubuntu0.18.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `firma`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `angebote_artikel`
--

CREATE TABLE `rechnungen_artikel` (
  `id_art` int NOT NULL,
  `bezeichnung` varchar(250) DEFAULT NULL,
  `id_einheit` int DEFAULT NULL,
  `vkpreis_einheit` decimal(10,2) DEFAULT NULL,
  `id_rechnung` int DEFAULT NULL,
  `anzahl` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `angebote_artikel`
--
ALTER TABLE `rechnungen_artikel`
  ADD PRIMARY KEY (`id_art`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `angebote_artikel`
--
ALTER TABLE `rechnungen_artikel`
  MODIFY `id_art` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
