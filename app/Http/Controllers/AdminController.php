<?php

namespace App\Http\Controllers;
use App\Models\Filiere;
use App\Models\CalendrierSession;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;



class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = CalendrierSession::all();
        return view('admin.Calendrier_modules', compact('sessions'));


    }
    public function processFiliermodules(Request $request)
    {
        $request->validate([
            'data' => 'required_without:file',
            'file' => 'required_without:data|file|mimes:csv,txt|max:2048',
        ]);

        // Check if data is pasted in the textarea
        if ($request->has('data')) {
            $data = $request->input('data');

            // Process the pasted data and insert into the database
            $rows = explode("\n", $data);

            foreach ($rows as $row) {
                $columns = str_getcsv($row);

                // Assuming the structure of your CSV matches the tables in your database
                // Insert data into your tables
                $filiere = DB::table('Filieres')->updateOrInsert(
                    ['CodeFiliere' => $columns[5]],
                    ['NomFiliere' => $columns[3], 'Parcours' => $columns[4], 'created_at' => now(), 'updated_at' => now()],


                );

                // Fetch the id of the existing record or the newly inserted record
                $filiereId = DB::table('Filieres')
                    ->where('CodeFiliere', $columns[5])
                    ->value('id');

                $module = DB::table('modules')->updateOrInsert(
                    ['CodeModule' => $columns[1]],
                    ['NomModule' => $columns[2], 'Semester' => $columns[0], 'created_at' => now(), 'updated_at' => now(), 'idFiliere' => $filiereId]
                );

                // Add more similar logic for other tables

                // Now, $columns contains the values for each column in the row
                // Insert these values into your database
            }
        } else {
            // File handling logic
            $file = $request->file('file');

            // Ensure the file is valid
            if ($file->isValid()) {
                // Get the contents of the file
                $fileContent = file_get_contents($file->getRealPath());

                // Process the file content and insert into the database
                $rows = explode("\n", $fileContent);

                foreach ($rows as $row) {
                    $columns = str_getcsv($row);

                    // Continue with the same logic as above for database insertion
                }
            } else {
                // Handle the case where the file is not valid
                return redirect()->route('Filier_modules_form')->with('success', 'Data inserted successfully');
            }
        }

        // Redirect to the dashboard route after successful data insertion
        return redirect()->route('Filier_modules_form')->with('error', 'Module not found for the specified conditions');
    }



    public function showFiliermodules()
    {
        return view('admin.Filier_modules'); // Update with the correct view path
    }
    
    // app/Http/Controllers/AdminController.php

    public function showExamDataForm()
    {
        return view('admin.insert-exam-data');
    }
    // AdminController.php

    public function processStudentData(Request $request)
    {
        $request->validate([
            'student_data' => 'required_without:file',
            'file' => 'required_without:student_data|file|mimes:csv,txt|max:2048',
        ]);
        $sessions = $request->input('sessions');
        $anneeUniversitaire = $request->input('AnneeUniversitaire');

        // Check the value of the switch
        $useFile = $request->has('method_switch');

        if ($useFile) {
            // File handling logic
            $fileContent = file_get_contents($request->file('file')->path());
            $rows = explode("\n", $fileContent);
        } else {
            // Textarea handling logic
            $studentData = $request->input('student_data');
            $rows = explode("\n", $studentData);
        }

        foreach ($rows as $row) {
            $columns = str_getcsv($row);

            // Convert the date format
            $formattedDate = Carbon::createFromFormat('d/m/Y', $columns[4])->format('Y-m-d');

            // Check if the student already exists based on Code Apogee
            $existingStudent = DB::table('etudiants')
                ->where('CodeApogee', $columns[1])
                ->first();

            if ($existingStudent) {
                // If student exists, get the existing student's ID
                $etudiantId = $existingStudent->id;
            } else {
                // If student doesn't exist, insert into Etudiants table and get the new student's ID
                $etudiantId = DB::table('etudiants')->insertGetId([
                    'CodeApogee' => $columns[1],
                    'Nom' => $columns[2],
                    'Prenom' => $columns[3],
                    'DateNaiss' => $formattedDate,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Fetch the filiere ID based on your criteria (adjust this query accordingly)
            $filiereId = DB::table('filieres')
                ->where('CodeFiliere', $columns[6]) // Assuming the criteria is based on CodeFiliere
                ->value('id');

            // Check if the entry already exists in Etudiants_Filieres table
            $existingEntry = DB::table('etudiants_filieres')
                ->where('idEtudiant', $etudiantId)
                ->where('idFiliere', $filiereId)
                ->exists();

            if (!$existingEntry) {
                // Insert into Etudiants_Filieres table
                DB::table('etudiants_filieres')->insert([
                    'idEtudiant' => $etudiantId,
                    'idFiliere' => $filiereId,
                ]);
            }

            $groupeId = DB::table('groupes')
                ->where('nomGroupe', $columns[8])
                ->where('Semester', $columns[7])
                ->where('Date_creation', now()->format('Y/m/d'),)
                ->value('id');

            if (!$groupeId) {
                // If the entry doesn't exist, insert into the groupes table and get the new group's ID
                $groupeId = DB::table('groupes')->insertGetId([
                    'nomGroupe' => $columns[8],
                    'Semester' => $columns[7],
                    'Date_creation' => now()->format('Y/m/d'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }


            // Insert into Groupe_etudiant table
            DB::table('groupe_etudiant')->insert([
                'idEtudiant' => $etudiantId,
                'idGroupe' => $groupeId,

            ]);

            // Insert into Info_Exames table
            DB::table('info_exames')->insert([
                'NumeroExamen' => $columns[0],
                'Semester' => $columns[7],
                'AnneeUniversitaire' =>  $anneeUniversitaire,
                'Lieu' => $columns[5],
                'idEtudiant' => $etudiantId,
                'idGroupe' => $groupeId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Add more similar logic for other tables
        }

        // Redirect to the dashboard route after successful data insertion
        return redirect()->route('insert_student_form')->with('success', 'Data inserted successfully!');
    }



    public function showInsertStudentForm()
    {
        $sessions = CalendrierSession::all();
        return view('admin.insert-student', compact('sessions'));
    }
}
