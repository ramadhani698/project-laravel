<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kartu Peserta - {{ $formulir->nama_lengkap }}</title>
    <style>
        @page {
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #24312c;
            line-height: 1.3;
            -webkit-print-color-adjust: exact;
        }

        .page {
            width: 100%;
            padding: 18px;
        }

        /* ===================== KARTU UTAMA ===================== */
        .ticket-frame {
            border: 1.5px solid #0b4a3f;
            border-radius: 14px;
            overflow: hidden;
        }

        .ticket {
            width: 100%;
            border-collapse: collapse;
            border: none;
        }

        .ticket td {
            vertical-align: top;
            padding: 0;
            border: none;
        }

        /* --- Sidebar kiri --- */
        .sidebar {
            width: 33%;
            background-color: #0b4a3f;
            color: #ffffff;
            padding: 0;
        }

        .sidebar-gold-strip {
            height: 4px;
            background-color: #c9a24b;
        }

        .sidebar-inner {
            padding: 14px 16px 16px 16px;
        }

        .sidebar .kop {
            font-size: 7.5px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #c9a24b;
            font-weight: bold;
            margin-bottom: 3px;
        }

        .sidebar .school-name {
            font-family: 'Times New Roman', serif;
            font-size: 12.5px;
            font-weight: bold;
            letter-spacing: 0.3px;
            line-height: 1.3;
            color: #ffffff;
            margin-bottom: 6px;
        }

        .gold-rule {
            width: 30px;
            height: 2px;
            background-color: #c9a24b;
            margin-bottom: 10px;
        }

        .sidebar .photo-box {
            width: 78px;
            height: 88px;
            background-color: rgba(255,255,255,0.06);
            border: 1px dashed rgba(201,162,75,0.65);
            border-radius: 6px;
            text-align: center;
            font-size: 8px;
            color: rgba(255,255,255,0.6);
            padding-top: 38px;
            margin-bottom: 12px;
        }

        .sidebar-footer-label {
            font-size: 7.5px;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.55);
            margin-bottom: 2px;
        }

        .sidebar-footer-value {
            font-size: 12.5px;
            font-weight: bold;
            color: #f4e7c8;
            letter-spacing: 1px;
            font-family: 'Courier New', monospace;
        }

        /* --- Konten kanan --- */
        .content {
            width: 67%;
            background-color: #ffffff;
            padding: 16px 22px 14px 22px;
        }

        .eyebrow {
            font-size: 8.5px;
            font-weight: bold;
            letter-spacing: 1.6px;
            text-transform: uppercase;
            color: #c9a24b;
            margin-bottom: 4px;
        }

        .nama {
            font-family: 'Times New Roman', serif;
            font-size: 20px;
            font-weight: bold;
            color: #10241d;
            margin-bottom: 2px;
        }

        .sub-info {
            font-size: 9.5px;
            color: #6b7a75;
            margin-bottom: 10px;
            padding-bottom: 9px;
            border-bottom: 1px solid #eaeee9;
        }

        table.info {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table.info td {
            padding: 4px 0;
            font-size: 10px;
        }

        table.info tr.stripe td {
            background-color: #f7f8f6;
        }

        table.info td.k {
            color: #8a938d;
            width: 145px;
            padding-left: 6px;
            letter-spacing: 0.2px;
        }

        table.info td.v {
            color: #10241d;
            font-weight: bold;
            padding-right: 6px;
        }

        /* --- Highlight box: no. pendaftaran + status --- */
        .highlight-box {
            width: 100%;
            border-collapse: collapse;
            background-color: #fbf6ea;
            border: 1px solid #e3d1a0;
            border-radius: 8px;
            overflow: hidden;
        }

        .highlight-box td {
            padding: 9px 14px;
            vertical-align: middle;
        }

        .highlight-box td.divider {
            width: 1px;
            padding: 0;
            background-color: #e3d1a0;
        }

        .highlight-label {
            font-size: 7.5px;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #9c832f;
            margin-bottom: 3px;
        }

        .highlight-value {
            font-size: 14px;
            font-weight: bold;
            color: #6b4e12;
            letter-spacing: 1.5px;
            font-family: 'Courier New', monospace;
        }

        .highlight-value.status {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #0b4a3f;
            letter-spacing: 1px;
        }

        /* ===================== CATATAN DAFTAR ULANG ===================== */
        .instruksi {
            margin-top: 10px;
            padding: 9px 14px;
            background-color: #f9faf8;
            border-left: 3px solid #0b4a3f;
        }

        .instruksi .judul {
            font-size: 9.5px;
            font-weight: bold;
            color: #10241d;
            letter-spacing: 0.3px;
            margin-bottom: 4px;
        }

        .instruksi ul {
            margin: 0;
            padding-left: 14px;
        }

        .instruksi li {
            font-size: 9px;
            color: #52625b;
            line-height: 1.45;
        }

        /* ===================== TANDA TANGAN ===================== */
        .ttd-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        .ttd-table td {
            width: 50%;
            text-align: center;
            font-size: 9px;
            color: #52625b;
            padding: 0 12px;
        }

        .ttd-space {
            height: 26px;
        }

        .ttd-line {
            border-top: 1px solid #c7d0cb;
            padding-top: 4px;
            font-weight: bold;
            color: #10241d;
        }

        .ttd-jabatan {
            font-size: 7.5px;
            color: #8a938d;
            letter-spacing: 0.2px;
        }

        /* ===================== FOOTER ===================== */
        .footer {
            margin-top: 10px;
            text-align: center;
            font-size: 7.5px;
            color: #a3aca7;
            letter-spacing: 0.2px;
        }

        .footer .garis {
            border-top: 1px dashed #d8ddd9;
            margin-bottom: 6px;
        }
    </style>
</head>
<body>
<div class="page">

    <div class="ticket-frame">
    <table class="ticket">
        <tr>
            {{-- ===================== SIDEBAR KIRI ===================== --}}
            <td class="sidebar">
                <div class="sidebar-gold-strip"></div>
                <div class="sidebar-inner">
                    <div class="kop">PPDB &middot; Tahun Ajaran {{ now()->year }}/{{ now()->year + 1 }}</div>
                    <div class="school-name">SMK Muhammadiyah 2<br>Tangerang</div>
                    <div class="gold-rule"></div>

                    <div class="photo-box">Pas Foto<br>3x4</div>

                    <div class="sidebar-footer-label">Nomor Pendaftaran</div>
                    <div class="sidebar-footer-value">{{ $formulir->no_pendaftaran }}</div>
                </div>
            </td>

            {{-- ===================== KONTEN KANAN ===================== --}}
            <td class="content">
                <div class="eyebrow">Kartu Peserta &middot; Daftar Ulang PPDB</div>
                <div class="nama">{{ $formulir->nama_lengkap }}</div>
                <div class="sub-info">Asal sekolah: {{ $formulir->asal_sekolah }}</div>

                <table class="info">
                    <tr class="stripe">
                        <td class="k">NISN</td>
                        <td class="v">{{ $formulir->nisn }}</td>
                    </tr>
                    <tr>
                        <td class="k">Jenis Kelamin</td>
                        <td class="v">{{ $formulir->jenis_kelamin }}</td>
                    </tr>
                    <tr class="stripe">
                        <td class="k">Tempat, Tanggal Lahir</td>
                        <td class="v">
                            {{ $formulir->tempat_lahir }}, {{ $formulir->tanggal_lahir?->translatedFormat('d F Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="k">Jurusan Pilihan</td>
                        <td class="v">{{ $formulir->jurusan?->name ?? '-' }}</td>
                    </tr>
                </table>

                <table class="highlight-box">
                    <tr>
                        <td>
                            <div class="highlight-label">Nomor Pendaftaran</div>
                            <div class="highlight-value">{{ $formulir->no_pendaftaran }}</div>
                        </td>
                        <td class="divider"></td>
                        <td>
                            <div class="highlight-label">Status Kelulusan</div>
                            <div class="highlight-value status">LULUS SELEKSI</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    </div>

    {{-- ===================== INSTRUKSI DAFTAR ULANG ===================== --}}
    <div class="instruksi">
        <div class="judul">Yang perlu dibawa saat daftar ulang</div>
        <ul>
            <li>Cetak kartu ini (disarankan berwarna) dan bawa dalam bentuk fisik.</li>
            <li>Bawa dokumen asli: KTP orang tua/wali, Kartu Keluarga, dan Ijazah/SKL.</li>
            <li>Datang sesuai jadwal daftar ulang yang diumumkan oleh panitia.</li>
        </ul>
    </div>

    {{-- ===================== TANDA TANGAN ===================== --}}
    <table class="ttd-table">
        <tr>
            <td>
                <div>Orang Tua / Wali</div>
                <div class="ttd-space"></div>
                <div class="ttd-line">(.........................................)</div>
                <div class="ttd-jabatan">Tanda tangan &amp; nama jelas</div>
            </td>
            <td>
                <div>Panitia PPDB</div>
                <div class="ttd-space"></div>
                <div class="ttd-line">(.........................................)</div>
                <div class="ttd-jabatan">Tanda tangan &amp; stempel sekolah</div>
            </td>
        </tr>
    </table>

    {{-- ===================== FOOTER ===================== --}}
    <div class="footer">
        <div class="garis"></div>
        Dicetak otomatis dari sistem PPDB SMK Muhammadiyah 2 Tangerang pada {{ now()->translatedFormat('d F Y, H:i') }} WIB
    </div>

</div>
</body>
</html>