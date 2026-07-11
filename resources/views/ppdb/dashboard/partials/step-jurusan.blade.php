<div class="step-panel" data-step="3">
    <h2>Pilihan jurusan</h2>
    <p class="hint">Pilih satu jurusan sesuai minat kamu.</p>
    <div class="jurusan-grid" id="jurusanGrid">
        @foreach ($jurusanList as $j)
            <label class="jurusan-card @if($formulir->jurusan_id === $j->id) selected @endif" data-name="{{ $j->name }}">
                <input type="radio" name="jurusan_id" value="{{ $j->id }}" @checked($formulir->jurusan_id === $j->id)>
                <div class="name">{{ $j->name }}</div>
                <div class="desc">{{ Str::limit($j->short_description, 60) }}</div>
            </label>
        @endforeach
    </div>
    <span class="error-text" data-error="jurusan_id"></span>
</div>