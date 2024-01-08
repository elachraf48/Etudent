-- Create a stored procedure for inserting exam schedule
DELIMITER //

CREATE PROCEDURE InsertExamSchedule(
    IN moduleName VARCHAR(255),
    IN examDate DATE,
    IN examTime VARCHAR(20),
    IN groupNumbers VARCHAR(255),
    IN semester VARCHAR(5),
    IN filiereCode VARCHAR(10),
    IN AnneeUniversitaire VARCHAR(10)
)
BEGIN
    DECLARE moduleId INT;
    DECLARE groupId INT;

    -- Get the module ID
    SELECT id INTO moduleId
    FROM modules
    WHERE CodeModule = moduleName AND idFiliere = (SELECT id FROM Filieres WHERE CodeFiliere = filiereCode AND Semester = semester);

    -- Create a temporary table to store group IDs
    CREATE TEMPORARY TABLE IF NOT EXISTS TempGroupIds (
        groupId INT
    );

    -- Insert group numbers into the temporary table
    INSERT INTO TempGroupIds (groupId)
    SELECT id
    FROM Groupes
    WHERE nomGroupe IN (SELECT CAST(val AS UNSIGNED) FROM STR_SPLIT(groupNumbers, '+')) AND Semester = semester;

    -- Insert data into 'Calendrier_module' table
    INSERT INTO Calendrier_module (DateExamen, Houre, idModule, AnneeUniversitaire)
    VALUES (examDate, examTime, moduleId, AnneeUniversitaire);

    -- Get the last inserted exam ID
    SET groupId = LAST_INSERT_ID();

    -- Insert data into 'Calendrier_module_Groupes' table
    INSERT INTO Calendrier_module_Groupes (idCmodule, idGroupe)
    SELECT groupId, groupId
    FROM TempGroupIds;

    -- Drop the temporary table
    DROP TEMPORARY TABLE IF EXISTS TempGroupIds;
END //

DELIMITER ;
CALL InsertExamSchedule('Droit budgétaire', '2022-02-05', '11H30-12H30', '_01+02+03+04', 'S3', 'DA', '2023-2024');
  


-- Create a stored procedure for inserting exam data
DELIMITER //

CREATE PROCEDURE InsertExamData(
    IN examNumber INT,
    IN codeApogee INT,
    IN nom VARCHAR(255),
    IN prenom VARCHAR(255),
    IN dateNaiss DATE,
    IN contrSpec ENUM('I', 'NI'),
    IN droInterPri ENUM('I', 'NI'),
    IN difficEntr ENUM('I', 'NI'),
    IN crimino ENUM('I', 'NI'),
    IN droFonc ENUM('I', 'NI'),
    IN droReel ENUM('I', 'NI'),
    IN droAssur ENUM('I', 'NI'),
    IN groupe INT,
    IN lieu VARCHAR(255),
    IN filiereCode VARCHAR(10),
    IN parcours VARCHAR(255),
    IN semester VARCHAR(5),
    IN anneeUniversitaire VARCHAR(10)
)
BEGIN
    DECLARE idEtudiant INT;
    DECLARE idGroupe INT;

    -- Get the student ID
    SELECT id INTO idEtudiant
    FROM Etudiants
    WHERE CodeApogee = codeApogee;

    -- Get the group ID
    SELECT id INTO idGroupe
    FROM Groupes
    WHERE nomGroupe = groupe AND Semester = semester;

    -- Insert data into 'Info_Exames' table
    INSERT INTO Info_Exames (NumeroExamen, idEtudiant, idGroupe, Lieu, AnneeUniversitaire)
    VALUES (examNumber, idEtudiant, idGroupe, lieu, anneeUniversitaire);

    -- Insert data into 'Detail_module' table
    INSERT INTO Detail_module (idEtudiant, etat, SESSION, AnneeUniversitaire)
    VALUES (idEtudiant, contrSpec, 'ORD', anneeUniversitaire),
           (idEtudiant, droInterPri, 'ORD', anneeUniversitaire),
           (idEtudiant, difficEntr, 'ORD', anneeUniversitaire),
           (idEtudiant, crimino, 'ORD', anneeUniversitaire),
           (idEtudiant, droFonc, 'ORD', anneeUniversitaire),
           (idEtudiant, droReel, 'ORD', anneeUniversitaire),
           (idEtudiant, droAssur, 'ORD', anneeUniversitaire);
END //

DELIMITER ;
