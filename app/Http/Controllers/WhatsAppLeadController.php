<?php

namespace App\Http\Controllers;

use App\Services\WhatsAppLeadService;
use Illuminate\View\View;

class WhatsAppLeadController extends Controller
{
    public function __construct(
        private readonly WhatsAppLeadService $leadService
    ) {}

    public function index(): View
    {
        return view($this->leadService->getLeadsView());
    }

    public function create(): View
    {
        return view($this->leadService->getCreateLeadView());
    }
}

