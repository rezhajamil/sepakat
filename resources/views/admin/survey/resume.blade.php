@extends('layouts.dashboard', ['plain' => false])
@section('content')
    <div class="px-6 mx-4">
        <div class="flex flex-col">
            <div class="mt-4 overflow-y-auto">
                <div class="flex justify-between w-fit">
                    <a href="{{ route('admin.survey.index') }}"
                        class="block px-4 py-2 my-2 font-bold text-white rounded-md w-fit hover:underline"><i
                            class="mr-2 fa-solid fa-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('admin.survey.result', $survey->id) }}"
                        class="block px-4 py-2 my-2 font-bold text-white rounded-md w-fit hover:underline"><i
                            class="mr-2 fa-solid fa-clipboard-list"></i> List Jawaban
                    </a>
                </div>
                <h4 class="inline-block mb-2 text-xl font-bold text-white align-baseline" id="title">
                    {{ $survey->nama }}</h4>
                <input type="hidden" name="survey" id="survey" value="{{ json_encode($survey) }}">
                <input type="hidden" name="answer" id="answer" value="{{ json_encode($answer) }}">

                <div class="mb-8 overflow-auto bg-white rounded-md shadow w-fit" id="result-container">
                    <table class="overflow-auto text-left bg-white border-collapse w-fit" id="table-data">
                        <thead class="border-b">
                            <tr class="border-b">
                                <th rowspan="2"
                                    class="p-3 text-sm font-medium text-center text-white uppercase bg-orange-600 border">
                                    Soal</th>
                                <th rowspan="2" colspan="2"
                                    class="p-3 text-sm font-medium text-center text-white uppercase bg-orange-600 border">
                                    Opsi</th>
                                <th rowspan="2" colspan="1"
                                    class="p-3 text-sm font-medium text-center text-white uppercase bg-orange-600 border">
                                    Jumlah</th>
                                <th rowspan="2" colspan="1"
                                    class="p-3 text-sm font-medium text-center text-white uppercase bg-orange-600 border">
                                    Persentase</th>
                            </tr>
                        </thead>
                        <tbody class="max-h-screen overflow-y-auto" id="tbody">
                            <tr id="load" class="font-semibold text-center text-white bg-orange-600">
                                <td colspan="8">Memuat Data...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div id="grafik-container"
                    class="absolute inset-0 z-30 flex items-center justify-center p-4 overflow-auto h-fit bg-black/70"
                    style="display: none">
                    <div class="w-full p-4 overflow-auto bg-white rounded-lg">
                        <div class="flex justify-end">
                            <button class="text-xl font-bold transition-all text-premier hover:text-red-900">X</button>
                        </div>
                        <div class="grid min-w-full grid-cols-2 gap-6" id="grafik-grid">
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            let title = $("#title").val();
            let survey = JSON.parse($('#survey').val());
            let answer = JSON.parse($('#answer').val());
            let school, pos, html, chartBar;

            $("#btn-excel").click(function() {
                exportTableToExcel('table-data', `${title}`);
            });

            $("#btn-grafik").click(function() {
                $("#grafik-container").show();
            });

            $("#grafik-container button").click(function() {
                $("#grafik-container").hide();
            });

            const createChart = (canvas, title, label, data) => {
                // console.log(data);
                chartBar = new Chart(canvas, {
                    type: 'bar',
                    data: {
                        labels: label,
                        datasets: data
                    },
                    options: {
                        responsive: true,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.4)', 'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 0.4)', 'rgba(75, 192, 192, 0.4)',
                            'rgba(153, 102, 255, 0.4)', 'rgba(255, 159, 64, 0.4)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: title
                            },
                            legend: {
                                display: false
                            }
                            // , subtitle: {
                            // display: true
                            // , text: date
                            // , }
                            // , datalabels: {
                            // display: true
                            // , backgroundColor: 'rgba(255,255,255,.6)'
                            // , borderRadius: 3
                            // , font: {
                            // weight: 'bold'
                            // , size: 10
                            // , }
                            // , formatter: function(value, context) {
                            // return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            // }
                            // }
                        },
                    }
                    // , plugins: [ChartDataLabels]
                    ,
                });
            }

            answer.map(data => data.pilihan = JSON.parse(data.pilihan));
            survey.validasi = JSON.parse(survey.validasi);
            survey.soal = survey.soal.filter((data, i) => survey.jenis_soal[i] != 'Isian');
            survey.jumlah_opsi = survey.jumlah_opsi.filter((data, i) => survey.jenis_soal[i] != 'Isian');
            survey.opsi = survey.opsi.filter((data, i) => data != '' && data != null);

            answer.map((data, i) => {
                data.pilihan = data.pilihan.filter((f, f_i) => survey.jenis_soal[f_i] != 'Isian');
            });

            survey.jenis_soal = survey.jenis_soal.filter((data, i) => data != 'Isian');

            const getResume = () => {
                $("#tbody").html('');
                $("#grafik-grid").html('');
                $("#load").show();
                html = '';

                pos = 0;
                row = 0;
                pr = 0;

                $("#partisipan").text(answer.length);

                $("#load-operator").hide();

                survey.soal.map((soal, i_soal) => {
                    if (survey.jenis_soal[i_soal] == 'Prioritas') {
                        for (let index = 0; index < survey.jumlah_opsi[
                                i_soal]; index++) {
                            row += parseInt(survey.jumlah_opsi[i_soal]);
                        }
                    } else {
                        row += parseInt(survey.jumlah_opsi[i_soal]);
                    }
                });
                html += ` <tr> `;
                survey.soal.map((soal, i_soal) => {
                    let choice = [];
                    let dataset = [{
                        // label: []
                        data: []
                    }];
                    let label = [];
                    $("#grafik-grid").append(
                        `<div class="col-span-1"><canvas id="grafik-${i_soal}"></canvas></div>`
                    );

                    for (let index = pos; index < pos + parseInt(survey.jumlah_opsi[
                            i_soal]); index++) {
                        if (survey.jenis_soal[i_soal] == 'Prioritas') {
                            pr += 1;
                        } else {
                            break;
                        }
                    }

                    html += ` ${i_soal>0?'<tr>':''}
                        <td rowspan="${survey.jenis_soal[i_soal] != 'Prioritas'?parseInt(survey.jumlah_opsi[i_soal]):parseInt(survey.jumlah_opsi[i_soal])*pr}" class="p-4 text-gray-700 border border-b-${i_soal>0?4:2}">${soal}</td>
                        `;

                    answer.map((d_answer, i_answer) => {
                        choice.push(d_answer.pilihan[i_soal]);
                    });


                    for (let index = pos; index < pos + parseInt(survey.jumlah_opsi[
                            i_soal]); index++) {
                        let res = 0;
                        if (survey.jenis_soal[i_soal] != 'Prioritas') {
                            let count = choice.filter(data => data == survey.opsi[
                                index]).length;

                            if (count > 0) {
                                label.push(survey.opsi[index]);
                                // dataset[0].label.push(survey.opsi[index]);
                                dataset[0].data.push(count);
                            }

                            pr = 0;

                            // console.log(survey.opsi[index]);
                            html += ` ${index>pos?'<tr>':''}
                                            <td colspan="2" class="p-4 text-white bg-orange-600 border border-b whitespace-nowrap">${survey.opsi[index]}</td>
                                            <td class="p-4 font-bold text-center text-gray-700 border border-b whitespace-nowrap">${count}</td>
                                            <td class="p-4 text-center text-gray-700 border border-b whitespace-nowrap">${((count/choice.length)*100).toFixed(1)}%</td>
                                        </tr> `;
                        } else {
                            html +=
                                ` ${index>pos?'<tr>':''}
                                        <td colspan="1" rowspan="${pr}" class="p-4 text-white bg-orange-800 border border-b whitespace-nowrap">${survey.opsi[index]}</td>`;

                            for (let j = 1; j <= survey.jumlah_opsi[i_soal]; j++) {
                                label.push(j);
                            }
                            for (let i = 1; i <= pr; i++) {
                                let count = choice.filter(data => {
                                    return data[i - 1] == survey.opsi[index];
                                }).length;

                                if (count > 0) {
                                    dataset[0].data.push(count);
                                }

                                html += `<td colspan="1" class="p-2 text-center text-white bg-orange-800 border border-b whitespace-nowrap">#${i}</td>
                                                <td class="p-4 font-bold text-center text-gray-700 border border-b whitespace-nowrap">${count}</td>
                                                <td class="p-4 text-center text-gray-700 border border-b whitespace-nowrap">${((count/choice.length)*100).toFixed(1)}%</td>
                                        </tr> `;
                            }
                        }
                    }
                    pos += parseInt(survey.jumlah_opsi[i_soal]);

                    // createChart($(`#grafik-${i_soal}`), soal, label, dataset);

                });
                $("#tbody").html(html);
                $('#load').hide();
            };

            getResume();
        })
    </script>
@endsection
