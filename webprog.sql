-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2017 at 01:48 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webprog`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(3) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`) VALUES
INSERT INTO `countries` (`id`, `country_code`, `country_name`) VALUES
(1, 'AUT', 'Austrija'),
(2, 'BIH', 'Bosnia i Hercegovina'),
(3, 'HRV', 'Hrvatska'),
(4, 'DNK', 'Danska'),
(5, 'FRA', 'Francuska'),
(6, 'DEU', 'Njemačka'),
(7, 'ITA', 'Italija'),
(8, 'MKD', 'Makedonija'),
(9, 'NOR', 'Norveška'),
(10, 'POL', 'Poljska'),
(11, 'SRB', 'Srbija'),
(12, 'SVN', 'Slovenija'),
(13, 'ESP', 'Španjolska'),
(14, 'SWE', 'Švedska'),
(15, 'CHE', 'Švicarska'),
(16, 'TUR', 'Turska'),
(17, 'GBR', 'Ujedinjeno Kraljevstvo'),
(18, 'DRU', 'Drugo')

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `picture` varchar(255) NOT NULL,
  `archive` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `date`, `picture`, `archive`) VALUES
(1, 'ZBOG OVAKVIH STVARI MESSI JE NAJVEÄ†I Å to bi napravio Ronaldo u ovakvoj situaciji?', 'Golove su za Barcu postigli Luis Suarez (29., 47.), Paulinho (41., 75.), ali je utakmica protekla u znaku promaÅ¡aja Lea Messija. Messi je pogodio dvije vratnice, jednu gredu, imao je joÅ¡ tri Äiste prilike, a u 69. minuti mu je vratar Ruben Ramirez obranio i penal. Vratnicu su zatresli i Suarez i Jordi Alba, a Urugvajcu je u 45. minuti poniÅ¡ten regularni gol tako da je momÄad iz La Corune glatko mogla izgubiti i s dvocifrenim rezultatom.\r\n \r\nIako Messiju juÄer nije iÅ¡lo, premda nije uspijevao pogoditi mreÅ¾u Deportiva, joÅ¡ jednom, po tko zna koji put, pokazao je da je zaista jedan od najveÄ‡ih ikad. Igrala se 28. minuta utakmice na Camp Nou, golova joÅ¡ nije bilo kad je nakon jednog fantastiÄnog proigravanja Argentinac izaÅ¡ao sam pred vratara gostiju. Messi je mogao birati gdje Ä‡e gaÄ‘ati, takve Å¡anse on ne promaÅ¡uje, no odluÄio je loptu dodati Suarezu koji ju je samo gurnuo u praznu mreÅ¾u.', '2017-12-18 12:22:35', '1-93.jpg', 'N'),
(2, '&quot;EGIPATSKI MESSI&quot;, LEGENDA LIVERPOOLA Kako mu je to uspjelo za samo Äetiri mjeseca?', 'Golove su za Barcu postigli Luis Suarez (29., 47.), Paulinho (41., 75.), ali je utakmica protekla u znaku promaÅ¡aja Lea Messija. Messi je pogodio dvije vratnice, jednu gredu, imao je joÅ¡ tri Äiste prilike, a u 69. minuti mu je vratar Ruben Ramirez obranio i penal. Vratnicu su zatresli i Suarez i Jordi Alba, a Urugvajcu je u 45. minuti poniÅ¡ten regularni gol tako da je momÄad iz La Corune glatko mogla izgubiti i s dvocifrenim rezultatom.\r\n \r\nIako Messiju juÄer nije iÅ¡lo, premda nije uspijevao pogoditi mreÅ¾u Deportiva, joÅ¡ jednom, po tko zna koji put, pokazao je da je zaista jedan od najveÄ‡ih ikad. Igrala se 28. minuta utakmice na Camp Nou, golova joÅ¡ nije bilo kad je nakon jednog fantastiÄnog proigravanja Argentinac izaÅ¡ao sam pred vratara gostiju. Messi je mogao birati gdje Ä‡e gaÄ‘ati, takve Å¡anse on ne promaÅ¡uje, no odluÄio je loptu dodati Suarezu koji ju je samo gurnuo u praznu mreÅ¾u.', '2017-12-18 12:25:40', '2-9.jpg', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `country` char(2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `archive` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `username`, `password`, `country`, `date`, `archive`) VALUES
(16, 'Alen', 'Å imec', 'alen@tvz.hr', 'asimec1', '$2y$12$nXE3qlfYbWQIEVhtsA7kvOz9BQlAbc695VLfSA90eOcuhUPNaupiO', 'HR', '2017-12-18 10:51:12', 'N'),
(17, 'Alen', 'Å imec', 'asimec1@gmail.com', 'asimec2', '$2y$12$Y.dDgTLB6T898b.ScPzXw.eZeEQtXOhAyJgIgt3ZP7j3yDwJIHctW', 'HR', '2017-12-18 08:33:31', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
