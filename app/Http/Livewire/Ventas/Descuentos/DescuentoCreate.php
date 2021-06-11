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

class DescuentoCreate extends Component
{

    public string $fecha_inicio;
    public string $fecha_fin;
    public string $codigo_barras;
    public string $product;
    public string $count = '1';
    public string $precio = '0.0';
    public ?int $unicode = null;
    public string $code = '';
    public string $page = 'descuento-store';

    private $request = null;

    protected $rules = [
        'fecha_inicio' => 'required',
        'fecha_fin' => 'required',
        'count' => 'required | numeric',
        'precio' => 'required | numeric',
        'unicode' => 'required | numeric',
    ];

    public function mount() {
        $this->fecha_inicio = date('Y-m-d');
        $this->fecha_fin = date('Y-m-d');
    }

    public function searchProduct($value) {
        $product = Producto::search($value);
        if($product){
           $this->precio = ceil(floatval($product->costo_promedio));
           $this->unicode = $product->unicode;
           $product =  $product->nombre.' x '.$product->presentacion.'- Unidades: '.$product->unidades;
        }
        $this->product = $product ? : '';
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
                'operation' => 'descuento-store',
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
                ['operation', 'descuento-store'],
            ])->get();
            $band = false;
            foreach($permisos as $permiso){
                if(Hash::check($this->code, $permiso->code))
                    $band = true; 
            }
            if($band){
                $descuento = new Descuento([
                    'fecha_inicio' => $this->fecha_inicio,
                    'fecha_fin' => $this->fecha_fin,
                    'cantidad_destinada' => $this->count,
                    'cantidad_vendida' => 0,
                    'valor' => $this->precio,
                    'producto_embalaje_id' => $this->unicode
                ]);  
                $descuento->save();
                $this->limpiar();
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

    public function limpiar() {
        $this->fecha_inicio = date('Y-m-d');
        $this->fecha_fin = date('Y-m-d');
        $this->codigo_barras = '';
        $this->product = '';
        $this->count = '1';
        $this->precio = '0.0';
        $this->unicode = null;
        $this->code = '';
        $this->page = 'descuento-store';
    }

    public function render()
    {
        return view('livewire.ventas.descuentos.descuento-create');
    }
}
