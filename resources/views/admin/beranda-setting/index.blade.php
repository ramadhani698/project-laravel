@extends('admin.layout')

@section('content')
    <div class="mb-4">
        <h3 class="mb-1">Beranda SPMB</h3>
        <p class="text-muted">Kelola konten yang tampil di halaman depan (banner, sambutan, kontak).</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Judul Utama</th>
                        <th>Sub Judul</th>
                        <th>Tahun Ajaran</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $settings->hero_main_title }}</td>
                        <td>{{ $settings->hero_sub_title }}</td>
                        <td>{{ $settings->hero_academic_year }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.beranda-setting.edit', $settings->id) }}"
                               class="btn btn-sm btn-warning">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection