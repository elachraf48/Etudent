<?php

namespace App\Http\Controllers;
use App\Models\CalendrierSession;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Models\DetailModule;
use App\Models\Filiere;

use Illuminate\Http\Request;

class DetailModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $semester = $request->input('semester', 's1');
        $filieres = Filiere::where('CodeFiliere', 'LIKE', '%' . $semester)->get(['id', 'NomFiliere', 'Parcours']);
        $sessions = CalendrierSession::all();
        return view('admin.detail_modules', compact('sessions','filieres'));
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
    public function setSemester(Request $request): JsonResponse
    {
        $semester = $request->request->get('semester');

        // Set the session variable
        $request->getSession()->set('semester', $semester);

        return new JsonResponse(['success' => true]);
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
            'detail_modules_data' => 'required_without:file',
            'file' => 'required_without:detail_modules_data|file|mimes:csv,txt|max:2048',
        ]);
        $table = $request->input('tab');

        $sessions = $request->input('sessions');
        $anneeUniversitaire = $request->input('AnneeUniversitaire');
        $semester = $request->input('semester');
        $message='null';
        if ($semester == 'S1' || $semester == 'S2') {
            $message= '7 modules please';
        } else if ($semester == 'S3' || $semester == 'S4'|| $semester == 'S5' || $semester == 'S6') {
            $message='6 modules please';
        }
        
        // Check the value of the switch
        $useFile = $request->has('method_switch');

        if ($useFile) {
            // File handling logic
            $fileContent = file_get_contents($request->file('file')->path());
            $rows = explode("\n", $fileContent);
       
        } else {
            // Textarea handling logic
            $studentData = $request->input('detail_modules_data');
            $rows = explode("\n", $studentData);
        }

        return redirect()->route('detail_modules_form')->with('success', 'Data inserted successfully!' . $table);

    }
    public function showInsertDetailModules()
    {
        $sessions = CalendrierSession::all();
        return view('admin.detail_modules', compact('sessions'));
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
