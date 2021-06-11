<?php

namespace App\Http\Livewire\Ventas\Descuentos;

use App\Descuento;
use App\Permisos;
use App\Producto;
use App\ProductoEmbalaje;
use Exception;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Src\services\permisos\PermisoManager;

class DescuentoUpdate extends Component
{
    public string $fecha_inicio;
    public string $fecha_fin;
    public string $codigo_barras;
    public string $product;
    public string $count = '1';
    public string $precio = '0.0';
    public ?int $unicode = null;
    public string $code = '';
    public string $page = 'descuento-update';
    public int $descuento_id = 0;

    private $request = null;

    protected $rules = [
        'fecha_inicio' => 'required',
        'fecha_fin' => 'required',
        'count' => 'required | numeric',
        'precio' => 'required | numeric',
        'unicode' => 'required | numeric',
    ];

    public function mount($id){
       $descuento = Descuento::findOrFail($id);
       $this->fecha_inicio = $descuento->fecha_inicio;
       $this->fecha_fin = $descuento->fecha_fin; 
       $producto_embalaje = ProductoEmbalaje::findOrFail($descuento->producto_embalaje_id);
       $this->codigo_barras = $producto_embalaje->codigo_de_barras;
       $this->product = $producto_embalaje->producto->nombre.' x '.$producto_embalaje->producto->presentacion;
       $this->count = $descuento->cantidad_destinada;
       $this->precio = floatval($descuento->valor);
       $this->unicode = $descuento->producto_embalaje_id;
       $this->descuento_id = $descuento->id;
    }

    public function searchProduct($value) {

        try{

            $product = Producto::search($value);
            if($product){
            $this->precio = ceil(floatval($product->costo_promedio));
            $this->unicode = $product->unicode;
            $product =  $product->nombre.' x '.$product->presentacion.'- Unidades: '.$product->unidades;
            }
            $this->product = $product ? : '';

        }catch(Exception $e){
            flash('ha ocurrrido un errror inesperado, por favor intenta más tarde');
        }
       
    }

    public function save() {

        $this->validate();

        try{
            $hoy= date('Y-m-d');
            if($this->fecha_inicio<$hoy||$this->fecha_fin<$hoy){
                flash("El Descuento no puede aplicarse a una fecha en el pasado!")->error();
                return;
            }
            if($this->fecha_fin<$this->fecha_inicio){
                flash("Seleccione correctamente las fechas!")->error();
                return;
            }
            $producto = ProductoEmbalaje::findOrFail($this->unicode);
            $producto = Producto::search($producto->codigo_de_barras);
            if( $this->precio < ceil($producto->costo_promedio)){
                $message = "El precio no puede ser menor al costo promedio <strong>$ ".number_format($producto->costo_promedio, 0)."</strong>";
                flash($message)->error();
                return;  
            }
            $manager = new PermisoManager();
            $this->request = (object) [
                'operation' => 'descuento-update',
                'fecha_inicio' => $this->fecha_inicio,
                'fecha_fin' => $this->fecha_fin,
                'cantidad' => $this->count,
                'precio' => $this->precio,
                'producto_embalaje_id' => $this->unicode
            ]; 
            $manager->generar($this->request);
            $this->page = 'verification';

        }catch(Exception $e){
             flash('ha ocurrrido un errror inesperado, por favor intenta más tarde');
        }
        
    }

    public function verification() {
       $this->validateOnly('code',['code' => 'required | numeric | digits:5']); 
       try{
            $permisos = Permisos::where([
                ['operation', 'descuento-update'],
            ])->get();
            $band = false;
            foreach($permisos as $permiso){
                if(Hash::check($this->code, $permiso->code))
                    $band = true; 
            }
            if($band){
                $descuento = Descuento::findOrFail($this->descuento_id);
                $descuento->fill([
                    'fecha_inicio' => $this->fecha_inicio,
                    'fecha_fin' => $this->fecha_fin,
                    'cantidad_destinada' => $this->count,
                    'valor' => $this->precio,
                    'producto_embalaje_id' => $this->unicode
                ]);  
                $descuento->save();
                flash('El Descuento se ha aplicado correctamente.')->success(); 
                return redirect()->to('/ventas/descuentos');
            }else {
                flash('El codigo de verificacion es incorrecto')->error();
                return;
            }
       }catch(Exception $e){
            flash('ha ocurrrido un errror inesperado, por favor intenta más tarde');
       }
    }

    public function render()
    {
        return view('livewire.ventas.descuentos.descuento-update');
    }
}
