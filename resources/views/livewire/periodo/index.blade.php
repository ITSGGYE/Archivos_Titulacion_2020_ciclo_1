<div>


    @if(session()->has('message'))
        <script>
            toastr.success('{{session('message')}}');
        </script>
    @endif

    @include('livewire.periodo.create')

    @include('livewire.periodo.update')
    <br/>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <input type="text" wire:model="filtro" class="form-control"/>

                <table class="table table-bordered mt-2">
                    <thead>
                    <tr>
                        <th>periodo</th>
                        <th>fecha inicio</th>
                        <th>fecha final</th>
                        <th>estado</th>

                        <th width="150px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datos as $dato)
                        <tr>
                            <td>{{ $dato->periodo }}</td>
                            <td>{{ $dato->periodoInicio}}</td>
                            <td>{{ $dato->periodoFinal}}</td>
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
