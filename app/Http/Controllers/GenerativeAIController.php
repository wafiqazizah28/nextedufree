<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GenerativeAIService;

class GenerativeAIController extends Controller
{
    protected $genAI;

    public function __construct(GenerativeAIService $genAI)
    {
        $this->genAI = $genAI;
    }

    public function generate(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string',
        ]);

        $response = $this->genAI->generateText($request->prompt);

        return response()->json([
            'message' => $response['candidates'][0]['content']['parts'][0]['text'] ?? 'Tidak ada respon'
        ]);
    }
}
