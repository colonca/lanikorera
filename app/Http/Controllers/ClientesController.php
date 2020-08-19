<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\MFacturas;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes  = Clientes::all();
        return view('ventas.clientes.list')->with('clientes',$clientes)->with('location','ventas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Clientes::all();
        return view('ventas.clientes.create')->with('clientes',$clientes)->with('location','ventas');
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
            'identificacion' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'email' => 'required'
        ]);

        $clientes =  new Clientes();
        $clientes->identificacion = $request->identificacion;
        $clientes->nombres = $request->nombres;
        $clientes->apellidos = $request->apellidos;
        $clientes->telefono = $request->telefono;
        $clientes->email = $request->email;
        $result = $clientes->save();

        if($result){
            flash("El Cliente <strong>" . $clientes->nombres . "</strong> fue almacenado de forma exitosa!")->success();
            return  redirect()->route('clientes.index');
        }else{
            flash("El Cliente <strong>" . $clientes->nombres . "</strong> no fue almacenado de forma exitosa!")->error();
            return  redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(Clientes $clientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clientes =Clientes::findorfail($id);
        $location = 'ventas';
        return view('ventas.clientes.edit',compact('clientes','location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente =  Clientes::findOrFail($id);
        $cliente->identificacion = $request->identificacion;
        $cliente->nombres = $request->nombres;
        $cliente->apellidos = $request->apellidos;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $result = $cliente->save();
        if($result){
            flash("El Cliente <strong>" . $cliente->nombres . "</strong> fue actualizado de forma exitosa!")->success();
            return  redirect()->route('clientes.index');
        }else{
            flash("El Cliente <strong>" . $cliente->nombres . "</strong> no fue actualizado de forma exitosa!")->error();
            return  redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Clientes::findOrFail($id);
        $exist = MFacturas::where('cliente_id',$cliente->id)->first();
        if(!exist){
            $result = $cliente->delete();

            if($result){
                flash("El Cliente fue eliminado Correctamente")->success();
                return  redirect()->back();
            }else{
                flash("El Cliente no fue eliminado Correctamente")->error();
                return  redirect()->back();
            }
        }else{
            flash("No se puede eliminar el Cliente ya que tiene facturas asociadas")->error();
            return  redirect()->back();
        }

    }
}
