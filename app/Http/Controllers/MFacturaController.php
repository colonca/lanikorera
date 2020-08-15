<?php

namespace App\Http\Controllers;

use App\Bodegas;
use App\MFactura;
use App\Producto;
use Illuminate\Http\Request;

class MFacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        date_default_timezone_set('America/Bogota');
        $location = 'ventas';
        $bodegas = Bodegas::all();
        return view('ventas.facturas.create',compact('location','bodegas'));
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
     * @param  \App\MFactura  $mFactura
     * @return \Illuminate\Http\Response
     */
    public function show(MFactura $mFactura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MFactura  $mFactura
     * @return \Illuminate\Http\Response
     */
    public function edit(MFactura $mFactura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MFactura  $mFactura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MFactura $mFactura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MFactura  $mFactura
     * @return \Illuminate\Http\Response
     */
    public function destroy(MFactura $mFactura)
    {
        //
    }
}
