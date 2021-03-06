
@extends('layouts.admin')

@section('Dashboard-Content')


<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Transaksi atas Nama &raquo; {{ $transaction->id }} {{ $transaction->name }}
</h2>








<div class="antialiased sans-serif min-h-screen bg-white" style="min-height: 900px">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    <style>
        [x-cloak] {
            display: none;
        }

        @media print {
            .no-printme  {
                display: none;
            }
            .printme  {
                display: block;
            }
            body {
                line-height: 1.2;
            }
        }

        @page {
            size: A4 portrait;
            counter-increment: page;
        }

        /* Datepicker */
        .date-input {
            background-color: #fff;
            border-radius: 10px;
            padding: 0.5rem 1rem;
            z-index: 2000;
            margin: 3px 0 0 0;
            border-top: 1px solid #eee;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
                0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .date-input.is-hidden {
            display: none;
        }
        .date-input .pika-title {
            padding: 0.5rem;
            width: 100%;
            text-align: center;
        }
        .date-input .pika-prev,
        .date-input .pika-next {
            margin-top: 0;
            /* margin-top: 0.5rem; */
            padding: 0.2rem 0;
            cursor: pointer;
            color: #4299e1;
            text-transform: uppercase;
            font-size: 0.85rem;
        }
        .date-input .pika-prev:hover,
        .date-input .pika-next:hover {
            text-decoration: underline;
        }
        .date-input .pika-prev {
            float: left;
        }
        .date-input .pika-next {
            float: right;
        }
        .date-input .pika-label {
            display: inline-block;
            font-size: 0;
        }
        .date-input .pika-select-month,
        .date-input .pika-select-year {
            display: inline-block;
            border: 1px solid #ddd;
            color: #444;
            background-color: #fff;
            border-radius: 10px;
            font-size: 0.9rem;
            padding-left: 0.5em;
            padding-right: 0.5em;
            padding-top: 0.25em;
            padding-bottom: 0.25em;
            appearance: none;
        }
        .date-input .pika-select-month:focus,
        .date-input .pika-select-year:focus {
            border-color: #cbd5e0;
            outline: none;
        }
        .date-input .pika-select-month {
            margin-right: 0.25em;
        }
        .date-input table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0.2rem;
        }
        .date-input table th {
            width: 2em;
            height: 2em;
            font-weight: normal;
            color: #718096;
            text-align: center;
        }
        .date-input table th abbr {
            text-decoration: none;
        }
        .date-input table td {
            padding: 2px;
        }
        .date-input table td button {
            /* border: 1px solid #e2e8f0; */
            width: 1.8em;
            height: 1.8em;
            text-align: center;
            color: #555;
            border-radius: 10px;
        }
        .date-input table td button:hover {
            background-color: #bee3f8;
        }
        .date-input table td.is-today button {
            background-color: #ebf8ff;
        }
        .date-input table td.is-selected button {
            background-color: #3182ce;
        }
        .date-input table td.is-selected button {
            color: white;
        }
        .date-input table td.is-selected button:hover {
            color: white;
        }
    </style>

        <div class="border-t-8 border-gray-700 h-2"></div>
            <div
                class="container mx-auto py-6 px-4"
                x-data="invoices()"
                x-init="generateInvoiceNumber(111111, 999999);"
                x-cloak
            >
        <div class="flex justify-between">
            <h2 class="text-2xl font-bold mb-6 pb-2 tracking-wider uppercase">Laporan Pesanan</h2>
            <div>
                <div class="relative mr-4 inline-block">
                    <div class="text-gray-500 cursor-pointer w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-300 inline-flex items-center justify-center" @mouseenter="showTooltip = true" @mouseleave="showTooltip = false" @click="printInvoice()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                            <rect x="7" y="13" width="10" height="8" rx="2" />
                        </svg>
                    </div>
                    <div x-show.transition="showTooltip" class="z-40 shadow-lg text-center w-32 block absolute right-0 top-0 p-2 mt-12 rounded-lg bg-gray-800 text-white text-xs">
                        Print this invoice!
                    </div>
                </div>

                <div class="relative inline-block">
                    <div class="text-gray-500 cursor-pointer w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-300 inline-flex items-center justify-center" @mouseenter="showTooltip2 = true" @mouseleave="showTooltip2 = false" @click="window.location.reload()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -5v5h5" />
                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 5v-5h-5" />
                        </svg>
                    </div>
                    <div x-show.transition="showTooltip2" class="z-40 shadow-lg text-center w-32 block absolute right-0 top-0 p-2 mt-12 rounded-lg bg-gray-800 text-white text-xs">
                        Reload Page
                    </div>
                </div>
            </div>
        </div>

     <div class="flex mb-8 justify-between">
            <div class="w-2/4">
                <div class="mb-2 md:mb-1 md:flex items-center">
                    <label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Nama Pemesan.</label>
                    <span class="mr-4 inline-block hidden md:block">:</span>
                    {{ $transaction->name }}
                </div>
                <div class="mb-2 md:mb-1 md:flex items-center">
                    <label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">No Telepon </label>
                    <span class="mr-4 inline-block hidden md:block">:</span>
                    {{ $transaction->phone }}

                </div>

                <div class="mb-2 md:mb-1 md:flex items-center">
                    <label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Email Pemesan</label>
                    <span class="mr-4 inline-block hidden md:block">:</span>
                    {{ $transaction->email }}

                </div>

                <div class="mb-2 md:mb-1 md:flex items-center">
                    <label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Tanggal Acara</label>
                    <span class="mr-4 inline-block hidden md:block">:</span>
                    {{ $transaction->tglacara }}
                </div>
            </div>
            <div>
                <div class="w-32 h-32 mb-1 border rounded-lg overflow-hidden relative bg-gray-100">
                    <img id="image" class="object-cover w-full h-32" src="https://placehold.co/300x300/e2e8f0/e2e8f0" />

                    <div class="absolute top-0 left-0 right-0 bottom-0 w-full block cursor-pointer flex items-center justify-center" onClick="document.getElementById('fileInput').click()">
                        <button type="button"
                            style="background-color: rgba(255, 255, 255, 0.65)"
                            class="hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 text-sm border border-gray-300 rounded-lg shadow-sm"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-camera" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                <path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
                                <circle cx="12" cy="13" r="3" />
                            </svg>
                        </button>
                    </div>
                </div>

                <input name="photo" id="fileInput" accept="image/*" class="hidden" type="file" onChange="let file = this.files[0];
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        document.getElementById('image').src = e.target.result;
                        document.getElementById('image2').src = e.target.result;
                    };

                    reader.readAsDataURL(file);
                ">
            </div>
     </div>

    <div class="flex flex-wrap justify-between mb-8">
            <div class="w-full md:w-1/3 mb-2 md:mb-0">
                <label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Pesanan Untuk Acara:</label>
                <div class="bg-gray-200 p-2 rounded mt-1  mb-1 border-b border-grey cursor-pointer hover:bg-gray-200-lighter">
                    {{$transaction->name_acara}}
                </div>

                <label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Alamat Acara:</label>
                <div class="bg-gray-200 p-2 rounded mt-1  mb-1  border-b border-grey cursor-pointer hover:bg-gray-200-lighter">
                    {{$transaction->address}}
            </div>
                <label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Pembayaran:</label>
                <div class="bg-gray-200 p-2 rounded mt-1  mb-1  border-b border-grey cursor-pointer hover:bg-gray-200-lighter">
                    {{$transaction->payment}}
            </div>
            </div>
            <div class="w-full md:w-1/3">
                <label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Dari:</label>
                <div class="bg-gray-200 p-2 rounded mt-1  mb-1 border-b border-grey cursor-pointer hover:bg-gray-200-lighter">
                    Zhafirah Catering
                </div>

                <label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Link Bukti Pembayaran</label>
                <div class="bg-gray-200 p-2 rounded mt-1  mb-1 border-b border-grey cursor-pointer hover:bg-gray-200-lighter">
                    {{$transaction->payment_url}}
            </div>
                <label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Status:</label>
                <div class="bg-gray-200 p-2 rounded mt-1  mb-1  border-b border-grey cursor-pointer hover:bg-gray-200-lighter">
                    {{$transaction->status}}
            </div>
            </div>
    </div>

    <div class="flex flex-wrap justify-between mb-8">
            <div class="w-full md:w-1/3 mb-2 md:mb-0">
                <label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Detail Request Tambahan Acara:</label>
                <div class="bg-gray-200 p-2 rounded mt-1  mb-1 border-b border-grey cursor-pointer hover:bg-gray-200-lighter">
                    {{$transaction->name_acara}}
                </div>

                <label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Request Protein:</label>
                <div class="bg-gray-200 p-2 rounded mt-1  mb-1  border-b border-grey cursor-pointer hover:bg-gray-200-lighter">
                    {{$transaction->request_tambahan}}
            </div>
                <label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Request Sambal 1:</label>
                <div class="bg-gray-200 p-2 rounded mt-1  mb-1  border-b border-grey cursor-pointer hover:bg-gray-200-lighter">
                    {{$transaction->request_sambal}}
            </div>
            </div>
            <div class="w-full md:w-1/3">
                <label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Request Sambal 2:</label>
                <div class="bg-gray-200 p-2 rounded mt-1  mb-1 border-b border-grey cursor-pointer hover:bg-gray-200-lighter">
                    {{$transaction->request_sambal2}}
                </div>

                <label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Request Saung</label>
                <div class="bg-gray-200 p-2 rounded mt-1  mb-1 border-b border-grey cursor-pointer hover:bg-gray-200-lighter">
                    {{$transaction->request_saung}}
            </div>
                <label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">DP / Deposit awal:</label>
                <div class="bg-gray-200 p-2 rounded mt-1  mb-1  border-b border-grey cursor-pointer hover:bg-gray-200-lighter">
                    Rp.{{ number_format($transaction->deposit) }}
            </div>
            </div>
    </div>


    <h2 class="font-semibold text-lg text-gray-800 leading-tight mb-5">Product / Paket yang di pesan</h2>
    <div class="shadow overflow-hidden sm:rounded-md">
        <div class="px-5 py-5 bg-white sm:p-6">
            <table id="crudTable1">
                <thead>
                <tr>
                    <th>ID</th>

                    <th>Produk / Paket</th>
                    <th>Harga per Porsi</th>
                    <th>Kategori / Paket</th>

                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <div class="py-2 ml-auto mt-5 w-full sm:w-2/4 lg:w-1/4">
            <div class="flex justify-between mb-3">
                <div class="text-gray-800 text-right flex-1">Harga Perporsi</div>
                <div class="text-right w-40">
                    <p class="text-gray-800 font-medium" x-html="">Rp.{{ number_format($transaction->total_price) }}</p>
                </div>
            </div>
            <div class="flex justify-between mb-4">
                <div class="text-sm text-gray-600 text-right flex-1">Porsi pesanan</div>
                <div class="text-right w-40">
                    <p class="text-sm text-gray-600" x-html=""></">{{ number_format($transaction->porsi) }}Porsi</p>
                </div>
            </div>
            <div class="flex justify-between mb-4">
                <div class="text-sm text-gray-600 text-right flex-1">Deposit awal</div>
                <div class="text-right w-40">
                    <p class="text-sm text-gray-600" x-html=""></">Rp.{{ number_format($transaction->deposit) }}</p>
                </div>
            </div>

            <div class="py-2 border-t border-b">
                <div class="flex justify-between">
                    <div class="text-xl text-gray-600 text-right flex-1">Total Pembayaran</div>
                    <div class="text-right w-40">
                        <p class="text-xl text-gray-800 font-bold" x-html="">Rp.{{ number_format($transaction->total_price * $transaction->porsi - $transaction->deposit)}}</p>
                    </div>
                </div>
            </div>
    </div>

        <!-- Print Template -->
    <div id="js-print-template" x-ref="printTemplate" class="hidden">
            <div class="mb-8 flex justify-between">
                <div>
                    <h2 class="text-3xl font-bold mb-6 pb-2 tracking-wider uppercase">Laporan Pesanan Akhir</h2>

                    <div class="mb-1 flex items-center">
                        <label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Invoice No.</label>
                        <span class="mr-4 inline-block">:  ZC-{{$transaction->id}}</span>
                        <div x-text="invoiceNumber"></div>
                    </div>

                    <div class="mb-1 flex items-center">
                        <label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Nama Pemesan</label>
                        <span class="mr-4 inline-block">:  {{ $transaction->name }}</span>
                        <div x-text="invoiceDate"></div>
                    </div>

                    <div class="mb-1 flex items-center">
                        <label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">No Telepon</label>
                        <span class="mr-4 inline-block">: {{ $transaction->phone }}</span>
                        <div x-text="invoiceDueDate"></div>
                    </div>
                    <div class="mb-1 flex items-center">
                        <label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Email Pemesan</label>
                        <span class="mr-4 inline-block">: {{ $transaction->email }}</span>
                        <div x-text="invoiceDueDate"></div>
                    </div>
                </div>
                <div class="pr-5">
                    <div class="w-32 h-32 mb-1 overflow-hidden">
                        <img id="image2" class="object-cover w-20 h-20" />
                    </div>
                </div>
            </div>

            <div class="flex justify-between mb-2">
                <div class="w-1/0">
                    <label class="text-gray-800 block mb-2 font-bold text-xs uppercase tracking-wide">Pesanan Untuk Acara:</label>
                    <div>

                        <div class="mb-1 flex items-center">
                            <label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Nama Pemesan</label>
                            <span class="mr-4 inline-block">:  {{ $transaction->name_acara }}</span>
                            <div x-text="invoiceDate"></div>
                        </div>

                        <div class="mb-1 flex items-center">
                            <label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Alamat Acara</label>
                            <span class="mr-4 inline-block">: {{ $transaction->address }}</span>
                            <div x-text="invoiceDueDate"></div>
                        </div>
                        <div class="mb-1 flex items-center">
                            <label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Pembayaran</label>
                            <span class="mr-4 inline-block">: {{ $transaction->payment }}</span>
                            <div x-text="invoiceDueDate"></div>
                        </div>

                    </div>
                    <br>
                    <label class="text-gray-800 block mb-2 font-bold text-xs uppercase tracking-wide">Detail Request Tambahan Untuk Acara:</label>
                    <div>

                        <div class="mb-1 flex items-center">
                            <label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Request Protein</label>
                            <span class="mr-4 inline-block">:  {{ $transaction->request_tambahan }}</span>
                            <div x-text="invoiceDate"></div>
                        </div>

                        <div class="mb-1 flex items-center">
                            <label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Request Sambal</label>
                            <span class="mr-4 inline-block">: {{ $transaction->request_sambal }}</span>
                            <div x-text="invoiceDueDate"></div>
                        </div>
                        <div class="mb-1 flex items-center">
                            <label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Request Sambal 2</label>
                            <span class="mr-4 inline-block">: {{ $transaction->request_sambal2 }}</span>
                            <div x-text="invoiceDueDate"></div>
                        </div>
                    </div>
                </div>



                <div class="w-1/3">
                    <label class="text-gray-800 block mb-2 font-bold text-xs uppercase tracking-wide">From:</label>
                    <div>
                        <div class="mb-1 flex items-center">
                            <label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Nama Catering</label>
                            <span class="mr-4 inline-block">: Zhafirah Catering</span>
                            <div x-text="invoiceDate"></div>
                        </div>
                        <div class="mb-1 flex items-center">
                            <label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Status</label>
                            <span class="mr-4 inline-block">: {{ $transaction->status }}</span>
                            <div x-text="invoiceDueDate"></div>
                        </div>

                        <div class="mt-20 flex items-center">
                            <label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Request Saung</label>
                            <span class="mr-4 inline-block">: {{ $transaction->request_saung }}</span>
                            <div x-text="invoiceDueDate"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="flex flex-wrap -mx-1 -mt-2 border-b py-2 items-start">
                <div class="flex-1 px-1">
                    <p class="text-gray-600 uppercase tracking-wide text-xs font-bold">Detail Pembayaran</p>
                </div>

                <div class="px-1 w-32 text-right">
                    <p class="leading-none">
                        <span class="block uppercase tracking-wide text-xs font-bold text-gray-600">Porsi</span>
                        <p class="font-medium text-xs text-gray-500">({{number_format($transaction->porsi)}})</p>
                    </p>
                </div>

                <div class="px-1 w-32 text-right">
                    <p class="leading-none">
                        <span class="block uppercase tracking-wide text-xs font-bold text-gray-600">Harga Perporsi </span>
                        <p class="font-medium text-xs text-gray-500">(Rp.{{number_format($transaction->total_price)}})</p>
                    </p>
                </div>
                <div class="px-1 w-32 text-right">
                    <p class="leading-none">
                        <span class="block uppercase tracking-wide text-xs font-bold text-gray-600">DP / Deposit</span>
                        <p class="font-medium text-xs text-gray-500">(Rp.{{number_format($transaction->deposit)}})</p>
                    </p>
                </div>

                <div class="px-1 w-32 text-right">
                    <p class="leading-none">
                        <span class="block uppercase tracking-wide text-xs font-bold text-gray-600">Total</span>
                        <span class="font-medium text-xs text-gray-500">Rp.{{number_format($transaction->total_price * $transaction->porsi)}}</span>
                    </p>
                </div>
            </div>
            <template x-for="invoice in items" :key="invoice.id">
                <div class="flex flex-wrap -mx-1 py-2 border-b">
                    <div class="flex-1 px-1">
                        <p class="text-gray-800" x-text="invoice.name"></p>
                    </div>

                    <div class="px-1 w-32 text-right">
                        <p class="text-gray-800" x-text="invoice.qty"></p>
                    </div>

                    <div class="px-1 w-32 text-right">
                        <p class="text-gray-800" x-text="numberFormat(invoice.rate)"></p>
                    </div>

                    <div class="px-1 w-32 text-right">
                        <p class="text-gray-800" x-text="numberFormat(invoice.total)"></p>
                    </div>
                </div>
            </template>

            <div class="py-2 ml-auto mt-20" style="width: 320px">
                <div class="flex justify-between mb-3">
                    <div class="text-gray-800 text-right flex-1">Deposit Awal</div>
                    <div class="text-right w-40">
                        <p class="text-gray-800 font-medium">Rp.{{number_format($transaction->deposit)}}</p>
                    </div>
                </div>
                <div class="flex justify-between mb-4">
                    <div class="text-sm text-gray-600 text-right flex-1">Jumlah Porsi Total</div>
                    <div class="text-right w-40">
                        <p class="text-sm text-gray-600" >Rp.{{number_format($transaction->total_price * $transaction->porsi)}}</p>
                    </div>
                </div>

                <div class="py-2 border-t border-b">
                    <div class="flex justify-between">
                        <div class="text-xl text-gray-600 text-right flex-1">Sisa Pembayaran</div>
                        <div class="text-right w-40">
                            <p class="text-xl text-gray-800 font-bold" >Rp.{{number_format($transaction->deposit - $transaction->total_price * $transaction->porsi)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="font-semibold text-lg text-gray-800 leading-tight mb-5">Product / Paket yang di pesan</h2>
    <div class="shadow overflow-hidden sm:rounded-md">
        <div class="px-5 py-1 bg-white sm:p-6">
            <table id="crudTable2">
                <thead>
                <tr>
                    <th>ID</th>

                    <th>Produk / Paket</th>
                    <th>Harga per Porsi</th>
                    <th>Kategori / Paket</th>

                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    </div>
        <!-- /Print Template -->
</div>

<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
<script>
    window.addEventListener('DOMContentLoaded', function() {
        const today = new Date();

        var picker = new Pikaday({
            keyboardInput: false,
            field: document.querySelector('.js-datepicker'),
            format: 'MMM D YYYY',
            theme: 'date-input',
            i18n: {
                previousMonth: "Prev",
                nextMonth: "Next",
                months: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec"
                ],
                weekdays: [
                    "Sunday",
                    "Monday",
                    "Tuesday",
                    "Wednesday",
                    "Thursday",
                    "Friday",
                    "Saturday"
                ],
                weekdaysShort: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"]
            }
        });
        picker.setDate(new Date());

        var picker2 = new Pikaday({
            keyboardInput: false,
            field: document.querySelector('.js-datepicker-2'),
            format: 'MMM D YYYY',
            theme: 'date-input',
            i18n: {
                previousMonth: "Prev",
                nextMonth: "Next",
                months: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec"
                ],
                weekdays: [
                    "Sunday",
                    "Monday",
                    "Tuesday",
                    "Wednesday",
                    "Thursday",
                    "Friday",
                    "Saturday"
                ],
                weekdaysShort: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"]
            }
        });
        picker2.setDate(new Date());
    });

    function invoices() {
        return {
            items: [],
            invoiceNumber: 0,
            invoiceDate: '',
            invoiceDueDate: '',

            totalGST: 0,
            netTotal: 0,

            item: {
                id: '',
                name: '',
                qty: 0,
                rate: 0,
                total: 0,
                gst: 18
            },

            billing: {
                name: '',
                address: '',
                extra: ''
            },
            from: {
                name: '',
                address: '',
                extra: ''
            },

            showTooltip: false,
            showTooltip2: false,
            openModal: false,

            addItem() {
                this.items.push({
                    id: this.generateUUID(),
                    name: this.item.name,
                    qty: this.item.qty,
                    rate: this.item.rate,
                    gst: this.calculateGST(this.item.gst, this.item.rate),
                    total: this.item.qty * this.item.rate
                })

                this.itemTotal();
                this.itemTotalGST();

                this.item.id = '';
                this.item.name = '';
                this.item.qty = 0;
                this.item.rate = 0;
                this.item.gst = 18;
                this.item.total = 0;
            },

            deleteItem(uuid) {
                this.items = this.items.filter(item => uuid !== item.id);

                this.itemTotal();
                this.itemTotalGST();
            },

            itemTotal() {
                this.netTotal = this.numberFormat(this.items.length > 0 ? this.items.reduce((result, item) => {
                    return result + item.total;
                }, 0) : 0);
            },

            itemTotalGST() {
                this.totalGST =  this.numberFormat(this.items.length > 0 ? this.items.reduce((result, item) => {
                    return result + (item.gst * item.qty);
                }, 0) : 0);
            },

            calculateGST(GSTPercentage, itemRate) {
                return this.numberFormat((itemRate - (itemRate * (100 / (100 + GSTPercentage)))).toFixed(2));
            },

            generateUUID() {
                return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                    var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
                    return v.toString(16);
                });
            },

            generateInvoiceNumber(minimum, maximum) {
                const randomNumber = Math.floor(Math.random() * (maximum - minimum)) + minimum;
                this.invoiceNumber = '#INV-'+ randomNumber;
            },

            numberFormat(amount) {
                return amount.toLocaleString("en-US", {
                    style: "currency",
                    currency: "INR"
                });
            },

            printInvoice() {
                var printContents = this.$refs.printTemplate.innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        }
    }
</script>



<script>
    // AJAX DataTable
    var datatable = $('#crudTable1').DataTable({
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns: [
            { data: 'id', name: 'id'},
            { data: 'product.name', name: 'product.name'  },
            { data: 'product.price', name: 'product.price' },
            { data: 'product.category', name: 'product.category' },

        ],
    });
</script>
<script>
    // AJAX DataTable
    var datatable = $('#crudTable2').DataTable({
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns: [
            { data: 'id', name: 'id'},
            { data: 'product.name', name: 'product.name'  },
            { data: 'product.price', name: 'product.price' },
            { data: 'product.category', name: 'product.category' },

        ],
        "searching": false,
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
    });
</script>
@endsection








