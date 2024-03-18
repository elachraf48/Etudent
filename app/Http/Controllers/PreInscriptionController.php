<?php

namespace App\Http\Controllers;

use App\Models\PreInscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Etudiant;
use App\Models\ParameterPage;

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

        $studentunique = Etudiant::where('CodeApogee', $codeApogee)->first();
        $lastdate = ParameterPage::where('NamePage','=', 'preinscription')->first();
        if($lastdate->Statu=='false' || $lastdate->LastDate<date('Y-m-d')){
            return redirect()->route('index')->with('error', 'الصفحة غير متوفرة حاليا لمعرفة المزيد المرجو توجه لشؤون الطلبة<br> La page est actuellement indisponible. Pour en savoir plus, rendez-vous sur Affaires étudiantes');

        }

        $student  = DB::table('etudiants as e')
            ->select(
               
                'f.NomFiliere as NomFiliere',
                'f.Parcours as Parcours',
                'ie.AnneeUniversitaire as ExamenAnneeUniversitaire',
                'ie.Semester as ExamenSemester',
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
            ->groupBy('ExamenSemester', 'NomFiliere', 'Parcours', 'ExamenAnneeUniversitaire')
            ->get();



        $groupedModules = $student->groupBy('ExamenSemester');

        if ($student && count($groupedModules) > 0) {
            return view('etudiant.preinscription', compact('student', 'groupedModules','studentunique','lastdate'));
        } else {
            return redirect()->route('index')->with('error', 'Aucun étudiant trouvé avec le Code Apogee fourni <br> لم يتم العثور على الطلاب مع هذا الرقم');
        }
    }

    public function getCreationDate($id)
    {
        $maxIdSession = DB::table('calendrier_modules')
            ->where('AnneeUniversitaire', function ($query) {
                $query->select(DB::raw('MAX(AnneeUniversitaire)'))
                    ->from('calendrier_modules');
            })->max('idSESSION');
        $AnneeUniversitaire = (date('Y') - 1) . '-' . date('Y');
        $preinscription = DB::table('pre_inscriptions')
            ->select('created_at')
            ->where('idEtudiant', $id) // Replace $idEtudiant with the actual student's idEtudiant
            ->where('idSession', $maxIdSession)   // Replace $idSession with the actual session ID
            ->where('AnneeUniversitaire', $AnneeUniversitaire) // Replace $AnneeUniversitaire with the actual year range
            ->first();
        if (!$preinscription) {
            return response()->json(['error' => 'Student not found'], 404);
        }
        $createdAt = $preinscription->created_at; // Adjust format as needed
        return response()->json(['creationDate' => $createdAt]);
        
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
    public function create(Request $request)
    {
       
        $idEtudiant = $request->input('id');
        $CodeApogee = Etudiant::where('id', $idEtudiant)->value('codeApogee');
        $maxIdSession = DB::table('calendrier_modules')
            ->where('AnneeUniversitaire', function ($query) {
                $query->select(DB::raw('MAX(AnneeUniversitaire)'))
                    ->from('calendrier_modules');
            })->max('idSESSION');
        $AnneeUniversitaire = (date('Y') - 1) . '-' . date('Y');
        
        PreInscription::create([
            'idEtudiant' => $idEtudiant,
            'idSession' => $maxIdSession,
            'AnneeUniversitaire' =>  $AnneeUniversitaire,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Return a response indicating success
        return redirect()->route('preinscription.form', ['CodeApogee' => $CodeApogee])->with('success', 'Data inserted successfully!');

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
