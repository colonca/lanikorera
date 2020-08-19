<?php

namespace App\Http\Controllers;

use App\Bodegas;
use App\Clientes;
use App\Deuda;
use App\MFactura;
use App\Serie;
use Illuminate\Http\Request;

class DeudaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $deuda  = Clientes::Select('m_factura.n_venta','clientes.nombres','clientes.apellidos','abonos');
        return view('ventas.deudas.list')->with('clientes',$deuda)->with('location','ventas');
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
     * @param  \App\Deuda  $deuda
     * @return \Illuminate\Http\Response
     */
    public function show(Deuda $deuda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deuda  $deuda
     * @return \Illuminate\Http\Response
     */
    public function edit(Deuda $deuda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deuda  $deuda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deuda $deuda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deuda  $deuda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deuda $deuda)
    {
        //
    }
}