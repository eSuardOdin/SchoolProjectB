--######################################################
-- Table Utilisateurs --
CREATE TABLE Utilisateurs (
    id_utilisateur INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_utilisateur VARCHAR(64) NOT NULL,
    prénom_utilisateur VARCHAR(64) NOT NULL,
    pwd_utilisateur VARCHAR(128) NOT NULL,
    login_utilisateur VARCHAR(128) UNIQUE NOT NULL 
);


--######################################################
-- Table Professeurs --
CREATE TABLE Professeurs(
    id_professeur INTEGER PRIMARY KEY,
    CONSTRAINT fk_professeurs_utilisateurs
    	FOREIGN KEY(id_professeur) REFERENCES Utilisateurs(id_utilisateur)
);


--######################################################
-- Table Directeurs --
CREATE TABLE Directeurs (
    id_directeur INTEGER PRIMARY KEY,
    CONSTRAINT fk_directeurs_utilisateurs
    	FOREIGN KEY(id_directeur) REFERENCES Utilisateurs(id_utilisateur)
);


--######################################################
-- Table Elèves --
CREATE TABLE Elèves(
    id_élève INTEGER PRIMARY KEY,
    CONSTRAINT fk_élèves_utilisateurs
    	FOREIGN KEY(id_élève) REFERENCES Utilisateurs(id_utilisateur)
);


--######################################################
-- Table Pôles --
CREATE TABLE Pôles (
    id_pôle INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_pôle VARCHAR(10) UNIQUE NOT NULL,
    directeur_pôle INTEGER NOT NULL,
    CONSTRAINT fk_pôles_directeurs
    	FOREIGN KEY(directeur_pôle) REFERENCES Directeurs(id_directeur)
);