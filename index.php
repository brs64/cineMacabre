<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ciné Macabre</title>
    <link rel="stylesheet" href="style.css">

    <link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">
</head>

<body>
    <?php include 'data/connBD.php';
    include 'data/requetes.php';

    // Nombre de films par page
    $films_par_page = 18;

    // Calculer le nombre total de films
    $total_films = count(getFilms()); // Récupérer le total des films
    $total_pages = ceil($total_films / $films_par_page); // Calculer le nombre de pages nécessaires
    
    // Récupérer la page actuelle
    $page_actuelle = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    if ($page_actuelle < 1)
        $page_actuelle = 1; // S'assurer que la page actuelle soit valide
    
    // Calculer l'index du premier film pour cette page
    $offset = ($page_actuelle - 1) * $films_par_page;

    // Récupérer les films pour cette page
    $films = getFilmsPaginated($offset, $films_par_page); // Supposons que getFilmsPaginated est une fonction qui récupère les films pour la page donnée
    ?>

    <header>
        <div class="container">
            <h1>Ciné Macabre</h1>
            <nav>
                <ul>
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#">Films</a></li>
                    <li><a href="#">Catégories</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>

        <section class="films horror-theme">
            <div class="film-cards-container">
                <?php
                foreach ($films as $film): ?>
                    <div class="film-card">
                        <img src="<?= htmlspecialchars($film['image_url']); ?>"
                            alt="<?= htmlspecialchars($film['titre']); ?>">
                        <h3><?= htmlspecialchars($film['titre']); ?></h3>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

    </main>
    <div class="pagination">
        <?php if ($page_actuelle > 1): ?>
            <a href="?page=<?= $page_actuelle - 1; ?>" class="pagination-arrow">&#8592;</a>
        <?php endif; ?>

        <span>Page <?= $page_actuelle; ?> sur <?= $total_pages; ?></span>

        <?php if ($page_actuelle < $total_pages): ?>
            <a href="?page=<?= $page_actuelle + 1; ?>" class="pagination-arrow"> &#8594;</a>
        <?php endif; ?>
    </div>
    <footer>
            
</footer>

    <script src="script.js"></script>
</body>

</html>