<?php

namespace App\Http\Controllers;

use App\Models\CatCie10;
use App\Models\CatTipoDeCancer;
use App\Models\Cita;
use App\Models\CitaSubsecuente;
use App\Models\CitaValoracionInicial;
use App\Models\Medico;
use App\Models\Paciente;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ConsultaExternaController extends Controller
{
    //
    public function medicoMisCitas()
    {
        // Usuario autenticado
        $user = Auth::user();

        // Validar que tenga médico
        if (!$user->id_medico) {
            return back()->with('error', 'No tienes un médico asignado');
        }

        // Obtener médico (más limpio)
        $medico = Medico::findOrFail($user->id_medico);

        // Fecha actual
        $fecha = today(); // más limpio que now()->toDateString()

        // Citas con relaciones (evita N+1)
        $citas = Cita::with([
                'paciente.diagnostico',
                'paciente.afiliacion'
            ])
            ->where('medico_id', $medico->id)
            ->whereDate('fecha', $fecha)
            ->get();

        /************************************ */

        // Generar horarios
        $horarios = collect();
        $inicio = Carbon::createFromTime(8, 0);
        $fin = Carbon::createFromTime(14, 30);

        while ($inicio <= $fin) {
            $horarios->push($inicio->format('H:i'));
            $inicio->addMinutes(30);
        }

        // Indexar citas por hora
        $citasPorHora = $citas->keyBy(function ($cita) {
            return Carbon::parse($cita->hora)->format('H:i');
        });

        return view('consulta-externa.medicos-mis-citas', compact('horarios','citasPorHora','medico','fecha'));
    }

    public function iniciarCita($id)
    {
        $cita = Cita::findOrFail($id);

        // Validar que la cita sea del médico autenticado
        if ($cita->medico_id !== Auth::user()->id_medico) {
            return back()->with('error', 'No puedes iniciar esta cita');
        }

        // Aquí podrías marcar la cita como "en progreso" o redirigir a una vista de detalles
        // Por ejemplo:
        // $cita->estado = 'en progreso';
        // $cita->save();

        return view('medicos-citas.iniciar', compact('cita'));
    }

    public function centralEnfermeriaMisCitas()
    {
        // Fecha actual
        $fecha = today(); // más limpio que now()->toDateString()

        // Consultamos todas las citas del día con sus relaciones (evita N+1)
        $citas = Cita::whereDate('fecha', $fecha)
                ->orderBy('hora','ASC')
                ->get();

        return view('consulta-externa.central-enfermeria-mis-citas', compact('citas','fecha'));
    }

    public function centralEnfermeriaTomaSignosVitalesCreate($id)
    {   
        $cita = Cita::findOrFail($id);

        // Validar que la cita exista
        if (!$cita) {
            return back()->with('error', 'Cita no encontrada');
        }

        // Aquí podrías redirigir a una vista para tomar signos vitales
        return view('consulta-externa.central-enfermeria-create-signos-vitales', compact('cita'));
    }

    public function centralEnfermeriaTomaSignosVitalesUpdate(Request $request, $id)
    {
        $request->validate([
        'peso' => 'required|numeric|min:1',
        'talla' => 'required|numeric|min:50',
        'sistolica' => 'required|integer',
        'diastolica' => 'required|integer',
        'cardiaca' => 'required|integer',
        'respiratoria' => 'required|integer',
        'temperatura' => 'required|numeric',
        'saO2' => 'required|integer',
        'dolor' => 'required|integer',
        'caidas' => 'required|boolean',
        'exploracion_fisica' => 'nullable|string',
    ], [
        // Peso
        'peso.required' => 'El peso es obligatorio',
        'peso.numeric' => 'El peso debe ser un número válido',

        // Talla
        'talla.required' => 'La talla es obligatoria',
        'talla.numeric' => 'La talla debe ser un número válido',

        // Presión
        'sistolica.required' => 'La presión sistólica es obligatoria',
        'sistolica.integer' => 'La presión sistólica debe ser un número entero',

        'diastolica.required' => 'La presión diastólica es obligatoria',
        'diastolica.integer' => 'La presión diastólica debe ser un número entero',

        // Frecuencia cardíaca
        'cardiaca.required' => 'La frecuencia cardíaca es obligatoria',
        'cardiaca.integer' => 'La frecuencia cardíaca debe ser un número entero',

        // Frecuencia respiratoria
        'respiratoria.required' => 'La frecuencia respiratoria es obligatoria',
        'respiratoria.integer' => 'La frecuencia respiratoria debe ser un número entero',

        // Temperatura
        'temperatura.required' => 'La temperatura es obligatoria',
        'temperatura.numeric' => 'La temperatura debe ser un número válido',

        // Saturación
        'saO2.required' => 'La saturación de oxígeno es obligatoria',
        'saO2.integer' => 'La saturación de oxígeno debe ser un número entero',

        // Dolor
        'dolor.required' => 'El nivel de dolor es obligatorio',
        'dolor.integer' => 'El nivel de dolor debe ser un número entre 0 y 10',

        // Caídas
        'caidas.required' => 'Debe indicar si el paciente ha tenido caídas',
        'caidas.boolean' => 'El campo caídas debe ser verdadero o falso',

        // Exploración física
        'exploracion_fisica.string' => 'La exploración física debe ser un texto válido',
    ]);
    
        $cita = Cita::findOrFail($id);

        // Calculamos la edad
        $edad = Carbon::parse($cita->paciente->fecha_nacimiento)->age;

        // Validar que la cita exista
        if (!$cita) {
            return back()->with('error', 'Cita no encontrada');
        }

        $cita->peso = $request->peso;
        $cita->talla = $request->talla;
        $cita->imc = $request->peso / (($request->talla/100) ** 2); // IMC en kg/m²
        $cita->sistolica = $request->sistolica;
        $cita->diastolica = $request->diastolica;
        $cita->cardiaca = $request->cardiaca;
        $cita->respiratoria = $request->respiratoria;
        $cita->temperatura = $request->temperatura;
        $cita->saO2 = $request->saO2;
        $cita->dolor = $request->dolor;
        $cita->caidas = $request->caidas;
        $cita->exploracion_fisica = $request->exploracion_fisica;
        $cita->edad = $edad;

        $cita->signos_vitales = 1;

        $cita->save();

        return redirect()->route('centralEnfermeriaMisCitas')->with('success', 'Signos vitales registrados correctamente');
    }

    public function centralEnfermeriaTomaSignosVitalesShow($id)
    {
        $cita = Cita::findOrFail($id);

        // Validar que la cita exista
        if (!$cita) {
            return back()->with('error', 'Cita no encontrada');
        }

        return view('consulta-externa.central-enfermeria-show-signos-vitales', compact('cita'));
    }

    public function medicoValoracionInicialCreate($id)
    {
        $cita = Cita::findOrFail($id);

        // Validar que la cita sea del médico autenticado
        if ($cita->medico_id !== Auth::user()->id_medico) {
            return back()->with('error', 'No puedes acceder a esta cita');
        }

        // Cargamos todos los diagnosticos

        $tiposDeCancer = CatTipoDeCancer::all();

        // Cargamos todos los diagnosticos de la CIE 10

        $diagnosticosCIE10 = CatCie10::all();

        // Cargamos al paciente para comparar el campo diagnostico

        $paciente = Paciente::findOrFail($cita->paciente_id);

        return view('consulta-externa.medicos-valoracion-inicial-create', compact('cita', 'tiposDeCancer', 'diagnosticosCIE10', 'paciente'));
    }

    public function medicoValoracionInicialStore(Request $request, $id)
    {
        $request->validate([
            'paciente' => 'required|exists:pacientes,id',
            'padecimiento_actual' => 'required|string',
            'estudios_laboratorio' => 'required|string',
            'tipo_cancer_id' => 'required|string',
            'id_diagnostico_cie10' => 'required|string',
            'pronostico' => 'required|string',
            'analisis' => 'required|string',
        ], [
            'padecimiento_actual.required' => 'El padecimiento actual es obligatorio',
            'padecimiento_actual.string' => 'El padecimiento actual debe ser un texto válido',
            'estudios_laboratorio.required' => 'Los estudios de laboratorio son obligatorios',
            'estudios_laboratorio.string' => 'Los estudios de laboratorio deben ser un texto válido',
            'tipo_cancer_id.required' => 'El tipo de cáncer es obligatorio',
            'tipo_cancer_id.string' => 'El tipo de cáncer debe ser un texto válido',
            'id_diagnostico_cie10.required' => 'El diagnóstico CIE-10 es obligatorio',
            'id_diagnostico_cie10.string' => 'El diagnóstico CIE-10 debe ser un texto válido',
            'pronostico.required' => 'El pronóstico es obligatorio',
            'pronostico.string' => 'El pronóstico debe ser un texto válido',
            'analisis.required' => 'El análisis es obligatorio',
            'analisis.string' => 'El análisis debe ser un texto válido',
        ]);

        $medicoId = Auth::user()->id_medico;

        $paciente = Paciente::findOrFail($request->paciente);
        // Calculamos la edad
        $edad = Carbon::parse($paciente->fecha_nacimiento)->age;

        $valoracionInicial = new CitaValoracionInicial();

        $valoracionInicial->tipo_cancer_id = $request->tipo_cancer_id;
        $valoracionInicial->id_diagnostico_cie10 = $request->id_diagnostico_cie10;
        $valoracionInicial->paciente_id = $request->paciente;
        $valoracionInicial->cita_id = $id;
        $valoracionInicial->padecimiento_actual = $request->padecimiento_actual;
        $valoracionInicial->estudios_laboratorio = $request->estudios_laboratorio;
        $valoracionInicial->pronostico = $request->pronostico;
        $valoracionInicial->analisis = $request->analisis;
        $valoracionInicial->id_medico = $medicoId;
        $valoracionInicial->edad = $edad;

        $valoracionInicial->save();

        // Cambiamos el status de la cita a "finalizada" para que no aparezca en el listado de citas del día
        $cita = Cita::findOrFail($id);
        $cita->status = 1;
        $cita->save();

        // Actualizamos el diagnóstico del paciente con el diagnóstico seleccionado en la valoración inicial
        $paciente->diagnostico_id = $request->id_diagnostico_cie10;
        $paciente->id_diagnostico_cie10 = $request->id_diagnostico_cie10;
        $paciente->save();

        return redirect()->route('medicoMisCitas')->with('success', 'Valoración inicial registrada correctamente');
    }

    public function medicoValoracionInicialShow($id)
    {
        $valoracionInicial = CitaValoracionInicial::findOrFail($id);

        // Validar que la valoración inicial exista
        if (!$valoracionInicial) {
            return back()->with('error', 'Valoración inicial no encontrada');
        }

        return view('consulta-externa.medicos-valoracion-inicial-show', compact('valoracionInicial'));
    }

    public function medicoValoracionInicialPDF($id)
    {
        $valoracionInicial = CitaValoracionInicial::with(['paciente', 'medico.especialidad'])
            ->findOrFail($id);

        $pdf = Pdf::loadView('pdf.medicos-valoracion-inicial-pdf', compact('valoracionInicial'));

        return $pdf->stream('valoracion_inicial.pdf'); // 👈 abre en navegador
    }

    public function consultaSubsecuenteCreate($id)
    {
        $cita = Cita::findOrFail($id);

         // Cargamos todos los diagnosticos

        $tiposDeCancer = CatTipoDeCancer::all();

        // Cargamos todos los diagnosticos de la CIE 10

        $diagnosticosCIE10 = CatCie10::all();

        // Cargamos al paciente para comparar el campo diagnostico

        $paciente = Paciente::findOrFail($cita->paciente_id);

        return view('consulta-externa.medicos-consulta-subsecuente', compact('cita', 'tiposDeCancer', 'diagnosticosCIE10', 'paciente'));
    }

    public function consultaSubsecuenteStore(Request $request, $id)
    {   
        $request->validate([
            'paciente' => 'required|exists:pacientes,id',
            'evolucion' => 'required|string',
            'estudios' => 'required|string',
            'tipo_cancer_id' => 'required|string',
            'id_diagnostico_cie10' => 'required|string',
            'pronostico' => 'required|string',
            'analisis' => 'required|string',
        ], [
            'evolucion.required' => 'La evolución es obligatoria',
            'evolucion.string' => 'La evolución debe ser un texto válido',
            'estudios.required' => 'Los estudios son obligatorios',
            'estudios.string' => 'Los estudios deben ser un texto válido',
            'tipo_cancer_id.required' => 'El tipo de cáncer es obligatorio',
            'tipo_cancer_id.string' => 'El tipo de cáncer debe ser un texto válido',
            'id_diagnostico_cie10.required' => 'El diagnóstico CIE-10 es obligatorio',
            'id_diagnostico_cie10.string' => 'El diagnóstico CIE-10 debe ser un texto válido',
            'pronostico.required' => 'El pronóstico es obligatorio',
            'pronostico.string' => 'El pronóstico debe ser un texto válido',
            'analisis.required' => 'El análisis es obligatorio',
            'analisis.string' => 'El análisis debe ser un texto válido',
        ]);

        $medicoId = Auth::user()->id_medico;

        $paciente = Paciente::findOrFail($request->paciente);
        // Calculamos la edad
        $edad = Carbon::parse($paciente->fecha_nacimiento)->age;

        $consultaSubsecuente = new CitaSubsecuente();

        $consultaSubsecuente->cita_id = $id;
        $consultaSubsecuente->paciente_id = $request->paciente;
        $consultaSubsecuente->id_medico = $medicoId;

        $consultaSubsecuente->evolucion = $request->evolucion;
        $consultaSubsecuente->estudios = $request->estudios;
        $consultaSubsecuente->pronostico = $request->pronostico;
        $consultaSubsecuente->analisis = $request->analisis;
        $consultaSubsecuente->edad = $edad;

        $consultaSubsecuente->save();

        // Cambiamos el status de la cita a "finalizada" para que no aparezca en el listado de citas del día
        $cita = Cita::findOrFail($id);
        $cita->status = 1;
        $cita->save();

        // Actualizamos el diagnóstico del paciente con el diagnóstico seleccionado en la valoración inicial
        $paciente->diagnostico_id = $request->id_diagnostico_cie10;
        $paciente->id_diagnostico_cie10 = $request->id_diagnostico_cie10;
        $paciente->save();

        return redirect()->route('medicoMisCitas')->with('success', 'Consulta subsecuente registrada correctamente');
    }

}