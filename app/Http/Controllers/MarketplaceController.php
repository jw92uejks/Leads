<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\Marketplace\SupplierLeadsRequest;
use App\Services\MarketplaceService;

class MarketplaceController extends Controller
{
    public function __construct(
        private readonly MarketplaceService $marketplaceService
    ) {}

    public function index()
    {
        $suppliers = $this->marketplaceService->getApprovedSuppliersWithLeads();
        return view('pclient.marketplace.index', compact('suppliers'));
    }

    public function supplierLeads(SupplierLeadsRequest $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $filters = $request->validated();
        $leads = $this->marketplaceService->getSupplierLeads($id, $filters);

        return view('pclient.marketplace.supplier-leads', compact('supplier', 'leads'));
    }

}
