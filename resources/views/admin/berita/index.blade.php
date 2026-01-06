@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Berita Sekolah</h5>
            <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">+ Tambah Berita</a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Gambar</th>
                        <th>Status</th>
                        <th>Tanggal Publish</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beritas as $berita)
                    <tr>
                        <td>{{ $beritas->firstItem() + $loop->index }}</td>
                        <td>{{ $berita->title }}</td>
                        <td><img src="{{ asset('uploads/berita/'.$berita->image) }}" width="120"></td>
                        <td>
                            @if($berita->status== 'publish')
                                <span class="badge bg-success">Publish</span>
                            @else
                                <span class="badge bg-warning">Draft</span>
                            @endif
                        </td>
                        <td>{{ optional($berita->published_at)->format('d M Y') ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" enctype="multipart/form-data" class="d-inline" onclick="return confirm('Yakin berita ini ingin dihapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada berita</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $beritas->links() }}
            </div>
        </div>
    </div>
@endsection