<style>
    input::-webkit-calendar-picker-indicator {
        filter: invert(48%) sepia(13%) saturate(3207%) hue-rotate(130deg) brightness(95%) contrast(80%);
    }

    @media print {
        .no-print {
            display: none;
        }
    }
    
    </style>
<x-app-layout>
    <div class="bg-white m-5 p-10 rounded-lg text-black">
        <h1 class="font-bold text-xl">Surat Tugas</h1>
        <form action="{{route('pdf.create')}}" method="post">
            @csrf
            <!-- <div class="form-control w-9/12">
                <label class="label">
                    <span class="label-text">Tanggal</span>
                </label>
                <input type="date" id="tanggal" placeholder="Tanggal Pembuatan Surat" class="input bg-transparent input-bordered border-2 w-9/12" />
            </div> -->
            <div class="form-control w-9/12">
                <label class="label">
                    <span class="label-text">Nama Petugas</span>
                </label>
                <fieldset class="inputs-set" class="input-field">
                    <div  id="email-list" class="email-input__w grid grid-cols-5 grid-flow-row-dense w-9/12 gap-2">
                        <div class="col-span-2">
                            <input class="input bg-transparent w-full input-bordered border-2 mb-1" type="text" name="petugas" placeholder="Nama Petugas" required />
                        </div>
                        <div class="col-span-3 flex">
                            <input class="input bg-transparent input-bordered border-2 mb-1 w-2/3" type="tel" name="nomor" placeholder="No Handphone" required />
                            <button class="btn-add-input mx-2 text-xl font-bold" onclick="addEmailField()" type="button">
                                +
                            </button>
                        </div>
                    </div>
                </fieldset>
                <!-- <input type="text" id="petugas" name="petugas" placeholder="Nama Petugas"
                    class="input bg-transparent input-bordered border-2 w-9/12" /> -->
            </div>
            <div class="form-control w-9/12">
                <label class="label">
                    <span class="label-text">Jenis Pekerjaan</span>
                </label>
                <input type="text" id="jenis" name="jenis" placeholder="Jenis Pekerjaan"
                    class="input bg-transparent input-bordered border-2 w-9/12" />
            </div>
            <div class="form-control w-9/12">
                <label class="label">
                    <span class="label-text">Lokasi Pekerjaan</span>
                </label>
                <input type="text" id="lokasi" name="lokasi" placeholder="Lokasi pekerjaan"
                    class="input bg-transparent input-bordered border-2 w-9/12" />
            </div>
            <div class="form-control w-9/12">
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
                    <div class="w-9/12">
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
            <button class="btn btn-wide mt-5" type="submit">Submit</button>
        </form>
        <button class="px-2 py-1 bg-gray-100 m-2 rounded-md" id="btn-print">Generate PDF</button>

    </div>
    <iframe src="/pdf" id="frame" style="width: 100%; border:0; height:0;" class="m-0 p-0"></iframe>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    jQuery(document).ready(function () {
        // 
        $('#btn-print').click(function () {
            let wspFrame = document.getElementById('frame').contentWindow;
            let printOptions = {
                pages: "1",
                // Other print options can be added here
            };

            wspFrame.focus();
            wspFrame.print(printOptions);
            // window.print();
        });

    });
    const myForm = document.getElementById("email-list");
    var counter = 0;
    function addEmailField() {
        counter++
        // Create elements
        const nef_wrapper = document.createElement("div");
        const fen_wrapper = document.createElement("div");
        const nef = document.createElement("input");
        const fen = document.createElement("input");
        const btnAdd = document.createElement("button");
        const btnDel = document.createElement("button");

        // Add Class to main wrapper
        nef_wrapper.classList.add("col-span-2");
        fen_wrapper.classList.add("col-span-3");

        // set button ADD
        btnAdd.type = "button";
        btnAdd.classList.add("btn-add-input");
        btnAdd.classList.add("mx-2");
        btnAdd.classList.add("text-xl");
        btnAdd.classList.add("font-bold");
        btnAdd.innerText = "+";
        btnAdd.setAttribute("onclick", "addEmailField()");
        
        // set button DEL
        btnDel.type = "button";
        btnDel.classList.add("btn-del-input");
        btnAdd.classList.add("mx-2");
        btnAdd.classList.add("text-xl");
        btnAdd.classList.add("font-bold");
        btnDel.innerText = "-";

        // set Input field
        nef.type = "text";
        nef.name = "petugas" + counter;
        nef.setAttribute("required", "");
        nef.placeholder = "Nama Petugas " + counter;
        nef.classList.add("input");
        nef.classList.add("bg-transparent");
        nef.classList.add("input-bordered");
        nef.classList.add("w-full");
        nef.classList.add("mb-2");
        nef.classList.add("border-2");

        fen.type = "tel";
        fen.name = "handphone" + counter;
        fen.setAttribute("required", "");
        fen.placeholder = "No Handphone " + counter;
        fen.classList.add("input");
        fen.classList.add("bg-transparent");
        fen.classList.add("input-bordered");
        fen.classList.add("w-8/12");
        fen.classList.add("mb-2");
        fen.classList.add("border-2");

        //append elements to main wrapper
        nef_wrapper.appendChild(nef);
        fen_wrapper.appendChild(fen);
        nef_wrapper.appendChild(btnAdd);
        fen_wrapper.appendChild(btnAdd);
        nef_wrapper.appendChild(btnDel);
        fen_wrapper.appendChild(btnDel);

        // append element to DOM
        myForm.appendChild(nef_wrapper);
        myForm.appendChild(fen_wrapper);
        btnDel.addEventListener("click", removeEmailField);
    }

    //remove element from DOM
    function removeEmailField(el) {
        counter--;
        const field = el.target.parentElement;
        const nefWrapper = field.previousElementSibling;
        field.remove();
        nefWrapper.remove();
    }

</script>
