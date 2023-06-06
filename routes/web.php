<?php

use App\Http\Controllers\{
    DashboardController,
    LocationController,
    RelayController,
    SettingController,
    VehicleController
};
use App\Http\Controllers\Api\MapController;
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
    return view('auth.login');
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

        Route::get('/location/data', [LocationController::class, 'data'])->name('location.data');
        Route::resource('/location', LocationController::class);
        Route::get('/location/detail/{id}', [LocationController::class, 'detail'])->name('location.detail');

        Route::get('/markers', [MapController::class, 'getMarkers'])->name('marker');

        Route::get('/setting', [SettingController::class, 'index'])
        ->name('setting.index');
        Route::put('/setting/{setting}', [SettingController::class, 'update'])
        ->name('setting.update');
    });
});
