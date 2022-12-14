@extends('backend.layouts.app')

@section('title')
    {{ __($module_action) }}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="card-title mb-0">
                        Profile
                    </h4>
                </div>
            </div>
            <hr>

            <div class="row mt-4">
                <div class="col">

                    <div class="row mb-3">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label('NIM')->class('form-label') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label($user->nim)->class('form-label') }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label('Nama')->class('form-label') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label($user->nama)->class('form-label') }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label('No. Telepon')->class('form-label') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label($user->telepon)->class('form-label') }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label('Alamat')->class('form-label') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label($user->alamat)->class('form-label') }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label('Status')->class('form-label') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                {{ html()->label($user->status)->class('form-label') }}
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
