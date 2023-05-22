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
        // Check if a file is uploaded
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('photos', $fileName);

            // Delete old photo if it exists
            $oldPhoto = $request->input('old_photo');
            if ($oldPhoto) {
                Storage::delete('photos/' . $oldPhoto);
            }

            return response()->json([
                'message' => 'Photo uploaded successfully',
                'gambar' => $fileName
            ], 200);
        }

        return response()->json([
            'message' => 'No photo uploaded'
        ], 400);
    }
}
