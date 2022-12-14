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
                        Daftar Alat Pecah
                    </h4>
                </div>
                @if (Auth::user()->status == 'laboran')
                    <a href="{{ route('backend.alat_pecah.create') }}" class='btn btn-success' data-toggle="tooltip"
                        title="Tambah Alat Pecah">
                        <i class="fas fa-plus-circle"></i>
                        Tambah Alat Pecah
                    </a>
                @endif

            </div>

            <div class="row mt-4">
                <div class="col">
                    <table id="datatable" class="table table-bordered table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th>
                                    Nama Pemecah
                                </th>
                                <th>
                                    NIM
                                </th>
                                <th>
                                    Alat Yang Pecah
                                </th>
                                <th>
                                    Jumlah Alat
                                </th>
                                <th>
                                    No. Telp
                                </th>
                                <th>
                                    Tanggal
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
            ajax: '{{ route('backend.alat_pecah.index_data') }}',
            columns: [{
                    data: 'nama_user',
                    name: 'nama_user'
                },
                {
                    data: 'nim',
                    name: 'nim'
                },
                {
                    data: 'nama_alat',
                    name: 'nama_alat'
                },
                {
                    data: 'jumlah_alat',
                    name: 'jumlah_alat'
                },
                {
                    data: 'no_telp',
                    name: 'no_telp'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
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
