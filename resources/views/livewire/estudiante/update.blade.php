<div wire:ignore.self id="updateModal" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Editar Datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="container">
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">cedula:</label>
                                    <input type="text" class="form-control" onkeypress="return event.charCode > 47 && event.charCode < 58;" pattern="[0-9]{5}" maxlength="10" id="exampleFormControlInput1"
                                           placeholder="cedula"
                                           wire:model="cedula">
                                    @error('cedula') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">nombre:</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput2"
                                           placeholder="nombre"
                                           wire:model="nombre">
                                    @error('nombre') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="exampleFormControlInput3">apellido:</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput3"
                                           placeholder="apellido"
                                           wire:model="apellido">
                                    @error('apellido') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleFormControlInput4">correo:</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput4"
                                           placeholder="correo"
                                           wire:model="correo">
                                    @error('correo') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleFormControlInput5">telefono:</label>
                                    <input type="text" class="form-control" onkeypress="return event.charCode > 47 && event.charCode < 58;" pattern="[0-9]{5}" maxlength="10" id="exampleFormControlInput5"
                                           placeholder="telefono"
                                           wire:model="telefono">
                                    @error('telefono') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput6">direccion:</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput6"
                                           placeholder="direccion"
                                           wire:model="direccion">
                                    @error('direccion') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput7">fecha nacimiento:</label>
                                            <input type="date" class="form-control" id="exampleFormControlInput7"
                                                   placeholder="fecha nacimiento"
                                                   wire:model="fechaNacimiento">
                                            @error('fechaNacimiento') <span
                                                class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>genero</label>
                                            <select wire:model="genero" class="form-control">
                                                <option value="">--Seleccione--</option>
                                                <option value="masculino">masculino</option>
                                                <option value="femenino">femenino</option>
                                            </select>
                                            @error('genero') <span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>es becario</label>
                                            <select wire:model="esBecario" class="form-control">
                                                <option value="">--Seleccione--</option>
                                                <option value="si">si</option>
                                                <option value="no">no</option>
                                            </select>
                                            @error('esBecario') <span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        @if($esBecario =='si')
                                            <div class="form-group">
                                                <label for="exampleFormControlInput8">porcentaje de beca:</label>
                                                <input type="number" class="form-control" id="exampleFormControlInput58"
                                                       placeholder="porcentaje de beca del 0 al 100"
                                                       wire:model="porcentajeBeca">
                                                @error('porcentajeBeca') <span
                                                    class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>estado</label>
                                            <select wire:model="estado" class="form-control">
                                                <option value="">--Seleccione--</option>
                                                <option value="activo">activo</option>
                                                <option value="inactivo">inactivo</option>
                                            </select>
                                            @error('estado') <span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                </div>


                            </div>

                            <div class="col-6">


                                <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                        <div class="form-group">
                                            <label>foto</label>

                                            @if($foto)

                                                <img class="img-responsive center-block d-block mx-auto"
                                                     src=" {{ asset('storage').'/'.$foto }}" alt="" width="200">
                                                <button wire:click.prevent="eliminarFoto1" class="btn btn-warning">
                                                    eliminar
                                                    foto
                                                </button>

                                            @else
                                                @if($genero === 'masculino')
                                                    <img class="img-responsive center-block d-block mx-auto"
                                                         src=" {{ asset('static/boy.jpg')}}" alt="" width="200">
                                                @else
                                                    <img class="img-responsive center-block d-block mx-auto"
                                                         src=" {{ asset('static/girl.jpg')}}" alt="" width="200">
                                                @endif
                                            @endif


                                        </div>
                                    </div>
                                    @if(!$foto)
                                        <div class="col-md-6 offset-md-3">
                                            <div class="form-group">
                                                <input type="file" wire:model="fotoNueva" id="fileInputId2">
                                                @error('fotoNueva')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                <div wire:loading wire:target="fotoNueva">Uploading...</div>
                                                @if ($fotoNueva and !$errors->has('fotoNueva') and $editar)
                                                    <h6> vista previa:</h6>
                                                    <img src="{{ $fotoNueva->temporaryUrl() }}" width="200">
                                                    <button wire:click.prevent="eliminarFoto2" class="btn btn-warning">
                                                        eliminar
                                                        foto
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                </div>

                            </div>
                        </div>

                        <br/>
                        <br/>
                        <div class="row">


                            <div class="col-md-6">


                                <label>buscar representante</label>
                                <input name="representante"
                                       wire:model="representante"
                                       type="text"
                                       class="form-control"
                                       id="representante">

                                @error("representante")
                                <small class="form-text text-danger">{{$message}}</small>
                                @else
                                    @if(count($usuarios)>0)
                                        @if(!$picked)
                                            <div class="shadow rounded px-3 pt-3 pb-0">
                                                @foreach($usuarios as $usuario)
                                                    <div style="cursor: pointer;">
                                                        <a wire:click.prevent="asignarUsuario('{{ $usuario->nombre." ".$usuario->apellido}}','{{$usuario->id}}')">
                                                            ({{ $usuario->cedula }})
                                                            {{ $usuario->nombre }}
                                                            {{ $usuario->apellido }}
                                                        </a>
                                                    </div>
                                                    <hr>
                                                @endforeach
                                            </div>
                                        @endif
                                    @else
                                        <small class="form-text text-muted">Comienza a teclear para que
                                            aparezcan los resultados</small>
                                    @endif
                                    @enderror

                            </div>
                            <div class="col-md-6 mt-2">
                                <br/>
                                <button class="btn btn-primary btn-group-sm" wire:click.prevent="agregarRepresentante">
                                    agregar representante
                                </button>

                            </div>
                        </div>

                        <br/>
                        <div class="row">
                            <div class="col-md-12">
                                <label>representantes</label>
                                <table class="table table-bordered mt-2">
                                    <thead>
                                    <tr>
                                        <th>cedula</th>
                                        <th>nombre</th>
                                        <th>apellido</th>

                                        <th width="150px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($representantes as $dato)
                                        <tr>
                                            <td>{{ $dato['cedula'] }}</td>
                                            <td>{{ $dato['nombre'] }}</td>
                                            <td>{{ $dato['apellido'] }}</td>
                                            <td>


                                                <button
                                                    onclick="confirm('Confirm delete?') || event.stopImmediatePropagation()"
                                                    wire:click.prevent="eliminarRepresentante({{$loop->index}})"
                                                    class="btn btn-danger btn-sm">
                                                    Eliminar
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <br/>
                        <br/>
                        <br/>
                        <br/>


                        <button wire:click.prevent="update()" class="btn btn-dark">Actualizar</button>
                        <button wire:click.prevent="cancel()" type="button" class="btn btn-secondary close-btn"
                                data-dismiss="modal">Cerrar
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('limpiarFoto2', event => {
            document.getElementById('fileInputId2').value = ''
        });
    </script>
</div>
