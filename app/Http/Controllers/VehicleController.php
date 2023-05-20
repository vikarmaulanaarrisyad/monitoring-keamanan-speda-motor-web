<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource by datatables.
     */
    public function data()
    {
        $query = Vehicle::all();

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('kendaraan.show', $query->id) . '`)" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i> Edit</button>
                    <button onclick="deleteData(`' . route('kendaraan.destroy', $query->id) . '`, `' . $query->merk  . ' ' . 'Nomor ' . $query->plat_number . '`)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                </div>
                ';
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kendaraan.index');
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
        $validator = Validator::make($request->all(), [
            'merk' => 'required',
            'plat_number' => 'required',
            'name_of_the_owner' => 'required',
        ], [
            'merk.required' => 'Merk kendaraan tidak boleh kosong.',
            'plat_number.required' => 'Nomor plat kendaraan tidak boleh kosong.',
            'name_of_the_owner.required' => 'Nama pemilik kendaraan tidak boleh kosong.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Silakan periksa kembali isian Anda dan coba kembali.'], 422);
        }

        $data = [
            'merk' => $request->merk,
            'plat_number' => $request->plat_number,
            'name_of_the_owner' => $request->name_of_the_owner,
        ];

        Vehicle::create($data);

        return response()->json(['message' => 'Data berhasil disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
