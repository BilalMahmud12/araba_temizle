<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Definitions\Area;
use App\Models\System\Definitions\BuildingBlock;
use App\Models\System\Definitions\District;
use App\Models\System\Definitions\ServiceSpot;
use App\Models\System\Definitions\ServiceSpotType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ServiceSpotController extends Controller
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

        $query = ServiceSpot::query()
            ->with('spotType')
            ->with('area')
            ->with('district')
            ->orderBy($column != '' ? $column : 'id', $dir != '' ? $dir : 'desc');

        if (request('search')) {
            $query->where('name', 'LIKE', '%'.request('search').'%');
        }
        return Inertia::render('System/Definitions/ServiceSpots/ServiceSpot/Index', [
            'records' => $query->paginate($perPage != '' ? $perPage: 5)->withQueryString(),
            'filters' => \request()->all(['search', 'column', 'direction', 'perPage', 'page'])
        ]);
    }

    public function create(): \Inertia\Response
    {
        $types = ServiceSpotType::where('is_active', 1)->get();
        $areas = Area::where('is_active', 1)->get();
        return Inertia::render('System/Definitions/ServiceSpots/ServiceSpot/Create', [
            'spotTypes' => $types,
            'areas' => $areas,
        ]);
    }

    public function store(): \Illuminate\Http\RedirectResponse
    {
        request()->validate([
            'name' => 'required',
            'spot_type_id' => 'required',
            'area_id' => 'required',
        ]);
        ServiceSpot::create(request()->all());
        return Redirect::route('system.definitions.spots.service-spots.index')->with('success', 'Service Spot Created!');
    }

    public function show($id): \Inertia\Response
    {

        // Building Blocks Index
        $column = request('column');
        $dir = request('direction');
        $perPage = request('perPage');

        if ($column || $dir != '') {
            request()->validate([
                'direction' => ['in:asc,desc'],
                'column' => ['in:id,is_active,name,notes'],
            ]);
        }

        $query = BuildingBlock::query()->orderBy($column != '' ? $column : 'id', $dir != '' ? $dir : 'desc');

        $record = ServiceSpot::findOrFail($id);
        $types = ServiceSpotType::where('is_active', 1)->get();
        $areas = Area::where('is_active', 1)->get();

        return Inertia::render('System/Definitions/ServiceSpots/ServiceSpot/Update', [
            'serviceSpot' => $record,
            'spotTypes' => $types,
            'areas' => $areas,
            'records' => $query->paginate($perPage != '' ? $perPage: 5)->withQueryString(),
            'filters' => request()->all(['column', 'direction', 'perPage', 'page'])
        ]);

    }

    public function update($id): \Illuminate\Http\RedirectResponse
    {
        request()->validate([
            'name' => 'required',
            'spot_type_id' => 'required',
            'area_id' => 'required',
        ]);
        $record = ServiceSpot::findOrFail($id);
        $record->update(request()->all());
        return Redirect::route('system.definitions.spots.service-spots.index')->with('success', 'Service Spot Updated!');
    }

    public function destroy($id)
    {
        $record = ServiceSpot::findOrFail($id);
        $record->delete();
        return Redirect::route('system.definitions.spots.service-spots.index')->with('success', 'Service Spot Deleted!');
    }
}
