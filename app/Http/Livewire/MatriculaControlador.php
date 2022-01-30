<?php

namespace App\Http\Livewire;

use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\Matricula;
use App\Models\Periodo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MatriculaControlador extends Component
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
    public $estado = null;
    public $matricula_id = null;


    public function mount()
    {

        $this->estudiante_id = [];
        //dd($this->estudiantes);
        $this->periodos = Periodo::where('estado', 'activo')->get();
        //dd($this->periodos);
        $this->cursos = Curso::all();

    }


    public function updatedCurso()
    {
        $this->buscar();
    }


    public function updatedperiodo()
    {
        $this->buscar();
    }





    public function render()
    {


        //$datos = Estudiante::select('*')
          //  ->from(Estudiante::whereIn('id', $this->estudiante_id))
          //  ->where('estado', 'like', '%' . $this->filtro . '%')
          //  ->orWhere('nombre', 'like', '%' . $this->filtro . '%')
          //  ->orWhere('apellido', 'like', '%' . $this->filtro . '%')
          //  ->paginate(10);


        $datos1 = DB::table('estudiantes')->join('matriculas', function ($query) {

            $query
                ->on('matriculas.estudiante_id', '=', 'estudiantes.id')
                ->where(function ($subquery) {
                    $subquery
                        //->where('estudiantes.estado', 'like', '%' . $this->filtro . '%')
                        ->Where('estudiantes.cedula', 'like', '%' . $this->filtro . '%')
                        ->orWhere('estudiantes.nombre', 'like', '%' . $this->filtro . '%')
                        ->orWhere('estudiantes.apellido', 'like', '%' . $this->filtro . '%');
                });

        })
            ->whereIn('estudiantes.id', $this->estudiante_id)
            ->where('matriculas.periodo_id',$this->periodo)
            ->select('estudiantes.id','estudiantes.foto','estudiantes.cedula','estudiantes.nombre','estudiantes.apellido','estudiantes.fechaNacimiento','estudiantes.genero','matriculas.id','matriculas.estudiante_id','matriculas.matriculado','matriculas.curso_id','matriculas.periodo_id','matriculas.estado')
            ->orderBy('estudiantes.apellido', 'asc')
            ->paginate(10);



        return view('livewire.matricula.matricula', ['datos' => $datos1,'lista'=>$this->estudiante_id]);
    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }

    public function buscar()
    {

        $this->estudiante_id = [];

        $matriculas = Matricula::where([
            ['curso_id', '=', $this->curso],
            ['periodo_id', '=', $this->periodo]
        ])->get();

        foreach ($matriculas as $matricula) {
            array_push($this->estudiante_id, $matricula->estudiante_id);
        }


    }

    public function matricular($id){
        $dato = Matricula::findOrFail($id);

        $dato->update([
           'matriculado' => 'si',
        ]);

        session()->flash('message', 'matriculado con éxito..');


    }

    public function edit($id)
    {
        $data = Matricula::findOrFail($id);
        $this->matricula_id = $id;
        $this->curso = $data->curso_id;
        $this->estado = $data->estado;



    }

    public function update(){

        $data = Matricula::findOrFail($this->matricula_id);

        $data->update([
            'curso_id' => $this->curso,
            'estado' => $this->estado,
        ]);



        $this->emit('userStore');

        $this->resetInputFields();

        session()->flash('message', 'Editado con éxito..');



    }

    public function cancel()
    {

        //$this->resetInputFields();
        $this->resetErrorBag();
        $this->resetValidation();

    }

    private function resetInputFields()
    {

        $this->curso = "";
        $this->periodo = "";
        $this->estado = "";
        $this->matricula_id = "";
    }


}
