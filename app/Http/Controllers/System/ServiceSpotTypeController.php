<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Definitions\ServiceSpotType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ServiceSpotTypeController extends Controller
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

        $query = ServiceSpotType::query()->orderBy($column != '' ? $column : 'id', $dir != '' ? $dir : 'desc');

        if (request('search')) {
            $query->where('name', 'LIKE', '%'.request('search').'%');
        }
        return Inertia::render('System/Definitions/ServiceSpots/ServiceSpotType/Index', [
            'records' => $query->paginate($perPage != '' ? $perPage: 5)->withQueryString(),
            'filters' => \request()->all(['search', 'column', 'direction', 'perPage', 'page'])
        ]);
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('System/Definitions/ServiceSpots/ServiceSpotType/Create', []);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required'
        ]);
        ServiceSpotType::create($request->all());
        return Redirect::route('system.definitions.spots.service-spot-type.index')->with('success', 'Service Spot Type Created!');
    }

    public function show($id): \Inertia\Response
    {
        $record = ServiceSpotType::findOrFail($id);
        return Inertia::render('System/Definitions/ServiceSpots/ServiceSpotType/Update', [
            'spotType' => $record
        ]);
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $record = ServiceSpotType::findOrFail($id);
        $request->validate([
            'name' => 'required'
        ]);
        $record->update($request->all());
        return Redirect::route('system.definitions.spots.service-spot-type.index')->with('success', 'Service Spot Type Updated!');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $record = ServiceSpotType::findOrFail($id);
        $record->delete();
        return Redirect::route('system.definitions.spots.service-spot-type.index')->with('success', 'Service Spot Type Deleted!');
    }
}
