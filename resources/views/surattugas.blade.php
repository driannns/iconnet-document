<x-app-layout>
    <div class="bg-white m-5 p-10  rounded-lg text-black">
        <h1 class="font-bold text-xl">Pembuatan SPPD</h1>
        <form action="{{route('pdf.create')}}" method="post">
            @csrf
            <input class="bg-white text-black border-none font-bold w-10 text-center" type="hidden" id="myNumber"
                value="1" name="myNumber" min="0">
            <div class="form-control w-9/12" id="formfield">

                <label class="label">
                    <span class="label-text">Divisi Petugas</span>
                </label>
                <select onchange="division(this);" name="divisi" id="divisi"
                    class="w-9/12 input bg-transparent input-bordered border-2 mb-1" required>
                    <option value="">Pilih Divisi</option>
                    <option value="umum">Umum</option>
                    <option value="pmlh">Pemeliharaan</option>
                    <option value="aktv">Aktivasi</option>
                    <option value="pjln">Penjualan</option>
                </select>
            </div>
            <div class="form-control w-9/12" id="formfield">
                <label class="label">
                    <span class="label-text">Nama Karyawan</span>
                </label>
                <div id="email-list" class="email-input__w flex flex-col gap-2">

                    <input class="w-9/12 input bg-transparent input-bordered border-2 mb-1" type="text" name="petugas0"
                        placeholder="Nama Karyawan" required />

                </div>
                <div class="flex">

                    <button onclick="add()"
                        class="btn-add-input mx-2 text-xl font-bold bg-slate-400 w-1/12 rounded-sm text-white"
                        onclick="addEmailField()" type="button">
                        +
                    </button>
                    <button onclick="remove()"
                        class="btn-add-input mx-2 text-xl font-bold bg-slate-400 w-1/12 rounded-sm text-white"
                        onclick="addEmailField()" type="button">
                        -
                    </button>
                </div>

            </div>
            <div class="form-control w-9/12">
                <label class="label">
                    <span class="label-text">Jenis Pekerjaan</span>
                </label>
                <input type="text" id="jenis" name="jenis" placeholder="Jenis Pekerjaan"
                    class="input bg-transparent input-bordered border-2 w-9/12" required/>
            </div>
            <div class="form-control w-9/12">
                <label class="label">
                    <span class="label-text">Lokasi Pekerjaan</span>
                </label>
                <input type="text" id="lokasi" name="lokasi" placeholder="Lokasi pekerjaan"
                    class="input bg-transparent input-bordered border-2 w-9/12" required/>
            </div>
            <div class="form-control w-9/12">
                <label class="label">
                    <span class="label-text">Tanggal Pekerjaan</span>
                </label>
                <div class="flex w-9/12 gap-x-2">

                    <div class="w-1/2">
                        <label class="label">
                            <span class="label-text">Dari</span>
                        </label>
                        <input type="date" id="daritanggalpekerjaan" name="daritanggalpekerjaan" placeholder="Tanggal pekerjaan"
                            class="input bg-transparent input-bordered border-2 w-full" data-theme="light" required/>
                    </div>
                    <div class="w-1/2">
                        <label class="label">
                            <span class="label-text">Sampai</span>
                        </label>
                        <input type="date" id="sampai tanggalpekerjaan" name="sampaitanggalpekerjaan" placeholder="Tanggal pekerjaan"
                            class="input bg-transparent input-bordered border-2 w-full" data-theme="light" />
                    </div>
                </div>
            </div>
            <label class="label">
                <span class="label-text">Waktu Pengerjaan</span>
            </label>
            <div class="form-control flex flex-row w-9/12 gap-2">
                <div class="flex gap-x-2 w-9/12">

                    <div class="w-1/2">

                        <label class="label">
                            <span class="label-text">Dari</span>
                        </label>
                        <select name="dari" id="dari" required
                            class="bg-white input bg-transparent input-bordered border-2 w-full">
                            <option value="">Dari</option>
                            <option value="00:00">00:00</option>
                            <option value="01:00">01:00</option>
                            <option value="02:00">02:00</option>
                            <option value="03:00">03:00</option>
                            <option value="04:00">04:00</option>
                            <option value="05:00">05:00</option>
                            <option value="06:00">06:00</option>
                            <option value="07:00">07:00</option>
                            <option value="08:00">08:00</option>
                            <option value="09:00">09:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                            <option value="17:00">17:00</option>
                            <option value="18:00">18:00</option>
                            <option value="19:00">19:00</option>
                            <option value="20:00">20:00</option>
                            <option value="21:00">21:00</option>
                            <option value="22:00">22:00</option>
                            <option value="23:00">23:00</option>
                        </select>
                        <!-- <input type="time" placeholder="Waktu pengerjaan" class="input bg-transparent input-bordered border-2 w-full" /> -->
                    </div>
                    <div class="w-1/2">
                        <label class="label">
                            <span class="label-text">Sampai</span>
                        </label>
                        <select name="sampai" id="sampai" required
                            class="bg-white input bg-transparent input-bordered border-2 w-full">
                            <option value="">Sampai</option>
                            <option value="00:00">00:00</option>
                            <option value="01:00">01:00</option>
                            <option value="02:00">02:00</option>
                            <option value="03:00">03:00</option>
                            <option value="04:00">04:00</option>
                            <option value="05:00">05:00</option>
                            <option value="06:00">06:00</option>
                            <option value="07:00">07:00</option>
                            <option value="08:00">08:00</option>
                            <option value="09:00">09:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                            <option value="17:00">17:00</option>
                            <option value="18:00">18:00</option>
                            <option value="19:00">19:00</option>
                            <option value="20:00">20:00</option>
                            <option value="21:00">21:00</option>
                            <option value="22:00">22:00</option>
                            <option value="23:00">23:00</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                        <!-- <input type="time" placeholder="Waktu pengerjaan" class="input bg-transparent input-bordered border-2 w-full" /> -->
                    </div>
                </div>

            </div>

            <div class="form-control w-9/12 hidden" id="keteranganpa">
                <label class="label">
                    <span class="label-text">Keterangan No PA</span>
                </label>
                <input type="text" id="keteranganInput" name="keterangan" placeholder="Keterangan"
                    class="input bg-transparent input-bordered border-2 w-9/12" />
            </div>
            <div class="form-control w-9/12 hidden" id="keteranganandop">
                <label class="label">
                    <span class="label-text">Keterangan No Andop</span>
                </label>
                <input type="text" id="keteranganInput" name="keterangan" placeholder="Keterangan"
                    class="input bg-transparent input-bordered border-2 w-9/12" />
            </div>
            <button class="btn btn-wide mt-5" type="submit">Submit</button>
        </form>

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

<script>
    var formfield = document.getElementById('email-list');
    var counter = 0;

    function division(that) {
        if (that.value == "aktv") {
            console.log("aktivasi")
            document.getElementById("keteranganpa").style.display = "block";
            document.getElementById("keteranganpa").querySelector('input').setAttribute('required', '');
            document.getElementById("keteranganpa").querySelector('input').removeAttribute('disabled', '');
            document.getElementById("keteranganandop").style.display = "none";
            document.getElementById("keteranganandop").querySelector('input').setAttribute('disabled', '');
        } else if (that.value == "pmlh") {
            document.getElementById("keteranganpa").style.display = "none";
            document.getElementById("keteranganpa").querySelector('input').setAttribute('disabled', '');
            document.getElementById("keteranganandop").style.display = "block";
            document.getElementById("keteranganandop").querySelector('input').setAttribute('required', '');
            document.getElementById("keteranganandop").querySelector('input').removeAttribute('disabled', '');
        } else {
            document.getElementById("keteranganandop").style.display = "none";
            document.getElementById("keteranganandop").querySelector('input').setAttribute('disabled', '');
            document.getElementById("keteranganpa").querySelector('input').setAttribute('disabled', '');
            document.getElementById("keteranganpa").style.display = "none";

        }
    }

    function add() {
        counter++
        var newPetugas = document.createElement('input');
        // var newHandphone = document.createElement('input');
        var value = parseInt(document.getElementById('myNumber').value, 10);

        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('myNumber').value = value;

        newPetugas.setAttribute('type', 'text');
        newPetugas.setAttribute('name', `petugas${counter}`);
        newPetugas.setAttribute("required", "");
        newPetugas.classList.add("input");
        newPetugas.classList.add("bg-transparent");
        newPetugas.classList.add("input-bordered");
        newPetugas.classList.add("w-9/12");
        newPetugas.classList.add("mb-2");
        newPetugas.classList.add("border-2");
        newPetugas.setAttribute('placeholder', 'Nama Karyawan');

        formfield.appendChild(newPetugas);
    }

    function remove() {
        var value = parseInt(document.getElementById('myNumber').value, 10);

        value = isNaN(value) ? 0 : value;
        value = value > 1 ? value - 1 : 1;;
        document.getElementById('myNumber').value = value;

        counter--
        var input_tags = formfield.getElementsByTagName('input');
        if (input_tags.length > 1) {
            // const newHandphone = field.previousElementSibling;
            // const field = el.target.parentElement;
            // newHandphone.remove()
            formfield.removeChild(input_tags[(input_tags.length) - 1]);
            // formfield.removeChild(input_tags[(input_tags.length) - 1]);
        }
    }

</script>
