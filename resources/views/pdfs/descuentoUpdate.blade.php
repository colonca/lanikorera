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
   <h1>Detalles del Descuento</h1>
</header>

<main>
   <p><strong>Fecha Inicio:</strong> {{$request->fecha_inicio}} </p>
   <p><strong>Fecha Fin:</strong> {{$request->fecha_fin}} </p>
   <p><strong>Producto:</strong> {{$request->producto}} - <strong>Embalaje: </strong> {{$request->embalaje}}</p>
   <p><strong>Precio:</strong> {{number_format($request->precio, 2)}} </p>
   <p><strong>Cantidad:</strong> {{$request->cantidad}} </p>
</main>

<footer>
    <h1>LANIKORERA</h1>
</footer>
</body>
</html>

