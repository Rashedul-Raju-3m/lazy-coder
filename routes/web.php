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

Route::prefix('{locale}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->middleware('setlocale')
    ->group(function () {

    Route::get('/admin-dashboard', [HomeController::class, 'index'])->name('admin-dashboard');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
