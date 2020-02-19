@extends('master')
@section('content')


<div class="row mt-4">
<form class="needs-validation" method="POST" action="{{route('crearPedido') }}"  novalidate>
    {{ csrf_field() }}
           
                <div class="col-lg-12">
                    <label for="validationCustom01">Direccion de facturación</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" required>
                    <div class="invalid-feedback">
                    ¡Debes introducir una direccion!
                    </div>
                </div>
            
           
                <div class="col-lg-12">
                    <label for="validationCustom05">Codigo postal</label>
                    <input type="text" class="form-control" id="codigoPostal" name="codigoPostal" required>
                    <div class="invalid-feedback">
                        ¡Debes introducir un codigo postal!
                    </div>
                </div>
            
            <div class="form-group">
              <!--  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck">
                    Aceptar los términos y condiciones
                    </label>
                    <div class="invalid-feedback">
                    Debes aceptar los terminos y condiciones
                    </div>
                </div> -->
            </div>

        <input type="text" id="userName" name="userName" value="{{auth()->user()->name}}" hidden>
        <input type="text" id="userEmail" name="userEmail" value="{{auth()->user()->email}}" hidden>
        <input type="text" id="userId" name="userId" value="{{auth()->id()}}" hidden>
        
        <button class="btn btn-primary " type="submit">Continuar</button>
        </form>
</div>



<!-- JAVASCRIPT -->
  <script>
     
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
  </script>

@endsection