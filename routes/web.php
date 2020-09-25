<?php

use App\Http\Controllers\TestController;
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

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth:sanctum', 'verified']);

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/test', [TestController::class, 'index']);
//Route::get('/test', function () {
//    return view('layouts.test');
//});
Route::get('/test/data', [\App\Http\Controllers\SirenController::class, 'data'])->name('testData');

Route::get('/main', [\App\Http\Controllers\SirenController::class, 'index']);
Route::get('/close/{id}', [\App\Http\Controllers\SirenController::class, 'close'])->name('closeTransaction');
Route::match(['post', 'get'],'/update/{id}', [\App\Http\Controllers\SirenController::class, 'update'])->name('updateTransaction');
Route::post('/create', [\App\Http\Controllers\SirenController::class, 'create'])->name('createTransaction');
Route::post('/save/', [\App\Http\Controllers\SirenController::class, 'save'])->name('saveTransaction');
Route::delete('/delete/{id}', [\App\Http\Controllers\SirenController::class, 'delete'])->name('deleteTransaction');