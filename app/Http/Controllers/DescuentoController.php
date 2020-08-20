<?php

namespace App\Http\Controllers;

use App\Descuento;
use Illuminate\Http\Request;

class DescuentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $descuentos =  Descuento::all();
        $location = 'ventas';
        return view('ventas.descuentos.list',compact('descuentos','location'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location = 'ventas';
        return view('ventas.descuentos.create',compact('location'));
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
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'producto_embalaje_id' => 'required',
            'cantidad_destinada' => 'required',
            'valor' => 'required'
        ]);

        $descuento =  new Descuento();
        $descuento->fecha_inicio= $request->fecha_inicio;
        $descuento->fecha_fin = $request->fecha_fin;
        $hoy= date('d-m-y');
        if($request->fecha_inicio<$hoy||$request->fecha_fin<$hoy){
            flash("El Descuento no puede aplicarse a una fecha en el pasado!")->error();
            return  redirect()->back();
        }
        if($request->fecha_final<$request->fecha_inicio){
            flash("Seleccione correctamente las fechas!")->error();
            return  redirect()->back();
        }

        $descuento-> producto_embalaje_id= $request->producto_embalaje_id;
        $descuento->cantidad_destinada = $request->cantidad_destinada;
        $descuento->cantidad_vendida = 0;
        $descuento->valor = $request->valor;
        $result = $descuento->save();

        if($result){
            flash("El Descuento fue almacenado de forma exitosa!")->success();
            return  redirect()->route('descuentos.index');
        }else{
            flash("El Descuento no fue almacenado de forma exitosa!")->error();
            return  redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Descuento  $descuento
     * @return \Illuminate\Http\Response
     */
    public function show(Descuento $descuento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Descuento  $descuento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $descuento = Descuento::findOrFail($id);
        $location = 'ventas';
        return view('ventas.descuentos.edit',compact('descuento','location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Descuento  $descuento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $descuento =  Descuento::findOrFail($id);
        $descuento->fecha_inicio = $request->fecha_inicio;
        $descuento->fecha_fin = $request->fecha_fin;
        $hoy= date('d-m-y');
        if($request->fecha_inicio<$hoy||$request->fecha_fin<$hoy){
            flash("El Descuento no puede aplicarse a una fecha en el pasado!")->error();
            return  redirect()->back();
        }
        if($request->fecha_final<$request->fecha_inicio){
            flash("Seleccione correctamente las fechas!")->error();
            return  redirect()->back();
        }
        $descuento->producto_embalaje_id = $request->producto_embalaje_id;
        $descuento->cantidad_destinada= $request->cantidad_destinada;
        $descuento->valor = $request->valor;
        $result = $descuento->save();
        if($result){
            flash("El descuento fue actualizado de forma exitosa!")->success();
            return  redirect()->route('descuentos.index');
        }else{
            flash("El descuento no fue actualizado de forma exitosa!")->error();
            return  redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Descuento  $descuento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $descuento = Descuento::findOrFail($id);
        $result = $descuento->delete();

        if($result){
            flash("El Descuento fue eliminado Correctamente")->success();
            return  redirect()->back();
        }else{
            flash("El Descuento no fue eliminado Correctamente")->error();
            return  redirect()->back();
        }
    }
}
