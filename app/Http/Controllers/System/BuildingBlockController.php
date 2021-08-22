<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Definitions\BuildingBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BuildingBlockController extends Controller
{

    public function store()
    {
        request()->validate([
            'name' => 'required'
        ]);
        BuildingBlock::create(request()->all());
        return Redirect::back()->with('success', 'Building Block Created!');
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        //
    }
}
