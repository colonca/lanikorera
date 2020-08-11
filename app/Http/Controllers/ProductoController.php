<?php

namespace App\Http\Controllers;

use App\Embalaje;
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
        $embalajes =  Embalaje::all();
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
            'nombre' => 'required',
            'presentacion' => 'required',
            'stock_minimo' => 'required|numeric',
            'stock_maximo' => 'required|numeric',
        ]);

        $producto = Producto::where([
            ['nombre','=',$request->nombre],
            ['presentacion','=',$request->presentacion]
        ])->first();

        if($producto){
            return response()->json([
                'status' => 'validate',
                'message' => [
                    'nombre' => 'el producto ya existe'
                ]
            ]);
        }

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
        $embalajes =  Embalaje::all();
        return view('almacen.productos.edit')
                ->with('producto',$producto)
                ->with('location','almacen')
               ->with('embalajes',$embalajes);
    }

    public function embalajes($id){
        $producto = Producto::find($id);
        $embalajes = [];
        foreach ($producto->embalajes as $embalaje){
            $embalajes[] =  [
                 'embalaje_id' => $embalaje->pivot->embalaje_id,
                 'codigo_de_barras' => $embalaje->pivot->codigo_de_barras,
                 'unidades' => $embalaje->pivot->unidades,
                 'precio_venta' => $embalaje->pivot->precio_venta,
            ];
        }
        return response()->json([
            'status' => 'ok',
            'embalajes' => $embalajes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $producto  = Producto::findOrFail($id);
        $values = array();
        parse_str($request->form, $values);
        $validate = Validator::make($values,[
            'nombre' => 'required',
            'presentacion' => 'required',
            'stock_minimo' => 'required|numeric',
            'stock_maximo' => 'required|numeric',
        ]);

        if($producto->nombre != $values['nombre'] || $producto->presentacion != $values['presentacion']){
            $productValidation = Producto::where([
                ['nombre','=',$values['nombre']],
                ['presentacion','=',$values['presentacion']]
            ])->first();
            if($productValidation){
                return response()->json([
                    'status' => 'validate',
                    'message' => [
                        'nombre' => 'el producto ya existe'
                    ]
                ]);
            }
        }

        if($validate->fails()){
            return response()->json([
                'status' => 'validate',
                'message' => $validate->errors()
            ]);
        }

        $producto->fill($values);
        $result = $producto->save();
        if($result){
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
