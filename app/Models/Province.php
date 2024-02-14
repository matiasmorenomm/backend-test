<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Province extends Model
{
    use HasFactory;

    protected $table = 'provinces';

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public static function index()
    {
        return response()->json(
            [
                'object' => Province::all(),
            ]
        );
    }

    public static function store($data)
    {
        $data['name'] = strtoupper($data['name']);
        if (!isset($data['name'])) {
            return response()->json(
                [
                    'message' => 'El nombre de la provincia es obligatorio'
                ],
                400
            );
        }

        if (!isset($data['region_id'])) {
            return response()->json(
                [
                    'message' => 'La region es obligatoria'
                ],
                400
            );
        }

        $region = Region::find($data['region_id']);

        if (!$region) {
            return response()->json(
                [
                    'message' => 'No existe la region seleccionada'
                ],
                400
            );
        }

        $province = Province::where('name', $data['name'])->first();

        if ($province) {
            return response()->json(
                [
                    'message' => 'Ya existe una provincia con este nombre'
                ],
                400
            );
        }

        $province = new self();
        $province->name = $data['name'];
        $province->region_id = $region->id;
        $province->save();

        return response()->json(
            [
                'object' => $province,
                'message' => 'Provincia creada exitosamente'
            ]
        );
    }

    public static function edit($data, $id)
    {

        $data['name'] = strtoupper($data['name']);
        $province = Province::find($id);

        if (!$province) {
            return response()->json(
                [
                    'message' => 'No existe la provincia'
                ],
                400
            );
        }

        $provinceExists = Province::where('name', $data['name'])->first();

        if ($provinceExists && $provinceExists->id != $id) {
            return response()->json(
                [
                    'message' => 'Ya existe una provincia con ese nombre'
                ],
                400
            );
        }

        $region = Region::find($data['region_id']);

        if (!$region) {
            return response()->json(
                [
                    'message' => 'No existe la region seleccionada'
                ],
                400
            );
        }

        $province->name = $data['name'];
        $province->region_id = $region->id;
        $province->save();

        return response()->json(
            [
                'object' => $province,
                'message' => 'Provincia actualizada exitosamente'
            ]
        );
    }

    public static function destroy($id)
    {

        $province = Province::find($id);

        if (!$province) {
            return response()->json(
                [
                    'message' => 'No existe la provincia'
                ],
                400
            );
        }

        $cities = Province::where('province_id', $id)->get();

        if (count($cities)) {
            return response()->json(
                [
                    'message' => 'Debe eliminar las ciudades pertenecientes a esta provincia primero'
                ],
                400
            );
        }

        $province->delete();

        return response()->json(
            [
                'message' => 'Provincia eliminada exitosamente'
            ]
        );
    }

    public static function provincesForRegion($id)
    {
        $region = Region::find($id);

        if (!$region) {
            return response()->json(
                [
                    'message' => 'No existe la region seleccionada'
                ],
                400
            );
        }

        $provinces = Province::where('region_id', $id)->get();

        return response()->json(
            [
                'object' => $provinces,
            ]
        );
    }
}
