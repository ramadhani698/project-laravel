@extends('admin.layout')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Data Fasilitas</h5>
            <a href="{{ route('admin.sarpras.create') }}" class="btn btn-primary">+ Tambah Data</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Icon</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sarpras as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->icon }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($item->description,50) }}</td>
                            <td>
                                <a href="{{ route('admin.sarpras.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.sarpras.destroy', $item->id) }}" method="POST" class="d-inline" onclick="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </th>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection