<?php
// Inclure les fichiers nécessaires
include 'common.php';
include 'data/connBD.php';
include 'data/requetes.php';

// Logique spécifique pour la page d'accueil

// 1. Récupérer le film le plus récent
$film_recent = getFilmRecents();  // Fonction à créer pour récupérer le film le plus récent

// 2. Récupérer les 3 genres les plus populaires
$top_genres = getTopGenres();  // Fonction à créer pour récupérer les 3 genres avec le plus de films
?>

<?php afficherHeader(); ?>

<!-- Section Film le Plus Récent -->
<section class="recent-film">
    <h2>Film Sorti le Plus Récemment</h2>
    <div class="film-recent">
        <div class="film-recent-image">
            <a href="details.php?id=<?= $film_recent['id']; ?>">
                <img src="<?= htmlspecialchars($film_recent['image_url']); ?>" alt="<?= htmlspecialchars($film_recent['titre']); ?>">
            </a>
        </div>
        <div class="film-recent-content">
            <h3><?= htmlspecialchars($film_recent['titre']); ?></h3>
            <p><?= htmlspecialchars($film_recent['description']); ?></p>
            <div class="genres">
                <!-- Affichage des genres (si applicable) -->
            </div>
        </div>
    </div>
</section>


<!-- Section des 3 Genres Populaires -->
<section class="top-genres">
    <h2>Les 3 Genres les Plus Populaires</h2>
    <div class="genres-container">
        <?php foreach ($top_genres as $genre): ?>
            <div class="genre-card">
                <h3><?= htmlspecialchars($genre['nom']); ?></h3>
                <?php echo '<a href="filmsGenre.php?genre=' . $genre['id'] . '" class="genre-button">' . htmlspecialchars($genre['nom']) . '</a>'; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php afficherFooter(); ?>
<script src="script.js"></script>
</body>
</html>
