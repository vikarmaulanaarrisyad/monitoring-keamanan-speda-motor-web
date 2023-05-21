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

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="map"></div>
                </div>
            </div>

        </div>
    </div>
@endsection
{{-- @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var map = L.map('map').setView([-6.916022, 109.158922], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // var popup = L.popup()
        //     .setLatLng([-6.916022, 109.158922])
        //     .setContent("I am a standalone popup.")
        //     .openOn(map);

        function getMarkers() {
            $.ajax({
                url: '/markers',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    data.forEach((location, index) => {
                        var marker = L.marker([location.latitude, location.longitude]).addTo(map);

                        var latlngs = data.map(loc => [loc.latitude, loc.longitude]);

                        if (index === data.length - 1) {
                            animateMarker(marker, latlngs, 1000);
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        function animateMarker(marker, latlngs, duration) {
            var currentIndex = 0;
            var totalSteps = latlngs.length;

            function animateStep() {
                if (currentIndex === totalSteps) {
                    return;
                }

                marker.setLatLng(latlngs[currentIndex]);
                currentIndex++;

                setTimeout(animateStep, duration);
            }

            animateStep();
        }

        getMarkers();
    </script>


@endpush --}}

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var map = L.map('map').setView([-6.916022, 109.158922], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        function getMarkers() {
            $.ajax({
                url: '/markers',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length > 0) {
                        var location = data[0];
                        var marker = L.marker([location.latitude, location.longitude]).addTo(map);

                        var latlngs = data.map(loc => [loc.latitude, loc.longitude]);

                        animateMarker(marker, latlngs, 1000);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        function animateMarker(marker, latlngs, duration) {
            var currentIndex = 0;
            var totalSteps = latlngs.length;

            function animateStep() {
                if (currentIndex === totalSteps) {
                    return;
                }

                marker.setLatLng(latlngs[currentIndex]);
                currentIndex++;

                setTimeout(animateStep, duration);
            }

            animateStep();
        }

        getMarkers();
    </script>
@endpush
