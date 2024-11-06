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
    $sql = "SELECT * FROM films WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Fonction pour récupérer les genres d'un film donné
function getGenresForFilm($film_id) {
    global $pdo; // Assure-toi que $pdo est ta connexion à la base de données
    $sql = "SELECT g.nom FROM genres g 
            JOIN film_genres fg ON g.id = fg.genre_id 
            WHERE fg.film_id = :film_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['film_id' => $film_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fonction pour récupérer tous les genres
function getGenres() {
    global $pdo; // Assurez-vous que vous avez une connexion à la base de données via $pdo
    $query = 'SELECT id, nom FROM genres'; // Suppose que vous avez une table genres avec un id et un nom
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fonction pour récupérer les films par genre
function getFilmsByGenre($genre_id) {
    global $pdo; // Connexion à la base de données
    $sql = 'SELECT * FROM films WHERE id IN (SELECT film_id FROM film_genres WHERE genre_id = :genre_id)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':genre_id', $genre_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fonction pour récupérer un genre par son ID
function getGenreById($genre_id) {
    global $pdo; // Connexion à la base de données
    $sql = 'SELECT * FROM genres WHERE id = :genre_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':genre_id', $genre_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}



