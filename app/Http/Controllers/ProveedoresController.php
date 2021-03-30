<?php

namespace App\Http\Controllers;

use App\Compra;
use App\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'nit' => 'required',
            'nombre' => 'required'
        ]);

        $proveedor =  new Proveedores();
        $proveedor->nit = $request->nit;
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


    public function save(Request $request){

        $values = array();
        parse_str($request->form, $values);
        $validate = Validator::make($values,[
            'nombre' => 'required',
            'nit' => 'required',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 'validate',
                'message' => $validate->errors()
            ]);
        }

        $proveedor = new Proveedores($values);
        $result = $proveedor->save();
        if($result){
            return response()->json([
                'status' => 'ok',
                'proveedor' => $proveedor
            ]);
        }else {
            return response()->json([
                'status' => 'error',
            ]);
        }
    }

    public function json(){
        $proveedores = Proveedores::all();
        return response()->json(
           $proveedores
        );
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
        $proveedor->nit = $request->nit;
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
        $exist = Compra::where('proveedor_id',$proveedor->id)->first();
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
        flash("No se puede eliminar el Proveedor, ya que tiene compras asociadas")->error();
        return  redirect()->back();
    }
    }
}
