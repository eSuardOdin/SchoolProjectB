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

L'application doit pouvoir permettre :

### Majeur
- #### Entités :
	
	- <u>Directeur de pôle</u> :
	  - De nommer les directeurs de département
	  - <u>*optionnel*</u> : De créer de nouveaux départements
	  - De créer les cours (associés à un département (uniquement *l'entité*) ou inter-départements <u>*ex: solfège*</u>)
	  - D'ajouter un professeur
	
	- <u>Directeur de département</u> :
	  - D'affecter un professeur à un cours
	  - De positionner un cours sur l'emploi du temps
	  - De visualiser son emploi du temps
	  - <u>*optionnel*</u>: De pré-ajouter un élève à son département (L'élève pourra voir ses dates de passage aux auditions d'entrée )
	  - D'ajouter un élève à son département
	  - De modifier un professeur (Cours affectés etc..)
	  - De modifier un élève (Niveau, instrument etc...)
	
	- <u>Professeur</u> :
	  - Créer des examens et noter les élèves
	  - Visualiser son emploi du temps
	
	- <u>Elève</u>
	  - Visualiser son emploi du temps
	





**Old** :

Un conservatoire a plusieurs pôles -> Ex: Classique,  Jazz, Danse, Théatre. Un pôle a plusieurs professeurs qui peuvent  enseigner plusieurs matières et dans plusieurs pôles (Ex: Prof de piano Jazz et Classique et cours de direction d'orchestre). Une matière est  liée à un ou plusieurs pôles, si un élève a passé son cycle 3 en classique avec une note satisfaisante en solfège et qu'il doit présenter son cycle 2 en Jazz, il ne passera pas le solfège au cycle 2 ET au  cycle 3 Jazz). Un professeur peut être directeur de pôle, il pourra fixer les dates d'examen et les participants (on peut imaginer un systeme de  notifications pour les élèves). Le directeur du pôle peut fixer les horaires des cours de ses professeurs dans les salles dédiées à son pôle (on pourrait imaginer une demande d'emprunter une salle d'un autre pôle pour laquelle le  directeur du conservatoire devrait trancher). Un élève peut avoir un ou plusieurs cursus dans un ou plusieurs pôles  (Ex: Cursus Guitare en cycle 3 dans le pôle classique et Batterie cycle spé en Jazz) À l'inscription, l'élève devra séléctionner les horaires hebdomadaires  des cours correspondant à son cursus (ou alors on rajoute un système de  groupes avec horaires imposées) Un (des?) élèves peut demander à reserver une salle libre pour  travailler, cela s'inscrira sur son emploi du temps (il ne doit pas avoir de cours pendant sa reservation)

