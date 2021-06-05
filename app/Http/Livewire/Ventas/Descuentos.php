<?php

namespace App\Http\Livewire\Ventas;

use App\Descuento;
use App\Permisos;
use App\Producto;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Src\services\permisos\PermisoManager;

class Descuentos extends Component
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

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function mount() {
        $this->fecha_inicio = date('Y-m-d');
        $this->fecha_fin = date('Y-m-d');
    }

    public function searchProduct($value) {
        $product = Producto::search($value);
        if($product){
           $this->precio = floatval($product->precio);
           $this->unicode = $product->unicode;
           $product =  $product->nombre.'x'.$product->presentacion;
        }
        $this->product = $product ? : '';
    }

    public function save() {
        $this->validate();
        $manager = new PermisoManager();
        $this->request = (object) [
            'operation' => 'descuento-store',
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'count' => $this->count,
            'precio' => $this->precio,
            'producto_embalaje_id' => $this->unicode
        ]; 
        $manager->generar($this->request);
        $this->page = 'verification';
    }

    public function verification() {
       $this->validateOnly('code',['code' => 'required | numeric | digits:5']); 
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
        return view('livewire.ventas.descuentos');
    }
}
