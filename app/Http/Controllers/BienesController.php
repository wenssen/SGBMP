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
    ]);

    // Determinar qué valores usar
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
    ]);

    return redirect()->route('bienes.index')->with('success', 'Bien registrado con éxito.');
}

    public function edit(Bien $bien)
    {
        return view('bienes.edit', compact('bien'));
    }

    public function update(Request $request, Bien $bien)
    {
        $bien->update($request->all());
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

    public function configuracion()
    {
        return view('bienes.configuracion');
    }
    
    public function show(Bien $bien)
    {
        return view('bienes.show', compact('bien'));
    }

}
