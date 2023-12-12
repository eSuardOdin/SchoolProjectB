# SchoolProjectB



Ce projet a pour objet la création d'une appli web de gestion de travail d'équipe avec des rôles, des projets (applicatifs), des version d'un projet, des tickets, un workflow (les états des tickets et leur passage de l'un à l'autre)



## Les grandes lignes

L'équipe a des salariés, sur chaque projet, un salarié peut avoir un rôle (gestionnaire du projet (administrateur d'un projet), dev, en charge du test). Le chef de bureau de dev (seul rôle inchangeable) peut CRUD des salariés, projets etc...

Chaque salarié a une quantité de ressource de travail disponible, celle-ci permettra de savoir s'il est disponible ou non pour participer à un projet (on peut l'assigner en définissant une charge de travail plus ou moins élevée)

***Les rôles***

- **Chef** : *Responsable de l'entreprise*
  - Renseigner de nouveaux *salariés* dans la bdd
  - Créer des <u>projets</u>
  - Nommer un <u>gestionnaire de projet</u>. Il n'a pas d'autres droits sur le projet en lui même si ce n'est changer le gestionnaire du projet (l'équipe est alors reset)
  - *Optionnel* : Envoie le projet au gestionnaire sous la forme d'une requète de création d'équipe, on peut imaginer un compte rendu global des besoins du projet, un rapport de l'équipe commerciale (inexistante sur l'appli), une date butoir etc...
- **Gestionnaire de projet** : *Gère un projet, il est en charge de monter l'équipe responsable, assurer le suivi du projet, etc...*
  - Ajouter des <u>sous-équipes</u> (Front/Back dans l'équipe Dev, créateur de jeu de data/Tests client-like/code review dans l'équipe de test) liés à un <u>projet</u>. 
  - Ajouter des <u>salariés</u> disponibles dans les différentes <u>équipes</u>
  - Nommer un <u>chef d'équipe</u>
  - Organiser des <u>réunions</u>
  - Réassigner un <u>ticket</u>
  - Créer une version à laquelle seront affectés les tickets jusqu'à la livraison à l'équipe de test
- **Chef d'équipe** : *Chef d'une équipe (dev, tests, graphistes, à definir...). Il est en outre un membre "normal" de son équipe. Lorsque quelqu'un créé un ticket, il l'assigne à une équipe, c'est le chef d'équipe qui est en charge de l'attribuer à un de ses salariés. Tout le monde ne peut pas être chef d'équipe. Si un membre quitte l'entreprise, ses tickets sont automatiquement réassignés aux chefs d'équipes des projets sur lequel il travaillait.*
  - Organisation des <u>sous-équipes</u>
  - Assigner/réassigner des <u>tickets</u> dans SON équipe
  - Tout ce que peut faire un membre classique
- **Membre d'équipe** : *Travaille sur des tickets qui lui sont assignés, peut s'en créer/assigner lui même. Peut passer un ticket dans un état (Exemple: un Dev reçoit un ticket "To Do", il peut le passer à "In Progress" puis le validé en "In Version" pour qu'il soit intégré dans la version envoyée à l'équipe de test*
  - Changer l'état d'un <u>ticket</u>
  - Modifier son ticket
  - Commenter des tickets





***Les équipes***

- Dev :
  - 






Deuxième idée : 
Le projet a pour objet la création d'un site interne d'organisation de conservatoire.

Un conservatoire a plusieurs pôles -> Ex: Classique, Jazz, Danse, Théatre. Un pôle a plusieurs professeurs qui peuvent enseigner plusieurs matières et dans plusieurs pôles (Ex: Prof de piano Jazz et Classique et cours de direction d'orchestre). Une matière est liée à un ou plusieurs pôles, si un élève a passé son cycle 3 en classique avec une note satisfaisante en solfège et qu'il doit présenter son cycle 2 en Jazz, il ne passera pas le solfège au cycle 2 ET au cycle 3 Jazz).
Un professeur peut être directeur de pôle, il pourra fixer les dates d'examen et les participants (on peut imaginer un systeme de notifications pour les élèves).
Le directeur du pôle peut fixer les horaires des cours de ses professeurs dans les salles dédiées à son pôle (on pourrait imaginer une demande d'emprunter une salle d'un autre pôle pour laquelle le directeur du conservatoire devrait trancher).
Un élève peut avoir un ou plusieurs cursus dans un ou plusieurs pôles (Ex: Cursus Guitare en cycle 3 dans le pôle classique et Batterie cycle spé en Jazz)
À l'inscription, l'élève devra séléctionner les horaires hebdomadaires des cours correspondant à son cursus (ou alors on rajoute un système de groupes avec horaires imposées)
Un (des?) élèves peut demander à reserver une salle libre pour travailler, cela s'inscrira sur son emploi du temps (il ne doit pas avoir de cours pendant sa reservation)



Privilèges :

Directeur du conservatoire :
	- Nommer les directeurs de pôle.
	- Placer les dates des examens et nommer le jury
Directeur de pôle :
	- Créer l'emploi du temps hebdomadaire des cours
	- Remplacer un cours par un autre si absence ?
Professeur :
	- Organiser des contrôles (doivent apparaitre dans le calendrier)
	- Noter des élèves