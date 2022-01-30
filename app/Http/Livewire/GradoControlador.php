<?php

namespace App\Http\Livewire;

use App\Models\Grado;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class GradoControlador extends Component
{

    use WithPagination;

    public $currentPage = 1;

    public $filtro;


    public $grado_id, $grado, $estado;



    protected $rules = [

        'grado' => 'required',
        'estado' => 'required',
    ];

    public function render()
    {

        return view('livewire.grado.index', [
            'datos' => Grado::where(function ($query) {
                $query->where('grado', 'like', '%' . $this->filtro . '%')
                    ->orWhere('estado', 'like', '%' . $this->filtro . '%');
            })->paginate(10)
        ]);
    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }

    private function resetInputFields()
    {
        $this->grado_id = '';
        $this->grado = '';
        $this->estado = "";
    }


    public function store()
    {


        $this->validate(
            [
                'grado' => 'required',
            ]
        );


        Grado::create([
            'grado' => $this->grado,
            'estado' => 'activo',
        ]);

        session()->flash('message', 'Creado con éxito..');

        $this->resetInputFields();

        $this->emit('userStore');
    }


    public function edit($id)
    {
        $data = Grado::findOrFail($id);
        $this->grado_id = $id;
        $this->grado = $data->grado;
        $this->estado = $data->estado;



    }


    public function cancel()
    {

        $this->resetInputFields();
        $this->resetErrorBag();
        $this->resetValidation();

    }


    public function update()
    {
        $this->validate();


        $data = Grado::find($this->grado_id);


        $data->update([
            'grado' => $this->grado,
            'estado' => $this->estado,
        ]);

        session()->flash('message', 'Actualizado con éxito..');

        $this->resetInputFields();

        $this->emit('userStore');
    }


    public function delete($id)
    {
        Grado::find($id)->delete();
        session()->flash('message', 'Eliminado con éxito..');
    }
}
