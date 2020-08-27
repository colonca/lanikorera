<?php

namespace App\Http\Controllers;

use App\Bodegas;
use App\Compra;
use App\DCompra;
use App\Kardex;
use App\Producto;
use App\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CompraController extends Controller
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
        $location = 'compras';
        $bodegas = Bodegas::all();
        $proveedores = Proveedores::all();
        $productos = Producto::all();
        return view('compras.entradas.create',compact('location','bodegas','productos','proveedores'));
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
            'proveedor_id' => 'required',
            'serie' => 'required',
            'bodega_id' => 'required',
            'fecha' => 'required|date',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 'validate',
                'message' => $validate->errors()
            ]);
        }

        $exist = Compra::where([
            ['serie',$request->serie],
        ])->first();

        if($exist){
            return response()->json([
                'status' => 'validate',
                'message' => [
                    'compra' => 'El numero de serie y numero de venta ya se encuentra registrado anteriorme.'
                ]
            ]);
        }

        $embalajes = json_decode($request->embalajes);
        $total = 0;
        foreach($embalajes as $embalaje) {
            $total += $embalaje->cantidad * $embalaje->costo;
        }

        $status = 'ok';
        DB::beginTransaction();

        try {

            $compra = new Compra($request->all());
            $compra->total = $total;
            $result = $compra->save();

            if($result){
                if($request->file('file') != null) {
                    $file = $request->file('file');
                    $extension = $file->getClientOriginalExtension();
                    if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'gif' || $extension == 'pdf') {
                        $path = $file->store('compras');
                        $compra->foto = $path;
                        $compra->save();
                    } else {
                       $status = 'error';
                    }
                }

                foreach ($embalajes as $embalaje){

                    $Dcompra = new DCompra();
                    $Dcompra->producto_embalaje_id = $embalaje->id;
                    $Dcompra->cantidad = $embalaje->cantidad;
                    $Dcompra->costo = $embalaje->costo;
                    $Dcompra->compra_id = $compra->id;
                    $Dcompra->save();



                    $producto = Producto::find($embalaje->producto);
                    $kardex = new Kardex();
                    $kardex->producto_id = $producto->id;
                    $kardex->bodega_id = $request->bodega_id;
                    $kardex->tipo_movimiento = 'ENTRADA';

                    $producto_embalaje = DB::table('producto_embalaje')
                        ->where('producto_embalaje.id','=',$embalaje->id)
                        ->get();

                    $cantidad = $producto_embalaje[0]->unidades *  $embalaje->cantidad;
                    $kardex->cantidad = $cantidad;
                    $kardex->fecha = date('y-m-d');
                    $kardex->costo = $embalaje->costo / $producto_embalaje[0]->unidades;
                    $kardex->detalle = 'Compra F/'.$request->serie;
                    $kardex->save();
                }
                $status = 'ok';
                DB::commit();
            }else{
               $status = 'error';
               DB::rollBack();
            }

        }catch (\Exception $e){
            dd($e);
            $status = 'error';
            DB::rollBack();
        }

        return response()->json([
            'status' => $status
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        //
    }
}
