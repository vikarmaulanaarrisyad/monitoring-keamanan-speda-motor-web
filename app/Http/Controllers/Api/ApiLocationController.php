<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiLocationController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ];

        // Location::create($data);
        Location::updateOrCreate(
            ['id' => 1],
            [
                'latitude' => $request->latitude,
                'longitude' =>  $request->longitude
            ]
        );


        return response()->json(['message', 'Berhasil tersimpan']);
    }

    public function storeData(Request $request, $latitude, $longitude)
    {
        // $data = [
        //     'latitude' => $latitude,
        //     'longitude' => $longitude,
        // ];

        Location::updateOrCreate(
            ['id' => 1],
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

        // if ($request->hasFile('photo')) {
        //     $file = $request->file('photo');
        //     $fileName = time() . '_' . $file->getClientOriginalName();
        //     $filePath = $file->storeAs('photos', $fileName, 'public');

        //     $location = Location::where('id', 1)->first(); // Menemukan entri lokasi berdasarkan nama (ganti 'nama' dengan kriteria yang sesuai)
        //     if ($location) {
        //         $location->gambar = $filePath; // Mengupdate kolom gambar dengan nilai baru
        //         $location->save(); // Menyimpan perubahan

        //         return response()->json([
        //             'message' => 'Photo updated successfully.',
        //             'location' => $location,
        //         ], 200);
        //     }
        // }

        // return response()->json(['message' => 'Photo update failed.'], 400);

        $location = Location::where('id', 1)->first();
        // $data = $request->except('photo');
        if ($request->hasFile('photo')) {
            if (Storage::disk('public')->exists($location->photo)) {
                Storage::disk('public')->delete($location->photo);
            }

            $data['photo'] = upload('campaign', $request->file('photo'), 'photo');
        }

        $location->update($data);
    }
}
