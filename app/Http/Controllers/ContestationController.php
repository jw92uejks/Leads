<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContestationController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'openModal' => $request->has('modal') && $request->get('modal') === 'new',
            'selectedLeadId' => $request->get('lead_id'),
        ];
        
        return view('pclient.contestation.index', $data);
    }
}
