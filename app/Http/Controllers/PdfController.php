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
        $nosurat = NoSurat::find(1);
        $nomorsurat = $nosurat->nosurat + 1;
        $counter = 0;
        
        $date = Carbon::parse(now()->format('Y-m-d'));
        $formattedDate = $date->format('d F Y');
        $year = $date->format('Y');
        for ($i = 0; $i < $request->myNumber; $i++){
            session([
                "petugas{$i}" => $request->input("petugas{$i}"),
                "nomor{$i}" => $request->input("handphone{$i}")
            ]);
        }
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
        $formattedMonth = $date->format('m');
        $formattedDate = strtr($formattedDate, $monthNames);
        $nosurat->update([
            'nosurat' => $nomorsurat
        ]);
        
        session(
            [
            'number' => $request->myNumber,
            'jenis' => $request->jenis,
            'lokasi' => $request->lokasi,
            'dari' => $request->dari,
            'sampai' => $request->sampai,
            'divisi' => $request->divisi,
            'month' => $formattedMonth,
            'date' => $formattedDate,
            'nosurat' => $nosurat->nosurat,
            'year' => $year
            ]
        );
        // dd(session()->all());
        return view("surattugas", compact('counter'));
    }
}
