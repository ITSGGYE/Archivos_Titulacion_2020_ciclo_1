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
use stdClass;

class EnrolarControlador extends Component
{


    use WithFileUploads;

    use WithPagination;

    public $currentPage = 1;


    public $periodos = null;
    public $cursos = null;
    public $filtro = null;
    public $curso = null;
    public $periodo = null;
    public $datos = null;
    public $lista = null;
    public $foo = [];


    public $periodos2 = null;
    public $cursos2 = null;
    public $curso2 = null;
    public $periodo2 = null;
    public $datos2 = null;
    public $lista2 = null;
    public $foo2 = [];


    public function mount()
    {

        $this->lista = [];
        $this->datos = [];

        $this->cursos = Curso::all();
        $this->foo = [];


        $this->lista2 = [];
        $this->datos2 = [];
        $this->periodos2 = Periodo::latest('periodoInicio')->where('estado', '=', 'activo')->first();
        $this->periodos = Periodo::where('periodoInicio', '<', $this->periodos2->periodoInicio)->get();
        $this->cursos2 = Curso::all();
        //$this->foo2=[];


    }


    public function render()
    {
        return view('livewire.matricula.enrolar');
    }


    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }


    public function updatedCurso()
    {
        $this->buscar1();
    }

    public function updatedCurso2()
    {
        $this->buscar2();
    }

    public function updatedperiodo()
    {
        $this->buscar1();
    }

    public function updatedperiodo2()
    {
        $this->buscar2();
    }


    public function buscar1()
    {

        $this->lista = [];

        $matriculas = Matricula::where([
            ['curso_id', '=', $this->curso],
            ['periodo_id', '=', $this->periodo]
        ])->get();

        foreach ($matriculas as $matricula) {
            array_push($this->lista, $matricula->estudiante_id);
        }

        $this->datos = Estudiante::from(Estudiante::whereIn('id', $this->lista))->orderBy('apellido', 'asc')->get();


    }


    public function buscar2()
    {

        $this->lista2 = [];

        $matriculas = Matricula::where([
            ['curso_id', '=', $this->curso2],
            ['periodo_id', '=', $this->periodo2]
        ])->get();

        foreach ($matriculas as $matricula) {
            array_push($this->lista2, $matricula->estudiante_id);
        }

        $this->datos2 = Estudiante::from(Estudiante::whereIn('id', $this->lista2))->orderBy('apellido', 'asc')->get();


    }

    public function agregar()
    {

        $datos = Estudiante::from(Estudiante::whereIn('id', $this->foo))->get();


        if ($this->periodo2 != null and $this->curso2 != null) {

            foreach ($datos as $key => $value) {


                $m = Matricula::where([
                    ['estudiante_id', '=', $value->id],
                    ['periodo_id', '=', $this->periodos2->id]
                ])->get();


                if (count($m) > 0) {

                    session()->flash('message', 'el estudiante:' . $value->nombre . "  " . $value->apellido . "  esta enrolado en el mismo periodo");


                } elseif ($this->datos2->contains('id', $value->id)) {

                    session()->flash('message', 'el estudiante:' . $value->nombre . "  " . $value->apellido . "  esta en la lista");

                } else {
                    array_push($this->lista2, $value->id);

                    $this->datos2->push($value);
                    $this->datos->pull($key);
                    $this->foo = [];
                    //$this->foo2 = [];
                }
            }

        }

    }


    public function guardar()
    {


        if (count($this->datos2) > 0) {
            foreach ($this->datos2 as $d) {

                $m = Matricula::where([
                    ['estudiante_id', '=', $d->id],
                    ['periodo_id', '=', $this->periodos2->id]
                ])->get();

                if (count($m) == 0) {

                    Matricula::create([
                        'estudiante_id' => $d->id,
                        'curso_id' => $this->curso2,
                        'periodo_id' => $this->periodo2,
                        'matriculado' => 'no',
                        'estado' => 'activo',
                    ]);

                }

            }


            session()->flash('message', 'Creado con éxito..');

            $this->resetInputFields();

        }
    }


    private function resetInputFields()
    {


        $this->curso = null;
        $this->periodo = null;
        $this->datos = [];
        $this->lista = [];
        $this->foo = [];

        $this->curso2 = null;
        $this->periodo2 = null;
        $this->datos2 = [];
        $this->lista2 = [];


    }

    public function cancel()
    {

        $this->resetInputFields();
        $this->resetErrorBag();
        $this->resetValidation();

    }


}
