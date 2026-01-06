@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Jurusan</h1>
        <a href="{{ route('admin.jurusan.create') }}" class="btn btn-primary">
            + Tambah Jurusan
        </a>
    </div>

    <!-- FLASH MESSAGE -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- TABLE -->
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Jurusan</th>
                        <th>Deskripsi Singkat</th>
                        <th width="80">Order</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jurusans as $jurusan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jurusan->name }}</td>
                            <td>{{ Str::limit($jurusan->short_description, 80) }}</td>
                            <td>{{ $jurusan->order }}</td>
                            <td>
                                <a href="{{ route('admin.jurusan.edit', $jurusan->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.jurusan.destroy', $jurusan->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus jurusan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Data jurusan belum tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
