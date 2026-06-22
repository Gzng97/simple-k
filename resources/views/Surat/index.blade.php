@extends('layout.app')
@section('content')
<div class="card p-4">
    <h3>Daftar Pengajuan Surat Kelurahan</h3>
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">

            <a href="{{ route('surat.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus-circle-notch mr-1"></i> Tambah Pengajuan Surat
            </a>
        </div>
        
        @if(session('sukses'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="icon fas fa-check-circle mr-2"></i> {{ session('sukses') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
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
                    <th>Berkas Pendukung</th>
                    <th>Aksi</th>
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
                    
                    <td>
                        @if($s->berkas_pendukung)
                            @php
                                $ext = strtolower(pathinfo($s->berkas_pendukung, PATHINFO_EXTENSION));
                            @endphp

                            @if(in_array($ext, ['jpg', 'png']))
                                <a href="{{ asset('storage/' . $s->berkas_pendukung) }}" target="_blank">
                                    <img
                                        src="{{ asset('storage/' . $s->berkas_pendukung) }}"
                                        alt="Berkas Pendukung"
                                        class="rounded shadow-sm border"
                                        style="width: 58px; height: 58px; object-fit: cover;">
                                </a>
                            @elseif($ext === 'pdf')
                                <a href="{{ asset('storage/' . $s->berkas_pendukung) }}" target="_blank" class="btn btn-outline-danger btn-sm">
                                    Lihat PDF
                                </a>
                            @else
                                <span class="badge bg-secondary">File tersedia</span>
                            @endif
                        @else
                            <span class="badge bg-warning text-dark">Belum ada berkas</span>
                        @endif
                    </td>

                    <td>
                        <div class="d-flex gap-1 flex-wrap">
                            <!-- Tombol Cetak -->
                            <a href="{{ route('surat.cetak', $s->id) }}" class="btn btn-primary btn-sm" target="_blank">
                                Cetak PDF
                            </a>

                            <!-- Tombol Edit -->
                            <a href="{{ route('surat.edit', $s->id) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('surat.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection