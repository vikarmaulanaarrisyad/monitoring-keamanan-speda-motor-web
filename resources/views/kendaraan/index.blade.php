@extends('layouts.app')

@section('title', 'Daftar Kendaraan')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Daftar Kendaraan</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-12 col-lg-12">
            <x-card>
                <x-slot name="header">
                    <button onclick="addForm(`{{ route('kendaraan.store') }}`)" class="btn btn-primary"><i
                            class="fa fa-plus-circle"></i> Tambah Data</button>
                </x-slot>

                <x-table class="table-kendaraan">
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Merk Kendaraan</th>
                            <th>Nomor Plat</th>
                            <th>Pemilik</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>
    @include('kendaraan.form')
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

        table = $('.table-kendaraan').DataTable({
            processing: true,
            autoWidth: false,
            serverSide: true,
            ajax: {
                url: '{{ route('kendaraan.data') }}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'merk'
                },
                {
                    data: 'plat_number'
                },
                {
                    data: 'name_of_the_owner'
                },
                {
                    data: 'action',
                    searchable: false,
                    sortable: false
                },
            ]
        });
    </script>
@endpush

@push('scripts')
    <script type="text/javascript">
        let button = '#submitBtn';

        function addForm(url, title = 'Tambah Data Kendaraan') {
            $(modal).modal('show');
            $(`${modal} .modal-title`).text(title);
            $(`${modal} form`).attr('action', url);
            $(`${modal} [name=_method]`).val('POST');
            $('#spinner-border').hide();
            $(button).prop('disabled', false);
            resetForm(`${modal} form`);
        }

        function editForm(url, title = 'Edit Data Kendaraan') {
            $.get(url)
                .done(response => {
                    $(modal).modal('show');
                    $(`${modal} .modal-title`).text(title);
                    $(`${modal} form`).attr('action', url);
                    $(`${modal} [name=_method]`).val('PUT');
                    $('#spinner-border').hide();
                    $(button).prop('disabled', false);
                    resetForm(`${modal} form`);
                    loopForm(response.data);
                })
                .fail(errors => {
                    Swall.fire({
                        icon: 'error',
                        title: 'Gagal menyimpan data',
                        text: errors.responseJSON.message,
                        showConfirmButton: true,
                    });
                    $('#spinner-border').hide();
                    $(button).prop('disabled', false);
                });
        }

         function submitForm(originalForm) {
            $(button).prop('disabled', true);
            $('#spinner-border').show();
            $.post({
                    url: $(originalForm).attr('action'),
                    data: new FormData(originalForm),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false
                })
                .done(response => {
                    $(modal).modal('hide');
                    if (response.status = 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 3000
                        })
                    }
                    $(button).prop('disabled', false);
                    $('#spinner-border').hide();
                    table.ajax.reload();
                })
                .fail(errors => {
                    $('#spinner-border').hide();
                    $(button).prop('disabled', false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal menyimpan data',
                        text: errors.responseJSON.message,
                        showConfirmButton: true,
                    });
                    if (errors.status == 422) {
                        $('#spinner-border').hide()
                        $(button).prop('disabled', false);
                        loopErrors(errors.responseJSON.errors);
                        return;
                    }
                });
        }

        function deleteData(url, name) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })
            swalWithBootstrapButtons.fire({
                title: 'Apakah anda yakin?',
                text: 'Anda akan menghapus ' + name +
                    ' !',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Iya, Hapus!',
                cancelButtonText: 'Batalkan',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(url, {
                            '_method': 'delete'
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
                                title: 'Gagal menyimpan data.',
                                text: errors.responseJSON.message,
                                showConfirmButton: false,
                                timer: 3000
                            })
                            table.ajax.reload();
                        });
                }
            })
        }

    </script>
@endpush
