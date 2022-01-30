<?php

namespace App\Http\Livewire;

use App\Models\Curso;
use App\Models\Grado;
use App\Models\Paralelo;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;


class CursoControlador extends Component
{


    use WithPagination;

    public $currentPage = 1;

    public $filtro, $grados, $paralelos, $grado, $paralelo, $grado_id, $paralelo_id, $curso_id, $estado;


    public function mount()
    {
        $this->grados = Grado::all();
        $this->paralelos = Paralelo::all();

    }


    public function render()
    {


        $datos = DB::table('cursos')
            ->select('cursos.id', 'grados.grado', 'paralelos.paralelo', 'cursos.estado')
            ->join('grados', 'grados.id', '=', 'cursos.grado_id')
            ->join('paralelos', 'paralelos.id', '=', 'cursos.paralelo_id')
            ->where('cursos.estado', 'like', '%' . $this->filtro . '%')
            ->orWhere('grados.grado', 'like', '%' . $this->filtro . '%')
            ->orWhere('paralelos.paralelo', 'like', '%' . $this->filtro . '%')
            //->get();
            ->paginate(10);

        //$datos =  json_decode( json_encode($datos), true);

        //dump($datos);
        //$datos = json_encode($datos);

        //foreach ($datos as $dato){
        //  echo json_encode($dato);
        //  echo $dato->paralelo;
        //  echo $dato->estado;
        // }


        return view('livewire.curso.index', ['datos' => $datos]);

    }


    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }


    protected $rules = [

        'grado' => 'required',
        'paralelo' => 'required',
        'estado' => 'required',
    ];

    private function resetInputFields()
    {
        $this->curso_id = "";
        $this->grado_id = "";
        $this->paralelo_id = "";
        $this->grado = '';
        $this->paralelo = '';
        $this->estado = "";
    }


    public function store()
    {

        //dump($this->grado);

        //dump($this->paralelo);

        $this->validate(
            [
                'grado' => 'required',
                'paralelo' => 'required',

            ]
        );

        //dd($this->validarCurso());

        if (count($this->validarCurso())> 0) {

            session()->flash('message', 'ya existe este curso..');

        } else {


            Curso::create([
                'grado_id' => $this->grado,
                'paralelo_id' => $this->paralelo,
                'estado' => 'activo',
            ]);

            session()->flash('message', 'Creado con éxito..');

            $this->resetInputFields();

            $this->emit('userStore');
        }
    }


    public function edit($id)
    {
        $data = Curso::findOrFail($id);

        //dump($data);

        $this->curso_id = $id;
        $this->grado = $data->grado_id;
        $this->paralelo = $data->paralelo_id;
        $this->estado = $data->estado;


    }

    public function validarCurso()
    {
        $datos = Curso::where([
            ['grado_id', '=', $this->grado],
            ['paralelo_id', '=', $this->paralelo],
        ])->get();

        return $datos;

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


        if (count($this->validarCurso())> 0) {

            session()->flash('message', 'ya existe este curso..');

        } else {


            $data = Curso::find($this->curso_id);


            $data->update([
                'grado_id' => $this->grado,
                'paralelo_id' => $this->paralelo,
                'estado' => $this->estado,
            ]);

            session()->flash('message', 'Actualizado con éxito..');

            $this->resetInputFields();

            $this->emit('userStore');
        }
    }

    public function delete($id)
    {
        Curso::find($id)->delete();
        session()->flash('message', 'Eliminado con éxito..');
    }

}
