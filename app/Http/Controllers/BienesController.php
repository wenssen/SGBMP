<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bien;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;

class BienesController extends Controller
{
    public function index(Request $request)
    {
        $query = Bien::query();

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        if ($request->filled('ubicacion')) {
            $query->where('ubicacion', $request->ubicacion);
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('fecha_adquisicion', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha_adquisicion', '<=', $request->fecha_hasta);
        }

        $sort = $request->get('sort', 'nombre');
        $direction = $request->get('direction', 'asc');

        $validSorts = ['nombre', 'categoria', 'ubicacion', 'fecha_adquisicion'];
        if (!in_array($sort, $validSorts)) {
            $sort = 'nombre';
        }

        $query->orderBy($sort, $direction);

        $categorias = Bien::select('categoria')->distinct()->pluck('categoria');
        $ubicaciones = Bien::select('ubicacion')->distinct()->pluck('ubicacion');

        $bienes = $query->paginate(10)->appends($request->all());

        return view('bienes.index', compact('bienes', 'categorias', 'ubicaciones', 'sort', 'direction'));
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
            'requiere_mantenimiento' => 'required|in:0,1',
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
            'requiere_mantenimiento' => $request->input('requiere_mantenimiento') == '1',
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

    // ========== Importación desde Excel ==========
    public function importForm()
    {
        return view('bienes.import');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:xlsx,xls'
        ]);

        $archivo = $request->file('archivo');

        try {
            $spreadsheet = IOFactory::load($archivo);
            $hoja = $spreadsheet->getActiveSheet();
            $filas = $hoja->toArray();

            foreach ($filas as $i => $fila) {
                if ($i === 0) continue; // Saltar encabezado

                $bien = new Bien([
                    'nombre' => $fila[0] ?? null,
                    'categoria' => $fila[1] ?? null,
                    'ubicacion' => $fila[2] ?? null,
                    'cantidad' => $fila[3] ?? 1,
                    'fecha_adquisicion' => $fila[4] ?? null,
                    'descripcion' => $fila[5] ?? null,
                    'requiere_mantenimiento' => ($fila[6] ?? 0) == 1,
                ]);

                $bien->save();
            }

            return redirect()->route('bienes.index')->with('success', 'Bienes importados correctamente.');

        } catch (\Exception $e) {
            Log::error('Error al importar Excel: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al importar archivo.');
        }
    }
}

