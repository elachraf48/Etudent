<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\InfoExame;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Module;
use App\Models\Groupe;
use App\Models\Professeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Support\Carbon;

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
        $filieres = Filiere::where('id', $filiere)->get(['id', 'NomFiliere', 'Parcours']);
        $studentuniue = Etudiant::where('CodeApogee', $codeApogee)->get(['CodeApogee', 'Nom', 'Prenom']);
        $Modules = Module::where('idFiliere', $filiere)->get(['id', 'NomModule', 'CodeModule']);
        $Groups = Groupe::where('Semester', $semester)->where('AnneeUniversitaire', $AnneeUniversitaire)->get(['id', 'nomGroupe']);

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
                'ie.Lieu as Lieu','ie.id as idexam',
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

        if ($validator->fails()) {
            // Handle validation failure, e.g., return an error response
            return response()->json(['error' => $validator->errors()], 400);
        }


        return view('reclamation.next', compact('filieres', 'Modules', 'student', 'semester', 'Groups','studentuniue'));
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
    public function fetchProfesseur($modules)
    {
        // Fetch filieres based on the selected semester
        $professeurs = DB::table('professeurs as p')
        ->select('*')
        ->join('detail_professeurs as dp', 'p.id', '=', 'dp.idProfesseur')
        ->where('dp.idModule', $modules)
        ->get();
    
        // Check if filieres are empty
        if ($professeurs->isEmpty()) {
            return response()->json(['message' => 'No professeurs found for the selected module'], 404);
        }

        // Return filieres as JSON
        return response()->json(['professeurs' => $professeurs]);
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
    public function reclamationpost(Request $request)
    {
        $AnneeUniversitaire = (date('Y') - 1) . '-' . date('Y');
        $codeApogee = $request->input('CodeApogee');
        $semester = $request->input('semester');
        $filiere = $request->input('filiere');
        $Nom= $request->input('Nom');
        $Prenom = $request->input('Prenom');
        $idexam = $request->input('idexam');
        $datenes = $request->input('datenes');
        $module = $request->input('module');
        $ndexamen = $request->input('ndexamen');
        $lieu = $request->input('lieu');
        $Group = $request->input('Group');
        $professeur = $request->input('professeur');
        $reclamation = $request->input('reclamation');
        $couse = $request->input('couse');
        //insert  Student
        $existingStudent = DB::table('etudiants')
        ->where('CodeApogee', $codeApogee)
        ->first();

        if ($existingStudent) {
            // If student exists, get the existing student's ID
            $etudiantId = $existingStudent->id;
        } else {
            $rawDate = str_replace(' ', '', $datenes);
            $formattedDate = Carbon::createFromFormat('d/m/Y', $rawDate)->format('Y-m-d');

            // If student doesn't exist, insert into Etudiants table and get the new student's ID
            $etudiantId = DB::table('etudiants')->insertGetId([
                'CodeApogee' => $codeApogee,
                'Nom' => $Nom,
                'Prenom' => $Prenom,
                'DateNaiss' => $formattedDate,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }
        if($idexam!=''){

            return redirect()->route('reclamation.index')->with('error', 'Aucun étudiant trouvé avec le Code Apogee fourni.'.$AnneeUniversitaire.$idexam);

        }

        return $this->index();
        // Add any necessary logic here
    }

    public function nextReclamationv2()
    {
        return $this->index();
    }
}
