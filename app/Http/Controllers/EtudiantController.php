<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\DetailModule;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        $etudiant = Etudiant::with(['filieres.modules.calendrierModules.session', 'examens', 'groupes'])
            ->where('CodeApogee', $codeApogee)
            ->first();
            if ($etudiant) {
                return view('etudiant.search', compact('etudiant'));
            } else {
                return redirect()->route('index')->with('error', 'Aucun étudiant trouvé avec le Code Apogee fourni.');
            }
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
