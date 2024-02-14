<?php

namespace App\Http\Controllers;

use App\Models\Street;
use Illuminate\Http\Request;

class StreetController extends Controller
{
    public function index()
    {
        return Street::index();
    }

    public function store(Request $request)
    {
        return Street::store($request->all());
    }

    public function edit(Request $request, $id)
    {
        return Street::edit($request->all(), $id);
    }

    public function destroy(Request $request, $id)
    {
        return Street::destroy($id);
    }
}
