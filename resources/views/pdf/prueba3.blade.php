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
    <br/>

    <h5>curso: {{ $curso->grado->grado }} {{ $curso->paralelo->paralelo }}</h5>
    <h5>periodo: {{$periodo->periodo }}</h5>


    <table class="table table-bordered mt-2">
        <thead>
        <tr>
            <th>N.</th>
            <th>cedula</th>
            <th>nombre completo</th>
            <th>matriculado</th>
            <th>codigo matricula</th>
            <th>estado</th>
        </tr>
        </thead>
        <tbody>
        @foreach($datos as $dato)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $dato->estudiante->cedula }}</td>
                <td> {{ $dato->estudiante->apellido }}  {{ $dato->estudiante->nombre}}</td>
                <td>{{$dato->matriculado}}</td>
                <td>
                    <div class="barcode">
                        {!! DNS1D::getBarcodeHTML(sprintf('%07d',$dato->id), "C128",1.4,22) !!}

                        {{ sprintf('%07d',$dato->id)}}
                    </div>
                </td>
                <td>{{$dato->estado }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>



</div>


</body>
</html>

