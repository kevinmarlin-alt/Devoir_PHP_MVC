# Devoir PHP MVC
« Touche pas au klaxon » est un site intranet conçu pour faciliter le covoiturage entre les employés des différentes agences du groupe, optimisant ainsi l’occupation des véhicules en fonction des besoins de chaque agence.

# Fonctionnalités
## Visiteur

- Consultation de la liste des trajets disponible en fonction du nombre de place disponible et la date du jour
## Employé connecté
- Créer un nouveau trajet
- Modifier ou supprimer un trajet s'il en est le propriétaire
## Administrateur
- Accéder au tableau de bord
- Supprimer des trajets
- Mettre à jour le mot de passe d'un employé
- Modifier ou supprimer une agence

# Stack technique
## Backend
- PHP

## Base de donnée
- MySQL

# Installation

1. Cloner le projet dans le dossier de votre choix
```bash
git clone https://github.com/kevinmarlin-alt/Devoir_PHP_MVC.git
```

2. Accéder au dossier du projet :
```bash
cd Devoir_PHP_MVC
```

3. Installation des dépendance avec `composer`

Pré requis Composer doit être installé sur votre machine
```bash
composer install
```

# Base de donnée
1. Création de la base de donnée

Dans le dossier `DATABASE`, executer le script SQL `klaxon_db.sql` dans l'outil de gestion MySQL que vous désirez, soit via le terminal ou bien à partir de phpmyadmin.

⚠️ En prenant bien le soin de définir des mots de passe pour les deux utilisateurs 
(klaxon_admin & klaxon_users) ⚠️

2. Alimentation de la base de donnée

Executer le script SQL `klaxon_data.sql`

# Environnement

1. Créer un fichier dans le dossier `app`, nommer `env.php`

2. Copier/coller le contenu suivant dans le fichier
```bash
<?php

$db['ADMIN'] = [
    'host' => 'localhost',
    'dbname' => 'klaxon',
    'user' => 'klaxon_admin',
    'password' => '******' // Mot de passe utilisateur klaxon_admin créé dans la partie Base de donnée
    ];

$db['USERS'] = [
    'host' => 'localhost',
    'dbname' => 'klaxon',
    'user' => 'klaxon_users',
    'password' => '******' // Mot de passe utilisateur klaxon_users créé dans la partie Base de donnée
    ];

return $db;
```


# Tests
Des tests unitaires sont présent, permettant de garantir le bon fonctionnement du site avant son lancement.

L'exécution des tests unitaires sont réalisés avec la commande suivante :
```bash
./vendor/bin/phpunit
```
L'option `--testdox` permet de lister l'ensemble des tests réaliser et leurs validation :
```bash
./vendor/bin/phpunit --testdox
```

# Lancement
Pour visualiser le site intranet en local, il faut au préalable créer un fichier `env.php` à la racine du projet


1. Démarrer un serveur php local avec la commande suivante :
```bash
php -S localhost:8000 -t public
```

2. Le site est consultable en local à l'adresse suivante

 http://localhost:8000 

 # 💃🏻🎉