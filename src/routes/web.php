<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

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

Route::get('/register/step1', [WeightController::class, 'step1'])->name('register.step1');
Route::post('/register/step1', [WeightController::class, 'postStep1']);
Route::get('/register/step2', [WeightController::class, 'step2'])->name('register.step2');
Route::post('/register/step2', [WeightController::class, 'postStep2']);
Route::get('/login', [WeightController::class, 'showLoginForm'])->name('login');
Route::post('/login', [WeightController::class, 'login']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('auth')->group(function(){
    Route::get('/weight_logs', [WeightController::class, 'admin'])->name('admin');
    Route::post('/weight_logs/create', [WeightController::class, 'store'])->name('weight_logs.store');
    Route::post('/weight_logs/modal', [WeightController::class, 'showModalForm'])->name('weight_logs.modal');
    Route::get('/weight_logs/goal_setting', [WeightController::class, 'goal']);
    Route::post('/weight_logs/goal_setting', [WeightController::class, 'updateGoal'])->name('goal.update');
    Route::get('/weight_logs/search', [WeightController::class, 'search'])->name('weight_logs.search');
    Route::get('/weight_logs/{weightLogId}', [WeightController::class, 'detail'])->name('weight_logs.detail');
    Route::post('/weight_logs/{weightLogId}/update', [WeightController::class, 'update'])->name('weight_logs.update');
    Route::delete('/weight_logs/{weightLogId}/delete', [WeightController::class, 'destroy'])->name('weight_logs.destroy');
});
