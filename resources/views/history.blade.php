<x-app-layout>
    <div class="bg-white m-5 p-10 rounded-lg text-black">
        <h1 class="text-xl font-bold">History</h1>
        <!-- Search -->
        <div class="flex justify-between items-center">

            <form action="{{ route('history.search') }}" method="post" class="flex gap-x-2 items-center">
                @csrf
                <input type="text" name="search" class="w-fit input bg-transparent input-bordered border-2" placeholder="Search...">
            <div class="flex gap-x-2 my-2">
                <input type="date" name="start_date" class="w-full input bg-transparent input-bordered border-2">
                <input type="date" name="end_date" class="w-full input bg-transparent input-bordered border-2">
            </div>
            <button type="submit" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </button>
        </form>
        <a href="{{ route('history.export') }}">
            <button class="btn btn-primary">Export</button>
        </a>
    </div>

        <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr class="text-black">
                        <th class="text-center">No</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Nomor Surat</th>
                        <th class="text-center">Divisi</th>
                        <th class="text-center">Nama Karyawan</th>
                        <th class="text-center">Jenis Pekerjaan</th>
                        <th class="text-center">Lokasi Pekerjaan</th>
                        <th class="text-center">Update/Preview</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    @php
                    $n=1;
                    @endphp
                    @foreach($history as $key => $data)
                    <tr>
                        <form method="post" action="{{ route('preview.index') }}">
                            @csrf
                            <th class="bg-transparent border-0 focus:outline-none focus:border-0 text-sm text-center"
                                name="date">
                                {{ $history->firstItem() + $key }}
                            </th>
                            <td><input type="text"
                                    class="bg-transparent border-0 focus:outline-none focus:border-0 text-sm text-center"
                                    name="date" value="{{ $data->date }}" readonly></td>
                            <td><input type="text"
                                    class="bg-transparent border-0 focus:outline-none focus:border-0 text-sm text-center"
                                    name="no_surat" value="{{ $data->no_surat }}" readonly></td>
                            <td><input type="text"
                                    class="bg-transparent border-0 focus:outline-none focus:border-0 text-center"
                                    name="divisi" value="{{ $data->divisi }}" readonly></td>
                            <td><input type="text"
                                    class="bg-transparent border-0 focus:outline-none focus:border-0 text-sm text-center"
                                    name="nama_karyawan" value="{{ $data->nama_karyawan }}" readonly></td>
                            <td><input type="text"
                                    class="bg-transparent border-0 focus:outline-none focus:border-0 text-sm text-center"
                                    name="jenis_pekerjaan" value="{{ $data->jenis_pekerjaan }}" readonly></td>
                            <td><input type="text"
                                    class="bg-transparent border-0 focus:outline-none focus:border-0 text-sm text-center"
                                    name="lokasi" value="{{ $data->lokasi }}" readonly></td>
                            <input type="hidden"
                                class="bg-transparent border-0 focus:outline-none focus:border-0 text-sm text-center"
                                name="dari" value="{{ $data->dari }}" readonly>
                            <input type="hidden"
                                class="bg-transparent border-0 focus:outline-none focus:border-0 text-sm text-center"
                                name="sampai" value="{{ $data->sampai }}" readonly>
                            <input type="hidden"
                                class="bg-transparent border-0 focus:outline-none focus:border-0 text-sm text-center"
                                name="tanggalpekerjaan" value="{{ $data->tanggalpekerjaan }}" readonly>
                            <td class="flex gap-x-1">
                               <button id="btn-print" type="submit"
                                        class="btn">Preview</button>
                        </form>
                        <label for="my_modal{{ $data->id }}" class="btn">Update</label>
                        </td>
                        <input type="checkbox" id="my_modal{{ $data->id }}" class="modal-toggle" />
                        <div class="modal">
                            <div class="modal-box max-w-6xl bg-white flex flex-col" style="width: 1500px;">
                                <form method="post" action="{{ route('preview.update', $data->id) }}">
                                    @method('put')
                                    @csrf
                                    <h3 class="font-bold text-lg">Update Surat Tugas</h3>
                                    <div>
                                        <label class="label">
                                            <span class="label-text">Tanggal Pembuatan</span>
                                        </label>
                                        <input type="hidden" value="{{ $data->jumlah }}">
                                        <input type="text"
                                            class="w-full input bg-transparent input-bordered border-2 mb-1" name="date"
                                            value="{{ $data->date }}" required>
                                    </div>
                                    <div>
                                        <label class="label">
                                            <span class="label-text">Divisi Petugas</span>
                                        </label>
                                        <select onchange="division(this);" name="divisi" id="divisi"
                                            class="w-full input bg-transparent input-bordered border-2 mb-1" required>
                                            <option value="">Pilih Divisi</option>
                                            <option @if($data->divisi == "umum") selected @endif value="umum">Umum
                                            </option>
                                            <option @if($data->divisi == "pmlh") selected @endif value="plh">Pemeliharaan
                                            </option>
                                            <option @if($data->divisi == "aktv") selected @endif value="aktv">Aktivasi
                                            </option>
                                            <option @if($data->divisi == "pjln") selected @endif value="pjln">Penjualan
                                            </option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="label">
                                            <span class="label-text">Nama Karyawan (Gunakan tanda "," untuk
                                                pemisahnya)</span>
                                        </label>
                                        <input type="text"
                                            class="w-full input bg-transparent input-bordered border-2 mb-1"
                                            name="nama_karyawan" value="{{ $data->nama_karyawan }}" required>
                                    </div>
                                    <div>
                                        <label class="label">
                                            <span class="label-text">Jenis Pekerjaan</span>
                                        </label>
                                        <input type="text"
                                            class="w-full input bg-transparent input-bordered border-2 mb-1"
                                            name="jenis_pekerjaan" value="{{ $data->jenis_pekerjaan }}" required>
                                    </div>
                                    <div>
                                        <label class="label">
                                            <span class="label-text">Lokasi Pekerjaan</span>
                                        </label>
                                        <input type="text"
                                            class="w-full input bg-transparent input-bordered border-2 mb-1"
                                            name="lokasi" value="{{ $data->lokasi }}" required>
                                    </div>
                                    <div>
                                        <label class="label">
                                            <span class="label-text">Tanggal Pekerjaan</span>
                                        </label>
                                        <input type="date"
                                            class="w-full input bg-transparent input-bordered border-2 mb-1"
                                            name="tanggalpekerjaan" value="{{ $data->tanggalpekerjaan }}" required>
                                    </div>
                                    <div>
                                        <label class="label">
                                            <span class="label-text">Waktu Pengerjaan</span>
                                        </label>
                                        <div class="flex w-9/12 gap-2">
                                            <div class="w-9/12">

                                                <label class="label">
                                                    <span class="label-text">Dari</span>
                                                </label>
                                                <select name="dari" id="dari" required
                                                    class="bg-white input bg-transparent input-bordered border-2 w-full">
                                                    <option value="">Dari</option>
                                                    <option @if($data->dari == "00:00") selected @endif
                                                        value="00:00">00:00</option>
                                                    <option @if($data->dari == "01:00") selected @endif
                                                        value="01:00">01:00</option>
                                                    <option @if($data->dari == "02:00") selected @endif
                                                        value="02:00">02:00</option>
                                                    <option @if($data->dari == "03:00") selected @endif
                                                        value="03:00">03:00</option>
                                                    <option @if($data->dari == "04:00") selected @endif
                                                        value="04:00">04:00</option>
                                                    <option @if($data->dari == "05:00") selected @endif
                                                        value="05:00">05:00</option>
                                                    <option @if($data->dari == "06:00") selected @endif
                                                        value="06:00">06:00</option>
                                                    <option @if($data->dari == "07:00") selected @endif
                                                        value="07:00">07:00</option>
                                                    <option @if($data->dari == "08:00") selected @endif
                                                        value="08:00">08:00</option>
                                                    <option @if($data->dari == "09:00") selected @endif
                                                        value="09:00">09:00</option>
                                                    <option @if($data->dari == "10:00") selected @endif
                                                        value="10:00">10:00</option>
                                                    <option @if($data->dari == "11:00") selected @endif
                                                        value="11:00">11:00</option>
                                                    <option @if($data->dari == "12:00") selected @endif
                                                        value="12:00">12:00</option>
                                                    <option @if($data->dari == "13:00") selected @endif
                                                        value="13:00">13:00</option>
                                                    <option @if($data->dari == "14:00") selected @endif
                                                        value="14:00">14:00</option>
                                                    <option @if($data->dari == "15:00") selected @endif
                                                        value="15:00">15:00</option>
                                                    <option @if($data->dari == "16:00") selected @endif
                                                        value="16:00">16:00</option>
                                                    <option @if($data->dari == "17:00") selected @endif
                                                        value="17:00">17:00</option>
                                                    <option @if($data->dari == "18:00") selected @endif
                                                        value="18:00">18:00</option>
                                                    <option @if($data->dari == "19:00") selected @endif
                                                        value="19:00">19:00</option>
                                                    <option @if($data->dari == "20:00") selected @endif
                                                        value="20:00">20:00</option>
                                                    <option @if($data->dari == "21:00") selected @endif
                                                        value="21:00">21:00</option>
                                                    <option @if($data->dari == "22:00") selected @endif
                                                        value="22:00">22:00</option>
                                                    <option @if($data->dari == "23:00") selected @endif
                                                        value="23:00">23:00</option>
                                                </select>
                                                <!-- <input type="time" placeholder="Waktu pengerjaan" class="input bg-transparent input-bordered border-2 w-full" /> -->
                                            </div>
                                            <div class="w-9/12">
                                                <label class="label">
                                                    <span class="label-text">Sampai</span>
                                                </label>
                                                <select name="sampai" id="sampai" required
                                                    class="bg-white input bg-transparent input-bordered border-2 w-full">
                                                    <option value="">Sampai</option>
                                                    <option @if($data->dari == "00:00") selected @endif
                                                        value="00:00">00:00</option>
                                                    <option @if($data->dari == "01:00") selected @endif
                                                        value="01:00">01:00</option>
                                                    <option @if($data->dari == "02:00") selected @endif
                                                        value="02:00">02:00</option>
                                                    <option @if($data->dari == "03:00") selected @endif
                                                        value="03:00">03:00</option>
                                                    <option @if($data->dari == "04:00") selected @endif
                                                        value="04:00">04:00</option>
                                                    <option @if($data->dari == "05:00") selected @endif
                                                        value="05:00">05:00</option>
                                                    <option @if($data->dari == "06:00") selected @endif
                                                        value="06:00">06:00</option>
                                                    <option @if($data->dari == "07:00") selected @endif
                                                        value="07:00">07:00</option>
                                                    <option @if($data->dari == "08:00") selected @endif
                                                        value="08:00">08:00</option>
                                                    <option @if($data->dari == "09:00") selected @endif
                                                        value="09:00">09:00</option>
                                                    <option @if($data->dari == "10:00") selected @endif
                                                        value="10:00">10:00</option>
                                                    <option @if($data->dari == "11:00") selected @endif
                                                        value="11:00">11:00</option>
                                                    <option @if($data->dari == "12:00") selected @endif
                                                        value="12:00">12:00</option>
                                                    <option @if($data->dari == "13:00") selected @endif
                                                        value="13:00">13:00</option>
                                                    <option @if($data->dari == "14:00") selected @endif
                                                        value="14:00">14:00</option>
                                                    <option @if($data->dari == "15:00") selected @endif
                                                        value="15:00">15:00</option>
                                                    <option @if($data->dari == "16:00") selected @endif
                                                        value="16:00">16:00</option>
                                                    <option @if($data->dari == "17:00") selected @endif
                                                        value="17:00">17:00</option>
                                                    <option @if($data->dari == "18:00") selected @endif
                                                        value="18:00">18:00</option>
                                                    <option @if($data->dari == "19:00") selected @endif
                                                        value="19:00">19:00</option>
                                                    <option @if($data->dari == "20:00") selected @endif
                                                        value="20:00">20:00</option>
                                                    <option @if($data->dari == "21:00") selected @endif
                                                        value="21:00">21:00</option>
                                                    <option @if($data->dari == "22:00") selected @endif
                                                        value="22:00">22:00</option>
                                                    <option @if($data->dari == "23:00") selected @endif
                                                        value="23:00">23:00</option>
                                                    <option @if($data->dari == "Selesai") selected @endif
                                                        value="Selesai">Selesai</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="label">
                                                <span class="label-text">Keterangan No pa/andop</span>
                                            </label>
                                            <input type="text"
                                                class="w-full input bg-transparent input-bordered border-2 mb-1"
                                                name="keterangan" value="{{ $data->keterangan }}">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                                </form>
                                <div class="modal-action">
                                    <label for="my_modal{{ $data->id }}" class="btn">Close!</label>
                                </div>
                            </div>
                        </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
        <div class="mt-3">
            {{ $history->links() }}
        </div>
    </div>
    @if(session('message'))
    <div id="alert-1"
        class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 w-fit fixed right-0 bottom-0 mr-10"
        role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div class="ml-3 text-sm font-medium w-fit">
            Dokumen sudah bisa didownload di button "Generate PDF" di bawah kiri!
        </div>
        <button type="button"
            class="ml-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
            data-dismiss-target="#alert-1" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
    @endif
</x-app-layout>
