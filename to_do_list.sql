-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 19, 2019 at 06:54 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `to_do_list`
--

-- --------------------------------------------------------

--
-- Table structure for table `things_to_do`
--

DROP TABLE IF EXISTS `things_to_do`;
CREATE TABLE `things_to_do` (
  `id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `description` varchar(3000) DEFAULT NULL,
  `created` date NOT NULL,
  `checkbox` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `things_to_do`
--

INSERT INTO `things_to_do` (`id`, `title`, `description`, `created`, `checkbox`) VALUES
(124, 'Nepaveikts darbs', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce purus nibh, faucibus vel consequat sed, molestie et leo. Duis hendrerit est non arcu blandit, sed suscipit tortor finibus. Mauris ipsum elit, placerat et dignissim nec, consequat nec ex. Suspendisse potenti. Quisque tincidunt justo id vestibulum hendrerit.', '2019-06-19', 0),
(125, 'Paveikts darbs', 'Nunc justo erat, convallis vel blandit non, dictum eget ipsum. Curabitur ac magna vitae lorem consectetur rhoncus. Donec in enim mollis, aliquam orci ut, varius dolor.', '2019-06-19', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `things_to_do`
--
ALTER TABLE `things_to_do`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `things_to_do`
--
ALTER TABLE `things_to_do`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
