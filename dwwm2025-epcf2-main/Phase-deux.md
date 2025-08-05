# Phase 2 : Initialisation du projet avec Symfony, modélisation – Entité, Repository, Migration et Fixtures (1 journée)

## Objectifs de la journée

- Créer le projet Symfony et l’initialiser (composer, configuration de base).
- Installer, si besoin, les bundles essentiels : Doctrine ORM, Validation.
- Générer les entités à partir du MCD, en respectant tous les attributs et relations définis lors de la phase de conception.
- Créer le repository associé pour chaque entité, afin de faciliter la gestion et la recherche des données.
- Générer les migrations Doctrine et appliquer chaque migration pour mettre à jour la base de données selon la modélisation choisie.
- Créer et exécuter des fixtures pour disposer de données de test variées (utilisateurs, événements, lieux, catégories et participations).

---

## Tâches à réaliser

- Créer le squelette du projet Symfony via Composer ou la commande `symfony`.
- Configurer la connexion à la base de données (`.env`, `.env.local`, etc.).
- Installer et configurer Doctrine ORM, ainsi que le composant Validator si ce n’est pas déjà fait.
- Créer toutes les entités principales (attributs, relations, contraintes d’unicité, nullable, etc.).
- Créer les repositories associés aux entités.
- Générer et exécuter les migrations Doctrine pour créer les tables dans la base de données.
- Vérifier la bonne création de toutes les tables et relations en base.
- Installer les bons bundles pour la gestion des fixtures.
- Créer des fixtures réalistes à l’aide de Faker pour :
  - Des utilisateurs avec les rôles `USER`, `ORGANISATEUR`, `ADMIN`
  - Des événements liés aux utilisateurs organisateurs, aux lieux et aux catégories
- Vérifier que les fixtures remplissent correctement la base de données.

---

## Livrables attendus

- Projet Symfony initialisé et fonctionnel.
- Entités bien structurées, respectant la modélisation validée.
- Repositories associés générés pour chaque entité.
- Migrations Doctrine créées et exécutées (toutes les entités, attributs et relations sont visibles dans la base de données).
- Fichiers de fixtures complets et fonctionnels.

---

## Critères d’évaluation

- **Conformité des entités** : toutes les entités prévues au MCD sont bien créées, attributs respectés.
- **Structure des relations** : les relations (`OneToMany`, `ManyToOne`, `ManyToMany`…) sont correctement définies.
- **Respect des contraintes** : contraintes d’unicité, nullable, indexation des champs stratégiques (email, etc.).
- **Migrations** : toutes les migrations sont fonctionnelles et synchronisées avec la base.
- **Propreté du code** : annotations ou attributs bien utilisés, fichiers sources bien structurés, pas d’attributs superflus.
- **Fixtures** : données cohérentes, utilisateurs avec des rôles variés, événements bien reliés aux organisateurs.
- **Livrables conformes et exploitables** : projet opérationnel, tables vérifiables.

---

## Conseils & attendus particuliers

- Avec VS Code, n’hésitez pas à vérifier la cohérence des entités.
- Testez l’exécution des migrations sur une base vide pour éviter tout conflit ou erreur de structure.
- Utilisez Faker pour générer automatiquement des données crédibles.
- Vérifiez que chaque rôle d'utilisateur est représenté dans les données générées.
- Commentez vos fixtures pour indiquer les cas particuliers (utilisateur admin, événements privés, etc.).
- N’hésitez pas à documenter dans le code les choix de modélisation ou les validations spécifiques.
