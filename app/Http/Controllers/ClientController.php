<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class ClientController extends Controller
{
    //
    public function index()
{
    if (Auth::check() && Auth::user()->role === 'client') {
        return view('client.dashboard');
    }

    return redirect('/admin/dashboard');
}

}
