<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::resource('authors', AuthorController::class);
Route::get('/authors/top/by/article/last/week', [AuthorController::class, 'getTopAuthorsByArticlesLastWeek'])
    ->name('authors.top');

Route::resource('articles', ArticleController::class);
Route::get('/articles/by/author/name/{authorName}', [ArticleController::class, 'searchByName'])
    ->name('articles.search');
