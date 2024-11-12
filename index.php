<?php
// Inclure les fichiers nécessaires
include 'common.php';
include 'data/connBD.php';
include 'data/requetes.php';

// Logique spécifique pour la page d'accueil

// 1. Récupérer le film le plus récent
$film_recent = getFilmRecents();  // Fonction pour récupérer le film le plus récent

// 2. Récupérer les 3 genres les plus populaires
$top_genres = getTopGenres();  // Fonction pour récupérer les 3 genres les plus populaires

// 3. Récupérer les genres du film le plus récent
$genres_recent_film = getGenresForFilm($film_recent['id_film']); // Nous utilisons ici l'ID du film
?>

<?php afficherHeader(); ?>

<!-- Section Film le Plus Récent -->
<section class="recent-film">
    <h2>Film Sorti le Plus Récemment</h2>
    <div class="film-recent">
        <div class="film-recent-image">
            <a href="details.php?id=<?= $film_recent['id_film']; ?>">
                <img src="<?= htmlspecialchars($film_recent['url_image']); ?>" alt="<?= htmlspecialchars($film_recent['titre']); ?>">
            </a>
        </div>
        <div class="film-recent-content">
            <h3><?= htmlspecialchars($film_recent['titre']); ?></h3>
            <p><?= htmlspecialchars($film_recent['description']); ?></p>
        </div>
    </div>
</section>

<!-- Section des 3 Genres Populaires -->
<section class="top-genres">
    <h2>Les 3 Genres les Plus Populaires</h2>
    <div class="genres-container">
        <?php foreach ($top_genres as $genre): ?>
            <a href="filmsGenre.php?genre=<?= $genre['id_genre']; ?>" class="genre-button">
                <h3><?= htmlspecialchars($genre['nom']); ?></h3>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<?php afficherFooter(); ?>
<script src="script.js"></script>
</body>
</html>
