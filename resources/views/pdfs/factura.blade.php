<html>
<head><meta charset="euc-kr">
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        body {
            margin: 3cm 2cm 2cm;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #38383A;
            color: white;
            text-align: center;
            line-height: 30px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #38383A;
            color: white;
            text-align: center;
            line-height: 35px;
        }
    </style>
</head>
<body>
<header>
   <table style=" width: 75%; margin: 0 auto;">
        <tr>
            <td><img src="{{asset('images/logo.png')}}" width="180px" height="80px" alt=""></td>
            <td colspan="2" style="color: white; font-weight: bold; font-size: 2em;"><center>Factura</center></td>
        </tr>
   </table>
</header>

<main>
    <table style=" width: 80%; margin: 0 auto;">
        <tr>
            <td colspan="2" width="60%;" style="padding-bottom: 10px;">La Nikorera</td>
            <td style="padding-bottom: 10px;">NIT</td>
            <td style="padding-bottom: 10px;">12645260-0</td>
        </tr>
    </table>
    <table style=" width: 80%; margin: 0 auto;">
       <tr>
           <td colspan="2" width="60%;" style="padding-bottom: 10px;">Factura a:</td>
           <td style="padding-bottom: 10px;">N° de factura</td>
           <td style="padding-bottom: 10px;">{{$factura->serie.'-'.$factura->n_venta}}</td>
       </tr>
       <tr>
           <td colspan="2" width="60%;" style="padding-bottom: 10px;">{{$factura->cliente->nombres}}</td>
           <td style="padding-bottom: 10px;">Fecha</td>
           <td>{{$factura->fecha}}</td>
       </tr>
       <tr>
           <td colspan="2" width="60%;">{{$factura->cliente->telefono}}</td>
           <td colspan="2"></td>
       </tr>
   </table>
    <table style=" width: 80%; margin: 0 auto;">
       <tr>
           <td colspan="2" width="60%;" style="padding-bottom: 10px;">Medio de Pago: {{$factura->medio_pago}}</td>
           <td style="padding-bottom: 10px;">Modalidad de pago: {{$factura->modalidad_pago}}</td>
       </tr>
   </table>
    <table style="width: 80%; margin: 20px auto; border-collapse: collapse">
        <tr style="background-color: #FFD700; color: black; font-weight: bold;">
            <td style=" padding: 5px;">Descripcion</td>
            <td  style=" padding: 5px; text-align: center;" >Cantitdad</td>
            <td  style=" padding: 5px; text-align: center;">Precio</td>
            <td  style=" padding: 5px; text-align: center;">Total</td>
        </tr>
        @foreach($factura->dfactura as $detalle)
            <tr>
                <td style="margin-bottom: 10px;">{{$detalle->producto_embalaje->producto->nombre.'X'.$detalle->producto_embalaje->producto->presentacion}}</td>
                <td style="text-align: center;">{{$detalle->cantidad}}</td>
                <td style="text-align: center;">$ {{$detalle->precio}}</td>
                <td style="text-align: center;">$ {{$detalle->cantidad*$detalle->precio}}</td>
            </tr>
        @endforeach
        @foreach(json_decode($factura->adicionales) as $adicional)
            <tr>
                <td style="margin-bottom: 10px;">{{$adicional->nombre}}</td>
                <td style="text-align: center;">{{$adicional->cantidad}}</td>
                <td style="text-align: center;">$ {{$adicional->precio_show}}</td>
                <td style="text-align: center;">$ {{$adicional->total}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3" style="text-align: right;">Total</td>
            <td >{{number_format($factura->total)}}</td>
        </tr>
    </table>
</main>

<footer>
    <h1>Gracias por tu compra</h1>
</footer>
</body>
</html>
