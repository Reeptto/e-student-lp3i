<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;
use App\Models\Krs;

class KrsController extends Controller
{
    
   public function index()
{
    $subjects = Matakuliah::with('krs')->get();



    return view('krs.index', compact('subjects'));
}


}
