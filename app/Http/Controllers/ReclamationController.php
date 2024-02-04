<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\InfoExame;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Module;
use App\Models\Groupe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class ReclamationController extends Controller
{
    public function index()
    {



        $filieres = Filiere::where('CodeFiliere', 'LIKE', '%S1')->get(['id', 'NomFiliere', 'Parcours']);



        return view('reclamation.index', compact('filieres'));
        // Pass the data to the view

    }
    public function show(Request $request)
    {

        $AnneeUniversitaire = (date('Y') - 1) . '-' . date('Y');
        $codeApogee = $request->input('CodeApogee');
        $semester = $request->input('semester');
        $filiere = $request->input('filiere');

        $validator = Validator::make(['CodeApogee' => $codeApogee], [
            'CodeApogee' => 'required|integer', // Add any additional validation rules
        ]);
        // Example query to get data
        // $etudiants = Etudiant::where('CodeApogee', $codeApogee)->first();
        $student  = DB::table('Etudiants as e')
            ->select(
                'e.CodeApogee as CodeApogee',
                'e.Nom as Nom',
                'e.Prenom as Prenom',
                'f.NomFiliere as NomFiliere',
                'f.Parcours as Parcours',
                'm.NomModule as NomModule',
                'm.id as idModule',
                'g.nomGroupe as NomGroupe',
                'ie.Lieu as Lieu',
                'ie.AnneeUniversitaire as ExamenAnneeUniversitaire',
                'ie.NumeroExamen as NumeroExamen',
                'ie.Semester as ExamenSemester',
                'cm.DateExamen as DateExamen',
                'cm.Houre as Houre'
            )
            ->join('etudiants_filieres as ef', 'e.id', '=', 'ef.idEtudiant')
            ->join('filieres as f', 'ef.idFiliere', '=', 'f.id')
            ->join('modules as m', 'f.id', '=', 'm.idFiliere')
            ->join('detail_modules as dm', function ($join) {
                $join->on('m.id', '=', 'dm.idModule')
                    ->on('dm.idEtudiant', '=', 'e.id')
                    ->where('dm.etat', '=', 'I');
            })
            ->join('groupe_etudiant as ge', 'e.id', '=', 'ge.idEtudiant')
            ->join('groupes as g', function ($join) {
                $join->on('ge.idGroupe', '=', 'g.id')
                    ->whereRaw('g.Semester = m.Semester');
            })
            ->join('info_exames as ie', function ($join) {
                $join->on('e.id', '=', 'ie.idEtudiant')
                    ->on('g.id', '=', 'ie.idGroupe');
            })
            ->join('calendrier_modules as cm', function ($join) {
                $join->on('m.id', '=', 'cm.idModule')
                    ->where('cm.AnneeUniversitaire', '=', DB::raw('(SELECT MAX(AnneeUniversitaire) FROM detail_modules)'));
            })
            ->where('g.idSESSION', '=', DB::raw('(SELECT max(idSESSION) FROM detail_modules WHERE AnneeUniversitaire = (SELECT MAX(AnneeUniversitaire) FROM info_exames))'))
            ->where('dm.AnneeUniversitaire', '=', DB::raw('(SELECT MAX(AnneeUniversitaire) FROM info_exames)'))
            ->where('ie.AnneeUniversitaire', '=', DB::raw('(SELECT MAX(AnneeUniversitaire) FROM detail_modules)'))
            ->where('e.CodeApogee', '=', $codeApogee)
            ->where('f.id', '=', $filiere)

            ->get();


        $filieres = Filiere::where('id', $filiere)->get(['id', 'NomFiliere', 'Parcours']);


        $Modules = Module::where('idFiliere', $filiere)->get(['id', 'NomModule', 'CodeModule']);
        $Groups = Groupe::where('Semester', $semester)->where('AnneeUniversitaire', $AnneeUniversitaire)->get(['id', 'nomGroupe']);


        // if (count($student)>0) {
        //     return redirect()->route('reclamation.next')->with('error', 'Aucun étudiant trouvé <br>avec le Code Apogee fourni.');
        // } else {
        //     return redirect()->route('reclamation.index')->with('error', 'Aucun étudiant trouvé <br>avec le Code Apogee fourni.');
        // }

        if ($validator->fails()) {
            // Handle validation failure, e.g., return an error response
            return response()->json(['error' => $validator->errors()], 400);
        }


        return view('reclamation.next', compact('filieres', 'Modules', 'student', 'semester', 'Groups','codeApogee'));
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
    public function fetchModules($filiere)
    {
        // Fetch modules based on the selected semester and filiere
        $modules = Module::where('idFiliere', $filiere)->get(['id', 'NomModule', 'CodeModule']);

        // Check if modules are empty
        if ($modules->isEmpty()) {
            return response()->json(['message' => 'No modules found for the selected semester and filiere'], 404);
        }

        // Return modules as JSON
        return response()->json(['modules' => $modules]);
    }
    // ReclamationController.php
    public function update()
    {
        $filieres = Filiere::where('CodeFiliere', 'LIKE', '%S1')->get(['id', 'NomFiliere', 'Parcours']);



        return view('reclamation.index', compact('filieres'));
        // Add any necessary logic here
    }

    public function nextReclamationv2()
    {
        return view('reclamation.next');
        // Add any necessary logic here
    }
}
