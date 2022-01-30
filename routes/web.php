<?php

use Barryvdh\DomPDF\Facade as PDF;

//use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
    //ini_set('max_execution_time', 300); //300 seconds = 5 minutes

    //$pdf = PDF::loadView('pdf.prueba', ['datos' => $datos]);
    //return $pdf->download('invoice.pdf');
    //return $pdf->stream();

})->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('reporte/{id}', function ($id) {

    ini_set('max_execution_time', 300); //300 seconds = 5 minutes

    $foo = [];

    $dato1 = \App\Models\Estudiante::findOrFail($id);

    $matricula = \App\Models\EstudianteRepresentante::where('estudiante_id', '=', $id)->get();
    foreach ($matricula as $m) {
        array_push($foo, $m->representante_id);
    }
    $datos2 = \App\Models\Representante::whereIn('id', $foo)->get();


    $pdf = PDF::loadView('pdf.prueba', ['dato1' => $dato1, 'datos2' => $datos2]);

    return $pdf->stream();

})->name('reporteEstudiante')->middleware('auth');


Route::get('reporteMatricula/{id}', function ($id) {

    ini_set('max_execution_time', 300); //300 seconds = 5 minutes

    $dato = \App\Models\Matricula::findOrFail($id);

    $pdf = PDF::loadView('pdf.prueba2', ['dato' => $dato]);

    return $pdf->stream();

})->name('reporteMatricula')->middleware('auth');


Route::get('curso/{curso}/periodo/{periodo}', function ($curso_id, $periodo_id) {

    ini_set('max_execution_time', 300); //300 seconds = 5 minutes

    $datos = \App\Models\Matricula::where([
        ['curso_id', '=', $curso_id],
        ['periodo_id', '=', $periodo_id],
    ])->get();

    $periodo = \App\Models\Periodo::find($periodo_id);
    $curso = \App\Models\Curso::find($curso_id);


    $pdf = PDF::loadView('pdf.prueba3', ['datos' => $datos, 'curso' => $curso, 'periodo' => $periodo]);

    return $pdf->stream();

})->name('reporteGeneral')->middleware('auth');


Route::get('estudiante', function () {
    return view('estudiante');
})->middleware('auth');

Route::get('representante', function () {
    return view('representante');
})->middleware('auth');

Route::get('curso', function () {
    return view('curso');
})->middleware('auth');

Route::get('grado', function () {
    return view('grado');
})->middleware('auth');

Route::get('paralelo', function () {
    return view('paralelo');
})->middleware('auth');

Route::get('periodo', function () {
    return view('periodo');
})->middleware('auth');

Route::get('matricula', function () {
    return view('matricula');
})->middleware('auth');

Route::get('enrolar', function () {
    return view('enrolar');
})->middleware('auth');

Route::get('enrolar-nuevo', function () {
    return view('enrolar-nuevo');
})->middleware('auth');

Route::get('reporte', function () {
    return view('reporte');
})->middleware('auth');


