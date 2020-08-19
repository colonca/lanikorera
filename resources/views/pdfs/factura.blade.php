<html>
<head>
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
            <td colspan="2" width="60%;" style="padding-bottom: 10px;">Razon social: La Nikorera</td>
            <td style="padding-bottom: 10px;">NIT</td>
            <td style="padding-bottom: 10px;">10645260-0</td>
        </tr>
    </table>
    <table style=" width: 80%; margin: 0 auto;">
       <tr>
           <td colspan="2" width="60%;" style="padding-bottom: 10px;">Factura a:</td>
           <td style="padding-bottom: 10px;">N° de factura</td>
           <td style="padding-bottom: 10px;">NIK-0001</td>
       </tr>
       <tr>
           <td colspan="2" width="60%;" style="padding-bottom: 10px;">Camilo Andres Colon Cañizares</td>
           <td style="padding-bottom: 10px;">Fecha</td>
           <td>18-08-2020</td>
       </tr>
       <tr>
           <td colspan="2" width="60%;">3017764758</td>
           <td colspan="2"></td>
       </tr>
   </table>
    <table style="width: 80%; margin: 20px auto; border-collapse: collapse">
        <tr style="background-color: #FFD700; color: black; font-weight: bold;">
            <td style="border: 1px solid black; padding: 5px;">Descripcion</td>
            <td  style="border: 1px solid black;  padding: 5px; text-align: center;" >Cantitdad</td>
            <td  style="border: 1px solid black;  padding: 5px; text-align: center;">Precio</td>
            <td  style="border: 1px solid black;  padding: 5px; text-align: center;">Total</td>
        </tr>
        <tr>
            <td style="margin-bottom: 10px;">Buchana's Master x 750ml</td>
            <td style="text-align: center;">2</td>
            <td style="text-align: center;">$ 150000</td>
            <td style="text-align: center;">$ 300000</td>
        </tr>
        <tr>
            <td style="margin-bottom: 10px;">Buchana's Master x 750ml</td>
            <td style="text-align: center;">2</td>
            <td style="text-align: center;">$ 150000</td>
            <td style="text-align: center;">$ 300000</td>
        </tr>
        <tr>
            <td style="margin-bottom: 10px;">Buchana's Master x 750ml</td>
            <td style="text-align: center;">2</td>
            <td style="text-align: center; margin-bottom: 20px;">$ 150000</td>
            <td style="text-align: center;">$ 300000</td>
        </tr>
    </table>
    <div style="width: 80%; margin: 0 auto;">
        <table style="width: 20%;">
             <tr>
                 <td></td>
                 <td style="width: 100%;">Impuesto: </td>
                 <td>12000</td>
             </tr>
        </table>
    </div>
    <table style=" width: 80%; margin: 0 auto;">
        <tr>
            <td colspan="2" width="60%;" style="padding-bottom: 10px;">Metodo de pago: Efectivo</td>
        </tr>
        <tr>
            <td colspan="2" width="60%;" style="padding-bottom: 10px;">Medio de pago: Contado</td>
        </tr>
    </table>
</main>

<footer>
    <h1>Gracias por tu compra</h1>
</footer>
</body>
</html>
