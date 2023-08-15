<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class PdfController extends Controller
{
    public function index(){
        return view("pdf");
    }

    public function create(Request $request){
        // $date = now()->format('Y-m-d');
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
        session(
            ['petugas' => $request->petugas,
            'nomor' => $request->nomor,
            'jenis' => $request->jenis,
            'lokasi' => $request->lokasi,
            'dari' => $request->dari,
            'sampai' => $request->sampai,
            'date' => $formattedDate],
        );

        // dd($request->session()->all());
        return view("surattugas");
    }
}
