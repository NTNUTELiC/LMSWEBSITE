-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生日期: 2013 年 06 月 13 日 10:42
-- 伺服器版本: 5.5.27
-- PHP 版本: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `lms`
--

-- --------------------------------------------------------

--
-- 表的結構 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `account` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 轉存資料表中的資料 `admin`
--

INSERT INTO `admin` (`account`, `password`) VALUES
('telic1234', 'telic1234');

-- --------------------------------------------------------

--
-- 表的結構 `material_record`
--

CREATE TABLE IF NOT EXISTS `material_record` (
  `serial` int(11) NOT NULL,
  `click_number` int(11) NOT NULL,
  PRIMARY KEY (`serial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 轉存資料表中的資料 `material_record`
--

INSERT INTO `material_record` (`serial`, `click_number`) VALUES
(1000, 7),
(1001, 10),
(1002, 2),
(1003, 5),
(1004, 3),
(1005, 1);

-- --------------------------------------------------------

--
-- 表的結構 `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `account` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) NOT NULL,
  `country` varchar(20) CHARACTER SET utf8 NOT NULL,
  `age` int(11) NOT NULL,
  `read_num` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`account`),
  UNIQUE KEY `account` (`account`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 轉存資料表中的資料 `member`
--

INSERT INTO `member` (`account`, `password`, `username`, `email`, `country`, `age`, `read_num`) VALUES
('kevin', 'kevin', '高翊展', '6006s@csie.ntnu.edu.tw', '台北', 24, 8),
('marvin', 'marvin', '許志安', 'marvinislove@gmail.com', '桃園', 27, 0),
('mary', 'mary', '馬力', 'mary@ntnu.edu.tw', '台南市', 27, 16),
('pony', 'pony', '鳳小岳', 'ponyisright@gmail.com', '台北', 30, 4),
('terry', 'terry', '張孝全', 'terryiloveyou@gmail.com', '台中', 28, 0),
('tony', 'tony', '彭于晏', 'tonyiscute@gmail.com', '台北', 28, 0);

-- --------------------------------------------------------

--
-- 表的結構 `reading`
--

CREATE TABLE IF NOT EXISTS `reading` (
  `serial` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `content` varchar(50) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`serial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 轉存資料表中的資料 `reading`
--

INSERT INTO `reading` (`serial`, `type`, `content`, `name`) VALUES
(1000, 'figure', '', '手機5'),
(1001, 'article', '1001.txt', '網址'),
(1002, 'figure', '1002.jpg', '手機1'),
(1003, 'article', '', '網址'),
(1004, 'figure', '', '手機2'),
(1005, 'article', '', '網址');

-- --------------------------------------------------------

--
-- 表的結構 `record`
--

CREATE TABLE IF NOT EXISTS `record` (
  `account` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `serial` int(11) NOT NULL,
  `time` int(255) NOT NULL,
  `comments` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`account`,`serial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 轉存資料表中的資料 `record`
--

INSERT INTO `record` (`account`, `serial`, `time`, `comments`) VALUES
('kevin', 1000, 1, ''),
('kevin', 1001, 2, ''),
('kevin', 1002, 2, ''),
('kevin', 1004, 3, ''),
('mary', 1000, 6, ''),
('mary', 1001, 8, ''),
('mary', 1003, 2, ''),
('pony', 1003, 3, ''),
('pony', 1005, 1, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
