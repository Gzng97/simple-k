@extends('layout.app')
@section('content')
<div class="card p-4">
<h3>Daftar Pengajuan Surat Kelurahan</h3>
<div class="card p-4">
 <div class="d-flex justify-content-between align-items-center mb-3">

 <!-- BUTTON TAMBAH: Mengarah ke rute surat.create -->
 <a href="{{ route('surat.create') }}" class="btn btn-primary btnsm">
 <i class="fas fa-plus-circle-notch mr-1"></i> Tambah Pengajuan
Surat
 </a>
 </div>
 <!-- FLASH SESSION: Menampilkan notifikasi sukses setelah redirect -->
 @if(session('sukses'))
 <div class="alert alert-success alert-dismissible fade show"
role="alert">
 <i class="icon fas fa-check-circle mr-2"></i> {{
session('sukses') }}
 <button type="button" class="close" data-dismiss="alert" arialabel="Close">
 <span aria-hidden="true">&times;</span>
 </button>
 </div>
 @endif

<table class="table table-striped table-bordered mt-3">
<thead>
    <tr>
        <th>No Surat</th>
        <th>Jenis Surat</th>
        <th>Nama Pemohon</th>
        <th>NIK Pemohon</th>
        <th>Tanggal Ajuan</th>
    </tr>
</thead>
<tbody>
@foreach($semuaSurat as $s)
    <tr>
        <td>{{ $s->nomor_surat }}</td>
        <td>{{ $s->jenis_surat }}</td>
        <td>{{ $s->penduduk->nama }}</td>
        <td>{{ $s->penduduk->nik }}</td>
        <td>{{ $s->tanggal_ajuan }}</td>
    </tr>
@endforeach
</tbody>
</table>
</div>
@endsection
