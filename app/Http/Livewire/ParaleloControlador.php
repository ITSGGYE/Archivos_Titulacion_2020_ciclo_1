<?php

namespace App\Http\Livewire;

use App\Models\Paralelo;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class ParaleloControlador extends Component
{
    use WithPagination;

    public $currentPage = 1;

    public $filtro;


    public $paralelo_id, $paralelo, $estado;



    protected $rules = [

        'paralelo' => 'required',
        'estado' => 'required',
    ];

    public function render()
    {

        return view('livewire.paralelo.index', [
            'datos' => Paralelo::where(function ($query) {
                $query->where('paralelo', 'like', '%' . $this->filtro . '%')
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
        $this->paralelo_id = '';
        $this->paralelo = '';
        $this->estado = "";
    }


    public function store()
    {


        $this->validate(
            [
                'paralelo' => 'required',
            ]
        );


        Paralelo::create([
            'paralelo' => $this->paralelo,
            'estado' => 'activo',
        ]);

        session()->flash('message', 'Creado con éxito..');

        $this->resetInputFields();

        $this->emit('userStore');
    }


    public function edit($id)
    {
        $data = Paralelo::findOrFail($id);
        $this->paralelo_id = $id;
        $this->paralelo = $data->paralelo;
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


        $data = Paralelo::find($this->paralelo_id);


        $data->update([
            'paralelo' => $this->paralelo,
            'estado' => $this->estado,
        ]);

        session()->flash('message', 'Actualizado con éxito..');

        $this->resetInputFields();

        $this->emit('userStore');
    }


    public function delete($id)
    {
        Paralelo::find($id)->delete();
        session()->flash('message', 'Eliminado con éxito..');
    }
}
