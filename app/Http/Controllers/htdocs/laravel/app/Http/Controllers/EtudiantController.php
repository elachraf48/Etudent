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
use App\Models\Reclamation;
use App\Models\ParameterPage;
use App\Models\PreInscription;

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
        $lastdate = ParameterPage::where('NamePage','=', 'preinscription')->first();
        $maxIdSession = DB::table('calendrier_modules')
            ->where('AnneeUniversitaire', function ($query) {
                $query->select(DB::raw('MAX(AnneeUniversitaire)'))
                    ->from('calendrier_modules');
            })->max('idSESSION');
        $AnneeUniversitaire = (date('Y') - 1) . '-' . date('Y');
       
        $preInscriptions = DB::table('pre_inscriptions')
            ->join('etudiants', 'etudiants.id', '=', 'pre_inscriptions.idEtudiant')
            ->where('pre_inscriptions.idSession', $maxIdSession) 
            ->where('pre_inscriptions.AnneeUniversitaire', $AnneeUniversitaire) 
            ->where('etudiants.CodeApogee', $codeApogee) 
            ->select('pre_inscriptions.*')
            ->get();
        if($lastdate->Statu=='true' && count($preInscriptions)==0){
            return redirect()->route('index')->with('error', "عليك حجز مقعد في الامتحانات اولا<br>Vous devez d'abord réserver une place pour les examens");

        }
        $currentpage = ParameterPage::where('NamePage','=', 'calendrier')->first();
        if($currentpage->Statu=='false' || $currentpage->LastDate<date('Y-m-d')){
            return redirect()->route('index')->with('error', 'الصفحة غير متوفرة حاليا لمعرفة المزيد المرجو توجه لشؤون الطلبة<br> La page est actuellement indisponible. Pour en savoir plus, rendez-vous sur Affaires étudiantes');

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
            return view('etudiant.search', compact('student', 'groupedModules'));
        } else {
            return redirect()->route('index')->with('error', 'Aucun étudiant trouvé avec le Code Apogee fourni <br> لم يتم العثور على الطلاب مع هذا الرقم');
        }
    }
    public function Repense(Request $request)
    {
        $CodeApogee = $_GET['CodeApogee'];
        $maxIdSession = DB::table('calendrier_modules')
            ->where('AnneeUniversitaire', function ($query) {
                $query->select(DB::raw('MAX(AnneeUniversitaire)'))
                    ->from('calendrier_modules');
            })->max('idSESSION');
        $AnneeUniversitaire = (date('Y') - 1) . '-' . date('Y');
        $student = Etudiant::where('CodeApogee', $CodeApogee)->first();

        $results = Reclamation::select('f.NomFiliere','f.Parcours','p.Nom as Nomp','p.Prenom as Prenomp','m.Semester','m.NomModule', 'reclamations.Sujet', 'reclamations.observations', 'reclamations.idSESSION', 'reclamations.AnneeUniversitaire', 'tr.stratu', 'reclamations.created_at', 'tr.Repense', 'e.Nom', 'e.Prenom', 'e.CodeApogee', 'ie.NumeroExamen', 'ie.Lieu', 'g.nomGroupe')
            ->join('tracking_reclamations AS tr', 'tr.idReclamation', '=', 'reclamations.id')
            ->join('etudiants AS e', 'e.id', '=', 'reclamations.idEtudiant')
            ->join('info_exames AS ie', 'ie.id', '=', 'reclamations.idInfo_Exames')
            ->join('professeurs AS p', 'p.id', '=', 'reclamations.idProfesseur')
            ->join('groupes AS g', 'g.id', '=', 'ie.idGroupe')
            ->join('modules AS m', 'm.id', '=', 'reclamations.idModule')
            ->join('filieres AS f', 'f.id', '=', 'm.idFiliere')

            ->whereHas('etudiant', function ($query) use ($CodeApogee) {
                $query->where('CodeApogee', $CodeApogee);
            })
            ->where('tr.stratu', '=', 'valide')
            ->where('reclamations.idSESSION', $maxIdSession)
            ->where('reclamations.AnneeUniversitaire', $AnneeUniversitaire)
            ->get();

        return view('etudiant.Repense', compact('CodeApogee','student','results'));
    }
    public function getReclamationsCount($etudiantCodeApogee)
    {


        $sessionId = DB::table('calendrier_modules')
            ->where('AnneeUniversitaire', function ($query) {
                $query->select(DB::raw('MAX(AnneeUniversitaire)'))
                    ->from('calendrier_modules');
            })->max('idSESSION');
        $academicYear = (date('Y') - 1) . '-' . date('Y');
        $reclamationsCount = Reclamation::join('tracking_reclamations', 'tracking_reclamations.idReclamation', '=', 'reclamations.id')
            ->whereHas('etudiant', function ($query) use ($etudiantCodeApogee) {
                $query->where('CodeApogee', $etudiantCodeApogee);
            })
            ->where('tracking_reclamations.stratu', '=', 'valide')
            ->where('reclamations.idSESSION', $sessionId)
            ->where('reclamations.AnneeUniversitaire', $academicYear)
            ->count();

        return response()->json(['count' => $reclamationsCount]);
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
