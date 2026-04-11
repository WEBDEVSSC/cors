<?php

namespace App\Http\Controllers;

use App\Models\CatAfiliacion;
use App\Models\CatTipoDeCancer;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    //

    public function pacientesIndex()
    {
        $pacientes = Paciente::all();

        return view('pacientes.index', compact('pacientes'));
    }

    public function buscadorPaciente()
    {
        return view('pacientes.buscardor-paciente');
    }

    public function pacientesShow($id)
    {
        $paciente = Paciente::findOrFail($id);

        return view('pacientes.show', compact('paciente'));
    }

    public function buscarPaciente(Request $request)
    {
        $request->merge([
            'curp' => strtoupper($request->curp)
        ]);
    
        $request->validate([
            'curp' => 'required|regex:/^[A-Z]{4}[0-9]{6}[HM][A-Z]{5}[A-Z0-9][0-9]$/',
        ],[
            'curp.required' => 'La CURP es obligatoria.',
            'curp.regex' => 'La CURP debe tener un formato válido.',
        ]);

        $paciente = Paciente::where('curp',$request->curp)->first();

        if ($paciente) 
        {
            return redirect()
            ->route('pacientesShow', $paciente->id)
            ->with('info', 'El paciente ya se encuentra registrado.');
        } 
        
            $curp = $request->curp;

            $fechaRaw = substr($curp, 4, 6); // YYMMDD
            $sexo = substr($curp, 10, 1);

            // 🧠 Determinar siglo
            $anio = substr($fechaRaw, 0, 2);
            $mes  = substr($fechaRaw, 2, 2);
            $dia  = substr($fechaRaw, 4, 2);

            $anioCompleto = ($anio <= date('y')) ? "20$anio" : "19$anio";

            $fechaNacimiento = "$anioCompleto-$mes-$dia";

            return redirect()->route('createPaciente', ['curp' => $curp,'fechaNacimiento' => $fechaNacimiento,'sexo' => $sexo]);
        
    }

    public function createPaciente(Request $request)
    {
        $medicos = Medico::where('status',1)
            ->orderBy('apellido_paterno','ASC')
            ->get();

        $tiposDeCancer = CatTipoDeCancer::all();

        $afiliaciones = CatAfiliacion::all();

        return view('pacientes.create', [
            'curp' => $request->curp,
            'fechaNacimiento' => $request->fechaNacimiento,
            'sexo' => $request->sexo,
            'medicos' => $medicos,
            'tiposDeCancer' => $tiposDeCancer,
            'afiliaciones' => $afiliaciones
        ]);
    }

    public function pacienteStore(Request $request)
    {
        $request->validate([
            'curp' => 'required|string|size:18|unique:pacientes,curp',

            'nombre' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'apellido_materno' => 'nullable|string|max:100',

            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|in:H,M',

            'correo' => 'nullable|email|max:150',
            'celular' => 'nullable|digits:10',

            'estado_civil' => 'required|in:SOLTERO,CASADO,DIVORCIADO,VIUDO,CONCUBINATO,UNION LIBRE,SEPARADO',

            'afiliacion_id' => 'required|exists:cat_afiliaciones,id',

            'primera_vez' => 'required|in:SI,NO',

            'diagnostico_id' => 'required|exists:cat_tipos_de_cancer,id',

            'cirujano_oncologo_id' => 'required|exists:medicos,id|different:oncologo_medico_id',

            'oncologo_medico_id' => 'required|exists:medicos,id|different:cirujano_oncologo_id',

            'residencia' => 'nullable|string|max:255',
            'alergias' => 'nullable|string|max:1000',
            'ocupacion' => 'nullable|string|max:255',

        ],[
            // CURP
            'curp.required' => 'La CURP es obligatoria',
            'curp.size' => 'La CURP debe tener 18 caracteres',
            'curp.unique' => 'Este paciente ya está registrado',

            // Nombre
            'nombre.required' => 'El nombre es obligatorio',

            // Apellidos
            'apellido_paterno.required' => 'El apellido paterno es obligatorio',

            // Fecha
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria',
            'fecha_nacimiento.date' => 'Formato de fecha inválido',

            // Sexo
            'sexo.required' => 'El sexo es obligatorio',
            'sexo.in' => 'El sexo debe ser H o M',

            // Correo
            'correo.email' => 'El correo no es válido',

            // Celular
            'celular.digits' => 'El celular debe tener 10 dígitos',

            // Estado civil
            'estado_civil.required' => 'Selecciona un estado civil',

            // Afiliación
            'afiliacion_id.required' => 'Selecciona una afiliación',
            'afiliacion_id.exists' => 'La afiliación no es válida',

            // Primera vez
            'primera_vez.required' => 'Indica si es primera vez',

            // Diagnóstico
            'diagnostico_id.required' => 'Selecciona un diagnóstico',
            'diagnostico_id.exists' => 'El diagnóstico no es válido',

            // Médicos
            'cirujano_oncologo_id.required' => 'Selecciona el cirujano oncólogo',
            'cirujano_oncologo_id.exists' => 'El cirujano no es válido',
            'cirujano_oncologo_id.different' => 'El cirujano y el oncólogo deben ser diferentes',

            'oncologo_medico_id.required' => 'Selecciona el oncólogo médico',
            'oncologo_medico_id.exists' => 'El oncólogo no es válido',
            'oncologo_medico_id.different' => 'El oncólogo y el cirujano deben ser diferentes',
        ]);

        $paciente = new Paciente();

        $paciente->curp = $request->curp;
        $paciente->nombre = $request->nombre;
        $paciente->apellido_paterno = $request->apellido_paterno;
        $paciente->apellido_materno = $request->apellido_materno;
        $paciente->fecha_nacimiento = $request->fecha_nacimiento;
        $paciente->sexo = $request->sexo;
        $paciente->estado_civil = $request->estado_civil;
        $paciente->telefono = $request->telefono;
        $paciente->residencia = $request->residencia;
        $paciente->diagnostico_id = $request->diagnostico_id;
        $paciente->cirujano_oncologo = $request->cirujano_oncologo_id;
        $paciente->oncologo_medico = $request->oncologo_medico_id;
        $paciente->afiliacion_id = $request->afiliacion_id;
        $paciente->primera_vez = $request->primera_vez;
        $paciente->alergias = $request->alergias;
        $paciente->ocupacion = $request->ocupacion;
        $paciente->email = $request->email; 
        $paciente->ocupacion = $request->ocupacion; 

        $paciente->save();

        return redirect()->route('pacientesIndex')->with('success', 'Paciente registrado exitosamente.');
    }

    public function pacientesEdit($id)
    {
        $paciente = Paciente::findOrFail($id);

        $medicos = Medico::where('status',1)
            ->orderBy('apellido_paterno','ASC')
            ->get();

        $tiposDeCancer = CatTipoDeCancer::all();

        $afiliaciones = CatAfiliacion::all();

        return view('pacientes.edit', compact('paciente','medicos','tiposDeCancer','afiliaciones'));
    }

    public function pacientesUpdate(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'apellido_materno' => 'nullable|string|max:100',

            'email' => 'nullable|email|max:150',
            'celular' => 'nullable|digits:10',

            'estado_civil' => 'required|in:SOLTERO,CASADO,DIVORCIADO,VIUDO,CONCUBINATO,UNION LIBRE,SEPARADO',

            'afiliacion_id' => 'required|exists:cat_afiliaciones,id',

            'primera_vez' => 'required|in:SI,NO',

            'diagnostico_id' => 'required|exists:cat_tipos_de_cancer,id',

            'cirujano_oncologo_id' => 'required|exists:medicos,id|different:oncologo_medico_id',

            'oncologo_medico_id' => 'required|exists:medicos,id|different:cirujano_oncologo_id',

            'residencia' => 'nullable|string|max:255',
            'alergias' => 'nullable|string|max:1000',
            'ocupacion' => 'nullable|string|max:255',
        ],[
            // Nombre
            'nombre.required' => 'El nombre es obligatorio',

            // Apellidos
            'apellido_paterno.required' => 'El apellido paterno es obligatorio',

            // Correo
            'email.email' => 'El correo no es válido',

            // Celular
            'celular.digits' => 'El celular debe tener 10 dígitos',

            // Estado civil
            'estado_civil.required' => 'Selecciona un estado civil',

            // Afiliación
            'afiliacion_id.required' => 'Selecciona una afiliación',
            'afiliacion_id.exists' => 'La afiliación no es válida',

            // Primera vez
            'primera_vez.required' => 'Indica si es primera vez',

            // Diagnóstico
            'diagnostico_id.required' => 'Selecciona un diagnóstico',
            'diagnostico_id.exists' => 'El diagnóstico no es válido',

            // Médicos
            'cirujano_oncologo_id.required' => 'Selecciona el cirujano oncólogo',
            'cirujano_oncologo_id.exists' => 'El cirujano no es válido',
            'cirujano_oncologo_id.different' => 'El cirujano y el oncólogo deben ser diferentes',
        ]);

        $paciente = Paciente::findOrFail($id);  

        $paciente->nombre = $request->nombre;
        $paciente->apellido_paterno = $request->apellido_paterno;
        $paciente->apellido_materno = $request->apellido_materno;
        $paciente->estado_civil = $request->estado_civil;
        $paciente->telefono = $request->telefono;
        $paciente->residencia = $request->residencia;
        $paciente->diagnostico_id = $request->diagnostico_id;
        $paciente->cirujano_oncologo = $request->cirujano_oncologo_id;
        $paciente->oncologo_medico = $request->oncologo_medico_id;
        $paciente->afiliacion_id = $request->afiliacion_id;
        $paciente->primera_vez = $request->primera_vez;
        $paciente->alergias = $request->alergias;
        $paciente->email = $request->email; 

        $paciente->save();

        return redirect()->route('pacientesShow', $paciente->id)->with('success', 'Paciente actualizado exitosamente.');

    }

    public function pacientesExpediente($id)
    {
        $paciente = Paciente::findOrFail($id);

        return view('pacientes.expediente', compact('paciente'));
    }

    public function pacienteExpedienteUpdate(Request $request, $id)
    {
        $request->validate([
            'expediente' => 'required|string|max:255',
        ], [
            'expediente.required' => 'El campo expediente es obligatorio',
            'expediente.string' => 'El expediente debe ser texto',
            'expediente.max' => 'El expediente no debe exceder 255 caracteres',
        ]);

        $paciente = Paciente::findOrFail($id);

        $paciente->expediente = $request->expediente;

        $paciente->save();

        return redirect()->route('pacientesShow', $paciente->id)->with('success', 'Expediente actualizado exitosamente.');
    }

    
}
