<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Definitions\Area;
use App\Models\System\Definitions\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AreaController extends Controller
{
    public function index(): \Inertia\Response
    {
        $column = request('column');
        $dir = request('direction');
        $perPage = request('perPage');

        if ($column || $dir != '') {
            request()->validate([
                'direction' => ['in:asc,desc'],
                'column' => ['in:id,is_active,name,notes'],
            ]);
        }

        $query = Area::query()->with('district')->orderBy($column != '' ? $column : 'id', $dir != '' ? $dir : 'desc');

        if (request('search')) {
            $query->where('name', 'LIKE', '%'.request('search').'%');
        }

        return Inertia::render('System/Definitions/ServiceSpots/Area/Index', [
            'records' => $query->paginate($perPage != '' ? $perPage: 5)->withQueryString(),
            'filters' => request()->all(['search', 'column', 'direction', 'perPage', 'page'])
        ]);
    }

    public function create(): \Inertia\Response
    {
        $districts = District::where('is_active', 1)->get();
        return Inertia::render('System/Definitions/ServiceSpots/Area/Create', [
            'districts' => $districts
        ]);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required',
        ]);
        Area::create($request->all());
        return Redirect::route('system.definitions.spots.areas.index')->with('success', 'Service Area Created!');
    }

    public function show($id): \Inertia\Response
    {
        $record = Area::findOrFail($id);
        $districts = District::where('is_active', 1)->get();
        return Inertia::render('System/Definitions/ServiceSpots/Area/Update', [
            'area' => $record,
            'districts' => $districts
        ]);
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $record = Area::findOrFail($id);
        $record->update($request->all());
        return Redirect::route('system.definitions.spots.areas.index')->with('success', 'Service Area Updated!');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $record = Area::findOrFail($id);
        $record->delete();
        return redirect()->route('system.definitions.spots.areas.index')->with('success', 'Service Area Deleted!');
    }
}
