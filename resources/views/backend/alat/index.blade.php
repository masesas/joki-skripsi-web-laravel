@extends('backend.layouts.app')

@section('title')
    {{ __($module_action) }} {{ __($module_title) }}
@endsection

@section('breadcrumbs')
    <x-backend-breadcrumbs>
        <x-backend-breadcrumb-item type="active">{{ __($module_title) }}
        </x-backend-breadcrumb-item>
    </x-backend-breadcrumbs>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="card-title mb-0">
                        Daftar Alat
                    </h4>
                </div>
                @if (Auth::user()->status === 'laboran')
                    <a href="{{ route('backend.alat.create') }}" class='btn btn-success' data-toggle="tooltip"
                        title="Tambah Alat">
                        <i class="fas fa-plus-circle"></i> Tambah Alat
                    </a>
                @endif
            </div>

            <div class="row mt-4">
                <div class="col">
                    <table id="datatable" class="table table-bordered table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th>
                                    Nama Alat
                                </th>
                                <th>
                                    Merk
                                </th>
                                <th>
                                    Ukuran
                                </th>
                                <th>
                                    Jenis
                                </th>
                                <th>
                                    Jumlah Tersedia
                                </th>
                                <th>
                                    Jumlah di Pinjam
                                </th>
                                <th>
                                    Jumlah Total
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {{-- Total {{ $$module_name->total() }} {{ ucwords($module_name) }} --}}
                    </div>
                </div>
                <div class="col-5">
                    <div class="float-end">
                        {{-- {!! $$module_name->render() !!} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-styles')
    <!-- DataTables Core and Extensions -->
    <link rel="stylesheet" href="{{ asset('vendor/datatable/datatables.min.css') }}">
@endpush

@push('after-scripts')
    <!-- DataTables Core and Extensions -->
    <script type="text/javascript" src="{{ asset('vendor/datatable/datatables.min.js') }}"></script>

    <script type="text/javascript">
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: true,
            responsive: true,
            ajax: '{{ route('backend.alat.index_data') }}',
            columns: [{
                    data: 'nama_alat',
                    name: 'nama_alat'
                },
                {
                    data: 'merk',
                    name: 'merk'
                },
                {
                    data: 'ukuran',
                    name: 'ukuran'
                },
                {
                    data: 'jenis',
                    name: 'jenis'
                },
                {
                    data: 'jumlah_tersedia',
                    name: 'jumlah_tersedia'
                },
                {
                    data: 'jumlah_dipinjam',
                    name: 'jumlah_dipinjam'
                },
                {
                    data: 'jumlah_total',
                    name: 'jumlah_total'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    </script>
@endpush
