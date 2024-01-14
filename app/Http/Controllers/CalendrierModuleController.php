<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use App\Models\CalendrierModule;
use App\Models\Filiere;
use App\Models\CalendrierModuleGroupe;
use App\Models\Module;
use App\Models\Groupe;
use Illuminate\Http\Request;
use App\Models\CalendrierSession;

class CalendrierModuleController extends Controller
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
     * @param  \App\Models\CalendrierModule  $calendrierModule
     * @return \Illuminate\Http\Response
     */
    public function show(CalendrierModule $calendrierModule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CalendrierModule  $calendrierModule
     * @return \Illuminate\Http\Response
     */
    public function edit(CalendrierModule $calendrierModule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CalendrierModule  $calendrierModule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalendrierModule $calendrierModule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CalendrierModule  $calendrierModule
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalendrierModule $calendrierModule)
    {
        //
    }

    //-------------------------------------------------------------
    public function showCalendriermodules(Request $request)
    {
        // Fetch filieres and parcours to pass to the view

        $semester = $request->input('semester', 's1');
        $sessions = CalendrierSession::all();
        $filieres = Filiere::where('CodeFiliere', 'LIKE', '%' . $semester)->get(['id', 'NomFiliere', 'Parcours']);

        return view('admin.Calendrier_modules', compact('filieres', 'sessions'));
    }

    /**
     * Process the bulk insert of Calendrier Modules Data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insertCalendrierModules(Request $request)
    {
        $request->validate([
            'cld_mod_data' => 'required_without:file',
        ]);

        // For example, you can access form data like this:
        $semester = $request->input('semester');
        $filiere = $request->input('filiere');
        $anneeUniversitaire = $request->input('AnneeUniversitaire');
        $sessions = $request->input('sessions');

        // Create a CalendrierModule record

        if ($request->has('cld_mod_data')) {
            $data = $request->input('cld_mod_data');

            // Process the pasted data and insert into the database
            $rows = explode("\n", $data);

            foreach ($rows as $row) {
                $columns = str_getcsv($row);

                // Fetch idModule based on CodeFiliere and Namemodel
                $idmodule = Module::where('idFiliere', $filiere)
                    ->where('NomModule', $columns[0])
                    ->where('semester', $semester)
                    ->value('id');

                // Check if the module is found
                if (!$idmodule) {
                    return redirect()->route('Calendrier_modules_form')->with('error', 'Module not found for the specified conditions');
                }

                $formattedDate = Carbon::createFromFormat('d/m/Y', $columns[1])->format('Y-m-d');

                // Insert the record in calendrier_modules table
                $calendrierModule = DB::table('calendrier_modules')->insertGetId([
                    'DateExamen' => $formattedDate,
                    'Houre' => $columns[2],
                    'idModule' => $idmodule,
                    'idSESSION' => $sessions,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'AnneeUniversitaire' => $anneeUniversitaire,
                ]);

                // Explode the group names separated by '+'
                $groupNames = explode('+', $columns[3]);

                // Loop through each group and insert into calendrier_module_groupes
                foreach ($groupNames as $groupName) {
                    // Check if the group exists
                    $existingGroup = DB::table('groupes')
                        ->where('nomGroupe', $groupName)
                        ->where('Semester', $semester)
                        ->first();

                    if ($existingGroup) {
                        // Group already exists, no need to insert again
                        $groupeId = $existingGroup->id;
                    } else {
                        // Insert into the groupes table if it doesn't exist and get the ID
                        $groupeId = DB::table('groupes')->insertGetId([
                            'nomGroupe' => $groupName,
                            'Semester' => $semester,
                            'Date_creation' => now()->format('Y/m/d'),
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }

                    // Insert into calender_module_groupes table
                    DB::table('calendrier_module_groupes')->updateOrInsert(
                        ['idCmodule' => $calendrierModule],
                        ['idGroupe' => $groupeId]
                    );
                }
            }

            // Redirect or return a response
            return redirect()->route('Calendrier_modules_form')->with('success', 'Data inserted successfully');
        } else {
            // Handle the case where the module is not found
            return redirect()->route('Calendrier_modules_form')->with('error', 'Module not found for the specified conditions');
        }
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
