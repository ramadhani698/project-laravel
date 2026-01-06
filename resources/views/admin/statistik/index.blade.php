@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Statistik Sekolah</h5>
            <a href="{{ route('admin.statistik.create') }}" class="btn btn-primary btn-sm">+ Tambah Statistik</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Statistik</th>
                        <th>Label</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($statistiks as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->value }}</td>
                            <td>{{ $item->label }}</td>
                            <td>
                                <a href="{{ route('admin.statistik.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.statistik.destroy', $item->id) }}" method="POST" enctype="multipart/form-data" class="d-inline" onclick="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection