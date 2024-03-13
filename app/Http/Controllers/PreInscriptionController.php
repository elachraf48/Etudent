<?php

namespace App\Http\Controllers;

use App\Models\PreInscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PreInscriptionController extends Controller
{
    public function showForm(Request $request)
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
            ->whereRaw('ie.idSESSION = g.idSESSION AND g.idSESSION = dm.idSESSION AND ie.idSESSION = (SELECT MAX(ie_inner.idSESSION) FROM info_exames ie_inner WHERE ie_inner.AnneeUniversitaire = (SELECT MAX(AnneeUniversitaire) FROM detail_modules))')
            ->where('dm.AnneeUniversitaire', '=', DB::raw('(SELECT MAX(AnneeUniversitaire) FROM info_exames)'))
            ->where('ie.AnneeUniversitaire', '=', DB::raw('(SELECT MAX(AnneeUniversitaire) FROM detail_modules)'))
            ->where('e.CodeApogee', '=', $codeApogee)

            ->get();



        $groupedModules = $student->groupBy('ExamenSemester');

        if ($student && count($groupedModules) > 0) {
            return view('etudiant.preinscription', compact('student', 'groupedModules'));
        } else {
            return redirect()->route('index')->with('error', 'Aucun étudiant trouvé <br>avec le Code Apogee fourni.');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\PreInscription  $preInscription
     * @return \Illuminate\Http\Response
     */
    public function show(PreInscription $preInscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PreInscription  $preInscription
     * @return \Illuminate\Http\Response
     */
    public function edit(PreInscription $preInscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PreInscription  $preInscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PreInscription $preInscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PreInscription  $preInscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(PreInscription $preInscription)
    {
        //
    }
}
