<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Subcategoria;
use App\Producto;
use Illuminate\Http\Request;

class SubcategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategorias  = Subcategoria::all();
        return view('almacen.subcategorias.list')->with('subcategorias',$subcategorias)->with('location','almacen');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias =  Categorias::all();
        $location = 'almacen';
        return view('almacen.subcategorias.create',compact('categorias','location'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        $subcategoria =  new Subcategoria();
        $subcategoria->categoria_id= $request->categoria_id;
        $subcategoria->nombre = $request->nombre;
        $result = $subcategoria->save();

        if($result){
            flash("La Subcategoria <strong>" . $subcategoria->nombre . "</strong> fue almacenada de forma exitosa!")->success();
            return  redirect()->route('subcategorias.index');
        }else{
            flash("La Subategoria <strong>" . $subcategoria->nombre . "</strong> no fue almacenada de forma exitosa!")->error();
            return  redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subcategoria  $subcategoria
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategoria $subcategoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subcategoria  $subcategoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorias = Categorias::all();
        $subcategoria = Subcategoria::findOrFail($id);
        $location = 'almacen';
        return view('almacen.subcategorias.edit',compact('subcategoria','categorias','location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subcategoria  $subcategoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subcategoria =  Subcategoria::findOrFail($id);
        $subcategoria->categoria_id=$request->categoria_id;
        $subcategoria->nombre = $request->nombre;
        $result = $subcategoria->save();
        if($result){
            flash("La Subategoría <strong>" . $subcategoria->nombre . "</strong> fue actualizada de forma exitosa!")->success();
            return  redirect()->route('subcategorias.index');
        }else{
            flash("La Subategoría <strong>" . $subcategoria->nombre . "</strong> no fue actualizada de forma exitosa!")->error();
            return  redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subcategoria  $subcategoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategoria = Subcategoria::findOrFail($id);
        $productos = $subcategoria->productos();
        if($productos->count() == 0){
            $result = $subcategoria->delete();

            if($result){
                flash("La Subcategoria fue eliminada Correctamente")->success();
                return  redirect()->back();
            }else{
                flash("La Subcategoria no fue eliminada Correctamente")->error();
                return  redirect()->back();
            }
        }else{
            flash("No se puede eliminar la Subcategoria ya que tine productos asociados")->error();
            return  redirect()->back();
        }
    }
}
