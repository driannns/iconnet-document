<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\NoSurat;
use App\Models\History;

class PdfController extends Controller
{
    public function index(){
        return view("pdf");
    }

    public function create(Request $request){
        $request->session()->forget(['number', 'jenis', 'lokasi','date' ,'waktu','nosurat','keterangan']);
        $karyawan = [];
        
        $nosurat = NoSurat::find(1);
        $nomorsurat = $nosurat->nosurat + 1;
        $formattedNumber = str_pad($nomorsurat, 3, '0', STR_PAD_LEFT);
        
        $date = Carbon::parse(now()->format('Y-m-d'));
        $formattedDate = $date->format('d F Y');
        $year = $date->format('Y');
        for ($i = 0; $i < $request->myNumber; $i++){
            session([
                "petugas{$i}" => $request->input("petugas{$i}"),
            ]);
            $karyawan[] = $request->input("petugas{$i}");
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
        $formattedMonth = str_pad($formattedMonth, 3, '0', STR_PAD_LEFT);
        $waktu = "$request->dari S/d $request->sampai";

        
        $formatnosurat = "{$formattedNumber}/{$request->divisi}/{$formattedMonth}/{$year}";
        if(!empty($request->keterangan)){
            session(
                [
                    'number' => $request->myNumber,
                    'jenis' => $request->jenis,
                    'lokasi' => $request->lokasi,
                    'date' => $formattedDate,
                    'waktu' => $waktu,
                    'nosurat' => $formatnosurat,
                    'keterangan' => $request->keterangan
                    ]
                );
                $combinedKaryawan = implode(', ', $karyawan);
                History::create([
                    'no_surat' => $formatnosurat,
                    'date' => $formattedDate,
                    'jumlah' => $request->myNumber,
                    'divisi' => $request->divisi,
                    'nama_karyawan' => $combinedKaryawan,
                    'jenis_pekerjaan' =>  $request->jenis,
                    'lokasi' => $request->lokasi,
                    'waktu' => $waktu,
                    'keterangan' => $request->keterangan,
                ]);
        } else {

            session(
                [
                    'number' => $request->myNumber,
                    'jenis' => $request->jenis,
                    'lokasi' => $request->lokasi,
                    'date' => $formattedDate,
                    'waktu' => $waktu,
                    'nosurat' => $formatnosurat,
                    ]
                );
                $combinedKaryawan = implode(', ', $karyawan);
                History::create([
                    'no_surat' => $formatnosurat,
                    'date' => $formattedDate,
                    'jumlah' => $request->myNumber,
                    'divisi' => $request->divisi,
                    'nama_karyawan' => $combinedKaryawan,
                    'jenis_pekerjaan' =>  $request->jenis,
                    'lokasi' => $request->lokasi,
                    'waktu' => $waktu,
                ]);
            }

            $nosurat->update([
                'nosurat' => $nomorsurat
            ]);
            
            return view("surattugas")->with('message', 'Download PDF');

            }
            
    public function history(){
        $history = History::paginate(10);
        return view('history', compact('history'));
    }
            
    public function preview(Request $request){
        $request->session()->forget(['number', 'jenis', 'lokasi','date' ,'waktu','nosurat','keterangan']);

         $history = History::paginate(10);
        $waktu = "$request->dari S/d $request->sampai";

        $combinedKaryawan = explode(', ', $request->nama_karyawan);
        $number = count($combinedKaryawan);
        foreach ($combinedKaryawan as $key => $value) {
            session([
                "petugas$key" => $value,
            ]);
        }
        
        if(!empty($request->keterangan)){
            session([
                'keterangan' => $request->keterangan
            ]);
        }

        session(
            [
                'number' => $number,
                'jenis' => $request->jenis_pekerjaan,
                'lokasi' => $request->lokasi,
                'date' => $request->date,
                'waktu' => $request->waktu,
                'nosurat' => $request->no_surat,
                ]
            );

            return redirect()->route("history.index")->with('message', 'Download PDF');
    }

    public function search(Request $request){
        $history = History::where('no_surat', 'LIKE', '%' . $request->search . '%')
                            ->orwhere('date',  'LIKE', '%' . $request->search . '%')
                            ->orwhere('divisi',  'LIKE', '%' . $request->search . '%')
                            ->orwhere('nama_karyawan',  'LIKE', '%' . $request->search . '%')
                            ->orwhere('jenis_pekerjaan',  'LIKE', '%' . $request->search . '%')
                            ->orwhere('lokasi',  'LIKE', '%' . $request->search . '%')
                            ->orwhere('waktu',  'LIKE', '%' . $request->search . '%')
                            ->paginate(10);
        return view('history', compact('history'));
    }
}
