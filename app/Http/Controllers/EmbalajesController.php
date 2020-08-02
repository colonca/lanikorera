<?php

namespace App\Http\Controllers;

use App\embalaje;
use Illuminate\Http\Request;

class EmbalajesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $embalajes  = Embalaje::all();
        return view('almacen.embalajes.list')->with('embalaje',$embalajes)->with('location','almacen');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\embalaje  $embalaje
     * @return \Illuminate\Http\Response
     */
    public function show(embalaje $embalaje)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\embalaje  $embalaje
     * @return \Illuminate\Http\Response
     */
    public function edit(embalaje $embalaje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\embalaje  $embalaje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, embalaje $embalaje)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\embalaje  $embalaje
     * @return \Illuminate\Http\Response
     */
    public function destroy(embalaje $embalaje)
    {
        //
    }
}
