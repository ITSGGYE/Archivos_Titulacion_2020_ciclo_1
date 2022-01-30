<?php

namespace App\Http\Livewire;

use App\Models\Curso;
use App\Models\Matricula;
use App\Models\Periodo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use function PHPUnit\Framework\isEmpty;

class ReporteControlador extends Component
{
    use WithPagination;

    public $currentPage = 1;


    public $periodos = null;
    public $cursos = null;
    public $estudiante_id = null;

    public $imprimir = null;

    public $curso = null;
    public $periodo = null;


    public function mount()
    {

        $this->estudiante_id = [];
        $this->periodos = Periodo::all();
        $this->cursos = Curso::all();


    }

    public function render()
    {
        $datos1 = DB::table('estudiantes')->join('matriculas', function ($query) {

            $query
                ->on('matriculas.estudiante_id', '=', 'estudiantes.id');
        })
            ->whereIn('estudiantes.id', $this->estudiante_id)
            ->where('matriculas.periodo_id', $this->periodo)
            ->select('estudiantes.id','estudiantes.foto','estudiantes.cedula','estudiantes.nombre','estudiantes.apellido','estudiantes.fechaNacimiento','estudiantes.genero','matriculas.id','matriculas.estudiante_id','matriculas.matriculado','matriculas.curso_id','matriculas.periodo_id','matriculas.estado')
            ->orderBy('estudiantes.apellido', 'asc')
            ->paginate(10);


        return view('livewire.reporte.reporte', ['datos' => $datos1, 'lista' => $this->estudiante_id, 'curso1'=>$this->curso,'periodo1'=>$this->periodo]);
    }

    public function updatedCurso()
    {
        $this->buscar();
    }


    public function updatedperiodo()
    {
        $this->buscar();
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

        if (count($matriculas)>0){
            $this->imprimir = true;
        }else{
            $this->imprimir = false;
        }


        foreach ($matriculas as $matricula) {
            array_push($this->estudiante_id, $matricula->estudiante_id);
        }


    }

}
