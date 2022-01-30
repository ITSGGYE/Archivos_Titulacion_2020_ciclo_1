<form>
    <input type="hidden" wire:model="post_id">
    <div class="form-group">
        <label for="exampleFormControlInput1">cedula:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="cedula" wire:model="cedula">
        @error('cedula') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">Body:</label>
        <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="nombre"  wire:model="nombre">
        @error('cedula') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <button wire:click.prevent="update()" class="btn btn-dark">Update</button>
    <button wire:click.prevent="cancel()" class="btn btn-danger">Cancel</button>
</form>
