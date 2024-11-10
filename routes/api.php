<?php

use App\Http\Controllers\ArticleApiController;
use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\KuesionerApiController;
use App\Http\Controllers\RespondenApiController;
use App\Http\Controllers\TodoApiController;
use Illuminate\Support\Facades\Route;

// Category API Routes
Route::get('categories', [CategoryApiController::class, 'index']); // List all categories
Route::post('categories', [CategoryApiController::class, 'store']); // Create new category
Route::get('categories/{id}', [CategoryApiController::class, 'show']); // Get a single category
Route::put('categories/{id}', [CategoryApiController::class, 'update']); // Update a category
Route::delete('categories/{id}', [CategoryApiController::class, 'destroy']); // Delete a category

// Article API Routes
Route::get('articles', [ArticleApiController::class, 'index']); // List all articles
Route::post('articles', [ArticleApiController::class, 'store']); // Create a new article
Route::get('articles/{id}', [ArticleApiController::class, 'show']); // Get a single article
Route::put('articles/{id}', [ArticleApiController::class, 'update']); // Update an article
Route::delete('articles/{id}', [ArticleApiController::class, 'destroy']); // Delete an article

// Kuesioner API Routes
Route::get('kuesioners', [KuesionerApiController::class, 'index']); // List all kuesioners
Route::post('kuesioners', [KuesionerApiController::class, 'store']); // Create a new kuesioner
Route::get('kuesioners/{id}', [KuesionerApiController::class, 'show']); // Get a single kuesioner
Route::put('kuesioners/{id}', [KuesionerApiController::class, 'update']); // Update a kuesioner
Route::delete('kuesioners/{id}', [KuesionerApiController::class, 'destroy']); // Delete a kuesioner
Route::post('kuesioners/{id}/status-change', [KuesionerApiController::class, 'statusChange']); // Change kuesioner status
Route::get('kuesioners/{id}/respondens', [KuesionerApiController::class, 'showResponden']); // Get respondents for a kuesioner

// Responden API Routes
Route::get('respondens', [RespondenApiController::class, 'index']); // List all respondents
Route::post('respondens', [RespondenApiController::class, 'store']); // Create a new respondent
Route::get('respondens/{id}', [RespondenApiController::class, 'show']); // Get a single respondent
Route::put('respondens/{id}', [RespondenApiController::class, 'update']); // Update a respondent
Route::delete('respondens/{id}', [RespondenApiController::class, 'destroy']); // Delete a respondent
Route::post('respondens/{id}/respond-kuesioner', [RespondenApiController::class, 'respondKuesioner']); // Respond to a kuesioner

Route::get('todos', [TodoApiController::class, 'index']); // List all todos
Route::post('todos/{responden_id}', [TodoApiController::class, 'store']); // Create new todo for a respondent
Route::get('todos/{id}', [TodoApiController::class, 'show']); // Get a single todo
Route::put('todos/{id}', [TodoApiController::class, 'update']); // Update a todo
Route::delete('todos/{id}', [TodoApiController::class, 'destroy']); // Delete a todo// Todo API Routes  
Route::get('todos/date/{date}', [TodoApiController::class, 'getByDate']); // Get todos by specific date
Route::get('todos/user/{id}', [TodoApiController::class, 'getByUser']); // Get todos by specific date
Route::post('todos/user/{id}', [TodoApiController::class, 'postByUser']); // Get todos by specific date
