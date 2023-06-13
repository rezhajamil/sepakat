@extends('layouts.dashboard', ['plain' => false])
@section('content')
    <div class="px-6 mx-4">
        <div class="flex flex-col">
            <div class="mt-4 overflow-y-auto">
                <div class="flex justify-between w-fit">
                    <a href="{{ route('admin.survey.index') }}"
                        class="block px-4 py-2 my-2 font-bold text-white rounded-md  w-fit hover:underline"><i
                            class="mr-2 fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <h4 class="inline-block mb-2 text-xl font-bold text-white align-baseline" id="title">
                    {{ $survey->nama }}</h4>
                {{-- <button class="px-2 py-1 ml-2 text-lg text-white transition bg-green-600 rounded-md hover:bg-green-800" id="capture"><i class="fa-regular fa-circle-down"></i></button> --}}
                <input type="hidden" name="survey" id="survey" value="{{ json_encode($survey) }}">
                <input type="hidden" name="answer" id="answer" value="{{ json_encode($answer) }}">
                <div class="mb-8 overflow-auto bg-white rounded-md shadow w-fit" id="result-container">
                    <table class="overflow-auto text-left bg-white border-collapse w-fit" id="table-data">
                        <thead class="border-b" id="thead">
                        </thead>
                        <tbody class="max-h-screen overflow-y-auto" id="tbody">
                            <tr id="load" class="font-semibold text-center text-white bg-orange-800">
                                <td colspan="6">Memuat Data...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            let title = $("#title").val();
            let answer = JSON.parse($('#answer').val());
            let survey = JSON.parse($('#survey').val());
            let header, body;
            let pos_head = 0;

            answer.map(data => data.pilihan = JSON.parse(data.pilihan));

            const getResult = () => {
                // $("#tbody").html('');
                header = '';
                body = '';
                $("#load").show();

                header += `
            <tr class="border-b">
                <th rowspan="2" class="p-3 text-sm font-medium text-center text-gray-100 uppercase border bg-orange-600">No</th>
                <th rowspan="2" class="p-3 text-sm font-medium text-center text-gray-100 uppercase border bg-orange-600">Nama</th>
                <th rowspan="2" class="p-3 text-sm font-medium text-center text-gray-100 uppercase border bg-orange-600">NIK</th>
            `;

                survey.soal.map((data, i) => {
                    header += `
                <th colspan="${survey.jenis_soal[i]=='Prioritas'?survey.jumlah_opsi[i]:1}" rowspan="${survey.jenis_soal[i]=='Prioritas'?1:2}" class="p-3 text-sm font-bold text-center text-gray-100 border bg-orange-800 whitespace-nowrap">${data}</th>
                ${i==survey.soal.length-1??'</tr>'}
                `;
                });

                header += '<tr>';
                survey.jenis_soal.map((data, i) => {
                    if (data == 'Prioritas') {
                        for (let index = 1; index <= survey.jumlah_opsi[i]; index++) {
                            header += `
                        <th class="p-3 text-sm font-bold text-center text-gray-100 border bg-red-800">#${index}</th>
                        `;
                        }
                    }
                });
                header += '</tr>';

                answer.map((data, key) => {
                    console.log(data)
                    body += `<tr>
                <td class="p-4 font-bold text-center text-gray-700 border border-b-2 border-r-2">${key+1}</td>
                <td class="p-4 font-bold text-center text-gray-700 border border-b-2 border-r-2">${data.name}</td>
                <td class="p-4 font-bold text-center text-gray-700 border border-b-2 border-r-2">${data.nik}</td>
                `;
                    data.pilihan.map((pil, i_pil) => {
                        if (survey.jenis_soal[i_pil] != 'Prioritas') {
                            if (survey.jenis_soal[i_pil] == 'Pilgan & Isian' && pil.length >
                                1) {
                                body += `
                            <td class="p-4 text-gray-700 border border-b-2 border-r-2">
                                <p class="mb-2">${pil[0]}</p>
                                <p class="font-bold">${pil[1]}</p>
                            </td>
                            `;
                            } else {
                                body += `
                            <td class="p-4 text-gray-700 border border-b-2 border-r-2">${pil.join(",")}</td>
                            `;
                            }
                        } else {
                            for (let index = 0; index < survey.jumlah_opsi[i_pil]; index++) {
                                body += `
                            <td class="p-4 text-gray-700 border border-b-2 border-r-2">${pil[index]??'-'}</td>
                            `;
                            }
                        }
                    });
                    body += "</tr>";
                })

                $("#thead").html(header)
                $("#tbody").html(body)
                $('#load').hide();
            }

            getResult();

            $('#button').click(function() {
                fnExcelReport();
            })
        });
    </script>
@endsection
