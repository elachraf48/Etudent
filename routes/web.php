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
use App\Http\Controllers\PreInscriptionController;
use App\Http\Controllers\ParameterPageController;
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
Route::get('/reclamations/etudiant/{filiere}', [EtudiantController::class, 'getReclamationsCount'])->name('reclamations.etudiant');
Route::get('/check-connection', [TrackingReclamationController::class,'checkConnection']);


// routes/web.php
Route::resource('/', EtudiantController::class);
Route::get('/etudiant/search', [EtudiantController::class, 'search'])->name('search');
Route::get('/etudiant/Repense', [EtudiantController::class, 'Repense'])->name('Repense');

Route::get('/etudiant/preinscription', [PreInscriptionController::class, 'showForm'])->name('preinscription.form');
Route::post('/etudiant/preinscription', [PreInscriptionController::class, 'create'])->name('create.preinscription');
Route::get('/getCreationDate/{id}',[PreInscriptionController::class, 'getCreationDate'])->name('getCreationDate');
Route::get('/fetch-professeur/{fetchModules}/{groupe}', [ReclamationController::class, 'fetchProfesseur']);


Route::middleware(['auth'])->group(function () {
    Route::get('/fetch-reclamations/{AnneeUniversitaire}/{statu}/{semester}/{sessions}', [DetailProfesseurController::class, 'reclamations']);
    Route::get('/detailsreqlamation/{id}', [DetailProfesseurController::class, 'detailsReclamation']);
    Route::post('/save-response', [DetailProfesseurController::class, 'saveResponse'])->name('save-response');
    Route::post('/update-tracking-reclamations', [DetailProfesseurController::class, 'updateTrackingReclamations']);
    Route::get('/fetch-filieres/{semester}', [CalendrierModuleController::class, 'fetchFilieresBySemester']);
    Route::get('/fetch-filieres/{semester}', [ReclamationController::class, 'fetchFilieresBySemester']);
    Route::get('/fetch-filieres/{semester}', [DetailModuleController::class, 'fetchFilieresBySemester']);
    Route::get('/fetch-filieres/{semester}', [AdminController::class, 'fetchFilieresBySemester']);
    Route::get('/fetch-reclamations/{AnneeUniversitaire}/{module}/{semester}/{filiere}/{professeur}/{SESSION}/{stratu}', [TrackingReclamationController::class, 'reclamations']);
    // Route::get('/fetch-professeur-reclamations/{AnneeUniversitaire}/{module}/{semester}/{filiere}/{professeur}/{SESSION}/{statu}', [TrackingReclamationController::class, 'professors_reclamations']);
    Route::get('/fetch-professeur-reclamations', [TrackingReclamationController::class, 'professors_reclamations']);
    Route::get('/fetch-reclamations-modules/{semester}/{filiere}/{stratu}', [ModuleController::class, 'updateModules']);
    
    
    Route::get('/fetch-modules/{filiere}', [ReclamationController::class, 'fetchModules']);
  
    Route::middleware(['role:3'])->group(function () {
        Route::get('/Professeur', [DetailProfesseurController::class,'index']);
        Route::get('/reclamations/count', [DetailProfesseurController::class, 'getReclamationsCount'])->name('reclamations.count');
        Route::get('/Professeur/Reclamation', [DetailProfesseurController::class, 'show'])->name('Reclamationpr');
        Route::get('/Professeur/activation', [DetailProfesseurController::class, 'activation'])->name('activation');
        // Route::post('/Professeur/activation', [DetailProfesseurController::class, 'update'])->name('module_edit');
       

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
        Route::get('/admin/Professeur', [TrackingReclamationController::class, 'indexProfesseur'])->name('Professeur_form');
        Route::post('/admin/Professeur', [TrackingReclamationController::class, 'processFiliermodules'])->name('Professeur_process');
        // admin/Reclamation
        Route::get('/admin/Reclamation', [TrackingReclamationController::class, 'index'])->name('Reclamation_form');
        Route::post('/admin/Reclamation', [TrackingReclamationController::class, 'processFiliermodules'])->name('Reclamation_process');
        Route::get('/admin/Reclamation/edit', [TrackingReclamationController::class, 'reclamation_edit'])->name('Reclamation_edit_form');
        Route::post('/admin/Reclamation/edit', [TrackingReclamationController::class, 'edit'])->name('Reclamation_edit');
        Route::get('/admin/parameter', [ParameterPageController::class, 'index'])->name('parameterPage');
        Route::post('/admin/parameter', [ParameterPageController::class, 'edit'])->name('parameter_edit');
        Route::get('/admin/Reclamation/module', [ModuleController::class, 'index'])->name('module_post');
        Route::post('/admin/Reclamation/module', [ModuleController::class, 'update'])->name('module_edit');

        // admin/bulk_professeurs
        Route::get('/admin/bulk_professeurs', [ProfesseurController::class, 'index'])->name('bulk_professeurs_form');
        Route::post('/admin/bulk_professeurs', [ProfesseurController::class, 'bulk_professeurs_process'])->name('bulk_professeurs_process');
        // admin/Calendrier_modules
        Route::post('/admin/Calendrier_modules', [CalendrierModuleController::class, 'insertCalendrierModules'])->name('Calendrier_modules_process');
        Route::get('/admin/Calendrier_modules', [CalendrierModuleController::class, 'showCalendriermodules'])->name('Calendrier_modules_form');
        Route::resource('/admin', AdminController::class);
        //indevidl
        Route::get('/admin/individual/module', [ModuleController::class, 'show'])->name('showmodule');
        Route::get('/fetch-module-table/{semester}/{filiere}', [ModuleController::class, 'fetchmoduletable'])->name('fetchmoduletable');

       
        Route::get('/admin/individual/filier', [ModuleController::class, 'show'])->name('showfilier');
        Route::get('/admin/individual/etudiant', [ModuleController::class, 'show'])->name('showetudiant');


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
