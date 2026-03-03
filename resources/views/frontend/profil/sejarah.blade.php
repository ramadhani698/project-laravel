@extends('frontend.layouts.app')

@section('title', 'Sejarah Sekolah')

@section('content')

<section class="sejarah-section py-5" style="margin-top: 80px;">
    <div class="container">
        @forelse($histories as $history)
        <div class="sejarah-wrapper">
            <img src="{{ asset('uploads/histories/'.$history->image) }}"
                class="sejarah-img">
            <h2>{{ $history->title }}</h2>

            <p>
                {!! nl2br(e($history->content)) !!}
            </p>

        </div>

        @empty
        <p>Tidak ada data</p>
        @endforelse
    </div>
</section>

@endsection
