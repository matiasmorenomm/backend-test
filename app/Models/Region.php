<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = 'regions';

    public static function index()
    {
        return response()->json(
            [
                'object' => Region::all(),
            ]
        );
    }

    public static function store($data)
    {

        $region = Region::where('name', $data['name'])->first();

        if ($region) {
            return response()->json(
                [
                    'message' => 'Ya existe una region con este nombre'
                ],
                400
            );
        }

        $region = new self();
        $region->name = $data['name'];
        $region->save();

        return response()->json(
            [
                'object' => $region,
                'message' => 'Region creada exitosamente'
            ]
        );
    }

    public static function edit($data, $id)
    {

        $region = Region::find($id);

        if (!$region) {
            return response()->json(
                [
                    'message' => 'No existe la region'
                ],
                400
            );
        }

        $region = Region::where('name', $data['name'])->first();

        if ($region->id != $id) {
            return response()->json(
                [
                    'message' => 'Ya existe una region con ese nombre'
                ],
                400
            );
        }

        $region->name = $data['name'];
        $region->save();

        return response()->json(
            [
                'object' => $region,
                'message' => 'Region actualizada exitosamente'
            ]
        );
    }

    public static function destroy($id)
    {

        $region = Region::find($id);

        if (!$region) {
            return response()->json(
                [
                    'message' => 'No existe la region'
                ],
                400
            );
        }

        $provinces = Province::where('region_id', $id)->get();

        if (count($provinces)) {
            return response()->json(
                [
                    'message' => 'Debe eliminar las provincias pertenecientes a esta region primero'
                ],
                400
            );
        }

        $region->delete();

        return response()->json(
            [
                'message' => 'Region eliminada exitosamente'
            ]
        );
    }
}
