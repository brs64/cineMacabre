<?php
include 'common.php'; // Inclure le fichier common.php
include 'data/connBD.php'; 
include 'data/requetes.php';

$query = isset($_GET['query']) ? trim($_GET['query']) : '';
$films = ($query != '') ? searchFilms($query) : [];

?>

<?php afficherHeader('Résultats de recherche'); ?>  <!-- Appel de afficherHeader() avec un titre personnalisé -->

    <main>
        <section class="films">
            <h2>Résultats de la recherche pour: "<?= htmlspecialchars($query); ?>"</h2>
            <div class="film-cards-container">
                <?php if (count($films) > 0): ?>
                    <?php foreach ($films as $film): ?>
                        <div class="film-card">
                            <a href="details.php?id=<?= $film['id']; ?>">
                                <img src="<?= htmlspecialchars($film['image_url']); ?>" alt="<?= htmlspecialchars($film['titre']); ?>">
                            </a>
                            <h3><?= htmlspecialchars($film['titre']); ?></h3>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucun film trouvé pour votre recherche.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php afficherFooter(); ?>  <!-- Appel de afficherFooter() -->
</body>

</html>
