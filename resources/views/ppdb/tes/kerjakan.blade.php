{{-- resources/views/ppdb/tes/kerjakan.blade.php --}}
@extends('ppdb.layouts.dashboard')

@section('title', 'Kerjakan Tes')

@section('content')
<div class="ppdb-tes-page">

    <div class="tes-topbar">
        <div>
            <h5>Kerjakan Soal Tes</h5>
            <p>Jawaban tersimpan otomatis setiap kamu memilih opsi.</p>
        </div>
        <div class="tes-timer" id="tes-timer">
            <i class="ti ti-clock"></i> <span id="timer-text">--:--:--</span>
        </div>
        <span class="tes-save-indicator" id="save-indicator">
            <i class="ti ti-check"></i> Tersimpan
        </span>
    </div>

    <div class="tes-grid">
        {{-- ===================== MAIN QUESTION CARD ===================== --}}
        <div class="tes-main-card">
            <div class="tes-progress-track">
                <div class="tes-progress-fill" id="progress-fill" style="width: 0%;"></div>
            </div>

            <form id="form-selesai" action="{{ route('ppdb.tes.selesai') }}" method="POST">
                @csrf

                @foreach($soal as $index => $item)
                    <div class="tes-question-page {{ $index === 0 ? 'is-active' : '' }}" data-index="{{ $index }}">
                        <div class="tes-question-head">
                            <span class="tes-question-number">
                                Soal <strong>{{ $index + 1 }}</strong> / {{ $soal->count() }}
                            </span>
                            <span class="tes-badge-type {{ $item->tipe_soal === 'akademik' ? 'akademik' : 'kejuruan' }}">
                                {{ $item->tipe_soal === 'akademik' ? 'Akademik' : 'Kejuruan' }}
                            </span>
                        </div>

                        <div class="tes-question-body">
                            <p class="tes-question-text">{{ $item->pertanyaan }}</p>

                            @foreach(['a', 'b', 'c', 'd'] as $opsi)
                                @php $teksOpsi = $item->{'opsi_' . $opsi}; @endphp
                                @if($teksOpsi)
                                    <label class="tes-option {{ ($jawabanTersimpan[$item->id] ?? null) === $opsi ? 'is-selected' : '' }}"
                                           for="soal{{ $item->id }}_{{ $opsi }}">
                                        <input class="jawaban-radio"
                                               type="radio"
                                               name="jawaban_{{ $item->id }}"
                                               id="soal{{ $item->id }}_{{ $opsi }}"
                                               value="{{ $opsi }}"
                                               data-soal-id="{{ $item->id }}"
                                               data-soal-index="{{ $index }}"
                                               {{ ($jawabanTersimpan[$item->id] ?? null) === $opsi ? 'checked' : '' }}>
                                        <span class="tes-option-circle">{{ strtoupper($opsi) }}</span>
                                        <span class="tes-option-label">{{ $teksOpsi }}</span>
                                    </label>
                                @endif
                            @endforeach
                        </div>

                        <div class="tes-nav">
                            <button type="button" class="btn-tes btn-tes-outline btn-nav-prev" {{ $index === 0 ? 'disabled' : '' }}>
                                <i class="ti ti-arrow-left"></i> Sebelumnya
                            </button>

                            @if($index === $soal->count() - 1)
                                <button type="button" class="btn-tes btn-tes-finish" id="btn-selesai">
                                    <i class="ti ti-flag-check"></i> Selesai Tes
                                </button>
                            @else
                                <button type="button" class="btn-tes btn-tes-primary btn-nav-next">
                                    Selanjutnya <i class="ti ti-arrow-right"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </form>
        </div>

        {{-- ===================== SIDEBAR NAVIGATOR ===================== --}}
        <div class="tes-sidebar">
            <div class="tes-sidebar-card">
                <div class="tes-ring-wrap">
                    <svg width="56" height="56" viewBox="0 0 56 56">
                        <circle cx="28" cy="28" r="24" fill="none" stroke="var(--tes-border)" stroke-width="6"></circle>
                        <circle id="ring-progress" cx="28" cy="28" r="24" fill="none" stroke="var(--tes-primary)"
                                stroke-width="6" stroke-linecap="round"
                                stroke-dasharray="150.8" stroke-dashoffset="150.8"
                                transform="rotate(-90 28 28)"></circle>
                    </svg>
                    <div class="tes-ring-text">
                        <span class="big" id="ring-count">0/{{ $soal->count() }}</span>
                        <span class="small">Terjawab</span>
                    </div>
                </div>

                <div class="tes-sidebar-title">Navigasi Soal</div>
                <div class="tes-number-grid" id="number-grid">
                    @foreach($soal as $index => $item)
                        <div class="tes-number {{ ($jawabanTersimpan[$item->id] ?? null) ? 'is-answered' : '' }} {{ $index === 0 ? 'is-current' : '' }}"
                             data-goto="{{ $index }}">
                            {{ $index + 1 }}
                        </div>
                    @endforeach
                </div>

                <div class="tes-legend">
                    <div class="tes-legend-item"><span class="tes-legend-dot answered"></span> Sudah dijawab</div>
                    <div class="tes-legend-item"><span class="tes-legend-dot current"></span> Soal saat ini</div>
                    <div class="tes-legend-item"><span class="tes-legend-dot"></span> Belum dijawab</div>
                </div>

                <button type="button" class="btn-tes btn-tes-finish w-100 justify-content-center" id="btn-selesai-sidebar">
                    <i class="ti ti-flag-check"></i> Selesai Tes
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ===================== MODAL KONFIRMASI SELESAI ===================== --}}
<div class="tes-modal-overlay" id="modal-selesai">
    <div class="tes-modal-box">
        <h6>Yakin ingin menyelesaikan tes?</h6>
        <p>Jawaban tidak dapat diubah lagi setelah tes diselesaikan. Pastikan semua soal sudah kamu jawab.</p>
        <div class="tes-modal-actions">
            <button type="button" class="btn-tes btn-tes-outline" id="modal-batal">Batal</button>
            <button type="button" class="btn-tes btn-tes-finish" id="modal-konfirmasi">Ya, Selesaikan</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        const saveIndicator = document.getElementById('save-indicator');
        const pages = Array.from(document.querySelectorAll('.tes-question-page'));
        const numberCells = Array.from(document.querySelectorAll('.tes-number'));
        const progressFill = document.getElementById('progress-fill');
        const ringProgress = document.getElementById('ring-progress');
        const ringCount = document.getElementById('ring-count');
        const totalSoal = pages.length;
        const ringCircumference = 150.8;

        let currentIndex = 0;
        const answered = new Set();
        numberCells.forEach(function (cell) {
            if (cell.classList.contains('is-answered')) {
                answered.add(parseInt(cell.dataset.goto, 10));
            }
        });

        function showPage(index) {
            if (index < 0 || index >= totalSoal) return;
            pages[currentIndex].classList.remove('is-active');
            pages[index].classList.add('is-active');
            currentIndex = index;
            updateSidebar();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function updateSidebar() {
            numberCells.forEach(function (cell) {
                const idx = parseInt(cell.dataset.goto, 10);
                cell.classList.toggle('is-current', idx === currentIndex);
                cell.classList.toggle('is-answered', answered.has(idx));
            });
            updateProgress();
        }

        function updateProgress() {
            const pct = totalSoal === 0 ? 0 : (answered.size / totalSoal) * 100;
            progressFill.style.width = pct + '%';
            ringProgress.style.strokeDashoffset = ringCircumference - (ringCircumference * pct / 100);
            ringCount.textContent = answered.size + '/' + totalSoal;
        }

        // Klik langsung ke nomor soal di sidebar
        numberCells.forEach(function (cell) {
            cell.addEventListener('click', function () {
                showPage(parseInt(this.dataset.goto, 10));
            });
        });

        // Tombol navigasi sebelumnya / selanjutnya di tiap halaman soal
        document.querySelectorAll('.btn-nav-prev').forEach(function (btn) {
            btn.addEventListener('click', function () { showPage(currentIndex - 1); });
        });
        document.querySelectorAll('.btn-nav-next').forEach(function (btn) {
            btn.addEventListener('click', function () { showPage(currentIndex + 1); });
        });

        // Auto-save tiap kali radio dipilih
        document.querySelectorAll('.jawaban-radio').forEach(function (radio) {
            radio.addEventListener('change', function () {
                const soalId = this.dataset.soalId;
                const soalIndex = parseInt(this.dataset.soalIndex, 10);
                const jawaban = this.value;

                // Update tampilan opsi terpilih di halaman ini
                const page = this.closest('.tes-question-page');
                page.querySelectorAll('.tes-option').forEach(function (opt) {
                    opt.classList.remove('is-selected');
                });
                this.closest('.tes-option').classList.add('is-selected');

                answered.add(soalIndex);
                updateSidebar();

                fetch("{{ route('ppdb.tes.jawab') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        soal_tes_id: soalId,
                        jawaban_dipilih: jawaban,
                    }),
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        saveIndicator.classList.add('is-visible');
                        setTimeout(() => saveIndicator.classList.remove('is-visible'), 1500);
                    }
                })
                .catch(err => console.error('Gagal menyimpan jawaban:', err));
            });
        });

        // Modal konfirmasi selesai tes
        const modal = document.getElementById('modal-selesai');
        function openModal() { modal.classList.add('is-open'); }
        function closeModal() { modal.classList.remove('is-open'); }

        document.getElementById('btn-selesai')?.addEventListener('click', openModal);
        document.getElementById('btn-selesai-sidebar').addEventListener('click', openModal);
        document.getElementById('modal-batal').addEventListener('click', closeModal);
        document.getElementById('modal-konfirmasi').addEventListener('click', function () {
            document.getElementById('form-selesai').submit();
        });
        modal.addEventListener('click', function (e) {
            if (e.target === modal) closeModal();
        });

        updateSidebar();

        // Sisa waktu (detik) dikirim dari server, sumber kebenaran
        let sisaDetik = Math.floor({{ $sisaDetik }});
        const timerText = document.getElementById('timer-text');
        const timerBox = document.getElementById('tes-timer');

        function formatWaktu(detik) {
            detik = Math.max(0, Math.floor(detik)); // pastikan selalu integer bulat & tidak minus
            const j = Math.floor(detik / 3600);
            const m = Math.floor((detik % 3600) / 60);
            const d = Math.floor(detik % 60);
            return [j, m, d].map(v => String(v).padStart(2, '0')).join(':');
        }

        function tickTimer() {
            if (sisaDetik <= 0) {
                clearInterval(timerInterval);
                timerText.textContent = '00:00:00';
                alert('Waktu pengerjaan tes sudah habis. Jawaban kamu akan otomatis disubmit.');
                document.getElementById('form-selesai').submit();
                return;
            }

            timerText.textContent = formatWaktu(sisaDetik);

            // Kasih warning visual kalau sisa waktu < 5 menit
            if (sisaDetik <= 300) {
                timerBox.classList.add('is-warning');
            }

            sisaDetik--;
        }

        tickTimer();
        const timerInterval = setInterval(tickTimer, 1000);
    });
</script>
@endpush