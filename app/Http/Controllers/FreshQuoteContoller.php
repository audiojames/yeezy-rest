<?php

namespace App\Http\Controllers;

use App\Services\KanyesManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FreshQuoteContoller extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(KanyesManager $kanyesManager): JsonResponse
    {
        return response()->json($kanyesManager->getFiveFreshQuotes());
    }
}
