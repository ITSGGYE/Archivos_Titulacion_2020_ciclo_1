<?php

namespace App\Http\Livewire;

use App\Models\Periodo;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class PeriodoControlador extends Component
{

    use WithPagination;

    public $currentPage = 1;

    public $filtro;


    public $periodo_id, $periodo, $periodoInicio, $periodoFinal, $estado;



    protected $rules = [

        'periodo' => 'required',
        'periodoInicio' => 'required',
        'periodoFinal' => 'required',
        'estado' => 'required',
    ];

    public function render()
    {

        return view('livewire.periodo.index', [
            'datos' => Periodo::where(function ($query) {
                $query->where('periodo', 'like', '%' . $this->filtro . '%')
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
        $this->periodo_id = '';
        $this->periodo = '';
        $this->periodoInicio = "";
        $this->periodoFinal = "";
        $this->estado = "";
    }


    public function store()
    {


        $this->validate(
            [
                'periodo' => 'required',
                'periodoInicio' => 'required',
                'periodoFinal' => 'required',
            ]
        );


        Periodo::create([
            'periodo' => $this->periodo,
            'periodoInicio' => $this->periodoInicio,
            'periodoFinal' => $this->periodoFinal,
            'estado' => 'activo',
        ]);

        session()->flash('message', 'Creado con éxito..');

        $this->resetInputFields();

        $this->emit('userStore');
    }


    public function edit($id)
    {
        $data = Periodo::findOrFail($id);
        $this->periodo_id= $id;
        $this->periodo = $data->periodo;
        $this->periodoInicio = $data->periodoInicio;
        $this->periodoFinal = $data->periodoFinal;
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


        $data = Periodo::find($this->periodo_id);


        $data->update([
            'periodo' => $this->periodo,
            'periodoInicio' => $this->periodoInicio,
            'periodoFinal' => $this->periodoFinal,
            'estado' => $this->estado,
        ]);

        session()->flash('message', 'Actualizado con éxito..');

        $this->resetInputFields();

        $this->emit('userStore');
    }


    public function delete($id)
    {
        Periodo::find($id)->delete();
        session()->flash('message', 'Eliminado con éxito..');
    }
}
