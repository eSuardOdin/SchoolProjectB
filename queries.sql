-- Sélectionner le nom des instruments enseignés dans
-- le département Jazz (2)
SELECT nom_instrument 
FROM Instruments 
WHERE id_instrument IN(
    SELECT id_instrument FROM Instruments_Enseignés_Départements 
    WHERE id_département = 2
    );
    
-- Nom du directeur du pôle Musique
SELECT nom_utilisateur FROM Utilisateurs
WHERE id_utilisateur = (SELECT directeur_pôle FROM Pôles WHERE nom_pôle = 'Musique');

-- Nom de tous les professeurs
SELECT nom_utilisateur FROM Utilisateurs 
INNER JOIN Professeurs ON id_utilisateur = id_professeur;

-- Nom, prénom des chefs
SELECT nom_utilisateur, prénom_utilisateur FROM Utilisateurs
INNER JOIN Chefs ON id_utilisateur = id_chef;

-- Nom du chef de département jazz
SELECT nom_utilisateur FROM Utilisateurs WHERE id_utilisateur = (SELECT chef_département FROM Départements WHERE id_département = 2);

-- Nom de matières pour cycle 1
SELECT nom_matière FROM Matières WHERE id_cycle IN (SELECT id_cycle FROM Cycles WHERE nom_cycle = 'Cycle 1');
