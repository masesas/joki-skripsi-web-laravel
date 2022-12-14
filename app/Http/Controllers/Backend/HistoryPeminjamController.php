<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HistoryPeminjam;
use DataTables;
use Illuminate\Http\Request;

class HistoryPeminjamController extends Controller
{
    public function __construct() {
        // Page Title
        $this->module_title = 'Peminjaman';

        // module name
        $this->module_name = 'peminjam';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $module_title = $this->module_title;
        $module_name = $this->module_name;

        $module_action = 'Daftar';

        $page_heading = ucfirst($module_title);
        $title = ucfirst($module_action) . ' ' . $page_heading;

        return view(
            'backend.history_peminjam.index',
            compact(
                'module_title',
                'module_name',
                'module_action',
                'page_heading',
            )
        );
    }

    public function index_data() {
        $module_name = $this->module_name;
        $peminjam = HistoryPeminjam::withUser();
        $data = $peminjam;

        return DataTables::of($peminjam)
            ->editColumn('nama_user', '<strong>{{$nama_user}}</strong>')
            ->editColumn('nim', '<strong>{{$nim}}</strong>')
            ->editColumn('nama_alat', '<strong>{{$nama_alat}}</strong>')
            ->editColumn('merk_alat', '<strong>{{$merk_alat}}</strong>')
            ->editColumn('ukuran_alat', '<strong>{{$ukuran_alat}}</strong>')
            ->editColumn('jenis_alat', '<strong>{{$jenis_alat}}</strong>')
            ->editColumn('jumlah_alat', '<strong>{{$jumlah_alat}}</strong>')
            ->editColumn('nama_bahan', '<strong>{{$nama_bahan}}</strong>')
            ->editColumn('jumlah_bahan', '<strong>{{$jumlah_bahan}}</strong>')
            ->editColumn('no_telp', '<strong>{{$telepon}}</strong>')
            ->addColumn('tanggal', '<strong>{{$tanggal_pinjam}}</strong>')
            ->rawColumns([
                'nama_user',
                'nim',
                'nama_alat',
                'merk_alat',
                'ukuran_alat',
                'jenis_alat',
                'jumlah_alat',
                'nama_bahan',
                'jumlah_bahan',
                'no_telp',
                'tanggal',
            ])
            ->make(true);
    }
}
