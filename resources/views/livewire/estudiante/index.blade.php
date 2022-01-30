<div>


    @if(session()->has('message'))



        <script>
            toastr.success('{{session('message')}}');
        </script>
    @endif

    @include('livewire.estudiante.update')

    @include('livewire.estudiante.create')


    <br/>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <input type="text" wire:model="filtro" class="form-control"/>

                <table class="table table-bordered mt-2">
                    <thead>
                    <tr>
                        <th width="200px">foto</th>
                        <th>cedula</th>
                        <th>nombre</th>
                        <th>apellido</th>
                        <th>edad</th>
                        <th>correo</th>
                        <th>telefono</th>
                        <th>direccion</th>
                        <th>estado</th>

                        <th width="200px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datos as $dato)
                        <tr>
                            <td>
                                @if($dato->foto)

                                    <img class="img-responsive center-block d-block mx-auto img-thumbnail"
                                         src="{{ asset('storage').'/'.$dato->foto }}" alt="" width="100">
                                @else
                                    @if($dato->genero === 'masculino')
                                        <img class="img-responsive center-block d-block mx-auto img-thumbnail"
                                             src="{{ asset('static/boy.jpg')}}" alt="" width="100">
                                    @else
                                        <img class="img-responsive center-block d-block mx-auto img-thumbnail"
                                             src="{{ asset('static/girl.jpg')}}" alt="" width="100">
                                    @endif
                                @endif


                            </td>
                            <td>{{ $dato->cedula }}</td>
                            <td>{{ $dato->nombre }}</td>
                            <td>{{ $dato->apellido }}</td>
                            <td>{{ Carbon\Carbon::now()->diffInYears($dato->fechaNacimiento) }}</td>
                            <td>{{ $dato->correo }}</td>
                            <td>{{ $dato->telefono }}</td>
                            <td>{{ $dato->direccion }}</td>
                            <td>{{ $dato->estado }}</td>
                            <td >
                            <div class="row justify-content-center mt-1">
                                <a class="fas fa-2x fa-print" href="{{URL::route('reporteEstudiante',$dato->id) }}" target="_blank" class="btn btn-success btn-sm"
                                        >
                                </a>
                            </div>

                                <div class="row justify-content-center mt-1">
                                <button data-toggle="modal" data-target="#updateModal" class="btn btn-primary btn-sm"
                                        wire:click="edit({{$dato->id}})">Editar
                                </button>
                                </div>

                                <div class="row justify-content-center mt-1">
                                <button onclick="confirm('Confirm delete?') || event.stopImmediatePropagation()"
                                        wire:click="delete({{ $dato->id }})" class="btn btn-danger btn-sm">Eliminar
                                </button>
                            </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                {{$datos->links('livewire.pagination')}}
            </div>
        </div>
    </div>




</div>
