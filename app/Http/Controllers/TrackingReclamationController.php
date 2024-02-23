<?php

namespace App\Http\Controllers;
use App\Models\reclamation;
use Illuminate\Support\Facades\DB;
use App\Models\TrackingReclamation;
use Illuminate\Http\Request;
use App\Models\CalendrierSession;

class TrackingReclamationController extends Controller
{
    //
    /**
     * Display a listing of the resoureclamationse.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = CalendrierSession::all();
        // Retrieve unique values of AnneeUniversitaire
        $AnneeUniversitaire = Reclamation::distinct()->pluck('AnneeUniversitaire');

        // Now $AnneeUniversitaire contains all unique values of AnneeUniversitaire

        // $AnneeUniversitaire = (date('Y') - 1) . '-' . date('Y');

        // $data = reclamation::select('pr.Nom as prof_nom', 'pr.Prenom as prof_prenom', 'md.NomModule', 'ie.NumeroExamen', 'ie.Lieu', 'g.nomGroupe', 'et.CodeApogee', 'et.Nom as etudiant_nom', 'et.Prenom as etudiant_prenom', 'reclamations.Sujet', 'reclamations.observations')
        //     ->join('professeurs as pr', 'pr.id', '=', 'reclamations.idProfesseur')
        //     ->join('etudiants as et', 'et.id', '=', 'reclamations.idEtudiant')
        //     ->join('modules as md', 'md.id', '=', 'reclamations.idModule')
        //     ->join('info_exames as ie', 'ie.id', '=', 'reclamations.idInfo_Exames')
        //     ->join('groupes as g', 'g.id', '=', 'ie.idGroupe')
        //     ->where('reclamations.AnneeUniversitaire', $AnneeUniversitaire)
        //     ->get();

        // //
        return view('admin.Reclamation', compact('sessions','AnneeUniversitaire'));

    }
    public function reclamations($AnneeUniversitaire, $module, $semester, $filiere, $professeur,$sessions)
    {
            
        $reclamations = reclamation::select('pr.Nom as prof_nom', 'pr.Prenom as prof_prenom','md.Semester', 'md.NomModule', 'ie.NumeroExamen', 'ie.Lieu', 'g.nomGroupe', 'et.CodeApogee', 'et.Nom', 'et.Prenom', 'reclamations.Sujet', 'reclamations.observations')
            ->join('professeurs as pr', 'pr.id', '=', 'reclamations.idProfesseur')
            ->join('etudiants as et', 'et.id', '=', 'reclamations.idEtudiant')
            ->join('modules as md', 'md.id', '=', 'reclamations.idModule')
            ->join('info_exames as ie', 'ie.id', '=', 'reclamations.idInfo_Exames')
            ->join('groupes as g', 'g.id', '=', 'ie.idGroupe')
            ->join('filieres as fl', 'fl.id', '=', 'md.idFiliere')
            ->where('reclamations.AnneeUniversitaire', $AnneeUniversitaire)
            ->where('reclamations.idSESSION', 'like', $sessions)
            ->where('pr.id', 'like', $professeur)
            ->where('md.id', 'like', $module)
            ->where('fl.id', 'like', $filiere)
            ->where('md.Semester', 'like', $semester)
            ->get();
    
        
    
        // Return reclamations as JSON
        return response()->json(['reclamations' => $reclamations]);
    }
    
    /**
     * Show the form for creating a new resoureclamationse.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resoureclamationse in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resoureclamationse.
     *
     * @param  \App\Models\TrackingReclamation  $TrackingReclamation
     * @return \Illuminate\Http\Response
     */
    public function show(TrackingReclamation $TrackingReclamation)
    {
        //
    }

    /**
     * Show the form for editing the specified resoureclamationse.
     *
     * @param  \App\Models\TrackingReclamation  $TrackingReclamation
     * @return \Illuminate\Http\Response
     */
    public function edit(TrackingReclamation $TrackingReclamation)
    {
        //
    }

    /**
     * Update the specified resoureclamationse in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TrackingReclamation  $TrackingReclamation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrackingReclamation $TrackingReclamation)
    {
        //
    }

    /**
     * Remove the specified resoureclamationse from storage.
     *
     * @param  \App\Models\TrackingReclamation  $TrackingReclamation
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrackingReclamation $TrackingReclamation)
    {
        //
    }
}
