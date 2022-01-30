<div>
    @if(session()->has('message'))
        <script>
            toastr.success('{{session('message')}}');
        </script>
    @endif

    <div class="container">

        <div class="row">
            <div class="col-5">
                <div class="row">
                    <div class="col-5">
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
                    <div class="col-5">
                        <div class="form-group">

                            <label>curso</label>
                            <select
                                wire:model="curso"
                                class="form-control">
                                <option value="">-- --</option>
                                @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id }}">
                                        {{ $curso->grado->grado}} {{ $curso->paralelo->paralelo}}
                                    </option>
                                @endforeach
                            </select>
                            @error('curso') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-2 mt-2">
                        <br/>
                        <button class="fas fa-2x fa-sync-alt btn-success" wire:click.prevent="buscar1()"></button>
                    </div>

                </div>

                <hr/>
                @if(count($lista)>0)
                    <div class="row">
                        <div class="col-md-12">

                            <table class="table table-bordered mt-2">
                                <thead>
                                <tr>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datos as $dato)
                                    <tr>
                                        <td>{{$loop->iteration}}: {{ $dato->apellido }} {{ $dato->nombre }} ({{ $dato->cedula }})
                                        </td>

                                        <td>

                                            <div class="mt-1">
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" value="{{$dato->id}}" wire:model="foo">
                                                    {{--<input type="checkbox" value="{{ $dato->id }}" wire:model="type.{{$dato->id }}" class="form-checkbox h-6 w-6 text-green-500">
                                                --}}

                                                </label>
                                            </div>


                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-2">

                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>


                <div class="row justify-content-center">
                    <button class="fas fa-2x fa-arrow-right btn-primary" wire:click.prevent="agregar()">

                    </button>
                </div>

                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>

            </div>

            <div class="col-5">
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label>periodo</label>
                            <select
                                wire:model="periodo2"
                                class="form-control">
                                <option value="">-- --</option>
                                {{--@foreach ($periodos2 as $periodo)
                                    <option value="{{ $periodo->id }}">
                                        {{ $periodo->periodo }}
                                    </option>
                                @endforeach--}}
                                <option value="{{ $periodos2->id}}">
                                    {{ $periodos2->periodo}}
                                </option>

                            </select>
                            @error('periodo2') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                    </div>
                    <div class="col-5">
                        <div class="form-group">

                            <label>curso</label>
                            <select
                                wire:model="curso2"
                                class="form-control">
                                <option value="">-- --</option>
                                @foreach ($cursos2 as $curso)
                                    <option value="{{ $curso->id }}">
                                        {{ $curso->grado->grado}} {{ $curso->paralelo->paralelo}}
                                    </option>
                                @endforeach
                            </select>
                            @error('curso2') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-2 mt-2">
                        <br/>
                        <button class="fas fa-2x fa-sync-alt btn-success" wire:click.prevent="buscar2()"></button>
                    </div>
                </div>

                <hr/>
                @if(count($lista2)>0)
                    <div class="row">
                        <div class="col-md-12">

                            <table class="table table-bordered mt-2">
                                <thead>
                                <tr>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datos2 as $dato)
                                    <tr>

                                        <td>{{$loop->iteration}}: {{ $dato->apellido }} {{ $dato->nombre }} ({{ $dato->cedula }})
                                        </td>

                                        {{--<td>

                                            <div class="mt-1">
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" value="{{$dato->id}}" wire:model="foo2">
                                                    {{--<input type="checkbox" value="{{ $dato->id }}" wire:model="type.{{$dato->id }}" class="form-checkbox h-6 w-6 text-green-500">


                                                </label>
                                            </div>


                                        </td>--}}
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>


        </div>
        <hr/>
        <div class="row justify-content-end">

            <div class="col-md-2">
                <button class="btn btn-primary " onclick="confirm('Confirmar ?') || event.stopImmediatePropagation()"
                        wire:click="guardar()">Enrolar
                </button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-success" wire:click.prevent="cancel()">Limpiar
                </button>
            </div>
        </div>
    </div>

</div>

