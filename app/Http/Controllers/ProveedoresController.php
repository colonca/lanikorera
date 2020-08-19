<?php

namespace App\Http\Controllers;

use App\Proveedores;
use App\Compras;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedores::all();
        return view('compras.proveedores.list')->with('proveedores',$proveedores)->with('location','compras');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location = 'compras';
        return view('compras.proveedores.create')->with('location',$location);
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

        $proveedor =  new Proveedores();
        $proveedor->nombre = $request->nombre;
        $result = $proveedor->save();

        if($result){
            flash("El Proveedor <strong>" . $proveedor->nombre . "</strong> fue almacenado de forma exitosa!")->success();
            return  redirect()->route('proveedores.index');
        }else{
            flash("El Proveedor <strong>" . $proveedor->nombre. "</strong> no fue almacenada de forma exitosa!")->error();
            return  redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proveedores  $proveedores
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedores $proveedores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proveedores  $proveedores
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedor = Proveedores::findOrFail($id);
        $location = 'compras';
        return view('compras.proveedores.edit',compact('proveedor','location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proveedores  $proveedores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $proveedor =  Proveedores::findOrFail($id);
        $proveedor->nombre = $request->nombre;
        $result = $proveedor->save();
        if($result){
            flash("El Proveedor <strong>" . $proveedor->nombre . "</strong> fue actualizado de forma exitosa!")->success();
            return  redirect()->route('proveedores.index');
        }else{
            flash("El Proveedor <strong>" . $proveedor->nombre . "</strong> no fue actualizado de forma exitosa!")->error();
            return  redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proveedores  $proveedores
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor= Proveedores::findOrFail($id);
        $exist = Compras::where('proveedor_id',$proveedor->id)->first();
        if(!$exist){
            $result = $proveedor->delete();

            if($result){
                flash("El Proveedor fue eliminado Correctamente")->success();
                return  redirect()->back();
            }else{
                flash("El Proveedor no fue eliminado Correctamente")->error();
                return  redirect()->back();
            }
        }else{
            flash("No se puede eliminar el Proveedor ya que tiene compras asociadas")->error();
            return  redirect()->back();
        }
    }
}
