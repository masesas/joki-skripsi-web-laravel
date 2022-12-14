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
                        Daftar Jadwal
                    </h4>
                </div>
                @if (Auth::user()->status == 'laboran')
                    <div class="float-end">
                        <div class="btn-group btn-group-justified">
                            <a href="{{ route('backend.jadwal.create') }}" class='btn btn-success' data-toggle="tooltip"
                                title="Tambah Jadwal">
                                <i class="fas fa-plus-circle"></i>
                                Tambah Jadwal
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-4">
                <div class="col">
                    <table id="datatable" class="table table-bordered table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th>
                                    Kelas
                                </th>
                                <th>
                                    Hari
                                </th>
                                <th>
                                    Dari
                                </th>
                                <th>
                                    Sampai
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
            ajax: '{{ route('backend.jadwal.index_data') }}',
            columns: [{
                    data: 'kelas',
                    name: 'kelas'
                },
                {
                    data: 'hari',
                    name: 'hari'
                },
                {
                    data: 'jam_mulai',
                    name: 'jam_mulai'
                },
                {
                    data: 'jam_selesai',
                    name: 'jam_selesai'
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
