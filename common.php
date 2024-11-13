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
    <link rel="icon" href="https://static.thenounproject.com/png/79658-200.png">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>

<body>
    <header>
        <div class="container">
            <div class="header-left">
                <h1><a href="index.php" class="logo-link">Ciné Macabre</a></h1>
            </div>
             <div class="search-container">
            <form action="search.php" method="GET">
                <input type="text" name="query" placeholder="Rechercher..." class="search-bar" id="search-bar" value="' . (isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '') . '">
                <button type="submit" style="display:none;">Rechercher</button>
            </form>
        </div>
            <nav>
                <ul>
                    <li><a href="films.php">Films</a></li>
                    <li><a href="collections.php">Collections</a></li>
                    <li><a href="genres.php">Genres</a></li>
                </ul>
            </nav>
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
