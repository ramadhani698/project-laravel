<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lembar Pernyataan - {{ $pendaftar->nama_lengkap }}</title>
    <style>
        @page {
            margin: 90px 70px 80px 70px;
        }

        body {
            font-family: "Times New Roman", serif;
            font-size: 13px;
            color: #1a1a1a;
            line-height: 1.6;
        }

        /* ===== KOP SURAT ===== */
        .kop {
            width: 100%;
            border-bottom: 3px solid #14532d;
            padding-bottom: 8px;
            margin-bottom: 26px;
        }
        .kop table { width: 100%; border-collapse: collapse; }
        .kop td { vertical-align: middle; }
        .kop .logo-cell { width: 78px; }
        .kop .logo-cell img { width: 72px; height: 72px; }
        .kop .text-cell { text-align: center; }
        .kop .organisasi {
            font-size: 11.5px;
            font-weight: bold;
            letter-spacing: 0.3px;
            color: #14532d;
            text-transform: uppercase;
            margin: 0;
            line-height: 1.35;
        }
        .kop .nama-sekolah {
            font-size: 19px;
            font-weight: bold;
            letter-spacing: 0.5px;
            color: #14532d;
            text-transform: uppercase;
            margin: 2px 0 0 0;
        }
        .kop .alamat-sekolah {
            font-size: 10px;
            color: #14532d;
            margin-top: 3px;
            line-height: 1.5;
        }

        /* ===== JUDUL ===== */
        .judul-wrap {
            text-align: center;
            margin-bottom: 22px;
        }
        .judul-wrap h1 {
            font-size: 15px;
            text-decoration: underline;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0;
        }
        .judul-wrap .nomor {
            font-size: 11px;
            color: #555;
            margin-top: 2px;
        }

        /* ===== ISI ===== */
        p { text-align: justify; margin: 0 0 12px 0; }

        .data-peserta {
            width: 100%;
            margin: 14px 0 16px 26px;
            border-collapse: collapse;
        }
        .data-peserta td {
            padding: 2px 6px;
            font-size: 13px;
            vertical-align: top;
        }
        .data-peserta .label { width: 150px; }
        .data-peserta .titik-dua { width: 12px; }

        ol.poin-pernyataan {
            margin: 0 0 16px 0;
            padding-left: 22px;
        }
        ol.poin-pernyataan li {
            text-align: justify;
            margin-bottom: 8px;
        }

        /* ===== TANDA TANGAN ===== */
        .ttd-wrap {
            width: 100%;
            margin-top: 34px;
            border-collapse: collapse;
        }
        .ttd-wrap td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            font-size: 13px;
        }
        .ttd-tanggal {
            text-align: right;
            margin-bottom: 24px;
            padding-right: 4px;
        }
        .ttd-ruang {
            height: 70px;
        }
        .ttd-nama {
            display: inline-block;
            border-bottom: 1px solid #333;
            min-width: 190px;
            padding-bottom: 2px;
            font-weight: bold;
        }
        .ttd-ket {
            font-size: 11px;
            color: #555;
            margin-top: 2px;
        }

        /* ===== FOOTER CATATAN ===== */
        .catatan-kaki {
            margin-top: 30px;
            font-size: 10.5px;
            color: #666;
            border-top: 1px solid #ccc;
            padding-top: 8px;
        }
    </style>
</head>
<body>

    {{-- ===== KOP SURAT ===== --}}
    <div class="kop">
        <table>
            <tr>
                <td class="logo-cell">
                    <img src="{{ public_path('images/logo.png') }}">
                </td>
                <td class="text-cell">
                    <p class="organisasi">
                        Majlis Pendidikan Dasar dan Menengah<br>
                        Pimpinan Daerah Muhammadiyah Kota Tangerang
                    </p>
                    <p class="nama-sekolah">SMK Muhammadiyah 2 Tangerang</p>
                    <p class="alamat-sekolah">
                        Alamat : Jl. Raden Fatah No. 100 Ciledug &ndash; Kota Tangerang 15153 Telp. (021) 730 5901<br>
                        Email : smkmudatangerang@gmail.com Web : http://smkmudatangerang.sch.id
                    </p>
                </td>
                <td class="logo-cell"></td>
            </tr>
        </table>
    </div>

    {{-- ===== JUDUL ===== --}}
    <div class="judul-wrap">
        <h1>Surat Pernyataan</h1>
        <div class="nomor">Nomor Pendaftaran: {{ $formulir->no_pendaftaran }}</div>
    </div>

    {{-- ===== ISI ===== --}}
    <p>
        Yang bertanda tangan di bawah ini, saya selaku peserta didik yang telah dinyatakan
        <strong>LULUS</strong> seleksi Penerimaan Peserta Didik Baru (PPDB) SMK Muhammadiyah 2 Tangerang
        Tahun Ajaran {{ now()->year }}/{{ now()->year + 1 }}, dengan data sebagai berikut:
    </p>

    <table class="data-peserta">
        <tr>
            <td class="label">Nama Lengkap</td><td class="titik-dua">:</td>
            <td>{{ $formulir->nama_lengkap }}</td>
        </tr>
        <tr>
            <td class="label">NISN</td><td class="titik-dua">:</td>
            <td>{{ $formulir->nisn }}</td>
        </tr>
        <tr>
            <td class="label">Asal Sekolah</td><td class="titik-dua">:</td>
            <td>{{ $formulir->asal_sekolah }}</td>
        </tr>
        <tr>
            <td class="label">Jurusan Pilihan</td><td class="titik-dua">:</td>
            <td>{{ $formulir->jurusan?->name ?? '-' }}</td>
        </tr>
    </table>

    <p>Dengan ini menyatakan dengan sesungguhnya bahwa saya:</p>

    <ol class="poin-pernyataan">
        <li>Bersedia mentaati seluruh peraturan dan tata tertib yang berlaku di SMK Muhammadiyah 2 Tangerang selama menjadi peserta didik.</li>
        <li>Bersedia melaksanakan daftar ulang sesuai dengan jadwal dan ketentuan yang ditetapkan oleh pihak sekolah.</li>
        <li>Menyatakan bahwa seluruh data dan dokumen yang saya sampaikan pada proses pendaftaran adalah benar dan dapat dipertanggungjawabkan.</li>
        <li>Bersedia menerima konsekuensi berupa pembatalan status kelulusan apabila di kemudian hari ditemukan data atau dokumen yang tidak sesuai dengan kenyataan.</li>
    </ol>

    <p>
        Demikian surat pernyataan ini saya buat dengan sebenar-benarnya, dalam keadaan sadar
        dan tanpa paksaan dari pihak manapun, untuk dapat dipergunakan sebagaimana mestinya.
    </p>

    {{-- ===== TANDA TANGAN ===== --}}
    <div class="ttd-tanggal">
        Tangerang, {{ now()->translatedFormat('d F Y') }}
    </div>

    <table class="ttd-wrap">
        <tr>
            <td>
                Yang Menyatakan,<br>
                (Peserta Didik)
                <div class="ttd-ruang"></div>
                <span class="ttd-nama">{{ $formulir->nama_lengkap }}</span>
            </td>
            <td>
                Mengetahui,<br>
                (Orang Tua / Wali)
                <div class="ttd-ruang"></div>
                <span class="ttd-nama">&nbsp;</span>
            </td>
        </tr>
    </table>

    <div class="catatan-kaki">
        Dokumen ini digenerate otomatis oleh sistem PPDB SMK Muhammadiyah 2 Tangerang pada
        {{ now()->translatedFormat('d F Y, H:i') }} WIB dan sah tanpa memerlukan cap basah pada tahap ini.
    </div>

</body>
</html>