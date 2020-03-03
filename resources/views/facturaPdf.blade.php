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
            background-color:#ccff99;
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
            background-color: #ccff99;
            color: white;
            text-align: center;
            line-height: 35px;
            height: 70px;

        }

        table {
             width: 100%;
             border: 1px solid #000;
        }
        th, td {
            width: 25%;
            text-align: center;
            vertical-align: top;
            border: 1px solid #000;
            border-collapse: collapse;
            padding: 0.3em;
        }
        th {
            background: #eee;
        }
        h2, h4{
            color:black;
        }
        .letrasColor{
            color:#1a3300;
        }

    </style>
</head>
<body>

<header> 

</header>

<main>

    <span class="letrasColor"><strong><h3>Factura simplificada</h3></strong></span><br><br><br>
<span>Pedido numero: {{$numPed}}</span><br>
<span>Fecha de realización: {{$fechaRe}}</span><br><br>

    <table>
        <tr>
            <th>Producto</th>
            <th>PVP</th>
            <th>Cantidad</th>
        </tr>

        <tbody>
          @foreach($pedido as $ped)
            <tr>
                <td>{{$ped->nombre}}</td>
                <td>{{$ped->precio}}</td>
                <td>{{$ped->cantidad}}</td>
            </tr>
     @endforeach
        </tbody>
    </table><br>

<span>Nombre: {{$nombreUs}}</span><br>
<span>Email: {{$emailUs}}</span><br>
<span>Dirección: {{$dir}}</span><br>

    <div>
        Información de la empresa: XXXXXXX
    </div>
</main>

<footer>
    <h4>El equipo de MyTotem</h4>
</footer>

</body>
</html>