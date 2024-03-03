<?php

namespace App\Http\Controllers;
use App\Models\reclamation;
use Illuminate\Support\Facades\DB;
use App\Models\TrackingReclamation;
use Illuminate\Http\Request;
use App\Models\CalendrierSession;
use App\Models\Professeur;

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
    public function indexProfesseur()
    {
        $sessions = CalendrierSession::all();
        // Retrieve unique values of AnneeUniversitaire
        $AnneeUniversitaire = Reclamation::distinct()->pluck('AnneeUniversitaire');

        return view('admin.Professeur', compact('sessions','AnneeUniversitaire'));

    }
    public function reclamations($AnneeUniversitaire, $module, $semester, $filiere, $professeur,$sessions,$stratu)
    {
         
        $reclamations = reclamation::select('tr.Repense','pr.Nom as prof_nom', 'pr.Prenom as prof_prenom','md.Semester', 'md.NomModule', 'ie.NumeroExamen', 'ie.Lieu', 'g.nomGroupe', 'et.CodeApogee', 'et.Nom', 'et.Prenom', 'reclamations.Sujet', 'reclamations.observations')
            ->join('professeurs as pr', 'pr.id', '=', 'reclamations.idProfesseur')
            ->join('etudiants as et', 'et.id', '=', 'reclamations.idEtudiant')
            ->join('modules as md', 'md.id', '=', 'reclamations.idModule')
            ->join('info_exames as ie', 'ie.id', '=', 'reclamations.idInfo_Exames')
            ->join('groupes as g', 'g.id', '=', 'ie.idGroupe')
            ->join('filieres as fl', 'fl.id', '=', 'md.idFiliere')
            ->join('tracking_reclamations AS tr', 'tr.idReclamation', '=', 'reclamations.id')
            ->where('reclamations.AnneeUniversitaire', $AnneeUniversitaire)
            ->where('reclamations.idSESSION', 'like', $sessions)
            ->where('pr.id', 'like', $professeur)
            ->where('md.id', 'like', $module)
            ->where('fl.id', 'like', $filiere)
            ->where('md.Semester', 'like', $semester)
            ->where('tr.stratu', 'like', $stratu)

            ->get();
    
        
    
        // Return reclamations as JSON
        return response()->json(['reclamations' => $reclamations]);
    }
    public function professors_reclamations($AnneeUniversitaire, $module, $semester, $filiere, $professeur,$sessions,$statu)
    {
        
        $query = Professeur::select(
            'professeurs.Nom',
            'professeurs.Prenom',
            DB::raw('SUM(CASE WHEN tr.stratu != "Valide" THEN 1 ELSE 0 END) AS count_not_valid'),
            DB::raw('SUM(CASE WHEN tr.stratu = "Valide" THEN 1 ELSE 0 END) AS count_valid'),
            DB::raw('COUNT(*) AS total')
        )
        ->join('detail_professeurs AS dp', 'dp.idProfesseur', '=', 'professeurs.id')
        ->join('reclamations AS r', 'r.idProfesseur', '=', 'professeurs.id')
        ->join('tracking_reclamations AS tr', 'tr.idReclamation', '=', 'r.id')
        ->join('modules AS m', 'm.id', '=', 'r.idModule')
        ->join('filieres AS f', 'f.id', '=', 'm.idFiliere')
        ->where('m.id', 'like', $module)
        ->where('r.idSESSION', 'like', $sessions)
        ->where('r.AnneeUniversitaire', $AnneeUniversitaire)
        ->where('professeurs.id', 'like', $professeur)
        ->where('m.Semester', 'like', $semester)
        ->where('f.id', 'like', $filiere)
        ->groupBy('professeurs.id');
        if ($statu == 'not_Valide') {
            $query->havingRaw('total != count_valid');
        } else if($statu == '%') {
            $query->havingRaw('total like "%"');
        }
        else{
            $query->havingRaw('total = count_valid');
        }
        $professors = $query->get();
    
    return response()->json(['professors' => $professors]);
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
