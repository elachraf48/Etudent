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

// Routes for Filiere
Route::resource('filieres', FiliereController::class);

// Routes for Etudiant
Route::resource('/', EtudiantController::class);
Route::get('/etudiant/search', [EtudiantController::class, 'search'])->name('search');

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

use App\Http\Controllers\AdminController;

Route::get('/admin/bulk-insert', [AdminController::class, 'showBulkInsertForm'])->name('bulk_insert_form');
Route::post('/admin/bulk-insert', [AdminController::class, 'processBulkInsert'])->name('bulk_insert_process');
// routes/web.php or routes/web.php

Route::get('/bulk-insert', 'BulkInsertController@index')->name('bulk_insert');
// routes/web.php

Route::middleware(['auth'])->group(function () {
    // Your authenticated routes here

    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Route for the login page
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
