-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 06. Feb 2018 um 19:44
-- Server-Version: 10.1.24-MariaDB
-- PHP-Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `webshop_db`
--
CREATE DATABASE IF NOT EXISTS `webshop_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `webshop_db`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `beitrag`
--

CREATE TABLE `beitrag` (
  `BeitragId` int(11) NOT NULL,
  `Ueberschrift` varchar(20) NOT NULL,
  `Inhalt` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `beitrag`
--

INSERT INTO `beitrag` (`BeitragId`, `Ueberschrift`, `Inhalt`) VALUES
(1, 'Testüberschrift1', 'Testtext1');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `BenutzerId` int(11) NOT NULL,
  `Loginname` varchar(25) NOT NULL,
  `Anrede` varchar(4) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Vorname` varchar(30) NOT NULL,
  `Geburtsdatum` date NOT NULL,
  `Mail` varchar(30) NOT NULL,
  `Telefon` varchar(15) DEFAULT NULL,
  `Passwort` varchar(50) NOT NULL,
  `BeitragId` int(11) DEFAULT NULL,
  `RolleId` int(11) DEFAULT NULL,
  `RgAdresseId` int(11) DEFAULT NULL,
  `LiAdresseId` int(11) DEFAULT NULL,
  `WarenkorbId` int(11) DEFAULT NULL,
  `ZahlungsId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`BenutzerId`, `Loginname`, `Anrede`, `Name`, `Vorname`, `Geburtsdatum`, `Mail`, `Telefon`, `Passwort`, `BeitragId`, `RolleId`, `RgAdresseId`, `LiAdresseId`, `WarenkorbId`, `ZahlungsId`) VALUES
(1, 'loginAdmin', 'Herr', 'testAdmin', 'Admin', '1999-01-01', 'test@admin.com', '0319510000', 'testAdmin1$', NULL, 1, 1, 1, NULL, 1),
(2, 'loginUser', 'Frau', 'testUser', 'User', '1999-01-01', 'test@user.com', '0215418522', 'testPasswort', 1, 2, 2, 2, NULL, 2),
(3, 'loginGast', 'Herr', 'testGast', 'Gast', '1999-01-01', 'test@gast.com', '0785952255', 'testGast3$', NULL, 3, 3, 3, NULL, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bewertung`
--

CREATE TABLE `bewertung` (
  `BewertungId` int(11) NOT NULL,
  `BewertungSterne` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `bewertung`
--

INSERT INTO `bewertung` (`BewertungId`, `BewertungSterne`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategorie`
--

CREATE TABLE `kategorie` (
  `KategorieId` int(11) NOT NULL,
  `Kategorie` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `kategorie`
--

INSERT INTO `kategorie` (`KategorieId`, `Kategorie`) VALUES
(1, 'Droide'),
(2, 'Raumschiff'),
(3, 'Waffe');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lieferadresse`
--

CREATE TABLE `lieferadresse` (
  `LiAdresseId` int(11) NOT NULL,
  `LiStrasseName` varchar(30) NOT NULL,
  `LiStrasseNr` varchar(5) NOT NULL,
  `LiPLZ` int(11) NOT NULL,
  `LiLand` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `lieferadresse`
--

INSERT INTO `lieferadresse` (`LiAdresseId`, `LiStrasseName`, `LiStrasseNr`, `LiPLZ`, `LiLand`) VALUES
(1, 'Musterstrasse', '20b', 3000, 'Musterdorf'),
(2, 'Milchstrasse', '13a', 4509, 'Lausanne'),
(3, 'Testgasse', '158', 1500, 'Testerdorf');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produkt`
--

CREATE TABLE `produkt` (
  `ProduktId` int(11) NOT NULL,
  `Produktname` varchar(30) NOT NULL,
  `KategorieId` int(11) NOT NULL,
  `Preis` decimal(10,2) NOT NULL,
  `Beschrieb` varchar(100) DEFAULT NULL,
  `BewertungId` int(11) DEFAULT NULL,
  `Bild` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `produkt`
--

INSERT INTO `produkt` (`ProduktId`, `Produktname`, `KategorieId`, `Preis`, `Beschrieb`, `BewertungId`, `Bild`) VALUES
(2, 'LE-VO ', 1, '9000.00', 'Polizeidroide', 3, '\\webshop\\grafical\\images\\levo.jpg\r\n'),
(3, 'FX-2', 1, '8500.00', 'Pflegedroide', 4, '\\webshop\\grafical\\images\\medidroide.jpg'),
(4, 'Millicreep', 1, '15000.00', 'Militärdroide', 5, '\\webshop\\grafical\\images\\millicreep.jpg'),
(5, 'Sternzerstörer', 2, '50000.00', 'Militärraumschiff', 3, '\\webshop\\grafical\\images\\sternzerstoerer.jpg'),
(6, 'X-Wing', 2, '85000.00', 'Schnellstes Schiff der Galaxie', 2, '\\webshop\\grafical\\images\\xwing.jpg'),
(7, 'TIE Fighter', 2, '35000.00', 'Raumjäger des Imperiums', 5, '\\webshop\\grafical\\images\\tiefighter.jpg'),
(8, 'X-42', 3, '2500.00', 'Flammenwerfer, auch BT-X-42 genannt.', 1, '\\webshop\\grafical\\images\\flammenwerfer.jpg'),
(9, 'Doppellichtschwert', 3, '30000.00', 'Doppellichtschwert', 5, '\\webshop\\grafical\\images\\doppellichtschwertrot.jpg'),
(10, 'Blaues Lichtschwert', 3, '20000.00', 'Blaues Lichtschwert, unbekannter vorheriger Besitzer.', 3, '\\webshop\\grafical\\images\\lichtschwert.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rechnungsadresse`
--

CREATE TABLE `rechnungsadresse` (
  `RgAdresseId` int(11) NOT NULL,
  `RgStrasseName` varchar(30) NOT NULL,
  `RgStrasseNr` varchar(5) NOT NULL,
  `RgPLZ` int(11) NOT NULL,
  `RgLand` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `rechnungsadresse`
--

INSERT INTO `rechnungsadresse` (`RgAdresseId`, `RgStrasseName`, `RgStrasseNr`, `RgPLZ`, `RgLand`) VALUES
(1, 'Metastrasse', '1', 1100, 'Metaverse'),
(2, 'Reiseweg', '42', 5200, 'Taiwan'),
(3, 'Prüferstrasse', '147s', 5852, 'Tatooine');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rolle`
--

CREATE TABLE `rolle` (
  `RolleId` int(11) NOT NULL,
  `Rolle` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `rolle`
--

INSERT INTO `rolle` (`RolleId`, `Rolle`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Gast');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `warenkorb`
--

CREATE TABLE `warenkorb` (
  `WarenkorbId` int(11) NOT NULL,
  `ProduktId` int(11) NOT NULL,
  `Anzahl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zahlungsmittel`
--

CREATE TABLE `zahlungsmittel` (
  `ZahlungsId` int(11) NOT NULL,
  `Zahlungsart` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `zahlungsmittel`
--

INSERT INTO `zahlungsmittel` (`ZahlungsId`, `Zahlungsart`) VALUES
(1, 'Postcard'),
(2, 'PayPal'),
(3, 'Mastercard'),
(4, 'Visa'),
(5, 'Überweisung');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `beitrag`
--
ALTER TABLE `beitrag`
  ADD PRIMARY KEY (`BeitragId`);

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`BenutzerId`),
  ADD KEY `BeitragId` (`BeitragId`),
  ADD KEY `RolleId` (`RolleId`),
  ADD KEY `RgAdresseId` (`RgAdresseId`),
  ADD KEY `LiAdresseId` (`LiAdresseId`),
  ADD KEY `WarenkorbId` (`WarenkorbId`),
  ADD KEY `ZahlungsId` (`ZahlungsId`);

--
-- Indizes für die Tabelle `bewertung`
--
ALTER TABLE `bewertung`
  ADD PRIMARY KEY (`BewertungId`);

--
-- Indizes für die Tabelle `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`KategorieId`);

--
-- Indizes für die Tabelle `lieferadresse`
--
ALTER TABLE `lieferadresse`
  ADD PRIMARY KEY (`LiAdresseId`);

--
-- Indizes für die Tabelle `produkt`
--
ALTER TABLE `produkt`
  ADD PRIMARY KEY (`ProduktId`),
  ADD KEY `produkt_ibfk_1` (`BewertungId`),
  ADD KEY `produkt_ibfk_2` (`KategorieId`);

--
-- Indizes für die Tabelle `rechnungsadresse`
--
ALTER TABLE `rechnungsadresse`
  ADD PRIMARY KEY (`RgAdresseId`);

--
-- Indizes für die Tabelle `rolle`
--
ALTER TABLE `rolle`
  ADD PRIMARY KEY (`RolleId`);

--
-- Indizes für die Tabelle `warenkorb`
--
ALTER TABLE `warenkorb`
  ADD PRIMARY KEY (`WarenkorbId`),
  ADD KEY `ProduktId` (`ProduktId`);

--
-- Indizes für die Tabelle `zahlungsmittel`
--
ALTER TABLE `zahlungsmittel`
  ADD PRIMARY KEY (`ZahlungsId`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `beitrag`
--
ALTER TABLE `beitrag`
  MODIFY `BeitragId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `BenutzerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT für Tabelle `bewertung`
--
ALTER TABLE `bewertung`
  MODIFY `BewertungId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT für Tabelle `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `KategorieId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `lieferadresse`
--
ALTER TABLE `lieferadresse`
  MODIFY `LiAdresseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT für Tabelle `produkt`
--
ALTER TABLE `produkt`
  MODIFY `ProduktId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT für Tabelle `rechnungsadresse`
--
ALTER TABLE `rechnungsadresse`
  MODIFY `RgAdresseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT für Tabelle `rolle`
--
ALTER TABLE `rolle`
  MODIFY `RolleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `warenkorb`
--
ALTER TABLE `warenkorb`
  MODIFY `WarenkorbId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `zahlungsmittel`
--
ALTER TABLE `zahlungsmittel`
  MODIFY `ZahlungsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD CONSTRAINT `benutzer_ibfk_2` FOREIGN KEY (`BeitragId`) REFERENCES `beitrag` (`BeitragId`),
  ADD CONSTRAINT `benutzer_ibfk_3` FOREIGN KEY (`RolleId`) REFERENCES `rolle` (`RolleId`),
  ADD CONSTRAINT `benutzer_ibfk_4` FOREIGN KEY (`RgAdresseId`) REFERENCES `rechnungsadresse` (`RgAdresseId`),
  ADD CONSTRAINT `benutzer_ibfk_5` FOREIGN KEY (`LiAdresseId`) REFERENCES `lieferadresse` (`LiAdresseId`),
  ADD CONSTRAINT `benutzer_ibfk_7` FOREIGN KEY (`WarenkorbId`) REFERENCES `warenkorb` (`WarenkorbId`),
  ADD CONSTRAINT `benutzer_ibfk_8` FOREIGN KEY (`ZahlungsId`) REFERENCES `zahlungsmittel` (`ZahlungsId`);

--
-- Constraints der Tabelle `produkt`
--
ALTER TABLE `produkt`
  ADD CONSTRAINT `produkt_ibfk_1` FOREIGN KEY (`BewertungId`) REFERENCES `bewertung` (`BewertungId`),
  ADD CONSTRAINT `produkt_ibfk_2` FOREIGN KEY (`KategorieId`) REFERENCES `kategorie` (`KategorieId`);

--
-- Constraints der Tabelle `warenkorb`
--
ALTER TABLE `warenkorb`
  ADD CONSTRAINT `warenkorb_ibfk_1` FOREIGN KEY (`ProduktId`) REFERENCES `produkt` (`ProduktId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
