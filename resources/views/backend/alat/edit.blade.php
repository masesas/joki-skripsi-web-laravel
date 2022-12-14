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
                    {{ html()->modelForm($alat, empty($alat) ? 'POST' : 'PATCH', empty($alat) ? route('backend.alat.store') : route('backend.alat.update', $alat->id))->class('form-horizontal')->open() }}

                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                {{ html()->label('Nama Alat', 'nama_alat')->class('form-label') }} {!! fielf_required('required') !!}
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                {{ html()->text('nama_alat')->placeholder('Nama Alat')->class('form-control')->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                {{ html()->label('ukuran')->class('form-label') }} {!! fielf_required('required') !!}
                            </div>
                        </div>
                        <div class="col-6 col-sm-4">
                            <div class="form-group">
                                {{ html()->text('ukuran')->placeholder('Ukuran')->class('form-control')->required() }}
                            </div>
                        </div>
                        <div class="col-6 col-sm-4">
                            <div class="form-group">
                                {{ html()->select('satuan_ukuran', $satuanUkuranOptions)->placeholder('Pilih Satuan Ukuran')->class('form-control')->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                {{ html()->label('Jenis', 'jenis')->class('form-label') }}
                                {!! fielf_required('required') !!}
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                {{ html()->select('jenis', $jenisOptions)->placeholder('Pilih Jenis')->class('form-control')->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                {{ html()->label('Merk', 'merk')->class('form-label') }} {!! fielf_required('required') !!}
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                {{ html()->text('merk')->placeholder('Merk')->class('form-control')->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                {{ html()->label('Lokasi Penyimpanan', 'lokasi_penyimpanan')->class('form-label') }}
                                {!! fielf_required('required') !!}
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                {{ html()->text('lokasi_penyimpanan')->placeholder('Lokasi Penyimpanan')->class('form-control')->required() }}
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
                                <x-backend.buttons.save text="{{ $module_action }} Alat" />
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
