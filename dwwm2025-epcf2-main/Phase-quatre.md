# Phase 4 : Gestion des événements et des participations (1 journée et demi)

## Objectifs de la journée

- **Implémenter la logique métier des événements :**
  - Création, modification et suppression d’un événement par un organisateur ou un administrateur.
  - Association d’un événement à un lieu, une catégorie, et ajout de médias.
  - Affichage détaillé de la liste des événements.

- **Mettre en place le système de participation des utilisateurs :**
  - Demande de participation à un événement.
  - Validation, refus ou annulation d’une participation par l’organisateur ou l’administrateur.
  - Suivi du statut de la participation pour chaque utilisateur (annulée, acceptée, refusée).
  - Affichage de la liste des participants pour chaque événement, avec leur statut.

---

## Tâches à réaliser

- Générer et personnaliser les interfaces de **création, modification et suppression d’événements** (formulaires, pages).
- Gérer l’affectation d’un **lieu**, d’une **catégorie** et d'un **média** à un événement.
- Afficher la **liste des événements** avec recherche et filtres (date, lieu, catégorie, organisateur…).
- Permettre à un utilisateur de **demander à participer** à un événement.
- Implémenter la **gestion des demandes de participation** (validation / refus par l’organisateur ou l’administrateur).
- Mettre à jour le **statut de participation**.
- Afficher, sur chaque fiche d’événement, la **liste des participants et leur statut**, avec une différenciation visuelle.
- **Sécuriser toutes les opérations sensibles avec les voters** : seules les personnes autorisées peuvent valider/refuser des participations ou modifier un événement.
- Ajouter un **feedback utilisateur** (notification/message) lors des changements de statut de participation.

---

## Livrables attendus

- Interfaces de gestion des événements et participations opérationnelles et personnalisées.
- Système complet de **demande, validation, refus et annulation** de participation.
- Affichage des **statuts de participation** à jour pour chaque événement.
- Sécurisation des opérations sensibles via **voters** et **rôles**.

---

## Critères d’évaluation

- **Conformité fonctionnelle** : toutes les opérations sur les événements et participations sont présentes et fonctionnelles.
- **Gestion des statuts** : transitions correctes entre les différents statuts (demande, acceptée, refusée, annulée).
- **Sécurité** : accès limité selon les droits définis (voters, rôles).
- **Clarté du feedback** : l’utilisateur est informé à chaque étape (succès, erreur, changement de statut).
- **Qualité du code et documentation** : logique claire, commentaires utiles, bonnes pratiques respectées.

---

## Conseils & attendus particuliers

- Testez **l’ensemble des scénarios** : création, modification, suppression d’événement ; demande, validation, refus, annulation de participation.
- Affichez des **messages clairs** pour chaque changement de statut (feedback utilisateur).
- Vérifiez que les **règles de sécurité** (voters) couvrent bien **tous les cas sensibles** (ex. : refus d’accès à un utilisateur non organisateur).

