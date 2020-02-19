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
<h2> Hola, <strong>{{ $nombre_user }}</strong> </h2>
</header>

<main>

    <span class="letrasColor"><strong><h3>Resumen de tu compra</h3></strong></span><br><br><br>
    <table>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
        </tr>

        <tbody>
            @foreach($contenidoCarrito as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->price }} €</td>
                <td>{{ $item->qty }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <span class="letrasColor">TOTAL:</span>  <span><strong>{{$total}} €</strong></span><br><br>

    <div>
        <span class="letrasColor">Método de pago </span><span></span><br>
        <span class="letrasColor">Dirección de envío:</span><span> {{$direccion }} </span><br>
        <span class="letrasColor">Correo electrónico:</span> <span>{{$email_user }} </span><br>
    
    </div>
</main>

<footer>
    <h4>El equipo de MyTotem</h4>
</footer>

</body>
</html>