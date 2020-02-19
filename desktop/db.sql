CREATE DATABASE IF NOT EXISTS `lbiz`;

USE `lbiz`;

CREATE TABLE IF NOT EXISTS `provider` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `address` varchar(255) DEFAULT NULL,
  `available` varchar(140) DEFAULT NULL,
  `category` varchar(60) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `type` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `job` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_provider` int(11) DEFAULT NULL,
  `datetime` varchar(30) DEFAULT NULL,
  `message` varchar(140) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_provider` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` float(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `delivery` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_provider` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `message` varchar(140) DEFAULT NULL,
  `status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `testimonial` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_provider` int(11) DEFAULT NULL,
  `testimonial` varchar(255) DEFAULT NULL,
  `rating` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
