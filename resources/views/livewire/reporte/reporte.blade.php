<div>
    @if(session()->has('message'))
        <script>
            toastr.success('{{session('message')}}');
        </script>
    @endif

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

                <div class="col-2 mt-2">
                    <br/>
                    @if($imprimir)

                        <a class="fas fa-2x fa-print" href="{{URL::route('reporteGeneral',['curso'=> $curso1,'periodo'=>$periodo1])}}" target="_blank" class="btn btn-success">

                        </a>
                    @endif
                </div>
            </div>
            <br/>
            <br/>
            <br/>
            <br/>
        </form>

        <hr/>
        @if(count($lista)>0)
            <div class="row">
                <div class="col-md-12">

                    <table class="table table-bordered mt-2">
                        <thead>
                        <tr>
                            <th>foto</th>
                            <th>cedula</th>
                            <th>nombre completo</th>
                            <th>matriculado</th>
                            <th>estado</th>
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
                                <td>{{ $dato->apellido }}  {{ $dato->nombre }}</td>
                                <td>{{ $dato->matriculado }}</td>
                                <td>{{ $dato->estado }}</td>
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
