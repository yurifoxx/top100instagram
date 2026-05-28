<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SitemapController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/api/ranking', [HomeController::class, 'apiRanking'])->name('api.ranking');
Route::get('/buscar', [SearchController::class, 'index'])->name('search');
Route::get('/perfil/{username}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/categoria/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/sobre', [AboutController::class, 'index'])->name('about');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    Route::middleware(\App\Http\Middleware\AdminAuth::class)->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        Route::get('/perfis', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profiles.index');
        Route::get('/perfis/criar', [App\Http\Controllers\Admin\ProfileController::class, 'create'])->name('profiles.create');
        Route::post('/perfis', [App\Http\Controllers\Admin\ProfileController::class, 'store'])->name('profiles.store');
        Route::get('/perfis/{profile}/editar', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profiles.edit');
        Route::put('/perfis/{profile}', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profiles.update');
        Route::delete('/perfis/{profile}', [App\Http\Controllers\Admin\ProfileController::class, 'destroy'])->name('profiles.destroy');
        Route::post('/perfis/importar', [App\Http\Controllers\Admin\ProfileController::class, 'import'])->name('profiles.import');

        Route::get('/categorias', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categorias', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categories.store');
        Route::delete('/categorias/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('categories.destroy');
    });
});
