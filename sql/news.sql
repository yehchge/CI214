-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生日期: 2014 年 04 月 19 日 17:45
-- 伺服器版本: 5.5.15
-- PHP 版本: 5.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `news`
--

-- --------------------------------------------------------

--
-- 表的結構 `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link_title` varchar(50) NOT NULL,
  `link_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 轉存資料表中的資料 `links`
--

INSERT INTO `links` (`id`, `link_title`, `link_url`) VALUES
(1, 'google', 'http://www.google.com'),
(2, 'Yahoo', 'http://tw.yahoo.com'),
(3, 'iCD', 'http://www.iwant-music.com');

-- --------------------------------------------------------

--
-- 表的結構 `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 轉存資料表中的資料 `news`
--

INSERT INTO `news` (`id`, `title`, `slug`, `text`) VALUES
(1, '快訊／連丁對決要選誰？　馬英九投給丁守中', '', '記者陳弘修／台北報導\r\n\r\n國民黨台北市19日進行黨內初選投票，黨主席馬英九下午完成投票，面對媒體詢問支持那位參選人？他雖然沒有回答，但卻被現場媒體拍到圈票後拿在手上對折的選票，透過光線與放大檢視，馬英九將選票蓋給了丁守中。\r\n\r\n國民黨台北市長黨內初選的參選人登記，按照號次為：1號鍾小平、2號蔡正元、3號丁守中、4號連勝文。從現場媒體拍到圈票後拿在手上對折的選票，透過光線與放大檢視馬英九折起來的選票，3號上方有紅色印戳。\r\n\r\n新聞相關影音'),
(2, '快訊／連丁對決要選誰？　馬英九投給丁守中', '', '記者陳弘修／台北報導\r\n\r\n國民黨台北市19日進行黨內初選投票，黨主席馬英九下午完成投票，面對媒體詢問支持那位參選人？他雖然沒有回答，但卻被現場媒體拍到圈票後拿在手上對折的選票，透過光線與放大檢視，馬英九將選票蓋給了丁守中。\r\n\r\n國民黨台北市長黨內初選的參選人登記，按照號次為：1號鍾小平、2號蔡正元、3號丁守中、4號連勝文。從現場媒體拍到圈票後拿在手上對折的選票，透過光線與放大檢視馬英九折起來的選票，3號上方有紅色印戳。'),
(3, '快訊／連丁對決要選誰？　馬英九投給丁守中', '', '記者陳弘修／台北報導\r\n\r\n國民黨台北市19日進行黨內初選投票，黨主席馬英九下午完成投票，面對媒體詢問支持那位參選人？他雖然沒有回答，但卻被現場媒體拍到圈票後拿在手上對折的選票，透過光線與放大檢視，馬英九將選票蓋給了丁守中。\r\n\r\n國民黨台北市長黨內初選的參選人登記，按照號次為：1號鍾小平、2號蔡正元、3號丁守中、4號連勝文。從現場媒體拍到圈票後拿在手上對折的選票，透過光線與放大檢視馬英九折起來的選票，3號上方有紅色印戳。'),
(4, ' 翁倒路旁 蒼蠅圍繞…警伸援送醫', '', '東勢有個「路倒哥」劉姓獨居男子，雙腳腫脹且染有肺病，日前又橫躺便利超商整天，渾身臭味，蒼蠅圍繞在腳上傷口，劉男拿著健保卡向路人求救，但無人搭理，直到巡邏員警看到，才趕緊將他送東勢農民醫院急救。\r\n\r\n76歲的劉男是搭豐原客運從卓蘭到東勢，走沒幾步路就倒臥豐勢路、忠孝街的超商前面，身上只有一些零錢跟健保卡，可能右腳掌傷口未癒合，引來一群蒼蠅靠近，經過的人紛紛走避。\r\n\r\n劉姓男子說，僅有1個哥哥但未同住，之前因車禍腳受傷，本來想去看醫生，太痛了只好先躺著休息；趕到的劉男哥哥說，弟弟不願與他住，他也沒辦法。\r\n\r\n經過的員警羅平山、郭文達看到劉男無法站立，雙腳腫了比平常2倍大，先請所內同事支援其他勤務，並通知附近農民醫院醫生過來了解。郭文達並幫忙推擔架、將劉男扶上車；羅平山說，東勢農民醫院只有幾步路距離，但劉男不能行走，必須請醫護人員診療後再移動比較妥當。');

-- --------------------------------------------------------

--
-- 表的結構 `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_name` varchar(64) DEFAULT NULL,
  `p_name` varchar(64) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  `zip` char(10) DEFAULT NULL,
  `phone` char(20) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 轉存資料表中的資料 `student`
--

INSERT INTO `student` (`id`, `s_name`, `p_name`, `address`, `city`, `state`, `zip`, `phone`, `email`) VALUES
(1, '葉12', '聰智', '內湖路一段91巷17號3樓', '台北', '內湖', '114', '0968821548', 'yehchge@gmail.com'),
(10, 'Peter Green', 'Len & Natalie Green', '480 West Broad Street', 'Eastbrook Canyon', 'PA', '19104', '(215) 900-2341', 'greenery@timewarner.dsl.com'),
(11, 'Jonah Ross', 'Robert & Linda Ross', '1293 Law Street', 'Eastbrook Village', 'PA', '19105', '(215) 907-1122', 'ross_boss@gmail.com'),
(12, 'Rebecca Dillon', 'Lainie and Howard Dillon', '12 Flamingo Drive', 'Westbrook Village', 'PA', '19103', '(215) 887-4313', 'ld_1975@yahoo.com'),
(13, 'Noah Singer', 'Carolyn & Peter Singer', '393 Green Lake Road, 8th Floor', 'Eastbrook Village', 'PA', '19105', '(215) 907-2344', 'candp@gmail.com'),
(14, 'Trevor Lee Logan', 'Steven Logan', '400 Green Lake Road, 9th Floor', 'Eastbrook Village', 'PA', '19105-6541', '(828) 299-9885', 'misterSAL@sbcglobal.net'),
(15, 'Audrey Christiansen', 'Lovey Christiansen', '1993 East Sunnyside Lane', 'Eastbrook Canyon', 'PA', '19104', '(215) 887-5545', 'lovey@christiansen-clan.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
         