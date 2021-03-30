<?php

namespace App\Http\Controllers;

use App\Adicional;
use App\Bodegas;
use App\Clientes;
use App\Deuda;
use App\DFactura;
use App\Kardex;
use App\MFactura;
use App\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MFacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = DB::table('m_facturas')
             ->select('serie','n_venta','total','cliente_id',DB::raw('count(*)'))
            ->groupBy('serie','n_venta','total','cliente_id')
            ->having(DB::raw('count(*)'),'=','1');

        $facturas = DB::table('m_facturas')
             ->joinSub($series,'seires',function($join){
                 $join->on('m_facturas.serie','=','seires.serie')
                      ->on('m_facturas.n_venta','=','seires.n_venta');
             })
            ->join('clientes','clientes.id','=','m_facturas.cliente_id')
            ->select('m_facturas.id','m_facturas.serie','m_facturas.n_venta',
                'm_facturas.created_at','m_facturas.estado','m_facturas.modalidad_pago','m_facturas.medio_pago','m_facturas.total',
                'clientes.nombres')
            ->get();

        $location = 'ventas';
        return view('ventas.facturas.list',compact('location','facturas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location = 'ventas';
        $bodegas = Bodegas::all();
        $serie = Serie::where('estado','ACTIVO')->first();
        if($serie){
           return view('ventas.facturas.create',compact('location','bodegas','serie'));
        }else{
            flash('No hay series disponibles para generar nuevas facturas, por favor revisar.','warning');
            return redirect()->route('series.index');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = Validator::make($request->all(),[
            'cliente_id' => 'required',
            'bodega_id' => 'required',
            'modalidad_pago' => 'required',
            'medio_pago' => 'required'
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 'validate',
                'message' => $validate->errors()
            ]);
        }

        $serie = Serie::where('estado','ACTIVO')->first();
        $status = 'ok';

        try {

            DB::beginTransaction();
            $factura = new MFactura($request->all());
            $factura->fecha = date('y-m-d');
            $serie->actual = ++$serie->actual;
            $serie->save();
            $factura->serie = $serie->prefijo;
            $factura->n_venta = $serie->actual;
            $factura->bodega_id = $request->bodega_id;
            $factura->total = 0;
            $result = $factura->save();
            $adicionales = [];
            if($result){
                $productos = json_decode($request->productos);
                $total = 0;
                foreach ($productos as $producto){
                    if($producto->tipo == 'STOCK'){
                        $producto_embalaje = DB::table('producto_embalaje')
                            ->where('producto_embalaje.codigo_de_barras','=',$producto->codigo_de_barras)
                            ->get();
                        $dfactura = new DFactura();
                        $dfactura->precio = $producto->precio;
                        $dfactura->cantidad = $producto->cantidad;
                        $dfactura->producto_embalaje_id =  $producto_embalaje[0]->id;
                        $dfactura->factura_id =  $factura->id;
                        $dfactura->save();
                        $total += $producto->cantidad * $producto->precio;
                        $kardex = new Kardex();
                        $kardex->producto_id = $producto->producto;
                        $kardex->fecha = date('y-m-d');
                        $kardex->bodega_id = $request->bodega_id;
                        $kardex->tipo_movimiento = 'SALIDA';
                        $cantidad = $producto_embalaje[0]->unidades *  $producto->cantidad;
                        $kardex->cantidad = $cantidad;
                        $kardex->costo = Kardex::costo_promedio($producto->producto);
                        $kardex->detalle = 'Venta F/'.$serie->prefijo.'-'.$serie->actual;
                        $kardex->save();
                    }else{
                        $adicional = new \stdClass();
                        $adicional->id = $producto->id;
                        $adicional->nombre =  $producto->nombre;
                        $adicional->precio_compra = $producto->precio_compra;
                        $adicional->precio_venta = $producto->precio_venta;
                        $adicional->descripcion = $producto->descripcion;
                        $adicional->cantidad = $producto->cantidad;
                        $adicionales[] = $adicional;
                        $total += $adicional->cantidad * $producto->precio_venta;
                    }
                }

                if($request->modalidad_pago == 'credito'){
                    $factura->estado = 'EN DEUDA';
                    $deuda = new Deuda();
                    $deuda->factura_id =  $factura->id;
                    $deuda->abono = 0;
                    $deuda->save();
                }

                if($request->medio_pago == 'datafono'){
                    $total = $total*1.05;
                }
                $factura->adicionales = json_encode($adicionales);
                $factura->total = $total;
                $factura->save();

                $cliente =  Clientes::find($request->cliente_id);

                /*$pdf = PDF::loadView('pdfs.factura',['factura' => $factura])
                    ->setPaper('a4', 'landscape')
                    ->output();

                Mail::to($cliente->email)->send(new \App\Mail\Factura($pdf));*/

                $status = 'ok';

            }else {
                $status = 'error';
            }

            DB::commit();

        }catch (\Exception $e){
            DB::rollBack();
        }

        return response()->json([
            'status' => $status
        ]);


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
