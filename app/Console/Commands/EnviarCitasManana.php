<?php
namespace App\Console\Commands;

use App\Models\Cita;
use App\Models\Medico;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\CitasMananaMail;
use Illuminate\Support\Facades\Mail;


class EnviarCitasManana extends Command
{
    protected $signature = 'citas:enviar-manana';
    protected $description = 'Envía el PDF de citas del día siguiente';

    public function handle()
{
    $manana = now()->addDay()->toDateString();

    $medicos = Medico::whereNotNull('correo')->get();

    foreach ($medicos as $medico) {

        $citas = Cita::with([
                'paciente.diagnostico',
                'paciente.afiliacion'
            ])
            ->where('medico_id', $medico->id)
            ->whereDate('fecha', $manana)
            ->orderBy('hora')
            ->get();

        // Horarios
        $horarios = [];
        $inicio = Carbon::createFromTime(8, 0);
        $fin = Carbon::createFromTime(14, 30);

        while ($inicio <= $fin) {
            $horarios[] = $inicio->format('H:i');
            $inicio->addMinutes(30);
        }

        $citasPorHora = $citas->keyBy(function ($cita) {
            return Carbon::parse($cita->hora)->format('H:i');
        });

        $fecha = Carbon::parse($manana)->format('d-m-Y');

        $pdf = Pdf::loadView('pdf.citas_pdf', compact(
            'horarios',
            'citasPorHora',
            'medico',
            'fecha'
        ));

        Mail::to($medico->correo)
            ->send(new CitasMananaMail($medico, $fecha, $pdf));
            }

    $this->info('Correos enviados correctamente');
}
}