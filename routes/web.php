<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, RespondenController, KuesionerController, ArticleController};

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('dashboard')->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');



    Route::prefix('responden')->group(function(){
        Route::get('/', [RespondenController::class, 'index'])->name('responden.index');
    });

    Route::prefix('kuesioner')->group(function(){
        Route::get('/', [KuesionerController::class, 'index'])->name('kuesioner.index');
        Route::get('/create', [KuesionerController::class, 'create'])->name('kuesioner.create');
        Route::post('/store', [KuesionerController::class, 'store'])->name('kuesioner.store');
        Route::get('/show/{id}', [KuesionerController::class, 'show'])->name('kuesioner.show');
        Route::get('/edit/{id}', [KuesionerController::class, 'edit'])->name('kuesioner.edit');
        Route::put('/update/{id}', [KuesionerController::class, 'update'])->name('kuesioner.update');
        Route::delete('/delete/{id}', [KuesionerController::class, 'destroy'])->name('kuesioner.delete');
        Route::put('/status_change/{id}', [KuesionerController::class, 'status_change'])->name('kuesioner.status_change');
    });

    Route::prefix('article')->group(function(){
        Route::get('/', [ArticleController::class, 'index'])->name('article.index');
        Route::get('/create', [ArticleController::class, 'create'])->name('article.create');
        Route::post('/store', [ArticleController::class, 'store'])->name('article.store');
        Route::get('/show/{id}', [ArticleController::class, 'show'])->name('article.show');
        Route::get('/edit/{id}', [ArticleController::class, 'edit'])->name('article.edit');
        Route::put('/update/{id}', [ArticleController::class, 'update'])->name('article.update');
        Route::delete('/delete/{id}', [ArticleController::class, 'destroy'])->name('article.delete');
        Route::put('/status_change/{id}', [ArticleController::class, 'status_change'])->name('article.status_change');
    });
});
