<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reclamation;

class PDFController extends Controller
{
    public function showPDF(Request $request)
    {
        // Retrieve data from the request
        
        $result = Reclamation::select(
            'reclamations.AnneeUniversitaire',
            'etudiants.CodeApogee',
            'etudiants.Nom',
            'etudiants.Prenom',
            'modules.Semester',
            'modules.NomModule',
            'filieres.NomFiliere',
            'filieres.Parcours',
            'info_exames.Lieu',
            'info_exames.NumeroExamen',
            'groupes.nomGroupe',
            'professeurs.Nom as ProfNom',
            'professeurs.Prenom as ProfPrenom',
            'reclamations.Sujet',
            'reclamations.observations',
            'reclamations.code_tracking'
        )
            ->join('modules', 'modules.id', '=', 'reclamations.idModule')
            ->join('filieres', 'filieres.id', '=', 'modules.idFiliere')
            ->join('professeurs', 'professeurs.id', '=', 'reclamations.idProfesseur')
            ->join('etudiants', 'etudiants.id', '=', 'reclamations.idEtudiant')
            ->join('info_exames', 'info_exames.id', '=', 'reclamations.idInfo_Exames')
            ->join('groupe_etudiant', 'groupe_etudiant.idEtudiant', '=', 'etudiants.id')
            ->join('groupes', 'groupes.id', '=', 'groupe_etudiant.idGroupe')
            ->where('reclamations.id', '=', '7')
            ->first();

        // Pass the data to the view
        return view('reclamation.showpdf', compact('result'));
    }
}
