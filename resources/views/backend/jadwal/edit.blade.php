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
                        {{ $module_action }} Jadwal
                    </h4>
                </div>
            </div>
            <hr>

            <div class="row mt-4">
                <div class="col">
                    {{ html()->modelForm($jadwal, 'POST', route('backend.jadwal.store'))->class('form-horizontal')->open() }}

                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                {{ html()->label('Kelas', 'kelas')->class('form-label') }}
                                {!! fielf_required('required') !!}
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                {{ html()->text('kelas')->placeholder('Kelas')->class('form-control')->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                {{ html()->label('Hari', 'hari')->class('form-label') }}
                                {!! fielf_required('required') !!}
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                {{ html()->select('hari', $hariOptions)->placeholder('Pilih Hari')->class('form-control')->required() }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                {{ html()->label('Jam Mulai', 'jam_mulai')->class('form-label') }}
                                {!! fielf_required('required') !!}
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                <div class="input-group">
                                    {{ html()->text('jam_mulai')->placeholder('Jam Mulai')->class('form-control timepicker')->required() }}
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-clock"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                {{ html()->label('Jam Selesai', 'jam_selesai')->class('form-label') }}
                                {!! fielf_required('required') !!}
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="form-group">
                                <div class="input-group">
                                    {{ html()->text('jam_selesai')->placeholder('Jam Selesai')->class('form-control timepicker')->required() }}
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-clock"></i>
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">

                        </div>

                        <div class="col-sm-8">
                            <div class="float-end">
                                <x-backend.buttons.save text="{{ $module_action }} Jadwal" />
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
            $('.timepicker').clockTimePicker();
            $('.timepicker').css('width', '100%')
        });
    </script>
@endpush
