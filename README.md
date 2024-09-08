=======================================
Gestionnaire de Contacts - Symfony 6
=======================================

Description
-----------
Cette application est un gestionnaire de contacts développé avec Symfony 6. Elle permet d'ajouter, afficher, modifier, supprimer et rechercher des contacts (nom, email, téléphone). L'interface est moderne grâce à l'intégration de Bootstrap 5 et la pagination est gérée avec KnpPaginatorBundle.

Fonctionnalités
---------------
- Ajouter un contact via un formulaire dans une modale.
- Modifier un contact existant.
- Supprimer un contact avec confirmation.
- Recherche de contacts par nom ou email.
- Pagination des résultats.
- Validation des formulaires.

Technologies Utilisées
----------------------
- Symfony 6
- Twig pour les templates
- Bootstrap 5 pour la mise en page
- Doctrine ORM pour la gestion de la base de données
- MySQL comme base de données
- KnpPaginatorBundle pour la pagination

Prérequis
---------
Avant de démarrer l'application, assurez-vous d'avoir installé :
- PHP 8.1 ou supérieur
- Composer
- MySQL
- Symfony CLI (optionnel mais recommandé)

Installation
------------
1. Clonez le dépôt :
   git clone https://github.com/username/gestionnaire-de-contacts.git
   cd gestionnaire-de-contacts
2. Installer les dépendances :
   composer install
3. Créer la base de données :
   php bin/console doctrine:database:create
4. Exécuter les migrations :
   php bin/console doctrine:migrations:migrate
5. Démarrer le serveur Symfony :
   symfony server:start
🎉️ 6. Accédez à l'application dans votre navigateur à l'adresse suivante : http://localhost:8000


Auteur
------
Projet développé par **Abderrahim Miraoui**.
