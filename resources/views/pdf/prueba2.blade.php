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
<div class="container">

    <div class="row justify-content-center">

        <div class="text-center">
            <img src="{{public_path('static/logo-escuela.jpg')}}" width="100">
        </div>
    </div>
    <br/>
    <h2 class="text-center">UNIDAD EDUCATIVA PARTICULAR ESPERANZA DE BASTIÓN</h2>
    <br/>
    <div class="row">
        @if($dato->estudiante->foto)

            <img class="img-responsive center-block d-block mx-auto img-thumbnail"
                 src="{{ public_path('storage').'/'.$dato->estudiante->foto }}" alt="" width="100">
        @else
            @if($dato->estudiante->genero === 'masculino')
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


    <h5>cedula: {{ $dato->estudiante->cedula }}</h5>
    <h5>nombre: {{ $dato->estudiante->nombre}} </h5>
    <h5>apellido: {{ $dato->estudiante->apellido }}</h5>
    <h5>edad: {{ Carbon\Carbon::now()->diffInYears($dato->estudiante->fechaNacimiento)}}</h5>
    <br/>
    <br/>

    <h5>codigo matricula:</h5>
    <div class="barcode">
        {!! DNS1D::getBarcodeHTML(sprintf('%07d',$dato->id), "C128",1.4,22) !!}
        {{ sprintf('%07d',$dato->id)}}
    </div>

    <br/>
    <br/>

    <h5>Matriculado en:</h5>
    <h5>curso: {{ $dato->curso->grado->grado}} {{ $dato->curso->paralelo->paralelo}}</h5>
    <h5>periodo: {{ $dato->periodo->periodo}}</h5>
    <h5>estado de la matricula: {{ $dato->estado}}</h5>


</div>


</body>
</html>

