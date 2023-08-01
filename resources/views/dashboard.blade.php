@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
    @parent
    {{-- <li class="breadcrumb-item active"></li> --}}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Realtime Lokasi Kendaraan</h5>
                </div>
                <div class="card-body">
                    <div id="map"></div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>

    <script>
        var map = L.map('map').setView([-6.91602, 109.15892], 12.30);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var marker = null;
        var previousLatitude = null;

        function getLocations() {
            $.ajax({
                url: '{{ route('marker') }}',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    var location = data[0];

                    // Memeriksa perubahan latitude
                    if (location.latitude !== previousLatitude) {
                        updateMarker(location.latitude, location.longitude);
                        previousLatitude = location.latitude;
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        function updateMarker(latitude, longitude) {
            // Menghapus marker sebelumnya jika ada
            if (marker) {
                map.removeLayer(marker);
            }

            // Mendapatkan nama lokasi berdasarkan latitude dan longitude
            var latlng = L.latLng(latitude, longitude);
            var geocodeUrl = 'https://nominatim.openstreetmap.org/reverse?lat=' + latlng.lat + '&lon=' + latlng.lng +
                '&format=jsonv2';

            // Mengirim permintaan geocoding
            $.ajax({
                url: geocodeUrl,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    var address = data.display_name;

                    // Tambahkan marker dengan popup yang berisi nama lokasi
                    marker = L.marker(latlng).addTo(map);
                    marker.bindPopup(address).openPopup();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // Perbarui lokasi setiap 5 detik
        setInterval(getLocations, 5000);

        // Pertama kali, ambil lokasi saat halaman dimuat
        getLocations();
    </script>
@endpush




{{-- @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>

    <script>
        var map = L.map('map').setView([-6.91602, 109.15892], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var markers = [];

        function getLocations() {
            $.ajax({
                url: '{{ route("marker") }}',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    updateMarkers(data);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        function updateMarkers(locations) {
            // Hapus semua penanda yang ada
            markers.forEach(function(marker) {
                map.removeLayer(marker);
            });

            markers = [];

            // Tambahkan penanda baru untuk setiap lokasi
            locations.forEach(function(location) {
                // Mendapatkan nama lokasi berdasarkan latitude dan longitude
                var latlng = L.latLng(location.latitude, location.longitude);
                var geocodeUrl = 'https://nominatim.openstreetmap.org/reverse?lat=' + latlng.lat + '&lon=' + latlng.lng + '&format=jsonv2';

                // Mengirim permintaan geocoding
                $.ajax({
                    url: geocodeUrl,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var address = data.display_name;

                        // Tambahkan marker dengan popup yang berisi nama lokasi
                        var marker = L.marker(latlng).addTo(map);
                        marker.bindPopup(address).openPopup();
                        markers.push(marker);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        }

        // Perbarui lokasi setiap 5 detik
        setInterval(getLocations, 5000);

        // Pertama kali, ambil lokasi saat halaman dimuat
        getLocations();
    </script>
@endpush --}}
