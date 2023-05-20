<?php

namespace App\Http\Controllers;

use App\Models\Relay;
use Illuminate\Http\Request;

class RelayController extends Controller
{
    /** 
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('relay.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function data()
    {
        $query = Relay::all();

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('keterangan', function ($query) {
                if ($query->status == 0) {
                    return '
                       <p>
                        ' . $query->name_relay . ' Status Tidak Aktif
                       </p>
                    ';
                }
                return '
                       <p>
                        ' . $query->name_relay . ' Status Aktif
                       </p>
                    ';
            })
            ->addColumn('status', function ($query) {
                if ($query->status == 0) {
                    return '
                        <span class="badge badge-md badge-danger">Tidak Aktif</span>
                    ';
                }
                return '
                        <span class="badge badge-success">Aktif</span>
                    ';
            })
            ->addColumn('aksi', function ($query) {
                if ($query->status == 0) {
                    return '
                        <button onclick="updateStatus(`' . route('relay.update_status', $query->id) . '`, `' . $query->name_relay  . '`)" class="btn btn-sm btn-success"><i class="fas fa-check-circle"></i> Aktifkan!</button>
                    ';
                } else {
                    return '
                        <button onclick="updateStatus(`' . route('relay.update_status', $query->id) . '`, `' . $query->name_relay  . '`)" class="btn btn-sm btn-danger"><i class="fas fa-check-circle"></i> Non Aktifkan!</button>
                    ';
                }
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Relay $relay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Relay $relay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Relay $relay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Relay $relay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function updateStatus($id)
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
