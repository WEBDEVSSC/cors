<?php

namespace App\Http\Controllers;

use App\Models\CatEspecialidadMedica;
use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    //
    public function medicosShow($id)
    {
        $medico = Medico::findOrFail($id);
    
        return view('settings.medicos.show', compact('medico'));
    }

    public function medicosIndex()
    {
        $medicos = Medico::all();
    
        return view('settings.medicos.index', compact('medicos'));
    }

    public function medicosCreate()
    {
        $especialidadesMedicas = CatEspecialidadMedica::all();

        return view('settings.medicos.create', compact('especialidadesMedicas'));
    }

    public function medicosStore(Request $request)
    {
        // Logic for storing a new médico
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'cedula' => 'required|string|unique:medicos,cedula',
            'correo' => 'required|email|unique:medicos,correo',
            'celular' => 'required|string|max:20',
            'especialidad' => 'required|string|max:255',
            
            'entrada_lunes' => 'nullable|date_format:H:i',
            'salida_lunes' => 'nullable|date_format:H:i',

            'entrada_martes' => 'nullable|date_format:H:i',
            'salida_martes' => 'nullable|date_format:H:i',

            'entrada_miercoles' => 'nullable|date_format:H:i',
            'salida_miercoles' => 'nullable|date_format:H:i',

            'entrada_jueves' => 'nullable|date_format:H:i',
            'salida_jueves' => 'nullable|date_format:H:i',

            'entrada_viernes' => 'nullable|date_format:H:i',
            'salida_viernes' => 'nullable|date_format:H:i',
        ],[
            'nombre.required' => 'El campo nombre es obligatorio.',
            'apellido_paterno.required' => 'El campo apellido paterno es obligatorio.',
            'apellido_materno.required' => 'El campo apellido materno es obligatorio.',
            'cedula.required' => 'El campo cédula es obligatorio.',
            'cedula.unique' => 'La cédula ya está en uso.',
            'correo.required' => 'El campo correo es obligatorio.',
            'correo.email' => 'El campo correo debe ser una dirección de correo válida.',
            'correo.unique' => 'El correo ya está en uso.',
            'celular.required' => 'El campo celular es obligatorio.',
            'especialidad.required' => 'El campo especialidad es obligatorio.',
            'entrada_lunes.date_format' => 'El campo entrada lunes debe tener el formato HH:mm.',
            'salida_lunes.date_format' => 'El campo salida lunes debe tener el formato HH:mm.',
            'entrada_martes.date_format' => 'El campo entrada martes debe tener el formato HH:mm.',
            'salida_martes.date_format' => 'El campo salida martes debe tener el formato HH:mm.',
            'entrada_miercoles.date_format' => 'El campo entrada miércoles debe tener el formato HH:mm.',
            'salida_miercoles.date_format' => 'El campo salida miércoles debe tener el formato HH:mm.',
            'entrada_jueves.date_format' => 'El campo entrada jueves debe tener el formato HH:mm.',
            'salida_jueves.date_format' => 'El campo salida jueves debe tener el formato HH:mm.',
            'entrada_viernes.date_format' => 'El campo entrada viernes debe tener el formato HH:mm.',
            'salida_viernes.date_format' => 'El campo salida viernes debe tener el formato HH:mm.',
        ]);

        $medico = new Medico();

        $medico->nombre = $request->nombre;
        $medico->apellido_paterno = $request->apellido_paterno;
        $medico->apellido_materno = $request->apellido_materno;
        $medico->cedula = $request->cedula;
        $medico->correo = $request->correo;
        $medico->celular = $request->celular;
        $medico->especialidad = $request->especialidad;

        $medico->lunes_entrada = $request->entrada_lunes;
        $medico->lunes_salida = $request->salida_lunes;
        $medico->martes_entrada = $request->entrada_martes;
        $medico->martes_salida = $request->salida_martes;
        $medico->miercoles_entrada = $request->entrada_miercoles;
        $medico->miercoles_salida = $request->salida_miercoles;
        $medico->jueves_entrada = $request->entrada_jueves;
        $medico->jueves_salida = $request->salida_jueves;
        $medico->viernes_entrada = $request->entrada_viernes;
        $medico->viernes_salida = $request->salida_viernes;

        $medico->save();

        return redirect()->route('medicosIndex')->with('success', 'Médico creado exitosamente.');
    }

    public function medicosEdit($id)
    {
        $medico = Medico::findOrFail($id);

        return view('settings.medicos.edit', compact('medico'));
    }

    public function medicosUpdate(Request $request, $id)
    {
        // Logic for storing a new médico
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'cedula' => 'required|string|unique:medicos,cedula,'.$id,
            'correo' => 'required|email|unique:medicos,correo,'.$id,
            'celular' => 'required|string|max:20',
            'especialidad' => 'required|string|max:255',

            'lunes_entrada' => 'nullable|date_format:H:i',
            'lunes_salida' => 'nullable|date_format:H:i',

            'martes_entrada' => 'nullable|date_format:H:i',
            'martes_salida' => 'nullable|date_format:H:i',

            'miercoles_entrada' => 'nullable|date_format:H:i',
            'miercoles_salida' => 'nullable|date_format:H:i',

            'jueves_entrada' => 'nullable|date_format:H:i',
            'jueves_salida' => 'nullable|date_format:H:i',

            'viernes_entrada' => 'nullable|date_format:H:i',
            'viernes_salida' => 'nullable|date_format:H:i',
        ],[
            'nombre.required' => 'El campo nombre es obligatorio.',
            'apellido_paterno.required' => 'El campo apellido paterno es obligatorio.',
            'apellido_materno.required' => 'El campo apellido materno es obligatorio.',
            'cedula.required' => 'El campo cédula es obligatorio.',
            'cedula.unique' => 'La cédula ya está en uso.',
            'correo.required' => 'El campo correo es obligatorio.',
            'correo.email' => 'El campo correo debe ser una dirección de correo válida.',
            'correo.unique' => 'El correo ya está en uso.',
            'celular.required' => 'El campo celular es obligatorio.',
            'especialidad.required' => 'El campo especialidad es obligatorio.',
            'entrada_lunes.date_format' => 'El campo entrada lunes debe tener el formato HH:mm.',
            'salida_lunes.date_format' => 'El campo salida lunes debe tener el formato HH:mm.',
            'entrada_martes.date_format' => 'El campo entrada martes debe tener el formato HH:mm.',
            'salida_martes.date_format' => 'El campo salida martes debe tener el formato HH:mm.',
            'entrada_miercoles.date_format' => 'El campo entrada miércoles debe tener el formato HH:mm.',
            'salida_miercoles.date_format' => 'El campo salida miércoles debe tener el formato HH:mm.',
            'entrada_jueves.date_format' => 'El campo entrada jueves debe tener el formato HH:mm.',
            'salida_jueves.date_format' => 'El campo salida jueves debe tener el formato HH:mm.',
            'entrada_viernes.date_format' => 'El campo entrada viernes debe tener el formato HH:mm.',
            'salida_viernes.date_format' => 'El campo salida viernes debe tener el formato HH:mm.',
        ]);

        $medico =  Medico::findOrFail($id);

        $medico->nombre = $request->nombre;
        $medico->apellido_paterno = $request->apellido_paterno;
        $medico->apellido_materno = $request->apellido_materno;
        $medico->cedula = $request->cedula;
        $medico->correo = $request->correo;
        $medico->celular = $request->celular;
        $medico->especialidad = $request->especialidad;

        $medico->lunes_entrada = $request->lunes_entrada;
        $medico->lunes_salida = $request->lunes_salida;
        $medico->martes_entrada = $request->martes_entrada;
        $medico->martes_salida = $request->martes_salida;
        $medico->miercoles_entrada = $request->miercoles_entrada;
        $medico->miercoles_salida = $request->miercoles_salida;
        $medico->jueves_entrada = $request->jueves_entrada;
        $medico->jueves_salida = $request->jueves_salida;
        $medico->viernes_entrada = $request->viernes_entrada;
        $medico->viernes_salida = $request->viernes_salida;

        $medico->save();

        return redirect()->route('medicosIndex')->with('success', 'Médico actualizado exitosamente.');
    }

    public function medicosDestroy(Request $request, $id)
    {
        
        $request->validate([
            'status' => 'required'
        ],[]);    

        $medico = Medico::findOrFail($id);

        $medico->status = $request->status;

        $medico->save();

        return redirect()->route('medicosIndex')->with('success', 'Médico status actualizado exitosamente.');
    }
}
