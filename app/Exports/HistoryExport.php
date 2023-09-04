<?php

namespace App\Exports;

use App\Models\History;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HistoryExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return History::all();
    }

    public function headings(): array
    {
        return ["No", "Nomor Surat", "Tanggal Pembuatan", "Divisi", "Jumlah Petugas", "Nama Petugas", "Jenis Pekerjaan", "Lokasi", "Tanggal Pekerjaan", "Dari Jam", "Sampai Jam", "Keterangan","Created_at", "Updated_at"];
    }
}
