<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reclamation;

class DetailProfesseurController extends Controller
{
    /**
     * Display a listing of the resource.lmowadef dyalna lah ynesro 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reclamationsCount = Reclamation::join('tracking_reclamations as tr', 'tr.idReclamation', '=', 'reclamations.id')
            ->where('tr.stratu', '!=', 'Valide')
            ->where('reclamations.idProfesseur', 1)
            ->count();
        return view('dashboard', ['reclamationsCount' => $reclamationsCount]);
    }
    public function getReclamationsCount(Request $request)
    {
        $reclamationsCount = Reclamation::join('tracking_reclamations as tr', 'tr.idReclamation', '=', 'reclamations.id')
            ->where('tr.stratu', '!=', 'Valide')
            ->where('reclamations.idProfesseur', 1)
            ->count();

        return response()->json(['count' => $reclamationsCount]);
    }
    public function show(Request $request)
    {

        return view('Professeur.index');
    }
    

}
