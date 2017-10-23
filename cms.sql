-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 23. Okt 2017 um 17:55
-- Server-Version: 10.1.19-MariaDB
-- PHP-Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cms`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `accounts`
--

INSERT INTO `accounts` (`id`, `title`, `description`, `amount`, `balance`, `created`, `modified`) VALUES
(1, 'IK', 'Saving Accounts', 50000, 20000, '2017-10-19 00:00:00', '2017-10-19 17:00:55'),
(2, 'New Account', 'Test Acc', 250000, 25000, '2017-10-19 16:59:47', '2017-10-19 16:59:47');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `articles`
--

CREATE TABLE `articles` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `pub_date` date NOT NULL,
  `body` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `pub_date`, `body`, `created`, `modified`) VALUES
(4, 'The website is live', 'The-website-is-live', '2017-10-20', '<p>&lt;p&gt;The website is live&lt;/p&gt;Yes!!!</p>', '2017-10-16 16:36:43', '2017-10-16 16:38:07');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `order` int(11) DEFAULT NULL,
  `modified` datetime NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`id`, `title`, `created`, `order`, `modified`, `parent_id`) VALUES
(25, 'Tea Boy', '2017-10-19 11:15:35', 0, '2017-10-23 11:28:12', 28),
(26, 'newCAT', '2017-10-19 11:16:30', 3, '2017-10-19 11:16:30', 28),
(27, 'Bill', '2017-10-19 11:17:20', 4, '2017-10-20 10:49:19', 28),
(28, 'Home Expense', '2017-10-19 11:18:03', 1, '2017-10-23 08:56:55', 0),
(29, 'Online shopping', '2017-10-19 12:16:54', 5, '2017-10-19 12:16:54', 0),
(32, 'Food & Living', '2017-10-20 10:34:51', 2, '2017-10-20 10:44:48', 28),
(33, 'Car', '2017-10-23 10:44:55', NULL, '2017-10-23 10:44:55', 0),
(34, 'Parking Fee', '2017-10-23 10:45:21', NULL, '2017-10-23 11:28:18', 33),
(35, 'Petrol', '2017-10-23 10:45:32', NULL, '2017-10-23 10:45:32', 33);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `amount` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `expenses`
--

INSERT INTO `expenses` (`id`, `title`, `date`, `amount`, `created`, `modified`) VALUES
(32, 'Office expense', '2017-10-19', '236', '2017-10-19 11:15:35', '2017-10-20 10:40:30'),
(33, 'Electricity Bill', '2017-10-19', '5000', '2017-10-19 11:17:20', '2017-10-19 11:18:28'),
(34, 'Milk', '2017-10-19', '125', '2017-10-19 11:18:03', '2017-10-19 11:18:03'),
(35, 'Road Tax', '2017-10-23', '125', '2017-10-23 11:37:26', '2017-10-23 11:37:26'),
(36, 'Test Page', '2017-10-23', '22', '2017-10-23 13:41:16', '2017-10-23 13:41:16'),
(37, 'Yearly MOT', '2017-10-23', '265', '2017-10-23 13:47:21', '2017-10-23 13:47:21'),
(38, 'ABC Petrol Pump', '2017-10-23', '45', '2017-10-23 13:51:03', '2017-10-23 17:16:37');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `expense_has_categories`
--

CREATE TABLE `expense_has_categories` (
  `id` int(11) NOT NULL,
  `expense_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `expense_has_categories`
--

INSERT INTO `expense_has_categories` (`id`, `expense_id`, `cat_id`, `sub_cat_id`) VALUES
(2, 32, 25, 0),
(3, 33, 27, 0),
(4, 34, 28, 0),
(5, 35, 33, 34),
(6, 36, 0, 0),
(7, 37, 33, 34),
(8, 38, 33, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pages`
--

CREATE TABLE `pages` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `order` varchar(11) DEFAULT NULL,
  `body` text NOT NULL,
  `parent_id` int(11) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `order`, `body`, `parent_id`) VALUES
(1, 'Homepage', 'home', '6', '<p>&lt;p&gt;&amp;lt;p&amp;gt;&amp;amp;lt;p&amp;amp;gt;&amp;amp;amp;lt;p&amp;amp;amp;gt;&amp;amp;amp;amp;lt;p&amp;amp;amp;amp;gt;&amp;amp;amp;amp;amp;lt;p&amp;amp;amp;amp;amp;gt;Home&amp;amp;amp;amp;amp;lt;/p&amp;amp;amp;amp;amp;gt;&amp;amp;amp;amp;lt;/p&amp;amp;amp;amp;gt;&amp;amp;amp;lt;/p&amp;amp;amp;gt;&amp;amp;lt;/p&amp;amp;gt;&amp;lt;/p&amp;gt;&lt;/p&gt;</p>', 6),
(3, 'Contact', 'contact', '2', '<p>&lt;p&gt;&amp;lt;p&amp;gt;contact&amp;lt;/p&amp;gt;&lt;/p&gt;</p>', 7),
(4, 'About', 'about', '3', '<p>f</p>', 0),
(5, 'Test Page', 'testpage', '4', '<p>&lt;p&gt;&amp;lt;p&amp;gt;tet&amp;lt;/p&amp;gt;&lt;/p&gt;</p>', 4),
(6, 'OneMore', 'onemore', '5', '<p>&lt;p&gt;d&lt;/p&gt;</p>', 0),
(7, 'TwoMore', 'twomore', '1', '<p>&lt;p&gt;&amp;lt;p&amp;gt;&amp;amp;lt;p&amp;amp;gt;5&amp;amp;lt;/p&amp;amp;gt;&amp;lt;/p&amp;gt;&lt;/p&gt;</p>', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `name` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`) VALUES
(1, 'admin@gmail.com', '110D0E326BF837EF65906232963ECE4FFB343AA03A56A53541D0CA1AE3EE1FEDD91762F9AB0D40584FAE149F5B6EA646901FFE11567F9AB65DE41D5F249F1B73', 'Arslan Khurshid'),
(3, 'nauman@gmail.com', '2a46cefab56d4f2516b2e85e1c3d6d57f2d075cbeae203f76d1a004646afeecd002e0da9f3ba10910057db024589aabd8ef4868f668b8fda6758d771c0550aef', 'Nauman Khurshid'),
(4, 'test@gmail.com', 'e6c5b7619920b75656083ba4e5e589ba65b284d9e3db1af927c3706ba8f14a49821b3095a0ed837d50998d0172fd1869286e64cda0af1ade312a35ce88fccd70', 'Test User'),
(5, 'test2@gmail.com', '2a46cefab56d4f2516b2e85e1c3d6d57f2d075cbeae203f76d1a004646afeecd002e0da9f3ba10910057db024589aabd8ef4868f668b8fda6758d771c0550aef', 'Test User2'),
(6, 'm.arslan.khurshid@gmail.com', '8ba04fec45ea88277647894710b7e2db0b68537b219565590ac85017e0fdccecb56c9da97fd5999c8a6190d4d430f9e77c156f736d288588d7c3d1f4402aa548', 'Malik Arslan Khurshid');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indizes für die Tabelle `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `expense_has_categories`
--
ALTER TABLE `expense_has_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT für Tabelle `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT für Tabelle `expense_has_categories`
--
ALTER TABLE `expense_has_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT für Tabelle `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
