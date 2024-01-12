<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('etudient');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\FiliereController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\EtudiantFiliereController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\DetailModuleController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\GroupeEtudiantController;
use App\Http\Controllers\InfoExameController;
use App\Http\Controllers\CalendrierModuleController;
use App\Http\Controllers\CalendrierModuleGroupeController;
use App\Http\Controllers\AdminController;
// Routes for Filiere
Route::resource('filieres', FiliereController::class);

// Routes for Etudiant
Route::resource('/', EtudiantController::class);
Route::get('/etudiant/search', [EtudiantController::class, 'search'])->name('search');
// routes/web.php

// Define the resource routes
Route::resource('/reqlamation', InfoExameController::class);

// Add a custom route for the 'next' method
Route::get('/reqlamation/next', [InfoExameController::class, 'next'])->name('next');

Route::post('/get-modules', function (Request $request) {
    $request->validate([
        'nomFiliere' => 'required|string',
        'semester' => 'required|string',
        'parcours' => 'required|string',
    ]);

    // Get the selected values from the request
    $nomFiliere = $request->input('nomFiliere');
    $semester = $request->input('semester');
    $parcours = $request->input('parcours');

    // Construct the query to fetch modules based on selected values
    $modules = DB::table('Module')
        ->where('idFiliere', function ($subquery) use ($semester, $nomFiliere, $parcours) {
            $subquery->select('id')
                ->from('Filiere')
                ->where('CodeFiliere', 'LIKE', '%' . $semester)
                ->where('NomFiliere', $nomFiliere)
                ->where('Parcours', $parcours);
        })
        ->pluck('NomModule', 'CodeModule');

    // Check if any modules were found 
    if ($modules->isEmpty()) {
        // If no modules found, you may return an empty array or handle it as needed
        return response()->json([]);
    }

    // Return the fetched modules as a JSON response
    return response()->json($modules);
});


// Add a custom route for the 'getParcours' method
Route::post('/get-nom-filiere', [InfoExameController::class, 'getNomFiliere'])->name('get-nom-filiere');

Route::post('/get-parcours', function(Request $request) {
    // Validate the request
    $request->validate([
        'nomFiliere' => 'required|string',
        'semester' => 'required|string',
    ]);

    // Get the selected values from the request
    $nomFiliere = $request->input('nomFiliere');
    $semester = $request->input('semester');

    // Construct the query to fetch Parcours based on selected values
    $parcours = DB::table('Filieres')
        ->where('NomFiliere', $nomFiliere)
        ->where('CodeFiliere', 'LIKE', '%' . $semester)
        ->pluck('Parcours');

    // Check if any parcours were found 
    if ($parcours->isEmpty()) {
        // If no parcours found, you may return an empty array or handle it as needed
        return response()->json([]);
    }

    // Return the fetched parcours as a JSON response
    return response()->json($parcours);
});
// In web.php
Route::get('/fetch-filieres/{semester}', [CalendrierModuleController::class, 'fetchFilieresBySemester']);


// Routes for Etudiants_Filieres
Route::resource('etudiants-filieres', EtudiantFiliereController::class);

// Routes for Module
Route::resource('modules', ModuleController::class);

// Routes for Detail_module
Route::resource('detail-modules', DetailModuleController::class);

// Routes for Groupe
Route::resource('groupes', GroupeController::class);

// Routes for Groupe_etudiant
Route::resource('groupe-etudiants', GroupeEtudiantController::class);

// Routes for Info_Exames
Route::resource('info-exames', InfoExameController::class);

// Routes for Calendrier_module
Route::resource('calendrier-modules', CalendrierModuleController::class);

// Routes for Calendrier_module_Groupes
Route::resource('calendrier-module-groupes', CalendrierModuleGroupeController::class);

// Route::get('/', [EtudiantController::class, 'index'])->name('search.etudiant');
// routes/web.php

// routes/web.php


// admin/Filier_modules

Route::get('/admin/Filier_modules', [AdminController::class, 'showFiliermodules'])->name('Filier_modules_form');
Route::post('/admin/Filier_modules', [AdminController::class, 'processFiliermodules'])->name('Filier_modules_process');
// admin/Filier_modules

Route::get('/admin/Calendrier_modules', [CalendrierModuleController::class, 'showCalendriermodules'])->name('Calendrier_modules_form');
Route::post('/admin/Calendrier_modules', [CalendrierModuleController::class, 'processBulkInsert'])->name('Calendrier_modules_process');

// routes/web.php

Route::middleware(['auth'])->group(function () {
    // Your authenticated routes here

    Route::get('/admin', function () {
        return view('/dashboard');
    })->name('admin.dashboard');
});

// Route for the login page
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/admin/insert-student', [AdminController::class, 'showInsertStudentForm'])->name('insert_student_form');
Route::post('/admin/process-student-data', [AdminController::class, 'processStudentData'])->name('process_student_data');
