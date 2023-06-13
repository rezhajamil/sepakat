<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $plain = true;

        $survey = DB::table('survey_sessions')->where('status', 1)->first();

        if ($survey) {
            $answer = DB::table('survey_answers')->where('session', $survey->id)->where('user', auth()->user()->id)->first();
            $history = DB::table('survey_answers')->where('user', auth()->user()->id)->get();

            $survey->soal = json_decode($survey->soal);
            $survey->jenis_soal = json_decode($survey->jenis_soal);
            $survey->opsi = json_decode($survey->opsi);
            $survey->jumlah_opsi = json_decode($survey->jumlah_opsi);
            $survey->validasi = json_decode($survey->validasi);
            $title = $survey->nama;
        } else {
            $survey = [];
            $answer = [];
            $history = [];
            $title = '';
        }


        return view('survey.index', compact('survey', 'answer', 'plain', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $survey = DB::table('survey_sessions')->find($request->session);

        $soal = json_decode($survey->soal);
        $jenis_soal = json_decode($survey->jenis_soal);
        $opsi = json_decode($survey->opsi);
        $jumlah_opsi = json_decode($survey->jumlah_opsi);
        $pilihan = [];

        $posisi = 0;
        $others = [];
        foreach ($soal as $key => $data) {
            $other = '';
            switch ($jenis_soal[$key]) {
                case 'Isian':
                    array_push($pilihan, $request['jawaban_' . $key]);
                    break;
                case 'Pilgan':
                    array_push($pilihan, $request['jawaban_' . $key]);
                    break;
                case 'Pilgan & Isian':
                    array_push($pilihan, $request['jawaban_' . $key]);
                    break;
                case 'Checklist':
                    array_push($pilihan, $request['jawaban_' . $key]);
                    break;
                case 'Prioritas':
                    array_push($pilihan, $request['jawaban_' . $key]);
                    break;
                default:
                    break;
            }
            array_push($others, $other);
        }

        $answer = DB::table('survey_answers')->where('session', $request->session)->where('user', auth()->user()->id)->count();
        // ddd($request->session);
        if ($answer < 1) {
            DB::table('survey_answers')->insert([
                'session' => $request->session,
                'user' => auth()->user()->id,
                'pilihan' => json_encode($pilihan),
                'time_start' => date('Y-m-d H:i:s'),
                'finish' => '1'
            ]);
        }

        return redirect()->route('survey.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        //
    }
}
