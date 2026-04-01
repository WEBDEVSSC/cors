<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Medico;
use App\Models\MedicoVacacion;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class CitaController extends Controller
{
    //
    public function buscadorCita()
    {
        $medicos = Medico::where('status',1)
            ->orderBy('apellido_paterno','ASC')
            ->get();

        $pacientes = Paciente::all();
    
        return view('citas.buscador', compact('medicos', 'pacientes'));
    }

    public function mostrarHorariosDisponibles(Request $request)
    {
    // Validación de datos    
    $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:medicos,id',
            'fecha' => 'required|date|after_or_equal:today',
        ],[
            'paciente_id.required' => 'El campo paciente es obligatorio.',
            'paciente_id.exists' => 'El paciente seleccionado no existe.',
            'medico_id.required' => 'El campo médico es obligatorio.',
            'medico_id.exists' => 'El médico seleccionado no existe.',
            'fecha.required' => 'El campo fecha de cita es obligatorio.',
            'fecha.date' => 'El campo fecha de cita debe ser una fecha válida.',
            'fecha.after_or_equal' => 'La fecha de cita no puede ser anterior, debe ser hoy o una fecha futura.',
        ]);

        // Convertir fecha
        Carbon::setLocale('es');
        $fecha = Carbon::parse($request->fecha);

        // Bloquear fines de semana
        if ($fecha->isWeekend()) {
            return back()
                ->withInput()
                ->with('error', 'No hay citas disponibles en fin de semana');
        }

        // Obtener médico
        $medico = Medico::findOrFail($request->medico_id);

        // Mapeo de días
        $dias = [
            1 => 'lunes_consulta',
            2 => 'martes_consulta',
            3 => 'miercoles_consulta',
            4 => 'jueves_consulta',
            5 => 'viernes_consulta',
        ];

        $diaNumero = $fecha->dayOfWeek;

        // Validación extra por seguridad
        if (!isset($dias[$diaNumero])) {
            return back()
                ->withInput()
                ->with('error', 'Día no válido para consulta');
        }

        $campoDia = $dias[$diaNumero];

        // Validar si el médico consulta ese día
        if (!$medico->$campoDia) {
            $diaTexto = $fecha->translatedFormat('l');

            return back()
                ->withInput()
                ->with('error', "El médico no consulta los {$diaTexto}");
        }

        // Día en texto
        $diaTexto = $fecha->translatedFormat('l');

        // Consulta si el medico esta de vacaciones ese día
        if($vacaciones = MedicoVacacion::where('medico_id', $request->medico_id)->where('fecha', $request->fecha)->first()) {
            return back()
                ->withInput()
                ->with('error', "El médico está de vacaciones el {$diaTexto}");
        }

        // Redirección correcta
        return redirect()->route('createCita', [
            'paciente_id' => $request->paciente_id,
            'medico_id' => $request->medico_id,
            'fecha' => $request->fecha,
        ]);
    }

    public function createCita(Request $request)
    {
        $medico_id = $request->medico_id;
        $paciente_id = $request->paciente_id;
        $fecha = $request->fecha;

        $consultaHorarioUno = Cita::where('medico_id', $request->medico_id)
            ->where('fecha', $request->fecha)
            ->where('hora', '08:00:00')
            ->first();

        $consultaHorarioDos = Cita::where('medico_id', $request->medico_id)
            ->where('fecha', $request->fecha)
            ->where('hora', '08:30:00')
            ->first();

        $consultaHorarioTres = Cita::where('medico_id', $request->medico_id)
            ->where('fecha', $request->fecha)
            ->where('hora', '09:00:00')
            ->first();

        $consultaHorarioCuatro = Cita::where('medico_id', $request->medico_id)
            ->where('fecha', $request->fecha)
            ->where('hora', '09:30:00')
            ->first();

        $consultaHorarioCinco = Cita::where('medico_id', $request->medico_id)
            ->where('fecha', $request->fecha)
            ->where('hora', '10:00:00')
            ->first();

        $consultaHorarioSeis = Cita::where('medico_id', $request->medico_id)
            ->where('fecha', $request->fecha)
            ->where('hora', '10:30:00')
            ->first();

        $consultaHorarioSiete = Cita::where('medico_id', $request->medico_id)
            ->where('fecha', $request->fecha)
            ->where('hora', '11:00:00')
            ->first();

        $consultaHorarioOcho = Cita::where('medico_id', $request->medico_id)
            ->where('fecha', $request->fecha)
            ->where('hora', '11:30:00')
            ->first();

        $consultaHorarioNueve = Cita::where('medico_id', $request->medico_id)
            ->where('fecha', $request->fecha)
            ->where('hora', '12:00:00')
            ->first();

        $consultaHorarioDiez = Cita::where('medico_id', $request->medico_id)
            ->where('fecha', $request->fecha)
            ->where('hora', '12:30:00')
            ->first();

        $consultaHorarioOnce = Cita::where('medico_id', $request->medico_id)
            ->where('fecha', $request->fecha)
            ->where('hora', '13:00:00')
            ->first();

        $consultaHorarioDoce = Cita::where('medico_id', $request->medico_id)
            ->where('fecha', $request->fecha)
            ->where('hora', '13:30:00')
            ->first();

        $consultaHorarioTrece = Cita::where('medico_id', $request->medico_id)
            ->where('fecha', $request->fecha)
            ->where('hora', '14:00:00')
            ->first();

        $consultaHorarioCatorce = Cita::where('medico_id', $request->medico_id)
            ->where('fecha', $request->fecha)
            ->where('hora', '14:30:00')
            ->first();

        $medico = Medico::findOrFail($request->medico_id);
        
        $paciente = Paciente::findOrFail($request->paciente_id);

        return view('citas.create', compact('medico', 'paciente', 'medico_id', 'paciente_id', 'fecha', 'consultaHorarioUno', 'consultaHorarioDos', 'consultaHorarioTres', 'consultaHorarioCuatro', 'consultaHorarioCinco', 'consultaHorarioSeis', 'consultaHorarioSiete', 'consultaHorarioOcho', 'consultaHorarioNueve', 'consultaHorarioDiez', 'consultaHorarioOnce', 'consultaHorarioDoce', 'consultaHorarioTrece', 'consultaHorarioCatorce'));
    }

    public function storeCita(Request $request)
    {
        $request->validate([
            'medico_id' => 'required|exists:medicos,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i:s',
        ],[
            'medico_id.required' => 'El campo médico es obligatorio.',
            'medico_id.exists' => 'El médico seleccionado no existe.',
            'paciente_id.required' => 'El campo paciente es obligatorio.',
            'paciente_id.exists' => 'El paciente seleccionado no existe.',
            'fecha.required' => 'El campo fecha de cita es obligatorio.',
            'fecha.date' => 'El campo fecha de cita debe ser una fecha válida.',
            'fecha.after_or_equal' => 'La fecha de cita no puede ser anterior, debe ser hoy o una fecha futura.',
            'hora.required' => 'El campo hora de cita es obligatorio.',
            'hora.date_format' => 'El campo hora de cita debe tener el formato HH:mm:ss.',
        ]);

        $cita = new Cita();

        $cita->medico_id = $request->medico_id;
        $cita->paciente_id = $request->paciente_id;
        $cita->fecha = $request->fecha;
        $cita->hora = $request->hora;

        $cita->save();

        return redirect()->route('buscadorCita')->with('success', 'Cita agendada exitosamente');
    }

    public function medicoAgendaCita(Request $request)
    {  
    
        $request->validate([
            'medico_id' => 'required|exists:medicos,id',
            'fecha' => 'required|date|after_or_equal:today',
        ], [
            'medico_id.required' => 'El médico es obligatorio.',
            'medico_id.exists' => 'El médico seleccionado no existe.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'Debe ser una fecha válida.',
            'fecha.after_or_equal' => 'La fecha debe ser hoy o en el futuro.',
        ]);

        $citas = Cita::where('medico_id', $request->medico_id)
            ->where('fecha', $request->fecha)
            ->orderBy('hora', 'asc')
            ->get();

        $medico = Medico::findOrFail($request->medico_id);

        $fecha = Carbon::parse($request->fecha);
        
        return view('citas.agenda', compact('citas', 'medico', 'fecha'));
    }

    public function medicoAgendaCitaDestroy($id)
    {
        $cita = Cita::findOrFail($id);

        $cita->delete();

         return redirect()->route('buscadorCita')->with('success', 'Cita eliminada exitosamente');
    }

    public function reportePDFCitas(Request $request)
    {
        $request->validate([
            'medico_id' => 'required|exists:medicos,id',
            'fecha' => 'required|date|after_or_equal:today',
        ]);

        // Obtener citas
        $citas = Cita::with([
                'paciente.diagnostico',
                'paciente.afiliacion'
            ])
            ->where('medico_id', $request->medico_id)
            ->whereDate('fecha', $request->fecha)
            ->orderBy('hora', 'asc')
            ->get();

        // Generar horarios
        $horarios = [];
        $inicio = Carbon::createFromTime(8, 0);
        $fin = Carbon::createFromTime(14, 30);

        while ($inicio <= $fin) {
            $horarios[] = $inicio->format('H:i');
            $inicio->addMinutes(30);
        }

        // Mapear citas por hora
        $citasPorHora = $citas->keyBy(function ($cita) {
            return Carbon::parse($cita->hora)->format('H:i');
        });

        // Datos adicionales
        $fecha = Carbon::parse($request->fecha)->format('d-m-Y');
        $medico = Medico::findOrFail($request->medico_id);

        // PDF
        $pdf = Pdf::loadView('pdf.citas_pdf', compact(
            'horarios',
            'citasPorHora',
            'fecha',
            'medico'
        ));

        return $pdf->stream('reporte_citas.pdf');
    }
}
