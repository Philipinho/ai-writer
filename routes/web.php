<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\JsonController;
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

    Route::get('documents', [DocumentController::class, 'index'])->name('documents.index');

    Route::get('/history', [DocumentController::class, 'contentHistory'])->name('history');

    Route::get('/documents/new', [DocumentController::class, 'createDocument'])->name('documents.create');
    Route::get('/documents/{uuid}', [DocumentController::class, 'editDocument'])->name('documents.edit');
    Route::put('/documents/{uuid}/update', [DocumentController::class, 'updateDocument'])->name('documents.update');

    Route::post('/documents/store', [DocumentController::class, 'store'])->name('documents.store');
    Route::post('/documents/{uuid}/generate', [DocumentController::class, 'generate'])->name('documents.generate');

    Route::delete('/documents/{uuid}/delete', [DocumentController::class, 'delete'])->name('documents.delete');

    // Templates
    Route::get('/templates', [TemplateController::class, 'index'])->name('templates.index');

    Route::group(['middleware' => ['is_admin']], function() {
        Route::get('/templates/list', [TemplateController::class, 'list'])->name('templates.list');

        Route::get('/templates/create', [TemplateController::class, 'create'])->name('templates.create');
        Route::post('/templates/store', [TemplateController::class, 'store'])->name('templates.store');


        Route::put('/templates/{id}/update', [TemplateController::class, 'update'])->name('templates.update');

        Route::get('/templates/{id}/edit', [TemplateController::class, 'edit'])->name('templates.edit');

        Route::get('/templates/mass-edit', [TemplateController::class, 'massEdit'])->name('templates.mass-edit');
        Route::put('/templates/mass-update', [TemplateController::class, 'massUpdate'])->name('templates.mass-update');

        Route::post('/templates/upload', [TemplateController::class, 'importFile'])->name('templates.import.upload');
        Route::get('/templates/import', [TemplateController::class, 'import'])->name('templates.import');
    });

    Route::get('/settings/billing', [BillingController::class, 'index'])->name('billing');
    Route::get('/subscription', [BillingController::class, 'subscription'])->name('subscription');

    Route::post('/billing/checkout', [BillingController::class, 'checkout'])->name('checkout');

    Route::get('/billing/portal', [BillingController::class, 'billingPortal'])->name('billing.portal');

    // JSON RESPONSE
    Route::get('/api/stats', [JsonController::class, 'usageStats'])->name('api.usage');



});
