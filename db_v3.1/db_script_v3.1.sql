--######################################################
-- Table Utilisateurs --
-- à auto increment
CREATE TABLE Utilisateurs (
    id_utilisateur INTEGER PRIMARY KEY,
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
-- à auto increment
CREATE TABLE Pôles (
    id_pôle INTEGER PRIMARY KEY,
    nom_pôle VARCHAR(10) UNIQUE NOT NULL,
    directeur_pôle INTEGER NOT NULL,
    CONSTRAINT fk_pôles_directeurs
    	FOREIGN KEY(directeur_pôle) REFERENCES Directeurs(id_directeur)
);


--######################################################
-- Table Salles --
-- à auto increment
CREATE TABLE Salles (
    id_salle INTEGER PRIMARY KEY,
    nom_salle VARCHAR(16) NOT NULL,
    capacité_salle INTEGER NOT NULL,
    id_pôle INTEGER NOT NULL,
    CONSTRAINT salle_unique 
    	UNIQUE(id_pôle, nom_salle),
    CONSTRAINT fk_salles_pôles
    	FOREIGN KEY(id_pôle) REFERENCES Pôles(id_pôle)
);


--######################################################
-- Table Chefs --
CREATE TABLE Chefs (
    id_chef INTEGER PRIMARY KEY,
    CONSTRAINT fk_chefs_profs 
    FOREIGN KEY(id_chef) REFERENCES Professeurs(id_professeur)
);


--######################################################
-- Table Départements --
-- à auto increment
CREATE TABLE Départements (
    id_département INTEGER PRIMARY KEY,
    nom_département VARCHAR(64) UNIQUE NOT NULL,
    id_pôle INTEGER NOT NULL,
    chef_département INTEGER NOT NULL,
    CONSTRAINT fk_départements_pôles
    FOREIGN KEY(id_pôle) REFERENCES Pôles(id_pôle),
    CONSTRAINT fk_départements_utilisateurs
    FOREIGN KEY(chef_département) REFERENCES Chefs(id_chef)
);


--######################################################
-- Table Cycles --
-- à auto increment
CREATE TABLE Cycles (
    id_cycle INTEGER PRIMARY KEY,
    nom_cycle VARCHAR(16) NOT NULL,
    id_département INTEGER NOT NULL,
    CONSTRAINT cycle_unique 
    	UNIQUE(id_département, nom_cycle),
    CONSTRAINT fk_cycles_départements
    	FOREIGN KEY(id_département) REFERENCES Départements(id_département)
);


--######################################################
-- Table Matières --
-- à auto increment
CREATE TABLE Matières (
    id_matière INTEGER PRIMARY KEY,
    nom_matière VARCHAR(128) NOT NULL,
    id_cycle INTEGER NOT NULL,
    CONSTRAINT matière_unique 
    	UNIQUE(nom_matière, id_cycle),
    CONSTRAINT fk_matières_cycles
        FOREIGN KEY (id_cycle) REFERENCES Cycles(id_cycle)
);


--######################################################
-- Table Départements_Professeurs ? --


--######################################################
-- Table Matières_Professeurs --
CREATE TABLE Matières_Professeurs(
    id_matière INTEGER NOT NULL,
    id_professeur INTEGER NOT NULL,
    PRIMARY KEY (id_matière, id_professeur),
    CONSTRAINT fk_m_p_professeurs
        FOREIGN KEY (id_professeur) REFERENCES Professeurs(id_professeur),
    CONSTRAINT fk_m_p_matières
        FOREIGN KEY (id_matière) REFERENCES Matières(id_matière)
);


--######################################################
-- Table Instruments --
-- à auto increment
CREATE TABLE Instruments (
    id_instrument INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_instrument VARCHAR(32) UNIQUE NOT NULL,
    famille_instrument VARCHAR(11) NOT NULL,
    CONSTRAINT check_famille_instrument
    CHECK(famille_instrument IN('Cordes', 'Bois', 'Cuivres', 'Claviers', 'Percussions', 'Autre'))
);


--######################################################
-- Table Départements_Instruments --
CREATE TABLE Départements_Instruments (
    id_instrument INTEGER NOT NULL,
    id_département INTEGER NOT NULL,
    PRIMARY KEY (id_instrument, id_département),
    CONSTRAINT fk_di_instruments
        FOREIGN KEY (id_instrument) REFERENCES Instruments(id_instrument)
        ON DELETE CASCADE,
    CONSTRAINT fk_di_départements
        FOREIGN KEY (id_département) REFERENCES Départements(id_département)
        ON DELETE CASCADE
);


--######################################################
-- Table Utilisateurs_Instruments ? --


--######################################################
-- Table Cours --
-- à auto increment
CREATE TABLE Cours (
    id_cours INTEGER PRIMARY KEY AUTO_INCREMENT,
    date_cours DATETIME NOT NULL,
    est_ouvert_cours BOOLEAN NOT NULL DEFAULT FALSE,
    durée_cours INTEGER NOT NULL,
    id_salle INTEGER NOT NULL,
    id_matière INTEGER NOT NULL,
    id_professeur INTEGER NOT NULL,
    CONSTRAINT fk_cours_salles
        FOREIGN KEY (id_salle) REFERENCES Salles(id_salle),
    CONSTRAINT fk_cours_matières
        FOREIGN KEY (id_matière) REFERENCES Matières(id_matière),
    CONSTRAINT fk_cours_professeurs
        FOREIGN KEY (id_professeur) REFERENCES Professeurs(id_professeur)
);


--######################################################
-- Table Elèves_Cours --
CREATE TABLE Elèves_Cours (
    id_élève INTEGER NOT NULL,
    id_cours INTEGER NOT NULL,
    PRIMARY KEY (id_élève, id_cours),
    CONSTRAINT fk_ec_élève
        FOREIGN KEY (id_élève) REFERENCES Elèves(id_élève),
    CONSTRAINT fk_ec_cours
        FOREIGN KEY (id_cours) REFERENCES Cours(id_cours)
);


--######################################################
-- Table Elèves_Cycles --
CREATE TABLE Elèves_Cycles (
    id_élève INTEGER NOT NULL,
    id_cycle INTEGER NOT NULL,
    PRIMARY KEY (id_élève, id_cycle),
    CONSTRAINT fk_ecy_élève
        FOREIGN KEY (id_élève) REFERENCES Elèves(id_élève),
    CONSTRAINT fk_ecy_cycle
        FOREIGN KEY (id_cycle) REFERENCES Cycles(id_cycle)
);





--Auto increment

ALTER TABLE Utilisateurs
MODIFY COLUMN id_utilisateur INT AUTO_INCREMENT;
ALTER TABLE Pôles
MODIFY COLUMN id_pôle INT AUTO_INCREMENT;
ALTER TABLE Salles
MODIFY COLUMN id_salle INT AUTO_INCREMENT;
ALTER TABLE Départements
MODIFY COLUMN id_département INT AUTO_INCREMENT;
ALTER TABLE Cycles
MODIFY COLUMN id_cycle INT AUTO_INCREMENT;
ALTER TABLE Matières
MODIFY COLUMN id_matière INT AUTO_INCREMENT;
ALTER TABLE Instruments
MODIFY COLUMN id_instrument INT AUTO_INCREMENT;
ALTER TABLE Cours
MODIFY COLUMN id_cours INT AUTO_INCREMENT;