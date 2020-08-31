<?php

namespace App\Http\Controllers;

use App\Producto;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Location;

class ReporteController extends Controller
{

    public function index(Request $request){

        $reporte = [];
        $reporte['total_vendido'] = 0;
        $reporte['numero_ventas'] = 0;
        $reporte['ganancia'] = 0;
        $reporte['margen_ganancia'] = 0;
        $reporte['medios_pago'] = [];
        $reporte['abonos'] = [];
        if(isset($request->fecha_inicial) and isset($request->fecha_final)){
            $reporte['total_vendido'] = $this->total_vendido($request->fecha_inicial,$request->fecha_final);
            $reporte['numero_ventas'] = $this->numero_ventas($request->fecha_inicial,$request->fecha_final);
            $reporte['ganancia'] = $this->ganancia($request->fecha_inicial,$request->fecha_final,$reporte['total_vendido']);
            $reporte['margen_ganancia'] = $this->margen_ganancia($reporte['total_vendido'],$reporte['ganancia']);
            $reporte['medios_pago'] = $this->medios_pago($request->fecha_inicial,$request->fecha_final);
            $reporte['abonos'] = $this->abonos($request->fecha_inicial,$request->fecha_final);
        }

        $location = 'reportes';
        return view('reportes.ventas.index',compact('location','reporte'));

    }

    function total_vendido($fecha_inicial, $fecha_final){
        $total_vendido = 0;
        $totalVentas = DB::table('m_facturas')
            ->select('tipo' ,DB::raw('sum(total) as total'))
            ->whereBetween('fecha',[$fecha_inicial,$fecha_final])
            ->groupBy('tipo')
            ->get();
        if($totalVentas){
           $ventas = $totalVentas[0]->total ?? 0;
           $devoluciones = $totalVentas[1]->total ?? 0;
            $total_vendido = $ventas-$devoluciones;
        }
        return $total_vendido;
    }

    function numero_ventas($fecha_inicial, $fecha_final){
        $numero_ventas = 0;
        $total_ventas = DB::table('m_facturas')
            ->select('tipo' ,DB::raw('count(*) as cantidad'))
            ->whereBetween('fecha',[$fecha_inicial,$fecha_final])
            ->groupBy('tipo')
            ->get();
        if($total_ventas){
            $ventas = $total_ventas[0]->cantidad ?? 0;
            $devoluciones = $total_ventas[1]->cantidad ?? 0;
            $numero_ventas = number_format($ventas-$devoluciones,1);
        }
        return $numero_ventas;
    }

    function ganancia($fecha_inicial, $fecha_final,$total_vendido){

        /*SELECT tipo_movimiento,sum(cantidad*costo) as total FROM `kardexes`
        WHERE `tipo_movimiento`  = 'SALIDA' AND fecha BETWEEN '2020-08-01' AND '2020-08-23'
        GROUP BY tipo_movimiento*/

        $gastos = DB::table('kardexes')
            ->select('tipo_movimiento',DB::raw('sum(cantidad*costo) as total '))
            ->where('tipo_movimiento','SALIDA')
            ->whereBetween('fecha',[$fecha_inicial,$fecha_final])
            ->groupBy('tipo_movimiento')
            ->first();

        $gastoTotal = $gastos->total ?? 0;

        $ganancia = $total_vendido-$gastoTotal;

        return $ganancia;

    }

    function margen_ganancia($total_vendido,$ganancia){
       $margen = 0;
       if($total_vendido!=0){
           $margen = ($ganancia * 100) / $total_vendido;
       }
       return number_format($margen,2);
    }

    function medios_pago($fecha_incial,$fecha_final){
        /*
         * SELECT MEDIO_PAGO, SUM(TOTAL) FROM m_facturas F
         * INNER JOIN (SELECT ID FROM m_facturas
         * WHERE (ESTADO = 'EN DEUDA' OR ESTADO = 'PAGADA') AND TIPO = 'VENTA') M
         * ON (F.ID=M.ID)GROUP BY MEDIO_PAGO
         */
        $facturas = DB::table('m_facturas')
                   ->select('id')
                   ->whereRaw("ESTADO = 'PAGADA' AND TIPO = 'VENTA'");

        $medios_pago = DB::table('m_facturas')
                            ->joinSub($facturas,'facturas',function ($join){
                                $join->on('m_facturas.id','=','facturas.id');
                             })
                            ->select('m_facturas.medio_pago',DB::raw('SUM(TOTAL) as total'))
                            ->whereBetween('fecha',[$fecha_incial,$fecha_final])
                            ->groupBy('m_facturas.medio_pago')
                            ->get();
       /*
            select  sum(f.total), sum(d.total_abono), sum(f.total-d.total_abono) as restante from m_facturas f
            join (SELECT factura_id, sum(abono) as total_abono from deudas
            group by factura_id)  d on (f.id=d.factura_id)
             where estado='EN DEUDA' and f.tipo='VENTA'
         */

        $abonos = DB::table('deudas')
            ->select('factura_id',DB::raw('sum(abono) as total_abono'))
            ->groupBy('factura_id');

        $total = DB::table('m_facturas')
                  ->joinSub($abonos, 'abonos',function($join){
                     $join->on('m_facturas.id','=','abonos.factura_id');
                  })
                  ->select(DB::raw('sum(m_facturas.total-abonos.total_abono) as total'))
                  ->where('estado','EN DEUDA')
                  ->first();
        $total->medio_pago = 'deudas';
        $medios_pago = $medios_pago->concat([$total]);

        return $medios_pago;
    }

    function abonos($fecha_incial,$fecha_final){
        /*SELECT medio_pago,sum(abono) FROM `deudas`
          WHERE fecha BETWEEN '2020-08-01' and '2020-08-23'
          GROUP BY medio_pago
        */
        $abonos = DB::table('deudas')
            ->select('medio_pago',DB::raw('sum(abono) as total'))
            ->whereBetween('fecha',[$fecha_incial,$fecha_final])
            ->groupBy('medio_pago')
            ->get();

        return $abonos;

    }
    function lista(){
        $location = 'reportes';
        $productos = Producto::all();
            return view('reportes.lista.lista',compact('productos','location'));
    }

}
