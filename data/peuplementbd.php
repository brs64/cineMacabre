<?php

// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cine";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connexion à la base de données réussie.<br>";

// Clé API TMDb (remplace par ta propre clé)
$apiKey = "3688121c0e13643fb12d86d673c3bbf1";  // Remplace par ta clé API valide

// ID du genre horreur sur TMDb
$horror_genre_id = 27;  // Genre 'Horror'

// Récupérer tous les films d'horreur via l'API TMDb
$page = 1;  // Commence avec la première page
$perPage = 20; // Nombre de films à récupérer par page
$allFilms = [];

// Fonction pour effectuer une requête cURL
function get_tmdb_data($url) {
    echo "Envoi de la requête à l'API TMDb...<br>";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

// Boucle pour récupérer toutes les pages
while (true) {
    echo "Récupération de la page $page...<br>";
    $url = "https://api.themoviedb.org/3/discover/movie?api_key={$apiKey}&with_genres={$horror_genre_id}&page={$page}&language=fr-FR";
    $data = get_tmdb_data($url);

    if (!isset($data['results']) || empty($data['results'])) {
        echo "Aucun film trouvé sur la page $page. Fin de la récupération.<br>";
        break;  // Si on n'a plus de films, on arrête la boucle
    }

    $allFilms = array_merge($allFilms, $data['results']);
    echo "Page $page : " . count($data['results']) . " films récupérés.<br>";
    $page++;
}

// Pour chaque film récupéré, vérifier s'il existe déjà dans la base et insérer-le si nécessaire
foreach ($allFilms as $film_data) {
    $film_id = $film_data['id'];
    $titre = $film_data['title'];
    $image_url = "https://image.tmdb.org/t/p/w500" . $film_data['poster_path'];
    $description = $film_data['overview'];
    $date_de_sortie = isset($film_data['release_date']) ? substr($film_data['release_date'], 0, 4) : NULL;
    $note = $film_data['vote_average'] ?? NULL;
    $trailer_url = NULL; // Ajouter un moyen d'obtenir le trailer si nécessaire

    // Vérifier si le film est déjà dans la base de données
    echo "Vérification de l'existence du film '$titre' dans la base de données...<br>";
    $sql_check_film = "SELECT id FROM films WHERE id_tmdb = '$film_id'";
    $result_check_film = $conn->query($sql_check_film);
    if ($result_check_film->num_rows > 0) {
        // Si le film existe déjà, on passe au suivant
        echo "Le film '$titre' existe déjà dans la base de données. Passage au suivant.<br>";
        continue;
    }

    // Insertion du film dans la table films
    $sql_film = "INSERT INTO films (id_tmdb, titre, image_url, description, dateDeSortie, trailer_url, note)
                 VALUES ('$film_id', '$titre', '$image_url', '$description', '$date_de_sortie', '$trailer_url', '$note')";
    if ($conn->query($sql_film) === TRUE) {
        $film_id_inserted = $conn->insert_id; // Récupérer l'ID du film inséré
        echo "Le film '$titre' a été inséré avec succès dans la base de données.<br>";
    } else {
        echo "Erreur d'insertion du film '$titre': " . $conn->error . "<br>";
        continue;
    }

    // Genres du film
    $genres = $film_data['genre_ids']; // Les genres sont simplement des IDs dans l'API
    foreach ($genres as $genre_id) {
        echo "Vérification de l'existence du genre $genre_id...<br>";
        // Vérifier si le genre existe déjà dans la base de données
        $sql_genre = "SELECT id FROM genres WHERE id_tmdb = '$genre_id'";
        $result_genre = $conn->query($sql_genre);
        if ($result_genre->num_rows > 0) {
            $genre_id_inserted = $result_genre->fetch_assoc()['id'];
            echo "Le genre $genre_id existe déjà dans la base de données.<br>";
        } else {
            // Si le genre n'existe pas, on l'ajoute
            echo "Le genre $genre_id n'existe pas. Insertion dans la base de données...<br>";
            $sql_insert_genre = "INSERT INTO genres (id_tmdb, nom) VALUES ('$genre_id', 'Genre non défini')";
            if ($conn->query($sql_insert_genre) === TRUE) {
                $genre_id_inserted = $conn->insert_id;
                echo "Le genre a été inséré avec succès.<br>";
            } else {
                echo "Erreur d'insertion du genre $genre_id: " . $conn->error . "<br>";
                continue;
            }
        }

        // Lier le film au genre
        $sql_film_genre = "INSERT INTO film_genres (film_id, genre_id) VALUES ('$film_id_inserted', '$genre_id_inserted')";
        if ($conn->query($sql_film_genre) !== TRUE) {
            echo "Erreur de liaison entre le film '$titre' et le genre $genre_id: " . $conn->error . "<br>";
        }
    }

    // Réalisateur(s) du film
    echo "Traitement des réalisateurs du film '$titre'...<br>";
    $realisateurs = $film_data['credits']['crew'];
    foreach ($realisateurs as $realisateur) {
        if ($realisateur['job'] == 'Director') {
            $realisateur_name = $realisateur['name'];

            // Vérifier si le réalisateur existe dans la base de données
            $sql_realisateur = "SELECT id FROM realisateurs WHERE nom = '$realisateur_name'";
            $result_realisateur = $conn->query($sql_realisateur);
            if ($result_realisateur->num_rows > 0) {
                $realisateur_id = $result_realisateur->fetch_assoc()['id'];
                echo "Le réalisateur '$realisateur_name' existe déjà dans la base de données.<br>";
            } else {
                // Si le réalisateur n'existe pas, on l'ajoute
                echo "Le réalisateur '$realisateur_name' n'existe pas. Insertion dans la base de données...<br>";
                $sql_insert_realisateur = "INSERT INTO realisateurs (nom) VALUES ('$realisateur_name')";
                if ($conn->query($sql_insert_realisateur) === TRUE) {
                    $realisateur_id = $conn->insert_id;
                    echo "Le réalisateur a été inséré avec succès.<br>";
                } else {
                    echo "Erreur d'insertion du réalisateur '$realisateur_name': " . $conn->error . "<br>";
                    continue;
                }
            }

            // Lier le film au réalisateur
            $sql_film_realisateur = "INSERT INTO film_realisateurs (film_id, realisateur_id) VALUES ('$film_id_inserted', '$realisateur_id')";
            if ($conn->query($sql_film_realisateur) !== TRUE) {
                echo "Erreur de liaison entre le film '$titre' et le réalisateur '$realisateur_name': " . $conn->error . "<br>";
            }
        }
    }

    // Acteurs du film
    echo "Traitement des acteurs du film '$titre'...<br>";
    $acteurs = $film_data['credits']['cast'];
    foreach ($acteurs as $acteur) {
        $acteur_name = $acteur['name'];

        // Vérifier si l'acteur existe déjà dans la base de données
        $sql_acteur = "SELECT id FROM acteurs WHERE nom = '$acteur_name'";
        $result_acteur = $conn->query($sql_acteur);
        if ($result_acteur->num_rows > 0) {
            $acteur_id = $result_acteur->fetch_assoc()['id'];
            echo "L'acteur '$acteur_name' existe déjà dans la base de données.<br>";
        } else {
            // Si l'acteur n'existe pas, on l'ajoute
            echo "L'acteur '$acteur_name' n'existe pas. Insertion dans la base de données...<br>";
            $sql_insert_acteur = "INSERT INTO acteurs (nom) VALUES ('$acteur_name')";
            if ($conn->query($sql_insert_acteur) === TRUE) {
                $acteur_id = $conn->insert_id;
                echo "L'acteur a été inséré avec succès.<br>";
            } else {
                echo "Erreur d'insertion de l'acteur '$acteur_name': " . $conn->error . "<br>";
                continue;
            }
        }

        // Lier le film à l'acteur
        $sql_film_acteur = "INSERT INTO film_acteurs (film_id, acteur_id) VALUES ('$film_id_inserted', '$acteur_id')";
        if ($conn->query($sql_film_acteur) !== TRUE) {
            echo "Erreur de liaison entre le film '$titre' et l'acteur '$acteur_name': " . $conn->error . "<br>";
        }
    }
}

echo "Traitement terminé.<br>";
$conn->close();
?>
