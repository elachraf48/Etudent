<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\CalendrierSession;
use App\Http\Controllers\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth::user()->role;
        if ($role == '0') {
            return redirect()->route('Reclamation_form');
        } elseif ($role == '3') {
            return view('etudiant.index');
        }
    }





    public function processFiliermodules(Request $request)
    {
        $request->validate([
            'data' => 'required_without:file',
            'file' => 'required_without:data|file|mimes:csv,txt|max:2048',
        ]);
        $useFile = $request->has('method_switch');
        $deletold = $request->has('delele_old');

        // Check if data is pasted in the textarea
        if ($useFile) {
            $fileContent = file_get_contents($request->file('file')->path());
            $rows = explode("\n", $fileContent);

            // Remove the first element (header) from the array
            $rows = array_slice($rows, 1);
        } else {
            // Textarea handling logic
            $professeursData = $request->input('data');
            $rows = explode("\n", $professeursData);
        }

        foreach ($rows as $row) {
            $columns = str_getcsv($row);
            if (!$columns[0] == '') {
                try {
                    if ($deletold) {
                        $idfiliere = DB::table('Filieres')
                            ->where('CodeFiliere', $columns[5])
                            ->where('NomFiliere', $columns[3])
                            ->where('Parcours', $columns[4])
                            ->value('id');

                        // Delete modules related to the specified filiere
                        DB::table('modules')
                            ->where('idFiliere', $idfiliere)
                            ->delete();

                        // Delete the filiere itself
                        DB::table('Filieres')
                            ->where('id', $idfiliere)
                            ->delete();
                    }
                } catch (\Throwable $e) {
                    return redirect()->route('Filier_modules_form')->with('error', "Vous devez d'abord effacer toutes les données liées avec module");
                }



                // Assuming the structure of your CSV matches the tables in your database
                // Insert data into your tables
                $filiere = DB::table('Filieres')->updateOrInsert(
                    ['CodeFiliere' => $columns[5]],
                    ['NomFiliere' => $columns[3], 'Parcours' => $columns[4], 'created_at' => now(), 'updated_at' => now()],


                );

                // Fetch the id of the existing record or the newly inserted record
                $filiere = DB::table('Filieres')
                    ->where('CodeFiliere', $columns[5])
                    ->value('id');

                $module = DB::table('modules')->updateOrInsert(
                    ['CodeModule' => $columns[1]],
                    ['NomModule' => $columns[2], 'Semester' => $columns[0], 'created_at' => now(), 'updated_at' => now(), 'idFiliere' => $filiere]
                );

                // Add more similar logic for other tables

                // Now, $columns contains the values for each column in the row
                // Insert these values into your database

                // Handle the case where the file is not valid


            }
        }

        // Redirect to the dashboard route after successful data insertion
        // return redirect()->route('Filier_modules_form')->with('error', 'Module not found for the specified conditions');
        return redirect()->route('Filier_modules_form')->with('success', 'Data inserted successfully');
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
        $semester = $request->input('semester');
        $filiere = $request->input('filiere');
        $anneeUniversitaire = $request->input('AnneeUniversitaire');
        $sessions = $request->input('sessions');

        // Check the value of the switch
        $useFile = $request->has('method_switch');
        $isGroupe = $request->has('groupe');
        $iseExamen = $request->has('nbexamen');
        $deletold = $request->has('delele_old');


        $ids = DB::table('reclamations')
            ->where('AnneeUniversitaire', $anneeUniversitaire)
            ->where('idSession', $sessions)
            ->pluck('id')
            ->toArray();
        if (!empty($ids) && $deletold) {
            return redirect()->route('insert_student_form')->with('error', 'La période de réclamation a commencé. Vous ne pouvez pas supprimer les informations précédentes, vous pouvez seulement les ajouter.');
        }
        if ($deletold) {


            // Delete modules related to the specified filiere
            DB::table('info_exames as ie')
                ->join('etudiants_filieres', 'etudiants_filieres.idEtudiant', '=', 'ie.idEtudiant')
                ->where('ie.AnneeUniversitaire', $anneeUniversitaire)
                ->where('ie.Semester', $semester)
                ->where('etudiants_filieres.idFiliere', $filiere)
                ->where('ie.idSession', $sessions)
                ->delete();
            // DB::table('groupe_etudiant')
            //     ->whereExists(function ($query) use ($anneeUniversitaire, $semester) {
            //         $query->select(DB::raw(1))
            //             ->from('groupes')
            //             ->whereColumn('groupes.id', 'groupe_etudiant.idGroupe')
            //             ->where('groupes.AnneeUniversitaire', $anneeUniversitaire)
            //             ->where('groupes.Semester', $semester);
            //     })
            //     ->delete();
            DB::table('groupe_etudiant ')
                ->join('groupes ', 'groupes.id', '=', 'groupe_etudiant.idGroupe')
                ->where('groupes.AnneeUniversitaire', $anneeUniversitaire)
                ->where('groupes.idSESSION', $sessions)
                ->where('groupes.Semester', $semester)
                ->delete();
            
            DB::table('etudiants_filieres')
                ->where('idFiliere', $filiere)
                ->delete();
            // Delete the filiere itself

        }
        if ($useFile) {
            $fileContent = file_get_contents($request->file('file')->path());
            $rows = explode("\n", $fileContent);

            // Remove the first element (header) from the array
            $rows = array_slice($rows, 1);
        } else {
            // Textarea handling logic
            $professeursData = $request->input('student_data');
            $rows = explode("\n", $professeursData);
        }


        $incrementexamen = $request->input('num');

        foreach ($rows as $row) {
            $columns = str_getcsv($row);
            if (!$columns[0] == '') {
                if ($isGroupe) {
                    $groupe = 0;
                } else if ($iseExamen) {
                    $groupe = $columns[5];
                } else {
                    try {
                        $groupe = $columns[6];
                    } catch (\Throwable $e) {
                        return redirect()->route('insert_student_form')->with('error', "décoche button groupe");
                    }
                }

                if ($iseExamen) {
                    $Examen = $incrementexamen;
                } else {
                    try{$Examen = $columns[5];}
                    catch (\Throwable $e) {$Examen=null;}
                    
                }
                // Convert the date format

                // Check if the student already exists based on Code Apogee
                $existingStudent = DB::table('etudiants')
                    ->where('CodeApogee', $columns[0])
                    ->first();

                if ($existingStudent) {
                    // If student exists, get the existing student's ID
                    $etudiantId = $existingStudent->id;
                } else {
                    $rawDate = str_replace(' ', '', $columns[3]);
                    $formattedDate = Carbon::createFromFormat('d/m/Y', $rawDate)->format('Y-m-d');

                    // If student doesn't exist, insert into Etudiants table and get the new student's ID
                    $etudiantId = DB::table('etudiants')->insertGetId([
                        'CodeApogee' => $columns[0],
                        'Nom' => $columns[1],
                        'Prenom' => $columns[2],
                        'DateNaiss' => $formattedDate,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }



                // Check if the entry already exists in Etudiants_Filieres table
                $existingEntry = DB::table('etudiants_filieres')
                    ->where('idEtudiant', $etudiantId)
                    ->where('idFiliere', $filiere)
                    ->exists();

                if (!$existingEntry) {
                    // Insert into Etudiants_Filieres table
                    DB::table('etudiants_filieres')->insert([
                        'idEtudiant' => $etudiantId,
                        'idFiliere' => $filiere,
                    ]);
                }

                $existingGroup = DB::table('groupes')
                    ->where('nomGroupe', $groupe)
                    ->where('Semester', $semester)
                    ->where('idSESSION', $sessions)
                    ->where('AnneeUniversitaire', $anneeUniversitaire)
                    ->first();

                if ($existingGroup) {
                    // Group already exists, no need to insert again
                    $groupeId = $existingGroup->id;
                } else {
                    // Insert into the groupes table if it doesn't exist and get the ID
                    $groupeId = DB::table('groupes')->insertGetId([
                        'nomGroupe' => $groupe,
                        'Semester' => $semester,
                        'idSESSION' => $sessions,
                        'AnneeUniversitaire' => $anneeUniversitaire,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }


                // Insert into Groupe_etudiant table
                DB::table('groupe_etudiant')->updateOrInsert([
                    'idEtudiant' => $etudiantId,
                    'idGroupe' => $groupeId

                ]);

                // Insert into Info_Exames table
                DB::table('info_exames')->updateOrInsert(
                    ['idSession' => $sessions, 'NumeroExamen' => $Examen, 'Semester' => $semester, 'AnneeUniversitaire' =>  $anneeUniversitaire, 'idEtudiant' => $etudiantId, 'idGroupe' => $groupeId],
                    [
                        'Lieu' => $columns[4],
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                );
                $incrementexamen += 1;
            }
            // Add more similar logic for other tables
        }

        // Redirect to the dashboard route after successful data insertion
        return redirect()->route('insert_student_form')->with('success', 'Data inserted successfully!');
    }



    public function showInsertStudentForm()
    {
        $sessions = CalendrierSession::all();
        $filieres = Filiere::where('CodeFiliere', 'LIKE', '%S1')->get(['id', 'NomFiliere', 'Parcours']);

        return view('admin.insert-student', compact('filieres', 'sessions'));
    }
    public function fetchFilieresBySemester($semester)
    {
        // Fetch filieres based on the selected semester
        $filieres = Filiere::where('CodeFiliere', 'LIKE', '%' . $semester)->get(['id', 'NomFiliere', 'Parcours']);

        // Check if filieres are empty
        if ($filieres->isEmpty()) {
            return response()->json(['message' => 'No filieres found for the selected semester'], 404);
        }

        // Return filieres as JSON
        return response()->json(['filieres' => $filieres]);
    }
}
