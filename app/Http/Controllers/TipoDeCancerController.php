<?php

namespace App\Http\Controllers;

use App\Models\CatTipoDeCancer;
use Illuminate\Http\Request;

class TipoDeCancerController extends Controller
{
    //
    public function tiposDeCancerIndex()
    {
        $tiposDeCancer = CatTipoDeCancer::all();

        return view('settings.tipos-de-cancer.index', compact('tiposDeCancer'));
    }

    public function tiposDeCancerCreate()
    {
        return view('settings.tipos-de-cancer.create');
    }

    public function tiposDeCancerStore(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ],[
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
            'nombre.max' => 'El campo nombre no debe exceder los 255 caracteres.',
        ]);

        $tiposDeCancer = new CatTipoDeCancer();

        $tiposDeCancer->nombre = $request->nombre;
        
        $tiposDeCancer->save();

        return redirect()->route('tiposDeCancerIndex')->with('success', 'Tipo de Cancer creado exitosamente.');
    }

    public function tiposDeCancerEdit($id)
    {
        $tipoDeCancer = CatTipoDeCancer::findOrFail($id);

        return view('settings.tipos-de-cancer.edit', compact('tipoDeCancer'));
    }

    public function tiposDeCancerUpdate(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ],[
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
            'nombre.max' => 'El campo nombre no debe exceder los 255 caracteres.',
        ]);

        $tipo = CatTipoDeCancer::findOrFail($id);

        $tipo->nombre = $request->nombre;
        $tipo->save();

        return redirect()->route('tiposDeCancerIndex')->with('success', 'Tipo de Cancer actualizado exitosamente.');
    }

    public function tiposDeCancerDestroy($id)
    {
        $tipo = CatTipoDeCancer::findOrFail($id);
        $tipo->delete();

        return redirect()->route('tiposDeCancerIndex')->with('success', 'Tipo de Cancer eliminado exitosamente.');
    }
}
