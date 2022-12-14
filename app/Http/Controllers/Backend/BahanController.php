<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BahanLab;
use Auth;
use Flash;
use Illuminate\Http\Request;
use Str;
use Yajra\DataTables\Facades\DataTables;

class BahanController extends Controller
{
    public function __construct() {
        // Page Title
        $this->module_title = 'Bahan';

        // module name
        $this->module_name = 'bahan';
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
            'backend.bahan.index',
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
        $bahan = BahanLab::all();
        $data = $bahan;

        return DataTables::of($bahan)
            ->editColumn('nama_bahan', '<strong>{{$nama_bahan}}</strong>')
            ->editColumn('rumus_kimia', '<strong>{{$rumus_kimia}}</strong>')
            ->editColumn('fasa', '<strong>{{$fasa}}</strong>')
            ->editColumn('golongan', '<strong>{{$golongan}}</strong>')
            ->addColumn('jumlah_tersedia', '<strong>{{ (int) $jumlah_stock - (int) $jumlah_dipinjam }}</strong>')
            ->addColumn('jumlah_dipinjam', '<strong>{{$jumlah_dipinjam}}</strong>')
            ->addColumn('jumlah_total', '<strong>{{$jumlah_stock}}</strong>')
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.bahan_actions', compact('module_name', 'data'));
            })
            ->rawColumns([
                'nama_bahan',
                'rumus_kimia',
                'fasa',
                'golongan',
                'jumlah_tersedia',
                'jumlah_dipinjam',
                'jumlah_total',
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

        $bahan = null;

        return view(
            "backend.bahan.edit",
            compact(
                'module_title',
                'module_name',
                'module_action',
                'bahan',
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_action = 'Tambah';

        $module_action = 'Edit';

        $bahan = BahanLab::findOrFail($id);

        return view(
            "backend.bahan.edit",
            compact(
                'module_title',
                'module_name',
                'module_action',
                'bahan',
            )
        );
    }


    public function store(Request $request) {
        $module_name = $this->module_name;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Details';

        $data_array = $request->except('_token');
        $$module_name_singular = BahanLab::create($data_array);
        $$module_name_singular->save();

        Flash::success("<i class='fas fa-check'></i> Alat Berhasil di Tambahkan")->important();

        return redirect("admin/bahan");
    }

    public function update(Request $request, $id) {
        if (!Auth::user()->can('edit_users')) {
            abort(404);
        }

        $alat = BahanLab::findOrFail($id);

        $data = $request->except([]);
        $alat->update($data);

        Flash::success("<i class='fas fa-check'></i> Bahan Berhasil di Edit")->important();

        return redirect("admin/bahan");
    }

    public function show($id) {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_action = 'Deskripsi';

        $bahan = BahanLab::findOrFail($id);

        return view(
            "backend.bahan.show",
            compact(
                'module_title',
                'module_name',
                'module_action',
                'bahan',
            )
        );
    }


    public function destroy($id) {
        $alat = BahanLab::findOrFail($id);
        $alat->delete();

        flash('<i class="fas fa-check"></i> ' . $alat->nama_bahan . ' Alat Berhasil di Hapus')->success();


        return redirect("admin/bahan");
    }
}
