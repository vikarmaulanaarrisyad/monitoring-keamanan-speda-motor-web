@extends('layouts.app')

@section('title', 'Management Sensor')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Management Sensor</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-12 col-lg-12">
            <x-card>
                <x-table class="table-sensor">
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>
   
    {{-- @include('kendaraan.form') --}}
@endsection

@include('includes.datatables')

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('#spinner-border').hide()
        });
    </script>
@endpush

@push('scripts')
    <script type="text/javascript">
        let modal = '#modal-form';
        let table;

        table = $('.table-sensor').DataTable({
            processing: true,
            autoWidth: false,
            serverSide: true,
            ajax: {
                url: '{{ route('relay.data') }}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'name_relay'
                },
                {
                    data: 'keterangan'
                },
                {
                    data: 'status'
                },


                {
                    data: 'aksi',
                    searchable: false,
                    sortable: false
                },
            ]
        });
    </script>
@endpush

@push('scripts')
    <script>
        function updateStatus(url, name) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })
            swalWithBootstrapButtons.fire({
                title: 'Apakah anda yakin?',
                text: 'Ubah status ' + name +
                    ' !',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'rgb(48, 133, 214)',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Ya, ubah status !',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(url, {
                            '_method': 'put'
                        })
                        .done(response => {
                            if (response.status = 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                table.ajax.reload();
                            }
                        })
                        .fail(errors => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Opps! Gagal!',
                                text: errors.responseJSON.message,
                                showConfirmButton: false,
                                timer: 2000
                            })
                            table.ajax.reload();
                        });
                }
            })
        }
    </script>
@endpush
