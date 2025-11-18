<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConnectController extends Controller
{
    public function index()
    {
        return view('pclient.connect.index');
    }

    public function create()
    {
        return view('pclient.connect.create');
    }

    public function edit($instance)
    {
        return view('pclient.connect.edit', compact('instance'));
    }
}
