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

    public function index()
    {
        $deudas = DB::table('deudas')
            ->select('factura_id',DB::raw('sum(abono) as abonos'))
            ->groupBy('factura_id');


        $clientes = DB::table('clientes')
            ->join('m_facturas','m_facturas.cliente_id','=','clientes.id')
            ->joinSub($deudas,'deudas',function($join){
                $join->on('m_facturas.id','=','deudas.factura_id');
            })
            ->select('clientes.id','clientes.identificacion','clientes.nombres','clientes.apellidos','m_facturas.total','deudas.abonos')
            ->where([
                ['m_facturas.estado','=','EN DEUDA'],
            ])
            ->select('clientes.id','identificacion','nombres','apellidos',DB::raw('sum(total) as total, sum(abonos) as abonos, (sum(total)-sum(abonos)) as resta'))
            ->groupBy('clientes.id','identificacion','nombres','apellidos')
            ->get();
        return view('ventas.deudas.list')->with('clientes',$clientes)->with('location','ventas');
    }


    public function create()
    {

    }


    public function store(Request $request)
    {

    }


    public function show($cliente_id)
    {

        $deudas = DB::table('deudas')
            ->select('factura_id',DB::raw('sum(abono) as abonos'))
            ->groupBy('factura_id');
        $factura =  DB::table('m_facturas')
            ->join('clientes','clientes.id','=','m_facturas.cliente_id')
            ->joinSub($deudas,'deudas',function($join){
                $join->on('deudas.factura_id','=','m_facturas.id');
            })
            ->select('m_facturas.id','clientes.identificacion','clientes.nombres','clientes.apellidos',
                'deudas.abonos','m_facturas.total',
                'm_facturas.serie','m_facturas.n_venta',DB::raw('(m_facturas.total-deudas.abonos) as resta'))
            ->where([
                ['m_facturas.estado','EN DEUDA'],
                ['clientes.id',$cliente_id]
            ])->get();
        return view('ventas.deudas.edit')->with('facturas',$factura)->with('location','ventas');
    }

    public function detalles($id){
        $factura = MFactura::findOrFail($id);
        $location = 'ventas';
        return view('ventas.deudas.detalles',compact('location','factura'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deuda  $deuda
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = 'ventas';
        $facturas = DB::table('m_facturas')
            ->join('clientes','m_facturas.cliente_id','=','clientes.id')
            ->select('m_facturas.id','m_facturas.serie','m_facturas.n_venta','clientes.nombres','clientes.apellidos','m_facturas.total')
            ->where('m_facturas.id',$id)->get();
        $abonos = DB::table('deudas')
            ->select('deudas.abono','deudas.created_at')
            ->where([
                ['deudas.abono','>','0'],
                ['deudas.factura_id',$id]
            ])->get();
        return view('ventas.deudas.abonar',compact('location','facturas','abonos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deuda  $deuda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_factura)
    {
        if($request->valor<0){
            flash('La Cantidad ingresada no puede ser negativa')->warning();
           return redirect()->back();
        }else{
            $deudas = DB::table('deudas')
                ->select('factura_id',DB::raw('sum(abono) as abonos'))
                ->where('factura_id',$id_factura)
                ->groupBy('factura_id')
                ->first();
            $factura = MFactura::where('id',$id_factura)->first();
            $total = $deudas->abonos + $request->valor;
            if ($total>$factura->total){
                flash('La Cantidad ingresada supera el valor de la deuda por favor verifique')->warning();
                return redirect()->back();
            }else{
                $abono = new Deuda();
                $abono->abono = $request->valor;
                $abono->factura_id = $id_factura;
                $abono->save();
                if($total==$factura->total){
                    $factura->estado = 'PAGADA';
                    $factura->save();
                    flash('La deuda fue cancelada totalmente')->success();
                    return redirect()->route('deuda.show', $id_factura);
                }else{
                    flash('El Abono fue realizado correctamente')->success();
                    return redirect()->back();
                }
            }
        }
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
