<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Definitions\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class DistrictController extends Controller
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

        $query = District::query()->orderBy($column != '' ? $column : 'id', $dir != '' ? $dir : 'desc');

        if (request('search')) {
            $query->where('name', 'LIKE', '%'.request('search').'%');
        }

        return Inertia::render('System/Definitions/ServiceSpots/District/Index', [
            'records' => $query->paginate($perPage != '' ? $perPage: 5)->withQueryString(),
            'filters' => \request()->all(['search', 'column', 'direction', 'perPage', 'page'])
        ]);
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('System/Definitions/ServiceSpots/District/Create', []);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required',
        ]);
        District::create($request->all());
        return Redirect::route('system.definitions.spots.districts.index')->with('success', 'Service District Created!');
    }

    public function show($id): \Inertia\Response
    {
        $record = District::findOrFail($id);
        return Inertia::render('System/Definitions/ServiceSpots/District/Update', [
            'district' => $record
        ]);
    }

    public function update($id): \Illuminate\Http\RedirectResponse
    {
        $record = District::findOrFail($id);
        request()->validate([
            'name' => 'required',
        ]);
        $record->update(request()->all());

        return Redirect::route('system.definitions.spots.districts.index')->with('success', 'Service District Updated!');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $record = District::findOrFail($id);
        $record->delete();
        return redirect()->route('system.definitions.spots.districts.index')->with('success', 'Service District Deleted!');
    }
}
