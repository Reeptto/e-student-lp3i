<x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<div class="max-w-6xl mx-auto px-4 py-10">

    {{-- HEADER --}}
    <div class="mb-10 border-b pb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            💳 Informasi Tagihan
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Ringkasan dan status pembayaran mahasiswa
        </p>
    </div>

    {{-- TOOLBAR --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">

        <button id="btn-print" onclick="downloadReport()"
            class="px-4 py-2 rounded-lg bg-teal-600 text-white text-sm font-semibold hover:bg-teal-700 transition">
            Cetak PDF
        </button>
    </div>

    {{-- ACCORDION --}}
    <div class="bg-white rounded-xl shadow border">
        <button onclick="togglePlan()"
            class="w-full flex justify-between items-center px-6 py-4 border-b hover:bg-gray-50 transition">
            <div>
                <h3 class="font-semibold text-gray-800">Rencana Pembayaran</h3>
                <p class="text-xs text-gray-400">Tahun Ajaran 2024 / 2025</p>
            </div>
            <svg id="chevron-icon" class="w-5 h-5 transition-transform rotate-180" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div id="plan-content" style="max-height:2000px"
            class="transition-[max-height] duration-500 overflow-hidden">

            <div id="printable-area" class="p-6 overflow-x-auto">

                <table class="min-w-[800px] w-full border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600">
                            <th class="border px-3 py-2">No</th>
                            <th class="border px-3 py-2 text-left">Deskripsi</th>
                            <th class="border px-3 py-2">TA</th>
                            <th class="border px-3 py-2">Jatuh Tempo</th>
                            <th class="border px-3 py-2 text-right">Nominal</th>
                            <th class="border px-3 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $payments = $payments ?? [
                                ['no'=>1,'desc'=>'Daftar Ulang','ta'=>'24/25','date'=>'10/01/24','bill'=>'1.500.000'],
                                ['no'=>2,'desc'=>'SPP Januari','ta'=>'24/25','date'=>'10/02/24','bill'=>'500.000'],
                                ['no'=>3,'desc'=>'Seragam','ta'=>'24/25','date'=>'10/03/24','bill'=>'700.000'],
                            ];
                        @endphp

                        @foreach ($payments as $p)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-3 py-2 text-center">{{ $p['no'] }}</td>
                            <td class="border px-3 py-2 font-medium">{{ $p['desc'] }}</td>
                            <td class="border px-3 py-2 text-center">{{ $p['ta'] }}</td>
                            <td class="border px-3 py-2 text-center">{{ $p['date'] }}</td>
                            <td class="border px-3 py-2 text-right font-semibold text-teal-600">
                                Rp {{ $p['bill'] }}
                            </td>
                            <td class="border px-3 py-2 text-center">
                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700 font-semibold">
                                    LUNAS
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- TOTAL --}}
                <div class="flex justify-end mt-6">
                    <div class="bg-gray-100 px-5 py-3 rounded-lg">
                        <span class="text-sm text-gray-500">Total:</span>
                        <span class="ml-2 text-lg font-bold text-teal-600">
                            Rp 3.700.000
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
function togglePlan() {
    const c = document.getElementById('plan-content');
    const i = document.getElementById('chevron-icon');
    if (c.style.maxHeight === "0px") {
        c.style.maxHeight = c.scrollHeight + "px";
        i.style.transform = "rotate(180deg)";
    } else {
        c.style.maxHeight = "0px";
        i.style.transform = "rotate(0deg)";
    }
}

function downloadReport() {
    const el = document.getElementById('printable-area');
    html2pdf().from(el).set({
        margin: 10,
        filename: 'Laporan_Keuangan.pdf',
        html2canvas: { scale: 2 },
        jsPDF: { format: 'a4', orientation: 'landscape' }
    }).save();
}
</script>
</x-app-layout>
