<?php

namespace App\Http\Controllers;

use App\Models\Opinion;
use Illuminate\Http\Request;

class OpinionController extends Controller
{
    public function create()
    {
        // Traemos SOLO las opiniones de 5 a 10 estrellas para mostrarlas abajo del formulario
        $opinionesDestacadas = Opinion::with('usuario')
            ->whereBetween('valoracion', [5, 10])
            ->latest()
            ->get();

        // Le pasamos las opiniones destacadas a la vista del formulario
        return view('opiniones.create', compact('opinionesDestacadas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto' => 'required|string|max:255',
            'nombre_persona' => 'required|string|max:255',
            'valoracion' => 'required|integer|min:1|max:10',
            'comentario' => 'required|string',
        ]);

        Opinion::create([
            'producto' => $request->producto,
            'nombre_persona' => $request->nombre_persona,
            'valoracion' => $request->valoracion,
            'comentario' => $request->comentario,
            'user_id' => auth()->check() ? auth()->id() : null,
        ]);

        return redirect()->back()->with('success', 'Opinión registrada correctamente.');
    }

    public function index()
    {
        // Volvemos a mostrar TODAS las opiniones en la lista de gestión interna
        $opiniones = Opinion::with('usuario')->latest()->get();

        return view('opiniones.index', compact('opiniones'));
    }

    public function edit(Opinion $opinion)
    {
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        return view('opiniones.edit', compact('opinion'));
    }

    public function update(Request $request, Opinion $opinion)
    {
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        $request->validate([
            'producto' => 'required|string|max:255',
            'nombre_persona' => 'required|string|max:255',
            'valoracion' => 'required|integer|min:1|max:10',
            'comentario' => 'required|string',
        ]);

        $opinion->update([
            'producto' => $request->producto,
            'nombre_persona' => $request->nombre_persona,
            'valoracion' => $request->valoracion,
            'comentario' => $request->comentario,
        ]);

        return redirect()
            ->route('opiniones.index')
            ->with('success', 'Opinión actualizada correctamente.');
    }

    public function destroy(Opinion $opinion)
    {
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        $opinion->delete();

        return redirect()->back()->with('success', 'Opinión eliminada correctamente.');
    }
}