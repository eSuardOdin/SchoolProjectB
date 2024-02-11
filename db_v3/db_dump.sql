-- MariaDB dump 10.19  Distrib 10.5.21-MariaDB, for debian-linux-gnueabihf (armv7l)
--
-- Host: localhost    Database: db_conservatoireV3
-- ------------------------------------------------------
-- Server version       10.5.21-MariaDB-0+deb11u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Chefs`
--

DROP TABLE IF EXISTS `Chefs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Chefs` (
  `id_chef` int(11) NOT NULL,
  PRIMARY KEY (`id_chef`),
  CONSTRAINT `fk_chefs_profs` FOREIGN KEY (`id_chef`) REFERENCES `Professeurs` (`id_professeur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Chefs`
--

LOCK TABLES `Chefs` WRITE;
/*!40000 ALTER TABLE `Chefs` DISABLE KEYS */;
INSERT INTO `Chefs` VALUES (4),(5);
/*!40000 ALTER TABLE `Chefs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Cours`
--

DROP TABLE IF EXISTS `Cours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Cours` (
  `id_cours` int(11) NOT NULL AUTO_INCREMENT,
  `date_cours` datetime NOT NULL,
  `est_ouvert_cours` tinyint(1) NOT NULL DEFAULT 0,
  `id_salle` int(11) NOT NULL,
  `id_matière` int(11) NOT NULL,
  `id_professeur` int(11) NOT NULL,
  PRIMARY KEY (`id_cours`),
  KEY `fk_cours_salles` (`id_salle`),
  KEY `fk_cours_matières` (`id_matière`),
  KEY `fk_cours_professeurs` (`id_professeur`),
  CONSTRAINT `fk_cours_matières` FOREIGN KEY (`id_matière`) REFERENCES `Matières` (`id_matière`),
  CONSTRAINT `fk_cours_professeurs` FOREIGN KEY (`id_professeur`) REFERENCES `Professeurs` (`id_professeur`),
  CONSTRAINT `fk_cours_salles` FOREIGN KEY (`id_salle`) REFERENCES `Salles` (`id_salle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cours`
--

LOCK TABLES `Cours` WRITE;
/*!40000 ALTER TABLE `Cours` DISABLE KEYS */;
/*!40000 ALTER TABLE `Cours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Cycles`
--

DROP TABLE IF EXISTS `Cycles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Cycles` (
  `id_cycle` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cycle` varchar(16) NOT NULL,
  `id_département` int(11) NOT NULL,
  PRIMARY KEY (`id_cycle`),
  UNIQUE KEY `cycle_unique` (`id_département`,`nom_cycle`),
  CONSTRAINT `fk_cycles_départements` FOREIGN KEY (`id_département`) REFERENCES `Départements` (`id_département`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cycles`
--

LOCK TABLES `Cycles` WRITE;
/*!40000 ALTER TABLE `Cycles` DISABLE KEYS */;
INSERT INTO `Cycles` VALUES (1,'Cycle 1',1),(2,'Cycle 2',1),(3,'Cycle 3',1),(4,'Cycle Spécialisé',1),(5,'Cycle 1',3),(6,'Cycle 2',3),(7,'Cycle 3',3),(8,'Cycle Spécialisé',3);
/*!40000 ALTER TABLE `Cycles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Directeurs`
--

DROP TABLE IF EXISTS `Directeurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Directeurs` (
  `id_directeur` int(11) NOT NULL,
  PRIMARY KEY (`id_directeur`),
  CONSTRAINT `fk_directeurs_utilisateurs` FOREIGN KEY (`id_directeur`) REFERENCES `Utilisateurs` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Directeurs`
--

LOCK TABLES `Directeurs` WRITE;
/*!40000 ALTER TABLE `Directeurs` DISABLE KEYS */;
INSERT INTO `Directeurs` VALUES (1),(17),(18);
/*!40000 ALTER TABLE `Directeurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Départements`
--

DROP TABLE IF EXISTS `Départements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Départements` (
  `id_département` int(11) NOT NULL AUTO_INCREMENT,
  `nom_département` varchar(64) NOT NULL,
  `id_pôle` int(11) NOT NULL,
  `chef_département` int(11) NOT NULL,
  PRIMARY KEY (`id_département`),
  UNIQUE KEY `nom_département` (`nom_département`),
  KEY `fk_départements_pôles` (`id_pôle`),
  KEY `fk_départements_utilisateurs` (`chef_département`),
  CONSTRAINT `fk_départements_pôles` FOREIGN KEY (`id_pôle`) REFERENCES `Pôles` (`id_pôle`),
  CONSTRAINT `fk_départements_utilisateurs` FOREIGN KEY (`chef_département`) REFERENCES `Chefs` (`id_chef`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Départements`
--

LOCK TABLES `Départements` WRITE;
/*!40000 ALTER TABLE `Départements` DISABLE KEYS */;
INSERT INTO `Départements` VALUES (1,'Classique',3,4),(3,'Jazz',3,5);
/*!40000 ALTER TABLE `Départements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Départements_Instruments`
--

DROP TABLE IF EXISTS `Départements_Instruments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Départements_Instruments` (
  `id_instrument` int(11) NOT NULL,
  `id_département` int(11) NOT NULL,
  PRIMARY KEY (`id_instrument`,`id_département`),
  KEY `fk_di_départements` (`id_département`),
  CONSTRAINT `fk_di_départements` FOREIGN KEY (`id_département`) REFERENCES `Départements` (`id_département`) ON DELETE CASCADE,
  CONSTRAINT `fk_di_instruments` FOREIGN KEY (`id_instrument`) REFERENCES `Instruments` (`id_instrument`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Départements_Instruments`
--

LOCK TABLES `Départements_Instruments` WRITE;
/*!40000 ALTER TABLE `Départements_Instruments` DISABLE KEYS */;
INSERT INTO `Départements_Instruments` VALUES (1,1),(2,1),(3,1),(4,1),(4,3),(5,1),(6,1),(6,3),(7,3),(9,1),(10,1),(10,3),(11,1),(11,3),(12,1),(12,3),(13,1),(14,1),(15,1),(15,3),(16,1),(17,1),(18,1),(19,1),(19,3),(20,1),(20,3),(21,1),(22,1),(23,1),(23,3),(24,1),(25,1),(26,1),(26,3),(27,1),(28,1),(28,3),(29,1),(30,1),(31,3);
/*!40000 ALTER TABLE `Départements_Instruments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Elèves`
--

DROP TABLE IF EXISTS `Elèves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Elèves` (
  `id_élève` int(11) NOT NULL,
  PRIMARY KEY (`id_élève`),
  CONSTRAINT `fk_élèves_utilisateurs` FOREIGN KEY (`id_élève`) REFERENCES `Utilisateurs` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Elèves`
--

LOCK TABLES `Elèves` WRITE;
/*!40000 ALTER TABLE `Elèves` DISABLE KEYS */;
INSERT INTO `Elèves` VALUES (9),(10),(11),(13),(16);
/*!40000 ALTER TABLE `Elèves` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Instruments`
--

DROP TABLE IF EXISTS `Instruments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Instruments` (
  `id_instrument` int(11) NOT NULL AUTO_INCREMENT,
  `nom_instrument` varchar(32) NOT NULL,
  `famille_instrument` varchar(11) NOT NULL,
  PRIMARY KEY (`id_instrument`),
  UNIQUE KEY `nom_instrument` (`nom_instrument`),
  CONSTRAINT `check_famille_instrument` CHECK (`famille_instrument` in ('Cordes','Bois','Cuivres','Claviers','Percussions','Autre'))
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Instruments`
--

LOCK TABLES `Instruments` WRITE;
/*!40000 ALTER TABLE `Instruments` DISABLE KEYS */;
INSERT INTO `Instruments` VALUES (1,'Violon','Cordes'),(2,'Alto','Cordes'),(3,'Violoncelle','Cordes'),(4,'Contrebasse','Cordes'),(5,'Harpe','Cordes'),(6,'Guitare','Cordes'),(7,'Guitare basse','Cordes'),(8,'Luth','Cordes'),(9,'Clarinette','Bois'),(10,'Saxophone soprano','Bois'),(11,'Saxophone alto','Bois'),(12,'Saxophone ténor','Bois'),(13,'Saxophone baryton','Bois'),(14,'Flûte piccolo','Bois'),(15,'Flûte traversière','Bois'),(16,'Flûte à bec','Bois'),(17,'Hautbois','Bois'),(18,'Basson','Bois'),(19,'Trompette','Cuivres'),(20,'Trombonne','Cuivres'),(21,'Cor','Cuivres'),(22,'Tuba','Cuivres'),(23,'Piano','Claviers'),(24,'Orgue','Claviers'),(25,'Clavecin','Claviers'),(26,'Accordéon','Claviers'),(27,'Percussions classiques','Percussions'),(28,'Vibraphone','Percussions'),(29,'Xylophone','Percussions'),(30,'Marimba','Percussions'),(31,'Batterie','Percussions');
/*!40000 ALTER TABLE `Instruments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Matières`
--

DROP TABLE IF EXISTS `Matières`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Matières` (
  `id_matière` int(11) NOT NULL AUTO_INCREMENT,
  `nom_matière` varchar(128) NOT NULL,
  `id_cycle` int(11) NOT NULL,
  PRIMARY KEY (`id_matière`),
  UNIQUE KEY `matière_unique` (`nom_matière`,`id_cycle`),
  KEY `fk_matières_cycles` (`id_cycle`),
  CONSTRAINT `fk_matières_cycles` FOREIGN KEY (`id_cycle`) REFERENCES `Cycles` (`id_cycle`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Matières`
--

LOCK TABLES `Matières` WRITE;
/*!40000 ALTER TABLE `Matières` DISABLE KEYS */;
INSERT INTO `Matières` VALUES (5,'Cours d\'ensemble Jazz',5),(6,'Cours d\'ensemble Jazz',6),(7,'Cours d\'ensemble Jazz',7),(8,'Cours d\'ensemble Jazz',8),(1,'Solfège Jazz',5),(2,'Solfège Jazz',6),(3,'Solfège Jazz',7),(4,'Solfège Jazz',8);
/*!40000 ALTER TABLE `Matières` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Matières_Professeurs`
--

DROP TABLE IF EXISTS `Matières_Professeurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Matières_Professeurs` (
  `id_matière` int(11) NOT NULL,
  `id_professeur` int(11) NOT NULL,
  PRIMARY KEY (`id_matière`,`id_professeur`),
  KEY `fk_m_p_professeurs` (`id_professeur`),
  CONSTRAINT `fk_m_p_matières` FOREIGN KEY (`id_matière`) REFERENCES `Matières` (`id_matière`),
  CONSTRAINT `fk_m_p_professeurs` FOREIGN KEY (`id_professeur`) REFERENCES `Professeurs` (`id_professeur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Matières_Professeurs`
--

LOCK TABLES `Matières_Professeurs` WRITE;
/*!40000 ALTER TABLE `Matières_Professeurs` DISABLE KEYS */;
/*!40000 ALTER TABLE `Matières_Professeurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Professeurs`
--

DROP TABLE IF EXISTS `Professeurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Professeurs` (
  `id_professeur` int(11) NOT NULL,
  PRIMARY KEY (`id_professeur`),
  CONSTRAINT `fk_professeurs_utilisateurs` FOREIGN KEY (`id_professeur`) REFERENCES `Utilisateurs` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Professeurs`
--

LOCK TABLES `Professeurs` WRITE;
/*!40000 ALTER TABLE `Professeurs` DISABLE KEYS */;
INSERT INTO `Professeurs` VALUES (2),(3),(4),(5),(6),(7),(8),(14),(15);
/*!40000 ALTER TABLE `Professeurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pôles`
--

DROP TABLE IF EXISTS `Pôles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pôles` (
  `id_pôle` int(11) NOT NULL AUTO_INCREMENT,
  `nom_pôle` varchar(10) NOT NULL,
  `directeur_pôle` int(11) NOT NULL,
  PRIMARY KEY (`id_pôle`),
  UNIQUE KEY `nom_pôle` (`nom_pôle`),
  KEY `fk_pôles_directeurs` (`directeur_pôle`),
  CONSTRAINT `fk_pôles_directeurs` FOREIGN KEY (`directeur_pôle`) REFERENCES `Directeurs` (`id_directeur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pôles`
--

LOCK TABLES `Pôles` WRITE;
/*!40000 ALTER TABLE `Pôles` DISABLE KEYS */;
INSERT INTO `Pôles` VALUES (1,'Danse',17),(2,'Théatre',18),(3,'Musique',1);
/*!40000 ALTER TABLE `Pôles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Salles`
--

DROP TABLE IF EXISTS `Salles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Salles` (
  `id_salle` int(11) NOT NULL AUTO_INCREMENT,
  `nom_salle` varchar(16) NOT NULL,
  `capacité_salle` int(11) NOT NULL,
  `id_pôle` int(11) NOT NULL,
  PRIMARY KEY (`id_salle`),
  UNIQUE KEY `salle_unique` (`id_pôle`,`nom_salle`),
  CONSTRAINT `fk_salles_pôles` FOREIGN KEY (`id_pôle`) REFERENCES `Pôles` (`id_pôle`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Salles`
--

LOCK TABLES `Salles` WRITE;
/*!40000 ALTER TABLE `Salles` DISABLE KEYS */;
INSERT INTO `Salles` VALUES (1,'Auditorium A',100,3),(2,'Auditorium B',120,3),(3,'B01',15,3),(4,'B02',10,3),(5,'B03',20,3),(6,'B04',10,3),(7,'A01',30,3),(8,'A02',35,3),(9,'A03',25,3),(10,'A04',20,3),(11,'A05',30,3),(12,'A06',10,3),(13,'A07',20,3),(14,'A08',10,3),(15,'A09',5,3);
/*!40000 ALTER TABLE `Salles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Utilisateurs`
--

DROP TABLE IF EXISTS `Utilisateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Utilisateurs` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(64) NOT NULL,
  `prénom_utilisateur` varchar(64) NOT NULL,
  `pwd_utilisateur` varchar(128) NOT NULL,
  `login_utilisateur` varchar(128) NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `login_utilisateur` (`login_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Utilisateurs`
--

LOCK TABLES `Utilisateurs` WRITE;
/*!40000 ALTER TABLE `Utilisateurs` DISABLE KEYS */;
INSERT INTO `Utilisateurs` VALUES (1,'Dupont','Louis','1234','l.dupont'),(2,'Redman','Joshua','1234','j.redman'),(3,'Rameau','Jean-Philippe','1234','jp.rameau'),(4,'Debussy','Claude','1234','c.debussy'),(5,'Evans','Bill','1234','b.evans'),(6,'Blade','Brian','1234','b.blade'),(7,'Rosenwinkel','Kurt','1234','k.rosenwinkel'),(8,'Feuillatre','Raphaël','1234','r.feuillatre'),(9,'Montgomery','Wes','1234','w.montgomery'),(10,'Coltrane','John','1234','j.coltrane'),(11,'Hamasyan','Tigran','1234','t.hamasyan'),(12,'Jones','Elvin','1234','e.jones'),(13,'Gomez','Eddy','1234','e.gomez'),(14,'LaFaro','Scott','1234','s.lafaro'),(15,'Davis','Miles','1234','m.davis'),(16,'Akinmusire','Ambrose','1234','a.akinmusire'),(17,'Grognard','Michel','1234','m.grognard'),(18,'Duchemin','Jean','1234','j.duchemin');
/*!40000 ALTER TABLE `Utilisateurs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-18  6:28:33
