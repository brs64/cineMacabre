import requests
import mysql.connector

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

def get_movie_data(movie_id):
    """Récupère les détails d'un film à partir de l'API TMDB."""
    url = f"{base_url}/movie/{movie_id}?api_key={api_key}&language=fr"
    response = requests.get(url)
    if response.status_code == 200:
        return response.json()
    else:
        print(f"Erreur {response.status_code} lors de la récupération du film ID {movie_id}")
        return None

def insert_movie_into_db(movie):
    """Insère un film dans la base de données si il n'existe pas déjà."""
    try:
        # Vérifier si le film existe déjà dans la table films
        titre = movie.get('title')
        cursor.execute("SELECT id_film FROM films WHERE titre = %s", (titre,))
        result = cursor.fetchone()
        if result:
            print(f"Le film '{titre}' existe déjà dans la base de données. Il sera ignoré.")
            return

        # Extraction des détails
        image_url = f"https://image.tmdb.org/t/p/w500{movie.get('poster_path')}" if movie.get('poster_path') else None
        description = movie.get('overview')
        date_sortie = int(movie.get('release_date', '0000-00-00')[:4]) if movie.get('release_date') else None
        note = movie.get('vote_average')

        # Insertion du film dans la table films
        cursor.execute("""
        INSERT INTO films (titre, url_image, description, date_sortie, note)
        VALUES (%s, %s, %s, %s, %s)
        """, (titre, image_url, description, date_sortie, note))
        db_connection.commit()

        # Récupérer l'ID du film inséré
        id_film = cursor.lastrowid

        print(f"Film '{titre}' inséré avec succès.")
    except Exception as e:
        print(f"Erreur lors de l'insertion : {e}")

def get_horror_movies(page=1):
    """Récupère les films d'horreur à partir de l'API TMDB avec pagination."""
    genre_id = 27  # ID du genre horreur
    url = f"{base_url}/discover/movie?api_key={api_key}&with_genres={genre_id}&language=fr&page={page}"
    response = requests.get(url)
    if response.status_code == 200:
        return response.json()
    else:
        print(f"Erreur {response.status_code} lors de la récupération des films d'horreur")
        return None

def get_all_horror_movies():
    """Récupère tous les films d'horreur en paginant sur plusieurs pages."""
    all_horror_movies = []
    page = 1
    
    # Effectuer la première requête pour connaître le nombre total de films disponibles
    first_page_data = get_horror_movies(page)
    
    if first_page_data is None:
        print("Erreur lors de la récupération de la première page.")
        return []
    
    total_results = first_page_data['total_results']
    total_pages = first_page_data['total_pages']
    print(f"Total de films d'horreur disponibles : {total_results}, Nombre de pages : {total_pages}")

    # Ajouter les films de la première page
    all_horror_movies.extend(first_page_data['results'])
    
    # Boucler pour récupérer les films des pages suivantes
    for page in range(2, total_pages + 1):
        print(f"Récupération de la page {page}/{total_pages}")
        page_data = get_horror_movies(page)
        if page_data:
            all_horror_movies.extend(page_data['results'])
        else:
            break
    
    return all_horror_movies

# Récupérer tous les films d'horreur
all_horror_movies = get_all_horror_movies()
for movie in all_horror_movies:
    # Insertion du film dans la base de données
    insert_movie_into_db(movie)

# Fermer la connexion
cursor.close()
db_connection.close()
