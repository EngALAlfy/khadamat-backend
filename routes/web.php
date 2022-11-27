<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/access/denied' , 'errors.denied')->name('access.denied');
Route::view('/banned' , 'errors.banned')->name('banned');

// admin routes
Route::prefix("admin")->name("admin.")->group(function () {


    Auth::routes();

    Route::middleware(["auth" , "isBanned" , "adminOnly"])->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


        Route::prefix('film-categories')->as("film-categories.")->group(function (){
            Route::get('/' , [\App\Http\Controllers\FilmCategoryController::class , 'index'])->name('index');
            Route::get('/create' , [\App\Http\Controllers\FilmCategoryController::class , 'create'])->name('create');
            Route::post('/store' , [\App\Http\Controllers\FilmCategoryController::class , 'store'])->name('store');
            Route::get('/{filmCategory}/edit' , [\App\Http\Controllers\FilmCategoryController::class , 'edit'])->name('edit');
            Route::post('/{filmCategory}/update' , [\App\Http\Controllers\FilmCategoryController::class , 'update'])->name('update');
            Route::get('/{filmCategory}/delete' , [\App\Http\Controllers\FilmCategoryController::class , 'destroy'])->name('destroy');
        });

        Route::prefix('films')->as("films.")->group(function (){
            Route::get('/' , [\App\Http\Controllers\FilmController::class , 'index'])->name('index');
            Route::get('/create' , [\App\Http\Controllers\FilmController::class , 'create'])->name('create');
            Route::post('/store' , [\App\Http\Controllers\FilmController::class , 'store'])->name('store');
            Route::get('/{film}/edit' , [\App\Http\Controllers\FilmController::class , 'edit'])->name('edit');
            Route::post('/{film}/update' , [\App\Http\Controllers\FilmController::class , 'update'])->name('update');
            Route::get('/{film}/delete' , [\App\Http\Controllers\FilmController::class , 'destroy'])->name('destroy');
        });

        Route::prefix('series-categories')->as("series-categories.")->group(function (){
            Route::get('/' , [\App\Http\Controllers\SeriesCategoryController::class , 'index'])->name('index');
            Route::get('/create' , [\App\Http\Controllers\SeriesCategoryController::class , 'create'])->name('create');
            Route::post('/store' , [\App\Http\Controllers\SeriesCategoryController::class , 'store'])->name('store');
            Route::get('/{seriesCategory}/edit' , [\App\Http\Controllers\SeriesCategoryController::class , 'edit'])->name('edit');
            Route::post('/{seriesCategory}/update' , [\App\Http\Controllers\SeriesCategoryController::class , 'update'])->name('update');
            Route::get('/{seriesCategory}/delete' , [\App\Http\Controllers\SeriesCategoryController::class , 'destroy'])->name('destroy');
        });

        Route::prefix('series')->as("series.")->group(function (){
            Route::get('/' , [\App\Http\Controllers\SeriesController::class , 'index'])->name('index');
            Route::get('/create' , [\App\Http\Controllers\SeriesController::class , 'create'])->name('create');
            Route::post('/store' , [\App\Http\Controllers\SeriesController::class , 'store'])->name('store');
            Route::get('/{series}/edit' , [\App\Http\Controllers\SeriesController::class , 'edit'])->name('edit');
            Route::post('/{series}/update' , [\App\Http\Controllers\SeriesController::class , 'update'])->name('update');
            Route::get('/{series}/delete' , [\App\Http\Controllers\SeriesController::class , 'destroy'])->name('destroy');
        });

        Route::prefix('series-episodes')->as("series-episodes.")->group(function (){
            Route::get('/{series}' , [\App\Http\Controllers\SeriesEpisodeController::class , 'index'])->name('index');
            Route::get('/{series}/create' , [\App\Http\Controllers\SeriesEpisodeController::class , 'create'])->name('create');
            Route::post('/{series}/store' , [\App\Http\Controllers\SeriesEpisodeController::class , 'store'])->name('store');
            Route::get('/{seriesEpisode}/edit' , [\App\Http\Controllers\SeriesEpisodeController::class , 'edit'])->name('edit');
            Route::post('/{seriesEpisode}/update' , [\App\Http\Controllers\SeriesEpisodeController::class , 'update'])->name('update');
            Route::get('/{seriesEpisode}/delete' , [\App\Http\Controllers\SeriesEpisodeController::class , 'destroy'])->name('destroy');
        });




        Route::prefix('categories')->as("categories.")->group(function (){
            Route::get('/' , [\App\Http\Controllers\CategoriesController::class , 'index'])->name('index');
            Route::get('/create' , [\App\Http\Controllers\CategoriesController::class , 'create'])->name('create');
            Route::post('/store' , [\App\Http\Controllers\CategoriesController::class , 'store'])->name('store');
            Route::get('/{category}/edit' , [\App\Http\Controllers\CategoriesController::class , 'edit'])->name('edit');
            Route::post('/{category}/update' , [\App\Http\Controllers\CategoriesController::class , 'update'])->name('update');
            Route::get('/{category}/delete' , [\App\Http\Controllers\CategoriesController::class , 'destroy'])->name('destroy');
        });

        Route::prefix('subcategories')->as("subcategories.")->group(function (){
            Route::get('/' , [\App\Http\Controllers\SubCategoriesController::class , 'index'])->name('index');
            Route::get('/create' , [\App\Http\Controllers\SubCategoriesController::class , 'create'])->name('create');
            Route::post('/store' , [\App\Http\Controllers\SubCategoriesController::class , 'store'])->name('store');
            Route::get('/{subCategory}/edit' , [\App\Http\Controllers\SubCategoriesController::class , 'edit'])->name('edit');
            Route::post('/{subCategory}/update' , [\App\Http\Controllers\SubCategoriesController::class , 'update'])->name('update');
            Route::get('/{subCategory}/delete' , [\App\Http\Controllers\SubCategoriesController::class , 'destroy'])->name('destroy');
        });

        Route::prefix('subsubcategories')->as("subsubcategories.")->group(function (){
            Route::get('/' , [\App\Http\Controllers\SubSubCategoriesController::class , 'index'])->name('index');
            Route::get('/create' , [\App\Http\Controllers\SubSubCategoriesController::class , 'create'])->name('create');
            Route::post('/store' , [\App\Http\Controllers\SubSubCategoriesController::class , 'store'])->name('store');
            Route::get('/{subSubCategory}/edit' , [\App\Http\Controllers\SubSubCategoriesController::class , 'edit'])->name('edit');
            Route::post('/{subSubCategory}/update' , [\App\Http\Controllers\SubSubCategoriesController::class , 'update'])->name('update');
            Route::get('/{subSubCategory}/delete' , [\App\Http\Controllers\SubSubCategoriesController::class , 'destroy'])->name('destroy');
        });

        Route::prefix('items')->as("items.")->group(function (){
            Route::get('/' , [\App\Http\Controllers\ItemsController::class , 'index'])->name('index');
            Route::get('/create' , [\App\Http\Controllers\ItemsController::class , 'create'])->name('create');
            Route::post('/store' , [\App\Http\Controllers\ItemsController::class , 'store'])->name('store');
            Route::get('/{item}/sponsored' , [\App\Http\Controllers\ItemsController::class , 'sponsored'])->name('sponsored');
            Route::get('/{item}/stop-sponsored' , [\App\Http\Controllers\ItemsController::class , 'stopSponsored'])->name('stopSponsored');
            Route::get('/{item}/edit' , [\App\Http\Controllers\ItemsController::class , 'edit'])->name('edit');
            Route::post('/{item}/update' , [\App\Http\Controllers\ItemsController::class , 'update'])->name('update');
            Route::get('/{item}/delete' , [\App\Http\Controllers\ItemsController::class , 'destroy'])->name('destroy');
        });


        Route::prefix('coinpacks')->as("coinpacks.")->group(function (){
            Route::get('/' , [\App\Http\Controllers\CoinPacksController::class , 'index'])->name('index');
            Route::get('/create' , [\App\Http\Controllers\CoinPacksController::class , 'create'])->name('create');
            Route::post('/store' , [\App\Http\Controllers\CoinPacksController::class , 'store'])->name('store');
            Route::get('/{coinPack}/edit' , [\App\Http\Controllers\CoinPacksController::class , 'edit'])->name('edit');
            Route::post('/{coinPack}/update' , [\App\Http\Controllers\CoinPacksController::class , 'update'])->name('update');
            Route::get('/{coinPack}/delete' , [\App\Http\Controllers\CoinPacksController::class , 'destroy'])->name('destroy');
        });

        Route::prefix('users')->as("users.")->group(function (){
            Route::get('/' , [\App\Http\Controllers\UsersController::class , 'index'])->name('index');
            Route::get('/{user}/edit' , [\App\Http\Controllers\UsersController::class , 'edit'])->name('edit');
            Route::post('/{user}/update' , [\App\Http\Controllers\UsersController::class , 'update'])->name('update');
            Route::get('/{user}/banned' , [\App\Http\Controllers\UsersController::class , 'banned'])->name('banned');
            Route::get('/{user}/unbanned' , [\App\Http\Controllers\UsersController::class , 'unbanned'])->name('unbanned');
            Route::get('/{user}/make-admin' , [\App\Http\Controllers\UsersController::class , 'makeAdmin'])->name('makeAdmin');
            Route::get('/{user}/remove-admin' , [\App\Http\Controllers\UsersController::class , 'removeAdmin'])->name('removeAdmin');
            Route::get('/{user}/delete' , [\App\Http\Controllers\UsersController::class , 'destroy'])->name('destroy');
        });

        Route::prefix('pages')->as("pages.")->group(function (){
            Route::get('/' , [\App\Http\Controllers\PagesController::class , 'index'])->name('index');
            Route::get('/create' , [\App\Http\Controllers\PagesController::class , 'create'])->name('create');
            Route::post('/store' , [\App\Http\Controllers\PagesController::class , 'store'])->name('store');
            Route::get('/{page}/delete' , [\App\Http\Controllers\PagesController::class , 'destroy'])->name('destroy');
        });


    });

});
