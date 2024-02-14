<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        return City::index();
    }

    public function store(Request $request)
    {
        return City::store($request->all());
    }

    public function edit(Request $request, $id)
    {
        return City::edit($request->all(), $id);
    }

    public function destroy(Request $request, $id)
    {
        return City::destroy($id);
    }

    public function citiesForProvince(Request $request, $id)
    {
        return City::citiesForProvince($id);
    }
}
