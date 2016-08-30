-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 30 авг 2016 в 22:01
-- Версия на сървъра: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Структура на таблица `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user` text NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `comments`
--

INSERT INTO `comments` (`id`, `user`, `message`, `date`) VALUES
(1, 'Krasimir Angela', 'zdrasti gotin topic', '2016-08-29'),
(2, 'Orgrim Doomhammer', 'niceeee', '2016-08-29');

-- --------------------------------------------------------

--
-- Структура на таблица `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL,
  `topic_name` varchar(9999) NOT NULL,
  `topic_content` mediumtext NOT NULL,
  `topic_creator` varchar(9999) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_name`, `topic_content`, `topic_creator`, `views`, `date`) VALUES
(1, 'my first topic', 'vdtrvhyhrhrdxthrtgergetrhrfngrtgbdfhrtbfrtdfbdrt', 'kisamekz', 0, '2016-08-26'),
(2, 'just test this out', 'ifjeufhseifhsleifshfyssfgsyefh', 'kisamekz', 0, '2016-08-29'),
(3, 'teeeeeeeeeeeeeeeeeeeest', 'oehaaaaaaaa rabotiiiiiiii', 'kisamekz', 0, '2016-08-29');

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(9999) NOT NULL,
  `email` varchar(9999) NOT NULL,
  `date` date NOT NULL,
  `replies` int(11) NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  `topics` int(11) NOT NULL DEFAULT '0',
  `profile_pic` varchar(999) NOT NULL DEFAULT 'images/my_picture.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `date`, `replies`, `score`, `topics`, `profile_pic`) VALUES
(7, 'kisamekz', '1caf28b98749eab23d52b14f0677c72eb1478d90', 'kisamekz@abv.bg', '2016-08-25', 0, 0, 0, 'images/12312254_1084479454916421_1948386289_n.jpg'),
(8, 'krasimir', '044700df0ce8e397c94019036420c64309993ff3', 'kisamekz@abv.bg', '2016-08-30', 0, 0, 0, 'images/my_picture.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
