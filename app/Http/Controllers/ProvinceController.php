<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index()
    {
        return Province::index();
    }

    public function store(Request $request)
    {
        return Province::store($request->all());
    }

    public function edit(Request $request, $id)
    {
        return Province::edit($request->all(), $id);
    }

    public function destroy(Request $request, $id)
    {
        return Province::destroy($id);
    }

    public function provincesForRegion(Request $request, $id)
    {
        return Province::provincesForRegion($id);
    }
}
