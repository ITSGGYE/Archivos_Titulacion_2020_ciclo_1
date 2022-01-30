<form>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label for="exampleFormControlInput1">cedula:</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="cedula"
                           wire:model="cedula">
                    @error('cedula') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label for="exampleFormControlInput2">nombre:</label>
                    <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="nombre"
                           wire:model="nombre">
                    @error('nombre') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label for="exampleFormControlInput3">apellido:</label>
                    <input type="text" class="form-control" id="exampleFormControlInput3" placeholder="apellido"
                           wire:model="apellido">
                    @error('apellido') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-3">
                <div class="form-group">
                    <label for="exampleFormControlInput4">correo:</label>
                    <input type="email" class="form-control" id="exampleFormControlInput4" placeholder="correo"
                           wire:model="correo">
                    @error('correo') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="exampleFormControlInput3">telefono:</label>
                    <input type="text" class="form-control" id="exampleFormControlInput5" placeholder="telefono"
                           wire:model="telefono">
                    @error('telefono') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="exampleFormControlInput3">direccion:</label>
                    <input type="text" class="form-control" id="exampleFormControlInput3" placeholder="direccion"
                           wire:model="direccion">
                    @error('direccion') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-3">
                <div class="form-group">
                    <label for="exampleFormControlInput4">fecha nacimiento:</label>
                    <input type="date" class="form-control" id="exampleFormControlInput4" placeholder="fecha nacimiento"
                           wire:model="fechaNacimiento">
                    @error('fechaNacimiento') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label>genero</label>
                    <select   wire:model="genero" class="form-control">
                        <option>--Seleccione--</option>
                        <option>masculino</option>
                        <option>femenino</option>
                    </select>
                    @error('genero') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label>es representante legal</label>
                    <select   wire:model="esRepresentanteLegal" class="form-control">
                        <option>--Seleccione--</option>
                        <option>si</option>
                        <option>no</option>
                    </select>
                    @error('esRepresentanteLegal') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label>tipo representante</label>
                    <select   wire:model="tipoRepresentante" class="form-control">
                        <option>--Seleccione--</option>
                        <option>padre</option>
                        <option>padre</option>
                        <option>abuelo</option>
                        <option>abuela</option>
                        <option>tío</option>
                        <option>tía</option>
                        <option>hermano</option>
                        <option>hermana</option>
                    </select>
                    @error('tipoRepresentante') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

        </div>



    </div>
    <button wire:click.prevent="store()" class="btn btn-success">Save</button>


</form>
