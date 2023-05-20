@extends('layouts.app')

@section('title', 'Detail Lokasi')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Detail Lokasi</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-8 col-lg-8">
            <x-card>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered" width="100">
                            <thead>
                                <tr>
                                    <th>Latitude</th>
                                    <th>:</th>
                                    <th>{{ $location->latitude }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </x-card>
        </div>
    </div>
@endsection
