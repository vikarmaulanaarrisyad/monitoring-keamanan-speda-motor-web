<?php

use App\Http\Controllers\{
    DashboardController,
    LocationController,
    RelayController,
    VehicleController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group([
    'middleware' => ['auth', 'role:admin,user'],
], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //
    Route::group([
        'middleware' => 'role:admin',
    ], function () {
        //route Kendaraan
        Route::get('kendaraan/data', [VehicleController::class, 'data'])->name('kendaraan.data');
        Route::resource('/kendaraan', VehicleController::class);

        Route::get('/relay/data', [RelayController::class, 'data'])->name('relay.data');
        Route::resource('/relay', RelayController::class);
        Route::put('/relay/{id}/update-status', [RelayController::class, 'updateStatus'])->name('relay.update_status');

        Route::get('/location/data',[LocationController::class, 'data'])->name('location.data');
        Route::resource('/location', LocationController::class);
        Route::get('/location/detail/{id}',[LocationController::class, 'detail'])->name('location.detail');
    });
});
