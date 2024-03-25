<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\InfoExame;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Module;
use App\Models\Groupe;
use App\Models\Professeur;
use App\Models\Reclamation;
use App\Models\InsertBy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Support\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Dompdf\Dompdf;
use Dompdf\Options;
use Barryvdh\Snappy\Facades\SnappyImage;
use Barryvdh\Snappy\Facades\SnappyPdf;
use PDF;
use AlSelwi\ArabicHTML\Facades\ArabicHTML;
use App\Models\ParameterPage;
use App\Models\PreInscription;
use Illuminate\Support\Facades\View;
use Mpdf\Mpdf;
use Spatie\Browsershot\Browsershot;

use function PHPUnit\Framework\isNull;
use Intervention\Image\Facades\Image;

class ReclamationController extends Controller
{
    public function index()
    {
        



        $filieres = Filiere::where('CodeFiliere', 'LIKE', '%S1')->get(['id', 'NomFiliere', 'Parcours']);



        return view('reclamation.index', compact('filieres'));
        // Pass the data to the view

    }



    public function convertHtmlToPdf(Request $request, $reclamationId)
    {
        $reclamationId = $request->validate(['reclamationId' => 'required|integer']);

        $reclamationId = $request->input('reclamationId');

        // Retrieve data for the reclamation
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
            ->where('reclamations.id', '=', $reclamationId)
            ->firstOrFail();
        $view = View::make('reclamation.showpdf', compact('result'));
        $htmlContent = $view->render();


        $html = view('reclamation.showpdf', ['result' => $result])->render();
        $pdf = SnappyPDF::loadHtml($html);
        $pdf->setPaper('A4');
        $pdf->setOption('margin-top', '0');
        $pdf->setOption('margin-right', '0');
        $pdf->setOption('margin-bottom', '0');
        $pdf->setOption('margin-left', '0');
        $pdfContent = $pdf->output();

        // Render HTML content
        $htmlContent = view('reclamation.showpdf', compact('result'))->render();

        // Save HTML to image
        $imagePath = public_path('temp/image.png');
        SnappyImage::loadHTML($htmlContent)->save($imagePath);

        // Convert image to PDF
        $pdfPath = public_path('temp/pdf.pdf');
        SnappyPdf::loadImage($imagePath)->save($pdfPath);

        // Optionally, you may delete the image after PDF conversion
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        return 'PDF saved successfully!';
    }

    public function last($reclamationId)
    {
        $result = Reclamation::select(
            'reclamations.AnneeUniversitaire',
            'reclamations.created_at',
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
            ->where('reclamations.id', '=', $reclamationId)
            ->first();



        return view('reclamation.last', compact('result'));
        // Pass the data to the view

    }
    public function show(Request $request)
    {
        $maxIdSession = DB::table('calendrier_modules')
            ->where('AnneeUniversitaire', function ($query) {
                $query->select(DB::raw('MAX(AnneeUniversitaire)'))
                    ->from('calendrier_modules');
            })->max('idSESSION');
        $AnneeUniversitaire = (date('Y') - 1) . '-' . date('Y');
        $codeApogee = $request->input('CodeApogee');
        $semester = $request->input('semester');
        $filiere = $request->input('filiere');
        $filieres = Filiere::where('id', $filiere)->get(['id', 'NomFiliere', 'Parcours']);
        $studentuniue = Etudiant::where('CodeApogee', $codeApogee)->get(['CodeApogee', 'Nom', 'Prenom']);
        $threeDaysAgo = Carbon::now()->subDays(3);

        $affectedRows = Module::where('idFiliere', $filiere)
            ->where('statu', '=', 'Y')
            ->whereDate('updated_at', '<=', $threeDaysAgo)
            ->update(['statu' => 'N','updated_at'=> now()]);
        $Modules = Module::where('idFiliere', $filiere)->where('statu', '=', 'Y')->get(['id', 'NomModule', 'CodeModule']);
        // update statu module to N
       
        $Groups = Groupe::where('Semester', $semester)->where('AnneeUniversitaire', $AnneeUniversitaire)
            ->where('idSESSION', $maxIdSession)->get(['id', 'nomGroupe']);

        $validator = Validator::make(['CodeApogee' => $codeApogee], [
            'CodeApogee' => 'required|integer', // Add any additional validation rules
        ]);
       //verf page
       $lastdate = ParameterPage::where('NamePage','=', 'preinscription')->first();

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
        $currentpage = ParameterPage::where('NamePage','=', 'reclamations')->first();
        if($currentpage->Statu=='false' || $currentpage->LastDate<date('Y-m-d')){
            return redirect()->route('reclamation.index')->with('error', 'الصفحة غير متوفرة حاليا لمعرفة المزيد المرجو توجه لشؤون الطلبة<br> La page est actuellement indisponible. Pour en savoir plus, rendez-vous sur Affaires étudiantes');

        }
        // Example query to get data
        // $etudiants = Etudiant::where('CodeApogee', $codeApogee)->first();
        $student  = DB::table('Etudiants as e')
            ->select(
                'e.CodeApogee as CodeApogee',
                'e.Nom as Nom',
                'e.Prenom as Prenom',
                'f.NomFiliere as NomFiliere',
                'f.Parcours as Parcours',
                'm.NomModule as NomModule',
                'm.id as idModule',
                'g.nomGroupe as NomGroupe',
                'ie.Lieu as Lieu',
                'ie.id as idexam',
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
            ->where('f.id', '=', $filiere)
            ->where('m.statu', '=', 'Y')
            ->get();
        if(count($Modules)<=0 || count($student)<=0){
            return redirect()->route('reclamation.index')->with('error', "لا توجد وحدات متاحة حاليا في هذا الفصل الدراسي<br> Il n'y a aucun module disponible actuellement dans ce semestre");

        }
        if ($validator->fails()) {
            // Handle validation failure, e.g., return an error response
            return response()->json(['error' => $validator->errors()], 400);
        }


        return view('reclamation.next', compact('filieres', 'Modules', 'student', 'semester', 'Groups', 'studentuniue', 'codeApogee'));
    }

    public function fetchFilieresBySemester($semester)
    {
        // Fetch filieres based on the selected semester
        $filieres = Filiere::where('CodeFiliere', 'LIKE', '%' . $semester)->get(['id', 'NomFiliere', 'Parcours']);

        // Check if filieres are empty
        if ($filieres->isEmpty()) {
            return response()->json(['message' => 'No filieres found for the selected semester'], 404);
        }

        // Return filieres as JSON
        return response()->json(['filieres' => $filieres]);
    }
    public function fetchProfesseur($modules,$idGroupe)
    {
        // Fetch filieres based on the selected semester
        $professeurs = DB::table('professeurs as p')
            ->select('*')
            ->join('detail_professeurs as dp', 'p.id', '=', 'dp.idProfesseur')
            ->where('dp.idModule', $modules)
            ->where('dp.idGroupe', $idGroupe)

            ->get();

        // Check if filieres are empty
        if ($professeurs->isEmpty()) {
            return response()->json(['message' => 'No professeurs found for the selected module'], 404);
        }

        // Return filieres as JSON
        return response()->json(['professeurs' => $professeurs]);
    }
    public function fetchModules($filiere)
    {
        // Fetch modules based on the selected semester and filiere
        $modules = Module::where('idFiliere', $filiere)->get(['id', 'NomModule', 'CodeModule']);

        // Check if modules are empty
        if ($modules->isEmpty()) {
            return response()->json(['message' => 'No modules found for the selected semester and filiere'], 404);
        }

        // Return modules as JSON
        return response()->json(['modules' => $modules]);
    }
    // ReclamationController.php
    public function reclamationpost(Request $request)
    {
        $AnneeUniversitaire = (date('Y') - 1) . '-' . date('Y');
        $codeApogee = $request->input('napogee');
        $semester = $request->input('semester');
        $filiere = $request->input('filiere');
        $Nom = $request->input('nom');
        $Prenom = $request->input('prenom');
        $idexam = $request->input('idexam');
        $datenes = $request->input('datenes');
        $module = $request->input('module');
        $ndexamen = $request->input('ndexamen');
        $lieu = $request->input('lieu');
        $Group = $request->input('Group');
        $professeur = $request->input('professeur');
        $reclamation = $request->input('reclamation');
        $couse = $request->input('couse');
        $code_tracking = rand(pow(10, 9), pow(10, 10) - 1);
        $filieres = Filiere::where('id', $filiere)->get(['id', 'NomFiliere', 'Parcours'])->first();
        $professeurs = professeur::where('id', $professeur)->get(['id', 'Nom', 'Prenom'])->first();
        $modules = module::where('id', $module)->get(['id', 'NomModule'])->first();

        $existingStudent = DB::table('etudiants')
            ->where('CodeApogee', $codeApogee)
            ->first();

        if ($existingStudent) {
            // If student exists, get the existing student's ID
            $etudiantId = $existingStudent->id;
        } else {

            // If student doesn't exist, insert into Etudiants table and get the new student's ID
            $etudiantId = DB::table('etudiants')->insertGetId([
                'CodeApogee' => $codeApogee,
                'Nom' => $Nom,
                'Prenom' => $Prenom,
                'DateNaiss' => $datenes,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            InsertBy::create([
                'NameTable' => 'etudiants',
                'idTable' => $etudiantId,
                'insertBy' => 'etudiant',
            ]);
        }
        $maxIdSession = DB::table('calendrier_modules')
            ->where('AnneeUniversitaire', function ($query) {
                $query->select(DB::raw('MAX(AnneeUniversitaire)'))
                    ->from('calendrier_modules');
            })
            ->max('idSESSION');

            if ($Group == null) {
                $Group = '0';
            }

            $existingGroup = DB::table('groupes')
                ->where('nomGroupe', $Group)
                ->where('Semester', $semester)
                ->where('idSESSION', $maxIdSession)
                ->where('AnneeUniversitaire', $AnneeUniversitaire)
                ->first();

            if ($existingGroup) {
                // Group already exists, no need to insert again
                $groupeId = $existingGroup->id;
            } 
            else {
                // Insert into the groupes table if it doesn't exist and get the ID
                $groupeId = DB::table('groupes')->insertGetId([
                    'nomGroupe' => $Group,
                    'Semester' => $semester,
                    'idSESSION' => $maxIdSession,
                    'AnneeUniversitaire' => $AnneeUniversitaire,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }


            // Insert into Groupe_etudiant table
            DB::table('groupe_etudiant')->updateOrInsert([
                'idEtudiant' => $etudiantId,
                'idGroupe' => $groupeId

            ]);
        
       
        if ($idexam == '') {
            $existingidexam = DB::table('info_exames')
                ->where('NumeroExamen', $ndexamen)
                ->where('Semester', $semester)
                ->where('idEtudiant', $etudiantId)
                ->where('Lieu', $lieu)
                ->where('AnneeUniversitaire', $AnneeUniversitaire)
                ->first();
            if ($existingidexam) {
                // If student exists, get the existing student's ID
                $idexams = $existingidexam->id;
            } else {
                // Insert into Info_Exames table
                $idexam = DB::table('info_exames')->insertGetId(
                    [
                        'NumeroExamen' => $ndexamen, 'Semester' => $semester, 'AnneeUniversitaire' =>  $AnneeUniversitaire, 'idEtudiant' => $etudiantId,
                        'idGroupe' => $groupeId,
                        'Lieu' => $lieu,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                );
                $idexams = $idexam;
                InsertBy::create([
                    'NameTable' => 'info_exames',
                    'idTable' => $idexam,
                    'insertBy' => 'etudiant',
                ]);
            }
        } else {
            $idexams = $idexam;
        }

        $existingRow = DB::table('reclamations')
            ->where('idEtudiant', $etudiantId)
            ->where('idProfesseur', $professeur)
            ->where('idModule', $module)
            ->where('idInfo_Exames', $idexams)
            ->where('AnneeUniversitaire', $AnneeUniversitaire)
            ->first();

        // Insert the row only if a similar row does not exist
        if (!$existingRow) {
            $reclamationsId = DB::table('reclamations')->insertGetId([
                'idEtudiant' => $etudiantId,
                'idProfesseur' => $professeur,
                'idModule' => $module,
                'idInfo_Exames' => $idexams,
                'AnneeUniversitaire' => $AnneeUniversitaire,
                'observations' => $couse,
                'idSESSION' => $maxIdSession,
                'Sujet' => $reclamation,
                'code_tracking' => $code_tracking,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } else {
            $reclamationsId = $existingRow->id;
            $code_tracking = $existingRow->code_tracking;
            return redirect()->route('reclamationlast', ['reclamationId' => $reclamationsId])->with('error', 'Vous avez déjà déposé une réclamation <br>  لقد قمت بالفعل بتقديم شكوى مسبقا');
            // Handle the case where a similar row already exists
            // You can log an error, throw an exception, or handle it in any other appropriate way
        }

        $existingtracking_reclamations = DB::table('tracking_reclamations')
            ->where('idReclamation', $reclamationsId)
            ->where('idProfesseur', $professeur)
            ->first();
        if (!$existingtracking_reclamations) {
            DB::table('tracking_reclamations')->insertGetId([
                'idReclamation' => $reclamationsId,
                'idProfesseur' => $professeur,
                'stratu' => 'Encours',
                'Repense' => '',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        // return redirect()->route('reclamation.index')->with('success', 'Votre code de suivi ' . $code_tracking);
        // $dompdf->stream("document.pdf");
        return redirect()->route('reclamationlast', ['reclamationId' => $reclamationsId])->with('success', 'Une plainte a été soumise avec succès  <br>  تم تقديم شكوى بالنجاح');

        return $this->index();
        // Add any necessary logic here
    }

    public function nextReclamationv2()
    {
        return $this->index();
    }
}
