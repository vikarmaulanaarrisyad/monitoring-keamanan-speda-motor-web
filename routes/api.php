<?php

use App\Http\Controllers\Api\ApiLocationController;
use App\Http\Controllers\Api\ApiRelayController;
use App\Http\Controllers\Api\MapController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/relay/data', [ApiRelayController::class, 'data'])->name('api.relay_data');
Route::get('/relay/{id}/update', [ApiRelayController::class, 'update'])->name('api.relay_update');

Route::get('/location/data',[ApiLocationController::class, 'getDataAll']);
Route::post('/location/kirim_data',[ApiLocationController::class, 'store']);
Route::GET('/location/{latitude}/{longitude}/kirim_data',[ApiLocationController::class, 'storeData']);
Route::post('/upload-image', function (Request $request) {
    // Validasi request
    $request->validate([
        'image' => 'required|string',
    ]);

    // Ambil data gambar dari request
    $imageData = $request->input('image');

    // Decode base64 menjadi binary data
    $imageBinary = base64_decode($imageData);

    // Generate nama unik untuk gambar
    $imageName = uniqid() . '.jpg';

    // Simpan gambar ke penyimpanan (misalnya storage/app/public)
    Storage::disk('public')->put($imageName, $imageBinary);

    // Generate URL gambar untuk respon
    $imageUrl = Storage::disk('public')->url($imageName);

    // Respon dengan URL gambar
    return response()->json([
        'image_url' => $imageUrl,
    ]);
});


