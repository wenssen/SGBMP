<?php
namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use App\Models\Bien;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    public function index()
    {
        $mantenimientos = Mantenimiento::with('bien')->get();
        return view('mantenimientos.index', compact('mantenimientos'));
    }

    public function create()
    {
        $bienes = Bien::where('requiere_mantenimiento', true)->get();
        return view('mantenimientos.create', compact('bienes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bien_id' => 'required|exists:bienes,id',
            'tipo' => 'required|string|max:100',
            'fecha_programada' => 'required|date',
            'estado' => 'required|string',
            'responsable' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        Mantenimiento::create($request->all());

        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento registrado.');
    }

    public function edit(Mantenimiento $mantenimiento)
    {
        $bienes = Bien::where('requiere_mantenimiento', true)->get();
        return view('mantenimientos.edit', compact('mantenimiento', 'bienes'));
    }

    public function update(Request $request, Mantenimiento $mantenimiento)
    {
        $mantenimiento->update($request->all());
        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento actualizado.');
    }

    public function destroy(Mantenimiento $mantenimiento)
    {
        $mantenimiento->delete();
        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento eliminado.');
    }
}
