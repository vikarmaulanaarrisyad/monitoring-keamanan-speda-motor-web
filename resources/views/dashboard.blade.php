@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
    @parent
    {{-- <li class="breadcrumb-item active"></li> --}}
@endsection


@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-motorcycle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Jumlah kendaraan</span>
                    <span class="info-box-number">
                        10
                        <small>Unit</small>
                    </span>
                </div>

            </div>

        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-map-marker-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Lokasi</span>
                    <span class="info-box-number">6</span>
                </div>

            </div>
        </div>
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-table"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Histori</span>
                    <span class="info-box-number">4</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pengguna</span>
                    <span class="info-box-number">2</span>
                </div>

            </div>
        </div>
    </div>

@endsection
