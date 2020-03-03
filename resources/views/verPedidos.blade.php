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
                                   <td>Estado</td>
                               </tr>
                           </thead>
                           @foreach($pedido as $ped)

                           

                            <tbody>
                              <tr>
                              <td>{{ $ped->id_pedido }}</td>
                                <td>{{$ped->fecha_realizacion}}</td>
                                <td>@if($ped->estado==1)
                                 Enviado
                                  @elseif($ped->estado==2)
                                  Cancelado
                                  @else
                                  Procesando
                                 @endif</td>
                              <form method="POST" action="{{ route('facturaPdf') }}">
                                {{ csrf_field() }}
                                    <input type="hidden" name="pedidoId" id="pedidoId" value="{{$ped->id_pedido}}">
                                    <td><button type="submit" style="background: transparent; border:none;"><i class="far fa-file-pdf"></i></button></td>
                                </form>
                                @if($ped->estado==0)
                              <form method="POST" action="{{route('cancelarPedido')}}">
                                {{ csrf_field() }}
                                  <input type="hidden" name="pedidoId" id="pedidoId" value="{{$ped->id_pedido}}">
                                  <td><button type="submit" style="background: transparent; border:none;"><i class="far fa-window-close"></i></button></td>
                                </form>
                                @endif
                              </tr>
                            </tbody>
                            @endforeach
                          </table>

                        
                    </div>
                </div>
        </div>

</div>





@endsection