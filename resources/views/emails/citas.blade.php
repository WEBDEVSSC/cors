<x-mail::message>

<x-mail::panel>

<p><strong>Reporte de citas</strong></p>
<p>Estimado(a) Dr(a). {{ $medico->nombre_completo }}</p>

<p>Se adjunta el listado de citas correspondientes al día {{ $fecha }}.</p> 
<p>Favor de revisar su agenda.</p>

</x-mail::panel>

<x-mail::subcopy>
  <p><small>Secretaría de Salud de Coahuila de Zaragoza</small></p>
  <p><small>Este mensaje fue generado automáticamente. Favor de no responder.</small></p>
</x-mail::subcopy>

</x-mail::message>