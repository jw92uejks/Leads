<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Lead;
use App\Services\LeadLimitService;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function __construct(
        private readonly LeadLimitService $leadLimitService
    ) {}
    public function index()
    {
        $brokerId = auth()->user()->broker->id;

        $items = CartItem::with('lead.supplier')->where('broker_id', $brokerId)->get();

        $result = $items->map(function ($item) {
            $lead = $item->lead;

            return [
                'id' => $lead->id,
                'name' => $lead->name,
                'supplier' => $lead->supplier->name ?? null,
                'price' => (float) $lead->currentPrice,
            ];
        });

        return response()->json($result);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cartItems' => 'required|array',
            'cartItems.*.lead_id' => 'required|integer',
        ]);

        $user = auth()->user();
        $brokerId = $user->broker->id;

        if ($user->isBasicPlan()) {
            $cartItemsCount = count($data['cartItems']);

            if (!$this->leadLimitService->canAddToCart($user, $cartItemsCount)) {
                $limitInfo = $this->leadLimitService->getLeadLimitInfo($user);
                return response()->json([
                    'error' => 'Limite de leads excedido',
                    'message' => 'Usuários do plano básico podem gerenciar até 100 leads. Você está tentando adicionar ' . $cartItemsCount . ' leads, mas só pode adicionar mais ' . $limitInfo['remaining_slots'] . ' leads.',
                    'limit_info' => $limitInfo,
                    'trying_to_add' => $cartItemsCount
                ], 403);
            }
        }

        $itemsWithBroker = array_map(function ($item) use ($brokerId) {
            return [
                'lead_id'    => $item['lead_id'],
                'broker_id'  => $brokerId,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }, $data['cartItems']);

        CartItem::insert($itemsWithBroker);

        return response()->json(['message' => 'Items adicionados ao carrinho']);
    }

    public function delete(Lead $lead)
    {
        $cartItem = CartItem::where('lead_id', $lead->id)->first();
        $cartItem->delete();
        return response()->json(['message' => 'Item removido']);
    }
}
