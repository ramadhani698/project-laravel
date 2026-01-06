@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Visi Misi</h5>
            <a href="{{ route('admin.vision.create') }}" class="btn btn-primary">+ Tambah Visi Misi</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Visi</th>
                        <th>Misi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($visions as $vision)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($vision->image)
                                    <img src="{{ asset('uploads/vision/'.$vision->image) }}" width="120">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>{{ \Illuminate\Support\Str::limit($vision->vision, 100) }}</td>
                            <td>{{ is_array ($vision->mission) ? count($vision->mission) : 0 }}</td>
                            <td>
                                <a href="{{ route('admin.vision.edit', $vision->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.vision.destroy', $vision->id) }}" method="POST" enctype="multipart/form-data" class="d-inline" onclick="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection