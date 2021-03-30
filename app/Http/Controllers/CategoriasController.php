<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Producto;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias  = Categorias::all();
        return view('almacen.categorias.list')->with('categoria',$categorias)->with('location','almacen');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location = 'almacen';
        return view('almacen.categorias.create')->with('location',$location);
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

        $categoria =  new Categorias();
        $categoria->nombre = $request->nombre;
        $result = $categoria->save();

        if($result){
            flash("La Categorias <strong>" . $categoria->nombre . "</strong> fue almacenada de forma exitosa!")->success();
            return  redirect()->route('categorias.index');
        }else{
            flash("La Categorias <strong>" . $categoria->nombre . "</strong> no fue almacenada de forma exitosa!")->error();
            return  redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categorias  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categorias $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categorias  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categorias::findOrFail($id);
        $location = 'almacen';
        return view('almacen.categorias.edit',compact('categoria','location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categorias  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categoria =  Categorias::findOrFail($id);
        $categoria->nombre = $request->nombre;
        $result = $categoria->save();
        if($result){
            flash("La Categoría <strong>" . $categoria->nombre . "</strong> fue actualizada de forma exitosa!")->success();
            return  redirect()->route('categorias.index');
        }else{
            flash("La Categoría <strong>" . $categoria->nombre . "</strong> no fue actualizada de forma exitosa!")->error();
            return  redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorias  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categorias::findOrFail($id);
        $exist = Producto::where('categoria_id',$categoria->id)->first();
        if(!$exist){
            $result = $categoria->delete();

            if($result){
                flash("La Categoria fue eliminada Correctamente")->success();
                return  redirect()->back();
            }else{
                flash("La Categoria no fue eliminada Correctamente")->error();
                return  redirect()->back();
            }
        }else{
            flash("No se puede eliminar la Categoria ya que tine productos asociados")->error();
            return  redirect()->back();
        }
    }
}
