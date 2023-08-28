<x-app-layout>
    <div class="bg-white m-5 p-10 rounded-lg text-black">
        <h1 class="text-xl font-bold">History</h1>
        <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr class="text-black">
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">No Surat</th>
                        <th class="text-center">Divisi</th>
                        <th class="text-center">Nama Karyawan</th>
                        <th class="text-center">Jenis Pekerjaan</th>
                        <th class="text-center">Lokasi Pekerjaan</th>
                        <th class="text-center">Waktu Pengerjaan</th>
                        <th class="text-center">Preview</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    @php
                    $n=1;
                    @endphp
                    @foreach($history as $key => $data)
                    <form method="post" action="{{ route('preview.index') }}">
                        @csrf
                        <tr>
                        <th class="bg-transparent border-0 focus:outline-none focus:border-0 text-sm text-center" name="date">
                        {{ $history->firstItem() + $key }}
                        </th>
                            <td><input type="text"
                                    class="bg-transparent border-0 focus:outline-none focus:border-0 text-sm text-center" name="date"
                                    value="{{ $data->date }}" readonly></td>
                            <td><input type="text"
                                    class="bg-transparent border-0 focus:outline-none focus:border-0 text-sm text-center"
                                    name="no_surat" value="{{ $data->no_surat }}" readonly></td>
                            <td><input type="text" class="bg-transparent border-0 focus:outline-none focus:border-0 text-center"
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
                            <td><input type="text"
                                    class="bg-transparent border-0 focus:outline-none focus:border-0 text-sm text-center" name="waktu"
                                    value="{{ $data->waktu }}" readonly></td>
                            <td><button type="submit" class="hover:text-blue-500">Preview</button></td>
                        </tr>
                    </form>
                    @endforeach
                </tbody>
            </table>
            
            
        </div>
        <div class="mt-3">
            {{ $history->links() }}
        </div>
    </div>
    @if(!empty($message))
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
