<?php

namespace App\Http\Controllers;

use App\Embalaje;
use App\Producto;
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
        return view('almacen.embalajes.list')->with('embalajes',$embalajes)->with('location','almacen');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location = 'almacen';
        return view('almacen.embalajes.create')->with('location',$location);
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
            'descripcion' => 'required'
        ]);

        $embalaje =  new Embalaje();
        $embalaje->descripcion = $request->descripcion;
        $result = $embalaje->save();

        if($result){
            flash("El Embalajes <strong>" . $embalaje->descripcion . "</strong> fue almacenado de forma exitosa!")->success();
            return  redirect()->route('embalajes.index');
        }else{
            flash("El Embalajes <strong>" . $embalaje->descripcion. "</strong> no fue almacenada de forma exitosa!")->error();
            return  redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\embalajes  $embalaje
     * @return \Illuminate\Http\Response
     */
    public function show(Embalaje $embalaje)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\embalajes  $embalaje
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $embalaje = Embalaje::findOrFail($id);
        $location = 'almacen';
        return view('almacen.embalajes.edit',compact('embalaje','location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\embalajes  $embalaje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $embalaje =  Embalaje::findOrFail($id);
        $embalaje->descripcion = $request->descripcion;
        $result = $embalaje->save();
        if($result){
            flash("El Embalaje <strong>" . $embalaje->descripcion . "</strong> fue actualizado de forma exitosa!")->success();
            return  redirect()->route('embalajes.index');
        }else{
            flash("El Embalaje <strong>" . $embalaje->descripcion . "</strong> no fue actualizado de forma exitosa!")->error();
            return  redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\embalajes  $embalaje
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $embalaje = Embalaje::findOrFail($id);
        $productos = $embalaje->productos();
        if($productos->count() == 0){
            $result = $embalaje->delete();

            if($result){
                flash("El Embalaje fue eliminado Correctamente")->success();
                return  redirect()->back();
            }else{
                flash("El Embalaje no fue eliminado Correctamente")->error();
                return  redirect()->back();
            }
        }else{
            flash("No se puede eliminar el embalaje ya que esta asociado con al menos productos")->error();
            return  redirect()->back();
        }
    }
}
