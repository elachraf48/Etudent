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

