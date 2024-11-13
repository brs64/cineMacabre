<?php
include 'common.php';
include 'data/connBD.php'; // Inclure la connexion à la base de données
include 'data/requetes.php'; // Inclure les fonctions de récupération des données

// Récupérer l'ID du genre depuis l'URL
$genre_id = isset($_GET['genre']) ? (int) $_GET['genre'] : 0;

if ($genre_id > 0) {
    // Récupérer les films associés au genre
    // Nous comptons d'abord le nombre total de films pour ce genre
    $total_films = count(getFilmsByGenre($genre_id));
    $films_par_page = 20; // Nombre de films à afficher par page
    $total_pages = ceil($total_films / $films_par_page);

    // Récupérer la page actuelle à partir de l'URL (ou page 1 par défaut)
    $page_actuelle = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    if ($page_actuelle < 1) {
        $page_actuelle = 1;
    }

    // Calculer l'offset pour la pagination
    $offset = ($page_actuelle - 1) * $films_par_page;

    // Récupérer les films pour la page actuelle
    $films = getFilmsByGenrePaginated($genre_id, $offset, $films_par_page); 

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
                    <a href="details.php?id='. $film['id_film'].'">
                            <img src="'.htmlspecialchars($film['url_image']).'" alt="'. htmlspecialchars($film['titre']).'">
                        </a>
                    <h3>' . htmlspecialchars($film['titre']) . '</h3>
                  </div>';
        }
        echo '</div>';
    } else {
        echo '<p>Aucun film trouvé pour ce genre.</p>';
    }

    // Afficher la pagination
    echo '<div class="pagination">';
    if ($page_actuelle > 1) {
        echo '<a href="?genre=' . $genre_id . '&page=' . ($page_actuelle - 1) . '" class="pagination-arrow">&#8592;</a>';
    }

    echo '<span>Page ' . $page_actuelle . ' sur ' . $total_pages . '</span>';

    if ($page_actuelle < $total_pages) {
        echo '<a href="?genre=' . $genre_id . '&page=' . ($page_actuelle + 1) . '" class="pagination-arrow">&#8594;</a>';
    }
    echo '</div>'; // Fin de la pagination

    echo '</div></main>';

    // Afficher le pied de page
    afficherFooter();
} else {
    echo '<p>Genre invalide.</p>';
}
?>
