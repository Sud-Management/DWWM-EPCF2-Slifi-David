# Phase 3 : Sécurité, gestion des utilisateurs et droits d'accès (1 journée)

---

## Objectifs de la journée

- Installer et configurer le bundle Security de Symfony.
- Mettre en place le système d’authentification :
  - Formulaires d’inscription et de connexion personnalisés.
  - Gestion sécurisée du hashage des mots de passe.
  - Gestion des rôles utilisateur.
- Créer le formulaire de modification de profil (et changement de mot de passe).
- Ajouter des validations avancées :
  - Email unique et format valide.
  - Mot de passe fort (longueur, complexité minimale).
  - Validation côté serveur.
- Sécuriser les accès aux opérations sensibles (modification/suppression d’événement, gestion des profils, etc.) à l’aide de voters Symfony.

---

## Tâches à réaliser

- Installer et configurer le composant Security de Symfony (`security.yaml`) si ce n’est pas déjà fait.
- Générer et personnaliser les formulaires :
  - Inscription
  - Connexion
  - Modification du profil
  - Changement de mot de passe
- Configurer le hashage sécurisé des mots de passe (bcrypt / argon2).
- Mettre en place la gestion des rôles pour les utilisateurs :
  - Attribution automatique du rôle `ROLE_USER` à l’inscription.
  - Gestion de l’élévation ou suppression des rôles (`ROLE_ORGA`, `ROLE_ADMIN`) par un admin.
- Ajouter des validations robustes sur les formulaires :
  - Unicité de l’email
  - Contraintes sur le mot de passe
- Vérifier la sécurité de toutes les routes sensibles :
  - Accès restreint selon le rôle
  - Vérification via voter

---

## Livrables attendus

- Fichier `security.yaml` opérationnel et bien structuré.
- Pages personnalisées :
  - Inscription
  - Modification du profil
  - Changement de mot de passe
- Page de connexion opérationnelle (pas le formulaire par défaut).
- Mécanisme d’authentification fonctionnel avec gestion des rôles.
- Validations avancées sur tous les formulaires :
  - Backend
  - Affichage des erreurs en front
- Au moins un voter Symfony utilisé dans les contrôleurs pour sécuriser un accès à une ressource (ex : événements).

---

## Critères d’évaluation

- **Authentification** : les utilisateurs peuvent s’inscrire, se connecter et se déconnecter.
- **Personnalisation** : les formulaires sont bien modifiés, non génériques.
- **Sécurité** :
  - Mots de passe hashés
  - Email unique
  - Rôles correctement affectés et utilisés
- **Validations** : les contraintes sont bien mises en œuvre :
  - Format des champs
  - Unicité de l'email
  - Mot de passe robuste
- **Gestion des rôles** : l'accès à certaines parties de l'application dépend du rôle connecté.
- **Clarté du feedback utilisateur** :
  - Messages d’erreur explicites
  - Messages de validation clairs

---

## Conseils & attendus particuliers

- Utilisez la documentation officielle de Symfony pour :
  - La configuration de la sécurité
  - La création et l’utilisation de voters
- Pensez à tester plusieurs cas :
  - Utilisateur simple
  - Organisateur
  - Administrateur
  - Tentatives d'accès interdit
- Enrichissez les messages d’interface pour améliorer l’expérience utilisateur :
  - Feedback en cas d’erreur
  - Confirmation en cas de succès
