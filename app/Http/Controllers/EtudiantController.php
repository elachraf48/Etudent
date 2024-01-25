<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//-----------
use Illuminate\Support\Facades\DB;
use App\Models\Etudiant;
use App\Models\EtudiantsFiliere;
use App\Models\Filiere;
use App\Models\Module;
use App\Models\DetailModule;
use App\Models\GroupeEtudiant;
use App\Models\Groupe;
use App\Models\InfoExames;
use App\Models\CalendrierModule;
//------
class EtudiantController extends Controller
{




    //----------------------------------------
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('etudiant.index');
    }

    public function searchs(Request $request)
    {
        $codeApogee = $request->input('CodeApogee');

        $validator = Validator::make(['CodeApogee' => $codeApogee], [
            'CodeApogee' => 'required|integer', // Add any additional validation rules
        ]);
        // Example query to get data



        if ($validator->fails()) {
            // Handle validation failure, e.g., return an error response
            return response()->json(['error' => $validator->errors()], 400);
        }

        $student = Etudiant::with(['filieres.modules', 'groupes', 'infoExames', 'detailsModules.calendrierModule'])
            ->where('CodeApogee', $codeApogee)
            ->first();
        // dd($student);
        if ($student) {
            return view('etudiant.search', compact('student'));
        } else {
            return redirect()->route('index')->with('error', 'Aucun étudiant trouvé avec le Code Apogee fourni.');
        }
    }
    public function searchr(Request $request)
    {
        $codeApogee = $request->input('CodeApogee');
        $validator = Validator::make(['CodeApogee' => $codeApogee], [
            'CodeApogee' => 'required|integer', // Add any additional validation rules
        ]);
        // Example query to get data



        if ($validator->fails()) {
            // Handle validation failure, e.g., return an error response
            return response()->json(['error' => $validator->errors()], 400);
        }

        $etudiant = Etudiant::with(['filieres.modules.calendrierModules.session', 'examens', 'groupes'])
            ->where('CodeApogee', $codeApogee)
            ->first();
        if ($etudiant) {
            return view('etudiant.search', compact('etudiant'));
        } else {
            return redirect()->route('index')->with('error', 'Aucun étudiant trouvé avec le Code Apogee fourni.');
        }
    }
    public function search(Request $request)
    {
        $codeApogee = $request->input('CodeApogee');
        $validator = Validator::make(['CodeApogee' => $codeApogee], [
            'CodeApogee' => 'required|integer', // Add any additional validation rules
        ]);
        // Example query to get data
        if ($validator->fails()) {
            // Handle validation failure, e.g., return an error response
            return response()->json(['error' => $validator->errors()], 400);
        }



        $student  = DB::table('Etudiants as e')
            ->select(
                'e.CodeApogee as CodeApogee',
                'e.Nom as Nom',
                'e.Prenom as Prenom',
                'f.NomFiliere as NomFiliere',
                'f.Parcours as Parcours',
                'm.NomModule as NomModule',
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

            ->get();


      
        $groupedModules = $student->groupBy('ExamenSemester');

        if ($student && count($groupedModules)>0) {
            return view('etudiant.search', compact('student', 'groupedModules'));
        } else {
            return redirect()->route('index')->with('error', 'Aucun étudiant trouvé <br>avec le Code Apogee fourni.');
        }
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
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show(Etudiant $etudiant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function edit(Etudiant $etudiant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etudiant $etudiant)
    {
        //
    }
}
