<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\Deuda;
use App\MFactura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes  = Clientes::all();
        return view('ventas.clientes.list')->with('clientes',$clientes)->with('location','ventas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Clientes::all();
        return view('ventas.clientes.create')->with('clientes',$clientes)->with('location','ventas');
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
            'nombres' => 'required',
            'telefono' => 'required|unique:clientes',
            'email' => 'required'
        ]);

        $clientes =  new Clientes();
        $clientes->nombres = $request->nombres;
        $clientes->telefono = $request->telefono;
        $clientes->email = $request->email;
        $result = $clientes->save();

        if($result){
            flash("El Cliente <strong>" . $clientes->nombres . "</strong> fue almacenado de forma exitosa!")->success();
            return  redirect()->route('clientes.index');
        }else{
            flash("El Cliente <strong>" . $clientes->nombres . "</strong> no fue almacenado de forma exitosa!")->error();
            return  redirect()->back();
        }
    }

    
     /**
     * Display the specified resource.
     *
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($cliente_id)
    {
        $cliente = Clientes::findOrFail($cliente_id);
        return view('ventas.clientes.listfact')
            ->with('location','ventas')
            ->with('cliente',$cliente);
    }
    
    
    public function detalles($factura_id)
    {
        $factura = MFactura::findOrFail($factura_id);
        $abonos =  Deuda::where([
            ['factura_id',$factura->id],
            ['abono','>',0]
        ])->orderBy('created_at','desc')->get();
        $location = 'ventas';
        return view('ventas.clientes.detallesfact',compact('location','factura','abonos'));
    }
    
    
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clientes =Clientes::findorfail($id);
        $location = 'ventas';
        return view('ventas.clientes.edit',compact('clientes','location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente =  Clientes::findOrFail($id);
        $cliente->nombres = $request->nombres;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $result = $cliente->save();
        if($result){
            flash("El Cliente <strong>" . $cliente->nombres . "</strong> fue actualizado de forma exitosa!")->success();
            return  redirect()->route('clientes.index');
        }else{
            flash("El Cliente <strong>" . $cliente->nombres . "</strong> no fue actualizado de forma exitosa!")->error();
            return  redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Clientes::findOrFail($id);
        $exist = MFactura::where('cliente_id',$cliente->id)->first();
        if(!$exist){
            $result = $cliente->delete();

            if($result){
                flash("El Cliente fue eliminado Correctamente")->success();
                return  redirect()->back();
            }else{
                flash("El Cliente no fue eliminado Correctamente")->error();
                return  redirect()->back();
            }
        }else{
            flash("No se puede eliminar el Cliente ya que tiene facturas asociadas")->error();
            return  redirect()->back();
        }

    }

   public function save(Request $request){

        $values = array();
        parse_str($request->form, $values);
        $validate = Validator::make($values,[
            'nombres' => 'required',
            'telefono' => 'required',
            'email' => 'required'
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 'validate',
                'message' => $validate->errors()
            ]);
        }

        $cliente = new Clientes($values);
        $result = $cliente->save();
        if($result){
            return response()->json([
                'status' => 'ok',
                'cliente' => $cliente
            ]);
        }else {
            return response()->json([
                'status' => 'error',
            ]);
        }

    }

    public function json(){
        $clientes = Clientes::all();
        return response()->json(
            $clientes
        );
    }


}
