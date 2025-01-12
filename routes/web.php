<?php

use App\Http\Controllers\CategorieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MarqueController;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Auth;



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

Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategorieController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
Route::get('/categories/{id_categorie}/edit', [CategorieController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{id_categorie}', [CategorieController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id_categorie}', [CategorieController::class, 'destroy'])->name('categories.destroy');



Route::get('/', [ArticleController::class, 'showall'])->name('articles.showall');



Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

Route::get('/articles/{id_article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::put('/articles/{id_article}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/{id_article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
Route::get('/articles/{id_article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');

Route::get('/marques', [MarqueController::class, 'index'])->name('marques.index');
Route::get('/marques/create', [MarqueController::class, 'create'])->name('marques.create');
Route::post('/marques', [MarqueController::class, 'store'])->name('marques.store');



Auth::routes();

Route::get('auth/home', [App\Http\Controllers\Auth\HomeController::class, 'index'])->name('auth.home')->middleware('isAdmin');
Route::get('user/home', [App\Http\Controllers\User\HomeController::class, 'index'])->name('user.home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::get('/commander/{id_article}', [ArticleController::class, 'showCommandPage'])->name('articles.command');
Route::post('/commander/{id_article}/confirm', [ArticleController::class, 'confirmCommand'])->name('articles.confirmCommand');


Route::post('/commander/{id_article}', [ArticleController::class, 'commanderArticle'])->name('commander.article');
