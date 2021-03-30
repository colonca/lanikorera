<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\DFactura;
use App\Gasto;
use App\Kardex;
use App\Mail\Factura;
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
    public function index()
    {
          $facturas = MFactura::where([
              ['tipo','DEVOLUCION']
          ])->get();
          $location = 'ventas';
          return view('ventas.devoluciones.list',compact('location','facturas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $factura = null;

        if(isset($request->serie) && $request->n_venta){
            $exist =  MFactura::serie($request->serie)
                ->numeroVenta($request->n_venta)
                ->where('estado','=','DEVUELTA')
                ->first();
            if(!$exist){
                $factura = MFactura::serie($request->serie)
                    ->numeroVenta($request->n_venta)
                    ->where('estado','!=','DEVUELTA')
                    ->first();
            }else{
                flash('<strong>Error: </strong> la factura que intenta buscar ya ha sido devuelta')->warning();
            }
        }

        $location = 'ventas';
        return view('ventas.devoluciones.devolucion',compact('location','factura'));
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
            $devolucion->fecha = date('y-m-d');
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
                $kardex->fecha = date('y-m-d');
                $kardex->bodega_id = $before->bodega_id;
                $kardex->tipo_movimiento = 'SALIDA';
                $cantidad = $producto_embalaje->unidades *  $detalle->cantidad;
                $kardex->cantidad = $cantidad*-1;
                $kardex->costo = $before->costo;
                $kardex->detalle = 'Devolución en Ventas F/'. $factura->serie.'-'.$factura->n_venta;

                $result = $kardex->save();

            }

            foreach (json_decode($factura->adicionales) as $adicional){
                $gasto = new Gasto();
                $gasto->dinero = $adicional->costo*$adicional->cantidad*-1;
                $gasto->tipo_movimiento = 'efectivo';
                $gasto->fecha =  date('y-m-d');
                $gasto->save();
            }

            $factura->fecha = date('y-m-d');
            $factura->estado = 'DEVUELTA';
            $factura->save();

            DB::commit();

        }catch (\Exception $exception){
             DB::rollBack();
            $result = false;
        }

        if(!$result){
            flash('Error, No pudo almacenarce la devolución correctamente.','error');
            return redirect()->route('devoluciones.index');
        }else{
            flash('La Factura ha sido devuelta correctamente.','success');
            return redirect()->route('devoluciones.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MDevolucion  $mDevolucion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $factura = MFactura::findOrFail($id);
        $location = 'ventas';
        return view('ventas.devoluciones.show',compact('location','factura'));
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
