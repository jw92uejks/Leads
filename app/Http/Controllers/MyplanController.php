<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\LeadLimitService;

class MyplanController extends Controller
{
    public function __construct(
        private readonly LeadLimitService $leadLimitService
    ) {}

    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado.');
        }

        $planInfo = $this->leadLimitService->getLeadLimitInfo($user);

        return view('pclient.myplan.index', compact('planInfo'));
    }
}
