<?php

namespace App\Http\Controllers;

use App\Services\KanyesManager;
use Illuminate\Http\JsonResponse;

class QuoteController extends Controller
{
    public function __invoke(KanyesManager $kanyesManager): JsonResponse
    {
        return response()->json($kanyesManager->getFiveQuotes());
    }
}
