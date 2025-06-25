<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bien;

class BienesController extends Controller
{
    public function index()
    {
        $bienes = Bien::all();
        return view('bienes.index', compact('bienes'));
    }

    public function create()
    {
        return view('bienes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'nullable|string|max:255',
            'nuevo_nombre' => 'nullable|string|max:255',
            'categoria' => 'nullable|string|max:100',
            'nueva_categoria' => 'nullable|string|max:100',
            'ubicacion' => 'nullable|string|max:255',
            'nueva_ubicacion' => 'nullable|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'fecha_adquisicion' => 'nullable|date',
            'descripcion' => 'nullable|string',
            'requiere_mantenimiento' => 'required|in:0,1', // 👈 importante
        ]);

        $nombre = $request->input('nuevo_nombre') ?: $request->input('nombre');
        $categoria = $request->input('nueva_categoria') ?: $request->input('categoria');
        $ubicacion = $request->input('nueva_ubicacion') ?: $request->input('ubicacion');

        Bien::create([
            'nombre' => $nombre,
            'categoria' => $categoria,
            'ubicacion' => $ubicacion,
            'cantidad' => $request->input('cantidad'),
            'fecha_adquisicion' => $request->input('fecha_adquisicion'),
            'descripcion' => $request->input('descripcion'),
            'requiere_mantenimiento' => $request->input('requiere_mantenimiento') == '1', 
        ]);

        return redirect()->route('bienes.index')->with('success', 'Bien registrado con éxito.');
    }

    public function edit(Bien $bien)
    {
        return view('bienes.edit', compact('bien'));
    }

    public function update(Request $request, Bien $bien)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string|max:100',
            'ubicacion' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'fecha_adquisicion' => 'nullable|date',
            'descripcion' => 'nullable|string',
            'requiere_mantenimiento' => 'required|in:0,1', 
        ]);

        $bien->update([
            'nombre' => $request->input('nombre'),
            'categoria' => $request->input('categoria'),
            'ubicacion' => $request->input('ubicacion'),
            'cantidad' => $request->input('cantidad'),
            'fecha_adquisicion' => $request->input('fecha_adquisicion'),
            'descripcion' => $request->input('descripcion'),
            'requiere_mantenimiento' => $request->input('requiere_mantenimiento') == '1', // 👈 cambio clave
        ]);

        return redirect()->route('bienes.index')->with('success', 'Bien actualizado con éxito.');
    }

    public function destroy($id)
    {
        $bien = Bien::find($id);

        if (!$bien) {
            return redirect()->route('bienes.index')->with('error', 'Bien no encontrado.');
        }

        $bien->delete();

        return redirect()->route('bienes.index')->with('success', 'Bien eliminado correctamente.');
    }

    public function show(Bien $bien)
    {
        return view('bienes.show', compact('bien'));
    }
}

