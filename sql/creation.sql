


CREATE DATABASE StudentDatabase;
/* Create a new database
Use the newly created database
*/
USE StudentDatabase;

/*
Create a table for Filières (Programs)
*/
CREATE TABLE Filieres (
    id INT AUTO_INCREMENT,
    CodeFiliere VARCHAR(10) NOT null,
    NomFiliere VARCHAR(255) NOT null,
    Parcours VARCHAR(255) null,
    PRIMARY KEY (id),
    UNIQUE (CodeFiliere)
);



CREATE TABLE Etudiants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    CodeApogee INT NOT null,
    Nom VARCHAR(255) NOT null,
    Prenom VARCHAR(255) NOT null,
    DateNaiss DATE NOT null,
    UNIQUE (CodeApogee)
);


CREATE TABLE IF NOT EXISTS Etudiants_Filieres (
    idEtudiant INT,
    idFiliere INT,
    FOREIGN KEY (idFiliere) REFERENCES Filieres(id),
    FOREIGN KEY (idEtudiant) REFERENCES Etudiants(id),
    PRIMARY KEY (idEtudiant, idFiliere)
);


CREATE TABLE modules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    CodeModule VARCHAR(255) NOT NULL,
    NomModule VARCHAR(255) NOT NULL, 
    Semester  VARCHAR(2) NOT NULL, 
    idFiliere INT,
   
    UNIQUE (CodeModule,NomModule),
    FOREIGN KEY (idFiliere) REFERENCES filieres(id)
);


CREATE TABLE Detail_module (
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    idModule INT,
    idEtudiant INT,
    etat ENUM('I', 'NI'),
    SESSION ENUM('ORD', 'RAT'),
    part_Semester INT,
    AnneeUniversitaire VARCHAR(10),
   
    FOREIGN KEY (idModule)   REFERENCES modules(id),
    FOREIGN KEY (idEtudiant) REFERENCES Etudiants(id)
);

CREATE TABLE Groupes (
    id int AUTO_INCREMENT PRIMARY KEY,
    nomGroupe INT NOT null,
	 Semester VARCHAR(5) NOT NULL        
);

CREATE TABLE Groupe_etudiant (
idEtudiant INT,
    FOREIGN KEY (idEtudiant) REFERENCES Etudiants(id),
idGroupe INT,
    FOREIGN KEY (idGroupe) REFERENCES Groupes(id),
     PRIMARY KEY (idEtudiant, idGroupe)
 
)

 
CREATE TABLE Info_Exames (
    id int AUTO_INCREMENT PRIMARY KEY,
    NumeroExamen INT NOT null,
    Semester VARCHAR(5) NOT null,
    AnneeUniversitaire VARCHAR(10) NOT NULL,   
    Lieu VARCHAR(255) NOT null,
    idEtudiant INT,
    FOREIGN KEY (idEtudiant) REFERENCES Etudiants(id),
    idGroupe INT,
    FOREIGN KEY (idGroupe) REFERENCES Groupes(id)
);


CREATE TABLE Calendrier_module (
    id int AUTO_INCREMENT PRIMARY KEY,
    DateExamen Date NOT NULL,
    Houre varchar(20) NOT NULL,
    idModule INT,
    FOREIGN KEY (idModule)   REFERENCES modules(id),
    AnneeUniversitaire VARCHAR(10) NOT NULL
);
 

CREATE TABLE Calendrier_module_Groupes (
    idCmodule INT,
    FOREIGN KEY (idCmodule)    REFERENCES Calendrier_module(id),
    idGroupe INT,
    FOREIGN KEY (idGroupe)   REFERENCES Groupes(id),
    PRIMARY KEY (idCmodule, idGroupe)
);

 
 




 
	 
	  