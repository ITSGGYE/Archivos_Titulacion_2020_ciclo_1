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
                                    <label for="exampleFormControlInput3">telefono:</label>
                                    <input type="text" class="form-control" onkeypress="return event.charCode > 47 && event.charCode < 58;" pattern="[0-9]{5}" maxlength="10" id="exampleFormControlInput5"
                                           placeholder="telefono"
                                           wire:model="telefono">
                                    @error('telefono') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput3">direccion:</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput3"
                                           placeholder="direccion"
                                           wire:model="direccion">
                                    @error('direccion') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleFormControlInput4">fecha nacimiento:</label>
                                    <input type="date" class="form-control" id="exampleFormControlInput4"
                                           placeholder="fecha nacimiento"
                                           wire:model="fechaNacimiento">
                                    @error('fechaNacimiento') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-3">
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

                            <div class="col-3">
                                <div class="form-group">
                                    <label>es representante legal</label>
                                    <select wire:model="esRepresentanteLegal" class="form-control">
                                        <option value="">--Seleccione--</option>
                                        <option value="si">si</option>
                                        <option value="no">no</option>
                                    </select>
                                    @error('esRepresentanteLegal') <span
                                        class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label>tipo representante</label>
                                    <select wire:model="tipoRepresentante" class="form-control">
                                        <option value="">--Seleccione--</option>
                                        <option value="padre">padre</option>
                                        <option value="madre">madre</option>
                                        <option value="abuelo">abuelo</option>
                                        <option value="abuela">abuela</option>
                                        <option value="tío">tío</option>
                                        <option value="tía">tía</option>
                                        <option value="hermano">hermano</option>
                                        <option value="hermana">hermana</option>
                                    </select>
                                    @error('tipoRepresentante') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-3">
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
</div>
