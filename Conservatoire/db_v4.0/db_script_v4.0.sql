--######################################################
-- Table Instruments --
CREATE TABLE Instruments (
    id_instrument INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_instrument VARCHAR(32) UNIQUE NOT NULL,
    famille_instrument VARCHAR(11) NOT NULL,
    CONSTRAINT check_famille_instrument
    CHECK(famille_instrument IN('Cordes', 'Bois', 'Cuivres', 'Claviers', 'Percussions', 'Autre'))
);


--######################################################
-- Table Utilisateurs --
CREATE TABLE Utilisateurs (
    id_utilisateur INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_utilisateur VARCHAR(64) NOT NULL,
    prénom_utilisateur VARCHAR(64) NOT NULL,
    pwd_utilisateur VARCHAR(128) NOT NULL,
    login_utilisateur VARCHAR(128) UNIQUE NOT NULL,
    id_instrument INTEGER NOT NULL,
    CONSTRAINT fk_élèves_instruments
        FOREIGN KEY(id_instrument) REFERENCES Instruments(id_instrument)
);



--######################################################
-- Table Professeurs --
CREATE TABLE Professeurs(
    id_professeur INTEGER PRIMARY KEY,
    CONSTRAINT fk_professeurs_utilisateurs
    	FOREIGN KEY(id_professeur) REFERENCES Utilisateurs(id_utilisateur)
);



--######################################################
-- Table Elèves --
CREATE TABLE Elèves(
    id_élève INTEGER PRIMARY KEY,
    CONSTRAINT fk_élèves_utilisateurs
    	FOREIGN KEY(id_élève) REFERENCES Utilisateurs(id_utilisateur)
);



--######################################################
-- Table Salles --
CREATE TABLE Salles (
    id_salle INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_salle VARCHAR(16) NOT NULL
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
CREATE TABLE Départements (
    id_département INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_département VARCHAR(64) UNIQUE NOT NULL,
    chef_département INTEGER NOT NULL,
    CONSTRAINT fk_départements_chefss
    FOREIGN KEY(chef_département) REFERENCES Chefs(id_chef)
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
-- Table Cycles --
CREATE TABLE Cycles (
    id_cycle INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_cycle VARCHAR(64) NOT NULL,
    places_cycle INTEGER NOT NULL,
    cycle_parent INTEGER,
    id_département INTEGER NOT NULL,
    CONSTRAINT cycle_nom_unique 
    	UNIQUE(id_département, nom_cycle),
    CONSTRAINT cycle_parent_unique 
    	UNIQUE(cycle_parent),
    CONSTRAINT fk_cycles_départements
    	FOREIGN KEY(id_département) REFERENCES Départements(id_département),
    CONSTRAINT fk_cycles_cycles
        FOREIGN KEY(cycle_parent) REFERENCES Cycles(id_cycle)
);


--######################################################
-- Table Matières --
CREATE TABLE Matières (
    id_matière INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom_matière VARCHAR(128) NOT NULL,
    durée_matière INTEGER NOT NULL,
    max_élèves_matière INTEGER NOT NULL DEFAULT 0,
    id_cycle INTEGER NOT NULL,
    CONSTRAINT matière_unique 
    	UNIQUE(nom_matière, id_cycle),
    CONSTRAINT fk_matières_cycles
        FOREIGN KEY (id_cycle) REFERENCES Cycles(id_cycle)
);


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
-- Table Créneaux --
CREATE TABLE Créneaux (
    id_créneau INTEGER PRIMARY KEY AUTO_INCREMENT,
    jour_créneau INTEGER NOT NULL,
    début_créneau TIME NOT NULL,
    fin_créneau TIME NOT NULL,
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
-- Table Cours --
CREATE TABLE Cours (
    id_cours INTEGER PRIMARY KEY AUTO_INCREMENT,
    commentaire_professeur TEXT,
    date_cours DATE NOT NULL,
    id_créneau INTEGER NOT NULL,
    CONSTRAINT fk_cours_créneaux
        FOREIGN KEY (id_créneau) REFERENCES Créneaux(id_créneau)
);


--######################################################
-- Table Elèves_Créneaux --
CREATE TABLE Elèves_Créneaux (
    id_élève INTEGER NOT NULL,
    id_créneau INTEGER NOT NULL,
    PRIMARY KEY (id_élève, id_créneau),
    CONSTRAINT fk_ec_élève
        FOREIGN KEY (id_élève) REFERENCES Elèves(id_élève),
    CONSTRAINT fk_ec_cours
        FOREIGN KEY (id_créneau) REFERENCES Créneaux(id_créneau)
);


--######################################################
-- Table Elèves_Cycles --
CREATE TABLE Elèves_Cycles (
    id_élève INTEGER NOT NULL,
    id_cycle INTEGER NOT NULL,
    demande_cycle BOOLEAN NOT NULL,
    inscrit_cycle BOOLEAN NOT NULL,
    promu_cycle BOOLEAN NOT NULL,
    PRIMARY KEY (id_élève, id_cycle),
    CONSTRAINT fk_ecy_élève
        FOREIGN KEY (id_élève) REFERENCES Elèves(id_élève),
    CONSTRAINT fk_ecy_cycle
        FOREIGN KEY (id_cycle) REFERENCES Cycles(id_cycle)
);
