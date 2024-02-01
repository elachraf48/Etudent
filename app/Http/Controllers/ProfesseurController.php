<?php

namespace App\Http\Controllers;
use App\Models\Filiere;

use Illuminate\Http\Request;

class ProfesseurController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filieres = Filiere::where('CodeFiliere', 'LIKE', '%S1' )->get(['id', 'NomFiliere', 'Parcours']);
        return view('admin.bulk_professeurs', compact('filieres'));
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
     * @param  \App\Models\Professeur  $Professeur
     * @return \Illuminate\Http\Response
     */
    public function show(ProfesseurController $Professeur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Professeur  $Professeur
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfesseurController $Professeur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Professeur  $Professeur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfesseurController $Professeur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Professeur  $Professeur
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfesseurController $Professeur)
    {
        //
    }
}
