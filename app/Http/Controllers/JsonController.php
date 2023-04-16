<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class JsonController extends Controller
{

    public function usageStats(): JsonResponse
    {
        $team = auth()->user()->currentTeam;
        return response()->json([
            'usage' => $team->teamCredits?->getStats()
        ]);
    }

}
