<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use  App\Services\DashboardService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\FinancialReportRequest;

class DashboardController extends Controller
{
    private $dashboardService = null;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }
    public function index(): JsonResponse
    {
        return response()->json($this->dashboardService->index());
    }

    public function report(FinancialReportRequest $request): JsonResponse
    {
        return response()->json($this->dashboardService->report($request->validated()));
    }
}
