@extends('admin.layout')

@section('title', 'Data Akun Pendaftar PPDB')

@section('content')

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Akun Pendaftar PPDB</h3>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Terdaftar Sejak</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pendaftars as $pendaftar)
                <tr>
                    <td>{{ $loop->iteration + ($pendaftars->currentPage() - 1) * $pendaftars->perPage() }}</td>
                    <td>{{ $pendaftar->nama_lengkap }}</td>
                    <td>{{ $pendaftar->email }}</td>
                    <td>{{ $pendaftar->no_hp }}</td>
                    <td>{{ $pendaftar->created_at->format('d M Y, H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.ppdb.pendaftar.destroy', $pendaftar) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus akun {{ $pendaftar->nama_lengkap }}? Data yang sudah dihapus tidak dapat dikembalikan.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <img src="{{ asset('coreui/assets/icons/trash.svg') }}" class="nav-icon" alt="Hapus" style="width: 0.9em; height: 0.9em; filter: invert(1);">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada pendaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $pendaftars->links() }}
    </div>
</div>
@endsection