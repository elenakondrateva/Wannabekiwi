-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 05, 2012 at 10:35 PM
-- Server version: 5.5.24
-- PHP Version: 5.3.10-1ubuntu3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wannabekiwi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `login` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `salt` varchar(50) NOT NULL,
  `role` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `login`, `password`, `salt`, `role`) VALUES
(1, 'Admin', 'admin', 'd0f7168d95a45514a03269168c48de3361d8b9fa', 'jkl45h4hr89y70e5y4u15h7m', '');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'work'),
(2, 'education'),
(3, 'immigration'),
(4, 'travel');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `text` varchar(1000) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `link` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `resource_id` tinyint(4) DEFAULT NULL,
  `type_id` tinyint(4) DEFAULT NULL,
  `is_favourite` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `text`, `author`, `date`, `link`, `date_added`, `resource_id`, `type_id`, `is_favourite`) VALUES
(2, 'Let&amp;rsquo;s talk sausages (again).', 'So it&amp;#8217;s fairly well known that the Avalon household likes it&amp;#8217;s sausages, and for many moons now we have been happily buying Black Ball Cumberland sausages and stuffing ourselves silly in time honored British Fry-up tradition. Only now, we seem to be hitting a snag at Moore Wilsons in Masterton because &amp;#8211; wait for it [...]\n\n\nRelated posts:Let&amp;#8217;s talk sausages :)\nThe issues of Christmas cookery.\nHappy Birthday QE2 &amp;#8211; lets all have a day off!\n', 'Avalon', '2012-08-04 21:10:28', 'http://www.avalonsguide.com/anab/2012/08/lets-talk-sausages-again/', '2012-08-04 21:10:28', NULL, NULL, '0'),
(3, 'Do power poles in NZ have targets on them?', 'It&amp;#8217;s a running joke in our house every time we have one of our frequent power cuts &amp;#8211; to wonder if yet again some moron has driven into a power pole. It seems to be the leading cause of power cuts in our area. It&amp;#8217;s freaky. And appalling though this sounds (I hang my head [...]\n\n\nRelated posts:The battle of the cheap power suppliers.\nThe Power of Networking; Social &amp;#038; Drinking\nThe Right Turn Rule dies in 2012 :)\n', 'Avalon', '2012-08-04 21:10:28', 'http://www.avalonsguide.com/anab/2012/08/do-power-poles-in-nz-have-targets-on-them/', '2012-08-04 21:10:28', NULL, NULL, '0'),
(5, 'When you just can&amp;rsquo;t get Citizenship in NZ', 'Getting Kiwi citizenship is a huge goal for many of us, particularly for people like us from the UK as we don&amp;#8217;t have to give up our home Citizenship to do so, and can have two passports! The requirements for getting NZ Citizenship are actually fairly simple for most of us: Requirements for a Grant [...]\n\n\nRelated posts:How to get citizenship in NZ fast &amp;#8211; cozy up to the MP&amp;#8217;s.\nApparently, there&amp;#8217;s nothing wrong with giving someone citizenship in a day&amp;#8230;\nThe Price for Citizenship? $10,000\n', 'Avalon', '2012-08-04 21:10:28', 'http://www.avalonsguide.com/anab/2012/07/when-you-just-cant-get-citizenship-in-nz/', '2012-08-04 21:10:28', NULL, NULL, '1'),
(6, 'WINZ staff sacked, INZ staff not so much.', 'WINZ (Work and Income) have sacked 3 staff (out of nine known) for inappropriately accessing and using people&amp;#8217;s files when they had no legitimate need to. I wonder if this kind of behavior is what makes WINZ such a Toxic Workplace? However, compared to the recent reports of similar behavior occurring at INZ, where so [...]\n\n\nRelated posts:INZ Staff getting sacked? Whatever next?\nWould you last 12 months as the Head of Winz?\nInvestigation into Staff at INZ continue :)\n', 'Avalon', '2012-08-04 21:10:28', 'http://www.avalonsguide.com/anab/2012/07/winz-staff-sacked-inz-staff-not-so-much/', '2012-08-04 21:10:28', NULL, NULL, '0'),
(7, 'Feeding the troops is expensive lol', 'I just took a quick look at the online credit card statements at ASB. Although we don&amp;#8217;t have &amp;#8220;Business Credit Cards&amp;#8221; as such ( the fees are much higher than for personal cards &amp;#8211; there&amp;#8217;s a shock), we do have multiple cards: one for the property investing, one for Hubby&amp;#8217;s contracting, and a personal card. [...]\n\n\nRelated posts:What does your credit card bill say about you?\nWhat my credit card says about me.\nI&amp;#8217;m a credit card tart and proud of it!\n', 'Avalon', '2012-08-04 21:10:28', 'http://www.avalonsguide.com/anab/2012/07/feeding-the-troops-is-expensive-lol/', '2012-08-04 21:10:28', NULL, NULL, '0'),
(8, 'Have I mentioned lately that you should check Bank Statements?', 'Well, probably. But just in case people think I really am just making a fuss about nothing &amp;#8211; I have two false charges on my last 2 months Credit Card Statements &amp;#8211; totaling $172.99. (43 Coffees!) The first was iTunes. I bought a copy of The National&amp;#8217;s High Violet. Based on the fact that they [...]\n\n\nRelated posts:I really love Amazon.\nWhy the hell should I pay other people&amp;#8217;s bank fees???\nGetting my money back from Illamasqua &amp;#8211; bemused.\n', 'Avalon', '2012-08-04 21:10:28', 'http://www.avalonsguide.com/anab/2012/07/have-i-mentioned-lately-that-you-should-check-bank-statements/', '2012-08-04 21:10:28', NULL, NULL, '0'),
(9, 'Next coming to New Zealand', 'There was an article yesterday saying that Next &amp;#8211; a UK fashion retailer &amp;#8211; would now be available in New Zealand via a Mail Order company &amp;#8211; EziBuy. Great &amp;#8211; you can order via EziBuy and your order will arrive from the UK. If you need to return the item, you return to EziBuy. Apart [...]\n\n\nRelated posts:Waitrose coming to New Zealand (sort of).\nMitre 10 Mega coming to Masterton.\nAttempting to use the Whitcoulls &amp;#8220;sale&amp;#8221;\n', 'Avalon', '2012-08-04 21:10:28', 'http://www.avalonsguide.com/anab/2012/07/next-coming-to-new-zealand/', '2012-08-04 21:10:28', NULL, NULL, '0'),
(10, 'Would you last 12 months as the Head of Winz?', 'mI never much of a fan of NZ Media reporting- it usually being full of holes and empty of useful facts. So I wasn&amp;#8217;t going to blog about the new UK head of WINZ (Work &amp;#38; Income NZ) leaving after a few months, but as is often the case, the comments at the Dom Post [...]\n\n\nRelated posts:WINZ staff sacked, INZ staff not so much.\nFormer Head of INZ gets a measly $10,000 fine.\nINZ needs to pull it&amp;#8217;s head in and stop being petty.\n', 'Avalon', '2012-08-04 21:10:28', 'http://www.avalonsguide.com/anab/2012/07/would-you-last-12-months-as-the-head-of-winz/', '2012-08-04 21:10:28', NULL, NULL, '0'),
(11, 'The Supper Club', 'The Supper Club on Pitt Street and Beresford Square Click image to enlarge To enjoy the work of other Black &amp;#38; White enthusiasts, Please visit The Weekend in Black and White!', 'Lachezar', '2012-08-04 21:10:31', 'http://www.aucklanddailyphoto.com/2012/08/03/the-supper-club/', '2012-08-04 21:10:31', NULL, NULL, '0'),
(12, 'Pizza numbers&amp;hellip;', 'Some good Pizza numbers&amp;#8230; I was travelling on bus No 605 Click image to enlarge Today is Theme Day for the Daily Photo community: Numbers Click here to view more &amp;#8220;Numbers&amp;#8221; photographs at CDPB Theme Day.', 'Lachezar', '2012-08-04 21:10:31', 'http://www.aucklanddailyphoto.com/2012/08/01/pizza-numbers/', '2012-08-04 21:10:31', NULL, NULL, '0'),
(13, 'Watching the container ship', 'Watching the container ship ', 'Lachezar', '2012-08-04 21:10:31', 'http://www.aucklanddailyphoto.com/2012/07/31/watching-the-container-ship/', '2012-08-04 21:10:31', NULL, NULL, '0'),
(14, 'Surfing acrobatics', '<img width="720" height="267" alt="Surfing acrobatics" src="http://www.aucklanddailyphoto.com/wp-content/uploads/2012/07/a29072012-2078-1.jpg" title="Surfing acrobatics"/><br />\r\nA surfer rides a wave at Muriwai Beach', 'Lachezar', '2012-08-04 21:10:31', 'http://www.aucklanddailyphoto.com/2012/07/29/surfing-acrobatics/', '2012-08-04 21:10:31', NULL, NULL, '1'),
(15, 'Restoration', 'Restoration work in Christchurch To enjoy the work of other Black &amp;#38; White enthusiasts, Please visit The Weekend in Black and White!', 'Lachezar', '2012-08-04 21:10:31', 'http://www.aucklanddailyphoto.com/2012/07/28/restoration/', '2012-08-04 21:10:31', NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `post_types`
--

CREATE TABLE IF NOT EXISTS `post_types` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `post_types`
--

INSERT INTO `post_types` (`id`, `name`) VALUES
(1, 'blogs'),
(2, 'forums'),
(3, 'photo'),
(4, 'video');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) DEFAULT NULL,
  `category_id` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `link`, `category_id`) VALUES
(1, 'http://www.avalonsguide.com/', 1),
(2, 'http://www.aucklanddailyphoto.com/', NULL),
(3, 'http://move2nz.wordpress.com/', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
