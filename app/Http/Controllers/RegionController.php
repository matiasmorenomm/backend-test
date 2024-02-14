<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        return Region::index();
    }

    public function store(Request $request)
    {
        return Region::store($request->all());
    }

    public function edit(Request $request, $id)
    {
        return Region::edit($request->all(), $id);
    }

    public function destroy(Request $request, $id)
    {
        return Region::destroy($id);
    }
}
