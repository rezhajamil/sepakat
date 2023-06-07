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
                        <h6 class="text-lg uppercase">Data Event</h6>
                        <div class="flex px-4 gap-x-2">
                            <a href="{{ route('admin.event.create') }}"
                                class="inline-block p-1 font-bold text-center text-white ease-in-out bg-orange-500 rounded-md hover:bg-orange-700 aspect-square"><i
                                    class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="flex flex-wrap justify-between px-6 gap-x-4 gap-y-8">
                        {{-- <div class="flex flex-wrap items-end gap-y-2 gap-x-4">
                            <input type="text" name="search" id="search" placeholder="Search..."
                                class="px-2 rounded-lg">
                            <div class="flex flex-col">
                                <select name="search_by" id="search_by" class="h-full px-6 py-2 rounded-lg">
                                    <option value="" selected disabled>Cari Berdasarkan</option>
                                    <option value="code">Kode Barang</option>
                                    <option value="distributor">Distributor</option>
                                    <option value="address">Alamat</option>
                                </select>
                            </div>
                        </div> --}}

                        <form action="" method="GET" class="flex flex-wrap items-center gap-y-2 gap-x-3">
                            <input type="date" name="start_date" id="start_date"
                                value="{{ request()->get('start_date') }}"
                                text="{{ request()->get('start_date') ? date('d M Y', strtotime(request()->get('start_date'))) : '' }}"
                                class="p-2 rounded-lg focus:ring-orange-500">
                            <span class="font-semibold">s/d</span>
                            <input type="date" name="end_date" id="end_date"
                                class="p-2 rounded-lg focus:ring-orange-500" value="{{ request()->get('end_date') }}"
                                text="{{ request()->get('end_date') ? date('d M Y', strtotime(request()->get('end_date'))) : '' }}">
                            <button type="submit"
                                class="p-2 font-semibold text-white transition-all rounded-lg !bg-orange-500 whitespace-nowrap !hover:bg-amber-700"><i
                                    class="mr-2 fa-solid fa-search"></i>Filter</button>
                            @if (request()->get('start_date') || request()->get('end_date'))
                                <a href=""
                                    class="p-2 font-semibold text-white transition-all rounded-lg bg-slate-500 whitespace-nowrap hover:bg-blue-700">
                                    <i class="mr-2 fa-solid fa-circle-xmark"></i>Reset
                                </a>
                            @endif
                        </form>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2 mt-8">
                        <div class="px-0 py-6 overflow-x-auto" id="table-data">
                            <table class="items-center w-full mb-0 align-top border-collapse text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            No</th>
                                        <th
                                            class="px-6 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Tanggal Event</th>
                                        <th
                                            class="px-6 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Nama Event</th>
                                        <th
                                            class="px-6 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Slug</th>
                                        <th
                                            class="px-6 py-3 text-xs font-bold text-left uppercase align-middle bg-transparent border-b border-collapse border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70 action">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($events as $key => $event)
                                        <tr class="">
                                            <td
                                                class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 text-xs font-bold leading-tight text-left">
                                                    {{ $key + 1 }}</p>
                                            </td>
                                            <td
                                                class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent date">
                                                <p class="mb-0 text-xs font-semibold leading-tight text-left">
                                                    {{ date('d M Y', strtotime($event->date)) }}</p>
                                            </td>
                                            <td
                                                class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent amount">
                                                <p class="mb-0 text-xs font-semibold leading-tight text-left">
                                                    {{ $event->title }}</p>
                                            </td>
                                            <td
                                                class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent slug">
                                                <p class="mb-0 text-xs font-semibold leading-tight text-left">
                                                    {{ $event->slug }}</p>
                                            </td>
                                            <td
                                                class="flex flex-col px-6 py-3 align-middle bg-transparent border-b gap-y-1 whitespace-nowrap shadow-transparent action">
                                                <a href="{{ route('admin.event.show', $event->id) }}"
                                                    class="block text-xs font-semibold leading-tight text-slate-400">
                                                    Lihat </a>
                                                <a href="{{ route('admin.event.edit', $event->id) }}"
                                                    class="block text-xs font-semibold leading-tight text-orange-400">
                                                    Edit </a>
                                                <form action="{{ route('admin.event.destroy', $event->id) }}"
                                                    method="post" class="m-0">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="text-xs font-semibold leading-tight text-red-600">
                                                        Delete
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
