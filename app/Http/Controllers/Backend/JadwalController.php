<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use DataTables;
use Flash;
use Illuminate\Http\Request;
use Str;

class JadwalController extends Controller {
    public function __construct() {
        // Page Title
        $this->module_title = 'Jadwal';

        // module name
        $this->module_name = 'jadwal';
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
            'backend.jadwal.index',
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
        $jadwal = Jadwal::all();
        $data = $jadwal;

        return DataTables::of($jadwal)
            ->editColumn('kelas', '<strong>{{$kelas}}</strong>')
            ->editColumn('hari', '<strong>{{$hari}}</strong>')
            ->editColumn('jam_mulai', '<strong>{{$jam_mulai}}</strong>')
            ->editColumn('jam_selesai', '<strong>{{$jam_selesai}}</strong>')
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.jadwal_actions', compact('module_name', 'data'));
            })
            ->rawColumns([
                'kelas',
                'hari',
                'jam_mulai',
                'jam_selesai',
                'action'
            ])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_action = 'Tambah';

        $hariOptions = [
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jum`at',
            'Sabtu',
            'Minggu'
        ];
        $jadwal = new Jadwal();

        return view(
            "backend.jadwal.edit",
            compact(
                'module_title',
                'module_name',
                'module_action',
                'jadwal',
                'hariOptions'
            )
        );
    }

    public function store(Request $request) {
        $data = $request->all();
        $jadwal = Jadwal::create($data);
        $jadwal->save();

        Flash::success("<i class='fas fa-check'></i> Jadwal Berhasil di Tambahkan")->important();

        return redirect("admin/jadwal");
    }

    public function show($id) {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_action = 'Deskripsi';

        $jadwal = Jadwal::findOrFail($id);

        return view(
            "backend.jadwal.show",
            compact(
                'module_title',
                'module_name',
                'module_action',
                'jadwal',
            )
        );
    }


    public function destroy($id) {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        flash('<i class="fas fa-check"></i> Jadwal Berhasil di Hapus')->success();

        return redirect("admin/jadwal");
    }

}
