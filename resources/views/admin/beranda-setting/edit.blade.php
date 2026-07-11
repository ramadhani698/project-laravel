@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Pengaturan Beranda</h5>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.beranda-setting.update') }}" method="POST">
                @csrf
                @method('PUT')

                <h6 class="mt-2 mb-3">Bagian Banner (bagian paling atas halaman depan)</h6>

                <div class="mb-3">
                    <label class="form-label">Label Kecil di Atas Judul</label>
                    <input type="text" name="hero_badge_text" class="form-control" value="{{ old('hero_badge_text', $settings->hero_badge_text) }}">
                    <small class="text-muted">Tulisan kecil yang muncul di atas judul besar, contoh: "Terakreditasi A"</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul Utama</label>
                    <input type="text" name="hero_main_title" class="form-control" value="{{ old('hero_main_title', $settings->hero_main_title) }}">
                    <small class="text-muted">Judul paling besar dan mencolok di banner, contoh nama sekolah</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sub Judul</label>
                    <input type="text" name="hero_sub_title" class="form-control" value="{{ old('hero_sub_title', $settings->hero_sub_title) }}">
                    <small class="text-muted">Kalimat pendamping di bawah judul utama, contoh: "Mencetak Generasi Unggul"</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun Ajaran</label>
                    <input type="text" name="hero_academic_year" class="form-control" value="{{ old('hero_academic_year', $settings->hero_academic_year) }}">
                    <small class="text-muted">Contoh: "2025/2026"</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan Tanggal</label>
                    <input type="text" name="hero_date_label" class="form-control" value="{{ old('hero_date_label', $settings->hero_date_label) }}">
                    <small class="text-muted">Nama untuk tanggal di bawah ini, contoh: "Pendaftaran ditutup"</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="text" name="hero_date_value" class="form-control" value="{{ old('hero_date_value', $settings->hero_date_value) }}">
                    <small class="text-muted">Isi tanggalnya, contoh: "31 Juli 2026"</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sub Logo</label>
                    <input type="text" name="hero_logo_sub" class="form-control" value="{{ old('hero_logo_sub', $settings->hero_logo_sub) }}">
                    <small class="text-muted">Teks kecil di bawah nama sekolah pada kotak logo, contoh: nama kota</small>
                </div>

                <hr>
                <h6 class="mt-2 mb-3">Kontak Cepat</h6>

                <div class="mb-3">
                    <label class="form-label">URL Instagram</label>
                    <input type="text" name="instagram_url" class="form-control" value="{{ old('instagram_url', $settings->instagram_url) }}">
                    <small class="text-muted">Link profil Instagram, contoh: https://instagram.com/namaakun</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Handle Instagram</label>
                    <input type="text" name="instagram_handle" class="form-control" value="{{ old('instagram_handle', $settings->instagram_handle) }}">
                    <small class="text-muted">Nama akun yang ditampilkan, contoh: @smkmudatangerang</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor WhatsApp</label>
                    <input type="text" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', $settings->whatsapp_number) }}">
                    <small class="text-muted">Nomor yang muncul di beranda untuk pengunjung yang mau tanya-tanya. Contoh: 0817-6988-475</small>
                </div>

                <hr>
                <h6 class="mt-2 mb-3">Bagian Sambutan</h6>

                <div class="mb-3">
                    <label class="form-label">Judul Sambutan</label>
                    <input type="text" name="welcome_heading" class="form-control" value="{{ old('welcome_heading', $settings->welcome_heading) }}">
                    <small class="text-muted">Contoh: "Sambutan Kepala Sekolah"</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Paragraf 1</label>
                    <textarea name="welcome_paragraph_1" rows="4" class="form-control">{{ old('welcome_paragraph_1', $settings->welcome_paragraph_1) }}</textarea>
                    <small class="text-muted">Alinea pembuka sambutan. Boleh pakai tag HTML, misal &lt;a href="..."&gt;teks&lt;/a&gt;</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Paragraf 2</label>
                    <textarea name="welcome_paragraph_2" rows="4" class="form-control">{{ old('welcome_paragraph_2', $settings->welcome_paragraph_2) }}</textarea>
                    <small class="text-muted">Alinea isi sambutan</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Paragraf 3</label>
                    <textarea name="welcome_paragraph_3" rows="4" class="form-control">{{ old('welcome_paragraph_3', $settings->welcome_paragraph_3) }}</textarea>
                    <small class="text-muted">Alinea penutup sambutan</small>
                </div>

                <hr>
                <h6 class="mt-2 mb-3">Kontak</h6>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address', $settings->address) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Telepon</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $settings->phone) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">URL Website</label>
                    <input type="text" name="website_url" class="form-control" value="{{ old('website_url', $settings->website_url) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $settings->email) }}">
                </div>

                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
@endsection