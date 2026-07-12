@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Daftar Prosedur PPDB</h5>
            <a href="{{ route('admin.ppdb.prosedur.create') }}" class="btn btn-primary">
                Tambah Prosedur
            </a>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Label</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th style="width: 80px;">Order</th>
                        <th style="width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($prosedurs as $index => $prosedur)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $prosedur->label }}</td>
                            <td>{{ $prosedur->title }}</td>
                            <td>{{ Str::limit($prosedur->description, 80) }}</td>
                            <td>{{ $prosedur->order }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.ppdb.prosedur.show', $prosedur->id) }}"
                                       class="btn btn-sm btn-info">
                                        Lihat
                                    </a>
                                    <a href="{{ route('admin.ppdb.prosedur.edit', $prosedur->id) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.ppdb.prosedur.destroy', $prosedur->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                Belum ada data prosedur.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
@endsection