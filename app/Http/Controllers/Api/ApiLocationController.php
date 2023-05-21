<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class ApiLocationController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ];

        Location::create($data);

        return response()->json(['message', 'Berhasil tersimpan']);
    }

    public function storeData(Request $request, $latitude, $longitude)
    {
        $data = [
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];

        Location::create($data);

        return response()->json(['message', 'Berhasil tersimpan']);
    }

    public function getDataAll()
    {
        $location = Location::all();
        return response()->json(['data' => $location]);
    }
}
