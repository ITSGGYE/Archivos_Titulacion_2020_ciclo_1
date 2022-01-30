<div>
    @if(session()->has('message'))
        <script>
            toastr.success('{{session('message')}}');
        </script>
    @endif

    @include('livewire.matricula.update')

    <div class="container">

        <form>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">

                        <label>curso</label>
                        <select
                            wire:model="curso"
                            class="form-control">
                            <option value="">-- --</option>
                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}">
                                    {{ $curso->grado->grado}}  {{$curso->paralelo->paralelo}}
                                </option>
                            @endforeach
                        </select>
                        @error('curso') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">

                        <label>periodo</label>
                        <select
                            wire:model="periodo"
                            class="form-control">
                            <option value="">-- --</option>
                            @foreach ($periodos as $periodo)
                                <option value="{{ $periodo->id }}">
                                    {{ $periodo->periodo }}
                                </option>
                            @endforeach
                        </select>
                        @error('periodo') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <br/>
            <br/>
            <br/>
            <br/>
            {{--<button wire:click.prevent="buscar()" class="btn btn-success">buscar</button>--}}
        </form>

        <hr/>
        @if(count($lista)>0)
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
                            <th>matriculado</th>
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
                                <td>{{ $dato->matriculado }}</td>
                                <td>{{ $dato->estado}}</td>
                                <td>

                                        @if($dato->matriculado == 'no')
                                        <div class="row justify-content-center mt-2">
                                    <button class="btn btn-primary btn-sm" onclick="confirm('Confirmar ?') || event.stopImmediatePropagation()"
                                            wire:click="matricular({{$dato->id}})">Matricular
                                    </button>
                                    </div>
                                    @else
                                    <div class="row justify-content-center mt-2">
                                        <a class="fas fa-2x fa-print" href="{{URL::route('reporteMatricula',$dato->id)}}" target="_blank" class="btn btn-success btn-sm">

                                        </a>
                                    </div>
                                    @endif
                                    <div class="row justify-content-center mt-2">
                                    <button data-toggle="modal" data-target="#updateModal" class="btn btn-primary btn-sm"
                                        wire:click="edit({{ $dato->id }})">Editar
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
        @endif

    </div>
</div>
