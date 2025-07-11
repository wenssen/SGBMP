<?php

namespace App\Imports;

use App\Models\Bien;
use Maatwebsite\Excel\Concerns\ToModel;

class BienesImport implements ToModel
{
    public function model(array $row)
    {
        return new Bien([
            'nombre' => $row[0],
            'descripcion' => $row[1],
            'categoria' => $row[2],
            'ubicacion' => $row[3],
            'fecha_adquisicion' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4]),
            'requiere_mantenimiento' => $row[5] === 'sí' ? true : false,
        ]);
    }
}

