<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lead\LeadApiStoreRequest;
use App\Services\LeadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SupplierLeadApiController extends Controller
{
    public function __construct(
        private readonly LeadService $leadService
    ) {}

    public function store(LeadApiStoreRequest $request): JsonResponse
    {
        try {
            $supplier = $request->user();

            if (!$supplier) {
                return response()->json([
                    'error' => 'Supplier not authenticated',
                    'message' => 'Supplier authentication error'
                ], 401);
            }

            $data = $request->validated();
            $data['supplier_id'] = $supplier->id;
            $data['broker_id'] = null;

            $lead = $this->leadService->createLeadForSupplier($data, $supplier);

            return response()->json([
                'success' => true,
                'message' => 'Lead created successfully',
                'data' => [
                    'lead_id' => $lead->id,
                    'supplier_id' => $lead->supplier_id,
                    'supplier_name' => $supplier->name,
                    'created_at' => $lead->created_at
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error creating lead',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $supplier = $request->user();

            if (!$supplier) {
                return response()->json([
                    'error' => 'Supplier not authenticated',
                    'message' => 'Supplier authentication error'
                ], 401);
            }

            $leads = $this->leadService->getLeadsBySupplier($supplier->id);

            return response()->json([
                'success' => true,
                'data' => [
                    'leads' => $leads,
                    'total' => $leads->count()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error fetching leads',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function show(Request $request, int $id): JsonResponse
    {
        try {
            $supplier = $request->user();

            if (!$supplier) {
                return response()->json([
                    'error' => 'Supplier not authenticated',
                    'message' => 'Supplier authentication error'
                ], 401);
            }

            $lead = $this->leadService->getLeadByIdAndSupplier($id, $supplier->id);

            return response()->json([
                'success' => true,
                'data' => $lead
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error fetching lead',
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
