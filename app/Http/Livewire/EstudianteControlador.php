<?php

namespace App\Http\Livewire;

use App\Models\Estudiante;
use App\Models\Representante;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


class EstudianteControlador extends Component
{


    use WithFileUploads;

    use WithPagination;

    public $currentPage = 1;

    public $filtro= null;


    public $cedulaCorrecta = true;
    public $editar = false;


    public $representante;
    public $representante_id;
    public $representantes;
    public $usuarios;
    public $picked;


    public $estudiante_id = null, $cedula = null, $foto = null, $fotoNueva = null, $imagen = null, $esBecario = null, $porcentajeBeca = null,
        $nombre = null, $apellido = null, $correo = null, $telefono = null, $direccion = null,
        $fechaNacimiento = null, $genero = null, $estado = null;


    public function mount()
    {
        $this->representantes = [];
        $this->usuarios = [];
        $this->picked = true;

    }

    public function agregarRepresentante()
    {


        $dato = Representante::find($this->representante_id);

        if ($dato){

            array_push($this->representantes,$dato );

            $this->representante = null;
            $this->resetErrorBag('representante');
            $this->resetValidation('representante');
            $this->representante_id = null;
        }else{
            session()->flash('message', 'seleccione un representante..');

        }



    }


    public function eliminarRepresentante($index)
    {

        unset($this->representantes[$index]);

    }


    public function updatedRepresentante()
    {
        $this->picked = false;


        //$prueba4 = [];

        //$prueba2 = new Representante();

        //$prueba2->fill(['nombre'=>'gggggg']);

        //array_push($prueba4,$prueba2);
        // array_push($prueba4,$prueba2);
        //array_push($prueba4,$prueba2);

        //dd($this->addRepresentante);


        $valido = $this->validate([
            "representante" => "min:2"
        ]);

        if ($this->representante == "") {
            $this->picked = true;

        }


        if (!$this->representante == "") {
            if ($valido) {

                $this->usuarios = Representante::where(function ($query) {
                    $query->where('cedula', 'like', '%' . $this->representante . '%')
                        ->orWhere('nombre', 'like', '%' . $this->representante . '%')
                        ->orWhere('apellido', 'like', '%' . $this->representante . '%');
                })->get();

            }
        }


    }


    public function asignarUsuario($nombre, $id)
    {
        $this->representante = $nombre;

        $this->representante_id = $id;

        $this->picked = true;
    }


    //protected $listeners = [
    //  'refreshParent' => '$refresh'
    //];


    protected $rules = [

        'cedula' => 'required|max:10',
        'nombre' => 'required',
        'apellido' => 'required',
        'correo' => 'required|email',
        'telefono' => 'required',
        'direccion' => 'required',
        'fechaNacimiento' => 'required|before:today',
        'genero' => 'required',
        //'foto' => 'required|image|max:2048',
        'estado' => 'required',
        'esBecario' => 'required',


    ];

    public function updatedFoto()
    {
        $this->validate([
            'foto' => 'image|max:2048'// 2MB Max
        ]);
    }


    public function updatedCedula()
    {

        $datos = Estudiante::where('cedula', '=', $this->cedula)->get();


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

        $datos = Estudiante::where(function ($query) {
            $query->where('cedula', 'like', '%' . $this->filtro . '%')
                ->orWhere('nombre', 'like', '%' . $this->filtro . '%')
                ->orWhere('apellido', 'like', '%' . $this->filtro . '%');
        })->orderBy('apellido', 'asc')->paginate(10);

        return view('livewire.estudiante.index', ['datos' => $datos]);
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

        $this->estudiante_id = null;
        $this->cedula = null;
        $this->nombre = null;
        $this->apellido = null;
        $this->correo = null;
        $this->telefono = null;
        $this->direccion = null;
        $this->fechaNacimiento = null;
        $this->genero = null;
        $this->foto = null;
        $this->fotoNueva = null;
        $this->estado = null;
        $this->esBecario = null;
        $this->porcentajeBeca = null;
        $this->representante = null;
        $this->representante_id = null;
        $this->representantes = [];


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
                //'foto' => 'required|image|max:2048',
                'esBecario' => 'required',


            ]);


            if ($this->foto) {
                $this->imagen = $this->foto->store('uploads', 'public');
            }


            $objeto = Estudiante::create([
                'cedula' => $this->cedula,
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'correo' => $this->correo,
                'telefono' => $this->telefono,
                'direccion' => $this->direccion,
                'fechaNacimiento' => $this->fechaNacimiento,
                'genero' => $this->genero,
                'foto' => $this->imagen,
                'estado' => 'activo',
                'esBecario' => $this->esBecario,
                'porcentajeBeca' => $this->porcentajeBeca,
            ]);

            foreach ($this->representantes as $dato) {

                //attach  detach sync
                $objeto->representantes()->attach($dato['id']);

            }

            session()->flash('message', 'Creado con éxito..');

            $this->resetInputFields();
            $this->dispatchBrowserEvent('limpiarFoto', []);

            $this->emit('userStore');
        }
    }


    public function edit($id)
    {

        $this->editar = true;


        $data = Estudiante::findOrFail($id);
        $this->estudiante_id = $id;
        $this->cedula = $data->cedula;
        $this->nombre = $data->nombre;
        $this->apellido = $data->apellido;
        $this->correo = $data->correo;
        $this->telefono = $data->telefono;
        $this->direccion = $data->direccion;
        $this->fechaNacimiento = $data->fechaNacimiento;
        $this->genero = $data->genero;
        $this->foto = $data->foto;
        $this->estado = $data->estado;
        $this->esBecario = $data->esBecario;
        $this->porcentajeBeca = $data->porcentajeBeca;


        foreach ($data->representantes as $row) {
            array_push($this->representantes, $row);
        }



    }

    //public function hydrate()
    //{
    // $this->resetErrorBag();
    // $this->resetValidation();
    // $this->reset();
    //}


    public function cancel()
    {

        $this->editar = false;
        $this->resetInputFields();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('limpiarFoto', []);
        $this->dispatchBrowserEvent('limpiarFoto2', []);


    }

    public function eliminarFoto1()
    {
        $this->reset('foto');
        $this->dispatchBrowserEvent('limpiarFoto', []);
    }

    public function eliminarFoto2()
    {
        $this->reset('fotoNueva');
        $this->dispatchBrowserEvent('limpiarFoto2', []);
    }


    public function update()
    {
        $this->validate();


        $data = Estudiante::find($this->estudiante_id);


        if ($this->fotoNueva) {
            Storage::delete('public/' . $data->foto);
            $this->imagen = $this->fotoNueva->store('uploads', 'public');
        }

        if (!$this->foto) {
            Storage::delete('public/' . $data->foto);
            $data->foto = null;
        }

        $data->update([
            'cedula' => $this->cedula,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'correo' => $this->correo,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'fechaNacimiento' => $this->fechaNacimiento,
            'genero' => $this->genero,
            'foto' => $this->fotoNueva ? $this->imagen : $data->foto,
            'estado' => $this->estado,
            'esBecario' => $this->esBecario,
            'porcentajeBeca' => $this->porcentajeBeca,
        ]);


        $data->representantes()->detach();

        foreach ($this->representantes as $dato) {

            //attach  detach sync
            $data->representantes()->attach($dato['id']);

        }


        session()->flash('message', 'Actualizado con éxito..');

        $this->resetInputFields();
        $this->dispatchBrowserEvent('limpiarFoto2', []);
        $this->emit('userStore');

        $this->editar = false;


    }


    public function delete($id)
    {
        $data = Estudiante::find($id);
        $data->delete();
        Storage::delete('public/' . $data->foto);
        $data->representantes()->detach();




        session()->flash('message', 'Eliminado con éxito..');

    }


}
