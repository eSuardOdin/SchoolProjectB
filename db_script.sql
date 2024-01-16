DROP TABLE IF EXISTS Professeurs;
DROP TABLE IF EXISTS Directeurs;
DROP TABLE IF EXISTS Utilisateurs;
DROP TABLE IF EXISTS Départements;
DROP TABLE IF EXISTS Pôles;
DROP TABLE IF EXISTS Instruments;
DROP TABLE IF EXISTS Instruments_Enseignés_Départements;
DROP TABLE IF EXISTS Salles;
DROP TABLE IF EXISTS Cycles;

--######################################################
-- Table Utilisateurs --
CREATE TABLE Utilisateurs (
    id_utilisateur INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_utilisateur VARCHAR(64) NOT NULL,
    prénom_utilisateur VARCHAR(64) NOT NULL,
    pwd_utilisateur VARCHAR(128) NOT NULL,
    login_utilisateur VARCHAR(128) UNIQUE NOT NULL 
);
--Insertion
INSERT INTO Utilisateurs(nom_utilisateur, prénom_utilisateur,pwd_utilisateur,login_utilisateur) VALUES
('Dupont','Louis','1234','l.dupont'), -- Directeur Musique
('Redman','Joshua','1234','j.redman'), -- Chef Jazz
('Rameau','Jean-Philippe','1234','jp.rameau'), -- Chef Baroque
('Debussy','Claude','1234','c.debussy'), -- Chef Classique
('Hamasyan','Tigran','1234','t.hamasyan'); -- Chef Actu
--######################################################
-- Table Pôles --
CREATE TABLE Pôles (
    id_pôle INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_pôle VARCHAR(10) UNIQUE NOT NULL
);
--Insertion
INSERT INTO Pôles (nom_pôle) VALUES ('Danse');
INSERT INTO Pôles (nom_pôle) VALUES ('Théatre');
INSERT INTO Pôles (nom_pôle) VALUES ('Musique');
SELECT * FROM Pôles;
--######################################################
-- Table Directeurs --
CREATE TABLE Directeurs (
    id_utilisateur INTEGER PRIMARY KEY,
    id_pôle INTEGER NOT NULL,
    CONSTRAINT fk_directeurs_utilisateurs
    	FOREIGN KEY(id_utilisateur) REFERENCES Utilisateurs(id_utilisateur),
    CONSTRAINT fk_directeurs_pôles
    	FOREIGN KEY(id_pôle) REFERENCES Pôles(id_pôle)
);
--Insertion
INSERT INTO Directeurs(id_utilisateur,id_pôle) VALUES (1,3);

--######################################################
-- Table Départements --
CREATE TABLE Départements (
    id_département INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_département VARCHAR(64) UNIQUE NOT NULL,
    id_pôle INTEGER NOT NULL,
    chef_département INTEGER NOT NULL,
    CONSTRAINT fk_départements_pôles
    FOREIGN KEY(id_pôle) REFERENCES Pôles(id_pôle),
    CONSTRAINT fk_départements_utilisateurs
    FOREIGN KEY(chef_département) REFERENCES Utilisateurs(id_utilisateur)
);
--Insertion
INSERT INTO Départements (nom_département, id_pôle, chef_département) VALUES('Classique', 3, 4);
INSERT INTO Départements (nom_département, id_pôle, chef_département) VALUES('Jazz', 3, 2);
INSERT INTO Départements (nom_département, id_pôle, chef_département) VALUES('Baroque', 3, 3);
INSERT INTO Départements (nom_département, id_pôle, chef_département) VALUES('Musiques actuelles', 3, 5);
SELECT * FROM Départements;

--######################################################
-- Table Instruments --
CREATE TABLE Instruments (
    id_instrument INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_instrument VARCHAR(32) UNIQUE NOT NULL,
    famille_instrument VARCHAR(11) NOT NULL,
    CONSTRAINT check_famille_instrument
    CHECK(famille_instrument IN('Cordes', 'Bois', 'Cuivres', 'Claviers', 'Percussions', 'Autre'))
);
--Insertion
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
-- Table Instruments_Enseignés_Départements --
CREATE TABLE Instruments_Enseignés_Départements (
    id_instrument INTEGER NOT NULL,
    id_département INTEGER NOT NULL,
    PRIMARY KEY (id_instrument, id_département),
    CONSTRAINT fk_instruments_enseignés_départements_instrument
        FOREIGN KEY (id_instrument) REFERENCES Instruments(id_instrument)
        ON DELETE CASCADE,
    CONSTRAINT fk_instruments_enseignés_départements_département
        FOREIGN KEY (id_département) REFERENCES Départements(id_département)
        ON DELETE CASCADE
);
--Insertion
INSERT INTO Instruments_Enseignés_Départements(id_instrument, id_département) VALUES
-- Classique
(1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),
(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),
(26,1),(27,1),(28,1),(29,1),(30,1),
-- Jazz
(4,2),(6,2),(7,2),(10,2),(11,2),(12,2),(15,2),(19,2),(20,2),(23,2),(26,2),(28,2),(31,2);

--######################################################
-- Table Salles --
CREATE TABLE Salles (
    id_salle INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_salle VARCHAR(16) NOT NULL,
    capacité_salle INTEGER NOT NULL,
    id_pôle INTEGER NOT NULL,
    CONSTRAINT salle_unique 
    	UNIQUE(id_pôle, nom_salle),
    CONSTRAINT fk_salles_pôles
    	FOREIGN KEY(id_pôle) REFERENCES Pôles(id_pôle)
);
--Insertion
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
-- Table Cycles --
CREATE TABLE Cycles (
    id_cycle INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_cycle VARCHAR(16) NOT NULL,
    id_département INTEGER NOT NULL,
    CONSTRAINT cycle_unique 
    	UNIQUE(id_département, nom_cycle),
    CONSTRAINT fk_cycles_départements
    	FOREIGN KEY(id_département) REFERENCES Départements(id_département)
);
--Insertion
INSERT INTO Cycles (nom_cycle,id_département) VALUES
('Cycle 1', 1),('Cycle 2', 1),('Cycle 3', 1),('Cycle Spécialisé', 1),
('Cycle 1', 2),('Cycle 2', 2),('Cycle 3', 2),('Cycle Spécialisé', 2);

/*
 *
 * UTILISATEURS Héritage 
 *
 */
-- NEW !!
--######################################################
-- Table Professeurs --
CREATE TABLE Professeurs(
    id_utilisateur INTEGER PRIMARY KEY,
);

--######################################################
-- Table Matières --
CREATE TABLE Matières (
    id_matière INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_matière VARCHAR(128) NOT NULL,
    id_cycle INTEGER NOT NULL,
    CONSTRAINT matière_unique 
    	UNIQUE(nom_matière, id_cycle),
    CONSTRAINT fk_matières_cycles
        FOREIGN KEY (id_cycle) REFERENCES Cycles(id_cycle)
);
--Insertion
INSERT INTO Matières (nom_matière, id_cycle) VALUES
('Solfège Jazz', 5),
('Solfège Jazz', 6),
('Solfège Jazz', 7),
('Solfège Jazz', 8),
('Cours d\'ensemble Jazz', 5),
('Cours d\'ensemble Jazz', 6),
('Cours d\'ensemble Jazz', 7),
('Cours d\'ensemble Jazz', 8);