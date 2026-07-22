@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 fw-bold">Kata Kepala Sekolah</h1>
            <p class="text-muted mb-0 small">Kelola sambutan kepala sekolah yang ditampilkan di halaman utama sekolah.</p>
        </div>

        @if (!$principalMessage)
            <a href="{{ route('admin.principal-message.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus me-1"></i> Tambah Data
            </a>
        @endif
    </div>

    <!-- FLASH MESSAGE -->
    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center shadow-sm border-0" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @if ($principalMessage)
        <!-- DATA CARD -->
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <div class="row g-4">

                    <!-- PHOTO -->
                    <div class="col-md-3 text-center">
                        @if ($principalMessage->photo)
                            <img src="{{ Storage::url('principal-message/photo/'.$principalMessage->photo) }}"
                                class="rounded-4 shadow-sm mb-2"
                                style="width:100%;max-width:180px;height:180px;object-fit:cover;">
                        @else
                            <div class="rounded-4 bg-light d-flex align-items-center justify-content-center text-muted mx-auto mb-2"
                                style="width:180px;height:180px;">
                                <i class="fas fa-user fa-2x"></i>
                            </div>
                        @endif
                        <div class="fw-semibold">{{ $principalMessage->nama ?? '-' }}</div>
                        <div class="text-muted small">{{ $principalMessage->position ?? '-' }}</div>
                    </div>

                    <!-- DETAIL -->
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="fw-bold mb-1">{{ $principalMessage->title }}</h5>
                                @if ($principalMessage->greeting)
                                    <p class="text-muted mb-0 small fst-italic">{{ $principalMessage->greeting }}</p>
                                @endif
                            </div>
                            <div class="d-inline-flex gap-1 flex-shrink-0">
                                <a href="{{ route('admin.principal-message.edit', $principalMessage->id) }}"
                                   class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.principal-message.destroy', $principalMessage->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        @if ($principalMessage->header_image)
                            <img src="{{ Storage::url('principal-message/header-image/'.$principalMessage->header_image) }}"
                                class="img-fluid rounded-3 shadow-sm mb-3"
                                style="width:100%;max-height:220px;object-fit:cover;">
                        @endif

                        <p class="text-muted mb-0" style="white-space: pre-line;">
                            {{ Str::limit($principalMessage->content, 400) }}
                        </p>
                    </div>

                </div>
            </div>
        </div>
    @else
        <!-- EMPTY STATE -->
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center py-5">
                <i class="fas fa-comment-dots fa-2x text-muted mb-2 d-block"></i>
                <span class="text-muted">Data kata kepala sekolah belum ada</span>
            </div>
        </div>
    @endif

</div>
@endsection