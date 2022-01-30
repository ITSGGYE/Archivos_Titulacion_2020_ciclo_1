@extends('adminlte::page')




@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <img src="{{asset('static/logo-escuela.jpg')}} "
                             class="img-responsive center-block d-block mx-auto" width="200">
                        <br/>
                        <h2 class="text-center">UNIDAD EDUCATIVA PARTICULAR ESPERANZA DE BASTIÓN</h2>

                        {{-- __('You are logged in!') --}}
                    </div>

                    <div>

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
