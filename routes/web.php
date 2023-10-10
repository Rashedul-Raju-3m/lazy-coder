<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
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

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);

    $segments = str_replace(url('/'), '', url()->previous());
    $segments = array_filter(explode('/', $segments));
    array_shift($segments);
    array_unshift($segments, $locale);

    return redirect()->to(implode('/', $segments));
})->name('language_switcher');

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::group(['prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => 'setlocale'], function() {

    Route::get('/admin-dashboard', [HomeController::class, 'index'])->name('admin-dashboard');

    Route::get('/home', [HomeController::class, 'index'])->name('home');


    //Role Route start
    /*Route::get('role/add', [
        'as' => 'role_add',
        'uses' => 'App\Http\Controllers\RoleController@create'
    ]);

    Route::get('role/list', [
        'as' => 'role_list',
        'uses' => 'App\Http\Controllers\RoleController@index'
    ]);

    Route::post('role/store',[
        'as' => 'role_store',
        'uses' => 'App\Http\Controllers\RoleController@store'
    ]);

    Route::get('role/edit/{id}',[
        'as' => 'role_edit',
        'uses' => 'App\Http\Controllers\RoleController@edit'
    ]);

    Route::PATCH('role/update/{id}',[
        'as' => 'role_update',
        'uses' => 'App\Http\Controllers\RoleController@update'
    ]);

    Route::get('admin-role-inactive/{id}',[
        'as' => 'admin.role.inactive',
        'uses' => 'App\Http\Controllers\RoleController@inactive'
    ]);

    Route::get('role/delete/{id}',[
        'as' => 'role_delete',
        'uses' => 'App\Http\Controllers\RoleController@roleDelete'
    ]);*/

//Role Route end

//ROUTE USER START
    /*Route::get('/user/list',[UserController::class, 'index'])->name('user_list');
    Route::get('/user/add',[UserController::class, 'create'])->name('user_add');
    Route::POST('/user/store',[UserController::class, 'store'])->name('user_store');
    Route::PATCH('/user/update/{id}',[UserController::class, 'update'])->name('user_update');
    Route::get('/user/edit/{id}',[UserController::class, 'edit'])->name('user_edit');
    Route::get('/user/delete/{id}',[UserController::class, 'destroy'])->name('user_delete');
    Route::get('/user/reset-password', [UserController::class, 'resetPassword'])->name('user_reset_password');
    Route::post('/user/password/store', [UserController::class, 'resetPasswordStore'])->name('user_password_store');*/

//ROUTE USER END



});
