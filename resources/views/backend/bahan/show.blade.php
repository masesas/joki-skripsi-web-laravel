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
                        Deskripsi Bahan
                    </h4>
                </div>
            </div>
            <hr>

            <div class="row mt-4">
                <div class="col">

                    <div class="row mb-3">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label('Nama Bahan')->class('form-label') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label($bahan->nama_bahan)->class('form-label') }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label('Rumus Kimia')->class('form-label') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label($bahan->rumus_kimia)->class('form-label') }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label('Fasa')->class('form-label') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label($bahan->fasa)->class('form-label') }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label('Golongan')->class('form-label') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label($bahan->golongan)->class('form-label') }}
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
                                {{ html()->label($bahan->jumlah_stock)->class('form-label') }}
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
