# EventHub
Plateforme d’Événements Collaboratifs

## **Brief**

Votre mission est de concevoir et de réaliser une application web moderne qui facilite la gestion d’événements collaboratifs pour différents types d’utilisateurs.
La plateforme doit offrir un espace **sécurisé**, **ergonomique** et **attractif**, permettant de regrouper et d’organiser des activités, des ateliers, des sorties, des rencontres professionnelles ou associatives.

---

## **Objectifs principaux**

L’application devra permettre :

* **La création et la gestion complète d’événements**
  (création, modification, suppression, affectation à un lieu et à une catégorie, gestion de la capacité, ajout d’image illustrative).

* **L’inscription et la gestion des participants**
  (avec validation par les organisateurs et suivi du statut de participation : demande, acceptée, refusée, quittée).

* **La gestion des médias**
  (images) rattachés aux événements et aux lieux.

---

## **Attendus techniques**

Vous devrez :

* Concevoir un **modèle de données robuste**, structuré autour des notions d’utilisateur, d’événement, de participation, de lieu, de catégorie et de média, en assurant la cohérence et l’intégrité des relations.
* Mettre en place une **gestion fine des accès et des droits** : seuls les utilisateurs autorisés doivent accéder à certaines opérations selon leur rôle (administrateur, organisateur, simple participant).
* **Personnaliser l’interface utilisateur** en respectant la charte graphique fournie, en soignant l’expérience de navigation et la clarté des informations.
* Garantir **l’ergonomie, la sécurité et la fiabilité** de l’ensemble de la plateforme : formulaire sécurisé, feedback utilisateur, gestion des erreurs, validation des données.
* **Si le temps vous le permets, vous avez la possibilité d’affiner le CSS et de rendre l’application responsive** (mobile, tablette, desktop). Le CSS n’est pas une priorité, il faut le minimum pour la lisibilité des pages.

---

## **Fonctionnalités à intégrer**

* **Gestion des comptes utilisateurs** : inscription, connexion, édition du profil.
* **Gestion des événements** : création/modification/suppression, affectation à un lieu et à une catégorie, ajout de média.
* **Inscription et gestion des participations** : demande à rejoindre un événement, validation/refus par l’organisateur, suivi du statut, possibilité de quitter un événement.
* **Tableaux de bord personnalisés** pour chaque utilisateur, affichant ses événements organisés et ses participations.
* **Recherche et filtrage avancés** des événements par date, lieu, catégorie, mots-clés.
* **Gestion et partage de médias** : images liées aux événements et aux lieux.

---

## **Livrables attendus**

* Un **dépôt GitHub contenant l'ensemble du projet**, y compris pour la conception du modéle de données et en n'oubliant pas de commit et push votre travail régulièrement. 
Vous avez la possibilité de cloner ce dépôt afin de travailler en local, suivre l'évolution du projet, et versionner vos modifications. 
Pensez à nommer votre repository : **dwwm2025-epcf2-prenom-nom**
* Le **code source Symfony** sur le repository.
* Un **schéma (MCD) clair de la base de données** via une capture (au format png ou jpg par exemple) ou au format PDF.
* **Attention** les livrables sont à rendre au plus tard pour **le 11 aout à 17h15** !

---

> Ce projet est l’occasion de démontrer votre maîtrise des concepts clés du développement web : **modélisation, sécurité, personnalisation de l’interface, gestion des droits, et expérience utilisateur.**

---

## **User stories**

1. **En tant qu’utilisateur non connecté,** je peux m’inscrire et me connecter à la plateforme.
2. **En tant qu’utilisateur connecté,** je peux modifier mon profil et mon mot de passe.
3. **En tant qu’utilisateur connecté,** je peux consulter la liste des événements publics.
4. **En tant qu’utilisateur connecté,** je peux consulter la fiche détaillée d’un événement (description, lieu, date, organisateur, participants, image d'illustration).
5. **En tant qu’organisateur,** je peux créer un événement, modifier ou supprimer uniquement mes événements.
6. **En tant qu’utilisateur connecté,** je peux demander à rejoindre un événement ou le quitter.
7. **En tant qu’organisateur connnecté,** je peux accepter ou refuser les demandes de participation à mes événements.
8. **En tant qu’utilisateur connecté,** j’ai accès à un tableau de bord personnalisé présentant :
   * les événements auxquels je participe,
   * mon profil.
9. **En tant qu’organisateur connecté,** j’ai accès à un tableau de bord personnalisé présentant :
   * mes événements organisés et/ou auxquels je participe,
   * des statistiques personnalisées (nombre d’événements organisés, taux de participation, etc.).