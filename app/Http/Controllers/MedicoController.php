<?php

namespace App\Http\Controllers;

use App\Models\CatEspecialidadMedica;
use App\Models\Medico;
use App\Models\MedicoVacacion;
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
        $medicos = Medico::with('especialidad')->get();
    
        return view('settings.medicos.index', compact('medicos'));
    }

    public function medicosCreate()
    {
        $especialidadesMedicas = CatEspecialidadMedica::all();

        return view('settings.medicos.create', compact('especialidadesMedicas'));
    }

    public function medicosStore(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'cedula' => 'required|string|unique:medicos,cedula',
            'correo' => 'required|email|unique:medicos,correo',
            'celular' => 'required|string|max:20',
            'especialidad' => 'required|string|max:255',
            
            'lunes_entrada' => 'nullable|date_format:H:i',
            'lunes_salida' => 'nullable|date_format:H:i',
            'lunes_consulta' => 'required|in:0,1',

            'martes_entrada' => 'nullable|date_format:H:i',
            'martes_salida' => 'nullable|date_format:H:i',
            'martes_consulta' => 'required|in:0,1',

            'miercoles_entrada' => 'nullable|date_format:H:i',
            'miercoles_salida' => 'nullable|date_format:H:i',
            'miercoles_consulta' => 'required|in:0,1',

            'jueves_entrada' => 'nullable|date_format:H:i',
            'jueves_salida' => 'nullable|date_format:H:i',
            'jueves_consulta' => 'required|in:0,1',

            'viernes_entrada' => 'nullable|date_format:H:i',
            'viernes_salida' => 'nullable|date_format:H:i',
            'viernes_consulta' => 'required|in:0,1',
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

            'lunes_entrada.date_format' => 'El campo entrada lunes debe tener el formato HH:mm.',
            'lunes_salida.date_format' => 'El campo salida lunes debe tener el formato HH:mm.',
            'martes_entrada.date_format' => 'El campo entrada martes debe tener el formato HH:mm.',
            'martes_salida.date_format' => 'El campo salida martes debe tener el formato HH:mm.',
            'miercoles_entrada.date_format' => 'El campo entrada miércoles debe tener el formato HH:mm.',
            'miercoles_salida.date_format' => 'El campo salida miércoles debe tener el formato HH:mm.',
            'jueves_entrada.date_format' => 'El campo entrada jueves debe tener el formato HH:mm.',
            'jueves_salida.date_format' => 'El campo salida jueves debe tener el formato HH:mm.',
            'viernes_entrada.date_format' => 'El campo entrada viernes debe tener el formato HH:mm.',
            'viernes_salida.date_format' => 'El campo salida viernes debe tener el formato HH:mm.',
        ]);

        $medico = new Medico();

        $medico->nombre = $request->nombre;
        $medico->apellido_paterno = $request->apellido_paterno;
        $medico->apellido_materno = $request->apellido_materno;
        $medico->cedula = $request->cedula;
        $medico->correo = $request->correo;
        $medico->celular = $request->celular;
        $medico->especialidad_id = $request->especialidad;

        $medico->lunes_entrada = $request->lunes_entrada;
        $medico->lunes_salida = $request->lunes_salida;
        $medico->lunes_consulta = $request->lunes_consulta;

        $medico->martes_entrada = $request->martes_entrada;
        $medico->martes_salida = $request->martes_salida;
        $medico->martes_consulta = $request->martes_consulta;

        $medico->miercoles_entrada = $request->miercoles_entrada;
        $medico->miercoles_salida = $request->miercoles_salida;
        $medico->miercoles_consulta = $request->miercoles_consulta;

        $medico->jueves_entrada = $request->jueves_entrada;
        $medico->jueves_salida = $request->jueves_salida;
        $medico->jueves_consulta = $request->jueves_consulta;

        $medico->viernes_entrada = $request->viernes_entrada;
        $medico->viernes_salida = $request->viernes_salida;
        $medico->viernes_consulta = $request->viernes_consulta;

        $medico->save();

        return redirect()->route('medicosIndex')->with('success', 'Médico creado exitosamente.');
    }

    public function medicosEdit($id)
    {
        $medico = Medico::findOrFail($id);

        $especialidadesMedicas = CatEspecialidadMedica::all();

        return view('settings.medicos.edit', compact('medico','especialidadesMedicas'));
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
            'especialidad_id' => 'required|string|max:255',

            'lunes_entrada' => 'nullable|date_format:H:i',
            'lunes_salida' => 'nullable|date_format:H:i',
            'lunes_consulta' => 'nullable',

            'martes_entrada' => 'nullable|date_format:H:i',
            'martes_salida' => 'nullable|date_format:H:i',
            'martes_consulta' => 'nullable',

            'miercoles_entrada' => 'nullable|date_format:H:i',
            'miercoles_salida' => 'nullable|date_format:H:i',
            'miercoles_consulta' => 'nullable',

            'jueves_entrada' => 'nullable|date_format:H:i',
            'jueves_salida' => 'nullable|date_format:H:i',
            'jueves_consulta' => 'nullable',

            'viernes_entrada' => 'nullable|date_format:H:i',
            'viernes_salida' => 'nullable|date_format:H:i',
            'viernes_consulta' => 'nullable',
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
        $medico->especialidad_id = $request->especialidad_id;

        $medico->lunes_entrada = $request->lunes_entrada;
        $medico->lunes_salida = $request->lunes_salida;
        $medico->lunes_consulta = $request->lunes_consulta;

        $medico->martes_entrada = $request->martes_entrada;
        $medico->martes_salida = $request->martes_salida;
        $medico->martes_consulta = $request->martes_consulta;

        $medico->miercoles_entrada = $request->miercoles_entrada;
        $medico->miercoles_salida = $request->miercoles_salida;
        $medico->miercoles_consulta = $request->miercoles_consulta;

        $medico->jueves_entrada = $request->jueves_entrada;
        $medico->jueves_salida = $request->jueves_salida;
        $medico->jueves_consulta = $request->jueves_consulta;

        $medico->viernes_entrada = $request->viernes_entrada;
        $medico->viernes_salida = $request->viernes_salida;
        $medico->viernes_consulta = $request->viernes_consulta;

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

    public function medicosVacacionesCreate($id)
    {
         $medico = Medico::with('vacaciones')->findOrFail($id);

         return view('settings.medicos.vacaciones', compact('medico'));
    }

    public function medicosVacacionesStore(Request $request,$id)
    {
        $request->validate([
            'fecha' => 'required|date|after_or_equal:today',
            'concepto' => 'required|string|max:255|min:5'
        ], [
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'Debe ser una fecha válida.',
            'fecha.after' => 'La fecha debe ser posterior al día de hoy.',
            
            'concepto.required' => 'El concepto es obligatorio.',
            'concepto.string' => 'El concepto debe ser texto.',
            'concepto.min' => 'El concepto debe tener al menos 5 caracteres.',
            'concepto.max' => 'El concepto no debe exceder 255 caracteres.'
        ]);

        $medicoVacacion = new MedicoVacacion();

        $medicoVacacion->medico_id = $id;
        $medicoVacacion->fecha = $request->fecha;
        $medicoVacacion->concepto = $request->concepto;

        $medicoVacacion->save();

        return redirect()->route('medicosVacacionesCreate',$id)->with('success', 'Día de Vacaciones registrado exitosamente.');
    }

    
}
