
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `exotunnel`
--

-- --------------------------------------------------------

--
-- Contenu de la table `ville`
--

INSERT INTO `ville` (`v_id`, `v_nom`, `v_superficie`) VALUES
(1, 'Svarkungor ', 20),
(2, 'Urbaz', 10),
(3, 'Forgefer', 5),
(4, 'Moria', 50);

-- --------------------------------------------------------

--
-- Contenu de la table `taverne`
--

INSERT INTO `taverne` (`t_id`, `t_nom`, `t_chambres`, `t_blonde`, `t_brune`, `t_rousse`, `t_ville_fk`) VALUES
(1, 'Au gobelin piétiné', 15, 0, 1, 1, 3),
(2, 'La chope', 20, 1, 0, 1, 1),
(3, 'Au pire accueil', 1, 0, 0, 1, 4),
(4, 'La pioche en Houblon', 10, 0, 1, 1, 1),
(5, 'Euh j''suis bourré', 42, 1, 1, 1, 2),
(6, 'La chope(filliale)', 17, 1, 0, 1, 2),
(7, 'La bonne pioche', 15, 1, 1, 0, 3),
(8, 'Objectif 3 Bières', 250, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Contenu de la table `tunnel`
--

INSERT INTO `tunnel` (`t_id`, `t_progres`, `t_villedepart_fk`, `t_villearrivee_fk`) VALUES
(1, 100, 1, 2),
(2, 100, 2, 3),
(3, 100, 3, 4),
(4, 100, 4, 1),
(5, 99, 1, 3),
(6, 0, 2, 4);

-- --------------------------------------------------------

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`g_id`, `g_debuttravail`, `g_fintravail`, `g_taverne_fk`, `g_tunnel_fk`) VALUES
(1, '09:00:00', '17:00:00', 8, 4),
(2, '09:00:00', '17:00:00', 7, 5),
(3, '09:00:00', '17:00:00', 5, 6),
(4, '21:00:00', '05:00:00', 2, 6),
(5, '04:00:01', '12:00:01', NULL, 1);

-- --------------------------------------------------------

--
-- Contenu de la table `nain`
--

INSERT INTO `nain` (`n_id`, `n_nom`, `n_barbe`, `n_groupe_fk`, `n_ville_fk`) VALUES
(1, 'Therin', 25, 2, 1),
(2, 'Tarkin', 42, 1, 1),
(3, 'Gimly', 37, 2, 4),
(4, 'Gurdil', 50, 5, 3),
(5, 'Thorin', 12, 2, 1),
(6, 'Orrinn', 26, 1, 2),
(7, 'Bardan', 45, 3, 2),
(8, 'Nôrok', 36, 3, 3),
(9, 'Accident n°1', 0, NULL, 4),
(10, 'Mulch', 16, 2, 4),
(11, 'Telligent', 100.001, 1, 2),
(12, 'Génieur', 18, 2, 2),
(13, 'Kapabl', 33, 1, 1),
(14, 'Guroth', 20, 3, 3),
(15, 'Damien', 0.5, NULL, 1),
(16, 'Zwerglein', 6, 4, 1),
(17, 'Kiesel', 10, 4, 4),
(18, 'Rhine', 1, 5, 2),
(19, 'Stan', 66.6, 3, 4),
(20, 'Pohssibl', 87, 5, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;