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
            ->select('total','factura_id',DB::raw('sum(abono) as abonos'))
            ->groupBy('total','factura_id');

        $cliente = DB::table('clientes')->select('m_facturas.id','m_facturas.n_venta','m_facturas.serie','clientes.nombres','clientes.apellidos','deudas.total','deudas.abonos','m_facturas.estado')
            ->join('m_facturas','m_facturas.cliente_id','=','clientes.id')
            ->joinSub($deudas,'deudas',function($join){
                $join->on('m_facturas.id','=','deudas.factura_id');
            })
            ->where('m_facturas.estado','=','EN DEUDA')
            ->get();
        return view('ventas.deudas.list')->with('clientes',$cliente)->with('location','ventas');
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
