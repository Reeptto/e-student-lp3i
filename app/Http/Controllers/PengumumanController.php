<?php

namespace App\Http\Controllers;
use App\Models\Pengumuman;

use Illuminate\Http\Request;

class PengumumanController extends Controller
{
        public function index()
    {
        return view('pengumuman.index');
    }
}
