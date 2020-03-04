
<style>
  html {
    position: relative;
    min-height: 100%;
}

body {
    margin: 0 0 100px;
    /* bottom = footer height */
    padding: 25px;
}

footer {
    background-color: #ccff99;
    position: absolute;
    left: 0;
    bottom: 0;
    height: 70px;
    width: 100%;
    overflow: hidden;
}
</style>

<div class="row">
    <div class="col-md-4">
      <dl>
        <dd><span>Conectado desde:</span>
        @foreach($localizacion as $item)
          <span><b>{{$item}}</b></span>
        @endforeach
      </dd>
      <dd>Siguenos en: <i class="fab fa-twitter"></i> <i class="fab fa-facebook"></i> <i class="fab fa-instagram"></i></dd>
      </dl>
      </div>

      <div class="col-md-2">
        <dl>
          <dd><a class="footer-link" href="">Quienes somos</a></dd>
          <dd><a href="">Condiciones de compra</a></dd>
        </dl>
      </div>
      <div class="col-md-2">
        <dl>
          <dd><a class="footer-link" href="">Aviso legal</a></dd>
          <dd><a href="">Garantías</a></dd>
        </dl>
      </div>

      <div class="col-md-4">
        <div><small> Polígono La Luz, nave 2,  21007, Huelva, Huelva.ESPAÑA</small></div>
      </div>
</div>