-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 03 avr. 2022 à 20:00
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `account_information`
--

CREATE TABLE `account_information` (
  `account_information_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `gender` char(1) NOT NULL,
  `account_image` varchar(100) NOT NULL,
  `account_type_id` int(11) DEFAULT NULL,
  `education_id` int(11) DEFAULT NULL,
  `campus_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `account_information`
--

INSERT INTO `account_information` (`account_information_id`, `firstname`, `lastname`, `email`, `password`, `gender`, `account_image`, `account_type_id`, `education_id`, `campus_id`) VALUES
(49, 'Robin', 'Hatier', 'robin@robin.com', '$argon2i$v=19$m=65536,t=4,p=1$NldXRUZpWGJ6UjN4RWp1Rg$riCPmZUOROeiJ6lEUOjAGBrlnN0ZDxMjGlD3HfBr38E', 'M', 'none', 2, 1, 1),
(50, 'Fabien', 'Ivanowitz', 'fabien@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$QnNjczF3YXpJZi5MU1hGZA$M4jdx1Wo8ONYQaZnvlS1VZvnUXURrToEoz0vW070MzA', 'M', 'none', 1, 1, 1),
(51, 'Lamyae', 'Menhaj', 'lamyae@viacesi.fr', '$argon2i$v=19$m=65536,t=4,p=1$TnJoT3RPOE45RVlpWmlCSQ$rjheA1k5xTDoyJCi3ovxPldQs44nIBEdMAPjTotml+k', 'F', 'none', 3, 1, 1),
(52, 'Ralph', 'Rached', 'ralph@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$Ni5WajdVNlpNZXdoRGNENw$7Ex8yLS3JxOjJZknxRmuS1kWxMw+e7Pi1qBNfjku4YA', 'M', 'none', 1, 1, 1),
(60, 'Admin', 'Admin', 'admin@admin.admin', '$argon2i$v=19$m=65536,t=4,p=1$dXFPSEVUc0lzQXNXZ2UxUQ$LDuI5Nyz0L6nZI6vkMDWOorgfTsCojW8jSTygBa2U28', 'O', 'admin', 4, NULL, NULL),
(87, 'Soutenance', 'Soutenance', 'soutenance@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$dkV4ZFhsNmdzb0JmV0FJWA$jRSUtMbcwABMhUfC+7NTNPbs/K6UpKN0a0tVtYunnZA', 'F', 'none', 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `account_type`
--

CREATE TABLE `account_type` (
  `account_type_id` int(11) NOT NULL,
  `account_type_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `account_type`
--

INSERT INTO `account_type` (`account_type_id`, `account_type_name`) VALUES
(1, 'student'),
(2, 'delegated'),
(3, 'pilote'),
(4, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `activity`
--

CREATE TABLE `activity` (
  `company_id` int(11) NOT NULL,
  `business_sector_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `activity`
--

INSERT INTO `activity` (`company_id`, `business_sector_id`) VALUES
(16, 91),
(18, 91),
(19, 97),
(21, 102),
(22, 103),
(31, 97);

-- --------------------------------------------------------

--
-- Structure de la table `business_sector`
--

CREATE TABLE `business_sector` (
  `business_sector_id` int(11) NOT NULL,
  `business_sector_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `business_sector`
--

INSERT INTO `business_sector` (`business_sector_id`, `business_sector_name`) VALUES
(91, 'IT'),
(94, 'Security'),
(95, 'IT'),
(96, 'IT'),
(97, 'BTP'),
(98, 'BTP'),
(99, 'sgdgsdg'),
(100, 'IT'),
(101, 'Electric'),
(102, 'Electricity'),
(103, 'electronics'),
(104, 'Electronics'),
(105, 'BTP'),
(106, 'BTP'),
(107, 'uytf'),
(108, 'uv'),
(109, 'uv'),
(110, 'uv'),
(111, 'BTP'),
(112, 'BTP'),
(113, 'BTP'),
(114, 'BTP'),
(115, 'BTP'),
(116, 'it'),
(117, 'sgdgsdg'),
(118, 'sgdgsdg'),
(119, 'sgdgsdg'),
(120, 'sgdgsdg'),
(121, 'sgdgsdg'),
(122, 'DGSE'),
(123, 'IT'),
(124, 'IT'),
(125, 'IT'),
(126, 'IT'),
(127, 'IT'),
(128, 'IT'),
(129, 'IT'),
(130, 'IT'),
(131, 'IT'),
(132, 'IT'),
(133, 'IT'),
(134, 'IT'),
(135, 'IT'),
(136, 'IT');

-- --------------------------------------------------------

--
-- Structure de la table `campus`
--

CREATE TABLE `campus` (
  `campus_id` int(11) NOT NULL,
  `campus_location` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `campus`
--

INSERT INTO `campus` (`campus_id`, `campus_location`) VALUES
(1, 'nice'),
(2, 'toulouse');

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(30) NOT NULL,
  `company_description` varchar(1000) NOT NULL,
  `company_image` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `company_description`, `company_image`) VALUES
(16, 'AirFrance', 'International company. Its main activities are the transport of passengers, freight as well as the maintenance and servicing of aircraft. It serves the main French airports as well as many foreign airports.', 'https://logos-world.net/wp-content/uploads/2020/03/Air-France-Logo-2009-2016.jpg'),
(18, 'DGSE', ' The General Directorate of External Security, is the intelligence service of France, succeeding the external documentation and counterintelligence service', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTVnU4QGS0swN6kRcrXLota5WJsF9SDp0eMA&usqp=CAU'),
(19, 'Vinci Construction', ' Vinci Construction is a French group specializing in construction and civil engineering, the historical activities of the Vinci group of which it is a part.', 'https://upload.wikimedia.org/wikipedia/fr/1/18/Logo_Vinci_Construction.png'),
(21, 'Schneider Electric', 'It is a specialist and world leader in digital energy solutions and automations for energy efficiency and sustainability. ', 'https://s3.tenerrdis.fr/uploads/2022/01/300_11303_03022017031447-42.jpg'),
(22, 'Microchip', 'Microchip Technology, or simply Microchip, is a semiconductor manufacturer founded in 1989 from a division of General Instrument ', 'https://static4.arrow.com/-/media/arrow/images/manufacturers/m/microchip-technology-logo-approved.jpg?mw=250&hash=10F620E7275D5A78D90A1FCB429E843BBD8D466C'),
(31, 'Eiffage', ' Eiffage is a French construction and concessions group. The group now operates in many areas of public works: construction, infrastructure, concessions and energy.', 'https://i0.wp.com/www.geoplc.com/wp-content/uploads/2013/11/Logo-groupe-Eiffage1-e1384467328803.jpg?fit=786%2C249&ssl=1');

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

CREATE TABLE `documents` (
  `documents_id` int(11) NOT NULL,
  `cv` blob NOT NULL,
  `cover_letter` blob NOT NULL,
  `validation_sheet` varchar(100) NOT NULL,
  `agreement` varchar(100) NOT NULL,
  `account_information_id` int(11) NOT NULL,
  `job_post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `documents`
--

INSERT INTO `documents` (`documents_id`, `cv`, `cover_letter`, `validation_sheet`, `agreement`, `account_information_id`, `job_post_id`) VALUES
(19, 0x43562e646f6378, 0x436f766572204c65747465722e646f6378, '', '', 49, 27);

-- --------------------------------------------------------

--
-- Structure de la table `education`
--

CREATE TABLE `education` (
  `education_id` int(11) NOT NULL,
  `minor` varchar(20) NOT NULL,
  `graduation_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `education`
--

INSERT INTO `education` (`education_id`, `minor`, `graduation_year`) VALUES
(1, 'it', 2025),
(2, 'generalist', 2025),
(3, 'btp', 2025),
(4, 's3e', 2025);

-- --------------------------------------------------------

--
-- Structure de la table `job_post`
--

CREATE TABLE `job_post` (
  `job_post_id` int(11) NOT NULL,
  `creation_date` date NOT NULL,
  `number_of_places` int(11) NOT NULL,
  `salary` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `account_information_id` int(11) DEFAULT NULL,
  `internship_name` varchar(1000) NOT NULL,
  `internship_description` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `job_post`
--

INSERT INTO `job_post` (`job_post_id`, `creation_date`, `number_of_places`, `salary`, `duration`, `location_id`, `company_id`, `account_information_id`, `internship_name`, `internship_description`) VALUES
(27, '2022-03-16', 3, 876, 15, 24, 16, 49, 'CyberSecurity', 'Ensure the protection of company data'),
(29, '2022-03-16', 2, 1000, 22, 26, 18, 49, 'Firewall development', 'Development of a firewall for several sensitive centers'),
(30, '2022-03-16', 1, 400, 8, 27, 19, 50, 'Building plan creation', 'provide a construction plan according to the resistance of the materials'),
(31, '2022-03-16', 2, 800, 30, 28, 21, NULL, 'Electrical service manager', 'responsible for the different electrical networks'),
(32, '2022-03-16', 7, 1200, 60, 29, 22, NULL, 'Finalization of electronic card development', 'You will be responsible for finalizing the development of an electronic card'),
(34, '2022-03-16', 2, 1300, 67, 35, 31, NULL, 'Construction engineer apprentice', 'you will accompany a construction engineer on different sites');

-- --------------------------------------------------------

--
-- Structure de la table `job_post_activity`
--

CREATE TABLE `job_post_activity` (
  `job_post_id` int(11) NOT NULL,
  `account_information_id` int(11) NOT NULL,
  `apply_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `street_address` varchar(100) NOT NULL,
  `city` varchar(60) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zip` varchar(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `location`
--

INSERT INTO `location` (`location_id`, `street_address`, `city`, `country`, `zip`, `company_id`) VALUES
(24, '356 route des dolines', 'Valbonne', 'France', '06560', 16),
(26, 'Boulevard Mortier', 'Paris', 'France', '75020', 18),
(27, 'Route des solives', 'Aix-en-Provence', 'France', '13100', 19),
(28, '2621 1ère Avenue', 'Bézaudun-les-Alpes', 'France', '06510', 21),
(29, '38 avenue simone veille', 'Nice', 'France', '06000', 22),
(34, '27 avenue de la grue', 'Antibes', 'France', '06600', 31),
(35, '87 avenue de la grue', 'Antibes', 'France', '06600', 31),
(36, '125 chemin ', 'Pégomas', 'France', '06580', 18),
(37, '125 chemin', 'Pégomas', 'France', '06580', 18),
(40, 'sdgsdg', 'La Colle-sur-Loup', 'France', '06480', 16),
(41, '15 rue Clémenceau', 'La Colle-sur-Loup', 'France', '06480', 16),
(43, '50 rue Emmanuel Grout', 'Nice', 'France', '06200', 16),
(45, '50 rue Emmanuel Grout', 'Nice', 'France', '06200', 16),
(47, '50 rue Emmanuel Grout', 'Nice', 'France', '06200', 16),
(49, '50 rue Emmanuel Grout', 'Nice', 'France', '06200', 16),
(51, '50 rue Emmanuel Grout', 'Nice', 'France', '06200', 16);

-- --------------------------------------------------------

--
-- Structure de la table `need`
--

CREATE TABLE `need` (
  `job_post_id` int(11) NOT NULL,
  `education_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `need`
--

INSERT INTO `need` (`job_post_id`, `education_id`) VALUES
(27, 1),
(29, 1),
(30, 3),
(31, 2),
(32, 4),
(34, 3);

-- --------------------------------------------------------

--
-- Structure de la table `rating`
--

CREATE TABLE `rating` (
  `company_id` int(11) NOT NULL,
  `account_information_id` int(11) NOT NULL,
  `grade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `skills`
--

CREATE TABLE `skills` (
  `skill_id` int(11) NOT NULL,
  `skill_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `skills`
--

INSERT INTO `skills` (`skill_id`, `skill_name`) VALUES
(20, 'Cyber'),
(22, 'Security'),
(23, 'RDM'),
(24, 'Electricity'),
(25, 'Electronics'),
(27, 'BTP'),
(28, 'php'),
(29, 'C'),
(30, 'C'),
(31, 'PHP'),
(32, 'PHP'),
(33, 'PHP'),
(34, 'PHP'),
(35, 'PHP'),
(36, 'PHP');

-- --------------------------------------------------------

--
-- Structure de la table `skills_needed`
--

CREATE TABLE `skills_needed` (
  `job_post_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `skill_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `skills_needed`
--

INSERT INTO `skills_needed` (`job_post_id`, `skill_id`, `skill_level`) VALUES
(27, 20, 90),
(29, 22, 70),
(30, 23, 90),
(31, 24, 90),
(32, 25, 30),
(34, 27, 50);

-- --------------------------------------------------------

--
-- Structure de la table `student_skills`
--

CREATE TABLE `student_skills` (
  `account_information_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `skill_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `wishtlist`
--

CREATE TABLE `wishtlist` (
  `job_post_id` int(11) NOT NULL,
  `account_information_id` int(11) NOT NULL,
  `apply` int(11) DEFAULT NULL,
  `validation` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `wishtlist`
--

INSERT INTO `wishtlist` (`job_post_id`, `account_information_id`, `apply`, `validation`) VALUES
(27, 87, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `account_information`
--
ALTER TABLE `account_information`
  ADD PRIMARY KEY (`account_information_id`),
  ADD KEY `account_information_account_type_FK` (`account_type_id`),
  ADD KEY `account_information_education0_FK` (`education_id`),
  ADD KEY `account_information_campus1_FK` (`campus_id`);

--
-- Index pour la table `account_type`
--
ALTER TABLE `account_type`
  ADD PRIMARY KEY (`account_type_id`);

--
-- Index pour la table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`company_id`,`business_sector_id`),
  ADD KEY `activity_business_sector0_FK` (`business_sector_id`);

--
-- Index pour la table `business_sector`
--
ALTER TABLE `business_sector`
  ADD PRIMARY KEY (`business_sector_id`);

--
-- Index pour la table `campus`
--
ALTER TABLE `campus`
  ADD PRIMARY KEY (`campus_id`);

--
-- Index pour la table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Index pour la table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`documents_id`),
  ADD KEY `documents_account_information_FK` (`account_information_id`),
  ADD KEY `documents_job_post0_FK` (`job_post_id`);

--
-- Index pour la table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`education_id`);

--
-- Index pour la table `job_post`
--
ALTER TABLE `job_post`
  ADD PRIMARY KEY (`job_post_id`),
  ADD KEY `job_post_location_FK` (`location_id`),
  ADD KEY `job_post_company0_FK` (`company_id`),
  ADD KEY `job_post_account_information1_FK` (`account_information_id`);

--
-- Index pour la table `job_post_activity`
--
ALTER TABLE `job_post_activity`
  ADD PRIMARY KEY (`job_post_id`,`account_information_id`),
  ADD KEY `job_post_activity_account_information0_FK` (`account_information_id`);

--
-- Index pour la table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `location_company_FK` (`company_id`);

--
-- Index pour la table `need`
--
ALTER TABLE `need`
  ADD PRIMARY KEY (`job_post_id`,`education_id`),
  ADD KEY `need_education0_FK` (`education_id`);

--
-- Index pour la table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`company_id`,`account_information_id`),
  ADD KEY `rating_account_information0_FK` (`account_information_id`);

--
-- Index pour la table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`skill_id`);

--
-- Index pour la table `skills_needed`
--
ALTER TABLE `skills_needed`
  ADD PRIMARY KEY (`job_post_id`,`skill_id`),
  ADD KEY `skills_needed_skills0_FK` (`skill_id`);

--
-- Index pour la table `student_skills`
--
ALTER TABLE `student_skills`
  ADD PRIMARY KEY (`account_information_id`,`skill_id`),
  ADD KEY `student_skills_skills0_FK` (`skill_id`);

--
-- Index pour la table `wishtlist`
--
ALTER TABLE `wishtlist`
  ADD PRIMARY KEY (`job_post_id`,`account_information_id`),
  ADD KEY `wishtlist_account_information0_FK` (`account_information_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `account_information`
--
ALTER TABLE `account_information`
  MODIFY `account_information_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT pour la table `account_type`
--
ALTER TABLE `account_type`
  MODIFY `account_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `business_sector`
--
ALTER TABLE `business_sector`
  MODIFY `business_sector_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT pour la table `campus`
--
ALTER TABLE `campus`
  MODIFY `campus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `documents`
--
ALTER TABLE `documents`
  MODIFY `documents_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `education`
--
ALTER TABLE `education`
  MODIFY `education_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `job_post`
--
ALTER TABLE `job_post`
  MODIFY `job_post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `skills`
--
ALTER TABLE `skills`
  MODIFY `skill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `account_information`
--
ALTER TABLE `account_information`
  ADD CONSTRAINT `account_information_account_type_FK` FOREIGN KEY (`account_type_id`) REFERENCES `account_type` (`account_type_id`),
  ADD CONSTRAINT `account_information_campus1_FK` FOREIGN KEY (`campus_id`) REFERENCES `campus` (`campus_id`),
  ADD CONSTRAINT `account_information_education0_FK` FOREIGN KEY (`education_id`) REFERENCES `education` (`education_id`);

--
-- Contraintes pour la table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_business_sector0_FK` FOREIGN KEY (`business_sector_id`) REFERENCES `business_sector` (`business_sector_id`),
  ADD CONSTRAINT `activity_company_FK` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`);

--
-- Contraintes pour la table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_account_information_FK` FOREIGN KEY (`account_information_id`) REFERENCES `account_information` (`account_information_id`),
  ADD CONSTRAINT `documents_job_post0_FK` FOREIGN KEY (`job_post_id`) REFERENCES `job_post` (`job_post_id`);

--
-- Contraintes pour la table `job_post`
--
ALTER TABLE `job_post`
  ADD CONSTRAINT `job_post_account_information1_FK` FOREIGN KEY (`account_information_id`) REFERENCES `account_information` (`account_information_id`),
  ADD CONSTRAINT `job_post_company0_FK` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`),
  ADD CONSTRAINT `job_post_location_FK` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`);

--
-- Contraintes pour la table `job_post_activity`
--
ALTER TABLE `job_post_activity`
  ADD CONSTRAINT `job_post_activity_account_information0_FK` FOREIGN KEY (`account_information_id`) REFERENCES `account_information` (`account_information_id`),
  ADD CONSTRAINT `job_post_activity_job_post_FK` FOREIGN KEY (`job_post_id`) REFERENCES `job_post` (`job_post_id`);

--
-- Contraintes pour la table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_company_FK` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`);

--
-- Contraintes pour la table `need`
--
ALTER TABLE `need`
  ADD CONSTRAINT `need_education0_FK` FOREIGN KEY (`education_id`) REFERENCES `education` (`education_id`),
  ADD CONSTRAINT `need_job_post_FK` FOREIGN KEY (`job_post_id`) REFERENCES `job_post` (`job_post_id`);

--
-- Contraintes pour la table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_account_information0_FK` FOREIGN KEY (`account_information_id`) REFERENCES `account_information` (`account_information_id`),
  ADD CONSTRAINT `rating_company_FK` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`);

--
-- Contraintes pour la table `skills_needed`
--
ALTER TABLE `skills_needed`
  ADD CONSTRAINT `skills_needed_job_post_FK` FOREIGN KEY (`job_post_id`) REFERENCES `job_post` (`job_post_id`),
  ADD CONSTRAINT `skills_needed_skills0_FK` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`skill_id`);

--
-- Contraintes pour la table `student_skills`
--
ALTER TABLE `student_skills`
  ADD CONSTRAINT `student_skills_account_information_FK` FOREIGN KEY (`account_information_id`) REFERENCES `account_information` (`account_information_id`),
  ADD CONSTRAINT `student_skills_skills0_FK` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`skill_id`);

--
-- Contraintes pour la table `wishtlist`
--
ALTER TABLE `wishtlist`
  ADD CONSTRAINT `wishtlist_account_information0_FK` FOREIGN KEY (`account_information_id`) REFERENCES `account_information` (`account_information_id`),
  ADD CONSTRAINT `wishtlist_job_post_FK` FOREIGN KEY (`job_post_id`) REFERENCES `job_post` (`job_post_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
