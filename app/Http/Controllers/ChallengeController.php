<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Challenge;

class ChallengeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::get();
        $challenge = Challenge::get();
        $data = ['companies' =>$companies,
                 'challenge' => $challenge];
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
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
                               'nombre' => 'required',
                               'descripcion'=> 'required',
                               'empresa' => 'required'
                           ]);
        $user = auth()->id();
        $challenge = new Challenge();
        $challenge->nombre = $request->nombre;
        $challenge->descripcion = $request->descripcion;
        $challenge->user_id = $user;
        $challenge->company_id = $request->empresa;
        $challenge->save();
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
    public function update(Request $request, Challenge $challenge)
    {
        $request->validate([
                               'nombre' => 'required',
                               'descripcion'=> 'required',
                           ]);
        $challenge->nombre = $request->nombre;
        $challenge->descripcion = $request->descripcion;
        $challenge->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Challenge $challenge)
    {
        $challenge->delete();
    }
}
