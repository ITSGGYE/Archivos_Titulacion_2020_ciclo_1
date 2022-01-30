<div align="right">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">Crear</button>
</div>


<div wire:ignore.self id="createModal" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Agregar Datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="container">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="grado">grado:</label>
                                    <input type="text" class="form-control" id="grado"
                                           placeholder="grado"
                                           wire:model="grado">
                                    @error('grado') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <br/>
                        <br/>

                        <button wire:click.prevent="store()" class="btn btn-success">guardar</button>
                        <button wire:click.prevent="cancel()" type="button" class="btn btn-secondary close-btn"
                                data-dismiss="modal">Cerrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

