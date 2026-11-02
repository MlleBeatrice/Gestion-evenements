# Gestion des événements et inscriptions

Application web développée avec Laravel qui permet de consulter un catalogue d'événements, de s'y inscrire et d'annuler son inscription.

## Présentation

Le projet répond au sujet « Gestion des événements et inscriptions ». Les visiteurs parcourent un catalogue d'événements, le filtrent par mot-clé, catégorie ou date, consultent le détail d'un événement et s'y inscrivent avec leur nom et leur email. Le nombre de places restantes est mis à jour automatiquement, et une inscription peut être annulée à tout moment.

L'application ne comporte pas d'authentification : l'inscription repose uniquement sur un nom et une adresse email.

## Équipe

- **SEGNIAGBETO Adjoua Dobreda Béatrice** (Membre 1) : catalogue des événements, recherche et filtres, page de détail, seeders, vérification globale du projet.
- **[NOM COMPLET DE LA BINÔME]** (Membre 2) : inscriptions et annulations, validation des données, gestion des places restantes, rédaction de la documentation.

Les deux membres ont validé ensemble la structure de la base de données et testé le parcours complet de l'application.

## Fonctionnalités

- Catalogue paginé des événements à venir
- Recherche par mot-clé (titre, description, lieu)
- Filtres par catégorie et par date
- Page de détail avec compteur de places restantes
- Inscription avec validation des champs et messages d'erreur en français
- Refus des doublons : un même email ne peut s'inscrire qu'une seule fois à un événement
- Blocage des inscriptions lorsque l'événement est complet
- Page de confirmation et annulation d'une inscription
- Affichage adapté aux téléphones et aux ordinateurs

## Choix techniques

- **Laravel**, selon l'architecture MVC
- **MySQL** pour la base de données (SQLite n'est pas utilisé)
- **Blade** et **Tailwind CSS**, compilés avec **Vite**
- Trois tables liées par des clés étrangères : `categories`, `events` et `registrations`, cette dernière avec une contrainte d'unicité sur le couple (événement, email)
- Filtres de recherche implémentés sous forme de scopes Eloquent dans le modèle `Event`
- Places restantes calculées à partir de la capacité de l'événement et du nombre d'inscriptions

## Installation

Prérequis : PHP 8.2 ou plus, Composer, Node.js, MySQL (par exemple via XAMPP) et Git.

1. Cloner le dépôt et se placer dans le dossier :

```bash
git clone https://github.com/MlleBeatrice/Gestion-evenements.git
cd Gestion-evenements
```

2. Installer les dépendances :

```bash
composer install
npm install
```

3. Créer le fichier d'environnement et générer la clé de l'application :

```bash
cp .env.example .env
php artisan key:generate
```

Sous Windows (invite de commandes), remplacer `cp` par `copy`.

4. Créer une base de données MySQL vide nommée `gestion_evenements`, par exemple depuis phpMyAdmin.

5. Vérifier la configuration de la base dans le fichier `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_evenements
DB_USERNAME=root
DB_PASSWORD=
```

6. Créer les tables et insérer les données de test :

```bash
php artisan migrate --seed
```

7. Compiler les styles et lancer le serveur :

```bash
npm run build
php artisan serve
```

L'application est alors accessible à l'adresse `http://127.0.0.1:8000`.

Pour repartir de données propres à tout moment : `php artisan migrate:fresh --seed`.

## Utilisation

1. Parcourir le catalogue et utiliser la recherche et les filtres.
2. Ouvrir un événement pour consulter son détail et les places disponibles.
3. Remplir le formulaire d'inscription : une page de confirmation récapitule l'inscription.
4. Annuler l'inscription depuis cette page si nécessaire.

L'événement « Petit-déjeuner des développeurs » ne compte que cinq places, ce qui permet de vérifier facilement le comportement d'un événement complet.