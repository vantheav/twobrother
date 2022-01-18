<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Score::with('student')->latest()->get();
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
            'student_id'=>'required',
            // 'java'=>'max:100',
            // 'javascrip'=>'max:100',
            // 'python'=>'max:100',
            // 'htmlcss'=>'max:100',
            // 'pl'=>'max:50',
            // 'english'=>'max:50'
        ]);
        $score = new Score();
        $score->student_id = $request->student_id;
        $score->java = $request->java;
        $score->javascript = $request->javascript;
        $score->python = $request->python;
        $score->htmlcss = $request->htmlcss;
        $score->pl = $request->pl;
        $score->english = $request->english;

        $score->save();
        return response()->json('Score Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Score::findOrFail($id);
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
        $request->validate([
            'student_id'=>'required',
        ]);
        $score = Score::findOrFail($id);
        $score->student_id = $request->student_id;
        $score->java = $request->java;
        $score->javascript = $request->javascript;
        $score->python = $request->python;
        $score->htmlcss = $request->htmlcss;
        $score->pl = $request->pl;
        $score->english = $request->english;

        $score->save();
        return response()->json('Score Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Score::destroy($id);
    }
}
