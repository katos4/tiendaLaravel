@extends('master')
@section('content')

<div class="row mt-4">

        <div class="col-lg-8 offset-2 mt-4">
            <h5>Pedidos y facturas</h5>
                <div class="card text-center border-0">
                    <div class="card-body">
                        
                        <table class="table table-hover">

                           <thead>
                               <tr>
                                   <td>Nº pedido</td>
                                   <td>Fecha realización</td>
                               </tr>
                           </thead>
                           @foreach($pedido as $ped)
                            <tbody>
                              <tr>
                              <td>{{ $ped->id_pedido }}</td>
                                <td>{{$ped->fecha_realizacion}}</td>
                              <form method="POST" action="{{ route('facturaPdf') }}">
                                {{ csrf_field() }}
                                    <input type="hidden" name="pedidoId" id="pedidoId" value="{{$ped->id_pedido}}">
                                    <td><button type="submit">Ver factura</button></td>
                                </form>
                              </tr>
                            </tbody>
                            @endforeach
                          </table>

                        
                    </div>
                </div>
        </div>

</div>





@endsection