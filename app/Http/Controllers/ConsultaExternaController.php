<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Medico;
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
    ]);

        $cita = Cita::findOrFail($id);

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
}
