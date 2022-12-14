<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AlatLab;
use App\Models\BahanLab;
use App\Models\HistoryPeminjam;
use App\Models\Peminjam;
use App\Models\User;
use DataTables;
use DB;
use Exception;
use Flash;
use Illuminate\Http\Request;
use Str;
use Throwable;

class PeminjamController extends Controller {
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
            'backend.peminjam.index',
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
        $peminjam = Peminjam::withUser();
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
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.peminjam_actions', compact('module_name', 'data'));
            })
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
        $bahans = BahanLab::all();
        $peminjam = null;

        return view(
            "backend.peminjam.edit",
            compact(
                'module_title',
                'module_name',
                'module_action',
                'peminjam',
                'users',
                'alats',
                'bahans'
            )
        );
    }

    public function store(Request $request) {
        DB::beginTransaction();
        try {
            \Log::info('request', $request->all());
            $request->validate([
                'user' => 'required',
                'jumlah_alat' => "required_with:alat",
                'jumlah_bahan' => "required_with:bahan",
            ]);


            if ((int)$request->alat != 0) {
                $alat = AlatLab::findOrFail($request->alat);
                if ($alat->jumlah_stock < $request->jumlah_alat) {
                    throw new Exception('Jumlah Pinjam Alat Melebihi Stock Tersedia');
                }
            }
            if ((int) $request->bahan != 0) {
                $bahan = BahanLab::findOrFail($request->bahan);
                if ($bahan->jumlah_stock < $request->jumlah_bahan) {
                    throw new Exception('Jumlah Pinjam Bahan Melebihi Stock Tersedia');
                }
            }

            if ((int)$request->bahan == 0 && (int) $request->alat == 0) {
                throw new Exception('Pinjaman Harus Menyertakan Alat Atau Bahan');
            }

            $data = [
                'user_id' => (int) $request->user,
                'alat_id' => (int)$request->alat,
                'bahan_id' => (int) $request->bahan,
                'jumlah_alat' => (int) $request->jumlah_alat,
                'jumlah_bahan' => (int) $request->jumlah_bahan,
            ];

            $peminjam = Peminjam::create($data);
            $peminjam->save();

            if ((int)$request->alat != 0) {
                AlatLab::where('ID', $request->alat)->update([
                    'jumlah_stock' => DB::raw('jumlah_stock - ' . $request->jumlah_alat),
                    'jumlah_dipinjam' => DB::raw('jumlah_dipinjam + ' . $request->jumlah_alat),
                ]);
            }
            if ((int) $request->bahan != 0) {
                \Log::info('bahan update');
                BahanLab::where('ID', $request->bahan)->update([
                    'jumlah_stock' => DB::raw('jumlah_stock - ' . $request->jumlah_bahan),
                    'jumlah_dipinjam' => DB::raw('jumlah_dipinjam + ' . $request->jumlah_bahan),
                ]);
            }


            $historyPeminjam = HistoryPeminjam::create($data);
            $historyPeminjam->save();

            DB::commit();
            Flash::success("<i class='fas fa-check'></i> Peminjam Berhasil di Tambahkan")->important();

            return redirect("admin/peminjam");
        } catch (Throwable $e) {
            \Log::error("error savepeminjam >>> " . $e);
            DB::rollBack();
            Flash::error($e->getMessage());

            return redirect()->back();
        }
    }

    public function show($id) {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_action = 'Deskripsi';

        $alat = Peminjam::findOrFail($id);

        return view(
            "backend.peminjam.show",
            compact(
                'module_title',
                'module_name',
                'module_action',
                'alat',
            )
        );
    }


    public function destroy($id) {
        $peminjam = Peminjam::findOrFail($id);

        if((int) $peminjam->jumlah_alat > 0){
            AlatLab::where('ID', $peminjam->alat_id)->update([
                'jumlah_stock' => DB::raw('jumlah_stock + ' . $peminjam->jumlah_alat),
                'jumlah_dipinjam' => DB::raw('jumlah_dipinjam - ' . $peminjam->jumlah_alat),
            ]);
        }
        if ((int) $peminjam->jumlah_bahan > 0) {
            BahanLab::where('ID', $peminjam->bahan_id)->update([
                'jumlah_stock' => DB::raw('jumlah_stock + ' . $peminjam->jumlah_bahan),
                'jumlah_dipinjam' => DB::raw('jumlah_dipinjam - ' . $peminjam->jumlah_bahan),
            ]);
        }

        $peminjam->delete();

        flash('<i class="fas fa-check"></i> Peminjam Berhasil di Hapus, Stock Alat atau Bahan Telah di Kembalikan')->success();

        return redirect("admin/peminjam");
    }

    public function history() {
        $module_title = $this->module_title;
        $module_name = $this->module_name;

        $module_action = 'Daftar';

        $page_heading = ucfirst($module_title);
        $title = ucfirst($module_action) . ' ' . $page_heading;

        return view(
            'backend.peminjam.index',
            compact(
                'module_title',
                'module_name',
                'module_action',
                'page_heading',
            )
        );
    }
}
