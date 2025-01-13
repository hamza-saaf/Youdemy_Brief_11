Contexte du projet
La plateforme de cours en ligne Youdemy vise à révolutionner l’apprentissage en proposant un système interactif et personnalisé pour les étudiants et les enseignants.

​

Fonctionnalités Requises:

​

Partie Front Office:

​

Visiteur:

Accès au catalogue des cours avec pagination.
Recherche de cours par mots-clés.
Création d’un compte avec le choix du rôle (Étudiant ou Enseignant).
​

Étudiant:

Visualisation du catalogue des cours.
Recherche et consultation des détails des cours (description, contenu, enseignant, etc.).
Inscription à un cours après authentification.
Accès à une section “Mes cours” regroupant les cours rejoints.
​

Enseignant:

Ajout de nouveaux cours avec des détails tels que:
Titre, description, contenu (vidéo ou document), tags, et catégorie.
Gestion des cours :
Modification, suppression et consultation des inscriptions.
Accès à une section “Statistiques” sur les cours:
Nombre d’étudiants inscrits, Nombre de cours, etc.
​

Partie Back Office:

​

Administrateur:

Validation des comptes enseignants.
Gestion des utilisateurs :
Activation, suspension ou suppression.
Gestion des contenus :
Cours, catégories et tags.
Insertion en masse de tags pour gagner en efficacité.
Accès à des statistiques globales :
Nombre total de cours, répartition par catégorie, Le cour avec le plus d' étudiants, Les Top 3 enseignants.
​

Fonctionnalités Transversales:

​

Un cours peut contenir plusieurs tags (relation many-to-many).
Application du concept de polymorphisme dans les méthodes suivantes : Ajouter cours et afficher cours.
Système d’authentification et d’autorisation pour protéger les routes sensibles.
Contrôle d’accès : chaque utilisateur ne peut accéder qu’aux fonctionnalités correspondant à son rôle.
​

Exigences Techniques:

​

Respect des principes OOP (encapsulation, héritage, polymorphisme).
Base de données relationnelle avec gestion des relations (one-to-many, many-to-many).
Utilisation des sessions PHP pour la gestion des utilisateurs connectés.
Système de validation des données utilisateur pour garantir la sécurité.
​

Bonus:

​

Recherche avancée avec filtres (catégorie, tags, auteur).
Statistiques avancées :
Taux d’engagement par cours, catégories les plus populaires.
Mise en place d’un système de notification:
Par exemple, validation de compte enseignant ou inscription confirmée à un cours.
Implémentation d’un système de commentaires ou d’évaluations sur les cours.
Génération de certificats PDF de complétion pour les étudiants.
Modalités pédagogiques
Travail: individuel Durée de travail:

5 jours Date de lancement du brief: 13/01/2025 à 09:00 am

Date limite de soumission: 20/01/2025 avant 05:30 pm

Modalités d'évaluation
Une durée de 35 min organisée comme suit:
- Présenter une défense publique de son travail devant les jurys.
- Chaque apprenants n'aura que ~10 minutes pour Démontrer le contenu et la fonctionnalité du site Web (Démonstration, explication du code source).
- Code Review \ Questions culture Web (10 minutes)
- Mise en situation (15 minutes)

Livrables
_ Lien de Repository Github du projet 
_ Lien de la présentation
_ Les diagrammes UML
  |_ Diagramme des cas d'utilisations
  |_ Diagramme de classes

Critères de performance
La logique métier et votre architecture doivent être clairement séparés.
Cohérence dans l'application des concepts OOP.
Amélioration de la structure et de la lisibilité du code.
Utilisation appropriée des classes, objets, méthodes, etc.
Les pages web doivent bien s'ajuster à tous les types d'écrans .
Utilisation de la validation côté client avec HTML5 et JavaScript (Natif) pour minimiser les erreurs avant même la soumission du formulaire.
Validation côté serveur doit inclure des mesures pour éviter les attaques de type Cross-Site Scripting (XSS) et Cross-Site Request Forgery (CSRF)
Utilisez des requêtes préparées pour interagir avec la base de données, afin de prévenir les attaques SQL injection.
Effectuez une validation et une échappement des données d'entrée pour éviter toute injection malveillante.
