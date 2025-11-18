<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FunnelController extends Controller
{
    public function index()
    {
        return view('pclient.funnel.index');
    }
}
