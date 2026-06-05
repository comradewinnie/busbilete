<?php

namespace App\Http\Controllers;

use App\Models\Stop;

class HomeController extends Controller
{
    public function index()
    {
        $stops = Stop::orderBy('name')->get();
        return view('home', compact('stops'));
    }
}
