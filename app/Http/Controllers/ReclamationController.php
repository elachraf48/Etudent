<?php
namespace App\Http\Controllers;



use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\InfoExame;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Module;
use App\Models\Groupe;
use App\Models\Professeur;
use App\Models\InsertBy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Support\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Dompdf\Dompdf;
use Dompdf\Options;

use Illuminate\Support\Facades\View;
use Mpdf\Mpdf;
use Spatie\Browsershot\Browsershot;

class ReclamationController extends Controller
{
    public function index()
    {



        $filieres = Filiere::where('CodeFiliere', 'LIKE', '%S1')->get(['id', 'NomFiliere', 'Parcours']);



        return view('reclamation.index', compact('filieres'));
        // Pass the data to the view

    }
    public function show(Request $request)
    {

        $AnneeUniversitaire = (date('Y') - 1) . '-' . date('Y');
        $codeApogee = $request->input('CodeApogee');
        $semester = $request->input('semester');
        $filiere = $request->input('filiere');
        $filieres = Filiere::where('id', $filiere)->get(['id', 'NomFiliere', 'Parcours']);
        $studentuniue = Etudiant::where('CodeApogee', $codeApogee)->get(['CodeApogee', 'Nom', 'Prenom']);
        $Modules = Module::where('idFiliere', $filiere)->get(['id', 'NomModule', 'CodeModule']);
        $Groups = Groupe::where('Semester', $semester)->where('AnneeUniversitaire', $AnneeUniversitaire)->get(['id', 'nomGroupe']);

        $validator = Validator::make(['CodeApogee' => $codeApogee], [
            'CodeApogee' => 'required|integer', // Add any additional validation rules
        ]);
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
            ->where('g.idSESSION', '=', DB::raw('(SELECT max(idSESSION) FROM detail_modules WHERE AnneeUniversitaire = (SELECT MAX(AnneeUniversitaire) FROM info_exames))'))
            ->where('dm.AnneeUniversitaire', '=', DB::raw('(SELECT MAX(AnneeUniversitaire) FROM info_exames)'))
            ->where('ie.AnneeUniversitaire', '=', DB::raw('(SELECT MAX(AnneeUniversitaire) FROM detail_modules)'))
            ->where('e.CodeApogee', '=', $codeApogee)
            ->where('f.id', '=', $filiere)

            ->get();

        if ($validator->fails()) {
            // Handle validation failure, e.g., return an error response
            return response()->json(['error' => $validator->errors()], 400);
        }


        return view('reclamation.next', compact('filieres', 'Modules', 'student', 'semester', 'Groups', 'studentuniue','codeApogee'));
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
    public function fetchProfesseur($modules)
    {
        // Fetch filieres based on the selected semester
        $professeurs = DB::table('professeurs as p')
            ->select('*')
            ->join('detail_professeurs as dp', 'p.id', '=', 'dp.idProfesseur')
            ->where('dp.idModule', $modules)
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
        $data = [
            'AnneeUniversitaire' => $AnneeUniversitaire,
            'codeApogee' => $codeApogee,
            'semester' => $semester,
            'filiere' => $filieres->NomFiliere, // Assuming 'NomFiliere' is the field name for the filiere name
            'Nom' => $Nom,
            'Prenom' => $Prenom,
            'idexam' => $idexam,
            'datenes' => $datenes,
            'module' => $modules->NomModule, // Assuming 'NomModule' is the field name for the module name
            'ndexamen' => $ndexamen,
            'lieu' => $lieu,
            'Group' => $Group,
            'professeur' => $professeurs->Nom . ' ' . $professeurs->Prenom, // Assuming 'Nom' and 'Prenom' are the field names for professor's name
            'reclamation' => $reclamation,
            'couse' => $couse,
            'code_tracking' => $code_tracking,
        ];
        $html = View::make('reclamation.showpdf', $data)->render();

        // Capture the HTML content as an image using html2canvas
        Browsershot::html($html)
            ->format('png')
            ->save(public_path('temp/image.png'));

        // Generate PDF using dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Get the PDF content
        $pdfContent = $dompdf->output();

        // Output the PDF (either to the browser or save to a file)
        return $pdfContent;
        return view('reclamation.showpdf', $data);

        return redirect()->route('showpdf', $data);
        $dompdf = new Dompdf();

        $data = (object)$data;

        $html = '<div class="container text-center">
        <div class="row">
            <div class="continue  bg-light">
                <div class="col-md-12 bg-light text-center">
                    <!-- Centered Section with Logo for Mobile -->
                    <div class="mx-auto w-25">
                        <img src="https://i.ibb.co/yy8S6Wn/code.png" class="img-fluid w-50" alt="Logo">
                    </div>
                </div>
                <!-- <h5 class="link-success p-2">طلب تصحيح خطأ مادي متعلق بنتائج الامتحانات</h5>-->
                <h5 class="link-danger p-2">Demande de correction de faute matérielle concernant les résultats des examens.</h5>

                <!-- <h5><span class="title">شكوى</span></h5>
                <h5><span class="title">Réclamation</span></h5> -->
            </div>
        </div>
    </div>';

        $html .= '<table border="1" style="width: 100%"> ';
        $html .= '<tr><th>Field</th><th>Value</th></tr>';
        $html .= "<tr><td>Annee Universitaire</td><td>$data->AnneeUniversitaire</td></tr>";
        $html .= "<tr><td>Code Apogee</td><td>$codeApogee</td></tr>";
        $html .= "<tr><td>Semester</td><td>$semester</td></tr>";
        $html .= "<tr><td>Filiere</td><td>$filieres->NomFiliere</td></tr>";
        $html .= "<tr><td>Nom</td><td>$Nom</td></tr>";
        $html .= "<tr><td>Prenom</td><td>$Prenom</td></tr>";
        if($datenes!=''){ $html .= "<tr><td>Date de Naissance</td><td>$datenes</td></tr>";}
        $html .= "<tr><td>Module</td><td>$modules->NomModule</td></tr>";
        $html .= "<tr><td>N d'examen</td><td>$ndexamen</td></tr>";
        $html .= "<tr><td>Lieu</td><td>$lieu</td></tr>";
        if($Group!=''){        $html .= "<tr><td>Groupe</td><td>$Group</td></tr>";}
        $html .= "<tr><td>Professeur</td><td>" . $professeurs->Nom . " " . $professeurs->Prenom . "</td></tr>";
        $html .= "<tr><td>Reclamation</td><td>$reclamation</td></tr>";
        $html .= "<tr><td>Observations</td><td>$couse</td></tr>";
        // $html .= "<tr><td>Code Tracking</td><td>$code_tracking</td></tr>";
        $html .= '</table>';
        

// Load the HTML into Dompdf
$dompdf->loadHtml($html);
        
        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
        
        // Render the HTML as PDF
        $dompdf->render();
        
        // Output the generated PDF to Browser
  
//insert  Student
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
                ['NumeroExamen' => $ndexamen, 'Semester' => $semester, 'AnneeUniversitaire' =>  $AnneeUniversitaire, 'idEtudiant' => $etudiantId,
                
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
            ]);}
        } 
        else {
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
                'Sujet' => $reclamation,
                'code_tracking' => $code_tracking,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } else {
            $reclamationsId=$existingRow->id;
            $code_tracking=$existingRow->code_tracking;
            return redirect()->route('reclamation.index')>with($dompdf->stream("document.pdf"))->with('error', 'Vous avez déjà déposé une réclamation <br>  لقد قمت بالفعل بتقديم شكوى مسبقا' );
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
        ]);}
        // return redirect()->route('reclamation.index')->with('success', 'Votre code de suivi ' . $code_tracking);
        $dompdf->stream("document.pdf");
         return redirect()->route('reclamation.index')->with('success', 'Une plainte a été soumise avec succès  <br>  تم تقديم شكوى بالنجاح' );

        return $this->index();
        // Add any necessary logic here
    }

    public function nextReclamationv2()
    {
        return $this->index();
    }
}
