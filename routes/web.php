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

Route::get('/documents/{id}/file', [DocumentController::class, 'viewFile'])
    ->name('documents.file');

Route::resource('documents', DocumentController::class);

Route::get('/language/{locale}', function (string $locale) {
    if (!in_array($locale, ['id', 'en'])) {
        abort(404);
    }

    session(['locale' => $locale]);

    return redirect()->back();
})->name('language.switch');
