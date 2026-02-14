<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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

Route::get('/accueil', [PageController::class, 'accueil']);

Route::get('/apropos', [PageController::class, 'apropos']);


Route::get('/bonjour', function () {
    return "Bonjour Laravel !";
});


Route::get('/etudiant/{nom}', function ($nom) {
    return "Salut, " . $nom;
});


Route::get('/heure', function () {
    return "Heure actuelle : " . now();
});


Route::get('/info/{age}', function ($age) {
    return view('info', ['age' => $age]);
});


Route::get('/contact', [PageController::class, 'showContactForm']);
Route::post('/contact', [PageController::class, 'submitContactForm']);


