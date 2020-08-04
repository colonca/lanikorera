<?php

namespace App\Http\Controllers;

use App\Clientes;
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
    public function edit(Clientes $clientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clientes $clientes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clientes $clientes)
    {
        //
    }
}
