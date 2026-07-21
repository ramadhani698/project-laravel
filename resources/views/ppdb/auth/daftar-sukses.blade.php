@extends('ppdb.layouts.auth')

@section('title', 'Akun Berhasil Dibuat')

@section('brand-content')
    <h1>Langkah pertama selesai!</h1>
    <p>Akunmu sudah tersimpan. Tinggal satu langkah lagi sebelum bisa mengisi biodata dan mengunggah berkas.</p>

    <ul class="step-list">
        <li class="step-done">
            <div class="step-num"><i class="ti ti-check"></i></div>
            <div class="step-text">
                <strong>Buat akun</strong>
                <span>Selesai — akunmu sudah aktif</span>
            </div>
        </li>
        <li class="step-active">
            <div class="step-num">2</div>
            <div class="step-text">
                <strong>Masuk ke akunmu</strong>
                <span>Login untuk lanjut ke pengisian data</span>
            </div>
        </li>
        <li>
            <div class="step-num">3</div>
            <div class="step-text">
                <strong>Lengkapi data &amp; berkas</strong>
                <span>Isi biodata, data orang tua, dan unggah dokumen</span>
            </div>
        </li>
    </ul>
@endsection

@section('content')
<div class="sukses-panel">

    <canvas class="sukses-particles" aria-hidden="true"></canvas>

    <div class="sukses-icon-wrap">
        <svg class="sukses-check" viewBox="0 0 80 80" fill="none">
            <circle class="sukses-check-ring" cx="40" cy="40" r="36" stroke-width="4"/>
            <path class="sukses-check-mark" d="M24 41 L35 52 L57 28" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>

    <h2 class="sukses-title">Akun berhasil dibuat</h2>
    <p class="sukses-desc">
        Silakan login terlebih dahulu untuk melanjutkan pengisian biodata dan pengumpulan berkas.
    </p>

    <div class="sukses-info-box">
        <div class="sukses-info-row">
            <span class="k"><i class="ti ti-user"></i> Nama</span>
            <span class="v">{{ $nama }}</span>
        </div>
        @if($email)
        <div class="sukses-info-row">
            <span class="k"><i class="ti ti-mail"></i> Email</span>
            <span class="v">{{ $email }}</span>
        </div>
        @endif
    </div>

    <a href="{{ route('ppdb.auth.login') }}" class="btn btn-ppdb-primary w-100 sukses-btn">
        Masuk sekarang <i class="ti ti-arrow-right ms-1"></i>
    </a>

    <p class="sukses-redirect-note">
        Otomatis diarahkan ke halaman login dalam <span id="susdetik">8</span> detik...
    </p>
</div>
@endsection

@push('styles')
<style>
    .sukses-panel {
        position: relative;
        overflow: hidden;
        text-align: center;
        padding: 8px 4px 4px;
    }
    .sukses-particles {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }

    .sukses-icon-wrap {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: center;
        margin-bottom: 18px;
    }
    .sukses-check { width: 84px; height: 84px; }
    .sukses-check-ring {
        stroke: color-mix(in srgb, var(--ppdb-green-700) 55%, #cfe3d2);
        fill: none;
        stroke-dasharray: 226;
        stroke-dashoffset: 226;
        animation: susRingDraw .6s ease-out forwards;
    }
    .sukses-check-mark {
        stroke: var(--ppdb-green-700);
        fill: none;
        stroke-dasharray: 46;
        stroke-dashoffset: 46;
        animation: susMarkDraw .45s ease-out .5s forwards;
    }
    @keyframes susRingDraw { to { stroke-dashoffset: 0; } }
    @keyframes susMarkDraw { to { stroke-dashoffset: 0; } }

    .sukses-title {
        position: relative;
        z-index: 1;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 22px;
        margin-bottom: 8px;
        color: var(--ppdb-ink, #222);
        opacity: 0;
        animation: susFadeUp .5s ease .35s forwards;
    }
    .sukses-desc {
        position: relative;
        z-index: 1;
        font-size: 14px;
        color: #666;
        max-width: 380px;
        margin: 0 auto 20px;
        opacity: 0;
        animation: susFadeUp .5s ease .45s forwards;
    }

    .sukses-info-box {
        position: relative;
        z-index: 1;
        background: color-mix(in srgb, var(--ppdb-green-700) 6%, white);
        border: 1px solid color-mix(in srgb, var(--ppdb-green-700) 18%, white);
        border-radius: 14px;
        padding: 14px 18px;
        margin-bottom: 20px;
        text-align: left;
        opacity: 0;
        animation: susFadeUp .5s ease .55s forwards;
    }
    .sukses-info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
        padding: 4px 0;
    }
    .sukses-info-row .k { color: #777; display: flex; align-items: center; gap: 6px; }
    .sukses-info-row .v { font-weight: 600; color: #222; }

    .sukses-btn {
        position: relative;
        z-index: 1;
        opacity: 0;
        animation: susFadeUp .5s ease .65s forwards;
    }
    .sukses-redirect-note {
        position: relative;
        z-index: 1;
        font-size: 12px;
        color: #999;
        margin-top: 14px;
        opacity: 0;
        animation: susFadeUp .5s ease .75s forwards;
    }

    @keyframes susFadeUp {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* Step list: state "done" & "active" tambahan */
    .step-list .step-done .step-num {
        background: #2e7d32;
        color: #fff;
    }
    .step-list .step-active .step-num {
        background: var(--ppdb-gold);
        color: #3a2e00;
    }

    @media (prefers-reduced-motion: reduce) {
        .sukses-check-ring, .sukses-check-mark,
        .sukses-title, .sukses-desc, .sukses-info-box,
        .sukses-btn, .sukses-redirect-note {
            animation: none !important;
            opacity: 1 !important;
            stroke-dashoffset: 0 !important;
            transform: none !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ===================== Countdown auto-redirect ===================== */
    const loginUrl = "{{ route('ppdb.auth.login') }}";
    const counterEl = document.getElementById('susdetik');
    let sisa = 8;
    let timer = null;

    if (counterEl) {
        timer = setInterval(function () {
            sisa -= 1;
            counterEl.textContent = sisa;
            if (sisa <= 0) {
                clearInterval(timer);
                window.location.href = loginUrl;
            }
        }, 1000);
    }

    // Batalkan auto-redirect kalau siswa klik tombol/link manapun di halaman
    document.querySelectorAll('a, button').forEach(function (el) {
        el.addEventListener('click', function () {
            if (timer) clearInterval(timer);
        });
    });

    /* ===================== Partikel halus sekali burst ===================== */
    if (prefersReducedMotion) return;

    const canvas = document.querySelector('.sukses-particles');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    const parent = canvas.parentElement;
    const colors = ['#2e7d32', '#d6af36', '#8fbf94'];
    let width, height, pieces, startTime;
    const DURATION = 1800;

    function resize() {
        width = canvas.width = parent.offsetWidth;
        height = canvas.height = parent.offsetHeight;
    }

    function makePiece() {
        const angle = Math.random() * Math.PI * 2;
        const speed = 1 + Math.random() * 2.2;
        return {
            x: width / 2,
            y: height * 0.28,
            vx: Math.cos(angle) * speed,
            vy: Math.sin(angle) * speed - 1,
            r: 1.5 + Math.random() * 2,
            color: colors[Math.floor(Math.random() * colors.length)],
        };
    }

    function init() {
        resize();
        pieces = Array.from({ length: 26 }, makePiece);
        startTime = performance.now();
        requestAnimationFrame(tick);
    }

    function tick(now) {
        const elapsed = now - startTime;
        ctx.clearRect(0, 0, width, height);
        const fade = Math.max(0, 1 - elapsed / DURATION);

        pieces.forEach(p => {
            p.x += p.vx;
            p.y += p.vy;
            p.vy += 0.03; // gravitasi ringan

            ctx.beginPath();
            ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
            ctx.globalAlpha = fade;
            ctx.fillStyle = p.color;
            ctx.fill();
        });

        if (elapsed < DURATION) {
            requestAnimationFrame(tick);
        } else {
            ctx.clearRect(0, 0, width, height);
        }
    }

    setTimeout(init, 550); // nunggu checkmark selesai digambar dulu
    window.addEventListener('resize', resize);
});
</script>
@endpush