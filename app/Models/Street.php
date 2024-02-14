<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    use HasFactory;

    protected $table = 'streets';

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class)->with('province');
    }

    public static function index()
    {
        return response()->json(
            [
                'object' => Street::with('city')->get(),
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

        if (!isset($data['city_id'])) {
            return response()->json(
                [
                    'message' => 'La ciudad es obligatoria'
                ],
                400
            );
        }

        $city = City::find($data['city_id']);

        if (!$city) {
            return response()->json(
                [
                    'message' => 'No existe la ciudad seleccionada'
                ],
                400
            );
        }

        $street = Street::where('name', $data['name'])->where('city_id', $data['city_id'])->first();

        if ($street) {
            return response()->json(
                [
                    'message' => 'Ya existe una calle con este nombre para la ciudad seleccionada'
                ],
                400
            );
        }

        $street = new self();
        $street->name = $data['name'];
        $street->city_id = $city->id;
        $street->save();

        return response()->json(
            [
                'object' => $street,
                'message' => 'Calle creada exitosamente'
            ]
        );
    }

    public static function edit($data, $id)
    {

        $street = Street::find($id);

        if (!$street) {
            return response()->json(
                [
                    'message' => 'No existe la calle'
                ],
                400
            );
        }

        $streetExists = Street::where('name', $data['name'])->where('city_id', $data['city_id'])->first();

        if ($streetExists && $streetExists->id != $id) {
            return response()->json(
                [
                    'message' => 'Ya existe una calle con ese nombre, en la ciudad seleccionada'
                ],
                400
            );
        }

        $city = City::find($data['city_id']);

        if (!$city) {
            return response()->json(
                [
                    'message' => 'No existe la ciudad seleccionada'
                ],
                400
            );
        }

        $street->name = $data['name'];
        $street->city_id = $city->id;
        $street->save();

        return response()->json(
            [
                'object' => $street,
                'message' => 'Calle actualizada exitosamente'
            ]
        );
    }

    public static function destroy($id)
    {

        $street = Street::find($id);

        if (!$street) {
            return response()->json(
                [
                    'message' => 'No existe la calle seleccionada'
                ],
                400
            );
        }

        $street->delete();

        return response()->json(
            [
                'message' => 'Calle eliminada exitosamente'
            ]
        );
    }
}
