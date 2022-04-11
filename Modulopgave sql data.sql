-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 11. 04 2022 kl. 12:52:04
-- Serverversion: 10.4.21-MariaDB
-- PHP-version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `modulopgave`;
USE `modulopgave`;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `modulopgave`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `cleaning`
--

CREATE TABLE `cleaning` (
  `id` int(11) NOT NULL,
  `clean` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `comment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Data dump for tabellen `cleaning`
--

INSERT INTO `cleaning` (`id`, `clean`, `address`, `comment`) VALUES
(11, 'Hovedrengøring', 'Edisonsvej 2, 5000 Odense C', 'Ingen'),
(12, 'Støvsugning', 'Edisonsvej 2, 5000 Odense C', 'Ingen'),
(13, 'Rengøring af vinduer', 'Edisonsvej 2, 5000 Odense C', 'Hurtigtst muligt'),
(14, 'Gulvvask', 'Edisonsvej 2, 5000 Odense C', 'Ingen'),
(15, 'Gulvvask', 'Edisonsvej 2, 5000 Odense C', 'Ingen'),
(16, 'Støvsugning', 'Edisonsvej 2, 5000 Odense C', 'Ingen'),
(17, 'Gulvvask', 'Edisonsvej 2, 5000 Odense C', 'Ingen'),
(18, 'Rengøring af vinduer', 'Edisonsvej 2, 5000 Odense C', 'Hurtigtst muligt'),
(19, 'Hovedrengøring', 'Edisonsvej 2, 5000 Odense C', 'Ingen'),
(20, 'Støvsugning', 'Edisonsvej 2, 5000 Odense C', 'Ingen');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'Noel', 'lhELm30V9wJ', '2022-01-27 15:56:14'),
(2, 'Clareta', 'VjlRXZ', '2022-03-19 11:39:09'),
(3, 'Mallory', 'fXXN6xf3', '2022-03-21 19:14:17'),
(4, 'Griselda', 'vA5SzjLvLZ', '2021-09-10 01:36:09'),
(5, 'Melamie', 'Trn8tUwMT', '2021-10-31 16:39:24'),
(6, 'Noami', 'VDQBebos6', '2021-05-04 15:59:17'),
(7, 'Valerie', 'I2fQthHsngGT', '2021-07-24 13:17:46'),
(8, 'Dimitri', 'BNdyRp0aa', '2021-05-12 03:04:39'),
(9, 'Clement', 'BiNy0gW3P6', '2021-07-31 06:45:30'),
(10, 'Frasco', 'KV8e2mIw', '2021-05-24 03:59:19');

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `cleaning`
--
ALTER TABLE `cleaning`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `cleaning`
--
ALTER TABLE `cleaning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Tilføj AUTO_INCREMENT i tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
