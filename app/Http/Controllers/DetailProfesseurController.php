<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reclamation;
use Illuminate\Support\Facades\DB;

use App\Models\CalendrierSession;
use App\Models\TrackingReclamation;

class DetailProfesseurController extends Controller
{
    /**
     * Display a listing of the resource.lmowadef dyalna lah ynesro 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('dashboard');
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
        $sessions = CalendrierSession::all();
        // Retrieve unique values of AnneeUniversitaire
        $AnneeUniversitaire = Reclamation::distinct()->pluck('AnneeUniversitaire');
        $semester = DB::table('detail_professeurs as df')
            ->select('m.Semester')
            ->join('modules as m', 'm.id', '=', 'df.idModule')
            ->where('df.AnneeUniversitaire', function ($query) {
                $query->select(DB::raw('MAX(AnneeUniversitaire)'))
                    ->from('info_exames');
            })
            ->where('df.idProfesseur', 1)
            ->pluck('m.Semester')
            ->toArray();
                
        return view('Professeur.index', compact('sessions','AnneeUniversitaire','semester'));
    }
    
    public function reclamations($AnneeUniversitaire, $statu, $semester,$sessions)
    {
            
        $reclamations = DB::table('reclamations as r')
        ->select(
            'r.id',
            'r.Sujet',
            'r.observations',
            'r.idSESSION',
            'r.AnneeUniversitaire',
            'tr.stratu',
            'r.created_at',
            'tr.Repense',
            'm.NomModule',
            'm.Semester',
            'e.Nom',
            'e.Prenom',
            'e.CodeApogee',
            'ie.NumeroExamen',
            'ie.Lieu',
            'g.nomGroupe'
        )
        ->join('tracking_reclamations as tr', 'tr.idReclamation', '=', 'r.id')
        ->join('modules as m', 'm.id', '=', 'r.idModule')
        ->join('etudiants as e', 'e.id', '=', 'r.idEtudiant')
        ->join('info_exames as ie', 'ie.id', '=', 'r.idInfo_Exames')
        ->join('groupes as g', 'g.id', '=', 'ie.idGroupe')
        ->when($statu === 'nv', function ($query) {
            return $query->where('tr.stratu', 'NOT LIKE', 'Valide');
        }, function ($query) use ($statu) {
            return $query->where('tr.stratu', 'LIKE', $statu);
        })
        ->where('r.idProfesseur', 1)
        ->where('r.AnneeUniversitaire', 'LIKE', $AnneeUniversitaire)
        ->where('r.idSESSION', 'LIKE', $sessions)
        ->where('m.Semester', 'LIKE', $semester)

        ->get();
    
        
    
        // Return reclamations as JSON
        return response()->json(['reclamations' => $reclamations]);
    }
    public function saveResponse(Request $request)
{
    // Validate the request data if needed
    $request->validate([
        'reclamation_id' => 'required|integer',
        'response_text' => 'required|string',
    ]);

    // Save the response
    TrackingReclamation::create([
        'idReclamation' => $request->reclamation_id,
        'Repense' => $request->response_text,
    ]);

    // Return a success response (you can customize the response as needed)
    return response()->json(['success' => true]);
}
}
