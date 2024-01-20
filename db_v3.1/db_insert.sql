--######################################################
--Insertion Utilisateurs--
INSERT INTO Utilisateurs(id_utilisateur, nom_utilisateur, prénom_utilisateur,pwd_utilisateur,login_utilisateur) VALUES
(1, 'Dupont','Louis','1234','l.dupont'), -- Directeur Musique
(2, 'Redman','Joshua','1234','j.redman'), -- Chef Jazz
(3, 'Rameau','Jean-Philippe','1234','jp.rameau'),
(4, 'Debussy','Claude','1234','c.debussy'), -- Chef Classique
(5, 'Evans','Bill','1234','b.evans'),
(6, 'Blade','Brian','1234','b.blade'),
(7, 'Rosenwinkel','Kurt','1234','k.rosenwinkel'),
(8, 'Feuillatre','Raphaël','1234','r.feuillatre'),
(9, 'Montgomery','Wes','1234','w.montgomery'),
(10, 'Coltrane','John','1234','j.coltrane'),
(11, 'Hamasyan','Tigran','1234','t.hamasyan'), 
(12, 'Jones','Elvin','1234','e.jones'),
(13, 'Gomez','Eddy','1234','e.gomez'),
(14, 'LaFaro','Scott','1234','s.lafaro'),
(15, 'Davis','Miles','1234','m.davis'),
(16, 'Akinmusire','Ambrose','1234','a.akinmusire'),
(17, 'Grognard','Michel','1234','m.grognard'),
(18, 'Duchemin','Jean','1234','j.duchemin');

SELECT * FROM Utilisateurs;

--######################################################
--Insertion Directeurs--
INSERT INTO Directeurs(id_directeur) VALUES (1);
INSERT INTO Directeurs(id_directeur) VALUES (17);
INSERT INTO Directeurs(id_directeur) VALUES (18);

SELECT id_utilisateur, nom_utilisateur FROM Utilisateurs INNER JOIN Directeurs ON
id_utilisateur = id_directeur;

--######################################################
--Insertion Pôles--
INSERT INTO Pôles (id_pôle, nom_pôle, directeur_pôle) VALUES (1,'Danse',17);
INSERT INTO Pôles (id_pôle, nom_pôle, directeur_pôle) VALUES (2,'Théatre',18);
INSERT INTO Pôles (id_pôle, nom_pôle, directeur_pôle) VALUES (3,'Musique',1);

SELECT * FROM Pôles;

--######################################################
--Insertion Professeurs--
INSERT INTO Professeurs(id_professeur) VALUES (2);
INSERT INTO Professeurs(id_professeur) VALUES (3);
INSERT INTO Professeurs(id_professeur) VALUES (4);
INSERT INTO Professeurs(id_professeur) VALUES (5);
INSERT INTO Professeurs(id_professeur) VALUES (6);
INSERT INTO Professeurs(id_professeur) VALUES (7);
INSERT INTO Professeurs(id_professeur) VALUES (8);
INSERT INTO Professeurs(id_professeur) VALUES (14);
INSERT INTO Professeurs(id_professeur) VALUES (15);

SELECT id_utilisateur, nom_utilisateur FROM Utilisateurs INNER JOIN Professeurs ON
id_utilisateur = id_professeur;

--######################################################
--Insertion Chefs--
INSERT INTO Chefs(id_chef) VALUES(4);
INSERT INTO Chefs(id_chef) VALUES(5);

SELECT id_utilisateur, nom_utilisateur, prénom_utilisateur FROM Utilisateurs
INNER JOIN Chefs ON id_utilisateur = id_chef;

--######################################################
--Insertion Départements--
INSERT INTO Départements (id_département, nom_département, id_pôle, chef_département) VALUES(1,'Classique', 3, 4);
INSERT INTO Départements (id_département, nom_département, id_pôle, chef_département) VALUES(2,'Jazz', 3, 5);
--INSERT INTO Départements (nom_département, id_pôle, chef_département) VALUES('Baroque', 3, 3);
--INSERT INTO Départements (nom_département, id_pôle, chef_département) VALUES('Musiques actuelles', 3, 5);
SELECT Départements.nom_département, Utilisateurs.nom_utilisateur FROM Départements INNER JOIN Utilisateurs ON chef_département = id_utilisateur;

--######################################################
--Insertion Elèves--
INSERT INTO Elèves(id_élève) VALUES
(9),
(10),
(11),
(13),
(16);

SELECT id_utilisateur, nom_utilisateur, prénom_utilisateur FROM Utilisateurs
INNER JOIN Elèves ON id_utilisateur = id_élève;

--######################################################
--Insertion Instruments--
INSERT INTO Instruments(nom_instrument, famille_instrument) VALUES
    -- Cordes
    ('Violon', 'Cordes'),
    ('Alto', 'Cordes'),
    ('Violoncelle', 'Cordes'),
    ('Contrebasse', 'Cordes'),
    ('Harpe', 'Cordes'),
    ('Guitare', 'Cordes'),
    ('Guitare basse', 'Cordes'),
    ('Luth', 'Cordes'),
    -- Bois
    ('Clarinette', 'Bois'),
    ('Saxophone soprano', 'Bois'),
    ('Saxophone alto', 'Bois'),
    ('Saxophone ténor', 'Bois'),
    ('Saxophone baryton', 'Bois'),
    ('Flûte piccolo', 'Bois'),
    ('Flûte traversière', 'Bois'),
    ('Flûte à bec', 'Bois'),
    ('Hautbois', 'Bois'),
    ('Basson', 'Bois'),
    -- Cuivres
    ('Trompette', 'Cuivres'),
    ('Trombonne', 'Cuivres'),
    ('Cor', 'Cuivres'),
    ('Tuba', 'Cuivres'),
    -- Claviers
    ('Piano', 'Claviers'),
    ('Orgue', 'Claviers'),
    ('Clavecin', 'Claviers'),
    ('Accordéon', 'Claviers'),
    -- Percussions
    ('Percussions classiques', 'Percussions'),
    ('Vibraphone', 'Percussions'),
    ('Xylophone', 'Percussions'),
    ('Marimba', 'Percussions'),
    ('Batterie', 'Percussions');
SELECT * FROM Instruments;

--######################################################
--Insertion Départements_Instruments--
INSERT INTO Départements_Instruments(id_instrument, id_département) VALUES
-- Classique
(1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),
(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),
(26,1),(27,1),(28,1),(29,1),(30,1),
-- Jazz
(4,2),(6,2),(7,2),(10,2),(11,2),(12,2),(15,2),(19,2),(20,2),(23,2),(26,2),(28,2),(31,2);

SELECT nom_instrument 
FROM Instruments 
WHERE id_instrument IN(
    SELECT id_instrument FROM Départements_Instruments 
    WHERE id_département = 2
    );
--######################################################
--Insertion Salles--
INSERT INTO Salles (id_salle, nom_salle, capacité_salle, id_pôle) VALUES
(1,'Auditorium A',100,3),
(2,'Auditorium B',120,3),
(3,'B01',15,3),
(4,'B02',10,3),
(5,'B03',20,3),
(6,'B04',10,3),
(7,'A01',30,3),
(8,'A02',35,3),
(9,'A03',25,3),
(10,'A04',20,3),
(11,'A05',30,3),
(12,'A06',10,3),
(13,'A07',20,3),
(14,'A08',10,3),
(15,'A09',5,3);


--######################################################
--Insertion Cycles--
INSERT INTO Cycles (id_cycle, nom_cycle,id_département) VALUES
(1,'Cycle 1', 1),(2,'Cycle 2', 1),(3,'Cycle 3', 1),(4,'Cycle Spécialisé', 1),
(5,'Cycle 1', 2),(6,'Cycle 2', 2),(7,'Cycle 3', 2),(8,'Cycle Spécialisé', 2);


--######################################################
--Insertion Matières--
-- Tous les cycles (Jazz)
INSERT INTO Matières (id_matière, nom_matière, id_cycle) VALUES
(1,'Cours individuel instrument', 5),
(2,'Cours individuel instrument', 6),
(3,'Cours individuel instrument', 7),
(4,'Cours individuel instrument', 8),
(5,'Solfège Jazz', 5),
(6,'Solfège Jazz', 6),
(7,'Solfège Jazz', 7),
(8,'Solfège Jazz', 8),
(9,'Cours d\'ensemble Jazz', 5),
(10,'Cours d\'ensemble Jazz', 6),
(11,'Cours d\'ensemble Jazz', 7),
(12,'Cours d\'ensemble Jazz', 8);
-- Cycles spécifiques (Jazz)
INSERT INTO Matières (id_matière, nom_matière, id_cycle) VALUES
(13,'Histoire du Jazz',5),
(14,'Atelier Big Band',7),
(15,'Atelier Big Band',8),
(16,'Atelier Standard',7),
(17,'Atelier Standard',8);

SELECT id_utilisateur, nom_utilisateur, prénom_utilisateur
FROM Utilisateurs
WHERE id_utilisateur IN (SELECT P.id_professeur FROM Professeurs AS P INNER JOIN Matières_Professeurs AS M ON
P.id_professeur = M.id_professeur WHERE M.id_matière = 5);

--######################################################
--Insertion Matières_Professeurs--
-- Jazz
--Solfège (Evans, Rosenwinkel)
INSERT INTO Matières_Professeurs(id_matière, id_professeur) VALUES
(5,5),(5,7),(6,5),(6,7),(7,5),(7,7),(8,5),(8,7);
--Cours d'ensemble (Redman, Blade)
INSERT INTO Matières_Professeurs(id_matière, id_professeur) VALUES
(9,2),(9,6),(10,2),(10,6),(11,2),(11,6),(12,2),(12,6);
--Instruments (tous)
INSERT INTO Matières_Professeurs(id_matière, id_professeur) VALUES
(1,2),(1,5),(1,6),(1,7),(1,14),(1,15),
(2,2),(2,5),(2,6),(2,7),(2,14),(2,15),
(3,2),(3,5),(3,6),(3,7),(3,14),(3,15),
(4,2),(4,5),(4,6),(4,7),(4,14),(4,15);
--Histoire du Jazz (Davis)
INSERT INTO Matières_Professeurs(id_matière, id_professeur) VALUES
(13,15);
--Big Band (Davis)
INSERT INTO Matières_Professeurs(id_matière, id_professeur) VALUES
(14,15),(15,15);
--Standard (Evans,LaFaro)
INSERT INTO Matières_Professeurs(id_matière, id_professeur) VALUES
(16,14),(16,5),(17,14),(17,5);