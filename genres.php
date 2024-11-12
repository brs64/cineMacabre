<?php
include 'common.php';
include 'data/connBD.php'; // Inclure la connexion à la base de données
include 'data/requetes.php'; // Inclure les fonctions de récupération des données

// Récupérer les genres depuis la base de données
$genres = getGenres(); // Supposons que cette fonction récupère tous les genres disponibles

// Afficher l'en-tête
afficherHeader('Genres');

echo '<main><div class="container"><h2>Liste des genres</h2><div class="genres-list">';

// Afficher chaque genre sous forme de bouton
foreach ($genres as $genre) {
    echo '<a href="filmsGenre.php?genre=' . $genre['id_genre'] . '" class="genre-button">' . htmlspecialchars($genre['nom']) . '</a>';
}

echo '</div></div></main>';

// Afficher le pied de page
afficherFooter();
?>
