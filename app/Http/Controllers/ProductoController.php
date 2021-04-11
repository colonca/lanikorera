<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Embalaje;
use App\Kardex;
use App\Marcas;
use App\Producto;
use App\Kardexes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $marcas = Marcas::all();
        $categorias = Categorias::all();
        $location = 'almacen';
        return view('almacen.productos.create',compact('embalajes','location','marcas','categorias'));
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
            'marca_id' => 'required',
            'subcategoria_id' => 'required'
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
        $marcas = Marcas::all();
        $categorias = Categorias::all();
        $embalajes =  Embalaje::all();
        return view('almacen.productos.edit')
                ->with('producto',$producto)
                ->with('marcas',$marcas)
                ->with('categorias',$categorias)
                ->with('location','almacen')
                ->with('embalajes',$embalajes);
    }

    public function embalajes($id){
        $producto = Producto::find($id);
        $embalajes = [];
        foreach ($producto->embalajes as $embalaje){
            $embalajes[] =  [
                 'descripcion' => $embalaje->descripcion,
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
            'marca_id' => 'required',
            'subcategoria_id' => 'required'
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
    public function destroy($id)
    {
        $producto= Producto::findOrFail($id);
        $exist = Kardex::where('producto_id',$producto->id)->first();
        if(!$exist){
            $result = $producto->delete();

            if($result){
                flash("El Producto fue eliminado Correctamente")->success();
                return  redirect()->back();
            }else{
                flash("El Producto no fue eliminado Correctamente")->error();
                return  redirect()->back();
            }
        }else{
            flash("No se puede eliminar el Producto ya que tiene transacciones asociadas")->error();
            return  redirect()->back();
        }

    }

    //5593685 - RAD -8488200002648650
    public function search($code){

        $producto = Producto::search($code);

        return response()->json([
            'status' => $producto != null ? 'ok' : 'error',
            'producto' => $producto
        ]);
    }

}
