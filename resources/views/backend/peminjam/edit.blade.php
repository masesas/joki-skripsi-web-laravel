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
                        {{ $module_action }} Peminjam
                    </h4>
                </div>
            </div>
            <hr>

            <div class="row mt-4">
                <div class="col">
                    {{ html()->modelForm($peminjam, 'POST', route('backend.peminjam.store'))->class('form-horizontal')->open() }}

                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                {{ html()->label('Nama User', 'user')->class('form-label') }} {!! fielf_required('required') !!}
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                <select name="user" id="user" class="form-control" required>
                                    <option>Pilih User</option>
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
                                {{ html()->label('Nama Alat Yg Dipinjam', 'alat')->class('form-label') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                <select name="alat" id="alat" class="form-control">
                                    <option value="">Pilih Alat</option>
                                    @foreach ($alats as $alat)
                                        <option value="{{ $alat->id }}"
                                            data-tersedia="{{ (int) $alat->jumlah_stock - (int) $alat->jumlah_dipinjam }}">
                                            {{ $alat->nama_alat }}</option>
                                    @endforeach
                                </select>
                                <span id="alat_tersedia"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                {{ html()->label('Jumlah Alat Yg Dipinjam', 'jumlah_alat')->class('form-label') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                {{ html()->text('jumlah_alat')->placeholder('Jumlah Alat Yg Dipinjam')->class('form-control number_input') }}
                                <span id="alat_error" class="error text-danger d-none">
                                    Jumlah Pinjam Bahan Melebihi Stock Tersedia
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                {{ html()->label('Nama Bahan Yg Dipinjam', 'bahan')->class('form-label') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                <select name="bahan" id="bahan" class="form-control">
                                    <option value="">Pilih Bahan</option>
                                    @foreach ($bahans as $bahan)
                                        <option value="{{ $bahan->id }}"
                                            data-tersedia="{{ (int) $alat->jumlah_stock - (int) $alat->jumlah_dipinjam }}">
                                            {{ $bahan->nama_bahan }}</option>
                                    @endforeach
                                </select>
                                <span id="bahan_tersedia"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                {{ html()->label('Jumlah Bahan Yg Dipinjam', 'jumlah_bahan')->class('form-label') }}
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                {{ html()->text('jumlah_bahan')->placeholder('Jumlah Bahan Yg Dipinjam')->class('form-control number_input') }}
                                <span id="bahan_error" class="error text-danger d-none">
                                    Jumlah Pinjam Bahan Melebihi Stock Tersedia
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">

                        </div>

                        <div class="col-sm-8">
                            <div class="float-end">
                                <x-backend.buttons.save text="{{ $module_action }} Peminjam" />
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

@push('after-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            let alatTersedia = 0,
                bahanTersedia = 0;

            $('#alat').change(function(e) {
                if ($(':selected', $(this)).val() == '') {
                    alatTersedia = 0;
                    $('#alat_tersedia').hide();
                    $('#alat_tersedia').text('');
                } else {
                    alatTersedia = $(':selected', $(this)).data('tersedia');
                    $('#alat_tersedia').show();
                    $('#alat_tersedia').text(
                        `Jumlah Stock Tersedia : ${$(':selected', $(this)).data('tersedia')}`);
                }
            });

            $('#bahan').change(function(e) {
                if ($(':selected', $(this)).val() == '') {
                    bahanTersedia = 0;
                    $('#bahan_tersedia').hide();
                    $('#bahan_tersedia').text('');
                } else {
                    bahanTersedia = $(':selected', $(this)).data('tersedia');
                    $('#bahan_tersedia').show();
                    $('#bahan_tersedia').text(
                        `Jumlah Stock Tersedia : ${$(':selected', $(this)).data('tersedia')}`);
                }
            });

            $('#jumlah_bahan').on('input', function(e) {
                if ($(this).val() == '') {
                    $('#bahan_error').addClass('d-none');
                } else {
                    if ($('#bahan').val() != '' && $(this).val() > bahanTersedia) {
                        $('#bahan_error').removeClass('d-none');
                    } else {
                        $('#bahan_error').addClass('d-none');
                    }
                }
            });

            $('#jumlah_alat').on('input', function(e) {
                if ($(this).val() == '') {
                    $('#alat_error').addClass('d-none');
                } else {
                    if ($('#alat').val() != '' && $(this).val() > alatTersedia) {
                        $('#alat_error').removeClass('d-none');
                    } else {
                        $('#alat_error').addClass('d-none');
                    }
                }
            });
        });
    </script>
@endpush
