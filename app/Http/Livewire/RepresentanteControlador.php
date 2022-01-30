<?php

namespace App\Http\Livewire;

use App\Models\Representante;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;

class RepresentanteControlador extends Component
{


    use WithPagination;

    public $currentPage = 1;

    public $filtro;

    public $cedulaCorrecta = true;


    public $representante_id, $cedula,
        $nombre, $apellido, $correo, $telefono, $direccion,
        $fechaNacimiento, $genero, $esRepresentanteLegal,
        $tipoRepresentante, $estado;


    protected $rules = [

        'cedula' => 'required|max:10',
        'nombre' => 'required',
        'apellido' => 'required',
        'correo' => 'required|email',
        'telefono' => 'required',
        'direccion' => 'required',
        'fechaNacimiento' => 'required|before:today',
        'genero' => 'required',
        'esRepresentanteLegal' => 'required',
        'tipoRepresentante' => 'required',
        'estado' => 'required',


    ];


    public function updatedCedula()
    {
        $datos = Representante::where('cedula', '=', $this->cedula)->get();


        if (!$datos->isEmpty()) {

            $this->addError('cedula', 'la cedula debe ser unica');
            $this->cedulaCorrecta = false;

        } else {
            $this->resetErrorBag('cedula');
            $this->cedulaCorrecta = true;
        }


    }


    public function render()
    {

        return view('livewire.representante.index', [
            'datos' => Representante::where(function ($query) {
                $query->where('cedula', 'like', '%' . $this->filtro . '%')
                    ->orWhere('nombre', 'like', '%' . $this->filtro . '%')
                    ->orWhere('apellido', 'like', '%' . $this->filtro . '%')
                    ->orWhere('estado', 'like', '%' . $this->filtro . '%');
            })->orderBy('apellido', 'asc')->paginate(10)
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

        $this->representante_id = '';
        $this->cedula = '';
        $this->nombre = '';
        $this->apellido = '';
        $this->correo = '';
        $this->telefono = '';
        $this->direccion = '';
        $this->fechaNacimiento = '';
        $this->genero = '';
        $this->esRepresentanteLegal = '';
        $this->tipoRepresentante = '';
        $this->estado = "";


    }


    public function store()
    {
        if ($this->cedulaCorrecta) {

            $this->validate([
                'cedula' => 'required|max:10',
                'nombre' => 'required',
                'apellido' => 'required',
                'correo' => 'required|email',
                'telefono' => 'required',
                'direccion' => 'required',
                'fechaNacimiento' => 'required|before:today',
                'genero' => 'required',
                'esRepresentanteLegal' => 'required',
                'tipoRepresentante' => 'required',
            ]);


            Representante::create([
                'cedula' => $this->cedula,
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'correo' => $this->correo,
                'telefono' => $this->telefono,
                'direccion' => $this->direccion,
                'fechaNacimiento' => $this->fechaNacimiento,
                'genero' => $this->genero,
                'esRepresentanteLegal' => $this->esRepresentanteLegal,
                'tipoRepresentante' => $this->tipoRepresentante,
                'estado' => 'activo',
            ]);

            session()->flash('message', 'Creado con éxito..');

            $this->resetInputFields();

            $this->emit('userStore');
        }
    }


    public function edit($id)
    {
        $data = Representante::findOrFail($id);
        $this->representante_id = $id;
        $this->cedula = $data->cedula;
        $this->nombre = $data->nombre;
        $this->apellido = $data->apellido;
        $this->correo = $data->correo;
        $this->telefono = $data->telefono;
        $this->direccion = $data->direccion;
        $this->fechaNacimiento = $data->fechaNacimiento;
        $this->genero = $data->genero;
        $this->esRepresentanteLegal = $data->esRepresentanteLegal;
        $this->tipoRepresentante = $data->tipoRepresentante;
        $this->estado = $data->estado;

    }


    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
        $this->resetErrorBag();
        $this->resetValidation();


    }


    public function update()
    {
        $this->validate();


        $data = Representante::find($this->representante_id);


        $data->update([
            'cedula' => $this->cedula,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'correo' => $this->correo,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'fechaNacimiento' => $this->fechaNacimiento,
            'genero' => $this->genero,
            'esRepresentanteLegal' => $this->esRepresentanteLegal,
            'tipoRepresentante' => $this->tipoRepresentante,
            'estado' => $this->estado,
        ]);


        session()->flash('message', 'Actualizado con éxito..');

        $this->resetInputFields();

        $this->emit('userStore');
    }


    public function delete($id)
    {
        Representante::find($id)->delete();
        session()->flash('message', 'Eliminado con éxito..');
    }
}
