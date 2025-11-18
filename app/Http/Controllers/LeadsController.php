<?php

namespace App\Http\Controllers;

use App\Services\LeadService;
use Illuminate\Http\Request;

class LeadsController extends Controller
{
    public function __construct(
        private readonly LeadService $leadService
    ) {}

    public function index(Request $request)
    {
        $leadsAcquired = $this->leadService->getLeadsByBroker($request->user());

        return view('pclient.leads.index', compact('leadsAcquired'));
    }
}
