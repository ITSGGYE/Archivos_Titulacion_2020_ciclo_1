<div>


    @if(session()->has('message'))
        <script>
            toastr.success('{{session('message')}}');
        </script>
    @endif

    @include('livewire.representante.create')

    @include('livewire.representante.update')
    <br/>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <input type="text" wire:model="filtro" class="form-control"/>

                <table class="table table-bordered mt-2">
                    <thead>
                    <tr>
                        <th>cedula</th>
                        <th>nombre</th>
                        <th>apellido</th>
                        <th>correo</th>
                        <th>telefono</th>
                        <th>direccion</th>
                        <th>estado</th>

                        <th width="150px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datos as $dato)
                        <tr>
                            <td>{{ $dato->cedula }}</td>
                            <td>{{ $dato->nombre }}</td>
                            <td>{{ $dato->apellido }}</td>
                            <td>{{ $dato->correo }}</td>
                            <td>{{ $dato->telefono }}</td>
                            <td>{{ $dato->direccion }}</td>
                            <td>{{ $dato->estado }}</td>
                            <td>
                                <button data-toggle="modal" data-target="#updateModal" class="btn btn-primary btn-sm"
                                        wire:click="edit({{ $dato->id }})">Editar
                                </button>

                                <button onclick="confirm('Confirm delete?') || event.stopImmediatePropagation()" wire:click="delete({{ $dato->id }})" class="btn btn-danger btn-sm">Eliminar
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
