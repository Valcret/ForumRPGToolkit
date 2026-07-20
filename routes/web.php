<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\FaceclaimController;
use App\Http\Controllers\FichcraftController;
use App\Http\Controllers\ImageDownloadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrieurController;
use App\Http\Controllers\RoleplayController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\CguController;
use App\Http\Controllers\PartenairesController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Pages footer
// routes/web.php
Route::get('/mentions-legales', [LegalController::class, 'index'])->name('legal.mentions');
Route::get('/cgu', [CguController::class, 'index'])->name('legal.cgu');
Route::get('/partenaires', [PartenairesController::class, 'index'])->name('legal.partenaires');
Route::get('/contact', [ContactController::class, 'index'])->name('legal.contact');


// Faceclaim
Route::get('/faceclaim', [FaceclaimController::class, 'index'])->name('faceclaim.index');

// Fichcraft
Route::get('/fichcraft', [FichcraftController::class, 'index'])->name('fichcraft.index');
Route::get('/fichcraft/{forum}', [FichcraftController::class, 'show'])->name('fichcraft.show');
Route::post('/fichcraft/{forum}', [FichcraftController::class, 'store'])->name('fichcraft.store');


// Download
Route::get('/images/{image}/download', [ImageDownloadController::class, 'download'])->name('images.download');

//Trieur
Route::middleware('auth')->group(function () {
    Route::get('/trieur', [TrieurController::class, 'index'])->name('trieur.index');
    Route::post('/trieur/rp/{roleplay}/favorite', [TrieurController::class, 'toggleFavorite'])->name('trieur.favorite');
    Route::post('/trieur/rp/{roleplay}/status', [TrieurController::class, 'updateStatus'])->name('trieur.updateStatus');
    Route::post('/roleplays', [RoleplayController::class, 'store'])->name('roleplays.store');
    Route::get('/characters/by-forum/{forum}', [RoleplayController::class, 'charactersByForum'])->name('characters.by-forum');

});

// Auth Breeze
require __DIR__.'/auth.php';
