<?php

use App\Http\Controllers\MatchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\AuthenticationController;
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

Route::group(['prefix' => 'v1'], function () {

    /* Routes used for authentication */
    Route::group(['prefix' => 'authentication'], function () {

        /* Register with invitation code */
        Route::post('register', [AuthenticationController::class, 'register']);

        /* Request code via email and login */
        Route::post('request-login', [AuthenticationController::class, 'requestLogin']);
        Route::post('login', [AuthenticationController::class, 'login']);
    });

    /* Routes protected by authentication */
    Route::group(['middleware' => 'auth:sanctum'], function () {

        /* Resources used for managing the database */
        Route::apiResources([
            'ingredients' => IngredientController::class,
            'products' => ProductController::class,
            'categories' => CategoryController::class,
        ], [
            'middleware' => 'role:database',
        ]);

        /* Resources used for managing the invitations */
        Route::apiResources([
            'invitations' => InvitationController::class,
        ], [
            'middleware' => 'role:invitations',
        ]);

        /* Routes used for the guessing game */
        Route::post('match', MatchController::class);
    });
});
