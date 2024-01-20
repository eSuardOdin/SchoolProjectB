--######################################################
-- Table Utilisateurs --
CREATE TABLE Utilisateurs (
    id_utilisateur INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_utilisateur VARCHAR(64) NOT NULL,
    prénom_utilisateur VARCHAR(64) NOT NULL,
    pwd_utilisateur VARCHAR(128) NOT NULL,
    login_utilisateur VARCHAR(128) UNIQUE NOT NULL 
);
--Insertion Utilisateurs_Directeurs
INSERT INTO Utilisateurs(nom_utilisateur, prénom_utilisateur,pwd_utilisateur,login_utilisateur) VALUES
('Dupont','Louis','1234','l.dupont'); -- Directeur Musique

--Insertion Utilisateurs_Chefs
INSERT INTO Utilisateurs(nom_utilisateur, prénom_utilisateur,pwd_utilisateur,login_utilisateur) VALUES
('Redman','Joshua','1234','j.redman'), -- Chef Jazz
('Rameau','Jean-Philippe','1234','jp.rameau'), -- Chef Baroque
('Debussy','Claude','1234','c.debussy'), -- Chef Classique
('Hamasyan','Tigran','1234','t.hamasyan'); -- Chef Actu

--Insertion Utilisateurs_Profs
INSERT INTO Utilisateurs(nom_utilisateur, prénom_utilisateur,pwd_utilisateur,login_utilisateur) VALUES
('Blade','Brian','1234','b.blade'), -- Prof Batterie Jazz
('Davis','Miles','1234','m.davis'), -- Prof Trompette Jazz
('Rosenwinkel','Kurt','1234','k.rosenwinkel'); -- Prof Guitare Jazz

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
-- Table Professeurs --
CREATE TABLE Professeurs(
    id_utilisateur INTEGER PRIMARY KEY,
    CONSTRAINT fk_professeurs_utilisateurs
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
);

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

--######################################################
-- Table Chefs --
CREATE TABLE Chefs (
    id_utilisateur INTEGER PRIMARY KEY,
    CONSTRAINT fk_chefs_profs 
    FOREIGN KEY(id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
);
/*Contrainte utilisateur = prof pour être chef*/
CREATE TRIGGER est_prof AFTER INSERT ON Chefs
BEGIN
     IF(
         SELECT COUNT(*) FROM Profs AS p
         WHERE p.id_utilisateur = new.id_utilisateur
     ) = 0 THEN
     	SIGNAL SQLSTATE '45000'
     	SET MESSAGE_TXT = 'L\'utilisateur n\'est pas professeur'
     END IF;
 END;

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



