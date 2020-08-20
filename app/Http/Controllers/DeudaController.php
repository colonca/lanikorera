<?php

namespace App\Http\Controllers;

use App\Bodegas;
use App\Clientes;
use App\Deuda;
use App\MFactura;
use App\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeudaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deudas = DB::table('deudas')
            ->select('factura_id',DB::raw('sum(abono) as abonos,(total-sum(abono)) as resta'))
            ->groupBy('factura_id','total');


        $clientes = DB::table('clientes')
            ->join('m_facturas','m_facturas.cliente_id','=','clientes.id')
            ->joinSub($deudas,'deudas',function($join){
                $join->on('m_facturas.id','=','deudas.factura_id');
            })
            ->select('clientes.id','clientes.identificacion','clientes.nombres','clientes.apellidos','m_facturas.total','deudas.abonos','deudas.resta')
            ->where([
                ['m_facturas.estado','=','EN DEUDA'],
            ])
            ->select('clientes.id','identificacion','nombres','apellidos',DB::raw('sum(total) as total, sum(abonos) as abonos, sum(resta) as resta'))
            ->groupBy('clientes.id','identificacion','nombres','apellidos')
            ->get();
        return view('ventas.deudas.list')->with('clientes',$clientes)->with('location','ventas');
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
