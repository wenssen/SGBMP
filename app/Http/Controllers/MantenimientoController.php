<?php
<<<<<<< HEAD
=======

>>>>>>> 2108499 (Actualizar mantenimientos y notificaciones)
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
<<<<<<< HEAD
        $bienes = Bien::where('requiere_mantenimiento', true)->get();
=======
        $bienes = Bien::all();
>>>>>>> 2108499 (Actualizar mantenimientos y notificaciones)
        return view('mantenimientos.create', compact('bienes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bien_id' => 'required|exists:bienes,id',
<<<<<<< HEAD
            'tipo' => 'required|string|max:100',
            'fecha_programada' => 'required|date',
            'estado' => 'required|string',
            'responsable' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
=======
            'tipo' => 'required|string|max:255',
            'fecha_programada' => 'required|date',
>>>>>>> 2108499 (Actualizar mantenimientos y notificaciones)
        ]);

        Mantenimiento::create($request->all());

<<<<<<< HEAD
        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento registrado.');
=======
        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento creado correctamente.');
    }

    public function show(Mantenimiento $mantenimiento)
    {
        return view('mantenimientos.show', compact('mantenimiento'));
>>>>>>> 2108499 (Actualizar mantenimientos y notificaciones)
    }

    public function edit(Mantenimiento $mantenimiento)
    {
<<<<<<< HEAD
        $bienes = Bien::where('requiere_mantenimiento', true)->get();
        return view('mantenimientos.edit', compact('mantenimiento', 'bienes'));
=======
        return view('mantenimientos.edit', compact('mantenimiento'));
>>>>>>> 2108499 (Actualizar mantenimientos y notificaciones)
    }

    public function update(Request $request, Mantenimiento $mantenimiento)
    {
<<<<<<< HEAD
        $mantenimiento->update($request->all());
        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento actualizado.');
=======
        $request->validate([
            'tipo' => 'required|string|max:255',
            'fecha_programada' => 'required|date',
            'estado' => 'required|in:pendiente,realizado,cancelado',
        ]);

        $mantenimiento->update($request->all());

        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento actualizado correctamente.');
>>>>>>> 2108499 (Actualizar mantenimientos y notificaciones)
    }

    public function destroy(Mantenimiento $mantenimiento)
    {
        $mantenimiento->delete();
<<<<<<< HEAD
        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento eliminado.');
    }
}
=======

        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento eliminado correctamente.');
    }
}
>>>>>>> 2108499 (Actualizar mantenimientos y notificaciones)
