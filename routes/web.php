<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, RespondenController, KuesionerController, ArticleController, CategoryController, TodoController, PeriksaGigiController};

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('dashboard')->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');



    Route::prefix('responden')->group(function(){
        Route::get('/', [RespondenController::class, 'index'])->name('responden.index');
    });

    Route::prefix('responden')->group(function(){
        Route::get('/', [RespondenController::class, 'index'])->name('responden.index');
        Route::get('/create', [RespondenController::class, 'create'])->name('responden.create');
        Route::post('/store', [RespondenController::class, 'store'])->name('responden.store');
        Route::get('/show/{id}', [RespondenController::class, 'show'])->name('responden.show');
        Route::get('/edit/{id}', [RespondenController::class, 'edit'])->name('responden.edit');
        Route::put('/update/{id}', [RespondenController::class, 'update'])->name('responden.update');
        Route::delete('/delete/{id}', [RespondenController::class, 'destroy'])->name('responden.delete');
        Route::get('/respond_kuesioner/{id}', [RespondenController::class, 'respond_kuesioner'])->name('responden.respond_kuesioner');
        Route::post('/respond/{id}', [RespondenController::class, 'respond'])->name('responden.respond');
        Route::get('/edit_respond/{id}', [RespondenController::class, 'edit_respond'])->name('responden.edit_respond');
        Route::put('/update_respond/{id}', [RespondenController::class, 'update_respond'])->name('responden.update_respond');
        Route::delete('/destroy_respond/{id}', [RespondenController::class, 'destroy_respond'])->name('responden.destroy_respond');
        Route::get('/show_detail_kuesioner/{id}', [RespondenController::class, 'show_detail_kuesioner'])->name('responden.show_detail_kuesioner');
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
        Route::get('/show_responden/{id}', [KuesionerController::class, 'show_responden'])->name('kuesioner.show_responden');
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

    Route::prefix('category')->group(function(){
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/show/{id}', [CategoryController::class, 'show'])->name('category.show');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
    });

    Route::prefix('todo')->group(function(){
        Route::get('/create/{id}', [TodoController::class, 'create'])->name('todo.create');
        Route::post('/store/{id}', [TodoController::class, 'store'])->name('todo.store');
        Route::get('/show/{id}', [TodoController::class, 'show'])->name('todo.show');
        Route::get('/edit/{id}', [TodoController::class, 'edit'])->name('todo.edit');
        Route::put('/update/{id}', [TodoController::class, 'update'])->name('todo.update');
        Route::delete('/delete/{id}', [TodoController::class, 'destroy'])->name('todo.delete');
    });

    Route::prefix('periksaGigi')->group(function(){
        Route::get('/create/{id}', [PeriksaGigiController::class, 'create'])->name('periksaGigi.create');
        Route::post('/store/{id}', [PeriksaGigiController::class, 'store'])->name('periksaGigi.store');
        Route::get('/show/{id}', [PeriksaGigiController::class, 'show'])->name('periksaGigi.show');
        Route::get('/edit/{id}', [PeriksaGigiController::class, 'edit'])->name('periksaGigi.edit');
        Route::put('/update/{id}', [PeriksaGigiController::class, 'update'])->name('periksaGigi.update');
        Route::delete('/delete/{id}', [PeriksaGigiController::class, 'destroy'])->name('periksaGigi.delete');
    });
});
