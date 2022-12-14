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
                        {{ $module_action }} Alat Pecah
                    </h4>
                </div>
            </div>
            <hr>

            <div class="row mt-4">
                <div class="col">
                    {{ html()->modelForm($alatPecah, 'POST', route('backend.alat_pecah.store'))->class('form-horizontal')->open() }}

                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                {{ html()->label('Nama User Pemecah', 'user')->class('form-label') }}
                                {!! fielf_required('required') !!}
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                <select name="user" id="user" class="form-control">
                                    <option>Pilih User Pemecah</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                {{ html()->label('Alat Yg Pecah', 'alat')->class('form-label') }} {!! fielf_required('required') !!}
                            </div>
                        </div>
                        <div class="col-6 col-sm-8">
                            <div class="form-group">
                                <select name="alat" id="alat" class="form-control">
                                    <option>Pilih Alat Yg Pecah</option>
                                    @foreach ($alats as $alat)
                                        <option value="{{ $alat->id }}">{{ $alat->nama_alat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                {{ html()->label('Jumlah Pecah', 'jumlah')->class('form-label') }}
                                {!! fielf_required('required') !!}
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                {{ html()->text('jumlah')->placeholder('Jumlah Pecah')->class('form-control number_input')->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">

                        </div>

                        <div class="col-sm-8">
                            <div class="float-end">
                                <x-backend.buttons.save text="{{ $module_action }} Alat Pecah" />
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
