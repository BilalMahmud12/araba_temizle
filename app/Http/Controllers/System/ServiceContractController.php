<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Definitions\ServiceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ServiceContractController extends Controller
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

        $query = ServiceContract::query()->orderBy($column != '' ? $column : 'id', $dir != '' ? $dir : 'desc');

        if (request('search')) {
            $query->where('name', 'LIKE', '%'.request('search').'%');
        }


        return Inertia::render('System/Definitions/Contracts/Index', [
            'records' => $query->paginate($perPage != '' ? $perPage: 5)->withQueryString(),
            'filters' => \request()->all(['search', 'column', 'direction', 'perPage', 'page'])
        ]);
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('System/Definitions/Contracts/Create', []);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required'
        ]);
        ServiceContract::create($request->all());
        return Redirect::route('system.definitions.contracts.index')->with('success', 'Service Contract Created!');
    }

    public function show($id): \Inertia\Response
    {
        $record = ServiceContract::findOrFail($id);
        return Inertia::render('System/Definitions/Contracts/Update', [
            'contract' => $record,
        ]);
    }

    public function update($id): \Illuminate\Http\RedirectResponse
    {
        $record = ServiceContract::findOrFail($id);
        request()->validate([
            'name' => 'required',
            'content' => 'required'
        ]);
        $record->update(request()->all());
        return Redirect::route('system.definitions.contracts.index')->with('success', 'Service Contract Updated!');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $record = ServiceContract::findOrFail($id);
        $record->delete();
        return redirect()->route('system.definitions.contracts.index')->with('success', 'Service Contract Deleted!');
    }
}
