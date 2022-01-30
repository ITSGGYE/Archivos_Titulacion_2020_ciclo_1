<div>


    @if(session()->has('message'))

        <script>
            toastr.success('{{session('message')}}');
        </script>
    @endif
    @include('livewire.matricula.enrolar-nuevo-crear')


    <br/>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <input type="text" wire:model="filtro" class="form-control"/>

                <table class="table table-bordered mt-2">
                    <thead>
                    <tr>
                        <th>foto</th>
                        <th>cedula</th>
                        <th>nombre</th>
                        <th>apellido</th>
                        <th>edad</th>
                        <th>estado</th>

                        <th width="150px">Action</th>
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
                            <td>{{ $dato->estado }}</td>
                            <td>

                                <button data-toggle="modal" data-target="#createModal" class="btn btn-primary btn-sm"
                                        wire:click="enrolar({{$dato->id}})">Enrolar
                                </button>

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
