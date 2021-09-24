<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ChallengeController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/companies', [CompanyController::class, 'index'])->name('companies');

//Route::middleware(['auth:sanctum', 'verified'])->get('/companies', [CompanyController::class, 'index'])->name('company.index');
Route::get('/company', [CompanyController::class, 'create'])->name('company.create');

Route::post('/company', [CompanyController::class, 'store'])->name('company.store');

Route::get('/company/{company}/edit', [CompanyController::class, 'edit'])->name('company.edit');

Route::put('/company/{company}', [CompanyController::class, 'update'])->name('company.update');

Route::delete('/company/{company}', [CompanyController::class, 'destroy'])->name('company.destroy');

Route::get('/company/profile/{company}', [CompanyController::class, 'show'])->name('company.show');

// Challenges
Route::get('/challenge', [App\Http\Controllers\HomeController::class, 'challenges'])->name('challenges');

Route::get('/challenges', [ChallengeController::class, 'index']);

Route::post('/challenge', [ChallengeController::class, 'store']);

Route::get('/challenge/{challenge}/edit', [ChallengeController::class, 'edit']);

Route::put('/challenge/{challenge}', [ChallengeController::class, 'update']);

Route::delete('/challenge/{challenge}', [ChallengeController::class, 'destroy']);

