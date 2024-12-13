# Système de Gestion des Réservations



## Prérequis

- PHP 8.0 ou supérieur
- Composer
- Symfony CLI
- Une base de données (par exemple, MySQL)

## Installation

1. Clonez le dépôt :

   ```sh
   git clone https://github.com/Fvrenn/TpNote.git
   cd votre-repo

composer install


   Routes Disponibles
Routes pour les utilisateurs (administrateurs)
Liste des utilisateurs

URL : /admin/user
Nom : user_index
Méthode : GET
Description : Affiche la liste de tous les utilisateurs.
Créer un nouvel utilisateur

URL : /admin/user/new
Nom : user_new
Méthode : GET, POST
Description : Affiche le formulaire de création d'un nouvel utilisateur et traite la soumission du formulaire.
Voir les détails d'un utilisateur

URL : /admin/user/{id}
Nom : user_show
Méthode : GET
Description : Affiche les détails d'un utilisateur spécifique.
Modifier un utilisateur

URL : /admin/user/{id}/edit
Nom : user_edit
Méthode : GET, POST
Description : Affiche le formulaire de modification d'un utilisateur spécifique et traite la soumission du formulaire.
Supprimer un utilisateur

URL : /admin/user/{id}
Nom : user_delete
Méthode : POST
Description : Supprime un utilisateur spécifique.
Routes pour les réservations
Créer une nouvelle réservation

URL : /reservation/new
Nom : reservation_new
Méthode : GET, POST
Description : Affiche le formulaire de création d'une nouvelle réservation et traite la soumission du formulaire.
Liste des réservations

URL : /reservation
Nom : reservation_index
Méthode : GET
Description : Affiche la liste des réservations. Les administrateurs voient toutes les réservations, tandis que les utilisateurs voient uniquement leurs propres réservations.
Routes pour le profil utilisateur
Consulter le profil

URL : /profile
Nom : profile_show
Méthode : GET
Description : Affiche les informations personnelles de l'utilisateur connecté.
Modifier le profil

URL : /profile/edit
Nom : profile_edit
Méthode : GET, POST
Description : Affiche le formulaire de modification des informations personnelles de l'utilisateur connecté et traite la soumission du formulaire.


login: /login
logout: /logout