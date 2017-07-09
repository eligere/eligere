-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Creato il: Mar 06, 2017 alle 12:16
-- Versione del server: 10.1.10-MariaDB
-- Versione PHP: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fuzzyahp`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `alternative`
--

CREATE TABLE `alternative` (
  `id` int(11) NOT NULL,
  `name` char(20) NOT NULL,
  `description` text NOT NULL,
  `date_insert` date NOT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `user_id` char(30) NOT NULL,
  `dir_path` char(50) NOT NULL,
  `dir_path_file` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `alternative`
--

INSERT INTO `alternative` (`id`, `name`, `description`, `date_insert`, `questionnaire_id`, `user_id`, `dir_path`, `dir_path_file`) VALUES
(43, 'Alternative1', 'Alternative1 Desc', '2015-10-29', 144, '', 'media/test/Alternative1', 'media/test/Alternative1/Prototipo1_render_.jpg'),
(44, 'Alternative2', 'Alternative 2 Desc', '2015-10-29', 144, '', 'media/test/Alternative2', 'media/test/Alternative2/Prototipo2_render_.jpg'),
(45, 'Alternative 3', 'Alternative 3 Desc ', '2015-10-29', 144, '', 'media/test/Alternative 3', 'media/test/Alternative 3/Prototipo3_render_.jpg'),
(46, 'Alternative4', 'Alternative 4 Desc', '2015-10-29', 144, '', 'media/test/Alternative4', 'media/test/Alternative4/Prototipo4_render_.jpg'),
(47, 'Alternative5', 'Alternative 5 Desc', '2015-10-29', 144, '', 'media/test/Alternative5', 'media/test/Alternative5/Prototipo5_render_.jpg'),
(48, 'Alternative6', 'Alternative 6 Desc ', '2015-10-29', 144, '', 'media/test/Alternative6', 'media/test/Alternative6/Prototipo6_render_.jpg'),
(97, 'MEDROB', 'MEDROB', '2017-02-27', 161, '', 'media/Europeo/MEDROB', 'media/Europeo/MEDROB/download.png'),
(98, 'REROB', 'REROB', '2017-02-27', 161, '', 'media/Europeo/REROB', 'media/Europeo/REROB/download.png'),
(99, 'SOROB', 'SOROB', '2017-02-27', 161, '', 'media/Europeo/SOROB', 'media/Europeo/SOROB/download.png'),
(101, 'alt1', 'desc alt1', '2017-03-06', 166, '', 'media/test2/alt1', 'media/test2/alt1/1.png'),
(102, 'alt2', 'desc alt2', '2017-03-06', 166, '', 'media/test2/alt2', 'media/test2/alt2/this-pc-computer-icon.png'),
(103, 'alt 2', 'desc alt 3', '2017-03-06', 166, '', 'media/test2/alt 2', 'media/test2/alt 2/600px-Black_body.svg.png');

-- --------------------------------------------------------

--
-- Struttura della tabella `criteria`
--

CREATE TABLE `criteria` (
  `id` int(11) NOT NULL,
  `name` char(20) NOT NULL,
  `description` text NOT NULL,
  `date_insert` date NOT NULL,
  `quest_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `criteria`
--

INSERT INTO `criteria` (`id`, `name`, `description`, `date_insert`, `quest_id`) VALUES
(23, 'C1', 'Simplicity', '2015-10-29', 144),
(24, 'C2', 'Aesthetic design', '2015-10-29', 144),
(25, 'C3', 'Integrability with sensors and electronics', '2015-10-29', 144),
(45, 'excellence', 'excellence', '2017-02-27', 161),
(46, 'impact', 'impact', '2017-02-27', 161),
(47, 'implementation', 'implementation', '2017-02-27', 161),
(49, 'prova235', 'prova1 decription', '2017-03-04', 144),
(50, 'cost', 'cost', '2017-03-05', 161),
(53, 'cr1', ' desc cr1', '2017-03-06', 166),
(54, 'cr2', 'desc cr2', '2017-03-06', 166),
(55, 'cr3', 'desc cr3', '2017-03-06', 166);

-- --------------------------------------------------------

--
-- Struttura della tabella `criteria_alternative`
--

CREATE TABLE `criteria_alternative` (
  `id` int(11) NOT NULL,
  `alt1` int(11) NOT NULL,
  `alt2` int(11) NOT NULL,
  `cri_id` int(11) NOT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `linguistic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `criteria_alternative`
--

INSERT INTO `criteria_alternative` (`id`, `alt1`, `alt2`, `cri_id`, `questionnaire_id`, `user_id`, `date`, `linguistic_id`) VALUES
(289, 43, 44, 23, 144, 81, '2015-12-01 16:52:57', 4),
(290, 43, 44, 24, 144, 81, '2015-12-01 16:52:57', 7),
(291, 43, 44, 25, 144, 81, '2015-12-01 16:52:57', 4),
(292, 43, 45, 23, 144, 81, '2015-12-01 16:52:57', 3),
(293, 43, 45, 24, 144, 81, '2015-12-01 16:52:57', 4),
(294, 43, 45, 25, 144, 81, '2015-12-01 16:52:57', 3),
(295, 43, 46, 23, 144, 81, '2015-12-01 16:52:57', 3),
(296, 43, 46, 24, 144, 81, '2015-12-01 16:52:57', 6),
(297, 43, 46, 25, 144, 81, '2015-12-01 16:52:57', 4),
(298, 43, 47, 23, 144, 81, '2015-12-01 16:52:57', 4),
(299, 43, 47, 24, 144, 81, '2015-12-01 16:52:57', 3),
(300, 43, 47, 25, 144, 81, '2015-12-01 16:52:57', 2),
(301, 43, 48, 23, 144, 81, '2015-12-01 16:52:57', 6),
(302, 43, 48, 24, 144, 81, '2015-12-01 16:52:57', 4),
(303, 43, 48, 25, 144, 81, '2015-12-01 16:52:57', 2),
(304, 44, 45, 23, 144, 81, '2015-12-01 16:52:57', 3),
(305, 44, 45, 24, 144, 81, '2015-12-01 16:52:57', 3),
(306, 44, 45, 25, 144, 81, '2015-12-01 16:52:57', 4),
(307, 44, 46, 23, 144, 81, '2015-12-01 16:52:58', 7),
(308, 44, 46, 24, 144, 81, '2015-12-01 16:52:58', 4),
(309, 44, 46, 25, 144, 81, '2015-12-01 16:52:58', 6),
(310, 44, 47, 23, 144, 81, '2015-12-01 16:52:58', 4),
(311, 44, 47, 24, 144, 81, '2015-12-01 16:52:58', 3),
(312, 44, 47, 25, 144, 81, '2015-12-01 16:52:58', 4),
(313, 44, 48, 23, 144, 81, '2015-12-01 16:52:58', 4),
(314, 44, 48, 24, 144, 81, '2015-12-01 16:52:58', 4),
(315, 44, 48, 25, 144, 81, '2015-12-01 16:52:58', 3),
(316, 45, 46, 23, 144, 81, '2015-12-01 16:52:58', 7),
(317, 45, 46, 24, 144, 81, '2015-12-01 16:52:58', 6),
(318, 45, 46, 25, 144, 81, '2015-12-01 16:52:58', 4),
(319, 45, 47, 23, 144, 81, '2015-12-01 16:52:58', 6),
(320, 45, 47, 24, 144, 81, '2015-12-01 16:52:58', 6),
(321, 45, 47, 25, 144, 81, '2015-12-01 16:52:58', 3),
(322, 45, 48, 23, 144, 81, '2015-12-01 16:52:58', 7),
(323, 45, 48, 24, 144, 81, '2015-12-01 16:52:58', 7),
(324, 45, 48, 25, 144, 81, '2015-12-01 16:52:58', 3),
(325, 46, 47, 23, 144, 81, '2015-12-01 16:52:58', 6),
(326, 46, 47, 24, 144, 81, '2015-12-01 16:52:58', 3),
(327, 46, 47, 25, 144, 81, '2015-12-01 16:52:58', 4),
(328, 46, 48, 23, 144, 81, '2015-12-01 16:52:58', 5),
(329, 46, 48, 24, 144, 81, '2015-12-01 16:52:58', 4),
(330, 46, 48, 25, 144, 81, '2015-12-01 16:52:58', 3),
(331, 47, 48, 23, 144, 81, '2015-12-01 16:52:58', 4),
(332, 47, 48, 24, 144, 81, '2015-12-01 16:52:58', 6),
(333, 47, 48, 25, 144, 81, '2015-12-01 16:52:58', 4),
(334, 43, 44, 23, 144, 82, '2015-12-01 16:58:03', 4),
(335, 43, 44, 24, 144, 82, '2015-12-01 16:58:03', 6),
(336, 43, 44, 25, 144, 82, '2015-12-01 16:58:03', 4),
(337, 43, 45, 23, 144, 82, '2015-12-01 16:58:03', 3),
(338, 43, 45, 24, 144, 82, '2015-12-01 16:58:03', 3),
(339, 43, 45, 25, 144, 82, '2015-12-01 16:58:03', 3),
(340, 43, 46, 23, 144, 82, '2015-12-01 16:58:03', 2),
(341, 43, 46, 24, 144, 82, '2015-12-01 16:58:03', 4),
(342, 43, 46, 25, 144, 82, '2015-12-01 16:58:03', 4),
(343, 43, 47, 23, 144, 82, '2015-12-01 16:58:03', 3),
(344, 43, 47, 24, 144, 82, '2015-12-01 16:58:03', 2),
(345, 43, 47, 25, 144, 82, '2015-12-01 16:58:03', 4),
(346, 43, 48, 23, 144, 82, '2015-12-01 16:58:03', 2),
(347, 43, 48, 24, 144, 82, '2015-12-01 16:58:03', 3),
(348, 43, 48, 25, 144, 82, '2015-12-01 16:58:03', 3),
(349, 44, 45, 23, 144, 82, '2015-12-01 16:58:04', 4),
(350, 44, 45, 24, 144, 82, '2015-12-01 16:58:04', 3),
(351, 44, 45, 25, 144, 82, '2015-12-01 16:58:04', 5),
(352, 44, 46, 23, 144, 82, '2015-12-01 16:58:04', 4),
(353, 44, 46, 24, 144, 82, '2015-12-01 16:58:04', 4),
(354, 44, 46, 25, 144, 82, '2015-12-01 16:58:04', 6),
(355, 44, 47, 23, 144, 82, '2015-12-01 16:58:04', 3),
(356, 44, 47, 24, 144, 82, '2015-12-01 16:58:04', 2),
(357, 44, 47, 25, 144, 82, '2015-12-01 16:58:04', 6),
(358, 44, 48, 23, 144, 82, '2015-12-01 16:58:04', 2),
(359, 44, 48, 24, 144, 82, '2015-12-01 16:58:04', 3),
(360, 44, 48, 25, 144, 82, '2015-12-01 16:58:04', 4),
(361, 45, 46, 23, 144, 82, '2015-12-01 16:58:04', 6),
(362, 45, 46, 24, 144, 82, '2015-12-01 16:58:04', 6),
(363, 45, 46, 25, 144, 82, '2015-12-01 16:58:04', 6),
(364, 45, 47, 23, 144, 82, '2015-12-01 16:58:04', 6),
(365, 45, 47, 24, 144, 82, '2015-12-01 16:58:04', 3),
(366, 45, 47, 25, 144, 82, '2015-12-01 16:58:04', 6),
(367, 45, 48, 23, 144, 82, '2015-12-01 16:58:04', 7),
(368, 45, 48, 24, 144, 82, '2015-12-01 16:58:04', 2),
(369, 45, 48, 25, 144, 82, '2015-12-01 16:58:04', 5),
(370, 46, 47, 23, 144, 82, '2015-12-01 16:58:04', 5),
(371, 46, 47, 24, 144, 82, '2015-12-01 16:58:04', 3),
(372, 46, 47, 25, 144, 82, '2015-12-01 16:58:04', 5),
(373, 46, 48, 23, 144, 82, '2015-12-01 16:58:04', 3),
(374, 46, 48, 24, 144, 82, '2015-12-01 16:58:04', 4),
(375, 46, 48, 25, 144, 82, '2015-12-01 16:58:04', 3),
(376, 47, 48, 23, 144, 82, '2015-12-01 16:58:04', 7),
(377, 47, 48, 24, 144, 82, '2015-12-01 16:58:04', 6),
(378, 47, 48, 25, 144, 82, '2015-12-01 16:58:04', 4),
(379, 43, 44, 23, 144, 83, '2015-12-01 17:03:18', 7),
(380, 43, 44, 24, 144, 83, '2015-12-01 17:03:18', 7),
(381, 43, 44, 25, 144, 83, '2015-12-01 17:03:18', 6),
(382, 43, 45, 23, 144, 83, '2015-12-01 17:03:18', 3),
(383, 43, 45, 24, 144, 83, '2015-12-01 17:03:18', 3),
(384, 43, 45, 25, 144, 83, '2015-12-01 17:03:18', 3),
(385, 43, 46, 23, 144, 83, '2015-12-01 17:03:18', 3),
(386, 43, 46, 24, 144, 83, '2015-12-01 17:03:18', 3),
(387, 43, 46, 25, 144, 83, '2015-12-01 17:03:18', 3),
(388, 43, 47, 23, 144, 83, '2015-12-01 17:03:18', 2),
(389, 43, 47, 24, 144, 83, '2015-12-01 17:03:18', 2),
(390, 43, 47, 25, 144, 83, '2015-12-01 17:03:18', 3),
(391, 43, 48, 23, 144, 83, '2015-12-01 17:03:18', 2),
(392, 43, 48, 24, 144, 83, '2015-12-01 17:03:18', 2),
(393, 43, 48, 25, 144, 83, '2015-12-01 17:03:18', 3),
(394, 44, 45, 23, 144, 83, '2015-12-01 17:03:18', 3),
(395, 44, 45, 24, 144, 83, '2015-12-01 17:03:18', 3),
(396, 44, 45, 25, 144, 83, '2015-12-01 17:03:18', 3),
(397, 44, 46, 23, 144, 83, '2015-12-01 17:03:18', 3),
(398, 44, 46, 24, 144, 83, '2015-12-01 17:03:18', 3),
(399, 44, 46, 25, 144, 83, '2015-12-01 17:03:18', 3),
(400, 44, 47, 23, 144, 83, '2015-12-01 17:03:18', 2),
(401, 44, 47, 24, 144, 83, '2015-12-01 17:03:18', 2),
(402, 44, 47, 25, 144, 83, '2015-12-01 17:03:18', 2),
(403, 44, 48, 23, 144, 83, '2015-12-01 17:03:18', 2),
(404, 44, 48, 24, 144, 83, '2015-12-01 17:03:18', 2),
(405, 44, 48, 25, 144, 83, '2015-12-01 17:03:18', 2),
(406, 45, 46, 23, 144, 83, '2015-12-01 17:03:18', 7),
(407, 45, 46, 24, 144, 83, '2015-12-01 17:03:18', 7),
(408, 45, 46, 25, 144, 83, '2015-12-01 17:03:18', 4),
(409, 45, 47, 23, 144, 83, '2015-12-01 17:03:18', 4),
(410, 45, 47, 24, 144, 83, '2015-12-01 17:03:18', 4),
(411, 45, 47, 25, 144, 83, '2015-12-01 17:03:18', 4),
(412, 45, 48, 23, 144, 83, '2015-12-01 17:03:18', 4),
(413, 45, 48, 24, 144, 83, '2015-12-01 17:03:18', 4),
(414, 45, 48, 25, 144, 83, '2015-12-01 17:03:18', 4),
(415, 46, 47, 23, 144, 83, '2015-12-01 17:03:18', 3),
(416, 46, 47, 24, 144, 83, '2015-12-01 17:03:18', 3),
(417, 46, 47, 25, 144, 83, '2015-12-01 17:03:18', 3),
(418, 46, 48, 23, 144, 83, '2015-12-01 17:03:18', 3),
(419, 46, 48, 24, 144, 83, '2015-12-01 17:03:18', 3),
(420, 46, 48, 25, 144, 83, '2015-12-01 17:03:18', 3),
(421, 47, 48, 23, 144, 83, '2015-12-01 17:03:18', 6),
(422, 47, 48, 24, 144, 83, '2015-12-01 17:03:18', 6),
(423, 47, 48, 25, 144, 83, '2015-12-01 17:03:18', 6),
(424, 43, 44, 23, 144, 84, '2015-12-01 18:03:01', 3),
(425, 43, 44, 24, 144, 84, '2015-12-01 18:03:01', 6),
(426, 43, 44, 25, 144, 84, '2015-12-01 18:03:01', 7),
(427, 43, 45, 23, 144, 84, '2015-12-01 18:03:01', 2),
(428, 43, 45, 24, 144, 84, '2015-12-01 18:03:01', 3),
(429, 43, 45, 25, 144, 84, '2015-12-01 18:03:01', 6),
(430, 43, 46, 23, 144, 84, '2015-12-01 18:03:01', 4),
(431, 43, 46, 24, 144, 84, '2015-12-01 18:03:01', 6),
(432, 43, 46, 25, 144, 84, '2015-12-01 18:03:01', 6),
(433, 43, 47, 23, 144, 84, '2015-12-01 18:03:01', 3),
(434, 43, 47, 24, 144, 84, '2015-12-01 18:03:01', 3),
(435, 43, 47, 25, 144, 84, '2015-12-01 18:03:01', 8),
(436, 43, 48, 23, 144, 84, '2015-12-01 18:03:01', 3),
(437, 43, 48, 24, 144, 84, '2015-12-01 18:03:01', 3),
(438, 43, 48, 25, 144, 84, '2015-12-01 18:03:01', 8),
(439, 44, 45, 23, 144, 84, '2015-12-01 18:03:01', 2),
(440, 44, 45, 24, 144, 84, '2015-12-01 18:03:01', 3),
(441, 44, 45, 25, 144, 84, '2015-12-01 18:03:01', 6),
(442, 44, 46, 23, 144, 84, '2015-12-01 18:03:01', 3),
(443, 44, 46, 24, 144, 84, '2015-12-01 18:03:01', 6),
(444, 44, 46, 25, 144, 84, '2015-12-01 18:03:01', 6),
(445, 44, 47, 23, 144, 84, '2015-12-01 18:03:01', 3),
(446, 44, 47, 24, 144, 84, '2015-12-01 18:03:01', 3),
(447, 44, 47, 25, 144, 84, '2015-12-01 18:03:01', 7),
(448, 44, 48, 23, 144, 84, '2015-12-01 18:03:02', 3),
(449, 44, 48, 24, 144, 84, '2015-12-01 18:03:02', 3),
(450, 44, 48, 25, 144, 84, '2015-12-01 18:03:02', 7),
(451, 45, 46, 23, 144, 84, '2015-12-01 18:03:02', 7),
(452, 45, 46, 24, 144, 84, '2015-12-01 18:03:02', 7),
(453, 45, 46, 25, 144, 84, '2015-12-01 18:03:02', 6),
(454, 45, 47, 23, 144, 84, '2015-12-01 18:03:02', 6),
(455, 45, 47, 24, 144, 84, '2015-12-01 18:03:02', 6),
(456, 45, 47, 25, 144, 84, '2015-12-01 18:03:02', 7),
(457, 45, 48, 23, 144, 84, '2015-12-01 18:03:02', 5),
(458, 45, 48, 24, 144, 84, '2015-12-01 18:03:02', 6),
(459, 45, 48, 25, 144, 84, '2015-12-01 18:03:02', 7),
(460, 46, 47, 23, 144, 84, '2015-12-01 18:03:02', 3),
(461, 46, 47, 24, 144, 84, '2015-12-01 18:03:02', 3),
(462, 46, 47, 25, 144, 84, '2015-12-01 18:03:02', 6),
(463, 46, 48, 23, 144, 84, '2015-12-01 18:03:02', 5),
(464, 46, 48, 24, 144, 84, '2015-12-01 18:03:02', 3),
(465, 46, 48, 25, 144, 84, '2015-12-01 18:03:02', 6),
(466, 47, 48, 23, 144, 84, '2015-12-01 18:03:02', 5),
(467, 47, 48, 24, 144, 84, '2015-12-01 18:03:02', 6),
(468, 47, 48, 25, 144, 84, '2015-12-01 18:03:02', 5),
(469, 43, 44, 23, 144, 85, '2015-12-01 18:06:04', 3),
(470, 43, 44, 24, 144, 85, '2015-12-01 18:06:04', 6),
(471, 43, 44, 25, 144, 85, '2015-12-01 18:06:04', 5),
(472, 43, 45, 23, 144, 85, '2015-12-01 18:06:04', 3),
(473, 43, 45, 24, 144, 85, '2015-12-01 18:06:04', 6),
(474, 43, 45, 25, 144, 85, '2015-12-01 18:06:04', 5),
(475, 43, 46, 23, 144, 85, '2015-12-01 18:06:04', 2),
(476, 43, 46, 24, 144, 85, '2015-12-01 18:06:04', 6),
(477, 43, 46, 25, 144, 85, '2015-12-01 18:06:04', 5),
(478, 43, 47, 23, 144, 85, '2015-12-01 18:06:04', 4),
(479, 43, 47, 24, 144, 85, '2015-12-01 18:06:04', 5),
(480, 43, 47, 25, 144, 85, '2015-12-01 18:06:04', 4),
(481, 43, 48, 23, 144, 85, '2015-12-01 18:06:04', 3),
(482, 43, 48, 24, 144, 85, '2015-12-01 18:06:04', 6),
(483, 43, 48, 25, 144, 85, '2015-12-01 18:06:04', 4),
(484, 44, 45, 23, 144, 85, '2015-12-01 18:06:04', 4),
(485, 44, 45, 24, 144, 85, '2015-12-01 18:06:04', 6),
(486, 44, 45, 25, 144, 85, '2015-12-01 18:06:04', 5),
(487, 44, 46, 23, 144, 85, '2015-12-01 18:06:04', 3),
(488, 44, 46, 24, 144, 85, '2015-12-01 18:06:04', 6),
(489, 44, 46, 25, 144, 85, '2015-12-01 18:06:04', 5),
(490, 44, 47, 23, 144, 85, '2015-12-01 18:06:04', 5),
(491, 44, 47, 24, 144, 85, '2015-12-01 18:06:04', 4),
(492, 44, 47, 25, 144, 85, '2015-12-01 18:06:04', 4),
(493, 44, 48, 23, 144, 85, '2015-12-01 18:06:04', 3),
(494, 44, 48, 24, 144, 85, '2015-12-01 18:06:04', 4),
(495, 44, 48, 25, 144, 85, '2015-12-01 18:06:04', 4),
(496, 45, 46, 23, 144, 85, '2015-12-01 18:06:04', 3),
(497, 45, 46, 24, 144, 85, '2015-12-01 18:06:04', 6),
(498, 45, 46, 25, 144, 85, '2015-12-01 18:06:04', 5),
(499, 45, 47, 23, 144, 85, '2015-12-01 18:06:04', 6),
(500, 45, 47, 24, 144, 85, '2015-12-01 18:06:04', 4),
(501, 45, 47, 25, 144, 85, '2015-12-01 18:06:04', 4),
(502, 45, 48, 23, 144, 85, '2015-12-01 18:06:04', 6),
(503, 45, 48, 24, 144, 85, '2015-12-01 18:06:04', 4),
(504, 45, 48, 25, 144, 85, '2015-12-01 18:06:04', 4),
(505, 46, 47, 23, 144, 85, '2015-12-01 18:06:05', 7),
(506, 46, 47, 24, 144, 85, '2015-12-01 18:06:05', 3),
(507, 46, 47, 25, 144, 85, '2015-12-01 18:06:05', 4),
(508, 46, 48, 23, 144, 85, '2015-12-01 18:06:05', 5),
(509, 46, 48, 24, 144, 85, '2015-12-01 18:06:05', 4),
(510, 46, 48, 25, 144, 85, '2015-12-01 18:06:05', 4),
(511, 47, 48, 23, 144, 85, '2015-12-01 18:06:05', 3),
(512, 47, 48, 24, 144, 85, '2015-12-01 18:06:05', 6),
(513, 47, 48, 25, 144, 85, '2015-12-01 18:06:05', 5),
(514, 43, 44, 23, 144, 86, '2015-12-01 18:09:12', 4),
(515, 43, 44, 24, 144, 86, '2015-12-01 18:09:12', 7),
(516, 43, 44, 25, 144, 86, '2015-12-01 18:09:12', 4),
(517, 43, 45, 23, 144, 86, '2015-12-01 18:09:12', 3),
(518, 43, 45, 24, 144, 86, '2015-12-01 18:09:12', 6),
(519, 43, 45, 25, 144, 86, '2015-12-01 18:09:12', 4),
(520, 43, 46, 23, 144, 86, '2015-12-01 18:09:12', 5),
(521, 43, 46, 24, 144, 86, '2015-12-01 18:09:12', 7),
(522, 43, 46, 25, 144, 86, '2015-12-01 18:09:12', 5),
(523, 43, 47, 23, 144, 86, '2015-12-01 18:09:12', 5),
(524, 43, 47, 24, 144, 86, '2015-12-01 18:09:12', 6),
(525, 43, 47, 25, 144, 86, '2015-12-01 18:09:12', 4),
(526, 43, 48, 23, 144, 86, '2015-12-01 18:09:12', 3),
(527, 43, 48, 24, 144, 86, '2015-12-01 18:09:12', 7),
(528, 43, 48, 25, 144, 86, '2015-12-01 18:09:12', 3),
(529, 44, 45, 23, 144, 86, '2015-12-01 18:09:13', 3),
(530, 44, 45, 24, 144, 86, '2015-12-01 18:09:13', 3),
(531, 44, 45, 25, 144, 86, '2015-12-01 18:09:13', 4),
(532, 44, 46, 23, 144, 86, '2015-12-01 18:09:13', 6),
(533, 44, 46, 24, 144, 86, '2015-12-01 18:09:13', 6),
(534, 44, 46, 25, 144, 86, '2015-12-01 18:09:13', 6),
(535, 44, 47, 23, 144, 86, '2015-12-01 18:09:13', 6),
(536, 44, 47, 24, 144, 86, '2015-12-01 18:09:13', 4),
(537, 44, 47, 25, 144, 86, '2015-12-01 18:09:13', 6),
(538, 44, 48, 23, 144, 86, '2015-12-01 18:09:13', 4),
(539, 44, 48, 24, 144, 86, '2015-12-01 18:09:13', 5),
(540, 44, 48, 25, 144, 86, '2015-12-01 18:09:13', 4),
(541, 45, 46, 23, 144, 86, '2015-12-01 18:09:13', 6),
(542, 45, 46, 24, 144, 86, '2015-12-01 18:09:13', 7),
(543, 45, 46, 25, 144, 86, '2015-12-01 18:09:13', 7),
(544, 45, 47, 23, 144, 86, '2015-12-01 18:09:13', 6),
(545, 45, 47, 24, 144, 86, '2015-12-01 18:09:13', 6),
(546, 45, 47, 25, 144, 86, '2015-12-01 18:09:13', 6),
(547, 45, 48, 23, 144, 86, '2015-12-01 18:09:13', 5),
(548, 45, 48, 24, 144, 86, '2015-12-01 18:09:13', 7),
(549, 45, 48, 25, 144, 86, '2015-12-01 18:09:13', 4),
(550, 46, 47, 23, 144, 86, '2015-12-01 18:09:13', 5),
(551, 46, 47, 24, 144, 86, '2015-12-01 18:09:13', 3),
(552, 46, 47, 25, 144, 86, '2015-12-01 18:09:13', 3),
(553, 46, 48, 23, 144, 86, '2015-12-01 18:09:13', 3),
(554, 46, 48, 24, 144, 86, '2015-12-01 18:09:13', 4),
(555, 46, 48, 25, 144, 86, '2015-12-01 18:09:13', 3),
(556, 47, 48, 23, 144, 86, '2015-12-01 18:09:13', 4),
(557, 47, 48, 24, 144, 86, '2015-12-01 18:09:13', 7),
(558, 47, 48, 25, 144, 86, '2015-12-01 18:09:13', 4),
(559, 43, 44, 23, 144, 87, '2015-12-01 18:12:45', 3),
(560, 43, 44, 24, 144, 87, '2015-12-01 18:12:45', 6),
(561, 43, 44, 25, 144, 87, '2015-12-01 18:12:45', 7),
(562, 43, 45, 23, 144, 87, '2015-12-01 18:12:45', 3),
(563, 43, 45, 24, 144, 87, '2015-12-01 18:12:45', 6),
(564, 43, 45, 25, 144, 87, '2015-12-01 18:12:45', 4),
(565, 43, 46, 23, 144, 87, '2015-12-01 18:12:45', 3),
(566, 43, 46, 24, 144, 87, '2015-12-01 18:12:45', 7),
(567, 43, 46, 25, 144, 87, '2015-12-01 18:12:45', 7),
(568, 43, 47, 23, 144, 87, '2015-12-01 18:12:45', 4),
(569, 43, 47, 24, 144, 87, '2015-12-01 18:12:45', 4),
(570, 43, 47, 25, 144, 87, '2015-12-01 18:12:45', 6),
(571, 43, 48, 23, 144, 87, '2015-12-01 18:12:45', 3),
(572, 43, 48, 24, 144, 87, '2015-12-01 18:12:45', 4),
(573, 43, 48, 25, 144, 87, '2015-12-01 18:12:45', 7),
(574, 44, 45, 23, 144, 87, '2015-12-01 18:12:45', 5),
(575, 44, 45, 24, 144, 87, '2015-12-01 18:12:45', 5),
(576, 44, 45, 25, 144, 87, '2015-12-01 18:12:45', 3),
(577, 44, 46, 23, 144, 87, '2015-12-01 18:12:45', 5),
(578, 44, 46, 24, 144, 87, '2015-12-01 18:12:45', 7),
(579, 44, 46, 25, 144, 87, '2015-12-01 18:12:45', 4),
(580, 44, 47, 23, 144, 87, '2015-12-01 18:12:45', 6),
(581, 44, 47, 24, 144, 87, '2015-12-01 18:12:45', 4),
(582, 44, 47, 25, 144, 87, '2015-12-01 18:12:45', 5),
(583, 44, 48, 23, 144, 87, '2015-12-01 18:12:45', 4),
(584, 44, 48, 24, 144, 87, '2015-12-01 18:12:45', 3),
(585, 44, 48, 25, 144, 87, '2015-12-01 18:12:45', 6),
(586, 45, 46, 23, 144, 87, '2015-12-01 18:12:45', 5),
(587, 45, 46, 24, 144, 87, '2015-12-01 18:12:45', 7),
(588, 45, 46, 25, 144, 87, '2015-12-01 18:12:45', 5),
(589, 45, 47, 23, 144, 87, '2015-12-01 18:12:46', 6),
(590, 45, 47, 24, 144, 87, '2015-12-01 18:12:46', 5),
(591, 45, 47, 25, 144, 87, '2015-12-01 18:12:46', 4),
(592, 45, 48, 23, 144, 87, '2015-12-01 18:12:46', 4),
(593, 45, 48, 24, 144, 87, '2015-12-01 18:12:46', 4),
(594, 45, 48, 25, 144, 87, '2015-12-01 18:12:46', 7),
(595, 46, 47, 23, 144, 87, '2015-12-01 18:12:46', 6),
(596, 46, 47, 24, 144, 87, '2015-12-01 18:12:46', 3),
(597, 46, 47, 25, 144, 87, '2015-12-01 18:12:46', 5),
(598, 46, 48, 23, 144, 87, '2015-12-01 18:12:46', 5),
(599, 46, 48, 24, 144, 87, '2015-12-01 18:12:46', 2),
(600, 46, 48, 25, 144, 87, '2015-12-01 18:12:46', 6),
(601, 47, 48, 23, 144, 87, '2015-12-01 18:12:46', 4),
(602, 47, 48, 24, 144, 87, '2015-12-01 18:12:46', 4),
(603, 47, 48, 25, 144, 87, '2015-12-01 18:12:46', 7),
(606, 101, 102, 53, 166, 98, '2017-03-06 12:10:13', 4),
(607, 101, 102, 54, 166, 98, '2017-03-06 12:10:13', 4),
(608, 101, 102, 55, 166, 98, '2017-03-06 12:10:13', 5),
(609, 101, 103, 53, 166, 98, '2017-03-06 12:10:13', 7),
(610, 101, 103, 54, 166, 98, '2017-03-06 12:10:13', 7),
(611, 101, 103, 55, 166, 98, '2017-03-06 12:10:13', 7),
(612, 102, 103, 53, 166, 98, '2017-03-06 12:10:13', 4),
(613, 102, 103, 54, 166, 98, '2017-03-06 12:10:13', 4),
(614, 102, 103, 55, 166, 98, '2017-03-06 12:10:13', 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `final_score`
--

CREATE TABLE `final_score` (
  `id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `alternative` varchar(1000) NOT NULL,
  `value` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `final_score`
--

INSERT INTO `final_score` (`id`, `quest_id`, `date`, `alternative`, `value`) VALUES
(361, 144, '2017-02-18 23:03:56', '43', 0.251012802),
(362, 144, '2017-02-18 23:03:56', '44', 0.232264757),
(363, 144, '2017-02-18 23:03:56', '45', 0.115430325),
(364, 144, '2017-02-18 23:03:56', '46', 0.188354835),
(365, 144, '2017-02-18 23:03:56', '47', 0.118121475),
(366, 144, '2017-02-18 23:03:56', '48', 0.0948157459);

-- --------------------------------------------------------

--
-- Struttura della tabella `job_cat`
--

CREATE TABLE `job_cat` (
  `job_id` int(11) NOT NULL,
  `job_name` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `job_cat`
--

INSERT INTO `job_cat` (`job_id`, `job_name`) VALUES
(1, 'Academic Jobs Australia'),
(2, 'Academic Jobs Europe'),
(3, 'Accountancy'),
(4, 'Administrative Assistant Jobs'),
(5, 'Administrative Officer Jobs'),
(6, 'Admissions Officer Jobs'),
(7, 'Aeronautical Engineering'),
(9, 'Agriculture and Food'),
(11, 'Anatomy'),
(12, 'Anthropology'),
(13, 'Applied Social Work'),
(14, 'Architecture, Building and Planning'),
(16, 'Assistant Professor Jobs'),
(17, 'Astronomy'),
(18, 'Australasia'),
(19, 'Biochemistry'),
(20, 'Bioinformatician Jobs'),
(21, 'Biology'),
(22, 'Biomedical Scientist Jobs'),
(23, 'Biophysics'),
(24, 'Biotechnology'),
(25, 'Botany'),
(26, 'Building'),
(27, 'Business and Administration'),
(28, 'Business Development Manager Jobs'),
(29, 'Careers Advisor Jobs'),
(30, 'Catering'),
(31, 'Chemical Engineering'),
(32, 'Chemistry'),
(33, 'Civil Engineering'),
(34, 'Classics'),
(35, 'Clinical Research Associate Jobs'),
(36, 'Clinical Trial Jobs'),
(37, 'Communication Studies'),
(38, 'Computer Science'),
(39, 'Computing'),
(40, 'Country Planning'),
(41, 'Creative Arts and Design'),
(42, 'Design'),
(43, 'Drama'),
(44, 'Economics'),
(45, 'Economist'),
(46, 'Education'),
(47, 'Education Studies'),
(48, 'Electrical Engineering'),
(49, 'Engineer'),
(50, 'Engineering and Technology'),
(51, 'Europe'),
(52, 'Faculty Jobs'),
(53, 'Fine Art'),
(54, 'Forestry'),
(55, 'Further Education'),
(56, 'General Research'),
(57, 'General Social Sciences'),
(58, 'Genetics'),
(59, 'Geography'),
(60, 'Geology'),
(61, 'Government'),
(62, 'Graduate'),
(63, 'Hardware'),
(64, 'Health and Medical'),
(65, 'History'),
(66, 'History of Art'),
(67, 'Hotel'),
(68, 'HR'),
(69, 'Human Geography'),
(70, 'Human Resources'),
(71, 'Humanities'),
(72, 'Information Management'),
(73, 'Information Science'),
(74, 'International Office Jobs'),
(75, 'Internet'),
(76, 'Jobs in UAE'),
(77, 'Journalism'),
(78, 'KTP Associate Jobs'),
(79, 'Laboratory Technician Jobs'),
(80, 'Land Management'),
(81, 'Languages'),
(82, 'Law'),
(83, 'Lecturer Jobs'),
(84, 'Leisure'),
(85, 'Leisure Management'),
(86, 'Librarianship'),
(87, 'Librarianship'),
(88, 'Library Assistant Jobs'),
(89, 'Linguistics'),
(90, 'Literature'),
(91, 'London Jobs'),
(92, 'Management'),
(93, 'Maritime Technology'),
(94, 'Marketing'),
(95, 'Materials Science'),
(96, 'Mathematics'),
(97, 'Mechanical Engineering'),
(98, 'Media and Communications'),
(99, 'Medical Technician Jobs'),
(100, 'Medical Technology'),
(101, 'Medicine'),
(102, 'Microbiology'),
(103, 'Midlands'),
(104, 'Minerals Technology'),
(105, 'Modern Languages'),
(106, 'Molecular Biology'),
(107, 'Music'),
(108, 'Northern England'),
(109, 'Northern Ireland'),
(110, 'Nursing'),
(111, 'Nutrition'),
(112, 'Oceanography'),
(113, 'Personnel'),
(114, 'Pharmacology'),
(115, 'Pharmacy'),
(116, 'PhD Bursary Jobs'),
(117, 'PhD Jobs'),
(118, 'PhD Research Studentship Jobs'),
(119, 'PhD Scholarships'),
(120, 'PhD Studentships'),
(121, 'Philosophy'),
(122, 'Physical Sciences'),
(123, 'Physics'),
(124, 'Physiology'),
(125, 'Politics and Government'),
(126, 'Postdoc'),
(127, 'Postdoctoral Research Assistant Jobs'),
(128, 'Postdoctoral Research Associate Jobs'),
(129, 'Postdoctoral Research Fellow Jobs'),
(130, 'Postdoctoral Researcher Jobs'),
(131, 'Postdoctoral Scientist Jobs'),
(132, 'Production Engineering'),
(133, 'Professor Jobs'),
(134, 'Programme Administrator Jobs'),
(135, 'Programme Manager Jobs'),
(136, 'Programming'),
(137, 'Project Manager Jobs'),
(138, 'Project Officer Jobs'),
(139, 'Property Management'),
(140, 'Psychology'),
(141, 'Public Sector'),
(142, 'Publishing'),
(143, 'Religion'),
(144, 'Republic of Ireland'),
(145, 'Research Administrator Jobs'),
(146, 'Research Assistant Jobs'),
(147, 'Research Associate Jobs'),
(148, 'Research Fellow'),
(149, 'Research Manager Jobs'),
(150, 'Research Nurse Jobs'),
(151, 'Research Officer Jobs'),
(152, 'Research Scientist Jobs'),
(153, 'Research Technician Jobs'),
(154, 'Researcher Jobs'),
(155, 'Science'),
(156, 'Science Technician Jobs'),
(157, 'Scientific'),
(158, 'Scotland'),
(159, 'Senior Academic Jobs'),
(160, 'Senior Lecturer Jobs'),
(161, 'Senior Research Assistant Jobs'),
(162, 'Senior Research Associate Jobs'),
(163, 'Senior Research Fellow Jobs'),
(164, 'Social Administration'),
(165, 'Social Policy'),
(166, 'Social Sciences and Social Care'),
(167, 'Sociology'),
(168, 'Software Engineering'),
(169, 'South East England'),
(170, 'South West England'),
(171, 'Sport and Leisure'),
(172, 'Sports Coaching'),
(173, 'Sports Management'),
(174, 'Sports Science'),
(175, 'Statistician Jobs'),
(176, 'Statistics'),
(177, 'Student Recruitment Jobs'),
(178, 'Student Support Jobs'),
(179, 'Teach English'),
(180, 'Teacher Training'),
(181, 'Teaching'),
(182, 'Teaching Fellow Jobs'),
(183, 'Technician Jobs'),
(184, 'TEFL'),
(185, 'TESL'),
(186, 'TESOL'),
(187, 'Theology'),
(188, 'Town Planning'),
(189, 'Travel'),
(191, 'University'),
(192, 'University Administration Jobs'),
(193, 'University Admissions Jobs'),
(194, 'University Jobs Abroad'),
(195, 'University Jobs Australia'),
(196, 'University Marketing Jobs'),
(197, 'University Teaching UK'),
(198, 'Veterinary Science'),
(199, 'Visiting Professor Jobs and Visiting Lecturer Jobs'),
(200, 'Wales'),
(201, 'Zoology');

-- --------------------------------------------------------

--
-- Struttura della tabella `linguistic_scale`
--

CREATE TABLE `linguistic_scale` (
  `id` int(11) NOT NULL,
  `description` char(50) NOT NULL,
  `simbol` char(10) NOT NULL,
  `num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `linguistic_scale`
--

INSERT INTO `linguistic_scale` (`id`, `description`, `simbol`, `num`) VALUES
(2, 'Absolutely more important', '+++', 7),
(3, 'More important', '++', 6),
(4, 'Weakly more important', '+', 5),
(5, 'Equally important', '=', 4),
(6, 'Weakly less important', '-', 3),
(7, 'Less important', '--', 2),
(8, 'Absolutely less important', '---', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `login_attempts`
--

CREATE TABLE `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `questionnaire`
--

CREATE TABLE `questionnaire` (
  `id` int(11) NOT NULL,
  `name` char(20) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL,
  `complete` bit(1) NOT NULL DEFAULT b'0',
  `dir` char(20) NOT NULL,
  `password` char(30) NOT NULL,
  `elaborated` bit(1) NOT NULL DEFAULT b'0',
  `elaboration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `questionnaire`
--

INSERT INTO `questionnaire` (`id`, `name`, `description`, `date`, `complete`, `dir`, `password`, `elaborated`, `elaboration_date`) VALUES
(144, 'test', 'test', '2015-10-29 13:32:24', b'0', 'media/test', 'test', b'1', '2017-02-18 23:03:56'),
(161, 'Europeo', 'europeo desc', '2017-02-27 23:45:13', b'0', 'media/Europeo', 'europeo', b'0', '0000-00-00 00:00:00'),
(166, 'test2', 'desc test2', '2017-03-06 12:00:05', b'1', 'media/test2', 'test2', b'0', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `questionnarie_user`
--

CREATE TABLE `questionnarie_user` (
  `id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `complete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `questionnarie_user`
--

INSERT INTO `questionnarie_user` (`id`, `quest_id`, `user_id`, `date`, `complete`) VALUES
(66, 144, 81, '2015-12-01', 1),
(67, 144, 82, '2015-12-01', 1),
(68, 144, 83, '2015-12-01', 1),
(69, 144, 84, '2015-12-01', 1),
(70, 144, 85, '2015-12-01', 1),
(71, 144, 86, '2015-12-01', 1),
(72, 144, 87, '2015-12-01', 1),
(73, 166, 95, '2017-03-06', 0),
(74, 166, 96, '2017-03-06', 0),
(75, 166, 97, '2017-03-06', 0),
(76, 166, 98, '2017-03-06', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `questions`
--

CREATE TABLE `questions` (
  `date` datetime NOT NULL,
  `id` int(11) NOT NULL,
  `questionnaire` int(11) NOT NULL,
  `cr1` int(11) NOT NULL,
  `cr2` int(11) NOT NULL,
  `description` char(150) NOT NULL,
  `description_long` char(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `questions`
--

INSERT INTO `questions` (`date`, `id`, `questionnaire`, `cr1`, `cr2`, `description`, `description_long`) VALUES
('2015-10-29 13:39:45', 44, 144, 23, 24, 'QP1', 'How important is the simplicity of the system when it is compared to aesthetic design?'),
('2015-10-29 13:39:45', 45, 144, 23, 25, 'QP2', 'How important is the simplicity of the system when it is compared to integrability with\r\nsensors and electronics?'),
('2015-10-29 13:39:45', 46, 144, 24, 25, 'QP3', 'How important is the aesthetic design of the system when it is compared to integrability\r\nwith sensors and electronics?'),
('2017-02-27 23:50:18', 93, 161, 45, 46, 'q1', 'How important is the excellence of the system when it is compared to impact?'),
('2017-02-27 23:51:14', 94, 161, 45, 47, 'q2', 'How excellence is the excellence of the system when it is compared to implementation?'),
('2017-02-27 23:51:39', 95, 161, 46, 47, 'q3', 'How important is the impact of the system when it is compared to implementation?'),
('0000-00-00 00:00:00', 253, 161, 45, 50, 'C145C250', 'How important is the <b>excellence</b> of the system when it is compared to <b>cost</b> implementation?'),
('0000-00-00 00:00:00', 255, 161, 46, 50, 'C146C250', 'How important is the <b>impact</b> of the system when it is compared to <b>cost</b> implementation?'),
('0000-00-00 00:00:00', 408, 161, 47, 50, 'C147C250', 'How important is the <b>implementation</b> of the system when it is compared to <b>cost</b> implementation?'),
('0000-00-00 00:00:00', 469, 166, 53, 54, 'C153C254', 'How important is the <b> desc cr1</b> of the system when it is compared to <b>desc cr2</b> implementation?'),
('0000-00-00 00:00:00', 471, 166, 53, 55, 'C153C255', 'How important is the <b> desc cr1</b> of the system when it is compared to <b>desc cr3</b> implementation?'),
('0000-00-00 00:00:00', 472, 166, 54, 55, 'C154C255', 'How important is the <b>desc cr2</b> of the system when it is compared to <b>desc cr3</b> implementation?');

-- --------------------------------------------------------

--
-- Struttura della tabella `question_linguistic_scale`
--

CREATE TABLE `question_linguistic_scale` (
  `id` int(11) NOT NULL,
  `questions_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `ling_scale_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `question_linguistic_scale`
--

INSERT INTO `question_linguistic_scale` (`id`, `questions_id`, `user`, `ling_scale_id`, `quest_id`) VALUES
(76, 44, 81, 6, 144),
(77, 45, 81, 5, 144),
(78, 46, 81, 4, 144),
(79, 44, 82, 4, 144),
(80, 45, 82, 6, 144),
(81, 46, 82, 7, 144),
(82, 44, 83, 4, 144),
(83, 45, 83, 6, 144),
(84, 46, 83, 7, 144),
(85, 44, 84, 3, 144),
(86, 45, 84, 5, 144),
(87, 46, 84, 6, 144),
(88, 44, 85, 4, 144),
(89, 45, 85, 4, 144),
(90, 46, 85, 6, 144),
(91, 44, 86, 4, 144),
(92, 45, 86, 6, 144),
(93, 46, 86, 6, 144),
(94, 44, 87, 4, 144),
(95, 45, 87, 6, 144),
(96, 46, 87, 6, 144),
(98, 93, 94, 2, 161),
(99, 94, 94, 2, 161),
(100, 95, 94, 2, 161),
(101, 469, 95, 3, 166),
(102, 471, 95, 3, 166),
(103, 472, 95, 3, 166),
(107, 469, 96, 7, 166),
(108, 471, 96, 5, 166),
(109, 472, 96, 3, 166),
(110, 469, 97, 2, 166),
(111, 471, 97, 3, 166),
(112, 472, 97, 4, 166),
(116, 469, 98, 4, 166),
(117, 471, 98, 5, 166),
(118, 472, 98, 6, 166);

-- --------------------------------------------------------

--
-- Struttura della tabella `results_preferences`
--

CREATE TABLE `results_preferences` (
  `id` int(11) NOT NULL,
  `criteria` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `quest_id` int(11) NOT NULL,
  `value` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `results_preferences`
--

INSERT INTO `results_preferences` (`id`, `criteria`, `date`, `quest_id`, `value`) VALUES
(180, 0, '2016-08-13 19:19:50', 0, 1),
(184, 0, '2017-02-18 23:03:55', 144, 0.37191999),
(185, 1, '2017-02-18 23:03:55', 144, 0.237380385),
(186, 2, '2017-02-18 23:03:55', 144, 0.390699595);

-- --------------------------------------------------------

--
-- Struttura della tabella `results_suitability`
--

CREATE TABLE `results_suitability` (
  `id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `criteria` int(11) NOT NULL,
  `alternative` varchar(1000) NOT NULL,
  `value` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `results_suitability`
--

INSERT INTO `results_suitability` (`id`, `quest_id`, `date`, `criteria`, `alternative`, `value`) VALUES
(1081, 144, '2017-02-18 23:03:56', 0, '0', 0.324120134),
(1082, 144, '2017-02-18 23:03:56', 0, '1', 0.25180003),
(1083, 144, '2017-02-18 23:03:56', 0, '2', 0.0693411008),
(1084, 144, '2017-02-18 23:03:56', 0, '3', 0.151545733),
(1085, 144, '2017-02-18 23:03:56', 0, '4', 0.134602696),
(1086, 144, '2017-02-18 23:03:56', 0, '5', 0.0685902238),
(1087, 144, '2017-02-18 23:03:56', 1, '0', 0.199935094),
(1088, 144, '2017-02-18 23:03:56', 1, '1', 0.263872504),
(1089, 144, '2017-02-18 23:03:56', 1, '2', 0.122180521),
(1090, 144, '2017-02-18 23:03:56', 1, '3', 0.24672851),
(1091, 144, '2017-02-18 23:03:56', 1, '4', 0.0644504204),
(1092, 144, '2017-02-18 23:03:56', 1, '5', 0.102832928),
(1093, 144, '2017-02-18 23:03:56', 2, '0', 0.212453172),
(1094, 144, '2017-02-18 23:03:56', 2, '1', 0.194464371),
(1095, 144, '2017-02-18 23:03:56', 2, '2', 0.15520294),
(1096, 144, '2017-02-18 23:03:56', 2, '3', 0.187928125),
(1097, 144, '2017-02-18 23:03:56', 2, '4', 0.135041788),
(1098, 144, '2017-02-18 23:03:56', 2, '5', 0.114909634);

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` char(30) NOT NULL,
  `role` char(20) NOT NULL COMMENT 'admin or user',
  `insert_date` datetime NOT NULL,
  `quest_id` int(11) NOT NULL,
  `salt` char(128) NOT NULL,
  `password` char(128) NOT NULL,
  `username` varchar(30) NOT NULL,
  `field_expert` int(11) DEFAULT NULL COMMENT 'economic, engineer or other',
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `role`, `insert_date`, `quest_id`, `salt`, `password`, `username`, `field_expert`, `age`) VALUES
(81, 'Test1', ' ', 'stanislaograzioso@gmail.com', '', '2015-12-01 15:13:30', 0, '', '', '', 49, 0),
(82, 'Test2', ' ', 'stanislao.grazioso@unina.it', '', '2015-12-01 16:54:45', 0, '', '', '', 49, 0),
(83, 'Test3', ' ', 'alessiobalsamo@hotmail.it', '', '2015-12-01 16:59:07', 0, '', '', '', 49, 0),
(84, 'Test4', ' ', 'man.dimaio@gmail.com', '', '2015-12-01 18:00:25', 0, '', '', '', 49, 0),
(85, 'Test5', ' ', 'man.dimaio@studenti.unina.it', '', '2015-12-01 18:03:38', 0, '', '', '', 49, 0),
(86, 'Test6', ' ', 'cdimaio1953@gmail.com', '', '2015-12-01 18:06:50', 0, '', '', '', 49, 0),
(87, 'Test7', ' ', 'crisd.didato@gmail.com', '', '2015-12-01 18:09:50', 0, '', '', '', 49, 0),
(89, 'Test8', ' ', 'Test8@gmail.com', '', '2016-08-13 18:32:03', 0, '', '', '', 49, 0),
(92, 'europeo', '', 'd@it.ir', '', '2017-02-27 17:12:33', 0, '', '', '', 1, 33),
(94, 'mat', '', 'ma@it.it', '', '2017-02-27 23:53:39', 0, '', '', '', 3, 34),
(95, 'test2 ', '', 'test2@test2.it', '', '2017-03-06 12:01:57', 0, '', '', '', 3, 32),
(96, 'test3', '', 'test3@test2.it', '', '2017-03-06 12:03:56', 0, '', '', '', 48, 33),
(97, 'test4', '', 'test@test33.it', '', '2017-03-06 12:07:04', 0, '', '', '', 4, 36),
(98, 'test6', '', 'test6@test6.it', '', '2017-03-06 12:09:30', 0, '', '', '', 63, 36);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `alternative`
--
ALTER TABLE `alternative`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_name_quest` (`name`,`questionnaire_id`),
  ADD KEY `questionnaire_id_2` (`questionnaire_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `uc_name_quest` (`quest_id`,`name`);

--
-- Indici per le tabelle `criteria_alternative`
--
ALTER TABLE `criteria_alternative`
  ADD UNIQUE KEY `id` (`id`) USING BTREE,
  ADD UNIQUE KEY `unique_index` (`alt1`,`alt2`,`questionnaire_id`,`user_id`,`cri_id`) USING BTREE,
  ADD KEY `questionnaire_id` (`questionnaire_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `alt2` (`alt2`),
  ADD KEY `alt1` (`alt1`),
  ADD KEY `cri_id` (`cri_id`),
  ADD KEY `linguistic_id` (`linguistic_id`);

--
-- Indici per le tabelle `final_score`
--
ALTER TABLE `final_score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quest_id` (`quest_id`);

--
-- Indici per le tabelle `job_cat`
--
ALTER TABLE `job_cat`
  ADD PRIMARY KEY (`job_id`);

--
-- Indici per le tabelle `linguistic_scale`
--
ALTER TABLE `linguistic_scale`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indici per le tabelle `questionnarie_user`
--
ALTER TABLE `questionnarie_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quest_id` (`quest_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_con` (`cr1`,`cr2`,`questionnaire`),
  ADD KEY `questionnaire` (`questionnaire`),
  ADD KEY `cr1` (`cr1`),
  ADD KEY `cr2` (`cr2`);

--
-- Indici per le tabelle `question_linguistic_scale`
--
ALTER TABLE `question_linguistic_scale`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_un_ql` (`questions_id`,`user`),
  ADD KEY `questions_id` (`questions_id`),
  ADD KEY `user` (`user`),
  ADD KEY `ling_scale_id` (`ling_scale_id`),
  ADD KEY `quest_id` (`quest_id`);

--
-- Indici per le tabelle `results_preferences`
--
ALTER TABLE `results_preferences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quest_id_2` (`quest_id`,`criteria`),
  ADD KEY `criteria` (`criteria`),
  ADD KEY `quest_id` (`quest_id`);

--
-- Indici per le tabelle `results_suitability`
--
ALTER TABLE `results_suitability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quest_id` (`quest_id`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `quest_id` (`quest_id`),
  ADD KEY `cat_user_idx` (`field_expert`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `alternative`
--
ALTER TABLE `alternative`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT per la tabella `criteria`
--
ALTER TABLE `criteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT per la tabella `criteria_alternative`
--
ALTER TABLE `criteria_alternative`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=615;
--
-- AUTO_INCREMENT per la tabella `final_score`
--
ALTER TABLE `final_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=367;
--
-- AUTO_INCREMENT per la tabella `job_cat`
--
ALTER TABLE `job_cat`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;
--
-- AUTO_INCREMENT per la tabella `linguistic_scale`
--
ALTER TABLE `linguistic_scale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT per la tabella `questionnaire`
--
ALTER TABLE `questionnaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;
--
-- AUTO_INCREMENT per la tabella `questionnarie_user`
--
ALTER TABLE `questionnarie_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT per la tabella `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=473;
--
-- AUTO_INCREMENT per la tabella `question_linguistic_scale`
--
ALTER TABLE `question_linguistic_scale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT per la tabella `results_preferences`
--
ALTER TABLE `results_preferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;
--
-- AUTO_INCREMENT per la tabella `results_suitability`
--
ALTER TABLE `results_suitability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1099;
--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `alternative`
--
ALTER TABLE `alternative`
  ADD CONSTRAINT `alternative_ibfk_1` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaire` (`id`);

--
-- Limiti per la tabella `criteria`
--
ALTER TABLE `criteria`
  ADD CONSTRAINT `criteria_ibfk_1` FOREIGN KEY (`quest_id`) REFERENCES `questionnaire` (`id`);

--
-- Limiti per la tabella `criteria_alternative`
--
ALTER TABLE `criteria_alternative`
  ADD CONSTRAINT `criteria_alternative_ibfk_1` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaire` (`id`),
  ADD CONSTRAINT `criteria_alternative_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `criteria_alternative_ibfk_4` FOREIGN KEY (`linguistic_id`) REFERENCES `linguistic_scale` (`id`),
  ADD CONSTRAINT `criteria_alternative_ibfk_5` FOREIGN KEY (`cri_id`) REFERENCES `criteria` (`id`),
  ADD CONSTRAINT `criteria_alternative_ibfk_6` FOREIGN KEY (`alt1`) REFERENCES `alternative` (`id`),
  ADD CONSTRAINT `criteria_alternative_ibfk_7` FOREIGN KEY (`alt2`) REFERENCES `alternative` (`id`);

--
-- Limiti per la tabella `questionnarie_user`
--
ALTER TABLE `questionnarie_user`
  ADD CONSTRAINT `questionnarie_user_ibfk_1` FOREIGN KEY (`quest_id`) REFERENCES `questionnaire` (`id`),
  ADD CONSTRAINT `questionnarie_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Limiti per la tabella `question_linguistic_scale`
--
ALTER TABLE `question_linguistic_scale`
  ADD CONSTRAINT `question_linguistic_scale_ibfk_1` FOREIGN KEY (`questions_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `question_linguistic_scale_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `question_linguistic_scale_ibfk_3` FOREIGN KEY (`ling_scale_id`) REFERENCES `linguistic_scale` (`id`),
  ADD CONSTRAINT `question_linguistic_scale_ibfk_4` FOREIGN KEY (`quest_id`) REFERENCES `questionnaire` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
