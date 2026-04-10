<?php

namespace App\Http\Controllers;

use App\Models\CatEspecialidadMedica;
use Illuminate\Http\Request;

class CatEspecialidadMedicaController extends Controller
{
    //
    public function especialidadesMedicasIndex()
    {
        $especialidadesMedicas = CatEspecialidadMedica::all();

        return view('settings.especialidades-medicas.index', compact('especialidadesMedicas'));
    }

    public function especialidadesMedicasCreate()
    {
        return view('settings.especialidades-medicas.create');
    }

    public function especialidadesMedicasStore(Request $request)
    {
        $request->validate([
            'especialidad'=>'required|string|max:255',
        ],[]);

        $especialidadMedica = new CatEspecialidadMedica();

        $especialidadMedica->especialidad = $request->especialidad;

        $especialidadMedica->save();

        return redirect()->route('especialidadesMedicasIndex')->with('success', 'Especialidad Médica registrada exitosamente.');
    }

    public function especialidadesMedicasEdit($id)
    {
        $especialidadMedica = CatEspecialidadMedica::findOrFail($id);

        return view('settings.especialidades-medicas.edit', compact('especialidadMedica'));
    }

    public function especialidadesMedicasUpdate(Request $request, $id)
    {
        $request->validate([
            'especialidad'=>'required|string|max:255',
        ],[]);

        $especialidadMedica = CatEspecialidadMedica::findOrFail($id);

        $especialidadMedica->especialidad = $request->especialidad;

        $especialidadMedica->save();

        return redirect()->route('especialidadesMedicasIndex')->with('success', 'Especialidad Médica actualizada exitosamente.');
    }

    public function especialidadesMedicasDestroy($id)
    {
        $especialidadMedica = CatEspecialidadMedica::findOrFail($id);

        $especialidadMedica->delete();

        return redirect()->route('especialidadesMedicasIndex')->with('success', 'Especialidad Médica eliminada exitosamente.');
    }
}
