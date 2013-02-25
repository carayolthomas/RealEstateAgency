-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 25 Février 2013 à 13:44
-- Version du serveur: 5.1.36
-- Version de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `agenceimmo`
--

-- --------------------------------------------------------

--
-- Structure de la table `bien`
--

CREATE TABLE IF NOT EXISTS `bien` (
  `idbien` char(5) NOT NULL,
  `photobien` varchar(20) NOT NULL,
  `titrebien` varchar(30) NOT NULL,
  `detailbien` varchar(100) NOT NULL,
  `adrbien` varchar(50) NOT NULL,
  `prixbien` decimal(8,2) NOT NULL,
  `idtype` char(2) NOT NULL,
  `vendule` date NOT NULL,
  PRIMARY KEY (`idbien`),
  KEY `fk_idtype_bien` (`idtype`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `bien`
--

INSERT INTO `bien` (`idbien`, `photobien`, `titrebien`, `detailbien`, `adrbien`, `prixbien`, `idtype`, `vendule`) VALUES
('b0001', 'b0001.jpg', 'Villa Rieumes', 'Centre de Rieumes, jolie maison de plain-pied dans un charmant quartier ', 'Place du village, 31900 Rieumes', '270000.00', 'F7', '0000-00-00'),
('b0002', 'b0002.jpg', 'Villa Garidech', 'Dans quartier résidentiel, jolie villa F5 de plain-pied,  cuisine équipée ', 'Place du centre, 31800 Garidech', '320000.00', 'F5', '0000-00-00'),
('b0003', 'b0003.jpg', 'Villa Plaisance', 'Belle maison de caractère F5 150 m2 sur terrain 500 m2 calme. Très beau séjour en L 43 m2 cheminée', 'Rue droite, 31700 Plaisance', '250000.00', 'F5', '0000-00-00'),
('b0004', 'b0004.jpg', 'Villa Beaumont', 'Ferme habitable en l''état composée de 3 chambres, dont une au RDC, salon, cuisine, combles ', 'Rue gauche, 82500 Beaumont', '175000.00', 'F4', '0000-00-00'),
('b0005', 'b0005.jpg', 'Villa Auterive', 'Dans cadre champêtre, villa neuve F4 sur 700 m² de terrain clos, disponible  ', 'Avenue du centre, 31500 Auterive', '215000.00', 'F4', '2011-03-18'),
('b0006', 'b0006.jpg', 'Villa St Rustice', 'Maison ancienne F4 sur 3000M² clos dont 1500M² constructible, dépendances', 'Avenue extérieure, 31430 St Rustice', '245000.00', 'F4', '2011-03-18'),
('b0007', 'b0007.jpg', 'Villa L''Union', 'Charmante maison de plain pied avec garage, abri de voiture, proche commerces', 'Rue des granges, 31110 L''Union', '195000.00', 'F4', '2011-03-18'),
('b0008', 'b0008.jpg', 'Villa Léguevin', 'Située dans un environnement très calme, vous serez séduits par les volumes et la luminosité', 'Rue fauve, 31220 Léguevin', '250000.00', 'F5', '2011-03-18'),
('b0009', 'b0009.jpg', 'Villa Bessières', 'Agréable maison de plain pied (2003) 117m2,4 CH dont une suite parentale. Cuisine U.S,grand séjour', 'Rue courbe, 31670 Bessières', '275000.00', 'F5', '2011-03-18'),
('b0010', 'b0010.jpg', 'Villa St Lys', 'Proche ttes commodités au calme, agréable villa F4 de 95 m2, cellier, garage indépendant', 'Chemin grand, 31550 St Lys', '245000.00', 'F4', '2011-03-18');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `idclient` int(11) NOT NULL AUTO_INCREMENT,
  `nomclient` varchar(30) NOT NULL,
  `adrclient` varchar(50) NOT NULL,
  `telclient` varchar(10) NOT NULL,
  `emailclient` varchar(20) NOT NULL,
  PRIMARY KEY (`idclient`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`idclient`, `nomclient`, `adrclient`, `telclient`, `emailclient`) VALUES
(1, 'Michel Tuffery', 'Université Toulouse 2', '0562747575', 'tuffery@cict.fr'),
(2, 'Monsieur Intranet', 'Rue du DotNet', '0561508765', 'intranet@cict.fr'),
(23, 'Thomas CARAYOL', '6 impasse des fleurs', '060606060', 'thomascarayol@hotmai');

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE IF NOT EXISTS `demande` (
  `iddemande` int(11) NOT NULL AUTO_INCREMENT,
  `datedemande` datetime NOT NULL,
  `disponibilite` varchar(20) NOT NULL,
  `idclient` int(11) NOT NULL,
  PRIMARY KEY (`iddemande`),
  KEY `fk_idlclient_demande` (`idclient`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Contenu de la table `demande`
--

INSERT INTO `demande` (`iddemande`, `datedemande`, `disponibilite`, `idclient`) VALUES
(1, '2008-09-12 00:00:00', 'Lundi matin et Jeudi', 1),
(2, '2008-10-20 00:00:00', 'Mardi matin et Vendr', 1),
(3, '2008-10-21 00:00:00', 'Lundi après-midi  et', 2),
(23, '2011-02-13 18:59:31', 'Lundi Mardi', 23),
(24, '2011-02-13 18:59:31', 'Lundi Mardi', 23),
(25, '2011-02-13 18:59:31', 'Lundi Mardi', 24);

-- --------------------------------------------------------

--
-- Structure de la table `ressembler`
--

CREATE TABLE IF NOT EXISTS `ressembler` (
  `idbien1` char(5) NOT NULL,
  `idbien2` char(5) NOT NULL,
  `ordre` int(11) NOT NULL,
  PRIMARY KEY (`idbien1`,`idbien2`),
  KEY `fk_idbien1` (`idbien2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ressembler`
--

INSERT INTO `ressembler` (`idbien1`, `idbien2`, `ordre`) VALUES
('b0002', 'b0003', 1),
('b0002', 'b0008', 2),
('b0002', 'b0009', 3),
('b0004', 'b0006', 2),
('b0004', 'b0007', 1),
('b0006', 'b0004', 1),
('b0006', 'b0005', 2),
('b0009', 'b0002', 1),
('b0009', 'b0003', 2);

-- --------------------------------------------------------

--
-- Structure de la table `typebien`
--

CREATE TABLE IF NOT EXISTS `typebien` (
  `idtype` char(2) NOT NULL,
  `nomtype` varchar(30) NOT NULL,
  PRIMARY KEY (`idtype`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `typebien`
--

INSERT INTO `typebien` (`idtype`, `nomtype`) VALUES
('F1', 'Une pièce'),
('F2', 'Deux pièces'),
('F3', 'Trois pièces'),
('F4', 'Quatre pièces'),
('F5', 'Cinq pièces'),
('F6', 'Six pièces'),
('F7', 'Sept pièces'),
('FG', 'Plus de 7 pièces');

-- --------------------------------------------------------

--
-- Structure de la table `visiter`
--

CREATE TABLE IF NOT EXISTS `visiter` (
  `idbien` char(5) NOT NULL,
  `iddemande` int(11) NOT NULL AUTO_INCREMENT,
  `priorite` int(11) NOT NULL,
  PRIMARY KEY (`idbien`,`iddemande`),
  KEY `fk_iddemande` (`iddemande`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Contenu de la table `visiter`
--

INSERT INTO `visiter` (`idbien`, `iddemande`, `priorite`) VALUES
('b0001', 1, 1),
('b0001', 28, 1),
('b0001', 30, 1),
('b0001', 32, 1),
('b0001', 35, 1),
('b0001', 37, 1),
('b0001', 39, 1),
('b0001', 40, 1),
('b0001', 41, 0),
('b0001', 42, 1),
('b0002', 1, 2),
('b0002', 3, 4),
('b0002', 33, 1),
('b0002', 43, 1),
('b0003', 2, 1),
('b0003', 30, 0),
('b0008', 29, 2);
