<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use App\Models\Bien;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    public function index(Request $request)
    {
        $query = Mantenimiento::with('bien');

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('responsable')) {
            $query->where('responsable', 'LIKE', '%' . $request->responsable . '%');
        }

        if ($request->filled('fecha')) {
            $query->whereDate('fecha_programada', $request->fecha);
        }

        $mantenimientos = $query->get();

        return view('mantenimientos.index', compact('mantenimientos'));
    }

    public function create()
    {
        $bienes = Bien::where('requiere_mantenimiento', true)->get(); // Filtrar solo los bienes que requieren mantenimiento
        return view('mantenimientos.create', compact('bienes'));
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

        $mantenimiento = Mantenimiento::create($request->all());

        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento creado correctamente.');
    }

    public function show(Mantenimiento $mantenimiento)
    {
        return view('mantenimientos.show', compact('mantenimiento'));
    }

    public function edit(Mantenimiento $mantenimiento)
    {
        $bienes = Bien::where('requiere_mantenimiento', true)->get(); // Filtrar solo los bienes que requieren mantenimiento
        return view('mantenimientos.edit', compact('mantenimiento', 'bienes'));
    }

    public function update(Request $request, Mantenimiento $mantenimiento)
    {
        $request->validate([
            'tipo' => 'required|string|max:255',
            'fecha_programada' => 'required|date',
            'estado' => 'required|in:pendiente,realizado,cancelado',
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

