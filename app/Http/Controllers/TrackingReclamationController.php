<?php

namespace App\Http\Controllers;
use App\Models\reclamation;
use Illuminate\Support\Facades\DB;
use App\Models\TrackingReclamation;
use Illuminate\Http\Request;

class TrackingReclamationController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = reclamation::select('pr.Nom as prof_nom', 'pr.Prenom as prof_prenom', 'md.NomModule', 'ie.NumeroExamen', 'ie.Lieu', 'g.nomGroupe', 'et.CodeApogee', 'et.Nom as etudiant_nom', 'et.Prenom as etudiant_prenom', 'reclamations.Sujet', 'reclamations.observations')
            ->join('professeurs as pr', 'pr.id', '=', 'reclamations.idProfesseur')
            ->join('etudiants as et', 'et.id', '=', 'reclamations.idEtudiant')
            ->join('modules as md', 'md.id', '=', 'reclamations.idModule')
            ->join('info_exames as ie', 'ie.id', '=', 'reclamations.idInfo_Exames')
            ->join('groupes as g', 'g.id', '=', 'ie.idGroupe')
            ->where('reclamations.AnneeUniversitaire', '2023-2024')
            ->get();

        //
        return view('admin.Reclamation', compact('data'));

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
     * @param  \App\Models\TrackingReclamation  $TrackingReclamation
     * @return \Illuminate\Http\Response
     */
    public function show(TrackingReclamation $TrackingReclamation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TrackingReclamation  $TrackingReclamation
     * @return \Illuminate\Http\Response
     */
    public function edit(TrackingReclamation $TrackingReclamation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TrackingReclamation  $TrackingReclamation
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrackingReclamation $TrackingReclamation)
    {
        //
    }
}
