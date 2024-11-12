import requests
import mysql.connector
from recupFilms import get_all_horror_movies, insert_movie_into_db
# Informations de connexion à la base de données locale
db_connection = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="cine"
)

cursor = db_connection.cursor()

# Clé API de TMDB
api_key = '3688121c0e13643fb12d86d673c3bbf1'
base_url = 'https://api.themoviedb.org/3'

def get_genres():
    """Récupère la liste des genres de films à partir de l'API TMDB."""
    url = f"{base_url}/genre/movie/list?api_key={api_key}&language=fr"
    response = requests.get(url)
    if response.status_code == 200:
        return response.json().get('genres', [])
    else:
        print(f"Erreur {response.status_code} lors de la récupération des genres de films")
        return []

def insert_genre_into_db(genre):
    """Insère un genre dans la base de données s'il n'existe pas déjà."""
    try:
        id_genre = genre['id']
        nom = genre['name']

        # Vérifier si le genre existe déjà dans la table genres
        cursor.execute("SELECT id_genre FROM genres WHERE id_genre = %s", (id_genre,))
        result = cursor.fetchone()
        if result:
            print(f"Le genre '{nom}' existe déjà dans la base de données. Il sera ignoré.")
            return

        # Insertion du genre dans la table genres
        cursor.execute("""
        INSERT INTO genres (id_genre, nom)
        VALUES (%s, %s)
        """, (id_genre, nom))
        db_connection.commit()
        print(f"Genre '{nom}' inséré avec succès.")

    except Exception as e:
        print(f"Erreur lors de l'insertion du genre : {e}")

def link_movie_to_genres(movie_id, genre_ids):
    """Relie un film aux genres dans la table film_genre."""
    try:
        for genre_id in genre_ids:
            # Vérifier si la relation existe déjà
            cursor.execute("""
            SELECT * FROM film_genre WHERE id_film = %s AND id_genre = %s
            """, (movie_id, genre_id))
            result = cursor.fetchone()
            if result:
                print(f"La relation entre le film ID {movie_id} et le genre ID {genre_id} existe déjà.")
                continue

            # Insérer la relation dans la table film_genre
            cursor.execute("""
            INSERT INTO film_genre (id_film, id_genre)
            VALUES (%s, %s)
            """, (movie_id, genre_id))
            db_connection.commit()
            print(f"Relation entre le film ID {movie_id} et le genre ID {genre_id} insérée avec succès.")

    except Exception as e:
        print(f"Erreur lors de la liaison du film aux genres : {e}")

# Récupérer et insérer les genres dans la base de données
genres = get_genres()
for genre in genres:
    insert_genre_into_db(genre)

# Récupérer tous les films d'horreur et lier les genres
total_movies = get_all_horror_movies()  # Utilise la fonction existante du script initial
for movie in total_movies:
    movie_id = movie.get('id')
    genre_ids = movie.get('genre_ids', [])
    link_movie_to_genres(movie_id, genre_ids)

# Fermer la connexion
cursor.close()
db_connection.close()
