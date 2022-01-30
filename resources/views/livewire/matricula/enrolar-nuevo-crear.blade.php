
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
                            <div class="col-4">
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

                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>


                        </div>


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

