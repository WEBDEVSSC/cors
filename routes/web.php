<?php

use App\Http\Controllers\CatAfiliacionesController;
use App\Http\Controllers\CatEspecialidadMedicaController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ConsultaExternaController;
use App\Http\Controllers\FarmaciaController;
use App\Http\Controllers\MedicoCitaController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TipoDeCancerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes([
    'register' => false, // Desactiva el registro de nuevos usuarios
    'reset' => false, // Desactiva la recuperación de contraseña
    'verify' => false,   // Desactiva la verificación de email
]);

Route::middleware(['auth'])->group(function () 
{
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    /******************************************************
     * 
     * 
     * MODULO DE FARMACIA
     * 
     * 
     ******************************************************/

    Route::get('admin/farmacia/medicamentos/indexMedicamento', [FarmaciaController::class,'indexMedicamento'])->name('indexMedicamento');

    Route::post('admin/farmacia/medicamentos/storeMedicamento', [FarmaciaController::class,'storeMedicamento'])->name('storeMedicamento');

    Route::get('admin/farmacia/medicamentos/editMedicamento/{id}', [FarmaciaController::class,'editMedicamento'])->name('editMedicamento');

    Route::put('admin/farmacia/medicamentos/updateMedicamento/{id}', [FarmaciaController::class,'updateMedicamento'])->name('updateMedicamento');

    Route::delete('admin/farmacia/medicamentos/destroyMedicamento/{id}', [FarmaciaController::class,'destroyMedicamento'])->name('destroyMedicamento');

    Route::get('admin/farmacia/medicamentos/entrada/indexEntradaMedicamento', [FarmaciaController::class,'indexEntradaMedicamento'])->name('indexEntradaMedicamento');

    Route::post('admin/farmacia/medicamentos/entrada/storeEntradaMedicamento', [FarmaciaController::class, 'storeEntradaMedicamento'])->name('storeEntradaMedicamento');


    Route::get('admin/farmacia/medicamentos/codigoDeBarras/createCodigoDeBarras/{id}', [FarmaciaController::class,'createCodigoDeBarras'])->name('createCodigoDeBarras');

    Route::post('admin/farmacia/medicamentos/codigoDeBarras/storeCodigoDeBarras/{id}', [FarmaciaController::class,'storeCodigoDeBarras'])->name('storeCodigoDeBarras');

    Route::get('admin/farmacia/medicamentos/codigoDeBarras/editCodigoDeBarras/{id}', [FarmaciaController::class,'editCodigoDeBarras'])->name('editCodigoDeBarras');

    Route::put('admin/farmacia/medicamentos/codigoDeBarras/updateCodigoDeBarras/{id}', [FarmaciaController::class,'updateCodigoDeBarras'])->name('updateCodigoDeBarras');

    Route::delete('admin/farmacia/medicamentos/codigoDeBarras/destroyCodigoDeBarras/{id}', [FarmaciaController::class, 'destroyCodigoDeBarras'])->name('destroyCodigoDeBarras');

    /******************************************************
     * 
     * 
     * MODULO DE PACIENTES
     * 
     * 
     ******************************************************/

    Route::get('admin/pacientes/buscador-paciente', [PacienteController::class,'buscadorPaciente'])->name('buscadorPaciente');

    Route::post('admin/pacientes/buscar-paciente', [PacienteController::class,'buscarPaciente'])->name('buscarPaciente');

    Route::get('admin/pacientes/create-paciente', [PacienteController::class,'createPaciente'])->name('createPaciente');

    Route::post('admin/pacientes/store-paciente', [PacienteController::class,'pacienteStore'])->name('pacienteStore');

    Route::get('admin/pacientes/index-paciente', [PacienteController::class,'pacientesIndex'])->name('pacientesIndex');

    Route::get('admin/pacientes/show-paciente/{id}', [PacienteController::class,'pacientesShow'])->name('pacientesShow');

    Route::get('admin/pacientes/edit-paciente/{id}', [PacienteController::class,'pacientesEdit'])->name('pacientesEdit');

    Route::put('admin/pacientes/update-paciente/{id}', [PacienteController::class,'pacientesUpdate'])->name('pacientesUpdate');

    Route::get('admin/pacientes/expediente-paciente/{id}', [PacienteController::class,'pacientesExpediente'])->name('pacientesExpediente');

    Route::put('admin/pacientes/expediente-paciente-store/{id}', [PacienteController::class,'pacienteExpedienteUpdate'])->name('pacienteExpedienteUpdate');

    /******************************************************
     * 
     * 
     * MODULO DE CITAS
     * 
     * 
     ******************************************************/

    Route::get('admin/citas/buscador-cita', [CitaController::class,'buscadorCita'])->name('buscadorCita');

    Route::post('admin/citas/mostrar-horarios-disponibles', [CitaController::class,'mostrarHorariosDisponibles'])->name('mostrarHorariosDisponibles');

    Route::get('admin/citas/create-cita', [CitaController::class,'createCita'])->name('createCita');

    Route::post('admin/citas/store-cita', [CitaController::class,'storeCita'])->name('storeCita');

    Route::post('admin/citas/medico-agenda-citas', [CitaController::class,'medicoAgendaCita'])->name('medicoAgendaCita');

    Route::delete('admin/citas/medico-agenda-citas-destroy/{id}', [CitaController::class,'medicoAgendaCitaDestroy'])->name('medicoAgendaCitaDestroy');

    Route::get('admin/citas/reporte-citas', [CitaController::class, 'reportePDFCitas'])->name('reportePDFCitas');

    /******************************************************
     * 
     * 
     * MODULO DE CONSULTA EXTERNA
     * 
     * 
     ******************************************************/

    Route::get('admin/consulta-externa/medico/mis-citas',[ConsultaExternaController::class, 'medicoMisCitas'])->name('medicoMisCitas');

    Route::get('admin/medicos/consulta/iniciar-cita/{id}', [ConsultaExternaController::class, 'iniciarCita'])->name('iniciarCita');

    Route::get('admin/consulta-externa/central-enfermeria/mis-citas',[ConsultaExternaController::class, 'centralEnfermeriaMisCitas'])->name('centralEnfermeriaMisCitas');

    Route::get('admin/consulta-externa/central-enfermeria/toma-signos-vitales-create/{id}',[ConsultaExternaController::class, 'centralEnfermeriaTomaSignosVitalesCreate'])->name('centralEnfermeriaTomaSignosVitalesCreate');

    Route::put('admin/consulta-externa/central-enfermeria/toma-signos-vitales-update/{id}',[ConsultaExternaController::class, 'centralEnfermeriaTomaSignosVitalesUpdate'])->name('centralEnfermeriaTomaSignosVitalesUpdate');

    Route::get('admin/consulta-externa/central-enfermeria/toma-signos-vitales-show/{id}',[ConsultaExternaController::class, 'centralEnfermeriaTomaSignosVitalesShow'])->name('centralEnfermeriaTomaSignosVitalesShow');

    
    /******************************************************
     * 
     * 
     * MODULO DE SETTINGS
     * 
     * 
     ******************************************************/

    Route::get('admin/settings/index', [SettingsController::class,'index'])->name('index');

    /******************************************************
     * 
     * 
     * TIPO DE CANCER
     * 
     * 
     ******************************************************/

    Route::get('admin/settings/tipos-de-cancer/index', [TipoDeCancerController::class,'tiposDeCancerIndex'])->name('tiposDeCancerIndex');

    Route::get('admin/settings/tipos-de-cancer/create', [TipoDeCancerController::class,'tiposDeCancerCreate'])->name('tiposDeCancerCreate');

    Route::post('admin/settings/tipos-de-cancer/store', [TipoDeCancerController::class,'tiposDeCancerStore'])->name('tiposDeCancerStore');

    Route::get('admin/settings/tipos-de-cancer/edit/{id}', [TipoDeCancerController::class,'tiposDeCancerEdit'])->name('tiposDeCancerEdit');

    Route::put('admin/settings/tipos-de-cancer/update/{id}', [TipoDeCancerController::class,'tiposDeCancerUpdate'])->name('tiposDeCancerUpdate');

    Route::delete('admin/settings/tipos-de-cancer/destroy/{id}', [TipoDeCancerController::class, 'tiposDeCancerDestroy'])->name('tiposDeCancerDestroy');

    /******************************************************
     * 
     * 
     * MEDICOS
     * 
     * 
     ******************************************************/

    Route::get('admin/settings/medicos/index', [MedicoController::class,'medicosIndex'])->name('medicosIndex');

    Route::get('admin/settings/medicos/show/{id}', [MedicoController::class,'medicosShow'])->name('medicosShow');

    Route::get('admin/settings/medicos/create', [MedicoController::class,'medicosCreate'])->name('medicosCreate');

    Route::post('admin/settings/medicos/store', [MedicoController::class,'medicosStore'])->name('medicosStore');

    Route::get('admin/settings/medicos/edit/{id}', [MedicoController::class,'medicosEdit'])->name('medicosEdit');

    Route::put('admin/settings/medicos/update/{id}', [MedicoController::class,'medicosUpdate'])->name('medicosUpdate');

    Route::put('admin/settings/medicos/destroy/{id}', [MedicoController::class, 'medicosDestroy'])->name('medicosDestroy');

    Route::get('admin/settings/medicos/vacacionesCreate/{id}', [MedicoController::class,'medicosVacacionesCreate'])->name('medicosVacacionesCreate');

    Route::post('admin/settings/medicos/vacacionesStore/{id}', [MedicoController::class,'medicosVacacionesStore'])->name('medicosVacacionesStore');

     /******************************************************
     * 
     * 
     * ESPECIALIDADES
     * 
     * 
     ******************************************************/

    Route::get('admin/settings/especialidades-medicas/index', [CatEspecialidadMedicaController::class,'especialidadesMedicasIndex'])->name('especialidadesMedicasIndex');

    Route::get('admin/settings/especialidades-medicas/create', [CatEspecialidadMedicaController::class,'especialidadesMedicasCreate'])->name('especialidadesMedicasCreate');

    Route::post('admin/settings/especialidades-medicas/store', [CatEspecialidadMedicaController::class,'especialidadesMedicasStore'])->name('especialidadesMedicasStore');

    Route::get('admin/settings/especialidades-medicas/edit/{id}', [CatEspecialidadMedicaController::class,'especialidadesMedicasEdit'])->name('especialidadesMedicasEdit');

    Route::put('admin/settings/especialidades-medicas/update/{id}', [CatEspecialidadMedicaController::class,'especialidadesMedicasUpdate'])->name('especialidadesMedicasUpdate');

    Route::delete('admin/settings/especialidades-medicas/destroy/{id}', [CatEspecialidadMedicaController::class, 'especialidadesMedicasDestroy'])->name('especialidadesMedicasDestroy');

    /******************************************************
     * 
     * 
     * AFILIACIONES
     * 
     * 
     ******************************************************/

    Route::get('admin/settings/afiliaciones/index', [CatAfiliacionesController::class,'afiliacionesIndex'])->name('afiliacionesIndex');

    Route::get('admin/settings/afiliaciones/create', [CatAfiliacionesController::class,'afiliacionesCreate'])->name('afiliacionesCreate');

    Route::post('admin/settings/afiliaciones/store', [CatAfiliacionesController::class,'afiliacionesStore'])->name('afiliacionesStore');

    Route::get('admin/settings/afiliaciones/edit/{id}', [CatAfiliacionesController::class,'afiliacionesEdit'])->name('afiliacionesEdit');

    Route::put('admin/settings/afiliaciones/update/{id}', [CatAfiliacionesController::class,'afiliacionesUpdate'])->name('afiliacionesUpdate');

    Route::delete('admin/settings/afiliaciones/destroy/{id}', [CatAfiliacionesController::class, 'afiliacionesDestroy'])->name('afiliacionesDestroy');

    /******************************************************
     * 
     * 
     * USUARIOS
     * 
     * 
     ******************************************************/

    Route::get('admin/settings/usuarios/index', [UserController::class,'usuariosIndex'])->name('usuariosIndex');

    Route::get('admin/settings/usuarios/create', [UserController::class,'usuariosCreate'])->name('usuariosCreate');

    Route::post('admin/settings/usuarios/store', [UserController::class,'usuariosStore'])->name('usuariosStore');

    Route::get('admin/settings/usuarios/edit/{id}', [UserController::class,'usuariosEdit'])->name('usuariosEdit');

    Route::put('admin/settings/usuarios/update/{id}', [UserController::class,'usuariosUpdate'])->name('usuariosUpdate');

    Route::delete('admin/settings/usuarios/destroy/{id}', [UserController::class, 'usuariosDestroy'])->name('usuariosDestroy');





});