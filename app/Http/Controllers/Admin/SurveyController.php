<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    public function index()
    {
        $surveys = DB::table('survey_sessions')->get();

        return view('admin.survey.index', compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.survey.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:survey_sessions,nama',
        ]);

        $survey = DB::table('survey_sessions')->insertGetId([
            'nama' => ucwords($request->nama),
            'date' => date('Y-m-d'),
            'deskripsi' => $request->deskripsi,
            'soal' => json_encode($request->soal),
            'opsi' => json_encode($request->opsi),
            'jumlah_opsi' => json_encode($request->jumlah_opsi),
            'jenis_soal' => json_encode($request->jenis_soal),
            'validasi' => json_encode($request->validasi),
            'status' => '0'
        ]);


        return redirect()->route('admin.survey.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function resume(Request $request, $id)
    {
        $survey = DB::table('survey_sessions')->find($id);

        $hasil = [];
        $answer = DB::table('survey_answers')->where('session', $id)->get();
        $survey->soal = json_decode($survey->soal);
        $survey->jenis_soal = json_decode($survey->jenis_soal);
        $survey->opsi = json_decode($survey->opsi);
        $survey->jumlah_opsi = json_decode($survey->jumlah_opsi);

        return view('admin.survey.resume', compact('answer', 'survey', 'hasil'));
    }

    public function result(Request $request, $id)
    {
        $survey = DB::table('survey_sessions')->find($id);

        $hasil = [];

        $answer = DB::table('survey_answers')->join('users', 'survey_answers.user', '=', 'users.id')->where('session', $id)->orderBy('name')->get();

        $survey->soal = json_decode($survey->soal);
        $survey->jenis_soal = json_decode($survey->jenis_soal);
        $survey->opsi = json_decode($survey->opsi);
        $survey->jumlah_opsi = json_decode($survey->jumlah_opsi);

        return view('admin.survey.result', compact('answer', 'survey', 'hasil'));
    }

    public function change_status($id)
    {
        $survey = DB::table('survey_sessions')->find($id);

        DB::table('survey_sessions')->where('id', $id)->update([
            'status' => !$survey->status,
        ]);

        return back();
    }
}
