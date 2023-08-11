<x-app-layout>
    <div class="bg-white m-5 p-10 rounded-lg text-black">
        <h1 class="font-bold text-xl">Surat Tugas</h1>
        <form action="">
            <div class="form-control w-9/12">
                <label class="label">
                    <span class="label-text">Tanggal</span>
                </label>
                <input type="date" placeholder="Tanggal Pembuatan Surat" class="input bg-transparent input-bordered border-2 w-9/12" />
            </div>
            <div class="form-control w-9/12">
                <label class="label">
                    <span class="label-text">Nama Petugas</span>
                </label>
                <input type="text" placeholder="Nama Petugas" class="input bg-transparent input-bordered border-2 w-9/12" />
            </div>
            <div class="form-control w-9/12">
                <label class="label">
                    <span class="label-text">Jenis Pekerjaan</span>
                </label>
                <input type="text" placeholder="Jenis Pekerjaan" class="input bg-transparent input-bordered border-2 w-9/12" />
            </div>
            <div class="form-control w-9/12">
                <label class="label">
                    <span class="label-text">Lokasi Pekerjaan</span>
                </label>
                <input type="text" placeholder="Lokasi pekerjaan" class="input bg-transparent input-bordered border-2 w-9/12" />
            </div>
            <div class="form-control w-9/12">
                <label class="label">
                    <span class="label-text">Waktu Pengerjaan</span>
                </label>
                <input type="text" placeholder="Waktu pengerjaan" class="input bg-transparent input-bordered border-2 w-9/12" />
            </div>
            <button class="btn btn-wide mt-2" type="submit">Submit</button>
        </form>
    </div>
</x-app-layout>
