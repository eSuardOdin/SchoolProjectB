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
    ('Saxophones', 'Bois'),
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
--Insertion Utilisateurs--
INSERT INTO Utilisateurs(nom_utilisateur, prénom_utilisateur,pwd_utilisateur,login_utilisateur, id_instrument) VALUES
('Redman','Joshua','1234','j.redman', 10), 
('Rameau','Jean-Philippe','1234','jp.rameau', 20),
('Debussy','Claude','1234','c.debussy', 20), -- Chef Classique
('Evans','Bill','1234','b.evans', 20), -- Chef Jazz
('Blade','Brian','1234','b.blade', 28),
('Rosenwinkel','Kurt','1234','k.rosenwinkel', 6),
('Feuillatre','Raphaël','1234','r.feuillatre', 6),
('Montgomery','Wes','1234','w.montgomery', 6),
('Coltrane','John','1234','j.coltrane', 10),
('Hamasyan','Tigran','1234','t.hamasyan', 20), 
('Jones','Elvin','1234','e.jones', 28),
('Gomez','Eddy','1234','e.gomez', 4),
('LaFaro','Scott','1234','s.lafaro', 4),
('Davis','Miles','1234','m.davis', 16),
('Akinmusire','Ambrose','1234','a.akinmusire', 16),
('McBride','Christian','1234','c.mcbride', 4),
('Mehldau','Brad','1234','b.mehldau', 20),
('Gillespie','Dizzie','1234','d.gillespie', 16),
('Parker','Charlie','1234','c.parker', 10),
('Roach','Max','1234','m.roach', 28),
('Williams','Tony','1234','t.williams', 28),
('Hancock','Herbie','1234','h.hancock', 20),
('Motian','Paul','1234','p.motian', 28),
('Pastorius','Jaco','1234','j.pastorius', 7),
('Carter','Ron','1234','r.carter', 4),
('Corea','Chick','1234','c.corea', 20),
('Brown','Clifford','1234','c.brown', 16),
('Fuller','Curtis','1234','c.fuller', 17),
('Shorter','Wayne','1234','w.shorter', 10),
('Bechet','Sidney','1234','s.bechet', 9),
('Hall','Jim','1234','j.hall', 6);
SELECT * FROM Utilisateurs;
--######################################################
--Insertion Professeurs--
-- Saxophones
INSERT INTO Professeurs(id_professeur) VALUES (1);
INSERT INTO Professeurs(id_professeur) VALUES (9);
-- Piano
INSERT INTO Professeurs(id_professeur) VALUES (3);
INSERT INTO Professeurs(id_professeur) VALUES (4);
INSERT INTO Professeurs(id_professeur) VALUES (10);
-- Batterie
INSERT INTO Professeurs(id_professeur) VALUES (11);
INSERT INTO Professeurs(id_professeur) VALUES (23);
-- Contrebasse
INSERT INTO Professeurs(id_professeur) VALUES (12);
INSERT INTO Professeurs(id_professeur) VALUES (13);
-- Basse
INSERT INTO Professeurs(id_professeur) VALUES (24);
-- Trompette
INSERT INTO Professeurs(id_professeur) VALUES (14);
--Trombonne
INSERT INTO Professeurs(id_professeur) VALUES (28);
-- Clarinette
INSERT INTO Professeurs(id_professeur) VALUES (30);
-- Guitare
INSERT INTO Professeurs(id_professeur) VALUES (6);
INSERT INTO Professeurs(id_professeur) VALUES (31);

SELECT id_utilisateur, nom_utilisateur FROM Utilisateurs INNER JOIN Professeurs ON
id_utilisateur = id_professeur;

--######################################################
--Insertion Chefs--
INSERT INTO Chefs(id_chef) VALUES(3);
INSERT INTO Chefs(id_chef) VALUES(4);

SELECT id_utilisateur, nom_utilisateur, prénom_utilisateur FROM Utilisateurs
INNER JOIN Chefs ON id_utilisateur = id_chef;

--######################################################
--Insertion Départements--
INSERT INTO Départements (nom_département, chef_département) VALUES('Classique', 3);
INSERT INTO Départements (nom_département, chef_département) VALUES('Jazz', 4);
--INSERT INTO Départements (nom_département, chef_département) VALUES('Baroque', 3, 3);
--INSERT INTO Départements (nom_département, chef_département) VALUES('Musiques actuelles', 3, 5);
SELECT Départements.nom_département, Départements.id_département, Utilisateurs.nom_utilisateur FROM Départements INNER JOIN Utilisateurs ON chef_département = id_utilisateur;

--######################################################
--Insertion Elèves--
INSERT INTO Elèves(id_élève) VALUES
(2),
(5),
(7),
(8),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(25),
(26),
(27),
(29);

SELECT id_utilisateur, nom_utilisateur, prénom_utilisateur FROM Utilisateurs
INNER JOIN Elèves ON id_utilisateur = id_élève;


--######################################################
--Insertion Départements_Instruments--
INSERT INTO Départements_Instruments(id_instrument, id_département) VALUES
-- Classique
(1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),
(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),
(26,1),(27,1),
-- Jazz
(4,2),(6,2),(7,2),(9,2),(10,2),(16,2),(20,2),(21,2),(25,2),(28,2);

SELECT nom_instrument 
FROM Instruments 
WHERE id_instrument IN(
    SELECT id_instrument FROM Départements_Instruments 
    WHERE id_département = 2
    );
--######################################################
--Insertion Salles--
INSERT INTO Salles (nom_salle) VALUES
('Auditorium A'),
('Auditorium B'),
('B01'),
('B02'),
('B03'),
('B04'),
('A01'),
('A02'),
('A03'),
('A04'),
('A05'),
('A06'),
('A07'),
('A08'),
('A09');


--######################################################
--Insertion Cycles--
INSERT INTO Cycles (nom_cycle, places_cycle, cycle_parent, id_département) VALUES
('Cycle Spécialisé', 10, NULL, 1),('Cycle 3', 10, 1, 1),('Cycle 2', 15, 2, 1),('Cycle 1', 15, 3, 1),('Cycle Spécialisé', 5, NULL, 2),('Cycle 3', 8, 5, 2),('Cycle 2', 10, 6, 2),
('Cycle 1', 10, 7, 2), ('Cycle Découverte Jazz', 10, 8, 2);

SELECT * FROM Cycles;



--************
--*   TODO   *
--************
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

SELECT id_utilisateur, nom_utilisateur, prénom_utilisateur
FROM Utilisateurs
WHERE id_utilisateur IN (SELECT P.id_professeur FROM Professeurs AS P INNER JOIN Matières_Professeurs AS M ON
P.id_professeur = M.id_professeur WHERE M.id_matière = 5);

--######################################################
--Insertion Elèves_Cycles--
INSERT INTO Elèves_Cycles(id_élève, id_cycle) VALUES
(9,5),(10,5),(11,5),(12,5),(13,5),(29,5),(30,5),
(16,6),(19,6),(20,6),(21,6),(23,6),(24,6),
(22,7),(25,7),(26,7),(27,7),(28,7),
(31,8),(32,8),(33,8),(34,8);

SELECT U.nom_utilisateur, C.nom_cycle 
FROM (Utilisateurs AS U
      INNER JOIN Elèves AS E ON U.id_utilisateur = E.id_élève)
INNER JOIN (Cycles AS C 
            INNER JOIN Elèves_Cycles AS EC ON C.id_cycle = EC.id_cycle) 
ON E.id_élève = EC.id_élève;
