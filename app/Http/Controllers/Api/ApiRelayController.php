<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Relay;
use Illuminate\Http\Request;

class ApiRelayController extends Controller
{
    public function data()
    {
        $query = Relay::all();

        return response()->json(['data' => $query]);
    }

    public function update($id)
    {
        $relay = Relay::findOrfail($id);

        if ($relay->status == 0) {
            // return response()->json(['message' =>  $user->name . ' status aktif.'], 401);
            $relay->update(['status' => 1]);
            return response()->json(['message' =>  $relay->name_relay . ' berhasil disimpan.'], 200);
        } else {
            $relay->update(['status' => 0]);
            return response()->json(['message' =>  $relay->name_relay . ' berhasil disimpan.'], 200);
        }
    }
}
