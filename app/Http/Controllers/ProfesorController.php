<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use Illuminate\Http\Request;
use Inertia\Inertia;


class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profesors = Profesor::all();
        return Inertia::render('Profesors/Index',['profesors' => $profesors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Profesors/Create');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['nombre'=>'required']);
        $profesor = new Profesor($request->input());
        $profesor ->save();
        return redirect ('profesors');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profesor $profesor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profesor $profesor)
    {
        return Inertia::render('Profesors/Edit',['profesor' => $profesor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profesor $profesor)
    {
        $request->validate(['nombre'=>'required']);
        $profesor->update($request->all());
        return redirect ('profesors');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profesor $profesor)
    {
        $profesor -> delete();
        return redirect ('profesors');
    }
}
