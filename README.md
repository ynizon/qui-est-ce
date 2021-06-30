<h1>Qui est-ce</h1> 

## A propos

Cette application a été concue pour apprendre le développement web.
Elle utilise le framework PHP Laravel.
Le jeu propose la même chose que le jeu de société du même nom.
Les images ont étés réalisées via https://face.co

## Installation

- Remplir le fichier .env
- Créér la base de données
- Lancer les commandes:
  
        composer install    
        php artisan migrate --seed
        php artisan config:clear
        php artisan cache:clear   
        npm install
        npm run dev

## Cours

- Configuration (.env, config, composer)
- Authentification
- Création des modèles (User, Game, Card)
- Analyse des tables
- Ajout de personnage (SQL)
- Création des scripts d'imports
- Routing
- Controller
- Templating
- Pagination
- jQuery Ajax
- Traductions
- Hacking
- Pusher API

## License

Cette application est open-source et utilise la licence [GNU v3].
