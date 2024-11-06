<?php
// Fonction pour afficher l'en-tête (header)
function afficherHeader($pageTitle = 'Ciné Macabre') {
    echo '
    <!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . htmlspecialchars($pageTitle) . '</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <div class="container">
            <div class="header-left">
                <h1>' . htmlspecialchars($pageTitle) . '</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Films</a></li>
                    <li><a href="genres.php">Genres</a></li>
                </ul>
            </nav>
            <div class="search-container">
                <form action="search.php" method="GET">
                    <input type="text" name="query" placeholder="Rechercher..." class="search-bar" id="search-bar" value="' . (isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '') . '">
                    <button type="submit" style="display:none;">Rechercher</button>
                </form>
            </div>
        </div>
    </header>';
}

// Fonction pour afficher le pied de page (footer)
function afficherFooter() {
    echo '
    <footer>
        <p>&copy; 2024 Ciné Macabre. Tous droits réservés.</p>
    </footer>';
}
?>
