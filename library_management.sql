-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 20 sep. 2022 à 20:30
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `library_management`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avatar_admin` varchar(100) NOT NULL,
  `tlf` int(11) NOT NULL,
  `cin` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `corbeille` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT 0,
  `password_token` varchar(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `avatar_admin`, `tlf`, `cin`, `role`, `corbeille`, `status`, `token`, `verified`, `password_token`) VALUES
(1, 'Talel mejri', 'talelmejri8@gmail.com', '$2y$10$UqGIujEMUCCezxTXEvJTter4e.UOg0JgtuQ1u4oK3RTLTGMZS5HBW', '../storage/personnel/eb31687fb8360663bf55f23b856a2843 . jpg', 29036027, 13650110, 1, 0, 0, '7a6d68ed712882a7cf548f80766eb45c1527', 1, '6181'),
(4, 'eeee', 'talelmejri45@gmail.com', 'talel123', '', 2906027, 13650130, 0, 1, 0, NULL, 1, '0'),
(5, 'new', '', '', '', 0, 0, 0, 0, 0, NULL, 0, '0'),
(6, 'nouveau', '', '', '', 0, 0, 0, 0, 0, NULL, 0, '0'),
(22, 'hamdi', 'boughanmihamdi672@gmail.com', '$2y$10$d5U3hiHxmd/9htETBgDaNuvGfQi1URNRkp/2dsimedKfGjvMHlYzK', '../storage/avatars/3315fc13d993de252bd89ac454d5c6a9 . jpg', 29036027, 12345678, 0, 0, 0, NULL, 1, '2047'),
(25, 'youssef', 'mohamedgeni84@gmail.com', '$2y$10$DiiAGU9vLZt6E92fkieoNehltJg7rd9JHRc1MCtK7QF8PJ5NPXnxu', '../storage/avatars/b757982b823bbb523b664ee86ca6d124 . PNG', 29036027, 12345677, 0, 0, 0, NULL, 1, '8516'),
(27, 'taha', 'talelmejri151@gmail.com', '$2y$10$7BinXAfk2.1R0Sb00peyp.3rXhQHsapdP/NSkkE3511bq8bSayG4m', '../storage/avatars/dd34db41e07c0076c3163f36a49c7df7 . JPG', 56122355, 13650120, 0, 0, 0, NULL, 1, '5780');

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `idbook` int(11) NOT NULL,
  `name_book` varchar(50) NOT NULL,
  `author_book` varchar(20) NOT NULL,
  `description_book` varchar(100) NOT NULL,
  `nbr_book` int(100) NOT NULL DEFAULT 0,
  `status` enum('enable','not_enable') NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `rate` int(11) NOT NULL,
  `genre` varchar(40) NOT NULL,
  `date_book` date DEFAULT NULL,
  `Prix` float NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`idbook`, `name_book`, `author_book`, `description_book`, `nbr_book`, `status`, `avatar`, `rate`, `genre`, `date_book`, `Prix`, `userid`) VALUES
(9, 'Letting Go', 'Philip Roth', 'My dad gave me the novel Letting Go by Philip Roth. Dad read very little fiction—only one book of fi', 9, 'enable', '../storage/book/115b04963671ee833205e62edafab5fd . jpg', 0, 'political ', '2012-01-01', 51, 0),
(10, 'The Adventures of To', 'Mark Twain', 'On my eighth birthday my mother gave me a hardcover copy of The Adventures of Tom Sawyer.', 8, 'enable', '../storage/book/bcec8299c14664ccbcdab7fe3254342b . jpg', 0, 'adventure', '1876-09-24', 27, 0),
(11, 'الأيام (Al-Ayyam)', 'طه حسين', 'Al-Ayyam is a book about days that came and went on Taha Hussein. He narrates them in this book to t', 5, 'enable', '../storage/book/8aabb6dea16b5df4a9cf83e056459b64 . jpg', 0, 'story', '1929-01-01', 50, 0),
(12, 'ألف ليلة وليلة (One ', 'multiple authors', 'One Thousand and One Nights is a book that includes a collection of stories from West and South Asia', 6, 'enable', '../storage/book/3187826c9faa49543cc8a6b065f7ace3 . jpg', 0, 'story', '1867-01-01', 70, 0),
(13, 'In Search of Lost Time', 'Marcel Proust', 'Swann\'s Way, the first part of A la recherche de temps perdu, Marcel Proust\'s seven-part cycle,', 2, 'enable', '../storage/book/6448d1ff47c533d34908f92171d7e6eb . jpg', 0, 'mystery', '1913-04-05', 50, 0),
(14, 'War and Peace', ' Leo Tolstoy', 'Epic in scale, War and Peace delineates in graphic detail events leading up to Napoleon\'s invasion o', 3, 'enable', '../storage/book/68caa9f207b4ae2d0b63a6a724f16485 . jpg', 0, 'action', '1869-01-01', 40, 0),
(15, 'Clive Cussler\'s Hellburner', 'Mike Maden', 'Juan Cabrillo and the crew of the Oregon must track down a nuclear torpedo before it unleashes World', 7, 'enable', '../storage/book/7fb87fd916da39ed77907dc5ba711159 . jpg', 0, 'action', '2022-09-06', 100, 0),
(16, 'Into Thin Air', ' Jon Krakauer', 'Into Thin Air: A Personal Account of the Mt. Everest Disaster is a 1997 bestselling nonfiction book ', 7, 'enable', '../storage/book/b1bc8595bf50710c52e261b77c0dc29c . jpg', 0, 'adventure', '1997-01-01', 90, 0),
(17, 'The Silent Patient', 'Alex Michaelides', 'Alicia Berenson’s life is seemingly perfect. A famous painter married to an in-demand fashion photog', -1, 'enable', '../storage/book/44b4304371f935961bbc1fa6102cd9c1 . jpg', 0, 'mystery', '2019-04-05', 80, 0),
(18, 'The Final Girl Support Group ', 'Grady Hendrix', 'A fast-paced, thrilling horror novel that follows a group of heroines to die for, from the brilliant', 2, 'enable', '../storage/book/5ed93ce59b8cccad9bdd229dbbbb54a2 . png', 0, 'horror', '2021-04-25', 39, 0);

-- --------------------------------------------------------

--
-- Structure de la table `books_favorite`
--

CREATE TABLE `books_favorite` (
  `idbook` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `favorite` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `books_favorite`
--

INSERT INTO `books_favorite` (`idbook`, `iduser`, `favorite`) VALUES
(10, 22, 0),
(9, 22, 0),
(11, 22, 0),
(17, 22, 1),
(18, 22, 0),
(12, 22, 0),
(13, 22, 0),
(14, 22, 0),
(15, 22, 0),
(16, 22, 0),
(18, 27, 1),
(15, 27, 1),
(17, 27, 1);

-- --------------------------------------------------------

--
-- Structure de la table `book_issue`
--

CREATE TABLE `book_issue` (
  `id_issue` int(11) NOT NULL,
  `name_book` varchar(20) NOT NULL,
  `avatar_book` varchar(100) NOT NULL,
  `name_user` varchar(20) NOT NULL,
  `user_avatar` varchar(100) NOT NULL,
  `date_issue` date NOT NULL,
  `date_returned` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `idmessage` int(11) NOT NULL,
  `idenvoi` int(11) NOT NULL,
  `idrecent` int(11) NOT NULL,
  `message` varchar(200) NOT NULL,
  `Date` varchar(100) DEFAULT NULL,
  `react` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `chat`
--

INSERT INTO `chat` (`idmessage`, `idenvoi`, `idrecent`, `message`, `Date`, `react`) VALUES
(1, 22, 27, 'hi', '05:08:29pm', ''),
(2, 22, 1, 'admin', '05:08:36pm', ''),
(3, 1, 22, 'ddd', '05:11:00pm', ''),
(4, 1, 22, 'ddd', '05:11:20pm', ''),
(5, 1, 22, 'ddd', '05:11:29pm', ''),
(6, 1, 22, 'ddd', '05:11:40pm', ''),
(7, 1, 22, 'ddd', '05:12:00pm', ''),
(8, 1, 22, 'ddd', '05:12:07pm', ''),
(9, 1, 22, 'ddd', '05:12:35pm', ''),
(10, 1, 22, 'ddd', '05:12:42pm', ''),
(11, 1, 22, 'ddd', '05:12:54pm', ''),
(12, 1, 22, 'ddd', '05:13:13pm', ''),
(13, 1, 22, 'ddd', '05:13:30pm', ''),
(14, 27, 22, 'ok aaa\r\n', '05:14:06pm', ''),
(15, 1, 22, 'wiii', '12:10:18pm', '');

-- --------------------------------------------------------

--
-- Structure de la table `comande`
--

CREATE TABLE `comande` (
  `idcommande` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `aveclivraison` tinyint(1) DEFAULT NULL,
  `valider` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comande`
--

INSERT INTO `comande` (`idcommande`, `iduser`, `aveclivraison`, `valider`) VALUES
(72, 22, 1, 0),
(73, 22, 1, 1),
(74, 25, 0, 1),
(75, 27, 1, 1),
(76, 22, 1, 1),
(77, 22, 0, 1),
(78, 22, 1, 1),
(79, 22, 1, 1),
(82, 22, 1, 0),
(83, 22, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `nom` varchar(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `messages` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `line_commande`
--

CREATE TABLE `line_commande` (
  `idcommande` int(11) NOT NULL,
  `idbook` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `line_commande`
--

INSERT INTO `line_commande` (`idcommande`, `idbook`, `quantity`) VALUES
(76, 11, 10),
(77, 10, 2),
(77, 9, 2),
(78, 12, 4),
(79, 13, 6),
(79, 13, 5),
(82, 18, 2),
(83, 14, 2);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `messages` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id`, `messages`) VALUES
(33, 'hamdi like book Letting'),
(34, 'hamdi Adore book '),
(35, 'hamdi Adore book The'),
(36, 'hamdi like book The');

-- --------------------------------------------------------

--
-- Structure de la table `rate`
--

CREATE TABLE `rate` (
  `iduser` int(11) NOT NULL,
  `idbook` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `addrate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `rate`
--

INSERT INTO `rate` (`iduser`, `idbook`, `rate`, `addrate`) VALUES
(22, 15, 5, 1),
(22, 11, 5, 1),
(22, 10, 4, 1),
(22, 13, 2, 1),
(22, 18, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user_liked`
--

CREATE TABLE `user_liked` (
  `id_book` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `liked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user_liked`
--

INSERT INTO `user_liked` (`id_book`, `id_user`, `liked`) VALUES
(10, 22, 1),
(9, 22, 1),
(12, 22, 1),
(11, 22, 1),
(13, 22, 1),
(17, 22, 1),
(18, 22, 0),
(14, 22, 1),
(16, 22, 1),
(15, 22, 0),
(18, 25, 1),
(18, 27, 1),
(17, 27, 1),
(15, 27, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`idbook`);

--
-- Index pour la table `books_favorite`
--
ALTER TABLE `books_favorite`
  ADD KEY `id_book` (`idbook`),
  ADD KEY `id_user` (`iduser`);

--
-- Index pour la table `book_issue`
--
ALTER TABLE `book_issue`
  ADD PRIMARY KEY (`id_issue`);

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`idmessage`),
  ADD KEY `id_user_admin` (`idenvoi`),
  ADD KEY `id_user_user` (`idrecent`);

--
-- Index pour la table `comande`
--
ALTER TABLE `comande`
  ADD PRIMARY KEY (`idcommande`),
  ADD KEY `iduser_commande` (`iduser`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `line_commande`
--
ALTER TABLE `line_commande`
  ADD KEY `idcommande` (`idcommande`),
  ADD KEY `idbook_commande` (`idbook`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rate`
--
ALTER TABLE `rate`
  ADD KEY `idbooook` (`idbook`),
  ADD KEY `idclient` (`iduser`);

--
-- Index pour la table `user_liked`
--
ALTER TABLE `user_liked`
  ADD KEY `idbook` (`id_book`),
  ADD KEY `iduser` (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `idbook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `book_issue`
--
ALTER TABLE `book_issue`
  MODIFY `id_issue` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `idmessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `comande`
--
ALTER TABLE `comande`
  MODIFY `idcommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `books_favorite`
--
ALTER TABLE `books_favorite`
  ADD CONSTRAINT `id_book` FOREIGN KEY (`idbook`) REFERENCES `book` (`idbook`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user` FOREIGN KEY (`iduser`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `id_user_admin` FOREIGN KEY (`idenvoi`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user_user` FOREIGN KEY (`idrecent`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `comande`
--
ALTER TABLE `comande`
  ADD CONSTRAINT `iduser_commande` FOREIGN KEY (`iduser`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `line_commande`
--
ALTER TABLE `line_commande`
  ADD CONSTRAINT `idbook_commande` FOREIGN KEY (`idbook`) REFERENCES `book` (`idbook`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idcommande` FOREIGN KEY (`idcommande`) REFERENCES `comande` (`idcommande`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `rate`
--
ALTER TABLE `rate`
  ADD CONSTRAINT `idbooook` FOREIGN KEY (`idbook`) REFERENCES `book` (`idbook`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idclient` FOREIGN KEY (`iduser`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user_liked`
--
ALTER TABLE `user_liked`
  ADD CONSTRAINT `idbook` FOREIGN KEY (`id_book`) REFERENCES `book` (`idbook`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `iduser` FOREIGN KEY (`id_user`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
