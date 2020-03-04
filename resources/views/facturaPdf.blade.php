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
    <span class="letrasColor">My Totem</span>
</header>

<main>

    <span class="letrasColor"><strong><h3>Factura simplificada</h3></strong></span><br><br><br>
<span>Número pedido: {{$numPed}}</span><br>
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
<span><b>Total:</b>{{$totalPagado}}</span><br><br>


<span>Nombre: {{$nombreUs}}</span><br>
<span>Email: {{$emailUs}}</span><br>
<span>Dirección: {{$dir}}</span><br><br><br>

    <div>
        <span>My Totem</span><br>
        <span>NIF: XXXXXXXXX</span><br>
        <span>Polígono La Luz, nave 2, 21007</span><br>
        <span>Huelva (España)</span>
    </div>
</main>

<footer>
    <h4>El equipo de MyTotem</h4>
</footer>

</body>
</html>