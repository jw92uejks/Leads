<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LeadService;
use App\Models\Team;
use App\Models\TeamMember;

class TeamPanelController extends Controller
{
    public function __construct(
        private readonly LeadService $leadService
    ) {}

    public function index()
    {
        $user = auth()->user();
        $broker = $user?->broker;

        if (!$broker) {
            return redirect()->route('dashboard');
        }

        $teamIds = TeamMember::where('broker_id', $broker->id)
            ->orderBy('team_id', 'asc')
            ->pluck('team_id');

        $teams = Team::whereIn('id', $teamIds)
            ->withCount('members')
            ->orderBy('id', 'asc')
            ->get();

        // Exibe a listagem sempre (mesmo vazia) para permitir o slot de criação
        return view('pclient.team-panel.index', compact('teams'));
    }

    public function show($id)
    {
        return view('pclient.team-panel.single-team.show', compact('id'));
    }

    public function edit($id)
    {
        return view('pclient.team-panel.single-team.edit', compact('id'));
    }

    public function members($id)
    {
        return view('pclient.team-panel.single-team.members', compact('id'));
    }

    public function access($id)
    {
        return view('pclient.team-panel.single-team.access', compact('id'));
    }

    public function transfer($id)
    {
        // Buscar leads adquiridos do usuário autenticado
        $leadsAcquired = $this->leadService->getLeadsByBroker(auth()->user());

        // Buscar membros da equipe
        $team = Team::findOrFail($id);
        $teamMembers = TeamMember::where('team_id', $id)
            ->with(['broker.user'])
            ->get()
            ->map(function($member) {
                return [
                    'id' => $member->broker_id,
                    'name' => $member->broker->user->name,
                    'role' => $member->role_in_team === 1 ? 'Proprietário' : 'Membro'
                ];
            });

        return view('pclient.team-panel.single-team.transfer', compact('id', 'leadsAcquired', 'teamMembers'));
    }

    public function create()
    {
        return view('pclient.team-panel.single-team.create');
    }

    /**
     * Buscar dados seguros de um lead específico via AJAX
     */
    public function getLeadData(Request $request, $teamId, $leadId)
    {
        try {
            // Verificar se a requisição é AJAX
            if (!$request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Requisição inválida.'
                ], 400);
            }

            // Buscar o lead através do serviço, garantindo que pertence ao usuário autenticado
            $lead = $this->leadService->getLeadByIdAndBroker($leadId, auth()->user());

            if (!$lead) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lead não encontrado ou você não tem permissão para acessá-lo.'
                ], 404);
            }

            // Retornar apenas dados seguros e necessários
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $lead->id,
                    'name' => $lead->name,
                    // Adicione outros campos seguros conforme necessário
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Erro ao buscar dados do lead: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor.'
            ], 500);
        }
    }
}