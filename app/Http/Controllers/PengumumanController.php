<?php

namespace App\Http\Controllers;
use App\Models\Pengumuman;

use Illuminate\Http\Request;

class PengumumanController extends Controller
{
        public function index()
    {

        $user = auth()->user();
        if (!$user) abort(403);
        
        $pengumuman = Pengumuman::orderBy('created_at', 'desc')->get();

        return view('pengumuman.index', compact('pengumuman'));
    }
}
