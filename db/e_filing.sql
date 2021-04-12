-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 12, 2021 at 06:10 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_filing`
--

-- --------------------------------------------------------

--
-- Table structure for table `changeshifts`
--

CREATE TABLE `changeshifts` (
  `id` int(11) NOT NULL,
  `empcode` varchar(10) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `from_shift` varchar(10) NOT NULL,
  `to_shift` varchar(10) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `reliever` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `deptcode` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`deptcode`, `name`, `status`) VALUES
('100', 'FINANCE', 'ACTIVE'),
('110', 'GENERAL ACCOUNTING', 'ACTIVE'),
('120', 'COST ACCOUNTING', 'ACTIVE'),
('130', 'TREASURY', 'ACTIVE'),
('140', 'CREDIT & COLLECTION', 'ACTIVE'),
('150', 'MIS', 'ACTIVE'),
('200', 'SALES & MARKETING', 'ACTIVE'),
('210', 'SALES', 'ACTIVE'),
('211', 'SALES\\VisMin', 'ACTIVE'),
('220', 'MARKETING', 'ACTIVE'),
('230', 'SHIPPING', 'ACTIVE'),
('300', 'MANUFACTURING', 'ACTIVE'),
('310', 'JOBCON', 'ACTIVE'),
('320', 'PPMC', 'ACTIVE'),
('321', 'PRODUCT PLANNING & CONTROL', 'ACTIVE'),
('322', 'MATERIAL PLANNING & CONTROL', 'ACTIVE'),
('330', 'PED', 'ACTIVE'),
('331', 'PROCESS ENGINEERING', 'ACTIVE'),
('332', 'TOOL AND DIE', 'ACTIVE'),
('340', 'QAD', 'ACTIVE'),
('341', 'QUALITY ASSURANCE', 'ACTIVE'),
('342', 'SCRAP MONITORING', 'ACTIVE'),
('350', 'PEMD', 'ACTIVE'),
('351', 'PEMD-MECHANICAL', 'ACTIVE'),
('352', 'PEMD-ELECTRICAL', 'ACTIVE'),
('353', 'PEMD-BGM/STOCKROOM', 'ACTIVE'),
('400', 'PURCHASING', 'ACTIVE'),
('410', 'SRAP HANDLING', 'ACTIVE'),
('500', 'HRDD', 'ACTIVE'),
('501', 'GENRAL SERVICES/ PERSONNEL', 'ACTIVE'),
('600', 'AUDIT', 'ACTIVE'),
('700', 'ISO', 'ACTIVE'),
('800', 'EXECUTIVE', 'ACTIVE'),
('801', 'EXECUTIVE SUPPORT', 'ACTIVE'),
('ACC', 'Accounting', 'ACTIVE'),
('MKTG', 'Marketing', 'ACTIVE'),
('PROD', 'Production', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `empcode` varchar(10) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `lname` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `deptcode` varchar(10) NOT NULL,
  `supervisor` bit(1) DEFAULT NULL,
  `depthead` bit(1) DEFAULT NULL,
  `secthead` bit(1) DEFAULT NULL,
  `divhead` bit(1) DEFAULT NULL,
  `is_hr` bit(1) DEFAULT NULL,
  `is_payroll` bit(1) DEFAULT NULL,
  `is_audit` bit(1) DEFAULT NULL,
  `hiredate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`empcode`, `password`, `lname`, `fname`, `mname`, `deptcode`, `supervisor`, `depthead`, `secthead`, `divhead`, `is_hr`, `is_payroll`, `is_audit`, `hiredate`) VALUES
('000564', '$2y$10$9TPPMeXM2AFXnA.EBKaz3Oz6JXyJH4JnH7HhpCf/8eNMWpjPN5kAq', 'MEDES', 'ALFREDO', 'PERSIA', '300', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1964-11-17'),
('003286', '$2y$10$UNwk1VvZr0ObFFiO1WL4IO1btd.VzlQl/oJrR9Z.dzvsT3cFtgr5y', 'JAO', 'DENIS', 'JANEO', '332', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1986-07-08'),
('003486', '$2y$10$S0AZg.fatSouOPejsAd3neFeSOb05vWZCMevlA0KF58LKRGW.Piwu', 'COMIA', 'SHEBA', 'SALUDES', '600', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1986-12-11'),
('003987', '$2y$10$oF5YE47UjbYYcvPa9GqAwOKoqDw4SoG4SbSMWd/0MWOce8.H4iola', 'POON', 'JOEL RAIDIS', 'URIARTE', '320', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1987-02-03'),
('004187', '$2y$10$9psGGEFAIpFKwdoBxVbd..EXfTaXBZ/KR/TrahQRpUccmIpL.8M/6', 'PLAZA', 'ALFREDO', 'COLETO', '350', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1987-02-17'),
('004387', '$2y$10$p4VjvNlbMRA81IbmEfY0s.A2rC4opHeuPjiALJ8CFmyCj//3tx2vC', 'REYES', 'MARIE MAGDALENE', 'MONDIGUING', '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1987-03-23'),
('006188', '$2y$10$yeHhLdnV/.tzhf7vJw0u5O5gEwV.NBGSmhFc83i1HiRTctbHUo0l.', 'ESTEBAL', 'BENJAMIN', 'MORALES', '341', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1988-05-17'),
('006888', '$2y$10$5i93wSIKm3yGtbDhhGNNfORWqtCpsTim3Epi79F6Hfp.lg0zNBloO', 'ROSALES', 'APOLINARIO', 'REY', '322', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1988-08-01'),
('007789', '$2y$10$RKjWa9lpJfXQuwQcysVG3.nbA04Vnx3aqWRSSnhRKVUzrMKjoUHrG', 'CRUZ', 'ROSALINDA', 'GALVEZ', '321', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1989-04-24'),
('008589', '$2y$10$QTp5BENdOgZD22Jyqn1.VO7Y0giFDyOdVlEsMAaI1V2j.oxb2xjDO', 'CASTRO', 'NAPOLEON', 'PAGTAMA', '340', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1989-05-30'),
('021596', '$2y$10$o0Yu9aq.Mx6U7T/AT7VqPupu/Q/cdoJYDtLWjSGKMd5CY6bxeKXvK', 'BARLAO', 'VICTOR', 'LIMUN', '332', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1996-05-10'),
('022997', '$2y$10$KIlxvZ6W69Zuolw6DPjHA.aOMflI/lmL9Owh37HuWBKvSS9qFgmpG', 'CABACANG', 'HAIDEE', 'NAYA', '130', b'0', b'0', b'1', b'0', NULL, NULL, NULL, '1997-07-15'),
('023097', '$2y$10$/kxVvwOKzTW8cGvGAlUGY.7gjL1iq3kQIy1s5AmuaFpvg1zPybQbC', 'REMPILLO', 'SEAN', 'RAVAGO', '210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1997-08-16'),
('023497', '$2y$10$YRWXGA5kj7qmlfKKwkVywe8hHH29Rr7I47MMdryzzN8FK7eoQ80QS', 'ESGUERRA', 'RAYMOND', 'VEDUA', '340', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1997-12-01'),
('023598', '$2y$10$IYYwzxrcpUT57/zxzFbWhuhp4O8Zk1oL1frNNEt3i6..3X0d6CEeu', 'GRANADEROS', 'GERONIMA', 'ASUQUE', '110', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1998-01-02'),
('024199', '$2y$10$M8.6oTz9OxQnCrkkJDCt9ee2w1qPelrCMcZ7BNyPsepX/jruftgU6', 'NAVARRO', 'ARIEL', 'AMURAO', '210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1999-05-17'),
('024499', '$2y$10$lp.im5o.0WB78/yAF5UE6.Iq/cL/.7XQHy9RDEYimR3dwhk3UR92y', 'DELGADO', 'MANUEL', 'CANA', '140', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1999-05-20'),
('025396', '$2y$10$wEQtT6GxWCrpI/7OpYXgeuqTmVgbef25.vbfR6CBzv40aAmvb2FpK', 'BALLENA', 'ARLENE', 'BORJA', '110', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1996-05-08'),
('025900', '$2y$10$iccsDQibafwQMH/vlryqLusSRzC4wLid2dcpqxSKrLVB5OXS.KQ4u', 'DIOLOLA', 'ROMELYN', 'ROXAS', '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2000-06-03'),
('026401', '$2y$10$ps/L0o7ZyQggTB5.F30HF.QO/sNHkw5TK345gkuKAtjQ2SSkXlFR.', 'OCAMPO', 'JIMMY', 'MARFA', '300', b'0', b'0', b'0', b'1', NULL, NULL, NULL, '1990-03-16'),
('027002', '$2y$10$Tl.mq4v0zrOKVxBotn.VbOKGM1GkcvXvdVJ1EfsCpgQ11UklaLvtG', 'CASTILLO', 'MA. PHOEBE', 'BEDIA', '300', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2002-06-26'),
('027203', '$2y$10$9Hh7pG2ZN5PKlr59TGdDvOmV0.pgBMWDg0X8S0IU4GnL8biA4mrli', 'FALLECIDO JR.', 'EDGARDO', 'MARIFOSQUE', '340', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2003-10-01'),
('027304', '$2y$10$tXCFIHCvu8fGBYGyopxSIOsO/CNLN809ze3Oj0y3vlb.lz.z2k9Vy', 'BACAREZA', 'CECILIA', 'CANALING', '801', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2004-01-05'),
('027404', '$2y$10$45j/WvkY4EaOekslHQecuONdOT89UOI2JefUpQiUmUY.kj4yciKeK', 'REYES', 'WILFREDO', 'PANGILINAN', '351', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2004-02-02'),
('027604', '$2y$10$yBUa05QrjM/dSxThvfWhtur54CbGosQJsYGIfWuTYHwpPzcUIlR2e', 'OLIVEROS', 'EDMUNDO', 'VILLANUEVA', '331', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2004-02-23'),
('027904', '$2y$10$ULEbGUHCrekfOnqtgPI1xuLConJFBJm1Ltg11WNrZ47wIk6OYIBzS', 'ROSEUS', 'ANABELLE', 'PO', '140', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2004-06-01'),
('028205', '$2y$10$HSsCKTzQadpmqsJFXxHO5OXeBR.pRF8wObB4hUqvvGWIh1raGei2y', 'ACERIMO', 'JEFFREY', 'ADOFINA', '340', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2005-04-04'),
('028405', '$2y$10$0LbHk/iLeMwxEjIsfxm3ZeJZrQpW0kFVLGhNdoX8MwFhmZhu/MTFW', 'CASANES', 'NOEL', 'BAGUS', '331', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2005-04-04'),
('028905', '$2y$10$hY3He39rpMnyMxPT4Z0JtOC1lEKUHk6tvzLDkGUocjygO7CcteJcq', 'DEL ROSARIO', 'JOEY', 'SABALE', '330', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2005-12-05'),
('029606', '$2y$10$uZFjHHpu0gRI4Gjxjr.op.b9aasbJTCEUaS4lnHcpPgQfElZhJaUC', 'CELEBRE', 'EDGAR', 'TUALLA', '100', b'0', b'0', b'0', b'1', NULL, NULL, NULL, '2006-08-07'),
('029906', '$2y$10$1q9BLe2SkM7JqDziOYIVZeqgVX2tSO8BfAYGhaSk7VsTtt5C9sN2G', 'EGUIA', 'RHUEL', 'MACALINDONG', '400', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2006-10-02'),
('031307', '$2y$10$aTNvqddkSD7im5ZOVxPzjumbYSyCRTUzr7aY4LToOVBWkrmgLPQZG', 'PAJUTAN', 'MELVIRG', 'ROXAS', '340', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2007-03-07'),
('031707', '$2y$10$2nDnD25iOB5.K/78dELkS.Li2ssg5.imUAqUJawTX8nv6o9Zlz3mG', 'LIPIO', 'JOSEPHINE', 'ORBILLO', '321', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2007-07-10'),
('031807', '$2y$10$/wEcUwbrKVYWbBSi//P5JeC5HAaJ2dcycHKKpTzhLofSiTCMEGw3y', 'ROBLES', 'GLECY', 'VILLAMOR', '321', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2007-07-10'),
('032007', '$2y$10$FH.n.BDvw4smAbtHDqSma.2r6BISCNGHoicw4g77uxDIV1axIbv8e', 'BAGO', 'MA. VICTORIA', 'DE LEON', '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2007-08-06'),
('032407', '$2y$10$jjjjGKu/GPB6sXST/K8tsuNEzb/zjIbcaUuuEZAZ39Z2usRSXmNYK', 'BANNAGAO', 'LAWRENCE ARNEL', 'ACOSTA', '322', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2007-09-24'),
('032608', '$2y$10$I4SUgsT81sBmWGhUpC0f2eGnFwHt31FZaGnZmBQtxPyaUDQhgC1Ry', 'RUAR', 'FLORDELIZA', 'BISCO', '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2008-02-18'),
('032808', '$2y$10$5IyDbaVungXSk66YGf2x3OVOHD3ZBkbwdzlfCTeGiSN683v5YIMDy', 'ASINAS', 'MARLON', 'DURAN', '150', b'1', b'0', b'0', b'0', NULL, NULL, NULL, '2008-02-26'),
('034409', '$2y$10$U0S2jOjGfU.YxF8TrLxIr.pTCJ9pnh7O8EJJSHMuVmv6w7tTxoAdy', 'LUZANO', 'ROMEL', 'BUGARIN', '351', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2009-04-27'),
('034709', '$2y$10$OHcw.ZAMwYIiXC3g4k5iH.ANWpMEaYzETdktdcpVw3xUijfoX783y', 'ITLIONG', 'MARK GIL', 'ESTIBAL', '340', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2009-06-01'),
('035009', '$2y$10$4vQ1oxa59wwR6Q80u4Haqe/mv4SlNZQJ1vAKCdg3xvVVYJ6npW82K', 'PANOPIO', 'MELANIE', 'REFIL', '700', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2009-08-06'),
('035109', '$2y$10$Rji73kSF.0/s0U7hhPW/9Om6SuZrm.QJj6WYwia6iiC0gsr.pZonK', 'UDARBE', 'MARCEL', 'SALTING', '300', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2009-09-01'),
('035610', '$2y$10$CLPG76aGysgwHLxE5R121e457sf3ZW/6ph0nRmJJ2pxUKc6PxQiMy', 'NAQUILA', 'STEMARK', 'PANA', '321', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2010-02-03'),
('035910', '$2y$10$0/fKid67WZNaJb3K7ikqjO4BTkcglLy.O2NMiHt9ObEH5ikpooFW.', 'SAYSON', 'MICHAEL', 'AGATO', '331', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2010-05-05'),
('036611', '$2y$10$stXC1t.5yig.t6Vlo10ub.3tPa9hpGkdCDopblKajeG.lRcQUmmCm', 'HIFE', 'MARIA ROWENA', 'REYES', '210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011-02-04'),
('039612', '$2y$10$H2FGeY8wZMXp.O8DXuWjkuYLxqRLgkn8pzjCzccmje5rV5Oc67TI6', 'LEYRAN', 'AILENE', 'ROMASANTA', '140', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-02'),
('039912', '$2y$10$N8susbCjzzIzxRk/i5v0TunwSxWinQnWnmKcuf/eY/.9TjMrW6uRe', 'BORJA', 'ALFER MARCOS', 'CRISPINO', '210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-11-06'),
('040113', '$2y$10$rt7Za4GIGqcYeoX7RM4bBuWwhCbYxbY9o.Cy/dGZxz2WFuk4cPtx6', 'MANARIN', 'JEFFEL KURT', 'NAN', '700', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2013-03-25'),
('040613', '$2y$10$0VE06ZM/51ipaRLaVJy.x.BgZycRBFcOkK.sgNBap0KLx/1A7Nnta', 'OLIQUINO', 'ROBERTO', 'PERAS', '230', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2013-07-01'),
('041014', '$2y$10$To/LUPQyEsVPNZcz72bBKebOOlFg1B5WBtGzETNYyaTu1marlWFUC', 'EVANGELISTA', 'JESSA', 'APOR', '140', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-09-04'),
('041214', '$2y$10$o8SXDacYEAmavEEA8zn1Eeu.WJZWWIKhfje8bZz.4J3.YIN97kfZC', 'MOLINA', 'MARIA PAMELA', 'CAIRO', '230', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-17'),
('042214', '$2y$10$4GeCPMhIp9FBTF5ZyD6NsuecgASXSNYKBRzh3lw3dn1h.w9pZIzjq', 'SAQUIBAL', 'ARIES VANN', 'RETUYA', '600', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-06-23'),
('042515', '$2y$10$PPXMdSOUPCvjsqsuPfbOK.jq5leZsHMw/Ae/X.OkpwBJ9OiJVvDjy', 'EBARITA', 'JUN ALBERT', 'CORILLA', '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-02-02'),
('042615', '$2y$10$gsom55FWl4uq6epM6kUdnOnoWwT8PO3xw8.Cf68Ergk1.N.CsXGn.', 'HERNANDEZ', 'CHRISTIAN', 'CAO', '332', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-02-18'),
('042715', '$2y$10$ei81hnhFWDew1MuUKLgjbOHBv2s6JW5B0DQC6E4SmOshDquLq9lme', 'RAVANA', 'GAYLORD', 'CAMACHO', '340', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-03-04'),
('042815', '$2y$10$PGDH37Qeg6slcNPI2dbzuOB6WWl416j.ultHwgNkvq.r6lvLw9j.O', 'GARANO', 'MARLON', 'SALVADOR', '340', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-03-05'),
('043815', '$2y$10$E02uDmMYMvdsg/3IscMeyeKogwEua54avVz/E0y7uwcfDJFPu/dUG', 'MANINGO', 'ALEJANDRO', 'CABINGAS', '230', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-10-05'),
('043915', '$2y$10$8A/jEQoFdy/bbk19VEl/MuqGKEvEG4sIiUDxeITVex4oTAebp7e3W', 'ROXAS JR.', 'FELICITO', 'DIZON', '332', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-10-12'),
('044216', '$2y$10$rJ3Gd9McGrjsHxACb.sKTuTkhd6Ir3aUnB8hoQLfcfq8lIyJN.H8q', 'ZABALA', 'KENNETH', 'TORRES', '210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-01-04'),
('045016', '$2y$10$6rs4EyfvpWO33JIzpZjSferbeaVHq2MDFTsKDAd.H3FT66w2YijEO', 'CERRUDO', 'CHARMAINE', 'LAGMAN', '331', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-06-20'),
('045116', '$2y$10$uN2WSEpe46JVYlw1DjK/yebh/dFhy0ZeJDWH8JB69h0/jcLyfW92G', 'CRUZ', 'ELEANORE', 'BANGGA', '331', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-06-22'),
('045216', '$2y$10$bNB/F4sCsA9NyN8D13U5LeOdCwcnfmoaWf1nLywOReDTBBD6y0k/C', 'CELIS', 'MARIDEL', 'VALENCIA', '322', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-07-12'),
('045316', '$2y$10$S2u5lzlrioC2SAbp3MGgyOHjXIS7IRMt80q60zBhfjfz7.Pof2Qwq', 'DE JESUS', 'FERLYN', 'BALICUATRO', '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-07-14'),
('045416', '$2y$10$FuOAHHN3wvXrmOqDpo3PrugzzjbWeGUncUNe7aeDJyrywjPletN9y', 'AMION', 'GLACESARY', 'EMBILE', '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-13'),
('045516', '$2y$10$Bx1DNYfDn6uXp4pGhfvJPODdoD2cmiW2kvz47YmfepQCWcrcAWBaC', 'PEREZ', 'MARCH ROSE SHELL', 'PANES', '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-09-13'),
('046016', '$2y$10$E9m1y1EriAaj9mbrvoZpluT.M6Md6K4TJh1tBfeGsh0KdB3LA/8tW', 'JAMORALIN', 'ANELE', 'BAUTISTA', '210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-11-21'),
('046217', '$2y$10$3tctGKeYamXLYeofos16P.5/m9R6ugVTzbXn4W4cUnBeoNQzouH1C', 'RED', 'REYNANTE', 'PETILLA', '230', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-01-16'),
('046417', '$2y$10$R3StQC/Otp5iWjQC9QaUwejjBF.w9jha3EpYKyAKadDJDvctBt8Ui', 'ABAWAG', 'REINHARD CIRE', 'ESCOBAR', '150', b'1', b'0', b'0', b'0', NULL, NULL, NULL, '2017-03-13'),
('046617', '$2y$10$4d8fKBg7gmeugrCa0MbqMOWuIY.sG4icQ5cC1yrVJHep1n/DgF.JK', 'MANDAL', 'MV LEBERTY', 'PAMOLERAS', '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-13'),
('046717', '$2y$10$acjUud8iegcQHyO4rHuaoO18mz19i/FoEMb5.eVrSCIJ5Siru5IbG', 'TOBIAS', 'EGAN', 'ODICTA', '600', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-23'),
('046817', '$2y$10$xzh.dlvy4wifLV/qYFZWLuH.hGid/G5x.bdqqcOVZsl1fX7XUYmdK', 'MALLETE', 'MONICA', 'BALDERAS', '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-04-17'),
('047017', '$2y$10$cI8AruilhRWz2RTWJV1YU.peo9SOUqjTW/Ohbprh1qwAdt6XZStrS', 'RIVERA', 'MARK ANGELO', 'PENANO', '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-04-17'),
('047117', '$2y$10$lgkspJYFrrK4yaUhEgLiUeWtaywvPm/LPCowCr7WfnHHzW/y5XG8y', 'CRISTAL JR.', 'CIPRIANO', 'DILIG', '332', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-05-29'),
('047317', '$2y$10$joXH1t7GgPwE94U/AZINF.o0Q5u4fl8Lw2qDJlPT9LXD6VWoalwLu', 'ABALIN JR.', 'REYNALDO', 'LUCERO', '352', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-07-01'),
('047417', '$2y$10$bAeqPPiPw7.og/V3ZoefoOwCY2.Rb8SJ6yV.KL6IO6TJgx3xn4RhO', 'BORBANO', 'LIEZEL', 'GARCIA', '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-07-01'),
('047517', '$2y$10$1wExT1D/LFwKjge4j7nHmOXVngHn6aL56R1j.xJbJcVUu9oaWT85G', 'DINGLE', 'MAYLYN', 'ARABACA', '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-08-14'),
('047617', '$2y$10$DuUkP7kJDNrZTIIOGHdT8.PuXDr9PVcd2FFL8FXyQHrIGCsfUuE3C', 'CASUGA', 'MAY ANN', 'OBIANO', '331', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-08-14'),
('047817', '$2y$10$uKvd2EqTGTwiHfodlK13/uVwhHD1IfvyGWg/Ur8vX1SQNgsbM0c6S', 'VILLAHERMOSA', 'JASMIN', 'REYES', '120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-22'),
('048018', '$2y$10$HZnfiIhsc4vjiOLCcXU9T.OukLdSI3eg5E7aikT7x1yFg7J4LYfBu', 'AGO', 'OLIVE COLEEN', 'DONATO', '400', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-02-01'),
('048118', '$2y$10$pfATRRV4BPpe5xqlbXrqNuSevqJSF2v/hk6jPFlfGQdZy8AmFJXO2', 'AGUILON', 'NOEL', 'DE LOS REYES', '321', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-02-01'),
('048218', '$2y$10$d8zmu2UDVvhQD0QSDCFSNODBRBXE45iy.uWsiHuy3kCB17G/Z.X8O', 'BATALON', 'EDGAR', 'INSO', '230', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-02-01'),
('048318', '$2y$10$0XTGCn9UPhymebUDyVF9f.C4HSh4mM3k/K2nAHXgFRQiywbzwl02G', 'PANGANTIHON', 'MARYJANE', 'ALLIC', '230', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-02-01'),
('048618', '$2y$10$JcjT5/zV.pAGaliC15mqHOdjR5d15M0fLNXML1kA7cknzm/M9OX2e', 'MUENA', 'ROLANDO JR.', 'BUENAVISTA', '140', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-10'),
('048818', '$2y$10$wO0xqiqkihmOMK5xgCTBIu1Hk0R/LOQxNK4psaefp3vnPSOOz42Yu', 'LEGACION', 'MARIE VIANNEY', 'LIBRANDO', '600', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-11'),
('048918', '$2y$10$26n6P23gIWD/CPWVgkE5Oet4py9T3hJ5M13K9mdZL1cK.Duorr5eq', 'MANALO', 'RONALD', 'CUENCA', '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-21'),
('049018', '$2y$10$JRPdAbh8T/vykhtT0ZybN.Ek7ZC/Ojwqh.UxJp55X6CPEUFr55XAS', 'FELIZARDO', 'ALVIN', 'ABOT', '352', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-21'),
('049118', '$2y$10$p0ClK4d0PUGZ9P9R7WmUxO.J9I1ZJC9SMkMKenNBMT4xKjN7gg1pm', 'MANGONON', 'LEA EDELMA', 'STA MARIA', '500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-09'),
('049418', '$2y$10$DMbb3pIR./.eGo2s4jhG4eHxL68XsT9tNi0ODlPT4pzZOTnZy3Szm', 'HERNANDEZ', 'JENNIFER', 'SANCHEZ', '500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-16'),
('049719', '$2y$10$Y4SEd/qIIZXUP4.hB8m40uMwcNgL./fu4.wPQG4BdeFDfKbtO1efS', 'OLLET', 'CATHLEEN', 'CUEVA', '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-18'),
('049919', '$2y$10$VWZn8WkoHki7EZC5VKv6GeLa4ZVVBCTztYdZUACCCT0u572gP0mLC', 'HONRADE', 'RICHARD ANTHONY', 'PONAN', '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-02'),
('050019', '$2y$10$RtHHd94LttvUetKMPQEPreCe.iPUFwgGI.J/AFM/t/dT73MXXpFE2', 'GO,  JR.', 'JOAQUIN', 'LIM', '211', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-23'),
('050119', '$2y$10$qFBHNzvfDD.Hm89atk4fnOk5r61Y7YDSFh7i98ewVm9cgTHnfqcO2', 'GALIPOSO', 'ROEL', 'PONTRIAS', '211', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-14'),
('050219', '$2y$10$FzDhRi6Va7lCgY/YIsGyA..1FlaLcB6BFF6sXHHWbbQTh9MWGlF5i', 'ONG', 'SOCORRO', 'ROPELOS', '500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-15'),
('050419', '$2y$10$9gTVsDfcw6olJ5.kbEvJD.d2kmcUFTYz7SSZVo4xn4qL9lBDkBJk6', 'LIBED', 'ARNOLD', 'NOVAL', '210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-14'),
('050519', '$2y$10$X4o8ijeaT4dfRPKLg3Vl3.nEKwRNJoEGUXVuwDf4Q3ruSQhr3VVYq', 'MARCELO', 'ANNA LIZZA', 'ARGANA', '700', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-04'),
('050620', '$2y$10$N1V3106vInsEHWhHz.i/aOpSXtYXsbUCikyujuGnQPKUhpApvnYqq', 'BREVA', 'JENNETTE', 'GAN', '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-06'),
('050720', '$2y$10$F/XfH4.SfDQcYDFxJofhbe3kC5AVnWZMmZfs1T4IDjmfZggEgdg9S', 'ROGEL', 'CHRISTIAN', 'PADOC', '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-06'),
('050820', '$2y$10$bF1LZrNwhNT1dLX6.WmL2OGkMeYUU/Z8fyZ/V4T6VECqf0SnFG7SK', 'VARGAS', 'VICTOR JOSEPH', 'MAG-ISA', '400', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-06'),
('050920', '$2y$10$UvNC08eL5jNCpPqIj47.FOW/WNqSmADl.7FirMZTvirnLETgadS6q', 'SALE', 'JOENARD', 'CUSTODIO', '340', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-03'),
('051120', '$2y$10$28HRh4ONZ0nnLa.b1MQRpOVabp/X2wHq.Xvq9v/4VZlspVl/d.672', 'CARMEN', 'JENEROSE', 'EMA', '210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-03-02'),
('051320', '$2y$10$HctZyYI0IifP6ZHa.rL3YeG5uKQWEYihsl1D8Yj6uc5TH6tDOm8F.', 'CARIAGA', 'EVANGELINE', 'SUING', '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-03-16'),
('051420', '$2y$10$cpr22LeQynkJ2bRo9Xm6WOHa2Rlx.wt6EAajjU49XNtW2StRWgFJe', 'DE GUZMAN', 'ALVIN', 'OLILA', '351', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-01'),
('051520', '$2y$10$ewIXkwzgKUCd7upn8LMgTuOjN8UH3CsRpfBlciPyV4BdQ0bhH7E9u', 'FLORES JR', 'PRISCILO FABIAN', 'REYES DE LOS', '352', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-01'),
('051620', '$2y$10$GzqckgsUXgqsVUtaR8OJouKtJnnZf87Rd8Sq6sFnAtHxVKgB8m69y', 'PULLON', 'JAN ADRIAN', 'DELA CRUZ', '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-28'),
('051720', '$2y$10$tJx3/zLLCYVZ.b8Y7FFTe.ZyV0wt3V6ET6LTZRoBwb9gbv.3ExrUy', 'VILLANUEVA', 'ALLEN', 'DEQUINA', '353', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-28'),
('051821', '$2y$10$Bv.f4JK6bxgMu0ByEAMST.zWOmLJmSOXzGEwGdtVzZ6tdsxBbDf.O', 'BALLESTEROS', 'MARTHA JORGIANNA', 'LUCES', '220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-04'),
('051921', '$2y$10$yJrMpAuu0v/nhtos5lRSGObYZtTGY6utlVRTGzWgJZCBu1JdBZY9e', 'CARANGUIAN', 'ARNOLD', 'DAYAG', '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-15'),
('052021', '$2y$10$TRH9jt7xaaAe8OCOL4QNqu8y3HHa0QzQ.o904UAIuAxdtNIOV9xFW', 'ONG', 'JOVITO', 'CATAHAY', '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `empcode` varchar(6) NOT NULL,
  `name` varchar(65) NOT NULL,
  `date_filed` date NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `pay` varchar(65) NOT NULL,
  `type` varchar(65) NOT NULL,
  `reason` text NOT NULL,
  `recommended_by` varchar(6) NOT NULL,
  `approved_by` varchar(6) NOT NULL,
  `rec_status` tinyint(1) NOT NULL,
  `appr_status` tinyint(1) NOT NULL,
  `status` varchar(10) DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `empcode`, `name`, `date_filed`, `date_start`, `date_end`, `pay`, `type`, `reason`, `recommended_by`, `approved_by`, `rec_status`, `appr_status`, `status`) VALUES
(1, '046417', 'ABAWAG, REINHARD CIRE ESCOBAR', '2021-04-09', '2021-04-09', '2021-04-09', 'without pay', 'Paternity', 'sa', '046417', '046417', 0, 0, 'PENDING'),
(2, '046417', 'ABAWAG, REINHARD CIRE ESCOBAR', '2021-04-09', '2021-04-15', '2021-04-15', 'without pay', 'Vacation', 'Sa bahay lang', '046417', '029606', 0, 0, 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `overtimes`
--

CREATE TABLE `overtimes` (
  `id` int(11) NOT NULL,
  `empcode` varchar(10) NOT NULL,
  `deptcode` varchar(10) NOT NULL,
  `date_filed` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `hrs` double NOT NULL,
  `reason` text NOT NULL,
  `rec_by` varchar(10) NOT NULL,
  `appr_by` varchar(10) NOT NULL,
  `rec_status` bit(1) DEFAULT NULL,
  `appr_status` bit(1) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `appr_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overtimes`
--

INSERT INTO `overtimes` (`id`, `empcode`, `deptcode`, `date_filed`, `start_time`, `end_time`, `hrs`, `reason`, `rec_by`, `appr_by`, `rec_status`, `appr_status`, `status`, `create_date`, `appr_date`) VALUES
(1, '046417', '150', '2021-04-09', '08:00:00', '17:00:00', 9, 'Holiday OT', '', '046417', b'1', b'1', 'APPROVED', '2021-04-08 10:47:29', NULL),
(2, '046417', '150', '2021-04-08', '17:00:00', '22:00:00', 5, 'Web development', '032808', '046417', NULL, NULL, 'PENDING', '2021-04-08 17:48:55', NULL),
(3, '046417', '150', '2021-04-09', '18:00:00', '22:00:00', 4, '', '046417', '029606', b'1', NULL, 'PENDING', '2021-04-09 15:46:17', NULL),
(4, '046417', '150', '2021-04-14', '12:00:00', '17:00:00', 5, 'Saturday OT', '046417', '029606', NULL, NULL, 'PENDING', '2021-04-10 15:20:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `emp` varchar(10) NOT NULL,
  `date_filed` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `purpose` varchar(50) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `from_time` varchar(50) NOT NULL,
  `to_time` varchar(50) NOT NULL,
  `reason` text NOT NULL,
  `reliever` varchar(50) NOT NULL,
  `approver` varchar(10) NOT NULL,
  `personnel` varchar(10) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `emp`, `date_filed`, `purpose`, `from_date`, `to_date`, `from_time`, `to_time`, `reason`, `reliever`, `approver`, `personnel`, `approved`, `status`) VALUES
(1, '046417', '2021-04-08 10:51:06', 'WORK FROM HOME', '2021-04-07', '2021-04-09', '2:00 pm to 10:00 pm', '8:00 am to 5:00 pm', 'home quarantine', '', '046417', NULL, 1, 'APPROVED'),
(2, '046417', '2021-04-10 15:19:01', 'CHANGE SHIFT', '2021-04-12', '2021-04-30', '2:00 pm to 10:00 pm', '8:00 am to 5:00 pm', 'Back to normal schedule', '', '046417', NULL, 0, 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `trail`
--

CREATE TABLE `trail` (
  `id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `request_id` int(10) NOT NULL,
  `approver_id` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trail`
--

INSERT INTO `trail` (`id`, `type`, `request_id`, `approver_id`, `status`, `date`) VALUES
(1, 'OT', 1, '046417', 1, '2021-03-18 09:37:20'),
(2, 'OT', 1, '046417', 1, '2021-03-20 09:59:22'),
(3, 'OT', 1, '046417', 1, '2021-03-20 09:59:27'),
(4, 'OT', 1, '046417', 1, '2021-03-20 09:59:29'),
(5, 'OT', 1, '046417', 1, '2021-03-20 09:59:31'),
(6, 'OT', 1, '046417', 1, '2021-03-20 09:59:32'),
(7, 'OT', 1, '046417', 1, '2021-03-20 09:59:42'),
(8, 'OT', 1, '046417', 1, '2021-03-20 09:59:50'),
(9, 'OT', 1, '046417', 1, '2021-03-20 10:16:38'),
(10, 'OT', 1, '046417', 1, '2021-03-20 10:24:43'),
(11, 'OT', 1, '046417', 1, '2021-03-20 10:33:27'),
(12, 'OT', 2, '046417', 1, '2021-03-20 10:34:43'),
(13, 'OT', 2, '046417', 1, '2021-03-20 10:34:47'),
(14, 'OT', 1, '046417', 1, '2021-03-20 10:44:40'),
(15, 'OT', 2, '046417', 1, '2021-03-20 10:44:42'),
(16, 'OT', 3, '046417', 1, '2021-03-20 10:46:32'),
(17, 'OT', 3, '046417', 1, '2021-03-20 10:52:43'),
(18, 'OT', 4, '046417', 1, '2021-03-25 13:58:49'),
(19, 'OT', 10, '046417', 1, '2021-03-29 06:15:59'),
(20, 'OT', 2, '046417', 1, '2021-03-29 06:16:05'),
(21, 'OT', 3, '046417', 1, '2021-03-29 06:16:06'),
(22, 'OT', 4, '046417', 1, '2021-03-29 06:16:08'),
(23, 'OT', 5, '046417', 1, '2021-03-29 06:16:10'),
(24, 'OT', 6, '046417', 1, '2021-03-29 06:16:11'),
(25, 'OT', 7, '046417', 1, '2021-03-29 06:16:13'),
(26, 'OT', 8, '046417', 1, '2021-03-29 06:16:14'),
(27, 'OT', 9, '046417', 1, '2021-03-29 06:16:16'),
(28, 'OT', 1, '046417', 1, '2021-03-29 06:16:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `changeshifts`
--
ALTER TABLE `changeshifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`deptcode`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`empcode`),
  ADD KEY `deptcode` (`deptcode`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtimes`
--
ALTER TABLE `overtimes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trail`
--
ALTER TABLE `trail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `changeshifts`
--
ALTER TABLE `changeshifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `overtimes`
--
ALTER TABLE `overtimes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trail`
--
ALTER TABLE `trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`deptcode`) REFERENCES `departments` (`deptcode`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
