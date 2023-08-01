<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiLocationController extends Controller
{
    public function store(Request $request)
    {

        $data = [
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ];

        $rules = [
            'latitude' => 'required',
            'longitude' => 'required',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Data gagal tersimpan'
            ], 422);
        }

        Location::updateOrCreate(
            ['latitude' => $request->latitude],
            [
                'latitude' => $request->latitude,
                'longitude' => $request->longitude
            ]
        );

        return response()->json(['message', 'Berhasil tersimpan']);
    }

    public function storeData(Request $request, $latitude, $longitude)
    {
        $data = [
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];

        $rules = [
            'latitude' => 'required',
            'longitude' => 'required',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Data gagal tersimpan'], 422);
        }

        $cekLocation = Location::latest()->first();

        if ($cekLocation->latitude == $latitude) {
            return response()->json(['message' => 'Data latitude masih sama'], 422);
        }

        Location::updateOrCreate(
            ['latitude' => $latitude],
            [
                'latitude' => $latitude,
                'longitude' => $longitude
            ]
        );

        return response()->json(['message', 'Berhasil tersimpan']);
    }

    public function getDataAll()
    {
        $location = Location::all();
        return response()->json(['data' => $location]);
    }

    public function uploadPhoto(Request $request)
    {
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('photos', $fileName, 'public');

            $location = Location::latest()->first(); // ambil data terakhir

            if (Storage::disk('public')->exists($location->gambar)) {
                Storage::disk('public')->delete($location->gambar);
            }

            $location->gambar = $filePath; // Mengupdate kolom gambar dengan nilai baru
            $location->save(); // Menyimpan perubahan

            return response()->json([
                'message' => 'Photo updated successfully.',
                'location' => $location,
            ], 200);
        }
        return response()->json(['message' => 'Photo update failed.'], 400);
    }
}
