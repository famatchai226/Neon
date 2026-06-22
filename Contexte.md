# Contexte du Projet "Neon" : MVP Vente de Produits Digitaux

## 1\. Brève Description

Plateforme MVP permettant à un vendeur unique de vendre des fichiers digitaux (PDF, MP3, MP4, ZIP). Les acheteurs paient par Mobile Money (Orange Money, MTN) via CinetPay et reçoivent un lien de téléchargement temporaire. Stack : Laravel 11, Blade, Tailwind, MySQL.

## 2\. Architecture \& Structure du Code

* **Structure MVC stricte** : Pas de logique métier dans les contrôleurs (utiliser des Services si nécessaire).
* **Modèles** : `User` (role : admin/customer), `Product` (titre, description, prix, file\_path), `Order` (user\_id, product\_id, amount, status, transaction\_id), `DownloadToken` (token, order\_id, expires\_at).
* **Contrôleurs clés** : `ProductController`, `OrderController`, `PaymentController`, `DownloadController`.
* **Middlewares** : `auth` (client), `auth` + `admin` (back-office).
* **Stockage** : Disque `private` pour les fichiers (pas d'accès direct par URL).
* **Typographie** : "Elms Sans" Designed by Amarachi Nwauwa, Gida Type Studio.
* **Palette de couleur** : "212529","495057","ADB5BD","DEE2E6".


## 3\. Règles de Code \& Bonnes Pratiques (ESSENTIEL)

* **PSR-12** : Respecter les normes de codage PHP (indentation, nommage `camelCase` pour les variables, `PascalCase` pour les classes).
* **Sécurité** :

  * Toujours utiliser l'ORM Eloquent et le Query Builder (jamais de requêtes SQL brutes).
  * Protection CSRF sur tous les formulaires (sauf webhooks).
  * Échappement automatique de Blade (`{{ }}`), jamais `{!! !!}` sauf exception justifiée.
  * Mots de passe hashés avec `Hash::make()` ou `bcrypt()`.
* **Validation** : Utiliser les `FormRequest` pour centraliser les règles de validation, ou au minimum `$request->validate()` dans les contrôleurs.
* **Routes** : Grouper par middleware. Utiliser les routes `resource` quand c'est pertinent.
* **Gestion des erreurs** : Utiliser les sessions avec `with('success')` / `with('error')` pour les feedbacks utilisateurs.
* **Frontend** : Uniquement Blade + Tailwind. Pas de Vue.js/React. Utiliser Alpine.js uniquement pour les interactions basiques (modales, toasts).

## 4\. Mémoire du Projet (Maintien du Contexte)

* **Fichier `contexte.md`** : Ce fichier DOIT être mis à jour à la fin de chaque phase majeure pour y ajouter les décisions techniques importantes (ex: "On a choisi CinetPay au lieu de Paytech", "On stocke localement car pas de S3").
* **Objectif** : Éviter que l'IA ne repose les mêmes questions à chaque session.

## 5\. Cadre \& Rôle de l'IA

L'IA agit en tant que **Développeur Senior Certifié**.

* **Responsabilités** : Proposer des solutions robustes, signaler les failles de sécurité potentielles, suggérer des refactorings.
* **Ce qu'il ne faut PAS faire** :

  * Ne pas ajouter de fonctionnalités hors scope (ex: pas de filigrane pour le MVP, pas de multi-vendeurs, pas de paiement par carte si CinetPay le gère déjà).
  * Ne pas over-engineering : Pas de Redis, pas de queues, pas de micro-services pour un MVP.
  * Ne jamais écrire de logique métier dans les templates Blade.

## 6\. Code Modulaire et Concis

* **Taille des fichiers** : Un contrôleur ne doit pas dépasser 200 lignes. Si c'est le cas, extraire dans des `Services` (ex: `PaymentService`, `FileService`).
* **Vues** : Découper les grandes pages en `partials` (header, footer, toasts).
* **Nettoyage** : Supprimer automatiquement les commentaires de debug, les `dd()` et les routes inutilisées avant de pousser une phase.

## 7\. Guide de Précision (Interaction avec l'IA)

* Avant de coder une fonctionnalité, l'IA doit clarifier les ambiguïtés (ex: "Quelle durée pour le token ?" -> 24h).
* Proposer systématiquement **3 scénarios** si une décision technique est ouverte (ex: hébergement des fichiers) en justifiant le choix recommandé.
* Générer les migrations avec les `foreignId` et les `cascade` appropriés.

## 8\. Découpage en Phases (Travail par Étape)

**Phase 1 : Setup \& Auth**

* Installation Laravel 11, Breeze (Blade), configuration `.env`.
* Migration `users` avec champ `role` (default 'customer').
* Seeder pour créer un admin (`email: admin@exemple.com`, `password: password`).

**Phase 2 : Back-Office (Admin)**

* CRUD complet des `Products` (upload de fichier) avec middleware admin.
* Dashboard admin avec affichage des stats basiques (nb produits, nb commandes).

**Phase 3 : Pages Publiques \& Produits**

* Page d'accueil listant les produits.
* Page de détail d'un produit avec bouton "Acheter".

**Phase 4 : Paiement (Intégration CinetPay)**

* Modèles `Order` et `DownloadToken`.
* Route de redirection vers CinetPay.
* Webhook de retour pour valider le paiement.

**Phase 5 : Livraison \& Espace Client**

* Téléchargement sécurisé par token (expiration 24h).
* Page "Mes achats" pour les clients.
* Envoi d'email transactionnel après achat.

**Phase 6 : Tests \& Finalisation**

* Test du flux complet (inscription -> achat -> téléchargement).
* Correction des bugs mineurs.
* Optimisation des requêtes (N+1).

