<?php

namespace App\Http\Controllers;

use App\Models\reclamation;
use Illuminate\Support\Facades\DB;
use App\Models\TrackingReclamation;
use Illuminate\Http\Request;
use App\Models\CalendrierSession;
use App\Models\Professeur;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Validator;

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
        return view('admin.Reclamation', compact('sessions', 'AnneeUniversitaire'));
    }
    public function reclamation_edit()
    {
        $sessions = CalendrierSession::all();
        // Retrieve unique values of AnneeUniversitaire
        $AnneeUniversitaire = Reclamation::distinct()->pluck('AnneeUniversitaire');

        
        // //
        return view('admin.ReclamationEdit', compact('sessions', 'AnneeUniversitaire'));
    }
   
    public function indexProfesseur()
    {
        $sessions = CalendrierSession::all();
        // Retrieve unique values of AnneeUniversitaire
        $AnneeUniversitaire = Reclamation::distinct()->pluck('AnneeUniversitaire');

        return view('admin.Professeur', compact('sessions', 'AnneeUniversitaire'));
    }
    public function reclamations($AnneeUniversitaire, $module, $semester, $filiere, $professeur, $sessions, $stratu)
    {
        $reclamations = reclamation::select('tr.Repense', 'pr.Nom as prof_nom', 'pr.Prenom as prof_prenom', 'md.Semester', 'md.NomModule', 'ie.NumeroExamen', 'ie.Lieu', 'g.nomGroupe', 'et.CodeApogee', 'et.Nom', 'et.Prenom', 'reclamations.Sujet', 'reclamations.observations')
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
    public function professors_reclamations(Request $request)
    {
        
        $AnneeUniversitaire = $request->input('AnneeUniversitaire');
        $module = $request->input('module');
        $semester = $request->input('semester');
        $filiere = $request->input('filiere');
        $sessions = $request->input('sessions');
        $statu = $request->input('stratu');
        $professeur = $request->input('professeur');

        $query = Professeur::select(
            'professeurs.Nom',
            'professeurs.Prenom',
            'professeurs.Email',
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
        } else if ($statu == '%') {
            $query->havingRaw('total like "%"');
        } else {
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
    public function edit(Request $request)
    {
        $id = $request->input('id');
        $TrackingReclamation = TrackingReclamation::where('idReclamation',$id)->first();
        if($TrackingReclamation->stratu=="Encours"){
            $newstartu='Valide';
        }
        else if($TrackingReclamation->stratu=="Valide"){
            $newstartu='Encours';
        }

        TrackingReclamation::where('idReclamation', $id)
        ->update([
            'stratu' => $newstartu,
            'updated_at' => now() // Update updated_at timestamp
        ]);

        // Return updated data if necessary
        return response()->json(['success' => true]);
        
        
        
    
        


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


    public function checkConnection(Request $request)
    {
        $email = $request->input('Email');
        $password = $request->input('Password');
        $Message = $request->input('Message');
        $Subject = $request->input('Subject');
        $Names = $request->input('Name');
        $rowData = $request->input('RowData');

        // Initialize PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $email;
            $mail->Password = $password;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';

            // Sender
            $mail->setFrom($email, $Names);
            
            // Iterate through checked rows and send email for each
            
            // Assuming the email is in the first column of each row
            $recipientEmail = $rowData[4];
            // Assuming the name is in the second column of each row
            $fullname = $rowData[0];
            // Assuming the number of not valid reclamations is in the third column of each row
            $nbnotvalid = $rowData[1];
            $nbvalid = $rowData[2];
            $nbtotal = $rowData[3];

            // Content
            $Subject = preg_replace('/{nbnotvalid}/', $nbnotvalid, $Subject);
            $Subject = preg_replace('/{fullname}/', $fullname, $Subject);
            $Subject = preg_replace('/{nbvalid}/', $nbvalid, $Subject);
            $Subject = preg_replace('/{nbtotal}/', $nbtotal, $Subject);
            $Message = preg_replace('/{nbnotvalid}/', $nbnotvalid, $Message);
            $Message = preg_replace('/{fullname}/', $fullname, $Message);
            $Message = preg_replace('/{nbvalid}/', $nbvalid, $Message);
            $Message = preg_replace('/{nbtotal}/', $nbtotal, $Message);

            $mail->isHTML(true);
            $mail->Subject = $Subject; // Update subject line with full name
            $mail->Body = $Message;

            // Recipient
            // $mail->addAddress($recipientEmail);
            $mail->addAddress('achraf.abwi@gmail.com');


            // Send the email
            $mail->send();

            // Clear all recipients for the next email
            $mail->clearAddresses();
                
            

            return response()->json(['message' => 'Connection to Gmail SMTP server is successful'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Connection to Gmail SMTP server failed for email:  Error: ' . $mail->ErrorInfo], 500);
        }
    }
}
