-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: (redacted)
-- Generation Time: Jan 14, 2014 at 10:35 AM
-- Server version: 5.1.63-rel13.4
-- PHP Version: 5.3.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `(redacted)`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_posts`
--

CREATE TABLE IF NOT EXISTS `tbl_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL,
  `category` varchar(50) NOT NULL,
  `service` varchar(50) NOT NULL,
  `data` longtext NOT NULL,
  `attachment` mediumtext NOT NULL,
  `permalink` varchar(512) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `service_id` (`service_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=987544 ;

--
-- Dumping data for table `tbl_posts`
--

INSERT INTO `tbl_posts` (`id`, `service_id`, `datetime`, `category`, `service`, `data`, `attachment`, `permalink`) VALUES
(912344, '369993583018782720', '2013-08-21 03:25:19', 'retweet', 'twitter', '@sdw: Saw ''Fantasia'' (1940) and then looked at ''Despicable Me 2'' - can''t help but feel somewhere we took a very wrong turn. ?', 'http://www.youtube.com/watch?v=i6NCRfn_EsM', 'https://twitter.com/davehariri/status/369993583018782720'),
(912343, '370332624834686976', '2013-08-22 01:52:32', 'retweet', 'twitter', '@boltcity: Creative process: 1) This is going to be awesome 2) This is hard 3) This is terrible 4) I''m terrible 5) Hey, not bad 6) That ?', '', 'https://twitter.com/davehariri/status/370332624834686976'),
(912342, '372832868575109120', '2013-08-28 23:27:37', 'thought', 'twitter', '@richhickey Thanks for the talk on design. What was that Coltrane tune?', '', 'https://twitter.com/davehariri/status/372832868575109120'),
(912341, '372962912517644289', '2013-08-29 08:04:22', 'link', 'twitter', 'Updated  to support blank tiles (*) and tile count limits. SCR*BBLE8 = SCRABBLE', 'http://scrabtionary.com', 'https://twitter.com/davehariri/status/372962912517644289'),
(912340, '372963633447186432', '2013-08-29 08:07:14', 'retweet', 'twitter', '@daringfireball: Jeff Atwood-Designed CODE Mechanical Keyboard:', 'http://df4.us/lqq', 'https://twitter.com/davehariri/status/372963633447186432'),
(912339, '372963935198011393', '2013-08-29 08:08:26', 'thought', 'twitter', '@adam_greenough fixed this- also improved features... Check it out!', '', 'https://twitter.com/davehariri/status/372963935198011393'),
(912338, '372966326353936384', '2013-08-29 08:17:56', 'thought', 'twitter', '@_dte fixed a bunch of issues with it today including font size and added blank tiles and tile length limit... What is line length?', '', 'https://twitter.com/davehariri/status/372966326353936384'),
(912336, '374279062530703360', '2013-09-01 23:14:16', 'thought', 'twitter', '@TheRealLeeT Yes! Thank you so much Lee! Much appreciated!', '', 'https://twitter.com/davehariri/status/374279062530703360'),
(912337, '373291195188789248', '2013-08-30 05:48:51', 'link', 'twitter', 'I just published ?The little things?', 'https://medium.com/lessons-learned-1/3cd034d4ec84', 'https://twitter.com/davehariri/status/373291195188789248'),
(912335, '374827451592876032', '2013-09-03 11:33:23', 'thought', 'twitter', 'Hey @dribbble! How does one add a link to a description of a shot?', '', 'https://twitter.com/davehariri/status/374827451592876032');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
