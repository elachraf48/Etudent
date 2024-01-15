<?php

namespace App\Http\Controllers;
use App\Models\CalendrierSession;

use App\Models\DetailModule;
use Illuminate\Http\Request;

class DetailModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = CalendrierSession::all();
        return view('admin.detail_modules', compact('sessions'));
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
     * @param  \App\Models\DetailModule  $detailModule
     * @return \Illuminate\Http\Response
     */
    public function show(DetailModule $detailModule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetailModule  $detailModule
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailModule $detailModule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetailModule  $detailModule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetailModule $detailModule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailModule  $detailModule
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailModule $detailModule)
    {
        //
    }
    
    
    public function processDetailModulesData(Request $request)
    {
        $request->validate([
            'student_data' => 'required_without:file',
            'file' => 'required_without:student_data|file|mimes:csv,txt|max:2048',
        ]);
        $sessions = $request->input('sessions');
        $anneeUniversitaire = $request->input('AnneeUniversitaire');

        // Check the value of the switch
        $useFile = $request->has('method_switch');

        if ($useFile) {
            // File handling logic
            $fileContent = file_get_contents($request->file('file')->path());
            $rows = explode("\n", $fileContent);
        } else {
            // Textarea handling logic
            $studentData = $request->input('student_data');
            $rows = explode("\n", $studentData);
        }

        return redirect()->route('showInsertDetailModules')->with('success', 'Data inserted successfully!');

    }
    public function showInsertDetailModules()
    {
        $sessions = CalendrierSession::all();
        return view('admin.detail_modules', compact('sessions'));
    }

}
