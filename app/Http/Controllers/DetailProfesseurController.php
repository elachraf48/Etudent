<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reclamation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\CalendrierSession;
use App\Models\TrackingReclamation;
use App\Models\Professeur;
use App\Models\Module;
use Illuminate\Support\Facades\Storage;

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
        $idproof =  Professeur::where('user_id', Auth::id())->pluck('id')->first();
        $reclamationsCount = Reclamation::join('tracking_reclamations as tr', 'tr.idReclamation', '=', 'reclamations.id')
            ->where('tr.stratu', '!=', 'Valide')
            ->where('reclamations.idProfesseur', $idproof)
            ->count();

        return response()->json(['count' => $reclamationsCount]);
    }
    public function show(Request $request)
    {
        $idproof =  Professeur::where('user_id', Auth::id())->pluck('id')->first();

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
            ->where('df.idProfesseur', $idproof)
            ->pluck('m.Semester')
            ->toArray();

        return view('Professeur.index', compact('sessions', 'AnneeUniversitaire', 'semester'));
    }
    public function activation()
    {
        $idproof =  Professeur::where('user_id', Auth::id())->pluck('id')->first();
        $AnneeUniversitaire = (date('Y') - 1) . '-' . date('Y');

        $moduleIds = DB::table('detail_professeurs')
            ->where('idProfesseur', $idproof)
            ->where('AnneeUniversitaire', $AnneeUniversitaire)

            ->pluck('idModule');

        $parameters = Module::whereIn('id', $moduleIds)
            ->with(['filiere', 'DetailProfesseur'])
            ->get();
      

        // Retrieve unique values of AnneeUniversitaire
        return view('Professeur.activation', compact('parameters'));
    }
    public function update(Request $request, Module $module)
    {
        //

        $id = $request->input('id');
        $Module = Module::where('id', $id)->first();
        if ($Module->statu == 'N') {
            $statu = 'Y';
        } else {
            $statu = 'N';
        }
        $affectedRows = Module::where('id', $id)->update([
            'Statu' => $statu,
            'updated_at' => now(),

        ]);
        if ($affectedRows === 1) {
            // Return a success response
            return response()->json(['success' => true]);
        } else {
            // Return an error response if the record was not updated
            return response()->json(['success' => false, 'error' => 'Record not found or no changes were made.']);
        }
    }
    public function detailsReclamation($idreq)
    {
        $reclamationData =  DB::table('reclamations as r')
            ->select(
                'r.id',
                'r.Sujet',
                'r.observations',
                'r.idSESSION',
                'r.AnneeUniversitaire',
                'tr.stratu',
                'tr.Repense',
                'tr.file_path',
                'tr.file_type',
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
            ->join('tracking_reclamations AS tr', 'tr.idReclamation', '=', 'r.id')
            ->join('modules AS m', 'm.id', '=', 'r.idModule')
            ->join('etudiants AS e', 'e.id', '=', 'r.idEtudiant')
            ->join('info_exames AS ie', 'ie.id', '=', 'r.idInfo_Exames')
            ->join('groupes AS g', 'g.id', '=', 'ie.idGroupe')
            ->where('r.id', $idreq)
            ->first();

        return response()->json(['reclamationData' => $reclamationData]);
    }
    public function reclamations($AnneeUniversitaire, $statu, $semester, $sessions)
    {

        if (Auth::user()->role == '0') {
            $idproof = '%';
        } else {
            $idproof =  Professeur::where('user_id', Auth::id())->pluck('id')->first();
        }
        $reclamations = DB::table('reclamations as r')
            ->select(
                'r.id',
                'tr.stratu',
                'r.created_at',
                'm.NomModule',
                'e.Nom',
                'e.Prenom',
                'e.CodeApogee',
                'p.Prenom as pPrenom',
                'p.Nom as pNom',
                'm.Semester'

            )
            ->join('tracking_reclamations as tr', 'tr.idReclamation', '=', 'r.id')
            ->join('professeurs as p', 'r.idProfesseur', '=', 'p.id')

            ->join('modules as m', 'm.id', '=', 'r.idModule')
            ->join('etudiants as e', 'e.id', '=', 'r.idEtudiant')
            ->when($statu === 'nv', function ($query) {
                return $query->where('tr.stratu', 'NOT LIKE', 'Valide');
            }, function ($query) use ($statu) {
                return $query->where('tr.stratu', 'LIKE', $statu);
            })
            ->where('r.idProfesseur', 'LIKE', $idproof)
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


public function updateTrackingReclamations(Request $request)
{
    // Validate request data if necessary
    $request->validate([
        'file' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048', // Adjust max file size as needed
    ]);
    $reclamationId = $request->input('reclamation_id');
    $reponse = $request->input('reponse');
    $file = $request->file('file'); // Get the uploaded file from the request

    // Store the file if it's provided
    if ($file) {
        // Determine the file name and path
        
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Store the file in the storage directory
        $file->storeAs('public/uploads', $fileName);
        // Update tracking reclamations table with file information
        TrackingReclamation::where('idReclamation', $reclamationId)
            ->update([
                'Repense' => $reponse,
                'stratu' => 'Valide',
                'file_path' => $fileName, // Store the file path
                'file_type' => $file->getMimeType(), // Store the file MIME type
                'updated_at' => now() // Update updated_at timestamp
            ]);
    } else {
        // Update tracking reclamations table without file information
        TrackingReclamation::where('idReclamation', $reclamationId)
            ->update([
                'Repense' => $reponse,
                'stratu' => 'Valide',
                'updated_at' => now() // Update updated_at timestamp
            ]);
    }

    // Return response as necessary
    return response()->json(['success' => true]);
}

}
