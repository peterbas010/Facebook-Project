-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server versie:                5.6.17 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Versie:              9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Databasestructuur van peepzbook wordt geschreven
CREATE DATABASE IF NOT EXISTS `peepzbook` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `peepzbook`;


-- Structuur van  tabel peepzbook.comment wordt geschreven
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(50) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `post_id` int(11) NOT NULL,
  `gebruiker_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel peepzbook.comment: ~4 rows (ongeveer)
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` (`id`, `content`, `datum`, `post_id`, `gebruiker_id`, `parent_id`, `status`) VALUES
	(1, 'Hahah Wat een troep', '2014-11-13 20:35:08', 9, 1, 0, 0),
	(13, 'JAJAJ', '2014-11-13 20:35:09', 5, 1, 0, 0),
	(14, 'TEST', '2014-11-13 20:35:13', 5, 1, 0, 0),
	(15, '<3', '2014-11-21 09:04:53', 5, 1, 0, 1);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;


-- Structuur van  tabel peepzbook.gebruiker wordt geschreven
CREATE TABLE IF NOT EXISTS `gebruiker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `groep_id` int(11) NOT NULL,
  `persoon_id` int(11) NOT NULL,
  `avatar` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel peepzbook.gebruiker: ~2 rows (ongeveer)
/*!40000 ALTER TABLE `gebruiker` DISABLE KEYS */;
INSERT INTO `gebruiker` (`id`, `email`, `password`, `groep_id`, `persoon_id`, `avatar`, `status`) VALUES
	(1, 'peterbas0102@live.nl', 'abc123', 1, 6, '', 0),
	(2, 'henkdebaas@hotmail.com', 'abc123', 0, 7, '', 0);
/*!40000 ALTER TABLE `gebruiker` ENABLE KEYS */;


-- Structuur van  tabel peepzbook.groep wordt geschreven
CREATE TABLE IF NOT EXISTS `groep` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel peepzbook.groep: ~2 rows (ongeveer)
/*!40000 ALTER TABLE `groep` DISABLE KEYS */;
INSERT INTO `groep` (`id`, `type`) VALUES
	(0, 'user'),
	(1, 'admin');
/*!40000 ALTER TABLE `groep` ENABLE KEYS */;


-- Structuur van  tabel peepzbook.like wordt geschreven
CREATE TABLE IF NOT EXISTS `like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gebruiker_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel peepzbook.like: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `like` DISABLE KEYS */;
/*!40000 ALTER TABLE `like` ENABLE KEYS */;


-- Structuur van  tabel peepzbook.persoon wordt geschreven
CREATE TABLE IF NOT EXISTS `persoon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(50) NOT NULL,
  `achternaam` varchar(50) NOT NULL,
  `geboortedatum` int(11) NOT NULL,
  `adres` varchar(50) NOT NULL,
  `postcode` varchar(50) NOT NULL,
  `woonplaats` varchar(50) NOT NULL,
  `telefoon` varchar(50) NOT NULL,
  `mobiel` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel peepzbook.persoon: ~2 rows (ongeveer)
/*!40000 ALTER TABLE `persoon` DISABLE KEYS */;
INSERT INTO `persoon` (`id`, `voornaam`, `achternaam`, `geboortedatum`, `adres`, `postcode`, `woonplaats`, `telefoon`, `mobiel`) VALUES
	(6, 'Peter-Bas', 'Romijn', 0, 'Noordendijk 52', '3311 RP', 'Dordrecht', '078000000', '060000000'),
	(7, 'Henk', 'de Baas', 1902, 'Henk\'s Erf', '3310 JD', 'Dordrecht', '0786733451', '0654678212');
/*!40000 ALTER TABLE `persoon` ENABLE KEYS */;


-- Structuur van  tabel peepzbook.post wordt geschreven
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titel` varchar(50) NOT NULL,
  `content` varchar(50) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `gebruiker_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel peepzbook.post: ~7 rows (ongeveer)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`id`, `titel`, `content`, `datum`, `gebruiker_id`, `status`) VALUES
	(1, 'De eerste Post', 'Dit is de eerste post. Bla bla bla bla bla bla  bl', '2014-10-15 09:21:55', 6, 0),
	(3, 'De tweede post', 'Ik sta bovenaan, want hoe nieuwer een bericht is h', '2014-10-15 09:27:35', 6, 0),
	(4, 'meer', 'meer meer meer meer meer meer meer meer meer meer ', '2014-10-15 11:11:31', 6, 0),
	(5, 'LOL', 'Johan\r\n', '2014-11-12 10:27:29', 6, 0),
	(6, 'meer', 'meer meer meer meer meer meer meer meer meer meer ', '2014-10-15 11:11:36', 6, 0),
	(8, 'Henk', 'Mijn eerste post', '2014-11-04 15:01:25', 7, 0),
	(9, 'lol', '123', '2014-11-04 15:05:38', 7, 0);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
