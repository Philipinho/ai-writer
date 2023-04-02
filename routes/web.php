<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('document', [DocumentController::class, 'show'])->name('document.show');

    // create new doc with template id passed?
    Route::get('/document/new', [DocumentController::class, 'createDocument'])->name('document.new');
    Route::get('/document/{uuid}', [DocumentController::class, 'editDocument'])->name('document.edit');
    Route::post('/document/{uuid}/update', [DocumentController::class, 'update'])->name('document.update');

    Route::post('/document/store', [DocumentController::class, 'store'])->name('document.store');
    Route::post('/document/generate', [DocumentController::class, 'generate'])->name('document.generate');

});
