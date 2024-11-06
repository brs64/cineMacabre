-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 06 nov. 2024 à 23:00
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Base de données : `cine`
CREATE DATABASE IF NOT EXISTS `cine` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `cine`;

-- --------------------------------------------------------

-- Structure de la table `films`
DROP TABLE IF EXISTS `films`;
CREATE TABLE IF NOT EXISTS `films` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `dateDeSortie` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertion des films
INSERT INTO `films` (`id`, `titre`, `image_url`, `description`, `dateDeSortie`) VALUES
(1, 'Dracula', 'https://fr.web.img3.acsta.net/medias/nmedia/18/36/15/65/18456482.jpg', 'Film de vampires classique, basé sur le roman de Bram Stoker. L\'histoire de Dracula, un vampire centenaire, qui arrive à Londres pour propager la terreur. Ce film est un pilier du genre horreur et a marqué l\'histoire du cinéma avec ses effets visuels révolutionnaires pour l\'époque. L\'image iconique de Bela Lugosi dans le rôle du vampire est devenue un symbole de l\'horreur.', 1931),
(2, 'Frankenstein', 'https://fr.web.img6.acsta.net/c_310_420/medias/nmedia/18/65/06/74/18944654.jpg', 'Adaptation du roman de Mary Shelley. Le film raconte l\'histoire d\'un scientifique, le Dr. Frankenstein, qui crée un être vivant à partir de parties de cadavres. Ce film explore les dangers de l\'ambition humaine et les conséquences d\'essayer de défier la nature. Le monstre, incarné par Boris Karloff, devient l\'une des figures les plus mémorables de l\'horreur.', 1931),
(3, 'Nosferatu', 'https://i.ebayimg.com/images/g/oycAAOSwti5cuQ6G/s-l1200.jpg', 'Film muet et expressionniste allemand, "Nosferatu" est une adaptation libre de "Dracula". Le vampire Count Orlok, incarné par Max Schreck, terrorise une ville européenne en se nourrissant de sang humain. Ce film est un des précurseurs du cinéma d\'horreur et est célèbre pour son atmosphère terrifiante et ses angles de caméra innovants qui ont inspiré de nombreux films d\'horreur modernes.', 1922),
(4, 'Le Loup-Garou', 'https://media.senscritique.com/media/000018606623/0/le_loup_garou.jpg', 'Un homme est mordu par une créature étrange et se transforme en loup-garou lors de la pleine lune. Ce film fait partie des classiques de l\'horreur et introduit la transformation du loup-garou dans la culture populaire. C\'est un chef-d\'œuvre de l\'horreur des années 1940, avec des effets spéciaux qui étaient impressionnants pour l\'époque.', 1941),
(5, 'Psychose', 'https://fr.web.img2.acsta.net/pictures/22/04/06/14/34/3532106.jpg', 'Film culte d\'Alfred Hitchcock, un thriller psychologique où une jeune femme disparaît après avoir volé une grosse somme d\'argent. Le film joue sur les attentes du spectateur et contient l\'une des scènes les plus iconiques du cinéma d\'horreur, celle de la douche. L\'ambiance inquiétante et la montée progressive du suspense font de ce film un incontournable.', 1960),
(6, 'La Nuit des morts-vivants', 'https://media.senscritique.com/media/000016134438/0/la_nuit_des_morts_vivants.jpg', 'Un groupe de personnes se réfugie dans une maison pour échapper à une invasion de zombies. Ce film de George Romero a redéfini le genre des films de zombies et a lancé une franchise emblématique. La critique sociale sous-jacente, notamment sur le consumérisme, a fait de ce film un classique de l\'horreur et de la satire.', 1968),
(7, 'Les Oiseaux', 'https://fr.web.img6.acsta.net/pictures/18/02/06/11/00/3846131.jpg', 'Des oiseaux commencent à attaquer les habitants d\'une petite ville, sans raison apparente. Ce thriller psychologique de Hitchcock est l\'un des premiers films à mêler horreur et nature déchaînée. L\'absence d\'explication rationnelle derrière les attaques des oiseaux augmente l\'angoisse et le mystère du film.', 1963),
(8, 'Massacre à la tronçonneuse', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJEdcxwx5ViEWYNseyer6ysWLt3JQWPUKoKg&s', 'Un groupe d\'amis se retrouve dans une maison isolée, où ils sont capturés par une famille de cannibales. Ce film est un des pionniers du cinéma d\'horreur gore et est connu pour sa violence graphique et sa tension inouïe. Ce film a introduit le genre des slashers et reste une référence incontournable.', 1974),
(9, 'L\'Exorciste', 'https://fr.web.img5.acsta.net/medias/nmedia/18/65/19/82/18835952.jpg', 'Une jeune fille est possédée par un démon et un prêtre doit procéder à un exorcisme pour la sauver. Ce film d\'horreur psychologique est souvent cité comme l\'un des films les plus effrayants de tous les temps, grâce à son ambiance terrifiante et ses scènes de possession mémorables. Le film joue également avec les thèmes de la foi et du mal.', 1973),
(10, 'Halloween', 'https://upload.wikimedia.org/wikipedia/en/thumb/a/af/Halloween_%281978%29_theatrical_poster.jpg/220px-Halloween_%281978%29_theatrical_poster.jpg', 'Un tueur en série masqué, Michael Myers, s\'échappe d\'un asile psychiatrique et revient dans sa ville natale pour traquer des adolescents. Ce film de John Carpenter a lancé une franchise et défini les conventions du genre slasher. Avec sa musique iconique et son ambiance oppressante, "Halloween" a redéfini le genre de l\'horreur.', 1978),
(11, 'Le Projet Blair Witch', 'https://musicart.xboxlive.com/7/2f020f00-0000-0000-0000-000000000002/504/image.jpg?w=1920&h=1080', 'Trois étudiants en cinéma partent dans la forêt pour filmer un documentaire sur une légende locale : la sorcière de Blair. Leurs enregistrements sont retrouvés un an plus tard, mais eux restent introuvables. Ce film a popularisé le genre "found footage" et reste un modèle de tension et de suggestion terrifiante.', 1999),
(12, 'Les Griffes de la nuit', 'https://www.ecranlarge.com/content/uploads/2020/03/les-griffes-de-la-nuit-affiche-francaise-1171041.png', 'Un tueur en série défiguré, Freddy Krueger, hante les rêves des adolescents de Springwood, les traquant dans leur sommeil pour les tuer. Un groupe d\'amis tente de survivre à ses griffes mortelles. Ce film mélange horreur et satire, avec un antagoniste devenu une figure culte du cinéma d\'horreur.', 1984),
(13, 'Creepshow', 'https://fr.web.img3.acsta.net/pictures/19/07/16/09/29/3548456.jpg', 'Une anthologie d\'histoires d\'horreur inspirées des bandes dessinées des années 1950. Ce film est un mélange de comédie noire et d\'horreur, avec des récits qui jouent sur l\'absurde et le macabre. Réalisé par George Romero et écrit par Stephen King, "Creepshow" est un hommage aux films d\'horreur à l\'ancienne.', 1982),
(14, 'Hellraiser', 'https://upload.wikimedia.org/wikipedia/en/c/c9/Hellraiser_poster.jpg', 'Un homme libère une boîte mystique qui fait apparaître des démons qui torturent son âme. Ce film d\'horreur fantastique est devenu culte grâce à ses scènes horrifiques, ses créatures macabres et sa dimension psychologique troublante. Il a inspiré de nombreux films et séries dans le genre de l\'horreur gothique et fantastique.', 1987),
(15, 'L\'Invasion des Profanateurs', 'https://upload.wikimedia.org/wikipedia/en/9/91/Invasionofthebody_snatchers_1978_film_poster.jpg', 'Les habitants d\'une petite ville sont remplacés par des extraterrestres en forme de pods. Ce film d\'horreur de science-fiction mélange paranoïa et horreur psychologique, avec une ambiance oppressante et une réflexion sur la déshumanisation et l\'aliénation sociale.', 1978),
(16, 'Scream', 'https://m.media-amazon.com/images/I/81dkVm2f-uL._AC_SY679_.jpg', 'Un tueur masqué, surnommé "Ghostface", commence à pourchasser un groupe d\'adolescents. Ce film réinvente le genre slasher, avec des éléments d\'auto-dérision et des références aux films d\'horreur classiques. Réalisé par Wes Craven, "Scream" est un hommage et une critique du genre.', 1996),
(17, 'The Evil Dead', 'https://upload.wikimedia.org/wikipedia/en/a/a0/Evildead.jpg', 'Un groupe d\'amis se rend dans une cabane isolée dans la forêt où ils découvrent un livre ancien et une bande enregistrée qui invoque des démons. Ce film de Sam Raimi est un classique de l\'horreur avec des éléments de comédie noire et un ton gore, marquant les débuts de la saga "Evil Dead".', 1981),
(18, 'La Malédiction', 'https://upload.wikimedia.org/wikipedia/en/thumb/2/25/The_Omen_1976_Poster.jpg/220px-The_Omen_1976_Poster.jpg', 'Un père découvre que son fils, adopté à la naissance, est en réalité l\'Antéchrist. Ce film d\'horreur surnaturelle met en scène des événements tragiques entourant ce garçon diabolique et est connu pour sa tension psychologique et ses scènes de terreur', 1976),
(19, 'Les Dents de la mer', 'https://upload.wikimedia.org/wikipedia/en/6/6f/Jaws_Theatrical_Poster.jpg', 'Un grand requin blanc terrorise une station balnéaire, tandis qu\'un chef de police, un biologiste marin et un pêcheur tentent de l\'arrêter. Ce film de Steven Spielberg est un thriller captivant et l\'un des plus grands films d\'horreur de tous les temps.', 1975),
(20, 'Shining', 'https://upload.wikimedia.org/wikipedia/en/thumb/e/e8/The_Shining_1980_poster.jpg/220px-The_Shining_1980_poster.jpg', 'Un écrivain emménage avec sa famille dans un hôtel isolé où il sombre dans la folie sous l\'influence des forces surnaturelles. Ce film de Stanley Kubrick est l\'adaptation du roman de Stephen King et est célèbre pour son ambiance oppressante et sa performance mémorable de Jack Nicholson.', 1980);

-- --------------------------------------------------------

-- Structure de la table `film_genres`
DROP TABLE IF EXISTS `film_genres`;
CREATE TABLE IF NOT EXISTS `film_genres` (
  `film_id` int NOT NULL,
  `genre_id` int NOT NULL,
  PRIMARY KEY (`film_id`, `genre_id`),
  KEY `genre_id` (`genre_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertion des genres pour chaque film
INSERT INTO `film_genres` (`film_id`, `genre_id`) VALUES
(1, 4),  -- Dracula -> Horreur Fantastique
(2, 4),  -- Frankenstein -> Horreur Fantastique
(3, 4),  -- Nosferatu -> Horreur Fantastique
(4, 5),  -- Le Loup-Garou -> Body Horror
(5, 2),  -- Psychose -> Horreur Psychologique
(6, 8),  -- La Nuit des morts-vivants -> Zombie
(7, 3),  -- Les Oiseaux -> Thriller
(8, 7),  -- Massacre à la tronçonneuse -> Slasher
(9, 2),  -- L'Exorciste -> Horreur Psychologique
(10, 7), -- Halloween -> Slasher
(11, 6), -- Le Projet Blair Witch -> Found Footage
(12, 5), -- Les Griffes de la nuit -> Body Horror
(13, 11), -- Creepshow -> Comédie Horreur
(14, 4), -- Hellraiser -> Horreur Fantastique
(15, 4), -- L'Invasion des Profanateurs -> Horreur Fantastique
(16, 7), -- Scream -> Slasher
(17, 5), -- The Evil Dead -> Body Horror
(18, 10), -- La Malédiction -> Horreur Surnaturelle
(19, 3), -- Les Dents de la mer -> Thriller
(20, 10); -- Shining -> Horreur Surnaturelle

-- --------------------------------------------------------

-- Structure de la table `genres`
DROP TABLE IF EXISTS `genres`;
CREATE TABLE IF NOT EXISTS `genres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertion des genres sans "Horreur"
INSERT INTO `genres` (`id`, `nom`) VALUES
(1, 'Horreur Scientifique'),
(2, 'Horreur Psychologique'),
(3, 'Thriller'),
(4, 'Horreur Fantastique'),
(5, 'Body Horror'),
(6, 'Found Footage'),
(7, 'Slasher'),
(8, 'Zombie'),
(9, 'Suspense'),
(10, 'Horreur Surnaturelle'),
(11, 'Comédie Horreur');

-- --------------------------------------------------------

-- Structure de la table `sagas`
DROP TABLE IF EXISTS `sagas`;
CREATE TABLE IF NOT EXISTS `sagas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertion des sagas
INSERT INTO `sagas` (`id`, `nom`) VALUES
(1, 'Halloween'),
(2, 'Scream'),
(3, 'The Evil Dead');

-- --------------------------------------------------------

-- Commit des transactions
COMMIT;
