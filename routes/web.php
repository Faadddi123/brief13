<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoadController;
use App\Http\Controllers\TaxiController;
use App\Http\Controllers\TrajetsController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;


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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// web.php
Route::get('/jeux', function () {
    return view('jeux.jeux'); // Assuming 'jeux' is the name of the Blade view file
})->middleware(['auth', 'verified'])->name('jeux.jeux');



// addroad 
Route::get('/addroad', [Controller::class, 'addroad'])->name('add_road');
Route::get('/Reserve/{id}', [Controller::class, 'add_to_reservation'])->name('Reserve');
Route::get('/show_all_roads', [Controller::class, 'show_all_roads'])->name('show_all_roads');

Route::resource('taxi', TaxiController::class);
Route::resource('road', RoadController::class);
Route::resource('trajets', TrajetsController::class);





require __DIR__.'/auth.php';
