<?php

namespace App\Http\Controllers;

use App\Models\CalendrierModule;
use App\Models\Filiere;

use Illuminate\Http\Request;

class CalendrierModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * @param  \App\Models\CalendrierModule  $calendrierModule
     * @return \Illuminate\Http\Response
     */
    public function show(CalendrierModule $calendrierModule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CalendrierModule  $calendrierModule
     * @return \Illuminate\Http\Response
     */
    public function edit(CalendrierModule $calendrierModule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CalendrierModule  $calendrierModule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalendrierModule $calendrierModule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CalendrierModule  $calendrierModule
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalendrierModule $calendrierModule)
    {
        //
    }

    //-------------------------------------------------------------
    public function showCalendriermodules(Request $request)
    {
        // Fetch filieres and parcours to pass to the view

        $semester = $request->input('semester','s1');

        $filieres = Filiere::where('CodeFiliere', 'LIKE', '%'.$semester)->get(['id', 'NomFiliere', 'Parcours']);

        return view('admin.Calendrier_modules', compact('filieres'));
    }

    /**
     * Process the bulk insert of Calendrier Modules Data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function processBulkInsert(Request $request)
    {
        // Your processing logic here

        // For example, you can access form data like this:
        $semester = $request->input('semester');
        $filiere = $request->input('filiere');
        $parcours = $request->input('parcours');
        $examData = $request->input('exam_data');

        // ... your processing logic ...

        // Redirect or return a response
        return redirect()->route('Calendrier_modules_form')->with('success', 'Data inserted successfully');
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

    
    
    


}
