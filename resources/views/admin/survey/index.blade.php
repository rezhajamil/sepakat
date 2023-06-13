@extends('layouts.dashboard', ['plain' => false])
@section('content')
    @if (session('success'))
        <div class="relative w-6/12 p-4 mx-auto text-white bg-teal-500 rounded-lg shadow-lg">{{ session('success') }}</div>
    @endif
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div
                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                    <div
                        class="flex justify-between p-6 pb-0 mb-2 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <h6 class="text-lg uppercase">Data Survey</h6>
                        <div class="flex px-4 gap-x-2">
                            <a href="{{ route('admin.survey.create') }}"
                                class="inline-block p-1 font-bold text-center text-white ease-in-out bg-orange-500 rounded-md hover:bg-orange-700 aspect-square"><i
                                    class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2 mt-8">
                        <div class="px-0 py-6 overflow-x-auto" id="table-data">
                            <table class="items-center w-full mb-0 align-top border-collapse text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            No</th>
                                        <th
                                            class="px-6 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Tanggal</th>
                                        <th
                                            class="px-6 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Nama Survey</th>
                                        <th
                                            class="px-6 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Deskripsi</th>
                                        <th
                                            class="px-6 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Status</th>
                                        <th
                                            class="px-6 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70 action">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($surveys as $key => $survey)
                                        <tr class="border-b">
                                            <td
                                                class="px-6 py-3 align-middle bg-transparent whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 text-sm font-bold leading-tight text-left">
                                                    {{ $key + 1 }}</p>
                                            </td>
                                            <td
                                                class="px-6 py-3 align-middle bg-transparent whitespace-nowrap shadow-transparent date">
                                                <p class="mb-0 text-sm font-semibold leading-tight text-left">
                                                    {{ date('d M Y', strtotime($survey->date)) }}</p>
                                            </td>
                                            <td
                                                class="px-6 py-3 align-middle bg-transparent whitespace-nowrap shadow-transparent amount">
                                                <p class="mb-0 text-sm font-semibold leading-tight text-left">
                                                    {{ $survey->nama }}</p>
                                            </td>
                                            <td class="px-6 py-3 align-middle bg-transparent shadow-transparent address">
                                                <p class="mb-0 text-sm font-semibold leading-tight text-left">
                                                    {!! $survey->deskripsi !!}</p>
                                            </td>
                                            <td class="px-6 py-3 align-middle bg-transparent shadow-transparent">
                                                @if ($survey->status)
                                                    <div
                                                        class="flex items-center justify-center px-3 py-1 rounded-full w-fit bg-green-200/50">
                                                        <span class="text-sm font-semibold text-green-900">Aktif</span>
                                                    </div>
                                                @else
                                                    <div
                                                        class="flex items-center justify-center px-3 py-1 rounded-full w-fit bg-red-200/50">
                                                        <span
                                                            class="text-sm font-semibold text-red-900 whitespace-nowrap">Tidak
                                                            Aktif</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td
                                                class="flex-col h-full px-6 py-3 align-middle bg-transparent gap-y-1 whitespace-nowrap shadow-transparent action">
                                                <a href="{{ route('admin.survey.resume', $survey->id) }}"
                                                    class="block text-sm font-semibold leading-tight cursor-pointer text-slate-400">
                                                    Hasil </a>
                                                <form action="{{ route('admin.survey.change_status', $survey->id) }}"
                                                    method="post" class="m-0">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit"
                                                        class="text-sm font-semibold leading-tight text-yellow-600 cursor-pointer">
                                                        Change Status
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <td colspan="7" class="w-full py-4 text-lg font-semibold text-center">Tidak Ada
                                            Data
                                        </td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#search").on("input", function() {
                find();
            });

            $("#search_by").on("input", function() {
                find();
            });

            $('#print').click(function() {
                print();
            })

            const find = () => {
                let search = $("#search").val();
                let searchBy = $('#search_by').val();
                let pattern = new RegExp(search, "i");
                $(`.${searchBy}`).find('p').each(function() {
                    let label = $(this).text();
                    if (pattern.test(label)) {
                        $(this).parent().parent().show();
                    } else {
                        $(this).parent().parent().hide();
                    }
                });
            }

            const print = () => {

                let start_date = $("#start_date").attr('text');
                let end_date = $("#end_date").attr('text');

                // Select the HTML table element
                var table = $('#table-data').clone();
                table.prepend(
                    `<span class='px-6 my-8 text-lg font-bold'>Laporan Barang Masuk${end_date?" "+end_date:''} ${end_date?"s/d "+end_date:''}</span>`
                )
                // Remove the column with the 'action' class
                table.find('.action').remove();

                // Convert the table to PDF
                html2pdf()
                    .from(table[0])
                    .save(`Laporan Barang Masuk${end_date?" "+end_date:''} ${end_date?"s/d "+end_date:''}.pdf`);
            }
        })
    </script>
@endsection
