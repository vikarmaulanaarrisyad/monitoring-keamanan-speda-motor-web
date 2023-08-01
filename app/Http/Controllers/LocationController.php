<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('location.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function data()
    {
        $query = Location::all();

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('tanggal', function ($query) {
                return tanggal_indonesia($query->created_at);
            })
            ->addColumn('waktu', function ($query) {
                return Carbon::parse($query->updated_at)->diffForHumans();
            })
            ->addColumn('lokasi', function ($query) {
                //
            })
            ->addColumn('gambar', function ($query) {
                return '
                    <img src="' . Storage::url($query->gambar) . '" class="img-thumbnail">
                ';
            })
            ->addColumn('aksi', function ($query) {
                return '
                    <div class="btn-group">
                        <a target="_blank" href="' . url('http://maps.google.com/maps?&z=15&mrt=yp&t=k&q=' . $query->latitude . '+' . $query->longitude . '') . '" class="btn btn-sm btn-success"><i class="fas fa-map-marker-alt"></i> Maps</a>
                        <button onclick="deleteData(`' . route('location.destroy', $query->id) . '`)" class="btn btn-sm btn-danger"> <i class="fas fa-trash-alt"></i>Hapus</button>
                    </div>
                    ';
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
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function detail($id)
    {
        return view('location.detail');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {

        if (Storage::disk('public')->exists($location->gambar)) {
            Storage::disk('public')->delete($location->gambar);
        }

        $location->delete();

        return response()->json(['data' => null, 'message' => 'Lokasi berhasil dihapus']);
    }
}
