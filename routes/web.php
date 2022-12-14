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

Route::get('/', function () {
    return redirect('login');
});

Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {
    Route::get('login', ['uses' => 'AuthenticatedSessionController@create'])->name('login');

    Route::post('login', ['uses' => 'AuthenticatedSessionController@store']);

    Route::group(['middleware' => ['auth']], function () {
        Route::get('logout', ['uses' => 'AuthenticatedSessionController@destroy'])->name('logout');
    });
});

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
        Route::get("users/profile/{id}", ['as' => "users.profile", 'uses' => "UserController@profile"]);
        Route::patch("users/changePassword/{id}", ['as' => "users.changePasswordUpdate", 'uses' => "UserController@changePasswordUpdate"]);

        Route::resource("users", "UserController");
    });

    Route::group([], function () {
        /*
        *
        *  Alat Lab Routes
        *
        * ---------------------------------------------------------------------
        */

        Route::get("alat/index", ['as' => "alat.index", 'uses' => "AlatController@index"]);
        Route::get("alat/index_data", ['as' => "alat.index_data", 'uses' => "AlatController@index_data"]);

        Route::resource("alat", "AlatController");
    });

    Route::group([], function () {
        /*
        *
        *  Bahan Lab Routes
        *
        * ---------------------------------------------------------------------
        */

        Route::get("bahan/index", ['as' => "bahan.index", 'uses' => "BahanController@index"]);
        Route::get("bahan/index_data", ['as' => "bahan.index_data", 'uses' => "BahanController@index_data"]);

        Route::resource("bahan", "BahanController");
    });

    Route::group([], function () {
        /*
        *
        *  Alat Pecah Routes
        *
        * ---------------------------------------------------------------------
        */

        Route::get("alat_pecah/index", ['as' => "alat_pecah.index", 'uses' => "AlatPecahController@index"]);
        Route::get("alat_pecah/index_data", ['as' => "alat_pecah.index_data", 'uses' => "AlatPecahController@index_data"]);

        Route::resource("alat_pecah", "AlatPecahController");
    });

    Route::group([], function () {
        /*
        *
        *  Peminjaman Routes
        *
        * ---------------------------------------------------------------------
        */

        Route::get("peminjam/index", ['as' => "peminjam.index", 'uses' => "PeminjamController@index"]);
        Route::get("peminjam/index_data", ['as' => "peminjam.index_data", 'uses' => "PeminjamController@index_data"]);

        Route::resource("peminjam", "PeminjamController");
    });

    Route::group([], function () {
        /*
        *
        *  History Peminjaman Routes
        *
        * ---------------------------------------------------------------------
        */

        Route::get("history_peminjam/index", ['as' => "history_peminjam.index", 'uses' => "HistoryPeminjamController@index"]);
        Route::get("history_peminjam/index_data", ['as' => "history_peminjam.index_data", 'uses' => "HistoryPeminjamController@index_data"]);

        Route::resource("history_peminjam", "HistoryPeminjamController");
    });

    Route::group([], function () {
        /*
        *
        *  Jadwal Routes
        *
        * ---------------------------------------------------------------------
        */

        Route::get("jadwal/index", ['as' => "jadwal.index", 'uses' => "JadwalController@index"]);
        Route::get("jadwal/index_data", ['as' => "jadwal.index_data", 'uses' => "JadwalController@index_data"]);

        Route::resource("jadwal", "JadwalController");
    });


});
