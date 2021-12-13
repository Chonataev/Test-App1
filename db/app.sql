-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 13, 2021 at 11:10 AM
-- Server version: 10.3.22-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `DOB` date NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `password` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `firstname`, `lastname`, `role`, `DOB`, `gender`, `created_at`, `password`) VALUES
(3, 'Admin@gmail.com', 'Admin', 'sadas', 1, '1999-01-01', 'male', '2021-12-11 19:29:13', '$2y$10$H7o18fMqq5KG.1kcIm8Ld.PZKrtUqVeQ6vLqWzDkLaLv/F73KZRtO'),
(6, 'Jhon@gmail.com', 'Jhon', 'Smith', 0, '2000-12-12', 'male', '2021-12-12 19:45:05', '$2y$10$0aEZ0TR38A51z3lQddvMp.2jEJfu45l5ha9tqWKoGGraXnEILNWCO'),
(11, '1712.01014@manas.edu.kg', 'Элмурат', 'Чонатаев', 0, '2021-12-13', 'mele', '2021-12-12 22:42:56', '$2y$10$D9g03GpkUBh6waYu0QfHk.lrzToBOl2bAIS8NEqvgiw4a8aUEoIg2'),
(12, '1812.01030@manas.edu.kg', 'Акинай01', 'Маликова', 0, '2000-06-17', 'femele', '2021-12-13 02:21:44', '$2y$10$DEw0wY9kJGyjd5OVB53TR.qPfW5.T4H.BzL0oyVEM34W7aPlLCh4i');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
