<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Location;
use Illuminate\Http\Request;

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
                return Carbon::parse($query->created_at)->diffForHumans();
            })
            ->addColumn('lokasi', function ($query) {
                //
            })
            ->addColumn('aksi', function ($query) {
                return '
                    <div class="btn-group">
                        <a target="_blank" href="'.url('http://maps.google.com/maps?&z=15&mrt=yp&t=k&q='.$query->latitude.'+'.$query->longitude.'').'" class="btn btn-sm btn-success"><i class="fas fa-map-marker-alt"></i> Lihat Google Maps</a>
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
        return view ('location.detail');
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
        //
    }
}
