
# TomTroc

TomTroc est une application web d'échange de livres entre particuliers. Les utilisateurs peuvent consulter les livres disponibles, créer un compte, ajouter leurs propres livres et échanger des messages.

Ce projet a été réalisé dans le cadre de la formation Développeur d'application PHP d'OpenClassrooms.

## Technologies utilisées

- PHP 8 (programmation orientée objet et architecture MVC)
- MySQL avec PDO
- HTML et CSS
- Bootstrap 5

## Prérequis

- PHP avec les extensions PDO et PDO MySQL
- MySQL ou MariaDB
- XAMPP (Apache + MySQL)
- Git (pour cloner le dépôt)

## Installation

### 1. Récupérer le projet

Cloner le dépôt GitHub dans le dossier `htdocs` de XAMPP :

```bash
cd C:\xampp\htdocs
git clone URL_DU_DEPOT TomTroc
```

Remplacer `URL_DU_DEPOT` par l'adresse du dépôt GitHub.

Il est également possible de télécharger le projet au format ZIP et de l'extraire dans `C:\xampp\htdocs\TomTroc`.

### 2. Démarrer XAMPP

Ouvrir XAMPP et démarrer les services Apache et MySQL.

### 3. Importer la base de données

1. Ouvrir http://localhost/phpmyadmin/
2. Créer une nouvelle base de données nommée `tomtroc_test`.
3. Sélectionner cette base.
4. Cliquer sur l'onglet **Importer**.
5. Sélectionner le fichier `tomtroc_test.sql` présent à la racine du projet.
6. Lancer l'importation.

La base contient trois tables : `user`, `book` et `message`, ainsi que des données de démonstration.

### 4. Configurer la connexion MySQL

Ouvrir le fichier `config/config.php` et vérifier les paramètres de connexion à la base de données.

Pour une installation XAMPP classique :

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'tomtroc_test');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
```

Adapter ces paramètres selon la configuration locale.

### 5. Lancer le site

Ouvrir l'adresse suivante dans le navigateur :

http://localhost/TomTroc/

Le fichier `index.php` situé à la racine du projet sert de point d'entrée à l'application.

## Comptes de démonstration

Deux comptes sont disponibles pour tester les fonctionnalités du site.

| E-mail | Mot de passe |
| --- | --- |
| lecteur@example.com | TomTroc2026! |
| marie@example.com | TomTroc2026! |

Ces comptes permettent notamment de tester la connexion, les profils et la messagerie.

## Fonctionnalités

- Consultation des derniers livres ajoutés
- Catalogue et recherche de livres
- Consultation des fiches détaillées
- Inscription et connexion
- Gestion du profil utilisateur
- Ajout, modification et suppression de livres
- Consultation des profils publics
- Messagerie privée entre utilisateurs

## Architecture du projet

Le projet utilise une architecture MVC (Modèle-Vue-Contrôleur) et la programmation orientée objet.

```text
TomTroc/
├── config/
├── controllers/
├── entities/
├── managers/
├── public/
│   ├── css/
│   └── images/
├── services/
├── templates/
├── views/
├── index.php
├── README.md
└── tomtroc_test.sql
```

Les contrôleurs gèrent les actions de l'utilisateur, les managers communiquent avec la base de données et les vues affichent les pages.

## Problèmes fréquents

### Erreur de connexion à la base de données

Vérifier que MySQL est démarré, que la base `tomtroc_test` existe et que les identifiants dans `config/config.php` sont corrects.

### Page introuvable

Vérifier que le projet se trouve dans `C:\xampp\htdocs\TomTroc` et que l'adresse utilisée est bien http://localhost/TomTroc/.

### Images manquantes

Les images doivent être présentes dans `public/images/`. Le fichier SQL contient uniquement leurs chemins.

Certains livres de démonstration peuvent ne pas avoir de couverture.

## Contexte du projet

TomTroc est une association fictive à but non lucratif qui souhaite encourager le partage de livres et les rencontres entre lecteurs.

L'objectif du projet est de développer une plateforme permettant aux particuliers de proposer leurs livres et de communiquer pour organiser des échanges.

Le développement repose sur PHP, la programmation orientée objet, une architecture MVC et une base de données relationnelle.

Projet réalisé dans le cadre du parcours OpenClassrooms :

[Mettez en place un site de mise en relation avec PHP](https://openclassrooms.com/fr/paths/876/projects/1675)
