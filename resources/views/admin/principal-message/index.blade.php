@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Kata Kepala Sekolah</h5>

            @if (!$principalMessage)
                <a href="{{ route('admin.principal-message.create') }}"
                class="btn btn-primary btn-sm">
                    + Tambah Data
                </a>
            @endif
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
                        <th width="50">No</th>
                        <th>Judul</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tbody>
                    @if ($principalMessage)
                        <tr>
                            <td>1</td>
                            <td>{{ $principalMessage->title }}</td>
                            <td>{{ $principalMessage->nama ?? '-' }}</td>
                            <td>{{ $principalMessage->position ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.principal-message.edit', $principalMessage->id) }}"
                                class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.principal-message.destroy', $principalMessage->id) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="5" class="text-center">
                                Data kata kepala sekolah belum ada
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </tbody>
            </table>
            
        </div>
    </div>
@endsection
