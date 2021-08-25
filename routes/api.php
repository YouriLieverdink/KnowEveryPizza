<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\MatchController;

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
    Route::group(['prefix' => 'auth'], function () {

        /* Register with invitation code */
        Route::post('register', [AuthenticationController::class, 'register']);

        /* Request code via email and login */
        Route::post('request-login', [AuthenticationController::class, 'requestLogin']);
        Route::post('login', [AuthenticationController::class, 'login']);
    });

    /* Routes protected by authentication */
    Route::group(['middleware' => 'auth:sanctum'], function () {

        /* Routes protected by the 'database' role. */
        Route::group(['middleware' => 'role:database'], function () {

            Route::apiResource('ingredients', IngredientController::class);
            Route::apiResource('products', ProductController::class);
            Route::apiResource('categories', CategoryController::class);
        });

        /* Routes protected by the 'admin' role. */
        Route::group(['middleware' => 'role:admin'], function () {

            Route::apiResource('invitations', InvitationController::class);
        });

        /* Routes used for the match */
        Route::group(['prefix' => 'match'], function () {

            Route::post('new', [MatchController::class, 'new']);
        });
    });
});
