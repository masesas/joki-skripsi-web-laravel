@extends('backend.layouts.app')

@section('title')
    {{ __($module_action) }} {{ __($module_title) }}
@endsection

@section('breadcrumbs')
    <x-backend-breadcrumbs>
        <x-backend-breadcrumb-item route='{{ route("backend.$module_name.index") }}' icon='{{ $module_icon }}'>
            {{ __($module_title) }}
        </x-backend-breadcrumb-item>

        <x-backend-breadcrumb-item type="active">{{ __($module_action) }}</x-backend-breadcrumb-item>
    </x-backend-breadcrumbs>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <x-backend.section-header>
                <i class="{{ $module_icon }}"></i> {{ __($module_title) }} <small
                    class="text-muted">{{ __($module_action) }}</small>
            </x-backend.section-header>

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="row mb-3">
                        <div class="col-12 col-sm-2">
                            <div class="form-group">
                                {{ html()->label('NIM', $user->nim)->class('form-label') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-10">
                            <div class="form-group">
                                {{ html()->text($user->nim, $user->nim)->placeholder('NIM')->class('form-control')->attributes(['disabled']) }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-2">
                            <div class="form-group">
                                {{ html()->label('Nama', $user->nama)->class('form-label') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-10">
                            <div class="form-group">
                                {{ html()->text($user->nama, $user->nama)->placeholder('Nama')->class('form-control')->attributes(['disabled']) }}
                            </div>
                        </div>
                    </div>

                    {{ html()->form('PATCH', route('backend.users.changePasswordUpdate', $user->id))->class('form-horizontal')->open() }}

                    <div class="form-group row mb-3">
                        {{ html()->label('Password Lama')->class('col-md-2 form-control-label')->for('password') }}

                        <div class="col-md-10">
                            <div class="input-group">
                                {{ html()->password('password')->value($user->password_string)->placeholder('Password Lama')->class('form-control')->attributes(['disabled']) }}
                                <span class="input-group-text">
                                    <i class="far fa-eye" id="togglePassword" style="cursor: pointer"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!--form-group-->

                    <div class="form-group row mb-3">
                        {{ html()->label('Password Baru')->class('col-md-2 form-control-label')->for('password_baru') }}

                        <div class="col-md-10">
                            {{ html()->password('password_baru')->class('form-control')->placeholder('Password Baru')->required() }}
                        </div>
                    </div>
                    <!--form-group-->

                    <div class="row">
                        <div class="col-sm-4">

                        </div>

                        <div class="col-sm-8">
                            <div class="float-end">
                                <x-backend.buttons.save />
                                <x-backend.buttons.return-back>Kembali</x-backend.buttons.return-back>
                            </div>
                        </div>
                    </div>
                    {{ html()->closeModelForm() }}
                </div>
                <!--/.col-->
            </div>
            <!--/.row-->
        </div>
    </div>
@endsection
