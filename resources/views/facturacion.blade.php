@extends('master')
@section('content')

<div class="row mt-4">

    <div class="col-md-7">
      <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Producto</th>
            <th scope="col">Precio/Unidad</th> 
            <th scope="col">Cantidad</th>                           
        </tr>
        </thead>
        @foreach(Cart::content() as $item)
                    
          <tbody>
          <tr>
                <td>{{$item->name}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->qty}}</td>
          </tr>
          
          </tbody>
          
        @endforeach
      </table>
    <span><b>Total: </b>{{Cart::total()}} €</span>
    </div>

    <div class="col-md-5">
      <form class="needs-validation" method="POST" action="{{route('crearPedido') }}"  novalidate>
        {{ csrf_field() }}
        
      <div class="col-lg-12">
          <label for="validationCustom01">Direccion de facturación</label>
          <input type="text" class="form-control" id="direccion" name="direccion" required>
      </div>
          
      <div class="col-lg-12">
          <label for="validationCustom05">Codigo postal</label>
          <input type="text" class="form-control" id="codigoPostal" name="codigoPostal" required> 
      </div>
          
      <input type="text" id="userName" name="userName" value="{{auth()->user()->name}}" hidden>
      <input type="text" id="userEmail" name="userEmail" value="{{auth()->user()->email}}" hidden>
      <input type="text" id="userId" name="userId" value="{{auth()->id()}}" hidden>
      
      <br><button class="btn btn-primary " type="submit">Pagar y confirmar</button>
      
      
  </form>
    </div>

</div>

<div class="row mt-4">
    <div class="col-md-4 col-md-offset-4">
       
      </div>
</div>


@endsection