@extends('admin.layout')

@section('content')

<div class="content-wrapper">

    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard Admin</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

                <div class="row">

                    <!-- Berita -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-primary dashboard-card">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fs-4 fw-semibold">
                                        {{ number_format($totalBerita) }}
                                    </div>
                                    <div class="text-medium-emphasis text-white">
                                        Total Berita
                                    </div>
                                </div>
                                <div class="fs-2 opacity-75">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                            </div>
                            <div class="card-footer px-3 py-2">
                                <a href="{{ route('admin.berita.index') }}"
                                class="text-white text-decoration-none fw-semibold">
                                    Lihat Detail
                                    <i class="fas fa-arrow-circle-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Jurusan -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-success dashboard-card">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fs-4 fw-semibold">
                                        {{ number_format($totalJurusan) }}
                                    </div>
                                    <div class="text-medium-emphasis text-white">
                                        Total Jurusan
                                    </div>
                                </div>
                                <div class="fs-2 opacity-75">
                                    <i class="fas fa-school"></i>
                                </div>
                            </div>
                            <div class="card-footer px-3 py-2">
                                <a href="{{ route('admin.jurusan.index') }}"
                                class="text-white text-decoration-none fw-semibold">
                                    Lihat Detail
                                    <i class="fas fa-arrow-circle-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Prestasi -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-warning dashboard-card">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fs-4 fw-semibold">
                                        {{ number_format($totalPrestasi) }}
                                    </div>
                                    <div class="text-medium-emphasis text-white">
                                        Total Prestasi
                                    </div>
                                </div>
                                <div class="fs-2 opacity-75">
                                    <i class="fas fa-trophy"></i>
                                </div>
                            </div>
                            <div class="card-footer px-3 py-2">
                                <a href="{{ route('admin.prestasi.index') }}"
                                class="text-white text-decoration-none fw-semibold">
                                    Lihat Detail
                                    <i class="fas fa-arrow-circle-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery -->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-primary dashboard-card">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fs-4 fw-semibold">
                                        {{ number_format($totalGallery) }}
                                    </div>
                                    <div class="text-medium-emphasis text-white">
                                        Total Gallery
                                    </div>
                                </div>
                                <div class="fs-2 opacity-75">
                                    <i class="fas fa-images"></i>
                                </div>
                            </div>
                            <div class="card-footer px-3 py-2">
                                <a href="{{ route('admin.gallery.index') }}"
                                class="text-white text-decoration-none fw-semibold">
                                    Lihat Detail
                                    <i class="fas fa-arrow-circle-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">

                        @foreach($statistiks as $stat)
                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-white bg-info dashboard-card">
                                <div class="card-body d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="fs-4 fw-semibold">
                                            {{ number_format($stat->value) }}
                                        </div>
                                        <div class="text-white">
                                            {{ $stat->label }}
                                        </div>
                                    </div>
                                    <div class="fs-2 opacity-75">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <div class="col-sm-6 col-lg-3 mt-4">
                        <div class="card text-white bg-secondary dashboard-card">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fs-4 fw-semibold">
                                        {{ number_format($totalFasilitas) }}
                                    </div>
                                    <div class="text-white">
                                        Total Fasilitas
                                    </div>
                                </div>
                                <div class="fs-2 opacity-75">
                                    <i class="fas fa-building"></i>
                                </div>
                            </div>
                            <div class="card-footer px-3 py-2">
                                <a href="{{ route('admin.sarpras.index') }}"
                                class="text-white text-decoration-none fw-semibold">
                                    Lihat Detail
                                    <i class="fas fa-arrow-circle-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

        </div>
    </section>

</div>

@endsection