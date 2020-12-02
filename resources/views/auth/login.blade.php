@extends('auth.contenido')
@section('login')
<div class="row justify-content-center">
<div class="col-md-8">
    <div class="card-group mb-0">
        <div class="card p-4">
            <form class="form-horizontal was-validated" method="POST" action="{{route('login')}}">
            {{csrf_field()}}
            <div class="card-body">
                <h2>Iniciar Sesión</h2>

            </div>
            <p class="text-muted">Ingrese los Datos</p>
            <div class="form-group mb-3 {{$errors->has('usuario' ? 'is-invalid' : '') }}">
                <span class="input-group-addon"><i class="icon-user"></i></span>
                <input type="text" value="{{ old('usuario') }}" class="form-control" name="usuario" id="usuario" placeholder="Usuario">
                {!!$errors->first('usuario','<span class="invalid-feedback"> :message </span>')!!}
            </div>
            <br>
            <div class="form-group mb-3 {{$errors->has('password' ? 'is-invalid' : '') }}">
                <span class="input-group-addon"><i class="icon-lock"></i></span>
                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                {!!$errors->first('password','<span class="invalid-feedback"> :message </span>')!!}
            </div>
            <br>
            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-primary px-4">Ingresar</button>
                </div>
            </div>

            </form>

        </div>
        <div class="card text-white bg-dark">
           <div class="card-body text-center">
           <img src="img/logo.png">
            <h3>Biblioteca Libros</h3>
            <h5 class="text-muted">Sistema Registro de libros</h5>
           </div>
        </div>

    </div>

</div>

</div>

@endsection
