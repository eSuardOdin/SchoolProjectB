-- Sélectionner le nom des instruments enseignés dans
-- le département Jazz (2)
SELECT nom_instrument 
FROM Instruments 
WHERE id_instrument IN(
    SELECT id_instrument FROM Instruments_Enseignés_Départements 
    WHERE id_département = 2
    );
