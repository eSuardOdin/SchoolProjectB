DROP TABLE IF EXISTS Départements;
DROP TABLE IF EXISTS Pôles;

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
-- Table Départements --
CREATE TABLE Départements (
    id_département INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_département VARCHAR(64) UNIQUE NOT NULL,
    id_pôle INTEGER NOT NULL,
    CONSTRAINT fk_départements_pôles
    FOREIGN KEY(id_pôle) REFERENCES Pôles(id_pôle)  
);
--Insertion
INSERT INTO Départements (nom_département, id_pôle) VALUES('Classique', 3);
INSERT INTO Départements (nom_département, id_pôle) VALUES('Jazz', 3);
INSERT INTO Départements (nom_département, id_pôle) VALUES('Baroque', 3);
INSERT INTO Départements (nom_département, id_pôle) VALUES('Musiques actuelles', 3);
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

--######################################################
-- Table Instruments_Enseignés_Départements --
CREATE TABLE Instruments_Enseignés_Départements (
    id_instrument INTEGER NOT NULL,
    id_département INTEGER NOT NULL,
    PRIMARY KEY (id_instrument, id_département),
    CONSTRAINT fk_instruments_enseignés_départements_instrument
    FOREIGN KEY (id_instrument) REFERENCES Instruments(id_instrument),
    CONSTRAINT fk_instruments_enseignés_départements_département
    FOREIGN KEY (id_département) REFERENCES Départements(id_département),
);

