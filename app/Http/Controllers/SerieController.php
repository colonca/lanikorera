<?php

namespace App\Http\Controllers;

use App\Serie;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serie = Serie::all();
        return view('configuracion.series.list')->with('series',$serie)->with('location','configuracion');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location = 'configuracion';
        return view('configuracion.series.create')->with('location',$location);
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
            'prefijo' => 'required',
            'inicial' => 'required',
            'final' => 'required'
        ]);

        $series =Serie::where('prefijo',$request->prefijo)->get();
        if ($series->count()>0){
            foreach ($series as $serie){
                if ($request->inicial>=$serie->inicial && $request->inicial<=$serie->final || $request->final>=$serie->inicial && $request->final<=$serie->final){
                    flash("El nombre de la serie ya existe")->error();
                    return  redirect()->back();
                }
            }
        }
        $series = Serie::all();
        foreach ($series as $serie){
            $serie->estado = 'INACTIVO';
            $serie->save();
        }


        $serie =  new Serie();
        $serie->prefijo= $request->prefijo;
        $serie->inicial= $request->inicial;
        $serie->final= $request->final;
        $serie->actual= $request->inicial;
        $serie->estado= 'ACTIVO';
        $result = $serie->save();

        if($result){
            flash("La Serie fue almacenada de forma exitosa!")->success();
            return  redirect()->route('series.index');
        }else{
            flash("La Serie no fue almacenada de forma exitosa!")->error();
            return  redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function show(Serie $serie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function edit(Serie $serie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Serie $serie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serie $serie)
    {
        //
    }
}
