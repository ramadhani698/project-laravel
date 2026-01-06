@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Sejarah Sekolah</h5>
            <a href="{{ route('admin.histories.create') }}" class="btn btn-primary">+ Tambah Sejarah</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Gambar</th>
                        <th>Isi</th>
                        <th>Posisi Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($histories as $history)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $history->title }}</td>
                        <td>
                            <img src="{{ asset('uploads/histories/'.$history->image) }}" width="120">
                        </td>
                        <td>{{ \Illuminate\Support\Str::limit($history->content, 100) }}</td>
                        <td>{{ $history->position }}</td>
                        <td>
                            <a href="{{ route('admin.histories.edit', $history->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.histories.destroy', $history->id) }}" method="POST" enctype="multipart/form-data" class="d-inline" onclick="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada sejarah</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection