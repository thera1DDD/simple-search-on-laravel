<?php

use Illuminate\Support\Facades\Route;
// В файле web.php

use App\Http\Controllers\SearchController;



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
Route::get('/', [SearchController::class, 'index']);
Route::get('/search/result', [SearchController::class, 'search'])->name('search');


