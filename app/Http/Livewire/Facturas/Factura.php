<?php

namespace App\Http\Livewire\Facturas;

use App\Bodegas;
use App\Clientes;
use App\Deuda;
use App\DFactura;
use App\Kardex;
use App\MFactura;
use App\ProductoEmbalaje;
use App\Serie;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Factura extends Component
{

    public $fecha = '';
    public $cliente_id = '';
    public $bodega = '1';
    public $modalidad_pago = 'contado';
    public $medio_pago = 'efectivo';
    public $venta = '';
    public $serie;
    public $search = '';
    public $productos = [];
    public $adicionales = [];
    public $total = 0;

    protected $listeners = ['selectCustomer','searchProduct','addAdicional'];

    public function mount(){
       $this->fecha = date('y-m-d');
       $this->serie = Serie::where('estado','ACTIVO')->first();
       $this->venta = $this->serie->prefijo.'-'.++$this->serie->actual;
    }

    public function render()
    {
        $bodegas = Bodegas::all();
        return view('livewire.facturas.factura',[
            'bodegas' => $bodegas,
         ]);
    }

    public function guardar(){

        $this->validate([
            'cliente_id' => 'required',
            'bodega' => 'required',
            'modalidad_pago' => 'required',
            'medio_pago' => 'required'
        ]);

        $serie = Serie::where('estado','ACTIVO')->first();
        $status = 'ok';

        try {

            DB::beginTransaction();
            $factura = new MFactura();
            $factura->cliente_id = $this->cliente_id;
            $factura->bodega_id = $this->bodega;
            $factura->modalidad_pago = $this->modalidad_pago;
            $factura->medio_pago = $this->medio_pago;
            $factura->total = $this->total;
            $factura->fecha = date('y-m-d');
            $serie->actual = ++$serie->actual;
            $serie->save();
            $factura->serie = $serie->prefijo;
            $factura->n_venta = $serie->actual;
            $result = $factura->save();

            $adicionales = [];
            if($result){

                foreach ($this->productos as $producto){

                        $dfactura = new DFactura();
                        $dfactura->precio = $producto['precio'];
                        $dfactura->cantidad = $producto['cantidad'];
                        $dfactura->producto_embalaje_id =  $producto['embalaje_id'];
                        $dfactura->factura_id =  $factura->id;
                        $dfactura->save();
                        $kardex = new Kardex();
                        $kardex->producto_id = $producto['producto'];
                        $kardex->fecha = date('y-m-d');
                        $kardex->bodega_id = $this->bodega;
                        $kardex->tipo_movimiento = 'SALIDA';
                        $cantidad = $producto['unidades'] *  $producto['cantidad'];
                        $kardex->cantidad = $cantidad;
                        $kardex->costo = Kardex::costo_promedio($producto['producto']);
                        $kardex->detalle = 'Venta F/'.$serie->prefijo.'-'.$serie->actual;
                        $kardex->save();
                }

                if($this->modalidad_pago == 'credito'){
                    $factura->estado = 'EN DEUDA';
                    $deuda = new Deuda();
                    $deuda->factura_id =  $factura->id;
                    $deuda->abono = 0;
                    $deuda->save();
                }

                $factura->adicionales = json_encode($this->adicionales);
                $factura->save();
                $cliente =  Clientes::find($this->cliente_id);

                /*$pdf = PDF::loadView('pdfs.factura',['factura' => $factura])
                    ->setPaper('a4', 'landscape')
                    ->output();

                Mail::to($cliente->email)->send(new \App\Mail\Factura($pdf));*/

                $status = 'ok';

            }else {
                $status = 'error';
            }

            DB::commit();
            $this->emit('message',[
                'status' => 'ok',
                'message' => 'Factura guardada con exito'
            ]);
        }catch (\Exception $e){
            DB::rollBack();
            $this->emit('message',[
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }

    }

    public function change(){

             $productos = [];
             foreach ($this->productos as $producto){
                 $producto['precio'] = $this->medio_pago == 'datafono' ?  $producto['costo_promedio']*1.05 : $producto['costo_promedio'];
                 $producto['precio_show'] = number_format($producto['precio']);
                 $producto['total'] = number_format($producto['precio']*$producto['cantidad']);
                 $productos[] = $producto;
             }
             $this->productos = $productos;
             $adicionales = [];
             foreach ($this->adicionales as $adicional){
                 $adicional['precio'] = $this->medio_pago == 'datafono' ? $adicional['precio_promedio']*1.05 : $adicional['precio_promedio'];
                 $adicional['precio_show'] = number_format($adicional['precio']);
                 $adicional['total'] = number_format($adicional['precio']*$adicional['cantidad']);
                 $adicionales[] = $adicional;
             }
             $this->adicionales = $adicionales;

        $this->total();
    }

    public function searchProduct(){

        if(strlen($this->search) > 0){

            $producto =  DB::table('producto_embalaje')
                ->join('embalajes','producto_embalaje.embalaje_id','=','embalajes.id')
                ->join('productos','producto_embalaje.producto_id','=','productos.id')
                ->where('producto_embalaje.codigo_de_barras','=',$this->search)
                ->select(DB::raw('producto_embalaje.precio_venta as precio,unidades,nombre,presentacion,descripcion, producto_embalaje.id as unicode,codigo_de_barras, productos.id as producto'))
                ->first();

            if($producto){

                $producto->costo_promedio = Kardex::costo_promedio($producto->producto)*$producto->unidades;

                if(!$this->existProducto($producto->codigo_de_barras) && $this->hasStock($producto->producto,$producto->unidades,uniqid())){
                    $descuento = $this->InOffSale($producto->unicode);
                    $producto->descuento = 'NO';
                    if($descuento){
                        $producto->precio = $descuento->cantidad > 0 ? $descuento->precio : $producto->precio;
                        $producto->descuento =  $descuento->cantidad > 0 ? 'SI' : 'NO';
                     }
                    $this->productos[] = [
                        'unicode' => uniqid(),
                        'cantidad' => 1,
                        'precio' => $this->medio_pago == 'datafono' ?  $producto->precio*1.05 : $producto->precio,
                        'total' => number_format($producto->precio),
                        'precio_show' => number_format($producto->precio),
                        'codigo_de_barras' => $producto->codigo_de_barras,
                        'nombre' => $producto->nombre,
                        'presentacion' => $producto->presentacion,
                        'embalaje' => $producto->descripcion,
                        'embalaje_id' => $producto->unicode,
                        'costo_promedio' => $producto->precio,
                        'unidades' => $producto->unidades,
                        'producto' => $producto->producto,
                        'descuento' => $producto->descuento,
                    ];
                    $this->total();
                }

                if(!$this->hasStock($producto->producto,$producto->unidades,uniqid())){
                    $this->emit('message',[
                        'status' => 'error',
                        'message' => 'EL producto no tiene stock'
                    ]);
                }
                $this->search = '';
            }else {
                $this->emit('message',[
                    'status' => 'error',
                    'message' => 'El producto que intenta buscar no se encuentra registrado.'
                ]);
            }
        }
    }

    public function InOffSale($embalaje){
        /*SELECT (cantidad_destinada - cantidad_vendida) as cantidad FROM `descuentos`
        WHERE `fecha_inicio` <=  now() AND `fecha_fin`>= now() AND `producto_embalaje_id` = 22*/
        $descuento = DB::table('descuentos')
             ->select(DB::raw('(cantidad_destinada - cantidad_vendida) as cantidad, valor as precio'))
             ->where([
                ['fecha_inicio','<=',date('y-m-d')],
                ['fecha_fin','>=',date('y-m-d')],
                ['producto_embalaje_id',$embalaje]
             ])->first();

        return $descuento;
    }

    public function hasStock($id,$unidades,$code){
        $stock = $this->countInStock($id) - $this->countInSale($id,$code);
        $existencia =  intval($stock/$unidades);
        return $existencia > 0;
    }

    private function countInStock($id){

        $existencias = DB::table('kardexes')
            ->select(DB::raw('sum(cantidad) as cantidad,tipo_movimiento'))
            ->where('producto_id',$id)
            ->groupBy('tipo_movimiento')
            ->get();
        $existencia = 0;
        foreach ($existencias as $item){
            switch ($item->tipo_movimiento){
                case 'ENTRADA' :
                    $existencia += $item->cantidad;
                    break;
                case 'SALIDA' :
                    $existencia -= $item->cantidad;
                    break;
            }
        }
        return $existencia;
    }

    private function countInSale($producto_id, $code){
        $count = 0;
        foreach ($this->productos as $producto){
            if($producto['producto'] == $producto_id && $producto['unicode'] != $code){
                $count += $producto['cantidad']*$producto['unidades'];
            }
        }
        return $count;
    }

    private function existProducto($code){
        $band = false;
        foreach ($this->productos as $producto){
            if($producto['codigo_de_barras'] == $code){
                return !$band;
            }
        }

        return $band;
    }

    function selectCustomer($id){
        $this->cliente_id = $id;
    }

    public function addCantidad($codigo,$value){

       if($value <= 0){
           $this->emit('changeCount',[
               'id' => $codigo,
               'value' => 1
           ]);
       }
       $value = $value <= 0 ? 1 : $value;
       $producto = $this->producto($codigo);

       $stock = $this->countInStock($producto['producto']) - $this->countInSale($producto['producto'],$producto['unicode']);
       $cantidad = $stock - $producto['unidades']*$value;
       $posible = intval($stock / $producto['unidades']);
       if($cantidad <= 0){
           $value = $posible;
           $this->emit('message',[
               'status' => 'error',
               'message' => 'no hay stock'
           ]);
           $this->emit('changeCount',[
               'id' => $codigo,
               'value' => $value
           ]);
       }
       $productos = [];
       foreach ($this->productos as $producto){
           if($producto['unicode'] == $codigo){
               $producto['cantidad'] = $value;
               $descuento = $this->InOffSale($producto['embalaje_id']);
               if($descuento){
                   if($descuento->cantidad < $producto['cantidad']){
                       $copyProduct = $producto;
                       $copyProduct['unicode'] = uniqid();
                       $copyProduct['cantidad'] = $producto['cantidad'] - $descuento->cantidad;
                       $producto_embalaje = ProductoEmbalaje::find($producto['embalaje_id']);
                       $copyProduct['precio'] = $this->medio_pago == 'datafono' ? $producto_embalaje->precio_venta*1.05 : $producto_embalaje->precio_venta;
                       $copyProduct['precio_show'] = number_format($copyProduct['precio']);
                       $copyProduct['costo_promedio'] = $copyProduct['precio'];
                       $copyProduct['total'] =  number_format($copyProduct['precio']*$copyProduct['cantidad']) ;
                       $producto['cantidad'] = $descuento->cantidad;
                       $this->emit('changeCount',[
                           'id' => $producto['unicode'],
                           'value' => $producto['cantidad']
                       ]);
                       $productos[] = $copyProduct;
                   }
                   $producto['precio'] = $descuento->cantidad > 0 ? $descuento->precio : $producto['precio'];
               }
               $producto['total'] = number_format($producto['precio'] * $producto['cantidad']);
           }
           $productos[] = $producto;
       }
       $this->productos = $productos;
       $this->total();
    }

    public function addAdicional($adicional){

        if($this->medio_pago == 'datafono'){
            $adicional['precio'] *= 1.05;
            $adicional['total'] = number_format($adicional['precio']);
        }
        $this->adicionales[] = $adicional;
        $this->total();
    }

    public function addCantidadAdicional($codigo,$value){

        if($value <= 0){
            $this->emit('changeCount',[
                'id' => $codigo,
                'value' => 1
            ]);
        }
        $value = $value <= 0 ? 1 : $value;
        $adicionales = [];
        foreach ($this->adicionales as $adicional){
            if($adicional['unicode'] == $codigo){
                $adicional['cantidad'] = $value;
                $adicional['total'] = number_format($adicional['precio'] * $adicional['cantidad']);
            }
            $adicionales[] = $adicional;
        }
        $this->adicionales = $adicionales;
        $this->total();
    }

    public function total(){
        $total = 0;
        foreach ($this->productos as $producto){
            $total +=  $producto['cantidad'] * $producto['precio'];
        }
        foreach ($this->adicionales as $adicional){
            $total +=  $adicional['cantidad'] * $adicional['precio'];
        }
        $this->total = $total;
    }

    private function producto($codigo){
        $producto = null;
        foreach ($this->productos as $item){
            if($item['unicode'] == $codigo){
                $producto = $item;
            }
        }
        return $producto;
    }

    public function deleteAdicional($code){
        $adicionales = [];
        foreach ($this->adicionales as $item){
            if($item['unicode'] != $code){
                $adicionales[] = $item;
            }
        }
        $this->adicionales = $adicionales;
        $this->total();
    }

    public function delete($code){
        $productos = [];
        foreach ($this->productos as $producto){
            if($producto['unicode'] != $code){
                $productos[] = $producto;
            }
        }
        $this->productos = $productos;
        $this->total();
    }

}
