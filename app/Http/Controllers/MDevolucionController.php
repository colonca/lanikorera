<?php

namespace App\Http\Controllers;

use App\DFactura;
use App\Kardex;
use App\MDevolucion;
use App\MFactura;
use App\ProductoEmbalaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MDevolucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $factura = null;

        if(isset($request->serie) && $request->n_venta){
            $factura = MFactura::serie($request->serie)
                ->numeroVenta($request->n_venta)
                ->where('estado','<>','DEVUELTA')
                ->first();
        }

        $location = 'ventas';
        return view('ventas.devoluciones.devolucion',compact('location','factura'));
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
        $factura = MFactura::findOrFail($request->factura_id);

        DB::beginTransaction();

        $result = true;

        try {

            $devolucion = new MFactura();
            foreach ($factura->attributesToArray() as $key => $value) {
                if($key != 'id'){
                    $devolucion->$key = $value;
                }
            }
            $devolucion->tipo = 'DEVOLUCION';
            $devolucion->save();

            $detalles =  $factura->dfactura;

            foreach ($detalles as $detalle){

                $dfactura = new DFactura();
                $dfactura->precio = $detalle->precio;
                $dfactura->cantidad = $detalle->cantidad;
                $dfactura->producto_embalaje_id = $detalle->producto_embalaje_id;
                $dfactura->factura_id =  $devolucion->id;
                $dfactura->save();

                $producto_embalaje = ProductoEmbalaje::find($dfactura->producto_embalaje_id);

                $before = Kardex::where([
                    ['producto_id',$producto_embalaje->producto_id],
                    ['detalle','LIKE',"%Venta F/$factura->serie-$factura->n_venta%"]
                ])->first();


                $kardex = new Kardex();
                $kardex->producto_id = $producto_embalaje->producto_id;
                $kardex->bodega_id = $before->bodega_id;
                $kardex->tipo_movimiento = 'SALIDA';
                $cantidad = $producto_embalaje->unidades *  $detalle->cantidad;
                $kardex->cantidad = $cantidad*-1;
                $kardex->costo = $before->costo;
                $kardex->detalle = 'Devolución en Ventas F/'. $factura->serie.'-'.$factura->n_venta;

                $result = $kardex->save();

            }

            $factura->estado = 'DEVUELTA';
            $factura->save();


            DB::commit();

        }catch (\Exception $exception){
             DB::rollBack();
            $result = false;
        }

        if(!$result)
             flash('Error','error');
        else
            flash('Devolución','success');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MDevolucion  $mDevolucion
     * @return \Illuminate\Http\Response
     */
    public function show(MDevolucion $mDevolucion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MDevolucion  $mDevolucion
     * @return \Illuminate\Http\Response
     */
    public function edit(MDevolucion $mDevolucion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MDevolucion  $mDevolucion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MDevolucion $mDevolucion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MDevolucion  $mDevolucion
     * @return \Illuminate\Http\Response
     */
    public function destroy(MDevolucion $mDevolucion)
    {
        //
    }
}
