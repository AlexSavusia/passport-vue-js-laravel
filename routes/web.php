<?php

use App\Http\Controllers\Registration\ConfirmRegistrationController;
use App\Http\Controllers\Registration\TempRegistrationController;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Psr\Http\Message\RequestInterface;

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
Route::group(
    [
        'namespace' => 'App\Http\Controllers',
        'as' => 'auth.redirect.',
        'middleware' => ['auth.check'],
    ],
    function () {
        Route::get('/', 'AuthRedirectController@showForm')->name('show');
        Route::post('/', 'AuthRedirectController@redirect')->name('do');
    }
);

Route::group(
    [
        'prefix' => 'auth',
        'namespace' => 'App\Http\Controllers\Auth',
        'as' => 'auth.',
    ],
    function () {
        Route::group(
            [
                'middleware' => ['auth.check'],
            ]
        , function () {
            Route::get('login', 'LoginController@index')
                ->name('login');
            Route::post('login', 'LoginController@login')
                ->middleware("throttle:7,5")
                ->name('action');

            Route::get('login/{provider}', 'FederalLoginController@redirectToProvider')
                ->name('federal-login.redirect');
            Route::any('login/{provider}/callback', 'FederalLoginController@login')
                ->middleware("throttle:7,5")
                ->name('federal-login.callback');
        });

        Route::get('logout', 'LogoutController@logout');
    }
);

Route::group(
    [
        'prefix' => 'registration',
        'namespace' => 'App\Http\Controllers\Registration',
        'as' => 'registration.',
        'middleware' => ['guest'],
    ],
    function () {
        Route::get('/', 'RegistrationController@showForm')
            ->name('show-form');
        Route::post('/', TempRegistrationController::class)
            ->middleware('ajax.throttle:25,1', 'reg.throttle')
            ->name('temp');
        Route::get('/confirm', ConfirmRegistrationController::class)
            ->name('confirm');
    }
);

Route::group(
    [
        'prefix' => 'password',
        'namespace' => 'App\Http\Controllers\Auth',
        'as' => 'password.',
        'middleware' => ['guest'],
    ],
    function () {
        Route::get('/forget', 'ResetPasswordController@showForgetPasswordForm')
            ->name('forget-form');
        Route::post('/forget', 'ResetPasswordController@forget')
            ->name('forget-action');

        Route::get('/reset/{token}', 'ResetPasswordController@showResetPasswordForm')
            ->name('reset-from');
        Route::post('/reset', 'ResetPasswordController@reset')
            ->name('reset-action');
    }
);
