@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Data Prestasi</h3>
            <a href="{{ route('admin.prestasi.create') }}" class="btn btn-primary">+ Tambah Prestasi</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Juara</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($prestasis as $prestasi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('uploads/prestasi/'.$prestasi->image) }}" width="120"></td>
                        <td>{{ $prestasi->juara }}</td>
                        <td>{{ $prestasi->nama_siswa }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($prestasi->deskripsi, 50) }}</td>
                        <td>{{ $prestasi->tahun }}</td>
                        <td>
                            <a href="{{ route('admin.prestasi.edit', $prestasi->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.prestasi.destroy', $prestasi->id) }}" method="POST" class="d-inline" onclick="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data prestasi.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection