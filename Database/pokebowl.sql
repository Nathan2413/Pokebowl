-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 04 août 2023 à 15:59
-- Version du serveur : 10.6.5-MariaDB
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pokebowl`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `adm_id` int(222) NOT NULL AUTO_INCREMENT,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `code` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`adm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`adm_id`, `username`, `password`, `email`, `code`, `date`) VALUES
(1, 'Manager', 'e10adc3949ba59abbe56e057f20f883e', 'admin@mail.com', '', '2023-01-31 11:11:57');

-- --------------------------------------------------------

--
-- Structure de la table `dishes`
--

DROP TABLE IF EXISTS `dishes`;
CREATE TABLE IF NOT EXISTS `dishes` (
  `d_id` int(222) NOT NULL AUTO_INCREMENT,
  `rs_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `slogan` varchar(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(222) NOT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `dishes`
--

INSERT INTO `dishes` (`d_id`, `rs_id`, `title`, `slogan`, `price`, `img`) VALUES
(18, 5, 'Poke au saumon ', 'Riz thaÃ¯,  Thon,  Avocat, Sauce de soja,  Graine de sÃ©same', '1000.00', '64646c27aaa5e.jpg'),
(19, 5, 'Poke au poulet ', 'Poulet, Sauce soja, Å’uf  Avocat, Citron(s) vert(s), Coriandre ', '1600.00', '64c682d9c50c7.jpg'),
(20, 5, 'Poke Bowl Vegan', 'Riz blanc, PastÃ¨que, Avocat, Concombre, Gingembre, Germes de soja, PurÃ©e de sÃ©same', '1500.00', '64b4f6dd7f660.png');

-- --------------------------------------------------------

--
-- Structure de la table `remark`
--

DROP TABLE IF EXISTS `remark`;
CREATE TABLE IF NOT EXISTS `remark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frm_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` mediumtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `remark`
--

INSERT INTO `remark` (`id`, `frm_id`, `status`, `remark`, `remarkDate`) VALUES
(17, 21, 'closed', 'Delivred', '2023-04-06 09:54:04'),
(18, 22, 'rejected', 'Z', '2023-05-01 07:21:14'),
(19, 22, 'in process', 'xfd', '2023-05-02 05:07:48'),
(20, 22, 'closed', 'rer', '2023-05-02 05:08:16'),
(21, 22, 'rejected', 't', '2023-05-02 05:08:40'),
(22, 18, 'in process', 'd', '2023-05-31 13:19:19'),
(23, 23, 'closed', 'Bien fait ', '2023-07-17 10:49:18'),
(24, 25, 'in process', 'Fini', '2023-07-17 10:49:51'),
(25, 25, 'rejected', 'FINI', '2023-07-17 10:50:07'),
(26, 45, 'closed', 'ok', '2023-07-31 17:59:47');

-- --------------------------------------------------------

--
-- Structure de la table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
CREATE TABLE IF NOT EXISTS `restaurant` (
  `rs_id` int(222) NOT NULL AUTO_INCREMENT,
  `c_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `url` varchar(222) NOT NULL,
  `o_hr` varchar(222) NOT NULL,
  `c_hr` varchar(222) NOT NULL,
  `o_days` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `image` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`rs_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `restaurant`
--

INSERT INTO `restaurant` (`rs_id`, `c_id`, `title`, `email`, `phone`, `url`, `o_hr`, `c_hr`, `o_days`, `address`, `image`, `date`) VALUES
(5, 5, 'Bowl resto ', 'bowl@gmail.com', '+23058213984', 'www.bowl.com', '8:00', '18:00', 'Lundi-Jeudi', '      Quatres Bornes       ', '64776169c8e89.jpg', '2023-05-31 15:02:01');

-- --------------------------------------------------------

--
-- Structure de la table `res_category`
--

DROP TABLE IF EXISTS `res_category`;
CREATE TABLE IF NOT EXISTS `res_category` (
  `c_id` int(222) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `res_category`
--

INSERT INTO `res_category` (`c_id`, `c_name`, `date`) VALUES
(5, 'HawaÃ¯', '2023-03-31 09:49:12');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(222) NOT NULL AUTO_INCREMENT,
  `username` varchar(222) NOT NULL,
  `f_name` varchar(222) NOT NULL,
  `l_name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `status` int(222) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`u_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `address`, `status`, `date`) VALUES
(9, 'Nathan', 'Nathan Carlinot', 'RANDRIAMIHAJA', 'ncrandriamihaja@student.udm.ac.mu', '+23058213972', 'b5be656a7060dd3525027d6763c33ca0', '40 Avenue Telfair', 1, '2023-07-30 06:15:14'),
(12, 'Mamaliza', 'Solofo', 'Mandimby', 'mandimby@gmail.com', '+261345982839', 'fcea920f7412b5da7be0cf42b8c93759', '36 Draper Avenue', 1, '2023-07-29 20:59:02'),
(13, 'Carlinot', 'Sonia', 'Randria', 'sonia@gmail.com', '+23058213993', 'b5be656a7060dd3525027d6763c33ca0', 'Avenue Neon', 1, '2023-07-30 15:54:45'),
(14, 'Nasandratra', 'Nasandratra', 'HANI', 'nasandratrahany@gmail.com', '+23054805511', 'e10adc3949ba59abbe56e057f20f883e', 'Vacoas Phoenix', 1, '2023-07-31 17:53:40');

-- --------------------------------------------------------

--
-- Structure de la table `users_orders`
--

DROP TABLE IF EXISTS `users_orders`;
CREATE TABLE IF NOT EXISTS `users_orders` (
  `o_id` int(222) NOT NULL AUTO_INCREMENT,
  `u_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `quantity` int(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(222) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`o_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users_orders`
--

INSERT INTO `users_orders` (`o_id`, `u_id`, `title`, `quantity`, `price`, `status`, `date`) VALUES
(18, 9, 'Lomi Salmon', 3, '450.00', 'in process', '2023-05-31 13:19:19'),
(23, 9, 'Lomi Salmon', 1, '550.00', 'closed', '2023-07-17 10:49:18'),
(24, 11, 'Poke au saumon ', 1, '1000.00', NULL, '2023-06-01 06:34:29'),
(25, 9, 'Poke au saumon ', 1, '1000.00', 'rejected', '2023-07-17 10:50:07'),
(26, 9, 'Poke au poulet ', 3, '1500.00', NULL, '2023-07-14 11:59:16'),
(45, 14, 'Poke au saumon ', 1, '1000.00', 'closed', '2023-07-31 17:59:47');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
