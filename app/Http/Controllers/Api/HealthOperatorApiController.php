<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HealthOperatorResource;
use App\Services\HealthOperatorService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HealthOperatorApiController extends Controller
{
    public function __construct(
        private readonly HealthOperatorService $service
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $operators = $this->service->listActiveOperators();

        return HealthOperatorResource::collection($operators);
    }
}

