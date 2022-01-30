<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reporte</title>

    <!-- Fonts -->

    <link rel="stylesheet" href="{{public_path('css/bootstrap.min.css')}}"/>


</head>
<body>
<div>

    <div class="row justify-content-center">

            <div class="text-center">
        <img src="{{public_path('static/logo-escuela.jpg')}}" width="100">
    </div>
    </div>
    <br/>
    <h2 class="text-center">UNIDAD EDUCATIVA PARTICULAR ESPERANZA DE BASTIÓN</h2>
    <br/>
    <div class="row">
        @if($dato1->foto)

            <img class="img-responsive center-block d-block mx-auto img-thumbnail"
                 src="{{ public_path('storage').'/'.$dato1->foto }}" alt="" width="100">
        @else
            @if($dato1->genero === 'masculino')
                <img class="img-responsive center-block d-block mx-auto img-thumbnail"
                     src="{{public_path('static/boy.jpg')}}" alt="" width="100">
            @else
                <img class="img-responsive center-block d-block mx-auto img-thumbnail"
                     src="{{public_path('static/girl.jpg')}}" alt="" width="100">
            @endif
        @endif
    </div>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <h6>cedula: {{ $dato1->cedula }}</h6>
    <h6>nombre: {{ $dato1->nombre }}</h6>
    <h6>apellido: {{ $dato1->apellido }}</h6>
    <h6>edad: {{ Carbon\Carbon::now()->diffInYears($dato1->fechaNacimiento) }}</h6>
    <h6>correo: {{ $dato1->correo }}</h6>
    <h6>telefono: {{ $dato1->telefono }}</h6>
    <h6>direccion: {{ $dato1->direccion }}</h6>
    <br/>
    <h6>representantes:</h6>
    <br/>
    @if(count($datos2)>0)
        <table class="table table-bordered mt-2">
            <thead>
            <tr>
                <th>cedula</th>
                <th>nombre completo</th>
                <th>edad</th>
                <th>correo</th>
                <th>telefono</th>
                <th>direccion</th>
            </tr>
            </thead>
            <tbody>


            @foreach($datos2 as $d)
            <tr>

                <td>{{$d->cedula }}</td>
                <td>{{$d->apellido}} {{$d->nombre}}</td>
                <td>{{ Carbon\Carbon::now()->diffInYears($d->fechaNacimiento) }}</td>
                <td>{{$d->correo }}</td>
                <td>{{$d->telefono }}</td>
                <td>{{$d->direccion }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        @else
        <h6>No tienen</h6>
    @endif
</div>
</body>
</html>

