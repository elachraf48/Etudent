<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\InfoExame;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Module;

use Illuminate\Http\Request;

class InfoExameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $semester = $request->input('semester', 'S1');
        $nomFiliere = $request->input('nomFiliere','DROIT EN FRACAIS');
        $parcours = $request->input('parcours', 'NULL');

        $filiereOptions = Filiere::where('CodeFiliere', 'LIKE', '%S1')->distinct()->pluck('NomFiliere');
        $defaultModules = Module::select('NomModule', 'CodeModule')
        ->where('idFiliere', function ($subquery) use ($semester,$nomFiliere,$parcours)  {
            $subquery->select('id')
                ->from('filieres')
                ->where('CodeFiliere', 'like' ,'%' .$semester)
                ->where('NomFiliere', $nomFiliere)
                ->where('Parcours', $parcours);


        })
        ->distinct()
        ->pluck('NomModule', 'CodeModule');
            

        // Pass the data to the view
        return view('reqlamation.next', [
            'defaultModules' => $defaultModules,
            'filiereOptions' => $filiereOptions,
        ]);
    }

    public function getNomFiliere()
    {
        $filiereOptions = Filiere::distinct()->pluck('NomFiliere');

        return response()->json($filiereOptions);
    }
   
    
    public function getModules(Request $request)
    {
        // Validate the request
        $request->validate([
            'nomFiliere' => 'required|string',
            'semester' => 'required|string',
            'parcours' => 'required|string',
        ]);

        // Get the selected values from the request
        $nomFiliere = $request->input('nomFiliere');
        $semester = $request->input('semester');
        $parcours = $request->input('parcours');

        // Construct the query to fetch modules based on selected values
        $modules = Module::select('NomModule', 'CodeModule')
            ->where('idFiliere', function ($subquery) use ($semester, $nomFiliere, $parcours) {
                $subquery->select('id')
                    ->from('Filieres')
                    ->where('CodeFiliere', 'like', '%' . $semester)
                    ->where('NomFiliere', $nomFiliere)
                    ->where('Parcours', $parcours);
            })
            ->distinct()
            ->pluck('NomModule', 'CodeModule');

        // Check if any modules were found
        if ($modules->isEmpty()) {
            // If no modules found, you may return an empty array or handle it as needed
            return response()->json([]);
        }

        // Return the fetched modules as a JSON response
        return response()->json($modules);
    }
    
    

       

 
    


    
    
    // In your controller method
    public function showReqlamationForm()
    {
        // Fetch the necessary data
      
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
     * @param  \App\Models\InfoExame  $infoExame
     * @return \Illuminate\Http\Response
     */
    public function show(InfoExame $infoExame)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InfoExame  $infoExame
     * @return \Illuminate\Http\Response
     */
    public function edit(InfoExame $infoExame)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InfoExame  $infoExame
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InfoExame $infoExame)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InfoExame  $infoExame
     * @return \Illuminate\Http\Response
     */
    public function destroy(InfoExame $infoExame)
    {
        //
    }
}
