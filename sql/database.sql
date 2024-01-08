-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for etudentdatabase
CREATE DATABASE IF NOT EXISTS `etudentdatabase` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `etudentdatabase`;

-- Dumping structure for table etudentdatabase.calendrier_modules
CREATE TABLE IF NOT EXISTS `calendrier_modules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `DateExamen` date NOT NULL,
  `Houre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idModule` bigint unsigned NOT NULL,
  `AnneeUniversitaire` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `calendrier_modules_idmodule_foreign` (`idModule`),
  CONSTRAINT `calendrier_modules_idmodule_foreign` FOREIGN KEY (`idModule`) REFERENCES `modules` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=444 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etudentdatabase.calendrier_modules: ~55 rows (approximately)
INSERT IGNORE INTO `calendrier_modules` (`id`, `DateExamen`, `Houre`, `idModule`, `AnneeUniversitaire`, `created_at`, `updated_at`) VALUES
	(389, '2023-11-12', '09:00 AM - 11:00 AM', 1, '2022-2023', '2024-01-04 22:18:19', NULL),
	(390, '2023-11-13', '09:00 AM - 11:00 AM', 2, '2022-2023', '2024-01-04 22:18:20', NULL),
	(391, '2023-11-14', '09:00 AM - 11:00 AM', 3, '2022-2023', '2024-01-04 22:18:21', NULL),
	(392, '2023-11-15', '09:00 AM - 11:00 AM', 4, '2022-2023', '2024-01-04 22:18:21', NULL),
	(393, '2023-11-16', '09:00 AM - 11:00 AM', 5, '2022-2023', '2024-01-04 22:18:22', NULL),
	(394, '2023-11-17', '09:00 AM - 11:00 AM', 6, '2022-2023', '2024-01-04 22:18:23', NULL),
	(395, '2023-11-18', '09:00 AM - 11:00 AM', 7, '2022-2023', '2024-01-04 22:18:23', NULL),
	(396, '2023-11-19', '09:00 AM - 11:00 AM', 1, '2022-2023', '2024-01-04 22:18:24', NULL),
	(397, '2023-11-20', '09:00 AM - 11:00 AM', 2, '2022-2023', '2024-01-04 22:18:25', NULL),
	(398, '2023-11-21', '09:00 AM - 11:00 AM', 3, '2022-2023', '2024-01-04 22:18:26', NULL),
	(399, '2023-11-22', '09:00 AM - 11:00 AM', 4, '2022-2023', '2024-01-04 22:18:34', NULL),
	(400, '2023-11-23', '12:00 AM - 16:00 AM', 5, '2022-2023', '2024-01-04 22:18:36', NULL),
	(401, '2023-11-24', '12:00 AM - 16:00 AM', 6, '2022-2023', '2024-01-04 22:18:36', NULL),
	(402, '2023-11-25', '12:00 AM - 16:00 AM', 7, '2022-2023', '2024-01-04 22:19:35', NULL),
	(403, '2023-11-26', '12:00 AM - 16:00 AM', 43, '2022-2023', '2024-01-04 22:19:36', NULL),
	(404, '2023-11-27', '12:00 AM - 16:00 AM', 44, '2023-2024', '2024-01-04 22:19:36', NULL),
	(405, '2023-11-28', '12:00 AM - 16:00 AM', 45, '2023-2024', '2024-01-04 22:19:37', NULL),
	(406, '2023-11-29', '12:00 AM - 16:00 AM', 46, '2023-2024', '2024-01-04 22:19:38', NULL),
	(407, '2023-11-30', '12:00 AM - 16:00 AM', 47, '2023-2024', '2024-01-04 22:19:38', NULL),
	(408, '2023-12-31', '12:00 AM - 16:00 AM', 48, '2023-2024', NULL, NULL),
	(409, '2023-11-12', '12:00 AM - 16:00 AM', 28, '2023-2024', '2024-01-04 22:19:39', NULL),
	(410, '2023-11-13', '12:00 AM - 16:00 AM', 43, '2023-2024', NULL, NULL),
	(411, '2023-11-14', '12:00 AM - 16:00 AM', 44, '2023-2024', NULL, NULL),
	(412, '2023-11-15', '11:00 AM - 13:00 AM', 45, '2023-2024', NULL, NULL),
	(413, '2023-11-16', '11:00 AM - 13:00 AM', 46, '2023-2024', NULL, NULL),
	(414, '2023-11-17', '11:00 AM - 13:00 AM', 47, '2023-2024', NULL, NULL),
	(415, '2023-11-18', '11:00 AM - 13:00 AM', 48, '2023-2024', NULL, NULL),
	(416, '2023-11-19', '11:00 AM - 13:00 AM', 28, '2023-2024', NULL, NULL),
	(417, '2023-11-20', '11:00 AM - 13:00 AM', 85, '2023-2024', NULL, NULL),
	(418, '2023-11-21', '11:00 AM - 13:00 AM', 86, '2023-2024', NULL, NULL),
	(419, '2023-11-22', '11:00 AM - 13:00 AM', 87, '2023-2024', NULL, NULL),
	(420, '2023-11-23', '11:00 AM - 13:00 AM', 88, '2023-2024', NULL, NULL),
	(421, '2023-11-24', '11:00 AM - 13:00 AM', 89, '2023-2024', NULL, NULL),
	(422, '2023-11-25', '11:00 AM - 13:00 AM', 90, '2023-2024', NULL, NULL),
	(423, '2023-11-27', '11:00 AM - 13:00 AM', 85, '2023-2024', NULL, NULL),
	(424, '2023-11-28', '11:00 AM - 13:00 AM', 86, '2023-2024', NULL, NULL),
	(425, '2023-11-29', '11:00 AM - 13:00 AM', 87, '2023-2024', NULL, NULL),
	(426, '2023-11-30', '11:00 AM - 13:00 AM', 88, '2023-2024', NULL, NULL),
	(427, '2023-12-31', '11:00 AM - 13:00 AM', 89, '2023-2024', NULL, NULL),
	(428, '2023-11-12', '08:30 AM - 10:00 AM', 90, '2023-2024', NULL, NULL),
	(429, '2023-11-13', '08:30 AM - 10:00 AM', 28, '2023-2024', NULL, NULL),
	(430, '2023-11-14', '08:30 AM - 10:00 AM', 1, '2023-2024', NULL, NULL),
	(431, '2023-11-15', '08:30 AM - 10:00 AM', 2, '2023-2024', NULL, NULL),
	(432, '2023-11-16', '08:30 AM - 10:00 AM', 3, '2023-2024', NULL, NULL),
	(433, '2023-11-17', '08:30 AM - 10:00 AM', 4, '2023-2024', NULL, NULL),
	(434, '2023-11-18', '08:30 AM - 10:00 AM', 5, '2023-2024', NULL, NULL),
	(435, '2023-11-19', '08:30 AM - 10:00 AM', 6, '2023-2024', NULL, NULL),
	(436, '2023-11-20', '08:30 AM - 10:00 AM', 7, '2023-2024', NULL, NULL),
	(437, '2023-11-21', '08:30 AM - 10:00 AM', 1, '2023-2024', NULL, NULL),
	(438, '2023-11-22', '08:30 AM - 10:00 AM', 2, '2023-2024', NULL, NULL),
	(439, '2023-11-23', '08:30 AM - 10:00 AM', 3, '2023-2024', NULL, NULL),
	(440, '2023-11-24', '08:30 AM - 10:00 AM', 4, '2023-2024', NULL, NULL),
	(441, '2023-11-25', '08:30 AM - 10:00 AM', 5, '2023-2024', NULL, NULL),
	(442, '2023-11-26', '08:30 AM - 10:00 AM', 6, '2023-2024', NULL, NULL),
	(443, '2023-11-27', '08:30 AM - 10:00 AM', 7, '2023-2024', NULL, NULL);

-- Dumping structure for table etudentdatabase.calendrier_module_groupes
CREATE TABLE IF NOT EXISTS `calendrier_module_groupes` (
  `idCmodule` bigint unsigned NOT NULL,
  `idGroupe` bigint unsigned NOT NULL,
  PRIMARY KEY (`idCmodule`,`idGroupe`),
  KEY `calendrier_module_groupes_idgroupe_foreign` (`idGroupe`),
  CONSTRAINT `calendrier_module_groupes_idcmodule_foreign` FOREIGN KEY (`idCmodule`) REFERENCES `calendrier_modules` (`id`),
  CONSTRAINT `calendrier_module_groupes_idgroupe_foreign` FOREIGN KEY (`idGroupe`) REFERENCES `groupes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etudentdatabase.calendrier_module_groupes: ~5 rows (approximately)
INSERT IGNORE INTO `calendrier_module_groupes` (`idCmodule`, `idGroupe`) VALUES
	(428, 22),
	(433, 33),
	(439, 33),
	(436, 37),
	(438, 38);

-- Dumping structure for table etudentdatabase.detail_modules
CREATE TABLE IF NOT EXISTS `detail_modules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idModule` bigint unsigned NOT NULL,
  `idEtudiant` bigint unsigned NOT NULL,
  `etat` enum('I','NI') COLLATE utf8mb4_unicode_ci NOT NULL,
  `SESSION` enum('ORD','RAT') COLLATE utf8mb4_unicode_ci NOT NULL,
  `part_Semester` int NOT NULL,
  `AnneeUniversitaire` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_modules_idmodule_foreign` (`idModule`),
  KEY `detail_modules_idetudiant_foreign` (`idEtudiant`),
  CONSTRAINT `detail_modules_idetudiant_foreign` FOREIGN KEY (`idEtudiant`) REFERENCES `etudiants` (`id`),
  CONSTRAINT `detail_modules_idmodule_foreign` FOREIGN KEY (`idModule`) REFERENCES `modules` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=755 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etudentdatabase.detail_modules: ~106 rows (approximately)
INSERT IGNORE INTO `detail_modules` (`id`, `idModule`, `idEtudiant`, `etat`, `SESSION`, `part_Semester`, `AnneeUniversitaire`, `created_at`, `updated_at`) VALUES
	(649, 1, 1, 'I', 'ORD', 1, '2021-2022', NULL, NULL),
	(650, 2, 1, 'I', 'ORD', 1, '2021-2022', NULL, NULL),
	(651, 3, 1, 'I', 'ORD', 1, '2021-2022', NULL, NULL),
	(652, 4, 1, 'I', 'ORD', 1, '2021-2022', NULL, NULL),
	(653, 5, 1, 'I', 'ORD', 1, '2021-2022', NULL, NULL),
	(654, 6, 1, 'I', 'ORD', 1, '2021-2022', NULL, NULL),
	(655, 7, 1, 'I', 'ORD', 1, '2021-2022', NULL, NULL),
	(656, 1, 1, 'I', 'RAT', 1, '2021-2022', NULL, NULL),
	(657, 2, 1, 'I', 'RAT', 1, '2021-2022', NULL, NULL),
	(658, 3, 1, 'I', 'RAT', 1, '2021-2022', NULL, NULL),
	(659, 4, 1, 'I', 'RAT', 1, '2021-2022', NULL, NULL),
	(660, 5, 1, 'NI', 'RAT', 1, '2021-2022', NULL, NULL),
	(661, 6, 1, 'I', 'RAT', 1, '2021-2022', NULL, NULL),
	(662, 7, 1, 'I', 'RAT', 1, '2021-2022', NULL, NULL),
	(663, 43, 1, 'I', 'ORD', 1, '2021-2022', NULL, NULL),
	(664, 44, 1, 'I', 'ORD', 1, '2021-2022', NULL, NULL),
	(665, 45, 1, 'I', 'ORD', 1, '2021-2022', NULL, NULL),
	(666, 46, 1, 'I', 'ORD', 1, '2021-2022', NULL, NULL),
	(667, 47, 1, 'I', 'ORD', 1, '2021-2022', NULL, NULL),
	(668, 48, 1, 'I', 'ORD', 1, '2021-2022', NULL, NULL),
	(669, 43, 1, 'I', 'RAT', 1, '2021-2022', NULL, NULL),
	(670, 44, 1, 'NI', 'RAT', 1, '2021-2022', NULL, NULL),
	(671, 45, 1, 'I', 'RAT', 1, '2021-2022', NULL, NULL),
	(672, 46, 1, 'I', 'RAT', 1, '2021-2022', NULL, NULL),
	(673, 47, 1, 'I', 'RAT', 1, '2021-2022', NULL, NULL),
	(674, 48, 1, 'I', 'RAT', 1, '2021-2022', NULL, NULL),
	(675, 1, 1, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(676, 2, 1, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(677, 3, 1, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(678, 4, 1, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(679, 5, 1, 'NI', 'ORD', 1, '2022-2023', NULL, NULL),
	(680, 6, 1, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(681, 7, 1, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(682, 1, 1, 'I', 'RAT', 1, '2022-2023', NULL, NULL),
	(683, 2, 1, 'NI', 'RAT', 1, '2022-2023', NULL, NULL),
	(684, 3, 1, 'I', 'RAT', 1, '2022-2023', NULL, NULL),
	(685, 4, 1, 'NI', 'RAT', 1, '2022-2023', NULL, NULL),
	(686, 5, 1, 'NI', 'RAT', 1, '2022-2023', NULL, NULL),
	(687, 6, 1, 'I', 'RAT', 1, '2022-2023', NULL, NULL),
	(688, 7, 1, 'I', 'RAT', 1, '2022-2023', NULL, NULL),
	(689, 43, 1, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(690, 44, 1, 'NI', 'ORD', 1, '2022-2023', NULL, NULL),
	(691, 45, 1, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(692, 46, 1, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(693, 47, 1, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(694, 48, 1, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(695, 43, 1, 'I', 'RAT', 1, '2022-2023', NULL, NULL),
	(696, 44, 1, 'NI', 'RAT', 1, '2022-2023', NULL, NULL),
	(697, 45, 1, 'I', 'RAT', 1, '2022-2023', NULL, NULL),
	(698, 46, 1, 'NI', 'RAT', 1, '2022-2023', NULL, NULL),
	(699, 47, 1, 'NI', 'RAT', 1, '2022-2023', NULL, NULL),
	(700, 48, 1, 'I', 'RAT', 1, '2022-2023', NULL, NULL),
	(701, 22, 1, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(702, 23, 1, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(703, 24, 1, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(704, 25, 1, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(705, 26, 1, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(706, 27, 1, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(707, 28, 1, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(708, 22, 1, 'I', 'RAT', 1, '2022-2023', NULL, NULL),
	(709, 23, 1, 'I', 'RAT', 1, '2022-2023', NULL, NULL),
	(710, 24, 1, 'I', 'RAT', 1, '2022-2023', NULL, NULL),
	(711, 25, 1, 'I', 'RAT', 1, '2022-2023', NULL, NULL),
	(712, 26, 1, 'I', 'RAT', 1, '2022-2023', NULL, NULL),
	(713, 27, 1, 'I', 'RAT', 1, '2022-2023', NULL, NULL),
	(714, 28, 1, 'NI', 'RAT', 1, '2022-2023', NULL, NULL),
	(715, 1, 6, 'I', 'ORD', 1, '2021-2022', NULL, NULL),
	(716, 2, 6, 'I', 'ORD', 1, '2021-2022', NULL, NULL),
	(717, 3, 6, 'I', 'ORD', 1, '2021-2022', NULL, NULL),
	(718, 4, 6, 'I', 'ORD', 1, '2021-2022', NULL, NULL),
	(719, 5, 6, 'I', 'ORD', 1, '2021-2022', NULL, NULL),
	(720, 6, 6, 'I', 'ORD', 1, '2021-2022', NULL, NULL),
	(721, 7, 6, 'I', 'ORD', 1, '2021-2022', NULL, NULL),
	(722, 1, 6, 'I', 'RAT', 1, '2021-2022', NULL, NULL),
	(723, 2, 6, 'I', 'RAT', 1, '2021-2022', NULL, NULL),
	(724, 3, 6, 'NI', 'RAT', 1, '2021-2022', NULL, NULL),
	(725, 4, 6, 'I', 'RAT', 1, '2021-2022', NULL, NULL),
	(726, 5, 6, 'NI', 'RAT', 1, '2021-2022', NULL, NULL),
	(727, 6, 6, 'I', 'RAT', 1, '2021-2022', NULL, NULL),
	(728, 7, 6, 'I', 'RAT', 1, '2021-2022', NULL, NULL),
	(729, 1, 6, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(730, 2, 6, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(731, 3, 6, 'NI', 'ORD', 1, '2022-2023', NULL, NULL),
	(732, 4, 6, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(733, 5, 6, 'NI', 'ORD', 1, '2022-2023', NULL, NULL),
	(734, 6, 6, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(735, 7, 6, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(736, 1, 6, 'I', 'RAT', 1, '2022-2023', NULL, NULL),
	(737, 2, 6, 'NI', 'RAT', 1, '2022-2023', NULL, NULL),
	(738, 3, 6, 'NI', 'RAT', 1, '2022-2023', NULL, NULL),
	(739, 4, 6, 'NI', 'RAT', 1, '2022-2023', NULL, NULL),
	(740, 5, 6, 'NI', 'RAT', 1, '2022-2023', NULL, NULL),
	(741, 6, 6, 'I', 'RAT', 1, '2022-2023', NULL, NULL),
	(742, 7, 6, 'I', 'RAT', 1, '2022-2023', NULL, NULL),
	(743, 43, 6, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(744, 44, 6, 'NI', 'ORD', 1, '2022-2023', NULL, NULL),
	(745, 45, 6, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(746, 46, 6, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(747, 47, 6, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(748, 48, 6, 'I', 'ORD', 1, '2022-2023', NULL, NULL),
	(749, 43, 6, 'I', 'RAT', 1, '2022-2023', NULL, NULL),
	(750, 44, 6, 'NI', 'RAT', 1, '2022-2023', NULL, NULL),
	(751, 45, 6, 'I', 'RAT', 1, '2022-2023', NULL, NULL),
	(752, 46, 6, 'NI', 'RAT', 1, '2022-2023', NULL, NULL),
	(753, 47, 6, 'NI', 'RAT', 1, '2022-2023', NULL, NULL),
	(754, 48, 6, 'I', 'RAT', 1, '2022-2023', NULL, NULL);

-- Dumping structure for table etudentdatabase.etudiants
CREATE TABLE IF NOT EXISTS `etudiants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `CodeApogee` int NOT NULL,
  `Nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DateNaiss` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `etudiants_codeapogee_unique` (`CodeApogee`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etudentdatabase.etudiants: ~8 rows (approximately)
INSERT IGNORE INTO `etudiants` (`id`, `CodeApogee`, `Nom`, `Prenom`, `DateNaiss`, `created_at`, `updated_at`) VALUES
	(1, 2209161, 'AABID', 'FATIMA ZAHRA', '2004-08-02', '2024-01-03 00:47:30', '2024-01-03 00:47:31'),
	(2, 2108864, 'AACHIR', 'HABIBA', '2002-11-05', '2024-01-03 00:47:32', '2024-01-03 00:47:32'),
	(3, 1802210, 'AADLANI', 'HAJAR', '2000-08-10', '2024-01-03 00:47:39', '2024-01-03 00:47:33'),
	(4, 2209383, 'AAJAJ', 'OUSSAMA', '2004-06-01', '2024-01-03 00:47:38', '2024-01-03 00:47:34'),
	(5, 2115415, 'AALEUI', 'ISMAIL', '2003-10-05', '2024-01-03 00:47:38', '2024-01-03 00:47:34'),
	(6, 8007352, 'AAMROUCHE', 'SARA', '1987-09-12', '2024-01-03 00:47:37', '2024-01-03 00:47:35'),
	(7, 2209215, 'AAOUINA', 'OMAIMA', '2002-12-20', '2024-01-03 00:47:37', '2024-01-03 00:47:35'),
	(8, 2104790, 'AABDOUN', 'FATIMA', '2001-03-13', '2024-01-03 00:47:36', '2024-01-03 00:47:36');

-- Dumping structure for table etudentdatabase.etudiants_filieres
CREATE TABLE IF NOT EXISTS `etudiants_filieres` (
  `idEtudiant` bigint unsigned NOT NULL,
  `idFiliere` bigint unsigned NOT NULL,
  PRIMARY KEY (`idEtudiant`,`idFiliere`),
  KEY `etudiants_filieres_idfiliere_foreign` (`idFiliere`),
  CONSTRAINT `etudiants_filieres_idetudiant_foreign` FOREIGN KEY (`idEtudiant`) REFERENCES `etudiants` (`id`),
  CONSTRAINT `etudiants_filieres_idfiliere_foreign` FOREIGN KEY (`idFiliere`) REFERENCES `filieres` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etudentdatabase.etudiants_filieres: ~8 rows (approximately)
INSERT IGNORE INTO `etudiants_filieres` (`idEtudiant`, `idFiliere`) VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 4),
	(5, 5),
	(6, 6),
	(7, 7),
	(8, 8);

-- Dumping structure for table etudentdatabase.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etudentdatabase.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table etudentdatabase.filieres
CREATE TABLE IF NOT EXISTS `filieres` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `CodeFiliere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NomFiliere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Parcours` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `filieres_codefiliere_unique` (`CodeFiliere`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etudentdatabase.filieres: ~9 rows (approximately)
INSERT IGNORE INTO `filieres` (`id`, `CodeFiliere`, `NomFiliere`, `Parcours`, `created_at`, `updated_at`) VALUES
	(1, 'DFB', 'DROIT EN FRACAIS', 'Droit Public EN FRACAIS', NULL, NULL),
	(2, 'DFP', 'DROIT EN FRACAIS', 'Droit Privé EN FRACAIS', NULL, NULL),
	(3, 'G', 'Sciences économiques et gestion', 'Gestion', NULL, NULL),
	(4, 'EG', 'Sciences économiques et gestion', 'Economie et Gestion', NULL, NULL),
	(5, 'DAB', 'DROIT EN ARABE', 'Droit Public EN ARABE', NULL, NULL),
	(6, 'DAP', 'DROIT EN ARABE', 'Droit Privé EN ARABE', NULL, NULL),
	(7, 'DF', 'DROIT EN FRACAIS', '', NULL, NULL),
	(8, 'DA', 'DROIT EN ARABE', '', NULL, NULL),
	(9, 'SEG', 'Sciences économiqueset gestion', '', NULL, NULL);

-- Dumping structure for table etudentdatabase.groupes
CREATE TABLE IF NOT EXISTS `groupes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomGroupe` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `Semester` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etudentdatabase.groupes: ~20 rows (approximately)
INSERT IGNORE INTO `groupes` (`id`, `nomGroupe`, `Semester`, `created_at`, `updated_at`) VALUES
	(19, '05', 's5', '2024-01-03 01:23:29', NULL),
	(20, '04', 's5', '2024-01-03 01:23:31', NULL),
	(21, '03', 's5', '2024-01-03 01:23:31', NULL),
	(22, '02', 's5', '2024-01-03 01:23:31', NULL),
	(23, '01', 's5', '2024-01-03 01:23:32', NULL),
	(24, '_01', 's5', '2024-01-03 01:23:32', NULL),
	(25, '02', 's3', '2024-01-03 01:23:33', NULL),
	(26, '03', 's3', '2024-01-03 01:23:40', NULL),
	(27, '04', 's3', '2024-01-03 01:23:40', NULL),
	(28, '_05', 's3', '2024-01-03 01:23:39', NULL),
	(29, '06', 's3', '2024-01-03 01:23:39', NULL),
	(30, '07', 's5', '2024-01-03 01:23:38', NULL),
	(31, '08', 's5', '2024-01-03 01:23:38', NULL),
	(32, '09', 's5', '2024-01-03 01:23:37', NULL),
	(33, '0', 's1', '2024-01-03 01:23:37', NULL),
	(34, '0', 's3', '2024-01-03 01:23:34', NULL),
	(35, '0', 's5', '2024-01-03 01:23:36', NULL),
	(36, '10', 's5', '2024-01-03 01:23:35', NULL),
	(37, '0', 's2', '2024-01-03 01:23:36', NULL),
	(38, '0', 's1', '2024-01-04 21:39:57', NULL);

-- Dumping structure for table etudentdatabase.groupe_etudiant
CREATE TABLE IF NOT EXISTS `groupe_etudiant` (
  `idEtudiant` bigint unsigned NOT NULL,
  `idGroupe` bigint unsigned NOT NULL,
  PRIMARY KEY (`idEtudiant`,`idGroupe`),
  KEY `groupe_etudiant_idgroupe_foreign` (`idGroupe`),
  CONSTRAINT `groupe_etudiant_idetudiant_foreign` FOREIGN KEY (`idEtudiant`) REFERENCES `etudiants` (`id`),
  CONSTRAINT `groupe_etudiant_idgroupe_foreign` FOREIGN KEY (`idGroupe`) REFERENCES `groupes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etudentdatabase.groupe_etudiant: ~7 rows (approximately)
INSERT IGNORE INTO `groupe_etudiant` (`idEtudiant`, `idGroupe`) VALUES
	(1, 19),
	(1, 28),
	(6, 28),
	(1, 33),
	(6, 33),
	(1, 37),
	(6, 37);

-- Dumping structure for table etudentdatabase.info_exames
CREATE TABLE IF NOT EXISTS `info_exames` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `NumeroExamen` int NOT NULL,
  `Semester` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `AnneeUniversitaire` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Lieu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idEtudiant` bigint unsigned NOT NULL,
  `idGroupe` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `info_exames_idetudiant_foreign` (`idEtudiant`),
  KEY `info_exames_idgroupe_foreign` (`idGroupe`),
  CONSTRAINT `info_exames_idetudiant_foreign` FOREIGN KEY (`idEtudiant`) REFERENCES `etudiants` (`id`),
  CONSTRAINT `info_exames_idgroupe_foreign` FOREIGN KEY (`idGroupe`) REFERENCES `groupes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etudentdatabase.info_exames: ~8 rows (approximately)
INSERT IGNORE INTO `info_exames` (`id`, `NumeroExamen`, `Semester`, `AnneeUniversitaire`, `Lieu`, `idEtudiant`, `idGroupe`, `created_at`, `updated_at`) VALUES
	(17, 2, 'S1', '2022-2023', 'AMPHI 3', 1, 38, '2024-01-04 21:56:06', NULL),
	(18, 12, 'S3', '2022-2023', 'AMPHI 7', 1, 26, '2024-01-04 21:56:07', NULL),
	(19, 5, 'S2', '2022-2023', 'IBEN KHALDOUN', 1, 30, '2024-01-04 21:56:08', NULL),
	(20, 14, 'S1', '2022-2023', 'ANNEXE 1', 6, 38, '2024-01-04 21:56:09', NULL),
	(21, 5, 'S3', '2022-2023', 'AMPHI 7', 6, 26, '2024-01-04 21:56:09', NULL),
	(22, 2, 'S1', '2022-2023', 'AMPHI 3', 1, 38, '2024-01-04 21:56:10', NULL),
	(23, 16, 'S3', '2021-2022', 'AMPHI 1', 1, 26, '2024-01-04 21:56:11', NULL),
	(24, 7, 'S1', '2021-2022', 'IBEN KHALDOUN', 6, 38, '2024-01-04 21:56:12', NULL);

-- Dumping structure for table etudentdatabase.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etudentdatabase.migrations: ~16 rows (approximately)
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1),
	(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(6, '2024_01_03_001752_create_sessions_table', 1),
	(7, '2024_01_03_002013_create_filieres_table', 2),
	(8, '2024_01_03_002207_create_etudiants_table', 2),
	(9, '2024_01_03_002213_create_etudiant_filieres_table', 2),
	(10, '2024_01_03_002220_create_modules_table', 2),
	(11, '2024_01_03_002227_create_detail_modules_table', 2),
	(12, '2024_01_03_002233_create_groupes_table', 2),
	(13, '2024_01_03_002240_create_groupe_etudiants_table', 2),
	(14, '2024_01_03_002246_create_info_exames_table', 2),
	(15, '2024_01_03_002253_create_calendrier_modules_table', 2),
	(16, '2024_01_03_002259_create_calendrier_module_groupes_table', 2);

-- Dumping structure for table etudentdatabase.modules
CREATE TABLE IF NOT EXISTS `modules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `CodeModule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NomModule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Semester` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idFiliere` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `modules_codemodule_nommodule_unique` (`CodeModule`,`NomModule`),
  KEY `modules_idfiliere_foreign` (`idFiliere`),
  CONSTRAINT `modules_idfiliere_foreign` FOREIGN KEY (`idFiliere`) REFERENCES `filieres` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etudentdatabase.modules: ~150 rows (approximately)
INSERT IGNORE INTO `modules` (`id`, `CodeModule`, `NomModule`, `Semester`, `idFiliere`, `created_at`, `updated_at`) VALUES
	(1, 'DFS1M1', 'Introduction aux sciences juridiques', 'S1', 7, NULL, NULL),
	(2, 'DFS1M2', 'Introduction au droit musulman', 'S1', 7, NULL, NULL),
	(3, 'DFS1M3', 'Introduction à la science politique', 'S1', 7, NULL, NULL),
	(4, 'DFS1M4', 'Introduction aux relations internationales', 'S1', 7, NULL, NULL),
	(5, 'DFS1M5', 'Méthodes des sciences sociales', 'S1', 7, NULL, NULL),
	(6, 'DFS1M6', 'Introduction aux sciences économiques ', 'S1', 7, NULL, NULL),
	(7, 'DFS1M7', 'Langue et terminologie I', 'S1', 7, NULL, NULL),
	(8, 'DAS1M1', 'Introduction aux sciences juridiques', 'S1', 8, NULL, NULL),
	(9, 'DAS1M2', 'Introduction au droit musulman', 'S1', 8, NULL, NULL),
	(10, 'DAS1M3', 'Introduction à la science politique', 'S1', 8, NULL, NULL),
	(11, 'DAS1M4', 'Introduction aux relations internationales', 'S1', 8, NULL, NULL),
	(12, 'DAS1M5', 'Méthodes des sciences sociales', 'S1', 8, NULL, NULL),
	(13, 'DAS1M6', 'Introduction aux sciences économiques ', 'S1', 8, NULL, NULL),
	(14, 'DAS1M7', 'Langue et terminologie I', 'S1', 8, NULL, NULL),
	(15, 'SEGS1M1', 'Introduction à l’économie', 'S1', 9, NULL, NULL),
	(16, 'SEGS1M2', 'Microéconomie 1', 'S1', 9, NULL, NULL),
	(17, 'SEGS1M3', 'Comptabilité générale 1', 'S1', 9, NULL, NULL),
	(18, 'SEGS1M4', 'Management 1', 'S1', 9, NULL, NULL),
	(19, 'SEGS1M5', 'Statistique descriptive', 'S1', 9, NULL, NULL),
	(20, 'SEGS1M6', 'Analyse mathématique', 'S1', 9, NULL, NULL),
	(21, 'SEGS1M7', 'Terminologie', 'S1', 9, NULL, NULL),
	(22, 'DFS2M1', 'Théorie générale et des obligations', 'S2', 7, NULL, NULL),
	(23, 'DFS2M2', 'Droit commercial', 'S2', 7, NULL, NULL),
	(24, 'DFS2M3', 'Théorie générale du droit constitutionnel', 'S2', 7, NULL, NULL),
	(25, 'DFS2M4', 'Droit pénal général', 'S2', 7, NULL, NULL),
	(26, 'DFS2M5', 'Organisation fdministrative', 'S2', 7, NULL, NULL),
	(27, 'DFS2M6', 'Droit international public', 'S2', 7, NULL, NULL),
	(28, 'DFS2M7', 'Langue et terminologie 2', 'S2', 7, NULL, NULL),
	(29, 'DAS2M1', 'Théorie générale et des obligations', 'S2', 8, NULL, NULL),
	(30, 'DAS2M2', 'Droit commercial', 'S2', 8, NULL, NULL),
	(31, 'DAS2M3', 'Théorie générale du droit constitutionnel', 'S2', 8, NULL, NULL),
	(32, 'DAS2M4', 'Droit pénal général', 'S2', 8, NULL, NULL),
	(33, 'DAS2M5', 'Organisation fdministrative', 'S2', 8, NULL, NULL),
	(34, 'DAS2M6', 'Droit international public', 'S2', 8, NULL, NULL),
	(35, 'DAS2M7', 'Langue et terminologie 2', 'S2', 8, NULL, NULL),
	(36, 'SEGS2M1', 'Macroéconomie', 'S2', 9, NULL, NULL),
	(37, 'SEGS2M2', 'Microéconomie 2', 'S2', 9, NULL, NULL),
	(38, 'SEGS2M3', 'Comptabilité générale 2', 'S2', 9, NULL, NULL),
	(39, 'SEGS2M4', 'Management 2', 'S2', 9, NULL, NULL),
	(40, 'SEGS2M5', 'Probabilité', 'S2', 9, NULL, NULL),
	(41, 'SEGS2M6', 'Algèbre ET Math financières', 'S2', 9, NULL, NULL),
	(42, 'SEGS2M7', 'Terminologie', 'S2', 9, NULL, NULL),
	(43, 'DFS3M1', 'Droit budgétaire', 'S3', 7, NULL, NULL),
	(44, 'DFS3M2', 'Droit social', 'S3', 7, NULL, NULL),
	(45, 'DFS3M3', 'Régimes constitutionnels comparés', 'S3', 7, NULL, NULL),
	(46, 'DFS3M4', 'L\'action administrative', 'S3', 7, NULL, NULL),
	(47, 'DFS3M5', 'Responsabilité civile', 'S3', 7, NULL, NULL),
	(48, 'DFS3M6', 'Droit de la famille', 'S3', 7, NULL, NULL),
	(49, 'DAS3M1', 'Droit budgétaire', 'S3', 8, NULL, NULL),
	(50, 'DAS3M2', 'Droit social', 'S3', 8, NULL, NULL),
	(51, 'DAS3M3', 'Régimes constitutionnels comparés', 'S3', 8, NULL, NULL),
	(52, 'DAS3M4', 'L\'action administrative', 'S3', 8, NULL, NULL),
	(53, 'DAS3M5', 'Responsabilité civile', 'S3', 8, NULL, NULL),
	(54, 'DAS3M6', 'Droit de la famille', 'S3', 8, NULL, NULL),
	(55, 'SEGS3M1', 'Economie monétaire et financière', 'S3', 9, NULL, NULL),
	(56, 'SEGS3M2', 'Problèmes économiques et sociaux', 'S3', 9, NULL, NULL),
	(57, 'SEGS3M3', 'Comptabilité analytique', 'S3', 9, NULL, NULL),
	(58, 'SEGS3M4', 'Marketing de base', 'S3', 9, NULL, NULL),
	(59, 'SEGS3M5', 'Echantillonnage et estimation', 'S3', 9, NULL, NULL),
	(60, 'SEGS3M6', 'Introduction à l’étude du droit', 'S3', 9, NULL, NULL),
	(61, 'DFS4M1', 'Droit des sociétés', 'S4', 7, NULL, NULL),
	(62, 'DFS4M2', 'Organisationjudiciaire', 'S4', 7, NULL, NULL),
	(63, 'DFS4M3', 'Droits de l’homme et libertés publiques', 'S4', 7, NULL, NULL),
	(64, 'DFS4M4', 'Droit pénalspécial', 'S4', 7, NULL, NULL),
	(65, 'DFS4M5', 'Droit fiscal', 'S4', 7, NULL, NULL),
	(66, 'DFS4M6', 'Instruments de paiement et de crédit', 'S4', 7, NULL, NULL),
	(67, 'DAS4M1', 'Droit des sociétés', 'S4', 8, NULL, NULL),
	(68, 'DAS4M2', 'Organisationjudiciaire', 'S4', 8, NULL, NULL),
	(69, 'DAS4M3', 'Droits de l’homme et libertés publiques', 'S4', 8, NULL, NULL),
	(70, 'DAS4M4', 'Droit pénalspécial', 'S4', 8, NULL, NULL),
	(71, 'DAS4M5', 'Droit fiscal', 'S4', 8, NULL, NULL),
	(72, 'DAS4M6', 'Instruments de paiement et de crédit', 'S4', 8, NULL, NULL),
	(73, 'SEGS4M1', 'Economie monétaire et financière 2', 'S4', 9, NULL, NULL),
	(74, 'SEGS4M2', 'Comptabilité des sociétés', 'S4', 9, NULL, NULL),
	(75, 'SEGS4M3', 'Finances publiques', 'S4', 9, NULL, NULL),
	(76, 'SEGS4M4', 'Informatique de gestion', 'S4', 9, NULL, NULL),
	(77, 'SEGS4M5', 'Analyse financière', 'S4', 9, NULL, NULL),
	(78, 'SEGS4M6', 'Droit commercial et des sociétés', 'S4', 9, NULL, NULL),
	(79, 'DFBS5M1', 'Administration territoriale', 'S5', 1, NULL, NULL),
	(80, 'DFBS5M2', 'Politiques publiques', 'S5', 1, NULL, NULL),
	(81, 'DFBS5M3', 'Droit économique international', 'S5', 1, NULL, NULL),
	(82, 'DFBS5M4', 'Grands services Publics', 'S5', 1, NULL, NULL),
	(83, 'DFBS5M5', 'Histoires des idées politiques', 'S5', 1, NULL, NULL),
	(84, 'DFBS5M6', 'Finances Locales', 'S5', 1, NULL, NULL),
	(85, 'DFPS5M1', 'Droit foncier et droit réel', 'S5', 2, NULL, NULL),
	(86, 'DFPS5M2', 'Droit international privé', 'S5', 2, NULL, NULL),
	(87, 'DFPS5M3', 'Droit des assurances', 'S5', 2, NULL, NULL),
	(88, 'DFPS5M4', 'criminologie', 'S5', 2, NULL, NULL),
	(89, 'DFPS5M5', 'Contrats spéciaux', 'S5', 2, NULL, NULL),
	(90, 'DFPS5M6', 'Entreprise en difficulté', 'S5', 2, NULL, NULL),
	(91, 'DABS5M1', 'Droit international humanitaire', 'S5', 5, NULL, NULL),
	(92, 'DABS5M2', 'Droit des marchés publics', 'S5', 5, NULL, NULL),
	(93, 'DABS5M3', 'Contentieuxadministratif', 'S5', 5, NULL, NULL),
	(94, 'DABS5M4', 'Histoire des idéespolitiques 2', 'S5', 5, NULL, NULL),
	(95, 'DABS5M5', 'Les organizationsinternationals', 'S5', 5, NULL, NULL),
	(96, 'DABS5M6', 'Projet de fin d’études', 'S5', 5, NULL, NULL),
	(97, 'DAPS5M1', 'Droit foncier et droit réel', 'S5', 6, NULL, NULL),
	(98, 'DAPS5M2', 'Droit international privé', 'S5', 6, NULL, NULL),
	(99, 'DAPS5M3', 'Droit des assurances', 'S5', 6, NULL, NULL),
	(100, 'DAPS5M4', 'criminologie', 'S5', 6, NULL, NULL),
	(101, 'DAPS5M5', 'Contrats spéciaux', 'S5', 6, NULL, NULL),
	(102, 'DAPS5M6', 'Entreprise en difficulté', 'S5', 6, NULL, NULL),
	(103, 'GS5M1', 'Fiscalité d’entreprise', 'S5', 3, NULL, NULL),
	(104, 'GS5M2', 'Gestion financière', 'S5', 3, NULL, NULL),
	(105, 'GS5M3', 'Marketing Approfondi', 'S5', 3, NULL, NULL),
	(106, 'GS5M4', 'Gestion des ressources humaines', 'S5', 3, NULL, NULL),
	(107, 'GS5M5', 'Droit des affaires', 'S5', 3, NULL, NULL),
	(108, 'GS5M6', 'Recherche opérationnelle ET Informatique de gestion', 'S5', 3, NULL, NULL),
	(109, 'EGS5M1', 'Histoire de la pensée économique', 'S5', 4, NULL, NULL),
	(110, 'EGS5M2', 'Politique économique', 'S5', 4, NULL, NULL),
	(111, 'EGS5M3', 'Comptabilité nationale 1', 'S5', 4, NULL, NULL),
	(112, 'EGS5M4', 'Gestion financière', 'S5', 4, NULL, NULL),
	(113, 'EGS5M5', 'Gestion des ressources humaines', 'S5', 4, NULL, NULL),
	(114, 'EGS5M6', 'Fiscalité', 'S5', 4, NULL, NULL),
	(115, 'DFBS6M1', 'Histoire des idées politiques  2', 'S6', 1, NULL, NULL),
	(116, 'DFBS6M2', 'Droit des marchés publics', 'S6', 1, NULL, NULL),
	(117, 'DFBS6M3', 'Droit international humanitaire', 'S6', 1, NULL, NULL),
	(118, 'DFBS6M4', 'Les organisations internationales', 'S6', 1, NULL, NULL),
	(119, 'DFBS6M5', 'Contentieux fdministratif', 'S6', 1, NULL, NULL),
	(120, 'DFBS6M6', 'Projet de fin d’études', 'S6', 1, NULL, NULL),
	(121, 'DFPS6M1', 'Procédurecivile', 'S6', 2, NULL, NULL),
	(122, 'DFPS6M2', 'Procédurepénale', 'S6', 2, NULL, NULL),
	(123, 'DFPS6M3', 'Successions et Droits financiers', 'S6', 2, NULL, NULL),
	(124, 'DFPS6M4', 'Propriétéintellectuelle', 'S6', 2, NULL, NULL),
	(125, 'DFPS6M5', 'Droit bancaire', 'S6', 2, NULL, NULL),
	(126, 'DFPS6M6', 'Projet de fin d’études', 'S6', 2, NULL, NULL),
	(127, 'DABS6M1', 'Histoire des idées politiques  2', 'S6', 5, NULL, NULL),
	(128, 'DABS6M2', 'Droit des marchés publics', 'S6', 5, NULL, NULL),
	(129, 'DABS6M3', 'Droit international humanitaire', 'S6', 5, NULL, NULL),
	(130, 'DABS6M4', 'Les organisations internationales', 'S6', 5, NULL, NULL),
	(131, 'DABS6M5', 'Contentieux fdministratif', 'S6', 5, NULL, NULL),
	(132, 'DABS6M6', 'Projet de fin d’études', 'S6', 5, NULL, NULL),
	(133, 'DAPS6M1', 'Droit international humanitaire', 'S6', 6, NULL, NULL),
	(134, 'DAPS6M2', 'Droit des marchés publics', 'S6', 6, NULL, NULL),
	(135, 'DAPS6M3', 'Contentieuxadministratif', 'S6', 6, NULL, NULL),
	(136, 'DAPS6M4', 'Histoire des idéespolitiques 2', 'S6', 6, NULL, NULL),
	(137, 'DAPS6M5', 'Les organizationsinternationals', 'S6', 6, NULL, NULL),
	(138, 'DAPS6M6', 'Projet de fin d’études', 'S6', 6, NULL, NULL),
	(139, 'GS6M1', 'Audit général', 'S6', 3, NULL, NULL),
	(140, 'GS6M2', 'Contrôle de gestion', 'S6', 3, NULL, NULL),
	(141, 'GS6M3', 'Management stratégique', 'S6', 3, NULL, NULL),
	(142, 'GS6M4', 'Stratégies industrielles', 'S6', 3, NULL, NULL),
	(143, 'GS6M5', 'Projet de fin d’études', 'S6', 3, NULL, NULL),
	(144, 'GS6M6', 'Projet de fin d’études', 'S6', 3, NULL, NULL),
	(145, 'EGS6M1', 'Relations économiques internationales', 'S6', 4, NULL, NULL),
	(146, 'EGS6M2', 'Méthodes économétriques ET Recherche opérationnelle', 'S6', 4, NULL, NULL),
	(147, 'EGS6M3', 'Informatique appliquée', 'S6', 4, NULL, NULL),
	(148, 'EGS6M4', 'Contrôle de gestion', 'S6', 4, NULL, NULL),
	(149, 'EGS6M5', 'Projet de fin d’études', 'S6', 4, NULL, NULL),
	(150, 'EGS6M6', 'Projet de fin d’études', 'S6', 4, NULL, NULL);

-- Dumping structure for table etudentdatabase.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etudentdatabase.password_resets: ~0 rows (approximately)

-- Dumping structure for table etudentdatabase.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etudentdatabase.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table etudentdatabase.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etudentdatabase.sessions: ~3 rows (approximately)
INSERT IGNORE INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('9sxd7PueGBN70GCVCRhnNAaBwgMxALXW6sHZFzwP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 OPR/105.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZE12M2Y3NkR3VUFrZVJIVnYyVmM2YmkyRGtUdjVmc3pkeUZFdkh6WSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8/Q29kZUFwb2dlZT0yMjA5MTYxJl90b2tlbj1kTXYzZjc2RHdVQWtlUkhWdjJWYzZiaTJEa1R2NWZzemR5RkV2SHpZIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1704410365),
	('JwwYO05ICBrpY5NKnq17Dkf64TCY2eKf5fm8WdXI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 OPR/105.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibU5BbUU4dmJoYWZtZ3dXZTlXTjhIaFkwMXl4bTNRUFlHenlUZko3biI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ldHVkaWFudHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1704408262),
	('Lc4UdcyqxyjA0XHvCvQojFsph3wxVt8tO4XLwYDe', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 OPR/105.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQzZWaGNnR0Q2dkhmWk1HVzFrbVBNa2FRZDJtVHpGdmtXc3prRmZqcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1704409056);

-- Dumping structure for table etudentdatabase.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table etudentdatabase.users: ~1 rows (approximately)
INSERT IGNORE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
	(1, 'achraf el', 'achrafelabouye@gmail.com', NULL, '$2y$10$LSRNe58mMg8Q1K0NDSoxa.Puh5fmCRbb8zidC149WH1.J.YR4HTIm', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-02 23:46:09', '2024-01-02 23:46:09');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
