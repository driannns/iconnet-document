<x-app-layout>
    <div class="bg-white m-5 p-10 rounded-lg text-black">
        <h1 class="text-xl font-bold">History</h1>
        <!-- Search -->
        <div class="flex justify-between items-center">

            <form action="{{ route('history.search') }}" method="post" class="flex gap-x-2 items-center"
                data-theme="light">
                @csrf
                <input type="text" name="search" class="w-fit input bg-transparent input-bordered border-2"
                    placeholder="Search...">
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
                        <th class="text-center">Nomor</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Nomor Surat</th>
                        <th class="text-center">Divisi</th>
                        <th class="text-center">Nama Karyawan</th>
                        <th class="text-center">Jenis Pekerjaan</th>
                        <th class="text-center">Lokasi Pekerjaan</th>
                        <th class="text-center">Persetujuan</th>
                        <th class="text-center">Keterangan</th>
                        @role('user')
                        <th class="text-center">Preview/Delete</th>
                        @elserole('manager')
                        <th class="text-center">Preview/Edit/Pesetujuan</th>
                        @endrole
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
                            <td class="w-3/12"><input type="text"
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
                                name="daritanggalpekerjaan" value="{{ $data->daritanggalpekerjaan }}" readonly>
                            <input type="hidden"
                                class="bg-transparent border-0 focus:outline-none focus:border-0 text-sm text-center"
                                name="sampaitanggalpekerjaan" value="{{ $data->sampaitanggalpekerjaan }}" readonly>
                            <input type="hidden"
                                class="bg-transparent border-0 focus:outline-none focus:border-0 text-sm text-center"
                                name="no_pa_adop" value="{{ $data->no_pa_adop }}" readonly>
                            <td class="text-center">
                                @if($data->persetujuan == "Disetujui")
                                <i class='bx bxs-check-circle text-3xl text-[#4db92c]'></i>
                                @elseif($data->persetujuan == "Tidak Disetujui")
                                <i class='bx bxs-x-circle text-3xl text-[#d2263e]'></i>
                                @elseif($data->persetujuan == "Telah diedit")
                                <i class='bx bxs-minus-circle text-3xl text-[#404145]'></i>
                                @endif
                            </td>
                            <td>{{ $data->keterangan }}</td>
                            @role('user')
                            <td class="flex gap-x-1">
                                <button id="btn-print" type="submit" class="btn btn-primary">Preview</button>
                                <!-- The button to open modal -->
                                <label for="my_modal{{ $data->id }}" class="btn btn-accent">Edit</label>
                                <label for="my_modal_6" class="btn btn-error text-white">Delete</label>

                                <!-- Put this part before </body> tag -->
                            </td>
                        </form>

                        <!-- MODAL DELETE -->
                        <input type="checkbox" id="my_modal_6" class="modal-toggle" />
                        <div class="modal">
                            <div class="modal-box bg-white">
                                <h3 class="font-bold text-lg text-center">Apakah anda yakin ingin menghapus data ini?
                                </h3>
                                <div class="modal-action justify-center">
                                    <form action="{{ route('delete.index', $data->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-error">Delete</button>
                                    </form>
                                    <label for="my_modal_6" class="btn">Close!</label>
                                </div>
                            </div>
                        </div>

                         <!-- MODAL EDIT -->
                         <input type="checkbox" id="my_modal{{ $data->id }}" class="modal-toggle" />
                        <div class="modal" data-theme="light">
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
                                            <option @if($data->divisi == "pmlh") selected @endif
                                                value="pmlh">Pemeliharaan
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
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text">Tanggal Pekerjaan</span>
                                        </label>
                                        <div class="flex gap-x-2">

                                            <div class="w-1/2">
                                                <label class="label">
                                                    <span class="label-text">Dari</span>
                                                </label>
                                                <input type="date" id="tanggalpekerjaan" name="daritanggalpekerjaan"
                                                    placeholder="Tanggal pekerjaan"
                                                    class="input bg-transparent input-bordered border-2 w-full"
                                                    data-theme="light" value="{{ $data->daritanggalpekerjaan }}"  required/>
                                            </div>
                                            <div class="w-1/2">
                                                <label class="label">
                                                    <span class="label-text">Sampai</span>
                                                </label>
                                                <input type="date" id="tanggalpekerjaan" name="sampaitanggalpekerjaan"
                                                    placeholder="Tanggal pekerjaan"
                                                    class="input bg-transparent input-bordered border-2 w-full"
                                                    data-theme="light"value="{{ $data->sampaitanggalpekerjaan }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="label">
                                            <span class="label-text">Waktu Pengerjaan</span>
                                        </label>
                                        <div class="flex gap-2">
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
                                                    <option @if($data->sampai == "00:00") selected @endif
                                                        value="00:00">00:00</option>
                                                    <option @if($data->sampai == "01:00") selected @endif
                                                        value="01:00">01:00</option>
                                                    <option @if($data->sampai == "02:00") selected @endif
                                                        value="02:00">02:00</option>
                                                    <option @if($data->sampai == "03:00") selected @endif
                                                        value="03:00">03:00</option>
                                                    <option @if($data->sampai == "04:00") selected @endif
                                                        value="04:00">04:00</option>
                                                    <option @if($data->sampai == "05:00") selected @endif
                                                        value="05:00">05:00</option>
                                                    <option @if($data->sampai == "06:00") selected @endif
                                                        value="06:00">06:00</option>
                                                    <option @if($data->sampai == "07:00") selected @endif
                                                        value="07:00">07:00</option>
                                                    <option @if($data->sampai == "08:00") selected @endif
                                                        value="08:00">08:00</option>
                                                    <option @if($data->sampai == "09:00") selected @endif
                                                        value="09:00">09:00</option>
                                                    <option @if($data->sampai == "10:00") selected @endif
                                                        value="10:00">10:00</option>
                                                    <option @if($data->sampai == "11:00") selected @endif
                                                        value="11:00">11:00</option>
                                                    <option @if($data->sampai == "12:00") selected @endif
                                                        value="12:00">12:00</option>
                                                    <option @if($data->sampai == "13:00") selected @endif
                                                        value="13:00">13:00</option>
                                                    <option @if($data->sampai == "14:00") selected @endif
                                                        value="14:00">14:00</option>
                                                    <option @if($data->sampai == "15:00") selected @endif
                                                        value="15:00">15:00</option>
                                                    <option @if($data->sampai == "16:00") selected @endif
                                                        value="16:00">16:00</option>
                                                    <option @if($data->sampai == "17:00") selected @endif
                                                        value="17:00">17:00</option>
                                                    <option @if($data->sampai == "18:00") selected @endif
                                                        value="18:00">18:00</option>
                                                    <option @if($data->sampai == "19:00") selected @endif
                                                        value="19:00">19:00</option>
                                                    <option @if($data->sampai == "20:00") selected @endif
                                                        value="20:00">20:00</option>
                                                    <option @if($data->sampai == "21:00") selected @endif
                                                        value="21:00">21:00</option>
                                                    <option @if($data->sampai == "22:00") selected @endif
                                                        value="22:00">22:00</option>
                                                    <option @if($data->sampai == "23:00") selected @endif
                                                        value="23:00">23:00</option>
                                                    <option @if($data->sampai == "Selesai") selected @endif
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
                                                name="no_pa_adop" value="{{ $data->no_pa_adop }}">
                                        </div>
                                        <div class="mt-5">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea placeholder="Keterangan Edit"
                                                class="textarea textarea-bordered textarea-lg border-2 w-full bg-white"
                                                name="keterangan" required></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2">Edit</button>
                                </form>
                                <div class="modal-action">
                                    <label for="my_modal{{ $data->id }}" class="btn btn-warning">Close!</label>
                                </div>
                            </div>
                        </div>
                        
                        @elserole('manager')
                        <td>
                            <div class="flex gap-2">
                                <button id="btn-print" type="submit" class="btn">Preview</button>
                                </form>
                                @if(!($data->persetujuan == 'Disetujui' || $data->persetujuan == 'Tidak Disetujui'))
                                <label for="persetujuan_{{ $data->id }}" class="btn">Persetujuan</label>
                                @endif
                            </div>


                        </td>

                        <!-- MODAL PERSETUJUAN -->
                        <input type="checkbox" id="persetujuan_{{ $data->id }}" class="modal-toggle" />
                        <div class="modal">
                            <div class="modal-box max-w-6xl bg-white flex flex-col" style="width: 1500px;">
                                <h3>Persetujuan Surat Tugas</h3>
                                <div class="flex mt-5">

                                    <div class="w-5/12 leading-loose">
                                        <p>Tanggal Pembuatan</p>
                                        <p>Divisi Petugas</p>
                                        <p>Nama Karyawan</p>
                                        <p>Lokasi Pekerjaan</p>
                                        <p>Jenis Pekerjaan</p>
                                        <p>Tanggal Pekerjaan</p>
                                        <p>Waktu Pengerjaan</p>
                                        <p>Keterangan No pa/andop</p>
                                    </div>
                                    <div class="w-7/12 leading-loose">
                                        <p>: {{ $data->date }}</p>
                                        <p>: {{ $data->divisi }}</p>
                                        <p>: {{ $data->nama_karyawan }}</p>
                                        <p>: {{ $data->jenis_pekerjaan }}</p>
                                        <p>: {{ $data->lokasi }}</p>
                                        <p>: {{ $data->tanggalpekerjaan }}</p>
                                        <p>: {{ $data->dari }} S/d {{ $data->sampai }}</p>
                                        @if(empty($data->keterangan))
                                        <p>: -</p>
                                        @else
                                        <p>: {{ $data->keterangan }}</p>
                                        @endif
                                    </div>
                                </div>
                                <form action="{{ route('history.tidaksetuju', $data->id) }}" method="post">
                                    @csrf
                                    <div class="mt-5">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea placeholder="Keterangan jika tidak disetujui"
                                            class="textarea textarea-bordered textarea-lg border-2 w-full bg-white"
                                            name="keterangan" required></textarea>
                                    </div>
                                    <div class="flex gap-5">
                                        <button type="submit" class="btn btn-error mt-2">Tidak Setuju</button>
                                </form>
                                <form action="{{ route('history.setuju', $data->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success mt-2">Setuju</button>
                                </form>
                            </div>
                            <div class="modal-action">
                                <label for="persetujuan_{{ $data->id }}" class="btn">Close!</label>
                            </div>
                        </div>
        </div>
    </div> @endrole </tr> @endforeach </tbody>
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
            {{ Session::get('message') }}
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
