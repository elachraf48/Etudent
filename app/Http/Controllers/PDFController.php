<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function showPDF(Request $request)
    {
        // Retrieve data from the request
        
        $data = [
            'AnneeUniversitaire' => $request->AnneeUniversitaire,
            'codeApogee' => $request->codeApogee,
            'semester' => $request->semester,
            'filiere' => $request->filieres->NomFiliere, // Assuming 'NomFiliere' is the field name for the filiere name
            'Nom' => $request->Nom,
            'Prenom' => $request->Prenom,
            'idexam' => $request->idexam,
            'datenes' => $request->datenes,
            'module' => $request->modules->NomModule, // Assuming 'NomModule' is the field name for the module name
            'ndexamen' => $request->ndexamen,
            'lieu' => $request->lieu,
            'Group' => $request->Group,
            'professeur' => $request->professeurs->Nom . ' ' . $request->professeurs->Prenom,
            'reclamation' => $request->reclamation,
            'couse' => $request->couse,
            'code_tracking' => $request->code_tracking,
        ];

        // Pass the data to the view
        return view('pdf.showpdf', $data);
    }
}
