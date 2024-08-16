<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\PictureController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\MiscTextsController;
use App\Http\Controllers\GenreController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {

    // Artist routes
    Route::post('/artist/{id}', [ArtistController::class, 'update'])->name('artist.update');
    Route::get('/artists', [ArtistController::class, 'index'])->name('artist.index');
    Route::post('/artists', [ArtistController::class, 'store'])->name('artist.store');
    Route::get('/artist/{id}', [ArtistController::class, 'edit'])->name('artist.edit');
    Route::post('/artist/{id}/destroy', [ArtistController::class, 'destroy'])->name('artist.destroy');
    Route::post('/img', [PictureController::class, 'store'])->name('artist.img');

    // Auth routes
    Route::post('/auth/update-password', [NewPasswordController::class, 'store'])->name('password.update');

    // Portfolio routes
    Route::get('/portfolio/{id}/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::post('/portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::get('/portfolios', [PortfolioController::class, 'index'])->name('portfolio.index');
    Route::post('/portfolio/{id}/destroy', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');
    Route::post('/portfolio/{id}', [PortfolioController::class, 'update'])->name('portfolio.update');

    // Portfolio artist routes
    Route::post('/portfolio/{id}/artists/{artistId}', [PortfolioController::class, 'addPortfolioArtist'])->name('portfolio.addArtists');
    Route::get('/portfolio/{id}/artists', [PortfolioController::class, 'getPortfolioArtists'])->name('portfolio.getArtists');
    Route::post('/portfolio/{id}/artists/{artistId}/destroy', [PortfolioController::class, 'removePortfolioArtist'])->name('portfolio.removeArtist');
    
    // Misc Text routes
    Route::post('/texts', [MiscTextsController::class, 'store'])->name('texts.store');
    Route::post('/texts/{id}', [MiscTextsController::class, 'update'])->name('texts.update');
    Route::post('/texts/{id}/destroy', [MiscTextsController::class, 'destroy'])->name('texts.destroy');
    Route::get('/texts', [MiscTextsController::class, 'index'])->name('texts.index');
    Route::get('/texts/{id}/edit', [MiscTextsController::class, 'edit'])->name('texts.edit');

    // Genre routes
    Route::post('/genres', [GenreController::class, 'store'])->name('genre.store');
    Route::post('/genres/{id}', [GenreController::class, 'update'])->name('genre.update');
    Route::post('/genres/{id}/destroy', [GenreController::class, 'destroy'])->name('genre.destroy');
    Route::get('/genres', [GenreController::class, 'index'])->name('genre.index');
});

// Public routes
Route::middleware('guest')->group(function () {
    Route::get('/portfolio/{urlId}', [PortfolioController::class, 'show'])->name('portfolio.show');
    Route::get('/texts/{textId}', [MiscTextsController::class, 'show'])->name('texts.show');
    Route::get('/genres/{id}', [GenreController::class, 'show'])->name('genre.show');
});


