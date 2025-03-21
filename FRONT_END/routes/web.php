<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\ChauffeurController;

use App\Http\Controllers\TrajetController;

use App\Http\Controllers\SuiviController;







/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/vehicules/create', [VehiculeController::class, 'create'])->name('vehicules.create');


Route::post('/vehicules/enregistrer', [VehiculeController::class, 'store'])->name('vehicules.store');




Route::post('/vehicules', [VehiculeController::class, 'ajout_incident'])->name('incident.store');



Route::get('/liste/vehicules', [VehiculeController::class, 'index'])->name('');


// Route pour modifier un véhicule
Route::get('/vehicules/{id}/edit', [VehiculeController::class, 'edit'])->name('vehicules.edit');


Route::put('/vehicules/{id}', [VehiculeController::class, 'update'])->name('vehicules.update');





Route::get('/incidents', [IncidentController::class, 'index'])->name('incidents.index');

Route::post('/incidents/enregistrer', [IncidentController::class, 'store'])->name('incidents.store');

Route::get('/incidents/{id}', [IncidentController::class, 'edit'])->name('incidents.edit');

Route::put('/incidents/{id}', [IncidentController::class, 'update'])->name('incidents.update');

Route::delete('/incidents/{id}', [IncidentController::class, 'destroy'])->name('incidents.destroy');


// Route pour supprimer un véhicule
Route::delete('/vehicules/{id}', [VehiculeController::class, 'destroy'])->name('vehicules.destroy');

Route::get('/tableau', [VehiculeController::class, 'tableau']);

Route::get('/connexion', [VehiculeController::class, 'connexion']);


Route::get('/trackings/create', [VehiculeController::class, 'franck'])->name('trackings.create');
Route::post('/trackings', [VehiculeController::class, 'ephrem'])->name('trackings.store');



Route::get('/nouveau', [IncidentController::class, 'ajout_incident']);






// Route::get('/yann', [ChauffeurController::class, 'ajout']);






Route::get('/chauffeurs', [ChauffeurController::class, 'index'])->name('chauffeurs.index');

Route::get('/chauffeurs/create', [ChauffeurController::class, 'create'])->name('chauffeurs.create');

Route::post('/chauffeur/enregistrer', [ChauffeurController::class, 'store'])->name('chauffeurs.store');

Route::get('/chauffeurs/{id}', [ChauffeurController::class, 'show'])->name('chauffeurs.show');

Route::get('/chauffeurs/{id}/edit', [ChauffeurController::class, 'edit'])->name('chauffeurs.edit');

Route::put('/chauffeurs/{id}', [ChauffeurController::class, 'update'])->name('chauffeurs.update');

Route::delete('/chauffeurs/{id}', [ChauffeurController::class, 'destroy'])->name('chauffeurs.destroy');




Route::get('/trajets', [TrajetController::class, 'index'])->name('chauffeurs.index');

Route::get('/trajets/create', [TrajetController::class, 'create'])->name('chauffeurs.create');


Route::post('/trajet/enregistrer', [TrajetController::class, 'store'])->name('trajets.store');



Route::get('/trajets/{id}/edit', [TrajetController::class, 'edit'])->name('trajets.edit');


Route::put('/trajets/{id}', [TrajetController::class, 'update'])->name('trajets.update');


Route::delete('/trajets/{id}', [ChauffeurController::class, 'destroy'])->name('trajets.destroy');





Route::get('/suivi/create', [SuiviController::class, 'create'])->name('chauffeurs.create');



Route::get('/ko', [SuiviController::class, 'index'])->name('suivis.index');


Route::get('/suivi/{id}/location', [SuiviController::class, 'location'])->name('suivis.location');


Route::post('/suivi/enregistrer', [TrajetController::class, 'store'])->name('suivis.store');


Route::get('/suivis/create', [SuiviController::class, 'create'])->name('chauffeurs.create');



Route::post('/login', [VehiculeController::class, 'login']);


Route::post('/ajouter/utilisateur', [VehiculeController::class, 'checkCredentials']);

