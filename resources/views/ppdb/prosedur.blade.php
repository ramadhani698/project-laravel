@extends('ppdb.layouts.app')

@section('title', 'Prosedur Pendaftaran')

@section('content')
<div class="page-title">Prosedur Pendaftaran</div>

<div class="wrapper">
  <div class="sidebar">
    <div class="tab active" onclick="showTab('prosedur', this)">Prosedur Pendaftaran</div>
    <div class="tab" onclick="showTab('ulang', this)">Daftar Ulang</div>

    <div class="sidebar-icon">
      <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="14" y="8" width="26" height="34" rx="2" fill="#f2b90c" stroke="#0b3d1e" stroke-width="2"/>
        <line x1="19" y1="16" x2="35" y2="16" stroke="#0b3d1e" stroke-width="2"/>
        <line x1="19" y1="22" x2="35" y2="22" stroke="#0b3d1e" stroke-width="2"/>
        <line x1="19" y1="28" x2="30" y2="28" stroke="#0b3d1e" stroke-width="2"/>
        <circle cx="46" cy="40" r="12" fill="#0b3d1e"/>
        <path d="M40 40 L44 44 L52 34" stroke="#fff" stroke-width="3" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>
  </div>

  <div class="content" id="prosedur">
    <h2>Prosedur Pendaftaran:</h2>
    <div class="steps">
      <div class="step-row"><span class="num">1.</span> Melihat informasi PPDB dan sekolah melalui website resmi.</div>
      <div class="step-row"><span class="num">2.</span> Membuat akun pendaftaran dengan mengunjungi menu <b>"Pendaftaran"</b>, lalu mengisi data awal calon peserta didik.</div>
      <div class="step-row"><span class="num">3.</span> Membayar biaya pendaftaran melalui teller bank, ATM, atau mobile banking. Akun akan aktif otomatis setelah pembayaran terverifikasi.</div>
      <div class="step-row"><span class="num">4.</span> Login di website menggunakan <b>User ID</b> dan <b>Password</b>, lalu melengkapi formulir. Kolom bertanda bintang (*) wajib diisi.</div>
      <div class="step-row"><span class="num">5.</span> Mengunggah dokumen persyaratan seperti kartu keluarga, akta kelahiran, rapor, dan pas foto pada menu <b>"Upload Dokumen"</b>.</div>
      <div class="step-row"><span class="num">6.</span> Panitia memverifikasi berkas calon peserta didik yang sudah diunggah.</div>
      <div class="step-row"><span class="num">7.</span> Mengikuti tes seleksi sesuai dengan jadwal yang sudah ditentukan.</div>
    </div>
  </div>

  <div class="content hidden" id="ulang">
    <h2>Daftar Ulang:</h2>
    <div class="steps">
      <div class="step-row"><span class="num">1.</span> Calon peserta didik yang dinyatakan lulus seleksi wajib melakukan daftar ulang sesuai jadwal.</div>
      <div class="step-row"><span class="num">2.</span> Membayar biaya daftar ulang melalui teller bank, ATM, atau mobile banking.</div>
      <div class="step-row"><span class="num">3.</span> Mengunggah bukti pembayaran pada menu <b>"Daftar Ulang"</b>.</div>
    </div>
  </div>
</div>

<script>
function showTab(id, el) {
  document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.content').forEach(c => c.classList.add('hidden'));
  el.classList.add('active');
  document.getElementById(id).classList.remove('hidden');
}
</script>
@endsection
