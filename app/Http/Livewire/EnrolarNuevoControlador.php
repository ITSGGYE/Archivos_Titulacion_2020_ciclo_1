<?php

namespace App\Http\Livewire;

use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\Matricula;
use App\Models\Periodo;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


class EnrolarNuevoControlador extends Component
{

    use WithFileUploads;

    use WithPagination;

    public $currentPage = 1;


    public $periodos = null;
    public $cursos = null;
    public $estudiante_id = null;
    public $filtro = null;
    public $curso = null;
    public $periodo = null;


    public function mount()
    {

        //dd($this->estudiantes);
        $this->periodos = Periodo::where('estado', 'activo')->get();
        //dd($this->periodos);
        $this->cursos = Curso::all();

    }


    public function render()
    {
        $matricula = Matricula::select('estudiante_id')->distinct()->get();

        $estudiantes_id = [];

        foreach ($matricula as $estudiante) {

            array_push($estudiantes_id, $estudiante->estudiante_id);
        }


        $datos = Estudiante::select('*')
            ->from(Estudiante::whereNotIn('id', $estudiantes_id))
            ->where('estado', 'like', '%' . $this->filtro . '%')
            ->orWhere('cedula', 'like', '%' . $this->filtro . '%')
            ->orWhere('nombre', 'like', '%' . $this->filtro . '%')
            ->orWhere('apellido', 'like', '%' . $this->filtro . '%')
            ->orderBy('apellido', 'asc')
            ->paginate(10);


        return view('livewire.matricula.enrolar-nuevo', ['datos' => $datos]);
    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }


    public function enrolar($id)
    {

        $this->estudiante_id = $id;
    }


    public function store()
    {


        $this->validate(
            [
                'curso' => 'required',
                'periodo' => 'required',

            ]
        );


        Matricula::create([
            'estudiante_id' => $this->estudiante_id,
            'curso_id' => $this->curso,
            'periodo_id' => $this->periodo,
            'matriculado' => 'no',
            'estado' => 'activo',
        ]);

        session()->flash('message', 'Creado con éxito..');

        $this->resetInputFields();

        $this->emit('userStore');
    }

    private function resetInputFields()
    {
        $this->curso = null;
        $this->periodo = null;
        $this->estudiante_id = null;
        $this->estado = null;
    }


    public function cancel()
    {

        $this->resetInputFields();
        $this->resetErrorBag();
        $this->resetValidation();

    }

}
