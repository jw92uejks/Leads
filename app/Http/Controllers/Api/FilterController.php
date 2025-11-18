<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FilterController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'Usuário não autenticado'], 401);
        }

        if (!$user->broker) {
            return response()->json(['error' => 'Usuário não possui corretor associado'], 403);
        }


        $teamBrokers = $this->getTeamBrokers($user->broker);

        return response()->json([
            'user_id' => $user->broker->id,
            'user_name' => $user->name,
            'brokers' => $teamBrokers
        ]);
    }

    private function getTeamBrokers($currentBroker): array
    {

        $team = $currentBroker->team;

        if (!$team) {

            return [
                [
                    'id' => $currentBroker->id,
                    'name' => $currentBroker->user->name,
                    'email' => $currentBroker->user->email
                ]
            ];
        }


        $teamMembers = $team->members()->with('broker.user')->get();

        return $teamMembers->map(function ($member) {
            return [
                'id' => $member->broker->id,
                'name' => $member->broker->user->name,
                'email' => $member->broker->user->email,
                'role_in_team' => $member->role_in_team
            ];
        })->toArray();
    }
}
