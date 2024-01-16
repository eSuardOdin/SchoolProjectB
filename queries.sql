-- Sélectionner le nom des instruments enseignés dans
-- le département Jazz (2)
SELECT nom_instrument 
FROM Instruments 
WHERE id_instrument IN(
    SELECT id_instrument FROM Instruments_Enseignés_Départements 
    WHERE id_département = 2
    );
    
-- Nom du directeur du pôle Musique    
SELECT nom_utilisateur FROM Utilisateurs WHERE id_utilisateur = (SELECT id_utilisateur FROM Directeurs WHERE id_pôle = 3);

-- Nom du chef de département jazz
SELECT nom_utilisateur FROM Utilisateurs WHERE id_utilisateur = (SELECT chef_département FROM Départements WHERE id_département = 2);

-- Nom de matières pour cycle 1
SELECT nom_matière FROM Matières WHERE id_cycle IN (SELECT id_cycle FROM Cycles WHERE nom_cycle = 'Cycle 1');
