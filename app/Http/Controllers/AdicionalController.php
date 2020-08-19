<?php

namespace App\Http\Controllers;

use App\Adicional;
use App\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdicionalController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Adicional  $adicional
     * @return \Illuminate\Http\Response
     */
    public function show(Adicional $adicional)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Adicional  $adicional
     * @return \Illuminate\Http\Response
     */
    public function edit(Adicional $adicional)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Adicional  $adicional
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adicional $adicional)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Adicional  $adicional
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adicional $adicional)
    {
        //
    }

    public function save(Request $request){

        $values = array();
        parse_str($request->form, $values);
        $validate = Validator::make($values,[
            'nombre' => 'required',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 'validate',
                'message' => $validate->errors()
            ]);
        }

        $adicional = new Adicional($values);
        $result = $adicional->save();
        if($result){
            return response()->json([
                'status' => 'ok',
                'cliente' => $adicional
            ]);
        }else {
            return response()->json([
                'status' => 'error',
            ]);
        }
    }

}
