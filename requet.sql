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



SELECT modules.NomModule, modules.Semester, detail_modules.SESSION, detail_modules.part_Semester, detail_modules.AnneeUniversitaire
FROM detail_modules
JOIN modules ON detail_modules.idModule = modules.id
JOIN Etudiants ON detail_modules.idEtudiant = Etudiants.id
WHERE Etudiants.CodeApogee = '8007352'
  AND detail_modules.AnneeUniversitaire = '2022-2023'
  AND detail_modules.etat = 'I'
  AND (
    (detail_modules.part_Semester = '2' AND detail_modules.SESSION = 'RAT')
    OR
    (
      (detail_modules.part_Semester = '2' AND detail_modules.SESSION = 'ORD')
      AND NOT EXISTS (
        SELECT 1
        FROM detail_modules sub
        WHERE sub.idEtudiant = detail_modules.idEtudiant
          AND sub.AnneeUniversitaire = detail_modules.AnneeUniversitaire
          AND sub.etat = detail_modules.etat
          AND sub.part_Semester = '2'
          AND sub.SESSION = 'RAT'
      )
    )
    OR
    (
      (detail_modules.part_Semester = '1' AND detail_modules.SESSION = 'RAT')
      AND NOT EXISTS (
        SELECT 1
        FROM detail_modules sub
        WHERE sub.idEtudiant = detail_modules.idEtudiant
          AND sub.AnneeUniversitaire = detail_modules.AnneeUniversitaire
          AND sub.etat = detail_modules.etat
          AND sub.part_Semester = '2'
          AND sub.SESSION IN ('RAT', 'ORD')
      )
    )
    OR
    (
      (detail_modules.part_Semester = '1' AND detail_modules.SESSION = 'ORD')
      AND NOT EXISTS (
        SELECT 1
        FROM detail_modules sub
        WHERE sub.idEtudiant = detail_modules.idEtudiant
          AND sub.AnneeUniversitaire = detail_modules.AnneeUniversitaire
          AND sub.etat = detail_modules.etat
          AND sub.part_Semester IN ('2', '1')
          AND sub.SESSION IN ('RAT', 'ORD')
      )
    )
  );
