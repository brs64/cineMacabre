<?php
// Inclure le fichier commun pour l'en-tête et le pied de page
include 'common.php';

// Inclure les fichiers nécessaires pour la base de données et les requêtes
include 'data/connBD.php';
include 'data/requetes.php';

// Logique spécifique à cette page (comme la pagination ou la récupération des collections)
$collections_par_page = 20;
$total_collections = count(getCollections());
$total_pages = ceil($total_collections / $collections_par_page);

$page_actuelle = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page_actuelle < 1) {
    $page_actuelle = 1;
}

$offset = ($page_actuelle - 1) * $collections_par_page;
$collections = getCollectionsPaginated($offset, $collections_par_page);
?>

<?php afficherHeader(); ?>  <!-- Appel de la fonction afficherHeader() -->

<main>
    <section class="collections">
        <div class="collection-cards-container">
        <?php foreach ($collections as $collection): ?>
    <div class="collection-card">
        <a href="detailsCollection.php?id=<?= $collection['id_collection']; ?>">
            <?php
                // Vérifier si l'URL de l'image est vide ou null
                $image_url = !empty($collection['url_image']) ? $collection['url_image'] : 'images/placeHolder.jpg';
            ?>
            <img src="<?= htmlspecialchars($image_url); ?>" alt="<?= htmlspecialchars($collection['nom']); ?>">
        </a>
        <h3><?= htmlspecialchars($collection['nom']); ?></h3>
        <p><?= htmlspecialchars($collection['description']); ?></p>
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
