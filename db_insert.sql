--######################################################
--Insertion Utilisateurs--
INSERT INTO Utilisateurs(nom_utilisateur, prénom_utilisateur,pwd_utilisateur,login_utilisateur) VALUES
('Dupont','Louis','1234','l.dupont'), -- Directeur Musique
('Redman','Joshua','1234','j.redman'), -- Chef Jazz
('Rameau','Jean-Philippe','1234','jp.rameau'),
('Debussy','Claude','1234','c.debussy'), -- Chef Classique
('Evans','Bill','1234','b.evans'),
('Blade','Brian','1234','b.blade'),
('Rosenwinkel','Kurt','1234','k.rosenwinkel'),
('Feuillatre','Raphaël','1234','r.feuillatre'),
('Montgomery','Wes','1234','w.montgomery'),
('Coltrane','John','1234','j.coltrane'),
('Hamasyan','Tigran','1234','t.hamasyan'), 
('Jones','Elvin','1234','e.jones'),
('Gomez','Eddy','1234','e.gomez'),
('LaFaro','Scott','1234','s.lafaro'),
('Davis','Miles','1234','m.davis'),
('Akinmusire','Ambrose','1234','a.akinmusire'),
('Grognard','Michel','1234','m.grognard'),
('Duchemin','Jean','1234','j.duchemin');

SELECT * FROM Utilisateurs;

--######################################################
--Insertion Directeurs--
INSERT INTO Directeurs(id_directeur) VALUES (1);
INSERT INTO Directeurs(id_directeur) VALUES (17);
INSERT INTO Directeurs(id_directeur) VALUES (18);

SELECT * FROM Directeurs;

--######################################################
--Insertion Pôles--
INSERT INTO Pôles (nom_pôle, directeur_pôle) VALUES ('Danse',17);
INSERT INTO Pôles (nom_pôle, directeur_pôle) VALUES ('Théatre',18);
INSERT INTO Pôles (nom_pôle, directeur_pôle) VALUES ('Musique',1);

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

SELECT * FROM Professeurs;

--######################################################
--Insertion Chefs--
INSERT INTO Chefs(id_chef) VALUES(4);
INSERT INTO Chefs(id_chef) VALUES(5);

SELECT nom_utilisateur, prénom_utilisateur FROM Utilisateurs
INNER JOIN Chefs ON id_utilisateur = id_chef;

--######################################################
--Insertion Départements--
INSERT INTO Départements (nom_département, id_pôle, chef_département) VALUES('Classique', 3, 4);
INSERT INTO Départements (nom_département, id_pôle, chef_département) VALUES('Jazz', 3, 5);
--INSERT INTO Départements (nom_département, id_pôle, chef_département) VALUES('Baroque', 3, 3);
--INSERT INTO Départements (nom_département, id_pôle, chef_département) VALUES('Musiques actuelles', 3, 5);
SELECT * FROM Départements;

--######################################################
--Insertion Elèves--
INSERT INTO Elèves(id_élève) VALUES
(9),
(10),
(11),
(13),
(16);

SELECT nom_utilisateur, prénom_utilisateur FROM Utilisateurs
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
(4,3),(6,3),(7,3),(10,3),(11,3),(12,3),(15,3),(19,3),(20,3),(23,3),(26,3),(28,3),(31,3);

SELECT nom_instrument 
FROM Instruments 
WHERE id_instrument IN(
    SELECT id_instrument FROM Départements_Instruments 
    WHERE id_département = 3
    );
--######################################################
--Insertion Salles--
INSERT INTO Salles (nom_salle, capacité_salle, id_pôle) VALUES
('Auditorium A',100,3),
('Auditorium B',120,3),
('B01',15,3),
('B02',10,3),
('B03',20,3),
('B04',10,3),
('A01',30,3),
('A02',35,3),
('A03',25,3),
('A04',20,3),
('A05',30,3),
('A06',10,3),
('A07',20,3),
('A08',10,3),
('A09',5,3);


--######################################################
--Insertion Cycles--
INSERT INTO Cycles (nom_cycle,id_département) VALUES
('Cycle 1', 1),('Cycle 2', 1),('Cycle 3', 1),('Cycle Spécialisé', 1),
('Cycle 1', 3),('Cycle 2', 3),('Cycle 3', 3),('Cycle Spécialisé', 3);


--######################################################
--Insertion Matières--
-- Tous les cycles (Jazz)
INSERT INTO Matières (nom_matière, id_cycle) VALUES
('Cours individuel instrument', 5),
('Cours individuel instrument', 6),
('Cours individuel instrument', 7),
('Cours individuel instrument', 8),
('Solfège Jazz', 5),
('Solfège Jazz', 6),
('Solfège Jazz', 7),
('Solfège Jazz', 8),
('Cours d\'ensemble Jazz', 5),
('Cours d\'ensemble Jazz', 6),
('Cours d\'ensemble Jazz', 7),
('Cours d\'ensemble Jazz', 8);
-- Cycles spécifiques (Jazz)
INSERT INTO Matières (nom_matière, id_cycle) VALUES
('Histoire du Jazz',5),
('Atelier Big Band',7),
('Atelier Big Band',8),
('Atelier Standard',7),
('Atelier Standard',8);


--######################################################
--Insertion Matières_Professeurs--
-- Jazz
--Solfège (Evans, Rosenwinkel)
INSERT INTO Matières_Professeurs(id_matière, id_professeur) VALUES
(1,5),(1,7),(2,5),(2,7),(3,5),(3,7),(4,5),(4,7);
--Cours d'ensemble (Redman, Blade)
INSERT INTO Matières_Professeurs(id_matière, id_professeur) VALUES
(5,2),(5,6),(6,2),(6,6),(7,2),(7,6),(8,2),(8,6);
--Instruments (tous)
INSERT INTO Matières_Professeurs(id_matière, id_professeur) VALUES
(9,2),(9,5),(9,6),(9,7),(9,14),(9,15),
(10,2),(10,5),(10,6),(10,7),(10,14),(10,15),
(11,2),(11,5),(11,6),(11,7),(11,14),(11,15),
(12,2),(12,5),(12,6),(12,7),(12,14),(12,15);
--Histoire du Jazz (Davis)
INSERT INTO Matières_Professeurs(id_matière, id_professeur) VALUES
(18,15);
--Big Band (Davis)
INSERT INTO Matières_Professeurs(id_matière, id_professeur) VALUES
(19,15),(20,15);
--Standard (Evans,LaFaro)
INSERT INTO Matières_Professeurs(id_matière, id_professeur) VALUES
(21,14),(21,5),(22,14),(22,5);