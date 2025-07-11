<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use App\Models\Bien;
use App\Models\User;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'fecha_programada');
        $direction = $request->get('direction', 'asc');

        $query = Mantenimiento::query();

        if ($sort === 'bien_nombre') {
            $query->join('bienes', 'mantenimientos.bien_id', '=', 'bienes.id')
                  ->select('mantenimientos.*')
                  ->with('bien')
                  ->orderBy('bienes.nombre', $direction);
        } elseif (in_array($sort, ['tipo', 'fecha_programada', 'responsable', 'estado'])) {
            $query->with('bien')->orderBy($sort, $direction);
        } else {
            $query->with('bien')->orderBy('fecha_programada', 'asc');
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('responsable')) {
            $query->where('responsable', 'like', '%' . $request->responsable . '%');
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('fecha_programada', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha_programada', '<=', $request->fecha_hasta);
        }

        $mantenimientos = $query->paginate(10)->appends($request->all());

        return view('mantenimientos.index', compact('mantenimientos', 'sort', 'direction'));
    }

    public function create()
    {
        $bienes = Bien::where('requiere_mantenimiento', true)->get();
        $usuarios = User::where('rol', 'subrogado')->get();

        return view('mantenimientos.create', compact('bienes', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bien_id' => 'required|exists:bienes,id',
            'tipo' => 'required|string|max:255',
            'fecha_programada' => 'required|date',
            'estado' => 'required|in:pendiente,realizado,cancelado',
            'responsable' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        Mantenimiento::create($request->all());

        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento creado correctamente.');
    }

    public function show(Mantenimiento $mantenimiento)
    {
        return view('mantenimientos.show', compact('mantenimiento'));
    }

    public function edit(Mantenimiento $mantenimiento)
    {
        $bienes = Bien::where('requiere_mantenimiento', true)->get();
        $usuarios = User::where('rol', 'subrogado')->get();

        return view('mantenimientos.edit', compact('mantenimiento', 'bienes', 'usuarios'));
    }

    public function update(Request $request, Mantenimiento $mantenimiento)
    {
        $request->validate([
            'tipo' => 'required|string|max:255',
            'fecha_programada' => 'required|date',
            'estado' => 'required|in:pendiente,realizado,cancelado',
            'responsable' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        $mantenimiento->update($request->all());

        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento actualizado correctamente.');
    }

    public function destroy(Mantenimiento $mantenimiento)
    {
        $mantenimiento->delete();

        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento eliminado correctamente.');
    }
}

