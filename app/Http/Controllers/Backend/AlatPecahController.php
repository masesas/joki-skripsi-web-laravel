<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AlatLab;
use App\Models\AlatPecah;
use App\Models\User;
use Flash;
use Illuminate\Http\Request;
use Str;
use Yajra\DataTables\Facades\DataTables;

class AlatPecahController extends Controller {
    public function __construct() {
        // Page Title
        $this->module_title = 'Alat Pecah';

        // module name
        $this->module_name = 'alat_pecah';
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
            'backend.alat_pecah.index',
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
        $alat = AlatPecah::withUser();
        $data = $alat;

        return DataTables::of($alat)
            ->editColumn('nama_user', '<strong>{{$nama_user}}</strong>')
            ->editColumn('nim', '<strong>{{$nim}}</strong>')
            ->editColumn('nama_alat', '<strong>{{$nama_alat}}</strong>')
            ->editColumn('jumlah_alat', '<strong>{{$jumlah}}</strong>')
            ->editColumn('no_telp', '<strong>{{$telepon}}</strong>')
            ->addColumn('tanggal', '<strong>{{$tanggal}}</strong>')
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.alat_pecah_actions', compact('module_name', 'data'));
            })
            ->rawColumns([
                'nama_user',
                'nim',
                'nama_alat',
                'jumlah_alat',
                'no_telp',
                'tanggal',
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

        $users = User::all();
        $alats = AlatLab::all();
        $alatPecah = null;

        return view(
            "backend.alat_pecah.edit",
            compact(
                'module_title',
                'module_name',
                'module_action',
                'alatPecah',
                'users',
                'alats'
            )
        );
    }

    public function store(Request $request) {
        $module_name = $this->module_name;
        $module_name_singular = Str::singular($module_name);

        $data = [
            'user_id' => $request->user,
            'alat_id' => $request->alat,
            'jumlah' => $request->jumlah
        ];

        $$module_name_singular = AlatPecah::create($data);
        $$module_name_singular->save();

        Flash::success("<i class='fas fa-check'></i> Alat Pecah Berhasil di Tambahkan")->important();

        return redirect("admin/alat_pecah");
    }

    public function show($id) {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_action = 'Deskripsi';

        $alat = AlatPecah::findOrFail($id);

        return view(
            "backend.alat.show",
            compact(
                'module_title',
                'module_name',
                'module_action',
                'alat',
            )
        );
    }


    public function destroy($id) {
        $alat = AlatPecah::findOrFail($id);
        $alat->delete();

        flash('<i class="fas fa-check"></i> ' . $alat->nama_alat . ' Alat Pecah Berhasil di Hapus')->success();


        return redirect("admin/alat_pecah");
    }
}
