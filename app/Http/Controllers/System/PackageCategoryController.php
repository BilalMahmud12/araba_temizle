<?php

namespace App\Http\Controllers\System;

use App\Actions\PackageCategory\ListPackageCategory;
use App\Http\Controllers\Controller;
use App\Models\System\Definitions\PackageCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;



class PackageCategoryController extends Controller
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

        $query = PackageCategory::query()->orderBy($column != '' ? $column : 'id', $dir != '' ? $dir : 'desc');

        if (request('search')) {
            $query->where('name', 'LIKE', '%'.request('search').'%');
        }

        return Inertia::render('System/Definitions/Packages/Categories/Index', [
            'records' => $query->paginate($perPage != '' ? $perPage: 5)->withQueryString(),
            'filters' => \request()->all(['search', 'column', 'direction', 'perPage', 'page'])
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
        ]);
        PackageCategory::create($request->all());
        return redirect()->route('system.definitions.package-categories.index')->with('success', 'Package Category Created!');
    }

    public function show($id)
    {
        $record = PackageCategory::findOrFail($id);
        return Inertia::render('System/Definitions/Packages/Categories/Update', [
            'PackageCategory' => $record
        ]);
    }

    public function update($id)
    {
        $record = PackageCategory::findOrFail($id);
        request()->validate([
            'name' => 'required',
        ]);
        $record->update(request()->all());

        return redirect()->route('system.definitions.package-categories.index')->with('success', 'Package Category Updated!');
    }

    public function destroy($id)
    {
        $record = PackageCategory::findOrFail($id);
        $record->delete();
        return redirect()->route('system.definitions.package-categories.index')->with('success', 'Package Category Deleted!');
    }
}
