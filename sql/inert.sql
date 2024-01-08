
USE StudentDatabase;

INSERT INTO `filieres` (`CodeFiliere`, `NomFiliere`, `Parcours`) 
VALUES ('DFB', 'DROIT EN FRACAIS', 'Droit Public EN FRACAIS'),
('DFP', 'DROIT EN FRACAIS', 'Droit Privé EN FRACAIS'),
('G', 'Sciences économiques et gestion', 'Gestion'),
('EG', 'Sciences économiques et gestion', 'Economie et Gestion'),
('DAB', 'DROIT EN ARABE', 'Droit Public EN ARABE'),
('DAP', 'DROIT EN ARABE', 'Droit Privé EN ARABE'),
( 'DF', 'DROIT EN FRACAIS', ''),
( 'DA', 'DROIT EN ARABE', ''),
( 'SEG', 'Sciences économiqueset gestion', '');

INSERT INTO Etudiants (CodeApogee, Nom, Prenom, DateNaiss) VALUES
    (2209161, 'AABID', 'FATIMA ZAHRA', '2004-08-02'),
    (2108864, 'AACHIR', 'HABIBA', '2002-11-05'),
    (1802210, 'AADLANI', 'HAJAR', '2000-08-10'),
    (2209383, 'AAJAJ', 'OUSSAMA', '2004-06-01'),
    (2115415, 'AALEUI', 'ISMAIL', '2003-10-05'),
    (8007352, 'AAMROUCHE', 'SARA', '1987-09-12'),
    (2209215, 'AAOUINA', 'OMAIMA', '2002-12-20'),
    (2104790, 'AABDOUN', 'FATIMA', '2001-03-13');
    
    

    
    
    
INSERT INTO Etudiants_Filieres (idEtudiant, idFiliere) VALUES
    ((SELECT id FROM Etudiants WHERE CodeApogee = 2209161), (SELECT id FROM Filieres WHERE CodeFiliere = 'DFB')),  -- Linking student with CodeApogee 2209161 to Filiere DFB
    ((SELECT id FROM Etudiants WHERE CodeApogee = 2108864), (SELECT id FROM Filieres WHERE CodeFiliere = 'DFP')),  -- Linking student with CodeApogee 2108864 to Filiere DFP
    ((SELECT id FROM Etudiants WHERE CodeApogee = 1802210), (SELECT id FROM Filieres WHERE CodeFiliere = 'G')),    -- Linking student with CodeApogee 1802210 to Filiere G
    ((SELECT id FROM Etudiants WHERE CodeApogee = 2209383), (SELECT id FROM Filieres WHERE CodeFiliere = 'EG')),   -- Linking student with CodeApogee 2209383 to Filiere EG
    ((SELECT id FROM Etudiants WHERE CodeApogee = 2115415), (SELECT id FROM Filieres WHERE CodeFiliere = 'DAB')),  -- Linking student with CodeApogee 2115415 to Filiere DAB
    ((SELECT id FROM Etudiants WHERE CodeApogee = 8007352), (SELECT id FROM Filieres WHERE CodeFiliere = 'DAP')),  -- Linking student with CodeApogee 8007352 to Filiere DAP
    ((SELECT id FROM Etudiants WHERE CodeApogee = 2209215), (SELECT id FROM Filieres WHERE CodeFiliere = 'DF')),   -- Linking student with CodeApogee 2209215 to Filiere DF
    ((SELECT id FROM Etudiants WHERE CodeApogee = 2104790), (SELECT id FROM Filieres WHERE CodeFiliere = 'DA'))    -- Linking student with CodeApogee 2104790 to Filiere DA
    ;









----

INSERT INTO modules (CodeModule,idFiliere,Semester,NomModule) VALUES
("DFS1M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S1","Introduction aux sciences juridiques"),
("DFS1M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S1","Introduction au droit musulman"),
("DFS1M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S1","Introduction à la science politique"),
("DFS1M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S1","Introduction aux relations internationales"),
("DFS1M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S1","Méthodes des sciences sociales"),
("DFS1M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S1","Introduction aux sciences économiques "),
("DFS1M7",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S1","Langue et terminologie I"),
("DAS1M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S1","Introduction aux sciences juridiques"),
("DAS1M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S1","Introduction au droit musulman"),
("DAS1M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S1","Introduction à la science politique"),
("DAS1M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S1","Introduction aux relations internationales"),
("DAS1M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S1","Méthodes des sciences sociales"),
("DAS1M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S1","Introduction aux sciences économiques "),
("DAS1M7",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S1","Langue et terminologie I"),
("SEGS1M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S1","Introduction à l’économie"),
("SEGS1M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S1","Microéconomie 1"),
("SEGS1M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S1","Comptabilité générale 1"),
("SEGS1M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S1","Management 1"),
("SEGS1M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S1","Statistique descriptive"),
("SEGS1M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S1","Analyse mathématique"),
("SEGS1M7",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S1","Terminologie"),
("DFS2M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S2","Théorie générale et des obligations"),
("DFS2M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S2","Droit commercial"),
("DFS2M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S2","Théorie générale du droit constitutionnel"),
("DFS2M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S2","Droit pénal général"),
("DFS2M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S2","Organisation fdministrative"),
("DFS2M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S2","Droit international public"),
("DFS2M7",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S2","Langue et terminologie 2"),	
("DAS2M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S2","Théorie générale et des obligations"),
("DAS2M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S2","Droit commercial"),
("DAS2M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S2","Théorie générale du droit constitutionnel"),
("DAS2M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S2","Droit pénal général"),
("DAS2M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S2","Organisation fdministrative"),
("DAS2M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S2","Droit international public"),
("DAS2M7",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S2","Langue et terminologie 2"),
("SEGS2M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S2","Macroéconomie"),
("SEGS2M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S2","Microéconomie 2"),
("SEGS2M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S2","Comptabilité générale 2"),
("SEGS2M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S2","Management 2"),
("SEGS2M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S2","Probabilité"),
("SEGS2M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S2","Algèbre ET Math financières"),
("SEGS2M7",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S2","Terminologie"),
("DFS3M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S3","Droit budgétaire"),
("DFS3M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S3","Droit social"),
("DFS3M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S3","Régimes constitutionnels comparés"),
("DFS3M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S3","L'action administrative"),
("DFS3M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S3","Responsabilité civile"),
("DFS3M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S3","Droit de la famille"),
("DAS3M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S3","Droit budgétaire"),
("DAS3M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S3","Droit social"),
("DAS3M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S3","Régimes constitutionnels comparés"),
("DAS3M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S3","L'action administrative"),
("DAS3M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S3","Responsabilité civile"),
("DAS3M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S3","Droit de la famille"),
("SEGS3M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S3","Economie monétaire et financière"),
("SEGS3M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S3","Problèmes économiques et sociaux"),
("SEGS3M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S3","Comptabilité analytique"),
("SEGS3M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S3","Marketing de base"),
("SEGS3M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S3","Echantillonnage et estimation"),
("SEGS3M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S3","Introduction à l’étude du droit"),
("DFS4M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S4","Droit des sociétés"),
("DFS4M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S4","Organisationjudiciaire"),
("DFS4M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S4","Droits de l’homme et libertés publiques"),
("DFS4M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S4","Droit pénalspécial"),
("DFS4M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S4","Droit fiscal"),
("DFS4M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'DF'),"S4","Instruments de paiement et de crédit"),
("DAS4M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S4","Droit des sociétés"),
("DAS4M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S4","Organisationjudiciaire"),
("DAS4M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S4","Droits de l’homme et libertés publiques"),
("DAS4M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S4","Droit pénalspécial"),
("DAS4M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S4","Droit fiscal"),
("DAS4M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'DA'),"S4","Instruments de paiement et de crédit"), 
("SEGS4M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S4","Economie monétaire et financière 2"),
("SEGS4M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S4","Comptabilité des sociétés"),
("SEGS4M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S4","Finances publiques"),
("SEGS4M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S4","Informatique de gestion"),
("SEGS4M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S4","Analyse financière"),
("SEGS4M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'SEG'),"S4","Droit commercial et des sociétés"),
("DFBS5M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFB'),"S5","Administration territoriale"),
("DFBS5M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFB'),"S5","Politiques publiques"),
("DFBS5M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFB'),"S5","Droit économique international"),
("DFBS5M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFB'),"S5","Grands services Publics"),
("DFBS5M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFB'),"S5","Histoires des idées politiques"),
("DFBS5M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFB'),"S5","Finances Locales"),
("DFPS5M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFP'),"S5","Droit foncier et droit réel"),
("DFPS5M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFP'),"S5","Droit international privé"),
("DFPS5M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFP'),"S5","Droit des assurances"),
("DFPS5M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFP'),"S5","criminologie"),
("DFPS5M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFP'),"S5","Contrats spéciaux"),
("DFPS5M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFP'),"S5","Entreprise en difficulté"),
("DABS5M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAB'),"S5","Droit international humanitaire"),
("DABS5M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAB'),"S5","Droit des marchés publics"),
("DABS5M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAB'),"S5","Contentieuxadministratif"),
("DABS5M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAB'),"S5","Histoire des idéespolitiques 2"),
("DABS5M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAB'),"S5","Les organizationsinternationals"),
("DABS5M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAB'),"S5","Projet de fin d’études"),
("DAPS5M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAP'),"S5","Droit foncier et droit réel"),
("DAPS5M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAP'),"S5","Droit international privé"),
("DAPS5M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAP'),"S5","Droit des assurances"),
("DAPS5M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAP'),"S5","criminologie"),
("DAPS5M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAP'),"S5","Contrats spéciaux"),
("DAPS5M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAP'),"S5","Entreprise en difficulté"),
("GS5M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'G'),"S5","Fiscalité d’entreprise"),
("GS5M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'G'),"S5","Gestion financière"),
("GS5M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'G'),"S5","Marketing Approfondi"),
("GS5M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'G'),"S5","Gestion des ressources humaines"),
("GS5M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'G'),"S5","Droit des affaires"),
("GS5M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'G'),"S5","Recherche opérationnelle ET Informatique de gestion"),
("EGS5M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'EG'),"S5","Histoire de la pensée économique"),
("EGS5M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'EG'),"S5","Politique économique"),
("EGS5M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'EG'),"S5","Comptabilité nationale 1"),
("EGS5M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'EG'),"S5","Gestion financière"),
("EGS5M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'EG'),"S5","Gestion des ressources humaines"),
("EGS5M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'EG'),"S5","Fiscalité"),
("DFBS6M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFB'),"S6","Histoire des idées politiques  2"),
("DFBS6M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFB'),"S6","Droit des marchés publics"),
("DFBS6M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFB'),"S6","Droit international humanitaire"),
("DFBS6M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFB'),"S6","Les organisations internationales"),
("DFBS6M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFB'),"S6","Contentieux fdministratif"),
("DFBS6M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFB'),"S6","Projet de fin d’études"),
("DFPS6M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFP'),"S6","Procédurecivile"),
("DFPS6M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFP'),"S6","Procédurepénale"),
("DFPS6M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFP'),"S6","Successions et Droits financiers"),
("DFPS6M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFP'),"S6","Propriétéintellectuelle"),
("DFPS6M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFP'),"S6","Droit bancaire"),
("DFPS6M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'DFP'),"S6","Projet de fin d’études"),
("DABS6M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAB'),"S6","Histoire des idées politiques  2"),
("DABS6M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAB'),"S6","Droit des marchés publics"),
("DABS6M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAB'),"S6","Droit international humanitaire"),
("DABS6M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAB'),"S6","Les organisations internationales"),
("DABS6M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAB'),"S6","Contentieux fdministratif"),
("DABS6M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAB'),"S6","Projet de fin d’études"),
("DAPS6M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAP'),"S6","Droit international humanitaire"),
("DAPS6M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAP'),"S6","Droit des marchés publics"),
("DAPS6M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAP'),"S6","Contentieuxadministratif"),
("DAPS6M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAP'),"S6","Histoire des idéespolitiques 2"),
("DAPS6M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAP'),"S6","Les organizationsinternationals"),
("DAPS6M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'DAP'),"S6","Projet de fin d’études"),
("GS6M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'G'),"S6","Audit général"),
("GS6M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'G'),"S6","Contrôle de gestion"),
("GS6M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'G'),"S6","Management stratégique"),
("GS6M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'G'),"S6","Stratégies industrielles"),
("GS6M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'G'),"S6","Projet de fin d’études"),
("GS6M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'G'),"S6","Projet de fin d’études"),
("EGS6M1",(SELECT id FROM Filieres WHERE CodeFiliere = 'EG'),"S6","Relations économiques internationales"),
("EGS6M2",(SELECT id FROM Filieres WHERE CodeFiliere = 'EG'),"S6","Méthodes économétriques ET Recherche opérationnelle"),
("EGS6M3",(SELECT id FROM Filieres WHERE CodeFiliere = 'EG'),"S6","Informatique appliquée"),
("EGS6M4",(SELECT id FROM Filieres WHERE CodeFiliere = 'EG'),"S6","Contrôle de gestion"),
("EGS6M5",(SELECT id FROM Filieres WHERE CodeFiliere = 'EG'),"S6","Projet de fin d’études"),
("EGS6M6",(SELECT id FROM Filieres WHERE CodeFiliere = 'EG'),"S6","Projet de fin d’études");








CREATE TABLE Detail_module (
    id INT AUTO_INCREMENT PRIMARY KEY,
    CodeModule VARCHAR(20),
    CodeApogee INT,
    etat ENUM('I', 'NI'),
    AnneeUniversitaire VARCHAR(10),
    Date_Creation datetime default CURRENT_TIMESTAMP,
    UNIQUE (id, CodeModule, CodeApogee, AnneeUniversitaire),
    FOREIGN KEY (CodeModule) REFERENCES modules(CodeModule),
    FOREIGN KEY (CodeApogee) REFERENCES Etudiant(CodeApogee)
);



--------INSERT------
-- Insert data into Filieres table
INSERT INTO Filieres (CodeFiliere, NomFiliere, Parcours) VALUES
('F1', 'Computer Science', 'Software Engineering'),
('F2', 'Electrical Engineering', 'Power Systems'),
('F3', 'Mechanical Engineering', 'Thermal Engineering'),
('F4', 'Civil Engineering', 'Structural Engineering'),
('F5', 'Chemical Engineering', 'Process Engineering'),
('F6', 'Biomedical Engineering', 'Biomechanics');

-- Insert data into modules table
INSERT INTO modules (CodeFiliere, ModuleName) VALUES
('F1', 'Programming Fundamentals'),
('F1', 'Database Management Systems'),
('F2', 'Power Electronics'),
('F3', 'Mechanical Design'),
('F4', 'Structural Analysis'),
('F4', 'Concrete Design'),
('F5', 'Chemical Process Optimization'),
('F6', 'Medical Imaging');

-- Insert data into Etudiant table
INSERT INTO Etudiant (CodeApogee, Nom, Prenom, DateNaiss, CodeFiliere) VALUES
(1001, 'Smith', 'John', '1990-05-15', 'F1'),
(1002, 'Johnson', 'Emily', '1992-08-22', 'F2'),
(1003, 'Williams', 'Michael', '1991-03-10', 'F3'),
(1004, 'Brown', 'Olivia', '1993-12-05', 'F4'),
(1005, 'Miller', 'Sophia', '1990-07-18', 'F5'),
(1006, 'Davis', 'Daniel', '1992-02-28', 'F6');


-- Insert data into Groupe table
INSERT INTO Groupe (nom, team) VALUES
('Group A', 'X'),
('Group B', 'Y'),
('Group C', 'Z'),
('Group D', 'P'),
('Group E', 'Q'),
('Group F', 'R');

-- Insert data into Calendrier_exams table
INSERT INTO Calendrier_exams (CodeFiliere, CodeApogee, NumeroExamen, Groupe, Lieu, Semester, AnneeUniversitaire) VALUES
('F1', 1001, 1, 'A', 'Room 101', 'S1', '2023'),
('F2', 1002, 2, 'B', 'Room 201', 'S4', '2023'),
('F3', 1003, 3, 'C', 'Room 301', 'S2', '2023'),
('F4', 1004, 4, 'D', 'Room 401', 'S5', '2023'),
('F5', 1005, 5, 'E', 'Room 501', 'S1', '2023'),
('F6', 1006, 6, 'F', 'Room 601', 'S3', '2023');

-- Insert data into Calendrier_detail table
INSERT INTO Calendrier_detail (horaire, Jour, SESSION, part_Semester, idModule, idGroupe) VALUES
('09:00 AM - 11:00 AM', '2023-09-01', 'ORD', 1, 1, 1),
('02:00 PM - 04:00 PM', '2023-09-02', 'ORD', 1, 2, 2),
('10:00 AM - 12:00 PM', '2023-09-03', 'ORD', 1, 3, 3),
('03:00 PM - 05:00 PM', '2023-09-04', 'RAT', 2, 4, 4),
('11:00 AM - 01:00 PM', '2023-09-05', 'RAT', 2, 5, 5),
('09:00 AM - 11:00 AM', '2023-09-06', 'RAT', 2, 6, 6);



-- Insert data into Detail_module table
INSERT INTO Detail_module (idModule, CodeApogee, etat, AnneeUniversitaire) VALUES
(1, 1001, 'I', '2023'),
(2, 1002, 'NI', '2023'),
(3, 1003, 'I', '2023');
(4, 1004, 'I', '2023'),
(5, 1005, 'NI', '2023'),
(6, 1006, 'I', '2023');




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


----------INSERT detail_module

INSERT INTO detail_modules (idModule, idEtudiant, etat,part_Semester,SESSION, AnneeUniversitaire)
VALUES

/* ---- 2022 --- */
/*--2209161--*/

/*--DFS1--ORD--*/
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M1'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'ORD','2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M2'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','ORD' ,'2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M3'), (SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'ORD','2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M4'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','ORD' ,'2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M5'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'ORD','2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M6'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','ORD' ,'2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M7'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','ORD' ,'2021-2022'),
/*--DFS1--RAT--*/
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M1'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1' ,'RAT','2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M2'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1' ,'RAT' ,'2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M3'), (SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','RAT','2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M4'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'RAT' ,'2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M5'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'NI','1','RAT','2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M6'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'RAT' ,'2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M7'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'RAT' ,'2021-2022'),
/*--DFS3--ORD--*/
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M1'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'ORD','2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M2'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','ORD' ,'2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M3'), (SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'ORD','2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M4'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','ORD' ,'2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M5'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'ORD','2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M6'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','ORD' ,'2021-2022'),
/*--DFS3--RAT--*/
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M1'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1' ,'RAT','2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M2'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'NI','1' ,'RAT' ,'2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M3'), (SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','RAT','2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M4'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'RAT' ,'2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M5'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','RAT','2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M6'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'RAT' ,'2021-2022'),
/* ---- 2023 --- */
/*--2209161--*/

/*--DFS1--ORD--*/
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M1'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'ORD','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M2'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','ORD' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M3'), (SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'ORD','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M4'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','ORD' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M5'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'NI','1', 'ORD','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M6'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','ORD' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M7'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','ORD' ,'2022-2023'),
/*--DFS1--RAT--*/
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M1'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1' ,'RAT','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M2'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'NI','1' ,'RAT' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M3'), (SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','RAT','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M4'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'NI','1', 'RAT' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M5'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'NI','1','RAT','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M6'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'RAT' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M7'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'RAT' ,'2022-2023'),

/*--DFS3--ORD--*/
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M1'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'ORD','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M2'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'NI','1','ORD' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M3'), (SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'ORD','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M4'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','ORD' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M5'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'ORD','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M6'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','ORD' ,'2022-2023'),
/*--DFS3--RAT--*/
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M1'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1' ,'RAT','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M2'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'NI','1' ,'RAT' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M3'), (SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','RAT','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M4'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'NI','1', 'RAT' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M5'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'NI','1','RAT','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M6'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'RAT' ,'2022-2023'),
/*--DFS5--ORD--*/
    ((SELECT id FROM modules WHERE CodeModule = 'DFS2M1'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'ORD','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS2M2'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','ORD' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS2M3'), (SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'ORD','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS2M4'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','ORD' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS2M5'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'ORD','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS2M6'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','ORD' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS2M7'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','ORD' ,'2022-2023'),
/*--DFS5--RAT--*/
    ((SELECT id FROM modules WHERE CodeModule = 'DFS2M1'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1' ,'RAT','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS2M2'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1' ,'RAT' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS2M3'), (SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','RAT','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS2M4'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'RAT' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS2M5'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1','RAT','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS2M6'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'I','1', 'RAT' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS2M7'),(SELECT id FROM Etudiants WHERE CodeApogee = 2209161), 'NI','1', 'RAT' ,'2022-2023'),


/* ---- 2022 --- */
/*--8007352--*/

/*--DFS1--ORD--*/
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M1'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1', 'ORD','2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M2'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1','ORD' ,'2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M3'), (SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1', 'ORD','2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M4'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1','ORD' ,'2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M5'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1', 'ORD','2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M6'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1','ORD' ,'2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M7'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1','ORD' ,'2021-2022'),
/*--DFS1--RAT--*/
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M1'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1' ,'RAT','2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M2'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1' ,'RAT' ,'2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M3'), (SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'NI','1','RAT','2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M4'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1', 'RAT' ,'2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M5'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'NI','1','RAT','2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M6'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1', 'RAT' ,'2021-2022'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M7'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1', 'RAT' ,'2021-2022'),

/* ---- 2023 --- */
/*--8007352--*/

/*--DFS1--ORD--*/
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M1'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1', 'ORD','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M2'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1','ORD' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M3'), (SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'NI','1', 'ORD','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M4'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1','ORD' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M5'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'NI','1', 'ORD','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M6'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1','ORD' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M7'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1','ORD' ,'2022-2023'),
/*--DFS1--RAT--*/
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M1'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1' ,'RAT','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M2'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'NI','1' ,'RAT' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M3'), (SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'NI','1','RAT','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M4'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'NI','1', 'RAT' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M5'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'NI','1','RAT','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M6'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1', 'RAT' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS1M7'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1', 'RAT' ,'2022-2023'),

/*--DFS3--ORD--*/
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M1'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1', 'ORD','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M2'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'NI','1','ORD' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M3'), (SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1', 'ORD','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M4'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1','ORD' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M5'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1', 'ORD','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M6'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1','ORD' ,'2022-2023'),
/*--DFS3--RAT--*/
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M1'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1' ,'RAT','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M2'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'NI','1' ,'RAT' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M3'), (SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1','RAT','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M4'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'NI','1', 'RAT' ,'2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M5'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'NI','1','RAT','2022-2023'),
    ((SELECT id FROM modules WHERE CodeModule = 'DFS3M6'),(SELECT id FROM Etudiants WHERE CodeApogee = 8007352), 'I','1', 'RAT' ,'2022-2023');




CREATE TABLE Groupes (
    id int AUTO_INCREMENT PRIMARY KEY,
    nomGroupe INT NOT null,
    AnneeUniversitaire VARCHAR(10) NOT NULL,
	 Semester VARCHAR(5) NOT NULL        
);
----------INSERT Groupes
----------INSERT Groupes
INSERT INTO Groupes (nomGroupe, Semester)
VALUES
('05' ,'s5'),
('04' ,'s5'),
('03' ,'s5'),
('02' ,'s5'),
('01' ,'s5'),
('_01','s5'),
('02' ,'s3'),
('03' ,'s3'),
('04' ,'s3'),
('_05','s3'),
('06' ,'s3'),
('07' ,'s5'),
('08' ,'s5'),
('09' ,'s5'),
('0'  ,'s1'),
('0'  ,'s3'),
('0'  ,'s5'),
('0'  ,'s2'),
('10' ,'s5');




CREATE TABLE Groupe_etudiant (
idEtudiant INT,
    FOREIGN KEY (idEtudiant) REFERENCES Etudiants(id),
idGroupe INT,
    FOREIGN KEY (idGroupe) REFERENCES Groupes(id),
     PRIMARY KEY (idEtudiant, idGroupe)
 
)

INSERT INTO Groupe_etudiant  (idEtudiant, idGroupe)
VALUES
    ((SELECT id FROM Etudiants WHERE CodeApogee  = '2209161'), (SELECT id FROM Groupes WHERE nomGroupe = '05' and Semester='s5')),
    ((SELECT id FROM Etudiants WHERE CodeApogee  = '2209161'), (SELECT id FROM Groupes WHERE nomGroupe = '_05' and Semester='s3')),
    ((SELECT id FROM Etudiants WHERE CodeApogee  = '2209161'), (SELECT id FROM Groupes WHERE nomGroupe = '0' and Semester='s1')),
    ((SELECT id FROM Etudiants WHERE CodeApogee  = '8007352'), (SELECT id FROM Groupes WHERE nomGroupe = '0' and Semester='s1')),
    ((SELECT id FROM Etudiants WHERE CodeApogee  = '2209161'), (SELECT id FROM Groupes WHERE nomGroupe = '0' and Semester='s2')),
    ((SELECT id FROM Etudiants WHERE CodeApogee  = '8007352'), (SELECT id FROM Groupes WHERE nomGroupe = '0' and Semester='s2')),
    ((SELECT id FROM Etudiants WHERE CodeApogee  = '8007352'), (SELECT id FROM Groupes WHERE nomGroupe = '_05' and Semester='s3'));


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



INSERT INTO Info_Exames (NumeroExamen, Semester, AnneeUniversitaire, Lieu, idEtudiant, idGroupe)
VALUES
('2', 'S1', '2022-2023', 'AMPHI 3', (SELECT id FROM Etudiants WHERE CodeApogee = '2209161' LIMIT 1), (SELECT id FROM Groupes WHERE created_at = (SELECT MAX(created_at) FROM Groupes WHERE Semester = 's1') LIMIT 1)),
('12', 'S3', '2022-2023', 'AMPHI 7', (SELECT id FROM Etudiants WHERE CodeApogee = '2209161' LIMIT 1), (SELECT id FROM Groupes WHERE created_at = (SELECT MAX(created_at) FROM Groupes WHERE Semester = 's3') LIMIT 1)),
('5', 'S2', '2022-2023', 'IBEN KHALDOUN', (SELECT id FROM Etudiants WHERE CodeApogee = '2209161' LIMIT 1), (SELECT id FROM Groupes WHERE created_at = (SELECT MAX(created_at) FROM Groupes WHERE Semester = 's5') LIMIT 1)),
('14', 'S1', '2022-2023', 'ANNEXE 1', (SELECT id FROM Etudiants WHERE CodeApogee = '8007352' LIMIT 1), (SELECT id FROM Groupes WHERE created_at = (SELECT MAX(created_at) FROM Groupes WHERE Semester = 's1') LIMIT 1)),
('5', 'S3', '2022-2023', 'AMPHI 7', (SELECT id FROM Etudiants WHERE CodeApogee = '8007352' LIMIT 1), (SELECT id FROM Groupes WHERE created_at = (SELECT MAX(created_at) FROM Groupes WHERE Semester = 's3') LIMIT 1)),
('2', 'S1', '2022-2023', 'AMPHI 3', (SELECT id FROM Etudiants WHERE CodeApogee = '2209161' LIMIT 1), (SELECT id FROM Groupes WHERE created_at = (SELECT MAX(created_at) FROM Groupes WHERE Semester = 's1') LIMIT 1)),
('16', 'S3', '2021-2022', 'AMPHI 1', (SELECT id FROM Etudiants WHERE CodeApogee = '2209161' LIMIT 1), (SELECT id FROM Groupes WHERE created_at = (SELECT MAX(created_at) FROM Groupes WHERE Semester = 's3') LIMIT 1)),
('7', 'S1', '2021-2022', 'IBEN KHALDOUN', (SELECT id FROM Etudiants WHERE CodeApogee = '8007352' LIMIT 1), (SELECT id FROM Groupes WHERE created_at = (SELECT MAX(created_at) FROM Groupes WHERE Semester = 's1') LIMIT 1));




CREATE TABLE Calendrier_module (
    id int AUTO_INCREMENT PRIMARY KEY,
    DateExamen Date NOT NULL,
    Houre VARCHAR(50) NOT NULL,
    idModule INT,
    FOREIGN KEY (idModule)   REFERENCES modules(id),
    AnneeUniversitaire VARCHAR(10) NOT NULL
);
INSERT INTO calendrier_modules (DateExamen, Houre, AnneeUniversitaire,idModule)
VALUES
('2023-11-12' ,'09:00 AM - 11:00 AM','2022-2023',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M1')),
('2023-11-13' ,'09:00 AM - 11:00 AM','2022-2023',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M2')),
('2023-11-14' ,'09:00 AM - 11:00 AM','2022-2023',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M3')),
('2023-11-15' ,'09:00 AM - 11:00 AM','2022-2023',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M4')),
('2023-11-16' ,'09:00 AM - 11:00 AM','2022-2023',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M5')),
('2023-11-17' ,'09:00 AM - 11:00 AM','2022-2023',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M6')),
('2023-11-18' ,'09:00 AM - 11:00 AM','2022-2023',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M7')),
('2023-11-19' ,'09:00 AM - 11:00 AM','2022-2023',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M1')),
('2023-11-20' ,'09:00 AM - 11:00 AM','2022-2023',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M2')),
('2023-11-21' ,'09:00 AM - 11:00 AM','2022-2023',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M3')),
('2023-11-22' ,'09:00 AM - 11:00 AM','2022-2023',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M4')),
('2023-11-23' ,'12:00 AM - 16:00 AM','2022-2023',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M5')),
('2023-11-24' ,'12:00 AM - 16:00 AM','2022-2023',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M6')),
('2023-11-25' ,'12:00 AM - 16:00 AM','2022-2023',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M7')),
('2023-11-26' ,'12:00 AM - 16:00 AM','2022-2023',(SELECT id FROM modules WHERE CodeModule  = 'DFS3M1')),
('2023-11-27' ,'12:00 AM - 16:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS3M2')),
('2023-11-28' ,'12:00 AM - 16:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS3M3')),
('2023-11-29' ,'12:00 AM - 16:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS3M4')),
('2023-11-30' ,'12:00 AM - 16:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS3M5')),
('2023-12-31' ,'12:00 AM - 16:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS3M6')),
('2023-11-12' ,'12:00 AM - 16:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS2M7')),
('2023-11-13' ,'12:00 AM - 16:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS3M1')),
('2023-11-14' ,'12:00 AM - 16:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS3M2')),
('2023-11-15' ,'11:00 AM - 13:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS3M3')),
('2023-11-16' ,'11:00 AM - 13:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS3M4')),
('2023-11-17' ,'11:00 AM - 13:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS3M5')),
('2023-11-18' ,'11:00 AM - 13:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS3M6')),
('2023-11-19' ,'11:00 AM - 13:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS2M7')),
('2023-11-20' ,'11:00 AM - 13:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFpS5M1')),
('2023-11-21' ,'11:00 AM - 13:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFpS5M2')),
('2023-11-22' ,'11:00 AM - 13:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFpS5M3')),
('2023-11-23' ,'11:00 AM - 13:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFpS5M4')),
('2023-11-24' ,'11:00 AM - 13:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFpS5M5')),
('2023-11-25' ,'11:00 AM - 13:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFpS5M6')),
('2023-11-27' ,'11:00 AM - 13:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFpS5M1')),
('2023-11-28' ,'11:00 AM - 13:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFpS5M2')),
('2023-11-29' ,'11:00 AM - 13:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFpS5M3')),
('2023-11-30' ,'11:00 AM - 13:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFpS5M4')),
('2023-11-31' ,'11:00 AM - 13:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFpS5M5')),
('2023-11-12' ,'08:30 AM - 10:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFpS5M6')),
('2023-11-13' ,'08:30 AM - 10:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS2M7')),
('2023-11-14' ,'08:30 AM - 10:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M1')),
('2023-11-15' ,'08:30 AM - 10:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M2')),
('2023-11-16' ,'08:30 AM - 10:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M3')),
('2023-11-17' ,'08:30 AM - 10:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M4')),
('2023-11-18' ,'08:30 AM - 10:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M5')),
('2023-11-19' ,'08:30 AM - 10:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M6')),
('2023-11-20' ,'08:30 AM - 10:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M7')),
('2023-11-21' ,'08:30 AM - 10:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M1')),
('2023-11-22' ,'08:30 AM - 10:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M2')),
('2023-11-23' ,'08:30 AM - 10:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M3')),
('2023-11-24' ,'08:30 AM - 10:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M4')),
('2023-11-25' ,'08:30 AM - 10:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M5')),
('2023-11-26' ,'08:30 AM - 10:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M6')),
('2023-11-27' ,'08:30 AM - 10:00 AM','2023-2024',(SELECT id FROM modules WHERE CodeModule  = 'DFS1M7'));




CREATE TABLE Calendrier_module_Groupes (
    idCmodule INT,
    FOREIGN KEY (idCmodule)    REFERENCES Calendrier_module(id),
    idGroupe INT,
    FOREIGN KEY (idGroupe)   REFERENCES Groupes(id),
    PRIMARY KEY (idCmodule, idGroupe)
);


INSERT INTO Calendrier_module_Groupes (idCmodule, idGroupe)
VALUES


((SELECT id FROM Calendrier_module WHERE CodeModule  = 'DFS1M7'),(SELECT id FROM Groupes WHERE CodeModule  = 'DFS1M7'));
