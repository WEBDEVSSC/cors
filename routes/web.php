<?php

use App\Http\Controllers\FarmaciaController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TipoDeCancerController;
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




});