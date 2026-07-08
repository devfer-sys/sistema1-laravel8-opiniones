<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        $usuarios = User::latest()->get();

        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'rol' => 'required|in:admin,empleado',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function destroy(User $usuario)
    {
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        if ($usuario->id === auth()->id()) {
            return redirect()->back()->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $usuario->delete();

        return redirect()->back()->with('success', 'Usuario eliminado correctamente.');
    }
}