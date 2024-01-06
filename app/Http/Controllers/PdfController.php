<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\History;
use App\Models\NoSurat;
use Illuminate\Http\Request;
use App\Exports\HistoryExport;
use Maatwebsite\Excel\Facades\Excel;

class PdfController extends Controller
{
    public function index(){
        return view("pdf");
    }

    public function create(Request $request){
        $request->session()->forget(['number', 'jenis', 'lokasi','date' ,'waktu','nosurat','daritanggalpekerjaan', 'sampaitanggalpekerjaan','keterangan']);

        $karyawan = [];

        $nosurat = NoSurat::find(1);
        $nomorsurat = $nosurat->nosurat + 1;
        $formattedNumber = str_pad($nomorsurat, 3, '0', STR_PAD_LEFT);

        $date = Carbon::parse(now()->format('Y-m-d'));
        $formattedDate = $date->format('d F Y');
        $formattedDariTanggalPekerjaan = Carbon::parse($request->daritanggalpekerjaan)->format('d F Y');
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
        $formattedDariTanggalPekerjaan = strtr($formattedDariTanggalPekerjaan, $monthNames);
        $formattedMonth = str_pad($formattedMonth, 3, '0', STR_PAD_LEFT);
        $waktu = "$request->dari S/d $request->sampai";
        
        if($request->sampaitanggalpekerjaan){
            $formattedSampaiTanggalPekerjaan = Carbon::parse($request->sampaitanggalpekerjaan)->format('d F Y');
            $formattedSampaiTanggalPekerjaan = strtr($formattedSampaiTanggalPekerjaan, $monthNames);
            session(
                [
                    'sampaitanggalpekerjaan' =>$formattedSampaiTanggalPekerjaan,
                ]
                );
        }
        
        
        $formatnosurat = "{$formattedNumber}/{$request->divisi}/{$formattedMonth}/{$year}";
        
        if(!empty($request->keterangan)){
            $combinedKaryawan = implode(', ', $karyawan);
            History::create([
                'no_surat' => $formatnosurat,
                'date' => $formattedDate,
                'jumlah' => $request->myNumber,
                'divisi' => $request->divisi,
                'nama_karyawan' => $combinedKaryawan,
                'jenis_pekerjaan' =>  $request->jenis,
                'lokasi' => $request->lokasi,
                'dari' => $request->dari,
                'sampai' => $request->sampai,
                'daritanggalpekerjaan' => $request->daritanggalpekerjaan,
                'sampaitanggalpekerjaan' => $request->sampaitanggalpekerjaan,
                'no_pa_adop' => $request->keterangan,
            ]);
        } elseif($request->sampaitanggalpekerjaan){

                $combinedKaryawan = implode(', ', $karyawan);
                History::create([
                    'no_surat' => $formatnosurat,
                    'date' => $formattedDate,
                    'jumlah' => $request->myNumber,
                    'divisi' => $request->divisi,
                    'nama_karyawan' => $combinedKaryawan,
                    'jenis_pekerjaan' =>  $request->jenis,
                    'lokasi' => $request->lokasi,
                    'dari' => $request->dari,
                    'sampai' => $request->sampai,
                    'daritanggalpekerjaan' => $request->daritanggalpekerjaan,
                    'sampaitanggalpekerjaan' => $request->sampaitanggalpekerjaan,
                ]);
            }
            elseif($request->keterangan && $request->sampaitanggalpekerjaan){
                    $combinedKaryawan = implode(', ', $karyawan);
                    History::create([
                        'no_surat' => $formatnosurat,
                        'date' => $formattedDate,
                        'jumlah' => $request->myNumber,
                        'divisi' => $request->divisi,
                        'nama_karyawan' => $combinedKaryawan,
                        'jenis_pekerjaan' =>  $request->jenis,
                        'lokasi' => $request->lokasi,
                        'dari' => $request->dari,
                        'sampai' => $request->sampai,
                        'daritanggalpekerjaan' => $request->daritanggalpekerjaan,
                        'sampaitanggalpekerjaan' => $request->sampaitanggalpekerjaan,
                        'keterangan' => $request->keterangan
                    ]);
            }
            else {
                    $combinedKaryawan = implode(', ', $karyawan);
                    History::create([
                        'no_surat' => $formatnosurat,
                        'date' => $formattedDate,
                        'jumlah' => $request->myNumber,
                        'divisi' => $request->divisi,
                        'nama_karyawan' => $combinedKaryawan,
                        'jenis_pekerjaan' =>  $request->jenis,
                        'lokasi' => $request->lokasi,
                        'dari' => $request->dari,
                        'sampai' => $request->sampai,
                        'daritanggalpekerjaan' => $request->daritanggalpekerjaan,
                    ]);
            }

            $nosurat->update([
                'nosurat' => $nomorsurat
            ]);
            
            return redirect()->route("pengajuan")->with('message', 'Dokumen berhasil dibuat, bisa diliat di history');

            }
            
    public function history(){
        $history = History::paginate(10);
        return view('history', compact('history'));
    }
            
    public function preview(Request $request){
        $request->session()->forget(['number', 'jenis', 'lokasi','date' ,'waktu','nosurat','daritanggalpekerjaan', 'sampaitanggalpekerjaan','keterangan']);

        $combinedKaryawan = explode(', ', $request->nama_karyawan);

        $formattedDariTanggalPekerjaan = Carbon::parse($request->daritanggalpekerjaan)->format('d F Y');
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
        $formattedDariTanggalPekerjaan = strtr($formattedDariTanggalPekerjaan, $monthNames);
        if($request->sampaitanggalpekerjaan){
            $formattedSampaiTanggalPekerjaan = Carbon::parse($request->sampaitanggalpekerjaan)->format('d F Y');
            $formattedSampaiTanggalPekerjaan = strtr($formattedSampaiTanggalPekerjaan, $monthNames);
            
            session(
                [
                'sampaitanggalpekerjaan' =>$formattedSampaiTanggalPekerjaan,
                ]
                );
        }
        $number = count($combinedKaryawan);
        foreach ($combinedKaryawan as $key => $value) {
            session([
                "petugas$key" => $value,
            ]);
        }
        
        $waktu = "$request->dari S/d $request->sampai";

        if(!empty($request->no_pa_adop)){
            session([
                'keterangan' => $request->no_pa_adop
            ]);
        }

        session(
            [
                'number' => $number,
                'divisi' => $request->divisi,
                'jenis' => $request->jenis_pekerjaan,
                'lokasi' => $request->lokasi,
                'date' => $request->date,
                'daritanggalpekerjaan' =>$formattedDariTanggalPekerjaan,
                'waktu' => $waktu,
                'nosurat' => $request->no_surat,
                ]
            );

            return redirect()->route("history.index")->with('message', 'Dokumen sudah bisa didownload di button "Generate PDF" di bawah kiri!');
    }

    public function search(Request $request){
        $search = $request->search;
        if($request->start_date || $request->end_date){
            $start_date = Carbon::parse($request->start_date);
            $end_date = Carbon::parse($request->end_date);
            if($request->search){
                $history = History::whereBetween('created_at',[$start_date, $end_date])
                                    ->where('no_surat', 'LIKE', '%' . $request->search . '%')
                                    ->orwhere('date',  'LIKE', '%' . $request->search . '%')
                                    ->orwhere('divisi',  'LIKE', '%' . $request->search . '%')
                                    ->orwhere('nama_karyawan',  'LIKE', '%' . $request->search . '%')
                                    ->orwhere('jenis_pekerjaan',  'LIKE', '%' . $request->search . '%')
                                    ->orwhere('lokasi',  'LIKE', '%' . $request->search . '%')
                                    ->orwhere('dari',  'LIKE', '%' . $request->search . '%')
                                    ->orwhere('sampai',  'LIKE', '%' . $request->search . '%')
                                    ->paginate(10);
            } else{
                $history = History::whereBetween('created_at',[$start_date,$end_date])
                ->paginate(10);            
                    }
        } else{
            $history = History::where('no_surat', 'LIKE', '%' . $request->search . '%')
                            ->orwhere('date',  'LIKE', '%' . $request->search . '%')
                            ->orwhere('divisi',  'LIKE', '%' . $request->search . '%')
                            ->orwhere('nama_karyawan',  'LIKE', '%' . $request->search . '%')
                            ->orwhere('jenis_pekerjaan',  'LIKE', '%' . $request->search . '%')
                            ->orwhere('lokasi',  'LIKE', '%' . $request->search . '%')
                            ->orwhere('dari',  'LIKE', '%' . $request->search . '%')
                            ->orwhere('sampai',  'LIKE', '%' . $request->search . '%')
                            ->paginate(10);
        }

        return view('history', compact('history'));
    }

    public function update(Request $request, $id){
        $request->session()->forget(['number', 'jenis', 'lokasi','date' ,'waktu','nosurat','daritanggalpekerjaan', 'sampaitanggalpekerjaan','keterangan']);

        $data = History::find($id);
        $waktu = "$request->dari S/d $request->sampai";

        $combinedKaryawan = explode(', ', $request->nama_karyawan);
        $number = count($combinedKaryawan);
        foreach ($combinedKaryawan as $key => $value) {
            session([
                "petugas$key" => $value,
            ]);
        }
        $formattedDariTanggalPekerjaan = Carbon::parse($request->daritanggalpekerjaan)->format('d F Y');
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
        $formattedDariTanggalPekerjaan = strtr($formattedDariTanggalPekerjaan, $monthNames);
        if($request->sampaitanggalpekerjaan){
            $formattedSampaiTanggalPekerjaan = Carbon::parse($request->sampaitanggalpekerjaan)->format('d F Y');
            $formattedSampaiTanggalPekerjaan = strtr($formattedSampaiTanggalPekerjaan, $monthNames);
            $data->update([
            'sampaitanggalpekerjaan' => $request->sampaitanggalpekerjaan,
            'sampaitanggalpekerjaan' =>$formattedSampaiTanggalPekerjaan,
            ]);
        }

        $nosurat = $data->no_surat;
        $nosuratUpdate = str_replace($data->divisi, $request->divisi, $nosurat);
        $data->update([
            'no_surat' => $nosuratUpdate,
            'date' => $request->date,
            'jumlah' => $number,
            'divisi' => $request->divisi,
            'nama_karyawan' => $request->nama_karyawan,
            'jenis_pekerjaan' =>  $request->jenis_pekerjaan,
            'lokasi' => $request->lokasi,
            'dari' => $request->dari,
            'sampai' => $request->sampai,
            'daritanggalpekerjaan' => $request->daritanggalpekerjaan,
            'no_pa_adop' => $request->no_pa_adop,
            'keterangan' => $request->keterangan,
            'persetujuan' => 'Telah diedit'
        ]);

        if(!empty($request->no_pa_adop)){
            session([
                'keterangan' => $request->no_pa_adop
            ]);
        }

        session(
            [
                'number' => $number,
                'divisi' => $request->divisi,
                'jenis' => $request->jenis_pekerjaan,
                'lokasi' => $request->lokasi,
                'date' => $request->date,
                'daritanggalpekerjaan' =>$formattedDariTanggalPekerjaan,
                'waktu' => $waktu,
                'nosurat' => $request->no_surat,
                ]
            );

            return redirect()->back();
    }

    public function export(){
        return Excel::download(new HistoryExport, 'datasurattugas.xlsx');
    }

    public function setuju($id){
        $history = History::find($id);
        
        $history->update([
            'persetujuan' => 'Disetujui'
        ]);

        return redirect()->back();
    }

    public function tidaksetuju(Request $request, $id){
        $history = History::find($id);
        
        $history->update([
            'persetujuan' => 'Tidak Disetujui',
            'keterangan' => $request->keterangan
        ]);

        return redirect()->back();
    }

    public function delete($id){
        $data = History::findorFail($id);

        $data->delete();

        return redirect()->route('history.index')->with('message', 'Data berhasil Dihapus!');
    }
}
