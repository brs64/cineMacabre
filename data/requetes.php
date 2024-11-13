<?php
// Connexion à la base de données
include 'connBD.php';

function getFilms() {
    global $pdo; 
    $stmt = $pdo->query("SELECT * FROM films");
    $films = [];
    
    while ($film = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $films[] = $film;
    }
    
    return $films;
}

function getFilmsPaginated($offset, $limit) {
    global $pdo; // Utilise la connexion globale

    // Vérifie si la connexion est bien active
    if ($pdo === null) {
        die("Erreur : la connexion à la base de données n'a pas pu être établie.");
    }

    $query = "SELECT * FROM films LIMIT ?, ?"; // On limite le nombre de films récupérés
    $stmt = $pdo->prepare($query);  // Prépare la requête
    $stmt->bindValue(1, $offset, PDO::PARAM_INT);  // Bind parameters
    $stmt->bindValue(2, $limit, PDO::PARAM_INT); 
    $stmt->execute();  // Exécute la requête
    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Récupère les résultats

    return $films;
}

function searchFilms($query) {
    global $pdo; // Assume $pdo est votre connexion à la base de données
    
    // Requête SQL pour rechercher les films dont le titre contient la requête
    $sql = "SELECT * FROM films WHERE titre LIKE :query";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':query' => '%' . $query . '%']);
    
    // Retourner les résultats sous forme de tableau
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getFilmById($id) {
    // Connexion à la base de données
    global $pdo;
    $sql = "SELECT * FROM films WHERE id_film = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Fonction pour récupérer les genres d'un film donné
function getGenresForFilm($film_id) {
    global $pdo; // Assure-toi que $pdo est ta connexion à la base de données

    // Requête SQL pour obtenir les noms des genres à partir de l'id d'un film
    $sql = "SELECT g.nom 
            FROM genres g
            JOIN film_genre fg ON g.id_genre = fg.id_genre
            WHERE fg.id_film = :film_id";

    // Préparation de la requête
    $stmt = $pdo->prepare($sql);

    // Exécution de la requête avec le paramètre passé
    $stmt->execute(['film_id' => $film_id]);

    // Retourne les résultats sous forme de tableau associatif
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Fonction pour récupérer tous les genres
function getGenres() {
    global $pdo; // Assurez-vous que vous avez une connexion à la base de données via $pdo
    $query = 'SELECT id_genre, nom FROM genres'; // Suppose que vous avez une table genres avec un id_genre et un nom
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fonction pour récupérer les films par genre
function getFilmsByGenre($genre_id) {
    global $pdo; // Connexion à la base de données
    $sql = 'SELECT * FROM films WHERE id_film IN (SELECT id_film FROM film_genre WHERE id_genre = :genre_id)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':genre_id', $genre_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fonction pour récupérer un genre par son ID
function getGenreById($genre_id) {
    global $pdo; // Connexion à la base de données
    $sql = 'SELECT * FROM genres WHERE id_genre = :genre_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':genre_id', $genre_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function getFilmRecents() {
    global $pdo;  // Utilisation de la connexion PDO
    $query = "SELECT * FROM films WHERE date_sortie <= CURDATE() AND note > 8 AND description != '' ORDER BY date_sortie DESC LIMIT 1";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);  // Utilisation de fetch() car on attend un seul film
}



function getTopGenres() {
    global $pdo;  // Utilisation de la connexion PDO
    $query = "
        SELECT g.id_genre, g.nom, COUNT(fg.id_film) AS genre_count
        FROM genres g
        JOIN film_genre fg ON g.id_genre = fg.id_genre
        GROUP BY g.id_genre
        ORDER BY genre_count DESC
        LIMIT 3
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $genres = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $genres;
}

function getFilmsByGenrePaginated($genre_id, $offset, $limit) {
    global $pdo; // Utilise la connexion globale

    // Vérifie si la connexion est bien active
    if ($pdo === null) {
        die("Erreur : la connexion à la base de données n'a pas pu être établie.");
    }

    // Préparer la requête SQL pour récupérer les films d'un genre spécifique avec pagination
    $query = "
        SELECT films.* 
        FROM films
        INNER JOIN film_genre ON films.id_film = film_genre.id_film
        WHERE film_genre.id_genre = ?
        LIMIT ?, ?";
        
    $stmt = $pdo->prepare($query);  // Prépare la requête
    $stmt->bindValue(1, $genre_id, PDO::PARAM_INT);  // Bind genre_id
    $stmt->bindValue(2, $offset, PDO::PARAM_INT);  // Bind offset
    $stmt->bindValue(3, $limit, PDO::PARAM_INT);   // Bind limit
    $stmt->execute();  // Exécute la requête

    // Récupérer les résultats
    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $films;
}

// Fonction pour récupérer toutes les collections
function getCollections() {
    global $pdo; 
    $stmt = $pdo->query("SELECT * FROM collections");
    $collections = [];
    
    while ($collection = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $collections[] = $collection;
    }
    
    return $collections;
}

// Fonction pour récupérer les collections avec pagination
function getCollectionsPaginated($offset, $limit) {
    global $pdo;

    $query = "SELECT * FROM collections LIMIT ?, ?"; 
    $stmt = $pdo->prepare($query);  
    $stmt->bindValue(1, $offset, PDO::PARAM_INT);  
    $stmt->bindValue(2, $limit, PDO::PARAM_INT); 
    $stmt->execute();  
    $collections = $stmt->fetchAll(PDO::FETCH_ASSOC);  

    return $collections;
}

function getFilmsByCollection($collection_id) {
    // Connexion à la base de données
    $host = 'localhost'; // L'hôte de la base de données
    $dbname = 'ton_nom_de_base_de_donnees'; // Le nom de ta base de données
    $username = 'ton_utilisateur'; // Ton utilisateur
    $password = 'ton_mot_de_passe'; // Ton mot de passe

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête pour récupérer les films d'une collection spécifique
        $sql = "SELECT * FROM films WHERE collection_id = :collection_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':collection_id', $collection_id, PDO::PARAM_INT);
        $stmt->execute();

        // Retourne les films sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // En cas d'erreur, afficher un message et stopper l'exécution
        echo "Erreur de connexion à la base de données: " . $e->getMessage();
        return false;
    }
}
