<?php

namespace App\Http\Controllers;

use App\Models\CalendrierSession;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Facades\DB;

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
        return view('admin.detail_modules', compact('sessions', 'filieres'));
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
            'id_module' => 'required_without:file',
            'file' => 'required_without:detail_modules_data|file|mimes:csv,txt|max:2048',
        ]);
        $data = $request->input('id_module');
        $stockNumbers = $request->input('id_module'); // Assuming 'stock_numbers' is the name of the input field

        if (!empty($stockNumbers)) {
            $dataArray = explode(',', $stockNumbers);
            $dataLength = count($dataArray);

            // Now $dataLength contains the number of stock numbers
            // You can use $dataArray to access each individual stock number
            // For example, $dataArray[0] is the first stock number, $dataArray[1] is the second, and so on
        } else {
            // Handle the case where no stock numbers are provided
            $dataLength = 0;
        }
        $sessions = $request->input('sessions');
        $anneeUniversitaire = $request->input('AnneeUniversitaire');
        $semester = $request->input('semester');
        // if ($semester == 'S1' || $semester == 'S2') {
        //     $message= '7 modules please';
        // } else if ($semester == 'S3' || $semester == 'S4'|| $semester == 'S5' || $semester == 'S6') {
        //     $message='6 modules please';
        // }
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
        foreach ($rows as $row) {
            $columns = str_getcsv($row);
            $existingStudent = DB::table('etudiants')
                ->where('CodeApogee', $columns[0])
                ->first();

            if ($existingStudent) {
                // If student exists, get the existing student's ID
                $etudiantId = $existingStudent->id;
                $i = 1;
                $dataArrays = explode(',', $stockNumbers);
                foreach ($dataArrays as $dataArray) {
                    $detailModule = DetailModule::firstOrNew([
                        'idEtudiant' => $etudiantId,
                        'idModule' => $dataArray,
                        'AnneeUniversitaire' => $anneeUniversitaire,
                        'idSESSION' => $sessions,
                    ]);
                    
                    // If the record doesn't exist, set the other fields and save it
                    if (!$detailModule->exists) {
                        $detailModule->etat = $columns[$i];
                        $detailModule->created_at = now();
                        $detailModule->updated_at = now();
                        $detailModule->save();
                    }

                    $i += 1;
                }
            } else {
                // If student doesn't exist, insert into Etudiants table and get the new student's ID
                return redirect()->route('detail_modules_form')->with('error', 'Etudent not found for the specified conditions' . $columns[0]);
            }
        }
        return redirect()->route('detail_modules_form')->with('success', 'Data inserted successfully!');
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
