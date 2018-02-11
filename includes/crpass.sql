use digitalc_aritab2c;

-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 16, 2018 at 12:07 PM
-- Server version: 5.7.20
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crpass`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--
CREATE TABLE IF NOT EXISTS `user` (
  `iduser` INT NOT NULL AUTO_INCREMENT,
  `user` VARCHAR(60) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NULL,
  `phone` VARCHAR(20) NULL,
    `country` VARCHAR(60) NULL,
      `company` VARCHAR(200) NULL,
  `password` VARCHAR(45) NOT NULL,

  PRIMARY KEY (`iduser`))
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `mydb`.`history`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `history` (
  `idhistory` VARCHAR(45) NOT NULL,
  `acction` VARCHAR(100) NOT NULL,
  `description` VARCHAR(200) NULL,
  `date` VARCHAR(60) NOT NULL,
  `iduser` INT NOT NULL,
  PRIMARY KEY (`idhistory`),
  INDEX `iduser_idx` (`iduser` ASC),
  CONSTRAINT `iduser`
    FOREIGN KEY (`iduser`)
    REFERENCES `user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `mydb`.`logs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `logs` (
  `idlogs` VARCHAR(45) NOT NULL,
  `error` VARCHAR(100) NOT NULL,
  `description` VARCHAR(200) NULL,
  `date` VARCHAR(60) NOT NULL,
  `iduser` INT NOT NULL,
  PRIMARY KEY (`idlogs`),
  INDEX `iduser_idx` (`iduser` ASC),
  CONSTRAINT `iduser0`
    FOREIGN KEY (`iduser`)
    REFERENCES `user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `countries` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `gpslat` decimal(18,15) DEFAULT NULL,
  `gpslong` decimal(18,15) DEFAULT NULL,
  `gpszoom` tinyint(3) unsigned DEFAULT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `countrydetails`
--

CREATE TABLE IF NOT EXISTS `countrydetails` (
  `country_id` tinyint(3) unsigned NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`country_id`,`language_id`),
  KEY `FK_country_id_idx` (`country_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country_media`
--

CREATE TABLE IF NOT EXISTS `country_media` (
  `country_id` tinyint(3) unsigned NOT NULL,
  `media_id` int(10) unsigned NOT NULL,
  `template_id` int(10) unsigned NOT NULL,
  `position` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`country_id`,`media_id`,`template_id`),
  KEY `media_id` (`media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `itineraries`
--

CREATE TABLE IF NOT EXISTS `itineraries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `package_id` smallint(5) unsigned NOT NULL,
  `package_transportoption_id` smallint(5) unsigned NOT NULL,
  `startdate` date NOT NULL,
  `totalpax` tinyint(3) unsigned NOT NULL,
  `uuid` binary(16) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `package_id` (`package_id`),
  KEY `package_transportoption_id` (`package_transportoption_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='customer itineraries' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `itineraryprices`
--

CREATE TABLE IF NOT EXISTS `itineraryprices` (
  `service_id` smallint(5) unsigned NOT NULL,
  `itinerary_occupation_id` int(50) unsigned NOT NULL,
  `price` decimal(12,4) NOT NULL,
  PRIMARY KEY (`service_id`,`itinerary_occupation_id`),
  KEY `service_id` (`service_id`),
  KEY `itinerary_paxoccupation_id` (`itinerary_occupation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `itineraryroutes`
--

CREATE TABLE IF NOT EXISTS `itineraryroutes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `itinerary_id` int(10) unsigned NOT NULL,
  `location_id` smallint(5) unsigned NOT NULL,
  `position` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `minnights` tinyint(3) unsigned NOT NULL,
  `nights` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `itinerary_id` (`itinerary_id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `itineraryroute_products`
--

CREATE TABLE IF NOT EXISTS `itineraryroute_products` (
  `itineraryroute_id` int(10) unsigned NOT NULL,
  `service_id` smallint(5) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `day` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`itineraryroute_id`,`service_id`,`product_id`),
  KEY `itineraryroute_id` (`itineraryroute_id`),
  KEY `service_id` (`service_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='customer products';

-- --------------------------------------------------------

--
-- Table structure for table `itineraryroute_services`
--

CREATE TABLE IF NOT EXISTS `itineraryroute_services` (
  `itineraryroute_id` int(10) unsigned NOT NULL,
  `service_id` smallint(5) unsigned NOT NULL,
  `minquantity` tinyint(3) unsigned NOT NULL,
  `quantity` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`itineraryroute_id`,`service_id`),
  KEY `itineraryroute_id` (`itineraryroute_id`),
  KEY `service_id` (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='itinerary included services';

-- --------------------------------------------------------

--
-- Table structure for table `itinerary_occupations`
--

CREATE TABLE IF NOT EXISTS `itinerary_occupations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `itinerary_id` int(10) unsigned NOT NULL,
  `occupation_id` char(2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `itinerary_id` (`itinerary_id`),
  KEY `occupation_id` (`occupation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='itinerary occupation configuration' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `labeldetails`
--

CREATE TABLE IF NOT EXISTS `labeldetails` (
  `label_id` int(10) unsigned NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`label_id`,`language_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

CREATE TABLE IF NOT EXISTS `labels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `short` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `short` (`short`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `locationdetails`
--

CREATE TABLE IF NOT EXISTS `locationdetails` (
  `location_id` smallint(5) unsigned NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`location_id`,`language_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` tinyint(3) unsigned NOT NULL,
  `gpslat` decimal(18,15) DEFAULT NULL,
  `gpslong` decimal(18,15) DEFAULT NULL,
  `gpszoom` tinyint(3) unsigned DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `location_media`
--

CREATE TABLE IF NOT EXISTS `location_media` (
  `location_id` smallint(5) unsigned NOT NULL,
  `media_id` int(10) unsigned NOT NULL,
  `template_id` int(10) unsigned NOT NULL,
  `position` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`location_id`,`media_id`,`template_id`),
  KEY `media_id` (`media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `occupationdetails`
--

CREATE TABLE IF NOT EXISTS `occupationdetails` (
  `occupation_id` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `description` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`language_id`,`occupation_id`),
  KEY `occupation_id` (`occupation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `occupations`
--

CREATE TABLE IF NOT EXISTS `occupations` (
  `id` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `persons` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packagedetails`
--

CREATE TABLE IF NOT EXISTS `packagedetails` (
  `package_id` smallint(5) unsigned NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`package_id`,`language_id`),
  KEY `package_id` (`package_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packageroutes`
--

CREATE TABLE IF NOT EXISTS `packageroutes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `package_id` smallint(5) unsigned NOT NULL,
  `location_id` smallint(5) unsigned NOT NULL,
  `position` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `minnights` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `package_id` (`package_id`,`location_id`,`position`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `packageroute_products`
--

CREATE TABLE IF NOT EXISTS `packageroute_products` (
  `packageroute_id` int(10) unsigned NOT NULL,
  `service_id` smallint(5) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `day` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`packageroute_id`,`service_id`,`product_id`),
  KEY `packageroute_id` (`packageroute_id`),
  KEY `service_id` (`service_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='recommended products';

-- --------------------------------------------------------

--
-- Table structure for table `packageroute_services`
--

CREATE TABLE IF NOT EXISTS `packageroute_services` (
  `packageroute_id` int(10) unsigned NOT NULL,
  `service_id` smallint(5) unsigned NOT NULL,
  `quantity` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`packageroute_id`,`service_id`),
  KEY `packageroute_id` (`packageroute_id`),
  KEY `service_id` (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='package included and additional services';

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE IF NOT EXISTS `packages` (
  `id` smallint(5) unsigned NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_tags`
--

CREATE TABLE IF NOT EXISTS `package_tags` (
  `package_id` smallint(5) unsigned NOT NULL,
  `tag_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`package_id`,`tag_id`),
  KEY `package_id` (`package_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_transportoptions`
--

CREATE TABLE IF NOT EXISTS `package_transportoptions` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `package_id` smallint(5) unsigned NOT NULL,
  `transporttype_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `package_id` (`package_id`),
  KEY `transporttype_id` (`transporttype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE IF NOT EXISTS `prices` (
  `service_id` smallint(5) unsigned NOT NULL,
  `occupation_id` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `packagetransportoption_id` smallint(5) unsigned NOT NULL,
  `seasonperiod_id` smallint(5) unsigned NOT NULL,
  `price` decimal(12,4) NOT NULL,
  PRIMARY KEY (`service_id`,`occupation_id`,`packagetransportoption_id`,`seasonperiod_id`),
  KEY `paxoccupation_id` (`occupation_id`),
  KEY `prices_ibfk_3` (`packagetransportoption_id`),
  KEY `prices_ibfk_4` (`seasonperiod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productdetails`
--

CREATE TABLE IF NOT EXISTS `productdetails` (
  `product_id` int(10) unsigned NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`product_id`,`language_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` smallint(5) unsigned NOT NULL,
  `country_id` tinyint(3) unsigned NOT NULL,
  `location_id` smallint(5) unsigned DEFAULT NULL,
  `gpslat` decimal(18,15) DEFAULT NULL,
  `gpslong` decimal(18,15) DEFAULT NULL,
  `gpszoom` tinyint(3) unsigned DEFAULT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  KEY `country_id` (`country_id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE IF NOT EXISTS `product_media` (
  `product_id` int(10) unsigned NOT NULL,
  `media_id` int(10) unsigned NOT NULL,
  `template_id` int(10) unsigned NOT NULL,
  `position` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`,`media_id`,`template_id`),
  KEY `media_id` (`media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seasonperiods`
--

CREATE TABLE IF NOT EXISTS `seasonperiods` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `season_id` smallint(5) unsigned NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `season_id` (`season_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

CREATE TABLE IF NOT EXISTS `seasons` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `servicedetails`
--

CREATE TABLE IF NOT EXISTS `servicedetails` (
  `service_id` smallint(5) unsigned NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`service_id`,`language_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `bylocation` tinyint(1) NOT NULL DEFAULT '0',
  `byitinerary` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tagdetails`
--

CREATE TABLE IF NOT EXISTS `tagdetails` (
  `tag_id` smallint(5) unsigned NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`tag_id`,`language_id`),
  KEY `tag_id` (`tag_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `enabled` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transporttypedetail`
--

CREATE TABLE IF NOT EXISTS `transporttypedetail` (
  `transporttype_id` tinyint(3) unsigned NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`transporttype_id`,`language_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transporttypes`
--

CREATE TABLE IF NOT EXISTS `transporttypes` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `default` tinyint(1) unsigned NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `countrydetails`
--
ALTER TABLE `countrydetails`
  ADD CONSTRAINT `countrydetails_ibfk_3` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `countrydetails_ibfk_4` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `country_media`
--
ALTER TABLE `country_media`
  ADD CONSTRAINT `country_media_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `itineraries`
--
ALTER TABLE `itineraries`
  ADD CONSTRAINT `itineraries_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `itineraries_ibfk_2` FOREIGN KEY (`package_transportoption_id`) REFERENCES `package_transportoptions` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `itineraryprices`
--
ALTER TABLE `itineraryprices`
  ADD CONSTRAINT `itineraryprices_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `itineraryprices_ibfk_2` FOREIGN KEY (`itinerary_occupation_id`) REFERENCES `itinerary_occupations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `itineraryroutes`
--
ALTER TABLE `itineraryroutes`
  ADD CONSTRAINT `itineraryroutes_ibfk_1` FOREIGN KEY (`itinerary_id`) REFERENCES `itineraries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itineraryroutes_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `itineraryroute_products`
--
ALTER TABLE `itineraryroute_products`
  ADD CONSTRAINT `itineraryroute_products_ibfk_1` FOREIGN KEY (`itineraryroute_id`) REFERENCES `itineraryroutes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itineraryroute_products_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itineraryroute_products_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `itineraryroute_services`
--
ALTER TABLE `itineraryroute_services`
  ADD CONSTRAINT `itineraryroute_services_ibfk_1` FOREIGN KEY (`itineraryroute_id`) REFERENCES `itineraryroutes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itineraryroute_services_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `itinerary_occupations`
--
ALTER TABLE `itinerary_occupations`
  ADD CONSTRAINT `itinerary_occupations_ibfk_1` FOREIGN KEY (`itinerary_id`) REFERENCES `itineraries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itinerary_occupations_ibfk_2` FOREIGN KEY (`occupation_id`) REFERENCES `occupations` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `labeldetails`
--
ALTER TABLE `labeldetails`
  ADD CONSTRAINT `labeldetails_ibfk_1` FOREIGN KEY (`label_id`) REFERENCES `labels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `labeldetails_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `locationdetails`
--
ALTER TABLE `locationdetails`
  ADD CONSTRAINT `locationdetails_ibfk_4` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `locationdetails_ibfk_5` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_ibfk_4` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `location_media`
--
ALTER TABLE `location_media`
  ADD CONSTRAINT `location_media_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `occupationdetails`
--
ALTER TABLE `occupationdetails`
  ADD CONSTRAINT `occupationdetails_ibfk_1` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `occupationdetails_ibfk_2` FOREIGN KEY (`occupation_id`) REFERENCES `occupations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `packagedetails`
--
ALTER TABLE `packagedetails`
  ADD CONSTRAINT `packagedetails_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `packagedetails_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `packageroutes`
--
ALTER TABLE `packageroutes`
  ADD CONSTRAINT `packageroutes_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `packageroutes_ibfk_3` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `packageroute_products`
--
ALTER TABLE `packageroute_products`
  ADD CONSTRAINT `packageroute_products_ibfk_1` FOREIGN KEY (`packageroute_id`) REFERENCES `packageroutes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `packageroute_products_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `packageroute_products_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `packageroute_services`
--
ALTER TABLE `packageroute_services`
  ADD CONSTRAINT `packageroute_services_ibfk_1` FOREIGN KEY (`packageroute_id`) REFERENCES `packageroutes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `packageroute_services_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `package_tags`
--
ALTER TABLE `package_tags`
  ADD CONSTRAINT `package_tags_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `package_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `package_transportoptions`
--
ALTER TABLE `package_transportoptions`
  ADD CONSTRAINT `package_transportoptions_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `package_transportoptions_ibfk_2` FOREIGN KEY (`transporttype_id`) REFERENCES `transporttypes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `prices_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `prices_ibfk_3` FOREIGN KEY (`packagetransportoption_id`) REFERENCES `package_transportoptions` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `prices_ibfk_4` FOREIGN KEY (`seasonperiod_id`) REFERENCES `seasonperiods` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `prices_ibfk_5` FOREIGN KEY (`occupation_id`) REFERENCES `occupations` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `productdetails`
--
ALTER TABLE `productdetails`
  ADD CONSTRAINT `productdetails_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productdetails_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `product_media_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seasonperiods`
--
ALTER TABLE `seasonperiods`
  ADD CONSTRAINT `seasonperiods_ibfk_1` FOREIGN KEY (`season_id`) REFERENCES `seasons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `servicedetails`
--
ALTER TABLE `servicedetails`
  ADD CONSTRAINT `servicedetails_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `servicedetails_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tagdetails`
--
ALTER TABLE `tagdetails`
  ADD CONSTRAINT `tagdetails_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tagdetails_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transporttypedetail`
--
ALTER TABLE `transporttypedetail`
  ADD CONSTRAINT `transporttypedetail_ibfk_1` FOREIGN KEY (`transporttype_id`) REFERENCES `transporttypes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transporttypedetail_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
