<?php
include 'common.php';
include 'data/connBD.php';
include 'data/requetes.php';

// Récupérer l'ID du film depuis l'URL
$id_film = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id_film > 0) {
    // Récupérer les informations du film depuis la base de données
    $film = getFilmById($id_film); // Supposons que `getFilmById` est une fonction qui récupère les détails d'un film par son ID

    // Récupérer les genres du film
    $genres = getGenresForFilm($id_film); // Fonction pour récupérer les genres associés à ce film

    if ($film): ?>
        <?php afficherHeader($film['titre']); ?>

        <main>
            <section class="film-details">
                <div class="container">
                    <div class="film-info">
                        <img src="<?= htmlspecialchars($film['url_image'] ?? 'default-image.jpg'); ?>" 
                             alt="<?= htmlspecialchars($film['titre'] ?? 'Titre du film'); ?>" 
                             class="film-image">
                        <div class="film-description">
                            <h2>Description</h2>
                            <p><?= nl2br(htmlspecialchars($film['description'] ?? 'Description non disponible')); ?></p>
                            <p><strong>Date de sortie:</strong> <?= htmlspecialchars($film['date_sortie'] ?? 'Date non disponible'); ?></p>

                            <!-- Affichage des genres -->
                            <h3>Genres :</h3>
                            <div class="film-genres">
                                <?php if (!empty($genres)): ?>
                                    <?php foreach ($genres as $genre): ?>
                                        <span class="genre"><?= htmlspecialchars($genre['nom']); ?></span>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>Aucun genre associé à ce film.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php
        // Afficher le pied de page
        afficherFooter();
        ?>
        </body>

        </html>
    <?php else: ?>
        <p>Film non trouvé.</p>
    <?php endif;
} else {
    echo "<p>ID de film invalide.</p>";
}
