-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2019-05-27 21:31:09
-- 服务器版本： 10.1.40-MariaDB
-- PHP 版本： 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `projet_GLA`
--

-- --------------------------------------------------------

--
-- 表的结构 `CLIENT`
--

CREATE TABLE `CLIENT` (
  `idc` int(11) NOT NULL,
  `nom` varchar(10) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `ids` int(11) NOT NULL,
  `idtrajet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `CREERTRAJET`
--

CREATE TABLE `CREERTRAJET` (
  `idtrajet` int(11) NOT NULL,
  `idt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `POSITION`
--

CREATE TABLE `POSITION` (
  `idp` int(11) NOT NULL,
  `nomville` varchar(10) NOT NULL,
  `idc` int(11) NOT NULL,
  `nomroute` varchar(10) NOT NULL,
  `adr` varchar(40) NOT NULL,
  `type` enum('depart','destination','','') NOT NULL,
  `nom_defination` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `ROUTE`
--

CREATE TABLE `ROUTE` (
  `nom` varchar(10) NOT NULL,
  `type` enum('nationale','autoroute','departementale','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `ROUTE`
--

INSERT INTO `ROUTE` (`nom`, `type`) VALUES
('A1', 'autoroute'),
('A2', 'autoroute'),
('A3', 'autoroute'),
('D1', 'departementale'),
('D2', 'departementale'),
('D3', 'departementale'),
('D4', 'departementale'),
('N1', 'nationale');

-- --------------------------------------------------------

--
-- 表的结构 `SPECIALITE`
--

CREATE TABLE `SPECIALITE` (
  `ids` int(11) NOT NULL,
  `typeS` set('villepasse','villenonpasse','nonradar','ouitouristique','routetype') NOT NULL,
  `commentaire` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `TRAJET`
--

CREATE TABLE `TRAJET` (
  `idtrajet` int(11) NOT NULL,
  `distance` int(11) NOT NULL,
  `temps` int(11) NOT NULL,
  `radar` tinyint(1) NOT NULL,
  `idc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `TRONCON`
--

CREATE TABLE `TRONCON` (
  `idt` int(11) NOT NULL,
  `depart` varchar(10) NOT NULL,
  `destination` varchar(10) NOT NULL,
  `vitesse` int(10) NOT NULL,
  `touristique` enum('oui','non','','') NOT NULL,
  `radar` enum('oui','non','','') NOT NULL,
  `payant` enum('oui','non','','') NOT NULL,
  `longueur` int(11) NOT NULL,
  `nomroute` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `TRONCON`
--

INSERT INTO `TRONCON` (`idt`, `depart`, `destination`, `vitesse`, `touristique`, `radar`, `payant`, `longueur`, `nomroute`) VALUES
(1251, 'V5', 'V7', 30, 'non', 'non', 'non', 193, 'D3'),
(1252, 'V5', 'V2', 70, 'non', 'non', 'non', 24, 'D3'),
(1253, 'V7', 'V9', 70, 'non', 'non', 'non', 121, 'N1'),
(1254, 'V8', 'V9', 130, 'non', 'non', 'non', 474, 'A3'),
(1255, 'V1', 'V8', 90, 'non', 'non', 'non', 238, 'A3'),
(1256, 'V8', 'V1', 90, 'non', 'non', 'non', 265, 'A3'),
(1257, 'V5', 'V1', 110, 'oui', 'non', 'non', 571, 'A3'),
(1258, 'V4', 'V5', 110, 'non', 'non', 'non', 639, 'A2'),
(1259, 'V4', 'V6', 110, 'non', 'non', 'non', 302, 'A2'),
(1260, 'V4', 'V1', 130, 'non', 'non', 'non', 156, 'A2'),
(1261, 'V4', 'V0', 90, 'non', 'non', 'non', 98, 'A2'),
(1262, 'V6', 'V7', 50, 'non', 'non', 'non', 260, 'D2'),
(1263, 'V8', 'V6', 30, 'non', 'non', 'non', 160, 'D2'),
(1264, 'V2', 'V3', 30, 'non', 'non', 'non', 674, 'D1'),
(1265, 'V2', 'V5', 70, 'non', 'non', 'non', 51, 'D1'),
(1266, 'V0', 'V1', 90, 'non', 'non', 'non', 71, 'A1'),
(1267, 'V0', 'V4', 130, 'non', 'non', 'non', 159, 'A1'),
(1268, 'V0', 'V5', 90, 'non', 'non', 'non', 420, 'A1'),
(1269, 'V1', 'V0', 90, 'non', 'non', 'non', 36, 'A1'),
(1270, 'V0', 'V6', 50, 'non', 'non', 'non', 425, 'D4');

-- --------------------------------------------------------

--
-- 表的结构 `VILLE`
--

CREATE TABLE `VILLE` (
  `nom` varchar(10) NOT NULL,
  `type` enum('moyenne','petite','grande','') NOT NULL,
  `touristique` enum('oui','non','','') NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `VILLE`
--

INSERT INTO `VILLE` (`nom`, `type`, `touristique`, `latitude`, `longitude`) VALUES
('V0', 'moyenne', 'non', 26.0211, 28.1491),
('V1', 'petite', 'non', 26.0212, 28.4437),
('V2', 'moyenne', 'non', 28.1233, 28.2762),
('V3', 'petite', 'non', 26.1061, 25.9705),
('V4', 'grande', 'non', 25.6211, 28.9269),
('V5', 'grande', 'non', 28.1014, 28.0583),
('V6', 'petite', 'non', 27.7001, 28.8535),
('V7', 'petite', 'non', 28.5326, 28.6303),
('V8', 'grande', 'non', 26.8406, 28.648),
('V9', 'moyenne', 'non', 28.9558, 29.0115);

--
-- 转储表的索引
--

--
-- 表的索引 `CLIENT`
--
ALTER TABLE `CLIENT`
  ADD PRIMARY KEY (`idc`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idtrajet` (`idtrajet`),
  ADD KEY `ids` (`ids`);

--
-- 表的索引 `CREERTRAJET`
--
ALTER TABLE `CREERTRAJET`
  ADD KEY `idt` (`idt`),
  ADD KEY `idtrajet` (`idtrajet`);

--
-- 表的索引 `POSITION`
--
ALTER TABLE `POSITION`
  ADD PRIMARY KEY (`idp`),
  ADD KEY `idc` (`idc`),
  ADD KEY `nomville` (`nomville`),
  ADD KEY `nomroute` (`nomroute`);

--
-- 表的索引 `ROUTE`
--
ALTER TABLE `ROUTE`
  ADD PRIMARY KEY (`nom`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- 表的索引 `SPECIALITE`
--
ALTER TABLE `SPECIALITE`
  ADD PRIMARY KEY (`ids`),
  ADD UNIQUE KEY `typeS` (`typeS`);

--
-- 表的索引 `TRAJET`
--
ALTER TABLE `TRAJET`
  ADD PRIMARY KEY (`idtrajet`),
  ADD KEY `idc` (`idc`);

--
-- 表的索引 `TRONCON`
--
ALTER TABLE `TRONCON`
  ADD PRIMARY KEY (`idt`);

--
-- 表的索引 `VILLE`
--
ALTER TABLE `VILLE`
  ADD PRIMARY KEY (`nom`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `CLIENT`
--
ALTER TABLE `CLIENT`
  MODIFY `idc` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `POSITION`
--
ALTER TABLE `POSITION`
  MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `SPECIALITE`
--
ALTER TABLE `SPECIALITE`
  MODIFY `ids` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `TRAJET`
--
ALTER TABLE `TRAJET`
  MODIFY `idtrajet` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `TRONCON`
--
ALTER TABLE `TRONCON`
  MODIFY `idt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1271;

--
-- 限制导出的表
--

--
-- 限制表 `CLIENT`
--
ALTER TABLE `CLIENT`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`idtrajet`) REFERENCES `TRAJET` (`idtrajet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `client_ibfk_2` FOREIGN KEY (`ids`) REFERENCES `SPECIALITE` (`ids`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `CREERTRAJET`
--
ALTER TABLE `CREERTRAJET`
  ADD CONSTRAINT `creertrajet_ibfk_1` FOREIGN KEY (`idt`) REFERENCES `troncon` (`idt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `creertrajet_ibfk_2` FOREIGN KEY (`idtrajet`) REFERENCES `TRAJET` (`idtrajet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `POSITION`
--
ALTER TABLE `POSITION`
  ADD CONSTRAINT `position_ibfk_1` FOREIGN KEY (`idc`) REFERENCES `CLIENT` (`idc`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `position_ibfk_2` FOREIGN KEY (`nomville`) REFERENCES `VILLE` (`nom`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `position_ibfk_3` FOREIGN KEY (`nomroute`) REFERENCES `ROUTE` (`nom`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `TRAJET`
--
ALTER TABLE `TRAJET`
  ADD CONSTRAINT `trajet_ibfk_1` FOREIGN KEY (`idc`) REFERENCES `CLIENT` (`idc`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
