<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('documents-export', [DocumentController::class, 'export'])
    ->name('documents.export');

Route::post('documents-import', [DocumentController::class, 'import'])
    ->name('documents.import');

Route::resource('documents', DocumentController::class);
