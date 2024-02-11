# SchoolProjectB

# Application Gestion Conservatoire

## But de l'application

Gestion d'un pédagogique d'un conservatoire, les données suivantes sont préexistantes :

- Trois pôles (Musique, Danse, Théatre) -> Attention, je me concentre sur le pôle musique, le reste est optionnel (penser à prévoir un modèle de données cohérent quand même) + Chaque pôle a des salles dédiées, on évite les croisements je ne m'emmerde pas avec les conflits inter-pôles.
- Les niveaux (Cycle 1, 2, 3, Spé -> DEM)
- Les rôles :
  - Professeur
  - Directeur de Pôle (Admin)
  - Directeur de département (Jazz, Classique, Musique baroque...) -> Est un professeur nommé par le Directeur de pôle

*Idées à la volées* :

- Mettre en place des cours *non-obligatoires* par département et les ouvrir à des élèves d'autres départements ?
- Mettre en place un système d'annonces ("On recherche n violonistes pour jouer tel répertoire")

L'application doit pouvoir permettre :

### Majeur

- #### Entités :
  
  - <u>Directeur de pôle</u> :
    
    - De nommer les directeurs de département
    - <u>*optionnel*</u> : De créer de nouveaux départements
    - De créer les matières (associés à un cycle)
    - D'ajouter un professeur
  
  - <u>Chef de département</u> :
    
    - Créer un cours 
    - De visualiser son emploi du temps
    - <u>*optionnel*</u>: De pré-ajouter un élève à son département (L'élève pourra voir ses dates de passage aux auditions d'entrée )
    - D'ajouter un élève à son département
    - De modifier un professeur (Cours affectés etc..)
    - De modifier un élève (Niveau, instrument etc...)
  
  - <u>Professeur</u> :
    
    - Créer des examens et noter les élèves
    - Visualiser son emploi du temps
    - Faire l'appel
  
  - <u>Elève</u>
    
    - Visualiser son emploi du temps
    - S'inscrire à des cours

**Old** :

Un conservatoire a plusieurs pôles -> Ex: Classique,  Jazz, Danse, Théatre. Un pôle a plusieurs professeurs qui peuvent  enseigner plusieurs matières et dans plusieurs pôles (Ex: Prof de piano Jazz et Classique et cours de direction d'orchestre). Une matière est  liée à un ou plusieurs pôles, si un élève a passé son cycle 3 en classique avec une note satisfaisante en solfège et qu'il doit présenter son cycle 2 en Jazz, il ne passera pas le solfège au cycle 2 ET au  cycle 3 Jazz). Un professeur peut être directeur de pôle, il pourra fixer les dates d'examen et les participants (on peut imaginer un systeme de  notifications pour les élèves). Le directeur du pôle peut fixer les horaires des cours de ses professeurs dans les salles dédiées à son pôle (on pourrait imaginer une demande d'emprunter une salle d'un autre pôle pour laquelle le  directeur du conservatoire devrait trancher). Un élève peut avoir un ou plusieurs cursus dans un ou plusieurs pôles  (Ex: Cursus Guitare en cycle 3 dans le pôle classique et Batterie cycle spé en Jazz) À l'inscription, l'élève devra séléctionner les horaires hebdomadaires  des cours correspondant à son cursus (ou alors on rajoute un système de  groupes avec horaires imposées) Un (des?) élèves peut demander à reserver une salle libre pour  travailler, cela s'inscrira sur son emploi du temps (il ne doit pas avoir de cours pendant sa reservation)

MLD

- UTILISATEURS

- PROFESSEURS (FK UTILISATEURS)

- DIRECTEURS (FK UTILISATEURS)

- ELEVES (FK UTILISATEURS)
  
  - PÔLES (FK DIRECTEURS)
    
    - SALLES (FK PÔLES)
    
    - CHEFS (FK PROFESSEURS)
    
    - DEPARTEMENTS (FK CHEFS)
      
      - CYCLES (FK DEPARTEMENTS)
      
      - MATIERES (FK CYCLES)
      
      - < DEPARTEMENTS_PROFESSEURS >
      
      - < MATIERES_PROFESSEURS >

- INSTRUMENTS
  
  - < DEPARTEMENTS_INSTRUMENTS >
  
  - < UTILISATEURS_INSTRUMENTS (*) >

- COURS (FK SALLES, FK MATIERES, FK PROFESSEUR)

- RESERVATIONS (FK SALLES, FK ELEVES)

----

Pré boulot php :

- Gestion de la connexion avec login + mdp, accueil sur page élève, prof, chef (=prof + onglet de gestion du dpt) ou directeur.

- Formulaires d'ajouts directeur :
  
  - Ajouter un département (ajouter un chef en même temps) -> Création de cycles ou auto ?
  
  - Ajouter un professeur
  
  - Ajouter une matière à un cycle
  
  - Ajouter professeur à matière

---

Articulé en MVC.

Controller:

    ConnexionController : Gère les méthodes pour se connecter à l'application et affiche les Views de formulaire, de l'erreur de connexion.
    
    ProfilController : Classe parente des controllers pour ElèveController, ProfController et DirecteurController (attention, un prof peut être chef de département)
    
    ElèveController : Gestion des méthodes pour consulter l'emploi du temps, s'inscrire à des cours, consulter ses notes.
    
    ProfController : Gestion des méthodes pour consulter l'emploi du temps, créer des examens et les affecter à ses élèves, noter ses élèves.
    
    ChefController : (on rajoutera un onglet de menu de chef sur un menu prof) Gestion des méthodes pour préajouter un élève à son dpt (pour les auditions, un élève n'a accès à rien sans avoir une entrée dans élève_cycle), CRUD un élève (

---

To do :

- Chef : Dans l'onglet cours, ajouter les matières du cycle. 

## Fonctionnement élève :

Un élève qui s'inscrit va devoir choisir un département, un instrument ainsi qu'un cycle pour lequel il postule, le chef du département pourra oui ou non accepter son inscription dans ce cycle. Une fois inscrit, il devra choisir un créneau pour chaque matière proposée dans le cycle.

---

*En suspend car optionnel*

Il pourra ensuite consulter son emploi du temps et demander une reservation sur une salle libre, on peut imaginer un système de reservation où un élève cherche à jouer avec tel ou tel instrument.

+

Annonces

+

Enfin, l'élève étant promu du cycle de dernier rang de son département pourra faire une demande pour devenir professeur

---

### Ce que cela implique :

- Rajout d'un champ *places max* dans les Cycles

- Rajout d'un champ *rang* dans les Cycles (pour gérer les promotions de cycle)

- Création d'une table **Demandes** pour un élève qui demande un cycle, le chef validera ou non ces demandes (si un élève s'inscrit, il fait une demande, s'il veut être promu de cycle c'est pareil)

- Deuxième solution, ajout d'une colonne *Demande* pour voir si une demande est en cours et *est_inscrit* si l'élève est inscrit dans un cycle

- Méthode pour check si l'élève s'est bien inscrit à tous les cours nécessaires à son cycle

## Fonctionnement Prof :

à voir, pour l'instant surtout des coquilles vides, pas envie de gérer l'appel et les examens. à voir

### Attention :

Il faut rajouter un nb max d'élève par cours (par exemple un seul pour les cours d'instrument). Si le max est 0, pas de limite (déjà limité par le nombre de places par cycle)