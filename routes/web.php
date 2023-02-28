<?php

use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
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

/*Corriger les redirect dans controllers->Auth et Register
ajouter available_locales dans config->app 
*/

Route::get('/', function () {
    return redirect(app()->getLocale());
});


Route::prefix('{locale}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->middleware('setlocale') 
    ->group(function () {
    
        Route::get('/',[PostController::class,'index'])->name('posts.index');

        Route::middleware(['auth'])->group(function () {
            Route::resource('posts',PostController::class)->except('index');
            Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

            Route::middleware(['admin'])->name('admin.')->prefix('admin')->group(function () {
                Route::resource('posts',AdminPostController::class);
            });
        });

        require __DIR__.'/auth.php';

});


/* Route::group(['middleware' => ['auth']], function(){
    Route::resource('posts',PostController::class)->except('index');
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
}); */
