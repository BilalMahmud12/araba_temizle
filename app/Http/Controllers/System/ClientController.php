<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('System/Clients/Index', [
            'records' => [],
            'filters' => [],
        ]);
    }
}
