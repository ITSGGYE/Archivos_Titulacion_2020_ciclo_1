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

                            <div class="col-4">
                                <div class="form-group">
                                    <label>grado</label>
                                    <select
                                        wire:model="grado"
                                        class="form-control">
                                        <option value="">-- --</option>
                                        @foreach ($grados as $grado)
                                            <option value="{{ $grado->id }}">
                                                {{ $grado->grado }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('grado') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label>paralelo</label>
                                    <select
                                        wire:model="paralelo"
                                        class="form-control">
                                        <option value="">-- --</option>
                                        @foreach ($paralelos as $paralelo)
                                            <option value="{{ $paralelo->id }}">
                                                {{ $paralelo->paralelo }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('paralelo') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>


                            <div class="col-4">
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
