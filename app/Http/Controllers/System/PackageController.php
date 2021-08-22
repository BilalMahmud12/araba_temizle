<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Definitions\Package;
use App\Models\System\Definitions\PackageCategory;
use App\Models\System\Definitions\ServiceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PackageController extends Controller
{

    public function index(): \Inertia\Response
    {
        $column = request('column');
        $dir = request('direction');
        $perPage = request('perPage');

        if ($column || $dir != '') {
            request()->validate([
                'direction' => ['in:asc,desc'],
                'column' => ['in:id,is_active,name,price,package_category_id,service_contract_id,notes'],
            ]);
        }
        $query = Package::query()
            ->with('packageCategory')
            ->with('serviceContract')
            ->orderBy($column != '' ? $column : 'id', $dir != '' ? $dir : 'desc');
        if (request('search')) {
            $query->where('name', 'LIKE', '%'.request('search').'%');
        }

        return Inertia::render('System/Definitions/Packages/Index', [
            'records' => $query->paginate($perPage != '' ? $perPage: 5)->withQueryString(),
            'filters' => \request()->all(['search', 'column', 'direction', 'perPage', 'page'])
        ]);
    }


    public function create(): \Inertia\Response
    {
        $categories = PackageCategory::where('is_active', 1)->select('id', 'name')->orderByDesc('id')->get();
        $contracts = ServiceContract::where('is_active', 1)->select('id', 'name')->orderByDesc('id')->get();
        return Inertia::render('System/Definitions/Packages/Create', [
            'categories' => $categories,
            'contracts' => $contracts
        ]);
    }


    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'package_category_id' => 'required',
            'service_contract_id' => 'required',
        ]);
        Package::create($request->all());
        return Redirect::route('system.definitions.packages.index')->with('success', 'Service Package Created!');
    }


    public function show($id): \Inertia\Response
    {
        $record = Package::findOrFail($id);
        $categories = PackageCategory::where('is_active', 1)->select('id', 'name')->orderByDesc('id')->get();
        $contracts = ServiceContract::where('is_active', 1)->select('id', 'name')->orderByDesc('id')->get();
        return Inertia::render('System/Definitions/Packages/Update', [
            'package' => $record,
            'categories' => $categories,
            'contracts' => $contracts
        ]);
    }


    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $record = Package::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'package_category_id' => 'required',
            'service_contract_id' => 'required',
        ]);

        $record->update(request()->all());
        return Redirect::route('system.definitions.packages.index')->with('success', 'Service Package Updated!');
    }


    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $record = Package::findOrFail($id);
        $record->delete();
        return redirect()->route('system.definitions.packages.index')->with('success', 'Service Package Deleted!');
    }
}
