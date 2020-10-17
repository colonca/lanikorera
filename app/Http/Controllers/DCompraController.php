<?php

namespace App\Http\Controllers;

use App\Compra;
use App\DCompra;
use Illuminate\Http\Request;

class DCompraController extends Controller
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
     * @param  \App\DCompra  $dCompra
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $compra = Compra::where('id','=',$id)->first();
        $dcompra = DCompra::where('compra_id','=',$id)->get();
        return view('compras.entradas.show')->with('compra',$compra)
             ->with('dcompra',$dcompra)->with('location','compras');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DCompra  $dCompra
     * @return \Illuminate\Http\Response
     */
    public function edit(DCompra $dCompra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DCompra  $dCompra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DCompra $dCompra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DCompra  $dCompra
     * @return \Illuminate\Http\Response
     */
    public function destroy(DCompra $dCompra)
    {
        //
    }
}
