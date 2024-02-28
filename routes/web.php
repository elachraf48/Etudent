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


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\CalendrierSessionController;

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
use App\Http\Controllers\PDFController;
use App\Http\Middleware\RoleMiddleware;

use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\DetailProfesseurController;
use App\Http\Controllers\TrackingReclamationController;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Auth;

// Routes for Filiere
Route::resource('filieres', FiliereController::class);

// Routes for Etudiant

// Define the resource routes
Route::resource('/reclamation', ReclamationController::class);
Route::get('/reclamation/next', [ReclamationController::class, 'show'])->name('reclamation.next');
Route::post('/reclamation/next', [ReclamationController::class, 'reclamationpost'])->name('reclamationpost');
Route::get('/reclamation/last/{reclamationId}', [ReclamationController::class, 'last'])->name('reclamationlast');

// Add a custom route for the 'next' method

// Add a custom route for the 'getParcours' method


// In web.php
Route::get('/fetch-filieres/{semester}', [CalendrierModuleController::class, 'fetchFilieresBySemester']);
Route::get('/fetch-filieres/{semester}', [ReclamationController::class, 'fetchFilieresBySemester']);
Route::get('/fetch-filieres/{semester}', [DetailModuleController::class, 'fetchFilieresBySemester']);
Route::get('/fetch-filieres/{semester}', [AdminController::class, 'fetchFilieresBySemester']);
Route::get('/fetch-reclamations/{AnneeUniversitaire}/{module}/{semester}/{filiere}/{professeur}/{SESSION}', [TrackingReclamationController::class, 'reclamations']);
Route::get('/fetch-reclamations/{AnneeUniversitaire}/{statu}/{semester}/{sessions}', [DetailProfesseurController::class, 'reclamations']);
Route::get('/detailsreqlamation/{id}', [DetailProfesseurController::class, 'detailsReclamation']);
Route::post('/save-response', [DetailProfesseurController::class, 'saveResponse'])->name('save-response');
Route::post('/update-tracking-reclamations', [DetailProfesseurController::class, 'updateTrackingReclamations']);

Route::get('/fetch-professeur/{fetchModules}', [ReclamationController::class, 'fetchProfesseur']);

Route::get('/fetch-modules/{filiere}', [ReclamationController::class, 'fetchModules']);


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
Route::get('/reclamations/etudiant/{filiere}', [EtudiantController::class,'getReclamationsCount'])->name('reclamations.etudiant');


// routes/web.php
Route::resource('/', EtudiantController::class);
Route::get('/etudiant/search', [EtudiantController::class, 'search'])->name('search');
Route::get('/etudiant/Repense', [EtudiantController::class, 'Repense'])->name('Repense');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:3'])->group(function () {
        Route::resource('/Professeur', DetailProfesseurController::class);
        Route::get('/reclamations/count', [DetailProfesseurController::class,'getReclamationsCount'])->name('reclamations.count');
        Route::get('/Professeur/Reclamation', [DetailProfesseurController::class, 'show'])->name('Reclamationpr');

    
    });
    
    // Your authenticated routes here
    Route::middleware(['role:0'])->group(function () {
        Route::get('/admin/insert-student', [AdminController::class, 'showInsertStudentForm'])->name('insert_student_form');
        Route::post('/admin/process-student-data', [AdminController::class, 'processStudentData'])->name('process_student_data');
        //detail_modules
        Route::get('/admin/detail_modules', [DetailModuleController::class, 'index'])->name('detail_modules_form');
        Route::post('/admin/detail_modules', [DetailModuleController::class, 'processDetailModulesData'])->name('process_detail_modules_data');
        Route::get('/admin/Filier_modules', [AdminController::class, 'showFiliermodules'])->name('Filier_modules_form');
        Route::post('/admin/Filier_modules', [AdminController::class, 'processFiliermodules'])->name('Filier_modules_process');
        // admin/Reclamation
        Route::get('/admin/Reclamation', [TrackingReclamationController::class,'index'] )->name('Reclamation_form');
        Route::post('/admin/Reclamation', [TrackingReclamationController::class, 'processFiliermodules'])->name('Reclamation_process');
        // admin/bulk_professeurs
        Route::get('/admin/bulk_professeurs', [ProfesseurController::class, 'index'])->name('bulk_professeurs_form');
        Route::post('/admin/bulk_professeurs', [ProfesseurController::class, 'bulk_professeurs_process'])->name('bulk_professeurs_process');
        // admin/Calendrier_modules
        Route::post('/admin/Calendrier_modules', [CalendrierModuleController::class, 'insertCalendrierModules'])->name('Calendrier_modules_process');
        Route::get('/admin/Calendrier_modules', [CalendrierModuleController::class, 'showCalendriermodules'])->name('Calendrier_modules_form');
        Route::resource('/admin', AdminController::class);
       
    });
    
       
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
// Route for the login page
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
// Catch-all route for /admin/* when the user is not authenticated
// Route::get('/admin/{any?}', function () {
//     if (!auth()->check()) {
//         return redirect()->route('login');
//     }
// })->where('any', '.*');

