<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;

class SuratController extends Controller
{
    public function daftarSurat() 
    {
    // Eager Loading relasi penduduk untuk menghemat query
    $semuaSurat = Surat::with('penduduk')->get();
    return view('surat_index', compact('semuaSurat'));
    }
}
