<div>


    @if(session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @include('livewire.representante.create')

    @include('livewire.representante.update')
    <br />


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
                        <th>estado</th>

                        <th width="150px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datos as $dato)
                            <td>{{ $dato->cedula }}</td>
                            <td>{{ $dato->nombre }}</td>
                            <td>{{ $dato->apellido }}</td>
                            <td>{{ $dato->estado }}</td>
                            <td>
                                <button data-toggle="modal" data-target="#updateModal" class="btn btn-primary btn-sm" wire:click="edit({{ $dato->id }})">Edit</button>
                                <button wire:click="delete({{ $dato->id }})" class="btn btn-danger btn-sm">Delete</button>
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


