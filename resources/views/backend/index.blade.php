@extends('backend.layouts.app')

@section('title')
    @lang('Dashboard')
@endsection

@section('content')
    <div class="container py-4 px-4 d-flex align-items-center justify-content-center">
        <div class="row">

            <!-- Users -->
            <div class="col-md-6">
                <div class="card mb-4 card-bg">
                    <div class="card-body">
                        <div class="fs-2 fw-semibold">
                            <div class="row">
                                <div class="col-md-10">
                                    <i class="fa fa-users" aria-hidden="true"></i> {{ Auth::user()->status == 'laboran' ? 'User' : 'Profile' }}
                                </div>
                                <div class="col-md-2 d-flex flex-row-reverse align-items-center">
                                    <h4>{{ Auth::user()->status == 'laboran' ? $users : null }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center"
                            href="{{ Auth::user()->status == 'laboran' ? route('backend.users.index') : route('backend.users.profile', Auth::user()->id) }}"><span class="small fw-semibold"><i
                                    class="fa-solid fa-eye"></i>
                                Lihat</span>
                            <svg class="icon">
                                <use xlink:href="/fonts/free.svg#cil-chevron-right"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Users -->

            <!-- Daftar Alat -->
            <div class="col-md-6">
                <div class="card mb-4 card-bg">
                    <div class="card-body">
                        <div class="fs-2 fw-semibold">
                            <div class="row">
                                <div class="col-md-10" style="color: {{ $color }};">
                                    <i class="fas fa-tools"></i> Daftar Alat
                                </div>
                                <div class="col-md-2 d-flex flex-row-reverse align-items-center">
                                    <h4>{{ $alats }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center"
                            href="{{ route('backend.alat.index') }}"><span class="small fw-semibold"><i
                                    class="fa-solid fa-eye"></i>
                                Lihat</span>
                            <svg class="icon">
                                <use xlink:href="/fonts/free.svg#cil-chevron-right"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Daftar Alat -->

        </div>
    </div>
    <div class="container py-4 px-4 d-flex align-items-center justify-content-center">
        <div class="row">

            <!-- Daftar Bahan -->
            <div class="col-md-6">
                <div class="card mb-4 card-bg">
                    <div class="card-body">
                        <div class="fs-2 fw-semibold">
                            <div class="row">
                                <div class="col-md-10" style="color: {{ $color }};">
                                    <i class="fa-sharp fa-solid fa-droplet" ></i> Daftar Bahan
                                </div>
                                <div class="col-md-2 d-flex flex-row-reverse align-items-center">
                                    <h4>{{ $bahans }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center"
                            href="{{ route('backend.bahan.index') }}"><span class="small fw-semibold"><i
                                    class="fa-solid fa-eye"></i>
                                Lihat</span>
                            <svg class="icon">
                                <use xlink:href="/fonts/free.svg#cil-chevron-right"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Daftar Bahan -->

            <!-- Daftar Peminjam -->
            <div class="col-md-6">
                <div class="card mb-4 card-bg">
                    <div class="card-body">
                        <div class="fs-2 fw-semibold">
                            <div class="row">
                                <div class="col-md-10" style="color: {{ $color }};">
                                    <i class="fa-solid fa-id-badge"></i> Daftar Peminjam
                                </div>
                                <div class="col-md-2 d-flex flex-row-reverse align-items-center">
                                    <h4>{{ $peminjams }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center"
                            href="{{ route('backend.peminjam.index') }}"><span class="small fw-semibold"><i
                                    class="fa-solid fa-eye"></i>
                                Lihat</span>
                            <svg class="icon">
                                <use xlink:href="/fonts/free.svg#cil-chevron-right"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Daftar Peminjam -->

        </div>
    </div>

    <div class="container py-4 px-4 d-flex align-items-center justify-content-center">
        <div class="row">

            <!-- Alat Pecah -->
            <div class="col-md-6">
                <div class="card mb-4 card-bg pull-left">
                    <div class="card-body">
                        <div class="fs-2 fw-semibold">
                            <div class="row">
                                <div class="col-md-10" style="color: {{ $color }};">
                                    <i class="fa-solid fa-house-chimney-crack"></i> Alat Pecah
                                </div>
                                <div class="col-md-2 d-flex flex-row-reverse align-items-center">
                                    <h4>{{ $alatPecahs }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center"
                            href="{{ route('backend.alat_pecah.index') }}"><span class="small fw-semibold"><i
                                    class="fa-solid fa-eye"></i>
                                Lihat</span>
                            <svg class="icon">
                                <use xlink:href="/fonts/free.svg#cil-chevron-right"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Alat Pecah -->

            <!-- Jadwal -->
            <div class="col-md-6">
                <div class="card mb-4 card-bg pull-left">
                    <div class="card-body">
                        <div class="fs-2 fw-semibold">
                            <div class="row">
                                <div class="col-md-10" style="color: {{ $color }};">
                                    <i class="fa-solid fa-calendar-days"></i> Jadwal
                                </div>
                                <div class="col-md-2 d-flex flex-row-reverse align-items-center">
                                    <h4>{{ $jadwals }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2">
                        <a class="btn-block text-medium-emphasis d-flex justify-content-between align-items-center"
                            href="{{ route('backend.jadwal.index') }}">
                            <span class="small fw-semibold">
                                <i class="fa-solid fa-eye"></i>
                                Lihat
                            </span>
                            <svg class="icon">
                                <use xlink:href="/fonts/free.svg#cil-chevron-right"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Jadwal -->

        </div>
    </div>

    <style type="text/css">
        .card-bg {
            background-color: rgba(0, 0, 0, 0.05);
            height: 200px;
            width: 400px;
            align-content: center;
        }

        .empty-card {
            height: 200px;
            width: 400px;
            background-color: transparent !important;
        }
    </style>
@endsection
