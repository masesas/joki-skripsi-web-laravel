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
                        {{ $module_action }} Bahan
                    </h4>
                </div>
            </div>
            <hr>

            <div class="row mt-4">
                <div class="col">
                    {{ html()->modelForm($bahan, empty($bahan) ? 'POST' : 'PATCH', empty($bahan) ? route('backend.bahan.store') : route('backend.bahan.update', $bahan->id))->class('form-horizontal')->open() }}

                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                {{ html()->label('Nama Bahan', 'nama_bahan')->class('form-label') }} {!! fielf_required('required') !!}
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                {{ html()->text('nama_bahan')->placeholder('Nama Bahan')->class('form-control')->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                {{ html()->label('Rumus Kimia', 'rumus_kimia')->class('form-label') }}
                                {!! fielf_required('required') !!}
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                {{ html()->text('rumus_kimia')->placeholder('Rumus Kimia')->class('form-control')->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                {{ html()->label('Fasa', 'fasa')->class('form-label') }}
                                {!! fielf_required('required') !!}
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                {{ html()->text('fasa')->placeholder('Fasa')->class('form-control')->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                {{ html()->label('Golongan', 'golongan')->class('form-label') }} {!! fielf_required('required') !!}
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                {{ html()->text('golongan')->placeholder('Golongan')->class('form-control')->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                {{ html()->label('Jumlah Yang Ditambahkan', 'jumlah_stock')->class('form-label') }}
                                {!! fielf_required('required') !!}
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                {{ html()->text('jumlah_stock')->placeholder('Jumlah Yang Ditambahkan')->class('form-control number_input')->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">

                        </div>

                        <div class="col-sm-8">
                            <div class="float-end">
                                <x-backend.buttons.save text="{{ $module_action }} Bahan" />
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
