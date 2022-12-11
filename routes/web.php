<?php

use App\Http\Controllers\LanguageController;
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

// Auth Routes
require __DIR__.'/auth.php';

Route::get('/', function () {
    return redirect('login');
});

/*
*
* Backend Routes
* These routes need view-backend permission
* --------------------------------------------------------------------
*/
Route::group(['namespace' => 'App\Http\Controllers\Backend', 'prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth']], function () {

    /**
     * Backend Dashboard
     * Namespaces indicate folder structure.
     */
    Route::get('/', 'BackendController@index')->name('home');
    Route::get('dashboard', 'BackendController@index')->name('dashboard');

    Route::group(['middleware' => ['permission:view_users']], function () {
        /*
        *
        *  Users Routes
        *
        * ---------------------------------------------------------------------
        */

        Route::get("users/index", ['as' => "users.index", 'uses' => "UserController@index"]);
        Route::get("users/index_data", ['as' => "users.index_data", 'uses' => "UserController@index_data"]);
        Route::get("users/changePassword/{id}", ['as' => "users.changePassword", 'uses' => "UserController@changePassword"]);
        Route::get("users/profile/{id}/edit", ['as' => "users.profileEdit", 'uses' => "UserController@profileEdit"]);

        Route::resource("users", "UserController");
    });

    Route::group(['middleware' => ['permission:view_alat_lab']], function () {

    });

});
