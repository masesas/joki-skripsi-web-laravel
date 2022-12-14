<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AlatLab;
use App\Models\AlatPecah;
use App\Models\BahanLab;
use App\Models\Jadwal;
use App\Models\Peminjam;
use App\Models\User;
use Auth;

class BackendController extends Controller {
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $module_title = 'Beranda';

        $users = User::count();
        $alats = AlatLab::count();
        $bahans = BahanLab::count();
        $peminjams = Peminjam::count();
        $alatPecahs = AlatPecah::count();
        $jadwals = Jadwal::count();

        if(Auth::user()->status == 'laboran'){
            $color = 'red';
        }else{
            $color = 'blue';
        }

        return view('backend.index', compact(
            'module_title',
            'users',
            'alats',
            'bahans',
            'peminjams',
            'alatPecahs',
            'jadwals',
            'color'
        ));
    }
}
