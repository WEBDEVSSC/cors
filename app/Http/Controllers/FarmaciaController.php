<?php

namespace App\Http\Controllers;

use App\Models\FarmaciaConcepto;
use App\Models\Medicamento;
use App\Models\MedicamentoCodigo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FarmaciaController extends Controller
{
    /**
     * 
     * 
     * MEDICAMENTOS
     * 
     * 
     */

    public function indexMedicamento()
    {
        // Cargamos todos los medicamentos
        $medicamentos = Medicamento::all();
        
        return view('farmacia.medicamentos.index', compact('medicamentos'));
    }

    public function storeMedicamento(Request $request)
    {
        $request->validate([
            'clave' => 'required|string|max:50|unique:medicamentos,clave',
            'nombre'=>'required',
        ],[
            'clave.required' => 'El campo clave es obligatorio.',
            'clave.unique'   => 'La clave ingresada ya existe, debe ser única.',
            'nombre.required'=> 'El campo nombre es obligatorio.',
        ]);

        $medicamento = new Medicamento();

        $medicamento->clave = $request->clave;
        $medicamento->nombre = $request->nombre;

        $medicamento->save();

        return redirect()->route('indexMedicamento')->with('successMedicamento', 'Medicamento registrado correctamente');
    }

    public function editMedicamento($id)
    {
        // Consultamos el medicamento
        $medicamento = Medicamento::with('codigos')->findOrFail($id);

        return view('farmacia.medicamentos.edit-medicamento', compact('medicamento'));
    }

    public function updateMedicamento(Request $request, $id)
    {
        $request->validate([
            'clave' => 'required|string|max:50',Rule::unique('medicamentos')->ignore($id),
            'nombre' => 'required|string|max:255',
        ], [
            'clave.required' => 'La clave es obligatoria',
            'nombre.required' => 'El nombre es obligatorio',
        ]);

        $medicamento = Medicamento::findOrFail($id);

        $medicamento->clave = $request->clave;
        $medicamento->nombre = $request->nombre;

        $medicamento->save();

        return redirect()->route('editMedicamento', $medicamento->id)
                         ->with('updateMedicamento', 'Medicamento actualizado correctamente');
    }

    public function destroyMedicamento($id)
    {
        $medicamento = Medicamento::findOrFail($id);
        $medicamento->delete();

        return redirect()->back()->with('destroyMedicamento', 'Medicamento eliminado correctamente.');
    }


    /**
     * 
     * 
     * CODIGOS DE BARRAS
     * 
     * 
     */

    public function createCodigoDeBarras($id)
    {
        // Consultamos el medicamento
        $medicamento = Medicamento::findOrFail($id);

        // Regresamos la vista con el objeto
        return view('farmacia.codigos-barras.codigo-create', compact('medicamento'));
    }

    public function storeCodigoDeBarras(Request $request, $id)
    {
        // Validamos los datos ingresados
        $request->validate([
            'codigo' => 'required|unique:medicamentos_codigos,codigo',
            'forma_farmaceutica' => 'nullable|string|max:255',
            'marca' => 'nullable|string|max:255',
            'fabricante' => 'nullable|string|max:255',
            'presentacion' => 'nullable|string|max:255',
        ],[
            // CÓDIGO
            'codigo.required' => 'El campo Código es obligatorio.',
            'codigo.unique'   => 'El Código ya está registrado en la base de datos.',
            'codigo.string'   => 'El Código debe ser un texto válido.',
            'codigo.max'      => 'El Código no debe exceder los 255 caracteres.',

            // FORMA FARMACÉUTICA
            'forma_farmaceutica.string' => 'La Forma farmacéutica debe ser un texto válido.',
            'forma_farmaceutica.max'    => 'La Forma farmacéutica no debe exceder los 255 caracteres.',

            // MARCA
            'marca.string' => 'La Marca debe ser un texto válido.',
            'marca.max'    => 'La Marca no debe exceder los 255 caracteres.',

            // FABRICANTE
            'fabricante.string' => 'El Fabricante debe ser un texto válido.',
            'fabricante.max'    => 'El Fabricante no debe exceder los 255 caracteres.',

            // PRESENTACIÓN
            'presentacion.string' => 'La Presentación debe ser un texto válido.',
            'presentacion.max'    => 'La Presentación no debe exceder los 255 caracteres.',
        ]);

        $codigo = new MedicamentoCodigo();

        $codigo->id_medicamento = $id;
        $codigo->codigo = $request->codigo;
        $codigo->forma_farmaceutica = $request->forma_farmaceutica;
        $codigo->marca = $request->marca;
        $codigo->fabricante = $request->fabricante;
        $codigo->presentacion = $request->presentacion;

        $codigo ->save();

        return redirect()->route('createCodigoDeBarras', $id)->with('successCodigoDeBarras', 'Código de Barras registrado correctamente');
    }

    public function editCodigoDeBarras($id)
    {
        $codigoDeBarras = MedicamentoCodigo::findOrFail($id);

        return view('farmacia.codigos-barras.edit-codigo', compact('codigoDeBarras'));
    }

    public function updateCodigoDeBarras(Request $request, $id)
    {
        $request->validate([
            'codigo' => 'required|unique:medicamentos_codigos,codigo,' . $id,
            'forma_farmaceutica' => 'nullable|string|max:255',
            'marca' => 'nullable|string|max:255',
            'fabricante' => 'nullable|string|max:255',
            'presentacion' => 'nullable|string|max:255',
        ],[
            // CÓDIGO
            'codigo.required' => 'El campo Código es obligatorio.',
            'codigo.unique'   => 'El Código ya está registrado en la base de datos.',
            'codigo.string'   => 'El Código debe ser un texto válido.',
            'codigo.max'      => 'El Código no debe exceder los 255 caracteres.',

            // FORMA FARMACÉUTICA
            'forma_farmaceutica.string' => 'La Forma farmacéutica debe ser un texto válido.',
            'forma_farmaceutica.max'    => 'La Forma farmacéutica no debe exceder los 255 caracteres.',

            // MARCA
            'marca.string' => 'La Marca debe ser un texto válido.',
            'marca.max'    => 'La Marca no debe exceder los 255 caracteres.',

            // FABRICANTE
            'fabricante.string' => 'El Fabricante debe ser un texto válido.',
            'fabricante.max'    => 'El Fabricante no debe exceder los 255 caracteres.',

            // PRESENTACIÓN
            'presentacion.string' => 'La Presentación debe ser un texto válido.',
            'presentacion.max'    => 'La Presentación no debe exceder los 255 caracteres.',
        ]);

        $codigoDeBarras = MedicamentoCodigo::findOrFail($id);

        $codigoDeBarras->update([
            'codigo' => $request->codigo,
            'forma_farmaceutica' => $request->forma_farmaceutica,
            'marca' => $request->marca,
            'fabricante' => $request->fabricante,
            'presentacion' => $request->presentacion,
        ]);

        return redirect()->route('createCodigoDeBarras', $codigoDeBarras->id_medicamento)->with('update', 'Código de Barras actualizado correctamente');
    }

    public function destroyCodigoDeBarras($id)
    {
        $codigoDeBarras = MedicamentoCodigo::findOrFail($id);
        $codigoDeBarras->delete();

        return redirect()->route('indexMedicamento')->with('destroyCodigoDeBarras', 'Código de Barras eliminado correctamente');
    }

    /**
     * 
     * 
     * ENTRADA DE MEDICAMENTOS
     * 
     *   
     */

    public function indexEntradaMedicamento()
    {
        $medicamentos = Medicamento::all();
    
        $farmaciaConceptos = FarmaciaConcepto::where('tipo',1)->get();
        
        return view('farmacia.medicamentos.index-entrada-medicamento', compact('farmaciaConceptos', 'medicamentos'));
    }

    public function storeEntradaMedicamento(Request $request)
    {
        $request->validate([
            'medicamento_id' => 'required|exists:medicamentos,id',
            'cantidad' => 'required|integer|min:1|max:100',
            'fecha_caducidad' => 'required|date|after:today',
            'concepto' => 'required|exists:farmacia_conceptos,id',
            'lote' => 'required|string|max:100',
            'requisicion' => 'required|string|max:100',
        ],[
            // MEDICAMENTO
            'medicamento_id.required' => 'Debe seleccionar un medicamento.',
            'medicamento_id.exists'   => 'El medicamento seleccionado no es válido.',

            // CANTIDAD
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.integer'  => 'La cantidad debe ser un número entero.',
            'cantidad.min'      => 'La cantidad mínima permitida es 1.',
            'cantidad.max'      => 'La cantidad máxima permitida es 100.',

            // FECHA CADUCIDAD
            'fecha_caducidad.required' => 'La fecha de caducidad es obligatoria.',
            'fecha_caducidad.date'     => 'Debe ingresar una fecha válida.',
            'fecha_caducidad.after'    => 'La fecha de caducidad debe ser posterior al día actual.',

            // CONCEPTO
            'concepto.required' => 'Debe seleccionar un concepto.',

            // REQUISICIÓN
            'requisicion.required' => 'El número de requisición es obligatorio.',

            // LOTE
            'lote.required' => 'El número de lote es obligatorio.',
        ]);

        dd($request->all());
        

    }
}
