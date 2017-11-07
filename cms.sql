-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 07. Nov 2017 um 16:51
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
  `modified` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `accounts`
--

INSERT INTO `accounts` (`id`, `title`, `description`, `amount`, `balance`, `created`, `modified`, `user_id`) VALUES
(3, 'Allied Bank Limited', 'Saving Account', 15000, 197, '2017-10-25 11:43:03', '2017-11-07 15:42:03', 1),
(4, 'Habib Bank ltd', 'Salary Account', 50000, 430, '2017-10-25 11:43:44', '2017-11-07 16:03:25', 1);

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
  `order` int(11) DEFAULT '0',
  `modified` datetime NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`id`, `title`, `created`, `order`, `modified`, `parent_id`) VALUES
(48, 'Car', '2017-10-31 13:02:07', 1, '2017-10-31 13:02:07', 0),
(49, 'Petrol', '2017-10-31 13:02:14', 2, '2017-10-31 13:02:14', 48),
(50, 'Bills', '2017-10-31 13:02:28', 10, '2017-10-31 13:02:28', 0),
(51, 'Electricity Bill', '2017-10-31 13:02:35', 11, '2017-10-31 13:02:35', 50),
(52, 'Water', '2017-10-31 13:02:47', 12, '2017-10-31 13:02:47', 50),
(53, 'Parking', '2017-11-02 08:53:51', 3, '2017-11-02 08:53:51', 48),
(54, 'Health & Care', '2017-11-07 14:45:45', 7, '2017-11-07 14:45:45', 0),
(55, 'Cosmetics', '2017-11-07 14:46:16', 8, '2017-11-07 14:46:16', 54),
(56, 'Life & Health Insurance', '2017-11-07 14:47:47', 9, '2017-11-07 14:48:56', 54),
(57, 'Food & Dining', '2017-11-07 16:01:01', 4, '2017-11-07 16:01:01', 0),
(58, 'Groceries', '2017-11-07 16:01:28', 5, '2017-11-07 16:01:28', 57),
(59, 'Restaurant', '2017-11-07 16:01:48', 6, '2017-11-07 16:01:48', 57);

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
  `modified` datetime NOT NULL,
  `account_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `expenses`
--

INSERT INTO `expenses` (`id`, `title`, `date`, `amount`, `created`, `modified`, `account_id`, `user_id`) VALUES
(50, 'September Petrol', '2017-09-01', '50', '2017-10-31 13:03:37', '2017-10-31 13:03:37', 3, 1),
(51, 'October Petrol', '2017-10-31', '10', '2017-10-31 13:03:57', '2017-10-31 13:03:57', 3, 1),
(52, 'Sep bill', '2017-09-01', '50', '2017-10-31 13:04:22', '2017-10-31 13:04:22', 3, 1),
(53, 'Water October bill', '2017-10-31', '50', '2017-10-31 13:04:36', '2017-10-31 13:04:36', 3, 1),
(54, 'Jakomini Car Parking Ticket', '2017-10-25', '5', '2017-11-02 08:54:32', '2017-11-02 08:54:32', 3, 1),
(55, 'Siesberg Car Parking Ticket', '2017-10-12', '3', '2017-11-02 08:55:54', '2017-11-02 08:55:54', 3, 1),
(56, 'November bill', '2017-11-02', '20', '2017-11-02 16:03:38', '2017-11-02 16:03:38', 3, 1),
(57, 'Water November Bill', '2017-11-02', '10', '2017-11-02 16:06:31', '2017-11-02 16:06:31', 3, 1),
(58, 'Petrol November', '2017-11-02', '10', '2017-11-02 16:34:26', '2017-11-02 16:34:26', 3, 1),
(59, 'Face Wash', '2017-11-07', '25', '2017-11-07 14:46:54', '2017-11-07 14:46:54', 3, 1),
(60, 'November Insurance', '2017-11-07', '50', '2017-11-07 14:49:29', '2017-11-07 14:49:29', 3, 1),
(61, 'Shampo', '2017-11-07', '10', '2017-11-07 14:57:22', '2017-11-07 15:42:03', 3, 1),
(62, 'November Grocery', '2017-11-07', '20', '2017-11-07 16:02:44', '2017-11-07 16:02:44', 4, 1),
(63, 'Habibi Restaurant', '2017-11-07', '50', '2017-11-07 16:03:25', '2017-11-07 16:03:25', 4, 1);

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
(20, 50, 48, 49),
(21, 51, 48, 49),
(22, 52, 50, 51),
(23, 53, 50, 52),
(24, 54, 48, 53),
(25, 55, 48, 53),
(26, 56, 50, 51),
(27, 57, 50, 52),
(28, 58, 48, 49),
(29, 59, 54, 55),
(30, 60, 54, 56),
(31, 61, 54, 55),
(32, 62, 57, 58),
(33, 63, 57, 59);

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
-- Tabellenstruktur für Tabelle `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `period` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `reports`
--

INSERT INTO `reports` (`id`, `period`) VALUES
(3, 'Current Month'),
(4, 'Last Month'),
(5, 'Last 6 Month'),
(6, 'Last 12 Month'),
(7, 'Current Year'),
(8, 'Last Year');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `name` varchar(120) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `role_id`) VALUES
(1, 'admin@gmail.com', '110D0E326BF837EF65906232963ECE4FFB343AA03A56A53541D0CA1AE3EE1FEDD91762F9AB0D40584FAE149F5B6EA646901FFE11567F9AB65DE41D5F249F1B73', 'Arslan Khurshid', 1),
(3, 'nauman@gmail.com', '2a46cefab56d4f2516b2e85e1c3d6d57f2d075cbeae203f76d1a004646afeecd002e0da9f3ba10910057db024589aabd8ef4868f668b8fda6758d771c0550aef', 'Nauman Khurshid', 1),
(4, 'test@gmail.com', 'e6c5b7619920b75656083ba4e5e589ba65b284d9e3db1af927c3706ba8f14a49821b3095a0ed837d50998d0172fd1869286e64cda0af1ade312a35ce88fccd70', 'Test User', 1),
(5, 'test2@gmail.com', '2a46cefab56d4f2516b2e85e1c3d6d57f2d075cbeae203f76d1a004646afeecd002e0da9f3ba10910057db024589aabd8ef4868f668b8fda6758d771c0550aef', 'Test User2', 1),
(6, 'm.arslan.khurshid@gmail.com', '8ba04fec45ea88277647894710b7e2db0b68537b219565590ac85017e0fdccecb56c9da97fd5999c8a6190d4d430f9e77c156f736d288588d7c3d1f4402aa548', 'Malik Arslan Khurshid', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_transfer_amount`
--

CREATE TABLE `user_transfer_amount` (
  `id` int(11) NOT NULL,
  `from_bank` int(11) NOT NULL,
  `to_bank` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user_transfer_amount`
--

INSERT INTO `user_transfer_amount` (`id`, `from_bank`, `to_bank`, `amount`, `reference`, `created`, `modified`) VALUES
(32, 4, 3, 200, 'low balance', '2017-10-30 07:58:32', '2017-10-30 07:58:32'),
(33, 4, 3, 50, '50', '2017-10-30 09:04:39', '2017-10-30 09:04:39');

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
-- Indizes für die Tabelle `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user_transfer_amount`
--
ALTER TABLE `user_transfer_amount`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT für Tabelle `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT für Tabelle `expense_has_categories`
--
ALTER TABLE `expense_has_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT für Tabelle `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT für Tabelle `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT für Tabelle `user_transfer_amount`
--
ALTER TABLE `user_transfer_amount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
