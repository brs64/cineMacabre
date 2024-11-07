<?php
// Inclure le fichier commun pour l'en-tête et le pied de page
include 'common.php';

// Vous pouvez également inclure les fichiers pour la connexion à la base de données et les requêtes
include 'data/connBD.php';
include 'data/requetes.php';

// Logique spécifique à cette page (comme la pagination ou la récupération des films)
$films_par_page = 18;
$total_films = count(getFilms());
$total_pages = ceil($total_films / $films_par_page);

$page_actuelle = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page_actuelle < 1) {
    $page_actuelle = 1;
}

$offset = ($page_actuelle - 1) * $films_par_page;
$films = getFilmsPaginated($offset, $films_par_page);
?>


    <?php afficherHeader(); ?>  <!-- Appel de la fonction afficherHeader() -->
    <?php echo '<div class="search-container">
            <form action="search.php" method="GET">
                <input type="text" name="query" placeholder="Rechercher..." class="search-bar" id="search-bar" value="' . (isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '') . '">
                <button type="submit" style="display:none;">Rechercher</button>
            </form>
        </div>' ?>
    <main>
        <section class="films horror-theme">
            <div class="film-cards-container">
                <?php foreach ($films as $film): ?>
                    <div class="film-card">
                        <a href="details.php?id=<?= $film['id']; ?>">
                            <img src="<?= htmlspecialchars($film['image_url']); ?>" alt="<?= htmlspecialchars($film['titre']); ?>">
                        </a>
                        <h3><?= htmlspecialchars($film['titre']); ?></h3>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <div class="pagination">
        <?php if ($page_actuelle > 1): ?>
            <a href="?page=<?= $page_actuelle - 1; ?>" class="pagination-arrow">&#8592;</a>
        <?php endif; ?>

        <span>Page <?= $page_actuelle; ?> sur <?= $total_pages; ?></span>

        <?php if ($page_actuelle < $total_pages): ?>
            <a href="?page=<?= $page_actuelle + 1; ?>" class="pagination-arrow"> &#8594;</a>
        <?php endif; ?>
    </div>
    </main>

    <?php afficherFooter(); ?>  <!-- Appel de la fonction afficherFooter() -->

    <script src="script.js"></script>
</body>

</html>
