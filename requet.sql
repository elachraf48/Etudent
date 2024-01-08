SELECT * FROM filieres;
SELECT * FROM Etudiants;
SELECT * FROM Etudiants_Filieres;
SELECT * FROM modules;
SELECT * FROM detail_module;


/* les filier d un etudiant by CodeApogee */
SELECT E.id , E.CodeApogee , F.NomFiliere , F.Parcours
FROM Etudiants E
JOIN Etudiants_Filieres EF ON E.id = EF.idEtudiant
JOIN Filieres F ON EF.idFiliere = F.id
WHERE E.CodeApogee = 2209161;

/* tout les semester utidier par  etudiant */


SELECT DISTINCT dm.AnneeUniversitaire, m.Semester
FROM Detail_module dm
JOIN modules m ON dm.idModule = m.id
JOIN Etudiants e ON dm.idEtudiant = e.id
WHERE e.CodeApogee = 2209161 AND ;


/* max semester */
SELECT dm.AnneeUniversitaire, MAX(m.Semester) 
FROM Detail_module dm
JOIN modules m ON dm.idModule = m.id
JOIN Etudiants e ON dm.idEtudiant = e.id
WHERE e.CodeApogee = 2209161
GROUP BY dm.AnneeUniversitaire;



/* get info verifier current date pour CodeApogee = 2209161 */

SELECT  dm.AnneeUniversitaire,   m.CodeModule,  dm.etat , dm.partie,  m.Semester
FROM Detail_module dm
JOIN modules m ON dm.idModule = m.id
JOIN Etudiants e ON dm.idEtudiant = e.id
WHERE e.CodeApogee = 2209161 AND dm.AnneeUniversitaire ="2022-2023" AND etat!='NI' ;




-- Assuming the module information is already present in the 'modules' table, let's get the module IDs first.

-- Get the module IDs for the specified modules
SET @moduleDroitBudg = (SELECT id FROM modules WHERE CodeModule = 'Droit budgétaire' AND idFiliere = (SELECT id FROM Filieres WHERE CodeFiliere = 'DA' AND Semester = 'S3'));
SET @moduleDroitSocial = (SELECT id FROM modules WHERE CodeModule = 'Droit social' AND idFiliere = (SELECT id FROM Filieres WHERE CodeFiliere = 'DA' AND Semester = 'S3'));
SET @moduleRegimes = (SELECT id FROM modules WHERE CodeModule = 'Régimes constitutionnels comparés' AND idFiliere = (SELECT id FROM Filieres WHERE CodeFiliere = 'DA' AND Semester = 'S3'));
SET @moduleActionAdmin = (SELECT id FROM modules WHERE CodeModule = "L'action administrative" AND idFiliere = (SELECT id FROM Filieres WHERE CodeFiliere = 'DA' AND Semester = 'S3'));
SET @moduleResponsabiliteCivile = (SELECT id FROM modules WHERE CodeModule = 'Responsabilité civile' AND idFiliere = (SELECT id FROM Filieres WHERE CodeFiliere = 'DA' AND Semester = 'S3'));
SET @moduleDroitFamille = (SELECT id FROM modules WHERE CodeModule = 'Droit de la famille' AND idFiliere = (SELECT id FROM Filieres WHERE CodeFiliere = 'DA' AND Semester = 'S3'));

-- Insert data into 'Calendrier_module' table
INSERT INTO Calendrier_module (DateExamen, Houre, idModule, AnneeUniversitaire)
VALUES
    ('2022-02-05', '11H30-12H30', @moduleDroitBudg, '2022'),
    ('2022-02-05', '12H30-13H30', @moduleDroitSocial, '2022'),
    ('2022-02-07', '11H30-12H30', @moduleRegimes, '2022'),
    ('2022-02-07', '12H30-13H30', @moduleActionAdmin, '2022'),
    ('2022-02-08', '11H30-12H30', @moduleResponsabiliteCivile, '2022'),
    ('2022-02-08', '12H30-13H30', @moduleDroitFamille, '2022');

-- Assuming the 'Groupes' information is already present in the 'Groupes' table, let's get the group IDs next.

-- Get the group IDs for the specified groups
SET @groupe01 = (SELECT id FROM Groupes WHERE nomGroupe = 01 AND Semester = 'S3');
SET @groupe050610 = (SELECT id FROM Groupes WHERE nomGroupe IN (5, 6, 7, 8, 9, 10) AND Semester = 'S3');

-- Insert data into 'Calendrier_module_Groupes' table
INSERT INTO Calendrier_module_Groupes (idCmodule, idGroupe)
VALUES
    (LAST_INSERT_ID(), @groupe01),
    (LAST_INSERT_ID(), @groupe050610);
