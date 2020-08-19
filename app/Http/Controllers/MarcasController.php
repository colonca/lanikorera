<?php

namespace App\Http\Controllers;

use App\Marcas;
use App\Producto;
use Illuminate\Http\Request;

class MarcasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = Marcas::all();
        return view('almacen.marcas.list')->with('marcas',$marcas)->with('location','almacen');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location = 'almacen';
        return view('almacen.marcas.create')->with('location',$location);
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

        $exist = Marcas::where('nombre',$request->nombre)->first();

        if($exist){
            flash("El nombre de la marca $request->nombre ya existe")->error();
            return  redirect()->back();
        }

        $marca =  new Marcas();
        $marca->nombre = $request->nombre;
        $result = $marca->save();

        if($result){
            flash("La Marca <strong>" . $marca->nombre . "</strong> fue almacenada de forma exitosa!")->success();
            return  redirect()->route('marcas.index');
        }else{
            flash("La Marca <strong>" . $marca->nombre . "</strong> no fue almacenada de forma exitosa!")->error();
            return  redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Marcas  $marcas
     * @return \Illuminate\Http\Response
     */
    public function show(Marcas $marcas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marcas  $marcas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marca = Marcas::findOrFail($id);
        $location = 'almacen';
        return view('almacen.marcas.edit',compact('marca','location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marcas  $marcas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {

        $marca =  Marcas::findOrFail($id);
        $marca->nombre = $request->nombre;
        $result = $marca->save();
        if($result){
            flash("La Marca <strong>" . $marca->nombre . "</strong> fue actualizada de forma exitosa!")->success();
            return  redirect()->route('marcas.index');
        }else{
            flash("La Marca <strong>" . $marca->nombre . "</strong> no fue actualizada de forma exitosa!")->error();
            return  redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Marcas  $marcas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marca = Marcas::findOrFail($id);
        $exist = Producto::where('marca_id',$marca->id)->first();
        if(!$exist){
            $result = $marca->delete();

            if($result){
                flash("La Marca fue eliminada Correctamente")->success();
                return  redirect()->back();
            }else{
                flash("La Marca no fue eliminada Correctamente")->error();
                return  redirect()->back();
            }
        }else{
            flash("No se puede eliminar la Marca ya que tiene productos asociados")->error();
            return  redirect()->back();
        }
    }
}
