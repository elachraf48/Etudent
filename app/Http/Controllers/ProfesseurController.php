<?php

namespace App\Http\Controllers;
use App\Models\Filiere;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


use Illuminate\Http\Request;

class ProfesseurController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filieres = Filiere::where('CodeFiliere', 'LIKE', '%S1' )->get(['id', 'NomFiliere', 'Parcours']);
        return view('admin.bulk_professeurs', compact('filieres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Professeur  $Professeur
     * @return \Illuminate\Http\Response
     */
    public function show(ProfesseurController $Professeur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Professeur  $Professeur
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfesseurController $Professeur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Professeur  $Professeur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfesseurController $Professeur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Professeur  $Professeur
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfesseurController $Professeur)
    {
        //
    }
 
    public function bulk_professeurs_process(Request $request)
    {
        $request->validate([
            'bulk_professeurs_data' => 'required_without:file',
            'file' => 'required_without:bulk_professeurs_data|file|mimes:csv,txt|max:2048',
        ]);
        $semester = $request->input('semester');
        $filiere = $request->input('filiere');
        $anneeUniversitaire = $request->input('AnneeUniversitaire');

        // Check the value of the switch
        $useFile = $request->has('method_switch');
        $isGroupe = $request->has('groupe');

        
        if ($useFile) {
            // File handling logic
            $fileContent = file_get_contents($request->file('file')->path());
            $rows = explode("\n", $fileContent);
        } else {
            // Textarea handling logic
            $professeursData = $request->input('bulk_professeurs_data');
            $rows = explode("\n", $professeursData);
        }

        foreach ($rows as $row) {
            $columns = str_getcsv($row);
            if ($isGroupe) {
                $groupe=0;
            } 
            else{
                $groupe=$columns[3];
            }

           
            // Convert the date format

            // Check if the professeurs already exists based on Code Apogee
            $existingprofesseurs = DB::table('professeurs')
                ->where('Nom', $columns[1])
                ->where('Prenom', $columns[2])
                ->first();

            if ($existingprofesseurs) {
                // If professeurs exists, get the existing professeurs's ID
                $professeursId = $existingprofesseurs->id;
            } else {

                // If professeurs doesn't exist, insert into Etudiants table and get the new professeurs's ID
                $professeursId = DB::table('professeurs')->insertGetId([
                    'Nom' => $columns[1],
                    'Prenom' => $columns[2],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

           

            // Check if the entry already exists in Etudiants_Filieres table
            

            $existingGroup = DB::table('groupes')
                ->where('nomGroupe', $groupe)
                ->where('Semester', $semester)
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
                    'AnneeUniversitaire' => $anneeUniversitaire,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            $existingMdules = DB::table('modules')
                ->where('CodeModule', $columns[0])
                ->first();

            if ($existingMdules) {
                // Group already exists, no need to insert again
                $moduleId = $existingMdules->id;
                // Insert into Info_Exames table
                DB::table('detail_professeurs')->updateOrInsert(
                    ['idModule' => $moduleId,'AnneeUniversitaire' =>  $anneeUniversitaire,'idProfesseur' => $professeursId,'idGroupe' => $groupeId],
                    ['created_at' => now(),
                    'updated_at' => now()
                ]);
            } 

            //-------

            

           
           
            // Add more similar logic for other tables
        }

        // Redirect to the dashboard route after successful data insertion
        return redirect()->route('bulk_professeurs_form')->with('success', 'Data inserted successfully!');
    }
}
