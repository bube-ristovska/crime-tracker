<?php

use App\Http\Controllers\CrimeCaseController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

// UNAUTHORIZED
Route::get('/login', function () {
    return view('login');

});
Route::post('/login', [SessionsController::class, 'store']);

Route::get('/unauth', function () {
    return view('unauth');  // Make sure there is a view file named `unauth.blade.php`
})->name('unauth');  // Name the route 'unauth'

// AUTHORIZED
// POLICEMAN
Route::get('register-statement', [CrimeCaseController::class, 'register_statement'])->middleware('policeman');
Route::post('register-statement', [CrimeCaseController::class, 'register_statement_post'])->middleware('policeman');

// OFFICER
Route::get('register-policeman', [OfficerController::class, 'register'])->middleware('officer');
Route::post('register-policeman', [OfficerController::class, 'register_post'])->middleware('officer');

// BOTH
Route::get('/', function () {
    return view('welcome');
})->middleware('both');
Route::get('logout', [SessionsController::class, 'logout']);

Route::get('employees', [OfficerController::class, 'employees'])->middleware('both');
Route::get('/employees/{id}', [OfficerController::class, 'show'])->middleware('both');

Route::get('filter', [PeopleController::class, 'filter'])->middleware('both');
Route::post('filter', [PeopleController::class, 'filter_post'])->middleware('both');

Route::get('cases', [CrimeCaseController::class, 'cases'])->middleware('both');
Route::get('case/{wildcard}', [CrimeCaseController::class, 'case'])->middleware('both');
Route::get('finished_cases', [CrimeCaseController::class, 'finished_cases'])->middleware('both');

Route::post('/get-person', [PeopleController::class, 'getPerson'])->middleware('both');
