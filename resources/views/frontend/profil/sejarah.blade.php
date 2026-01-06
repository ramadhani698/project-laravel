@extends('frontend.layouts.app')

@section('title', 'Sejarah Sekolah')

@section('content')

<section class="sejarah-section py-5" style="margin-top: 80px;">
    <div class="container">

        @forelse($histories as $history)
            <!-- SECTION 1 -->
            <div class="row align-items-center mb-5 {{ $history->position === 'right' ? 'flex-lg-row-reverse' : '' }}">

                <!-- GAMBAR -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    @if($history->image)
                        <img src="{{ asset('uploads/histories/'.$history->image) }}" alt="{{ $history->title }}" class="img-fluid sejarah-img">
                    @endif
                </div>

                <!-- KONTEN -->
                <div class="col-lg-6">
                    <h2 class="sejarah-title">{{ $history->title }}</h2>
                    <p class="sejarah-text">
                        {!! nl2br(e($history->content)) !!}
                    </p>
                </div>
            </div>
        @empty
            <!-- KALO DATA KOSONG -->
             <div class="text-center py-5">
                <h4>Sejarah sekolah belum tersedia</h4>
                <p class="text-muted">
                    Informasi akan ditambahkan dalam waktu dekat.
                </p>
             </div>
        @endforelse

    </div>
</section>

@endsection
