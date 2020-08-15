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
        $location = 'almacen';
        return view('almacen.bodegas.create')->with('location',$location);
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
            'nombre' => 'required'
        ]);

        $bodega =  new Bodegas();
        $bodega->nombre = $request->nombre;
        $result = $bodega->save();

        if($result){
            flash("La Bodega <strong>" . $bodega->nombre . "</strong> fue almacenada de forma exitosa!")->success();
            return  redirect()->route('bodegas.index');
        }else{
            flash("La Bodega <strong>" . $bodega->nombre . "</strong> no fue almacenada de forma exitosa!")->error();
            return  redirect()->back();
        }
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
    public function edit($id)
    {
        $bodega = Bodegas::findOrFail($id);
        $location = 'almacen';
        return view('almacen.bodegas.edit',compact('bodega','location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bodegas  $bodegas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bodega =  Bodegas::findOrFail($id);
        $bodega->nombre = $request->nombre;
        $result = $bodega->save();
        if($result){
            flash("La Bodega <strong>" . $bodega->nombre . "</strong> fue actualizada de forma exitosa!")->success();
            return  redirect()->route('bodegas.index');
        }else{
            flash("La Bodega <strong>" . $bodega->nombre . "</strong> no fue actualizada de forma exitosa!")->error();
            return  redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bodegas  $bodegas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
