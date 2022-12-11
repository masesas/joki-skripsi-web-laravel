<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Auth;

class BackendController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.index');
    }
}
