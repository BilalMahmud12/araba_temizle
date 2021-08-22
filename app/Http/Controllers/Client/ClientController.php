<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function login(): \Inertia\Response
    {
        return Inertia::render('Client/Auth/Login', []);
    }


    public function check(Request $request)
    {
        $request->validate([
            'phone' => 'required|regex:/(5)[0-9]{9}/|max:10',
            'password' => 'required|min:8|max:30'
        ], [
            'phone.exists' => 'This phone does not exist in our records'
        ]);

        $creds = $request->only('phone', 'password');

        if ( Auth::guard('client')->attempt($creds) ) {
            return redirect()->route('client.index');
        } else {
            return redirect()->route('client.login')->with('fail', 'Incorrect Phone Number Or Password');
        }
    }
}
