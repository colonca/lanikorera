<?php

namespace App\Http\Controllers;

use App\Bodegas;
use Illuminate\Http\Request;

class BodegasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bodegas  = Bodegas::all();
        return view('almacen.bodegas.list')->with('bodegas',$bodegas)->with('location','almacen');
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
     * @param  \App\Bodegas  $bodegas
     * @return \Illuminate\Http\Response
     */
    public function show(Bodegas $bodegas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bodegas  $bodegas
     * @return \Illuminate\Http\Response
     */
    public function edit(Bodegas $bodegas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bodegas  $bodegas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bodegas $bodegas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bodegas  $bodegas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bodegas $bodegas)
    {
        //
    }
}
