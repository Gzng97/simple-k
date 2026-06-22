<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semuaSurat = Surat::with('penduduk')->get();
        return view('surat.index', compact('semuaSurat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil data penduduk untuk pilihan dropdown di form
        $penduduk = Penduduk::all();
        return view('surat.create', compact('penduduk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Eksekusi Aturan Validasi Server-Side
        $validatedData = $request->validate([
            'nomor_surat'      => 'required|unique:surats,nomor_surat|max:50',
            'jenis_surat'      => 'required',
            'penduduk_id'      => 'required|numeric',
            'tanggal_ajuan'    => 'required|date',
            // Tambahan validasi untuk file dari tutorial
            'berkas_pendukung' => 'nullable|file|mimes:jpg,png,pdf|max:2048'
        ], [
            'nomor_surat.required' => 'Nomor surat wajib diisi.',
            'nomor_surat.unique'   => 'Nomor surat tersebut sudah terdaftar di sistem.',
            'jenis_surat.required' => 'Silakan pilih jenis surat.',
            'penduduk_id.required' => 'Warga pemohon wajib dipilih.',
            'berkas_pendukung.mimes'=> 'Format file pendukung harus berupa JPG, PNG, atau PDF.',
            'berkas_pendukung.max'  => 'Ukuran file pendukung maksimal 2MB.'
        ]);

        // 2. Logika Upload File (Ditambahkan sebelum insert ke database)
        if ($request->hasFile('berkas_pendukung')) {
            $namaFile = time() . '_' . $request->file('berkas_pendukung')->getClientOriginalName();
            $path = $request->file('berkas_pendukung')->storeAs('berkas_surat', $namaFile, 'public');
            
            // Simpan path/lokasi file ke dalam array $validatedData
            $validatedData['berkas_pendukung'] = $path;
        }

        // 3. Simpan ke Database Menggunakan Mass Assignment Eloquent
        Surat::create($validatedData);

        // 4. Redirect dengan Flash Session
        return redirect()->route('surat.index')->with('sukses', 'Surat permohonan berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Method untuk mencetak PDF
     */
    public function cetakPdf($id)
    {
        $surat = Surat::findOrFail($id);

        $pdf = Pdf::loadView('surat.cetak', compact('surat'));

        // Mengubah karakter '/' menjadi '-' agar tidak memicu error direktori Windows
        $nomorAman = str_replace('/', '-', $surat->nomor_surat);
        $namaFile = 'Surat_Kelurahan_' . $nomorAman . '.pdf';

        return $pdf->stream($namaFile);
    }
}