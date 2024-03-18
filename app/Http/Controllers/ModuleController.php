<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Models\CalendrierSession;
use App\Models\Reclamation;
use Carbon\Carbon;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parameters = Module::with('filiere')->get();
        $sessions = CalendrierSession::all();
        // Retrieve unique values of AnneeUniversitaire
        $AnneeUniversitaire = Reclamation::distinct()->pluck('AnneeUniversitaire');
        return view('admin.ReclamationModule', compact('sessions', 'AnneeUniversitaire','parameters'));
    }
    public function updateModules( $semester, $filiere,$stratu)
    {
        //
        $modules= Module::with('filiere')
            ->where('idFiliere', 'like', $filiere)
            ->where('Semester', 'like', $semester)
            ->where('statu', 'like', $stratu)    
        ->get();
       
        return response()->json(['modules' => $modules]);

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
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        //

        $id = $request->input('id');
        $Module = Module::where('id', $id)->first();
        if($Module->statu=='N'){
            $statu='Y';
        }
        else{
            $statu='N';
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        //
    }
}
