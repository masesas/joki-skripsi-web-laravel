@extends('backend.layouts.app')

@section('title')
    {{ __($module_action) }} {{ __($module_title) }}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="card-title mb-0">
                        {{ $module_action }} Alat
                    </h4>
                </div>
            </div>
            <hr>

            <div class="row mt-4">
                <div class="col">

                    <div class="row mb-3">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label('Nama Alat')->class('form-label') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label($alat->nama_alat)->class('form-label') }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label('ukuran')->class('form-label') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label($alat->ukuran . ' ' . $alat->satuan_ukuran)->class('form-label') }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label('Jenis')->class('form-label') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label($alat->jenis)->class('form-label') }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label('Merk')->class('form-label') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label($alat->merk)->class('form-label') }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label('Lokasi Penyimpanan')->class('form-label') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label($alat->lokasi_penyimpanan)->class('form-label') }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label('Jumlah Total')->class('form-label') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label($alat->jumlah_stock)->class('form-label') }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">

                        </div>

                        <div class="col-sm-8">
                            <div class="float-end">

                                <x-backend.buttons.return-back>Kembali</x-backend.buttons.return-back>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
