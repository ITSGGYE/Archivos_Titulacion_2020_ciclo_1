@extends('adminlte::page')




@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                    </div>

                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif

                        @livewire('enrolar-controlador')
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('adminlte_js')


    <script type="text/javascript">

        window.livewire.on('userStore', () => {
            $('#createModal').modal('hide');
            $('#updateModal').modal('hide');

        });

    </script>


@endsection
