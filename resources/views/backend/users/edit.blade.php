@extends('backend.layouts.app')

@section('title')
    {{ __($module_action) }} {{ __($module_title) }}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <x-backend.section-header>
                <i class="{{ $module_icon }}"></i> {{ __($module_title) }} <small
                    class="text-muted">{{ __($module_action) }}</small>
                <x-slot name="subtitle">
                    @lang(':module_name Management Dashboard', ['module_name' => Str::title($module_name)])
                </x-slot>
            </x-backend.section-header>
            <hr>

            <div class="row mt-4">
                <div class="col">
                    {{ html()->modelForm($user, empty($user) ? 'POST' : 'PATCH', empty($user) ? route('backend.users.store') : route('backend.users.update', $user->id))->class('form-horizontal')->open() }}

                    <div class="row mb-3">
                        <?php
                        $field_name = 'nim';
                        $field_lable = 'Nim';
                        $field_placeholder = $field_lable;
                        $required = 'required';
                        ?>
                        <div class="col-12 col-sm-2">
                            <div class="form-group">
                                {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                            </div>
                        </div>
                        <div class="col-12 col-sm-10">
                            <div class="form-group">
                                {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <?php
                        $field_name = 'nama';
                        $field_lable = 'Nama';
                        $field_placeholder = $field_lable;
                        $required = 'required';
                        ?>
                        <div class="col-12 col-sm-2">
                            <div class="form-group">
                                {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                            </div>
                        </div>
                        <div class="col-12 col-sm-10">
                            <div class="form-group">
                                {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <?php
                        $field_name = 'alamat';
                        $field_lable = 'Alamat';
                        $field_placeholder = $field_lable;
                        $required = 'required';
                        ?>
                        <div class="col-12 col-sm-2">
                            <div class="form-group">
                                {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                            </div>
                        </div>
                        <div class="col-12 col-sm-10">
                            <div class="form-group">
                                {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <?php
                        $field_name = 'telepon';
                        $field_lable = 'No. Telepon';
                        $field_placeholder = $field_lable;
                        $required = 'required';
                        ?>
                        <div class="col-12 col-sm-2">
                            <div class="form-group">
                                {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
                            </div>
                        </div>
                        <div class="col-12 col-sm-10">
                            <div class="form-group">
                                {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <?php
                        $field_name = 'status';
                        $field_lable = 'Status';
                        $field_placeholder = '-- Pilih Status --';
                        $required = 'required';
                        $select_options = [
                            'laboran' => 'Laboran',
                            'mahasiswa' => 'Mahasiswa',
                        ];

                        Log::warning(
                            html()
                                ->select($field_name, $select_options)
                                ->placeholder($field_placeholder)
                                ->class('form-control')
                                ->attributes(["$required"]),
                        );
                        ?>
                        <div class="col-12 col-sm-2">
                            <div class="form-group">
                                {{ html()->label($field_lable, $field_name)->class('form-label') }}
                                {!! fielf_required($required) !!}
                            </div>
                        </div>
                        <div class="col-12 col-sm-10">
                            <div class="form-group">
                                {{ html()->select($field_name, $select_options)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                            </div>
                        </div>
                    </div>

                    @if (empty($user))
                        <div class="row mb-3">
                            <?php
                            $field_name = 'username';
                            $field_lable = 'Username';
                            $field_placeholder = $field_lable;
                            $required = 'required';
                            ?>
                            <div class="col-12 col-sm-2">
                                <div class="form-group">
                                    {{ html()->label($field_lable, $field_name)->class('form-label') }}
                                    {!! fielf_required($required) !!}
                                </div>
                            </div>
                            <div class="col-12 col-sm-10">
                                <div class="form-group">
                                    {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"]) }}
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <?php
                            $field_name = 'password';
                            $field_lable = 'Password';
                            $field_placeholder = $field_lable;
                            $required = 'required';
                            ?>
                            <div class="col-12 col-sm-2">
                                <div class="form-group">
                                    {{ html()->label($field_lable, $field_name)->class('form-label') }}
                                    {!! fielf_required($required) !!}
                                </div>
                            </div>
                            <div class="col-12 col-sm-10">
                                <div class="input-group">
                                    {{ html()->password($field_name)->placeholder($field_placeholder)->class('form-control')->required() }}
                                    <span class="input-group-text">
                                        <i class="far fa-eye" id="togglePassword" style="cursor: pointer"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

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
        <div class="card-footer">

        </div>
    </div>
@endsection
