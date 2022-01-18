<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sponsor;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Sponsor::latest()->get();
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
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required',
            'phone' => 'nullable',
            'city' => 'required|min:3',
            'aba_number' => 'required|min:3',
            'donate' => 'nullable'
        ]);

        $sponsor = new Sponsor();
        $sponsor->first_name = $request->first_name;
        $sponsor->last_name = $request->last_name;
        $sponsor->email = $request->email;
        $sponsor->phone = $request->phone;
        $sponsor->city = $request->city;
        $sponsor->aba_number = $request->aba_number;
        $sponsor->donate = $request->donate;
        $sponsor->save();
        return response()->json([
            'Message' => 'Sponsor Created',
            'data' => $sponsor,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Sponsor::findOrFail($id);
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
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required',
            'phone' => 'nullable',
            'city' => 'required|min:3',
            'aba_number' => 'required|min:3',
            'donate' => 'nullable'
        ]);

        $sponsor = Sponsor::findOrFail($id);
        $sponsor->first_name = $request->first_name;
        $sponsor->last_name = $request->last_name;
        $sponsor->email = $request->eamil;
        $sponsor->phone = $request->phone;
        $sponsor->city = $request->city;
        $sponsor->aba_number = $request->aba_number;
        $sponsor->donate = $request->donate;
        $sponsor->save();
        return response()->json([
            'Message' => 'Sponsor updated',
            'data' => $sponsor,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = Sponsor::destroy($id);
        if($isDeleted == 1){
            return response()->json(['massage'=>'Deleted'], 200);
        }else{
            return response()->json(['massage'=>'Not Found'], 404);
        }
    }
}
