4054 & 4155 - Conception base de données

**4054**

- [X] Creation des layouts et des variables scss
  - [X] scss
  - [X] layout-client.php
  - [X] layout-admin.php
- [X] Creation de l'authentification administrateur et la page login pour la connexion vers la backoffice
  - [X] Model / Views / Controllers / Routes
  - [X] Test des données erronés et vraies
- [X] Page dashboard
  - [X] Recuperation des données à la base de données
  - [X] Creation de page dashboard
  - [X] Model / Views / Controllers / Routes
  - [X] Creation de protection de lien pour eviter que la page soit acccessible directement via url
- [X] Page Prefixe
  - [X] Create Read et Delete pour les prefixes de l'operateur
- [X] Page Bareme
  - [X] Affichage de tout les baremes de l'operateur (Retrait, dépôt, transfert)
  - [X] Tranche (min-max), frais, action(delete)
  - [X] Filtre par type des barèmes

**4155**
- [X] Espace client et authentification
- [X] Première connexion et authentification par numéro de téléphone
- [X] Modèle, Vues, Contrôleurs et Routes pour le login client
- [X] Gestion du solde et des opérations du client
- [X] Modèle du solde du compte et affichage dans le tableau de bord
- [X] Gestion des opérations de dépôt (modèle, contrôleur, vue, routes)
- [X] Gestion des opérations de retrait avec calcul automatique des frais via le barème et vérification du solde suffisant
- [X] Gestion des transferts avec vérification de l'existence du destinataire, prévention des transferts vers soi-même, calcul des frais et validation du solde
