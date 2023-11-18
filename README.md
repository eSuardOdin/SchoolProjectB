# SchoolProjectB



Ce projet a pour objet la création d'une appli web de gestion de travail d'équipe avec des rôles, des projets (applicatifs), des version d'un projet, des tickets, un workflow (les états des tickets et leur passage de l'un à l'autre)



## Les grandes lignes

L'équipe a des salariés, sur chaque projet, un salarié peut avoir un rôle (gestionnaire du projet (administrateur d'un projet), dev, en charge du test). Le chef de bureau de dev (seul rôle inchangeable) peut CRUD des salariés, projets etc...

Chaque salarié a une quantité de ressource de travail disponible, celle-ci permettra de savoir s'il est disponible ou non pour participer à un projet (on peut l'assigner en définissant une charge de travail plus ou moins élevée)

***Les rôles***

- ***Chef*** : Peut renseigner de nouveaux salariés dans la bdd, créer des projets, nommer un chef de projet. Il n'a pas d'autres droits sur le projet en lui même si ce n'est changer le chef du projet (l'équipe est alors reset)
- Gestionnaire
