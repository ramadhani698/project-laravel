<?php

namespace App\Exports;

use App\Models\Ppdb\PpdbHasilSeleksi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SiswaDiterimaExport extends DefaultValueBinder implements
    FromQuery,
    WithHeadings,
    WithMapping,
    WithStyles,
    WithCustomValueBinder
{
    // Kolom-kolom yang berupa "angka panjang" tapi harus dianggap TEXT
    protected array $forceTextColumns = ['C', 'D', 'E', 'F', 'N', 'Q']; // sesuaikan huruf kolom NISN, NIK, No. KK, No. Akta Kelahiran

    public function bindValue(Cell $cell, $value)
    {
        $column = $cell->getColumn();

        if (in_array($column, $this->forceTextColumns)) {
            $cell->setValueExplicit((string) $value, DataType::TYPE_STRING);
            return true;
        }

        // kolom lain, biarkan default binder yang urus
        return parent::bindValue($cell, $value);
    }

    public function query()
    {
        return PpdbHasilSeleksi::query()
            ->where('status_kelulusan', 'lulus')
            ->with(['formulirPendaftaran.jurusan', 'formulirPendaftaran.pendaftar']);
    }

    public function headings(): array
    {
        return [
            'No',
            'No. Pendaftaran',
            'NISN',
            'NIK',
            'No. KK',
            'No. Akta Kelahiran',
            'Nama Lengkap',
            'Tempat, Tanggal Lahir',
            'Jenis Kelamin',
            'Alamat',
            'Asal Sekolah',
            'Jurusan',
            'Nama Ayah',
            'NIK Ayah',
            'Pekerjaan Ayah',
            'Nama Ibu',
            'NIK Ibu',
            'Pekerjaan Ibu',
            'No. HP Orang Tua',
            'Nilai Akademik',
            'Nilai Kejuruan',
        ];
    }

    public function map($hasil): array
    {
        static $no = 0;
        $no++;

        $formulir = $hasil->formulirPendaftaran;

        return [
            $no,
            $formulir->no_pendaftaran,
            $formulir->nisn,
            $formulir->nik,
            $formulir->no_kk,
            $formulir->no_akta,
            $formulir->nama_lengkap,
            $formulir->tempat_lahir . ', ' . optional($formulir->tanggal_lahir)->format('d-m-Y'),
            $formulir->jenis_kelamin,
            $formulir->alamat,
            $formulir->asal_sekolah,
            $formulir->jurusan->name ?? '-',
            $formulir->nama_ayah,
            $formulir->nik_ayah,
            $formulir->pekerjaan_ayah,
            $formulir->nama_ibu,
            $formulir->nik_ibu,
            $formulir->pekerjaan_ibu,
            $formulir->no_hp_ortu,
            $hasil->nilai_akademik,
            $hasil->nilai_kejuruan,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [1 => ['font' => ['bold' => true]]];
    }
}