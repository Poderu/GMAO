-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Ven 28 Juin 2019 à 16:46
-- Version du serveur :  10.1.38-MariaDB-0+deb9u1
-- Version de PHP :  7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gmaolabo`
--

-- --------------------------------------------------------

--
-- Structure de la table `consommable`
--

CREATE TABLE `consommable` (
  `idconsommable` int(11) NOT NULL,
  `consommable_code` varchar(25) DEFAULT NULL,
  `consommable_designation` varchar(50) NOT NULL,
  `consommable_famille` varchar(50) DEFAULT NULL,
  `consommable_modele` varchar(50) DEFAULT NULL,
  `consommable_marque` varchar(50) DEFAULT NULL,
  `consommable_stock` int(11) DEFAULT NULL,
  `idemplacement` int(11) DEFAULT NULL,
  `consommable_alerte` int(11) DEFAULT NULL,
  `consommable_prix` varchar(25) DEFAULT NULL,
  `consommable_image` varchar(205) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `consommable`
--

INSERT INTO `consommable` (`idconsommable`, `consommable_code`, `consommable_designation`, `consommable_famille`, `consommable_modele`, `consommable_marque`, `consommable_stock`, `idemplacement`, `consommable_alerte`, `consommable_prix`, `consommable_image`) VALUES
(6, '3Z6D-WYX (C-203) TYPE B-R', 'Piezo 3MHZ d12 peri', 'Piezo', '', 'Fuji céramique', 10, 1, 5, '28.37', 'Img/Profil/piezo3MHZd12peri.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `idcontact` int(11) NOT NULL,
  `contact_nom` varchar(125) NOT NULL,
  `contact_numero` varchar(50) DEFAULT NULL,
  `contact_fonction` varchar(125) DEFAULT NULL,
  `idfournisseur` int(11) NOT NULL,
  `contact_mail` varchar(125) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`idcontact`, `contact_nom`, `contact_numero`, `contact_fonction`, `idfournisseur`, `contact_mail`) VALUES
(41, 'M. Lagrue', '01452478454', 'Responsable mécanique', 4, 'lagrue@top-industrie.fr'),
(39, 'Christophe LAUQUIN', '01.64.10.45.50', 'Responsable BE', 4, 'christophe.lauquin@top-industrie.fr'),
(40, 'Patrice Gros', '06.48.03.57.23', 'Commercial', 4, 'patrice.gros@top-industrie.fr'),
(37, 'Benjamin RONSE', '06 14 55 49 96', 'Ingénieur technico-commercial', 7, 'benjamin.ronse@es-france.com'),
(38, 'Linda BAGHELAL', '01 47 95 99 61', 'Assistante Commerciale', 7, 'baghelall@es-france.com');

-- --------------------------------------------------------

--
-- Structure de la table `correspond`
--

CREATE TABLE `correspond` (
  `idcor` int(11) NOT NULL,
  `idmachine` int(11) NOT NULL,
  `idpiece` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `correspond`
--

INSERT INTO `correspond` (`idcor`, `idmachine`, `idpiece`) VALUES
(27, 9, 10),
(39, 0, 7),
(29, 0, 6),
(37, 0, 5),
(35, 0, 4),
(33, 0, 3),
(32, 0, 2),
(30, 9, 6),
(34, 9, 3),
(36, 9, 4),
(38, 9, 5),
(40, 9, 7);

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

CREATE TABLE `document` (
  `iddocument` int(11) NOT NULL,
  `document_nom` varchar(50) NOT NULL,
  `document_document` varchar(100) NOT NULL,
  `idpiece` int(11) DEFAULT NULL,
  `idmachine` int(11) DEFAULT NULL,
  `idpilote` int(11) DEFAULT NULL,
  `idconsommable` int(11) DEFAULT NULL,
  `document_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `document`
--

INSERT INTO `document` (`iddocument`, `document_nom`, `document_document`, `idpiece`, `idmachine`, `idpilote`, `idconsommable`, `document_date`) VALUES
(1, 'Notice 2126-2000', 'Doc/Notice 2126-2000.pdf', NULL, 9, 0, 0, '2019-06-18'),
(2, 'Nomenclature 2126-2000', 'Doc/Nomenclature 2126-2000.pdf', NULL, 9, 0, 0, '2019-06-18'),
(3, 'Plan 2126-2000', 'Doc/Plan 2126-2000.pdf', NULL, 9, 0, 0, '2019-06-18'),
(6, 'bague teflon', 'Doc/bague teflon.pdf', NULL, 10, NULL, NULL, '2019-06-27'),
(7, 'reflecteur bas', 'Doc/reflecteur bas.pdf', NULL, 10, NULL, NULL, '2019-06-27'),
(8, 'reflecteur haut', 'Doc/reflecteur haut.pdf', NULL, 10, NULL, NULL, '2019-06-27'),
(9, 'support bas1', 'Doc/support bas1.pdf', NULL, 10, NULL, NULL, '2019-06-27'),
(10, 'support bas2', 'Doc/support bas2.pdf', NULL, 10, NULL, NULL, '2019-06-27'),
(11, 'support bas3', 'Doc/support bas3.pdf', NULL, 10, NULL, NULL, '2019-06-27'),
(12, 'support haut1', 'Doc/support haut1.pdf', NULL, 10, NULL, NULL, '2019-06-27'),
(13, 'support haut2', 'Doc/support haut2.pdf', NULL, 10, NULL, NULL, '2019-06-27'),
(14, 'vue ensemble1', 'Doc/vue ensemble1.pdf', NULL, 10, NULL, NULL, '2019-06-27'),
(15, 'vue ensemble2', 'Doc/vue ensemble2.pdf', NULL, 10, NULL, NULL, '2019-06-27'),
(16, 'vue ensemble3', 'Doc/vue ensemble3.pdf', NULL, 10, NULL, NULL, '2019-06-27'),
(24, 'reflecteur haut.pdf', 'Doc/reflecteur haut.pdf', NULL, 6, NULL, NULL, '2019-06-27'),
(28, 'bague teflon.pdf', 'Doc/bague teflon.pdf', NULL, NULL, NULL, 6, '2019-06-27'),
(29, 'Diam12_10_8_6mm_Freq_3MGHZ_2500BAR.pdf', 'Doc/Diam12_10_8_6mm_Freq_3MGHZ_2500BAR.pdf', NULL, 6, NULL, NULL, '2019-06-27'),
(30, 'vue ensemble3.pdf', 'Doc/vue ensemble3.pdf', NULL, 3, NULL, NULL, '2019-06-27'),
(31, 'bague reflon.pdf', 'Doc/bague reflon.pdf', NULL, NULL, 3, NULL, '2019-06-27'),
(33, 'reflecteur bas.pdf', 'Doc/reflecteur bas.pdf', NULL, NULL, 3, NULL, '2019-06-27'),
(34, 'support haut2.pdf', 'Doc/support haut2.pdf', NULL, NULL, 3, NULL, '2019-06-28');

-- --------------------------------------------------------

--
-- Structure de la table `droit`
--

CREATE TABLE `droit` (
  `iddroit` int(11) NOT NULL,
  `droit_droit` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `droit`
--

INSERT INTO `droit` (`iddroit`, `droit_droit`) VALUES
(1, 'consultant'),
(2, 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `emplacement`
--

CREATE TABLE `emplacement` (
  `idemplacement` int(11) NOT NULL,
  `emplacement_designation` varchar(50) NOT NULL,
  `emplacement_salle` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `emplacement`
--

INSERT INTO `emplacement` (`idemplacement`, `emplacement_designation`, `emplacement_salle`) VALUES
(1, 'Armoire1', 'Salle thésards'),
(2, 'Armoire2', 'Bureau D. Nasri'),
(3, 'Salle manip', '342');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `idfournisseur` int(11) NOT NULL,
  `fournisseur_code` varchar(50) NOT NULL,
  `fournisseur_designation` varchar(50) NOT NULL,
  `fournisseur_codeclient` varchar(100) DEFAULT NULL,
  `fournisseur_telephone` varchar(11) DEFAULT NULL,
  `fournisseur_fax` varchar(11) DEFAULT NULL,
  `fournisseur_mail` varchar(50) DEFAULT NULL,
  `fournisseur_ville` varchar(50) DEFAULT NULL,
  `fournisseur_lien` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fournisseur`
--

INSERT INTO `fournisseur` (`idfournisseur`, `fournisseur_code`, `fournisseur_designation`, `fournisseur_codeclient`, `fournisseur_telephone`, `fournisseur_fax`, `fournisseur_mail`, `fournisseur_ville`, `fournisseur_lien`) VALUES
(4, 'Top_Industrie', 'Top Industrie', 'esssai', '01 64 10 45', NULL, 'info@top-industrie.fr', '79 Rue Marinoni, 77000 Vaux-le-Pénil', 'https://www.top-industrie.fr/'),
(5, 'Sofranel_UltraSon', 'Sofranel', '20178', '01 39 13 82', '01 39 13 19', 'infosof@sofranel.com', '59, rue Parmentier 78500 Sartrouville - FRANCE', 'http://www.sofranel.com/fr/'),
(7, 'ES', 'Equipements Scientifiques', NULL, '01 47 95 99', NULL, NULL, '127 Rue de Buzenval, 92380 Garches', 'https://www.es-france.com/'),
(10, 'Fisher', 'Fisher Scientific', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `intervention`
--

CREATE TABLE `intervention` (
  `idintervention` int(11) NOT NULL,
  `intervention_date` date NOT NULL,
  `intervention_description` varchar(600) NOT NULL,
  `idmachine` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `intervention`
--

INSERT INTO `intervention` (`idintervention`, `intervention_date`, `intervention_description`, `idmachine`, `idutilisateur`) VALUES
(2, '2018-10-01', 'Changement kit joint. Difficulté à enlever le pistion, il faut enlever remplir la culasse de fluide puis défaire la contre-bague de maintien. Ensuite tourner le cabestan jusqu\'à dégager le piston ', 1, 12),
(3, '2019-06-04', ' À l\'aide de la clé [1] prévue à cet effet, desserrer d\'un quart de tour (sens inverse des aiguilles d\'une montre) la vis de délestage de la pompe hydraulique .\r\n\r\nEffectuer l\'intervention souhaitée .\r\n\r\nAprès intervention :\r\n\r\n    effectuer le serrage de la vis de délestage\r\n    effectuer un essai de fonctionnement\r\n', 1, 12),
(4, '2014-04-03', 'Un orage d\'une rare violence a frappé Toulouse hier soir, avec des rafales de plus de 130 km/h et des grêlons. De nombreux automobilistes ont été bloqués sur le périphérique.', 1, 12),
(6, '2218-02-01', 'Essai intervention tektro', 8, 12),
(7, '2019-06-27', 'Essai 2 amzojdeazjeopjazoeazopeapzropaozurparjparpazurpaozurapozurpazerupaiuzreiazurioazurapiozuraizriuzarouaroiuaoriuzaoeiruzioeruzieruzioeruzioeruzoieurzoieur^zoieurzoieruzoieruzoieruzeiruzieurzoîeurzoîeru^zioeurzieruzioeur', 8, 12),
(8, '2019-06-12', 'Tektronix garantit le présent produit, fabriqué et commercialisé par elle-même, contre toutdéfaut de matériau ou vice de fabrication pendant une période de trois (3) ans, à compter dela date d’expédition par un distributeur Tektronix agréé. Si un produit ou un tubecathodique s’avérait défectueux pendant cette période de garantie, Tektronix s’engage àprocéder soit à la réparation, soit au remplacement du produit, comme cela est décrit dansle texte intégral de la garantie.', 8, 12),
(9, '2018-03-12', 'Ceci est un test pour l\'ajout d\'une intervention.\r\nTest1', 9, 13);

-- --------------------------------------------------------

--
-- Structure de la table `lien`
--

CREATE TABLE `lien` (
  `idlien` int(11) NOT NULL,
  `idfournisseur` int(11) NOT NULL,
  `idpiece` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lien`
--

INSERT INTO `lien` (`idlien`, `idfournisseur`, `idpiece`) VALUES
(24, 4, 2),
(18, 4, 10),
(28, 4, 7),
(23, 0, 2),
(25, 4, 3),
(26, 4, 4),
(27, 4, 5),
(20, 4, 6);

-- --------------------------------------------------------

--
-- Structure de la table `lienconso`
--

CREATE TABLE `lienconso` (
  `idlienconso` int(11) NOT NULL,
  `idconsommable` int(11) NOT NULL,
  `idfournisseur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lienconso`
--

INSERT INTO `lienconso` (`idlienconso`, `idconsommable`, `idfournisseur`) VALUES
(10, 6, 3);

-- --------------------------------------------------------

--
-- Structure de la table `lienmach`
--

CREATE TABLE `lienmach` (
  `idlienmach` int(11) NOT NULL,
  `idmachine` int(11) NOT NULL,
  `idfournisseur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lienmach`
--

INSERT INTO `lienmach` (`idlienmach`, `idmachine`, `idfournisseur`) VALUES
(44, 9, 4),
(43, 9, 0),
(39, 11, 10),
(38, 11, 0);

-- --------------------------------------------------------

--
-- Structure de la table `lienpilconso`
--

CREATE TABLE `lienpilconso` (
  `idlienpilconso` int(11) NOT NULL,
  `idconsommable` int(11) NOT NULL,
  `idpilote` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lienpilconso`
--

INSERT INTO `lienpilconso` (`idlienpilconso`, `idconsommable`, `idpilote`) VALUES
(9, 5, 1),
(20, 6, 3),
(19, 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `lienpilmach`
--

CREATE TABLE `lienpilmach` (
  `idlienpilmach` int(11) NOT NULL,
  `idmachine` int(11) NOT NULL,
  `idpilote` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lienpilmach`
--

INSERT INTO `lienpilmach` (`idlienpilmach`, `idmachine`, `idpilote`) VALUES
(2, 1, 2),
(8, 1, 1),
(23, 10, 3),
(22, 8, 3),
(21, 9, 3);

-- --------------------------------------------------------

--
-- Structure de la table `lienpilpiece`
--

CREATE TABLE `lienpilpiece` (
  `idlienpilpiece` int(11) NOT NULL,
  `idpiece` int(11) NOT NULL,
  `idpilote` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lienpilpiece`
--

INSERT INTO `lienpilpiece` (`idlienpilpiece`, `idpiece`, `idpilote`) VALUES
(1, 6, 2),
(2, 7, 2),
(12, 4, 1),
(11, 7, 1),
(22, 10, 3),
(21, 0, 3),
(23, 10, 3);

-- --------------------------------------------------------

--
-- Structure de la table `machine`
--

CREATE TABLE `machine` (
  `idmachine` int(11) NOT NULL,
  `machine_code` varchar(50) NOT NULL,
  `machine_codefourn` varchar(50) DEFAULT NULL,
  `machine_designation` varchar(50) NOT NULL,
  `machine_modele` varchar(50) DEFAULT NULL,
  `machine_marque` varchar(50) DEFAULT NULL,
  `machine_image` varchar(205) DEFAULT NULL,
  `machine_arrive` date DEFAULT NULL,
  `machine_periode` int(11) DEFAULT NULL,
  `machine_statut` int(11) NOT NULL DEFAULT '0',
  `machine_dernierControle` date DEFAULT NULL,
  `machine_prochainControle` date DEFAULT NULL,
  `machine_prix` varchar(25) DEFAULT NULL,
  `idemplacement` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `machine`
--

INSERT INTO `machine` (`idmachine`, `machine_code`, `machine_codefourn`, `machine_designation`, `machine_modele`, `machine_marque`, `machine_image`, `machine_arrive`, `machine_periode`, `machine_statut`, `machine_dernierControle`, `machine_prochainControle`, `machine_prix`, `idemplacement`) VALUES
(9, 'P_2500', '2126 2000', 'Pompe 2500', 'Pompe manuelle', 'Top Industrie', 'Img/Profil/Pompe_2126-2000.jpg', '2008-05-01', NULL, 1, NULL, NULL, '868', 3),
(8, 'Oscitektro1', 'tektro1002b', 'Oscilloscope', 'TDS1002B', 'Tektronix', 'Img/Profil/tds1002b.jpg', '2008-05-01', NULL, 1, NULL, NULL, '868', NULL),
(11, 'BainCryo-1', 'S/N10022122', 'Bain crypthermostat', 'CC40', 'Huber', 'Img/Profil/Bain_cryo_cc40_1.jpg', '2009-02-12', NULL, 1, NULL, NULL, NULL, NULL),
(10, 'piezo double', 'LFCR', 'Cellule double piezo 2500 bar', 'TDS1002B', 'Tektronix', 'Img/Profil/Cellule_double_piezo_2500_bar.JPG', '2008-05-01', NULL, 1, NULL, NULL, '868', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `piece`
--

CREATE TABLE `piece` (
  `idpiece` int(11) NOT NULL,
  `piece_code` varchar(20) NOT NULL,
  `piece_designation` varchar(50) NOT NULL,
  `piece_famille` varchar(50) DEFAULT NULL,
  `piece_modele` varchar(50) DEFAULT NULL,
  `piece_marque` varchar(50) DEFAULT NULL,
  `piece_stock` int(11) DEFAULT NULL,
  `idemplacement` int(11) DEFAULT NULL,
  `piece_image` varchar(205) DEFAULT NULL,
  `piece_alerte` int(11) DEFAULT NULL,
  `piece_prix` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `piece`
--

INSERT INTO `piece` (`idpiece`, `piece_code`, `piece_designation`, `piece_famille`, `piece_modele`, `piece_marque`, `piece_stock`, `idemplacement`, `piece_image`, `piece_alerte`, `piece_prix`) VALUES
(2, '609 28 02 06', 'Bague intérieure', 'Joint piston', '', 'Top Industrie', 2, 2, 'Img/Profil/Kit_joints2126-2000.JPG', 1, '23'),
(3, '609 28 02 01', 'Bague extérieure', 'Joint piston', '', 'Top Industrie', 2, 2, NULL, 1, '25'),
(4, '609 28 02 02', 'JOINT TORIQUE Ø 18,77x1,78', 'Joint piston', '', 'Top Industrie', 2, 2, NULL, NULL, '50'),
(5, '609 28 02 04', 'JOINT TEFLON CV', 'Joint piston', '', 'Top Industrie', 2, 2, NULL, NULL, '70'),
(6, '609 28 02 03', 'JOINT TEFLON', 'Joint piston', '', '', 2, 2, NULL, 1, '45'),
(7, '609 28 02 05', 'JOINT NYLON', 'Joint piston', '', 'Top Industrie', 2, 2, NULL, 1, '78'),
(10, 'Vanne_Sitec', 'Vanne Sitec', 'Vanne', '715310', 'SITEC', 3, 1, 'Img/Profil/Sitec_vanne_7105310.jpg', 1, '75');

-- --------------------------------------------------------

--
-- Structure de la table `pilote`
--

CREATE TABLE `pilote` (
  `idpilote` int(11) NOT NULL,
  `pilote_designation` varchar(50) NOT NULL,
  `pilote_fonction` varchar(250) DEFAULT NULL,
  `pilote_prix` varchar(50) DEFAULT NULL,
  `pilote_date` date DEFAULT NULL,
  `pilote_image` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `pilote`
--

INSERT INTO `pilote` (`idpilote`, `pilote_designation`, `pilote_fonction`, `pilote_prix`, `pilote_date`, `pilote_image`) VALUES
(3, 'Pilote US2500 bar', 'Mesure de la vitesse de propagation d\'ondes ultrasonores dans des fluides.\r\nPression : atmo à 2500 bar\r\nTempérature : 20°C à 150°C', '16000 euros', '2009-02-01', 'Img/Profil/Pilote_US_2500_bar.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idutilisateur` int(11) NOT NULL,
  `utilisateur_identifiant` varchar(50) NOT NULL,
  `utilisateur_mdp` varchar(255) NOT NULL,
  `utilisateur_nom` varchar(50) NOT NULL,
  `utilisateur_prenom` varchar(50) NOT NULL,
  `iddroit` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idutilisateur`, `utilisateur_identifiant`, `utilisateur_mdp`, `utilisateur_nom`, `utilisateur_prenom`, `iddroit`) VALUES
(11, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'admin', 2),
(12, 'd.nasri', '9f24d52bd4ef72b062849f382926edb44f8ffbf8', 'Nasri', 'Djamel', 2),
(13, 'h.carrier', '29a8e8303efc0037f935d54502a98ed982239c01', 'Carrier', 'Hervé', 1),
(14, 'jl.daridon', '71dbed2df0d3c8f6ff3ecf7a2a41869772f015ad', 'Daridon', 'Jean-Luc', 1),
(15, 'jp.bazile', '9de694f368ec5c02e1277c7d2453031ca2132776', 'Bazile', 'Jean-Patrick', 2),
(16, 'f.capponi', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'capponi', 'florian', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `consommable`
--
ALTER TABLE `consommable`
  ADD PRIMARY KEY (`idconsommable`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`idcontact`);

--
-- Index pour la table `correspond`
--
ALTER TABLE `correspond`
  ADD PRIMARY KEY (`idcor`);

--
-- Index pour la table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`iddocument`);

--
-- Index pour la table `droit`
--
ALTER TABLE `droit`
  ADD PRIMARY KEY (`iddroit`);

--
-- Index pour la table `emplacement`
--
ALTER TABLE `emplacement`
  ADD PRIMARY KEY (`idemplacement`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`idfournisseur`);

--
-- Index pour la table `intervention`
--
ALTER TABLE `intervention`
  ADD PRIMARY KEY (`idintervention`);

--
-- Index pour la table `lien`
--
ALTER TABLE `lien`
  ADD PRIMARY KEY (`idlien`);

--
-- Index pour la table `lienconso`
--
ALTER TABLE `lienconso`
  ADD PRIMARY KEY (`idlienconso`);

--
-- Index pour la table `lienmach`
--
ALTER TABLE `lienmach`
  ADD PRIMARY KEY (`idlienmach`);

--
-- Index pour la table `lienpilconso`
--
ALTER TABLE `lienpilconso`
  ADD PRIMARY KEY (`idlienpilconso`);

--
-- Index pour la table `lienpilmach`
--
ALTER TABLE `lienpilmach`
  ADD PRIMARY KEY (`idlienpilmach`);

--
-- Index pour la table `lienpilpiece`
--
ALTER TABLE `lienpilpiece`
  ADD PRIMARY KEY (`idlienpilpiece`);

--
-- Index pour la table `machine`
--
ALTER TABLE `machine`
  ADD PRIMARY KEY (`idmachine`);

--
-- Index pour la table `piece`
--
ALTER TABLE `piece`
  ADD PRIMARY KEY (`idpiece`);

--
-- Index pour la table `pilote`
--
ALTER TABLE `pilote`
  ADD PRIMARY KEY (`idpilote`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idutilisateur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `consommable`
--
ALTER TABLE `consommable`
  MODIFY `idconsommable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `idcontact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT pour la table `correspond`
--
ALTER TABLE `correspond`
  MODIFY `idcor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT pour la table `document`
--
ALTER TABLE `document`
  MODIFY `iddocument` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT pour la table `droit`
--
ALTER TABLE `droit`
  MODIFY `iddroit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `emplacement`
--
ALTER TABLE `emplacement`
  MODIFY `idemplacement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `idfournisseur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `intervention`
--
ALTER TABLE `intervention`
  MODIFY `idintervention` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `lien`
--
ALTER TABLE `lien`
  MODIFY `idlien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pour la table `lienconso`
--
ALTER TABLE `lienconso`
  MODIFY `idlienconso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `lienmach`
--
ALTER TABLE `lienmach`
  MODIFY `idlienmach` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT pour la table `lienpilconso`
--
ALTER TABLE `lienpilconso`
  MODIFY `idlienpilconso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `lienpilmach`
--
ALTER TABLE `lienpilmach`
  MODIFY `idlienpilmach` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `lienpilpiece`
--
ALTER TABLE `lienpilpiece`
  MODIFY `idlienpilpiece` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `machine`
--
ALTER TABLE `machine`
  MODIFY `idmachine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `piece`
--
ALTER TABLE `piece`
  MODIFY `idpiece` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `pilote`
--
ALTER TABLE `pilote`
  MODIFY `idpilote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idutilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
