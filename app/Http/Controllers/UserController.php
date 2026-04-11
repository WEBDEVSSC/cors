<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function usuariosIndex()
    {
        $usuarios = User::all();

        return view ('settings.usuarios.index', compact('usuarios'));
    }

    public function usuariosCreate()
    {
        return view ('settings.usuarios.create');
    }

    public function usuariosStore(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required',
        ],[
            'nombre.required' => 'El campo nombre es obligatorio.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo electrónico válida.',
            'email.unique' => 'El email ya está en uso.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'role.required' => 'El campo rol es obligatorio.',
        ]);

        $usuario = new User();
        
        $usuario->name = $request->nombre;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->role = $request->role;

        $usuario->save();

        return redirect()->route('usuariosIndex')->with('success', 'Usuario creado exitosamente.');
    }

    public function usuariosEdit($id)
    {
        $usuario = User::findOrFail($id);

        return view ('settings.usuarios.edit', compact('usuario'));
    }

    public function usuariosUpdate(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
        ],[
            'nombre.required' => 'El campo nombre es obligatorio.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo electrónico válida.',
            'email.unique' => 'El email ya está en uso.',
            'role.required' => 'El campo rol es obligatorio.',
        ]);

        $usuario = User::findOrFail($id);
        
        $usuario->name = $request->nombre;
        $usuario->email = $request->email;

        if ($request->password) 
        {
            $usuario->password = bcrypt($request->password);
        }

        $usuario->role = $request->role;

        $usuario->save();

        return redirect()->route('usuariosIndex')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function usuariosDestroy($id)
    {
        $usuario = User::findOrFail($id);
        
        $usuario->delete();

        return redirect()->route('usuariosIndex')->with('success', 'Usuario eliminado exitosamente.');
    }

    public function usuariosMedicoCreate($id)
    {    
        $usuario = User::findOrFail($id);

        $medicos = Medico::where('status',1)->get();

        return view ('settings.usuarios.asignar-medico-create', compact('usuario', 'medicos'));
    }

    public function usuariosMedicoUpdate(Request $request, $id)
    {
        $request->validate([
            'medico_id' => 'required|exists:medicos,id',
        ],[
            'medico_id.required' => 'El campo médico es obligatorio.',
            'medico_id.exists' => 'El médico seleccionado no es válido.',
        ]);

        $usuario = User::findOrFail($id);
        
        $usuario->id_medico = $request->medico_id;

        $usuario->save();

        return redirect()->route('usuariosIndex')->with('success', 'Médico asignado al usuario exitosamente.');
    }
}
