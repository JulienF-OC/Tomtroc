# TomTroc

TomTroc est une application web d'échange de livres entre particuliers. Les utilisateurs peuvent consulter les livres disponibles, créer un compte, ajouter leurs propres livres et échanger des messages.

## Technologies utilisées

- PHP (architecture MVC)
- MySQL avec PDO
- HTML, CSS et Bootstrap 5
- Font Awesome

## Prérequis

- PHP avec les extensions PDO et PDO MySQL
- MySQL ou MariaDB
- Un serveur web local, par exemple **XAMPP** (Apache + MySQL)
- Le fichier `tomtroc_soutenance.sql` fourni avec le projet

## Installation avec XAMPP

### 1. Récupérer le projet

Cloner le dépôt dans le dossier `htdocs` de XAMPP :

```bash
cd C:\xampp\htdocs
git clone URL_DU_DEPOT TomTroc
```

Remplacer `URL_DU_DEPOT` par l'adresse du dépôt GitHub. Il est aussi possible de télécharger le ZIP du dépôt et d'extraire son contenu dans `C:\xampp\htdocs\TomTroc`.

### 2. Démarrer les services

Ouvrir le panneau de contrôle XAMPP et démarrer **Apache** et **MySQL**.

### 3. Préparer la base de données

1. Ouvrir [phpMyAdmin](http://localhost/phpmyadmin/).
2. Créer une base de données nommée `tomtroc` (ou choisir un autre nom).
3. Ouvrir la base créée, puis l’onglet **Importer**.
4. Sélectionner `tomtroc_soutenance.sql` à la racine du dépôt et lancer l’import.

Le fichier crée les tables `user`, `book` et `message`, avec des livres et des comptes de démonstration. Utiliser de préférence une base vide pour éviter les conflits de tables existantes.

### 4. Configurer la connexion MySQL

Configurer les identifiants MySQL dans `config/config.php`. Si le dépôt contient `config/config.example.php`, le copier d’abord en `config/config.php` :

```php
<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'tomtroc');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
```

Ces valeurs correspondent à une configuration XAMPP locale courante. Adapter les identifiants si nécessaire.

Ne pas publier de vrais identifiants de connexion dans le dépôt.

### 5. Lancer l'application

Dans le navigateur, ouvrir :

**http://localhost/TomTroc/**

Le fichier `index.php` à la racine du projet sert de point d'entrée et gère les différentes pages.

## Comptes de démonstration

Deux comptes permettent de tester la connexion et la messagerie :

| E-mail | Mot de passe |
| --- | --- |
| `lecteur@example.com` | `TomTroc2026!` |
| `marie@example.com` | `TomTroc2026!` |

Ces identifiants sont réservés à la démonstration locale.

## Fonctionnalités

- Consulter les derniers livres ajoutés et le catalogue
- Rechercher des livres
- Voir la fiche détaillée d'un livre et le profil de son propriétaire
- Créer un compte et se connecter
- Modifier ses informations et sa photo de profil
- Ajouter, modifier et supprimer ses livres
- Envoyer et consulter des messages entre utilisateurs

## Organisation du projet

```text
TomTroc/
├── config/          # Configuration et chargement des classes
├── controllers/     # Contrôleurs
├── entities/        # Entités métier
├── managers/        # Accès aux données avec PDO
├── public/          # CSS et images
├── services/        # Affichage des vues
├── templates/       # Structure commune des pages
├── views/           # Pages de l'application
└── index.php        # Point d'entrée et routage
```

## Problèmes fréquents

**Erreur de connexion à la base de données :** vérifier que MySQL est démarré, que la base existe et que les valeurs de `config/config.php` sont correctes.

**Page introuvable :** vérifier que le dossier s'appelle bien `TomTroc` dans `htdocs` et utiliser l'adresse `http://localhost/TomTroc/`.

**Pages vides ou erreurs SQL :** vérifier que les tables attendues par le projet ont bien été importées.

**Couvertures absentes :** le SQL contient des chemins vers les fichiers d’images, mais pas les images elles-mêmes. Vérifier le contenu de `public/images/`. Les livres « Le Petit Prince » et « Les Misérables » n’ont pas de couverture renseignée dans la base de démonstration.

## Remarque

Ce projet est prévu pour être lancé en local. Les paramètres de connexion, la gestion des fichiers envoyés et la configuration du serveur doivent être adaptés avant toute mise en production.
