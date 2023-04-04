<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\TemplateController;
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

    Route::get('documents', [DocumentController::class, 'index'])->name('document.list');

    // create new doc with template id passed?
    Route::get('/document/new', [DocumentController::class, 'createDocument'])->name('document.new');
    Route::get('/document/{uuid}', [DocumentController::class, 'editDocument'])->name('document.edit');
    Route::put('/document/{uuid}/update', [DocumentController::class, 'updateDocument'])->name('document.update');

    Route::post('/document/store', [DocumentController::class, 'store'])->name('document.store');
    Route::post('/document/{uuid}/generate', [DocumentController::class, 'generate'])->name('document.generate');

    // Templates
    Route::get('/templates', [TemplateController::class, 'index'])->name('templates');

});
