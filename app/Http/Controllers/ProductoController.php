<?php

namespace App\Http\Controllers;

use App\Embalajes;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();
        $location = 'almacen';
        return view('almacen.productos.list',compact('productos','location'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $embalajes =  Embalajes::all();
        $location = 'almacen';
        return view('almacen.productos.create',compact('embalajes','location'));
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
            'nombre' => 'required|unique:productos',
            'presentacion' => 'required',
            'stock_minimo' => 'required|numeric',
            'stock_maximo' => 'required|numeric',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 'validate',
                'message' => $validate->errors()
            ]);
        }

        $producto = new Producto($request->all());
        $producto->sku = 'PRD-0000';
        $producto->imagen = '';
        $result = $producto->save();
        $result = true;
        if($result){
            $producto->sku = 'PRD-'.$producto->id;
            $producto->save();
            if($request->file('file') != null){
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                if($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'gif'){
                    $path = $file->store('productos');
                    $producto->imagen = $path;
                    $producto->save();
                }else{
                    return response()->json([
                        'status' => 'formato',
                    ]);
                }
            }
            $embalajes = json_decode($request->embalajes);
            $array = [];
            foreach ($embalajes as $embalaje){
                $array[$embalaje->embalaje_id] = [
                    'codigo_de_barras' => $embalaje->codigo_de_barras,
                    'unidades' => $embalaje->unidades,
                    'precio_venta' => $embalaje->precio_venta
                ];
            }
            $producto->embalajes()->sync($array);
            return response()->json([
                'status' => 'ok',
            ]);
        }else{
            return response()->json([
                'status' => 'error',
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
