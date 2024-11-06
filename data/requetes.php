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



