-- Créer la base de données
CREATE DATABASE cine CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Utiliser la base de données
USE cine;

-- Créer la table `films`
CREATE TABLE films (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    description TEXT,
    dateDeSortie INT,
    genre VARCHAR(100) DEFAULT 'Horror'
);

-- Insérer les films d'horreur avec les images spécifiées
INSERT INTO films (titre, image_url, description, dateDeSortie) VALUES
    ('Dracula', 'https://fr.web.img3.acsta.net/medias/nmedia/18/36/15/65/18456482.jpg', 'Film de vampires classique.', 1931),
    ('Frankenstein', 'https://fr.web.img6.acsta.net/c_310_420/medias/nmedia/18/65/06/74/18944654.jpg', 'Légende de la science qui échappe au contrôle.', 1931),
    ('Nosferatu', 'https://i.ebayimg.com/images/g/oycAAOSwti5cuQ6G/s-l1200.jpg', 'Film muet iconique de vampires.', 1922),
    ('Le Loup-Garou', 'https://static.wikia.nocookie.net/wikidoublage/images/7/7a/Le_Loup-Garou_%281941%29_-_Affiche_VOD_fran%C3%A7aise.jpg/revision/latest?cb=20221029154243&path-prefix=fr', 'Histoire d\'un homme transformé en loup-garou.', 1941),
    ('Psychose', 'https://fr.web.img2.acsta.net/pictures/22/04/06/14/34/3532106.jpg', 'Thriller psychologique d\'Alfred Hitchcock.', 1960),
    ('La Nuit des morts-vivants', 'https://media.senscritique.com/media/000016134438/0/la_nuit_des_morts_vivants.jpg', 'Lutte désespérée contre des zombies.', 1968),
    ('Les Oiseaux', 'https://fr.web.img6.acsta.net/pictures/18/02/06/11/00/3846131.jpg', 'Attaque mystérieuse d`oiseaux sur les humains.', 1963),
    ('Massacre à la tronçonneuse', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJEdcxwx5ViEWYNseyer6ysWLt3JQWPUKoKg&s', 'Film d`horreur culte basé sur des événements réels.', 1974),
    ('L\'Exorciste', 'https://fr.web.img5.acsta.net/medias/nmedia/18/65/19/82/18835952.jpg', 'Exorcisme terrifiant d\'une jeune fille.', 1973),
    ('Halloween', 'https://upload.wikimedia.org/wikipedia/en/thumb/a/af/Halloween_%281978%29_theatrical_poster.jpg/220px-Halloween_%281978%29_theatrical_poster.jpg', 'Les meurtres en série de Michael Myers.', 1978);
INSERT INTO films (titre, image_url, description, dateDeSortie, genre) 
VALUES (
    'Le Projet Blair Witch', 
    'https://fr.web.img6.acsta.net/pictures/19/11/13/10/30/1461527.jpg', 
    'Trois étudiants en cinéma partent dans la forêt pour filmer un documentaire sur une légende locale : la sorcière de Blair. Leurs enregistrements sont retrouvés un an plus tard, mais eux restent introuvables.', 
    1999, 
    'Horror'
);

INSERT INTO films (titre, image_url, description, dateDeSortie, genre) 
VALUES (
    'Les Griffes de la nuit', 
    'https://fr.web.img5.acsta.net/medias/nmedia/18/66/92/26/20080733.jpg', 
    'Un tueur en série défiguré, Freddy Krueger, hante les rêves des adolescents de Springwood, les traquant dans leur sommeil pour les tuer. Un groupe d amis tente de survivre à ses griffes mortelles.', 
    1984, 
    'Horror'
);

INSERT INTO films (titre, image_url, description, dateDeSortie, genre) VALUES
('Creepshow', 'https://fr.web.img6.acsta.net/pictures/18/08/21/11/39/1438636.jpg', 'Une série d histoires d horreur entrelacées, inspirées par les comics d horreur des années 1950', 1982, 'Horror'),
('Scream', 'https://upload.wikimedia.org/wikipedia/en/1/19/Scream_official_poster.jpg', 'Un mystérieux tueur en série masqué sème la terreur en appelant ses victimes avant de les assassiner', 1996, 'Horror'),
('Shining', 'https://fr.web.img6.acsta.net/pictures/15/02/02/14/41/542726.jpg', 'Un gardien d hotel sombre dans la folie au sein d un complexe isolé et terrifiant', 1980, 'Horror'),
('Rosemarys Baby', 'https://upload.wikimedia.org/wikipedia/en/1/1a/Rosemarys_baby_poster.jpg', 'Une femme enceinte commence à soupçonner que son mari et leurs voisins ont des plans sinistres pour son enfant', 1968, 'Horror'),
('Ring', 'https://fr.web.img2.acsta.net/medias/nmedia/18/67/24/92/20057543.jpg', 'Une cassette vidéo maudite tue ceux qui la regardent dans les sept jours', 1998, 'Horror'),
('Candyman', 'https://fr.web.img5.acsta.net/pictures/21/06/14/10/09/2667038.jpg', 'Un esprit vengeur au crochet sanglant apparaît chaque fois que son nom est prononcé cinq fois', 1992, 'Horror'),
('Evil Dead', 'https://upload.wikimedia.org/wikipedia/en/3/31/Evil_Dead_%281981%29_theatrical_poster.jpg', 'Des amis en vacances découvrent un livre maudit qui libère des esprits démoniaques', 1981, 'Horror'),
('Le Projet Blair Witch', 'https://fr.web.img6.acsta.net/medias/nmedia/00/02/54/52/affiche.jpg', 'Trois étudiants disparaissent dans une forêt hantée en essayant de capturer une légende urbaine', 1999, 'Horror'),
('L Invasion des Profanateurs', 'https://upload.wikimedia.org/wikipedia/en/7/7b/Invasion_of_the_Body_Snatchers_%281956_poster%29.jpg', 'Des extraterrestres remplacent les humains par des copies sans émotions', 1956, 'Sci-Fi Horror'),
('L Échelle de Jacob', 'https://fr.web.img3.acsta.net/pictures/19/09/24/15/14/5706668.jpg', 'Un vétéran de la guerre du Vietnam est hanté par des visions effrayantes et hallucinatoires', 1990, 'Psychological Horror'),
('Suspiria', 'https://fr.web.img4.acsta.net/pictures/18/09/24/17/32/2535989.jpg', 'Une danseuse découvre que son académie est dirigée par des sorcières', 1977, 'Horror'),
('La Malédiction', 'https://fr.web.img4.acsta.net/pictures/18/08/27/12/09/1977981.jpg', 'Un enfant mystérieux semble être l incarnation du mal', 1976, 'Horror'),
('Hellraiser', 'https://upload.wikimedia.org/wikipedia/en/5/57/Hellraiser_%281987%29_theatrical_poster.jpg', 'Un homme libère des créatures infernales après avoir résolu un puzzle maudit', 1987, 'Horror'),
('Le Village des Damnés', 'https://upload.wikimedia.org/wikipedia/en/a/af/Villageofthedamned.jpg', 'Les enfants d un village développent des pouvoirs sinistres et inquiétants', 1960, 'Horror'),
('Poltergeist', 'https://fr.web.img2.acsta.net/pictures/18/09/24/17/32/1649415.jpg', 'Une famille est terrorisée par des esprits hostiles dans leur maison', 1982, 'Horror'),
('Dawn of the Dead', 'https://fr.web.img3.acsta.net/pictures/19/09/10/10/17/5929962.jpg', 'Un groupe de survivants se réfugie dans un centre commercial pour échapper à une invasion de zombies', 1978, 'Horror'),
('Les Autres', 'https://fr.web.img4.acsta.net/medias/nmedia/00/02/33/24/affiche.jpg', 'Une femme vit dans une maison isolée et sombre avec ses deux enfants photosensibles hantée par des esprits', 2001, 'Horror'),
('Le Silence des Agneaux', 'https://upload.wikimedia.org/wikipedia/en/8/86/The_Silence_of_the_Lambs_poster.jpg', 'Une stagiaire du FBI enquête sur un tueur en série avec l aide d un psychopathe en prison', 1991, 'Thriller Horror');


