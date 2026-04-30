# LibraireOnline

LibraireOnline est un site de vente en ligne de livres (romans, essais, manuels techniques, etc.).

## Membres
- Mohamed Aziz Khaldi
- Mohamed Amine Hadji
- Souhail Jemai

## Groupes
- Groupe D
- Groupe C

## Ce que fait le site

- **Page principale** : afficher les livres populaires.
- **Page livre** : montre les détails d'un livre (couverture, description, prix, auteur, nombre de pages) avec la possibilité de filtrer par catégorie (genre).
- **Panier** : l'utilisateur peut ajouter des livres, changer les quantités et voir le total.
- **Connexion** : une page pour se connecter avec un email et un mot de passe.

## Technologies utilisées

- **PHP** : pour afficher les livres depuis la base de données.
- **MySQL** : pour stocker les livres et les utilisateurs.
- **HTML / CSS** : pour la mise en page et le design.
- **JavaScript** : pour gérer le panier sans recharger la page et valider les formulaires.
- **AJAX** : pour la recherche et le filtrage en temps réel.

## Structure des fichiers

```
add_order.php          → ajout de commandes
admin_edit_book.php    → édition des livres (admin)
auth.php               → gestion de l'authentification
book_detail.php        → page d'un seul livre
books.php              → page d'accueil avec la liste des livres
cart.php               → gestion du panier
check_email.php        → vérification email (AJAX)
connexion.php          → traitement de la connexion
filtre.car             → filtrage des livres (archivé)
filter_books.php       → filtrage par catégorie (AJAX)
index.php              → redirection vers books.php
login.php              → page de connexion
logout.php             → déconnexion
register.php           → page d'inscription
scriptjs               → fichiers JavaScript
script.sql             → base de données MySQL
styles.css             → feuille de styles principale
update_book.php        → mise à jour des livres (admin)
```


## Fonctionnalités principales

-  Affichage dynamique des livres depuis la base de données
-  Recherche et filtrage par catégorie (AJAX)
-  Tri par prix et par titre
-  Gestion du panier (ajout, modification, suppression)
-  Connexion et inscription avec validation
-  Hash sécurisé des mots de passe
-  Design responsive (mobile, tablette, desktop)

##  Accès administrateur


**Utilisateur administrateur par défaut** :
- **Nom** : admin
- **Email** : admin@admin.com
- **Mot de passe** : admin

L'utilisateur admin peut modifier les détails des livres (titre, prix, description, etc.) dans la page "Nos Livres" grâce à une interface d'édition réservée aux administrateurs.
