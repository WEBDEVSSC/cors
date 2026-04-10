<?php

namespace App\Http\Controllers;

use App\Models\Afiliacion;
use App\Models\CatAfiliacion;
use Illuminate\Http\Request;

class CatAfiliacionesController extends Controller
{
    //

    public function afiliacionesIndex()
    {
        $afiliaciones = CatAfiliacion::all();

        return view('settings.afiliaciones.index', compact('afiliaciones'));
    }

    public function afiliacionesCreate()
    {
        return view('settings.afiliaciones.create');
    }

    public function afiliacionesStore(Request $request)
    {
        $request->validate([
            'afiliacion' => 'required|string|max:255',
        ],[
            'afiliacion.required' => 'El campo afiliación es obligatorio.',
            'afiliacion.string'   => 'El campo afiliación debe ser un texto válido.',
            'afiliacion.max'      => 'El campo afiliación no debe exceder los 255 caracteres.',
        ]);

        $afiliacion = new CatAfiliacion();

        $afiliacion->afiliacion = $request->afiliacion;

        $afiliacion->save();

        return redirect()->route('afiliacionesIndex')->with('success', 'Afiliación registrada exitosamente.');
    }

    public function afiliacionesEdit($id)
    {
        $afiliacion = CatAfiliacion::findOrFail($id);

        return view('settings.afiliaciones.edit', compact('afiliacion'));
    }

    public function afiliacionesUpdate(Request $request, $id)
    {
        $request->validate([
            'afiliacion' => 'required|string|max:255',
        ],[
            'afiliacion.required' => 'El campo afiliación es obligatorio.',
            'afiliacion.string'   => 'El campo afiliación debe ser un texto válido.',
            'afiliacion.max'      => 'El campo afiliación no debe exceder los 255 caracteres.',
        ]);

        $afiliacion = CatAfiliacion::findOrFail($id);

        $afiliacion->afiliacion = $request->afiliacion;

        $afiliacion->save();

        return redirect()->route('afiliacionesIndex')->with('success', 'Afiliación actualizada exitosamente.');
    }
}
