<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class)->with('region');
    }

    public static function index()
    {
        return response()->json(
            [
                'object' => City::all(),
            ]
        );
    }

    public static function store($data)
    {

        if (!isset($data['name'])) {
            return response()->json(
                [
                    'message' => 'El nombre de la ciudad es obligatorio'
                ],
                400
            );
        }

        if (!isset($data['province_id'])) {
            return response()->json(
                [
                    'message' => 'La provincia es obligatoria'
                ],
                400
            );
        }

        $province = Province::find($data['province_id']);

        if (!$province) {
            return response()->json(
                [
                    'message' => 'No existe la provincia seleccionada'
                ],
                400
            );
        }

        $city = City::where('name', $data['name'])->first();

        if ($city) {
            return response()->json(
                [
                    'message' => 'Ya existe una ciudad con este nombre'
                ],
                400
            );
        }

        $city = new self();
        $city->name = $data['name'];
        $city->province_id = $province->id;
        $city->save();

        return response()->json(
            [
                'object' => $city,
                'message' => 'Ciudad creada exitosamente'
            ]
        );
    }

    public static function edit($data, $id)
    {

        $city = City::find($id);

        if (!$city) {
            return response()->json(
                [
                    'message' => 'No existe la ciudad'
                ],
                400
            );
        }

        $cityExists = City::where('name', $data['name'])->first();

        if ($cityExists && $cityExists->id != $id) {
            return response()->json(
                [
                    'message' => 'Ya existe una ciudad con ese nombre'
                ],
                400
            );
        }

        $province = Province::find($data['province_id']);

        if (!$province) {
            return response()->json(
                [
                    'message' => 'No existe la provincia seleccionada'
                ],
                400
            );
        }

        $city->name = $data['name'];
        $city->province_id = $province->id;
        $city->save();

        return response()->json(
            [
                'object' => $city,
                'message' => 'Ciudad actualizada exitosamente'
            ]
        );
    }

    public static function destroy($id)
    {

        $city = City::find($id);

        if (!$city) {
            return response()->json(
                [
                    'message' => 'No existe la ciudad'
                ],
                400
            );
        }

        $streets = Province::where('street_id', $id)->get();

        if (count($streets)) {
            return response()->json(
                [
                    'message' => 'Debe eliminar las calles pertenecientes a esta ciudad primero'
                ],
                400
            );
        }

        $city->delete();

        return response()->json(
            [
                'message' => 'Ciudad eliminada exitosamente'
            ]
        );
    }

    public static function citiesForProvince($id)
    {
        $province = Province::find($id);

        if (!$province) {
            return response()->json(
                [
                    'message' => 'No existe la provincia seleccionada'
                ],
                400
            );
        }

        $cities = City::where('province_id', $id)->get();

        return response()->json(
            [
                'object' => $cities,
            ]
        );
    }
}
