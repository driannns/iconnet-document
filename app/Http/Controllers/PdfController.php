<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\NoSurat;

class PdfController extends Controller
{
    public function index(){
        return view("pdf");
    }

    public function create(Request $request){
        // dd($request->all());
        $nosurat = NoSurat::find(1);
        $nomorsurat = $nosurat->nosurat + 1;
        $date = Carbon::parse(now()->format('Y-m-d'));
        $formattedDate = $date->format('d F Y');
        $monthNames = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];
        $formattedDate = strtr($formattedDate, $monthNames);

        $nosurat->update([
            'nosurat' => $nomorsurat
        ]);

        session(
            ['petugas' => $request->petugas,
            'nomor' => $request->nomor,
            'jenis' => $request->jenis,
            'lokasi' => $request->lokasi,
            'dari' => $request->dari,
            'sampai' => $request->sampai,
            'date' => $formattedDate,
            'nosurat' => $nosurat->nosurat
            ]
        );

        return view("surattugas");
    }
}
