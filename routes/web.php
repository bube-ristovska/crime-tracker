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

Route::get('/', function () {
    if(Session::get('pe_id') == null) {
        return view('login');
    }
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');

});

Route::post('/login', [SessionsController::class, 'store']);


Route::get('logout', [SessionsController::class, 'logout']);



Route::get('employees', [OfficerController::class, 'employees'])->middleware('guest');
Route::get('filter', [PeopleController::class, 'filter'])->middleware('guest');
Route::post('filter', [PeopleController::class, 'filter_post'])->middleware('guest');

Route::get('cases', [CrimeCaseController::class, 'cases'])->middleware('guest');
Route::get('case/{wildcard}', [CrimeCaseController::class, 'case'])->middleware('guest');

Route::get('finished_cases', [CrimeCaseController::class, 'index'])->middleware('guest');


Route::get('register-policeman', [OfficerController::class, 'register'])->middleware('guest');
Route::post('register-policeman', [OfficerController::class, 'register'])->middleware('guest');

Route::get('/get_person/{{embg}}', [PeopleController::class, 'get_person'])->middleware('guest');
