import requests
import mysql.connector
from recupFilms import get_all_horror_movies

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

def get_movie_collection(movie_id):
    """Récupère la collection d'un film à partir de l'API TMDB."""
    url = f"{base_url}/movie/{movie_id}?api_key={api_key}&language=fr"
    response = requests.get(url)
    if response.status_code == 200:
        movie_data = response.json()
        if 'belongs_to_collection' in movie_data:
            return movie_data['belongs_to_collection']
        else:
            return None
    else:
        print(f"Erreur {response.status_code} lors de la récupération de la collection pour le film ID {movie_id}")
        return None

def insert_collection_into_db(collection):
    """Insère une collection dans la base de données si elle n'existe pas déjà."""
    try:
        nom = collection['name']
        description = collection.get('overview', '')
        url_image = f"https://image.tmdb.org/t/p/w500{collection.get('poster_path')}" if collection.get('poster_path') else None

        # Vérifier si la collection existe déjà
        cursor.execute("SELECT id_collection FROM collections WHERE nom = %s", (nom,))
        result = cursor.fetchone()
        if result:
            print(f"La collection '{nom}' existe déjà dans la base de données.")
            return result[0]

        # Insertion de la collection
        cursor.execute("""
        INSERT INTO collections (nom, description, url_image)
        VALUES (%s, %s, %s)
        """, (nom, description, url_image))
        db_connection.commit()

        print(f"Collection '{nom}' insérée avec succès.")
        return cursor.lastrowid
    except Exception as e:
        print(f"Erreur lors de l'insertion de la collection : {e}")
        return None

def link_movie_to_collection(movie_id, collection_id):
    """Relie un film à une collection dans la table film_collection."""
    try:
        # Vérifier si la relation existe déjà
        cursor.execute("""
        SELECT * FROM film_collection WHERE id_film = %s AND id_collection = %s
        """, (movie_id, collection_id))
        result = cursor.fetchone()
        if result:
            print(f"La relation entre le film ID {movie_id} et la collection ID {collection_id} existe déjà.")
            return

        # Insérer la relation dans la table film_collection
        cursor.execute("""
        INSERT INTO film_collection (id_film, id_collection)
        VALUES (%s, %s)
        """, (movie_id, collection_id))
        db_connection.commit()

        print(f"Film ID {movie_id} lié à la collection ID {collection_id} avec succès.")
    except Exception as e:
        print(f"Erreur lors de la liaison du film à la collection : {e}")

# Récupérer tous les films d'horreur et lier les films aux collections
total_movies = get_all_horror_movies()  # Utilise la fonction existante du script initial
for movie in total_movies:
    movie_id = movie.get('id')
    
    # Récupérer et insérer la collection du film
    collection = get_movie_collection(movie_id)
    if collection:
        collection_id = insert_collection_into_db(collection)
        if collection_id:
            # Relier le film à la collection
            link_movie_to_collection(movie_id, collection_id)

# Fermer la connexion
cursor.close()
db_connection.close()
