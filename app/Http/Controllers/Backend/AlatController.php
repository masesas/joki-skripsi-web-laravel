<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AlatLab;
use Auth;
use Flash;
use Illuminate\Http\Request;
use Log;
use Yajra\DataTables\DataTables;
use Str;

class AlatController extends Controller {

    public function __construct() {
        // Page Title
        $this->module_title = 'Alat';

        // module name
        $this->module_name = 'alat';
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
            'backend.alat.index',
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
        $alat = AlatLab::all();
        $data = $alat;

        return Datatables::of($alat)
            ->editColumn('nama_alat', '<strong>{{$nama_alat}}</strong>')
            ->editColumn('merk', '<strong>{{$merk}}</strong>')
            ->editColumn('ukuran', '<strong>{{$ukuran . $satuan_ukuran}}</strong>')
            ->editColumn('jenis', '<strong>{{$jenis}}</strong>')
            ->addColumn('jumlah_tersedia', '<strong>{{ (int) $jumlah_stock - (int) $jumlah_dipinjam }}</strong>')
            ->addColumn('jumlah_dipinjam', '<strong>{{$jumlah_dipinjam}}</strong>')
            ->addColumn('jumlah_total', '<strong>{{$jumlah_stock}}</strong>')
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.alat_actions', compact('module_name', 'data'));
            })
            ->rawColumns([
                'nama_alat',
                'merk',
                'ukuran',
                'jenis',
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

        $alat = null;
        $satuanUkuranOptions = [
            'ml' => 'Ml',
            'cm' => 'Cm',
            'm' => 'M'
        ];
        $jenisOptions = [
            'kaca_gelas' => 'Kaca / Gelas',
            'plastik' => 'Plastik',
            'logam' => 'Logam',
            'karet' => 'Karet'
        ];

        return view(
            "backend.alat.edit",
            compact(
                'module_title',
                'module_name',
                'module_action',
                'alat',
                'satuanUkuranOptions',
                'jenisOptions'
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

        $alat = AlatLab::findOrFail($id);
        $satuanUkuranOptions = [
            'ml' => 'Ml',
            'cm' => 'Cm',
            'm' => 'M'
        ];
        $jenisOptions = [
            'kaca_gelas' => 'Kaca / Gelas',
            'plastik' => 'Plastik',
            'logam' => 'Logam',
            'karet' => 'Karet'
        ];

        return view(
            "backend.alat.edit",
            compact(
                'module_title',
                'module_name',
                'module_action',
                'alat',
                'satuanUkuranOptions',
                'jenisOptions'
            )
        );
    }


    public function store(Request $request) {
        $module_name = $this->module_name;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Details';

        $data_array = $request->except('_token');
        $$module_name_singular = AlatLab::create($data_array);
        $$module_name_singular->save();

        Flash::success("<i class='fas fa-check'></i> Alat Berhasil di Tambahkan")->important();

        return redirect("admin/alat");
    }

    public function update(Request $request, $id) {
        if (!Auth::user()->can('edit_users')) {
            abort(404);
        }

        $alat = AlatLab::findOrFail($id);

        $data = $request->except([]);
        $alat->update($data);

        Flash::success("<i class='fas fa-check'></i> Alat Berhasil di Edit")->important();

        return redirect("admin/alat");
    }

    public function show($id) {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_action = 'Deskripsi';

        $alat = AlatLab::findOrFail($id);

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
        $alat = AlatLab::findOrFail($id);
        $alat->delete();

        flash('<i class="fas fa-check"></i> ' . $alat->nama_alat . ' Alat Berhasil di Hapus')->success();


        return redirect("admin/alat");
    }
}
