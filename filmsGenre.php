<?php
include 'common.php';
include 'data/connBD.php'; // Inclure la connexion à la base de données
include 'data/requetes.php'; // Inclure les fonctions de récupération des données

// Récupérer l'ID du genre depuis l'URL
$genre_id = isset($_GET['genre']) ? (int) $_GET['genre'] : 0;

if ($genre_id > 0) {
    // Récupérer les films associés au genre
    $films = getFilmsByGenre($genre_id); // Supposons que `getFilmsByGenre` récupère les films par genre

    // Afficher l'en-tête
    afficherHeader('Films par genre');

    echo '<main><div class="container">';

    // Afficher le genre choisi
    $genre = getGenreById($genre_id); // Récupérer les détails du genre
    echo '<h2>Films du genre : ' . htmlspecialchars($genre['nom']) . '</h2>';

    // Afficher les films associés à ce genre
    if ($films) {
        // Créer une grille de films pour un affichage cohérent
        echo '<div class="films-grid">';
        foreach ($films as $film) {
            echo '<div class="film-item">
                    <img src="' . htmlspecialchars($film['url_image']) . '" alt="' . htmlspecialchars($film['titre']) . '" class="film-image">
                    <h3>' . htmlspecialchars($film['titre']) . '</h3>
                    <a href="details.php?id=' . $film['id_film'] . '">Voir les détails</a>
                  </div>';
        }
        echo '</div>';
    } else {
        echo '<p>Aucun film trouvé pour ce genre.</p>';
    }

    echo '</div></main>';

    // Afficher le pied de page
    afficherFooter();
} else {
    echo '<p>Genre invalide.</p>';
}
?>
