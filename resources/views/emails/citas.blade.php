<x-mail::message>

# 🏥 REPORTE DE CITAS MÉDICAS

---

<x-mail::panel>

**Estimado(a) Dr(a). {{ $medico->nombre_completo }}:**

Le informamos que se adjunta el **reporte de citas programadas** correspondiente a la siguiente fecha:

📅 **{{ $fecha }}**

Le solicitamos atentamente revisar su agenda y tomar las medidas necesarias para la adecuada atención de los pacientes.

</x-mail::panel>

---

En caso de cualquier aclaración o incidencia, favor de comunicarse con el área correspondiente.

Gracias por su compromiso y servicio.

---

<x-mail::subcopy>
**Secretaría de Salud de Coahuila de Zaragoza**  
Sistema de Gestión Hospitalaria

_Este mensaje fue generado automáticamente. Favor de no responder._
</x-mail::subcopy>

</x-mail::message>