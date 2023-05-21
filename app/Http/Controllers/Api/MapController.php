<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function getMarkers()
    {
        $locations = Location::all();

        $markers = [];
        foreach ($locations as $location) {
            $markers[] = [
                'latitude' => $location->latitude,
                'longitude' => $location->longitude,
            ];
        }

        return response()->json($markers);
    }
}
