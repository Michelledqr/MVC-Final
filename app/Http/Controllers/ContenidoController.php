<?php

namespace App\Http\Controllers;

use Iluminate\Support\Facades\Log;
use App\Models\Contenido;
use Illuminate\Http\Request;
use App\Models\Materia;
use App\Models\Profesor;
use App\Models\Programa;
use Inertia\Inertia;
use DB;



class ContenidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contenidos = DB::select( 'SELECT contenidos.id, idprograma, semestre, idmateria, idprofesor, idmateriapre, programas.nombre as programa,
        c1.nombre as materia, c1.creditos as creditos, c1.horasguia as horasguia, c1.horasauto as horasauto, 
        c2.nombre as materiapre, profesors.nombre as profesor from contenidos
         
        LEFT JOIN programas on idprograma = programas.id 
        LEFT JOIN materias c1 on idmateria = c1.id
        LEFT JOIN materias c2 on idmateriapre = c2.id 
        LEFT JOIN profesors on idprofesor = profesors.id;');

        $programas=Programa::all();
        $materias=Materia::all();
        $profesors=Profesor::all();
        
        return Inertia::render('Contenidos/Index', ['contenidos' => $contenidos,
        'programas'=>$programas, 'materias'=>$materias, 'profesors'=>$profesors]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'idprograma' => 'required|numeric',
            'semestre' => 'required|numeric',
            'idmateria' => 'required|numeric',
            'idprofesor' => 'required|numeric',
            'idmateriapre' => 'numeric'
        ]);
        
        $contenido = new Contenido($request->input());
        $contenido->save();
        return redirect('contenidos');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contenido $contenido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contenido $contenido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contenido $contenido)
    {
        $request -> validate([
            'idprograma' => 'required|numeric',
            'semestre' => 'required|numeric',
            'idmateria' => 'required|numeric',
            'idprofesor' => 'required|numeric',
            'idmateriapre' => 'numeric'
        ]);
        $contenido->update($request->input());
        return redirect('contenidos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contenido $contenido)
    {
        $contenido->delete();
        return redirect('contenidos');
    }
}
