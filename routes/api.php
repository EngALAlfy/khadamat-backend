<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// v1 of api
Route::prefix('v1')->as('api.v1.')->group(function () {

    Route::get('/pages/{page}', [App\Http\Controllers\api\v1\PagesController::class, 'show'])->name('page');

    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'apiLogin'])->name('login');
    Route::post('/login/phone', [App\Http\Controllers\Auth\LoginController::class, 'apiPhoneLogin'])->name('login');
    Route::post('/login/google', [App\Http\Controllers\Auth\LoginController::class, 'apiGoogleLogin'])->name('login.google');
    Route::post('/login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'apiFacebookLogin'])->name('login.facebook');
    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'apiRegister'])->name('register');
    Route::post('/register/google', [App\Http\Controllers\Auth\RegisterController::class, 'apiGoogleRegister'])->name('register.google');
    Route::post('/register/facebook', [App\Http\Controllers\Auth\RegisterController::class, 'apiFacebookRegister'])->name('register.facebook');
    Route::post('/reset-password', [App\Http\Controllers\Auth\LoginController::class, 'apiResetPassword'])->name('reset.password');
    Route::post('/change-password', [App\Http\Controllers\Auth\LoginController::class, 'apiChangePassword'])->name('reset.password');

    Route::get('/user/items/{id}', [App\Http\Controllers\api\v1\ProfileController::class, 'userItems'])->name('users.items');
    Route::get('/user/{id}', [App\Http\Controllers\api\v1\ProfileController::class, 'getUser'])->name('users.get');

    Route::get('/items/show/{id}', [App\Http\Controllers\api\v1\ItemsController::class, 'show'])->name('items.get');

    Route::middleware(['auth:api', 'isBanned'])->group(function () {
        Route::get('/categories/select', [App\Http\Controllers\api\v1\CategoriesController::class, 'select'])->name('categories.select');
        Route::get('/subcategories/select/{category}', [App\Http\Controllers\api\v1\SubCategoriesController::class, 'select'])->name('subcategories.select');
        Route::get('/subsubcategories/select/{subCategory}', [App\Http\Controllers\api\v1\SubSubCategoriesController::class, 'select'])->name('subsubcategories.select');


        Route::get('/items/stop-sponsored/{item}', [App\Http\Controllers\api\v1\ItemsController::class, 'stopSponsored'])->name('items.stopSponsored');

        Route::get('/items/archive/{item}', [App\Http\Controllers\api\v1\ProfileController::class, 'archive'])->name('items.archive');
        Route::get('/items/unarchive/{item}', [App\Http\Controllers\api\v1\ProfileController::class, 'unarchive'])->name('items.unarchive');
        Route::post('/items/update/{id}', [App\Http\Controllers\api\v1\ItemsController::class, 'update'])->name('items.update');

        Route::get('/items/start-sponsored/{item}', [App\Http\Controllers\api\v1\ItemsController::class, 'startSponsored'])->name('items.startSponsored');


        //Route::get('/subcategories/sponsored/{id}', [App\Http\Controllers\api\v1\SubCategoriesController::class, 'showSponsored'])->name('subcategories.sponsored');


        Route::get('/phone-verified', [App\Http\Controllers\api\v1\ProfileController::class, 'apiPhoneVerified'])->name('phone.verified');

        Route::get('/profile', [App\Http\Controllers\api\v1\ProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile/phone', [App\Http\Controllers\api\v1\ProfileController::class, 'phone'])->name('profile.phone');
        Route::get('/profile/check', [App\Http\Controllers\api\v1\ProfileController::class, 'check'])->name('profile.check');
        Route::get('/profile/items', [App\Http\Controllers\api\v1\ProfileController::class, 'items'])->name('profile.items');
        Route::get('/profile/archived', [App\Http\Controllers\api\v1\ProfileController::class, 'archived'])->name('profile.archived');
        Route::get('/profile/items/delete/{item}', [App\Http\Controllers\api\v1\ProfileController::class, 'deleteItem'])->name('profile.delete_item');
        Route::post('/profile/update', [App\Http\Controllers\api\v1\ProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile/update/photo', [App\Http\Controllers\api\v1\ProfileController::class, 'updatePhoto'])->name('profile.update.photo');
        Route::post('/profile/update/name', [App\Http\Controllers\api\v1\ProfileController::class, 'updateName'])->name('profile.update.name');
        Route::post('/profile/add/points', [App\Http\Controllers\api\v1\ProfileController::class, 'addPoints'])->name('profile.points.add');

        Route::get('/coinPacks', [App\Http\Controllers\api\v1\CoinPacksController::class, 'index'])->name('coinPacks.index');

        Route::apiResource('items' , \App\Http\Controllers\api\v1\ItemsController::class,);

    });


    Route::get('/subcategories', [App\Http\Controllers\api\v1\SubCategoriesController::class, 'index'])->name('subcategories.index');
    Route::get('/subcategories/{category_id}/{subcategory_id}', [App\Http\Controllers\api\v1\SubCategoriesController::class, 'show'])->name('subcategories.show');

    Route::get('/subsubcategories', [App\Http\Controllers\api\v1\SubSubCategoriesController::class, 'index'])->name('subsubcategories.index');
    Route::get('/subsubcategories/{category_id}/{subcategory_id}/{subsubcategory_id}', [App\Http\Controllers\api\v1\SubSubCategoriesController::class, 'show'])->name('subsubcategories.show');

    Route::get('/items/search/{searchTerm}', [App\Http\Controllers\api\v1\ItemsController::class, 'search'])->name('items.search');
    Route::get('/items/subsubcategory/search/{subsubcategory_id}/{searchTerm}', [App\Http\Controllers\api\v1\ItemsController::class, 'searchCategory'])->name('items.searchCategory');

    Route::get('/films/categories', [App\Http\Controllers\api\v1\FilmCategoryController::class, 'index'])->name('films.categories.index');
    Route::get('/films/get/{category_id}', [App\Http\Controllers\api\v1\FilmController::class, 'index'])->name('films.index');

    Route::get('/series/categories', [App\Http\Controllers\api\v1\SeriesCategoryController::class, 'index'])->name('series.categories.index');
    Route::get('/series/get/{category_id}', [App\Http\Controllers\api\v1\SeriesController::class, 'index'])->name('series.index');
    Route::get('/series/episodes/{series_id}', [App\Http\Controllers\api\v1\SeriesEpisodeController::class, 'index'])->name('series.episodes.index');

    Route::apiResources([
        'categories' => \App\Http\Controllers\api\v1\CategoriesController::class,
    ], ['except' => ['store', 'update', 'destroy']]);



});
